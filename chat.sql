-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2023 at 12:05 AM
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
(22, 1137442813, 24767761, 'Hi I need help with my PC'),
(23, 1137442813, 1481230803, 'hello '),
(24, 1481230803, 24767761, 'hello '),
(25, 24767761, 1481230803, 'Hi how are you?'),
(26, 1481230803, 24767761, 'I am good how are you ?'),
(27, 1481230803, 566617455, 'qqq'),
(28, 1481230803, 566617455, 'www'),
(29, 1481230803, 566617455, 'eee'),
(30, 108356127, 1207774317, 'aaa'),
(31, 108356127, 1207774317, 'sss'),
(32, 108356127, 1207774317, 'ddd'),
(33, 1481230803, 1333962852, 'Hello'),
(34, 1333962852, 1481230803, 'hii'),
(35, 1481230803, 1333962852, 'bye');

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
  `is_guest` int(11) DEFAULT 0,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `is_guest`, `status`) VALUES
(6, 1481230803, 'Admin', 'A', 'yazan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1676635785profile-picture.jpeg', 0, 'Offline now'),
(7, 24767761, 'Bailey', 'L', 'bailey@gmail.com', 'a47eace67ec36839ddb9cd868bdc3a33', '1676636292images.jpg', 0, 'Offline now'),
(14, 715927783, 'Yazan', 'Armoush', 'yazan99@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1678051818Screen Shot 2023-03-01 at 5.12.44 PM.png', 0, 'Offline now'),
(30, 667090318, 'aa', 'dd', 'iii@gmail.com', '6c1d77a1851c78aa2894f8b7be3f7af4', '1678055814Screen Shot 2023-03-01 at 5.21.04 PM.png', 0, 'Offline now'),
(31, 1074009663, 'llls', 'saca', 'ww@gmail.com', '50f84daf3a6dfd6a9f20c9f8ef428942', '1678055841Screen Shot 2023-03-01 at 5.04.25 PM.png', 0, 'Offline now'),
(32, 108356127, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now'),
(33, 1207774317, 'Yazan', 'Armoush', 'lolo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1678056221Screen Shot 2023-03-01 at 5.12.44 PM.png', 0, 'Active now'),
(34, 1333962852, 'Guest', '', '', '', 'guest.jpg', 1, 'Active now');

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
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
