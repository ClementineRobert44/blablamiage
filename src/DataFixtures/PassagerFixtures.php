<?php
namespace App\DataFixtures;

use App\Entity\Passager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PassagerFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $passager1 = new Passager();
        $passager1->setNomPassager('Bretaud')
        ->setPrenomPassager('Emma')
        ->setDateNaissancePassager(new \DateTime('1998-10-15'))
        ->setMailPassager("emma.bretaud@gmail.com")
        ->setBioPassager("Etudiante")
        ->setTelPassager("0604568963")
        ->setAnimaux("Oui")
        ->setCigarette("Non")
        ->setMdpPassager("Hello45");;

        $manager->persist($passager1);

        $manager->flush();

        

    }
}