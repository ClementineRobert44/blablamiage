<?php

namespace App\DataFixtures;

use App\Entity\Voiture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class VoitureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {     
        
        /*************** Création des voitures rouges***************/ 
        $voiture1 = new Voiture();
        $voiture1->setMarqueVoiture("Peugeot");
        $voiture1->setModeleVoiture("207");
        $voiture1->setCouleurVoiture("Gris");
        $voiture1->setAnneeVoiture("2007");
        $voiture1->setTailleBagages("Moyen");
        $voiture1->setIdUtilisateur($manager->merge($this->getReference('admin-clementine')));        
        $manager->persist($voiture1);

        $manager->flush();   
    }
}