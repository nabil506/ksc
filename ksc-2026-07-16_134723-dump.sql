-- MySQL dump 10.13  Distrib 8.4.10, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: ksc
-- ------------------------------------------------------
-- Server version	8.4.10-0ubuntu0.25.10.1

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
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_event` varchar(255) NOT NULL,
  `tanggal_event` date NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT 'Upcoming',
  `deskripsi` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (10,'KSC CUP 250M','2026-07-14','krian ','Upcoming','gaya lumba\"'),(11,'KSC CUP 250M','2026-07-16','krian ','Upcoming','gaya lompat kodok'),(12,'KSC CUP 150M','2026-07-12','KRIAN SWIMMING CLUB','Upcoming','lompat gaya dada');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hari` varchar(20) NOT NULL,
  `waktu` varchar(50) NOT NULL,
  `id_pelatih` int NOT NULL,
  `kolam` varchar(50) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`),
  KEY `id_pelatih` (`id_pelatih`),
  CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_pelatih`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal`
--

LOCK TABLES `jadwal` WRITE;
/*!40000 ALTER TABLE `jadwal` DISABLE KEYS */;
INSERT INTO `jadwal` VALUES (1,'Sabtu','15.00 - 17.00',13,'KOLAM P01','latihan fisik'),(2,'Minggu','15.00 - 17.20',14,'KOLAM P02','latihan gaya kupu-kupu'),(3,'Jumat','12.00 - 15.00',13,'KOLAM P03','pembelajaran gaya lumba - lumba'),(4,'Jumat','15.10 - 17.20',14,'P01','gaya ketenangan batin');
/*!40000 ALTER TABLE `jadwal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendaftaran`
--

DROP TABLE IF EXISTS `pendaftaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pendaftaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `event_id` int NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `tanggal_daftar` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`user_id`),
  KEY `fk_event` (`event_id`),
  CONSTRAINT `fk_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendaftaran`
--

LOCK TABLES `pendaftaran` WRITE;
/*!40000 ALTER TABLE `pendaftaran` DISABLE KEYS */;
INSERT INTO `pendaftaran` VALUES (7,8,10,NULL,'2026-07-13 11:43:10'),(8,12,10,NULL,'2026-07-13 12:08:24'),(9,12,11,NULL,'2026-07-13 13:14:08');
/*!40000 ALTER TABLE `pendaftaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(2,'atlit'),(3,'pelatih');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `umur` int DEFAULT NULL,
  `no_wa` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_anggota` enum('Aktif','Nonaktif') DEFAULT 'Aktif',
  `foto_profile` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `users_ibfk_1` (`id_role`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'Administrator','balaikota789@gmail.com',25,'08123456789','$2y$12$ZBHZIfkNaY3h4pwmgKHgo.bEnd4psfEX2e3CknfKXd8v4mpgdeS2u',1,'2026-06-20 17:00:00','2026-07-03 05:50:31','Aktif',NULL),(8,'Nabil Faqi','nabilfaqi@gmail.com',25,'08123456789','$2y$12$ZBHZIfkNaY3h4pwmgKHgo.bEnd4psfEX2e3CknfKXd8v4mpgdeS2u',2,'2026-06-20 17:00:00','2026-07-16 05:09:40','Nonaktif','profile_8_1784117091.jpg'),(11,'Nuel','nuel@gmail.com',30,'08123456789','$2y$12$ZBHZIfkNaY3h4pwmgKHgo.bEnd4psfEX2e3CknfKXd8v4mpgdeS2u',3,'2026-06-23 17:00:00','2026-07-05 04:34:20','Nonaktif',NULL),(12,'kaira','kaira@gmail.com',20,'085806661464','$2y$12$TXZFhERnP3Gphs6QnHTdm.um4KgoAto4.wJOyoMxAzPBpeqJESXX.',2,'2026-07-05 08:46:30','2026-07-07 01:42:44','Aktif',NULL),(13,'dhimas','dhimas@gmail.com',NULL,NULL,'$2y$12$udlrwJsOK77PwnJcMvt6T.QETYtXzGdqUcqfijCr.8PUCy35gdoVa',3,'2026-07-05 15:57:15','2026-07-15 12:28:48','Aktif','profile_13_1784118528.png'),(14,'azizi','azizi@gmail.com',NULL,NULL,'$2y$12$iOIExEcTH0ExRjFepvNwSOyr/fMdP/.EczWIfOm4TTFN9CHXM3zga',3,'2026-07-09 17:21:10','2026-07-09 17:21:10','Aktif',NULL),(15,'rizal','rizal@gmail.com',NULL,NULL,'$2y$12$Urid6s.bRDGFW53cuZOB3eohoH/qze77N6CuHpLxCE40.pDM3e2Oy',2,'2026-07-14 04:22:00','2026-07-14 04:22:00','Aktif',NULL);
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

-- Dump completed on 2026-07-16 13:47:24
