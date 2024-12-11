-- MySQL dump 10.13  Distrib 8.0.36, for macos14 (x86_64)
--
-- Host: localhost    Database: boothlink
-- ------------------------------------------------------
-- Server version	9.1.0

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin1','admin1'),(2,'admin2','admin2'),(3,'admin3','admin3');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'randy@gmail.com','clifton','Black','Clifton','clifton'),(2,'rona@gmail.com','rona','James','Xena','rona'),(3,'john.doe@example.com','john_doe','Doe','John','password123'),(4,'jane.smith@example.com','jane_smith','Smith','Jane','password456'),(5,'michael.jones@example.com','mike_jones','Jones','Michael','pass789'),(6,'lisa.brown@example.com','lisa_brown','Brown','Lisa','securePass'),(7,'tom.jackson@example.com','tom_jackson','Jackson','Tom','myPassword1'),(8,'emma.wilson@example.com','emma_wilson','Wilson','Emma','randomPass22'),(9,'chris.davis@example.com','chris_davis','Davis','Chris','strongPass333'),(10,'sarah.miller@example.com','sarah_miller','Miller','Sarah','passw0rd444'),(11,'david.moore@example.com','dave_moore','Moore','David','mySecretPass555'),(12,'laura.thompson@example.com','laura_thompson','Thompson','Laura','passMe666');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location` (
  `loc_id` int NOT NULL AUTO_INCREMENT,
  `loc_room` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `stall_number` int NOT NULL,
  PRIMARY KEY (`loc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (1,'Devesse',6),(2,'Devesse',3),(3,'Devesse',7),(4,'Devesse',5),(5,'Devesse',9),(6,'Devesse',2),(7,'Devesse',6),(8,'Devesse',4),(9,'Devesse',8),(10,'Devesse',1),(11,'Devesse',10);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization` (
  `org_id` int NOT NULL AUTO_INCREMENT,
  `org_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `org_img` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `fb_link` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `x_link` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `ig_link` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`org_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization`
--

LOCK TABLES `organization` WRITE;
/*!40000 ALTER TABLE `organization` DISABLE KEYS */;
INSERT INTO `organization` VALUES (1,'SCHEMA','schema.jpg','facebook.com/schema','x.com/schema','ig.com/schema'),(2,'White & Blue','w&b.jpg','facebook.com/w&b','x.com/w&b','ig.com/w&b'),(3,'RPG','rpg.jpg','facebook.com/rpg','x.com/rpg','ig.com/rpg\r\n                                 '),(4,'COMELEC','comelec.jpg','facebook.com/comelec','x.com/comelec','ig.com/comelec'),(5,'ICON','icon.jpg','facebook.com/sluICON','x.com/sluICON','ig.com/sluICON'),(6,'GCS','gcs.jpg','facebook.com/greencoresociety','x.com/greencoresociety','ig.com/greencoresociety'),(7,'SICAP','sicap.jpg','facebook.com/SICAPSLU','x.com/SICAPSLU','ig.com/SICAPSLU'),(8,'JPIA','jpia.jpg','facebook.com/JrfinexSluSamcis','x.com/JrfinexSluSamcis','ig.com/JrfinexSluSamcis');
/*!40000 ALTER TABLE `organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prod_img`
--

DROP TABLE IF EXISTS `prod_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prod_img` (
  `prod_id` int NOT NULL,
  `img_src` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  KEY `fk_prod_img(prodserv)` (`prod_id`),
  CONSTRAINT `fk_prod_img(prodserv)` FOREIGN KEY (`prod_id`) REFERENCES `prod_serv` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prod_img`
--

LOCK TABLES `prod_img` WRITE;
/*!40000 ALTER TABLE `prod_img` DISABLE KEYS */;
INSERT INTO `prod_img` VALUES (1,'inc_clothing_tee.jpg'),(2,'bmeg_food.jpg'),(3,'swim_suit.jpg'),(4,'handsome_watch.jpg'),(5,'alawakbar_entertainment.jpg'),(6,'sports_jacket.jpg'),(7,'veggie_wrap.jpg'),(8,'silver_bracelet.jpg'),(9,'blueberry_cheesecake.jpg'),(10,'movie_ticket.jpg'),(11,'smoothie.jpg'),(12,'cotton_tshirt.jpg'),(13,'spaghetti_bolognese.jpg'),(14,'leather_wallet.jpg'),(15,'ice_cream_sundae.jpg'),(16,'testpaper.png'),(18,'backpack.jpg'),(19,'aquaflask.jpeg'),(20,'facepaint.jpg'),(21,'case.jpg'),(22,'lipstick.jpg'),(23,'japanese_stickers.jpg'),(24,'shrimp_yakisoba.jpg');
/*!40000 ALTER TABLE `prod_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prod_org_sched`
--

DROP TABLE IF EXISTS `prod_org_sched`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prod_org_sched` (
  `prod_id` int NOT NULL,
  `org_id` int NOT NULL,
  `sched_id` int NOT NULL,
  PRIMARY KEY (`prod_id`,`org_id`,`sched_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prod_org_sched`
--

LOCK TABLES `prod_org_sched` WRITE;
/*!40000 ALTER TABLE `prod_org_sched` DISABLE KEYS */;
INSERT INTO `prod_org_sched` VALUES (1,1,5),(3,2,2),(4,3,3),(5,4,4),(7,5,8),(8,6,7),(10,7,1),(11,8,10),(12,1,6),(15,2,9),(16,3,1),(18,4,30),(19,5,20),(20,7,20),(21,6,21),(22,3,20),(23,5,20),(24,2,20);
/*!40000 ALTER TABLE `prod_org_sched` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prod_serv`
--

DROP TABLE IF EXISTS `prod_serv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prod_serv` (
  `prod_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `prod_serv_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `price` double NOT NULL,
  `description` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prod_serv`
--

LOCK TABLES `prod_serv` WRITE;
/*!40000 ALTER TABLE `prod_serv` DISABLE KEYS */;
INSERT INTO `prod_serv` VALUES (1,'In Stock','Item','Sweater',400,'Updated description'),(2,'In Stock','Food','B-Meg',100,'Delicious food'),(3,'In Stock','Item','Clothing',350,'Swim Suit for summers'),(4,'In Stock','Item','Gshock',6000,'Watch for handsome guysasdf'),(5,'In Stock','Service','Serenade',150,'Sing a song to someone'),(6,'In Stock','Item','Sports Jacket',500,'Lightweight jacket perfect for workouts.'),(7,'In Stock','Food','Burrito',150,'Filled with savory ingredients'),(8,'In Stock','Service','Items for Rent',300,'Rent any item'),(9,'In Stock','Food','Blueberry Cheesecake',115,'Creamy cheesecake with fresh blueberries.'),(10,'In Stock','Item','Movie Ticket',350,'Ticket for the latest blockbuster movie.'),(11,'In Stock','Food','Smoothie',110,'testing'),(12,'In Stock','Item','Cotton T-Shirt',350,'Comfortable cotton t-shirt available in all s'),(13,'In Stock','Food','Spaghetti Bolognese',180,'Classic spaghetti with a rich meat sauce.'),(14,'In Stock','Item','Leather Wallet',750,'Durable leather wallet with multiple compartm'),(15,'In Stock','Food','Ice Cream Sundae',65,'Vanilla ice cream topped with chocolate syrup'),(16,'In Stock','Item','Testing',999,'This is an example for adding'),(18,'In Stock','Item','Backpack',350,'Magical backpack'),(19,'In Stock','Item','Aquaflask',700,'Thermal bottle 12oz'),(20,'In Stock','Service','Face Paint',200,'Paint your face with any design.'),(21,'In Stock','Item','Phone Case',50,'Phone case for Apple'),(22,'In Stock','Item','Lipstick',450,'Lip Stick long lasting'),(23,'In Stock','Item','Japanese Stickers',30,'Japanese Stickers from Russia'),(24,'In Stock','Food','Yakisoba',95,'Shrimp Yakisoba with gulay');
/*!40000 ALTER TABLE `prod_serv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `reservation_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `prod_id` int NOT NULL,
  `qty` int NOT NULL,
  `date` date NOT NULL,
  `status` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`reservation_id`),
  KEY `fk_reservation` (`customer_id`),
  CONSTRAINT `fk_reservation` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (1,1,3,2,'2024-10-20','Pending'),(2,2,5,1,'2024-10-21','Cancelled'),(3,3,7,3,'2024-10-25','Completed'),(4,1,1,4,'2024-10-23','Pending'),(5,4,2,2,'2024-10-24','Cancelled'),(6,2,9,1,'2024-10-29','Completed'),(7,3,4,2,'2024-10-26','Pending'),(8,5,6,1,'2024-10-27','Cancelled'),(9,1,8,3,'2024-10-28','Completed'),(10,4,10,5,'2024-10-29','Pending'),(11,3,5,2,'2024-11-07','Pending'),(12,4,12,1,'2024-11-07','Completed'),(13,2,7,3,'2024-11-07','Pending'),(14,5,3,5,'2024-11-06','Completed'),(15,6,8,1,'2024-11-07','Cancelled'),(16,7,11,4,'2024-11-06','Completed'),(17,8,2,2,'2024-11-06','Pending'),(18,3,10,1,'2024-11-06','Completed'),(19,9,6,3,'2024-11-06','Pending'),(20,10,4,2,'2024-12-10','Completed'),(21,11,9,1,'2024-12-11','Pending'),(22,12,13,5,'2024-12-11','Cancelled'),(23,1,15,2,'2024-12-10','Pending'),(24,3,2,3,'2024-12-11','Completed'),(25,4,14,1,'2024-12-10','Pending'),(26,5,1,6,'2024-12-11','Completed'),(27,6,8,2,'2024-12-10','Completed'),(28,7,10,1,'2024-12-10','Completed'),(29,8,6,4,'2024-12-10','Completed'),(30,9,5,1,'2024-12-10','Completed');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `sales_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `reservation_id` int NOT NULL,
  `grand_total` double NOT NULL,
  PRIMARY KEY (`sales_id`),
  KEY `fk_sales(customerid)` (`customer_id`),
  KEY `fk_sales(reservation_id)` (`reservation_id`),
  CONSTRAINT `fk_sales(customerid)` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  CONSTRAINT `fk_sales(reservation_id)` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,2,6,100),(2,3,3,150),(3,1,9,200),(4,4,12,350),(5,5,14,1750),(6,7,16,440),(7,3,18,350),(8,10,20,12000),(9,3,24,300),(10,5,26,2400),(11,7,28,350),(12,9,30,150);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedule` (
  `sched_id` int NOT NULL AUTO_INCREMENT,
  `loc_id` int NOT NULL,
  `org_id` int NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`sched_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` VALUES (1,4,1,'2024-11-23','09:00:00','11:00:00'),(2,7,3,'2024-11-25','13:30:00','15:30:00'),(3,2,1,'2024-11-25','08:00:00','10:00:00'),(4,9,1,'2024-11-24','14:00:00','16:00:00'),(5,1,2,'2024-11-26','07:00:00','09:00:00'),(6,5,3,'2024-11-25','10:30:00','12:30:00'),(7,3,1,'2024-11-24','11:00:00','13:00:00'),(8,6,3,'2024-11-25','16:00:00','18:00:00'),(9,10,2,'2024-10-24','09:30:00','11:30:00'),(10,8,1,'2024-11-25','12:00:00','14:00:00'),(11,2,3,'2024-11-06','09:00:00','11:00:00'),(12,1,1,'2024-11-06','12:00:00','14:00:00'),(13,2,2,'2024-11-06','15:00:00','17:00:00'),(14,3,3,'2024-11-06','13:00:00','15:00:00'),(15,4,1,'2024-11-06','08:00:00','09:30:00'),(16,5,2,'2024-11-06','10:00:00','12:30:00'),(17,6,3,'2024-11-06','14:00:00','16:00:00'),(18,7,1,'2024-11-06','11:00:00','15:00:00'),(19,8,2,'2024-11-06','08:30:00','11:00:00'),(20,9,3,'2024-12-10','13:00:00','15:30:00'),(21,10,1,'2024-12-10','13:00:00','14:00:00'),(22,1,2,'2024-12-10','09:00:00','11:00:00'),(23,2,3,'2024-12-10','12:00:00','14:00:00'),(24,3,1,'2024-12-10','15:00:00','17:00:00'),(25,4,2,'2024-12-11','08:00:00','09:30:00'),(26,5,3,'2024-12-11','10:00:00','12:30:00'),(27,6,1,'2024-12-11','14:00:00','16:00:00'),(28,7,2,'2024-12-11','17:00:00','19:00:00'),(29,8,3,'2024-12-11','19:00:00','21:00:00'),(30,9,1,'2024-12-11','21:00:00','22:30:00'),(31,10,2,'2024-12-11','23:00:00','24:00:00');
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendor` (
  `vendor_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor`
--

LOCK TABLES `vendor` WRITE;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` VALUES (1,'ramon@example.com','ramon','jasmin','ramon','ramon'),(2,'rithik@example.com','rithik','tank','rithik','rithik'),(3,'patrick@example.com','patrick','lacanilao','patrick','patrick'),(4,'johan@example.com','johan','roxas','johan','johan'),(5,'basti@example.com','basti','siccuan','basti','basti'),(6,'jasper@example.com','jasper','urbiztondon','jasper','jasper'),(7,'carlo@example.com','carlo','villareal','carlo','carlo');
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_org`
--

DROP TABLE IF EXISTS `vendor_org`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendor_org` (
  `org_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  PRIMARY KEY (`org_id`,`vendor_id`),
  KEY `fk_vendorOrg(orgid)` (`org_id`),
  KEY `fk_vendorOrg(vendorID)` (`vendor_id`),
  CONSTRAINT `fk_vendorOrg(orgid)` FOREIGN KEY (`org_id`) REFERENCES `organization` (`org_id`),
  CONSTRAINT `fk_vendorOrg(vendorID)` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor_org`
--

LOCK TABLES `vendor_org` WRITE;
/*!40000 ALTER TABLE `vendor_org` DISABLE KEYS */;
INSERT INTO `vendor_org` VALUES (1,1),(1,6),(2,2),(2,6),(3,3),(3,7),(4,4),(5,5),(6,6),(7,7);
/*!40000 ALTER TABLE `vendor_org` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-11  1:07:27
