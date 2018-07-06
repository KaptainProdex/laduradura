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

class CreateController extends Controller
{
    /**
     * @Method({"POST"})
     * @Route("/api/v1/matches", name="api_v1_matches_create")
     */
    public function index(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $match = new Match();
        $form = $this->createForm(MatchFormType::class, $match);

        $form->submit($data);

        $em->persist($match);
        $em->flush();

        return new JsonResponse();
    }
}
