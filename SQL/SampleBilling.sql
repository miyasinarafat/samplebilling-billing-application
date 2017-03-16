-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2017 at 01:11 অপরাহ্ণ
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SampleBilling`
--

-- --------------------------------------------------------

--
-- Table structure for table `php_bkash`
--

CREATE TABLE `php_bkash` (
  `id` int(11) UNSIGNED NOT NULL,
  `trxId` int(11) DEFAULT NULL,
  `sender` varchar(15) DEFAULT NULL,
  `ref` varchar(100) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_table`
--

CREATE TABLE `transaction_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `bkasht_id` int(255) NOT NULL,
  `is_accept` int(11) NOT NULL,
  `is_new` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `accepted` datetime NOT NULL,
  `remain` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_table`
--

INSERT INTO `transaction_table` (`id`, `user_id`, `unique_id`, `amount`, `bkasht_id`, `is_accept`, `is_new`, `created`, `accepted`, `remain`) VALUES
(9, 3, '5877cdec67e0d', 1111111111, 2147483647, 0, 0, '2017-01-13 12:41:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 3, '5877ce0393ee7', 33333333, 4444444, 0, 1, '2017-01-13 12:42:11', '0000-00-00 00:00:00', '2017-01-13 12:47:36'),
(11, 3, '5877ce0d3e364', 2147483647, 2147483647, 1, 1, '2017-01-13 12:42:21', '2017-01-13 12:47:34', '0000-00-00 00:00:00'),
(12, 3, '5877ce1995897', 2147483647, 888888888, 0, 1, '2017-01-13 12:42:33', '0000-00-00 00:00:00', '2017-01-13 12:46:33'),
(13, 3, '5877ce2353ce1', 99999999, 101010, 1, 1, '2017-01-13 12:42:43', '2017-01-13 12:46:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fb_profile_url` varchar(255) NOT NULL,
  `is_admin` int(11) NOT NULL,
  `is_delete` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `restore` datetime NOT NULL,
  `deleted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `unique_id`, `name`, `password`, `email`, `phone`, `fb_profile_url`, `is_admin`, `is_delete`, `created`, `modified`, `restore`, `deleted`) VALUES
(1, '587537ab98cd9', 'MD Iyasin Arafat', '@A123@456', 'arafat@gmail.com', '01921875585', 'https://www.facebook.com', 1, 0, '2017-01-11 01:36:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '5877c4c65e817', 'Naim Islam', '123456', 'naim@gmail.com', '016872626562', 'https://www.facebook.com', 0, 0, '2017-01-13 12:02:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '58ca67c8348af', 'test', 'test', 'test@gmail.com', '0192187558500', 'https://www.facebook.com', 0, 1, '2017-03-16 04:24:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2017-03-16 04:24:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `php_bkash`
--
ALTER TABLE `php_bkash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trxId` (`trxId`);

--
-- Indexes for table `transaction_table`
--
ALTER TABLE `transaction_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `php_bkash`
--
ALTER TABLE `php_bkash`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction_table`
--
ALTER TABLE `transaction_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
