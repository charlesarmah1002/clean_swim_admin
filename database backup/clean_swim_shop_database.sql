-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: php_mvc_tutorial
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `p_category` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (17,'Swimming Pool Protective Gear','2024-05-03 20:32:52','2024-05-03 20:32:52'),(18,'Swimming Pool Pumps ','2024-05-06 17:38:26','2024-05-06 17:38:26'),(19,'Sand Filters & Multi-ports','2024-05-06 17:38:59','2024-05-06 17:38:59');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `p_name` varchar(255) DEFAULT NULL,
  `p_price` decimal(20,2) DEFAULT '0.00',
  `p_description` varchar(1600) DEFAULT NULL,
  `c_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `p_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `c_id_idx` (`c_id`),
  CONSTRAINT `c_id` FOREIGN KEY (`c_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (2,'Swimming Pool Pump 3.0HP',1200.00,'                        <p style=\"text-align: center;\"><span style=\"text-decoration: underline;\"><strong>Now I have to add something that resembles what it would look like in the real world</strong></span></p>\r\n<p>There is a lot to be said about Mr. \"I want to be the Pirate King over here\". He\'s not exactly the brightest anime character to be created but for a May born who\'s a dunce I think he\'s doing alright bringing smiles to his viewers. Although he\'s not the favorite character for everyone who has followed One Piece so far.</p>\r\n<p> </p>                    ',17,'2024-05-06 16:37:41','2024-05-07 16:41:44','Swimming Pool Pump 3.0HP663a3da603305.jpg'),(3,'Vacuum Head',350.00,'<p>I miss having to do stuff, I just sit around all day typing and edit</p>',19,'2024-05-06 18:39:13','2024-05-06 18:39:13','Vacuum Head663907aa908ae.jpg'),(5,'Charles Wesley',1000000000.00,'<p>Yeah I am on sale too you know</p>\r\n<h2><strong>Charles Wesley</strong></h2>\r\n<p>I don\'t know why I shouldn\'t be on sale. I mean, I am handsome and all that but I still haven\'t clapped any ass and I find that to be fucking concerning you know.<br></p>',19,'2024-05-06 18:45:32','2024-05-06 18:45:32','Charles Wesley6639091be21aa.jpg'),(6,'Something very unrelated to what I intend on selling',12000.00,'<h1 style=\"text-align: center;\"><strong>Selling Something That Might As Well Be Breakfast For Customers</strong></h1>\r\n<p>Making customers buy their breakfast using the website might as well be the thing that we all need.</p>\r\n<p>I think that it\'s a nice idea to make it possible for customers who plan on making a pick up at the shop buy what they want to eat before they get to the shop. Like Starbucks in Pool Glory Online.</p>',18,'2024-05-13 20:16:47','2024-05-13 20:16:47','664258db2f915.png');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country_code` varchar(45) DEFAULT NULL,
  `phone` int DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (63,'Charles','Wesley','charlesarmah.dev@gmail.com','+233',549708561,'$2y$10$CUmZP01WFOnpA/X4ODNGdOrnL268EVv0UBA7FN7h8cNzXa6k3hNb.','2024-04-26 17:53:40','2024-04-26 17:53:40',1),(64,'Emmanuel','Armah','emmap26@gmail.com','+233',548083618,'$2y$10$QZAV2YCz95kHRaNjd2Sdvus/jRd/PVHySG7IAxPbXm8lRYe/Uv7j.','2024-05-02 19:50:55','2024-05-02 19:50:55',1),(65,'Esther','Crazy','charlesarmahdev@gmail.com','+233',553874796,'$2y$10$JB4997Jo00M5a72f3/Fd7ePsqUBhGqxkslp7OSq1.OkiIutSE3eMe','2024-05-02 19:54:21','2024-05-02 19:54:21',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-13 19:22:39
