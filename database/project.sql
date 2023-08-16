-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 16, 2023 at 12:18 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_info`
--

CREATE TABLE `login_info` (
  `id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_info`
--

INSERT INTO `login_info` (`id`, `email`, `password`) VALUES
(7, 'tigju24@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(10, 'test@test.com', '202cb962ac59075b964b07152d234b70'),
(11, 'caesar@gm.com', '202cb962ac59075b964b07152d234b70'),
(13, 'kmar@gmail.com', '202cb962ac59075b964b07152d234b70'),
(14, 'tb@mail.com', '202cb962ac59075b964b07152d234b70'),
(15, 'ben@mail.com', '202cb962ac59075b964b07152d234b70'),
(17, 'w@w.com', '202cb962ac59075b964b07152d234b70'),
(18, 'kat@gm.com', '202cb962ac59075b964b07152d234b70'),
(19, 'f@l.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(50) NOT NULL,
  `user_id` int(10) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`) VALUES
(20, 7, '2023-08-15 03:16:58'),
(21, 7, '2023-08-15 03:28:13'),
(22, 7, '2023-08-15 03:30:25'),
(23, 7, '2023-08-15 03:32:35'),
(24, 17, '2023-08-15 03:39:34'),
(25, 17, '2023-08-15 03:39:55'),
(26, 7, '2023-08-15 23:30:26'),
(27, 7, '2023-08-15 23:45:25'),
(28, 18, '2023-08-15 23:53:32'),
(29, 19, '2023-08-16 00:09:02'),
(30, 19, '2023-08-16 00:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `order_lines`
--

CREATE TABLE `order_lines` (
  `id` int(50) NOT NULL,
  `order_id` int(50) NOT NULL,
  `order_line` int(20) NOT NULL,
  `product_id` int(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_lines`
--

INSERT INTO `order_lines` (`id`, `order_id`, `order_line`, `product_id`, `product_name`, `quantity`, `price`) VALUES
(25, 20, 1, 1, 'Turkish style coffee', 1, 5),
(26, 20, 2, 2, 'Ethiopian Coffee', 1, 6),
(27, 20, 3, 5, 'Café de Olla (Mexican)', 1, 7.55),
(28, 20, 4, 4, 'Jamaican Blue Mountain', 1, 7),
(29, 21, 1, 1, 'Turkish style coffee', 1, 5),
(30, 21, 2, 5, 'Café de Olla (Mexican)', 1, 7.55),
(31, 22, 1, 2, 'Ethiopian Coffee', 1, 6),
(32, 23, 1, 1, 'Turkish style coffee', 1, 5),
(33, 23, 2, 2, 'Ethiopian Coffee', 1, 6),
(34, 23, 3, 3, 'Brazilian Style', 1, 5.5),
(35, 24, 1, 3, 'Brazilian Style', 1, 5.5),
(36, 24, 2, 2, 'Ethiopian Coffee', 1, 6),
(37, 24, 3, 1, 'Turkish style coffee', 1, 5),
(38, 24, 4, 4, 'Jamaican Blue Mountain', 1, 7),
(39, 25, 1, 8, 'Latte', 1, 9.75),
(40, 25, 2, 7, 'Sumatra Coffee', 1, 6.75),
(41, 25, 3, 9, 'Hawaiian Kona Coffee', 1, 6),
(42, 25, 4, 6, 'Rwandan Coffee', 1, 5.75),
(43, 26, 1, 3, 'Brazilian Style', 1, 5.5),
(44, 26, 2, 2, 'Ethiopian Coffee', 1, 6),
(45, 26, 3, 1, 'Turkish style coffee', 1, 5),
(46, 26, 4, 5, 'Café de Olla (Mexican)', 1, 7.55),
(47, 27, 1, 1, 'Turkish style coffee', 1, 5),
(48, 27, 2, 2, 'Ethiopian Coffee', 1, 6),
(49, 28, 1, 8, 'Latte', 1, 9.75),
(50, 28, 2, 9, 'Hawaiian Kona Coffee', 1, 6),
(51, 29, 1, 5, 'Café de Olla (Mexican)', 1, 7.55),
(52, 29, 2, 6, 'Rwandan Coffee', 1, 5.75),
(53, 29, 3, 8, 'Latte', 1, 9.75),
(54, 30, 1, 1, 'Turkish style coffee', 1, 5),
(55, 30, 2, 4, 'Jamaican Blue Mountain', 1, 7),
(56, 30, 3, 7, 'Sumatra Coffee', 1, 6.75),
(57, 30, 4, 8, 'Latte', 1, 9.75);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `street` varchar(75) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(4) NOT NULL,
  `zip` int(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `registered_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `street`, `city`, `state`, `zip`, `country`, `registered_date`) VALUES
(7, 'julia', 'stanina', '1212 Street', 'Brooklyn ', 'NY', 12121, '', '2023-08-12 23:13:06'),
(10, 'test', 'test', '23 main st', 'brookyln ', 'NY', 11111, 'United States', '2023-08-12 23:18:43'),
(11, 'caesar', 'cat', '56th St', 'Brook ', 'IL', 54321, 'United States', '2023-08-13 02:02:17'),
(13, 'kate', 'mar', '1234 main st', 'brooklyn ', 'NY', 11345, 'United States', '2023-08-14 02:02:39'),
(14, 'tom', 'brat', '123 est', 'brook ', 'ME', 23232, 'United States', '2023-08-14 02:05:47'),
(15, 'ben', 'cap', '345 east st', 'brook ', 'NE', 23454, 'United States', '2023-08-14 02:09:36'),
(17, 'w', 'w', '9012', 'brook ', 'IA', 12121, 'United States', '2023-08-15 03:39:08'),
(18, 'kat', 'kar', '34 main', 'bronx ', 'ID', 23122, 'United States', '2023-08-15 23:53:03'),
(19, 'f', 'l', '111 jay St', 'Brook ', 'NY', 10001, 'United States', '2023-08-16 00:08:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_info`
--
ALTER TABLE `login_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_lines`
--
ALTER TABLE `order_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_info`
--
ALTER TABLE `login_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_lines`
--
ALTER TABLE `order_lines`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
