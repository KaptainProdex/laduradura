<?php
declare(strict_types=1);
namespace App\Controller\Api\V1;

use App\Repository\HeroRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HeroController extends Controller
{
    /**
     * @Method({"GET"})
     * @Route("/api/v1/heroes", name="api_v1_heroes")
     */
    public function index(HeroRepository $heroRepository): JsonResponse
    {
        $heroes = [];

        foreach ($heroRepository->findAll() as $heroObject) {
            $hero = [
                'id' => $heroObject->getId(),
                'name' => $heroObject->getName(),
            ];

            $heroes[] = $hero;
        }

        return new JsonResponse($heroes);
    }
}
