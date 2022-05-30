-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: localhost    Database: dogster
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.20.04.3

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `dog_id` int NOT NULL,
  `body` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (4,1,17,'qqqqqqqqqqqqqqqqqqqq','2022-05-29 13:12:47','2022-05-29 13:12:47'),(6,1,18,'test','2022-05-29 13:55:00','2022-05-29 13:55:00'),(7,1,18,'aaa','2022-05-29 13:55:23','2022-05-29 13:55:23'),(8,1,18,'aaaaaaaaaaa','2022-05-29 13:55:51','2022-05-29 13:55:51'),(9,1,18,'tegaaa','2022-05-29 13:56:01','2022-05-29 13:56:01'),(37,1,18,'agaga','2022-05-29 15:39:35','2022-05-29 15:39:35'),(40,1,18,'dsaaaaaa','2022-05-29 15:43:58','2022-05-29 15:43:58'),(41,2,18,'test','2022-05-29 21:28:37','2022-05-29 21:28:37');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dogs`
--

DROP TABLE IF EXISTS `dogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dogs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `breed` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dogs`
--

LOCK TABLES `dogs` WRITE;
/*!40000 ALTER TABLE `dogs` DISABLE KEYS */;
INSERT INTO `dogs` VALUES (17,'GOLDEN RETRIEVER','Dzeki','The Golden Retriever is a large-sized breed of dog bred as gun dogs to retrieve shot waterfowl such as ducks and upland game birds during hunting and shooting parties, and were named \'retriever\' because ... Wikipedia Life span: 10 – 12 years Weight: Female: 25–32 kg, Male: 30–34 kg Colors: Cream, Golden, Dark Golden, Light Golden Temperament: Intelligent, Kind, Reliable, Trustworthy, Confident, Friendly Height: Female: 51–56 cm, Male: 56–61 cm Did you know: Golden Retriever is the fifth-most popular dog breed by registrations (92,994) worldwide.','assets/images/dogs/gr.jpg','2022-05-28 23:23:46','2022-05-28 23:23:46'),(18,'GERMAN SHEPHERD','Rea','The German Shepherd is a breed of medium to large-sized working dog that originated in Germany. The breed\'s officially recognized name is German Shepherd Dog in the English language. The breed was once known as the Alsatian in Britain and Ireland. Wikipedia Life span: 9 – 13 years Temperament: Obedient, Curious, Loyal, Alert, Confident, Intelligent, Watchful, Courageous Weight: Male: 30–40 kg, Female: 22–32 kg Colors: Black, Black & Tan, Red & Black, Black & Silver, Sable, Grey Height: Male: 60–65 cm, Female: 55–60 cm Did you know: German Shepherd is the second-most popular dog breed by registrations (129,186) worldwide.','assets/images/dogs/gsp.jpeg','2022-05-28 23:24:25','2022-05-28 23:24:25'),(20,'ROTTWEILER','Beki','The Rottweiler is a breed of domestic dog, regarded as medium-to-large or large. The dogs were known in German as Rottweiler Metzgerhund, meaning Rottweil butchers\' dogs, because their main use was to ... Wikipedia Life span: 8 – 10 years Origin: Germany Temperament: Steady, Good-natured, Fearless, Devoted, Obedient, Alert, Confident, Self-assured, Calm, Courageous Weight: Female: 35–48 kg, Male: 50–60 kg Height: Female: 56–63 cm, Male: 61–69 cm Colors: Black, Blue, Tan, Mahogany','assets/images/dogs/rott.jpg','2022-05-29 21:38:18','2022-05-29 21:38:18'),(21,'BULLDOG','Megi','A Bulldog is a medium-sized breed of dog commonly referred to as the English Bulldog or British Bulldog. It is a muscular, hefty dog with a wrinkled face and a distinctive pushed-in nose. Wikipedia Life span: 8 – 10 years Temperament: Docile, Willful, Friendly, Gregarious Weight: Female: 18–23 kg, Male: 23–25 kg Colors: White, Fawn, Piebald, Brindle & White, Red & White, Fawn & White, Red Brindle, Red Height: Female: 31–40 cm, Male: 31–40 cm Origin: United Kingdom, England','assets/images/dogs/bulldog.jpg','2022-05-29 21:38:34','2022-05-29 21:38:34'),(22,'BEAGLE','Dugi','The beagle is a breed of small hound that is similar in appearance to the much larger foxhound. The beagle is a scent hound, developed primarily for hunting hare. Life span: 12 – 15 years Temperament: Amiable, Gentle, Determined, Excitable, Intelligent, Even Tempered Height: Male: 36–41 cm, Female: 33–38 cm Weight: Male: 10–11 kg, Female: 9–10 kg Colors: Lemon & White, Tri-color, Chocolate Tri, Brown & White, Red & White, Orange & White, White & Tan Did you know: Beagle is the eighth-most popular dog breed by registrations (53,938) worldwide.','assets/images/dogs/beagle.jpeg','2022-05-29 21:39:40','2022-05-29 21:39:40'),(23,'BOXER','Borac','The Boxer is a medium-sized, short-haired breed of dog, developed in Germany. The coat is smooth and tight-fitting; colors are fawn or brindled, with or without white markings, and white. Life span: 10 – 12 years Temperament: Devoted, Friendly, Fearless, Cheerful, Energetic, Loyal, Playful, Confident, Intelligent, Bright, Brave, Calm Weight: Female: 25–29 kg, Male: 27–32 kg Colors: Brindle, White, Fawn Height: Female: 53–60 cm, Male: 57–63 cm Did you know: Boxer is the ninth-most popular dog breed by registrations (52,983) worldwide.','assets/images/dogs/boxer.jpg','2022-05-29 21:40:07','2022-05-29 21:40:07'),(24,'ENGLISH MASTIFF','Mata','The English Mastiff is a breed of extremely large dog perhaps descended from the ancient Alaunt and Pugnaces Britanniae, with a significant input from the Alpine Mastiff in the 19th century. Life span: 10 – 12 years Origin: England Weight: Female: 54–77 kg, Male: 73–100 kg Temperament: Good-natured, Affectionate, Dignified, Protective, Calm, Courageous Height: Female: 70–91 cm, Male: 70–91 cm Colors: Brindle, Fawn, Apricot','assets/images/dogs/mastif.jpeg','2022-05-29 21:40:23','2022-05-29 21:40:23');
/*!40000 ALTER TABLE `dogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `dog_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (10,1,18,'2022-05-30 00:28:56','2022-05-30 00:28:56'),(11,2,18,'2022-05-30 00:31:08','2022-05-30 00:31:08');
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(512) NOT NULL,
  `birthday` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'gagi','gagi@gagi.com','$2y$10$h8/sMEcR5Pjt2XCtv69QkOnkvNIbZbCrCHMX4AYA1OKKYr8AVdK4K',NULL,'2022-05-12 01:17:11','2022-05-12 01:17:11',1,'2022-05-30 00:28:43'),(2,'gagi2','gagi2@gmail.com','$2y$10$i3UK008M4VDbbuCWSceuhuhnXesC61.qKjlzrueQCdirS9m8e.ZlK','2022-05-03 00:00:00','2022-05-12 01:31:29','2022-05-12 01:31:29',0,'2022-05-30 00:30:56');
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

-- Dump completed on 2022-05-30 17:08:49
