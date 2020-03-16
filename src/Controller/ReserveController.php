<?php

namespace App\Controller;

use App\Entity\Reserve;
use App\Entity\Trajet;
use App\Form\ReserveType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class ReserveController extends AbstractController
{
    

    /**
     * Créer une reservation.
     * @Route("/nouvelle-reservation/{id}", name="reserve.create")
     * @param Trajet $trajet
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */

    public function create(Request $request, EntityManagerInterface $em, Trajet $trajet, int $id)
    {
        $reserve = new Reserve();
        $user = $this->getUser();
        $reserve->addIdUtilisateur($user);
        $reserve->addIdTrajet($trajet);
        
        $form = $this->createForm(ReserveType::class, $reserve);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($reserve);
        $em->flush();
           return $this->redirectToRoute('updateNbPlaces', ['id' => $id]);
        }
        return $this->render('reserve/create.html.twig', [
        'form' => $form->createView(),
        ]);
    }


}
