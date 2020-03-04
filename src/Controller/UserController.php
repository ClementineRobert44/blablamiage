<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\BrowserKit\Response;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\UtilisateurType;

class UserController extends AbstractController
{
    /**
     * Afficher tous les utilisateurs isncrits sur le site
     * @Route("/user", name="user.list")
     */
    public function list()
    {
        $utilisateurs = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('user/list.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);
    }

    /**
     * Afficher un utilisateur spécifique.
     * @Route("/user/{slug}", name="user.show", requirements={"id" = "\d+"})
     * @param User $utilisateur
     * @return Response
     */
    public function show(User $utilisateur)
    {
        return $this->render('user/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    /**
     * Création d'un nouveau Utilisateur
     * @Route("/nouveau-user", name="user.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $utilisateur = new User();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($utilisateur);
            $em->flush();
            return $this->redirectToRoute('user.list');
        }
        return $this->render('user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Modifier un Utilisateur.
     * @Route("user/{slug}/edit", name="user.edit")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, User $utilisateur, EntityManagerInterface $em)
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('utilisateur.list');
        }
        return $this->render('user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprimer un Utilisateur.
     * @Route("user/{slug}/delete", name="user.delete")
     * @param Request $request
     * @param User $utilisateur
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Request $request, User $utilisateur, EntityManagerInterface $em)
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('user.delete', ['slug' => $utilisateur->getSlug()]))
            ->getForm();
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('User/delete.html.twig', [
                'utilisateur' => $utilisateur,
                'form' => $form->createView(),
            ]);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($utilisateur);
        $em->flush();
        return $this->redirectToRoute('user.list');
    }
}
