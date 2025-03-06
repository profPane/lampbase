-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: esempio
-- ------------------------------------------------------
-- Server version	10.4.34-MariaDB-1:10.4.34+maria~ubu2004

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `iscritti`
--

DROP TABLE IF EXISTS `iscritti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `iscritti` (
  `ID_Iscritto` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `DataNascita` date DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `DataIscrizione` date NOT NULL,
  `LivelloGioco` varchar(20) DEFAULT NULL CHECK (`LivelloGioco` in ('Principiante','Intermedio','Esperto')),
  `GiochiPreferiti` varchar(255) DEFAULT NULL,
  `Note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_Iscritto`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iscritti`
--

LOCK TABLES `iscritti` WRITE;
/*!40000 ALTER TABLE `iscritti` DISABLE KEYS */;
INSERT INTO `iscritti` VALUES
(1,'Marco','Rossi','1990-05-15','marco.rossi@email.com','3331234567','2023-01-10','Intermedio','Catan, 7 Wonders','Sempre disponibile il venerdì sera.'),
(2,'Laura','Bianchi','1985-11-22','laura.bianchi@email.com','3489876543','2023-02-01','Esperto','Terraforming Mars, Gloomhaven','Organizza spesso tornei.'),
(3,'Giovanni','Verdi','2002-03-08','giovanni.verdi@email.com','3295551212','2023-03-15','Principiante','Ticket to Ride','Nuovo nel mondo dei giochi da tavolo.'),
(4,'Anna','Neri','1978-09-28','anna.neri@email.com','3401122333','2023-04-20','Intermedio','Pandemic, Azul','Collezionista di giochi da tavolo.'),
(5,'Luca','Gialli','1995-07-12','luca.gialli@email.com','3398887766','2023-05-05','Esperto','Brass Birmingham, Scythe','Giocatore molto competitivo.'),
(6,'Sofia','Marrone','2000-12-03','sofia.marrone@email.com','3472233444','2023-06-18','Principiante','Dixit','Partecipa volentieri alle serate a tema.'),
(7,'Davide','Viola','1982-04-25','davide.viola@email.com','3356677889','2023-07-22','Intermedio','Wingspan, Root','Appassionato di giochi di strategia.'),
(8,'Elena','Arancio','1998-08-10','elena.arancio@email.com','3497788990','2023-08-03','Esperto','Spirit Island, Mage Knight','Conosce a memoria le regole di ogni gioco.'),
(9,'Matteo','Celeste','2005-01-30','matteo.celeste@email.com','3284455667','2023-09-14','Principiante','Monopoly Deal','Gioca spesso con gli amici.'),
(10,'Giulia','Rosa','1975-06-07','giulia.rosa@email.com','3451122334','2023-10-29','Intermedio','Splendor, Carcassonne','Membro attivo del club.'),
(11,'Cane','Pazzo','2015-02-04','test@teste.it','','2025-02-28','Intermedio','rubamazzetto','ganzo'),
(13,'Cane','Pazzo','2015-02-04','testdc@teste.it','','2025-02-28','Intermedio','rubamazzetto','ganzo');
/*!40000 ALTER TABLE `iscritti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `livello` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(3,'admin','$2y$10$5OThg1YatiDww3m7QGDxOu/tOM09yp76W940PvjpTZzb.ABQ7VSCW',9),
(8,'ospite','$2y$10$BMmiMQdwhn7KD6AFOKEXoOTnuwBUHSLbrFq6ON2qgAK4i8Ekk1YK.',0),
(9,'ciccio','$2y$10$TgbaB0op70dezeRetVwCiO9rqodnIiIcimsX2ufkoKwhFVoKI0/Z.',7),
(10,'cuoricini','$2y$10$/saH73xIwh2lS4e5HGDbPOa9QGc/z.KqCiyahM/51eSO.6/QeG3Om',0),
(11,'cuoricinifa','$2y$10$BLtqrMSddtppN2LEN6n.2O3GjoBeFqRyEsWqBoCOqJwdVy3IaMg6q',0);
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

-- Dump completed on 2025-03-06  8:09:32
