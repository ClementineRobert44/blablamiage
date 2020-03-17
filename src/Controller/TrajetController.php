<?php

namespace App\Controller;

use App\Entity\PropertySearch;
use App\Entity\Trajet;
use App\Entity\User;
use App\Form\PropertySearchType;
use App\Form\TrajetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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

    /**
     * Afficher tous les trajets dispos sur le site
     * @Route("/trajet", name="trajet.list")
     */
    public function list(Request $request, EntityManagerInterface $em)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        // Afficher seulement les trajets où il reste de la place
        /*$query = $em->createQuery(
            'SELECT t FROM App:Trajet t WHERE t.nbPassagers > :aucunPassager'
            )->setParameter('aucunPassager', 0);
            $trajets = $query->getResult();*/

        if($search->getDateDepart()){
            $query = $em->createQuery(
                'SELECT t FROM App:Trajet t WHERE t.dateDepart = :dateDepart AND t.nbPassagers > :aucunPassager'
                )
                ->setParameter('dateDepart', $search->getDateDepart())
                ->setParameter('aucunPassager', 0);
                $trajets = $query->getResult();

        }else if($search->getVilleDepart()){
            $query = $em->createQuery(
                'SELECT t FROM App:Trajet t WHERE t.villeDepart = :villeDepart AND t.nbPassagers > :aucunPassager'
                )
                ->setParameter('villeDepart', $search->getVilleDepart())
                ->setParameter('aucunPassager', 0);
                $trajets = $query->getResult();

        } else if($search->getVilleDepart() && $search->getDateDepart()){
            $query = $em->createQuery(
                'SELECT t FROM App:Trajet t WHERE t.villeDepart = :villeDepart AND t.dateDepart = :dateDepart AND t.nbPassagers > :aucunPassager'
                )
                ->setParameter('villeDepart', $search->getVilleDepart())
                ->setParameter('dateDepart', $search->getDateDepart())
                ->setParameter('aucunPassager', 0);
                $trajets = $query->getResult();
        }else{

            $query = $em->createQuery(
                'SELECT t FROM App:Trajet t WHERE t.nbPassagers > :aucunPassager'
                )->setParameter('aucunPassager', 0);
                $trajets = $query->getResult();

        }
               
        return $this->render('trajet/list.html.twig', [
            'trajets' => $trajets,
            'form' => $form->createView()
        ]);
    }

    /**
     * Afficher un trajet spécifique.
     * @Route("/trajet/{id}", name="trajet.show")
     * @param Trajet $trajet
     * @return Response
     */
    public function show(Trajet $trajet, EntityManagerInterface $em)
    {
        $users = $trajet->getIdUtilisateur();
        foreach($users as $user){
            $userId = $user->getId();
        }
        

        $query = $em->createQuery(
            'SELECT u FROM App:User u WHERE u.id = :idUser'
            )->setParameter('idUser', $userId);
            $user = $query->getResult();
            
            
        $query = $em->createQuery(
            'SELECT v FROM App:Voiture v WHERE v.idUtilisateur = :idUser'
            )->setParameter('idUser', $userId);
            $voiture = $query->getResult();       

        
        return $this->render('trajet/show.html.twig', [
            'trajet' => $trajet,
            'user' => $user,
            'voiture' => $voiture
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
    public function reserve(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $trajet = $entityManager->getRepository(Trajet::class)->find($id);
        $user=$this->getUser();
        $trajet->addIdUser($user);
        $entityManager->flush();

        return $this->redirectToRoute('updateNbPlaces', ['id' => $id]);
    }

    
}
