<?php
namespace App\DataFixtures;

use App\Entity\Conducteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ConducteurFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $conducteur1 = new Conducteur();

        $conducteur1->setNomConducteur('Robert')
        ->setPrenomConducteur('Clémentine')
        ->setDateNaissanceConducteur('25/03/1999')
        ->setMailConducteur("clementine.robert.nantes@gmail.com")
        ->setBioConducteur("Etudainte, je fais la route Nantes-Rennes tous les vendredi soir et le retour le dimanche soir.")
        ->setTelConducteur("0605040809")
        ->setAnimaux("Non")
        ->setCigarette("Non");

        $manager->persist($conducteur1);

        $manager->flush();

        

    }
}