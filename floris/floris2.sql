-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 12 Octobre 2016 à 17:57
-- Version du serveur :  5.6.26
-- Version de PHP :  5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `floris2`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `clients_id` int(11) NOT NULL,
  `clients_mail` text NOT NULL,
  `clients_password` text NOT NULL,
  `clients_nom` varchar(50) NOT NULL,
  `clients_prenom` varchar(50) NOT NULL,
  `clients_tel` text NOT NULL,
  `etats_id` int(11) NOT NULL,
  `clients_date_inscription` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`clients_id`, `clients_mail`, `clients_password`, `clients_nom`, `clients_prenom`, `clients_tel`, `etats_id`, `clients_date_inscription`) VALUES
(7, 'pb@floris.fr', '8c5146e46aaab0fa64e04e960760fdeaac07e2caa9e4ae7f6783557cbc56d2b8f7161550446fd48296c88c6b7cd000b53156da44d81e1f5cc8f2ec4767e3479c', 'Client', 'Pierre', '0600989834', 2, '2016-10-12 17:24:26');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE IF NOT EXISTS `commandes` (
  `commandes_id` int(11) NOT NULL,
  `commandes_ajout` datetime NOT NULL,
  `commandes_modif` datetime NOT NULL,
  `id_reglements` int(11) NOT NULL,
  `id_statuts` int(11) NOT NULL,
  `id_clients` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE IF NOT EXISTS `entreprises` (
  `entreprises_id` int(11) NOT NULL,
  `entreprises_nom` varchar(50) NOT NULL,
  `entreprises_siret` int(15) NOT NULL,
  `entreprises_adresse` text NOT NULL,
  `entreprises_ville` varchar(20) NOT NULL,
  `entreprises_postal` varchar(10) NOT NULL,
  `entreprises_mail` text NOT NULL,
  `entreprises_tel` text NOT NULL,
  `id_pays` int(11) NOT NULL,
  `id_clients` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `entreprises`
--

INSERT INTO `entreprises` (`entreprises_id`, `entreprises_nom`, `entreprises_siret`, `entreprises_adresse`, `entreprises_ville`, `entreprises_postal`, `entreprises_mail`, `entreprises_tel`, `id_pays`, `id_clients`) VALUES
(1, 'Matthieu Vasseur', 123456789, '7 rue de la marche', 'Paris', '75010', 'vasseur.m19@gmail.com', '0645305828', 2, 1),
(2, 'Matthieu Vasseur', 2147483647, '7 rue de la marche', 'Paris', '75010', 'vasseur.m19@gmail.com', '0645305828', 3, 1),
(3, 'Normand Info', 2147483647, '3 bis rue Arthur Delobelle', 'Arras', '62000', 'vasseur.m19@gmail.com', '0645305828', 1, 5),
(4, 'Decathlon', 2147483647, '12 rue des templiers', 'Berlin', '123456', 'vasseur.m19@gmail.com', '0645305828', 5, 6);

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

CREATE TABLE IF NOT EXISTS `etats` (
  `etats_id` int(11) NOT NULL,
  `etats_nom` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etats`
--

INSERT INTO `etats` (`etats_id`, `etats_nom`) VALUES
(1, 'En cours'),
(2, 'Accepter'),
(3, 'Refuser');

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `grades_id` int(11) NOT NULL,
  `grades_nom` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `grades`
--

INSERT INTO `grades` (`grades_id`, `grades_nom`) VALUES
(1, 'Administrateur'),
(2, 'Opérateur');

-- --------------------------------------------------------

--
-- Structure de la table `lignes`
--

CREATE TABLE IF NOT EXISTS `lignes` (
  `lignes_id` int(11) NOT NULL,
  `lignes_nom` text NOT NULL,
  `lignes_prix` int(11) NOT NULL,
  `lignes_quantite` int(11) NOT NULL,
  `produits_id` int(11) NOT NULL,
  `id_commandes` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lignes`
--

INSERT INTO `lignes` (`lignes_id`, `lignes_nom`, `lignes_prix`, `lignes_quantite`, `produits_id`, `id_commandes`) VALUES
(1, 'Lilas', 12, 2, 17, 1),
(2, 'Anemone', 20, 5, 6, 1),
(3, 'Anemone', 20, 3, 6, 2),
(4, 'Anemone', 20, 3, 6, 3),
(5, 'Pivoine', 32, 9, 25, 3),
(6, 'Oeillet', 8, 2, 23, 3),
(7, 'Orange rose', 59, 5, 31, 4),
(8, 'Gerbera', 8, 3, 11, 4);

-- --------------------------------------------------------

--
-- Structure de la table `livraisons`
--

CREATE TABLE IF NOT EXISTS `livraisons` (
  `livraisons_id` int(11) NOT NULL,
  `livraisons_date` date NOT NULL,
  `id_transporteurs` int(11) NOT NULL,
  `id_commandes` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `livraisons`
--

INSERT INTO `livraisons` (`livraisons_id`, `livraisons_date`, `id_transporteurs`, `id_commandes`) VALUES
(21, '2014-04-23', 1, 2),
(22, '2015-05-12', 1, 1),
(23, '2015-05-30', 7, 3),
(24, '2015-05-30', 7, 4);

-- --------------------------------------------------------

--
-- Structure de la table `operateurs`
--

CREATE TABLE IF NOT EXISTS `operateurs` (
  `operateurs_id` int(11) NOT NULL,
  `operateurs_pseudo` varchar(50) NOT NULL,
  `operateurs_password` text NOT NULL,
  `operateurs_nom` varchar(50) NOT NULL,
  `operateurs_prenom` varchar(50) NOT NULL,
  `id_etats` int(11) NOT NULL,
  `id_grades` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `operateurs`
--

INSERT INTO `operateurs` (`operateurs_id`, `operateurs_pseudo`, `operateurs_password`, `operateurs_nom`, `operateurs_prenom`, `id_etats`, `id_grades`) VALUES
(1, 'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'Administrateur', 'admin', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE IF NOT EXISTS `pays` (
  `pays_id` int(11) NOT NULL,
  `pays_nom` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pays`
--

INSERT INTO `pays` (`pays_id`, `pays_nom`) VALUES
(1, 'France'),
(2, 'Angleterre'),
(3, 'Espagne'),
(4, 'Belgique'),
(5, 'Allemagne');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE IF NOT EXISTS `produits` (
  `produits_id` int(11) NOT NULL,
  `produits_nom` varchar(200) NOT NULL,
  `produits_description` text NOT NULL,
  `produits_prix` decimal(10,2) NOT NULL,
  `id_types` int(20) NOT NULL,
  `produits_image` varchar(5) NOT NULL DEFAULT 'jpg',
  `produits_conditionnement` int(11) NOT NULL,
  `id_promos` int(2) NOT NULL,
  `id_visibles` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`produits_id`, `produits_nom`, `produits_description`, `produits_prix`, `id_types`, `produits_image`, `produits_conditionnement`, `id_promos`, `id_visibles`) VALUES
(4, 'Alstroemeria', 'Éclatante, élégante, peu exigeante, l''Alstroemère est une plante qui peut s''adapter à tous les jardins. Dans un massif, en isolé, en bac, dans un bouquet, son élégance naturelle lui assurent une place de choix !\r\n\r\nL’Alstroemeria est une plante à plusieurs facettes.\r\nImpériale en bouquet, où son port la prédispose aux bouquets de grand style, elle est somptueuse au jardin, en massif ou en potée. L’élégance de sa fleur ne saurait passer inaperçue. Les pétales, finement dentelés sur les bords, ponctués ou striés au centre, se déclinent dans une large palette de couleurs : blanc, rose, rouge, saumon, orange et même violet.', '36.00', 1, 'jpg', 50, 3, 2),
(5, 'Amarylis', '\r\nL’amaryllis est une magnifique plante d’intérieur capable de s’adapter en extérieur lorsque le climat est relativement chaud.\r\n\r\nL’amaryllis, après la floraison, peut refleurir d’une année sur l’autredans votre maison à condition de bien respecter certaines règles…', '25.00', 1, 'jpg', 42, 2, 1),
(6, 'Anemone', 'L’anémone est une fleur à bulbe tout à fait originale et très décorative.\r\n\r\nElle orne bordures et rocailles mais aussi massifs et bouquets au printemps ou en été.\r\n\r\nSi vous avez une terrasse ou un balcon, elle se plaira également en bac ou jardinière.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Anemone blanda\r\nFamille : Renonculacées\r\nType : Vivace à tubercule\r\n\r\nHauteur : 5 à 30 cm\r\nExposition : Ensoleillée et mi-ombre\r\nSol : Ordinaire, bien drainé\r\n\r\nFloraison : Mars à mai ou septembre/octobre\r\n', '20.00', 1, 'jpg', 25, 3, 1),
(7, 'Arum', 'L’arum ou calla est sans aucun doute l’une des plus belles fleurs à bulbe.\r\n\r\nDe la plantation à la taille, chaque geste d’entretien participe au bon développement et à la floraison de l’arum.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Zantedeschia aethiopica\r\nFamille : Aracacées\r\nType : Vivace bulbeuse\r\n\r\nHauteur : 50 à 100 cm\r\nExposition : Ensoleillée, mi-ombre\r\nSol : Riche, bien drainé\r\n\r\nFloraison : Juin à octobre', '56.00', 1, 'jpg', 25, 3, 1),
(8, 'Chrisanthème', 'Le chrysanthème est très connu pour orner les tombes, mais c’est aussi une magnifique plante pour fleurir nos jardins et terrasses.\r\n\r\nPlantation et entretien, retrouvez ce qu’il faut savoir pour avoir de beaux chrysanthèmes.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Chrysanthemum\r\nFamille : Astéracées\r\nType : Annuelle et vivace (selon espèces)\r\n\r\nHauteur : 40 à 100 cm\r\nExposition : Ensoleillée\r\nSol : Ordinaire\r\n\r\nFloraison : Juin à novembre', '18.00', 1, 'jpg', 25, 3, 2),
(9, 'Delphinium', 'Le delphinium que l’on appelle aussi Pied d’alouette est une formidable plante qui fleurit de juin à octobre.\r\n\r\nLe semis ou la plantation sont les seuls gestes à réaliser car les delphiniums ne réclament aucun entretien.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Delphinium\r\nFamille : Renonculacées\r\nType : Vivace ou annuel\r\n\r\nHauteur : 50 à 150 cm\r\nExposition : Ensoleillée\r\nSol : Ordinaire, bien drainé\r\n\r\nFloraison : Juin à octobre', '25.00', 1, 'jpg', 25, 3, 2),
(10, 'Freesia', 'Le freesia est une superbe fleur à bulbe à l’effet particulièrement décoratif.\r\n\r\nL’entretien, de la plantation à la taille, est très facile et le résultat souvent enchantant.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Freesia\r\nFamille : Iridacées\r\nType : Bulbeuse\r\n\r\nHauteur : 25 à 50 cm\r\nExposition : Ensoleillée\r\nSol : Sableux et léger\r\n\r\nFloraison : Juillet à septembre ou février-mars (en pot)', '16.00', 1, 'jpg', 25, 3, 2),
(11, 'Gerbera', 'Le gerbéra est une jolie plante d’intérieur originaire d’Afrique et très appréciée pour ses jolies fleurs\r\n\r\nTrès utilisée en bouquet, c’est aussi sa bonne tenu qui en fait une des fleurs préférée des fleuristes.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Gerbera\r\nFamille : Asteracées\r\nType : Plante d’intérieur\r\n\r\nHauteur : 30 à 40 cm en intérieur\r\nExposition : Lumineuse\r\n\r\nFeuillage : Persistant\r\nFloraison : Toute l’année', '8.00', 1, 'jpg', 20, 3, 1),
(12, 'Giroflée', 'La giroflée est une petite fleur à l’odeur suave incontournable des massifs de vivaces, tant pour ses couleurs que par sa forme originale.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Erysimum\r\nFamille : Brassicacées\r\nType : Annuelle ou bisannuelle\r\n\r\nHauteur : 20 à 40 cm\r\nExposition : Ensoleillée\r\nSol : Ordinaire, bien drainé\r\n\r\nFloraison : Avril à octobre selon les variétés', '16.00', 1, 'jpg', 25, 3, 1),
(13, 'Glaïeul', 'Le glaïeul fait partie des plus belles fleurs à bulbe.\r\n\r\nLa plantation et l’entretien des glaïeuls, du printemps à l’hiver, sont faits de petits gestes qui vont améliorer la floraison.\r\n\r\nEn été, on profite des magnifiques fleurs et en hiver on prend soin de les garder à l’abri du gel…\r\n\r\nNom : Gladiolus\r\nFamille : Iridacées\r\nType : Bulbeuse\r\n\r\nHauteur : 50 à 100 cm\r\nExposition : Ensoleillée\r\nSol : Ordinaire\r\n\r\nFloraison : Juillet à septembre', '29.00', 1, 'jpg', 25, 3, 1),
(14, 'Iris', 'L’iris barbus est une vivace aussi facile à cultiver que décorative lorsqu’elle est en fleur.\r\n\r\nA la fois classique, belle et élégante, elle aime être au soleil et ne demande rien d’autre !\r\n\r\n\r\nNom : Iris barbata\r\nFamille : Iridacées\r\nType : Fleur bulbeuse ou vivace\r\n\r\nHauteur : 20 à 90 cm\r\nExposition : Ensoleillée et mi-ombre\r\nSol : Ordinaire\r\n\r\nFloraison : Janvier à juillet selon les espèces', '30.00', 1, 'jpg', 25, 3, 1),
(15, 'Jacinthe', 'La jacinthe fait sans doute partie des plus jolies fleurs à bulbe.\r\n\r\nElle s’utilise normalement en extérieur mais on la retrouve aussi dès le début de l’hiver dans nos intérieurs\r\n\r\nPlantation et entretien  du printemps à l’hiver, voici tous les conseils.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Hyacinthus\r\nFamille : Liliacées\r\nType : Blubeuse\r\n\r\nHauteur : 20 à 30 cm\r\nExposition : Ensoleillée et mi-ombre\r\nSol : Ordinaire\r\n\r\nFloraison en extérieur : mars à avril\r\nFloraison en intérieur : décembre à mars', '16.00', 1, 'jpg', 25, 3, 1),
(16, 'Jonquille', 'La Jonquille est une très belle fleur à bulbe, caractérisé par sa belle couleur jaune.\r\n\r\nLa plantation et l’entretien amélioreront la floraison qui peut même devenir un vrai spectacle lorsqu’ils sont plantés par dizaines.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Jonquillus\r\nFamille : Amaryllidacées\r\nType : Bulbeuse\r\n\r\nHauteur : 10 à 40 cm\r\nExposition : Ensoleillée et mi-ombre\r\nSol : Ordinaire\r\n\r\nFloraison : Dès février jusque mai', '21.00', 1, 'jpg', 50, 3, 1),
(17, 'Lilas', 'Le lilas fleurît et parfume dès le début du printemps.\r\n\r\nLa taille, l’entretien ou la plantation sont autant de gestes qui participeront à la beauté de votre lilas.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Syringa vulgaris\r\nFamille : Oléacées\r\nType : Arbuste\r\nHauteur : 2 à 5 m\r\n\r\nExposition : Ensoleillée et mi-ombre\r\nSol : Assez riche\r\nFeuillage : Caduc\r\nFloraison : Avril à juin', '12.00', 1, 'jpg', 25, 3, 1),
(18, 'Lis', 'Les lis sont des plantes à bulbes. Ils sont cultivés pour leurs fleurs colorées et parfumées.\r\n\r\nLes lis produisent des feuilles allongées qui peuvent atteindre près de 30 cm de long.\r\n\r\nIls aiment le plein soleil et un sol bien drainé.\r\n\r\nLeur insecte ravageur est la larve de criocère et ils peuvent avoir des maladies cryptogamiques.', '35.00', 1, 'jpg', 50, 3, 1),
(19, 'Mimosa', 'Le mimosa est l’un des plus beaux arbustes à floraison hivernale.\r\n\r\nLa plantation, la taille et l’entretien vous aideront à avoir un très beau mimosa.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Acacia dealbata\r\nFamille : Mimosacées\r\nType : Arbre\r\n\r\nHauteur: 4 à 10 m\r\nExposition : Ensoleillée\r\nSol : Bien drainé et sableux\r\n\r\nFeuillage : Persistant\r\nFloraison : Janvier à mars', '11.00', 1, 'jpg', 25, 3, 1),
(20, 'Muguet', 'Le muguet n’est pas simplement une jolie fleur, elle est aussi le symbole de la fête du travail.\r\n\r\nL’entretien, de la plantation à la floraison est un jeu d’enfant et un vrai plaisir lorsqu’il est en fleur !\r\n\r\n\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Convallaria\r\nFamille : Asparagacées\r\nType : Vivaceà bulbe\r\n\r\nHauteur : 15 à 25 cm\r\nExposition : Mi-ombre, ombre\r\nSol : Riche, bien drainé et humifère\r\n\r\nFloraison : Avril-mai\r\nRécolte : 1er mai !', '38.00', 1, 'jpg', 100, 3, 1),
(21, 'Myosotis', 'Les myosotis sont des jolies bisannuelles ou des vivaces selon les variétés et le climat.\r\n\r\nSouvent utilisées en rocaille, bordure ou plate-bande, c’est une plante qui se resème toute seule et devient parfois envahissante.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Myosotis\r\nFamille : Boraginacées\r\nType : Bisannuel ou vivace\r\n\r\nHauteur : 20 à 30 cm\r\nExposition : Ensoleillée et mi-ombre\r\nSol : Plutôt riche et frais\r\n\r\nFeuillage : Caduc\r\nFloraison : Mars à mai', '16.00', 1, 'jpg', 25, 3, 2),
(22, 'Narcisse', 'Le narcisse est une très belle fleur à bulbe, caractérisé par sa belle couleur jaune.\r\n\r\nLa plantation et l’entretien amélioreront la floraison qui peut même devenir un vrai spectacle lorsqu’ils sont plantés par dizaines.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Narcissus\r\nFamille : Amaryllidacées\r\nType : Bulbeuse\r\n\r\nHauteur : 10 à 40 cm\r\nExposition : Ensoleillée et mi-ombre\r\nSol : Ordinaire\r\n\r\nFloraison : Dès février jusque mai', '10.00', 1, 'jpg', 25, 3, 1),
(23, 'Oeillet', 'L’oeillet est une annuelle offrant de très jolies fleurs durant tout l’été.\r\n\r\nLa plantation et l’entretien sont des gestes qui améliorent la floraison.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Tagetes\r\nFamille : Asteracées\r\nType : Annuelle\r\n\r\nHauteur : 20 à 90 cm\r\nExposition : Ensoleillée\r\nSol : Ordinaire\r\nFloraison : Mai à septembre', '8.00', 1, 'jpg', 25, 3, 1),
(24, 'Orchidée', 'Les orchidées ou orchidacées (Orchidaceae) forment une grande famille de plantes monocotylédones. C''est une des familles les plus diversifiées, comptant plus de vingt-cinq mille espèces, réparties en huit-cent-cinquante genres.\r\nCe sont des plantes herbacées, de type divers, autotrophes ou mycotrophes, à feuilles réduites, à écailles, ou développées, terrestres ou épiphytes, pérennes, rhizomateuses ou tubéreuses, des régions tempérées à tropicales. La symbiose, qu''elle soit de type autotrophique, saprophytique, voire parasitique, se fait avec un champignon microscopique qui permet à la plante de pallier l''absence de toute réserve dans ses graines ainsi que l''absence de radicelles au niveau de ses racines. C''est une famille largement répandue ; la majorité des espèces se rencontrent dans les régions tropicales.', '46.00', 1, 'jpg', 25, 3, 1),
(25, 'Pivoine', 'La pivoine est une très jolie fleur, assez capricieuse, dont l’entretien participe largement à la floraison.\r\n\r\nDu printemps à l’hiver et de la plantation à la taille des fleurs fanées, voici tous les conseils.\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Paeonia\r\nFamille : Paéoniacées\r\nType : Vivace\r\n\r\nHauteur : 50 à 200 cm\r\nExposition : Ensoleillée et mi-ombre\r\nSol : Plutôt riche et humide\r\n\r\nFeuillage : Caduc\r\nFloraison : Mai à juillet', '32.00', 1, 'jpg', 25, 3, 1),
(26, 'Pois de senteur', 'Le pois de senteur est une fleur qui nous ravit durant tout l’été.\r\n\r\nSes fleurs, finement découpées, et son odeur délicate en fait l’une des plus jolies annuelles.\r\n\r\nAdoptez les pois de senteur et vous serez conquis !\r\n\r\nEn résumé, ce qu’il faut savoir :\r\n\r\nNom : Lonicera\r\nFamille : Caprifoliacées\r\nType : Plante grimpante\r\n\r\nHauteur : 2 à 5 m\r\nExposition : Ensoleillée\r\nSol : Ordinaire\r\n\r\nFeuillage : Caduc ou persistant\r\nFloraison : Mai à octobre selon les espèces', '21.00', 1, 'jpg', 25, 3, 1),
(27, 'Rose', 'Nom : Rose\nFamille : Rosier buisson\nType : Rosier\n\nHauteur : 80 à 100 cm\nExposition : Ensoleillée ou mi-ombre\nSol : Ordinaire\n\nFeuillage : Caduc\nFloraison : mai à décembre', '52.00', 1, 'jpg', 100, 3, 1),
(30, 'Pink rose ', 'Nom : Pink Rose\r\nFamille : Rosier buisson\r\nType : Rosier\r\n\r\nHauteur : 80 à 100 cm\r\nExposition : Ensoleillée ou mi-ombre\r\nSol : Ordinaire\r\n\r\nFeuillage : Caduc\r\nFloraison : mai à décembre', '56.00', 1, 'jpg', 100, 3, 1),
(31, 'Orange rose', 'Nom : Orange Rose\r\nFamille : Rosier buisson\r\nType : Rosier\r\n\r\nHauteur : 80 à 100 cm\r\nExposition : Ensoleillée ou mi-ombre\r\nSol : Ordinaire\r\n\r\nFeuillage : Caduc\r\nFloraison : mai à décembre', '59.00', 1, 'jpg', 100, 3, 1),
(32, 'Rose de noël', 'L’hellébore que l’on appelle rose de Noël est une magnifique fleur a floraison hivernale.\n\nL’entretien et le plantation sont des gestes qui faciliteront la floraison.\n\nEn résumé, ce qu’il faut savoir :\n\nNom : Helleborus\nFamille : Renonculacées\nType : Vivace\n\nHauteur : 30 à 80 cm\nExposition : Mi-ombre et ombre\nSol :\n\nFloraison : Décembre à mars', '62.00', 1, 'jpg', 100, 3, 1),
(33, 'Tulipe', 'La tulipe est, parmi les fleurs à bulbe, une incontournable de nos jardins.\r\n\r\nLa plantation et l’entretien des tulipes favorisera la floraison tout en garantissant une belle reprise d’année en année.\r\n\r\nNom : Tulipa\r\nFamille : Liliacées\r\n\r\nHauteur: 20 à 75 cm\r\nSol : Bien drainé\r\n\r\nExposition : Ensoleillée\r\nFloraison : Mars à mai', '20.00', 1, 'jpg', 50, 3, 1),
(34, 'Rosier en Pot', 'Les rosiers, ou églantiers, forment un genre de plantes, le genre Rosa de la famille des Rosaceae, originaires des régions tempérées et subtropicales de l''hémisphère nord. Ce sont des arbustes et arbrisseaux sarmenteux et épineux. Suivant les avis souvent divers des botanistes, le genre Rosa comprend de 100 à 200 espèces qui s''hybrident facilement entre elles1.\r\nPlusieurs espèces et de nombreux cultivars, issus de mutations ou de croisements, sont cultivés comme plantes ornementales pour leurs fleurs, les roses. Celles-ci constituent la plus importante catégorie des fleurs coupées, vendues chez les fleuristes, mais les rosiers sont aussi cultivés pour la production d''essence de parfumerie.', '65.00', 2, 'jpg', 6, 3, 2),
(35, 'Rosier', 'Les rosiers, ou églantiers, forment un genre de plantes, le genre Rosa de la famille des Rosaceae, originaires des régions tempérées et subtropicales de l''hémisphère nord. Ce sont des arbustes et arbrisseaux sarmenteux et épineux. Suivant les avis souvent divers des botanistes, le genre Rosa comprend de 100 à 200 espèces qui s''hybrident facilement entre elles1.\r\nPlusieurs espèces et de nombreux cultivars, issus de mutations ou de croisements, sont cultivés comme plantes ornementales pour leurs fleurs, les roses. Celles-ci constituent la plus importante catégorie des fleurs coupées, vendues chez les fleuristes, mais les rosiers sont aussi cultivés pour la production d''essence de parfumerie.', '12.00', 2, 'jpg', 1, 1, 2),
(36, 'Pelargonium impérial', 'Le géranium lierre est une formidable plante d’ornement.\r\n\r\nLa culture et  l’entretien sont faciles pour avoir de belles fleurs. En balcon, en terrasse ou au jardin, l’effet décoratif est garanti.\r\n\r\nNom : Pelargonium peltatum\r\nFamille : Geraniacées\r\nType : Vivace\r\n\r\nHauteur : 30 à 80 cm\r\nExposition : Ensoleillée\r\nSol : Bien drainé\r\n\r\nFeuillage : Caduc\r\nFloraison : Mai à octobre', '22.00', 2, 'jpg', 12, 3, 1),
(37, 'Geranium', '\r\nLe géranium vivace est une variété qui présente l’avantage d’être rustique et donc résistant au gel.\r\n\r\nLa plantation, l’entretien et la taille vous aideront à avoir de magnifiques fleurs durant tout l’été.\r\n\r\nNom : Geranium\r\nFamille : Géraniacées\r\nType : Vivace\r\n\r\nHauteur : 20 à 60 cm\r\nExposition : Ensoleillée et mi-ombre\r\nSol : Ordinaire, bien drainé\r\n\r\nFloraison : Mai à septembre', '24.00', 2, 'jpg', 12, 3, 1),
(38, 'Pelargonium mistress', 'Les pélargoniums présentent une extraordinaire variété de formes, de couleurs, de textures et surtout de délicieuses effluves dès que vous les effleurez ou les arrosez.\r\nLe pélargonium ''Mistress Parker'' est une variété de type zonale à la végétation compacte et au port érigé. Ses fleurs délicates sont doubles et roses (virant sur le mauve.', '25.00', 2, 'jpg', 12, 3, 1),
(39, 'Pelargonium lannion', 'Des fleurs innombrables pour des jardinières classiques. Les pelargoniums zonales se distinguent par leurs très grosses fleurs de mai jusqu''aux gelées, leur port érigé et des feuilles presques rondes. \r\nLa couleur de ces 12 Pelargoniums ''Lannion'' est orange vif, ses fleurs sont doubles. ', '25.00', 2, 'jpg', 12, 3, 1),
(40, 'Pot', 'Caractéristiques techniques :\n\nMatière :\nPolyéthylène\nLitrage :\nD25xH22cm - Litrage : 6,7\nD30xH27cm - Litrage : 11,5\nD35xH31cm - Litrage : 18,5\nLes plus produit :\n\nLéger et résistant\nDes coloris modernes\nDisponible en : D25xH22cm, D30xH27cm, D35xH31cm\nDisponible en : Rouge Mat, Blanc, Noir, Orange, Vert Pastel', '0.60', 3, 'jpg', 1, 2, 2),
(41, 'Pot en fibre', 'Notre avis :\r\nGrâce à une forme simple et élégante, ce pot en fibre de terre convient à tout type de plantes. Sa forme rectangulaire haute est idéale pour délimiter les espaces et construire un ensemble végétal dense.\r\n\r\nCaractéristiques :\r\nLa fibre de terre est solide et légère. Elle possède un rayonnement naturel et peut être utilisée tant à l''interieur qu''à l''extérieur. Ce pot peut aussi être utilisé en cache-pot.\r\n\r\nDimensions :\r\nLongueur : 100 cm\r\nLargeur : 45 cm\r\nHauteur : 45 cm\r\nPoids : 14 kg\r\nExiste en plusieurs dimensions.', '12.00', 3, 'jpg', 1, 3, 2),
(42, 'Pot résine', 'Cache pot résine\r\n\r\nCe cache pot résine est l''accessoire de décoration extérieure idéal pour accompagner vos salons de jardin tressés.\r\nLes avantages du cache pot résine\r\n\r\n- Design tendance,\r\n- Grande robustesse,\r\n- Structure entièrement démontable.\r\nGarantie 1 an.', '15.00', 3, 'jpg', 1, 1, 2),
(43, 'Pot zinc', 'Cache-pot simple en zinc patiné équipé d''une accroche pour vos balcons et ballustrades. Aromates et fleurs y trouveront leur place, mais vous pourrez également détourner cet objet pour y ranger par exemple, vos ustensiles de cuisine, cuillères en bois, éponges, tire bouchon etc...ou encore vos outils de jardin tels que sécateurs, poussoirs etc... un usage multiple et toujours utile ! Sans trou de drainage. Existe en version jardinière pour balcon et pots de fleurs. ', '17.00', 3, 'jpg', 20, 3, 1),
(44, 'Bille argile', 'La bille d’argile est un substrat, utilisable en agriculture biologique. Il a la particularité d’être extrêmement stable et durable..\r\n\r\nGrâce à une composition 100% minérale, ce produit est à la fois utile pour le drainage, le rempotage mais également, pour la décoration !', '5.00', 3, 'jpg', 1, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `promos`
--

CREATE TABLE IF NOT EXISTS `promos` (
  `promos_id` int(11) NOT NULL,
  `promos_taux` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `promos`
--

INSERT INTO `promos` (`promos_id`, `promos_taux`) VALUES
(1, 20),
(2, 50),
(3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `reglements`
--

CREATE TABLE IF NOT EXISTS `reglements` (
  `reglements_id` int(11) NOT NULL,
  `reglements_type` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reglements`
--

INSERT INTO `reglements` (`reglements_id`, `reglements_type`) VALUES
(1, 'Carte Bancaire'),
(2, 'Versement'),
(3, 'Chèque');

-- --------------------------------------------------------

--
-- Structure de la table `statuts`
--

CREATE TABLE IF NOT EXISTS `statuts` (
  `statuts_id` int(11) NOT NULL,
  `statuts_nom` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `statuts`
--

INSERT INTO `statuts` (`statuts_id`, `statuts_nom`) VALUES
(1, 'En attente'),
(2, 'Terminer');

-- --------------------------------------------------------

--
-- Structure de la table `transporteurs`
--

CREATE TABLE IF NOT EXISTS `transporteurs` (
  `transporteurs_id` int(11) NOT NULL,
  `transporteurs_nom` varchar(50) NOT NULL,
  `transporteurs_prenom` varchar(50) NOT NULL,
  `transporteurs_tel` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `transporteurs`
--

INSERT INTO `transporteurs` (`transporteurs_id`, `transporteurs_nom`, `transporteurs_prenom`, `transporteurs_tel`) VALUES
(1, 'Fournier', 'Thomas', '0645305838'),
(7, 'Pernet', 'Guy', '0645305825');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `types_id` int(255) NOT NULL,
  `types_nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `types`
--

INSERT INTO `types` (`types_id`, `types_nom`) VALUES
(1, 'Fleur'),
(2, 'Plante'),
(3, 'Accessoire');

-- --------------------------------------------------------

--
-- Structure de la table `visibles`
--

CREATE TABLE IF NOT EXISTS `visibles` (
  `visibles_id` int(11) NOT NULL,
  `visibles_type` varchar(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `visibles`
--

INSERT INTO `visibles` (`visibles_id`, `visibles_type`) VALUES
(1, 'Oui'),
(2, 'Non');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clients_id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`commandes_id`);

--
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`entreprises_id`);

--
-- Index pour la table `etats`
--
ALTER TABLE `etats`
  ADD PRIMARY KEY (`etats_id`);

--
-- Index pour la table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grades_id`);

--
-- Index pour la table `lignes`
--
ALTER TABLE `lignes`
  ADD PRIMARY KEY (`lignes_id`);

--
-- Index pour la table `livraisons`
--
ALTER TABLE `livraisons`
  ADD PRIMARY KEY (`livraisons_id`);

--
-- Index pour la table `operateurs`
--
ALTER TABLE `operateurs`
  ADD PRIMARY KEY (`operateurs_id`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`pays_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`produits_id`);

--
-- Index pour la table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`promos_id`);

--
-- Index pour la table `reglements`
--
ALTER TABLE `reglements`
  ADD PRIMARY KEY (`reglements_id`);

--
-- Index pour la table `statuts`
--
ALTER TABLE `statuts`
  ADD PRIMARY KEY (`statuts_id`);

--
-- Index pour la table `transporteurs`
--
ALTER TABLE `transporteurs`
  ADD PRIMARY KEY (`transporteurs_id`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`types_id`);

--
-- Index pour la table `visibles`
--
ALTER TABLE `visibles`
  ADD PRIMARY KEY (`visibles_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `clients_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `commandes_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `entreprises_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `etats`
--
ALTER TABLE `etats`
  MODIFY `etats_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `grades`
--
ALTER TABLE `grades`
  MODIFY `grades_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `lignes`
--
ALTER TABLE `lignes`
  MODIFY `lignes_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `livraisons`
--
ALTER TABLE `livraisons`
  MODIFY `livraisons_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `operateurs`
--
ALTER TABLE `operateurs`
  MODIFY `operateurs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `pays_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `produits_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT pour la table `promos`
--
ALTER TABLE `promos`
  MODIFY `promos_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `reglements`
--
ALTER TABLE `reglements`
  MODIFY `reglements_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `statuts`
--
ALTER TABLE `statuts`
  MODIFY `statuts_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `transporteurs`
--
ALTER TABLE `transporteurs`
  MODIFY `transporteurs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `types_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `visibles`
--
ALTER TABLE `visibles`
  MODIFY `visibles_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
