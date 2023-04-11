-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 07:34 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beta`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(1, 'Category 1'),
(2, 'Category 2');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `author` varchar(33) NOT NULL,
  `pdate` date NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `content`, `author`, `pdate`, `category`) VALUES
(1, '', '', '', '0000-00-00', 0),
(2, 'Title', '', 'reddit', '2023-03-29', 0),
(3, 'title 2', '', 'reddit', '2023-03-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(33) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dor` date NOT NULL,
  `access` int(1) NOT NULL,
  `fname` varchar(33) NOT NULL,
  `sname` varchar(33) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `dor`, `access`, `fname`, `sname`, `avatar`) VALUES
(6, 'Kaleb', '$2y$10$3zwj32U5xo7/y7aka1YgSu71mA5Jr6AZKngggTNqxbWLpuNNOVOfe', '2023-03-18', 1, 'Kaleb', 'Evanoff', ''),
(7, 'Shnizzie', '$2y$10$lO3.2OYxQJ2rTwQM5Mweu.4nPy.mwXaVmbz7qiVAUhsa5yQS/aRhy', '2023-03-18', 1, 'Josh', 'Hann', 'default.jpg'),
(8, 'admin', '$2y$10$FRFea3lyWf8EHzYlijvFfu2ag0V70EOxCUbHrdtXdOsSamYUzCFSO', '2023-03-25', 2, 'Josh', 'Hann', 'default.jpg'),
(9, 'Editor', '$2y$10$MxTl2luU1lfVo6zOHQ6LrechF8TVKzxoxvS3iDhFRC5dfDQ839sTe', '2023-03-28', 1, 'j', 'h', 'default.jpg'),
(10, 'edit', '$2y$10$eRqLDLHkx72.DMNDUmoGQuah06Yt6v2H.pBrKbRL20m.6IHOPx2Eu', '2023-03-28', 1, 'edit', 'edit', 'default.jpg'),
(11, 'reddit', '$2y$10$KK8w/5FP4qqXy.ccBQFVt.9cUwzo4NMom16cHeMozISS8ZYy7mjBy', '2023-03-28', 2, 'reddit', 'reddit', 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
