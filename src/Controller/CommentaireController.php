<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Trajet;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * Ecrire un commentaire.
     * @Route("/nouveau-commentaire/{id}", name="commentaire.new")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */

    public function create(Request $request, EntityManagerInterface $em, int $id)
    {
        $commentaire = new Commentaire();
        $userEnLigne = $this->getUser();
        $commentaire->setIdUtilisateur($userEnLigne);

        $entityManager = $this->getDoctrine()->getManager();
        $trajet = $entityManager->getRepository(Trajet::class)->find($id);
        $users = $trajet->getIdUtilisateur();
        $idTrajet =$trajet->getId();
        foreach($users as $user){
            $userId = $user->getId();
        }
        $query = $em->createQuery(
            'SELECT u FROM App:User u WHERE u.id = :idUser'
            )->setParameter('idUser', $userId);
            $users = $query->getResult();

            foreach($users as $user){
                $user = $user->getId();
            }
        $commentaire->setIdUtilisateurCommente($user);
        $commentaire->setIdTrajet($trajet);
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
