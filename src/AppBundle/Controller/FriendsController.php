<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FriendsController extends Controller
{
    /**
     * @Route("/profile/{username}/friends", name="friends")
     */
    public function indexAction($username)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $user = $repository->findOneByUsername($username);

        $friends = $repository->getFriends($user);

        return $this->render('friends/index.html.twig', [
            'friends' => $friends
        ]);
    }
}