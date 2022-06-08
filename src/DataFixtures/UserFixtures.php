<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
          $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        // Admin
        $admin = new User();
        $admin->setPseudo('Pumix');
        $admin->setEmail('melvin.delorme12@gmail.com');
        $admin->setRoles(['ROLE_USER', 'ROLE_ADMIN','ROLE_SUPER_ADMIN']);
        $admin->setToken('dfsfdsdf');
        $hashpassword = $this->hasher->hashPassword($admin,'121202');
        $admin->setPassword($hashpassword);
        $manager->persist($admin);

        // User
        $admin = new User();
        $admin->setPseudo('Smicer');
        $admin->setEmail('jeffrey.geromegnace@gmail.com');
        $admin->setRoles(['ROLE_USER', 'ROLE_ADMIN','ROLE_SUPER_ADMIN']);
        $admin->setToken('dfsfdsdf');
        $admin->setAvatar('https://static-cdn.jtvnw.net/jtv_user_pictures/25da32b2-e646-4202-9814-c049e200fae3-profile_image-70x70.png');
        $hashpassword = $this->hasher->hashPassword($admin,'michel');
        $admin->setPassword($hashpassword);
        $manager->persist($admin);

        $admin = new User();
        $admin->setPseudo('zodar');
        $admin->setEmail('zodarfr@gmail.com');
        $admin->setRoles(['ROLE_USER', 'ROLE_ADMIN','ROLE_SUPER_ADMIN']);
        $admin->setToken('dfsfdsdf');
        $hashpassword = $this->hasher->hashPassword($admin,'michel');
        $admin->setPassword($hashpassword);
        $manager->persist($admin);

        $manager->flush();

        $this->addReference('admin', $admin);
        //$this->addReference('user', $user);
    }
}
