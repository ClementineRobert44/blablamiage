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
        $user = new User();
        $user->setEmail("emma.bretaud@gmail.com");
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'monMotDePasse'));
        $user->setNom("Bretaud");
        $user->setPrenom("Emma");
        $user->setDateNaissance(new \DateTime('1998-10-15'));
        $user->setBio('Je suis étudiante');
        $user->setTel('0656678789');
        $user->setAnimaux('Oui');
        $user->setCigarette('Non');
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);
                                
        $admin = new User();
        $admin->setEmail("clementine.robert@gmail.com");
        $admin->setPassword($this->passwordEncoder->encodePassword($user, 'monMotDePasse'));
        $admin->setNom("Robert");
        $admin->setPrenom("Clémentine");
        $admin->setDateNaissance(new \DateTime('1999-03-25'));
        $admin->setBio('Je suis étudiante et administrateur de ce site');
        $admin->setTel('0676789098');
        $admin->setAnimaux('Non');
        $admin->setCigarette('Non');
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $manager->flush();

    }
}