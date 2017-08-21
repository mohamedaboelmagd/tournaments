-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2017 at 12:27 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourments`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `home_team` varchar(11) NOT NULL,
  `away_team` varchar(11) NOT NULL,
  `goals_in` int(11) DEFAULT NULL,
  `goals_out` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `home_team`, `away_team`, `goals_in`, `goals_out`) VALUES
(3, 'alahly', 'zamalek', 1, 3),
(4, 'masry', 'zamalek', 2, 2),
(5, 'Ismaly', 'alahly', 2, 5),
(6, 'alahly', 'zamalek', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

CREATE TABLE `ranking` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `matches_played` int(11) NOT NULL DEFAULT '0',
  `win` int(11) NOT NULL DEFAULT '0',
  `draw` int(11) NOT NULL DEFAULT '0',
  `loss` int(11) NOT NULL DEFAULT '0',
  `goals_in` int(11) NOT NULL DEFAULT '0',
  `goals_out` int(11) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ranking`
--

INSERT INTO `ranking` (`id`, `team_id`, `matches_played`, `win`, `draw`, `loss`, `goals_in`, `goals_out`, `points`) VALUES
(8, 5, 3, 1, 1, 1, 8, 7, 4),
(9, 6, 3, 1, 2, 0, 7, 5, 5),
(10, 7, 1, 0, 1, 0, 2, 2, 1),
(11, 8, 1, 0, 0, 1, 2, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `logo` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `logo`) VALUES
(5, 'alahly', '/images/img1.png'),
(6, 'zamalek', '/images/img1.png'),
(7, 'masry', '/images/img1.png'),
(8, 'Ismaly', '/images/img1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_2` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ranking`
--
ALTER TABLE `ranking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
