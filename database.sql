-- MySQL dump 10.13  Distrib 8.4.10, for Linux (x86_64)
--
-- Host: localhost    Database: ksc
-- ------------------------------------------------------
-- Server version	8.4.10-0ubuntu0.25.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!50503 SET NAMES utf8mb4 */
;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;
/*!40103 SET TIME_ZONE='+00:00' */
;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;

--
-- Table structure for table `atlit`
--

USE ksc;


-- ==========================
-- TABLE ROLES
-- ==========================
CREATE TABLE IF NOT EXISTS roles (
    id INT NOT NULL AUTO_INCREMENT,
    role_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ==========================
-- TABLE USERS
-- ==========================
CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    umur INT,
    no_wa VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    id_role INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status_anggota ENUM('Aktif','Nonaktif') DEFAULT 'Aktif',

    PRIMARY KEY (id),
    UNIQUE KEY email (email),

    CONSTRAINT users_ibfk_1
        FOREIGN KEY (id_role)
        REFERENCES roles(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ==========================
-- TABLE EVENTS
-- ==========================
CREATE TABLE IF NOT EXISTS events (
    id INT NOT NULL AUTO_INCREMENT,
    nama_event VARCHAR(255) NOT NULL,
    tanggal_event DATE NOT NULL,
    lokasi VARCHAR(255) NOT NULL,
    status VARCHAR(50) DEFAULT 'Upcoming',
    deskripsi TEXT,

    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ==========================
-- DATA ROLES
-- ==========================
INSERT INTO roles (id, role_name) VALUES
(1, 'admin'),
(2, 'atlit'),
(3, 'pelatih');

-- ==========================
-- DATA USERS
-- Password masih berupa contoh.
-- Sebaiknya gunakan password_hash() saat insert dari PHP.
-- ==========================
INSERT INTO users
(id, nama_lengkap, email,umur, no_wa, password, id_role, created_at, updated_at, status_anggota)
VALUES
(
7,
'Administrator',
'balaikota789@gmail.com',
25,
'08123456789',
'admin123',
1,
'2026-06-21 00:00:00',
'2026-06-21 00:00:00',
'Aktif'
),
(
8,
'Nabil Faqi',
'nabilfaqi@gmail.com',
25,
'08123456789',
'atlit123',
2,
'2026-06-21 00:00:00',
'2026-06-21 00:00:00',
'Aktif'
),
(
11,
'Nuel',
'nuel@gmail.com',
30,
'08123456789',
'pelatih123',
3,
'2026-06-24 00:00:00',
'2026-06-24 00:00:00',
'Aktif'
);

-- ==========================
-- DATA EVENTS
-- ==========================
INSERT INTO events
(id, nama_event, tanggal_event, lokasi, status, deskripsi)
VALUES
(
8,
'KSC Cup 50M',
'2026-06-28',
'KSC Krian',
'Upcoming',
'Kompetisi renang jarak 50 meter.'
);






























--
-- Table structure for table `pendaftaran`
--

DROP TABLE IF EXISTS `pendaftaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
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
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;

--
-- Dumping data for table `pendaftaran`
--

LOCK TABLES `pendaftaran` WRITE;
/*!40000 ALTER TABLE `pendaftaran` DISABLE KEYS */
;

/*!40000 ALTER TABLE `pendaftaran` ENABLE KEYS */
;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
/*!40101 SET character_set_client = @saved_cs_client */
;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */
;
INSERT INTO
    `users`
VALUES (
        7,
        'balaikota789@gmail.com',
        '$2y$12$b4HxS524jLuYWDRtLEFDFuvyAqXXzI.ZrenULZRZ4QQa0SdMvrMCm',
        'admin',
        '2026-06-21 12:49:51',
        '2026-06-24 10:17:21',
        'Aktif'
    ),
    (
        8,
        'nabilfaqi@gmail.com',
        '$2y$12$eGCC62aI2RH0/WQNahZBEu6Rbwb8omQ.9VORUqvquFcp6JYMinh2m',
        'atlit',
        '2026-06-21 12:58:37',
        '2026-06-21 12:58:37',
        'Aktif'
    ),
    (
        9,
        'kaira@gmail.com',
        '$2y$12$iUiso..5U0oMlFWy1qkxUOIh4teJYNwPhr1g544F64ZP4ChrxcjP6',
        'atlit',
        '2026-06-21 14:30:15',
        '2026-06-21 14:30:15',
        'Aktif'
    ),
    (
        10,
        'farrel@gmail.com',
        '$2y$12$VhRN54GGt1dH4mQFB5E8vOQ2JvsO.fBlGoA1wEIx5zU9IiUulyJCi',
        'atlit',
        '2026-06-23 16:56:59',
        '2026-06-27 16:51:10',
        'Aktif'
    ),
    (
        11,
        'nuel@gmail.com',
        '$2y$12$ygUf1Ri8RET2murdfEmVBeddtnHmDg53icjzW9x.Qx5Sxs7QXNvki',
        'pelatih',
        '2026-06-24 10:54:40',
        '2026-06-24 10:54:40',
        'Aktif'
    );
/*!40000 ALTER TABLE `users` ENABLE KEYS */
;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */
;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;

-- Dump completed on 2026-06-28 22:22:38