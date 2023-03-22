-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2023 at 03:01 AM
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
  `msg_id` bigint(15) NOT NULL,
  `incoming_msg_id` bigint(255) NOT NULL,
  `outgoing_msg_id` bigint(255) NOT NULL,
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
(35, 1481230803, 1333962852, 'bye'),
(36, 24767761, 519760876, 'http://google.com'),
(37, 24767761, 519760876, '<a href=\'google.com\'>qqq</a>'),
(38, 24767761, 1098549307, 'Hello'),
(39, 1098549307, 24767761, 'Hi how can I help?'),
(40, 2147483647, 1662466564, 'Test'),
(41, 648867767074786, 1662466564, 'Test'),
(42, 326272693292916, 929236095, 'hi'),
(43, 929236095, 326272693292916, 'You have been transfered, <a href=\'chat.php?user_id=326272693292916\'>please click here</a>'),
(44, 713081317956071, 1157820438, 'hi'),
(45, 1157820438, 713081317956071, 'You have been transfered, <a href=\'chat.php?user_id=326272693292916\'>please click here</a>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` bigint(15) NOT NULL,
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
(6, 326272693292916, 'Admin', 'A', 'yazan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1676635785profile-picture.jpeg', 0, 'Offline now'),
(7, 713081317956071, 'Bailey', 'L', 'bailey@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1676636292images.jpg', 0, 'Active now'),
(14, 248697192614588, 'Yazan', 'Armoush', 'yazan99@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1678051818Screen Shot 2023-03-01 at 5.12.44 PM.png', 0, 'Active now'),
(76, 648867767074786, 'Chris', 'T', 'chris123@gmail.com', '944facfeb153b4f01916a0f166fcc315', '1678153284Picture.jpg', 0, 'Active now'),
(77, 901892704140169, 'Yazan', 'Armoush', 'yazan88@live.com', '81dc9bdb52d04dc20036dbd8313ed055', '16783251911678055841Screen Shot 2023-03-01 at 5.04.25 PM.png', 0, 'Offline now'),
(80, 588425070, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now'),
(81, 91764873, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now'),
(82, 601609230, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now'),
(83, 1532788742, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now'),
(84, 1817087, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now'),
(85, 894672133, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now'),
(86, 1022439113, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now'),
(87, 1430481746, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now'),
(88, 929236095, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now'),
(89, 1434426198, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now'),
(90, 1591867034, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now'),
(91, 187056138, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now'),
(92, 1157820438, 'Guest', '', '', '', 'guest.jpg', 1, 'Offline now');

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
  MODIFY `msg_id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
