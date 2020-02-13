-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 25, 2019 at 08:17 AM
-- Server version: 5.7.23
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oxy`
--
CREATE DATABASE IF NOT EXISTS `oxy` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `oxy`;

-- --------------------------------------------------------

--
-- Table structure for table `cdata`
--

CREATE TABLE `cdata` (
  `id` int(11) NOT NULL,
  `cid` varchar(100) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `udate` varchar(100) NOT NULL,
  `ctype` varchar(100) NOT NULL,
  `checkin` varchar(100) NOT NULL,
  `checkout` varchar(100) NOT NULL,
  `stock` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cdata`
--

INSERT INTO `cdata` (`id`, `cid`, `cname`, `udate`, `ctype`, `checkin`, `checkout`, `stock`) VALUES
(1, '1', 'Mr. Omkar Kakeru', '2019-01-27', 'Oxygen', '0', '10', '10'),
(2, '3', 'Casements Africa', '2019-01-27', 'Nitrogen', '0', '7', '7'),
(3, '3', 'Casements Africa', '2019-02-04', 'Oxygen', '5', '0', '-5'),
(4, '3', 'Casements Africa', '2019-02-05', 'Oxygen', '22', '24', '-3'),
(5, '3', 'Casements Africa', '2019-02-05', 'Hydrogen', '2', '21', '-4'),
(6, '3', 'Casements Africa', '2019-02-06', 'Oxygen', '0', '3', '0'),
(7, '3', 'Casements Africa', '2019-02-06', 'Hydrogen', '2', '4', '0'),
(8, '3', 'Casements Africa', '2019-02-06', 'Nitrogen', '7', '7', '0'),
(9, '3', 'Casements Africa', '2019-02-09', 'Helium', '22', '22', '0'),
(10, '2', 'Norvik Hospital', '2019-02-07', 'Nitrogen', '0', '3', '3'),
(11, '2', 'Norvik Hospital', '2019-02-07', 'Oxygen', '3', '3', '0'),
(12, '3', 'Casements Africa', '2019-02-22', 'Nitrogen', '5', '5', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ctype`
--

CREATE TABLE `ctype` (
  `id` int(11) NOT NULL,
  `ctype` varchar(100) NOT NULL,
  `stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ctype`
--

INSERT INTO `ctype` (`id`, `ctype`, `stock`) VALUES
(1, 'Nitrogen', 40),
(2, 'Oxygen', 70),
(3, 'Hydrogen', 90),
(4, 'Helium', 0),
(5, 'Argon', 100);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `con` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `mail`, `con`) VALUES
(1, 'Mr. Omkar Kakeru', 'Kampala', 'omkar.kakeru@gmail.com', '+256700781234'),
(2, 'Norvik Hospital', 'Wlliam Street, Kampala', 'info@norvik.co.ug', '+256707012121'),
(3, 'Casements Africa', '5th Street, Kampala', 'info@casements.co.ug', '+256707012231');

-- --------------------------------------------------------

--
-- Table structure for table `filled`
--

CREATE TABLE `filled` (
  `id` int(100) NOT NULL,
  `edate` varchar(100) DEFAULT NULL,
  `ctype` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL DEFAULT '',
  `action` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filled`
--

INSERT INTO `filled` (`id`, `edate`, `ctype`, `qty`, `action`) VALUES
(34, '2019-01-25', 'Argon', '5', 'Filled'),
(35, '2019-01-27', 'Hydrogen', '5', 'Filled'),
(36, '2019-02-04', 'Oxygen', '2', 'Damaged'),
(37, '2019-02-04', 'Oxygen', '2', 'Repaired'),
(38, '2019-02-06', 'Hydrogen', '4', 'Filled'),
(39, '2019-02-06', 'Hydrogen', '1', 'Filled'),
(40, '2019-02-06', 'Helium', '22', 'Filled'),
(41, '2019-02-22', 'Nitrogen', '5', 'Filled');

-- --------------------------------------------------------

--
-- Table structure for table `gasdata`
--

CREATE TABLE `gasdata` (
  `id` int(100) NOT NULL,
  `edate` varchar(100) NOT NULL,
  `ctype` varchar(100) NOT NULL,
  `stock` varchar(100) NOT NULL,
  `empty` varchar(100) NOT NULL,
  `filled` varchar(100) NOT NULL,
  `checkin` varchar(100) NOT NULL,
  `checkout` varchar(100) NOT NULL,
  `damaged` varchar(100) NOT NULL,
  `repaired` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gasdata`
--

INSERT INTO `gasdata` (`id`, `edate`, `ctype`, `stock`, `empty`, `filled`, `checkin`, `checkout`, `damaged`, `repaired`) VALUES
(1, '2019-01-23', 'Nitrogen', '40', '40', '0', '0', '0', '0', '0'),
(2, '2019-01-24', 'Oxygen', '70', '60', '10', '0', '0', '0', '0'),
(3, '2019-01-23', 'Hydrogen', '90', '75', '0', '0', '0', '15', '0'),
(4, '2019-01-23', 'Argon', '100', '100', '0', '0', '0', '0', '0'),
(5, '2019-01-24', 'Nitrogen', '40', '35', '5', '0', '0', '0', '0'),
(6, '2019-01-25', 'Nitrogen', '40', '20', '20', '0', '0', '0', '0'),
(7, '2019-01-25', 'Oxygen', '70', '5', '65', '0', '0', '0', '0'),
(8, '2019-01-25', 'Argon', '100', '85', '5', '0', '0', '10', '5'),
(9, '2019-01-25', 'Hydrogen', '90', '85', '0', '0', '0', '5', '10'),
(10, '2019-01-27', 'Hydrogen', '90', '80', '5', '0', '0', '5', '10'),
(11, '2019-01-27', 'Oxygen', '60', '5', '55', '0', '10', '0', '0'),
(12, '2019-01-27', 'Nitrogen', '33', '20', '13', '0', '7', '0', '0'),
(13, '2019-02-04', 'Oxygen', '65', '10', '55', '5', '0', '0', '2'),
(14, '2019-02-05', 'Oxygen', '53', '32', '21', '22', '34', '0', '0'),
(15, '2019-02-05', 'Hydrogen', '85', '80', '0', '0', '5', '5', '0'),
(17, '2019-02-05', 'Nitrogen', '30', '20', '10', '0', '10', '0', '0'),
(18, '2019-02-06', 'Oxygen', '50', '32', '18', '0', '37', '0', '0'),
(19, '2019-02-06', 'Hydrogen', '82', '77', '0', '2', '5', '5', '0'),
(20, '2019-02-06', 'Nitrogen', '30', '27', '3', '7', '7', '0', '0'),
(21, '2019-02-07', 'Nitrogen', '27', '27', '0', '0', '3', '0', '0'),
(22, '2019-02-07', 'Oxygen', '50', '35', '15', '3', '3', '0', '0'),
(23, '2019-02-22', 'Nitrogen', '27', '27', '0', '5', '5', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `rentry`
--

CREATE TABLE `rentry` (
  `id` int(11) NOT NULL,
  `cid` varchar(100) NOT NULL,
  `edate` varchar(100) NOT NULL,
  `ctype` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rentry`
--

INSERT INTO `rentry` (`id`, `cid`, `edate`, `ctype`, `qty`, `action`) VALUES
(1, '1', '2019-01-27', 'Oxygen', '10', 'Out'),
(2, '2', '2019-01-27', 'Nitrogen', '7', 'Out'),
(3, '3', '2019-02-04', 'Oxygen', '5', 'In'),
(5, '3', '2019-02-05', 'Oxygen', '20', 'Out'),
(6, '3', '2019-02-05', 'Oxygen', '10', 'In'),
(11, '3', '2019-02-05', 'Hydrogen', '1', 'Out'),
(14, '3', '2019-02-05', 'Oxygen', '2', 'Out'),
(15, '3', '2019-02-05', 'Oxygen', '2', 'Out'),
(16, '3', '2019-02-05', 'Oxygen', '2', 'In'),
(17, '3', '2019-02-06', 'Oxygen', '3', 'Out'),
(18, '3', '2019-02-06', 'Hydrogen', '4', 'Out'),
(19, '3', '2019-02-06', 'Hydrogen', '1', 'In'),
(20, '3', '2019-02-06', 'Hydrogen', '1', 'Out'),
(21, '3', '2019-02-06', 'Nitrogen', '10', 'Out'),
(22, '3', '2019-02-06', 'Nitrogen', '5', 'In'),
(23, '3', '2019-02-06', 'Nitrogen', '5', 'In'),
(24, '3', '2019-02-06', 'Nitrogen', '10', 'In'),
(25, '3', '2019-02-06', 'Nitrogen', '5', 'Out'),
(26, '3', '2019-02-06', 'Nitrogen', '5', 'Out'),
(27, '3', '2019-02-06', 'Nitrogen', '2', 'Out'),
(28, '3', '2019-02-06', 'Nitrogen', '5', 'Out'),
(29, '3', '2019-02-06', 'Nitrogen', '2', 'Out'),
(30, '3', '2019-02-06', 'Nitrogen', '5', 'Out'),
(31, '3', '2019-02-06', 'Nitrogen', '2', 'Out'),
(32, '3', '2019-02-06', 'Hydrogen', '1', 'In'),
(33, '3', '2019-02-06', 'Helium', '10', 'In'),
(34, '3', '2019-02-06', 'Helium', '12', 'In'),
(35, '3', '2019-02-06', 'Helium', '2', 'Out'),
(36, '3', '2019-02-06', 'Nitrogen', '2', 'In'),
(37, '3', '2019-02-06', 'Helium', '20', 'Out'),
(38, '3', '2019-02-06', 'Nitrogen', '5', 'In'),
(39, '2', '2019-02-07', 'Nitrogen', '3', 'Out'),
(40, '2', '2019-02-07', 'Nitrogen', '3', 'Out'),
(41, '2', '2019-02-07', 'Oxygen', '3', 'In'),
(42, '2', '2019-02-07', 'Oxygen', '3', 'Out'),
(43, '3', '2019-02-22', 'Nitrogen', '5', 'In'),
(44, '3', '2019-02-22', 'Nitrogen', '5', 'Out');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) NOT NULL,
  `rname` varchar(30) NOT NULL,
  `rdesc` varchar(100) NOT NULL,
  `acc_code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `rname`, `rdesc`, `acc_code`) VALUES
(8, 'Full Access', 'Full Access', 'INDEX;A01;A02;A03;A07;A06;A08;C03;C04;C05;C06;');

-- --------------------------------------------------------

--
-- Table structure for table `stockupdate`
--

CREATE TABLE `stockupdate` (
  `id` int(11) NOT NULL,
  `edate` varchar(100) NOT NULL,
  `ctype` varchar(100) NOT NULL,
  `stock` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stockupdate`
--

INSERT INTO `stockupdate` (`id`, `edate`, `ctype`, `stock`) VALUES
(1, '2019-01-25', 'Nitrogen', '10'),
(2, '2019-01-25', 'Oxygen', '20'),
(3, '2019-01-25', 'Hydrogen', '30'),
(4, '2019-01-25', 'Nitrogen', '30'),
(5, '2019-01-25', 'Oxygen', '50'),
(6, '2019-01-25', 'Hydrogen', '60'),
(7, '2019-01-25', 'Argon', '100');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `role` int(10) NOT NULL,
  `active` int(2) NOT NULL,
  `llogin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `pass`, `role`, `active`, `llogin`) VALUES
(2, 'admin', 'Administrator', 'cf964d16eba49f7347608b6b9fac21af70a8a9a8', 8, 1, '18/10/2018 09:10 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cdata`
--
ALTER TABLE `cdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctype`
--
ALTER TABLE `ctype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ctype` (`ctype`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filled`
--
ALTER TABLE `filled`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gasdata`
--
ALTER TABLE `gasdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentry`
--
ALTER TABLE `rentry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rname` (`rname`);

--
-- Indexes for table `stockupdate`
--
ALTER TABLE `stockupdate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
