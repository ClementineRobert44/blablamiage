<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {     
        
        /*************** Création des admins ***************/ 
        $admin1 = new User();
        $admin1->setEmail("clementine.robert@gmail.com");
        $admin1->setPassword($this->passwordEncoder->encodePassword($admin1, 'monMotDePasse'));
        $admin1->setNom("Robert");
        $admin1->setPrenom("Clémentine");
        $admin1->setDateNaissance(new \DateTime('1999-03-25'));
        $admin1->setBio('Je suis étudiante et administrateur de ce site');
        $admin1->setTel('0676789098');
        $admin1->setAnimaux('Non');
        $admin1->setCigarette('Non');
        $admin1->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin1);

        $admin2 = new User();
        $admin2->setEmail("emma.bretaud@gmail.com");
        $admin2->setPassword($this->passwordEncoder->encodePassword($admin2, 'monMotDePasse'));
        $admin2->setNom("Bretaud");
        $admin2->setPrenom("Emma");
        $admin2->setDateNaissance(new \DateTime('1998-10-15'));
        $admin2->setBio('Je suis étudiante et administrateur de ce site');
        $admin2->setTel('0656678789');
        $admin2->setAnimaux('Oui');
        $admin2->setCigarette('Non');
        $admin2->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin2);

        $admin3 = new User();
        $admin3->setEmail("compteTest@gmail.com");
        $admin3->setPassword($this->passwordEncoder->encodePassword($admin3, 'compteTest'));
        $admin3->setNom("Number One");
        $admin3->setPrenom("Testeur");
        $admin3->setDateNaissance(new \DateTime('1990-05-15'));
        $admin3->setBio('Je suis un administrateur test de ce site');
        $admin3->setTel('0102030405');
        $admin3->setAnimaux('Non');
        $admin3->setCigarette('Non');
        $admin3->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin3);

        /*************** Création des users ***************/ 
        $user1 = new User();
        $user1->setEmail("jules.fichot@gmail.com");
        $user1->setPassword($this->passwordEncoder->encodePassword($user1, 'azerty1234'));
        $user1->setNom("Fichot");
        $user1->setPrenom("Jules");
        $user1->setDateNaissance(new \DateTime('1999-12-15'));
        $user1->setBio('Je suis étudiant et je voudrais partager mes trajets');
        $user1->setTel('0745632569');
        $user1->setAnimaux('Non');
        $user1->setCigarette('Non');
        $user1->setRoles(['ROLE_USER']);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail("jacques.dupont@gmail.com");
        $user2->setPassword($this->passwordEncoder->encodePassword($user2, 'qwerty1234'));
        $user2->setNom("Dupont");
        $user2->setPrenom("Jacques");
        $user2->setDateNaissance(new \DateTime('1965-07-01'));
        $user2->setBio("Je ne souhaite plus faire de trajets seuls, j'aime avoir de la compagnie.");
        $user2->setTel('0245566989');
        $user2->setAnimaux('Oui');
        $user2->setCigarette('Oui');
        $user2->setRoles(['ROLE_USER']);
        $manager->persist($user2);

        $manager->flush();

        /*************** Ajout des références ***************/ 
        $this->addReference('user-clementine', $admin1);
        $this->addReference('user-emma', $admin2);
        $this->addReference('user-test', $admin3);
        $this->addReference('user-jules', $user1);
        $this->addReference('user-jacques', $user2);


    }

    
}