<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Passager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PassagerType;

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

    /**
     * Création d'un nouveau passager
     * @Route("/nouveau-passager", name="passager.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $passager = new Passager();
        $form = $this->createForm(PassagerType::class, $passager);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($passager);
            $em->flush();
            return $this->redirectToRoute('passager.list');
        }
        return $this->render('passager/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Modifier un passager.
     * @Route("passager/{slug}/edit", name="passager.edit")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, Passager $passager, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PassagerType::class, $passager);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('passager.list');
        }
        return $this->render('passager/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
