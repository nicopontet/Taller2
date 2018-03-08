CREATE DATABASE  IF NOT EXISTS `mascotas` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mascotas`;
-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: mascotas
-- ------------------------------------------------------
-- Server version	5.7.20-19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `barrios`
--

DROP TABLE IF EXISTS `barrios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barrios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barrios`
--

LOCK TABLES `barrios` WRITE;
/*!40000 ALTER TABLE `barrios` DISABLE KEYS */;
INSERT INTO `barrios` VALUES (1,'Aguada'),(2,'Buceo'),(3,'Centro'),(4,'La Blanqueada'),(5,'Maroñas'),(6,'Jacinto Vera'),(7,'Parque Batlle'),(8,'Pocitos'),(9,'Malvín'),(10,'Punta Carretas'),(11,'Carrasco'),(12,'Sayago'),(13,'Peñarol');
/*!40000 ALTER TABLE `barrios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especies`
--

DROP TABLE IF EXISTS `especies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especies`
--

LOCK TABLES `especies` WRITE;
/*!40000 ALTER TABLE `especies` DISABLE KEYS */;
INSERT INTO `especies` VALUES (1,'Perros'),(2,'Gatos'),(3,'Conejos'),(4,'Aves'),(5,'Otros');
/*!40000 ALTER TABLE `especies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preguntas`
--

DROP TABLE IF EXISTS `preguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_publicacion` int(11) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `respuesta` varchar(255) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pregunta_publicacion_idx` (`id_publicacion`),
  KEY `fk_pregunta_usuario_idx` (`usuario_id`),
  CONSTRAINT `fk_pregunta_publicacion` FOREIGN KEY (`id_publicacion`) REFERENCES `publicaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pregunta_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preguntas`
--

LOCK TABLES `preguntas` WRITE;
/*!40000 ALTER TABLE `preguntas` DISABLE KEYS */;
INSERT INTO `preguntas` VALUES (1,3,'¿A que hora se perdió?','A las 18:00 aproximadamente',1),(2,3,'¿Ya lo encontraron?',NULL,1);
/*!40000 ALTER TABLE `preguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicaciones`
--

DROP TABLE IF EXISTS `publicaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) NOT NULL,
  `descripcion` longtext NOT NULL,
  `tipo` char(1) NOT NULL,
  `especie_id` int(11) NOT NULL,
  `raza_id` int(11) DEFAULT NULL,
  `barrio_id` int(11) NOT NULL,
  `abierto` bit(1) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `exitoso` bit(1) DEFAULT NULL,
  `latitud` decimal(10,8) DEFAULT NULL,
  `longitud` decimal(11,8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_publicacion_usuario_idx` (`usuario_id`),
  KEY `fk_publicacion_especie_idx` (`especie_id`),
  KEY `fk_publicacion_raza_idx` (`raza_id`),
  KEY `fk_publicacion_barrio_idx` (`barrio_id`),
  CONSTRAINT `fk_publicacion_barrio` FOREIGN KEY (`barrio_id`) REFERENCES `barrios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_publicacion_especie` FOREIGN KEY (`especie_id`) REFERENCES `especies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_publicacion_raza` FOREIGN KEY (`raza_id`) REFERENCES `razas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_publicacion_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicaciones`
--

LOCK TABLES `publicaciones` WRITE;
/*!40000 ALTER TABLE `publicaciones` DISABLE KEYS */;
INSERT INTO `publicaciones` VALUES (1,'Encontrado en Peñarol','Fue encontrado este perrito en el barrio Peñarol en las inmediaciones de la cooperativa Mesa 2, está asustado y aulla. Se agradese información para devolverlo a sus dueños. Muchas gracias.','E',1,7,13,'',1,NULL,-34.82296900,-56.20121800),(2,'Ovejero en la Playa','Perro Ovejero aleman joven grande, se encuentra caminando sin rumbo en playa de El Buceo, esta muy muy lastimada su boca, con mucha tristeza y mucho dolor, esta precisando realmente ayuda urgente, segun un vecino dice que hace unos dias esta caminando, se agradece a alguien que lo pueda ayudar ya que se encuentra bien.','E',1,5,2,'\0',1,'',-34.90103100,-56.12275500),(3,'Thor','se perdio en 8 de octubre y garibaldi, color negro tamaño grande es manso se llama thor, se recompensarà, tel 094 XXX XXX','P',1,6,4,'',2,NULL,-34.88916200,-56.16065800);
/*!40000 ALTER TABLE `publicaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `razas`
--

DROP TABLE IF EXISTS `razas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `razas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `especie_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_raza_especie_idx` (`especie_id`),
  CONSTRAINT `fk_raza_especie` FOREIGN KEY (`especie_id`) REFERENCES `especies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `razas`
--

LOCK TABLES `razas` WRITE;
/*!40000 ALTER TABLE `razas` DISABLE KEYS */;
INSERT INTO `razas` VALUES (1,1,'Cocker'),(2,1,'Labrador'),(3,1,'Bull Dog'),(4,1,'Salchicha'),(5,1,'Ovejero Alemán'),(6,1,'Cruza'),(7,1,'Otros'),(11,2,'Persa'),(12,2,'Siamés'),(13,2,'Sphynx'),(14,2,'Otros'),(15,3,'Doméstico'),(16,4,'Loros'),(17,4,'Papagayos'),(18,4,'Otros'),(19,5,'Tortugas'),(20,5,'Serpientes'),(21,5,'Arañas');
/*!40000 ALTER TABLE `razas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'juan.perez@test.com','Juan Perez','test'),(2,'agonzalez@otro.com','Ana Gonzalez','test');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-17 11:40:40
