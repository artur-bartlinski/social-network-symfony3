<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/search", name="search")
     */
    public function handleSearch(Request $request)
    {
        $userName = $request->query->get('query');

        if (!$userName) {
            return $this->redirectToRoute('homepage');
        }

        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findByQuery($userName);

        return $this->render('search/get_results.html.twig', [
            'username' => $userName,
            'users' => $users
        ]);
    }
}