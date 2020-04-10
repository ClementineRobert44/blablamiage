<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Trajet;
use App\Entity\User;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/{_locale}")
 */

class CommentaireController extends AbstractController
{
    /**
     * Ecrire un commentaire.
     * @Route("/nouveau-commentaire/{idTrajet}/{statut}", name="commentaire.new")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */

    public function create(Request $request, EntityManagerInterface $em, int $idTrajet, String $statut)
    {
        $commentaire = new Commentaire();
        $userQuiCommente = $this->getUser();
        $commentaire->addIdUtilisateurQuiCommente($userQuiCommente);

        $entityManager = $this->getDoctrine()->getManager();
        $trajet = $entityManager->getRepository(Trajet::class)->find($idTrajet);
        
        $conducteurs = $trajet->getIdUtilisateur();
        // Car c'est une collection
        foreach($conducteurs as $conducteur){
            $conduct = $conducteur;
        }

        $passagers = $trajet->getIdUser();
        foreach($passagers as $pass){
            if($pass->getId() == $this->getUser()->getId()){
                $passager = $pass;
            }
        }

    
        if($statut == "Passager"){
            $commentaire->addIdUtilisateurCommente($passager);
        }else{
            $commentaire->addIdUtilisateurCommente($conduct);
        }
        
    
        
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
        $em->persist($commentaire);
        $em->flush();
        return $this->redirectToRoute('user.show', ['slug' => $this->getUser()->getSlug()]);
        }
        return $this->render('commentaire/create.html.twig', [
        'form' => $form->createView(),
        ]);
    }

    /**
     * Afficher tous les comentaires d'un utilisateur.
     * @Route("/commentaire/{slug}", name="commentaire.show")
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {        
        $commentaires = $user->getCommentairesRecus();
        $note = 0;
        $nbNote = 0;

        foreach($commentaires as $commentaire){
            $note = $note + $commentaire->getNote();
            $nbNote++;
        }

        $note = $note / $nbNote;

        return $this->render('commentaire/show.html.twig', [
            'user' => $user,
            'commentaires' => $commentaires,
            'note' => $note,
            
        ]);
    }
}
