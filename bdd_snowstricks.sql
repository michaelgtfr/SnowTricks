-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 01 mars 2020 à 17:17
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
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_comment_fk` (`author_id`),
  KEY `article_comment_fk` (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=217 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `article_id`, `date_create`, `comment`, `author_id`) VALUES
(190, 58, '2020-01-26 01:05:36', 'Un jour peut être je ferais ça!!', 139),
(192, 56, '2020-02-10 18:21:22', 'le saut doit être plaisant!!', 139),
(193, 56, '2020-02-10 18:21:33', 'attention à la chute', 139),
(194, 56, '2020-02-10 18:21:44', 'un jour peut être ', 139),
(195, 56, '2020-02-10 18:21:57', 'j\'aime bien sa planche', 139),
(196, 56, '2020-02-10 18:22:06', 'et son casque', 139),
(197, 56, '2020-02-11 15:01:30', 'pour les email privé vous pouvez cliquer sur mon pseudo', 139),
(198, 56, '2020-02-11 15:02:51', 'j\'avoue je ne sais pas trop quoi écrire', 139),
(199, 56, '2020-02-11 17:51:50', 'je sais pas si il fait si froid que sa??', 139),
(200, 56, '2020-02-11 17:51:54', 'le temps qu\'il a du mettre pour apprendre ça', 139),
(201, 56, '2020-02-11 17:51:58', 'la video est chouette!', 139),
(202, 56, '2020-02-11 17:52:03', 'johnny!!', 139),
(203, 56, '2020-02-11 17:52:08', 'classe le sad', 139),
(205, 56, '2020-02-18 17:20:27', 'coucou sa va!!', 139),
(207, 56, '2020-02-25 05:41:48', 'tu fonction ou pas', 139),
(208, 56, '2020-02-25 05:46:23', 'llkmlkmlk', 139),
(216, 56, '2020-03-01 16:05:09', 'coucou', 139);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `chapo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_article_fk` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `user_id`, `title`, `chapo`, `content`, `date_create`) VALUES
(85, 139, 'le 360', 'Trois six pour un tour complet', 'Comment faire un frontside 360 en snowboard La suite des conseils de Tonton Franky, qui après le backside 360 nous apprend en mots et en vidéo comment on tourne un 3.6 front dans les règles de l&#39;art. Le 3.6 front ou frontside 3 est un tricks intéressant car on peut y mettre facilement beaucoup de style. C’est une rotation de 360 degrés du côté frontside ( à gauche pour les regular et à droite pour les goofy). Comme le 3.6 back, la vitesse de rotation est assez facile à gérer, mais si l’impulsion parait plus évidente en lançant les épaules de face, l’atterrissage l&#39;est beaucoup moins car on est de dos le dernier quart du saut. On appelle ça une reception blind side…', '2020-03-01 17:14:21'),
(86, 139, 'HalfPipe', 'Il s&#39;agit d&#39;un double tremplin courbe, évoquant la forme d&#39;un demi-tube (comme l&#39;indique l&#39;appellation anglaise). On peut former une rampe en assemblant deux quarter-pipe', 'Un half-pipe dans le cas des sports de neige, appelé également rampe de neige et, au Canada, demi-lune, est une structure utilisée pour les sports de glisse comme le ski freestyle ou le snowboard. C&#39;est une structure neigeuse se présentant sous la forme d&#39;un demi tube. Il est constitué de deux longs murs de neige de forme arrondie qui se font front et se rejoignent en leur base. Ces rebords arrondis s&#39;appellent des murs ou des cuillères (walls en anglais). Le bord supérieur de ces murs s&#39;appelle le copping. Les half-pipes sont fabriqués par des dameuses à l&#39;aide d&#39;un équipement spécial qui taille les cuillères arrondies. On appelle cette machine la pipe dragon ou dragon master. Un half-pipe classique a une hauteur de murs d&#39;à peu près 5 mètres mais les plus gros, dits « SuperPipes », peuvent aller jusqu&#39;à 7 mètres au niveau du copping. Ils sont utilisés au Xgames, mais aussi sur le Dew tour, et d&#39;autres grosses compétitions.', '2020-03-01 17:16:20'),
(77, 139, 'MUTE', 'Saisie de la carre frontside de la planche entre les deux pieds avec la main avant (grab)', 'Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. » Il existe plusieurs types de grabs selon la position de la saisie et la main choisie pour l&#39;effectuer, avec des difficultés variables . Pour le Mute, le but Saisir de la carre frontside de la planche entre les deux pieds avec la main avant.Un grab est d&#39;autant plus réussi que la saisie est longue. De plus, le saut est d&#39;autant plus esthétique que la saisie du snowboard est franche, ce qui permet au rideur d&#39;accentuer la torsion de son corps grâce à la tension de sa main sur la planche. On dit alors que le grab est tweaké (le verbe anglais to tweak signifie « pincer » mais a également le sens de « peaufiner »).', '2020-03-01 17:01:19'),
(78, 139, 'Un 180', 'Un 180 désigne un demi-tour, soit 180 degrés d&#39;angle', 'On désigne par le mot « rotation » uniquement des rotations horizontales ; les rotations verticales sont des flips. Le principe est d&#39;effectuer une rotation horizontale pendant le saut, puis d&#39;attérir en position switch ou normal. La nomenclature se base sur le nombre de degrés de rotation effectués. un 180 désigne un demi-tour, soit 180 degrés d&#39;angle. Une rotation peut être frontside ou backside, une rotation frontside correspond à une rotation orientée vers la carre backside. Cela peut paraître incohérent mais l&#39;origine étant que dans un halfpipe ou une rampe de skateboard, une rotation frontside se déclenche naturellement depuis une position frontside (i.e. l&#39;appui se fait sur la carre frontside), et vice-versa. Ainsi pour un rider qui a une position regular (pied gauche devant), une rotation frontside se fait dans le sens inverse des aiguilles d&#39;une montre. Une rotation peut être agrémentée d&#39;un grab, ce qui rend le saut plus esthétique mais aussi plus difficile car la position tweakée a tendance à déséquilibrer le rideur et désaxer la rotation.', '2020-03-01 17:03:29'),
(79, 139, 'BackFlip', 'Un flip est une rotation verticale.', 'Les Back flips sont une rotations en arrière (Front flips, rotations en avant). Il est possible de faire plusieurs flips à la suite, et d&#39;ajouter un grab à la rotation. Les flips agrémentés d&#39;une vrille existent aussi (Mac Twist, Hakon Flip, ...), mais de manière beaucoup plus rare, et se confondent souvent avec certaines rotations horizontales désaxées. Néanmoins, en dépit de la difficulté technique relative d&#39;une telle figure, le danger de retomber sur la tête ou la nuque est réel et conduit certaines stations de ski à interdire de telles figures dans ses snowparks.', '2020-03-01 17:05:04'),
(80, 139, 'Cork', 'Le &#34;Corkscrew&#34; ou &#34;Cork&#34; est une figure dit de rotation désaxée .', 'Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation. Il existe différents types de rotations désaxées (corkscrew ou cork, rodeo, misty, etc.) en fonction de la manière dont est lancé le buste. Certaines de ces rotations, bien qu&#39;initialement horizontales, font passer la tête en bas. Bien que certaines de ces rotations soient plus faciles à faire sur un certain nombre de tours (ou de demi-tours) que d&#39;autres, il est en théorie possible de d&#39;attérir n&#39;importe quelle rotation désaxée avec n&#39;importe quel nombre de tours, en jouant sur la quantité de désaxage afin de se retrouver à la position verticale au moment voulu. Il est également possible d&#39;agrémenter une rotation désaxée par un grab.', '2020-03-01 17:06:24'),
(81, 139, 'Slide', 'Un slide consiste à glisser sur une barre de slide.', 'Le slide se fait soit avec la planche dans l&#39;axe de la barre, soit perpendiculaire, soit plus ou moins désaxé. On peut slider avec la planche centrée par rapport à la barre (celle-ci se situe approximativement au-dessous des pieds du rideur), mais aussi en nose slide, c&#39;est-à-dire l&#39;avant de la planche sur la barre, ou en tail slide, l&#39;arrière de la planche sur la barre.', '2020-03-01 17:07:59'),
(82, 139, 'One foot', 'Figures réalisée avec un pied décroché de la fixation,', 'afin de tendre la jambe correspondante pour mettre en évidence le fait que le pied n&#39;est pas fixé. Ce type de figure est extrêmement dangereuse pour les ligaments du genou en cas de mauvaise réception.', '2020-03-01 17:09:27'),
(83, 139, 'JapanAir', 'Japan air, figure old school', 'Le terme old school désigne un style de freestyle caractérisée par en ensemble de figure et une manière de réaliser des figures passée de mode, qui fait penser au freestyle des années 1980 - début 1990 (par opposition à new school) : figures désuètes : Japan air, rocket air, ... , rotations effectuées avec le corps tendu figures saccadées, par opposition au style new school qui privilégie l&#39;amplitude. Pour faire un japan air il faut que la main attrape le snow en passant derrière le corps.', '2020-03-01 17:11:08'),
(84, 139, 'Sad', 'Sad ou melancholie ou style week : saisie de la carre backside de la planche, entre les deux pieds, avec la main avant ;', 'Le Sad est un Grab. Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. ». Il existe plusieurs types de grabs selon la position de la saisie et la main choisie pour l&#39;effectuer, avec des difficultés variables :', '2020-03-01 17:12:29');

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_video_fk` (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`id`, `article_id`, `link`) VALUES
(46, 58, 'https://www.youtube.com/embed/he03dVkhLTM'),
(67, 82, 'https://www.youtube.com/embed/4IVdWdvsrVA'),
(44, 56, 'https://www.youtube.com/embed/KEdFwJ4SWq4'),
(68, 83, 'https://www.youtube.com/embed/CzDjM7h_Fwo'),
(66, 81, 'https://www.youtube.com/embed/U9qJnX7-P-8'),
(64, 79, 'https://www.youtube.com/embed/W853WVF5AqI'),
(65, 80, 'https://www.youtube.com/embed/qqNV0tI3Z4k'),
(62, 77, 'https://www.youtube.com/embed/Opg5g4zsiGY'),
(63, 78, 'https://www.youtube.com/embed/NQ1MERtpFLQ'),
(57, 70, 'http://dfg'),
(69, 84, 'https://www.youtube.com/embed/KEdFwJ4SWq4'),
(70, 85, 'https://www.youtube.com/embed/JJy39dO_PPE'),
(71, 86, 'https://www.youtube.com/embed/s87CH_RdIc4');

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
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_picture_fk` (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id`, `article_id`, `name`, `extension`, `description`) VALUES
(120, 85, '2020_03_01_17_14_21-5e5bed6daa9ae', 'jpeg', 'photo_2020_03_01_17_14_21-5e5bed6daa9ae'),
(117, 83, '2020_03_01_17_11_08-5e5becac94836', 'jpeg', 'photo_2020_03_01_17_11_08-5e5becac94836'),
(118, 83, '2020_03_01_17_11_08-5e5becac94cd4', 'jpeg', 'photo_2020_03_01_17_11_08-5e5becac94cd4'),
(116, 82, '2020_03_01_17_09_27-5e5bec4725c06', 'jpeg', 'photo_2020_03_01_17_09_27-5e5bec4725c06'),
(76, 56, '2020_02_06_09_38_09-5e3bde81112c1\r\n', 'jpeg', 'photo_2020_01_25_07_53_52-5e2bf4106cef3'),
(119, 84, '2020_03_01_17_12_29-5e5becfdc82e9', 'jpeg', 'photo_2020_03_01_17_12_29-5e5becfdc82e9'),
(115, 82, '2020_03_01_17_09_27-5e5bec47257be', 'jpeg', 'photo_2020_03_01_17_09_27-5e5bec47257be'),
(114, 81, '2020_03_01_17_07_59-5e5bebefa3a7c', 'jpeg', 'photo_2020_03_01_17_07_59-5e5bebefa3a7c'),
(113, 81, '2020_03_01_17_07_59-5e5bebefa35db', 'jpeg', 'photo_2020_03_01_17_07_59-5e5bebefa35db'),
(112, 80, '2020_03_01_17_06_24-5e5beb90aa574', 'jpeg', 'photo_2020_03_01_17_06_24-5e5beb90aa574'),
(111, 80, '2020_03_01_17_06_24-5e5beb90aa0d9', 'jpeg', 'photo_2020_03_01_17_06_24-5e5beb90aa0d9'),
(110, 79, '2020_03_01_17_05_04-5e5beb40b180c', 'jpeg', 'photo_2020_03_01_17_05_04-5e5beb40b180c'),
(106, 77, '2020_03_01_17_01_19-5e5bea5fec9bb', 'jpeg', 'photo_2020_03_01_17_01_19-5e5bea5fec9bb'),
(107, 78, '2020_03_01_17_03_29-5e5beae13db8c', 'jpeg', 'photo_2020_03_01_17_03_29-5e5beae13db8c'),
(108, 78, '2020_03_01_17_03_29-5e5beae13e2ac', 'jpeg', 'photo_2020_03_01_17_03_29-5e5beae13e2ac'),
(109, 79, '2020_03_01_17_05_04-5e5beb40b1316', 'jpeg', 'photo_2020_03_01_17_05_04-5e5beb40b1316'),
(121, 85, '2020_03_01_17_14_21-5e5bed6dab16c', 'jpeg', 'photo_2020_03_01_17_14_21-5e5bed6dab16c'),
(122, 86, '2020_03_01_17_16_20-5e5bede4e6b51', 'jpeg', 'photo_2020_03_01_17_16_20-5e5bede4e6b51'),
(98, 70, '2020_02_27_13_50_28-5e57c9248fde5', 'jpeg', 'photo_2020_02_27_13_50_28-5e57c9248fde5'),
(123, 86, '2020_03_01_17_16_20-5e5bede4e7293', 'jpeg', 'photo_2020_03_01_17_16_20-5e5bede4e7293');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_create` datetime NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `confirmation` int(11) NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `presentation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `roles` json NOT NULL,
  `confirmation_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `date_create`, `password`, `confirmation`, `picture`, `presentation`, `roles`, `confirmation_key`) VALUES
(139, 'mickdu62200@gmail.com', 'garret', '2020-01-26 00:56:32', '$argon2i$v=19$m=1024,t=2,p=2$QlBLU25XbnlXZ0hXS2FIQw$u6uf6RFI0agfcmzLGtPoUYT1vhkEu59p/WpRWuxVs5k', 1, '2020_01_26_00_56_32-5e2ce3c0a054e.jpeg', 'bonjour je m&#39;appelle michael', '[]', 'c8bbe3407d29d8b32fca2404632f3c22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
