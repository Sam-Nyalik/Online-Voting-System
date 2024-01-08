-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 08, 2024 at 04:00 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineVotingSystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `politicalParty` varchar(200) NOT NULL,
  `constituency` varchar(200) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `fullName`, `politicalParty`, `constituency`, `date_created`) VALUES
(1, 'John Odhiambo', 'Red Party', 'Western-Shangri-la', '2024-01-07 23:10:47'),
(2, 'David Malan', 'Blue Party', 'New-Felucia', '2024-01-08 11:49:26'),
(3, 'John Otiato', 'Independent*', 'Western-Shangri-la', '2024-01-08 16:01:13'),
(4, 'Brooke Adima', 'Yellow Party', 'Naboo-Vallery', '2024-01-08 16:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `constituency`
--

CREATE TABLE `constituency` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `constituency`
--

INSERT INTO `constituency` (`id`, `name`) VALUES
(1, 'Shangri-la-Town'),
(2, 'Northern-Kunlun-Mountain'),
(3, 'Western-Shangri-la'),
(4, 'Naboo-Vallery'),
(5, 'New-Felucia');

-- --------------------------------------------------------

--
-- Table structure for table `electionOfficer`
--

CREATE TABLE `electionOfficer` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `emailAddress` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `electionOfficer`
--

INSERT INTO `electionOfficer` (`id`, `fullName`, `emailAddress`, `password`) VALUES
(9, 'John Doe', 'election@shangrila.gov.sr', '$2y$10$6K3qdNAjwIN3cXNnewU3mOxgMNtgnfI9iY.d.G0gQjKt1C.Y9WU52');

-- --------------------------------------------------------

--
-- Table structure for table `politicalParty`
--

CREATE TABLE `politicalParty` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dateCreated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `politicalParty`
--

INSERT INTO `politicalParty` (`id`, `name`, `dateCreated`) VALUES
(1, 'Blue Party', '2024-01-07 22:44:17'),
(2, 'Red Party', '2024-01-07 22:44:26'),
(3, 'Yellow Party', '2024-01-07 22:44:35'),
(4, 'Independent*', '2024-01-07 22:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `uvc`
--

CREATE TABLE `uvc` (
  `id` int(11) NOT NULL,
  `code` varchar(8) NOT NULL,
  `dateCreated` datetime DEFAULT current_timestamp(),
  `voter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uvc`
--

INSERT INTO `uvc` (`id`, `code`, `dateCreated`, `voter_id`) VALUES
(1, 'HH64FWPE', '2024-01-06 13:11:46', NULL),
(2, 'BBMNS9ZJ', '2024-01-07 23:17:47', NULL),
(3, 'KYMK9PUH', '2024-01-07 23:19:29', NULL),
(4, 'WL3K3YPT', '2024-01-07 23:19:40', NULL),
(5, 'JA9WCMAS', '2024-01-07 23:19:49', NULL),
(6, 'Z93G7PN9', '2024-01-07 23:19:58', NULL),
(7, 'WPC5GEHA', '2024-01-07 23:20:06', NULL),
(8, 'RXLNLTA6', '2024-01-07 23:20:16', NULL),
(9, '7XUFD78Y', '2024-01-07 23:22:19', NULL),
(10, 'DBP4GQBQ', '2024-01-07 23:22:32', NULL),
(11, 'ZSRBTK9S', '2024-01-07 23:22:43', NULL),
(12, 'B7DMPWCQ', '2024-01-07 23:22:50', NULL),
(13, 'YADA47RL', '2024-01-07 23:23:00', NULL),
(14, '9GTZQNKB', '2024-01-07 23:23:40', NULL),
(15, 'KSM9NB5L', '2024-01-07 23:23:48', NULL),
(16, 'BQCRWTSG', '2024-01-07 23:23:58', NULL),
(17, 'ML5NSKKG', '2024-01-07 23:24:06', NULL),
(18, 'D5BG6FDH', '2024-01-07 23:24:14', NULL),
(19, '2LJFM6PM', '2024-01-07 23:24:23', NULL),
(20, '38NWLPY3', '2024-01-07 23:24:31', NULL),
(21, '2TEHRTHJ', '2024-01-07 23:24:40', NULL),
(22, 'G994LD9T', '2024-01-07 23:24:47', NULL),
(23, 'Q452KVQE', '2024-01-07 23:24:56', NULL),
(24, '75NKUXAH', '2024-01-07 23:25:03', NULL),
(25, 'DHKVCU8T', '2024-01-07 23:25:12', NULL),
(26, 'TH9A6HUB', '2024-01-07 23:25:20', NULL),
(27, '2E5BHT5R', '2024-01-07 23:25:29', NULL),
(28, '556JTA32', '2024-01-07 23:25:36', NULL),
(29, 'LUFKZAHW', '2024-01-07 23:25:44', NULL),
(30, 'DBAD57ZR', '2024-01-07 23:25:52', NULL),
(31, 'K96JNSXY', '2024-01-07 23:26:01', NULL),
(32, 'PFXB8QXM', '2024-01-07 23:26:11', NULL),
(33, '8TEXF2HD', '2024-01-07 23:26:20', NULL),
(34, 'N6HBFD2X', '2024-01-07 23:26:28', NULL),
(35, 'K3EVS3NM', '2024-01-07 23:26:36', NULL),
(36, '5492AC6V', '2024-01-07 23:26:45', NULL),
(37, 'U5LGC65X', '2024-01-07 23:26:53', NULL),
(38, 'BKMKJN5S', '2024-01-07 23:27:02', NULL),
(39, 'JF2QD3UF', '2024-01-07 23:27:17', NULL),
(40, 'NW9ETHS7', '2024-01-07 23:27:27', NULL),
(41, 'VFBH8W6W', '2024-01-07 23:27:35', NULL),
(42, '7983XU4M', '2024-01-07 23:27:43', NULL),
(43, '2GYDT5D3', '2024-01-07 23:27:51', NULL),
(44, 'LVTFN8G5', '2024-01-07 23:27:59', NULL),
(45, 'UNP4A5T7', '2024-01-07 23:28:07', NULL),
(46, 'UMT3RLVS', '2024-01-07 23:28:18', NULL),
(47, 'TZZZCJV8', '2024-01-07 23:28:28', NULL),
(48, 'UVE5M7FR', '2024-01-07 23:28:37', NULL),
(49, 'W44QP7XJ', '2024-01-07 23:28:46', NULL),
(50, '9FCV9RMT', '2024-01-07 23:28:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `voterId` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `constituency` varchar(200) NOT NULL,
  `uvc` varchar(8) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateCreated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`voterId`, `fullName`, `emailAddress`, `dateOfBirth`, `constituency`, `uvc`, `password`, `dateCreated`) VALUES
(20, 'fiona nyalik', 'fiona@gmail.com', '1988-01-13', 'Western-Shangri-la', 'KYMK9PUH', '$2y$10$qUWfmI1hGJcXyX8DdO0LyO1XC6Dd8mWf0G5YCGjnqC5dj/hIo5qHm', '2024-01-08 11:44:10'),
(21, 'sam nyalik', 'sam@gmail.com', '1988-01-13', 'Northern-Kunlun-Mountain', 'WPC5GEHA', '$2y$10$NVZes9eXdJ5istxZcYleCuAcUqcPBQ12DVvD/racsZ8Pbo16s28NG', '2024-01-08 11:46:56'),
(22, 'john doe', 'john@gmail.com', '1988-01-13', 'Northern-Kunlun-Mountain', '9GTZQNKB', '$2y$10$et6CjOipberLRU6cAJ.SweMd0jD4KsnZzaR.ocCQ4jcEdZUfoLwYi', '2024-01-08 11:47:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `constituency`
--
ALTER TABLE `constituency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electionOfficer`
--
ALTER TABLE `electionOfficer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `politicalParty`
--
ALTER TABLE `politicalParty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uvc`
--
ALTER TABLE `uvc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voter_id` (`voter_id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`voterId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `constituency`
--
ALTER TABLE `constituency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `electionOfficer`
--
ALTER TABLE `electionOfficer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `politicalParty`
--
ALTER TABLE `politicalParty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uvc`
--
ALTER TABLE `uvc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `voterId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `uvc`
--
ALTER TABLE `uvc`
  ADD CONSTRAINT `uvc_ibfk_1` FOREIGN KEY (`voter_id`) REFERENCES `voters` (`voterId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
