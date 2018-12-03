<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Datafixtures\UserFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;


class UserFixtures extends Fixture
{
    private $encoder;
    const DEFAULT_ENCODER_COST = 13;
    public function __construct()
    {
        $this->encoder = new BCryptPasswordEncoder(self::DEFAULT_ENCODER_COST);
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setIdentifiant('Liorleboss');
        $user->setPassword($this->encoder->encodePassword('test', null));
        $user->setRoles(['ROLE_ADMIN']);
        
        $manager->persist($user);
        $manager->flush();
    }
}

?>