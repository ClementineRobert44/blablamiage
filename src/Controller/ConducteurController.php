<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\BrowserKit\Response;
use App\Entity\Conducteur;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ConducteurType;

class ConducteurController extends AbstractController
{
    /**
     * Afficher tous les conducteurs isncrits sur le site
     * @Route("/conducteur", name="conducteur.list")
     */
    public function list()
    {
        $conducteurs = $this->getDoctrine()->getRepository(Conducteur::class)->findAll();
        return $this->render('conducteur/list.html.twig', [
            'conducteurs' => $conducteurs,
        ]);
    }

    /**
     * Afficher un conducteur spécifique.
     * @Route("/conducteur/{slug}", name="conducteur.show", requirements={"id" = "\d+"})
     * @param Conducteur $conducteur
     * @return Response
     */
    public function show(Conducteur $conducteur)
    {
        return $this->render('conducteur/show.html.twig', [
            'conducteur' => $conducteur,
        ]);
    }

    /**
     * Création d'un nouveau conducteur
     * @Route("/nouveau-conducteur", name="conducteur.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $conducteur = new Conducteur();
        $form = $this->createForm(ConducteurType::class, $conducteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($conducteur);
            $em->flush();
            return $this->redirectToRoute('conducteur.list');
        }
        return $this->render('conducteur/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Modifier un conducteur.
     * @Route("conducteur/{slug}/edit", name="conducteur.edit")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, Conducteur $conducteur, EntityManagerInterface $em)
    {
        $form = $this->createForm(ConducteurType::class, $conducteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('conducteur.list');
        }
        return $this->render('conducteur/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprimer un conducteur.
     * @Route("conducteur/{slug}/delete", name="conducteur.delete")
     * @param Request $request
     * @param Conducteur $conducteur
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Request $request, Conducteur $conducteur, EntityManagerInterface $em)
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('conducteur.delete', ['slug' => $conducteur->getSlug()]))
            ->getForm();
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('conducteur/delete.html.twig', [
                'conducteur' => $conducteur,
                'form' => $form->createView(),
            ]);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($conducteur);
        $em->flush();
        return $this->redirectToRoute('conducteur.list');
    }
}
