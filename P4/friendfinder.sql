-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 20, 2020 at 12:36 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.22

DROP DATABASE IF EXISTS friendfinder;
CREATE DATABASE friendfinder;
USE friendfinder;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `friendfinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `fid` int(11) NOT NULL,
  `uid1` int(11) DEFAULT NULL,
  `uid2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`fid`, `uid1`, `uid2`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 4),
(4, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `short_title` tinytext NOT NULL,
  `title` text NOT NULL,
  `body` longtext NOT NULL,
  `UID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`short_title`, `title`, `body`, `UID`) VALUES
('short title', 'long title', 'body2', 1),
('new', 'newenw', 'dsdsadas', 1),
('toilet', 'Is it safe to pour greenbeans in the toilet', 'asking for a friend', 2),
('test1', 'test2', 'test3', 4),
('order', 'Big Smokes Order', 'I`ll have two number nines, a number nine large, a number six with extra dip, a number seven, two number forty-fives, one with cheese, and a large soda.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `name`, `password`) VALUES
(1, 'Robert', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'Ryan', '5f4dcc3b5aa765d61d8327deb882cf99'),
(3, 'newuser', 'c4ca4238a0b923820dcc509a6f75849b'),
(4, 'test', '5a105e8b9d40e1329780d62ea2265d8a'),
(5, 'bread', 'c602c949788bd3e2a6a9e6f509b6adf6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `uid1` (`uid1`),
  ADD KEY `uid2` (`uid2`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `friend_ibfk_1` FOREIGN KEY (`uid1`) REFERENCES `users` (`UID`),
  ADD CONSTRAINT `friend_ibfk_2` FOREIGN KEY (`uid2`) REFERENCES `users` (`UID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
