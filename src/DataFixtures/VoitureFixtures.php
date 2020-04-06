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
        
        /*************** Création des voitures ***************/ 
        $voiture1 = new Voiture();
        $voiture1->setMarqueVoiture("Peugeot");
        $voiture1->setModeleVoiture("207");
        $voiture1->setCouleurVoiture("Gris");
        $voiture1->setAnneeVoiture("2007");
        $voiture1->setTailleBagages("Moyen");
        $voiture1->setIdUtilisateur($manager->merge($this->getReference('user-clementine')));        
        $manager->persist($voiture1);

        $voiture2 = new Voiture();
        $voiture2->setMarqueVoiture("Peugeot");
        $voiture2->setModeleVoiture("206+");
        $voiture2->setCouleurVoiture("Rouge");
        $voiture2->setAnneeVoiture("2012");
        $voiture2->setTailleBagages("Moyen");
        $voiture2->setIdUtilisateur($manager->merge($this->getReference('user-emma')));        
        $manager->persist($voiture2);

        $voiture3 = new Voiture();
        $voiture3->setMarqueVoiture("Volkswagen");
        $voiture3->setModeleVoiture("Golf IV match");
        $voiture3->setCouleurVoiture("Magic Black");
        $voiture3->setAnneeVoiture("2002");
        $voiture3->setTailleBagages("Grand");
        $voiture3->setIdUtilisateur($manager->merge($this->getReference('user-jules')));        
        $manager->persist($voiture3);

        $manager->flush();   
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}