<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Friendship;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    /**
     *
     * @Route("/profile/{username}", name="user_profile")
     */
    public function getProfile($username)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $user = $repository->findOneByUsername($username);

        $friends = $repository->getFriends($user);

        return $this->render('profile/get_profile.html.twig', [
            'user' => $user,
            'friends' => $friends
        ]);
    }

    /**
     * @Route("/profile/{username}/update", name="update_profile")
     */
    public function updateAction($username, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $authenticatedUser = $this->getUser();
        $user = $this->getUserByUsername($username);

        if ($authenticatedUser->getId() !== $user->getId()) {
            $this->addFlash('danger', 'Access forbidden!');

            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('update_profile', [
                'username' => $user->getUsername()
            ])
        ]);

        $form->handleRequest($request);

        if (!($form->isSubmitted() && $form->isValid())) {
            return $this->render('profile/update_profile.html.twig', [
                'form' => $form->createView(),
                'username' => $username
            ]);
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $this->addFlash('success', 'You have successfully updated your profile!');

        return $this->redirectToRoute('user_profile', [
            'username' => $user->getUsername()
        ]);
    }
}