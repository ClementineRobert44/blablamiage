<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReserveController extends AbstractController
{
    /**
     * @Route("/reserve", name="reserve")
     */
    public function index()
    {
        return $this->render('reserve/index.html.twig', [
            'controller_name' => 'ReserveController',
        ]);
    }
}
