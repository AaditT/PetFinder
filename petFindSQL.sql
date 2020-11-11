-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2020 at 12:51 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_find`
--

-- --------------------------------------------------------

--
-- Table structure for table `found`
--

CREATE TABLE `found` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `time_found` date DEFAULT NULL,
  `found_lat` varchar(50) DEFAULT NULL,
  `found_lon` varchar(50) DEFAULT NULL,
  `contact_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `found`
--

INSERT INTO `found` (`id`, `type`, `color`, `time_found`, `found_lat`, `found_lon`, `contact_number`) VALUES
(1, 'Dog', 'black', '2020-10-15', '-77.032', '38.913', '222-222-2222');

-- --------------------------------------------------------

--
-- Table structure for table `missing`
--

CREATE TABLE `missing` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `last_seen_time` date DEFAULT NULL,
  `last_seen_lat` varchar(50) DEFAULT NULL,
  `last_seen_lon` varchar(50) DEFAULT NULL,
  `contact_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `missing`
--

INSERT INTO `missing` (`id`, `type`, `color`, `last_seen_time`, `last_seen_lat`, `last_seen_lon`, `contact_number`) VALUES
(1, 'dog', 'brown', '2020-10-04', '-122.414', '37.776', '111-111-1111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `found`
--
ALTER TABLE `found`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missing`
--
ALTER TABLE `missing`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
