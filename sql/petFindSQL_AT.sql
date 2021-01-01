-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 01, 2021 at 07:53 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petFinder_AT`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_passwd` varchar(255) NOT NULL,
  `account_reg_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `account_enabled` tinyint(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_name`, `account_passwd`, `account_reg_time`, `account_enabled`) VALUES
(1, 'AaditUs3r', '$2y$10$3s7WvROcJyD8Ciam1FncF.PfoSv8dISjaq0Xn/r9S.vSJkD0dH.xm', '2020-12-05 01:54:14', 1),
(2, 'TaylorR', '$2y$10$Ki5P23ZyVNxjJlw7f0jakuIjb/0/slT7jj7GO3QzJvuaG869EtLdG', '2020-12-05 23:10:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_sessions`
--

CREATE TABLE `account_sessions` (
  `session_id` varchar(255) NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_sessions`
--

INSERT INTO `account_sessions` (`session_id`, `account_id`, `login_time`) VALUES
('3412d049e95c3489a33aa91eee4d6ee0', 1, '2020-12-05 07:38:07'),
('4e1b7ca1d2b654c3b2c0c0d6bdc108f0', 1, '2020-12-05 02:21:42'),
('64847b7054444d254fd4df15723c93a1', 1, '2020-12-05 01:54:53'),
('6a7237460ea2dad263affa54f023371e', 2, '2020-12-05 23:13:50'),
('f27c9a845b2f11938da166966569db2c', 1, '2020-12-07 20:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `found`
--

CREATE TABLE `found` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `age` varchar(10) DEFAULT NULL,
  `day` date DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lon` varchar(50) DEFAULT NULL,
  `contact` varchar(50) NOT NULL,
  `info` text DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `display` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `found`
--

INSERT INTO `found` (`id`, `type`, `color`, `weight`, `age`, `day`, `lat`, `lon`, `contact`, `info`, `account_id`, `display`) VALUES
(14, 'Dog', 'Black', '10', '12', '2020-09-09', '-79', '36', '111-111-2222', '', 1, 0),
(15, 'Dog', 'Black', '', '', '2020-09-24', '', '', '000-111-2222', '', 1, 0),
(16, 'Dog', 'Black', '10', '10', '2020-12-16', '-79.01', '35.02', '111-222-2221', '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `missing`
--

CREATE TABLE `missing` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `age` varchar(10) DEFAULT NULL,
  `day` date DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lon` varchar(50) DEFAULT NULL,
  `contact` varchar(50) NOT NULL,
  `info` text DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `display` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `missing`
--

INSERT INTO `missing` (`id`, `type`, `color`, `weight`, `age`, `day`, `lat`, `lon`, `contact`, `info`, `account_id`, `display`) VALUES
(13, 'Dog', 'Black', '', '', '2020-10-15', '-79', '36', '222-333-3311', '', 1, 0),
(14, 'Dog', 'Black', '10', '20', '2020-12-02', '-78', '36', '111-222-1122', '', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `account_name` (`account_name`);

--
-- Indexes for table `account_sessions`
--
ALTER TABLE `account_sessions`
  ADD PRIMARY KEY (`session_id`);

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

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `found`
--
ALTER TABLE `found`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `missing`
--
ALTER TABLE `missing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
