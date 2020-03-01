<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConducteurController extends AbstractController
{
    /**
     * @Route("/conducteur", name="conducteur")
     */
    public function index()
    {
        return $this->render('conducteur/index.html.twig', [
            'controller_name' => 'ConducteurController',
        ]);
    }
}
