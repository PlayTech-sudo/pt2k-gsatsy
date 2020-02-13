-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 25, 2019 at 09:41 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `ctype`
--

CREATE TABLE `ctype` (
  `id` int(11) NOT NULL,
  `ctype` varchar(100) NOT NULL,
  `stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
