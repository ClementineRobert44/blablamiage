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

class CommentaireController extends AbstractController
{
    /**
     * Ecrire un commentaire.
     * @Route("/nouveau-commentaire/{idTrajet}", name="commentaire.new")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */

    public function create(Request $request, EntityManagerInterface $em, int $idTrajet)
    {
        $commentaire = new Commentaire();
        $userQuiCommente = $this->getUser();
        $commentaire->addIdUtilisateurQuiCommente($userQuiCommente);

        $entityManager = $this->getDoctrine()->getManager();
        $trajet = $entityManager->getRepository(Trajet::class)->find($idTrajet);
        $conducteurs = $trajet->getIdUtilisateur();
        foreach($conducteurs as $conducteur){
            $conduct = $conducteur;
        }
    
        $commentaire->addIdUtilisateurCommente($conduct);
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
        $em->persist($commentaire);
        $em->flush();
        return $this->redirectToRoute('accueil');
        }
        return $this->render('commentaire/create.html.twig', [
        'form' => $form->createView(),
        ]);
    }
}
