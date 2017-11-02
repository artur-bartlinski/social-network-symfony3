<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction()
    {
        $user = new User();
        $form = $this->createRegistrationForm($user);

        return $this->render('registration/register.html.twig', [
            'register_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/handle-registration", name="handle_registration")
     */
    public function handleRegistrationFormAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createRegistrationForm($user);

        $form->handleRequest($request);

        if (!($form->isSubmitted() && $form->isValid())) {
            return $this->render('registration/register.html.twig', [
                'register_form' => $form->createView()
            ]);
        }

        $user = $form->getData();
        $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        $user->setCreatedAt(new \DateTime('now'));
        $user->setUpdatedAt(new \DateTime('now'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'You have been successfully registered! You can now sign in.');

        return $this->redirectToRoute('homepage');
    }

    public function createRegistrationForm(User $user = null)
    {
        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('handle_registration'),
            'method' => 'POST'
        ]);

        return $form;
    }
}