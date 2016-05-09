-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2016 at 08:51 PM
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
  `result` mediumtext,
  `pass` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`id`, `step`, `regression`, `result`, `pass`) VALUES
(1, '1', 'Blah 1				', 'I expected Blah 1', 'P'),
(2, '2', 'Blah 2', 'I expect Blah 2', 'a'),
(3, '1', '<p>Blah 1</p>', '<p>I expected Blah 1</p>', 'Passed'),
(4, '2', 'Blah 2', 'I expect Blah 2', 'Passed'),
(5, '3', 'fail	', 'fail', ' Failed'),
(6, '4', '4', '4 f', ' Failed');

-- --------------------------------------------------------

--
-- Table structure for table `testcase`
--

CREATE TABLE `testcase` (
  `id` int(11) NOT NULL,
  `tid` varchar(45) DEFAULT NULL,
  `description` mediumtext,
  `applicable` varchar(45) DEFAULT NULL,
  `requirements` varchar(45) DEFAULT NULL,
  `steps` mediumtext,
  `comments` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testcase`
--

INSERT INTO `testcase` (`id`, `tid`, `description`, `applicable`, `requirements`, `steps`, `comments`) VALUES
(1, 'CMS01', '<p>This is my description.</p>', 'Dave', 'Test builder', '3,4,5,6', '<p>Comments!</p>'),
(2, 'test image import', '', '', '', '', '<p><img src="data:image/png;base64,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" alt="" /></p>');

-- --------------------------------------------------------

--
-- Table structure for table `testresult`
--

CREATE TABLE `testresult` (
  `id` int(11) NOT NULL,
  `testID` varchar(45) DEFAULT NULL,
  `testName` varchar(45) DEFAULT NULL,
  `testNum` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `fail` varchar(45) DEFAULT NULL,
  `taker` varchar(45) DEFAULT NULL,
  `html` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testresult`
--

INSERT INTO `testresult` (`id`, `testID`, `testName`, `testNum`, `pass`, `fail`, `taker`, `html`) VALUES
(1, '1', 'CMS01-0', '0', '3', '1', 'Brendon', '<html><body><h1>Test Submission - CMS01</h1><p><b>Test Description:</b> <p>This is my description.</p></p><p><b>Test %</b> 0.75</p><p><b>Test Taken by:</b> Brendon</p><p><b>Passed:</b> 3</p><p><b>Failed:</b> 1</p><table><tr><th>Step</th><th>Regression</th><th>Expected</th><th>Pass/Fail</th><th>Notes</th></tr><tr><td>1</td><td><p>Blah 1</p></td><td><p>I expected Blah 1</p></td><td>Failed</td><td><p>I failed Test 1</p></td></tr><tr><td>2</td><td>Blah 2</td><td>I expect Blah 2</td><td>Passed</td><td></td></tr><tr><td>3</td><td>fail	</td><td>fail</td><td>Passed</td><td></td></tr><tr><td>4</td><td>4</td><td>4 f</td><td>Passed</td><td></td></tr></table><p>Completed on: 2016-05-09 14:41:44</p></body></html>'),
(2, '1', 'CMS01-1', '1', '4', '0', 'Brendon', '<html><body><h1>Test Submission - CMS01</h1><p><b>Test Description:</b> <p>This is my description.</p></p><p><b>Test %</b> 1</p><p><b>Test Taken by:</b> Brendon</p><p><b>Passed:</b> 4</p><p><b>Failed:</b> 0</p><table><tr><th>Step</th><th>Regression</th><th>Expected</th><th>Pass/Fail</th><th>Notes</th></tr><tr><td>1</td><td><p>Blah 1</p></td><td><p>I expected Blah 1</p></td><td>Passed</td><td><p>Passed the second time</p></td></tr><tr><td>2</td><td>Blah 2</td><td>I expect Blah 2</td><td>Passed</td><td><p>Pass</p></td></tr><tr><td>3</td><td>fail	</td><td>fail</td><td>Passed</td><td><p>Pass</p></td></tr><tr><td>4</td><td>4</td><td>4 f</td><td>Passed</td><td><p>Pass</p></td></tr></table><p>Completed on: 2016-05-09 14:45:32</p></body></html>');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `testcase`
--
ALTER TABLE `testcase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `testresult`
--
ALTER TABLE `testresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
