<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setName('admin');
        $userAdmin->setLastname('A');
        $userAdmin->setBirthday(new \DateTime('2000-07-16'));
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setPassword($this->passwordEncoder->encodePassword(
            $userAdmin,
            'admin01'
        ));

        $user = new User();
        $user->setUsername('toto');
        $user->setName('toto');
        $user->setLastname('T');
        $user->setBirthday(new \DateTime('2000-07-16'));
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'toto01'
        ));

        $manager->persist($user);
        $manager->persist($userAdmin);
        $manager->flush();
    }
}
