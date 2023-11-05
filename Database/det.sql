-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2023 at 05:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `det`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expense_name` varchar(50) NOT NULL,
  `expense_type` varchar(50) DEFAULT NULL,
  `expense_amount` decimal(10,2) NOT NULL,
  `date_added` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `user_id`, `expense_name`, `expense_type`, `expense_amount`, `date_added`) VALUES
(7, 1, 'Tree', 'tree', 60000.00, '2023-08-13'),
(8, 1, 'Tree', 'tree', 30000.00, '2023-09-13'),
(11, 1, 'henlo', 'whaaaat', 66778.00, '2023-10-02'),
(12, 1, 'bow', 'range', 2000.00, '2023-10-02'),
(13, 1, 'haya', 'tracer', 2000.00, '2023-10-02'),
(15, 1, 'drum', 'inst', 23232.00, '2023-10-05'),
(16, 1, 'room', 'bruh', 2000.00, '2023-10-05'),
(17, 1, 'haya', 'dayum', 23232.00, '2023-10-06'),
(18, 1, 'aditya', 'aditya', 10000.00, '2023-10-19'),
(25, 1, 'bow', 'aditya', 350.00, '2023-11-04'),
(28, 1, 'sad', 'asd', 1600.00, '2023-11-04'),
(29, 1, 'sdavgsa', 'sagf', 1234.00, '2023-11-04'),
(32, 13, 'sda', 'sfa', 100.00, '2023-11-05'),
(34, 13, 'jhhj', 'shs', 1000.00, '2023-11-05'),
(35, 13, 'hshsh', 'hdhd', 500.00, '2023-11-05'),
(36, 14, 'ssss', 'ssss', 1234.00, '2023-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  `expense_limit` varchar(10) DEFAULT '1000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `expense_limit`) VALUES
(1, 'Sam', '', 'ss@gmail.com', '7404451911', '1234', '2000'),
(3, 'Adhrija', '', 'a@gmail.com', '9831528784', '1234', NULL),
(4, 'Subimol', 'Das', 'su@gmail.com', '9499949921', '1234', NULL),
(7, 'lil', 'uzi', 'lil@gmail.com', '7596996846', '$2y$10$O9UxHxb95FgTvimZCRIPd.G', NULL),
(9, 'a', 'b', '1@gmail.com', '', '$2y$10$pyQ9bS12WoZGySVvUa8HCuR', NULL),
(13, 'Soumik', 'Sil', 'soumiksilco@gmail.com', '9674045191', '1234', '3000'),
(14, 'Soumik', 'Sil', 'soumik.sil.mca24@heritageit.edu.in', '9830568783', '123456789', '1000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
