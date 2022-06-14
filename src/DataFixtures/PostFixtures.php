<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $post = new Post();
        $post->setTitle('RESIDENT EVIL 4 REMAKE : CAPCOM A DÉVOILÉ LE GAMEPLAY MODERNISÉ, L\'AMBIANCE A COMPLÈTEMENT CHANGÉ AUSSI !');
        $post->setDescription('Officialisé lors du dernier State of Play de Sony Interactive Entertainment, le remake de Resident Evil 4 a une nouvelle fois fait parler de lui lors du Capcom Showcase. L\'occasion pour les développeurs de dévoiler une courte vidéo de gameplay, histoire que l\'on puisse se faire une première idée du travail réalisé par les équipes. Ce n\'est pas tout, puisque nous avons également droit à des images inédites où l\'on peut apercevoir non seulement Leon S. Kennedy, mais également celui qui est vraisemblablement le premier individu qu\'il croise en arrivant au village. Une scène connue des fans et que Capcom a sans doute paticulièrement soignée dans ce remake.');
        $post->setUser($this->getReference('user'));
        $post->setGame($this->getReference('game'));
        $manager->persist($post);
        
        $post = new Post();
        $post->setTitle('SONIC FRONTIERS : LE JEU NE SERA PAS REPOUSSÉ, "LES FANS N\'ONT PAS ENCORE CERNÉ LE GAMEPLAY" SELON SEGA');
        $post->setDescription('SEGA avait sans doute imaginé un tout autre accueil pour Sonic Frontiers (Xbox Series X, Xbox Series S, Xbox One, PS4, PS5, PC, Nintendo Switch). En effet, depuis la diffusion des premières vidéos de gameplay, on ne peut pas dire que la hype soit au rendez-vous. D\'ailleurs, les fans n\'ont pas hésité à lancer le hashtag #DelaySonicFrontiers sur Twitter pour inciter la Sonic Team à repousser la sortie du jeu, déçus par la direction prise par la série. Interrogé sur le sujet par nos confrères de Video Games Chronicle, Takashi Iizuka a fait comprendre que lui et ses équipes avaient des certitudes. "Ce n\'est pas vraiment surprenant, a-t-il indiqué. Nous sommes conscients que les gens réagissent surtout par rapport aux vidéos qu\'ils ont vues, mais comme ils n\'ont pas encore cerné le gameplay, ils le comparent aux autres jeux qu\'ils connaissent déjà."');
        $post->setUser($this->getReference('user'));
        $post->setGame($this->getReference('game'));
        $manager->persist($post);

        $post = new Post();
        $post->setTitle('AVEC CHRISTOPHE GANS, ON A PARLÉ DU PACTE DES LOUPS 4K, DE SILENT HILL, DE PROJECT ZERO, DE CRYING FREEMAN ET DE BRANDON LEE');
        $post->setDescription('Cinéaste français qui s\'est fait connaître pour des oeuvres telles que Crying Freeman (1995), Le Pacte des Loups (2001), Silent Hill (2006) et La Belle & la Bête (2014), Christophe Gans est considéré - à juste titre - comme l\'un des piliers de la pop-culture et du cinéma asiatique en France. A l\'occasion de la ressortie du Pacte des Loups dans son édition longue et restaurée en 4K (en salles depuis le 10 juin dans les cinéma Pathé Gamont), nous avons la chance et l\'opprtunité de nous entretenir avec cet homme qui est également un grand amoureux du jeu vidéo. Pendant 55 min, nous avons abordé plusieurs sujets : de la restauration du Pacte des Loups en 4K à ses prochains films que sont un nouveau Silent Hill et Project Zero, en passant par ses références à SoulCalibur, son amour pour les films de la Shaw Brothers, mais aussi quelques anecdotes inédites (voire exclusives) sur Mark Dacascos, Jason Scott Lee et même Brandon Lee, qui devaient tous joués dans son Crying Freeman. En effet, le fils de Bruce Lee, brutalement décédé sur le tournage de The Crow en 1993, avait été pressenti pour le rôle de Crying Freeman, bien avant que Christophe Gans fasse le choix de prendre Mark Dacascos. Le cinéaste français nous explique en effet avoir rencontré Brandon Lee aux Etats-Unis, avoir déjeuné avec lui pour lui proposer le rôle.');
        $post->setUser($this->getReference('user'));
        $post->setGame($this->getReference('game'));
        $manager->persist($post);

        $post = new Post();
        $post->setTitle('MONSTER HUNTER RISE SUNBREAK : LE GORE MAGALA EST DE RETOUR, LA PREUVE EN VIDÉO');
        $post->setDescription('Parmi les productions mises en avant hier dans le Capcom Showcase figurait bien évidemment Monster Hunter Rise : Sunbreak. C\'est même Ryozo Tsujimoto, le producteur de la série, qui s\'est chargé d\'ouvrir l\'événement avec un trailer inédit où le retour du Gore Magala (Monster Hunte 4 Ultimate) a été confirmé. Aveugle, la créature se sert de ses écailles noires et de ses membranes alaires pour détecter la présence de ses proies. D\'une puissance phénoménale, il est capable d\'infliger de lourds dégâts lorsqu\'il déploie ses deux antennes et entre dans un état de rage extrême.');
        $post->setUser($this->getReference('user'));
        $post->setGame($this->getReference('game'));
        $manager->persist($post);

        $post = new Post();
        $post->setTitle('EXOPRIMAL : DU GAMEPLAY NERVEUX AVEC DES DINOSAURES PARTOUT, DES NOUVELLES INFOS');
        $post->setDescription('Exoprimal a lui aussi eu droit à son quart d\'heure de gloire lors du Capcom Showcase diffusé cette nuit. Après avoir dévoilé un tout nouveau trailer du jeu, Takuro Hiraoka (le réalisateur du jeu) est revenu sur certains aspects, comme l\'Intelligence Artificielle Leviathan qui guide les joueurs via une navigation vocale et une interface en réalité augmentée. Si elle pourra prendre la forme d\'un visage d\'humanoïde, elle pourra également être incarnée par un drone de surveillance appelé Guetteur. Manifestement, c\'est elle qui est à l\'origine des hordes de dinosaures que doivent combattre les joueurs dans des simulations de guerre qui se répètent à l\'infini. Bien évidemment, Hiraoka-san nous promet que ce n\'est qu\'en terminant le mode principal que l\'on comprendra le pourquoi du comment.');
        $post->setUser($this->getReference('user'));
        $post->setGame($this->getReference('game'));
        $manager->persist($post);

        $post = new Post();
        $post->setTitle('RESIDENT EVIL RE:VERSE : LE MULTI DE RESIDENT EVIL VILLAGE TIENT ENFIN SA DATE DE SORTIE');
        $post->setDescription('Resident Evil Re:Verse sortira le 28 octobre prochain sur Xbox Series S, Xbox Series X, Xbox One, PS5, PS4, Stadia et PC. C\'est en effet ce que l\'on a appris durant le Capcom Showcase de cette nuit, sachant que c\'est à cette même date qu\'arrivera Resident Evil Village : Gold Edition et tous les bonus qu\'il contiendra, à savoir l\'extension "Les ombres de Rose", le mode "Mercenaires" plus étoffé, et la possibilité de (re)découvrir l\'aventure principale à la troisième personne dans la peau d\'Ethan Winters.');
        $post->setUser($this->getReference('user'));
        $post->setGame($this->getReference('game'));
        $manager->persist($post);

        $post = new Post();
        $post->setTitle('FORZA MOTORSPORT : MICROSOFT DÉVOILE DES NOUVELLES IMAGES, ELLES SONT IMPRESSIONNANTES DE RÉALISME');
        $post->setDescription('Le Xbox & Bethesda Games Showcase qui a eu lieu hier a permis d\'en apprendre davantage sur le prochain Forza Motorsport. Naturellement - et ça ne surprendra personne - les développeurs de Turn 10 ont mis le paquet sur le rendu visuel, la série ayant souvent fait office de vitrine technologique pour les consoles de Microsoft. "Dans Forza Motorsport , les dégâts des véhicules sont affichés dans les moindres détails, jusqu’à la plus petite égratignure sur votre carrosserie, a expliqué Chris Esaki, le directeur créatif. Vous verrez de quelle direction les dégâts sont venus, la peinture s’effriter sur les bords les plus exposés, l’abrasion des roues et la poussière s’accumulant. Les dégâts font partie de la réalité de la course automobile et ces derniers ont été reproduits fidèlement dans le nouveau Forza Motorsport."');
        $post->setUser($this->getReference('user'));
        $post->setGame($this->getReference('game'));
        $manager->persist($post);

        $post = new Post();
        $post->setTitle('S.T.A.L.K.E.R. 2 : LA SORTIE DU JEU REPOUSSÉE À 2023, MICROSOFT ANNONCE LA MAUVAISE NOUVELLE');
        $post->setDescription('Étrangement absent lors du Xbox & Bethesda Games Showcase qui a eu lieu hier, S.T.A.L.K.E.R. 2 : Heart of Chornobyl - qui devait arriver le 8 décembre prochain - ne sortira pas avant 2023. C\'est en effet ce que Microsoft a annoncé hier en dévoilant la liste des jeux qui seront disponibles dans les douze prochains mois sur Xbox et PC. Il faut dire que le développement du titre est loin d\'être un long fleuve tranquille : entre un premier report et l\'interruption temporaire des travaux en raison de la guerre en Ukraine, tenir le planning devenait quasiment mission impossible pour GSC Game World.');
        $post->setUser($this->getReference('user'));
        $post->setGame($this->getReference('game'));
        $manager->persist($post);

        $post = new Post();
        $post->setTitle('SYSTEM SHOCK : ANNONCÉ EN 2016, LE REMAKE S\'OFFRE UN TRAILER INÉDIT, TERRI BROSIUS INCARNERA DE NOUVEAU SHODAN');
        $post->setDescription('Annoncé en 2016, le remake de System Shock a fait parler de lui hier soir lors du PC Gaming Show 2022. En effet, Nightdive Studios avait emmené dans ses valises un nouveau trailer qui, entre autres, a permis de confirmer le retour de Terri Brosius dans le rôle de l\'I.A. SHODAN (Sentient Hyper-Optimized Data Access Network) qu\'elle avait déjà occupé en 1994. D\'une durée de deux minutes, la séquence permet également d\'observer quelques phases de gameplay, et de rappeler que les contrôles ont été remaniés, tout comme l\'interface et le sound design. Quant à la réalisation, elle découvrira les bienfaits de la HD.');
        $post->setUser($this->getReference('user'));
        $post->setGame($this->getReference('game'));
        $manager->persist($post);

        $post = new Post();
        $post->setTitle('STARFIELD : DE NOMBREUSES RESSEMBLANCES AVEC NO MAN\'S SKY ? UNE VIDÉO COMPARATIVE FAIT LE POINT');
        $post->setDescription('Starfield était incontestablement la star du Xbox Showcase hier soir et Bethesda Softworks s\'est montré particulièrement généreux en nous dévoilant ces 15 min de gameplay. Il faut dire que le jeu s\'était montré très discret et que sa sortie décalée à 2023 commençait sérieusement à inquiéter les joueurs. En Messie, Todd Howard est venu montrer à quoi ressemble son fameux Skyrim dans l\'espace, et le moins que l\'on puisse dire, c\'est que Starfield est un jeu très ambitieux. On s\'est rendu compte que dans cet Action-RPG, le jeu se déroulera aussi bien sur terre que dans l\'espace, alternant vue subjective et caméra derrière le personnage selon les situations. Il sera possible aussi de piloter son vaisseau et aller dans les confins des galaxies pour découvrir de nouvelles planètes, qu\'il sera possible d\'explorer. Les promesses sont énormes et elles rappellent d\'autres jeux tels que Starfield, No Man\'s Sky et le regretté Beyond Good & Evil 2 qui semble être au point mort dans sa production.');
        $post->setUser($this->getReference('user'));
        $post->setGame($this->getReference('game'));
        $manager->persist($post);

        $manager->flush();

    }

    public function getDependencies(){
        return[
            UserFixtures::class,
            GameFixtures::class
        ];
    }
}
