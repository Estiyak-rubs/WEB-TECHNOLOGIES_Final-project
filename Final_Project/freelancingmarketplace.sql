-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 06:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freelancingmarketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `application_text` text DEFAULT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','accepted','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`application_id`, `job_id`, `freelancer_id`, `application_text`, `application_date`, `status`) VALUES
(1, 35, 4, 'i like to apply for the jobp.please accept me.', '2023-12-12 16:33:46', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `job_type` enum('hourly','fixed') NOT NULL,
  `payment` decimal(10,2) DEFAULT NULL,
  `status` enum('open','in progress','completed') DEFAULT 'open',
  `post_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `client_id`, `title`, `description`, `job_type`, `payment`, `status`, `post_date`) VALUES
(13, 3, 'write content', 'aaaa', 'hourly', 1234.00, 'open', '2023-11-12 21:22:28'),
(14, 5, 'Video Editing', 'aaa', 'hourly', 1200.00, 'open', '2023-11-13 07:08:49'),
(17, 2, 'aa', 'asss', '', 12.00, 'open', '2023-11-15 06:39:00'),
(29, 2, 'Video Editing', 'edit it', 'fixed', 25.00, 'open', '2023-11-22 07:31:16'),
(30, 2, 'Video Editing', 'hello', 'hourly', 25.00, 'open', '2023-11-27 05:13:15'),
(31, 2, 'aa', 'aweda', 'hourly', 14.00, 'open', '2023-11-27 05:18:05'),
(32, 2, 'Video Editing', 'edi', 'hourly', 12.00, 'open', '2023-11-27 05:39:41'),
(33, 2, 'Video Editing', 'byyyy', 'hourly', 12.00, 'open', '2023-12-12 06:49:46'),
(34, 2, 'aa', 'aaaaaaaaa', 'fixed', 12.00, 'open', '2023-12-12 17:15:01'),
(35, 2, 'Video Editing', 'aa', '', 1200.00, 'open', '2023-12-12 17:15:12'),
(36, 18, 'Video Editing', 'I need a video editor', 'hourly', 1200.00, 'open', '2023-12-12 17:51:13'),
(37, 2, 'aa', 'ss', 'fixed', 1200.00, 'open', '2023-12-12 18:37:26'),
(38, 2, 'aaaaaaaaaaaa', 'qqqqqqqqqqqqqq', 'hourly', 1200.00, 'open', '2023-12-12 18:38:59'),
(39, 20, 'Wright essay', 'Hello', '', 2300.00, 'open', '2023-12-13 05:27:37'),
(40, 21, 'Video', 'aa', '', 13.00, 'open', '2023-12-13 07:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message_text` text DEFAULT NULL,
  `send_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `user_type` enum('client','freelancer','admin') NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `PASSWORD`, `user_type`, `registration_date`) VALUES
(1, 'aaa', 'a@gmail.com', '$2y$10$MDs8iuQu6wb5MwtL1vXHGO5nIFibBXDl6ZgBAr9mS9OLIjoPxhC8S', 'freelancer', '2023-11-10 06:28:34'),
(2, 'aa', 'aaa@gmail.com', '123456', 'client', '2023-11-12 14:45:07'),
(3, 'abir', 'arshadabedin@outlook.com', 'aA123456', 'client', '2023-11-12 20:30:37'),
(4, 'arshad', 'arshadabedin@outlook.com', 'aA123456', 'freelancer', '2023-11-13 03:57:32'),
(5, 'abedin', 'b@gamil.com', 'aA123456', 'client', '2023-11-13 07:07:45'),
(6, 'aaB', 'arshadabedin@outlook.com', 'aA123456@', 'client', '2023-12-11 06:22:19'),
(7, 'aBa', 'arshadabedin@outlook.com', '@aA12345', 'client', '2023-12-11 06:23:15'),
(8, 'aBc', 'arshadabedin@outlook.com', '@aA12345', 'client', '2023-12-11 06:23:52'),
(9, 'aaaaaaaa', 'arshadabedin@outlook.com', '@Aa1234567', 'client', '2023-12-11 06:24:22'),
(10, 'aaaaaaaaA', 'arshadabedin@outlook.com', '@Aa1234567', 'client', '2023-12-11 06:25:33'),
(11, 'AAAA', 'arshadabedin@outlook.com', '@aA12345', 'client', '2023-12-11 06:26:02'),
(12, 'AAAAb', 'arshadabedin@outlook.com', '@aA12345', 'client', '2023-12-11 06:31:40'),
(13, 'AAAAbbb', 'arshadabedin@outlook.com', '@aA12345', 'client', '2023-12-11 06:31:44'),
(14, 'aE', 'arshadabedin@outlook.com', '12345aA@', 'client', '2023-12-11 06:32:12'),
(15, 'a', 'a@gmail.com', '123', 'client', '2023-12-11 13:25:29'),
(16, 'q', 'a@gmail.com', '123', 'client', '2023-12-11 13:26:16'),
(17, 'azim', 'arshadabedin@outlook.com', 'aA123456', 'client', '2023-12-11 14:58:36'),
(18, 'shown', 'arshadabedin@outlook.com', 'aA123456', 'client', '2023-12-12 17:50:09'),
(19, 'bb', 'c@gamil.com', 'aA123456', 'admin', '2023-12-13 02:44:53'),
(20, 'sium', 'a@gmail.com', 'aA123456', 'client', '2023-12-13 05:26:49'),
(21, 'ar', 'a@gmail.com', 'aA123456', 'client', '2023-12-13 07:55:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `freelancer_id` (`freelancer_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
