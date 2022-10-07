-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2022 at 09:55 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scoreboarding`
--

-- --------------------------------------------------------

--
-- Table structure for table `audittrail`
--

CREATE TABLE `audittrail` (
  `audit_id` int(8) NOT NULL,
  `roundindex` int(8) NOT NULL,
  `questionindex` int(8) NOT NULL,
  `school_id` int(8) NOT NULL,
  `score` int(8) NOT NULL,
  `timing` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audittrail`
--

INSERT INTO `audittrail` (`audit_id`, `roundindex`, `questionindex`, `school_id`, `score`, `timing`) VALUES
(73, 1, 2, 1, 2, '2022-10-06 00:08:34'),
(74, 1, 5, 2, 2, '2022-10-06 00:09:42'),
(75, 1, 4, 3, 0, '2022-10-06 00:09:58'),
(76, 1, 1, 4, 2, '2022-10-06 00:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `currentschool`
--

CREATE TABLE `currentschool` (
  `id` int(8) NOT NULL,
  `sch_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `currentschool`
--

INSERT INTO `currentschool` (`id`, `sch_id`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `masterscreen`
--

CREATE TABLE `masterscreen` (
  `id` int(8) NOT NULL,
  `round` int(8) NOT NULL,
  `qnumber` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masterscreen`
--

INSERT INTO `masterscreen` (`id`, `round`, `qnumber`) VALUES
(1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `nextquest`
--

CREATE TABLE `nextquest` (
  `id` int(8) NOT NULL,
  `nextquestindex` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nextquest`
--

INSERT INTO `nextquest` (`id`, `nextquestindex`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `qindex`
--

CREATE TABLE `qindex` (
  `id` int(8) NOT NULL,
  `qnumber` int(8) NOT NULL,
  `question` text NOT NULL,
  `optiona` text NOT NULL,
  `optionb` text NOT NULL,
  `optionc` text NOT NULL,
  `optiond` text NOT NULL,
  `correctanswer` text NOT NULL,
  `answered` int(8) NOT NULL DEFAULT 0,
  `round` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qindex`
--

INSERT INTO `qindex` (`id`, `qnumber`, `question`, `optiona`, `optionb`, `optionc`, `optiond`, `correctanswer`, `answered`, `round`) VALUES
(33, 1, 'What is the full meaning of \"KWIRS\"?', 'Kwara Inland Revenue System', 'Kwara Internal Revenue System', 'Kwara Internal Revenue Service', 'Kwara State Internal Revenue Service', 'Kwara State Internal Revenue Service', 0, 0),
(34, 2, 'Evaluate : (2 + 2)/4', '1', '14', '11', '9', '1', 0, 0),
(35, 3, 'What is the Address of KWIRS Head office?', '27 Ahmadu Bello way, GRA, Ilorin', '29 Ahmadu Bello Way, GRA, Ilorin', 'Plot 27 Ahmadu bello Way, CBN Qtrs, Ilorin.', 'Opposite Tuyil, Irewolede road, Ilorin', '27 Ahmadu Bello way, GRA, Ilorin', 0, 0),
(36, 1, 'what is the name of kwara state Gov.?', 'Mallam Abd. Rahman Abd. Rasak', 'Mallam Bukola Saraki', 'Mallam Fatai Arogunjo', 'Ibrahim Eletu', 'Mallam Abd. Rahman Abd. Rasak', 1, 1),
(37, 2, 'In the Tax Club logo, how many colors are there-in?', '3', '2', '1', '5', '3', 1, 1),
(38, 3, 'Hello, How are you?', 'I am fine, Thanks.', 'You are not serious', 'Let me catch you', 'I will rip you off', 'I am fine, Thanks.', 1, 1),
(39, 4, 'Who is the presidential candidate of the Labour Party?', 'Bola Ahmed Tinubu', 'Peter Gregory Obi', 'Atiku Abubabakar', 'Dumebi Kachukwu', 'Peter Gregory Obi', 1, 1),
(40, 5, 'Who is the presidential flag bearer of the APC?', 'Senator Ibikunle Amosun', 'Senator Bola Ahmed Tinubu', 'Prof. Yemi Osinbajo', 'Rt. Rotimi Amaechi', 'Senator Bola Ahmed Tinubu', 1, 1),
(41, 6, 'How many hours are in 3 days?', '24', '72', '64', '120', '72', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questionindex`
--

CREATE TABLE `questionindex` (
  `id` int(8) NOT NULL,
  `qnumb` int(8) NOT NULL,
  `question` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `sch_id` int(8) NOT NULL,
  `school_names` varchar(50) NOT NULL,
  `school_image` varchar(30) DEFAULT NULL,
  `score` int(8) NOT NULL,
  `time_entered` datetime NOT NULL,
  `extra` int(8) DEFAULT NULL,
  `t2` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`sch_id`, `school_names`, `school_image`, `score`, `time_entered`, `extra`, `t2`) VALUES
(1, 'AdeSchool', NULL, 2, '2022-10-06 00:08:34', NULL, NULL),
(2, 'Elizabethy', NULL, 2, '2022-10-06 00:09:42', NULL, NULL),
(3, 'bschool', NULL, 0, '2022-10-06 00:09:58', NULL, NULL),
(4, 'kunleschool', NULL, 2, '2022-10-06 00:10:19', NULL, NULL),
(5, 'klo', NULL, 0, '2022-10-05 23:58:21', NULL, NULL),
(6, 'malik', NULL, 0, '2022-10-05 23:58:21', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audittrail`
--
ALTER TABLE `audittrail`
  ADD PRIMARY KEY (`audit_id`);

--
-- Indexes for table `currentschool`
--
ALTER TABLE `currentschool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masterscreen`
--
ALTER TABLE `masterscreen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nextquest`
--
ALTER TABLE `nextquest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qindex`
--
ALTER TABLE `qindex`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionindex`
--
ALTER TABLE `questionindex`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`sch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audittrail`
--
ALTER TABLE `audittrail`
  MODIFY `audit_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `currentschool`
--
ALTER TABLE `currentschool`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `masterscreen`
--
ALTER TABLE `masterscreen`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nextquest`
--
ALTER TABLE `nextquest`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `qindex`
--
ALTER TABLE `qindex`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `questionindex`
--
ALTER TABLE `questionindex`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `sch_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
