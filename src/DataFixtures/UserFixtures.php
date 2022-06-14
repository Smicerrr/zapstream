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
        // Admin Pumix
        $admin = new User();
        $admin->setPseudo('Pumix');
        $admin->setDescription('Jeune streamer independant, Fornite, Call of duty, Overwatch ');
        $admin->setFollowers('1 000 000 000');
        $admin->setAvatar('melvin.jpg');
        $admin->setEmail('melvin.delorme12@gmail.com');
        $admin->setRoles(['ROLE_USER', 'ROLE_ADMIN','ROLE_SUPER_ADMIN']);
        $admin->setToken('dfsfdsdf');
        $hashpassword = $this->hasher->hashPassword($admin,'121202');
        $admin->setPassword($hashpassword);
        $manager->persist($admin);

        // Admin Smicer
        $admin = new User();
        $admin->setPseudo('Smicer');
        $admin->setAvatar('jeffrey.jpg');
        $admin->setDescription('Je suis un competiteur sur mon jeu de coeur R6 SIEGE.');
        $admin->setFollowers('1 000 000');
        $admin->setEmail('jeffrey.geromegnace@gmail.com');
        $admin->setRoles(['ROLE_USER', 'ROLE_ADMIN','ROLE_SUPER_ADMIN']);
        $admin->setToken('dfsfdsdf');
        $hashpassword = $this->hasher->hashPassword($admin,'michel');
        $admin->setPassword($hashpassword);
        $manager->persist($admin);

        //Admin Zodar
        $admin = new User();
        $admin->setPseudo('Zodar');
        $admin->setDescription('Je passe mon temps a jouer au jeux videos tout en les diffusant pour votre plaisir, attention aux ames sensible je suis un gros rageur. ');
        $admin->setFollowers('456');
        $admin->setAvatar('zodar.jpg');
        $admin->setEmail('zodarfr@gmail.com');
        $admin->setRoles(['ROLE_USER', 'ROLE_ADMIN','ROLE_SUPER_ADMIN']);
        $admin->setToken('dfsfdsdf');
        $hashpassword = $this->hasher->hashPassword($admin,'michel');
        $admin->setPassword($hashpassword);
        $manager->persist($admin);
        
        //Users
        $user = new User();
        $user->setPseudo('SamusAran');
        $user->setDescription('Je mappel Paul et jai 28 ans je m\'amuse a faire des parties de Mario Kart ');
        $user->setFollowers('1345');
        $user->setAvatar('SamuMetroidIcon.png');
        $user->setEmail('SamusAran@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setToken('dfsfdsdf');
        $hashpassword = $this->hasher->hashPassword($user,'michel');
        $user->setPassword($hashpassword);
        $manager->persist($user);
        
        $user = new User();
        $user->setPseudo('Moz');
        $user->setDescription('Je suis une streameuse rempli de talent, je kiff jouer a des jeux de gestion. ');
        $user->setFollowers('5788');
        $user->setAvatar('ZeldaIcon.jpg');
        $user->setEmail('Moz@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setToken('dfsfdsdf');
        $hashpassword = $this->hasher->hashPassword($user,'michel');
        $user->setPassword($hashpassword);
        $manager->persist($user);
        
        $user = new User();
        $user->setPseudo('Ahkas');
        $user->setDescription('Gros joueur de ApexLegends, try harder a temps plein ! ');
        $user->setFollowers('356 908');
        $user->setAvatar('ApexLegendsIcon.jpg');
        $user->setEmail('Ahkas@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setToken('dfsfdsdf');
        $hashpassword = $this->hasher->hashPassword($user,'michel');
        $user->setPassword($hashpassword);
        $manager->persist($user);
        
        $user = new User();
        $user->setPseudo('Titiviking27');
        $user->setDescription(' Farmer sur Diablo, je vous partage mon gameplay pour vous aidez a vous ameliorez. ');
        $user->setFollowers('3 456');
        $user->setAvatar('BarbareDiabloIcon.jpg');
        $user->setEmail('Titiviking27@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setToken('dfsfdsdf');
        $hashpassword = $this->hasher->hashPassword($user,'michel');
        $user->setPassword($hashpassword);
        $manager->persist($user);
        
        $user = new User();
        $user->setPseudo('Sam974');
        $user->setDescription('Ex joueur pro de CounterStrike, viens me voir detruire des games ! ');
        $user->setFollowers('1467');
        $user->setAvatar('CsIcon.png');
        $user->setEmail('Sam974@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setToken('dfsfdsdf');
        $hashpassword = $this->hasher->hashPassword($user,'michel');
        $user->setPassword($hashpassword);
        $manager->persist($user);
        
        $user = new User();
        $user->setPseudo('NMYoda');
        $user->setDescription('Je joue tranquille a des petits jeux independant, je ne me prend pas la tete.');
        $user->setFollowers('367');
        $user->setAvatar('YodaIcon.jpg');
        $user->setEmail('NMYoda@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setToken('dfsfdsdf');
        $hashpassword = $this->hasher->hashPassword($user,'michel');
        $user->setPassword($hashpassword);
        $manager->persist($user);
        
        $user = new User();
        $user->setPseudo('Antoine');
        $user->setDescription('Je suis un excellent developper, je me perd sur des jeux quand j\'ai le temps. ');
        $user->setFollowers('1456');
        $user->setAvatar('KaamelotArturIcon.jpg');
        $user->setEmail('Antoine@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setToken('dfsfdsdf');
        $hashpassword = $this->hasher->hashPassword($user,'michel');
        $user->setPassword($hashpassword);
        $manager->persist($user);

        $manager->flush();

        $this->addReference('admin', $admin);
        $this->addReference('user', $user);
    }
}
