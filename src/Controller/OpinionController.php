<?php

namespace App\Controller;

use App\Entity\Opinion;
use App\Form\OpinionType;
use App\Service\OpinionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpinionController extends AbstractController
{
    /**
     * @Route("/", name="opinion")
     */
    public function index(Request $request, OpinionService $opinionService, EntityManagerInterface $entityManager): Response
    {
        $opinionType = $this->createForm(OpinionType::class);

        $opinionType->handleRequest($request);

        if ($opinionType->isSubmitted() && $opinionType->isValid()) {
            $opinion = $opinionType->getData();

            $opinionService->save($opinion);
            $entityManager->flush();
        }

        if ($request->query->has('orderBy') && in_array($request->query->get('orderBy'), ['date', 'note'])) {
            $opinions = $entityManager->getRepository(Opinion::class)->findAllActiveOrderBy($request->query->get('orderBy'));
        } else {
            $opinions = $entityManager->getRepository(Opinion::class)->findAllActiveOrderBy('date');
        }

        return $this->render('opinion/index.html.twig', [
            'controller_name' => 'OpinionController',
            'opinion' => $opinionType->createView(),
            'opinions' => $opinions
        ]);
    }
}
