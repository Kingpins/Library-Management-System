-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2020 at 07:55 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookdetails`
--

CREATE TABLE `bookdetails` (
  `bnumber` varchar(10) NOT NULL,
  `bname` varchar(20) NOT NULL,
  `bauthor` varchar(20) NOT NULL,
  `bpublication` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookdetails`
--

INSERT INTO `bookdetails` (`bnumber`, `bname`, `bauthor`, `bpublication`) VALUES
('112200', 'Digital Electronics', 'ASK', 'ASK'),
('112210', 'Computer Architectur', 'DAS', 'DAS');

-- --------------------------------------------------------

--
-- Table structure for table `issuebook`
--

CREATE TABLE `issuebook` (
  `ID` varchar(20) NOT NULL,
  `issuedate` date NOT NULL,
  `renewaldate` date NOT NULL,
  `bnumber` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `repassword` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `email`, `password`, `repassword`) VALUES
('ask', 'ask@gmail.com', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `recipitdetails`
--

CREATE TABLE `recipitdetails` (
  `invoiceid` int(10) NOT NULL,
  `studentid` varchar(15) NOT NULL,
  `totalmoney` varchar(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipitdetails`
--

INSERT INTO `recipitdetails` (`invoiceid`, `studentid`, `totalmoney`, `date`) VALUES
(1, '16ECE20', '5', '2019-11-27'),
(2, '16ECE20', '20.5', '2019-11-27'),
(3, '16ECE20', '368893.5', '2019-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `ID` varchar(10) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `sgender` text NOT NULL,
  `sdep` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipitdetails`
--
ALTER TABLE `recipitdetails`
  ADD PRIMARY KEY (`invoiceid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipitdetails`
--
ALTER TABLE `recipitdetails`
  MODIFY `invoiceid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
