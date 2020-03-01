<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Passager;
use Symfony\Component\HttpFoundation\Response;

class PassagerController extends AbstractController
{
    /**
     * Afficher tous les passagers isncrits sur le site
     * @Route("/passager", name="passager.list")
     */
    public function list(): Response
    {
        $passagers = $this->getDoctrine()->getRepository(Passager::class)->findAll();
        return $this->render('passager/list.html.twig', [
            'passagers' => $passagers,
        ]);
    }

    /**
     * Afficher un passager spécifique.
     * @Route("/passager/{slug}", name="passager.show", requirements={"id" = "\d+"})
     * @param Passager $passager
     * @return Response
     */
    public function show(Passager $passager): Response
    {
        return $this->render('passager/show.html.twig', [
            'passager' => $passager,
        ]);
    }
}
