-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: inteliagencia_db:3306
-- Generation Time: Feb 06, 2024 at 06:31 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `operadoras`
--

CREATE TABLE IF NOT EXISTS `operadoras` (
  `id_operadora` int(11) NOT NULL AUTO_INCREMENT,
  `operadora` varchar(50) NOT NULL,
  PRIMARY KEY (`id_operadora`),
  UNIQUE KEY `operadora` (`operadora`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operadoras`
--

INSERT INTO `operadoras` (`id_operadora`, `operadora`) VALUES
(3, 'Altice Dominicana (Orance - Tricom)'),
(2, 'Claro Dominicana (Codetel)'),
(1, 'Trilogy Dominicana (Viva)');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
