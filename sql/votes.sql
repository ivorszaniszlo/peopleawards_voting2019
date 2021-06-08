-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2018 at 10:29 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `org` varchar(60) NOT NULL,
  `pos` varchar(60) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `org`, `pos`, `candidate_id`, `voters_id`) VALUES
(1, 'PROFESSION.HU', 'A Csapat', 63, 676),
(2, 'PROFESSION.HU', 'Az Innovátor', 47, 676),
(3, 'PROFESSION.HU', 'Az Ügyfélélmény-építő', 55, 676),
(4, 'RAS Cégcsoport', 'Az Innovátor', 1, 676),
(5, 'RAS Cégcsoport', 'A Történetmesélő', 6, 676),
(6, 'RAS Cégcsoport', 'A Csapat', 37, 676),
(7, 'RAS Cégcsoport', 'A Kolléga', 29, 676);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
