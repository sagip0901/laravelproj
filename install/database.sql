-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 07, 2024 at 11:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assista`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admins', 'admin@site.com', 'admin', NULL, '66b3120b71c4a1723011595.png', '$2y$12$yd/wmUsxeT3N5/7HrsnLQuE6n.KjQAqB6r1vumxyJvpcetjChUrmW', 'UFBLQHcnPAMns2yO6CDfwQqT7BPjHO2vi5tWR6FN4QHD5N2Ftpgc8JXyOCDs', NULL, '2024-08-07 00:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `click_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ai_translates`
--

CREATE TABLE `ai_translates` (
  `id` bigint NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `language` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `result` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `token` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archivers`
--

CREATE TABLE `archivers` (
  `id` bigint NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `archiver_category_id` int DEFAULT '0',
  `identifier` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archiver_categories`
--

CREATE TABLE `archiver_categories` (
  `id` bigint NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `a_i_images`
--

CREATE TABLE `a_i_images` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `artist` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `amount` tinyint(1) NOT NULL DEFAULT '1',
  `resolution` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ads', 1, '2023-07-26 10:14:05', '2023-09-10 09:53:22'),
(2, 'Articles', 1, '2023-07-26 10:14:05', '2023-07-26 10:14:05'),
(3, 'Blogs', 1, '2023-07-26 10:14:05', '2023-07-26 10:14:05'),
(4, 'E-commerce', 1, '2023-07-26 10:14:05', '2023-07-26 10:14:05'),
(5, 'Emails', 1, '2023-07-26 10:14:05', '2023-07-26 10:14:05'),
(7, 'Marketing', 1, '2023-07-26 10:14:05', '2023-07-26 10:14:05'),
(8, 'Social Media', 1, '2023-07-26 10:14:05', '2023-07-26 10:14:05'),
(10, 'Website', 1, '2023-07-26 10:14:05', '2023-07-26 10:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint UNSIGNED NOT NULL,
  `chat_bot_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_bots`
--

CREATE TABLE `chat_bots` (
  `id` int UNSIGNED NOT NULL,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `show_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_bots`
--

INSERT INTO `chat_bots` (`id`, `code`, `name`, `designation`, `image`, `description`, `is_free`, `status`, `show_status`, `created_at`, `updated_at`) VALUES
(1, 'V6SACC', 'Travel Adviser', 'Personal Travel Guider', '64e99281082a41693028993.png', 'Aenean viverra rhoncus pede. Ut varius tincidunt libero. Mauris sollicitudin fermentum libero. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.', 1, 1, 1, '2023-08-13 03:51:43', '2023-08-26 05:57:51'),
(2, '4B2T5H', 'George R R Martin', 'Story Writer', '64d87a009b3c91691908608.png', 'Aenean vulputate eleifend tellus. Curabitur ullamcorper ultricies nisi. Nam commodo suscipit quam. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi.', 0, 1, 1, '2023-08-13 03:55:24', '2023-08-13 04:06:48'),
(3, 'O9UTJX', 'Ignacia Conway', 'Social Media Influencer', '64e9bd94528bd1693040020.png', 'Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Cras non dolor. Fusce a quam. Fusce egestas elit eget lorem.', 1, 1, 1, '2023-08-26 06:00:33', '2023-08-26 08:53:40'),
(4, 'TJFTVY', 'Language Tutor', 'Personal Language Tutor', '64e9bde2f3dd91693040098.png', 'Praesent egestas tristique nibh. Ut id nisl quis enim dignissim sagittis. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Cras dapibus. Vestibulum dapibus nunc ac augue.', 1, 1, 1, '2023-08-26 06:01:17', '2023-08-26 08:54:59'),
(5, 'BDANO6', 'Alex Hightower', 'Personal Doctor', '64e9bd8c378091693040012.png', 'Cras varius. Nulla sit amet est. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus.', 0, 1, 1, '2023-08-26 06:01:57', '2023-09-09 07:21:03'),
(6, 'RJCGCQ', 'Interior Design', 'Personal Interior Guider', '64e9bda801d1f1693040040.png', 'Vestibulum suscipit nulla quis orci. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi. Nullam quis ante.', 1, 1, 1, '2023-08-26 06:02:36', '2023-08-26 08:54:00'),
(7, 'DCZ9TZ', 'Fitness Trainer', 'Personal Fitness Trainer', '64e9bd6f643fe1693039983.png', 'Suspendisse potenti. Phasellus gravida semper nisi. Suspendisse nisl elit, rhoncus eget, elementum ac, condimentum eget, diam. Praesent metus tellus, elementum eu, semper a, adipiscing nec, purus.', 1, 1, 1, '2023-08-26 06:03:09', '2023-08-26 08:53:03'),
(8, 'XWOQCR', 'Ferris Hester', 'SEO Specialist', '64e9bd64bcbc51693039972.png', 'Nunc nulla. Sed fringilla mauris sit amet nibh. Mauris sollicitudin fermentum libero.', 1, 1, 1, '2023-08-26 06:03:54', '2023-08-26 08:52:52'),
(9, 'RT5W78', 'Jayme Marshall', 'Accountant', '64e9bdc2100e91693040066.png', 'Etiam iaculis nunc ac metus. Maecenas malesuada. Quisque rutrum. In auctor lobortis lacus.', 1, 1, 1, '2023-08-26 06:04:15', '2023-08-26 08:54:26'),
(10, '7WGASW', 'Charlotte Hood', 'English Grammer Tutor', '64e9bd5626b651693039958.png', 'Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Duis lobortis massa imperdiet quam. Phasellus tempus. Etiam ut purus mattis mauris sodales aliquam.', 1, 1, 1, '2023-08-26 06:04:55', '2023-08-26 08:52:38'),
(11, '6VFEA1', 'Laura Wilkerson', 'Cyber Security Specialist', '64e9bdd1c46121693040081.png', 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede.', 1, 1, 1, '2023-08-26 06:05:39', '2023-08-26 08:54:41'),
(12, 'Z5V9GE', 'Celeste Diaz', 'Business Analysist', '64e9bd4b3f0901693039947.png', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem.', 0, 1, 1, '2023-08-26 06:08:18', '2023-08-26 08:52:27'),
(13, 'HMXKAR', 'Alexander Golden', 'Psychologist', '64e9bd3c31bc51693039932.png', 'Nullam cursus lacinia erat. Nunc nulla. Vestibulum turpis sem, aliquet eget, lobortis pellentesque, rutrum eu, nisl. Etiam iaculis nunc ac metus', 1, 1, 1, '2023-08-26 06:09:03', '2023-09-09 07:21:45'),
(14, '4YGKM5', 'Rana Rice', 'Academic Support', '64e9bdea532c21693040106.png', 'Curabitur turpis. Sed lectus. Phasellus viverra nulla ut metus varius laoreet. Nunc nec neque.', 1, 1, 1, '2023-08-26 06:09:38', '2023-08-26 08:55:06'),
(15, '5P8XPN', 'Ila William', 'Server Specialist', '64e9bd9d3a5341693040029.png', 'Nam eget dui. Etiam imperdiet imperdiet orci. Aenean imperdiet. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.', 1, 1, 1, '2023-08-26 06:10:06', '2023-08-26 08:53:49'),
(16, 'OBZSH3', 'Rama Shepard', 'Job Interviewer', '64e9bdda9d99e1693040090.png', 'Praesent blandit laoreet nibh. Phasellus magna. Praesent turpis. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.', 0, 1, 1, '2023-08-26 06:10:48', '2023-08-26 08:54:50'),
(17, 'PHXVBZ', 'Drake Roberson', 'Event Planner', '64e9bd5d77ebb1693039965.png', 'Praesent egestas neque eu enim. In turpis. Phasellus volutpat, metus eget egestas mollis, lacus lacus blandit dui, id egestas quam mauris ut lacus. Sed hendrerit.', 1, 1, 1, '2023-08-26 06:15:39', '2023-08-26 08:52:45'),
(18, 'OFNBT9', 'Cathleen Hurst', 'Career Counselor', '64e9bd45127f61693039941.png', 'Aenean imperdiet. Aenean imperdiet. Ut a nisl id ante tempus hendrerit. Vestibulum suscipit nulla quis orci.', 1, 1, 1, '2023-08-26 06:17:00', '2023-08-26 08:52:21'),
(19, 'HG4J3F', 'Jaime Hill', 'Poet', '64e9bdbace2321693040058.png', 'Vestibulum facilisis, purus nec pulvinar iaculis, ligula mi congue nunc, vitae euismod ligula urna in dolor. Suspendisse non nisl sit amet velit hendrerit rutrum. Ut a nisl id ante tempus hendrerit.', 1, 1, 1, '2023-08-26 06:17:38', '2023-08-26 08:54:18'),
(20, '26YQ6H', 'Hamilton Bruce', 'Motivational Guider', '64e9bd7ae57ba1693039994.png', 'Nullam accumsan lorem in dui. Aenean imperdiet. Phasellus magna. Aenean ut eros et nisl sagittis vestibulum.', 1, 1, 1, '2023-08-26 06:18:16', '2023-08-26 08:53:15'),
(21, 'EJVK3Y', 'AI Chat Bot', 'Default Bot', '64e9bd3086d481693039920.png', 'Fusce fermentum. Fusce convallis metus id felis luctus adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nullam quis ante.', 1, 1, 1, '2023-08-26 06:21:35', '2023-09-09 07:22:02'),
(23, 'X67Z7C', 'Financial Advisor', 'Financial Advisor', '64fc1b9f3125c1694243743.png', 'A robust financial advisor for any business holder', 1, 1, 0, '2023-09-09 07:15:43', '2023-09-09 07:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `chat_id` int NOT NULL DEFAULT '0',
  `sender` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `word` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT '0',
  `language` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instruction` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `token` int NOT NULL DEFAULT '0',
  `result` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `subscription_id` int NOT NULL DEFAULT '0',
  `method_code` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `method_currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `final_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `discount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `btc_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_try` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(1) NOT NULL DEFAULT '0',
  `admin_feedback` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `success_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `failed_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_cron` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_tokens`
--

CREATE TABLE `device_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `is_app` tinyint(1) NOT NULL DEFAULT '0',
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'object',
  `support` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, '2019-10-18 23:16:05', '2022-03-22 05:22:24'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\n<div class=\"g-recaptcha\" data-sitekey=\"{{site_key}}\" data-callback=\"verifyCaptcha\"></div>\n<div id=\"g-recaptcha-error\"></div>', '{\"site_key\":{\"title\":\"Site Key\",\"value\":\"6LdPC88fAAAAADQlUf_DV6Hrvgm-pZuLJFSLDOWV\"},\"secret_key\":{\"title\":\"Secret Key\",\"value\":\"6LdPC88fAAAAAG5SVaRYDnV2NpCrptLg2XLYKRKB\"}}', 'recaptcha.png', 0, '2019-10-18 23:16:05', '2024-07-04 03:22:28'),
(3, 'custom-captcha', 'Custom Captcha', 'Just put any random string', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, '2019-10-18 23:16:05', '2024-08-07 03:23:46'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{measurement_id}}\"></script>\n <script>\n window.dataLayer = window.dataLayer || [];\n function gtag(){dataLayer.push(arguments);}\n gtag(\"js\", new Date());\n \n gtag(\"config\", \"{{measurement_id}}\");\n </script>', '{\"measurement_id\":{\"title\":\"Measurement ID\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, '2021-05-04 10:19:12'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"----\"}}', 'fb_com.PNG', 0, NULL, '2022-03-22 05:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `template_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint UNSIGNED NOT NULL,
  `data_keys` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `seo_content`, `tempname`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"Assista\",\"Content Writer\",\"Text Transform\",\"Code Assistance\",\"Virtual Chat\",\"Weather\",\"Speech to Text\"],\"description\":\"Assista - Content Writing Assistant is designed to help writers create high-quality content more efficiently. It offers a variety of capabilities, from generating ideas and researching topics to outlining and writing full drafts. Whether you\'re an experienced writer or just starting out, content writing assistants can provide valuable support and improve your writing process\",\"social_title\":\"Assista - Content Writing Assistant as SAAS\",\"social_description\":\"Assista - Content Writing Assistant is designed to help writers create high-quality content more efficiently. It offers a variety of capabilities, from generating ideas and researching topics to outlining and writing full drafts. Whether you\'re an experienced writer or just starting out, content writing assistants can provide valuable support and improve your writing process\",\"image\":\"66b31344d9faf1723011908.png\"}', NULL, 'basic', '', '2020-07-05 03:42:52', '2024-08-07 00:25:09'),
(24, 'about.content', '{\"has_image\":\"1\",\"heading\":\"Latest News\",\"sub_heading\":\"Register New Account\",\"description\":\"fdg sdfgsdf g ggg\",\"about_icon\":\"<i class=\\\"las la-address-card\\\"><\\/i>\",\"background_image\":\"60951a84abd141620384388.png\",\"about_image\":\"5f9914e907ace1603867881.jpg\"}', NULL, 'basic', NULL, '2020-10-28 04:51:20', '2021-05-07 14:16:28'),
(25, 'article.content', '{\"heading\":\"Fresh Insights & Articles\",\"subheading\":\"Discover our Featured Reads, offering the latest tips, trends, and articles to enrich your knowledge and stay updated.\"}', NULL, 'basic', NULL, '2020-10-28 04:51:34', '2023-11-22 16:44:36'),
(26, 'article.element', '{\"has_image\":[\"1\"],\"title\":\"Elegant content writing\",\"description\":\"<span>Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<\\/span><br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div><div><br \\/><\\/div><blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#2c2c4d;font-size:18px;border-left:4px solid #e40a73;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote><h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5><div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div><div><br \\/><\\/div><h5>Planning before starting<\\/h5><div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<\\/div><\\/div>\",\"image\":\"655c9874b6d181700567156.jpg\"}', NULL, 'basic', 'elegant-content-writing', '2020-10-28 04:57:19', '2024-07-04 02:35:43'),
(27, 'contact_us.content', '{\"heading\":\"Send Us Your Message\",\"subheading\":\"Write to us, we are happy to assist you about your queries. Please get in touch and our expert support team will answer all your questions.\",\"google_map\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d27565.68573541891!2d-97.77096753256657!3d30.27382260117038!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8644b5096b006043%3A0xbce6f3d2684a9860!2sThe%20Belmont!5e0!3m2!1sen!2sde!4v1720084220890!5m2!1sen!2sde\"}', NULL, 'basic', '', '2020-10-28 04:59:19', '2024-07-04 03:10:41'),
(28, 'counter.content', '{\"heading\":\"Latest News\",\"sub_heading\":\"Register New Account\"}', NULL, 'basic', NULL, '2020-10-28 05:04:02', '2020-10-28 05:04:02'),
(31, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"fab fa-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\\/\"}', NULL, 'basic', NULL, '2020-11-12 09:07:30', '2023-09-10 13:44:58'),
(33, 'feature.content', '{\"heading\":\"The Evolution of Our \\ud83c\\udf1f Intelligence Tool\",\"subheading\":\"Embark on a transformative journey with our intelligence tool, innovating at every step. Join the evolution today and redefine intelligence. Welcome to the future of analytics.\"}', NULL, 'basic', NULL, '2021-01-04 04:40:54', '2023-11-22 17:40:15'),
(34, 'feature.element', '{\"title\":\"Content Generator\",\"icon\":\"<i class=\\\"fas fa-pen\\\"><\\/i>\"}', NULL, 'basic', NULL, '2021-01-04 04:41:02', '2023-11-21 10:33:35'),
(35, 'service.element', '{\"trx_type\":\"withdraw\",\"service_icon\":\"<i class=\\\"las la-highlighter\\\"><\\/i>\",\"title\":\"asdfasdf\",\"description\":\"asdfasdfasdfasdf\"}', NULL, 'basic', NULL, '2021-03-06 06:12:10', '2021-03-06 06:12:10'),
(36, 'service.content', '{\"trx_type\":\"deposit\",\"heading\":\"asdf fffff\",\"subheading\":\"555\"}', NULL, 'basic', NULL, '2021-03-06 06:27:34', '2022-03-30 12:07:06'),
(39, 'banner.content', '{\"has_image\":\"1\",\"heading\":\"Write Better Content \\u270d\\ufe0f to Grow  Journey of\",\"short_description\":\"All you need to  manage\\u270d\\ufe0f and grow your Access the tools necessary for scaling, along with flexible marketing programs and the talent needed for effortless growth \\u2014 all within a singular platform.\",\"button_one\":\"Get Started\",\"button_one_link\":\"user\\/register\",\"button_two\":\"Contact Us\",\"button_two_link\":\"contact\",\"banner_image\":\"655a1bef53d771700404207.png\"}', NULL, 'basic', NULL, '2021-05-02 10:09:30', '2023-11-30 17:04:43'),
(41, 'cookie.data', '{\"short_desc\":\"We may use cookies or any other tracking technologies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the Site and improve your experience.\",\"description\":\"<div>\\r\\n  <h4 class=\\\"banner-content__title mb-2\\\">What information do we collect?<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  We gather data from you when you register on our site, submit a request, buy\\r\\n  any services, react to an overview, or round out a structure. At the point\\r\\n  when requesting any assistance or enrolling on our site, as suitable, you\\r\\n  might be approached to enter your: name, email address, or telephone number.\\r\\n  You may, nonetheless, visit our site anonymously.\\r\\n<\\/div>\\r\\n<div><br><\\/div>\\r\\n<div>\\r\\n  <h4 class=\\\"banner-content__title mb-2\\\">How do we protect your information?<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">All provided delicate\\/credit data is sent through Stripe.<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  After an exchange, your private data (credit cards, social security numbers,\\r\\n  financials, and so on) won\'t be put away on our workers.\\r\\n<\\/div>\\r\\n<div><br><\\/div>\\r\\n<div>\\r\\n  <h4 class=\\\"banner-content__title mb-2\\\">Do we disclose any information to outside parties?<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  We don\'t sell, exchange, or in any case move to outside gatherings by and by\\r\\n  recognizable data. This does exclude confided in outsiders who help us in\\r\\n  working our site, leading our business, or adjusting you, since those\\r\\n  gatherings consent to keep this data private. We may likewise deliver your\\r\\n  data when we accept discharge is suitable to follow the law, implement our\\r\\n  site strategies, or ensure our own or others\' rights, property, or wellbeing.\\r\\n<\\/div>\\r\\n<div><br><\\/div>\\r\\n<div>\\r\\n  <h4 class=\\\"banner-content__title mb-2\\\">Children\'s Online Privacy Protection Act Compliance<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  We are consistent with the prerequisites of COPPA (Children\'s Online Privacy\\r\\n  Protection Act), we don\'t gather any data from anybody under 13 years old. Our\\r\\n  site, items, and administrations are completely coordinated to individuals who\\r\\n  are in any event 13 years of age or more established.\\r\\n<\\/div>\\r\\n<div><br><\\/div>\\r\\n<div>\\r\\n <h4>Changes to our Privacy Policy<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  If we decide to change our privacy policy, we will post those changes on this\\r\\n  page.\\r\\n<\\/div>\\r\\n<div><br><\\/div>\\r\\n<div>\\r\\n <h4>How long we retain your information?<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  At the point when you register for our site, we cycle and keep your\\r\\n  information we have about you however long you don\'t erase the record or\\r\\n  withdraw yourself (subject to laws and guidelines).\\r\\n<\\/div>\\r\\n<div><br><\\/div>\\r\\n<div>\\r\\n <h4>What we don\\u2019t do with your data<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  We don\'t and will never share, unveil, sell, or in any case give your\\r\\n  information to different organizations for the promoting of their items or\\r\\n  administrations.\\r\\n<\\/div>\",\"status\":1}', NULL, 'basic', NULL, '2020-07-05 03:42:52', '2023-11-30 17:51:49'),
(42, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<div>\\r\\n  <h4 class=\\\"banner-content__title mb-2\\\">What information do we collect?<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  We gather data from you when you register on our site, submit a request, buy\\r\\n  any services, react to an overview, or round out a structure. At the point\\r\\n  when requesting any assistance or enrolling on our site, as suitable, you\\r\\n  might be approached to enter your: name, email address, or telephone number.\\r\\n  You may, nonetheless, visit our site anonymously.\\r\\n<\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n<div>\\r\\n  <h4 class=\\\"banner-content__title mb-2\\\">How do we protect your information?<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">All provided delicate\\/credit data is sent through Stripe.<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  After an exchange, your private data (credit cards, social security numbers,\\r\\n  financials, and so on) won\'t be put away on our workers.\\r\\n<\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n<div>\\r\\n  <h4 class=\\\"banner-content__title mb-2\\\">Do we disclose any information to outside parties?<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  We don\'t sell, exchange, or in any case move to outside gatherings by and by\\r\\n  recognizable data. This does exclude confided in outsiders who help us in\\r\\n  working our site, leading our business, or adjusting you, since those\\r\\n  gatherings consent to keep this data private. We may likewise deliver your\\r\\n  data when we accept discharge is suitable to follow the law, implement our\\r\\n  site strategies, or ensure our own or others\' rights, property, or wellbeing.\\r\\n<\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n<div>\\r\\n  <h4 class=\\\"banner-content__title mb-2\\\">Children\'s Online Privacy Protection Act Compliance<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  We are consistent with the prerequisites of COPPA (Children\'s Online Privacy\\r\\n  Protection Act), we don\'t gather any data from anybody under 13 years old. Our\\r\\n  site, items, and administrations are completely coordinated to individuals who\\r\\n  are in any event 13 years of age or more established.\\r\\n<\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n<div>\\r\\n <h4>Changes to our Privacy Policy<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  If we decide to change our privacy policy, we will post those changes on this\\r\\n  page.\\r\\n<\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n<div>\\r\\n <h4>How long we retain your information?<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  At the point when you register for our site, we cycle and keep your\\r\\n  information we have about you however long you don\'t erase the record or\\r\\n  withdraw yourself (subject to laws and guidelines).\\r\\n<\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n<div>\\r\\n <h4>What we don\\u2019t do with your data<\\/h4>\\r\\n<\\/div>\\r\\n<div class=\\\"policy-heading__desc\\\">\\r\\n  We don\'t and will never share, unveil, sell, or in any case give your\\r\\n  information to different organizations for the promoting of their items or\\r\\n  administrations.\\r\\n<\\/div>\"}', NULL, 'basic', 'privacy-policy', '2021-06-09 12:50:42', '2023-11-30 09:22:23'),
(43, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<div>\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      What information do we collect?\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      We gather data from you when you register on our site, submit a request,\\r\\n      buy any services, react to an overview, or round out a structure. At the\\r\\n      point when requesting any assistance or enrolling on our site, as\\r\\n      suitable, you might be approached to enter your: name, email address, or\\r\\n      telephone number. You may, nonetheless, visit our site anonymously.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      How do we protect your information?\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      All provided delicate\\/credit data is sent through Stripe.<br \\/>After an\\r\\n      exchange, your private data (credit cards, social security numbers,\\r\\n      financials, and so on) won\'t be put away on our workers.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      Do we disclose any information to outside parties?\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      We don\'t sell, exchange, or in any case move to outside gatherings by and\\r\\n      by recognizable data. This does exclude confided in outsiders who help us\\r\\n      in working our site, leading our business, or adjusting you, since those\\r\\n      gatherings consent to keep this data private. We may likewise deliver your\\r\\n      data when we accept discharge is suitable to follow the law, implement our\\r\\n      site strategies, or ensure our own or others\' rights, property, or\\r\\n      wellbeing.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      Children\'s Online Privacy Protection Act Compliance\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      We are consistent with the prerequisites of COPPA (Children\'s Online\\r\\n      Privacy Protection Act), we don\'t gather any data from anybody under 13\\r\\n      years old. Our site, items, and administrations are completely coordinated\\r\\n      to individuals who are in any event 13 years of age or more established.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      Changes to our Privacy Policy\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      If we decide to change our privacy policy, we will post those changes on\\r\\n      this page.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      How long we retain your information?\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      At the point when you register for our site, we cycle and keep your\\r\\n      information we have about you however long you don\'t erase the record or\\r\\n      withdraw yourself (subject to laws and guidelines).\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      What we don\\u2019t do with your data\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      We don\'t and will never share, unveil, sell, or in any case give your\\r\\n      information to different organizations for the promoting of their items or\\r\\n      administrations.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<\\/div>\"}', NULL, 'basic', 'terms-of-service', '2021-06-09 12:51:18', '2023-11-30 09:31:03'),
(44, 'maintenance.data', '{\"description\":\"<div class=\\\"mb-5\\\" style=\\\"font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"text-align: center; font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif;\\\"><font color=\\\"#6c757d\\\">What information do we collect?<\\/font><\\/h3><p class=\\\"font-18\\\" style=\\\"text-align: center; margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\"><font color=\\\"#6c757d\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/font><\\/p><\\/div>\",\"image\":\"66b3137893d5e1723011960.png\"}', NULL, 'basic', NULL, '2020-07-05 03:42:52', '2024-08-07 00:26:00'),
(45, 'banner.element', '{\"tag\":\"Webpage\"}', NULL, 'basic', NULL, '2023-08-20 15:01:23', '2023-11-23 10:57:41'),
(46, 'banner.element', '{\"tag\":\"Solution\"}', NULL, 'basic', NULL, '2023-08-20 15:01:29', '2023-11-18 13:46:04'),
(47, 'banner.element', '{\"tag\":\"Ideas\"}', NULL, 'basic', NULL, '2023-08-20 15:01:33', '2023-08-20 15:01:33'),
(48, 'banner.element', '{\"tag\":\"Business\"}', NULL, 'basic', NULL, '2023-08-20 15:02:54', '2023-11-23 10:48:11'),
(49, 'how_it_work.content', '{\"heading\":\"How It \\ud83d\\udc69\\u200d\\ud83d\\udcbb Works\",\"subheading\":\"You really want to follow a couple of basic moves toward produce your substance. Utilize the simulated intelligence and save your time.\"}', NULL, 'basic', NULL, '2023-08-20 15:06:09', '2023-11-22 16:38:25'),
(50, 'how_it_work.element', '{\"title\":\"Select Template\",\"content\":\"Select template first that you want to generate content\",\"icon\":\"<i class=\\\"fas fa-bars\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-08-20 15:06:32', '2023-08-20 15:06:32'),
(51, 'how_it_work.element', '{\"title\":\"Write Your Prompt or Context\",\"content\":\"Enter a few sentences about your brand and products\",\"icon\":\"<i class=\\\"fas fa-user-edit\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-08-20 15:07:21', '2023-08-20 15:07:21'),
(52, 'how_it_work.element', '{\"title\":\"Select Advance Option & Generate\",\"content\":\"Multiple options for each campaign that you\\u2019re working on\",\"icon\":\"<i class=\\\"far fa-hand-pointer\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-08-20 15:07:43', '2023-08-20 15:07:43'),
(53, 'how_it_work.element', '{\"title\":\"Edit, Polish, and Publish\",\"content\":\"Just copy and paste the work into your CMS for publishing\",\"icon\":\"<i class=\\\"fas fa-edit\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-08-20 15:08:07', '2023-08-20 15:08:07'),
(54, 'content_writer.content', '{\"heading\":\"Elegant Content Writer \\ud83d\\udcd1 Templates\",\"subheading\":\"Produce your expected substance with over 60+ substance creation formats.\"}', NULL, 'basic', NULL, '2023-08-20 15:18:42', '2023-11-22 16:40:06'),
(55, 'ai_code.content', '{\"has_image\":\"1\",\"heading\":\"High Power intelligent \\ud83d\\udcbb Coding Assistant\",\"description\":\"Experience the pinnacle of innovation with our high-powered, intelligent coding tools. Engineered to elevate your coding experience, our suite of advanced tools harnesses cutting-edge technology, streamlining workflows with unparalleled efficiency. \\r\\n<br \\/>\\r\\n<br \\/>\\r\\nEmpower your projects with precision and intelligence, optimizing development processes and unlocking new potentials.\\r\\n<br \\/>\\r\\nThese tools seamlessly adapt to your needs, offering intuitive interfaces and robust functionalities. Transform the way you code, delve into a world where high-powered intelligence meets coding excellence, revolutionizing the future of development\",\"image\":\"656877a498d1a1701345188.png\"}', NULL, 'basic', '', '2023-08-20 15:23:24', '2024-07-04 02:57:15'),
(56, 'speech_text.content', '{\"has_image\":\"1\",\"heading\":\"High Power Speech \\ud83d\\udd6c to Text\",\"description\":\"Revolutionize your workflow with our high-powered speech-to-text solution. Our innovative technology combines high-performance capabilities with precision accuracy, effortlessly transcribing spoken words into text. Experience unparalleled efficiency as our tools adapt to diverse accents and languages, ensuring seamless transcription. Empowering various industries, from healthcare to education, our solution simplifies tasks, enabling hands-free operation and rapid documentation.\\r\\n \\r\\nRevolutionize your workflow with our high-powered speech-to-text solution. Empowering various industries, from healthcare to education, our solution simplifies tasks, enabling hands-free operation and rapid documentation. Embrace the future of communication and productivity with our cutting-edge speech-to-text technology, where high power meets exceptional accuracy, transforming spoken words into written brilliance.\",\"image\":\"656877fb936671701345275.png\"}', NULL, 'basic', '', '2023-08-20 15:27:08', '2024-07-04 02:57:39'),
(57, 'chatbot.content', '{\"has_image\":\"1\",\"heading\":\"Virtual \\ud83d\\udcac Chatbot\",\"description\":\"Step into the future of engagement with our virtual \\ud83d\\udcac chatbot. Seamlessly blending advanced AI with intuitive interfaces, our chatbot redefines interaction. <br \\/><br \\/> It\'s your 24\\/7 assistant, adept at handling inquiries, guiding users, and personalizing experiences. From customer support to enhancing user journeys, our chatbot streamlines processes, learns from interactions, and adapts dynamically. Explore the realm of effortless communication and unparalleled convenience, where our virtual chatbot shapes the future of interaction.\",\"image\":\"656877ce334a71701345230.png\"}', NULL, 'basic', NULL, '2023-08-20 15:33:47', '2023-11-30 16:53:50'),
(58, 'image_generator.content', '{\"has_image\":\"1\",\"heading\":\"High Power Image \\ud83e\\udd39\\u200d\\u2640\\ufe0f Generator\",\"description\":\"Experience unparalleled creativity with our high-powered image \\ud83e\\udd39\\u200d\\u2640\\ufe0f generator. Harnessing cutting-edge technology, our platform empowers users to effortlessly craft captivating visuals. From dynamic designs to stunning graphics, unleash your imagination with precision and ease. \\r\\n<br \\/><br \\/>Our tool adapts to diverse needs, offering a versatile array of templates and customization options. Elevate your projects with efficiency and innovation, where the fusion of high-powered tools and creative freedom shapes the future of visual content creation\",\"image\":\"6568775ab08381701345114.png\"}', NULL, 'basic', '', '2023-08-20 15:38:12', '2024-07-04 03:00:25'),
(59, 'affiliate.content', '{\"has_image\":\"1\",\"heading\":\"Dynamic Affiliate \\ud83c\\udf10 Network\",\"description\":\"Step into our dynamic affiliate \\ud83c\\udf10 network\\u2014a thriving ecosystem built on collaboration and boundless opportunities. Here, affiliates flourish through robust connections and a platform designed for growth. We empower partners with tools to maximize earnings and broaden global reach. Seamlessly interact, forge invaluable connections, and amplify revenue streams within a vibrant community. <br \\/><br \\/>Innovation intertwines with opportunity, fueling success and fostering mutual prosperity. Join us in this dynamic network where synergy propels growth, and each affiliate finds a supportive environment to thrive, prosper, and redefine success in the ever-evolving landscape of affiliate marketing.\",\"image\":\"64e4c8dc39b0a1692715228.png\"}', NULL, 'basic', '', '2023-08-20 15:41:01', '2024-07-04 03:01:35'),
(60, 'feature.element', '{\"title\":\"Advanced Dashboard\",\"description\":\"Admittance to important client knowledge and movement.\",\"icon\":\"<i class=\\\"las la-th-large\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-08-20 15:44:26', '2023-08-20 15:44:26'),
(61, 'feature.element', '{\"title\":\"Payment Gateways\",\"description\":\"Safely process Visa, check card, or different strategies.\",\"icon\":\"<i class=\\\"lab la-cc-paypal\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-08-20 15:44:44', '2023-08-20 15:44:44'),
(62, 'feature.element', '{\"title\":\"Multi-Lingual Option\",\"icon\":\"<i class=\\\"fas fa-globe\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-08-20 15:45:01', '2023-11-21 10:34:26'),
(63, 'feature.element', '{\"title\":\"Custom Templates\",\"description\":\"Add limitless number of custom prompts for your clients.\",\"icon\":\"<i class=\\\"fas fa-bars\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-08-20 15:45:23', '2023-08-20 15:45:23'),
(64, 'feature.element', '{\"title\":\"Supportive Platform\",\"icon\":\"<i class=\\\"fas fa-headset\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-08-20 15:45:44', '2023-11-21 10:34:43'),
(65, 'pricing.content', '{\"heading\":\"Get Your Plan at a Reasonable \\ud83d\\udcb8 Price\",\"subheading\":\"Produce your expected substance with over 60+ substance creation formats.\"}', NULL, 'basic', '', '2023-08-20 15:50:54', '2024-07-04 03:02:22'),
(66, 'faq.content', '{\"heading\":\"Frequently Ask \\u2753 Questions\",\"subheading\":\"Go ahead and contact us. We are generally glad to help you and give you any extra.\"}', NULL, 'basic', NULL, '2023-08-20 15:53:02', '2023-11-22 16:42:09'),
(67, 'faq.element', '{\"question\":\"How does the software assist in enhancing content quality?\",\"answer\":\"Our software utilizes advanced algorithms to suggest improvements in grammar, style, and readability, ensuring high-quality content.\"}', NULL, 'basic', NULL, '2023-08-20 15:53:22', '2023-11-23 12:01:06'),
(68, 'faq.element', '{\"question\":\"Does the software provide templates for various content types?\",\"answer\":\"Absolutely, we offer a wide array of templates catering to articles, blogs, social media posts, and more, streamlining the writing process.\"}', NULL, 'basic', NULL, '2023-08-20 15:53:31', '2023-11-23 12:01:34'),
(69, 'faq.element', '{\"question\":\"What Is SEO Wirting And How Do I Use It?\",\"answer\":\"Once you know your audience, choose a topic that will resonate with them. Look for trending topics in your industry or address common questions or challenges your audience may be facing.\"}', NULL, 'basic', NULL, '2023-08-20 15:53:45', '2023-11-23 11:59:36'),
(70, 'faq.element', '{\"question\":\"Does Openup To Write Long Articles?\",\"answer\":\"Once you know your audience, choose a topic that will resonate with them. Look for trending topics in your industry or address common questions or challenges your audience may be facing.\"}', NULL, 'basic', NULL, '2023-08-20 15:53:55', '2023-08-20 15:53:55'),
(71, 'testimonial.content', '{\"heading\":\"Our Client \\ud83d\\udc4d Reviews\",\"subheading\":\"We are generally glad to help you and give you any extra.\"}', NULL, 'basic', NULL, '2023-08-21 07:53:18', '2023-11-22 16:43:01'),
(72, 'testimonial.element', '{\"has_image\":\"1\",\"author\":\"John Doe\",\"designation\":\"CEO & Founder\",\"quote\":\"Suspendisse potenti. Aenean massa. Etiam ut purus mattis mauris sodales aliquam. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros.\",\"image\":\"64e9dc15159051693047829.png\"}', NULL, 'basic', NULL, '2023-08-21 07:58:50', '2023-08-26 15:03:49'),
(73, 'testimonial.element', '{\"has_image\":\"1\",\"author\":\"Daymon Targariyen\",\"designation\":\"CTO & Co-Founder\",\"quote\":\"Suspendisse potenti. Aenean massa. Etiam ut purus mattis mauris sodales aliquam. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros.\",\"image\":\"64e9dc1b4f10e1693047835.png\"}', NULL, 'basic', NULL, '2023-08-21 07:59:31', '2023-11-30 17:11:10'),
(74, 'testimonial.element', '{\"has_image\":\"1\",\"author\":\"Alicent Hightower\",\"designation\":\"Software Engineer\",\"quote\":\"Suspendisse potenti. Aenean massa. Etiam ut purus mattis mauris sodales aliquam. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros.\",\"image\":\"64e9dc21706b11693047841.png\"}', NULL, 'basic', NULL, '2023-08-21 07:59:45', '2023-11-30 17:11:21'),
(75, 'testimonial.element', '{\"has_image\":\"1\",\"author\":\"Alisa Smith\",\"designation\":\"Article Writter\",\"quote\":\"Suspendisse potenti. Aenean massa. Etiam ut purus mattis mauris sodales aliquam. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros.\",\"image\":\"64e9dc272841d1693047847.png\"}', NULL, 'basic', NULL, '2023-08-21 07:59:56', '2023-11-30 17:11:35'),
(76, 'article.element', '{\"has_image\":[\"1\"],\"title\":\"Suspendisse non nisl sit amet\",\"description\":\"<span>Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<\\/span><br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div><div><br \\/><\\/div><blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#2c2c4d;font-size:18px;border-left:4px solid #e40a73;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote><h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5><div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div><div><br \\/><\\/div><h5>Planning before starting<\\/h5><div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<\\/div><\\/div>\",\"image\":\"655c9b306fcab1700567856.jpg\"}', NULL, 'basic', 'suspendisse-non-nisl-sit-amet', '2023-08-21 08:21:30', '2024-07-04 02:36:39'),
(77, 'article.element', '{\"has_image\":[\"1\"],\"title\":\"Assist your code Generator\",\"description\":\"<span>Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<\\/span><br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div><div><br \\/><\\/div><blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#2c2c4d;font-size:18px;border-left:4px solid #e40a73;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote><h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5><div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div><div><br \\/><\\/div><h5>Planning before starting<\\/h5><div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<\\/div><\\/div>\",\"image\":\"65688284076db1701347972.png\"}', NULL, 'basic', 'assist-your-code-generator', '2023-08-21 08:21:59', '2024-07-04 02:37:48'),
(78, 'article.element', '{\"has_image\":[\"1\"],\"title\":\"Generate text by speech\",\"description\":\"<span>Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<\\/span><br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div><div><br \\/><\\/div><blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#2c2c4d;font-size:18px;border-left:4px solid #e40a73;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote><h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5><div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div><div><br \\/><\\/div><h5>Planning before starting<\\/h5><div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<\\/div><\\/div>\",\"image\":\"655c9cb0b23581700568240.jpg\"}', NULL, 'basic', 'generate-text-by-speech', '2023-08-21 08:22:30', '2024-07-04 02:36:55'),
(79, 'footer.content', '{\"short_description\":\"Crafting compelling stories and delivering captivating content creations. Let\'s collaborate and create magic with us. Explore our services and begin your journey toward impactful storytelling and content excellence.\"}', NULL, 'basic', '', '2023-08-21 08:39:20', '2024-08-07 03:45:15'),
(85, 'contact_us.element', '{\"title\":\"Address\",\"value\":\"717 Old Edinburgh Road, Belmontze A7M Austin\",\"icon\":\"<i class=\\\"fas fa-map-marker-alt\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-08-21 10:22:02', '2023-08-21 10:22:02'),
(86, 'contact_us.element', '{\"title\":\"Phone\",\"value\":\"+0123456789\",\"icon\":\"<i class=\\\"fas fa-phone\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-08-21 10:22:22', '2023-08-21 10:22:22'),
(87, 'contact_us.element', '{\"title\":\"Email\",\"value\":\"support@assista.com\",\"icon\":\"<i class=\\\"fas fa-envelope\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-08-21 10:22:43', '2023-11-30 17:22:07'),
(88, 'register.content', '{\"has_image\":\"1\",\"heading\":\"Create Your Account\",\"subheading\":\"Welcome! \\ud83c\\udf89 Please enter your sign up credentials and attach with us.\",\"image\":\"64e32e48e1f501692610120.png\"}', NULL, 'basic', NULL, '2023-08-21 10:58:40', '2023-11-21 18:47:33'),
(89, 'login.content', '{\"has_image\":\"1\",\"heading\":\"Create Your Account\",\"subheading\":\"Welcome! \\ud83d\\udc4b Please enter your details.\",\"image\":\"655cae570443f1700572759.png\"}', NULL, 'basic', NULL, '2023-08-21 11:21:52', '2023-11-21 18:47:51'),
(90, 'partner.content', '{\"heading\":\"Our valuable Collaborators\",\"subheading\":\"Produce your expected substance with over 60+ substance creation formats.\"}', NULL, 'basic', NULL, '2023-08-21 12:03:00', '2023-11-22 16:45:36'),
(92, 'partner.element', '{\"has_image\":\"1\",\"image\":\"64e33d6ee91c01692613998.png\"}', NULL, 'basic', NULL, '2023-08-21 12:03:18', '2023-08-21 12:03:18'),
(93, 'partner.element', '{\"has_image\":\"1\",\"image\":\"64e33d750f68e1692614005.png\"}', NULL, 'basic', NULL, '2023-08-21 12:03:25', '2023-08-21 12:03:25'),
(94, 'partner.element', '{\"has_image\":\"1\",\"image\":\"64e33d7b2e7231692614011.png\"}', NULL, 'basic', NULL, '2023-08-21 12:03:31', '2023-08-21 12:03:31'),
(95, 'partner.element', '{\"has_image\":\"1\",\"image\":\"64e33d9f1e58a1692614047.png\"}', NULL, 'basic', NULL, '2023-08-21 12:04:07', '2023-08-21 12:04:07'),
(96, 'partner.element', '{\"has_image\":\"1\",\"image\":\"64e33da4a32751692614052.png\"}', NULL, 'basic', NULL, '2023-08-21 12:04:12', '2023-08-21 12:04:12'),
(97, 'partner.element', '{\"has_image\":\"1\",\"image\":\"64e33da9d180e1692614057.png\"}', NULL, 'basic', NULL, '2023-08-21 12:04:17', '2023-08-21 12:04:17'),
(98, 'partner.element', '{\"has_image\":\"1\",\"image\":\"64e33daf5ddb51692614063.png\"}', NULL, 'basic', NULL, '2023-08-21 12:04:23', '2023-08-21 12:04:23'),
(99, 'kyc_content.content', '{\"kyc_verification\":\"Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Sed libero. Maecenas nec odio et ante tincidunt tempus. Vestibulum facilisis, purus nec pulvinar iaculis, ligula mi congue nunc, vitae euismod ligula urna in dolor.\",\"kyc_pending\":\"Fusce neque. Phasellus gravida semper nisi. Vivamus laoreet. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Suspendisse nisl elit, rhoncus eget, elementum ac, condimentum eget, diam.\"}', NULL, 'basic', NULL, '2023-08-23 14:09:01', '2023-08-23 14:09:01'),
(100, 'banned.content', '{\"has_image\":\"1\",\"heading\":\"You Are Banned\",\"image\":\"64e9e23b383671693049403.png\"}', NULL, 'basic', NULL, '2023-08-26 15:30:03', '2023-08-26 15:30:03'),
(101, 'welcome_message.element', '{\"title\":\"I am your Assista\"}', NULL, 'basic', NULL, '2023-08-27 22:54:40', '2023-11-23 16:08:40'),
(102, 'welcome_message.element', '{\"title\":\"I am your AI Assistant\"}', NULL, 'basic', NULL, '2023-08-27 22:54:47', '2023-08-27 22:54:47'),
(103, 'article.element', '{\"has_image\":[\"1\"],\"title\":\"Empowerment of intelligence\",\"description\":\"<span>Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<\\/span><br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div><div><br \\/><\\/div><blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#2c2c4d;font-size:18px;border-left:4px solid #e40a73;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote><h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5><div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div><div><br \\/><\\/div><h5>Planning before starting<\\/h5><div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<\\/div><\\/div>\",\"image\":\"655c9a1430e8e1700567572.jpg\"}', NULL, 'basic', 'empowerment-of-intelligence', '2023-08-27 16:41:36', '2024-07-04 02:37:05'),
(104, 'article.element', '{\"has_image\":[\"1\"],\"title\":\"A powerful language model for the future\",\"description\":\"<span>Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<\\/span><br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div><div><br \\/><\\/div><blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#2c2c4d;font-size:18px;border-left:4px solid #e40a73;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote><h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5><div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div><div><br \\/><\\/div><h5>Planning before starting<\\/h5><div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<\\/div><\\/div>\",\"image\":\"65687eecef40d1701347052.png\"}', NULL, 'basic', 'a-powerful-language-model-for-the-future', '2023-08-27 16:42:04', '2024-07-04 02:37:15');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `seo_content`, `tempname`, `slug`, `created_at`, `updated_at`) VALUES
(105, 'article.element', '{\"has_image\":[\"1\"],\"title\":\"The future of AI and its impact on society\",\"description\":\"<span>Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<\\/span><br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div><div><br \\/><\\/div><blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#2c2c4d;font-size:18px;border-left:4px solid #e40a73;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote><h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5><div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div><div><br \\/><\\/div><h5>Planning before starting<\\/h5><div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<\\/div><\\/div>\",\"image\":\"65687eccce30a1701347020.png\"}', NULL, 'basic', 'the-future-of-ai-and-its-impact-on-society', '2023-08-27 16:42:30', '2024-07-04 02:37:23'),
(106, 'article.element', '{\"has_image\":[\"1\"],\"title\":\"The Revolutionary Conversational AI\",\"description\":\"<span>Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<\\/span><br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div><div><br \\/><\\/div><blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#2c2c4d;font-size:18px;border-left:4px solid #e40a73;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote><h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5><div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div><div><br \\/><\\/div><h5>Planning before starting<\\/h5><div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><br \\/><h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5><div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<\\/div><\\/div>\",\"image\":\"655c99697a6c11700567401.jpg\"}', NULL, 'basic', 'the-revolutionary-conversational-ai', '2023-08-27 16:42:47', '2024-07-04 02:37:31'),
(107, 'social_icon.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"fab fa-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/www.twitter.com\\/\"}', NULL, 'basic', NULL, '2023-09-10 13:42:59', '2023-09-10 13:42:59'),
(108, 'social_icon.element', '{\"title\":\"Linkedin\",\"social_icon\":\"<i class=\\\"fab fa-linkedin-in\\\"><\\/i>\",\"url\":\"https:\\/\\/www.linkedin.com\\/\"}', NULL, 'basic', NULL, '2023-09-10 13:43:13', '2023-09-10 13:43:13'),
(109, 'social_icon.element', '{\"title\":\"Instagram\",\"social_icon\":\"<i class=\\\"fab fa-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', NULL, 'basic', NULL, '2023-09-10 13:43:27', '2023-09-10 13:43:27'),
(110, 'how_it_work.element', '{\"title\":\"Content Transform\",\"content\":\"Content transformation is the process of making existing content more versatile and reusable\",\"icon\":\"<i class=\\\"fab fa-amilia\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-11-19 19:33:14', '2023-11-19 19:33:14'),
(111, 'how_it_work.element', '{\"title\":\"Archive Your Data\",\"content\":\"Archived data is stored on a lower-cost tier of storage, reducing primary storage consumption\",\"icon\":\"<i class=\\\"fas fa-archive\\\"><\\/i>\"}', NULL, 'basic', NULL, '2023-11-19 19:34:23', '2023-11-19 19:34:23'),
(112, 'subscribe.content', '{\"heading\":\"Subscribe to newsletters and get news.\",\"subheading\":\"Sign up for updates and stay informed about the latest developments and be a part of our community and get the latest news and insights.\"}', NULL, 'basic', NULL, '2023-11-21 10:37:10', '2023-11-21 10:37:10'),
(113, 'text_transform.content', '{\"has_image\":\"1\",\"heading\":\"Make your text Transform & \\ud83d\\udcda Elegant\",\"description\":\"Make Your Text Transform\\\" embodies our commitment to empowering your words. We offer a transformative platform, a creative haven where your text evolves into a compelling force. With innovative tools and expert guidance, refine your narrative\'s impact. Seamlessly sculpt and enrich your content, captivating audiences with every word. Our mission is to elevate your message, ensuring it resonates authentically and powerfully. Unleash your creativity with precision, crafting text that leaves an indelible mark. Join us in the journey to unlock the potential of your words, making them not just speak, but truly transform.\",\"image\":\"656878dac6f701701345498.png\"}', NULL, 'basic', '', '2023-11-21 18:29:20', '2024-07-04 02:56:10'),
(114, 'policy_pages.element', '{\"title\":\"Content Policy\",\"details\":\"<div>\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      What information do we collect?\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      We gather data from you when you register on our site, submit a request,\\r\\n      buy any services, react to an overview, or round out a structure. At the\\r\\n      point when requesting any assistance or enrolling on our site, as\\r\\n      suitable, you might be approached to enter your: name, email address, or\\r\\n      telephone number. You may, nonetheless, visit our site anonymously.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      How do we protect your information?\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      All provided delicate\\/credit data is sent through Stripe.<br \\/>After an\\r\\n      exchange, your private data (credit cards, social security numbers,\\r\\n      financials, and so on) won\'t be put away on our workers.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      Do we disclose any information to outside parties?\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      We don\'t sell, exchange, or in any case move to outside gatherings by and\\r\\n      by recognizable data. This does exclude confided in outsiders who help us\\r\\n      in working our site, leading our business, or adjusting you, since those\\r\\n      gatherings consent to keep this data private. We may likewise deliver your\\r\\n      data when we accept discharge is suitable to follow the law, implement our\\r\\n      site strategies, or ensure our own or others\' rights, property, or\\r\\n      wellbeing.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      Children\'s Online Privacy Protection Act Compliance\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      We are consistent with the prerequisites of COPPA (Children\'s Online\\r\\n      Privacy Protection Act), we don\'t gather any data from anybody under 13\\r\\n      years old. Our site, items, and administrations are completely coordinated\\r\\n      to individuals who are in any event 13 years of age or more established.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      Changes to our Privacy Policy\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      If we decide to change our privacy policy, we will post those changes on\\r\\n      this page.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      How long we retain your information?\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      At the point when you register for our site, we cycle and keep your\\r\\n      information we have about you however long you don\'t erase the record or\\r\\n      withdraw yourself (subject to laws and guidelines).\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      What we don\\u2019t do with your data\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      We don\'t and will never share, unveil, sell, or in any case give your\\r\\n      information to different organizations for the promoting of their items or\\r\\n      administrations.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<\\/div>\"}', NULL, 'basic', 'content-policy', '2023-11-22 11:56:43', '2023-11-30 09:31:55'),
(115, 'policy_pages.element', '{\"title\":\"Pricing Policy\",\"details\":\"<div>\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      What information do we collect?\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      We gather data from you when you register on our site, submit a request,\\r\\n      buy any services, react to an overview, or round out a structure. At the\\r\\n      point when requesting any assistance or enrolling on our site, as\\r\\n      suitable, you might be approached to enter your: name, email address, or\\r\\n      telephone number. You may, nonetheless, visit our site anonymously.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      How do we protect your information?\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      All provided delicate\\/credit data is sent through Stripe.<br \\/>After an\\r\\n      exchange, your private data (credit cards, social security numbers,\\r\\n      financials, and so on) won\'t be put away on our workers.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      Do we disclose any information to outside parties?\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      We don\'t sell, exchange, or in any case move to outside gatherings by and\\r\\n      by recognizable data. This does exclude confided in outsiders who help us\\r\\n      in working our site, leading our business, or adjusting you, since those\\r\\n      gatherings consent to keep this data private. We may likewise deliver your\\r\\n      data when we accept discharge is suitable to follow the law, implement our\\r\\n      site strategies, or ensure our own or others\' rights, property, or\\r\\n      wellbeing.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      Children\'s Online Privacy Protection Act Compliance\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      We are consistent with the prerequisites of COPPA (Children\'s Online\\r\\n      Privacy Protection Act), we don\'t gather any data from anybody under 13\\r\\n      years old. Our site, items, and administrations are completely coordinated\\r\\n      to individuals who are in any event 13 years of age or more established.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      Changes to our Privacy Policy\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      If we decide to change our privacy policy, we will post those changes on\\r\\n      this page.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      How long we retain your information?\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      At the point when you register for our site, we cycle and keep your\\r\\n      information we have about you however long you don\'t erase the record or\\r\\n      withdraw yourself (subject to laws and guidelines).\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n  <div>\\r\\n    <h4 class=\\\"banner-content__title mb-2\\\">\\r\\n      What we don\\u2019t do with your data\\r\\n    <\\/h4>\\r\\n    <div class=\\\"policy-heading__desc\\\">\\r\\n      We don\'t and will never share, unveil, sell, or in any case give your\\r\\n      information to different organizations for the promoting of their items or\\r\\n      administrations.\\r\\n    <\\/div>\\r\\n  <\\/div>\\r\\n<\\/div>\"}', NULL, 'basic', 'pricing-policy', '2023-11-22 11:57:41', '2023-11-30 09:32:09'),
(117, 'banner.element', '{\"tag\":\"Article\"}', NULL, 'basic', NULL, '2023-08-20 15:02:54', '2023-11-23 10:56:04'),
(118, 'faq.element', '{\"question\":\"Is there a trial period available to test the software\'s features?\",\"answer\":\"Certainly, we offer a free trial period allowing users to explore all functionalities before committing to a subscription.\"}', NULL, 'basic', NULL, '2023-11-23 12:01:58', '2023-11-23 12:01:58'),
(119, 'faq.element', '{\"question\":\"How secure is the data stored and shared within the software?\",\"answer\":\"Data security is paramount. We employ robust encryption methods and follow stringent protocols to ensure the confidentiality and integrity of user data.\"}', NULL, 'basic', NULL, '2023-11-23 12:02:14', '2023-11-23 12:02:14'),
(120, 'welcome_message.element', '{\"title\":\"I am your Content Genie\"}', NULL, 'basic', NULL, '2023-11-23 16:08:25', '2023-11-23 16:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint UNSIGNED NOT NULL,
  `form_id` int UNSIGNED NOT NULL DEFAULT '0',
  `code` int DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `supported_currencies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `crypto` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `form_id`, `code`, `name`, `alias`, `image`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 101, 'Paypal', 'Paypal', '663a38d7b455d1715091671.png', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"sb-owud61543012@business.example.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:21:11'),
(2, 0, 102, 'Perfect Money', 'PerfectMoney', '663a3920e30a31715091744.png', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"hR26aw02Q1eEeUPSIfuwNypXX\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:22:24'),
(3, 0, 103, 'Stripe Hosted', 'Stripe', '663a39861cb9d1715091846.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:24:06'),
(4, 0, 104, 'Skrill', 'Skrill', '663a39494c4a91715091785.png', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"---\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:23:05'),
(5, 0, 105, 'PayTM', 'Paytm', '663a390f601191715091727.png', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:22:07'),
(6, 0, 106, 'Payeer', 'Payeer', '663a38c9e2e931715091657.png', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"866989763\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"7575\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.Payeer\"}}', NULL, '2019-09-14 07:14:22', '2024-05-07 02:20:57'),
(7, 0, 107, 'PayStack', 'Paystack', '663a38fc814e91715091708.png', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_cd330608eb47970889bca397ced55c1dd5ad3783\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_8a0b1f199362d7acc9c390bff72c4e81f74e2ac3\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, '2019-09-14 07:14:22', '2024-05-07 02:21:48'),
(9, 0, 109, 'Flutterwave', 'Flutterwave', '663a36c2c34d61715091138.png', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------------------\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:12:18'),
(10, 0, 110, 'RazorPay', 'Razorpay', '663a393a527831715091770.png', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:22:50'),
(11, 0, 111, 'Stripe Storefront', 'StripeJs', '663a3995417171715091861.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:24:21'),
(12, 0, 112, 'Instamojo', 'Instamojo', '663a384d54a111715091533.png', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:18:53'),
(13, 0, 501, 'Blockchain', 'Blockchain', '663a35efd0c311715090927.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"55529946-05ca-48ff-8710-f279d86b1cc5\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:08:47'),
(15, 0, 503, 'CoinPayments', 'Coinpayments', '663a36a8d8e1d1715091112.png', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"---------------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"---------------------\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"USDT.BEP20\":\"Tether USD (BSC Chain)\",\"USDT.ERC20\":\"Tether USD (ERC20)\",\"USDT.TRC20\":\"Tether USD (Tron/TRC20)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:11:52'),
(16, 0, 504, 'CoinPayments Fiat', 'CoinpaymentsFiat', '663a36b7b841a1715091127.png', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"6515561\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:12:07'),
(17, 0, 505, 'Coingate', 'Coingate', '663a368e753381715091086.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"6354mwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:11:26'),
(18, 0, 506, 'Coinbase Commerce', 'CoinbaseCommerce', '663a367e46ae51715091070.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"c47cd7df-d8e8-424b-a20a\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"55871878-2c32-4f64-ab66\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, '2019-09-14 07:14:22', '2024-05-07 02:11:10'),
(24, 0, 113, 'Paypal Express', 'PaypalSdk', '663a38ed101a61715091693.png', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:21:33'),
(25, 0, 114, 'Stripe Checkout', 'StripeV3', '663a39afb519f1715091887.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"whsec_lUmit1gtxwKTveLnSe88xCSDdnPOt8g5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, '2019-09-14 07:14:22', '2024-05-07 02:24:47'),
(27, 0, 115, 'Mollie', 'Mollie', '663a387ec69371715091582.png', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"vi@gmail.com\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:19:42'),
(30, 0, 116, 'Cashmaal', 'Cashmaal', '663a361b16bd11715090971.png', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"3748\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"546254628759524554647987\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.Cashmaal\"}}', NULL, NULL, '2024-05-07 02:09:31'),
(36, 0, 119, 'Mercado Pago', 'MercadoPago', '663a386c714a91715091564.png', 1, '{\"access_token\":{\"title\":\"Access Token\",\"global\":true,\"value\":\"APP_USR-7924565816849832-082312-21941521997fab717db925cf1ea2c190-1071840315\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-05-07 02:19:24'),
(37, 0, 120, 'Authorize.net', 'Authorize', '663a35b9ca5991715090873.png', 1, '{\"login_id\":{\"title\":\"Login ID\",\"global\":true,\"value\":\"59e4P9DBcZv\"},\"transaction_key\":{\"title\":\"Transaction Key\",\"global\":true,\"value\":\"47x47TJyLw2E7DbR\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-05-07 02:07:53'),
(46, 0, 121, 'NMI', 'NMI', '663a3897754cf1715091607.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"2F822Rw39fx762MaV7Yy86jXGTC7sCDy\"}}', '{\"AED\":\"AED\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"RUB\":\"RUB\",\"SEC\":\"SEC\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2024-05-07 02:20:07'),
(50, 0, 507, 'BTCPay', 'BTCPay', '663a35cd25a8d1715090893.png', 1, '{\"store_id\":{\"title\":\"Store Id\",\"global\":true,\"value\":\"HsqFVTXSeUFJu7caoYZc3CTnP8g5LErVdHhEXPVTheHf\"},\"api_key\":{\"title\":\"Api Key\",\"global\":true,\"value\":\"4436bd706f99efae69305e7c4eff4780de1335ce\"},\"server_name\":{\"title\":\"Server Name\",\"global\":true,\"value\":\"https:\\/\\/testnet.demo.btcpayserver.org\"},\"secret_code\":{\"title\":\"Secret Code\",\"global\":true,\"value\":\"SUCdqPn9CDkY7RmJHfpQVHP2Lf2\"}}', '{\"BTC\":\"Bitcoin\",\"LTC\":\"Litecoin\"}', 1, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.BTCPay\"}}', NULL, NULL, '2024-05-07 02:08:13'),
(51, 0, 508, 'Now payments hosted', 'NowPaymentsHosted', '663a38b8d57a81715091640.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"--------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------------\"}}', '{\"BTG\":\"BTG\",\"ETH\":\"ETH\",\"XMR\":\"XMR\",\"ZEC\":\"ZEC\",\"XVG\":\"XVG\",\"ADA\":\"ADA\",\"LTC\":\"LTC\",\"BCH\":\"BCH\",\"QTUM\":\"QTUM\",\"DASH\":\"DASH\",\"XLM\":\"XLM\",\"XRP\":\"XRP\",\"XEM\":\"XEM\",\"DGB\":\"DGB\",\"LSK\":\"LSK\",\"DOGE\":\"DOGE\",\"TRX\":\"TRX\",\"KMD\":\"KMD\",\"REP\":\"REP\",\"BAT\":\"BAT\",\"ARK\":\"ARK\",\"WAVES\":\"WAVES\",\"BNB\":\"BNB\",\"XZC\":\"XZC\",\"NANO\":\"NANO\",\"TUSD\":\"TUSD\",\"VET\":\"VET\",\"ZEN\":\"ZEN\",\"GRS\":\"GRS\",\"FUN\":\"FUN\",\"NEO\":\"NEO\",\"GAS\":\"GAS\",\"PAX\":\"PAX\",\"USDC\":\"USDC\",\"ONT\":\"ONT\",\"XTZ\":\"XTZ\",\"LINK\":\"LINK\",\"RVN\":\"RVN\",\"BNBMAINNET\":\"BNBMAINNET\",\"ZIL\":\"ZIL\",\"BCD\":\"BCD\",\"USDT\":\"USDT\",\"USDTERC20\":\"USDTERC20\",\"CRO\":\"CRO\",\"DAI\":\"DAI\",\"HT\":\"HT\",\"WABI\":\"WABI\",\"BUSD\":\"BUSD\",\"ALGO\":\"ALGO\",\"USDTTRC20\":\"USDTTRC20\",\"GT\":\"GT\",\"STPT\":\"STPT\",\"AVA\":\"AVA\",\"SXP\":\"SXP\",\"UNI\":\"UNI\",\"OKB\":\"OKB\",\"BTC\":\"BTC\"}', 1, '', NULL, NULL, '2024-05-07 02:20:40'),
(52, 0, 509, 'Now payments checkout', 'NowPaymentsCheckout', '663a38a59d2541715091621.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"---------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 1, '', NULL, NULL, '2024-05-07 02:20:21'),
(53, 0, 122, '2Checkout', 'TwoCheckout', '663a39b8e64b91715091896.png', 1, '{\"merchant_code\":{\"title\":\"Merchant Code\",\"global\":true,\"value\":\"253248016872\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"eQM)ID@&vG84u!O*g[p+\"}}', '{\"AFN\": \"AFN\",\"ALL\": \"ALL\",\"DZD\": \"DZD\",\"ARS\": \"ARS\",\"AUD\": \"AUD\",\"AZN\": \"AZN\",\"BSD\": \"BSD\",\"BDT\": \"BDT\",\"BBD\": \"BBD\",\"BZD\": \"BZD\",\"BMD\": \"BMD\",\"BOB\": \"BOB\",\"BWP\": \"BWP\",\"BRL\": \"BRL\",\"GBP\": \"GBP\",\"BND\": \"BND\",\"BGN\": \"BGN\",\"CAD\": \"CAD\",\"CLP\": \"CLP\",\"CNY\": \"CNY\",\"COP\": \"COP\",\"CRC\": \"CRC\",\"HRK\": \"HRK\",\"CZK\": \"CZK\",\"DKK\": \"DKK\",\"DOP\": \"DOP\",\"XCD\": \"XCD\",\"EGP\": \"EGP\",\"EUR\": \"EUR\",\"FJD\": \"FJD\",\"GTQ\": \"GTQ\",\"HKD\": \"HKD\",\"HNL\": \"HNL\",\"HUF\": \"HUF\",\"INR\": \"INR\",\"IDR\": \"IDR\",\"ILS\": \"ILS\",\"JMD\": \"JMD\",\"JPY\": \"JPY\",\"KZT\": \"KZT\",\"KES\": \"KES\",\"LAK\": \"LAK\",\"MMK\": \"MMK\",\"LBP\": \"LBP\",\"LRD\": \"LRD\",\"MOP\": \"MOP\",\"MYR\": \"MYR\",\"MVR\": \"MVR\",\"MRO\": \"MRO\",\"MUR\": \"MUR\",\"MXN\": \"MXN\",\"MAD\": \"MAD\",\"NPR\": \"NPR\",\"TWD\": \"TWD\",\"NZD\": \"NZD\",\"NIO\": \"NIO\",\"NOK\": \"NOK\",\"PKR\": \"PKR\",\"PGK\": \"PGK\",\"PEN\": \"PEN\",\"PHP\": \"PHP\",\"PLN\": \"PLN\",\"QAR\": \"QAR\",\"RON\": \"RON\",\"RUB\": \"RUB\",\"WST\": \"WST\",\"SAR\": \"SAR\",\"SCR\": \"SCR\",\"SGD\": \"SGD\",\"SBD\": \"SBD\",\"ZAR\": \"ZAR\",\"KRW\": \"KRW\",\"LKR\": \"LKR\",\"SEK\": \"SEK\",\"CHF\": \"CHF\",\"SYP\": \"SYP\",\"THB\": \"THB\",\"TOP\": \"TOP\",\"TTD\": \"TTD\",\"TRY\": \"TRY\",\"UAH\": \"UAH\",\"AED\": \"AED\",\"USD\": \"USD\",\"VUV\": \"VUV\",\"VND\": \"VND\",\"XOF\": \"XOF\",\"YER\": \"YER\"}', 0, '{\"approved_url\":{\"title\": \"Approved URL\",\"value\":\"ipn.TwoCheckout\"}}', NULL, NULL, '2024-05-07 02:24:56'),
(54, 0, 123, 'Checkout', 'Checkout', '663a3628733351715090984.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------\"},\"public_key\":{\"title\":\"PUBLIC KEY\",\"global\":true,\"value\":\"------\"},\"processing_channel_id\":{\"title\":\"PROCESSING CHANNEL\",\"global\":true,\"value\":\"------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"AUD\":\"AUD\",\"CAN\":\"CAN\",\"CHF\":\"CHF\",\"SGD\":\"SGD\",\"JPY\":\"JPY\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-05-07 02:09:44'),
(56, 0, 510, 'Binance', 'Binance', '663a35db4fd621715090907.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"tsu3tjiq0oqfbtmlbevoeraxhfbp3brejnm9txhjxcp4to29ujvakvfl1ibsn3ja\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"jzngq4t04ltw8d4iqpi7admfl8tvnpehxnmi34id1zvfaenbwwvsvw7llw3zdko8\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"231129033\"}}', '{\"BTC\":\"Bitcoin\",\"USD\":\"USD\",\"BNB\":\"BNB\"}', 1, '{\"cron\":{\"title\": \"Cron Job URL\",\"value\":\"ipn.Binance\"}}', NULL, NULL, '2024-05-07 02:08:27'),
(57, 0, 124, 'SslCommerz', 'SslCommerz', '663a397a70c571715091834.png', 1, '{\"store_id\":{\"title\":\"Store ID\",\"global\":true,\"value\":\"---------\"},\"store_password\":{\"title\":\"Store Password\",\"global\":true,\"value\":\"----------\"}}', '{\"BDT\":\"BDT\",\"USD\":\"USD\",\"EUR\":\"EUR\",\"SGD\":\"SGD\",\"INR\":\"INR\",\"MYR\":\"MYR\"}', 0, NULL, NULL, NULL, '2024-05-07 02:23:54'),
(58, 0, 125, 'Aamarpay', 'Aamarpay', '663a34d5d1dfc1715090645.png', 1, '{\"store_id\":{\"title\":\"Store ID\",\"global\":true,\"value\":\"---------\"},\"signature_key\":{\"title\":\"Signature Key\",\"global\":true,\"value\":\"----------\"}}', '{\"BDT\":\"BDT\"}', 0, NULL, NULL, NULL, '2024-05-07 02:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_code` int DEFAULT NULL,
  `gateway_alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `max_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) NOT NULL DEFAULT '0.00',
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `gateway_parameter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `third_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'email configuration',
  `sms_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `firebase_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `global_shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kv` tinyint(1) NOT NULL DEFAULT '0',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'mobile verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sms notification, 0 - dont send, 1 - send',
  `pn` tinyint(1) NOT NULL DEFAULT '1',
  `force_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `in_app_payment` tinyint(1) NOT NULL DEFAULT '1',
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT '0',
  `secure_password` tinyint(1) NOT NULL DEFAULT '0',
  `agree` tinyint(1) NOT NULL DEFAULT '0',
  `multi_language` tinyint(1) NOT NULL DEFAULT '1',
  `registration` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Off	, 1: On',
  `active_template` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `socialite_credentials` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `system_customized` tinyint(1) NOT NULL DEFAULT '0',
  `paginate_number` int NOT NULL DEFAULT '0',
  `currency_format` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>Both\r\n2=>Text Only\r\n3=>Symbol Only',
  `template_model_id` int NOT NULL DEFAULT '0',
  `chat_model_id` int NOT NULL DEFAULT '0',
  `max_result_length` int NOT NULL DEFAULT '0',
  `api_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `register_bonus` decimal(5,2) NOT NULL DEFAULT '0.00',
  `subscription_bonus` decimal(5,2) NOT NULL DEFAULT '0.00',
  `register_commission` tinyint(1) NOT NULL DEFAULT '0',
  `subscription_commission` tinyint(1) NOT NULL DEFAULT '0',
  `weather` tinyint(1) NOT NULL DEFAULT '0',
  `weather_api_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `available_version` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_cron` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `cur_text`, `cur_sym`, `email_from`, `email_from_name`, `email_template`, `sms_template`, `sms_from`, `push_title`, `push_template`, `base_color`, `secondary_color`, `third_color`, `mail_config`, `sms_config`, `firebase_config`, `global_shortcodes`, `kv`, `ev`, `en`, `sv`, `sn`, `pn`, `force_ssl`, `in_app_payment`, `maintenance_mode`, `secure_password`, `agree`, `multi_language`, `registration`, `active_template`, `socialite_credentials`, `system_customized`, `paginate_number`, `currency_format`, `template_model_id`, `chat_model_id`, `max_result_length`, `api_key`, `register_bonus`, `subscription_bonus`, `register_commission`, `subscription_commission`, `weather`, `weather_api_key`, `available_version`, `last_cron`, `created_at`, `updated_at`) VALUES
(1, 'Assista', 'USD', '$', 'info@viserlab.com', NULL, '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"https://i.imgur.com/Z1qtvtV.png\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello {{fullname}} ({{username}})</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">{{message}}</td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2021 <a href=\"#\">{{site_name}}</a>&nbsp;. All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'hi {{fullname}} ({{username}}), {{message}}', 'ViserAdmin', NULL, NULL, 'e4017a', 'e7a700', 'f4fb24', '{\"name\":\"php\"}', '{\"name\":\"nexmo\",\"clickatell\":{\"api_key\":\"----------------\"},\"infobip\":{\"username\":\"------------8888888\",\"password\":\"-----------------\"},\"message_bird\":{\"api_key\":\"-------------------\"},\"nexmo\":{\"api_key\":\"----------------------\",\"api_secret\":\"----------------------\"},\"sms_broadcast\":{\"username\":\"----------------------\",\"password\":\"-----------------------------\"},\"twilio\":{\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\"},\"text_magic\":{\"username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\"],\"value\":[\"test_api 555\"]},\"body\":{\"name\":[\"from_number\"],\"value\":[\"5657545757\"]}}}', '{\"apiKey\":\"---------------\",\"authDomain\":\"------------------\",\"projectId\":\"--------------------\",\"storageBucket\":\"--------------\",\"messagingSenderId\":\"------------------\",\"appId\":\"-------------------\",\"measurementId\":\"--------------\"}', '{\n    \"site_name\":\"Name of your site\",\n    \"site_currency\":\"Currency of your site\",\n    \"currency_symbol\":\"Symbol of currency\"\n}', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 'basic', '{\"google\":{\"client_id\":\"------------------\",\"client_secret\":\"-----------------\",\"status\":0},\"facebook\":{\"client_id\":\"------------------\",\"client_secret\":\"------------------\",\"status\":0},\"linkedin\":{\"client_id\":\"------------------\",\"client_secret\":\"------------------\",\"status\":0}}', 0, 20, 1, 2, 16, 20, '---------------------------------------', 10.00, 10.00, 0, 0, 1, '------------------------', '2.0', NULL, NULL, '2024-08-07 03:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `title` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: not default language, 1: default language',
  `image` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `flag`, `code`, `is_default`, `image`, `created_at`, `updated_at`) VALUES
(1, 'English', '655c6cae50ded1700555950.png', 'en', 1, '66b330e074db51723019488.png', '2023-08-27 16:26:20', '2024-08-07 02:31:28'),
(6, 'Hindi', NULL, 'hi', 0, '66b330e9e44181723019497.png', '2024-08-07 02:31:37', '2024-08-07 02:31:37'),
(7, 'Bangla', NULL, 'bn', 0, '66b330f46481a1723019508.png', '2024-08-07 02:31:48', '2024-08-07 02:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `sender` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_to` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notification_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `push_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_status` tinyint(1) NOT NULL DEFAULT '1',
  `email_sent_from_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_sent_from_address` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_status` tinyint(1) NOT NULL DEFAULT '1',
  `sms_sent_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subject`, `push_title`, `email_body`, `sms_body`, `push_body`, `shortcodes`, `email_status`, `email_sent_from_name`, `email_sent_from_address`, `sms_status`, `sms_sent_from`, `push_status`, `created_at`, `updated_at`) VALUES
(1, 'BAL_ADD', 'Balance - Added', 'Your Account has been Credited', NULL, '<div><div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been added to your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}&nbsp;</span></font><br></div><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin note:&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 12px; font-weight: 600; white-space: nowrap; text-align: var(--bs-body-text-align);\">{{remark}}</span></div>', '{{amount}} {{site_currency}} credited in your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin note is \"{{remark}}\"', NULL, '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 06:00:00', '2022-04-02 20:18:28'),
(2, 'BAL_SUB', 'Balance - Subtracted', 'Your Account has been Debited', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been subtracted from your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}</span></font><br><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin Note: {{remark}}</div>', '{{amount}} {{site_currency}} debited from your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin Note is {{remark}}', NULL, '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2022-04-02 20:24:11'),
(3, 'DEPOSIT_COMPLETE', 'Payment- Automated - Successfull', 'Payment Completed Successfully', NULL, '<div>Your payment of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been completed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Payment:<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#000000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Received : {{method_amount}} {{method_currency}}<br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Payment successfully by {{method_name}}', NULL, '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2023-08-26 07:49:42'),
(4, 'DEPOSIT_APPROVE', 'Payment - Manual - Approved', 'Your Payment is Approved', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your payment request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>is Approved .<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your Payment:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Admin Approve Your {{amount}} {{site_currency}} payment request by {{method_name}} transaction : {{trx}}', NULL, '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2023-08-26 07:51:30'),
(5, 'DEPOSIT_REJECT', 'Payment - Manual - Rejected', 'Your Payment Request is Rejected', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your payment request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}} has been rejected</span>.<span style=\"font-weight: bolder;\"><br></span></div><div><br></div><div><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge: {{charge}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number was : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">if you have any queries, feel free to contact us.<br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><br><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">{{rejection_message}}</span><br>', 'Admin Rejected Your {{amount}} {{site_currency}} payment request by {{method_name}}\r\n\r\n{{rejection_message}}', NULL, '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"rejection_message\":\"Rejection message by the admin\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2023-08-26 07:51:49'),
(6, 'DEPOSIT_REQUEST', 'Payment - Manual - Requested', 'Payment Request Submitted Successfully', NULL, '<div>Your payment request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>submitted successfully<span style=\"font-weight: bolder;\">&nbsp;.<br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} payment requested by {{method_name}}. Charge: {{charge}} . Trx: {{trx}}', NULL, '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2023-08-26 07:52:11'),
(7, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', NULL, '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 06:00:00', '2022-03-20 14:47:05'),
(8, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have reset your password', NULL, '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not change that, please contact us as soon as possible.</font></span></p>', 'Your password has been changed successfully', NULL, '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2022-04-04 21:46:35'),
(9, 'ADMIN_SUPPORT_REPLY', 'Support - Reply', 'Reply Support Ticket', NULL, '<div><p><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\">A member from our support team has replied to the following ticket:</span></span></p><p><span style=\"font-weight: bolder;\"><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\"><br></span></span></span></p><p><span style=\"font-weight: bolder;\">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.', NULL, '{\"ticket_id\":\"ID of the support ticket\",\"ticket_subject\":\"Subject  of the support ticket\",\"reply\":\"Reply made by the admin\",\"link\":\"URL to view the support ticket\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2022-03-20 14:47:51'),
(10, 'EVER_CODE', 'Verification - Email', 'Please verify your email address', NULL, '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;{{code}}</span></font></div></div>', '---', NULL, '{\"code\":\"Email verification code\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 06:00:00', '2022-04-02 20:32:07'),
(11, 'SVER_CODE', 'Verification - SMS', 'Verify Your Mobile Number', NULL, '---', 'Your phone verification code is: {{code}}', NULL, '{\"code\":\"SMS Verification Code\"}', 0, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2022-03-20 13:24:37'),
(12, 'WITHDRAW_APPROVE', 'Withdraw - Approved', 'Withdraw Request has been Processed and your money is sent', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been Processed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You will get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">-----</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\">Details of Processed Payment :</font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\"><span style=\"font-weight: bolder;\">{{admin_details}}</span></font></div>', 'Admin Approve Your {{amount}} {{site_currency}} withdraw request by {{method_name}}. Transaction {{trx}}', NULL, '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"admin_details\":\"Details provided by the admin\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2022-03-20 14:50:16'),
(13, 'WITHDRAW_REJECT', 'Withdraw - Rejected', 'Withdraw Request has been Rejected and your money is refunded to your account', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been Rejected.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You should get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">----</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><br></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\">{{amount}} {{currency}} has been&nbsp;<span style=\"font-weight: bolder;\">refunded&nbsp;</span>to your account and your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}}</span><span style=\"font-weight: bolder;\">&nbsp;{{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">-----</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\">Details of Rejection :</font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\"><span style=\"font-weight: bolder;\">{{admin_details}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br><br><br><br><br></div><div></div><div></div>', 'Admin Rejected Your {{amount}} {{site_currency}} withdraw request. Your Main Balance {{post_balance}}  {{method_name}} , Transaction {{trx}}', NULL, '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after fter this action\",\"admin_details\":\"Rejection message by the admin\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2022-03-20 14:57:46'),
(14, 'WITHDRAW_REQUEST', 'Withdraw - Requested', 'Withdraw Request Submitted Successfully', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been submitted Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You will get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br><br><br></div>', '{{amount}} {{site_currency}} withdraw requested by {{method_name}}. You will get {{method_amount}} {{method_currency}} Trx: {{trx}}', NULL, '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after fter this transaction\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2022-03-20 22:39:03'),
(15, 'DEFAULT', 'Default Template', '{{subject}}', NULL, '{{message}}', '{{message}}', NULL, '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, NULL, NULL, 1, NULL, 0, '2019-09-14 07:14:22', '2021-11-04 03:38:55'),
(16, 'KYC_APPROVE', 'KYC Approved', 'KYC has been approved', NULL, NULL, NULL, NULL, '[]', 1, NULL, NULL, 1, NULL, 0, NULL, NULL),
(17, 'KYC_REJECT', 'KYC Rejected', 'KYC has been rejected', NULL, NULL, NULL, NULL, '{\"reason\":\"Rejection Reason\"}', 1, NULL, NULL, 1, NULL, 0, NULL, NULL),
(18, 'SUBSCRIBE_PLAN', 'Successfully Subscribed to The Plan', 'Successfully Subscribed to The Plan', NULL, 'Hi {{username}},<div><br></div><div>Welcome to our subscription plan! We\'re excited to have you on board.<br>Plan Name : {{plan}}</div><div>Price : {{price}} {{site_currency}}<br>Expired Date : {{expired_at}}</div><div><br></div><div>We hope you enjoy using our subscription plan. If you have a question, please don\'t hesitate to contact us.<br><br>Thanks</div>', 'Hi {{username}},\r\n\r\nWelcome to our subscription plan! We\'re excited to have you on board.\r\nPlan Name : {{plan}}\r\nPrice : {{price}} {{site_currency}}\r\nExpired Date : {{expired_at}}', NULL, '{\n    \"username\":\"Subscription User Username\",\n    \"plan\":\"Plan Name\",\n    \"price\":\"Plan Price\",\n    \"expired_at\":\"Plan Duration After Subscription\"\n}', 1, NULL, NULL, 1, NULL, 0, NULL, '2023-08-10 03:54:48'),
(19, 'REGISTER_COMMISSION', 'Register Commission', 'Register Commission', NULL, '<div><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">You have got a&nbsp; registered referral bonus from {{username}}</span><br></div><div>Bonus Amount : {{amount}} {{site_currency}}<br>Transaction Number : {{trx}}</div>', 'You have got a  registered referral bonus from {{username}}\r\nBonus Amount : {{amount}} {{site_currency}}\r\nTransaction Number : {{trx}}', NULL, '{\n   \"username\":\"New register username\",\n    \"amount\":\"Register bonus amount\",\n\"trx\":\"Transaction number\"\n}', 1, NULL, NULL, 1, NULL, 0, NULL, '2023-08-14 01:38:47'),
(20, 'SUBSCRIPTION_COMMISSION', 'Subscription Commission', 'Subscription Commission', NULL, '<div><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">You have got a&nbsp; subscription commission from {{username}}</span><br></div><div>Bonus Amount : {{amount}} {{site_currency}}<br>Post Balance : {{post_balance}} {{site_currency}}</div><div>Transaction Number : {{trx}}&nbsp;<br><br></div>', 'You have got a  registered referral bonus from {{referred_username}}\r\nBonus Amount : {{amount}} {{site_currency}}\r\nPost Balance : {{post_balance}} {{site_currency}}\r\nTransaction Number : {{trx}}', NULL, '{\n    \"amount\":\"Subscription Commission Amount\",\n    \"trx\":\"Transaction number\",\n    \"post_balance\" :\"User Post Balance\"\n}\n', 1, NULL, NULL, 1, NULL, 0, NULL, '2023-08-14 01:41:36');

-- --------------------------------------------------------

--
-- Table structure for table `open_a_i_models`
--

CREATE TABLE `open_a_i_models` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_chat` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `open_a_i_models`
--

INSERT INTO `open_a_i_models` (`id`, `name`, `is_chat`, `status`, `created_at`, `updated_at`) VALUES
(2, 'gpt-3.5-turbo-instruct', 0, 1, '2023-07-26 05:28:43', '2023-07-26 05:28:43'),
(3, 'davinci-002', 0, 1, '2023-07-26 05:28:43', '2023-07-26 05:28:43'),
(4, 'babbage-002', 0, 1, '2023-07-26 05:28:43', '2023-07-26 05:34:49'),
(8, 'curie-instruct-beta', 0, 1, '2023-07-26 05:28:43', '2023-07-26 05:35:05'),
(9, 'davinci-instruct-beta', 0, 1, '2023-07-26 05:28:43', '2023-07-26 05:28:43'),
(14, 'gpt-3.5-turbo-0301', 1, 1, '2023-07-26 07:46:00', '2023-07-26 07:46:00'),
(15, 'gpt-3.5-turbo-16k', 1, 1, '2023-07-26 07:46:00', '2023-07-26 07:46:00'),
(16, 'gpt-3.5-turbo', 1, 1, '2023-07-26 07:46:00', '2023-07-26 07:46:00'),
(20, 'gpt-4o', 1, 1, '2024-07-06 06:53:05', NULL),
(21, 'gpt-3.5-turbo-instruct', 1, 1, '2024-07-06 06:53:07', NULL),
(22, 'gpt-3.5-turbo-0125', 1, 1, '2024-07-06 06:53:09', NULL),
(23, 'gpt-3.5-turbo-1106', 1, 1, '2024-07-06 06:53:11', NULL),
(24, 'gpt-4-turbo', 1, 1, '2024-07-06 06:53:13', NULL),
(25, 'gpt-4-turbo-2024-04-09', 1, 1, '2024-07-06 06:53:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `seo_content`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', '/', 'templates.basic.', '[\"content_writer\",\"text_transform\",\"ai_code\",\"speech_text\",\"chatbot\",\"image_generator\",\"how_it_work\",\"affiliate\",\"feature\",\"pricing\",\"faq\",\"testimonial\",\"article\",\"partner\"]', NULL, 1, '2020-07-11 06:23:58', '2023-11-21 13:30:06'),
(4, 'Article', 'article', 'templates.basic.', '[\"feature\"]', NULL, 1, '2020-10-22 01:14:43', '2023-11-18 12:02:11'),
(5, 'Contact', 'contact', 'templates.basic.', NULL, NULL, 1, '2020-10-22 01:14:53', '2020-10-22 01:14:53'),
(19, 'About', 'about', 'templates.basic.', '[\"feature\",\"pricing\",\"affiliate\",\"faq\",\"how_it_work\"]', NULL, 0, '2023-08-23 06:11:46', '2023-08-23 06:12:15'),
(20, 'Plan', 'plan', 'templates.basic.', NULL, NULL, 1, '2023-08-23 09:14:16', '2024-07-04 03:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int UNSIGNED NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `is_discount` tinyint(1) NOT NULL DEFAULT '0',
  `discount_type` tinyint(1) NOT NULL DEFAULT '0',
  `discount_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `word_limit` bigint NOT NULL DEFAULT '0',
  `image_limit` int NOT NULL DEFAULT '0',
  `minute_limit` int NOT NULL DEFAULT '0',
  `ai_template` tinyint(1) NOT NULL DEFAULT '0',
  `ai_image` tinyint(1) NOT NULL DEFAULT '0',
  `ai_code` tinyint(1) NOT NULL DEFAULT '0',
  `ai_chat` tinyint(1) NOT NULL DEFAULT '0',
  `ai_transcript` tinyint(1) NOT NULL DEFAULT '0',
  `premium_template` tinyint(1) NOT NULL DEFAULT '0',
  `premium_chat` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_contents`
--

CREATE TABLE `seo_contents` (
  `id` bigint NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `result` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `token` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `plan_id` int NOT NULL DEFAULT '0',
  `expired_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `support_message_id` int UNSIGNED NOT NULL DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `support_ticket_id` int UNSIGNED NOT NULL DEFAULT '0',
  `admin_id` int UNSIGNED NOT NULL DEFAULT '0',
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` int NOT NULL DEFAULT '0',
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `category_id`, `icon`, `code`, `name`, `description`, `form_data`, `is_free`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '<i class=\"fas fa-headphones-alt\"></i>', 'WAWCHW', 'Clickbait Titles', 'Create a creative clickbait titles for your products', '{\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 0, 1, '2023-07-26 10:21:35', '2023-07-26 10:21:35'),
(2, 1, '<i class=\"fas fa-ad\"></i>', '4PMFFH', 'Ad Headlines', 'Write an attention grabbing ad headlines', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 0, 1, '2023-07-26 10:24:06', '2023-07-29 04:33:37'),
(3, 2, '<i class=\"fas fa-th-list\"></i>', 'T7C4BC', 'Paragraph Generator', 'Generate paragraphs about any topic including a keyword and in a specific tone of voice', '{\"paragraph_description\":{\"name\":\"Paragraph Description\",\"label\":\"paragraph_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-07-29 04:04:56', '2023-07-29 04:04:56'),
(4, 2, '<i class=\"lar la-list-alt\"></i>', 'ZVQ4RA', 'Product Description', 'Write the description about your product and why it worth it', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-07-29 04:11:57', '2023-07-31 10:27:23'),
(6, 4, '<i class=\"fab fa-product-hunt\"></i>', '1HW6VS', 'Product Name Generator', 'Create creative product names from examples words.', '{\"description\":{\"name\":\"Description\",\"label\":\"description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 06:51:14', '2023-08-26 06:51:14'),
(7, 4, '<i class=\"fab fa-product-hunt\"></i>', 'YJUT39', 'Product Features', 'short description of a product feature', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"description\":{\"name\":\"Description\",\"label\":\"description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', 1, 1, '2023-08-26 06:52:57', '2023-08-26 06:52:57'),
(8, 4, '<i class=\"fas fa-cogs\"></i>', 'JOF27W', 'SEO Expert', 'SEO expert for any product', '{\"important_keyword\":{\"name\":\"Important Keyword\",\"label\":\"important_keyword\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', 1, 1, '2023-08-26 06:56:11', '2023-08-26 06:56:11'),
(9, 2, '<i class=\"fab fa-adn\"></i>', 'CNQUZR', 'Article Generator', 'Create article for any content , improvement, publications etc', '{\"title\":{\"name\":\"Title\",\"label\":\"title\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"important_keyword\":{\"name\":\"Important keyword\",\"label\":\"important_keyword\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"}}', 1, 1, '2023-08-26 06:59:32', '2023-08-26 07:00:22'),
(10, 2, '<i class=\"fab fa-adn\"></i>', '1YAC5S', 'Article For Publications', 'Generate an article for researcher or books etc.', '{\"description\":{\"name\":\"Description\",\"label\":\"description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:01:27', '2023-08-26 07:03:27'),
(11, 4, '<i class=\"fab fa-product-hunt\"></i>', '1J3GDX', 'Product Description', 'Create any product full description.', '{\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:03:09', '2023-08-26 07:03:09'),
(12, 5, '<i class=\"far fa-envelope\"></i>', 'R9TE88', 'AI-powered Email Description', 'AI-powered email description generates your email', '{\"email_description\":{\"name\":\"Email Description\",\"label\":\"email_description\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:07:33', '2023-08-27 12:13:53'),
(13, 5, '<i class=\"far fa-envelope\"></i>', 'KYO8A1', 'AI-generated Email Subject', 'Here you get meaning full email subject.', '{\"description\":{\"name\":\"Description\",\"label\":\"description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', 1, 1, '2023-08-26 07:10:26', '2023-08-27 12:13:50'),
(14, 1, '<i class=\"fas fa-ad\"></i>', 'W79QHT', 'Google Ad Description', 'it gives you the best-performing description for any ads', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 0, 1, '2023-08-26 07:17:06', '2023-08-26 07:17:06'),
(15, 1, '<i class=\"fas fa-ad\"></i>', 'JSRMA2', 'Facebook Ads Headline', 'You can generate any ad headline in your Facebook ad.', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:22:12', '2023-08-26 07:22:12'),
(16, 1, '<i class=\"fas fa-ad\"></i>', 'ZJNTFS', 'Linkedin Ads Headline', 'You can generate any ad headline in your Linkedin ad.', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:23:05', '2023-08-26 07:23:05'),
(17, 3, '<i class=\"lab la-blogger\"></i>', 'YF6CUM', 'Generate Blog Title', 'You can generate any content of blog title with this template', '{\"content_description\":{\"name\":\"Content Description\",\"label\":\"content_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:25:33', '2023-08-26 07:25:33'),
(18, 3, '<i class=\"fab fa-blogger\"></i>', '2S7YTD', 'Features of Blog Content', 'when you need to feature any blog content then you can get this template', '{\"description\":{\"name\":\"Description\",\"label\":\"description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:28:25', '2023-08-26 07:28:25'),
(19, 3, '<i class=\"fab fa-blogger\"></i>', 'C2HG6M', 'Conclusion of Blog', 'You can get here any blog conclusion.', '{\"description\":{\"name\":\"Description\",\"label\":\"description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:29:51', '2023-08-26 07:29:51'),
(20, 3, '<i class=\"fab fa-blogger\"></i>', 'PWFJFR', 'Generate Blog Description', 'Write any content of blog description for a personal site, documents, or publications.', '{\"description\":{\"name\":\"Description\",\"label\":\"description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:31:36', '2023-08-26 07:31:36'),
(21, 4, '<i class=\"fab fa-amazon\"></i>', 'QRKEDF', 'Amazon Product Description', 'write description of any amazon product', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 0, 1, '2023-08-26 07:35:01', '2023-08-26 07:35:01'),
(22, 7, '<i class=\"fas fa-ad\"></i>', 'KP5V54', 'Ad Headline', 'Write an attention healine for any product marketing', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:41:43', '2023-08-26 07:41:43'),
(23, 7, '<i class=\"fas fa-ad\"></i>', 'X71FTM', 'SEO Keyword', 'Generate any product SEO keyword', '{\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:43:47', '2023-08-26 07:43:47'),
(24, 7, '<i class=\"far fa-building\"></i>', 'V329S7', 'Real State Sale Description', 'Generate any real state sale description', '{\"property_name\":{\"name\":\"Property Name\",\"label\":\"property_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"property_information\":{\"name\":\"Property Information\",\"label\":\"property_information\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:45:47', '2023-08-26 07:45:47'),
(25, 7, '<i class=\"fab fa-product-hunt\"></i>', 'TAKY5T', 'Product Press Release', 'Write a brand or product press release with the help of AI', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:47:33', '2023-08-26 07:47:33'),
(26, 8, '<i class=\"fab fa-facebook-f\"></i>', 'YHY8BP', 'Facebook Ads', 'Generate high-impact facebook ads with AI-Powered writing assistance', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:50:21', '2023-08-26 07:50:21'),
(27, 8, '<i class=\"fab fa-youtube\"></i>', 'KOSCE3', 'Youtube Video Description', 'Youtube content with description, generate description effortlessly and increase views', '{\"video_title\":{\"name\":\"Video Title\",\"label\":\"video_title\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', 1, 1, '2023-08-26 07:51:59', '2023-08-26 07:51:59'),
(28, 8, '<i class=\"far fa-thumbs-up\"></i>', 'TF9URK', 'Personal Social Media Post', 'Unlock your creativity and create compelling social media post', '{\"description\":{\"name\":\"Description\",\"label\":\"description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:53:32', '2023-08-26 07:53:32'),
(29, 8, '<i class=\"fas fa-edit\"></i>', 'W9OEOT', 'Content Writer', 'Take a piece of content and make it creative and unique', '{\"rewrite_description\":{\"name\":\"Rewrite Description\",\"label\":\"rewrite_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:54:52', '2023-08-26 07:54:52'),
(30, 8, '<i class=\"fab fa-instagram\"></i>', 'F1OSZU', 'Instagram Captions', 'Maximize your reach and eye catching caption', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:56:12', '2023-08-26 07:56:53'),
(31, 8, '<i class=\"fab fa-facebook-f\"></i>', '5S9F6V', 'Facebook Captions', 'Maximize your reach and eye catching caption', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 07:58:21', '2023-08-26 07:58:21'),
(32, 8, '<i class=\"fab fa-youtube\"></i>', '2W5SMC', 'Youtube Video Hash Tag', 'Write compelling video description and get unique keyword , increase views like etc', '{\"video_description\":{\"name\":\"Video Description\",\"label\":\"video_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 08:00:04', '2023-08-26 08:00:04'),
(33, 8, '<i class=\"fab fa-youtube\"></i>', '2H7PR5', 'Youtube Video Title', 'write youtube video title to catch everyone attention', '{\"video_description\":{\"name\":\"Video Description\",\"label\":\"video_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 08:01:45', '2023-08-26 08:01:45'),
(34, 8, '<i class=\"fas fa-ad\"></i>', 'QSVMNZ', 'TikTok Video Description', 'Titktok content with description, generate description effortlessly and increase views', '{\"tiktok_video_title\":{\"name\":\"Tiktok Video Title\",\"label\":\"tiktok_video_title\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', 1, 1, '2023-08-26 08:02:48', '2023-08-26 08:02:48'),
(35, 8, '<i class=\"fab fa-linkedin-in\"></i>', 'BM6HHX', 'Linkedin Post Description', 'Professional and eye catching post description that will make your boost post', '{\"post_title\":{\"name\":\"Post Title\",\"label\":\"post_title\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', 1, 1, '2023-08-26 08:04:25', '2023-08-26 08:04:25'),
(36, 8, '<i class=\"lar la-file-alt\"></i>', 'UJJ6ZG', 'Meta Description', 'Write SEO optimize meta description based on a description', '{\"website_name\":{\"name\":\"Website Name\",\"label\":\"website_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"website_description\":{\"name\":\"Website Description\",\"label\":\"website_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 08:05:37', '2023-08-26 08:05:37'),
(37, 8, '<i class=\"fas fa-list\"></i>', 'NVW6UR', 'FAQ', 'Generate freequently ask questions based on your product description', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 08:07:06', '2023-08-26 08:07:06'),
(38, 8, '<i class=\"fas fa-star\"></i>', 'PSFS6P', 'Testimonial or Reviews', 'Add your website by generate user testimonial', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 08:08:16', '2023-08-26 08:08:16'),
(39, 2, '<i class=\"lar la-list-alt\"></i>', 'SS38KG', 'Talking Points', 'Write short, simple, and informative points for the subheading of your article', '{\"title\":{\"name\":\"Title\",\"label\":\"title\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"description\":{\"name\":\"Description\",\"label\":\"description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 0, 1, '2023-08-26 08:40:35', '2023-08-26 08:40:35'),
(40, 2, '<i class=\"fas fa-list\"></i>', 'JV2F7U', 'Pros and Cons', 'Write the pros and cons of a product, service or website for your blog article', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 08:43:07', '2023-08-26 08:43:07'),
(41, 8, '<i class=\"fab fa-twitter\"></i>', 'SEOK51', 'Twitter Tweet', 'Generate an intersting twitter tweets with AI', '{\"description\":{\"name\":\"Description\",\"label\":\"description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 1, 1, '2023-08-26 08:44:17', '2023-08-26 08:44:17'),
(42, 1, '<i class=\"fas fa-ad\"></i>', 'YRDWVG', 'Google Ad Healine', 'Write an attention grabbing ad headlines', '{\"product_name\":{\"name\":\"Product Name\",\"label\":\"product_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"product_description\":{\"name\":\"Product Description\",\"label\":\"product_description\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', 0, 1, '2023-08-26 08:46:23', '2023-08-26 08:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `template_contents`
--

CREATE TABLE `template_contents` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `template_id` int DEFAULT '0',
  `language` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_request` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `result` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `words` bigint NOT NULL DEFAULT '0',
  `result_quantity` tinyint(1) NOT NULL DEFAULT '0',
  `tokens` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `post_balance` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `trx_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transcripts`
--

CREATE TABLE `transcripts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_format` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int NOT NULL DEFAULT '0',
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `update_logs`
--

CREATE TABLE `update_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_log` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `plan_id` int NOT NULL DEFAULT '0',
  `access` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `expired_date` datetime DEFAULT NULL,
  `firstname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dial_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_by` int UNSIGNED NOT NULL DEFAULT '0',
  `balance` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'contains full address',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: banned, 1: active',
  `kyc_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kyc_rejection_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kv` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: KYC Unverified, 2: KYC pending, 1: KYC verified',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: mobile unverified, 1: mobile verified',
  `profile_complete` tinyint(1) NOT NULL DEFAULT '0',
  `ver_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `ts` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_ip` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint UNSIGNED NOT NULL,
  `method_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `after_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `withdraw_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel,  ',
  `admin_feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `form_id` int UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_limit` decimal(28,8) DEFAULT '0.00000000',
  `max_limit` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `fixed_charge` decimal(28,8) DEFAULT '0.00000000',
  `rate` decimal(28,8) DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) DEFAULT NULL,
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ai_translates`
--
ALTER TABLE `ai_translates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archivers`
--
ALTER TABLE `archivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archiver_categories`
--
ALTER TABLE `archiver_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_i_images`
--
ALTER TABLE `a_i_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_bots`
--
ALTER TABLE `chat_bots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_a_i_models`
--
ALTER TABLE `open_a_i_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_contents`
--
ALTER TABLE `seo_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_contents`
--
ALTER TABLE `template_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transcripts`
--
ALTER TABLE `transcripts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `update_logs`
--
ALTER TABLE `update_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ai_translates`
--
ALTER TABLE `ai_translates`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archivers`
--
ALTER TABLE `archivers`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archiver_categories`
--
ALTER TABLE `archiver_categories`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `a_i_images`
--
ALTER TABLE `a_i_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_bots`
--
ALTER TABLE `chat_bots`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_tokens`
--
ALTER TABLE `device_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `open_a_i_models`
--
ALTER TABLE `open_a_i_models`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_contents`
--
ALTER TABLE `seo_contents`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `template_contents`
--
ALTER TABLE `template_contents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transcripts`
--
ALTER TABLE `transcripts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `update_logs`
--
ALTER TABLE `update_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
