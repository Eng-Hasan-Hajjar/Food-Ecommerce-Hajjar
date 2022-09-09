-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2020 at 11:34 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sofra`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1, '2020-07-01 03:00:03', '2020-07-01 03:00:03', 'مشويات'),
(3, '2020-07-01 03:00:03', '2020-07-01 03:00:03', 'سلطات'),
(4, '2020-07-01 03:00:03', '2020-07-01 03:00:03', 'فراخ'),
(6, '2019-12-14 02:40:46', '2019-12-18 08:52:10', 'اي حاجهgh');

-- --------------------------------------------------------

--
-- Table structure for table `category_resturant`
--

CREATE TABLE `category_resturant` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `resturant_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_resturant`
--

INSERT INTO `category_resturant` (`id`, `created_at`, `updated_at`, `category_id`, `resturant_id`) VALUES
(4, '2020-07-01 03:00:03', '2020-07-01 03:00:03', 1, 12),
(5, '2020-07-01 03:00:03', '2020-07-01 03:00:03', 4, 12),
(6, '2020-07-01 03:00:03', '2020-07-01 03:00:03', 3, 12),
(21, '2020-07-01 03:00:03', '2020-07-01 03:00:03', 1, 18),
(22, '2020-07-01 03:00:03', '2020-07-01 03:00:03', 3, 18),
(23, '2020-07-01 03:00:03', '2020-07-01 03:00:03', 1, 3),
(24, '2020-07-01 03:00:03', '2020-07-01 03:00:03', 3, 3),
(25, '2020-07-01 03:00:03', '2020-07-01 03:00:03', 4, 3),
(26, NULL, NULL, 1, 19),
(27, NULL, NULL, 3, 19),
(28, NULL, NULL, 1, 20),
(29, NULL, NULL, 3, 20);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1, '2020-07-08 02:59:57', '2020-07-01 02:59:43', 'الاسكندريه'),
(2, '2020-07-01 03:00:03', '2020-07-01 02:59:52', 'المنيا'),
(3, '2020-07-01 03:00:03', '2020-07-01 03:00:03', 'بني سويف'),
(4, '2020-07-01 03:00:03', '2020-07-01 03:00:03', 'الاقصر'),
(8, '2019-12-13 23:44:40', '2019-12-13 23:44:40', 'اسيوط');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `district_id` int(10) UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin_code` int(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `created_at`, `updated_at`, `name`, `email`, `phone`, `district_id`, `password`, `image`, `api_token`, `pin_code`, `active`) VALUES
(2, '2019-12-11 23:22:36', '2020-07-28 00:43:51', 'keroUp', 'kero@gmail.com', 1060402715, 1, '$2y$10$agXigPnBJyihtfOMfTR3mOCRHENlpcFFzjIr5BxrT/FsbQcQ7WRTm', 'user_image1595904230.jpg', 'Wf3fN2zDUTmWMKxCRC29ZJ1QZl2j7UUMhkJwEyDM4oYT2Bh7UR9Noa0d5xUY', NULL, 1),
(3, '2020-02-24 22:22:56', '2020-02-24 22:22:57', 'كيرلس', 'kerolesatef200@gmail.com', 2131231, 2, '$2y$10$4jl9fJ0z6Anq0ePY6qpE9uzBrnHMu/n7EddAiiWEXliw.y7VpJ9Pm', 'user-photo.png', 'aYE0jGrXT3TDrKeUQZk38GMww2GS98reGfMLW3kznw6sq09fcFT4VRcaZQcz', NULL, 1),
(4, '2020-02-25 21:56:07', '2020-02-25 21:56:09', 'كيرلس عاطف صادق تاا', 'kerolesatef200@gmial.com', 1060402713, 6, '$2y$10$2wvIPlRnMGwVglL4q7eeWuLTf1HvVebgwh0zf4AHE7nyqOmWyXJgS', 'user-photo.png', 'xZeDtU5puoBgjhkHlLCnAc1EZDt7eH4y7VPCPmraulJWlDiCu1oBQ5ftIVBN', NULL, 1),
(5, '2020-02-25 21:58:40', '2020-02-25 21:58:41', 'كيرلس عاطف صادق ابراهيم', 'lerkrl@gmial.com', 103999049, 5, '$2y$10$fJeYpavvWahTjLdC0q7Ux.v9ji7gCpHyvUY/0TNFu85vcS.XjecVi', 'user-photo.png', 'rreOwsAXPg0PNN3kX2zSr8pQKPQXCWXUOXGx9kMUC2U5AlMg4GlPwYonxXkl', NULL, 1),
(6, '2020-07-28 06:43:46', '2020-07-28 06:43:46', 'isac', 'i@gmail.com', 777, 1, '$2y$10$d1MnjpWbRwA4jMlVQEjKB.RnddMUlR16v1NqEKGulnOQ8Rx2qYEXW', 'clientU.png', '4WEriNERyySBUmeqIL1JENxVij5keW8ymbS6wWHHKIyucsTYf37j1pciNXG6', NULL, 1),
(7, '2020-07-28 06:47:28', '2020-07-28 06:47:28', 'ww', 'ww@gmail.com', 222, 1, '$2y$10$0lJVDYM7maXAmFjlO94oq.fBkyhIUc3xhpoMvqCyZXdYX8AXy7pGu', 'clientU.png', 'CEKY34fC8NvoZbrLBI4SFIpdeSJUb6PUzoejNebQF7xlTITL00yIlok1cMN3', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('complaint','suggestion','inquiry') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `created_at`, `updated_at`, `full_name`, `email`, `phone`, `message`, `type`) VALUES
(5, '2020-01-20 19:51:52', '2020-01-20 19:51:52', 's', 'kerolesatef200@gmail.com', '01060402713', 'www', 'complaint'),
(6, '2020-01-20 19:52:01', '2020-01-20 19:52:01', 's', 'kerolesatef200@gmail.com', '01060402713', 'www', 'complaint'),
(7, '2020-01-20 19:52:24', '2020-01-20 19:52:24', 's', 'kerolesatef200@gmail.com', '01060402713', 'ثثث', 'complaint'),
(8, '2020-01-20 19:54:48', '2020-01-20 19:54:48', 's', 'kerolesatef200@gmail.com', '01060402713', 'sdfsdfsdfsd', 'complaint'),
(9, '2020-01-20 19:55:11', '2020-01-20 19:55:11', 's', 'kerolesatef200@gmail.com', '01060402713', 'sdfsdfsdfsd', 'complaint');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `created_at`, `updated_at`, `name`, `city_id`) VALUES
(1, '2020-07-03 02:59:37', '2019-12-14 03:07:52', 'بني مزار', 2),
(2, '2020-07-03 02:59:30', '2020-07-02 02:59:34', 'ناصر', 3),
(4, '2019-12-13 23:36:53', '2019-12-13 23:44:57', 'ملوي', 8),
(5, '2019-12-13 23:38:18', '2019-12-13 23:38:18', 'مطاي', 2),
(6, '2019-12-13 23:44:57', '2020-07-01 02:59:26', 'كارنك', 4);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resturant_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `address`, `phone`, `age`, `resume`, `resturant_id`, `created_at`, `updated_at`) VALUES
(1, 'سشيشس', 'صضثضصث', '213213', '12', '123123123', 3, '2020-07-07 02:54:30', '2020-07-30 02:54:30'),
(2, 'سيشسي', 'سشيشس', '21321', '21321', '12312', 18, '2020-07-07 02:54:30', '2020-07-01 02:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_10_185951_create_categories_table', 1),
(5, '2019_12_10_185951_create_category_resturant_table', 1),
(6, '2019_12_10_185951_create_cities_table', 1),
(7, '2019_12_10_185951_create_clients_table', 1),
(8, '2019_12_10_185951_create_contacts_table', 1),
(9, '2019_12_10_185951_create_districts_table', 1),
(10, '2019_12_10_185951_create_notifications_table', 1),
(11, '2019_12_10_185951_create_offers_table', 1),
(12, '2019_12_10_185951_create_order_product_table', 1),
(13, '2019_12_10_185951_create_orders_table', 1),
(14, '2019_12_10_185951_create_payments_table', 1),
(15, '2019_12_10_185951_create_products_table', 1),
(16, '2019_12_10_185951_create_resturants_table', 1),
(17, '2019_12_10_185951_create_reviews_table', 1),
(18, '2019_12_10_185951_create_settings_table', 1),
(19, '2019_12_10_185951_create_tokens_table', 1),
(20, '2019_12_10_190001_create_foreign_keys', 1),
(21, '2019_12_15_154227_create_permission_tables', 2),
(22, '2020_07_25_101410_create_employees_table', 3),
(23, '2020_07_25_115141_add_job_to_resturants_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 4),
(3, 'App\\User', 3),
(4, 'App\\User', 3),
(5, 'App\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(11) NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `created_at`, `updated_at`, `content`, `notifiable_id`, `notifiable_type`, `is_read`) VALUES
(1, '2019-12-12 21:26:51', '2019-12-12 21:26:51', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(2, '2019-12-12 21:28:27', '2019-12-12 21:28:27', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(3, '2019-12-12 21:42:37', '2019-12-12 21:42:37', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(4, '2019-12-12 21:48:06', '2019-12-12 21:48:06', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(5, '2019-12-12 21:51:16', '2019-12-12 21:51:16', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(6, '2019-12-12 21:52:10', '2019-12-12 21:52:10', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(7, '2019-12-12 21:56:52', '2019-12-12 21:56:52', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(8, '2019-12-12 23:01:14', '2019-12-12 23:01:14', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(9, '2019-12-12 23:05:16', '2019-12-12 23:05:16', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(10, '2019-12-12 23:41:51', '2019-12-12 23:41:51', 'keroUpaccepted order', 4, 'App\\Models\\Resturant', 0),
(11, '2019-12-12 23:46:16', '2019-12-12 23:46:16', 'keroUp  accepted order ', 4, 'App\\Models\\Resturant', 0),
(12, '2019-12-12 23:48:11', '2019-12-12 23:48:11', 'keroUp  rejected order ', 4, 'App\\Models\\Resturant', 0),
(13, '2019-12-13 12:55:32', '2019-12-13 12:55:32', 'keroUp  accepted order ', 4, 'App\\Models\\Resturant', 0),
(14, '2019-12-13 13:30:11', '2019-12-13 13:30:11', 'keroUp  accepted order ', 4, 'App\\Models\\Resturant', 0),
(15, '2019-12-13 13:30:21', '2019-12-13 13:30:21', 'keroUp  accepted order ', 4, 'App\\Models\\Resturant', 0),
(16, '2019-12-13 13:32:33', '2019-12-13 13:32:33', 'mena_shop  accepted order ', 2, 'App\\Models\\Client', 0),
(17, '2019-12-13 13:37:10', '2019-12-13 13:37:10', 'mena_shop  rejected order ', 2, 'App\\Models\\Client', 0),
(18, '2019-12-13 13:39:07', '2019-12-13 13:39:07', 'mena_shop  accepted order ', 2, 'App\\Models\\Client', 0),
(19, '2019-12-13 14:31:10', '2019-12-13 14:31:10', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(20, '2019-12-13 14:35:03', '2019-12-13 14:35:03', 'mena_shop  accepted order ', 2, 'App\\Models\\Client', 0),
(21, '2019-12-13 14:35:29', '2019-12-13 14:35:29', 'keroUp  accepted order ', 4, 'App\\Models\\Resturant', 0),
(22, '2020-02-18 13:07:42', '2020-02-18 13:07:42', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(23, '2020-02-18 13:09:33', '2020-02-18 13:09:33', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(24, '2020-02-18 13:09:56', '2020-02-18 13:09:56', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(25, '2020-02-18 13:10:52', '2020-02-18 13:10:52', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(26, '2020-02-18 13:11:10', '2020-02-18 13:11:10', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(27, '2020-02-18 13:11:48', '2020-02-18 13:11:48', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(28, '2020-02-18 13:12:22', '2020-02-18 13:12:22', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(29, '2020-02-18 13:24:12', '2020-02-18 13:24:12', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0),
(30, '2020-02-28 12:00:33', '2020-02-28 12:00:33', 'you have new order from user keroUp', 4, 'App\\Models\\Resturant', 0);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resturant_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `created_at`, `updated_at`, `name`, `description`, `from`, `to`, `image`, `resturant_id`) VALUES
(3, NULL, NULL, 'اي  خدمه', 'احصل علي خصم 20% عند اول  طلب ', '2019-12-02', '2019-12-31', 'user_image1595904812.jpg', 4),
(4, '2020-07-28 00:53:32', '2020-07-28 00:53:32', 'سييسي', 'يييي', '2020-07-29', '2020-07-30', 'user_image1595904812.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special_order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resturant_id` int(10) UNSIGNED NOT NULL,
  `payment_method` enum('cash','online') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 1,
  `state` enum('pending','accepted','rejected','delivered','declined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total` double NOT NULL DEFAULT 0,
  `commission` double NOT NULL DEFAULT 0,
  `cost` double NOT NULL DEFAULT 0,
  `client_id` int(10) UNSIGNED NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net` double NOT NULL DEFAULT 0,
  `delivery_cost` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `updated_at`, `special_order`, `resturant_id`, `payment_method`, `amount`, `state`, `total`, `commission`, `cost`, `client_id`, `notes`, `address`, `net`, `delivery_cost`) VALUES
(56, '2020-03-10 14:27:07', '2020-03-11 14:57:28', NULL, 3, 'cash', 1, 'rejected', 29, 8.1, 27, 2, NULL, 'شارع البنك', 20.9, 2),
(57, '2020-03-10 14:28:07', '2020-07-28 00:39:19', NULL, 3, 'cash', 1, 'delivered', 44, 12.6, 42, 2, NULL, 'شارع البنك', 31.4, 2),
(58, '2020-03-10 14:33:53', '2020-07-28 00:39:33', NULL, 3, 'cash', 1, 'rejected', 29, 8.1, 27, 2, NULL, 'شارع البنك', 20.9, 2),
(59, '2020-03-11 13:57:33', '2020-03-11 13:57:33', NULL, 3, 'cash', 1, 'pending', 20, 5.3999999999999995, 18, 2, NULL, 'شارع البنك', 14.600000000000001, 2),
(60, '2020-07-28 00:43:15', '2020-07-28 00:43:16', NULL, 3, 'cash', 1, 'pending', 62, 18, 60, 2, 'assad', 'egypt', 44, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `created_at`, `updated_at`, `product_id`, `order_id`, `price`, `amount`) VALUES
(58, NULL, NULL, 7, 56, 12, 1),
(59, NULL, NULL, 8, 56, 12, 1),
(61, NULL, NULL, 1, 57, 3, 1),
(62, NULL, NULL, 4, 57, 12, 1),
(63, NULL, NULL, 7, 57, 12, 1),
(64, NULL, NULL, 8, 57, 12, 1),
(66, NULL, NULL, 4, 58, 12, 1),
(67, NULL, NULL, 8, 58, 12, 1),
(68, NULL, NULL, 1, 59, 3, 1),
(69, NULL, NULL, 8, 59, 12, 1),
(70, NULL, NULL, 11, 59, 3, 1),
(71, NULL, NULL, 4, 60, 60, 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('kerolesatef200@gmail.com', '$2y$10$zpEpYFBdXMClA1aEbUca.uWcuy2TnksRLuTKx5lAnz.wKxRirsd8C', '2019-12-16 02:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `resturant_id` int(10) UNSIGNED NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `group_name`, `routes`) VALUES
(1, 'user-lists', 'admin', NULL, NULL, 'User', 'user.index'),
(2, 'user-create', 'admin', NULL, NULL, 'User', 'user.create,user.store'),
(3, 'user-edit', 'admin', NULL, NULL, 'User', 'user.edit,user.update'),
(4, 'user-delete', 'admin', NULL, NULL, 'User', 'user.destroy'),
(5, 'categories-lists', 'admin', NULL, NULL, 'Categories', 'category.index'),
(6, 'categories-edit', 'admin', NULL, NULL, 'Categories', 'category.edit,category.update'),
(7, 'categories-delete', 'admin', NULL, NULL, 'Categories', 'category.destroy'),
(9, 'Resturant', 'admin', NULL, NULL, 'Resturant', 'resturant.indx,resturant.status,resturant.destroy'),
(10, 'client', 'admin', NULL, NULL, 'client', 'client.index,client.status,client.destroy,client.filter'),
(12, 'Contact', 'admin', NULL, NULL, 'contact', 'contact.index,contact.destroy,contact.filter'),
(13, 'categories-create', 'admin', NULL, NULL, 'Categories', 'category.create,category.store'),
(14, 'offer', 'admin', NULL, NULL, 'Offer', 'offer.index,offer.destroy,offer.filter'),
(15, 'Product', 'admin', NULL, NULL, 'Resturant food items', 'product.index,product.show,product.filter'),
(16, 'setting', 'admin', NULL, NULL, 'Setting', 'setting.index,setting.update'),
(17, 'district', 'admin', NULL, NULL, 'District', 'district.index,destrict.edite,destrict.update,district.create,district.store,district.destroy'),
(18, 'city', 'admin', NULL, NULL, 'City', 'city.index,city.edite,city.update,city.create,city.store,district.destroy');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `offering_price` double DEFAULT NULL,
  `duratrion` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resturant_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `offering_price`, `duratrion`, `image`, `resturant_id`) VALUES
(1, '2019-12-11 15:37:28', '2020-07-28 00:46:06', 'شاورما', 'شاورما', 3, NULL, 3, 'user_image1595904366.jpg', 3),
(4, '2019-12-11 15:55:11', '2019-12-11 22:11:28', 'فراخ بانيه', 'فراخ بانيه', 12, NULL, 444, 'user_image1595904366.jpg', 3),
(7, '2020-02-16 00:03:43', '2020-02-16 00:03:43', 'فراخ ع الفحم', 'فراخ ع الفحم', 12, NULL, 23, 'user_image1595904366.jpg', 3),
(8, '2020-02-16 00:04:36', '2020-02-16 00:04:36', 'شبسي', 'شبسي', 12, NULL, 23, 'user_image1595904366.jpg', 3),
(9, '2020-02-16 12:58:03', '2020-02-16 12:58:03', 'صورة المنتج', 'صورة المنتج\r\nصورة المنتج\r\nصورة المنتج', 12, NULL, 23, 'user_image1595904366.jpg', 3),
(10, '2020-02-16 13:55:40', '2020-02-16 15:05:37', 'صورة', 'صورة صورة', 12, 2, 23, 'user_image1595904366.jpg', 3),
(11, '2020-02-16 15:00:43', '2020-02-16 15:00:43', 'فثسف', 'فثسف', 12, 3, 23, 'user_image1595904366.jpg', 3),
(12, '2020-02-18 12:46:45', '2020-02-18 12:57:19', 'شاورما', 'شاورما حاه بالفراخ المكسره', 12, 11, 12, 'user_image1595904366.jpg', 4),
(13, '2020-02-18 12:52:13', '2020-02-18 12:57:12', 'فراخ مشويه', 'فراخ مشويه', 12, 2, 23, 'user_image1595904366.jpg', 4),
(15, '2020-02-18 15:18:48', '2020-02-18 15:18:48', 'مكرونه', 'مكرونه', 122, 4, 23, 'user_image1595904366.jpg', 4),
(16, '2020-07-28 06:39:31', '2020-07-28 06:39:31', 'fff', 'ffff', 12, NULL, 12, 'user_image1595925571.jpg', 19);

-- --------------------------------------------------------

--
-- Table structure for table `resturants`
--

CREATE TABLE `resturants` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` int(10) UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_charge` double NOT NULL,
  `minimum_order` double NOT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whats` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `job` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resturants`
--

INSERT INTO `resturants` (`id`, `created_at`, `updated_at`, `name`, `email`, `phone`, `district_id`, `password`, `delivery_charge`, `minimum_order`, `contact_phone`, `whats`, `image`, `state`, `api_token`, `pin_code`, `active`, `job`) VALUES
(3, '2019-12-11 14:48:30', '2020-07-28 00:53:00', 'keroles', 'k@gmail.com', '01060402713', 1, '$2y$10$OXJ/SRi9htcqXlnb2UB7peCbqoTVsrOCU76KlU/JSAw71b78EJoWy', 2, 10, '10', NULL, 'user_image1595904644.png', 1, 'Xk89RQPgFkbYytclbnn5RqZ1ouV4z8nnwGhoTQgavdGJPIbQcMp6zUpnmSwq', NULL, 1, 1),
(4, '2019-12-11 15:40:16', '2020-02-07 06:53:03', 'mena_shop', 'm@gmail.com', '01060402713', 1, '$2y$10$SG17UBWpXOgMiQwWNluNTujJA6IU1hnlJ/cx5toO3ArqxZHT8IQ9W', 10, 10, '10', NULL, 'user_image1595904644.png', 1, 'LMSQml3ai8k0WpPHtmlvIfyYoaPn4ZsKtg1E1qSaZuzUeVwgJIk8TpnHRZDc', NULL, 1, 0),
(12, '2020-01-20 12:29:04', '2020-01-20 12:29:04', 'ddd_shop', 'addb@gmail.com', '231242341', 1, '$2y$10$yHZnTDGNgC9jv.Ipzc6vs.QrH85xZn3cSOFwuG/pD6QhqRyQsfNxq', 5, 10, '10', NULL, 'user_image1595904644.png', 1, 'q0NjAVDG5Wg7t9jdLy4wKizJ5ibyoduiwKjsIq6sIXmdQ8O6sRrBMweSQfzY', NULL, 1, 0),
(18, '2020-01-23 21:10:26', '2020-01-23 21:10:26', 'كيرلس ', 'dd@gmail.com', '21312', 2, '$2y$10$8QlSxh662tgmUFQEWqeFredrPrLt.7WZ.AjHZNmlxd2XBO69Y1tc.', 1, 10, '10', '12312', 'user_image1595904644.png', 1, 'yaj1Ur7X5y04Wviso1pHfeOds774oTMfXCJU7rZyyBgaXkf5CzwWs6FERqjX', NULL, 1, 0),
(19, '2020-07-28 06:38:59', '2020-07-28 06:38:59', 'dd', 'aw@gmail.com', '787755', 1, '$2y$10$cki9QfAtyGAI3hk205M9ZOeL/SmonbQjVBP3zBQk9pskISYGGTdde', 10, 12, '4444', '33333', 'user_image1595925538.png', 1, 'E4KKJAXDc77w9SFrBMbbsH7itbzBxPKIHerQKGjAaDnHgXNr38PIvzCgdNBI', NULL, 1, 0),
(20, '2020-07-28 06:49:49', '2020-07-28 06:49:50', 'kero', 'kero@gmail.com', '8888', 1, '$2y$10$hH3wvGvmLxTLlcXV/p.S2ucg/q7QHweOhT4PCeC2w1oLEDZVn2hA.', 12, 19, '2111', '213123', 'user_image1595926189.png', 1, 'caN2aAxNEYIn5Z74GiQih0qUsit9FLAalvBCB32guPAI6qy3LLtkYyaKCxBY', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reate` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `resturant_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `created_at`, `updated_at`, `reate`, `comment`, `client_id`, `resturant_id`) VALUES
(1, NULL, NULL, '2', '', 2, 4),
(2, '2019-12-12 10:19:10', '2019-12-12 10:19:10', '5', 'ay klam', 2, 3),
(5, NULL, NULL, '1', 'waeqwewqeq', 2, 3),
(6, NULL, NULL, '3', 'wqeqw', 2, 3),
(7, '2020-02-27 14:43:57', '2020-02-27 14:43:57', '4', 'الدنيا هنا حلوه فشخ علفكره', 2, 3),
(8, '2020-02-27 14:46:00', '2020-02-27 14:46:00', '5', 'حلو جدا  انا  اتعاملت معاه زي  الفل جدا', 5, 3),
(9, '2020-07-28 00:44:20', '2020-07-28 00:44:20', '4', 'wwww', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `description`) VALUES
(1, 'admin', 'admin', '2019-12-15 22:33:01', '2019-12-15 22:37:40', 'do any thing'),
(3, 'resturant controller', 'admin', '2019-12-15 23:22:07', '2019-12-15 23:22:07', NULL),
(4, 'client controller', 'admin', '2019-12-16 00:45:11', '2019-12-16 00:45:11', NULL),
(5, 'city controller', 'admin', '2019-12-16 00:45:34', '2019-12-16 00:45:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(9, 1),
(9, 3),
(10, 1),
(10, 4),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(17, 5),
(18, 1),
(18, 5);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `about_app` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission` double NOT NULL,
  `tex_up` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_down` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `about_app`, `commission`, `tex_up`, `text_down`, `acc1`, `acc2`) VALUES
(1, NULL, '2019-12-14 02:29:58', 'نحن  شركه غير مسؤله عن بيع اي  منتج ولكن تسهل  التعامل  مع البائعين وتوفر حاجه الزبائن نحن  شركه غير مسؤله عن بيع اي  منتج ولكن تسهل  التعامل  مع البائعين وتوفر حاجه الزبائن', 0.3, 'برجاء تحويل 10% من الربح المباع ف مده اقصاها شهر  علما بان  جميع الطلبات ستكون مسجله علي حسابك الشخصي', 'باسم سفره', '432535343', '435434655');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` int(11) NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `created_at`, `updated_at`, `token`, `tokenable_id`, `tokenable_type`) VALUES
(2, '2019-12-12 21:01:43', '2019-12-12 21:01:43', 'eGWRPgSVhz4:APA91bFo5Fg4EvDWhDCxvcs4kw9ODlV2tfh13AlokiIxQO2kmMtjiY6z7cFZMmTA-ioV5_A7e41puYjsf6Nx0QEEb8jJVErAFn9huiP-qlVvyPkPKOXsnPSQdqUA_Ab9AVY_g1nhK1eZ', 4, 'App\\Models\\Resturant');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'mina', 'mina@gmail.com', NULL, '$2y$10$I9RLRMax7n2C7VTEDXoZZOQ2WDZFj3tJfnpdLiKMNkPZfgPdiZRiy', NULL, '2019-12-15 23:21:17', '2019-12-15 23:21:17'),
(4, 'keroles', 'kerolesatef200@gmail.com', NULL, '$2y$10$h4CfTyVDZliwS0a1rYH7AeCVvr5jgOQ0fJoxW9MAHMWUL6GbO.ZrW', 'BBMKbw3YixbsoadYtsK4bCQ3fZXTKc1NfhDL1K5Xe8mgSk6L4RU8676S7Dih', '2019-12-15 23:22:20', '2019-12-15 23:22:20'),
(5, 'eee', 'nnnnn@gmail.com', NULL, '$2y$10$5J6CUlUbcNfjBirb2/zCV.rhUCIMwj/qTA2AzDzy4Z/FGPM1jjQk.', NULL, '2020-01-22 15:13:36', '2020-01-22 15:13:36'),
(6, 'emad.malak@poem.com', 'emad.malak@poem.com', NULL, '$2y$10$UwGB4dMgMTGN68KawoT/dOxRemBHsV7lE09oObzn.BjNc9xLN/jt.', NULL, '2020-02-24 15:02:29', '2020-02-24 15:02:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_resturant`
--
ALTER TABLE `category_resturant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_resturant_category_id_foreign` (`category_id`),
  ADD KEY `category_resturant_resturant_id_foreign` (`resturant_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_district_id_foreign` (`district_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_city_id_foreign` (`city_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_resturant_id_foreign` (`resturant_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_resturant_id_foreign` (`resturant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_resturant_id_foreign` (`resturant_id`),
  ADD KEY `orders_client_id_foreign` (`client_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product_product_id_foreign` (`product_id`),
  ADD KEY `order_product_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_resturant_id_foreign` (`resturant_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_resturant_id_foreign` (`resturant_id`);

--
-- Indexes for table `resturants`
--
ALTER TABLE `resturants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `resturants_district_id_foreign` (`district_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_client_id_foreign` (`client_id`),
  ADD KEY `reviews_resturant_id_foreign` (`resturant_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category_resturant`
--
ALTER TABLE `category_resturant`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `resturants`
--
ALTER TABLE `resturants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_resturant`
--
ALTER TABLE `category_resturant`
  ADD CONSTRAINT `category_resturant_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_resturant_resturant_id_foreign` FOREIGN KEY (`resturant_id`) REFERENCES `resturants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_resturant_id_foreign` FOREIGN KEY (`resturant_id`) REFERENCES `resturants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_resturant_id_foreign` FOREIGN KEY (`resturant_id`) REFERENCES `resturants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_resturant_id_foreign` FOREIGN KEY (`resturant_id`) REFERENCES `resturants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_resturant_id_foreign` FOREIGN KEY (`resturant_id`) REFERENCES `resturants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_resturant_id_foreign` FOREIGN KEY (`resturant_id`) REFERENCES `resturants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resturants`
--
ALTER TABLE `resturants`
  ADD CONSTRAINT `resturants_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_resturant_id_foreign` FOREIGN KEY (`resturant_id`) REFERENCES `resturants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
