-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 02:08 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uems`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `employeeid` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `securityquestion1` varchar(255) NOT NULL,
  `securityquestion2` varchar(255) NOT NULL,
  `securityquestion3` varchar(255) NOT NULL,
  `pass1` varchar(255) NOT NULL,
  `pass2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`firstname`, `lastname`, `employeeid`, `emailid`, `securityquestion1`, `securityquestion2`, `securityquestion3`, `pass1`, `pass2`) VALUES
('sameera', 'sineen', 'SLU0000028', 'ss@gmail.com', 'baby', 'Bangalore', 'green', 'Sameera@085', 'Sameera@085'),
('Mounika', 'Bireddy', 'SLU1111100', 'mounikabireddy58@gmail.com', 'mou', 'St. Louis', 'black', 'Mounika@12x', 'Mounika@12x'),
('sai', 'bireddy', 'SLU1111101', 'sai@gmail.com', 'sai', 'bangalore', 'green', 'Saireddy@123', 'Saireddy@123'),
('sai', 'bireddy', 'SLU1111104', 'sai@gmail.com', 'sai', 'bangalore', 'green', 'Saireddy@123', 'Saireddy@123'),
('Mounika', 'Bireddy', 'SLU1111110', 'sai@gmail.com', 'mou', 'St. Louis', 'green', 'Saireddy@123', 'Saireddy@123'),
('Venkat', 'Chilukuri', 'SLU1234567', 'venkatkiriti@gmail.com', 'venkat', 'Bangalore', 'white', 'Venkat@123', 'Venkat@123');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventid` int(11) NOT NULL,
  `eventname` varchar(255) NOT NULL,
  `noofparticipants` varchar(255) NOT NULL,
  `event_time` time DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `venue` varchar(255) NOT NULL,
  `eventdescription` text NOT NULL,
  `imagepath` text NOT NULL,
  `filename` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventid`, `eventname`, `noofparticipants`, `event_time`, `event_date`, `venue`, `eventdescription`, `imagepath`, `filename`) VALUES
(11, 'Song', '2', '12:11:00', '2023-11-29', 'Busch', 'Sing a song', 'uploads/ba645c3c4c412796cd16906c64a010f0.jpg', 'ba645c3c4c412796cd16906c64a010f0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `regisid` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `bannerid` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `eventid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`regisid`, `fullname`, `bannerid`, `emailid`, `eventid`) VALUES
(10, 'Mounika', '001290479', 'mounikabireddy58@gmail.com', '11');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `bannerid` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `securityquestion1` varchar(255) NOT NULL,
  `securityquestion2` varchar(255) NOT NULL,
  `securityquestion3` varchar(255) NOT NULL,
  `pass1` varchar(255) NOT NULL,
  `pass2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`firstname`, `lastname`, `bannerid`, `emailid`, `securityquestion1`, `securityquestion2`, `securityquestion3`, `pass1`, `pass2`) VALUES
('Sreeja', 'Sangras', '001257447', 'sreeja.sangras@slu.edu', 'chikki', 'hyd', 'white', 'Sangras@123', 'Sangras@123'),
('Mounika', 'Bireddy', '001290479', 'mounikabireddy58@gmail.com', 'mou', 'St. Louis', 'blue', 'Mounika@123', 'Mounika@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`employeeid`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`regisid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`bannerid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `regisid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
