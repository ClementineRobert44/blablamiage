<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/*
 * @Route("/{_locale}/")
 */ 

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index()
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}
