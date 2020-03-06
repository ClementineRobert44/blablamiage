<?php

namespace App\Controller;

use App\Entity\Trajet;
use App\Form\TrajetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TrajetController extends AbstractController
{
    /**
     * @Route("/trajet", name="trajet")
     */
    public function index()
    {
        return $this->render('trajet/index.html.twig', [
            'controller_name' => 'TrajetController',
        ]);
    }

    /**
     * Créer un neauveau trajet.
     * @Route("/nouveau-trajet", name="trajet.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */

    public function create(Request $request, EntityManagerInterface $em)
    {
        $trajet = new Trajet();
        $form = $this->createForm(TrajetType::class, $trajet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($trajet);
        $em->flush();
        return $this->redirectToRoute('trajet');
        }
        return $this->render('trajet/create.html.twig', [
        'form' => $form->createView(),
        ]);
    }
}
