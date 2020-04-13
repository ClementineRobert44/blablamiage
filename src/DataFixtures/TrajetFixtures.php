<?php

namespace App\DataFixtures;

use App\Entity\Trajet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\UserFixtures;


class TrajetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {     
        // Les dates peuvent ne pas être cohérentes (plusieurs longs trajets en quelques jours)
        /*************** Ajout d'un trajet qui sera expiré lors de l'évaluation ***************/ 
        /*************** Ces trajets pourront donc bénificer de commentaires ***************/
        $trajetExpire1 = new Trajet();
        $trajetExpire1->setHeureDepart(new \DateTime("18:00"));
        $trajetExpire1->setAdresseDepart("99 rue des Dunes");
        $trajetExpire1->setCodePostalDepart("35400");
        $trajetExpire1->setVilleDepart("Saint-Malo");
        $trajetExpire1->setAdresseArrivee("58 rue Pierre De Coubertin");
        $trajetExpire1->setCodePostalArrivee("31000");  
        $trajetExpire1->setVilleArrivee("Toulouse");
        $trajetExpire1->setPrixTrajet("102");
        $trajetExpire1->setNbPassagers("2"); // 4 places de bases mais il en reste 2 car il y a eu 2 reservations
        $trajetExpire1->setDatePublication(new \DateTime("2020/02/24"));
        $trajetExpire1->setDateDepart(new \DateTime("2020/03/24"));
        $trajetExpire1->addIdUtilisateur($manager->merge($this->getReference('user-clementine'))); // Clémentine propose de trajet
        $trajetExpire1->addIdUser($manager->merge($this->getReference('user-emma'))); // Emma reserve ce trajet
        $trajetExpire1->addIdUser($manager->merge($this->getReference('user-jules'))); // Jules reserve ce trajet
        $manager->persist($trajetExpire1);

        // Trajet expiré et complet
        $trajetExpire2 = new Trajet();
        $trajetExpire2->setHeureDepart(new \DateTime("19:30"));
        $trajetExpire2->setAdresseDepart("47 rue des Chaligny");
        $trajetExpire2->setCodePostalDepart("06000");
        $trajetExpire2->setVilleDepart("Nice");
        $trajetExpire2->setAdresseArrivee("14 Faubourg Saint Honoré");
        $trajetExpire2->setCodePostalArrivee("75018");  
        $trajetExpire2->setVilleArrivee("Paris");
        $trajetExpire2->setPrixTrajet("80");
        $trajetExpire2->setNbPassagers("0"); // 4 places de bases mais il en reste 0 car il y a eu 3 reservations
        $trajetExpire2->setDatePublication(new \DateTime("2020/01/24"));
        $trajetExpire2->setDateDepart(new \DateTime("2020/01/30"));
        $trajetExpire2->addIdUtilisateur($manager->merge($this->getReference('user-clementine'))); // Clémentine propose de trajet
        $trajetExpire2->addIdUser($manager->merge($this->getReference('user-emma'))); // Emma reserve ce trajet
        $trajetExpire2->addIdUser($manager->merge($this->getReference('user-jules'))); // Jules reserve ce trajet
        $trajetExpire2->addIdUser($manager->merge($this->getReference('user-jacques'))); // Jacques reserve ce trajet
        $manager->persist($trajetExpire2);

        $trajetExpire3 = new Trajet();
        $trajetExpire3->setHeureDepart(new \DateTime("19:30"));
        $trajetExpire3->setAdresseDepart("47 rue des Chaligny");
        $trajetExpire3->setCodePostalDepart("06000");
        $trajetExpire3->setVilleDepart("Nice");
        $trajetExpire3->setAdresseArrivee("14 Faubourg Saint Honoré");
        $trajetExpire3->setCodePostalArrivee("75018");  
        $trajetExpire3->setVilleArrivee("Paris");
        $trajetExpire3->setPrixTrajet("80");
        $trajetExpire3->setNbPassagers("1"); // 3 places de bases mais il en reste 1 car il y a eu 2 reservations
        $trajetExpire3->setDatePublication(new \DateTime("2019/12/24"));
        $trajetExpire3->setDateDepart(new \DateTime("2019/12/31"));
        $trajetExpire3->addIdUtilisateur($manager->merge($this->getReference('user-emma'))); // Emma propose de trajet
        $trajetExpire3->addIdUser($manager->merge($this->getReference('user-clementine'))); // Clémentine reserve ce trajet
        $trajetExpire3->addIdUser($manager->merge($this->getReference('user-jacques'))); // Jacques reserve ce trajet
        $manager->persist($trajetExpire3);

        $trajetExpire4 = new Trajet();
        $trajetExpire4->setHeureDepart(new \DateTime("10:30"));
        $trajetExpire4->setAdresseDepart("93 route de Lyon");
        $trajetExpire4->setCodePostalDepart("44300");
        $trajetExpire4->setVilleDepart("Nantes");
        $trajetExpire4->setAdresseArrivee("4 rue de Groussay");
        $trajetExpire4->setCodePostalArrivee("75020");  
        $trajetExpire4->setVilleArrivee("Paris");
        $trajetExpire4->setPrixTrajet("65");
        $trajetExpire4->setNbPassagers("1"); // 3 places de bases mais il en reste 1 car il y a eu 2 reservations
        $trajetExpire4->setDatePublication(new \DateTime("2019/12/20"));
        $trajetExpire4->setDateDepart(new \DateTime("2019/12/25"));
        $trajetExpire4->addIdUtilisateur($manager->merge($this->getReference('user-emma'))); // Emma propose de trajet
        $trajetExpire4->addIdUser($manager->merge($this->getReference('user-clementine'))); // Clémentine reserve ce trajet
        $trajetExpire4->addIdUser($manager->merge($this->getReference('user-jules'))); // Jules reserve ce trajet
        $manager->persist($trajetExpire4);

        $trajetExpire5 = new Trajet();
        $trajetExpire5->setHeureDepart(new \DateTime("09:30"));
        $trajetExpire5->setAdresseDepart("87 rue de l'Aigle");
        $trajetExpire5->setCodePostalDepart("59110");
        $trajetExpire5->setVilleDepart("La Madeleine");
        $trajetExpire5->setAdresseArrivee("64 rue des lieutemants Thomazo");
        $trajetExpire5->setCodePostalArrivee("39100");  
        $trajetExpire5->setVilleArrivee("Dole");
        $trajetExpire5->setPrixTrajet("80");
        $trajetExpire5->setNbPassagers("1"); // 3 places de bases mais il en reste 1 car il y a eu 2 reservations
        $trajetExpire5->setDatePublication(new \DateTime("2020/02/24"));
        $trajetExpire5->setDateDepart(new \DateTime("2020/02/28"));
        $trajetExpire5->addIdUtilisateur($manager->merge($this->getReference('user-jules'))); // Jules propose de trajet
        $trajetExpire5->addIdUser($manager->merge($this->getReference('user-clementine'))); // Clémentine reserve ce trajet
        $trajetExpire5->addIdUser($manager->merge($this->getReference('user-jacques'))); // Jacques reserve ce trajet
        $manager->persist($trajetExpire5);

        $trajetExpire6 = new Trajet();
        $trajetExpire6->setHeureDepart(new \DateTime("09:30"));
        $trajetExpire6->setAdresseDepart("8 avenue Jules Ferry");
        $trajetExpire6->setCodePostalDepart("83140");
        $trajetExpire6->setVilleDepart("Six-Fours-Les-Plages");
        $trajetExpire6->setAdresseArrivee("82 rue du Paillle en queue");
        $trajetExpire6->setCodePostalArrivee("91940");  
        $trajetExpire6->setVilleArrivee("Les Ulis");
        $trajetExpire6->setPrixTrajet("111");
        $trajetExpire6->setNbPassagers("0"); // 3 places de bases mais il en reste 0 car il y a eu 3 reservations
        $trajetExpire6->setDatePublication(new \DateTime("2020/02/20"));
        $trajetExpire6->setDateDepart(new \DateTime("2020/02/25"));
        $trajetExpire6->addIdUtilisateur($manager->merge($this->getReference('user-jules'))); // Jules propose de trajet
        $trajetExpire6->addIdUser($manager->merge($this->getReference('user-clementine'))); // Clémentine reserve ce trajet
        $trajetExpire6->addIdUser($manager->merge($this->getReference('user-jacques'))); // Jacques reserve ce trajet
        $trajetExpire6->addIdUser($manager->merge($this->getReference('user-emma'))); // Emma reserve ce trajet
        $manager->persist($trajetExpire6);

        /*************** Ajout de trajets non expirés lors de l'évaluation ***************/ 
        
        $trajet1 = new Trajet();
        $trajet1->setHeureDepart(new \DateTime("15:00"));
        $trajet1->setAdresseArrivee("91 rue Bonneterie");
        $trajet1->setCodePostalArrivee("82000");
        $trajet1->setVilleArrivee("Montauban");
        $trajet1->setAdresseDepart("44 rue Goya");
        $trajet1->setCodePostalDepart("94000");  
        $trajet1->setVilleDepart("Créteil");
        $trajet1->setPrixTrajet("63");
        $trajet1->setNbPassagers("3"); // 4 places de bases mais il en reste 3 car il y a eu 1 reservation
        $trajet1->setDatePublication(new \DateTime("2020/03/31"));
        $trajet1->setDateDepart(new \DateTime("2020/07/26"));
        $trajet1->addIdUtilisateur($manager->merge($this->getReference('user-clementine'))); // Clémentine propose de trajet
        $trajet1->addIdUser($manager->merge($this->getReference('user-jacques'))); // Jacques reserve ce trajet
        $manager->persist($trajet1);
                
        $trajet2 = new Trajet();
        $trajet2->setHeureDepart(new \DateTime("17:00"));
        $trajet2->setAdresseArrivee("99 rue des Dunes");
        $trajet2->setCodePostalArrivee("35400");
        $trajet2->setVilleArrivee("Saint-Malo");
        $trajet2->setAdresseDepart("58 rue Pierre De Coubertin");
        $trajet2->setCodePostalDepart("31000");  
        $trajet2->setVilleDepart("Toulouse");
        $trajet2->setPrixTrajet("102");
        $trajet2->setNbPassagers("2"); // 4 places de bases mais il en reste 2 car il y a eu 2 reservations
        $trajet2->setDatePublication(new \DateTime("2020/02/24"));
        $trajet2->setDateDepart(new \DateTime("2020/06/24"));
        $trajet2->addIdUtilisateur($manager->merge($this->getReference('user-clementine'))); // Clémentine propose de trajet
        $trajet2->addIdUser($manager->merge($this->getReference('user-emma'))); // Emma reserve ce trajet
        $trajet2->addIdUser($manager->merge($this->getReference('user-jules'))); // Jules reserve ce trajet
        $manager->persist($trajet2);

        // Trajet à modifier
        $trajet3 = new Trajet();
        $trajet3->setHeureDepart(new \DateTime("19:00"));
        $trajet3->setAdresseArrivee("95 Rue Joseph Vernet");
        $trajet3->setCodePostalArrivee("92220");
        $trajet3->setVilleArrivee("Bagneux");
        $trajet3->setAdresseDepart("18 Place du Jeu de Paume");
        $trajet3->setCodePostalDepart("38200");  
        $trajet3->setVilleDepart("Vienne");
        $trajet3->setPrixTrajet("83");
        $trajet3->setNbPassagers("3"); // 4 places de bases mais il en reste 3 car il y a eu 1 reservation
        $trajet3->setDatePublication(new \DateTime("2020/03/31"));
        $trajet3->setDateDepart(new \DateTime("2020/07/23"));
        $trajet3->addIdUtilisateur($manager->merge($this->getReference('user-clementine'))); // Clémentine propose de trajet
        $trajet3->addIdUser($manager->merge($this->getReference('user-jacques'))); // Jacques reserve ce trajet
        $manager->persist($trajet3);

        $trajet4 = new Trajet();
        $trajet4->setHeureDepart(new \DateTime("11:00"));
        $trajet4->setAdresseArrivee("44 cours Jean Jaures");
        $trajet4->setCodePostalArrivee("33100");
        $trajet4->setVilleArrivee("Bordeaux");
        $trajet4->setAdresseDepart("43 avenue Voltaire");
        $trajet4->setCodePostalDepart("06520");  
        $trajet4->setVilleDepart("Magagnosc");
        $trajet4->setPrixTrajet("60");
        $trajet4->setNbPassagers("1"); // 4 places de bases mais il en reste 1 car il y a eu 3 reservations
        $trajet4->setDatePublication(new \DateTime("2020/03/31"));
        $trajet4->setDateDepart(new \DateTime("2020/06/25"));
        $trajet4->addIdUtilisateur($manager->merge($this->getReference('user-jules'))); // Jules propose de trajet
        $trajet4->addIdUser($manager->merge($this->getReference('user-clementine'))); // Clémentine reserve ce trajet
        $trajet4->addIdUser($manager->merge($this->getReference('user-emma'))); // Emma reserve ce trajet
        $trajet4->addIdUser($manager->merge($this->getReference('user-jacques'))); // Jacques reserve ce trajet
        $manager->persist($trajet4);

        // Ajout d'un trajet complet
        $trajet5 = new Trajet();
        $trajet5->setHeureDepart(new \DateTime("09:00"));
        $trajet5->setAdresseArrivee("10 boulevard de la Liberation");
        $trajet5->setCodePostalArrivee("13013");
        $trajet5->setVilleArrivee("Marseille");
        $trajet5->setAdresseDepart("80 rue du Clair Bocage");
        $trajet5->setCodePostalDepart("83160");  
        $trajet5->setVilleDepart("La Valette-du-Var");
        $trajet5->setPrixTrajet("20");
        $trajet5->setNbPassagers("0"); // 2 places de bases mais il en reste 0 car il y a eu 2 reservations
        $trajet5->setDatePublication(new \DateTime("2020/04/01"));
        $trajet5->setDateDepart(new \DateTime("2020/06/27"));
        $trajet5->addIdUtilisateur($manager->merge($this->getReference('user-jules'))); // Jules propose de trajet
        $trajet5->addIdUser($manager->merge($this->getReference('user-emma'))); // Emma reserve ce trajet
        $trajet5->addIdUser($manager->merge($this->getReference('user-jacques'))); // Jacques reserve ce trajet
        $manager->persist($trajet5);

        $trajet6 = new Trajet();
        $trajet6->setHeureDepart(new \DateTime("12:25"));
        $trajet6->setAdresseArrivee("30 rue Porte d'Orange");
        $trajet6->setCodePostalArrivee("84300");
        $trajet6->setVilleArrivee("Cavaillon");
        $trajet6->setAdresseDepart("15 cours Franklin Roosevelt");
        $trajet6->setCodePostalDepart("13008");  
        $trajet6->setVilleDepart("Marseille");
        $trajet6->setPrixTrajet("23");
        $trajet6->setNbPassagers("4"); // Aucune réservation pour ce trajet
        $trajet6->setDatePublication(new \DateTime("2020/04/01"));
        $trajet6->setDateDepart(new \DateTime("2020/06/27"));
        $trajet6->addIdUtilisateur($manager->merge($this->getReference('user-jules'))); // Jules propose de trajet
        $manager->persist($trajet6);

        $trajet7 = new Trajet();
        $trajet7->setHeureDepart(new \DateTime("14:45"));
        $trajet7->setAdresseArrivee("67 Rue du Palais");
        $trajet7->setCodePostalArrivee("44000");
        $trajet7->setVilleArrivee("Nantes");
        $trajet7->setAdresseDepart("54 Rue Joseph Vernet");
        $trajet7->setCodePostalDepart("93170");  
        $trajet7->setVilleDepart("Bagnolet");
        $trajet7->setPrixTrajet("32");
        $trajet7->setNbPassagers("3"); // 4 places - 1 reservation
        $trajet7->setDatePublication(new \DateTime("2020/04/01"));
        $trajet7->setDateDepart(new \DateTime("2020/06/28"));
        $trajet7->addIdUtilisateur($manager->merge($this->getReference('user-emma'))); // Emma propose de trajet
        $trajet7->addIdUser($manager->merge($this->getReference('user-jacques'))); // Jacques reserve ce trajet
        $manager->persist($trajet7);

        $trajet8 = new Trajet();
        $trajet8->setHeureDepart(new \DateTime("14:30"));
        $trajet8->setAdresseDepart("67 Rue du Palais");
        $trajet8->setCodePostalDepart("44000");
        $trajet8->setVilleDepart("Nantes");
        $trajet8->setAdresseArrivee("54 Rue Joseph Vernet");
        $trajet8->setCodePostalArrivee("93170");  
        $trajet8->setVilleArrivee("Bagnolet");
        $trajet8->setPrixTrajet("32");
        $trajet8->setNbPassagers("2"); // 4 places - 2 reservation
        $trajet8->setDatePublication(new \DateTime("2020/04/01"));
        $trajet8->setDateDepart(new \DateTime("2020/06/30"));
        $trajet8->addIdUtilisateur($manager->merge($this->getReference('user-emma'))); // Emma propose de trajet
        $trajet8->addIdUser($manager->merge($this->getReference('user-jacques'))); // Jacques reserve ce trajet
        $trajet8->addIdUser($manager->merge($this->getReference('user-clementine'))); // Clémentine reserve ce trajet
        $manager->persist($trajet8);

        $manager->flush();  
        
        $this->addReference('trajet-trajetExpire1', $trajetExpire1);
        $this->addReference('trajet-trajetExpire2', $trajetExpire2);
        $this->addReference('trajet-trajetExpire3', $trajetExpire3);
        $this->addReference('trajet-trajetExpire4', $trajetExpire4);
        $this->addReference('trajet-trajetExpire5', $trajetExpire5);
        $this->addReference('trajet-trajetExpire6', $trajetExpire6);

        $this->addReference('trajet-trajet1', $trajet1);
        $this->addReference('trajet-trajet2', $trajet2);
        $this->addReference('trajet-trajet3', $trajet3);
        $this->addReference('trajet-trajet4', $trajet4);
        $this->addReference('trajet-trajet5', $trajet5);
        $this->addReference('trajet-trajet6', $trajet6);
        $this->addReference('trajet-trajet7', $trajet7);
        $this->addReference('trajet-trajet8', $trajet8);

    }

    // Permet de lister ce dont à besoin cette fixture pour fonctionner
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}