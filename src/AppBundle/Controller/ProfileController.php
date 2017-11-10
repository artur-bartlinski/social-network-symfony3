<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProfileController extends Controller
{
    /**
     * @Route("/profile/{username}", name="user_profile")
     */
    public function getProfile($username)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneByUsername($username);

        if (!$user) {
            throw $this->createNotFoundException('User does not exist!');
        }

        return $this->render('profile/get_profile.html.twig', [
            'user' => $user
        ]);
    }
}