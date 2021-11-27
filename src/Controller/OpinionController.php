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

        return $this->render('opinion/index.html.twig', [
            'controller_name' => 'OpinionController',
            'opinion' => $opinionType->createView(),
            'opinions' => $entityManager->getRepository(Opinion::class)->findAll()
        ]);
    }
}
