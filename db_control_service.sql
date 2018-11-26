CREATE DATABASE  IF NOT EXISTS `db_control_service` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_control_service`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_control_service
-- ------------------------------------------------------
-- Server version	5.6.37-log

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
-- Table structure for table `servico`
--

DROP TABLE IF EXISTS `servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servico` (
  `Codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Descricao` varchar(100) NOT NULL,
  `Valor` decimal(15,2) NOT NULL,
  `Dataservico` date NOT NULL,
  `Cadastro` datetime NOT NULL,
  `CodUsuario` int(10) unsigned NOT NULL,
  `CodTipo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `fk_Servico_Usuario_idx` (`CodUsuario`),
  KEY `fk_Servico_Tipo1_idx` (`CodTipo`),
  CONSTRAINT `fk_Servico_Tipo1` FOREIGN KEY (`CodTipo`) REFERENCES `tiposervico` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Servico_Usuario` FOREIGN KEY (`CodUsuario`) REFERENCES `usuario` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico`
--

LOCK TABLES `servico` WRITE;
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
INSERT INTO `servico` VALUES (4,'Montagem com peças novas',50.00,'2018-11-24','2018-11-24 15:43:56',8,4),(5,'Somente windows',110.00,'2018-11-30','2018-11-24 18:42:11',8,1),(6,'Cartões com 3 cores. 1000 unidades.',199.90,'2018-12-15','2018-11-25 15:46:20',8,5),(7,'Com peças novas.',93.52,'2019-01-03','2018-11-25 16:32:31',8,4),(10,'Van com 16 lugares fora o motorista',350.00,'2019-02-02','2018-11-26 00:21:13',7,9),(11,'Van com 150 lugares',340.00,'2019-02-28','2018-11-26 01:03:58',10,6),(12,'TV com defeito',150.00,'2018-11-26','2018-11-26 01:04:52',10,8),(13,'fora as peças',110.00,'2018-11-27','2018-11-26 01:09:14',7,4),(14,'Locação para o show Mariana e Matheus',950.00,'2019-01-17','2018-11-26 01:33:18',15,7),(15,'1000 unidades preço por milheiro',100.00,'2018-12-12','2018-11-26 01:34:02',15,5),(16,'Serviço voluntário',0.00,'2018-11-28','2018-11-26 01:48:56',16,3),(17,'Com limpeza interna',198.00,'2018-11-29','2018-11-26 01:49:40',16,1);
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiposervico`
--

DROP TABLE IF EXISTS `tiposervico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiposervico` (
  `Codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `CodUsuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `fk_Tiposervico_Usuario1_idx` (`CodUsuario`),
  CONSTRAINT `fk_Tiposervico_Usuario1` FOREIGN KEY (`CodUsuario`) REFERENCES `usuario` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiposervico`
--

LOCK TABLES `tiposervico` WRITE;
/*!40000 ALTER TABLE `tiposervico` DISABLE KEYS */;
INSERT INTO `tiposervico` VALUES (1,'Formatação de PC\'s',1),(3,'Assentamento de Piso',1),(4,'Montagem de móveis',8),(5,'Impressão de cartões',1),(6,'Excursão para Copacabana - RJ',1),(7,'Locação de Telão/Data Show',1),(8,'Reparo em Eletroeletrônicos',1),(9,'Transporte de Van',13);
/*!40000 ALTER TABLE `tiposervico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `Codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(100) NOT NULL,
  `Ativo` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `Perfil` smallint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 - Usuário comum\n2 - Administrador',
  `Cadastro` datetime NOT NULL,
  PRIMARY KEY (`Codigo`),
  UNIQUE KEY `Email_UNIQUE` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Admin Master ','admin@admin.com','1234',1,2,'2018-11-23 00:00:00'),(7,'User 01','user01@email.com','123456',1,1,'2018-11-23 21:41:15'),(8,'User 02','user02@email.br','123',1,1,'2018-11-23 21:47:35'),(9,'Reinaldo Soares (Naldo)','naldinho@email.com','123',1,2,'2018-11-24 02:20:48'),(10,'Helio Fernandez Silva','helinho@email.br','123',1,1,'2018-11-24 03:15:44'),(13,'Carlos Ferreira Souto','carlosfs@live.com','123',1,2,'2018-11-26 00:01:05'),(15,'Anderson Vieira Reis','avreis@gmail.com','123',1,1,'2018-11-26 00:53:26'),(16,'Albert Robins','albert@email.com','123',1,1,'2018-11-26 01:48:00');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-26  1:56:31
