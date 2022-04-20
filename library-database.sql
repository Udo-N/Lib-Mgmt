-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2022 at 07:33 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library-database`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(45) COLLATE utf8_bin NOT NULL,
  `image` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `availability` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `image`, `availability`) VALUES
(1, 'The Facility', '../images/book1.jpg', 1),
(2, 'Subjects', '../images/book3.jpg', 1),
(3, 'The Order', '../images/book4.jpg', 1),
(4, 'Upsilon', '../images/upsilon.jpg', 1),
(5, 'A Random Book', '../images/book2.jpg', 1),
(6, 'Modelling', '../images/book5.jpg', 1),
(7, 'Autobiography', '../images/book6.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `uname` varchar(45) COLLATE utf8_bin NOT NULL,
  `book_id` int(11) NOT NULL,
  `type` varchar(9) COLLATE utf8_bin NOT NULL,
  `approval_status` varchar(8) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`uname`, `book_id`, `type`, `approval_status`) VALUES
('AName', 1, 'booking', 'approved'),
('AName', 3, 'reservati', 'approved'),
('usernameA', 1, 'booking', 'approved'),
('usernameA', 1, 'booking', 'approved'),
('usernameA', 1, 'booking', 'approved'),
('AName', 1, 'booking', 'approved'),
('usernameA', 1, 'booking', 'approved'),
('usernameA', 1, 'booking', 'approved'),
('usernameA', 1, 'booking', 'approved'),
('usernameA', 1, 'booking', 'approved'),
('usernameA', 1, 'reservati', 'approved'),
('usernameA', 1, 'reservati', 'approved'),
('usernameA', 1, 'booking', 'approved'),
('usernameA', 1, 'reservati', 'approved'),
('usernameA', 1, 'booking', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uname` varchar(45) COLLATE utf8_bin NOT NULL,
  `pwd` varchar(45) COLLATE utf8_bin NOT NULL,
  `admin` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uname`, `pwd`, `admin`) VALUES
('', '', 0),
('AName', 'password3', 0),
('BName', 'bpassword', 0),
('UNjoku', 'pwd2', 0),
('fqgykJI7FDj18CO9dPXpmL6V4Zab0hoMSKnsGwRezQtrH', 'D6TJb7Kq9UmfBEkgteOZYlXSi5PFWwxnsAoL3I82apR4M', 0),
('usernameA', 'passwordA', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD KEY `users_requests_fk` (`uname`),
  ADD KEY `books_requests_fk` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uname`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `books_requests_fk` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_requests_fk` FOREIGN KEY (`uname`) REFERENCES `users` (`uname`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
