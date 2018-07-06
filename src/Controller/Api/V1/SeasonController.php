<?php
declare(strict_types=1);
namespace App\Controller\Api\V1;

use App\Repository\SeasonRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeasonController extends Controller
{
    /**
     * @Method({"GET"})
     * @Route("/api/v1/seasons", name="api_v1_seasons")
     */
    public function index(SeasonRepository $seasonRepository): JsonResponse
    {
        $seasons = [];

        foreach ($seasonRepository->findAll() as $seasonObject) {
            $season= [
                'id' => $seasonObject->getId(),
                'number' => $seasonObject->getNumber(),
            ];

            $seasons[] = $season;
        }

        return new JsonResponse($seasons);
    }
}
