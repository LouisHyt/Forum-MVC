-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour exo_forum_louis
CREATE DATABASE IF NOT EXISTS `exo_forum_louis` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `exo_forum_louis`;

-- Listage de la structure de table exo_forum_louis. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_category`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table exo_forum_louis.category : ~6 rows (environ)
INSERT INTO `category` (`id_category`, `name`, `createdAt`, `updatedAt`) VALUES
	(1, 'Web', '2024-12-23 13:33:51', '2024-12-23 13:33:51'),
	(2, 'Mobile', '2024-12-23 13:33:56', '2024-12-23 13:33:56'),
	(3, 'Design', '2024-12-23 13:34:03', '2024-12-23 13:34:03'),
	(4, 'Network', '2024-12-23 13:35:00', '2024-12-23 13:35:00'),
	(5, 'Database', '2024-12-23 13:35:28', '2024-12-23 13:35:28'),
	(6, 'Other', '2024-12-23 13:35:37', '2024-12-23 13:35:37');

-- Listage de la structure de table exo_forum_louis. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `FK_user` (`user_id`),
  KEY `FK_topic` (`topic_id`),
  CONSTRAINT `FK_topic_post` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE,
  CONSTRAINT `FK_user_post` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table exo_forum_louis.post : ~0 rows (environ)
INSERT INTO `post` (`id_post`, `content`, `createdAt`, `updatedAt`, `user_id`, `topic_id`) VALUES
	(41, 'Je suis totalement d\'accord avec ce point de vue, c\'est très pertinent !', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 4, 1),
	(42, 'Pouvez-vous préciser votre idée sur ce sujet ?', '2024-12-24 09:03:02', '2024-12-24 09:03:18', 8, 1),
	(43, 'Voici une référence utile que j\'ai trouvée : https://example.com', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 5, 2),
	(44, 'Intéressant, mais je pense qu\'il y a une autre façon de voir les choses.', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 6, 2),
	(45, 'Merci pour l\'explication, ça m\'a beaucoup aidé !', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 5, 3),
	(46, 'J\'ai une question supplémentaire à ce sujet.', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 9, 3),
	(47, 'Pourriez-vous développer cette partie ?', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 5, 4),
	(48, 'Je ne suis pas sûr de comprendre, pouvez-vous reformuler ?', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 11, 4),
	(49, 'C\'est exactement ce que je cherchais, merci !', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 9, 5),
	(50, 'Voici mon point de vue sur la question.', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 5, 5),
	(51, 'Je crois qu\'il manque une étape dans votre raisonnement.', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 6, 6),
	(52, 'Merci pour votre réponse rapide.', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 8, 6),
	(53, 'Est-ce que quelqu\'un a testé cette approche ?', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 7, 7),
	(54, 'Voici un exemple qui illustre bien le propos.', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 11, 7),
	(55, 'Intéressant, je vais essayer cette solution.', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 5, 8),
	(56, 'Je pense que cela pourrait fonctionner dans un autre contexte.', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 6, 8),
	(57, 'J\'apprécie beaucoup cette discussion.', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 10, 9),
	(58, 'Une question similaire a été posée ici : https://exampleforum.com', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 6, 9),
	(59, 'C\'est une perspective fascinante !', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 7, 10),
	(60, 'Voici un document qui pourrait être utile : https://doc.example.com', '2024-12-24 09:03:02', '2024-12-24 09:03:02', 5, 10);

-- Listage de la structure de table exo_forum_louis. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `isLocked` tinyint NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `FK_topic_category` (`category_id`),
  KEY `FK_topic_user` (`user_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE SET NULL,
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table exo_forum_louis.topic : ~16 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `content`, `isLocked`, `createdAt`, `updatedAt`, `user_id`, `category_id`) VALUES
	(1, 'How to start learning Python?', 'I am new to programming and would like some advice on learning Python. Any tips?', 0, '2022-12-01 10:00:00', '2024-12-23 16:10:22', 5, 1),
	(2, 'Best practices for responsive web design?', 'What are some best practices to make a website mobile-friendly?', 1, '2024-12-02 11:15:00', '2024-12-24 11:50:11', 4, 2),
	(3, 'Difference between SQL and NoSQL?', 'Could someone explain the main differences between SQL and NoSQL databases?', 0, '2024-12-03 09:30:00', '2024-12-23 16:10:40', 7, 5),
	(4, 'How to optimize page load speed?', 'My website is slow to load. What are the best ways to improve page load speed?', 0, '2024-12-04 14:00:00', '2024-12-24 11:41:08', 11, 6),
	(5, 'Recommended JavaScript frameworks in 2024?', 'What are the top JS frameworks to learn this year?', 1, '2024-12-05 08:45:00', '2024-12-24 11:48:26', 4, 1),
	(6, 'Understanding Docker for beginners', 'What is Docker, and how can it help with software development?', 0, '2024-12-06 16:20:00', '2024-12-23 16:10:37', 7, 6),
	(7, 'Should I learn React or Vue?', 'I am deciding between React and Vue for a project. Which one is better for beginners?', 1, '2024-12-07 10:10:00', '2024-12-24 11:48:18', 4, 1),
	(8, 'Advantages of using TypeScript?', 'Why should I consider using TypeScript over plain JavaScript?', 0, '2024-12-08 12:50:00', '2024-12-23 16:10:34', 8, 1),
	(9, 'How to set up a secure REST API?', 'What are the steps to secure a REST API for production?', 1, '2024-12-09 09:00:00', '2024-12-24 11:47:33', 4, 1),
	(10, 'Tips for debugging code effectively', 'How can I improve my debugging skills?', 0, '2024-12-10 13:30:00', '2024-12-24 08:53:56', 9, 6),
	(11, 'What is GraphQL?', 'Can someone explain what GraphQL is and how it differs from REST?', 1, '2024-12-11 15:45:00', '2024-12-24 11:46:10', 4, 5),
	(12, 'How to implement authentication in Node.js?', 'What are the best practices for implementing authentication in a Node.js app?', 0, '2024-12-12 18:00:00', '2024-12-24 08:54:09', 9, 1),
	(13, 'CSS Grid vs Flexbox?', 'When should I use CSS Grid, and when should I use Flexbox?', 0, '2024-12-13 10:30:00', '2024-12-23 16:10:29', 6, 1),
	(14, 'How to contribute to open-source projects?', 'I am new to open source. How can I start contributing?', 1, '2024-12-14 11:20:00', '2024-12-24 11:43:34', 4, 6),
	(15, 'Learning path for backend development?', 'What is the best learning path to become a backend developer?', 0, '2024-12-15 08:00:00', '2024-12-24 08:53:59', 10, 1),
	(16, 'What am i doing here ?', 'Hello there', 0, '2024-12-23 15:18:43', '2024-12-23 16:10:27', 6, 3);

-- Listage de la structure de table exo_forum_louis. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(90) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `roles` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `isBanned` tinyint NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table exo_forum_louis.user : ~8 rows (environ)
INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `roles`, `isBanned`, `createdAt`, `updatedAt`) VALUES
	(4, 'Jean45', 'jean45@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VjlCQjhFMzdEUDQxUTk3bQ$aqjFomQY9frYGqW7Xeg39iV9C+6DlvAilyW+1PtPMUA', 'user', 0, '2024-12-19 19:26:06', '2024-12-24 10:02:15'),
	(5, 'Marine4', 'marine@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VjlCQjhFMzdEUDQxUTk3bQ$aqjFomQY9frYGqW7Xeg39iV9C+6DlvAilyW+1PtPMUA', 'user', 0, '2024-12-23 15:53:37', '2024-12-24 10:02:17'),
	(6, 'pufto', 'lopuf@hotmail.fr', '$argon2id$v=19$m=65536,t=4,p=1$VjlCQjhFMzdEUDQxUTk3bQ$aqjFomQY9frYGqW7Xeg39iV9C+6DlvAilyW+1PtPMUA', 'user', 0, '2024-12-23 15:53:55', '2024-12-24 10:02:20'),
	(7, 'souma7', 'soum789@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VjlCQjhFMzdEUDQxUTk3bQ$aqjFomQY9frYGqW7Xeg39iV9C+6DlvAilyW+1PtPMUA', 'user', 0, '2024-12-23 15:54:09', '2024-12-24 10:02:21'),
	(8, 'Mathis', 'mathis@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VjlCQjhFMzdEUDQxUTk3bQ$aqjFomQY9frYGqW7Xeg39iV9C+6DlvAilyW+1PtPMUA', 'user', 0, '2024-12-23 15:54:26', '2024-12-24 10:02:23'),
	(9, 'Loic', 'loic@yahoo.fr', '$argon2id$v=19$m=65536,t=4,p=1$VjlCQjhFMzdEUDQxUTk3bQ$aqjFomQY9frYGqW7Xeg39iV9C+6DlvAilyW+1PtPMUA', 'user', 0, '2024-12-24 08:48:26', '2024-12-24 10:02:25'),
	(10, 'Emmanuel', 'manu76@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VjlCQjhFMzdEUDQxUTk3bQ$aqjFomQY9frYGqW7Xeg39iV9C+6DlvAilyW+1PtPMUA', 'user', 0, '2024-12-24 08:48:52', '2024-12-24 10:02:27'),
	(11, 'Mickael', 'mickael@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VjlCQjhFMzdEUDQxUTk3bQ$aqjFomQY9frYGqW7Xeg39iV9C+6DlvAilyW+1PtPMUA', 'user', 0, '2024-12-24 08:53:03', '2024-12-24 10:02:28');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
