<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PassagerController extends AbstractController
{
    /**
     * @Route("/passager", name="passager")
     */
    public function list()
    {
        $passagers = $this->getDoctrine()->getRepository(Passager::class)->findAll();
        return $this->render('passager/list.html.twig', [
            'passager' => $passagers,
    }
}
