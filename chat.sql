-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2023 at 03:53 AM
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
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 269636924, 1481230803, 'oi'),
(2, 269636924, 1481230803, 'How are you today?'),
(3, 1481230803, 269636924, 'Doin ok'),
(4, 1481230803, 24767761, 'hey'),
(5, 24767761, 1481230803, 'hi'),
(6, 1481230803, 24767761, 'Hello'),
(7, 24767761, 1481230803, 'IT WORKS'),
(8, 1481230803, 24767761, '!!!'),
(9, 269636924, 1481230803, 'test'),
(10, 24767761, 1481230803, 'test'),
(11, 24767761, 269636924, 'Hi my name is Chris'),
(12, 1481230803, 269636924, 'Hello'),
(13, 24767761, 269636924, 'hey'),
(14, 1481230803, 269636924, 'test'),
(15, 24767761, 1565280592, 'Hi Bailey!'),
(16, 24767761, 1424764303, 'Hello'),
(17, 1565280592, 1424764303, 'Hi'),
(18, 24767761, 1573578550, 'Hi, how are you today?'),
(19, 1424764303, 1573578550, 'Hi, how are you?'),
(20, 24767761, 1137442813, 'Hello, how are you?'),
(21, 24767761, 1137442813, 'Testing'),
(22, 1137442813, 24767761, 'Hi I need help with my PC');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(200) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(400) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`) VALUES
(6, 1481230803, 'Yazan', 'A', 'yazan@gmail.com', 'be9ae874852cda354b4c6068736a76fa', '1676635785profile-picture.jpeg', 'Offline now'),
(7, 24767761, 'Bailey', 'L', 'bailey@gmail.com', 'a47eace67ec36839ddb9cd868bdc3a33', '1676636292images.jpg', 'Offline now'),
(11, 1137442813, 'Christopher', 'Tsung', 'christopher@gmail.com', '944facfeb153b4f01916a0f166fcc315', '1677119059img.jpg', 'Active now');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
