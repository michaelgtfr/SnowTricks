-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 19 jan. 2020 à 19:02
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
) ENGINE=MyISAM AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `article_id`, `date_create`, `comment`, `author_id`) VALUES
(1, 2, '2019-10-14 08:00:00', 'est ce que sa fonctionne', 139),
(2, 2, '2019-10-15 04:00:00', 'est celui la', 139),
(29, 1, '2019-12-11 15:45:30', 'dsvmlqshfd*sq', 139),
(30, 2, '2019-12-20 10:22:01', 'teste de fonctionne security et traitement 1', 139),
(5, 2, '2019-12-11 14:25:46', 'vlcxkjwxpcxkvl m', 139),
(6, 2, '2019-12-11 14:25:57', 'dfdsjhldkhdms', 139),
(7, 2, '2019-12-11 14:26:06', 'coucoue sdq', 139),
(8, 2, '2019-12-11 14:26:14', 'dfmkfhqsùsdjqsùdmlskm', 139),
(9, 2, '2019-12-11 14:26:26', 'michaeksdhqszat', 139),
(10, 2, '2019-12-11 14:26:39', 'sdqszapisqpmqlk', 139),
(11, 2, '2019-12-11 14:26:48', 'numero 9', 139),
(12, 2, '2019-12-11 14:27:17', 'numero 10', 139),
(13, 2, '2019-12-11 14:27:32', 'numero 11', 139),
(14, 2, '2019-12-11 14:28:19', 'numero 11', 139),
(15, 2, '2019-12-11 14:28:55', 'coucoue sdq', 139),
(16, 2, '2019-12-11 14:29:04', 'numero 12', 139),
(17, 2, '2019-12-11 14:29:47', 'sqsjk', 139),
(18, 2, '2019-12-11 14:32:20', 'qsmdflqshfùql', 139),
(19, 2, '2019-12-11 14:33:22', 'qsmdflqshfùql', 139),
(20, 2, '2019-12-11 15:18:43', 'qsmdflqshfùql', 139),
(21, 2, '2019-12-11 15:19:58', 'qsmdflqshfùql', 139),
(22, 2, '2019-12-11 15:20:37', 'qsmdflqshfùql', 139),
(23, 2, '2019-12-11 15:21:41', 'qsmdflqshfùql', 139),
(24, 2, '2019-12-11 15:23:27', 'qsmdflqshfùql', 139),
(25, 2, '2019-12-11 15:24:40', 'coucou sa fonctionne', 139),
(26, 2, '2019-12-11 15:25:44', 'coucou sa fonctionne', 139),
(27, 2, '2019-12-11 15:26:35', 'coucou sa fonctionne', 139),
(28, 2, '2019-12-11 15:27:44', 'coucou sa fonctionne', 139),
(31, 2, '2019-12-20 10:22:39', 'teste de fonctionne security et traitement 2', 139),
(32, 2, '2019-12-20 10:23:12', 'teste de fonctionne security et traitement 2', 139),
(33, 2, '2019-12-20 10:23:38', 'teste de fonctionne security et traitement 3', 139),
(34, 2, '2019-12-20 11:03:23', 'teste de fonctionne security et traitement 3', 139),
(35, 23, '2019-12-23 11:13:01', 'dfghjhgfdfg', 139),
(36, 23, '2019-12-23 11:13:11', 'commentaire 2', 139),
(37, 23, '2019-12-23 11:13:17', 'commentaire 3', 139),
(38, 23, '2019-12-23 11:13:22', 'commentaire 4', 139),
(39, 23, '2019-12-23 11:13:38', 'commentaire 5', 139),
(40, 23, '2019-12-23 11:13:43', 'commentaire 6', 139),
(41, 23, '2019-12-23 11:13:49', 'commentaire 7', 139),
(42, 23, '2019-12-23 11:13:54', 'commentaire 8', 139),
(43, 23, '2019-12-23 11:14:00', 'commentaire 9', 139),
(44, 23, '2019-12-23 11:14:06', 'commentaire 10', 139),
(45, 23, '2019-12-23 11:14:12', 'commentaire 11', 139),
(46, 23, '2019-12-23 11:14:20', 'commentaire 12', 139),
(47, 23, '2019-12-23 11:14:29', 'commentaire 13', 139),
(48, 23, '2019-12-23 11:14:36', 'commentaire 14', 139),
(49, 23, '2019-12-23 11:14:42', 'commentaire 15', 139),
(50, 23, '2019-12-23 11:16:27', 'commentaire 15', 139),
(51, 23, '2019-12-23 11:16:45', 'commentaire 15', 139),
(52, 23, '2019-12-23 11:17:24', 'commentaire 15', 139),
(53, 23, '2019-12-23 11:17:30', 'commentaire 15', 139),
(54, 34, '2020-01-02 15:18:04', 'zeg', 139),
(55, 34, '2020-01-02 15:18:16', 'commentaire 2', 139),
(56, 34, '2020-01-02 15:18:24', 'commentaire 3', 139),
(57, 34, '2020-01-02 15:18:33', 'commentaire 4', 139),
(58, 34, '2020-01-02 15:18:39', 'commentaire 5', 139),
(59, 34, '2020-01-02 15:18:46', 'commentaire 6', 139),
(60, 34, '2020-01-02 15:18:52', 'commentaire 7', 139),
(61, 34, '2020-01-02 15:18:58', 'commentaire 8', 139),
(62, 34, '2020-01-02 15:19:04', 'commentaire 9', 139),
(63, 34, '2020-01-02 15:19:10', 'commentaire 10', 139),
(64, 34, '2020-01-02 15:19:16', 'commentaire 11', 139),
(65, 34, '2020-01-02 15:19:22', 'commentaire 12', 139),
(66, 34, '2020-01-02 15:19:28', 'commentaire 13', 139),
(67, 34, '2020-01-02 15:19:34', 'commentaire 14', 139),
(68, 34, '2020-01-02 15:19:40', 'commentaire 15', 139),
(69, 34, '2020-01-02 15:19:45', 'commentaire 16', 139),
(70, 34, '2020-01-02 15:19:50', 'commentaire 17', 139),
(71, 34, '2020-01-02 15:19:56', 'commentaire 18', 139),
(72, 34, '2020-01-02 15:20:04', 'commentaire 19', 139),
(73, 34, '2020-01-02 15:20:10', 'commentaire 20', 139),
(74, 34, '2020-01-02 15:20:16', 'commentaire 21', 139),
(75, 34, '2020-01-02 15:22:18', 'commentaire 21', 139),
(76, 34, '2020-01-02 15:23:49', 'commentaire 21', 139),
(77, 34, '2020-01-02 15:25:34', 'commentaire 21', 139),
(78, 34, '2020-01-02 15:30:27', 'commentaire 21', 139),
(79, 34, '2020-01-02 15:30:56', 'commentaire 21', 139),
(80, 34, '2020-01-02 15:33:13', 'commentaire 21', 139),
(81, 34, '2020-01-02 15:33:31', 'commentaire 21', 139),
(82, 34, '2020-01-02 15:34:45', 'commentaire 21', 139),
(83, 34, '2020-01-02 15:35:36', 'commentaire 21', 139),
(84, 34, '2020-01-02 15:36:23', 'commentaire 21', 139),
(85, 34, '2020-01-02 15:40:28', 'commentaire 21', 139),
(86, 34, '2020-01-02 15:42:31', 'commentaire 21', 139),
(87, 34, '2020-01-02 15:42:55', 'commentaire 21', 139),
(88, 34, '2020-01-02 15:43:07', 'commentaire 21', 139),
(89, 34, '2020-01-02 15:43:57', 'commentaire 21', 139),
(90, 34, '2020-01-02 15:44:25', 'commentaire 21', 139),
(91, 34, '2020-01-02 15:45:51', 'commentaire 21', 139),
(92, 34, '2020-01-02 15:46:47', 'commentaire 21', 139),
(93, 34, '2020-01-02 15:47:14', 'commentaire 21', 139),
(94, 34, '2020-01-02 15:47:28', 'commentaire 21', 139),
(95, 34, '2020-01-02 15:47:43', 'commentaire 21', 139),
(96, 34, '2020-01-02 15:48:22', 'commentaire 21', 139),
(97, 34, '2020-01-02 15:48:40', 'commentaire 21', 139),
(98, 34, '2020-01-02 15:49:09', 'commentaire 21', 139),
(99, 34, '2020-01-02 15:49:29', 'commentaire 21', 139),
(100, 34, '2020-01-02 15:49:44', 'commentaire 21', 139),
(101, 34, '2020-01-02 15:49:57', 'commentaire 21', 139),
(102, 34, '2020-01-02 15:50:49', 'commentaire 21', 139),
(103, 34, '2020-01-02 15:51:03', 'commentaire 21', 139),
(104, 34, '2020-01-02 15:51:35', 'commentaire 21', 139),
(105, 34, '2020-01-02 15:51:58', 'commentaire 21', 139),
(106, 34, '2020-01-02 15:52:45', 'commentaire 21', 139),
(107, 34, '2020-01-02 15:53:14', 'commentaire 21', 139),
(108, 34, '2020-01-02 15:53:31', 'commentaire 21', 139),
(109, 34, '2020-01-02 15:53:49', 'commentaire 21', 139),
(110, 34, '2020-01-02 15:56:36', 'commentaire 21', 139),
(111, 34, '2020-01-02 15:56:59', 'commentaire 21', 139),
(112, 34, '2020-01-02 15:57:09', 'commentaire 21', 139),
(113, 34, '2020-01-02 15:58:07', 'commentaire 21', 139),
(114, 34, '2020-01-02 15:58:40', 'commentaire 21', 139),
(115, 34, '2020-01-02 15:58:53', 'commentaire 21', 139),
(116, 34, '2020-01-02 16:01:03', 'commentaire 21', 139),
(117, 34, '2020-01-02 16:01:12', 'commentaire 21', 139),
(118, 34, '2020-01-02 16:01:26', 'commentaire 21', 139),
(119, 34, '2020-01-02 16:01:39', 'commentaire 21', 139),
(120, 34, '2020-01-02 16:55:10', 'commentaire 21', 139),
(121, 34, '2020-01-02 16:55:39', 'commentaire 21', 139),
(122, 34, '2020-01-02 16:56:29', 'commentaire 21', 139),
(123, 34, '2020-01-02 16:57:35', 'commentaire 21', 139),
(124, 34, '2020-01-02 16:57:53', 'commentaire 21', 139),
(125, 34, '2020-01-02 16:58:16', 'commentaire 21', 139),
(126, 34, '2020-01-02 16:58:36', 'commentaire 21', 139),
(127, 34, '2020-01-02 16:58:52', 'commentaire 21', 139),
(128, 34, '2020-01-02 16:59:52', 'commentaire 21', 139),
(129, 34, '2020-01-02 17:00:15', 'commentaire 21', 139),
(130, 34, '2020-01-02 17:03:44', 'commentaire 21', 139),
(131, 34, '2020-01-02 17:04:28', 'commentaire 21', 139),
(132, 34, '2020-01-02 17:06:54', 'commentaire 21', 139),
(133, 34, '2020-01-02 17:07:03', 'commentaire 21', 139),
(134, 34, '2020-01-02 17:07:35', 'commentaire 21', 139),
(135, 34, '2020-01-02 17:07:47', 'commentaire 21', 139),
(136, 34, '2020-01-02 17:08:07', 'commentaire 21', 139),
(137, 34, '2020-01-02 17:08:26', 'commentaire 21', 139),
(138, 34, '2020-01-02 17:08:56', 'commentaire 21', 139),
(139, 34, '2020-01-02 17:09:08', 'commentaire 21', 139),
(140, 34, '2020-01-02 17:09:35', 'commentaire 21', 139),
(141, 34, '2020-01-02 17:09:56', 'commentaire 21', 139),
(142, 34, '2020-01-02 17:11:16', 'commentaire 21', 139),
(143, 34, '2020-01-02 17:11:58', 'commentaire 21', 139),
(144, 34, '2020-01-02 17:12:27', 'commentaire 21', 139),
(145, 34, '2020-01-02 17:13:41', 'commentaire 21', 139),
(146, 34, '2020-01-02 17:14:05', 'commentaire 21', 139),
(147, 34, '2020-01-02 17:14:39', 'commentaire 21', 139),
(148, 34, '2020-01-02 17:15:29', 'commentaire 21', 139),
(149, 34, '2020-01-02 17:15:44', 'commentaire 21', 139),
(150, 34, '2020-01-02 17:16:07', 'commentaire 21', 139),
(151, 34, '2020-01-02 17:16:37', 'commentaire 21', 139),
(152, 34, '2020-01-02 17:16:52', 'commentaire 21', 139),
(153, 34, '2020-01-02 17:17:08', 'commentaire 21', 139),
(154, 34, '2020-01-02 17:18:11', 'commentaire 21', 139),
(155, 34, '2020-01-02 17:18:48', 'commentaire 21', 139),
(156, 34, '2020-01-02 17:19:09', 'commentaire 21', 139),
(157, 34, '2020-01-02 17:19:42', 'commentaire 21', 139),
(158, 34, '2020-01-02 17:20:07', 'commentaire 21', 139),
(159, 34, '2020-01-02 17:20:22', 'commentaire 21', 139),
(160, 34, '2020-01-02 17:20:33', 'commentaire 21', 139),
(161, 34, '2020-01-02 17:20:43', 'commentaire 21', 139),
(162, 34, '2020-01-02 17:21:06', 'commentaire 21', 139),
(163, 34, '2020-01-02 17:21:19', 'commentaire 21', 139),
(164, 34, '2020-01-02 17:21:52', 'commentaire 21', 139),
(165, 34, '2020-01-02 17:22:10', 'commentaire 21', 139),
(166, 34, '2020-01-02 17:22:26', 'commentaire 21', 139),
(167, 34, '2020-01-02 17:22:37', 'commentaire 21', 139),
(168, 34, '2020-01-02 17:32:29', 'commentaire 21', 139),
(169, 34, '2020-01-02 17:33:21', 'commentaire 21', 139),
(170, 34, '2020-01-02 17:34:03', 'commentaire 21', 139),
(171, 34, '2020-01-02 17:35:29', 'commentaire 21', 139),
(172, 34, '2020-01-02 17:35:45', 'commentaire 21', 139),
(173, 34, '2020-01-02 17:36:01', 'commentaire 21', 139),
(174, 34, '2020-01-02 17:36:25', 'commentaire 21', 139),
(175, 34, '2020-01-02 17:40:15', 'commentaire 21', 139),
(176, 34, '2020-01-02 17:40:31', 'commentaire 21', 139),
(177, 34, '2020-01-02 17:41:41', 'commentaire 21', 139),
(178, 34, '2020-01-02 17:41:56', 'commentaire 21', 139),
(179, 34, '2020-01-02 17:42:16', 'commentaire 21', 139),
(180, 34, '2020-01-02 17:42:42', 'commentaire 21', 139),
(181, 34, '2020-01-02 17:42:56', 'commentaire 21', 139),
(182, 34, '2020-01-02 21:27:07', 'commentaire 21', 139),
(183, 33, '2020-01-04 08:08:07', 'ceci est mon premier commentaire sur cette article.', 139),
(184, 33, '2020-01-06 05:24:33', 'coucoucoucou voir si l vue adaptative fonctionne', 139),
(185, 33, '2020-01-06 05:26:34', 'coucoucoucou voir si l vue adaptative fonctionne', 139),
(186, 33, '2020-01-06 05:27:07', 'coucoucoucou voir si l vue adaptative fonctionne', 139),
(187, 33, '2020-01-06 05:30:54', 'coucoucoucou voir si l vue adaptative fonctionne', 139),
(188, 33, '2020-01-06 05:35:30', 'coucoucoucou voir si l vue adaptative fonctionne', 139),
(189, 33, '2020-01-06 05:35:55', 'difhdshsmohsm', 139);

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
  `content` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_article_fk` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `user_id`, `title`, `chapo`, `content`, `date_create`) VALUES
(1, 139, 'première figure', 'boujours voila la première figure', 'ceci et le contenu de la première figure', '2019-12-19 05:59:29'),
(2, 139, 'figure 2', 'chapo de la figure 2', 'contenu de la figure 2', '2019-12-20 09:25:01'),
(22, 139, 'titre numero4', 'chapo numero4', 'contenu numero 4', '2019-12-20 13:22:45'),
(15, 121, 'mljh', 'mugi', 'mugù', '2019-12-06 17:01:29'),
(24, 139, 'dsfdshfds', 'moihmohl', 'mlhmol', '2019-12-20 15:19:09'),
(23, 139, 'titre 4', 'chapo 4', 'contenu 4', '2019-12-20 15:18:34'),
(25, 139, 'coucou', 'mkglkglkghljgh', 'mkglhglugyflufmlfumljufuml', '2019-12-20 15:31:58'),
(26, 139, 'titre huit', 'chapo huit', 'contenu huit', '2019-12-20 16:44:58'),
(27, 139, 'oihmouhmou', 'sdfdf', 'qsdfd', '2019-12-20 17:13:08'),
(35, 139, 'article numero 16', 'sdmlqsjfmùjdsmùhjdsùljkpùjoih', 'sdfgszegjoerkghpekrghpi^zelrfhdsizkelrfchxusipzefcgxhsokl', '2019-12-31 18:13:15'),
(29, 139, 'slaut a tous', 'qdzfzf', 'qdzfzf', '2019-12-20 17:20:14'),
(30, 139, 'fdsvvxcds', 'ddsdsd', 'dfdfg', '2020-01-17 15:29:12'),
(31, 139, 'coucou', 'df', 'sdfg', '2019-12-20 20:17:54'),
(32, 139, 'ohmh', 'sdfg', 'qsdfgh', '2019-12-20 20:37:20'),
(33, 139, 'djklfhmfohdsfmdhfdsùfdsfd', 'sdfghjkjhgfds', 'qsdfghjkjhgfdsqsdfghjgfdsqdfghjkjhgfd', '2020-01-17 14:31:08'),
(34, 139, 'dsfezhfmehu', 'dffhfkjh', 'sqfhfmqsdzabhemobmfob', '2020-01-17 15:26:26'),
(36, 139, 'voir lien', 'erty', 'ertyuyt', '2020-01-12 17:41:54');

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
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`id`, `article_id`, `link`) VALUES
(2, 4, 'https://www.youtube.com/embed/kfREmR2f2M8'),
(5, 6, 'https://www.youtube.com/embed/EIC1_0Dfa9o'),
(6, 8, 'https://www.youtube.com/watch?v=Te-WtYdr7y8'),
(7, 9, 'https://www.youtube.com/watch?v=Te-WtYdr7y8'),
(8, 10, 'https://www.youtube.com/watch?v=Te-WtYdr7y8'),
(9, 11, 'https://www.youtube.com/watch?v=Te-WtYdr7y8'),
(10, 12, 'https://www.youtube.com/watch?v=Te-WtYdr7y8'),
(11, 13, 'https://www.youtube.com/watch?v=Te-WtYdr7y8'),
(12, 14, 'https://www.youtube.com/watch?v=Te-WtYdr7y8'),
(17, 22, 'https://www.youtube.com/embed/tIOpP4VLDqg'),
(19, 23, 'htt://dslfdshfmdhfm'),
(20, 25, 'https://www.youtube.com/embed/5AkIDP3BT6Q'),
(21, 26, 'http://lien'),
(22, 29, 'http://sfsdg'),
(25, 33, 'https://www.youtube.com/embed/InBM3R_5I20'),
(32, 36, 'https://www.youtube.com/embed/GqP0XNzykW0'),
(35, 30, 'https://www.youtube.com/embed/JU9wwQAxrXg');

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
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id`, `article_id`, `name`, `extension`, `description`) VALUES
(1, 1, 'mute', 'jpg', 'photo figure un'),
(6, 4, '2019_11_16_18_57_24-5dd04694a4b59', 'jpeg', 'photo_2019_11_16_18_57_24-5dd04694a4b59'),
(51, 34, '2020_01_17_14_43_36-5e21c81861c4e', 'jpeg', 'photo_2020_01_17_14_43_36-5e21c81861c4e'),
(29, 2, '2019_12_20_09_25_01-5dfc936d3b4fd', 'jpeg', 'photo_2019_12_20_09_25_01-5dfc936d3b4fd'),
(7, 4, '2019_11_16_18_57_24-5dd04694a5368', 'jpeg', 'photo_2019_11_16_18_57_24-5dd04694a5368'),
(8, 5, '5de4a58b323a2', 'jpeg', 'photo_5de4a58b323a2'),
(9, 5, '5de4a5888103a', 'jpeg', 'photo_5de4a5888103a'),
(12, 7, '2019_12_06_16_22_19-5dea803bbbc7d', 'jpeg', 'photo_2019_12_06_16_22_19-5dea803bbbc7d'),
(30, 22, '5dfcbf4d8fcdf', 'jpeg', 'photo_5dfcbf4d8fcdf'),
(14, 9, '2019_12_06_16_37_34-5dea83ce08e85', 'jpeg', 'photo_2019_12_06_16_37_34-5dea83ce08e85'),
(15, 10, '2019_12_06_16_45_23-5dea85a313ce5', 'jpeg', 'photo_2019_12_06_16_45_23-5dea85a313ce5'),
(16, 11, '2019_12_06_16_51_32-5dea871452dd6', 'jpeg', 'photo_2019_12_06_16_51_32-5dea871452dd6'),
(17, 12, '2019_12_06_16_52_45-5dea875d2fabb', 'jpeg', 'photo_2019_12_06_16_52_45-5dea875d2fabb'),
(18, 13, '2019_12_06_16_54_54-5dea87de7907c', 'jpeg', 'photo_2019_12_06_16_54_54-5dea87de7907c'),
(19, 14, '2019_12_06_16_58_25-5dea88b1cf79f', 'jpeg', 'photo_2019_12_06_16_58_25-5dea88b1cf79f'),
(24, 19, '2019_12_18_15_27_59-5dfa457fca689', 'jpeg', 'photo_2019_12_18_15_27_59-5dfa457fca689'),
(49, 33, '2020_01_17_14_31_08-5e21c52c5601b', 'png', 'photo_2020_01_17_14_31_08-5e21c52c5601b'),
(32, 23, '2019_12_20_15_18_34-5dfce64a0f46f', 'jpeg', 'photo_2019_12_20_15_18_34-5dfce64a0f46f'),
(33, 25, '5dfceb7254eae', 'jpeg', 'photo_5dfceb7254eae'),
(34, 26, '2019_12_20_16_44_58-5dfcfa8a53dda', 'jpeg', 'photo_2019_12_20_16_44_58-5dfcfa8a53dda'),
(35, 27, '2019_12_20_17_13_08-5dfd01245ee7e', 'jpeg', 'photo_2019_12_20_17_13_08-5dfd01245ee7e'),
(45, 35, '5e21800114d43', 'jpeg', 'photo_5e21800114d43'),
(37, 29, '5e0a088e4abb0', 'jpeg', 'photo_5e0a088e4abb0'),
(38, 30, '5e21d3196cd49', 'jpeg', 'photo_5e21d3196cd49'),
(39, 31, '2019_12_20_20_17_54-5dfd2c727317d', 'jpeg', 'photo_2019_12_20_20_17_54-5dfd2c727317d'),
(40, 32, '2019_12_20_20_37_20-5dfd31007085c', 'jpeg', 'photo_2019_12_20_20_37_20-5dfd31007085c'),
(41, 33, '5e1a2b9a2680d', 'jpeg', 'photo_5e1a2b9a2680d'),
(48, 33, '2020_01_17_14_31_08-5e21c52c5581f', 'jpeg', 'photo_2020_01_17_14_31_08-5e21c52c5581f'),
(46, 34, '5e21877ba0c5d', 'jpeg', 'photo_5e21877ba0c5d'),
(50, 34, '2020_01_17_14_43_36-5e21c818614a2', 'jpeg', 'photo_2020_01_17_14_43_36-5e21c818614a2');

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
) ENGINE=MyISAM AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `date_create`, `password`, `confirmation`, `picture`, `presentation`, `roles`, `confirmation_key`) VALUES
(139, 'mickdu62200@gmail.com', 'garret', '2019-12-08 09:39:30', '$argon2i$v=19$m=1024,t=2,p=2$WXFnZ1BUZ0pyckpOV2poVg$OXdEvNK8EyPF/HL5VK25RU3Dy2B+B1bmUReqcRXregw', 1, '2019_12_08_09_39_30-5decc4d27d54a.jpeg', 'coucou sa va bien', '[]', '4130401d20c370bad59c608b22ed7770'),
(150, 'michael.garret.france@gmail.com', 'azedf', '2020-01-16 14:59:57', '$argon2i$v=19$m=1024,t=2,p=2$SVJhbURYbVlwLmN5M1o2RA$zf2L3Trb4goMqo2iRnJn9ia/tbsaG1ONwCR0CMnZKuU', 0, '2020_01_16_14_59_57-5e207a6de946c.jpeg', 'zef', '[]', '8db5720b25b7796d63611cd6e8d719ad');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
