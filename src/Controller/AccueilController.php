<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {

        $query = $em->createQuery(
            'SELECT t FROM App:Trajet t ORDER BY t.datePublication DESC'
            )
            ->setMaxResults(5);
            $trajets = $query->getResult();


        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'trajets' => $trajets
        ]);
    }
}