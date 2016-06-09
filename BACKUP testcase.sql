-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2016 at 08:48 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testcase`
--

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE `steps` (
  `id` int(11) NOT NULL,
  `step` varchar(45) DEFAULT NULL,
  `regression` mediumtext,
  `result` longtext,
  `pass` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testcase`
--

CREATE TABLE `testcase` (
  `id` int(11) NOT NULL,
  `tid` varchar(150) DEFAULT NULL,
  `description` mediumtext,
  `applicable` varchar(45) DEFAULT NULL,
  `requirements` varchar(45) DEFAULT NULL,
  `steps` mediumtext,
  `comments` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testresult`
--

CREATE TABLE `testresult` (
  `id` int(11) NOT NULL,
  `testID` varchar(90) DEFAULT NULL,
  `testName` varchar(90) DEFAULT NULL,
  `testNum` varchar(90) DEFAULT NULL,
  `pass` varchar(90) DEFAULT NULL,
  `fail` varchar(90) DEFAULT NULL,
  `taker` varchar(90) DEFAULT NULL,
  `html` mediumtext,
  `browser` varchar(90) DEFAULT NULL,
  `device` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `steps`
--
ALTER TABLE `steps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testcase`
--
ALTER TABLE `testcase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testresult`
--
ALTER TABLE `testresult`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `steps`
--
ALTER TABLE `steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;
--
-- AUTO_INCREMENT for table `testcase`
--
ALTER TABLE `testcase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `testresult`
--
ALTER TABLE `testresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
