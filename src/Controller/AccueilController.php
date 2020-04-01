<?php

namespace App\Controller;

use App\Entity\Voiture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/{_locale}")
 * 
 */

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        //Verifie que l'utilisateur est connecté
        if($user = $this->getUser()){

            //Récupère la voiture de l'utilisateur
            $voiture = $user->getVoiture();
                       
            // Affiche les 5 derniers trajets postés, n'affiche pas les expirés
            $query = $em->createQuery(
                'SELECT t FROM App:Trajet t WHERE t.dateDepart >= :dateDuJour ORDER BY t.datePublication DESC'
                )
                ->setParameter('dateDuJour', new \DateTime())
                ->setMaxResults(5); // Afficher au maximum 5 trajets
            $trajets = $query->getResult();

            // Récuperer la note de l'utilisateur connecté
            $commentaires = $user->getCommentairesRecus();

            $nbNotes = 0;
            $note = 0;
            foreach($commentaires as $commentaire){
                $nbNotes++;
                $note = $note + $commentaire->getNote();
            }

            // On récupère la moyenne de l'utilisateur
            $note = $note / $nbNotes;     

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'trajets' => $trajets,
            'utilisateur' => $user,
            'voiture' => $voiture,
            'nbNote' => $nbNotes,
            'note' => $note
        ]);

        }else{

            return $this->render('accueil/index.html.twig', [
                'controller_name' => 'AccueilController'
                
            ]);

        }
        
    }
}