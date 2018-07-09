<?php
declare(strict_types=1);

namespace App\Controller\Api\V1\Match;

use App\Dto\Form\MatchDto;
use App\Entity\Match;
use App\Form\MatchFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UpdateController extends Controller
{
    /**
     * @Method({"PUT"})
     * @Route("/api/v1/matches/{match}", name="api_v1_matches_edit")
     */
    public function index(Request $request, EntityManagerInterface $em, Match $match = null): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        /** @var Match $match */
        $match = $em->getRepository(Match::class)->find($match->getId());
        $matchDto = MatchDto::fromMatch($match);
        $form = $this->createForm(MatchFormType::class, $matchDto);

        $form->submit($data);

        if ($form->isValid()) {
            $updatedMatch = $matchDto->updateMatch($match);
            $em->persist($updatedMatch);
            $em->flush();

            return new JsonResponse(null, 200);
        } else {
            return new JsonResponse(null, 400);
        }

    }
}
