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
  `p_description` varchar(15000) DEFAULT NULL,
  `c_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `p_image` varchar(255) DEFAULT NULL,
  `stock` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `c_id_idx` (`c_id`),
  CONSTRAINT `c_id` FOREIGN KEY (`c_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (7,'This is also something that is very unrelated to the topic or to the mission provided',12.00,'<h3 style=\"text-align: center;\">This is me trying to make it look like I used the tinyMce for this one</h3><p>When it comes to writing HTML and css, I wouldn&#39;t say that I am very good at it even though I have been complimented by a lot of folks who tell me that I am a formidable one.</p><p>I am very emotional and arrogant and proud and a whole bunch of things people wish they could tell me and I bet they wouldn&#39;t considering the fact that I play a vital role in the lives people and I know that I am expendable. That is why I continue to get better and make myself needed the more. But I think it&#39;s about time I let myself be needed for profit which is something that I don&#39;t know if I can do. I have to be become someone or something that can&#39;t be ignored and everyone who pays what I ask for would see it as nothing but paying homage because they can&#39;t afford the service that I would render to them.</p><p>And that is where I think my arrogance and pompocity comes in. I do nothing but think of myself all the time. I just loathe the fact that I am nothing more than a speck in the grand scheme of things. I am insignificant and the most important piece. The double standardness of the situation is what makes it confusing. I have to let all my desires go and yet I should want, and ask and seek. WHAT AM I SEEKING AND LOOKING FOR.</p><p>Now I am adding some text but not using html to see how it looks like because this is becoming increasingly annoying to work with Now this about the most fun thing I am going to do in a long while</p>',17,'2024-05-14 13:18:20','2024-05-16 15:28:55','6643486d150a9.png',0),(9,'Smiles For Sale',0.00,'<p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;text-align:right;\' id=\"isPasted\"><span style=\"font-size:17px;\">10<sup>TH</sup> MAY 2024</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;text-align:center;\'><strong><u><span style=\"font-size:20px;\">METER PURCHASE AGREEMENT</span></u></strong></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">This is to show the agreement between Will of God Covenant Ministries (The Buyer) and &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip; (The Supplier), that a meter with number &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;. was purchased and installed under the supervision of Mr. Ben and Pastor Bismarck.</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">&nbsp;</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;line-height:150%;\'><strong><u><span style=\"font-size:16px;line-height:150%;\">SUPPLIER DETAILS</span></u></strong></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:.0001pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">NAME&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;NATIONAL ID NUMBER</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:.0001pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">PHONE NUMBER&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;SIGNATURE</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">&nbsp;</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;line-height:150%;\'><strong><u><span style=\"font-size:16px;line-height:150%;\">SUPPLIERS WITNESS</span></u></strong></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:.0001pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">NAME&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;NATIONAL ID NUMBER</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:.0001pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">PHONE NUMBER&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;SIGNATURE</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">&nbsp;</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;line-height:150%;\'><strong><u><span style=\"font-size:16px;line-height:150%;\">THE BUYER (WILL OF GOD COVENANT MINISTRIES)</span></u></strong></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:.0001pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">NAME&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;NATIONAL ID NUMBER</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:.0001pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">PHONE NUMBER&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;SIGNATURE</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">&nbsp;</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;line-height:150%;\'><strong><u><span style=\"font-size:16px;line-height:150%;\">THE BUYER&rsquo;S WITNESS</span></u></strong></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:.0001pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">NAME&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;NATIONAL ID NUMBER</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:.0001pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></p><p style=\'margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;font-size:11.0pt;font-family:\"Calibri\",sans-serif;\'><span style=\"font-size:16px;\">PHONE NUMBER &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;SIGNATURE</span></p>',18,'2024-05-14 20:29:16','2024-05-16 17:31:04','6643ad75b1b37.png',0),(16,'Finally got most of the stuff working',150.00,'<p><br></p>This is just some very dumb text that I wouldn&#39;t even read when I get out of here',18,'2024-05-16 22:53:38','2024-05-16 22:53:38','6646724eb457a.png',0);
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

-- Dump completed on 2024-05-16 21:04:47
