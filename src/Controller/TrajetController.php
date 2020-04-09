<?php

namespace App\Controller;

use App\Entity\PropertySearch;
use App\Entity\Trajet;
use App\Entity\User;
use App\Form\PropertySearchType;
use App\Form\TrajetType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Proxies\__CG__\App\Entity\User as EntityUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/{_locale}")
 */

class TrajetController extends AbstractController
{
     /**
     * Créer un neauveau trajet.
     * @Route("/nouveau-trajet", name="trajet.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */

    public function create(Request $request, EntityManagerInterface $em)
    {
        $user=$this->getUser();
        $idUser = $user->getId();
        $query = $em->createQuery(
            'SELECT v FROM App:Voiture v WHERE v.idUtilisateur = :idUtilisateur'
            )
            ->setParameter('idUtilisateur', $idUser);
            $voiture = $query->getResult();

            if($voiture == NULL){
                $this->addFlash('pasDeVoiture', 'Vous devez ajouter une voiture pour pouvoir ajouter un trajet');
                return $this->redirectToRoute('voiture.create');
            }else{

                $trajet = new Trajet();
                $user = $this->getUser();
                $trajet->addIdUtilisateur($user);
                $form = $this->createForm(TrajetType::class, $trajet);
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($trajet);
                $em->flush();
                return $this->redirectToRoute('accueil');
                }
                return $this->render('trajet/create.html.twig', [
                'form' => $form->createView(),
                ]);

            }

        
    }

    /**
     * Afficher tous les trajets dispos sur le site
     * @Route("/trajet", name="trajet.list")
     */
    public function list(Request $request, EntityManagerInterface $em)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        // Quelque soit le mode d'affichage (recherche ou non) il faut que le(s) trajet(s) affiché(s) soi(en)t trié(s) dans l'ordre des dates de départ et pas complet
        // Ce qui est fait si l'utilisateur saisie des info de recherche
        if($search->getDateDepart()){
            // Recherche le trajet en fonction de la date de départ
            $query = $em->createQuery(
                'SELECT t FROM App:Trajet t WHERE t.dateDepart = :dateDepart AND t.nbPassagers > :aucunPassager AND t.dateDepart >= :dateDuJour ORDER BY t.dateDepart ASC'
                )
                ->setParameter('dateDepart', $search->getDateDepart())
                ->setParameter('aucunPassager', 0)
                ->setParameter('dateDuJour', new \DateTime());
                $trajets = $query->getResult();

        }else if($search->getVilleDepart()){
            // Recherche le trajet en fonction de la ville de départ saisie
            $query = $em->createQuery(
                'SELECT t FROM App:Trajet t WHERE t.villeDepart = :villeDepart AND t.nbPassagers > :aucunPassager AND t.dateDepart >= :dateDuJour ORDER BY t.dateDepart ASC'
                )
                ->setParameter('villeDepart', $search->getVilleDepart())
                ->setParameter('aucunPassager', 0)
                ->setParameter('dateDuJour', new \DateTime());
                $trajets = $query->getResult();

        } else if($search->getVilleDepart() && $search->getDateDepart()){
            // Recherche les trajets en fonction de la ville de départ ET la date de départ
            $query = $em->createQuery(
                'SELECT t FROM App:Trajet t WHERE t.villeDepart = :villeDepart AND t.dateDepart = :dateDepart AND t.nbPassagers > :aucunPassager AND t.dateDepart >= :dateDuJour ORDER BY t.dateDepart ASC'
                )
                ->setParameter('villeDepart', $search->getVilleDepart())
                ->setParameter('dateDepart', $search->getDateDepart())
                ->setParameter('aucunPassager', 0)
                ->setParameter('dateDuJour', new \DateTime());
                $trajets = $query->getResult();

        }else{
            // Rien n'est saisi par l'utilisateur donc on affiche tous les trajets
            $query = $em->createQuery(
                'SELECT t FROM App:Trajet t WHERE t.nbPassagers > :aucunPassager AND t.dateDepart >= :dateDuJour ORDER BY t.dateDepart ASC'
                )->setParameter('aucunPassager', 0)
                ->setParameter('dateDuJour', new \DateTime());
                $trajets = $query->getResult();
        }

        $usersTrajets = NULL;
        $i = 0;
        foreach($trajets as $trajet){
            $user = $trajet->getIdUtilisateur();
            $usersTrajets[$i] = $user;
            $i++;
        }           
        
        return $this->render('trajet/list.html.twig', [
            'trajets' => $trajets,
            'users' => $usersTrajets,
            'form' => $form->createView()
        ]);
    }

    /**
    * Permet de mettre à jour le nombre de places dispo dans la voiture
    * @Route("/updateNbPlaces/{id}", name="updateNbPlaces")
    */
    public function update(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $trajet = $entityManager->getRepository(Trajet::class)->find($id);

        $nbPlaces = $trajet->getNbPassagers() - 1;
        $trajet->setNbPassagers($nbPlaces);
        $entityManager->flush();

        return $this->redirectToRoute('trajet.list');
    }

    /**
    * Reserver un trajet
    * @Route("/reserve/{id}", name="reserveTrajet")
    */
    public function reserve(int $id, Request $request)
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('reserveTrajet', ['id' => $id]))
            ->getForm();
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('Trajet/reserve.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $trajet = $entityManager->getRepository(Trajet::class)->find($id);
        $user=$this->getUser();
        $trajet->addIdUser($user);
        $entityManager->flush();

        return $this->redirectToRoute('updateNbPlaces', ['id' => $id]);
    }

    /**
     * Modifier un trajet.
     * @Route("trajet/{id}/edit", name="trajet.edit")
     * @param Request $request
     * @param Trajet $trajet
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    
    public function edit(Request $request, Trajet $trajet, EntityManagerInterface $em)
    {
        $user = $this->getUser();
        $form = $this->createForm(TrajetType::class, $trajet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('user.show', ['slug' => $user->getSlug()]);
        }
        return $this->render('trajet/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Afficher les détails d'un trajet.
     * @Route("/trajet/show/{id}", name="trajet.show", requirements={"id" = "\d+"})
     * @param Trajet $trajet
     * @return Response
     */
    public function show(Trajet $trajet, EntityManagerInterface $em)
    {
        $user = $trajet->getIdUtilisateur();
        $usersReservation = $trajet->getIdUser();
        $commentairesRecus = $trajet->getCommentaires();
        
       

        //Comme c'est une collection on fait un for
        foreach($user as $userPoste){
            $utilisateurPoste = $userPoste;
        }


        return $this->render('trajet/show.html.twig', [
            'trajet' => $trajet,
            'userPoste' => $utilisateurPoste,
            'usersResa' => $usersReservation,
            'commentairesRecus' => $commentairesRecus
            
        ]);
    }

    /**
     * Supprimer une reservation.
     * @Route("trajet/deleteResa/{id}", name="reservation.delete")
     * @param Request $request
     * @param Trajet $trajet
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function deleteResa(Request $request,  Trajet $trajet, EntityManagerInterface $em)
    {

        $user = $this->getUser();

        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('reservation.delete', ['id' => $trajet->getId()]))
            ->getForm();
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('trajet/annuleResa.html.twig', [
                'trajet' => $trajet,
                'user' => $user,
                'form' => $form->createView(),
            ]);
        }

        
        
        $user->removeTrajetsReserf($trajet);
        
        $trajet->removeIdUser($user);


        $nbPlaces = $trajet->getNbPassagers();
        $nbPlaces++;
        $trajet->setNbPassagers($nbPlaces);

        $em->flush();



        return $this->redirectToRoute('trajet.list');
    }

    

    
}
