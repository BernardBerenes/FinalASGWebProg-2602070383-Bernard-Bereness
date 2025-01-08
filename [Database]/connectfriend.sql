-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 08, 2025 at 10:28 AM
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
-- Database: `connectfriend`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE `avatars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avatars`
--

INSERT INTO `avatars` (`id`, `name`, `price`, `path`, `created_at`, `updated_at`) VALUES
(1, 'Cool Buddy Avatar', 7011, '/assets/images/avatar/1.png', '2025-01-08 00:46:51', '2025-01-08 00:46:51'),
(2, 'Keep Fighting Buddy', 51052, '/assets/images/avatar/2.png', '2025-01-08 00:46:51', '2025-01-08 00:46:51'),
(3, 'Itachi', 98163, '/assets/images/avatar/3.png', '2025-01-08 00:46:51', '2025-01-08 00:46:51'),
(4, 'Eagle Bird', 79493, '/assets/images/avatar/4.png', '2025-01-08 00:46:51', '2025-01-08 00:46:51'),
(5, 'Phantom Assassin', 71290, '/assets/images/avatar/5.png', '2025-01-08 00:46:51', '2025-01-08 00:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `avatar_transactions`
--

CREATE TABLE `avatar_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `avatar_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avatar_transactions`
--

INSERT INTO `avatar_transactions` (`id`, `buyer_id`, `avatar_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2025-01-08 01:19:19', '2025-01-08 01:19:19'),
(2, 2, 1, '2025-01-08 01:19:20', '2025-01-08 01:19:20'),
(3, 4, 5, '2025-01-08 01:48:03', '2025-01-08 01:48:03'),
(4, 5, 3, '2025-01-08 02:28:31', '2025-01-08 02:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `sender_id`, `receiver_id`, `message`, `seen`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Hello Mister Thevid', 1, '2025-01-08 01:42:34', '2025-01-08 01:43:58'),
(2, 1, 2, 'How are you today', 1, '2025-01-08 01:42:43', '2025-01-08 01:43:58'),
(3, 2, 1, 'Hello Sir, I\'m fine thank you!!', 1, '2025-01-08 01:43:58', '2025-01-08 01:43:58'),
(4, 1, 2, 'I want to ask you something, may I?', 0, '2025-01-08 01:53:52', '2025-01-08 01:53:52'),
(5, 1, 2, 'Are you coming to the event tomorrow?', 0, '2025-01-08 01:55:35', '2025-01-08 01:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Pending','Accepted','Declined') NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `sender_id`, `receiver_id`, `status`, `seen`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Accepted', 1, '2025-01-08 01:20:39', '2025-01-08 01:38:54'),
(2, 4, 2, 'Accepted', 1, '2025-01-08 01:54:24', '2025-01-08 02:25:45'),
(3, 5, 3, 'Pending', 0, '2025-01-08 02:27:46', '2025-01-08 02:27:46'),
(4, 5, 1, 'Pending', 0, '2025-01-08 02:27:47', '2025-01-08 02:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_03_155155_create_friends_table', 1),
(5, '2025_01_04_163558_create_avatars_table', 1),
(6, '2025_01_04_163833_create_avatar_transactions_table', 1),
(7, '2025_01_06_045702_create_chats_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('L3zSseopMO5jkHRb5xYYcWwYaQYTmK6fISsBDyaY', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQllnd3BoOEdrSzlXTHpENnlLSEduR3ZrZUJ1NHVDalZRcTFMSDRyRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9mcmllbmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6NjoibG9jYWxlIjtzOjI6ImlkIjt9', 1736328127),
('Y2ZpPvriUL0jAfNdvZzAUPjkGsLqxJ51MG9n2yGo', 5, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiVUZMczRVQ0VXZmlOVHU0TFhpbURlS1Q2ZWlPMVZuZEVMWng2Wnh5eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==', 1736328521);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `fields_of_work` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`fields_of_work`)),
  `linkedin_username` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `coin` int(11) NOT NULL DEFAULT 100,
  `profile_picture` varchar(255) DEFAULT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `fields_of_work`, `linkedin_username`, `phone_number`, `coin`, `profile_picture`, `visibility`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bernard Bereness', 'bernardbereness78@gmail.com', '$2y$12$jqpWlU/NEF/rUCDVT4QHB.iNIrdnbhYahHU/AENq3GI75IWcqPRAe', 'Male', '[\"Bisnis\",\" Tongkang\",\" Batubara\",\" ITMG\"]', 'https://www.linkedin.com/in/bernard-bereness-514259251', '081369251040', 947, NULL, 1, NULL, '2025-01-08 00:56:13', '2025-01-08 00:56:13'),
(2, 'Mister Thevid', 'thevidob@gmail.com', '$2y$12$.Vmc.fgrGC31GKkjGpMM8OGcZFr1FTnFsCbuM9M5L3NcyfykJfXTa', 'Female', '[\"Billiard\",\" Tongkang\",\" DJ\"]', 'https://www.linkedin.com/in/bernard-bereness-514259251', '081369251040', 91832, '/assets/images/avatar/1.png', 0, NULL, '2025-01-08 01:09:13', '2025-01-08 02:16:27'),
(3, 'Reynaldi Adudu', 'reynaldiadison@gmail.com', '$2y$12$aiG1a6FCvucDNOUZX8h11uIf.amURvlxOfZnBw9PgwErzyi0pXLCe', 'Male', '[\"Saham\",\" BBRI\",\" BBCA\"]', 'https://www.linkedin.com/in/bernard-bereness-514259251', '081369251040', 192, NULL, 1, NULL, '2025-01-08 01:11:27', '2025-01-08 01:11:27'),
(4, 'I Made Tupperware', 'made@gmail.com', '$2y$12$620VT2uxv6sLjz8z/BsZcOVf5gOEYXLZSh2byYR5c7C6UoJ3YbeQa', 'Female', '[\"Fashion\",\" Traveling\",\" Teaching\"]', 'https://www.linkedin.com/in/bernard-bereness-514259251', '081369251040', 26993, '/assets/images/avatar/5.png', 1, NULL, '2025-01-08 01:17:53', '2025-01-08 01:48:08'),
(5, 'Dicky Dharma', 'dickydharmasusanto@gmail.com', '$2y$12$BfbrwWNR5Cx/j3r894qwB.C4lmsKmNLRA.jX.jRvxEI6kKPy1Fu16', 'Male', '[\"Basket\",\" Crypto\",\" Programmer\"]', 'https://www.linkedin.com/in/bernard-bereness-514259251', '081369251040', 1541, '/assets/images/avatar/3.png', 1, NULL, '2025-01-08 02:27:12', '2025-01-08 02:28:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avatar_transactions`
--
ALTER TABLE `avatar_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avatar_transactions_buyer_id_foreign` (`buyer_id`),
  ADD KEY `avatar_transactions_avatar_id_foreign` (`avatar_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_sender_id_foreign` (`sender_id`),
  ADD KEY `chats_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friends_sender_id_foreign` (`sender_id`),
  ADD KEY `friends_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `avatar_transactions`
--
ALTER TABLE `avatar_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avatar_transactions`
--
ALTER TABLE `avatar_transactions`
  ADD CONSTRAINT `avatar_transactions_avatar_id_foreign` FOREIGN KEY (`avatar_id`) REFERENCES `avatars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avatar_transactions_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friends_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
