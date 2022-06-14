<?php

namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GameFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $game = new Game();
        $game->setTitle('Mario Kart');
        $game->setDescription('Mario Kart est une série de jeux vidéo de course et de combat motorisé produite par Nintendo, adaptée de la série de jeux de plates-formes Super Mario.');
        $game->setImage('MarioKartWp.jpg');
        $game->setCreatedAt(new \DateTimeImmutable());
        $game->setUser($this->getReference('user'));
        $manager->persist($game);
        
        $game = new Game();
        $game->setTitle('Counter Strike');
        $game->setDescription('Counter-Strike: Source, généralement abrégé par CS:S ou CSS, est un jeu vidéo développé par Valve Software. Il s\'agit d\'une évolution de Counter-Strike utilisant le moteur Source.');
        $game->setImage('CssWp.jpg');
        $game->setCreatedAt(new \DateTimeImmutable());
        $game->setUser($this->getReference('user'));
        $manager->persist($game);

        $game = new Game();
        $game->setTitle('Apex Legends');
        $game->setDescription('Apex Legends est un jeu vidéo de type battle royale développé par Respawn Entertainment et édité par Electronic Arts. Il est publié en accès gratuit le 4 février 2019 sur Microsoft Windows, PlayStation 4 et Xbox One. Le jeu sort sur Nintendo Switch le 9 mars 2021, enfin la version mobile est sortie le 17 mai 2022.');
        $game->setImage('ApexLegendsWp.jpg');
        $game->setCreatedAt(new \DateTimeImmutable());
        $game->setUser($this->getReference('user'));
        $manager->persist($game);

        $game = new Game();
        $game->setTitle('Overwatch');
        $game->setDescription('Overwatch est un jeu vidéo de tir (FPS) en ligne et en équipe de 6, développé et publié par Blizzard Entertainment. Le jeu est annoncé le 7 novembre 2014 à la BlizzCon, et est commercialisé le 24 mai 2016 sur Windows, PlayStation 4 et Xbox One et le 15 octobre 2019 sur Nintendo Switch.');
        $game->setImage('OverwatchWp.jpeg');
        $game->setCreatedAt(new \DateTimeImmutable());
        $game->setUser($this->getReference('user'));
        $manager->persist($game);

        $game = new Game();
        $game->setTitle('Rainbow Six Siege');
        $game->setDescription('Tom Clancy\'s Rainbow Six Siege est un jeu vidéo de tir tactique développé par Ubisoft Montréal et édité par Ubisoft, sorti le 1ᵉʳ décembre 2015 sur PlayStation 4, Xbox One et Windows. Le jeu sort également sur Google Stadia le 30 juin 2021.');
        $game->setImage('rs6.jpeg');
        $game->setCreatedAt(new \DateTimeImmutable());
        $game->setUser($this->getReference('user'));
        $manager->persist($game);

        $game = new Game();
        $game->setTitle('World of Warcraft');
        $game->setDescription('World of Warcraft /wɜrld.əv.wɔr.kræft/ est un jeu vidéo de type MMORPG développé par la société Blizzard Entertainment. C\'est le 4ᵉ jeu de l\'univers médiéval-fantastique Warcraft, introduit par Warcraft: Orcs and Humans en 1994.');
        $game->setImage('WowWp.jpg');
        $game->setCreatedAt(new \DateTimeImmutable());
        $game->setUser($this->getReference('user'));
        $manager->persist($game);

        $game = new Game();
        $game->setTitle('Street Fighter');
        $game->setDescription('Street Fighter est une série de jeux vidéo de combat en un contre un développée par Capcom, dont le premier épisode est publié en 1987. ');
        $game->setImage('StreetFighterWp.jpg');
        $game->setCreatedAt(new \DateTimeImmutable());
        $game->setUser($this->getReference('user'));
        $manager->persist($game);

        $game = new Game();
        $game->setTitle('Rocket League');
        $game->setDescription('Rocket League est un jeu vidéo développé et édité par Psyonix. Il sort en juillet 2015 sur Windows et sur PlayStation 4, en février 2016 sur Xbox One, en septembre 2016 sur Linux et Mac et en novembre 2017 sur Nintendo Switch.');
        $game->setImage('RlWp.jpg');
        $game->setCreatedAt(new \DateTimeImmutable());
        $game->setUser($this->getReference('user'));
        $manager->persist($game);

        $game = new Game();
        $game->setTitle('Metroid');
        $game->setDescription('Metroid est une série de jeux vidéo d\'action-aventure se déroulant dans un univers de science-fiction, créée par Nintendo et publiée pour la première fois en 1986.');
        $game->setImage('MetroidWp.jpg');
        $game->setCreatedAt(new \DateTimeImmutable());
        $game->setUser($this->getReference('user'));
        $manager->persist($game);

        $game = new Game();
        $game->setTitle('ARK: Survival Evolved');
        $game->setDescription('Ark: Survival Evolved est un jeu vidéo d’action-aventure et de survie ainsi que de multijoueur, développé et publié par Studio Wildcard.');
        $game->setImage('ArkWp.jpg');
        $game->setCreatedAt(new \DateTimeImmutable());
        $game->setUser($this->getReference('user'));
        $manager->persist($game);

        $manager->flush();

        $this->addReference('game', $game);
    }

    public function getDependencies(){
        return[
            UserFixtures::class,
        ];
    }
}
