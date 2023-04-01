-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2023 at 04:35 PM
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
(1, 'cat1'),
(2, 'cat2');

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
  `category` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `content`, `author`, `pdate`, `category`) VALUES
(2, 'Titular', '<p>Postular</p>', 'poster', '2023-03-30', 'cat1'),
(3, 'title2', '<p>post 2</p>', 'poster', '2023-03-30', 'cat2');

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
  `active` varchar(5) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `dor`, `access`, `fname`, `sname`, `active`, `avatar`) VALUES
(6, 'evan', '$2y$10$3zwj32U5xo7/y7aka1YgSu71mA5Jr6AZKngggTNqxbWLpuNNOVOfe', '2023-03-18', 1, 'Kaleb', 'Evanoff', '', ''),
(7, 'Joshua', '$2y$10$lO3.2OYxQJ2rTwQM5Mweu.4nPy.mwXaVmbz7qiVAUhsa5yQS/aRhy', '2023-03-18', 2, 'Josh', 'Hann', 'False', 'default.jpg'),
(8, 'admin', '$2y$10$FRFea3lyWf8EHzYlijvFfu2ag0V70EOxCUbHrdtXdOsSamYUzCFSO', '2023-03-25', 1, 'Josh', 'Hann', '', 'default.jpg'),
(9, 'sir', '$2y$10$bpuJucGto3.A6oF2w45t/Og1FBXjsHyDcWWvJKhli2t.Fpc1UAuGO', '2023-03-27', 1, 'Geoff', 'Thompson', '', 'default.jpg'),
(10, 'day', '$2y$10$8cnSG9kBRzybbv532vc1wOHJEc2vQHmoqjZ2/plJSEEuhCdkwrmf6', '2023-03-29', 2, 'day', 'night', 'True', 'default.jpg'),
(11, 'poster', '$2y$10$8U5g8MZw9sw0tyJrbA6XNubNLY2ubwrxUx/ZeUJQxeK.q//AKxE3a', '2023-03-30', 2, 'internet', 'warrior', 'True', 'default.jpg'),
(12, 'mod', '$2y$10$5IyXPtslDpfNQ6K8KcOF0OivWhD0z5UIN2ojU2u39XJxEqsYnLnCO', '2023-03-30', 1, 'mod', 'mod', '', 'default.jpg');

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
