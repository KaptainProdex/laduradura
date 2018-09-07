<?php
declare(strict_types=1);

namespace App\Controller\Api\V1\Match;

use App\Dto\Form\MatchDto;
use App\Form\MatchFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CreateController extends Controller
{
    /**
     * @Method({"POST"})
     * @Route("/api/v1/matches", name="api_v1_matches_create")
     */
    public function index(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $matchDto = new MatchDto();
        $form = $this->createForm(MatchFormType::class, $matchDto);

        $form->submit($data);

        if ($form->isValid()) {
            $match = $matchDto->createMatch();

            $em->persist($match);
            $em->flush();

            return new JsonResponse($match, 201);
        } else {
            return new JsonResponse(null, 400);
        }
    }
}
