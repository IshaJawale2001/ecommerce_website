-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Aug 20, 2025 at 05:21 PM
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
-- Database: `ecommerce_website`
--

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT 1,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 3, '2025-07-10 02:08:43', '2025-07-10 04:46:33', '2025-07-10 04:46:33'),
(2, 1, 2, 1, '2025-07-10 02:09:34', '2025-07-10 04:46:33', '2025-07-10 04:46:33'),
(3, 1, 3, 2, '2025-07-10 02:13:39', '2025-07-10 03:31:07', '2025-07-10 03:31:07'),
(4, 1, 5, 1, '2025-07-10 02:14:16', '2025-07-10 03:13:29', '2025-07-10 03:13:29'),
(5, 1, 5, 1, '2025-07-10 03:32:43', '2025-07-10 04:46:33', '2025-07-10 04:46:33'),
(6, 1, 1, 2, '2025-07-10 05:22:57', '2025-07-10 05:23:14', '2025-07-10 05:23:14'),
(7, 1, 4, 1, '2025-07-10 05:23:05', '2025-07-10 05:23:14', '2025-07-10 05:23:14'),
(8, 1, 4, 1, '2025-07-10 05:40:34', '2025-07-10 05:42:32', '2025-07-10 05:42:32'),
(9, 1, 3, 2, '2025-07-10 08:34:11', '2025-07-10 08:35:31', '2025-07-10 08:35:31'),
(10, 1, 8, 1, '2025-07-10 08:34:21', '2025-07-10 08:35:31', '2025-07-10 08:35:31'),
(11, 1, 3, 1, '2025-07-10 08:40:20', '2025-07-10 09:21:03', '2025-07-10 09:21:03'),
(12, 1, 2, 2, '2025-07-10 09:19:03', '2025-07-10 09:19:38', '2025-07-10 09:19:38'),
(13, 1, 7, 2, '2025-08-20 07:22:36', '2025-08-20 07:23:33', '2025-08-20 07:23:33');

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
(4, '2025_07_10_101513_add_timestamps_to_order_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 366000.00, NULL, '2025-07-10 04:46:33', '2025-07-10 04:46:33'),
(3, 1, 189000.00, NULL, '2025-07-10 05:23:14', '2025-07-10 05:23:14'),
(4, 1, 35000.00, 'success', '2025-07-10 05:42:32', '2025-07-10 05:42:32'),
(5, 1, 64000.00, 'success', '2025-07-10 08:35:31', '2025-07-10 08:35:31'),
(6, 1, 22000.00, 'success', '2025-07-10 09:21:03', '2025-07-10 09:21:03'),
(7, 1, 90000.00, 'success', '2025-08-20 07:23:33', '2025-08-20 07:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, 77000.00, '2025-07-10 04:46:33', '2025-07-10 04:46:33'),
(2, 2, 2, 1, 60000.00, '2025-07-10 04:46:33', '2025-07-10 04:46:33'),
(3, 2, 5, 1, 75000.00, '2025-07-10 04:46:33', '2025-07-10 04:46:33'),
(4, 3, 1, 2, 77000.00, '2025-07-10 05:23:14', '2025-07-10 05:23:14'),
(5, 3, 4, 1, 35000.00, '2025-07-10 05:23:14', '2025-07-10 05:23:14'),
(6, 4, 4, 1, 35000.00, '2025-07-10 05:42:32', '2025-07-10 05:42:32'),
(7, 5, 3, 2, 22000.00, '2025-07-10 08:35:31', '2025-07-10 08:35:31'),
(8, 5, 8, 1, 20000.00, '2025-07-10 08:35:31', '2025-07-10 08:35:31'),
(9, 6, 3, 1, 22000.00, '2025-07-10 09:21:03', '2025-07-10 09:21:03'),
(10, 7, 7, 2, 45000.00, '2025-08-20 07:23:33', '2025-08-20 07:23:33');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Camera', 77000.00, '2025-07-10 05:23:50', '2025-07-10 05:23:50', NULL),
(2, 'Laptop', 64000.00, '2025-07-10 05:38:33', '2025-07-10 14:02:59', NULL),
(3, 'Headphones', 22000.00, '2025-07-10 05:39:43', '2025-07-10 05:39:43', NULL),
(4, 'Watch', 35000.00, '2025-07-10 05:40:18', '2025-07-10 05:40:18', NULL),
(5, 'TV', 75000.00, '2025-07-10 05:47:05', '2025-07-10 14:03:31', '2025-07-10 14:03:31'),
(6, 'Camera', 30000.00, '2025-07-10 05:57:15', '2025-07-10 06:12:29', '2025-07-10 06:12:29'),
(7, 'TV', 45000.00, '2025-07-10 12:02:31', '2025-07-10 12:02:31', NULL),
(8, 'Mobile', 20000.00, '2025-07-10 14:01:42', '2025-07-10 14:01:42', NULL),
(9, 'Smart Watch', 8000.00, '2025-07-10 14:46:34', '2025-07-10 14:48:14', '2025-07-10 14:48:14'),
(10, 'mayu', 40000.00, '2025-08-20 12:51:18', '2025-08-20 12:51:38', '2025-08-20 12:51:38'),
(11, 'Pratibha', 5000.00, '2025-08-20 12:52:13', '2025-08-20 12:52:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'uploads/1752125030-camera4.png', '2025-07-10 05:23:50', '2025-07-10 05:23:50', NULL),
(2, 1, 'uploads/1752125030-camera3.png', '2025-07-10 05:23:50', '2025-07-10 05:23:50', NULL),
(3, 1, 'uploads/1752125030-camera.png', '2025-07-10 05:23:50', '2025-07-10 05:23:50', NULL),
(4, 2, 'uploads/1752125913-laptop.png', '2025-07-10 05:38:33', '2025-07-10 14:02:59', '2025-07-10 14:02:59'),
(5, 3, 'uploads/1752125983-headphone4.jpg', '2025-07-10 05:39:43', '2025-07-10 05:39:43', NULL),
(6, 3, 'uploads/1752125983-headphone3.jpg', '2025-07-10 05:39:43', '2025-07-10 05:39:43', NULL),
(7, 3, 'uploads/1752125983-headphone2.jpg', '2025-07-10 05:39:43', '2025-07-10 05:39:43', NULL),
(8, 3, 'uploads/1752125983-headphone1.jpg', '2025-07-10 05:39:43', '2025-07-10 05:39:43', NULL),
(9, 4, 'uploads/1752126018-watch3_11zon.jpg', '2025-07-10 05:40:18', '2025-07-10 05:40:18', NULL),
(10, 4, 'uploads/1752126018-watch2_11zon.jpg', '2025-07-10 05:40:18', '2025-07-10 05:40:18', NULL),
(11, 4, 'uploads/1752126018-watch1.png', '2025-07-10 05:40:18', '2025-07-10 05:40:18', NULL),
(12, 5, 'uploads/1752126425-tv3.jpg', '2025-07-10 05:47:05', '2025-07-10 05:56:10', '2025-07-10 05:56:10'),
(13, 5, 'uploads/1752126425-tv2.jpg', '2025-07-10 05:47:05', '2025-07-10 05:56:10', '2025-07-10 05:56:10'),
(14, 5, 'uploads/1752126970-tv3.jpg', '2025-07-10 05:56:10', '2025-07-10 14:03:31', '2025-07-10 14:03:31'),
(15, 5, 'uploads/1752126970-tv.png', '2025-07-10 05:56:10', '2025-07-10 14:03:31', '2025-07-10 14:03:31'),
(16, 6, 'uploads/1752127035-camera4.png', '2025-07-10 05:57:15', '2025-07-10 06:12:29', '2025-07-10 06:12:29'),
(17, 7, 'uploads/1752148951-tv.png', '2025-07-10 12:02:31', '2025-07-10 12:02:31', NULL),
(18, 8, 'uploads/1752156102-mobile.png', '2025-07-10 14:01:42', '2025-07-10 14:01:42', NULL),
(19, 2, 'uploads/1752156179-tv.png', '2025-07-10 14:02:59', '2025-07-10 14:02:59', NULL),
(20, 2, 'uploads/1752156179-laptop.png', '2025-07-10 14:02:59', '2025-07-10 14:02:59', NULL),
(21, 9, 'uploads/1752158794-watch3_11zon.jpg', '2025-07-10 14:46:34', '2025-07-10 14:47:38', '2025-07-10 14:47:38'),
(22, 9, 'uploads/1752158794-watch2_11zon.jpg', '2025-07-10 14:46:34', '2025-07-10 14:47:38', '2025-07-10 14:47:38'),
(23, 9, 'uploads/1752158794-watch1.png', '2025-07-10 14:46:34', '2025-07-10 14:47:38', '2025-07-10 14:47:38'),
(24, 9, 'uploads/1752158858-watch3_11zon.jpg', '2025-07-10 14:47:38', '2025-07-10 14:48:14', '2025-07-10 14:48:14'),
(25, 9, 'uploads/1752158858-watch2_11zon.jpg', '2025-07-10 14:47:38', '2025-07-10 14:48:14', '2025-07-10 14:48:14'),
(26, 10, 'uploads/1755694278-banner1.jpg', '2025-08-20 12:51:18', '2025-08-20 12:51:38', '2025-08-20 12:51:38'),
(27, 11, 'uploads/1755694333-banner1.jpg', '2025-08-20 12:52:13', '2025-08-20 12:52:13', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
