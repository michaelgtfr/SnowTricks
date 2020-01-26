-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 26 jan. 2020 à 01:06
-- Version du serveur :  8.0.13
-- Version de PHP :  7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `snow_tricks`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_comment_fk` (`author_id`),
  KEY `article_comment_fk` (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=191 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `article_id`, `date_create`, `comment`, `author_id`) VALUES
(190, 58, '2020-01-26 01:05:36', 'Un jour peut être je ferais ça!!', 139);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `chapo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_article_fk` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `user_id`, `title`, `chapo`, `content`, `date_create`) VALUES
(49, 139, 'Mute (grabs)', 'Saisie de la carre frontside de la planche entre les deux pieds avec la main avant', 'Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. » Il existe plusieurs types de grabs selon la position de la saisie et la main choisie pour l&#39;effectuer, avec des difficultés variables . Pour le Mute, le but Saisir de la carre frontside de la planche entre les deux pieds avec la main avant.Un grab est d&#39;autant plus réussi que la saisie est longue. De plus, le saut est d&#39;autant plus esthétique que la saisie du snowboard est franche, ce qui permet au rideur d&#39;accentuer la torsion de son corps grâce à la tension de sa main sur la planche. On dit alors que le grab est tweaké (le verbe anglais to tweak signifie « pincer » mais a également le sens de « peaufiner »).', '2020-01-24 23:00:37'),
(50, 139, 'Un 180', 'Un 180 désigne un demi-tour, soit 180 degrés d&#39;angle', 'On désigne par le mot « rotation » uniquement des rotations horizontales ; les rotations verticales sont des flips. Le principe est d&#39;effectuer une rotation horizontale pendant le saut, puis d&#39;attérir en position switch ou normal. La nomenclature se base sur le nombre de degrés de rotation effectués. un 180 désigne un demi-tour, soit 180 degrés d&#39;angle. Une rotation peut être frontside ou backside, une rotation frontside correspond à une rotation orientée vers la carre backside. Cela peut paraître incohérent mais l&#39;origine étant que dans un halfpipe ou une rampe de skateboard, une rotation frontside se déclenche naturellement depuis une position frontside (i.e. l&#39;appui se fait sur la carre frontside), et vice-versa. Ainsi pour un rider qui a une position regular (pied gauche devant), une rotation frontside se fait dans le sens inverse des aiguilles d&#39;une montre. Une rotation peut être agrémentée d&#39;un grab, ce qui rend le saut plus esthétique mais aussi plus difficile car la position tweakée a tendance à déséquilibrer le rideur et désaxer la rotation.', '2020-01-24 23:03:20'),
(51, 139, 'BackFlip', 'Un flip est une rotation verticale.', 'Les Back flips sont une rotations en arrière (Front flips, rotations en avant). Il est possible de faire plusieurs flips à la suite, et d&#39;ajouter un grab à la rotation. Les flips agrémentés d&#39;une vrille existent aussi (Mac Twist, Hakon Flip, ...), mais de manière beaucoup plus rare, et se confondent souvent avec certaines rotations horizontales désaxées. Néanmoins, en dépit de la difficulté technique relative d&#39;une telle figure, le danger de retomber sur la tête ou la nuque est réel et conduit certaines stations de ski à interdire de telles figures dans ses snowparks.', '2020-01-24 23:07:57'),
(52, 139, 'Corkscrew', 'Le &#34;Corkscrew&#34; ou &#34;Cork&#34; est une figure dit de rotation désaxée .', 'Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation. Il existe différents types de rotations désaxées (corkscrew ou cork, rodeo, misty, etc.) en fonction de la manière dont est lancé le buste. Certaines de ces rotations, bien qu&#39;initialement horizontales, font passer la tête en bas. Bien que certaines de ces rotations soient plus faciles à faire sur un certain nombre de tours (ou de demi-tours) que d&#39;autres, il est en théorie possible de d&#39;attérir n&#39;importe quelle rotation désaxée avec n&#39;importe quel nombre de tours, en jouant sur la quantité de désaxage afin de se retrouver à la position verticale au moment voulu. Il est également possible d&#39;agrémenter une rotation désaxée par un grab.', '2020-01-24 23:10:49'),
(53, 139, 'Slide', 'Un slide consiste à glisser sur une barre de slide.', 'Le slide se fait soit avec la planche dans l&#39;axe de la barre, soit perpendiculaire, soit plus ou moins désaxé. On peut slider avec la planche centrée par rapport à la barre (celle-ci se situe approximativement au-dessous des pieds du rideur), mais aussi en nose slide, c&#39;est-à-dire l&#39;avant de la planche sur la barre, ou en tail slide, l&#39;arrière de la planche sur la barre.', '2020-01-24 23:14:06'),
(54, 139, 'One foot tricks', 'Figures réalisée avec un pied décroché de la fixation,', 'afin de tendre la jambe correspondante pour mettre en évidence le fait que le pied n&#39;est pas fixé. Ce type de figure est extrêmement dangereuse pour les ligaments du genou en cas de mauvaise réception.', '2020-01-25 07:50:31'),
(55, 139, 'Japan air', 'Japan air, figure old school', 'Le terme old school désigne un style de freestyle caractérisée par en ensemble de figure et une manière de réaliser des figures passée de mode, qui fait penser au freestyle des années 1980 - début 1990 (par opposition à new school) : figures désuètes : Japan air, rocket air, ... , rotations effectuées avec le corps tendu figures saccadées, par opposition au style new school qui privilégie l&#39;amplitude. Pour faire un japan air il faut que la main attrape le snow en passant derrière le corps.', '2020-01-25 07:52:20'),
(56, 139, 'Sad', 'Sad ou melancholie ou style week : saisie de la carre backside de la planche, entre les deux pieds, avec la main avant ;', 'Le Sad est un Grab. Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. ». Il existe plusieurs types de grabs selon la position de la saisie et la main choisie pour l&#39;effectuer, avec des difficultés variables :', '2020-01-25 07:53:52'),
(57, 139, 'le 360', 'Trois six pour un tour complet', 'Comment faire un frontside 360 en snowboard La suite des conseils de Tonton Franky, qui après le backside 360 nous apprend en mots et en vidéo comment on tourne un 3.6 front dans les règles de l&#39;art. Le 3.6 front ou frontside 3 est un tricks intéressant car on peut y mettre facilement beaucoup de style. C’est une rotation de 360 degrés du côté frontside ( à gauche pour les regular et à droite pour les goofy). Comme le 3.6 back, la vitesse de rotation est assez facile à gérer, mais si l’impulsion parait plus évidente en lançant les épaules de face, l’atterrissage l&#39;est beaucoup moins car on est de dos le dernier quart du saut. On appelle ça une reception blind side…', '2020-01-25 07:55:23'),
(58, 139, 'Half-pipe', 'Il s&#39;agit d&#39;un double tremplin courbe, évoquant la forme d&#39;un demi-tube (comme l&#39;indique l&#39;appellation anglaise). On peut former une rampe en assemblant deux quarter-pipe', 'Un half-pipe dans le cas des sports de neige, appelé également rampe de neige et, au Canada, demi-lune, est une structure utilisée pour les sports de glisse comme le ski freestyle ou le snowboard. C&#39;est une structure neigeuse se présentant sous la forme d&#39;un demi tube. Il est constitué de deux longs murs de neige de forme arrondie qui se font front et se rejoignent en leur base. Ces rebords arrondis s&#39;appellent des murs ou des cuillères (walls en anglais). Le bord supérieur de ces murs s&#39;appelle le copping. Les half-pipes sont fabriqués par des dameuses à l&#39;aide d&#39;un équipement spécial qui taille les cuillères arrondies. On appelle cette machine la pipe dragon ou dragon master. Un half-pipe classique a une hauteur de murs d&#39;à peu près 5 mètres mais les plus gros, dits « SuperPipes », peuvent aller jusqu&#39;à 7 mètres au niveau du copping. Ils sont utilisés au Xgames, mais aussi sur le Dew tour, et d&#39;autres grosses compétitions.', '2020-01-25 07:57:56');

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_video_fk` (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`id`, `article_id`, `link`) VALUES
(46, 58, 'https://www.youtube.com/embed/he03dVkhLTM'),
(45, 57, 'https://www.youtube.com/embed/JJy39dO_PPE'),
(44, 56, 'https://www.youtube.com/embed/KEdFwJ4SWq4'),
(43, 55, 'https://www.youtube.com/embed/CzDjM7h_Fwo'),
(41, 53, 'https://www.youtube.com/embed/U9qJnX7-P-8'),
(42, 54, 'https://www.youtube.com/embed/4IVdWdvsrVA'),
(38, 50, 'https://www.youtube.com/embed/NQ1MERtpFLQ'),
(40, 52, 'https://www.youtube.com/embed/qqNV0tI3Z4k'),
(39, 51, 'https://www.youtube.com/embed/W853WVF5AqI'),
(37, 49, 'https://www.youtube.com/embed/Opg5g4zsiGY');

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `extension` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_picture_fk` (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id`, `article_id`, `name`, `extension`, `description`) VALUES
(80, 58, '2020_01_25_07_57_56-5e2bf504b349a', 'jpeg', 'photo_2020_01_25_07_57_56-5e2bf504b349a'),
(78, 57, '2020_01_25_07_55_23-5e2bf46befb54', 'jpeg', 'photo_2020_01_25_07_55_23-5e2bf46befb54'),
(79, 58, '2020_01_25_07_57_56-5e2bf504b2c70', 'jpeg', 'photo_2020_01_25_07_57_56-5e2bf504b2c70'),
(77, 57, '2020_01_25_07_55_23-5e2bf46bef620', 'jpeg', 'photo_2020_01_25_07_55_23-5e2bf46bef620'),
(76, 56, '2020_01_25_07_53_52-5e2bf4106cef3', 'jpeg', 'photo_2020_01_25_07_53_52-5e2bf4106cef3'),
(75, 55, '2020_01_25_07_52_20-5e2bf3b446321', 'jpeg', 'photo_2020_01_25_07_52_20-5e2bf3b446321'),
(74, 55, '2020_01_25_07_52_20-5e2bf3b445f35', 'jpeg', 'photo_2020_01_25_07_52_20-5e2bf3b445f35'),
(73, 54, '2020_01_25_07_50_31-5e2bf347af5ba', 'jpeg', 'photo_2020_01_25_07_50_31-5e2bf347af5ba'),
(72, 54, '2020_01_25_07_49_57-5e2bf325ef7c8', 'jpeg', 'photo_2020_01_25_07_49_57-5e2bf325ef7c8'),
(66, 53, '2020_01_24_23_14_06-5e2b7a3e4b426', 'jpeg', 'photo_2020_01_24_23_14_06-5e2b7a3e4b426'),
(65, 53, '2020_01_24_23_14_06-5e2b7a3e4afbe', 'jpeg', 'photo_2020_01_24_23_14_06-5e2b7a3e4afbe'),
(64, 52, '2020_01_24_23_10_49-5e2b7979d269e', 'jpeg', 'photo_2020_01_24_23_10_49-5e2b7979d269e'),
(63, 52, '2020_01_24_23_10_49-5e2b7979d21d0', 'jpeg', 'photo_2020_01_24_23_10_49-5e2b7979d21d0'),
(62, 51, '2020_01_24_23_04_44-5e2b780c7134e', 'jpeg', 'photo_2020_01_24_23_04_44-5e2b780c7134e'),
(61, 51, '2020_01_24_23_04_44-5e2b780c70e18', 'jpeg', 'photo_2020_01_24_23_04_44-5e2b780c70e18'),
(58, 49, '2020_01_24_23_00_37-5e2b7715eac8e', 'jpeg', 'photo_2020_01_24_23_00_37-5e2b7715eac8e'),
(59, 50, '2020_01_24_23_03_20-5e2b77b8dd5c9', 'jpeg', 'photo_2020_01_24_23_03_20-5e2b77b8dd5c9'),
(60, 50, '2020_01_24_23_03_20-5e2b77b8ddc3c', 'jpeg', 'photo_2020_01_24_23_03_20-5e2b77b8ddc3c');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `date_create` datetime NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `confirmation` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `presentation` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `roles` json NOT NULL,
  `confirmation_key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `date_create`, `password`, `confirmation`, `picture`, `presentation`, `roles`, `confirmation_key`) VALUES
(139, 'mickdu62200@gmail.com', 'garret', '2020-01-26 00:56:32', '$argon2i$v=19$m=1024,t=2,p=2$am1HMDdZaWIvQUNkVEVUdg$vxyG5eTG/LkOHT02CLMlQXpsdBl70NmmM97yk9xiqfY', 1, '2020_01_26_00_56_32-5e2ce3c0a054e.jpeg', 'bonjour je m&#39;appelle michael', '[]', 'c8bbe3407d29d8b32fca2404632f3c22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
