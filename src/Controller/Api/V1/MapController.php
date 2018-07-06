<?php
declare(strict_types=1);
namespace App\Controller\Api\V1;

use App\Repository\MapRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller
{
    /**
     * @Method({"GET"})
     * @Route("/api/v1/maps", name="api_v1_maps")
     */
    public function index(MapRepository $mapRepository): JsonResponse
    {
        $maps = [];

        foreach ($mapRepository->findAll() as $mapObject) {
            $map= [
                'id' => $mapObject->getId(),
                'name' => $mapObject->getName(),
            ];

            $maps[] = $map;
        }

        return new JsonResponse($maps);
    }
}
