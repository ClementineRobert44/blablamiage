<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    /**
     * @Route("/voiture", name="voiture")
     */
    public function index()
    {
        return $this->render('voiture/index.html.twig', [
            'controller_name' => 'VoitureController',
        ]);
    }

    /**
     * Créer un nouvelle voiture.
     * @Route("/nouvelle-voiture", name="voiture.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */

    public function create(Request $request, EntityManagerInterface $em)
    {
        $voiture = new Voiture();
        $user = $this->getUser();
        $voiture->setIdUtilisateur($user);
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($voiture);
        $em->flush();
        return $this->redirectToRoute('accueil');
        }
        return $this->render('voiture/create.html.twig', [
        'form' => $form->createView(),
        ]);
    }

   
}
