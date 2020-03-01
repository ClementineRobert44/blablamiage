<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PassagerController extends AbstractController
{
    /**
     * @Route("/passager", name="passager")
     */
    public function index()
    {
        return $this->render('passager/index.html.twig', [
            'controller_name' => 'PassagerController',
        ]);
    }
}
