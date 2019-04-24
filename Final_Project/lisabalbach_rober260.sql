-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2019 at 08:44 PM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lisabalbach_rober260`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_users`
--

CREATE TABLE `auth_users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(41) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_users`
--

INSERT INTO `auth_users` (`id`, `firstName`, `lastName`, `username`, `password`) VALUES
(1, 'richard', 'robertson', 'rober260', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `computer`
--

CREATE TABLE `computer` (
  `id` int(11) NOT NULL,
  `top_id` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `serialNum` varchar(25) DEFAULT NULL,
  `modelNum` varchar(30) DEFAULT NULL,
  `dept` char(5) DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `computer`
--

INSERT INTO `computer` (`id`, `top_id`, `date_added`, `date_modified`, `serialNum`, `modelNum`, `dept`, `description`) VALUES
(1, 1, '2019-04-17 14:31:42', '2019-04-17 14:31:42', 'ads234554f', 'a1663', 'IT', 'macbook air 2016'),
(4, 4, '2019-04-22 13:52:51', '2019-04-22 13:52:51', '12343kfjdh', 'a5772', 'PM', 'macbook pro 2016');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `top_id` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `type` enum('home','work','other') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `top_id`, `date_added`, `date_modified`, `email`, `type`) VALUES
(1, 1, '2019-04-17 14:31:42', '2019-04-17 14:31:42', 'Rich.robertson2@outlook.com', 'other'),
(4, 4, '2019-04-22 13:52:51', '2019-04-22 13:52:51', 'Gkaborge@gmail.com', 'home');

-- --------------------------------------------------------

--
-- Table structure for table `employeename`
--

CREATE TABLE `employeename` (
  `id` int(11) NOT NULL,
  `date_hired` datetime DEFAULT NULL,
  `firstName` varchar(75) DEFAULT NULL,
  `lastName` varchar(75) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employeename`
--

INSERT INTO `employeename` (`id`, `date_hired`, `firstName`, `lastName`) VALUES
(1, '2019-04-22 13:45:04', 'Richard', 'Robertson'),
(4, '2019-04-22 13:52:51', 'George', 'Kaborge');

-- --------------------------------------------------------

--
-- Table structure for table `telephone`
--

CREATE TABLE `telephone` (
  `id` int(11) NOT NULL,
  `top_id` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `tel_number` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `telephone`
--

INSERT INTO `telephone` (`id`, `top_id`, `date_added`, `date_modified`, `tel_number`) VALUES
(1, 1, '2019-04-17 14:31:42', '2019-04-17 14:31:42', '2313578536'),
(4, 4, '2019-04-22 13:52:51', '2019-04-22 13:52:51', '2316459989');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_users`
--
ALTER TABLE `auth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `computer`
--
ALTER TABLE `computer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employeename`
--
ALTER TABLE `employeename`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telephone`
--
ALTER TABLE `telephone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_users`
--
ALTER TABLE `auth_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `computer`
--
ALTER TABLE `computer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employeename`
--
ALTER TABLE `employeename`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `telephone`
--
ALTER TABLE `telephone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
