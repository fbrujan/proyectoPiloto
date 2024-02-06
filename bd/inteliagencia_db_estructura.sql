-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: inteliagencia_db:3306
-- Generation Time: Feb 06, 2024 at 05:13 PM
-- Server version: 10.9.3-MariaDB-1:10.9.3+maria~ubu2204
-- PHP Version: 8.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inteliagencia`
--
DROP DATABASE IF EXISTS `inteliagencia`;
CREATE DATABASE IF NOT EXISTS `inteliagencia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `inteliagencia`;

-- --------------------------------------------------------

--
-- Table structure for table `cajas`
--

DROP TABLE IF EXISTS `cajas`;
CREATE TABLE IF NOT EXISTS `cajas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caja` varchar(20) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cellsites`
--

DROP TABLE IF EXISTS `cellsites`;
CREATE TABLE IF NOT EXISTS `cellsites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_operadora` int(11) NOT NULL,
  `celda_id` varchar(50) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `celda_num` int(11) DEFAULT NULL,
  `tecnologia` varchar(10) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `latitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cellsite` (`celda_id`,`id_operadora`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `operadoras`
--

DROP TABLE IF EXISTS `operadoras`;
CREATE TABLE IF NOT EXISTS `operadoras` (
  `id_operadora` int(11) NOT NULL AUTO_INCREMENT,
  `operadora` varchar(50) NOT NULL,
  PRIMARY KEY (`id_operadora`),
  UNIQUE KEY `operadora` (`operadora`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `padron`
--

DROP TABLE IF EXISTS `padron`;
CREATE TABLE IF NOT EXISTS `padron` (
  `tipo_documento` varchar(10) NOT NULL DEFAULT 'Cédula',
  `nro_documento` varchar(100) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  UNIQUE KEY `documento_identidad` (`nro_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `suscriptores`
--

DROP TABLE IF EXISTS `suscriptores`;
CREATE TABLE IF NOT EXISTS `suscriptores` (
  `id_operadora` int(11) NOT NULL,
  `nro_telefonico` varchar(50) NOT NULL,
  `imsi` varchar(50) DEFAULT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `estado_actual` int(11) NOT NULL DEFAULT 0 COMMENT '1 = Activo, 0 = Inactivo',
  `nro_documento` varchar(100) DEFAULT NULL,
  UNIQUE KEY `suscriptor` (`nro_telefonico`,`fecha_inicio`),
  KEY `nroDocumento` (`nro_documento`),
  KEY `numeroroDocumento` (`nro_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trafico`
--

DROP TABLE IF EXISTS `trafico`;
CREATE TABLE IF NOT EXISTS `trafico` (
  `id_operadora` int(11) NOT NULL,
  `codigo_llamada` varchar(100) NOT NULL,
  `telefono_a` varchar(50) DEFAULT NULL,
  `telefono_b` varchar(50) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `duracion` int(11) NOT NULL DEFAULT 0,
  `cellsite_origen` varchar(50) DEFAULT NULL,
  `cellsite_destino` varchar(50) DEFAULT NULL,
  `imsi_a` varchar(50) DEFAULT NULL,
  `imsi_b` varchar(50) DEFAULT NULL,
  `imei_a` varchar(50) DEFAULT NULL,
  `imei_b` varchar(50) DEFAULT NULL,
  `direccion_llamada` int(11) DEFAULT 0 COMMENT '0 = entrante, \r\n1 = saliente, \r\n2 = No Especificado',
  PRIMARY KEY (`codigo_llamada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
