-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2020 at 08:22 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `myaddressbook`
--

CREATE TABLE `myaddressbook` (
  `id` int(6) UNSIGNED NOT NULL,
  `firstname` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `mail` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `phone` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `myaddressbook`
--

INSERT INTO `myaddressbook` (`id`, `firstname`, `lastname`, `mail`, `phone`) VALUES
(1, 'John', 'Doe', 'john@example.com', 41777777),
(2, 'Janez', 'Novak', 'aaa@bbb.com', 31447766),
(3, 'Mojca', 'Kovač', 'mojca@kovac.si', 51236554),
(4, 'Metka', 'Rozman', 'rozica356@gmail.com', 41323100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `myaddressbook`
--
ALTER TABLE `myaddressbook`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `myaddressbook`
--
ALTER TABLE `myaddressbook`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
