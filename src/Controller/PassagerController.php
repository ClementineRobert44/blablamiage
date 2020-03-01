<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Passager;
use Symfony\Component\HttpFoundation\Response;

class PassagerController extends AbstractController
{
    /**
     * @Route("/passager", name="passager.list")
     */
    public function list() : Response
    {
        $passagers = $this->getDoctrine()->getRepository(Passager::class)->findAll();
        return $this->render('passager/list.html.twig', [
            'passagers' => $passagers,
        ]);
    }
}
