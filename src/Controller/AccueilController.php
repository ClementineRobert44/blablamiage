<?php

namespace App\Controller;

use App\Entity\Voiture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        
        if($user = $this->getUser()){

            $idUser = $user->getId();

        $query = $em->createQuery(
            'SELECT v FROM App:Voiture v WHERE v.idUtilisateur = :idUser'
            )
            ->setParameter('idUser', $idUser);
            $voitures = $query->getResult();

        $query = $em->createQuery(
            'SELECT t FROM App:Trajet t ORDER BY t.datePublication DESC'
            )
            ->setMaxResults(5);
            $trajets = $query->getResult();

        $query = $em->createQuery(
            'SELECT c.note FROM App:Commentaire c WHERE c.idUtilisateurCommente = :idUser OR c.idUtilisateur = :idUser'
            )
            ->setParameter('idUser', $idUser);
            $notes = $query->getResult();

            $nbNotes = 0;
            $moyenne = 0;
            
        foreach($notes as $note){
            $nbNotes = $nbNotes + 1;
            $moyenne = $moyenne + $note['note'];
        }

        if($nbNotes != 0){
            $moyenne = $moyenne / $nbNotes;
        }

        
        


        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'trajets' => $trajets,
            'utilisateur' => $user,
            'voitures' => $voitures,
            'nbNote' => $nbNotes,
            'note' => $moyenne
        ]);

        }else{

            return $this->render('accueil/index.html.twig', [
                'controller_name' => 'AccueilController'
                
            ]);

        }
        
    }
}