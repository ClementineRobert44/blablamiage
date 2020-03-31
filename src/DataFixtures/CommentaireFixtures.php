<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\TrajetFixtures;


class CommentaireFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {     
        /*************** Ajout de commentaires sur les trajets expirés ***************/
        $commentaire1 = new Commentaire();
        $commentaire1->setDateCom(new \DateTime("2020/03/25"));
        $commentaire1->setContenuCom("Clémentine a une très bonne conduite et est très arrangeante");
        $commentaire1->setNote("5");
        $commentaire1->addIdUtilisateurCommente($manager->merge($this->getReference('user-clementine')));
        $commentaire1->addIdUtilisateurQuiCommente($manager->merge($this->getReference('user-jules')));
        $manager->persist($commentaire1);

        $commentaire2 = new Commentaire();
        $commentaire2->setDateCom(new \DateTime("2020/03/25"));
        $commentaire2->setContenuCom("Très bien je recommande");
        $commentaire2->setNote("4");
        $commentaire2->addIdUtilisateurCommente($manager->merge($this->getReference('user-clementine')));
        $commentaire2->addIdUtilisateurQuiCommente($manager->merge($this->getReference('user-emma')));
        $manager->persist($commentaire2);

        $commentaire3 = new Commentaire();
        $commentaire3->setDateCom(new \DateTime("2020/02/02"));
        $commentaire3->setContenuCom("Très bonne conduite mais je n'aimais pas trop la musique écoutée durant ce trajet. Dommage mais je recommande quand même");
        $commentaire3->setNote("3");
        $commentaire3->addIdUtilisateurCommente($manager->merge($this->getReference('user-clementine')));
        $commentaire3->addIdUtilisateurQuiCommente($manager->merge($this->getReference('user-jacques')));
        $manager->persist($commentaire3);

        $commentaire3 = new Commentaire();
        $commentaire3->setDateCom(new \DateTime("2020/01/01"));
        $commentaire3->setContenuCom("Emma est ponctuelle, arrangeante et a une très bonne conduite. Je recommande vivement et voyagerais à nouveau avec elle avec plaisir.");
        $commentaire3->setNote("5");
        $commentaire3->addIdUtilisateurCommente($manager->merge($this->getReference('user-emma')));
        $commentaire3->addIdUtilisateurQuiCommente($manager->merge($this->getReference('user-clementine')));
        $manager->persist($commentaire3);

        $commentaire4 = new Commentaire();
        $commentaire4->setDateCom(new \DateTime("2020/01/01"));
        $commentaire4->setContenuCom("Très bon voyage, je recommande");
        $commentaire4->setNote("4");
        $commentaire4->addIdUtilisateurCommente($manager->merge($this->getReference('user-emma')));
        $commentaire4->addIdUtilisateurQuiCommente($manager->merge($this->getReference('user-jacques')));
        $manager->persist($commentaire4);

        $commentaire5 = new Commentaire();
        $commentaire5->setDateCom(new \DateTime("2019/12/26"));
        $commentaire5->setContenuCom("Conduite parfaite, rien à redire");
        $commentaire5->setNote("5");
        $commentaire5->addIdUtilisateurCommente($manager->merge($this->getReference('user-emma')));
        $commentaire5->addIdUtilisateurQuiCommente($manager->merge($this->getReference('user-jules')));
        $manager->persist($commentaire5);

        $commentaire6 = new Commentaire();
        $commentaire6->setDateCom(new \DateTime("2020/02/26"));
        $commentaire6->setContenuCom("Très bonne musique, arrangeant.");
        $commentaire6->setNote("5");
        $commentaire6->addIdUtilisateurCommente($manager->merge($this->getReference('user-jules')));
        $commentaire6->addIdUtilisateurQuiCommente($manager->merge($this->getReference('user-emma')));
        $manager->persist($commentaire6);

        $commentaire7 = new Commentaire();
        $commentaire7->setDateCom(new \DateTime("2020/02/26"));
        $commentaire7->setContenuCom("Très bien cependant attention à la vitesse quelque fois.");
        $commentaire7->setNote("3");
        $commentaire7->addIdUtilisateurCommente($manager->merge($this->getReference('user-jules')));
        $commentaire7->addIdUtilisateurQuiCommente($manager->merge($this->getReference('user-clementine')));
        $manager->persist($commentaire7);

        $manager->flush();  
        
    

    }

    // Permet de lister ce dont à besoin cette fixture pour fonctionner
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            TrajetFixtures::class,
        );
    }
}