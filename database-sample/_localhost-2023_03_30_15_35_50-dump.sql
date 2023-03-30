-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: fruit_app
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20230329120430','2023-03-29 14:05:32',19);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favourates`
--

DROP TABLE IF EXISTS `favourates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favourates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nutritions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fruit_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favourates`
--

LOCK TABLES `favourates` WRITE;
/*!40000 ALTER TABLE `favourates` DISABLE KEYS */;
INSERT INTO `favourates` VALUES (2,'Dragonfruit','Selenicereus','Selenicereus','Caryophyllales','{\"carbohydrates\":9,\"protein\":9,\"fat\":1.5,\"calories\":60,\"sugar\":8}',13),(4,'Apple','Malus','Malus','Rosales','{\"carbohydrates\":11.4,\"protein\":0.3,\"fat\":0.4,\"calories\":52,\"sugar\":10.3}',6),(5,'Apple','Malus','Malus','Rosales','{\"carbohydrates\":11.4,\"protein\":0.3,\"fat\":0.4,\"calories\":52,\"sugar\":10.3}',6),(6,'Cranberry','Vaccinium','Vaccinium','Ericales','{\"carbohydrates\":12.2,\"protein\":0.4,\"fat\":0.1,\"calories\":46,\"sugar\":4}',12),(7,'Durian','Durio','Durio','Malvales','{\"carbohydrates\":27.1,\"protein\":1.5,\"fat\":5.3,\"calories\":147,\"sugar\":6.75}',14),(8,'Cherry','Prunus','Prunus','Rosales','{\"carbohydrates\":12,\"protein\":1,\"fat\":0.3,\"calories\":50,\"sugar\":8}',11),(9,'Gooseberry','Ribes','Ribes','Saxifragales','{\"carbohydrates\":10,\"protein\":0.9,\"fat\":0.6,\"calories\":44,\"sugar\":0}',17),(10,'Guava','Psidium','Psidium','Myrtales','{\"carbohydrates\":14,\"protein\":2.6,\"fat\":1,\"calories\":68,\"sugar\":9}',20);
/*!40000 ALTER TABLE `favourates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fruits`
--

DROP TABLE IF EXISTS `fruits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fruits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `genus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nutritions` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:json)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fruits`
--

LOCK TABLES `fruits` WRITE;
/*!40000 ALTER TABLE `fruits` DISABLE KEYS */;
INSERT INTO `fruits` VALUES (1,'Malus','Apple','Malus','Rosales','{\"carbohydrates\":11.4,\"protein\":0.3,\"fat\":0.4,\"calories\":52,\"sugar\":10.3}'),(2,'Malus','Apple','Malus','Rosales','{\"carbohydrates\":11.4,\"protein\":0.3,\"fat\":0.4,\"calories\":52,\"sugar\":10.3}'),(3,'Malus','Apple','Malus','Rosales','{\"carbohydrates\":11.4,\"protein\":0.3,\"fat\":0.4,\"calories\":52,\"sugar\":10.3}'),(4,'Malus','Apple','Malus','Rosales','{\"carbohydrates\":11.4,\"protein\":0.3,\"fat\":0.4,\"calories\":52,\"sugar\":10.3}'),(5,'Malus','Apple','Malus','Rosales','{\"carbohydrates\":11.4,\"protein\":0.3,\"fat\":0.4,\"calories\":52,\"sugar\":10.3}'),(6,'Prunus','Apricot','Prunus','Rosales','{\"carbohydrates\":3.9,\"protein\":0.5,\"fat\":0.1,\"calories\":15,\"sugar\":3.2}'),(7,'Persea','Avocado','Persea','Laurales','{\"carbohydrates\":8.53,\"protein\":2,\"fat\":14.66,\"calories\":160,\"sugar\":0.66}'),(8,'Musa','Banana','Musa','Zingiberales','{\"carbohydrates\":22,\"protein\":1,\"fat\":0.2,\"calories\":96,\"sugar\":17.2}'),(9,'Rubus','Blackberry','Rubus','Rosales','{\"carbohydrates\":9,\"protein\":1.3,\"fat\":0.4,\"calories\":40,\"sugar\":4.5}'),(10,'Fragaria','Blueberry','Fragaria','Rosales','{\"carbohydrates\":5.5,\"protein\":0,\"fat\":0.4,\"calories\":29,\"sugar\":5.4}'),(11,'Prunus','Cherry','Prunus','Rosales','{\"carbohydrates\":12,\"protein\":1,\"fat\":0.3,\"calories\":50,\"sugar\":8}'),(12,'Vaccinium','Cranberry','Vaccinium','Ericales','{\"carbohydrates\":12.2,\"protein\":0.4,\"fat\":0.1,\"calories\":46,\"sugar\":4}'),(13,'Selenicereus','Dragonfruit','Selenicereus','Caryophyllales','{\"carbohydrates\":9,\"protein\":9,\"fat\":1.5,\"calories\":60,\"sugar\":8}'),(14,'Durio','Durian','Durio','Malvales','{\"carbohydrates\":27.1,\"protein\":1.5,\"fat\":5.3,\"calories\":147,\"sugar\":6.75}'),(15,'Sellowiana','Feijoa','Sellowiana','Myrtoideae','{\"carbohydrates\":8,\"protein\":0.6,\"fat\":0.4,\"calories\":44,\"sugar\":3}'),(16,'Ficus','Fig','Ficus','Rosales','{\"carbohydrates\":19,\"protein\":0.8,\"fat\":0.3,\"calories\":74,\"sugar\":16}'),(17,'Ribes','Gooseberry','Ribes','Saxifragales','{\"carbohydrates\":10,\"protein\":0.9,\"fat\":0.6,\"calories\":44,\"sugar\":0}'),(18,'Vitis','Grape','Vitis','Vitales','{\"carbohydrates\":18.1,\"protein\":0.72,\"fat\":0.16,\"calories\":69,\"sugar\":16}'),(19,'Malus','GreenApple','Malus','Rosales','{\"carbohydrates\":3.1,\"protein\":0.4,\"fat\":0.1,\"calories\":21,\"sugar\":6.4}'),(20,'Psidium','Guava','Psidium','Myrtales','{\"carbohydrates\":14,\"protein\":2.6,\"fat\":1,\"calories\":68,\"sugar\":9}'),(21,'Apteryx','Kiwi','Apteryx','Struthioniformes','{\"carbohydrates\":15,\"protein\":1.1,\"fat\":0.5,\"calories\":61,\"sugar\":9}'),(22,'Actinidia','Kiwifruit','Actinidia','Ericales','{\"carbohydrates\":14.6,\"protein\":1.14,\"fat\":0.5,\"calories\":61,\"sugar\":8.9}'),(23,'Citrus','Lemon','Citrus','Sapindales','{\"carbohydrates\":9,\"protein\":1.1,\"fat\":0.3,\"calories\":29,\"sugar\":2.5}'),(24,'Citrus','Lime','Citrus','Sapindales','{\"carbohydrates\":8.4,\"protein\":0.3,\"fat\":0.1,\"calories\":25,\"sugar\":1.7}'),(25,'Vaccinium','Lingonberry','Vaccinium','Ericales','{\"carbohydrates\":11.3,\"protein\":0.75,\"fat\":0.34,\"calories\":50,\"sugar\":5.74}'),(26,'Litchi','Lychee','Litchi','Sapindales','{\"carbohydrates\":17,\"protein\":0.8,\"fat\":0.44,\"calories\":66,\"sugar\":15}'),(27,'Mangifera','Mango','Mangifera','Sapindales','{\"carbohydrates\":15,\"protein\":0.82,\"fat\":0.38,\"calories\":60,\"sugar\":13.7}'),(28,'Cucumis','Melon','Cucumis','Cucurbitaceae','{\"carbohydrates\":8,\"protein\":0,\"fat\":0,\"calories\":34,\"sugar\":8}'),(29,'Morus','Morus','Morus','Rosales','{\"carbohydrates\":9.8,\"protein\":1.44,\"fat\":0.39,\"calories\":43,\"sugar\":8.1}'),(30,'Citrus','Orange','Citrus','Sapindales','{\"carbohydrates\":8.3,\"protein\":1,\"fat\":0.2,\"calories\":43,\"sugar\":8.2}'),(31,'Carica','Papaya','Carica','Caricacea','{\"carbohydrates\":11,\"protein\":0,\"fat\":0.4,\"calories\":43,\"sugar\":1}'),(32,'Passiflora','Passionfruit','Passiflora','Malpighiales','{\"carbohydrates\":22.4,\"protein\":2.2,\"fat\":0.7,\"calories\":97,\"sugar\":11.2}'),(33,'Prunus','Peach','Prunus','Rosales','{\"carbohydrates\":9.5,\"protein\":0.9,\"fat\":0.25,\"calories\":39,\"sugar\":8.4}'),(34,'Pyrus','Pear','Pyrus','Rosales','{\"carbohydrates\":15,\"protein\":0.4,\"fat\":0.1,\"calories\":57,\"sugar\":10}'),(35,'Diospyros','Persimmon','Diospyros','Rosales','{\"carbohydrates\":18,\"protein\":0,\"fat\":0,\"calories\":81,\"sugar\":18}'),(36,'Ananas','Pineapple','Ananas','Poales','{\"carbohydrates\":13.12,\"protein\":0.54,\"fat\":0.12,\"calories\":50,\"sugar\":9.85}'),(37,'Cactaceae','Pitahaya','Cactaceae','Caryophyllales','{\"carbohydrates\":7,\"protein\":1,\"fat\":0.4,\"calories\":36,\"sugar\":3}'),(38,'Prunus','Plum','Prunus','Rosales','{\"carbohydrates\":11.4,\"protein\":0.7,\"fat\":0.28,\"calories\":46,\"sugar\":9.92}'),(39,'Punica','Pomegranate','Punica','Myrtales','{\"carbohydrates\":18.7,\"protein\":1.7,\"fat\":1.2,\"calories\":83,\"sugar\":13.7}'),(40,'Rubus','Raspberry','Rubus','Rosales','{\"carbohydrates\":12,\"protein\":1.2,\"fat\":0.7,\"calories\":53,\"sugar\":4.4}'),(41,'Fragaria','Strawberry','Fragaria','Rosales','{\"carbohydrates\":5.5,\"protein\":0.8,\"fat\":0.4,\"calories\":29,\"sugar\":5.4}'),(42,'Citrus','Tangerine','Citrus','Sapindales','{\"carbohydrates\":8.3,\"protein\":0,\"fat\":0.4,\"calories\":45,\"sugar\":9.1}'),(43,'Solanum','Tomato','Solanum','Solanales','{\"carbohydrates\":3.9,\"protein\":0.9,\"fat\":0.2,\"calories\":74,\"sugar\":2.6}'),(44,'Citrullus','Watermelon','Citrullus','Cucurbitales','{\"carbohydrates\":8,\"protein\":0.6,\"fat\":0.2,\"calories\":30,\"sugar\":6}');
/*!40000 ALTER TABLE `fruits` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-30 15:35:50
