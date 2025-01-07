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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table exo_forum_louis.category : ~6 rows (environ)
INSERT INTO `category` (`id_category`, `name`, `createdAt`, `updatedAt`) VALUES
	(1, 'Web', '2024-12-23 13:33:51', '2024-12-23 13:33:51'),
	(2, 'Mobile', '2024-12-23 13:33:56', '2024-12-23 13:33:56'),
	(3, 'Design', '2024-12-23 13:34:03', '2024-12-23 13:34:03'),
	(4, 'Network', '2024-12-23 13:35:00', '2024-12-23 13:35:00'),
	(5, 'Database', '2024-12-23 13:35:28', '2025-01-06 16:56:54'),
	(6, 'Other', '2024-12-23 13:35:37', '2024-12-23 13:35:37');

-- Listage de la structure de table exo_forum_louis. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `FK_user` (`user_id`),
  KEY `FK_topic` (`topic_id`),
  CONSTRAINT `FK_topic_post` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE,
  CONSTRAINT `FK_user_post` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table exo_forum_louis.post : ~5 rows (environ)
INSERT INTO `post` (`id_post`, `content`, `createdAt`, `updatedAt`, `user_id`, `topic_id`) VALUES
	(2, 'Hello man !', '2025-01-06 11:51:12', '2025-01-06 13:51:37', 4, 15),
	(3, 'Yooooo', '2025-01-06 13:44:35', '2025-01-06 13:44:35', 4, 15),
	(4, 'Test post response', '2025-01-06 14:05:24', '2025-01-06 14:05:24', 4, 15),
	(5, 'You can&#039;t i&#039;m sorry :/', '2025-01-06 14:07:55', '2025-01-06 14:07:55', NULL, 15),
	(6, 'Why don&#039;t you just google it ?....', '2025-01-06 14:10:43', '2025-01-06 14:10:43', NULL, 14);

-- Listage de la structure de table exo_forum_louis. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table exo_forum_louis.topic : ~16 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `content`, `isLocked`, `createdAt`, `updatedAt`, `user_id`, `category_id`) VALUES
	(1, 'How to start learning Python?', 'I am new to programming and would like some advice on learning Python. Any tips?', 0, '2022-12-01 10:00:00', '2024-12-23 16:10:22', NULL, 1),
	(2, 'Best practices for responsive web design?', 'What are some best practices to make a website mobile-friendly?', 0, '2024-12-02 11:15:00', '2024-12-23 14:29:35', 4, 2),
	(3, 'Difference between SQL and NoSQL?', 'Could someone explain the main differences between SQL and NoSQL databases?', 0, '2024-12-03 09:30:00', '2024-12-23 16:10:40', 7, 5),
	(4, 'How to optimize page load speed?', 'My website is slow to load. What are the best ways to improve page load speed?', 0, '2024-12-04 14:00:00', '2025-01-01 15:41:50', NULL, 6),
	(5, 'Recommended JavaScript frameworks in 2024?', 'What are the top JS frameworks to learn this year?', 0, '2024-12-05 08:45:00', '2024-12-23 14:29:38', 4, 1),
	(6, 'Understanding Docker for beginners', 'What is Docker, and how can it help with software development?', 0, '2024-12-06 16:20:00', '2024-12-23 16:10:37', 7, 6),
	(7, 'Should I learn React or Vue?', 'I am deciding between React and Vue for a project. Which one is better for beginners?', 0, '2024-12-07 10:10:00', '2025-01-01 15:53:35', 4, 1),
	(8, 'Advantages of using TypeScript?', 'Why should I consider using TypeScript over plain JavaScript?', 0, '2024-12-08 12:50:00', '2024-12-23 16:10:34', 8, 1),
	(9, 'How to set up a secure REST API?', 'What are the steps to secure a REST API for production?', 0, '2024-12-09 09:00:00', '2025-01-01 15:53:36', 4, 1),
	(10, 'Tips for debugging code effectively', 'How can I improve my debugging skills?', 0, '2024-12-10 13:30:00', '2024-12-23 16:10:31', 8, 6),
	(11, 'What is GraphQL?', 'Can someone explain what GraphQL is and how it differs from REST?', 0, '2024-12-11 15:45:00', '2025-01-01 15:53:36', 4, 5),
	(12, 'How to implement authentication in Node.js?', 'What are the best practices for implementing authentication in a Node.js app?', 1, '2024-12-12 18:00:00', '2025-01-06 14:42:11', 4, 1),
	(13, 'CSS Grid vs Flexbox?', 'When should I use CSS Grid, and when should I use Flexbox?', 0, '2024-12-13 10:30:00', '2024-12-23 16:10:29', 6, 1),
	(14, 'How to contribute to open-source projects?', 'I am new to open source. How can I start contributing?', 1, '2024-12-14 11:20:00', '2025-01-06 14:55:17', 4, 6),
	(15, 'Learning path for backend development?', 'What is the best learning path to become a backend developer? I started a few days a ago but i can\'t find any ressources online... Can someone help me with that please ?', 1, '2024-12-15 08:00:00', '2025-01-06 14:45:50', 4, 1),
	(20, 'Help me ehgfief', 'sgekhisoieghsoieg', 1, '2025-01-07 08:35:38', '2025-01-07 08:36:12', 4, 3);

-- Listage de la structure de table exo_forum_louis. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(90) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `roles` varchar(255) DEFAULT NULL,
  `isBanned` tinyint NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table exo_forum_louis.user : ~4 rows (environ)
INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `roles`, `isBanned`, `createdAt`, `updatedAt`) VALUES
	(4, 'Jean45', 'jean45@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VjlCQjhFMzdEUDQxUTk3bQ$aqjFomQY9frYGqW7Xeg39iV9C+6DlvAilyW+1PtPMUA', 'ROLE_ADMIN', 0, '2024-12-19 19:26:06', '2025-01-06 14:19:27'),
	(6, 'pufto', 'lopuf@hotmail.fr', '$argon2id$v=19$m=65536,t=4,p=1$VjlCQjhFMzdEUDQxUTk3bQ$aqjFomQY9frYGqW7Xeg39iV9C+6DlvAilyW+1PtPMUA', NULL, 0, '2024-12-23 15:53:55', '2025-01-07 08:42:52'),
	(7, 'souma7', 'soum789@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VjlCQjhFMzdEUDQxUTk3bQ$aqjFomQY9frYGqW7Xeg39iV9C+6DlvAilyW+1PtPMUA', NULL, 0, '2024-12-23 15:54:09', '2025-01-06 16:07:29'),
	(8, 'Mathis', 'mathis@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VjlCQjhFMzdEUDQxUTk3bQ$aqjFomQY9frYGqW7Xeg39iV9C+6DlvAilyW+1PtPMUA', NULL, 0, '2024-12-23 15:54:26', '2024-12-23 15:54:28');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
