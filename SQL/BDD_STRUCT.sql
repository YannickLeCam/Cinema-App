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


-- Listage de la structure de la base pour cinema-lecam
CREATE DATABASE IF NOT EXISTS `cinema-lecam` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema-lecam`;

-- Listage de la structure de table cinema-lecam. actor
CREATE TABLE IF NOT EXISTS `actor` (
  `id_actor` int NOT NULL AUTO_INCREMENT,
  `id_person` int NOT NULL,
  PRIMARY KEY (`id_actor`),
  UNIQUE KEY `id_person` (`id_person`),
  CONSTRAINT `FK_actor_person` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema-lecam.actor : ~5 rows (environ)
INSERT IGNORE INTO `actor` (`id_actor`, `id_person`) VALUES
	(5, 1),
	(1, 2),
	(2, 4),
	(3, 6),
	(4, 8);

-- Listage de la structure de table cinema-lecam. be
CREATE TABLE IF NOT EXISTS `be` (
  `id_movie` int NOT NULL,
  `id_type` int NOT NULL,
  PRIMARY KEY (`id_movie`,`id_type`),
  UNIQUE KEY `id_movie_id_type` (`id_movie`,`id_type`),
  KEY `FK_be_type` (`id_type`),
  CONSTRAINT `FK__movie_be` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_be_type` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema-lecam.be : ~0 rows (environ)
INSERT IGNORE INTO `be` (`id_movie`, `id_type`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(6, 6);

-- Listage de la structure de table cinema-lecam. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `id_actor` int NOT NULL,
  `id_movie` int NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id_actor`,`id_movie`,`id_role`),
  UNIQUE KEY `id_actor_id_movie_id_role` (`id_actor`,`id_movie`,`id_role`),
  KEY `FK_casting_movie` (`id_movie`),
  KEY `FK_casting_role` (`id_role`),
  CONSTRAINT `FK_casting_actor` FOREIGN KEY (`id_actor`) REFERENCES `actor` (`id_actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_casting_movie` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_casting_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema-lecam.casting : ~0 rows (environ)
INSERT IGNORE INTO `casting` (`id_actor`, `id_movie`, `id_role`) VALUES
	(1, 1, 2),
	(2, 1, 1),
	(1, 2, 1),
	(2, 2, 3),
	(1, 3, 4),
	(2, 3, 5),
	(3, 4, 6),
	(4, 4, 7),
	(1, 5, 8),
	(2, 5, 9),
	(3, 6, 4),
	(4, 6, 5);

-- Listage de la structure de table cinema-lecam. director
CREATE TABLE IF NOT EXISTS `director` (
  `id_director` int NOT NULL AUTO_INCREMENT,
  `id_person` int NOT NULL,
  PRIMARY KEY (`id_director`),
  UNIQUE KEY `id_person` (`id_person`),
  CONSTRAINT `FK_director_person` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema-lecam.director : ~4 rows (environ)
INSERT IGNORE INTO `director` (`id_director`, `id_person`) VALUES
	(1, 1),
	(2, 3),
	(3, 5),
	(4, 7);

-- Listage de la structure de table cinema-lecam. movie
CREATE TABLE IF NOT EXISTS `movie` (
  `id_movie` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date_release` date NOT NULL,
  `duration` int NOT NULL,
  `synopsis` mediumtext NOT NULL,
  `poster` text NOT NULL,
  `rate` decimal(2,1) NOT NULL DEFAULT '0.0',
  `id_director` int NOT NULL,
  PRIMARY KEY (`id_movie`),
  KEY `FK_movie_director` (`id_director`),
  CONSTRAINT `FK_movie_director` FOREIGN KEY (`id_director`) REFERENCES `director` (`id_director`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema-lecam.movie : ~0 rows (environ)
INSERT IGNORE INTO `movie` (`id_movie`, `name`, `date_release`, `duration`, `synopsis`, `poster`, `rate`, `id_director`) VALUES
	(1, 'Epic Adventure', '2023-06-01', 120, 'An epic adventure of discovery and courage.', 'poster1.jpg', 8.5, 1),
	(2, 'Romantic Escape', '2023-02-14', 95, 'A love story that transcends time.', 'poster2.jpg', 7.8, 2),
	(3, 'Mystery Thriller', '2023-09-10', 150, 'A thrilling mystery that keeps you on the edge of your seat.', 'poster3.jpg', 8.2, 3),
	(4, 'Sci-Fi Odyssey', '2023-12-20', 200, 'A journey through space and time.', 'poster4.jpg', 9.0, 4),
	(5, 'Comedy Night', '2023-07-18', 85, 'A night full of laughs and surprises.', 'poster5.jpg', 7.5, 3),
	(6, 'Historical Drama', '2023-11-05', 180, 'A poignant drama set in historical times.', 'poster6.jpg', 8.8, 4);

-- Listage de la structure de table cinema-lecam. person
CREATE TABLE IF NOT EXISTS `person` (
  `id_person` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `birthday` date NOT NULL,
  `genre` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_person`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema-lecam.person : ~8 rows (environ)
INSERT IGNORE INTO `person` (`id_person`, `name`, `firstname`, `birthday`, `genre`) VALUES
	(1, 'Smith', 'John', '1980-05-15', 'Male'),
	(2, 'Doe', 'Jane', '1990-08-25', 'Female'),
	(3, 'Brown', 'Charlie', '1975-12-01', 'Male'),
	(4, 'Johnson', 'Emily', '1985-03-22', 'Female'),
	(5, 'Davis', 'Mark', '1982-10-10', 'Male'),
	(6, 'Taylor', 'Anna', '1995-05-20', 'Female'),
	(7, 'White', 'Chris', '1978-11-11', 'Male'),
	(8, 'King', 'Laura', '1983-04-12', 'Female');

-- Listage de la structure de table cinema-lecam. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema-lecam.role : ~0 rows (environ)
INSERT IGNORE INTO `role` (`id_role`, `name`) VALUES
	(6, 'Captain Kirk'),
	(5, 'Dr. Watson'),
	(2, 'Elizabeth Swann'),
	(9, 'Harley Quinn'),
	(1, 'Jack Sparrow'),
	(8, 'Joker'),
	(4, 'Sherlock Holmes'),
	(7, 'Spock'),
	(3, 'Will Turner');

-- Listage de la structure de table cinema-lecam. type
CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_type`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema-lecam.type : ~0 rows (environ)
INSERT IGNORE INTO `type` (`id_type`, `name`) VALUES
	(1, 'Action'),
	(5, 'Comedy'),
	(6, 'Drama'),
	(2, 'Romance'),
	(4, 'Sci-Fi'),
	(3, 'Thriller');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
