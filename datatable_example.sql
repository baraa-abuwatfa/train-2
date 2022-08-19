-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19 أغسطس 2022 الساعة 19:45
-- إصدار الخادم: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datatable_example`
--

-- --------------------------------------------------------

--
-- بنية الجدول `dept`
--

CREATE TABLE `dept` (
  `depart_name` varchar(11) NOT NULL,
  `depart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `dept`
--

INSERT INTO `dept` (`depart_name`, `depart_id`) VALUES
('1', 1),
('2', 2),
('3', 3),
('4', 4),
('5', 5),
('20', 20);

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `depart_id` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `username`, `depart_id`, `mobile`, `city`) VALUES
(1, 'fgvbn', '7', '678', '677'),
(2, 'baraa', '8', '67890', 'vbnm'),
(3, 'admin3', '7', '09877', 'gaza'),
(4, 'admin3', '7', '56789', 'rafahh'),
(5, 'admin5', '6', '2346', 'xcvbn'),
(6, 'admin6', '15', '245346', 'dbhgfhn'),
(7, 'admin7', '17', '464', 'rfdgbtr'),
(8, 'admin8', '15', '48899', 'uhgbruit'),
(9, 'admin9', '11', '488', 'gbruit'),
(10, 'admin10', '20', '56789', '7uyn j');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`depart_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
