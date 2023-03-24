-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.31 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour pintviewv1
DROP DATABASE IF EXISTS `pintviewv1`;
CREATE DATABASE IF NOT EXISTS `pintviewv1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pintviewv1`;

-- Listage de la structure de la table pintviewv1. activitestatus
DROP TABLE IF EXISTS `activitestatus`;
CREATE TABLE IF NOT EXISTS `activitestatus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `createdAt` datetime NOT NULL,
  `content` text,
  `user_id` int DEFAULT NULL,
  `media_url` text,
  `media_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_USERS` (`user_id`),
  CONSTRAINT `activitestatus_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

-- Listage des données de la table pintviewv1.activitestatus : ~0 rows (environ)
/*!40000 ALTER TABLE `activitestatus` DISABLE KEYS */;
/*!40000 ALTER TABLE `activitestatus` ENABLE KEYS */;

-- Listage de la structure de la table pintviewv1. comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `createdAt` datetime NOT NULL,
  `content` text NOT NULL,
  `user_id` int NOT NULL,
  `status_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

-- Listage des données de la table pintviewv1.comments : ~20 rows (environ)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `createdAt`, `content`, `user_id`, `status_id`) VALUES
	(80, '2023-03-24 06:54:46', 'Ca va ? T&#39;es tombé sur la tête ? Un humain à écris à ta place ?', 24, 150),
	(81, '2023-03-24 06:56:22', 'Oula, t&#39;es bizarre toi, regardes le règlement s&#39;il te plait. Fermeture du topic', 25, 150),
	(82, '2023-03-24 06:57:45', 'Par rapport aux nouvelles lois sur led griffes dépassant les 4 cm ? ', 25, 151),
	(83, '2023-03-24 06:59:41', 'Woow ! Ca craint! J&#39;espère qu&#39;ils vont vite te rembourser ! ', 26, 151),
	(84, '2023-03-24 07:01:03', 'S&#39;il vous plait me dites pas Candia , c&#39;est dégueuuu', 26, 152),
	(85, '2023-03-24 07:01:19', 'T&#39;es bizarre mec . .', 26, 150),
	(86, '2023-03-24 07:02:56', 'T&#39;as essayé le &#34;ExtracatLacto&#34; Il est incroyaable ! ', 27, 152),
	(87, '2023-03-24 07:03:37', 'Contact la litière service client ! Il répondent jusqu&#39;a 22h00 ', 27, 151),
	(88, '2023-03-24 07:05:18', 'Le but de ce meeting est de ce préparé à manger nos humains, ainsi qu&#39;a les esclavagé', 27, 153),
	(89, '2023-03-24 07:06:53', 'Mais reveillez moi le lui..', 28, 150),
	(90, '2023-03-24 07:07:27', 'J&#39;en vient moi, tout pareil que toi, dégouter même pas une croquette pour l&#39;attente..', 28, 151),
	(91, '2023-03-24 07:08:10', 'Le DolceLacto évidement ! Même le chat potté en est fou ', 28, 152),
	(92, '2023-03-24 07:08:36', 'C&#39;est quand ? ça m&#39;interresse !', 28, 153),
	(93, '2023-03-24 07:10:46', 'C&#39;est bon arretez de polluer le topic il va être fermé !', 29, 150),
	(94, '2023-03-24 07:11:21', 'Toujours la même avec ses services, ça avait mit 3 mois pour moi !', 29, 151),
	(95, '2023-03-24 07:11:44', '+1000 pour le DolceLacto ! ', 29, 152),
	(96, '2023-03-24 07:12:16', 'Idem je suis chaud! Y&#39;aura de la pâté ?', 29, 153),
	(97, '2023-03-24 07:12:41', 'GOOOOO', 23, 153),
	(98, '2023-03-24 07:13:06', 'Je voit pas ce que tu trouves de mal au Candia en fait !', 23, 152),
	(99, '2023-03-24 07:13:57', 'Catcaf.mew.fr/  avec ce site tu pourras faire une réclamation', 23, 151);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Listage de la structure de la table pintviewv1. santestatus
DROP TABLE IF EXISTS `santestatus`;
CREATE TABLE IF NOT EXISTS `santestatus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `createdAt` datetime NOT NULL,
  `content` text,
  `user_id` int DEFAULT NULL,
  `media_url` text,
  `media_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_USERS` (`user_id`),
  CONSTRAINT `santestatus_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

-- Listage des données de la table pintviewv1.santestatus : ~0 rows (environ)
/*!40000 ALTER TABLE `santestatus` DISABLE KEYS */;
/*!40000 ALTER TABLE `santestatus` ENABLE KEYS */;

-- Listage de la structure de la table pintviewv1. sportstatus
DROP TABLE IF EXISTS `sportstatus`;
CREATE TABLE IF NOT EXISTS `sportstatus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `createdAt` datetime NOT NULL,
  `content` text,
  `user_id` int DEFAULT NULL,
  `media_url` text,
  `media_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_USERS` (`user_id`),
  CONSTRAINT `sportstatus_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

-- Listage des données de la table pintviewv1.sportstatus : ~2 rows (environ)
/*!40000 ALTER TABLE `sportstatus` DISABLE KEYS */;
INSERT INTO `sportstatus` (`id`, `createdAt`, `content`, `user_id`, `media_url`, `media_type`) VALUES
	(148, '2023-03-22 09:39:20', 'dd', 20, NULL, 'video'),
	(149, '2023-03-22 09:39:37', 'szz', 20, NULL, 'video');
/*!40000 ALTER TABLE `sportstatus` ENABLE KEYS */;

-- Listage de la structure de la table pintviewv1. status
DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `createdAt` datetime NOT NULL,
  `content` text,
  `user_id` int DEFAULT NULL,
  `media_url` text,
  `media_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_USERS` (`user_id`),
  CONSTRAINT `status_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=latin1;

-- Listage des données de la table pintviewv1.status : ~4 rows (environ)
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id`, `createdAt`, `content`, `user_id`, `media_url`, `media_type`) VALUES
	(150, '2023-03-24 06:49:08', 'dddd [FERMÉ]', 23, NULL, 'video'),
	(151, '2023-03-24 06:54:01', 'La meow CAF ne veux pas m&#39;indemniser', 24, NULL, 'video'),
	(152, '2023-03-24 07:00:31', 'Recherche lait d&#39;exception', 26, NULL, 'video'),
	(153, '2023-03-24 07:04:45', 'CatMeeting contre les humains', 27, NULL, 'video');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Listage de la structure de la table pintviewv1. users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Listage des données de la table pintviewv1.users : ~8 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `description`, `avatar`) VALUES
	(20, 'mew', 'mew', 'thomasrussopro@gmail.com', '$2y$10$kj233bBxFMMJfxvnXXBJLOSFQKgL8psChkLli.0LH8u0r3dRVc4Y.', '4 pattes', 'https://images.unsplash.com/photo-1676910226586-eb747ab85443?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80'),
	(23, 'mew1', 'mew', 'mew@mew.fr', '$2y$10$7Rbe2ZJuMRtfgi0ycXLkQuQ8ljlwb0XS6Zk9bd1iYJmrXTPBI5WiK', '4 pattes', 'https://images.unsplash.com/photo-1676910226586-eb747ab85443?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80'),
	(24, 'mew2', 'mew', 'mew@mew2.fr', '$2y$10$nORz4qDeNC0a8Kh4W/tzR.vlHBVtxDr4n6HbC61EXeZUpTM0QHgly', '4 pattes', 'https://images.unsplash.com/photo-1676910226586-eb747ab85443?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80'),
	(25, 'ADMIN', 'CAT', 'mew@mew3.fr', '$2y$10$03L9qpvXigUSgBQZ68bB.O41oFZ.uewD6DKJHS890SSfL3G7xoBla', '4 pattes', 'http://www.petelevage.com/blog/wp-content/uploads/2016/04/Image41-181x300.png'),
	(26, 'mew4', 'mew', 'mew@mew4.fr', '$2y$10$9/AAwLy1/.btiQZhBHjJBOQ9LXBQoioEoAQ8Ac0joF84SjpfdvPwy', '4 pattes', 'http://blog.planete-nextgen.com/wp-content/uploads/2014/01/chat-combat-2.jpg'),
	(27, 'mew5', 'mew', 'mew@mew5.fr', '$2y$10$rbjnF/AFZhz5qMucN3nIj.zrxS1449BM6el8lFpWwDDwlkwIF.Vau', '4 pattes', 'https://static.wikia.nocookie.net/heros/images/7/76/Happy_Anime_S2.png/revision/latest?cb=20210409230824&path-prefix=fr'),
	(28, 'mew6', 'mew', 'mew@mew6.fr', '$2y$10$g1cPgLqLfTgu0FLwoPaxL.ZRGADANM7mC9T3gT2Da0vKPOOUYTOSi', '4 pattes', 'https://photos.tf1info.fr/images/700/700/chat-illustre-1c4a8b-0@1x.jpeg'),
	(29, 'mew7', 'mew', 'mew@mew7.fr', '$2y$10$v3Zu9sfRE68iVIzNYPDhn.eOiYTtwenji3q.GTJ8YmvC/PKOI49kG', '4 pattes', 'https://images.ladepeche.fr/api/v1/images/view/63600c1986a82e7a5a29be4b/large/image.jpg?v=2');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
