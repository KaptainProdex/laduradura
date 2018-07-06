<?php

namespace App\Controller;

use App\Entity\Match;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        $matchRepository = $this->getDoctrine()->getManager()->getRepository(Match::class);
        $matches = $matchRepository->findAll();

        return $this->render(
            'index.html.twig',
            [
                'matches' => $matches,
            ]
        );
    }
}
