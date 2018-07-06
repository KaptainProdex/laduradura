<?php
declare(strict_types=1);
namespace App\Controller\Api\V1;

use App\Repository\MatchRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MatchController extends Controller
{
    /**
     * @Method({"GET"})
     * @Route("/api/v1/matches", name="api_v1_matches")
     */
    public function index(MatchRepository $matchRepository): JsonResponse
    {
        $matches = [];

        foreach ($matchRepository->findAll() as $matchObject) {
            $heroes = [];
            foreach ($matchObject->getHeroes() as $heroObject) {
               $hero = [
                   'id' => $heroObject->getId()
               ];
               $heroes[] = $hero;
            }

            $match = [
                'id' => $matchObject->getId(),
                'season' => $matchObject->getSeason()->getId(),
                'heroes' => $heroes,
            ];

            $matches[] = $match;
        }

        return new JsonResponse($matches);
    }
}
