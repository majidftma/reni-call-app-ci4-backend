-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 01:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reni_call_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `language_code` varchar(10) NOT NULL,
  `row_createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `language_code`, `row_createdAt`) VALUES
(1, 'English', 'en', '2024-12-01 19:47:57'),
(2, 'English', 'en', '2024-12-01 19:49:35'),
(3, 'Malayalam', 'ML', '2025-03-16 14:48:17'),
(4, 'Malayalam', 'ML', '2025-03-16 15:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `no_of_coins` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `no_of_coins`, `amount`, `created_at`, `updated_at`) VALUES
(1, 100, 100.00, '2025-03-16 08:08:40', '2025-03-16 08:08:40'),
(2, 200, 200.00, '2025-03-16 08:11:27', '2025-03-16 08:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) DEFAULT 'INR',
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `dob` date DEFAULT NULL,
  `preferred_language` int(11) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `row_creayedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `dob`, `preferred_language`, `last_login`, `row_creayedAt`) VALUES
(1, 'John Doe', '1234567890', '0000-00-00', 1, NULL, '2024-12-03 00:06:54'),
(2, 'muh', '919745869570', '2000-01-21', 1, '2025-03-16 09:11:30', '2025-03-16 13:05:30'),
(3, NULL, '918089332859', NULL, NULL, '2025-03-18 12:16:47', '2025-03-18 17:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `user_id` int(11) NOT NULL,
  `refresh_token` varchar(512) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`user_id`, `refresh_token`, `expires_at`, `created_at`) VALUES
(3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjMiLCJtb2JpbGUiOiI5MTgwODkzMzI4NTkiLCJpYXQiOjE3NDIzMDAyMDcsImV4cCI6MTc0NDg5MjIwN30.NrAywgef08_cnoMY64_kxqwERu2X8DbMd50rSgjzt3M', '2025-04-17 12:16:47', '2025-03-18 17:46:47');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `balance`, `createdAt`, `updated_at`) VALUES
(1, 1, 0.00, '2024-12-03 00:06:54', '2025-03-16 10:53:19'),
(2, 2, 100.00, '2025-03-16 14:35:50', '2025-03-16 10:53:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_userid_on_wallet` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
