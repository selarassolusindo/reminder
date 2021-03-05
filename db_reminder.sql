-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2021 at 10:25 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_reminder`
--

-- --------------------------------------------------------

--
-- Table structure for table `t01_company`
--

CREATE TABLE `t01_company` (
  `idcompany` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t01_company`
--

INSERT INTO `t01_company` (`idcompany`, `Nama`, `created_at`, `updated_at`) VALUES
(1, 'PT. Andalan Mandiri Raya', '2021-03-04 06:30:58', '2021-03-04 06:30:58'),
(2, 'PT. Moerni Jaya Sakti', '2021-03-04 06:31:10', '2021-03-04 06:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `t05_property`
--

CREATE TABLE `t05_property` (
  `idproperty` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t05_property`
--

INSERT INTO `t05_property` (`idproperty`, `Nama`, `created_at`, `updated_at`) VALUES
(1, 'ASTON BOJONEGORO CITY HOTEL', '2021-03-04 07:11:22', '2021-03-04 07:11:22'),
(2, 'FAVEHOTEL SUDIRMAN BOJONEGORO', '2021-03-04 07:11:41', '2021-03-04 07:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `t06_main`
--

CREATE TABLE `t06_main` (
  `idmain` int(11) NOT NULL,
  `Kode` varchar(5) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t07_sub`
--

CREATE TABLE `t07_sub` (
  `idsub` int(11) NOT NULL,
  `idmain` int(11) NOT NULL,
  `Kode` varchar(5) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t08_description`
--

CREATE TABLE `t08_description` (
  `iddescription` int(11) NOT NULL,
  `idsub` int(11) NOT NULL,
  `Kode` varchar(5) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t01_company`
--
ALTER TABLE `t01_company`
  ADD PRIMARY KEY (`idcompany`);

--
-- Indexes for table `t05_property`
--
ALTER TABLE `t05_property`
  ADD PRIMARY KEY (`idproperty`);

--
-- Indexes for table `t06_main`
--
ALTER TABLE `t06_main`
  ADD PRIMARY KEY (`idmain`);

--
-- Indexes for table `t07_sub`
--
ALTER TABLE `t07_sub`
  ADD PRIMARY KEY (`idsub`);

--
-- Indexes for table `t08_description`
--
ALTER TABLE `t08_description`
  ADD PRIMARY KEY (`iddescription`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t01_company`
--
ALTER TABLE `t01_company`
  MODIFY `idcompany` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t05_property`
--
ALTER TABLE `t05_property`
  MODIFY `idproperty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t06_main`
--
ALTER TABLE `t06_main`
  MODIFY `idmain` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t07_sub`
--
ALTER TABLE `t07_sub`
  MODIFY `idsub` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t08_description`
--
ALTER TABLE `t08_description`
  MODIFY `iddescription` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
