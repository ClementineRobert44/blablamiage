<?php

namespace App\Controller;

use App\Entity\Trajet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\BrowserKit\Response;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

/*
 * @Route("/{_locale}, defaults={"_locale":"en"}, requirements={"_locale": "en|fr"})
 */ 
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
     * Afficher un utilisateur spécifique avec toutes ses données.
     * @Route("/user/{slug}", name="user.show", requirements={"id" = "\d+"})
     * @param User $utilisateur
     * @return Response
     */
    public function show(User $utilisateur, EntityManagerInterface $em)
    {
        // Initiatilisations des variables

        $trajetPostesExpires = NULL;
        $trajetPostesAVenir = NULL;
        $trajetReservesExpires = NULL;
        $trajetReservesAVenir = NULL;
        // Récupère les trajets qu'il a posté
        $trajetsPostes = $utilisateur->getTrajets();


        // Récupère les trajets postés et expirés et ou a venir
        foreach($trajetsPostes as $trajetPoste){
            
            $idTrajet = $trajetPoste->getId();
            
            $entityManager = $this->getDoctrine()->getManager();
            $trajetPostesExpires = $entityManager->getRepository(Trajet::class)->getTrajetsExpires($idTrajet);
            
        }

        foreach($trajetsPostes as $trajetPoste){
            $idTrajet = $trajetPoste->getId();
            $entityManager = $this->getDoctrine()->getManager();
            $trajetPostesAVenir = $entityManager->getRepository(Trajet::class)->getTrajetsAvenir($idTrajet); 
        }


        // Recupères les trajets reservé
        $trajetsReserves = $utilisateur->getTrajetsReserves();

        // Récupère les trajets postés et expirés et ou a venir
        foreach($trajetsReserves as $trajetReserve){
            $idTrajet = $trajetReserve->getId();

            $query = $em->createQuery(
                'SELECT t FROM App:Trajet t WHERE t.id = :idTrajet AND t.dateDepart < :dateDuJour'
                )->setParameter('idTrajet', $idTrajet)
                ->setParameter('dateDuJour', new DateTime());
                $trajetReservesExpires = $query->getResult();

            $query = $em->createQuery(
                'SELECT t FROM App:Trajet t WHERE t.id = :idTrajet AND t.dateDepart >= :dateDuJour'
                )->setParameter('idTrajet', $idTrajet)
                ->setParameter('dateDuJour', new DateTime());
                $trajetReservesAVenir = $query->getResult();
        }

        // Afficher les trajets à venir

        return $this->render('user/show.html.twig', [
            'utilisateur' => $utilisateur,
            'trajetsPostesExpires' => $trajetPostesExpires,
            'trajetsPostesAVenir' => $trajetPostesAVenir,
            'trajetsReservesExpires' => $trajetReservesExpires,
            'trajetsReservesAVenir' => $trajetReservesAVenir
        ]);
    }
    

    

    /**
     * Modifier un Utilisateur.
     * @Route("user/{slug}/edit", name="user.edit")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    /*
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
    }*/

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
