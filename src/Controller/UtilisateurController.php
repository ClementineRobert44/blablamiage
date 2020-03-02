<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\BrowserKit\Response;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\UtilisateurType;

class UtilisateurController extends AbstractController
{
    /**
     * Afficher tous les utilisateurs isncrits sur le site
     * @Route("/utilisateur", name="utilisateur.list")
     */
    public function list()
    {
        $utilisateurs = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();
        return $this->render('utilisateur/list.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);
    }

    /**
     * Afficher un utilisateur spécifique.
     * @Route("/utilisateur/{slug}", name="utilisateur.show", requirements={"id" = "\d+"})
     * @param Utilisateur $utilisateur
     * @return Response
     */
    public function show(Utilisateur $utilisateur)
    {
        return $this->render('utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    /**
     * Création d'un nouveau Utilisateur
     * @Route("/nouveau-utilisateur", name="utilisateur.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($utilisateur);
            $em->flush();
            return $this->redirectToRoute('utilisateur.list');
        }
        return $this->render('utilisateur/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Modifier un Utilisateur.
     * @Route("utilisateur/{slug}/edit", name="utilisateur.edit")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, Utilisateur $utilisateur, EntityManagerInterface $em)
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('utilisateur.list');
        }
        return $this->render('utilisateur/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprimer un Utilisateur.
     * @Route("utilisateur/{slug}/delete", name="utilisateur.delete")
     * @param Request $request
     * @param Utilisateur $utilisateur
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Request $request, Utilisateur $utilisateur, EntityManagerInterface $em)
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('utilisateur.delete', ['slug' => $utilisateur->getSlug()]))
            ->getForm();
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('Utilisateur/delete.html.twig', [
                'utilisateur' => $utilisateur,
                'form' => $form->createView(),
            ]);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($utilisateur);
        $em->flush();
        return $this->redirectToRoute('utilisateur.list');
    }
}
