-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 10:55 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookinfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookinfo`
--

CREATE TABLE `bookinfo` (
  `bookid` int(11) NOT NULL,
  `isbn` varchar(12) NOT NULL,
  `title` varchar(100) NOT NULL,
  `classification` varchar(25) NOT NULL,
  `publisher` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookinfo`
--

INSERT INTO `bookinfo` (`bookid`, `isbn`, `title`, `classification`, `publisher`) VALUES
(77, 'fgsfsdf', 'dfgsdfsdf', 'dfgsdfsdf', 'dfgdfgsdfsdf'),
(80, 'fg', 'dfg', 'dfg', 'dfgdfg'),
(81, 'fg', 'dfg', 'dfg', 'dfgdfg'),
(82, 'fg', 'dfg', 'dfg', 'dfgdfg'),
(84, 'fg', 'dfg', 'dfg', 'dfgdfg'),
(85, 'fg', 'dfg', 'dfg', 'dfgdfg'),
(86, 'fg', 'dfg', 'dfg', 'dfgdfg'),
(87, 'fff', 'ffffffdada', 'fff', 'ff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookinfo`
--
ALTER TABLE `bookinfo`
  ADD PRIMARY KEY (`bookid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookinfo`
--
ALTER TABLE `bookinfo`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
