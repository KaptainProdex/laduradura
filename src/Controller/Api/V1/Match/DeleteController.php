<?php
declare(strict_types=1);

namespace App\Controller\Api\V1\Match;

use App\Entity\Match;
use App\Form\MatchFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeleteController extends Controller
{
    /**
     * @Method({"DELETE"})
     * @Route("/api/v1/matches/{match}", name="api_v1_matches_delete")
     */
    public function index(EntityManagerInterface $em, Match $match = null): JsonResponse
    {
        try {
            $em->remove($match);
            $em->flush();

            return new JsonResponse(null, 204);
        } catch (\Exception $exception) {
            return new JsonResponse(null, 409);
        }


    }
}
