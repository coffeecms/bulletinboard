-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 04, 2021 at 04:40 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbfree`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities_data`
--

DROP TABLE IF EXISTS `activities_data`;
CREATE TABLE `activities_data` (
  `activity_c` varchar(100) COLLATE utf8_bin NOT NULL,
  `activity_content` varchar(500) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu_data`
--

DROP TABLE IF EXISTS `admin_menu_data`;
CREATE TABLE `admin_menu_data` (
  `menu_id` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `parent_menu_id` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_url` int(1) NOT NULL DEFAULT '0',
  `page_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plugin_name` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'nav-icon fas fa-th',
  `sort_order` int(5) NOT NULL DEFAULT '0',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_menu_data`
--

INSERT INTO `admin_menu_data` (`menu_id`, `parent_menu_id`, `title`, `is_url`, `page_url`, `plugin_name`, `icon_text`, `sort_order`, `ent_dt`, `upd_dt`) VALUES
('11011011', NULL, 'Dashboard', 0, 'admin/dashboard', NULL, 'nav-icon fas fa-calendar-alt', 0, '2021-01-31 08:16:27', '2021-01-31 08:16:27'),
('11011012', NULL, 'Posts', 0, '/', NULL, 'nav-icon fas fa-file', 1, '2021-01-31 08:20:20', '2021-01-31 08:20:20'),
('11011013', NULL, 'Pages', 0, '/', NULL, 'nav-icon fas fa-file', 2, '2021-01-31 08:20:20', '2021-01-31 08:20:20'),
('11011014', NULL, 'Projects', 0, 'admin/projects', NULL, 'nav-icon fas fa-file', 15, '2021-01-31 08:20:20', '2021-01-31 08:20:20'),
('11011015', NULL, 'Themes', 0, 'admin/themes', NULL, 'nav-icon fas fa-palette', 17, '2021-01-31 08:23:51', '2021-01-31 08:23:51'),
('11011016', NULL, 'Users', 0, 'admin/users', NULL, 'nav-icon fas fa-user', 18, '2021-01-31 08:26:07', '2021-01-31 08:26:07'),
('11011017', NULL, 'Plugins', 0, 'admin/plugins', NULL, 'nav-icon fas fa-code-branch', 19, '2021-01-31 08:26:07', '2021-01-31 08:26:07'),
('11011018', NULL, 'Systems', 0, 'admin/settings', NULL, 'nav-icon fas fa-bahai', 20, '2021-01-31 13:05:49', '2021-01-31 13:05:49'),
('11015011', '11011012', 'Add new', 0, 'admin/new_post', NULL, 'nav-icon fas fa-tag', 3, '2021-01-31 08:21:17', '2021-01-31 08:21:17'),
('11015012', '11011018', 'Settings', 0, 'admin/setting_general', NULL, 'nav-icon fas fa-tag', 0, '2021-01-31 13:07:22', '2021-01-31 13:07:22'),
('11015013', '11011013', 'Add new', 0, 'admin/new_page', NULL, 'nav-icon fas fa-tag', 1, '2021-01-31 08:20:48', '2021-01-31 08:20:48'),
('11015014', '11011012', 'All Posts', 0, 'admin/posts', NULL, 'nav-icon fas fa-tag', 0, '2021-01-31 08:20:48', '2021-01-31 08:20:48'),
('11015015', '11011016', 'All Users', 0, 'admin/users', NULL, 'nav-icon fas fa-tag', 0, '2021-01-31 08:20:48', '2021-01-31 08:20:48'),
('11015016', '11011013', 'All Pages', 0, 'admin/pages', NULL, 'nav-icon fas fa-tag', 0, '2021-01-31 08:20:48', '2021-01-31 08:20:48'),
('11015017', '11011015', 'All Themes', 0, 'admin/themes', NULL, 'nav-icon fas fa-tag', 0, '2021-01-31 08:24:30', '2021-01-31 08:24:30'),
('11015018', '11011012', 'Comments', 0, 'admin/comments', NULL, 'nav-icon fas fa-tag', 5, '2021-01-31 08:22:45', '2021-01-31 08:22:45'),
('11015019', '11011016', 'Levels', 0, 'admin/level_user', NULL, 'nav-icon fas fa-tag', 8, '2021-01-31 08:20:48', '2021-01-31 08:20:48'),
('11015020', '11011015', 'Menu', 0, 'admin/edit_menu', NULL, 'nav-icon fas fa-tag', 2, '2021-01-31 08:25:35', '2021-01-31 08:25:35'),
('11015021', '11011018', 'Email Templates', 0, 'admin/email_templates', NULL, 'nav-icon fas fa-tag', 5, '2021-01-31 13:07:22', '2021-01-31 13:07:22'),
('11015022', '11011012', 'Categories', 0, 'admin/categories', NULL, 'nav-icon fas fa-tag', 4, '2021-01-31 08:22:16', '2021-01-31 08:22:16'),
('11015023', '11011017', 'All Plugins', 0, 'admin/plugins', NULL, 'nav-icon fas fa-tag', 0, '2021-01-31 08:42:42', '2021-01-31 08:42:42'),
('11015024', '11011014', 'All Projects', 0, 'admin/projects', NULL, 'nav-icon fas fa-tag', 1, '2021-01-31 08:20:48', '2021-01-31 08:20:48'),
('11015025', '11011016', 'Permissions', 0, 'admin/global_permission', NULL, 'nav-icon fas fa-tag', 5, '2021-01-31 08:20:48', '2021-01-31 08:20:48'),
('11015026', '11011016', 'Groups', 0, 'admin/group_user', NULL, 'nav-icon fas fa-tag', 4, '2021-01-31 08:20:48', '2021-01-31 08:20:48'),
('11015027', NULL, 'Email Marketings', 0, '', NULL, 'nav-icon fas fa-inbox', 30, '2021-01-31 08:26:07', '2021-01-31 08:26:07'),
('11015028', '11015027', 'Groups', 0, 'admin/email_marketing_group', NULL, 'nav-icon fas fa-tag', 4, '2021-01-31 13:07:22', '2021-01-31 13:07:22'),
('11015029', '11015027', 'Email List', 0, 'admin/email_marketing_emaillist', NULL, 'nav-icon fas fa-tag', 5, '2021-01-31 13:07:22', '2021-01-31 13:07:22'),
('11015030', '11015027', 'Send', 0, 'admin/email_marketing_send', NULL, 'nav-icon fas fa-tag', 1, '2021-01-31 13:07:22', '2021-01-31 13:07:22'),
('11015031', '11015027', 'Send Histories', 0, 'admin/email_marketing_histories', NULL, 'nav-icon fas fa-tag', 6, '2021-01-31 13:07:22', '2021-01-31 13:07:22'),
('11015032', '11015027', 'UnSubscrible List', 0, 'admin/email_marketing_unsubscrible', NULL, 'nav-icon fas fa-tag', 7, '2021-01-31 13:07:22', '2021-01-31 13:07:22'),
('11015034', '11015027', 'Dashboard', 0, 'admin/email_marketing_dashboard', NULL, 'nav-icon fas fa-tag', 0, '2021-01-31 13:07:22', '2021-01-31 13:07:22'),
('11015035', '11015027', 'Job List', 0, 'admin/email_marketing_jobs', NULL, 'nav-icon fas fa-tag', 2, '2021-01-31 13:07:22', '2021-01-31 13:07:22'),
('11015123', '11011017', 'Import', 0, 'admin/import_plugin', NULL, 'nav-icon fas fa-tag', 2, '2021-01-31 08:42:42', '2021-01-31 08:42:42'),
('11015424', '11011014', 'All Tasks', 0, 'admin/projects_task', NULL, 'nav-icon fas fa-tag', 2, '2021-01-31 08:20:48', '2021-01-31 08:20:48'),
('11016117', '11011015', 'Import', 0, 'admin/import_theme', NULL, 'nav-icon fas fa-tag', 5, '2021-01-31 08:24:30', '2021-01-31 08:24:30'),
('11017021', '11011018', 'Activities', 0, 'admin/activities_logs', NULL, 'nav-icon fas fa-tag', 6, '2021-01-31 13:07:22', '2021-01-31 13:07:22'),
('11017121', '11011018', 'Short Urls', 0, 'admin/short_urls', NULL, 'nav-icon fas fa-tag', 8, '2021-01-31 13:07:22', '2021-01-31 13:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `bb_ads_thread_data`
--

DROP TABLE IF EXISTS `bb_ads_thread_data`;
CREATE TABLE `bb_ads_thread_data` (
  `ads_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `thread_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `forum_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `method` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'forum',
  `sort_order` int(9) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bb_alert_data`
--

DROP TABLE IF EXISTS `bb_alert_data`;
CREATE TABLE `bb_alert_data` (
  `alert_id` bigint(11) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_annoucement_data`
--

DROP TABLE IF EXISTS `bb_annoucement_data`;
CREATE TABLE `bb_annoucement_data` (
  `a_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `title` varchar(500) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `forum_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `group_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_banned_browser_data`
--

DROP TABLE IF EXISTS `bb_banned_browser_data`;
CREATE TABLE `bb_banned_browser_data` (
  `browser_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_banned_ip_data`
--

DROP TABLE IF EXISTS `bb_banned_ip_data`;
CREATE TABLE `bb_banned_ip_data` (
  `ip_address` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bb_banned_os_data`
--

DROP TABLE IF EXISTS `bb_banned_os_data`;
CREATE TABLE `bb_banned_os_data` (
  `os_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_banned_user_data`
--

DROP TABLE IF EXISTS `bb_banned_user_data`;
CREATE TABLE `bb_banned_user_data` (
  `data_method` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'username',
  `username` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bb_bbcode_data`
--

DROP TABLE IF EXISTS `bb_bbcode_data`;
CREATE TABLE `bb_bbcode_data` (
  `bbcode_id` varchar(16) COLLATE utf8_bin NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `tagname` varchar(255) COLLATE utf8_bin NOT NULL,
  `replace_data` text COLLATE utf8_bin NOT NULL,
  `example_str` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `descriptions` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_bbcode_hide_pay_data`
--

DROP TABLE IF EXISTS `bb_bbcode_hide_pay_data`;
CREATE TABLE `bb_bbcode_hide_pay_data` (
  `id` bigint(11) NOT NULL,
  `data_type` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'thread',
  `post_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `item_id` varchar(155) COLLATE utf8_bin NOT NULL,
  `item_cost` double NOT NULL DEFAULT '0',
  `pay_method` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'points',
  `seller_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `buyer_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_bot_detect_data`
--

DROP TABLE IF EXISTS `bb_bot_detect_data`;
CREATE TABLE `bb_bot_detect_data` (
  `id` int(9) NOT NULL,
  `session_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bb_buy_usergroup_data`
--

DROP TABLE IF EXISTS `bb_buy_usergroup_data`;
CREATE TABLE `bb_buy_usergroup_data` (
  `order_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `target_user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `group_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_capcha_questions_data`
--

DROP TABLE IF EXISTS `bb_capcha_questions_data`;
CREATE TABLE `bb_capcha_questions_data` (
  `question_id` int(9) NOT NULL,
  `title` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bb_capcha_questions_data`
--

INSERT INTO `bb_capcha_questions_data` (`question_id`, `title`, `answer`, `status`, `user_id`, `ent_dt`, `upd_dt`) VALUES
(1, 'What is the name of ground military forces', 'Army', 1, NULL, '2021-07-12 09:44:28', '2021-07-12 09:44:28'),
(3, 'What do you call the middle of something?', 'Center', 1, NULL, '2021-07-12 09:44:54', '2021-07-12 09:44:54'),
(4, 'Whose job is it to treat people that are ill or have an injury at a hospital?', 'Doctor', 1, NULL, '2021-07-12 09:45:05', '2021-07-12 09:45:05'),
(5, 'What is the process of teaching and learning called?', 'Education', 1, NULL, '2021-07-12 09:45:16', '2021-07-12 09:45:16'),
(6, 'What kind of book is written by a person about their own life?', 'Autobiography', 1, NULL, '2021-07-12 09:45:25', '2021-07-12 09:45:25'),
(7, 'What is the red liquid that flows through a body?', 'Blood', 1, NULL, '2021-07-12 09:45:44', '2021-07-12 09:45:44'),
(8, 'What is the payment of a students education by an organization called?', 'scholarship', 1, NULL, '2021-07-12 09:45:52', '2021-07-12 09:45:52'),
(9, 'What is piece of paper with official information written on it?', 'document', 1, NULL, '2021-07-12 09:46:02', '2021-07-12 09:46:02'),
(10, 'What is the name of a building where you can borrow books?', 'library', 1, NULL, '2021-07-12 09:46:12', '2021-07-12 09:46:12'),
(11, 'Who is a person that makes bread, cakes and pastries?', 'baker', 1, NULL, '2021-07-12 09:46:22', '2021-07-12 09:46:22'),
(12, 'What organ controls your speech, feelings, body movement and thoughts?', 'brain', 1, NULL, '2021-07-12 09:46:31', '2021-07-12 09:46:31'),
(13, 'What piece of equipment shows a person what direction they are traveling?', 'compass', 1, NULL, '2021-07-12 09:46:41', '2021-07-12 09:46:41'),
(14, 'What is a series of events that happen in your mind while you are sleeping?', 'dream', 1, '11015035', '2021-07-12 09:46:50', '2021-07-12 09:46:50'),
(15, '<p>What is a that person belongs to<strong> an organization </strong>called?</p>\n', 'member', 1, '11015035', '2021-07-12 09:46:59', '2021-07-12 09:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `bb_captcha_image_session_data`
--

DROP TABLE IF EXISTS `bb_captcha_image_session_data`;
CREATE TABLE `bb_captcha_image_session_data` (
  `session_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `captcha_result` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bb_captcha_session_data`
--

DROP TABLE IF EXISTS `bb_captcha_session_data`;
CREATE TABLE `bb_captcha_session_data` (
  `id` int(9) NOT NULL,
  `session_id` varchar(68) COLLATE utf8_bin NOT NULL,
  `captcha_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `answer` varchar(255) COLLATE utf8_bin NOT NULL,
  `ref_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_category_mst`
--

DROP TABLE IF EXISTS `bb_category_mst`;
CREATE TABLE `bb_category_mst` (
  `category_c` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_category_c` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptions` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contents` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `views` int(9) NOT NULL DEFAULT '0',
  `sort_order` int(9) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bb_category_mst`
--

INSERT INTO `bb_category_mst` (`category_c`, `title`, `parent_category_c`, `friendly_url`, `thumbnail`, `keywords`, `descriptions`, `contents`, `status`, `views`, `sort_order`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('9844612265587', 'Non Title', '', 'Non-Title', '', 'Non Title', 'Non Title', NULL, 1, 0, 0, '', '2021-06-05 09:36:23', '2021-06-05 09:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `bb_disallow_word_data`
--

DROP TABLE IF EXISTS `bb_disallow_word_data`;
CREATE TABLE `bb_disallow_word_data` (
  `word` varchar(155) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bb_disallow_word_data`
--

INSERT INTO `bb_disallow_word_data` (`word`, `ent_dt`) VALUES
('fuck', '2021-08-08 15:34:01'),
('shit', '2021-08-08 15:34:01');

-- --------------------------------------------------------

--
-- Table structure for table `bb_forum_data`
--

DROP TABLE IF EXISTS `bb_forum_data`;
CREATE TABLE `bb_forum_data` (
  `forum_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `forum_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'normal',
  `external_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `parent_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `allow_create_thread` int(1) NOT NULL DEFAULT '1',
  `last_thread_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_thread_friendly_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_thread_author_username` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_thread_author_avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_thread_dt` datetime DEFAULT NULL,
  `last_post_friendly_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_post_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_post_ent_dt` datetime DEFAULT NULL,
  `last_post_author` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_post_author_avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_content` text COLLATE utf8_unicode_ci,
  `total_threads` int(9) DEFAULT '0',
  `total_posts` int(9) NOT NULL DEFAULT '0',
  `sort_order` int(9) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bb_forum_message_data`
--

DROP TABLE IF EXISTS `bb_forum_message_data`;
CREATE TABLE `bb_forum_message_data` (
  `forum_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `message_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_forum_usergroup_permission_data`
--

DROP TABLE IF EXISTS `bb_forum_usergroup_permission_data`;
CREATE TABLE `bb_forum_usergroup_permission_data` (
  `forum_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `group_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `permission_c` varchar(50) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_forum_user_permission_data`
--

DROP TABLE IF EXISTS `bb_forum_user_permission_data`;
CREATE TABLE `bb_forum_user_permission_data` (
  `forum_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `permission_c` varchar(50) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_hook_content_key_data`
--

DROP TABLE IF EXISTS `bb_hook_content_key_data`;
CREATE TABLE `bb_hook_content_key_data` (
  `key_c` varchar(255) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_html_global_data`
--

DROP TABLE IF EXISTS `bb_html_global_data`;
CREATE TABLE `bb_html_global_data` (
  `html_c` varchar(255) COLLATE utf8_bin NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `status` int(1) DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bb_html_global_data`
--

INSERT INTO `bb_html_global_data` (`html_c`, `title`, `content`, `status`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('after_1st_post', 'after_1st_post', '', 0, NULL, '2021-08-09 14:45:01', '2021-08-09 14:45:01'),
('after_1st_post_attach_files', 'after_1st_post_attach_files', '', 0, NULL, '2021-08-09 14:44:49', '2021-08-09 14:44:49'),
('after_1st_post_content', 'after_1st_post_content', '', 0, NULL, '2021-08-09 14:44:42', '2021-08-09 14:44:42'),
('after_forum_right_widgets', 'after_forum_right_widgets', '', 0, NULL, '2021-08-09 14:43:27', '2021-08-09 14:43:27'),
('after_posts_attach_files', 'after_posts_attach_files', '', 0, NULL, '2021-08-09 14:45:17', '2021-08-09 14:45:17'),
('after_posts_content', 'after_posts_content', '', 0, NULL, '2021-08-09 14:45:12', '2021-08-09 14:45:12'),
('before_1st_post_content', 'before_1st_post_content', '', 0, NULL, '2021-08-09 14:44:36', '2021-08-09 14:44:36'),
('before_forum_right_widgets', 'before_forum_right_widgets', '', 0, NULL, '2021-08-09 14:43:19', '2021-08-09 14:43:19'),
('before_list_forums', 'before_list_forums', '', 0, NULL, '2021-08-09 14:43:01', '2021-08-09 14:43:01'),
('bottom_account_page', 'bottom_account_page', '', 0, NULL, '2021-08-09 14:47:55', '2021-08-09 14:47:55'),
('bottom_forums_page', 'bottom_forums_page', '', 0, NULL, '2021-08-09 14:43:54', '2021-08-09 14:43:54'),
('bottom_login_page', 'bottom_login_page', '', 0, NULL, '2021-08-09 14:46:44', '2021-08-09 14:46:44'),
('bottom_posts_content', 'bottom_posts_content', '', 0, NULL, '2021-08-09 14:45:25', '2021-08-09 14:45:25'),
('bottom_profile_page', 'bottom_profile_page', '', 0, NULL, '2021-08-09 14:46:52', '2021-08-09 14:46:52'),
('bottom_register_page', 'bottom_register_page', '', 0, NULL, '2021-08-09 14:46:20', '2021-08-09 14:46:20'),
('bottom_search_page', 'bottom_search_page', '', 0, NULL, '2021-08-09 14:46:03', '2021-08-09 14:46:03'),
('bottom_thread_details_page', 'bottom_thread_details_page', '', 0, NULL, '2021-08-09 14:45:32', '2021-08-09 14:45:32'),
('bottom_thread_reply_page', 'bottom_thread_reply_page', '', 0, NULL, '2021-08-09 14:45:39', '2021-08-09 14:45:39'),
('top_account_page', 'top_account_page', '', 0, NULL, '2021-08-09 14:48:02', '2021-08-09 14:48:02'),
('top_forums_page', 'top_forums_page', '', 0, NULL, '2021-08-09 14:43:42', '2021-08-09 14:43:42'),
('top_home_page', 'top_home_page', '', 0, NULL, '2021-08-09 14:42:53', '2021-08-09 14:42:53'),
('top_login_page', 'top_login_page', '', 0, NULL, '2021-08-09 14:46:38', '2021-08-09 14:46:38'),
('top_profile_page', 'top_profile_page', '', 0, NULL, '2021-08-09 14:46:59', '2021-08-09 14:46:59'),
('top_register_page', 'top_register_page', '', 0, NULL, '2021-08-09 14:46:28', '2021-08-09 14:46:28'),
('top_search_page', 'top_search_page', '', 0, NULL, '2021-08-09 14:46:12', '2021-08-09 14:46:12'),
('top_thread_details_page', 'top_thread_details_page', '', 0, NULL, '2021-08-09 14:44:18', '2021-08-09 14:44:18'),
('top_thread_reply_page', 'top_thread_reply_page', '', 0, NULL, '2021-08-09 14:45:56', '2021-08-09 14:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `bb_message_ads_data`
--

DROP TABLE IF EXISTS `bb_message_ads_data`;
CREATE TABLE `bb_message_ads_data` (
  `ads_id` int(9) NOT NULL,
  `message_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `group_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_message_attach_files_data`
--

DROP TABLE IF EXISTS `bb_message_attach_files_data`;
CREATE TABLE `bb_message_attach_files_data` (
  `file_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `message_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `file_path` varchar(255) COLLATE utf8_bin NOT NULL,
  `file_name` varchar(155) COLLATE utf8_bin NOT NULL,
  `file_type` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `file_size` float NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `last_download` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int(9) NOT NULL DEFAULT '0',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_message_data`
--

DROP TABLE IF EXISTS `bb_message_data`;
CREATE TABLE `bb_message_data` (
  `message_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `parent_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `allow_reply` int(1) NOT NULL DEFAULT '1',
  `has_attach_files` int(1) DEFAULT '0',
  `username` varchar(155) COLLATE utf8_bin DEFAULT NULL,
  `is_read` int(1) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_message_user_data`
--

DROP TABLE IF EXISTS `bb_message_user_data`;
CREATE TABLE `bb_message_user_data` (
  `message_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `target_username` varchar(155) COLLATE utf8_bin DEFAULT NULL,
  `target_user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `source_user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `is_read` int(1) NOT NULL DEFAULT '0',
  `readed_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_notifies_data`
--

DROP TABLE IF EXISTS `bb_notifies_data`;
CREATE TABLE `bb_notifies_data` (
  `id` varchar(28) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `content` varchar(5000) COLLATE utf8_bin NOT NULL,
  `target_url` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `is_read` int(1) NOT NULL DEFAULT '0',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_notifies_user_data`
--

DROP TABLE IF EXISTS `bb_notifies_user_data`;
CREATE TABLE `bb_notifies_user_data` (
  `id` bigint(11) NOT NULL,
  `notify_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `source_user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `target_user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `target_username` varchar(155) COLLATE utf8_bin NOT NULL,
  `is_read` int(1) NOT NULL DEFAULT '1',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_payment_data`
--

DROP TABLE IF EXISTS `bb_payment_data`;
CREATE TABLE `bb_payment_data` (
  `id` bigint(11) NOT NULL,
  `payment_id` bigint(11) NOT NULL,
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `comment` text COLLATE utf8_unicode_ci,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bb_poll_answer_data`
--

DROP TABLE IF EXISTS `bb_poll_answer_data`;
CREATE TABLE `bb_poll_answer_data` (
  `answer_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `poll_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `content` varchar(500) COLLATE utf8_bin NOT NULL,
  `sort_order` int(9) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_poll_data`
--

DROP TABLE IF EXISTS `bb_poll_data`;
CREATE TABLE `bb_poll_data` (
  `poll_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `thread_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `question` varchar(500) COLLATE utf8_bin NOT NULL,
  `status` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `end_dt` date DEFAULT NULL,
  `poll_choice` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'unique',
  `poll_choice_max` int(5) NOT NULL DEFAULT '7',
  `allow_change_answer` int(1) NOT NULL DEFAULT '0',
  `allow_guest_access` int(1) NOT NULL DEFAULT '0',
  `set_close_poll_day` int(1) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_poll_member_answer_data`
--

DROP TABLE IF EXISTS `bb_poll_member_answer_data`;
CREATE TABLE `bb_poll_member_answer_data` (
  `id` bigint(11) NOT NULL,
  `visitor_hash` varchar(70) COLLATE utf8_bin NOT NULL,
  `poll_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `answer_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ip_address` varchar(30) COLLATE utf8_bin NOT NULL,
  `user_agent` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `is_guest` int(1) NOT NULL DEFAULT '0',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_posts_data`
--

DROP TABLE IF EXISTS `bb_posts_data`;
CREATE TABLE `bb_posts_data` (
  `post_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `thread_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `forum_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `total_reactions` int(9) NOT NULL DEFAULT '0',
  `has_attach_files` int(1) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(9) NOT NULL DEFAULT '0',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bb_post_attach_files_data`
--

DROP TABLE IF EXISTS `bb_post_attach_files_data`;
CREATE TABLE `bb_post_attach_files_data` (
  `file_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `post_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `file_path` varchar(255) COLLATE utf8_bin NOT NULL,
  `file_name` varchar(155) COLLATE utf8_bin NOT NULL,
  `file_type` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `file_size` float NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `last_download` datetime DEFAULT NULL,
  `views` int(9) NOT NULL DEFAULT '0',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_post_prefix_data`
--

DROP TABLE IF EXISTS `bb_post_prefix_data`;
CREATE TABLE `bb_post_prefix_data` (
  `prefix_id` varchar(8) COLLATE utf8_bin NOT NULL,
  `title` varchar(155) COLLATE utf8_bin NOT NULL,
  `bg_color_c` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bb_post_prefix_data`
--

INSERT INTO `bb_post_prefix_data` (`prefix_id`, `title`, `bg_color_c`, `status`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('1002821', 'Thread', '#F23412', 1, '11015035', '2021-09-11 09:34:30', '2021-09-11 09:34:30'),
('1102911', 'Normal', '#F19425', 1, '11015035', '2021-09-11 09:35:51', '2021-09-11 09:35:51'),
('4355292', 'Help', '#F23412', 1, '11015035', '2021-09-11 09:34:30', '2021-09-11 09:34:30'),
('5405054', 'Bug', '#8F8F8F', 1, '11015035', '2021-09-11 09:35:10', '2021-09-11 09:35:10'),
('6654585', 'Free', '#2DBA60', 1, '11015035', '2021-09-11 09:35:25', '2021-09-11 09:35:25'),
('8459333', 'Question', '#F19425', 1, '11015035', '2021-09-11 09:35:51', '2021-09-11 09:35:51'),
('9355169', 'Tutorial', '#499CCF', 1, '11015035', '2021-09-11 09:34:58', '2021-09-11 09:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `bb_post_reactions_count_data`
--

DROP TABLE IF EXISTS `bb_post_reactions_count_data`;
CREATE TABLE `bb_post_reactions_count_data` (
  `post_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `reaction_id` varchar(14) COLLATE utf8_bin NOT NULL,
  `total` int(9) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_post_reactions_data`
--

DROP TABLE IF EXISTS `bb_post_reactions_data`;
CREATE TABLE `bb_post_reactions_data` (
  `id` int(9) NOT NULL,
  `type` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'thread',
  `post_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `reaction_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `reaction_text` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_post_tag_data`
--

DROP TABLE IF EXISTS `bb_post_tag_data`;
CREATE TABLE `bb_post_tag_data` (
  `post_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `tag` varchar(155) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_ranks_data`
--

DROP TABLE IF EXISTS `bb_ranks_data`;
CREATE TABLE `bb_ranks_data` (
  `rank_id` varchar(14) COLLATE utf8_bin NOT NULL,
  `title` varchar(155) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `bg_color_c` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `left_str` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `right_str` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bb_ranks_data`
--

INSERT INTO `bb_ranks_data` (`rank_id`, `title`, `image`, `status`, `bg_color_c`, `left_str`, `right_str`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('11102011', 'Noob', NULL, 1, '#46B4D4', NULL, NULL, NULL, '2021-07-12 09:49:48', '2021-07-12 09:49:48'),
('11102012', 'Professional', NULL, 1, '#46B4D4', NULL, NULL, NULL, '2021-07-12 09:50:20', '2021-07-12 09:50:20'),
('9244136952425', 'Test', '', 1, '#000000', '', '', '11015035', '2021-09-26 13:36:34', '2021-09-26 13:36:34');

-- --------------------------------------------------------

--
-- Table structure for table `bb_reaction_data`
--

DROP TABLE IF EXISTS `bb_reaction_data`;
CREATE TABLE `bb_reaction_data` (
  `reaction_id` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `text_color` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `sort_order` int(9) DEFAULT '0',
  `score` int(3) NOT NULL DEFAULT '1',
  `user_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bb_reaction_data`
--

INSERT INTO `bb_reaction_data` (`reaction_id`, `title`, `text_color`, `image_path`, `status`, `sort_order`, `score`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('119471982', 'sad', '#46B4D4', 'public/bb_contents/reactions/sad_7804308671_4387411033.png', 0, 0, 1, '11015035', '2021-09-26 14:00:42', '2021-09-26 14:00:42'),
('255403720', 'live', '#46B4D4', 'public/bb_contents/reactions/love_4564014539_7382666222.png', 0, 0, 1, '11015035', '2021-09-26 14:00:42', '2021-09-26 14:00:42'),
('263122846', 'care', '#46B4D4', 'public/bb_contents/reactions/care_6341567423_9129975918.png', 0, 0, 1, '11015035', '2021-09-26 14:00:42', '2021-09-26 14:00:42'),
('477622474', 'angry', '#46B4D4', 'public/bb_contents/reactions/angry_2334516538_1207762404.png', 0, 0, 1, '11015035', '2021-09-26 14:00:41', '2021-09-26 14:00:41'),
('603532042', 'haha', '#46B4D4', 'public/bb_contents/reactions/haha_9657659872_2583574280.png', 0, 0, 1, '11015035', '2021-09-26 14:00:42', '2021-09-26 14:00:42'),
('655026435', 'wow', '#46B4D4', 'public/bb_contents/reactions/wow_2727404584_1464875623.png', 0, 0, 1, '11015035', '2021-09-26 14:00:42', '2021-09-26 14:00:42'),
('778689943', 'like', '#46B4D4', 'public/bb_contents/reactions/like_9542204390_2561235053.png', 0, 0, 1, '11015035', '2021-09-26 14:00:42', '2021-09-26 14:00:42');

-- --------------------------------------------------------

--
-- Table structure for table `bb_report_page_data`
--

DROP TABLE IF EXISTS `bb_report_page_data`;
CREATE TABLE `bb_report_page_data` (
  `id` int(9) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `type` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'thread',
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `reason` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `target_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_shop_cart_data`
--

DROP TABLE IF EXISTS `bb_shop_cart_data`;
CREATE TABLE `bb_shop_cart_data` (
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `product_title` varchar(255) COLLATE utf8_bin NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `quantity` int(9) NOT NULL DEFAULT '1',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_shop_orders_data`
--

DROP TABLE IF EXISTS `bb_shop_orders_data`;
CREATE TABLE `bb_shop_orders_data` (
  `order_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `product_title` varchar(255) COLLATE utf8_bin NOT NULL,
  `quantity` int(9) NOT NULL DEFAULT '1',
  `price` double NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `payer_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_shop_payment_method_data`
--

DROP TABLE IF EXISTS `bb_shop_payment_method_data`;
CREATE TABLE `bb_shop_payment_method_data` (
  `payment_method` varchar(155) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin,
  `status` int(1) NOT NULL DEFAULT '1',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_smiles_category_data`
--

DROP TABLE IF EXISTS `bb_smiles_category_data`;
CREATE TABLE `bb_smiles_category_data` (
  `category_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `sort_order` int(9) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bb_smiles_category_data`
--

INSERT INTO `bb_smiles_category_data` (`category_id`, `friendly_url`, `title`, `status`, `sort_order`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('6803491913354', 'Default', 'Default', 1, 0, '11015035', '2021-08-17 10:56:04', '2021-08-17 10:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `bb_smiles_data`
--

DROP TABLE IF EXISTS `bb_smiles_data`;
CREATE TABLE `bb_smiles_data` (
  `smile_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_replace` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(9) NOT NULL DEFAULT '0',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bb_smiles_data`
--

INSERT INTO `bb_smiles_data` (`smile_id`, `category_id`, `image_path`, `text_replace`, `sort_order`, `ent_dt`) VALUES
('188911360', '6803491913354', 'public/bb_contents/smiles/Default/12_9206776733.jpg', ':255828:', 11, '2021-08-17 10:56:31'),
('206415341', '6803491913354', 'public/bb_contents/smiles/Default/19_5416225355.jpg', ':938165:', 18, '2021-08-17 10:56:31'),
('278943648', '6803491913354', 'public/bb_contents/smiles/Default/1_5762548234.jpg', ':921586:', 0, '2021-08-17 10:56:30'),
('335641649', '6803491913354', 'public/bb_contents/smiles/Default/15_7458350212.jpg', ':892865:', 14, '2021-08-17 10:56:31'),
('368072449', '6803491913354', 'public/bb_contents/smiles/Default/14_3023470299.jpg', ':896268:', 13, '2021-08-17 10:56:31'),
('414954225', '6803491913354', 'public/bb_contents/smiles/Default/18_2747593552.jpg', ':382637:', 17, '2021-08-17 10:56:31'),
('415084450', '6803491913354', 'public/bb_contents/smiles/Default/16_7554342482.jpg', ':689662:', 15, '2021-08-17 10:56:31'),
('454843788', '6803491913354', 'public/bb_contents/smiles/Default/4_4959310890.jpg', ':186673:', 3, '2021-08-17 10:56:31'),
('554308319', '6803491913354', 'public/bb_contents/smiles/Default/11_1958005895.jpg', ':433428:', 10, '2021-08-17 10:56:31'),
('561480722', '6803491913354', 'public/bb_contents/smiles/Default/13_5652885126.jpg', ':436995:', 12, '2021-08-17 10:56:31'),
('586385151', '6803491913354', 'public/bb_contents/smiles/Default/5_2668325518.jpg', ':644569:', 4, '2021-08-17 10:56:31'),
('626565582', '6803491913354', 'public/bb_contents/smiles/Default/2_9840633646.jpg', ':688137:', 1, '2021-08-17 10:56:30'),
('681876423', '6803491913354', 'public/bb_contents/smiles/Default/17_3541595247.jpg', ':487784:', 16, '2021-08-17 10:56:31'),
('690607235', '6803491913354', 'public/bb_contents/smiles/Default/7_9313136700.jpg', ':135141:', 6, '2021-08-17 10:56:31'),
('741585173', '6803491913354', 'public/bb_contents/smiles/Default/9_4450903901.jpg', ':564195:', 8, '2021-08-17 10:56:31'),
('803221994', '6803491913354', 'public/bb_contents/smiles/Default/10_7501478936.jpg', ':597185:', 9, '2021-08-17 10:56:31'),
('842474268', '6803491913354', 'public/bb_contents/smiles/Default/3_8387344752.jpg', ':779714:', 2, '2021-08-17 10:56:31'),
('958564372', '6803491913354', 'public/bb_contents/smiles/Default/8_3185404139.jpg', ':743581:', 7, '2021-08-17 10:56:31'),
('991044971', '6803491913354', 'public/bb_contents/smiles/Default/6_9166496418.jpg', ':997263:', 5, '2021-08-17 10:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `bb_smile_most_recent_data`
--

DROP TABLE IF EXISTS `bb_smile_most_recent_data`;
CREATE TABLE `bb_smile_most_recent_data` (
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `smile_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_threads_data`
--

DROP TABLE IF EXISTS `bb_threads_data`;
CREATE TABLE `bb_threads_data` (
  `thread_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `forum_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `prefix_id` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `descriptions` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `views` int(9) NOT NULL DEFAULT '0',
  `is_stick` int(1) DEFAULT '0',
  `is_url` int(1) NOT NULL DEFAULT '0',
  `has_attach_files` int(1) NOT NULL DEFAULT '0',
  `external_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_replies` int(9) NOT NULL DEFAULT '0',
  `total_reactions` int(9) NOT NULL DEFAULT '0',
  `last_repy_time` datetime DEFAULT NULL,
  `last_username_reply` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_reply_friendly_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_reply_author_avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_approved_time` datetime DEFAULT NULL,
  `last_approved_username` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `allow_reply` int(1) NOT NULL DEFAULT '1',
  `sort_order` int(9) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bb_threads_reactions_data`
--

DROP TABLE IF EXISTS `bb_threads_reactions_data`;
CREATE TABLE `bb_threads_reactions_data` (
  `id` int(9) NOT NULL,
  `thread_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `reaction_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `reaction_text` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_thread_attach_files_data`
--

DROP TABLE IF EXISTS `bb_thread_attach_files_data`;
CREATE TABLE `bb_thread_attach_files_data` (
  `file_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `post_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `data_type` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'thread',
  `file_path` varchar(255) COLLATE utf8_bin NOT NULL,
  `file_name` varchar(155) COLLATE utf8_bin NOT NULL,
  `file_type` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `file_size` float NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `last_download` datetime DEFAULT NULL,
  `views` int(9) NOT NULL DEFAULT '0',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_thread_tag_data`
--

DROP TABLE IF EXISTS `bb_thread_tag_data`;
CREATE TABLE `bb_thread_tag_data` (
  `thread_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `tag` varchar(155) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_thread_transfer_data`
--

DROP TABLE IF EXISTS `bb_thread_transfer_data`;
CREATE TABLE `bb_thread_transfer_data` (
  `id` bigint(11) NOT NULL,
  `data_type` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'thread',
  `transfer_method` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT 'fee',
  `post_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `total_value` double NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `target_user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_usergroup_ranks_data`
--

DROP TABLE IF EXISTS `bb_usergroup_ranks_data`;
CREATE TABLE `bb_usergroup_ranks_data` (
  `group_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `rank_id` varchar(14) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_users_rank_data`
--

DROP TABLE IF EXISTS `bb_users_rank_data`;
CREATE TABLE `bb_users_rank_data` (
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `rank_id` varchar(28) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_user_bookmarks_data`
--

DROP TABLE IF EXISTS `bb_user_bookmarks_data`;
CREATE TABLE `bb_user_bookmarks_data` (
  `bookmark_id` int(9) NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_user_data`
--

DROP TABLE IF EXISTS `bb_user_data`;
CREATE TABLE `bb_user_data` (
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `posts` int(9) NOT NULL DEFAULT '0',
  `threads` int(9) NOT NULL DEFAULT '0',
  `reactions` int(9) NOT NULL DEFAULT '0',
  `max_message` int(9) NOT NULL DEFAULT '10000',
  `created_message` int(9) NOT NULL DEFAULT '0',
  `message_unread` int(9) NOT NULL DEFAULT '0',
  `require_view_thread_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `last_view_forum_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `last_view_forum_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_view_post_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `last_view_post_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_thread_views` int(9) NOT NULL DEFAULT '0',
  `total_followers` int(9) NOT NULL DEFAULT '0',
  `total_follows` int(9) NOT NULL DEFAULT '0',
  `bio` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(155) COLLATE utf8_bin DEFAULT NULL,
  `skills` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `job` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `signature` varchar(5000) COLLATE utf8_bin DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `about` varchar(5000) COLLATE utf8_bin DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `total_points` double NOT NULL DEFAULT '0',
  `balance` double NOT NULL DEFAULT '0',
  `reputation` int(9) NOT NULL DEFAULT '0',
  `wall_banner` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `is_show_birthday` int(1) NOT NULL DEFAULT '1',
  `birthday` date DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'none',
  `address` varchar(155) COLLATE utf8_bin DEFAULT NULL,
  `phone1` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `phone2` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `is_show_online_status` int(1) NOT NULL DEFAULT '1',
  `is_show_activites` int(1) NOT NULL DEFAULT '1',
  `allow_view_profile` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `allow_other_write_on_profile` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '2',
  `allow_receive_message` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '2',
  `received_news_via_email` int(1) NOT NULL DEFAULT '0',
  `received_activities_via_email` int(1) NOT NULL DEFAULT '0',
  `icq` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `aim` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `skype` varchar(155) COLLATE utf8_bin DEFAULT NULL,
  `google_talk` varchar(155) COLLATE utf8_bin DEFAULT NULL,
  `lang` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `timezone` varchar(155) COLLATE utf8_bin DEFAULT NULL,
  `two_step_login_verify` int(1) NOT NULL DEFAULT '0',
  `is_buy_usergroup` int(1) NOT NULL DEFAULT '0',
  `last_user_online` datetime DEFAULT NULL,
  `last_user_ip_address` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `last_user_user_agent` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `ref_user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `coin_btc` double NOT NULL DEFAULT '0',
  `coin_eth` double NOT NULL DEFAULT '0',
  `coin_usdt` double NOT NULL DEFAULT '0',
  `coin_busd` double NOT NULL DEFAULT '0',
  `coin_bnb` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bb_user_data`
--

INSERT INTO `bb_user_data` (`user_id`, `posts`, `threads`, `reactions`, `max_message`, `created_message`, `message_unread`, `require_view_thread_id`, `last_view_forum_id`, `last_view_forum_time`, `last_view_post_id`, `last_view_post_time`, `total_thread_views`, `total_followers`, `total_follows`, `bio`, `website`, `skills`, `job`, `signature`, `facebook`, `about`, `twitter`, `total_points`, `balance`, `reputation`, `wall_banner`, `is_show_birthday`, `birthday`, `gender`, `address`, `phone1`, `phone2`, `is_show_online_status`, `is_show_activites`, `allow_view_profile`, `allow_other_write_on_profile`, `allow_receive_message`, `received_news_via_email`, `received_activities_via_email`, `icq`, `aim`, `skype`, `google_talk`, `lang`, `timezone`, `two_step_login_verify`, `is_buy_usergroup`, `last_user_online`, `last_user_ip_address`, `last_user_user_agent`, `ref_user_id`, `coin_btc`, `coin_eth`, `coin_usdt`, `coin_busd`, `coin_bnb`) VALUES
('11015035', 0, 0, 0, 10000, 0, 0, NULL, NULL, '2021-12-04 11:38:47', NULL, '2021-12-04 11:38:47', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 1, NULL, 'none', NULL, NULL, NULL, 1, 1, '1', '2', '2', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bb_user_disallow_forum`
--

DROP TABLE IF EXISTS `bb_user_disallow_forum`;
CREATE TABLE `bb_user_disallow_forum` (
  `forum_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `insert_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_user_disallow_register`
--

DROP TABLE IF EXISTS `bb_user_disallow_register`;
CREATE TABLE `bb_user_disallow_register` (
  `username` varchar(155) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bb_user_disallow_register`
--

INSERT INTO `bb_user_disallow_register` (`username`, `ent_dt`) VALUES
('admin', '2021-08-08 15:35:49'),
('administrator', '2021-08-08 15:35:50'),
('bulletinboard', '2021-08-08 15:35:50'),
('coffeecms', '2021-08-08 15:35:50'),
('fuck', '2021-08-10 13:56:25'),
('guest', '2021-08-08 15:35:50'),
('login', '2021-08-08 15:35:50'),
('manager', '2021-08-08 15:35:49'),
('mod', '2021-08-08 15:35:49'),
('moderate', '2021-08-08 15:35:49'),
('moderator', '2021-08-08 15:35:49'),
('register', '2021-08-08 15:35:50'),
('system', '2021-08-08 15:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `bb_user_follow_data`
--

DROP TABLE IF EXISTS `bb_user_follow_data`;
CREATE TABLE `bb_user_follow_data` (
  `follow_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `followed_user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_user_group_data`
--

DROP TABLE IF EXISTS `bb_user_group_data`;
CREATE TABLE `bb_user_group_data` (
  `group_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `left_str` varchar(5000) COLLATE utf8_bin DEFAULT NULL,
  `right_str` varchar(5000) COLLATE utf8_bin DEFAULT NULL,
  `max_message` int(9) NOT NULL DEFAULT '10000',
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_user_wall_comment_data`
--

DROP TABLE IF EXISTS `bb_user_wall_comment_data`;
CREATE TABLE `bb_user_wall_comment_data` (
  `message_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `wall_user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `author_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_visitor_views_data`
--

DROP TABLE IF EXISTS `bb_visitor_views_data`;
CREATE TABLE `bb_visitor_views_data` (
  `id` int(9) NOT NULL,
  `session_id` varchar(155) COLLATE utf8_bin NOT NULL,
  `username` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `ip_address` varchar(24) COLLATE utf8_bin NOT NULL,
  `user_agent` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `page_url` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `referrer_url` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `referrer_site` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `referrer_type` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT 'website',
  `os_title` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `os_version` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `browser_title` varchar(155) COLLATE utf8_bin DEFAULT NULL,
  `browser_version` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `is_mobile` int(1) NOT NULL DEFAULT '0',
  `is_tablet` int(1) NOT NULL DEFAULT '0',
  `is_windows` int(1) NOT NULL DEFAULT '0',
  `is_linux` int(1) NOT NULL DEFAULT '0',
  `is_android` int(1) NOT NULL DEFAULT '0',
  `is_ios` int(1) NOT NULL DEFAULT '0',
  `country_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `cache_data`
--

DROP TABLE IF EXISTS `cache_data`;
CREATE TABLE `cache_data` (
  `cache_id` varchar(26) COLLATE utf8_unicode_ci NOT NULL,
  `cache_key` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `cache_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `plugin_c` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `theme_c` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calendar_data`
--

DROP TABLE IF EXISTS `calendar_data`;
CREATE TABLE `calendar_data` (
  `calendar_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `title` varchar(500) COLLATE utf8_bin NOT NULL,
  `start_dt` datetime NOT NULL,
  `end_dt` datetime NOT NULL,
  `all_day` int(1) NOT NULL DEFAULT '0',
  `comment` text COLLATE utf8_bin,
  `color_c` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `calendar_data`
--

INSERT INTO `calendar_data` (`calendar_id`, `title`, `start_dt`, `end_dt`, `all_day`, `comment`, `color_c`, `status`, `ent_dt`, `upd_dt`) VALUES
('8855744123794432624752345', 'test test', '2021-07-08 09:00:00', '2021-07-08 10:00:00', 0, NULL, '#5DB7D1', 0, '2021-07-08 16:09:31', '2021-07-08 16:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `calendar_group`
--

DROP TABLE IF EXISTS `calendar_group`;
CREATE TABLE `calendar_group` (
  `group_c` varchar(8) COLLATE utf8_bin NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `color_c` varchar(20) COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `category_mst`
--

DROP TABLE IF EXISTS `category_mst`;
CREATE TABLE `category_mst` (
  `category_c` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_category_c` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptions` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contents` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `views` int(9) NOT NULL DEFAULT '0',
  `sort_order` int(9) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_mst`
--

INSERT INTO `category_mst` (`category_c`, `title`, `parent_category_c`, `friendly_url`, `thumbnail`, `keywords`, `descriptions`, `contents`, `status`, `views`, `sort_order`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('9844612265587', 'Non Title', '', 'Non-Title', '', 'Non Title', 'Non Title', NULL, 1, 0, 0, '', '2021-06-05 09:36:23', '2021-06-05 09:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `comment_data`
--

DROP TABLE IF EXISTS `comment_data`;
CREATE TABLE `comment_data` (
  `comment_id` varchar(38) COLLATE utf8_unicode_ci NOT NULL,
  `parent_comment_id` varchar(38) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_data`
--

DROP TABLE IF EXISTS `contact_data`;
CREATE TABLE `contact_data` (
  `contact_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `ent_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cronjob_data`
--

DROP TABLE IF EXISTS `cronjob_data`;
CREATE TABLE `cronjob_data` (
  `id` int(9) NOT NULL,
  `command_content` varchar(255) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `cronjob_log_data`
--

DROP TABLE IF EXISTS `cronjob_log_data`;
CREATE TABLE `cronjob_log_data` (
  `id` int(11) NOT NULL,
  `job_content` varchar(500) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `emailmarketing_email_data`
--

DROP TABLE IF EXISTS `emailmarketing_email_data`;
CREATE TABLE `emailmarketing_email_data` (
  `id` int(9) NOT NULL,
  `email` varchar(155) COLLATE utf8_bin NOT NULL,
  `group_id` varchar(8) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `emailmarketing_email_data`
--

INSERT INTO `emailmarketing_email_data` (`id`, `email`, `group_id`, `ent_dt`) VALUES
(8, 'sadsadsad@gmail.com', '1001201', '2021-06-11 11:05:23'),
(9, 'test1@gmail.com', '1001201', '2021-06-11 11:30:53'),
(10, 'test2@gmail.com', '1001201', '2021-06-11 11:30:53'),
(11, 'test4@gmail.com', '1001201', '2021-06-11 11:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `emailmarketing_group_data`
--

DROP TABLE IF EXISTS `emailmarketing_group_data`;
CREATE TABLE `emailmarketing_group_data` (
  `group_id` varchar(8) COLLATE utf8_bin NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `emailmarketing_group_data`
--

INSERT INTO `emailmarketing_group_data` (`group_id`, `title`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('1001201', 'Default', '', '2021-06-11 10:16:33', '2021-06-11 10:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `emailmarketing_jobs_data`
--

DROP TABLE IF EXISTS `emailmarketing_jobs_data`;
CREATE TABLE `emailmarketing_jobs_data` (
  `job_id` varchar(12) COLLATE utf8_bin NOT NULL,
  `template_id` varchar(12) COLLATE utf8_bin NOT NULL,
  `group_id` varchar(8) COLLATE utf8_bin NOT NULL,
  `total_sended` int(9) NOT NULL DEFAULT '0',
  `total_readed` int(9) NOT NULL DEFAULT '0',
  `total_email` int(9) NOT NULL DEFAULT '0',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `emailmarketing_sent_data`
--

DROP TABLE IF EXISTS `emailmarketing_sent_data`;
CREATE TABLE `emailmarketing_sent_data` (
  `send_id` int(9) NOT NULL,
  `job_id` varchar(12) COLLATE utf8_bin NOT NULL,
  `to_email` varchar(155) COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `is_readed` int(1) NOT NULL DEFAULT '0',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `emailmarketing_unsubscrible_data`
--

DROP TABLE IF EXISTS `emailmarketing_unsubscrible_data`;
CREATE TABLE `emailmarketing_unsubscrible_data` (
  `id` int(9) NOT NULL,
  `email` varchar(155) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `emailmarketing_unsubscrible_data`
--

INSERT INTO `emailmarketing_unsubscrible_data` (`id`, `email`, `ent_dt`) VALUES
(1, 'test2@gmail.com', '2021-06-11 12:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `email_sent_data`
--

DROP TABLE IF EXISTS `email_sent_data`;
CREATE TABLE `email_sent_data` (
  `send_id` int(9) NOT NULL,
  `template_id` varchar(8) COLLATE utf8_bin NOT NULL,
  `to_email` varchar(1000) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin,
  `sent_result` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `email_template_data`
--

DROP TABLE IF EXISTS `email_template_data`;
CREATE TABLE `email_template_data` (
  `template_id` varchar(8) COLLATE utf8_bin NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `subject` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `content` text COLLATE utf8_bin,
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `email_template_data`
--

INSERT INTO `email_template_data` (`template_id`, `title`, `subject`, `content`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('124231', 'New user registered', 'Welcome to {{site_title}}', '<p>Dear,</p>\n\n<p><strong>Welcome to {{site_title}}</strong></p>\n\n<p>Your account details:</p>\n\n<p>Username: {{username}}</p>\n\n<p>Password : {{password}}</p>\n\n<p><strong>Thanks for register new user on my website!</strong></p>\n', '', '2021-05-17 09:25:16', '2021-05-17 09:25:16'),
('137454', 'Forgot Password', 'Forgot password verfify - {{site_title}}', '<p>Hi,</p>\n\n<p>You have make a forgot password request</p>\n\n<p>You can click on below url for verify your request and create new password</p>\n\n<p><a href=\\\"{{verify_forgotpassword_url}}\\\">{{verify_forgotpassword_url}}</a></p>\n\n<p>Thanks and BRs,</p>\n\n<p>&nbsp;</p>\n', '', '2021-05-17 09:25:16', '2021-05-17 09:25:16'),
('143664', 'Change password', 'Change password - {{site_title}}', '<p><strong>Dear {{user_name}},</strong></p>\n\n<p>You have been change password of your account at our website&nbsp;<a href=\\\"{{site_url}}\\\">{{site_title}}</a></p>\n\n<p>You new account details:</p>\n\n<p>Username: <strong>{{username}}</strong></p>\n\n<p>Password: <strong>{{password}}</strong></p>\n\n<p>Thanks and BRs,</p>\n', '', '2021-05-17 09:25:16', '2021-05-17 09:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `group_permission_data`
--

DROP TABLE IF EXISTS `group_permission_data`;
CREATE TABLE `group_permission_data` (
  `group_c` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `permission_c` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_permission_data`
--

INSERT INTO `group_permission_data` (`group_c`, `permission_c`, `user_id`, `ent_dt`) VALUES
('11016013', 'menu02', '11015035', '2021-06-23 09:08:08'),
('11016013', 'menu08', '11015035', '2021-06-23 09:08:08'),
('11016013', 'menu10', '11015035', '2021-06-23 09:08:08'),
('11016013', 'menu11', '11015035', '2021-06-23 09:08:08'),
('11016013', 'post01', '11015035', '2021-06-23 09:08:08'),
('11016013', 'post02', '11015035', '2021-06-23 09:08:08'),
('11016013', 'post04', '11015035', '2021-06-23 09:08:08'),
('11016013', 'post05', '11015035', '2021-06-23 09:08:08'),
('11016016', 'post04', '11015035', '2021-06-19 14:58:39'),
('11016016', 'post05', '11015035', '2021-06-19 14:58:39'),
('554546466', 'menu02', 'mrtienmi4', '2021-05-10 06:29:52'),
('554546466', 'menu08', 'mrtienmi4', '2021-05-10 06:29:52'),
('11016011', 'menu10', '11015035', '2021-09-01 13:56:09'),
('11016011', 'post08', '11015035', '2021-09-01 13:56:09'),
('11016011', 'post05', '11015035', '2021-09-01 13:56:09'),
('11016011', 'post11', '11015035', '2021-09-01 13:56:09'),
('11016011', 'per1101105', '11015035', '2021-09-01 13:56:09'),
('11016011', 'post06', '11015035', '2021-09-01 13:56:09'),
('11016011', 'post01', '11015035', '2021-09-01 13:56:09'),
('11016011', 'menu05', '11015035', '2021-09-01 13:56:09'),
('11016011', 'menu09', '11015035', '2021-09-01 13:56:09'),
('11016011', 'menu11', '11015035', '2021-09-01 13:56:09'),
('11016011', 'per1101103', '11015035', '2021-09-01 13:56:09'),
('11016011', 'post09', '11015035', '2021-09-01 13:56:09'),
('11016011', 'post02', '11015035', '2021-09-01 13:56:09'),
('11016011', 'post12', '11015035', '2021-09-01 13:56:09'),
('11016011', 'category02', '11015035', '2021-09-01 13:56:09'),
('11016011', 'menu02', '11015035', '2021-09-01 13:56:09'),
('11016011', 'menu08', '11015035', '2021-09-01 13:56:09'),
('11016011', 'category01', '11015035', '2021-09-01 13:56:09'),
('11016011', 'menu01', '11015035', '2021-09-01 13:56:09'),
('11016011', 'menu03', '11015035', '2021-09-01 13:56:09'),
('11016011', 'menu06', '11015035', '2021-09-01 13:56:09'),
('11016011', 'post10', '11015035', '2021-09-01 13:56:09'),
('11016011', 'menu04', '11015035', '2021-09-01 13:56:09'),
('11016011', 'menu07', '11015035', '2021-09-01 13:56:10'),
('11016011', 'per1101101', '11015035', '2021-09-01 13:56:10'),
('11016011', 'per1101102', '11015035', '2021-09-01 13:56:10'),
('11016011', 'post04', '11015035', '2021-09-01 13:56:10'),
('11016012', 'post05', '11015035', '2021-09-01 14:03:22'),
('11016012', 'post01', '11015035', '2021-09-01 14:03:22'),
('11016012', 'post02', '11015035', '2021-09-01 14:03:22'),
('11016012', 'category02', '11015035', '2021-09-01 14:03:22'),
('11016012', 'menu02', '11015035', '2021-09-01 14:03:22'),
('11016012', 'menu08', '11015035', '2021-09-01 14:03:22'),
('11016012', 'post04', '11015035', '2021-09-01 14:03:23'),
('925680128', 'menu10', '11015035', '2021-11-06 10:39:14'),
('925680128', 'post08', '11015035', '2021-11-06 10:39:14'),
('925680128', 'post05', '11015035', '2021-11-06 10:39:14'),
('925680128', 'post11', '11015035', '2021-11-06 10:39:14'),
('925680128', 'per1101105', '11015035', '2021-11-06 10:39:14'),
('925680128', 'post06', '11015035', '2021-11-06 10:39:14'),
('925680128', 'post01', '11015035', '2021-11-06 10:39:14'),
('925680128', 'menu11', '11015035', '2021-11-06 10:39:14'),
('925680128', 'per1101103', '11015035', '2021-11-06 10:39:15'),
('925680128', 'post09', '11015035', '2021-11-06 10:39:15'),
('925680128', 'post02', '11015035', '2021-11-06 10:39:15'),
('925680128', 'post12', '11015035', '2021-11-06 10:39:15'),
('925680128', 'category02', '11015035', '2021-11-06 10:39:15'),
('925680128', 'menu02', '11015035', '2021-11-06 10:39:15'),
('925680128', 'menu08', '11015035', '2021-11-06 10:39:15'),
('925680128', 'post10', '11015035', '2021-11-06 10:39:15'),
('925680128', 'per1101101', '11015035', '2021-11-06 10:39:15'),
('925680128', 'per1101102', '11015035', '2021-11-06 10:39:15'),
('925680128', 'post04', '11015035', '2021-11-06 10:39:15'),
('11016012', 'BB10001', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10002', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10003', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10004', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10005', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10006', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10007', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10008', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10009', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10010', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10011', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10012', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10013', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10014', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10015', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10016', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10017', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10018', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB10019', '11015035', '2021-12-04 11:38:15'),
('11016012', 'BB30013', '11015035', '2021-12-04 11:38:16'),
('11016012', 'BB30014', '11015035', '2021-12-04 11:38:16'),
('11016012', 'BB30015', '11015035', '2021-12-04 11:38:16'),
('11016012', 'BB30016', '11015035', '2021-12-04 11:38:16'),
('11016012', 'BB30019', '11015035', '2021-12-04 11:38:16'),
('11016012', 'BB30020', '11015035', '2021-12-04 11:38:16'),
('11016012', 'BB30021', '11015035', '2021-12-04 11:38:16'),
('11016012', 'BB30026', '11015035', '2021-12-04 11:38:16'),
('11016012', 'BB30027', '11015035', '2021-12-04 11:38:16'),
('11016012', 'BB30028', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10001', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10002', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10003', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10004', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10005', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10006', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10007', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10008', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10009', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10010', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10011', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10012', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10013', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10014', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10015', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10016', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10017', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10018', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB10019', '11015035', '2021-12-04 11:38:16'),
('11016018', 'BB30013', '11015035', '2021-12-04 11:38:17'),
('11016018', 'BB30014', '11015035', '2021-12-04 11:38:17'),
('11016018', 'BB30015', '11015035', '2021-12-04 11:38:17'),
('11016018', 'BB30016', '11015035', '2021-12-04 11:38:17'),
('11016018', 'BB30019', '11015035', '2021-12-04 11:38:17'),
('11016018', 'BB30020', '11015035', '2021-12-04 11:38:17'),
('11016018', 'BB30021', '11015035', '2021-12-04 11:38:17'),
('11016018', 'BB30025', '11015035', '2021-12-04 11:38:17'),
('11016018', 'BB30026', '11015035', '2021-12-04 11:38:17'),
('11016018', 'BB30027', '11015035', '2021-12-04 11:38:17'),
('11016018', 'BB30028', '11015035', '2021-12-04 11:38:17'),
('11016018', 'BB30030', '11015035', '2021-12-04 11:38:17'),
('11016013', 'BB10001', '11015035', '2021-12-04 11:38:19'),
('11016013', 'BB10003', '11015035', '2021-12-04 11:38:19'),
('11016013', 'BB10004', '11015035', '2021-12-04 11:38:19'),
('11016013', 'BB10005', '11015035', '2021-12-04 11:38:19'),
('11016013', 'BB10006', '11015035', '2021-12-04 11:38:19'),
('11016013', 'BB10007', '11015035', '2021-12-04 11:38:19'),
('11016013', 'BB10010', '11015035', '2021-12-04 11:38:19'),
('11016013', 'BB10013', '11015035', '2021-12-04 11:38:19'),
('11016013', 'BB10014', '11015035', '2021-12-04 11:38:19'),
('11016013', 'BB10017', '11015035', '2021-12-04 11:38:19'),
('11016013', 'BB10018', '11015035', '2021-12-04 11:38:19'),
('11016011', 'BB10001', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10002', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10003', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10004', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10005', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10006', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10007', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10008', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10009', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10010', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10011', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10012', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10013', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10014', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10015', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10016', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10017', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10018', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB10019', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30013', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30014', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30015', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30016', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30017', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30018', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30019', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30020', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30021', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30022', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30023', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30024', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30025', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30026', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30027', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30028', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30029', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30030', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30031', '11015035', '2021-12-04 11:38:48'),
('11016011', 'BB30032', '11015035', '2021-12-04 11:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `kanban_board_comment_data`
--

DROP TABLE IF EXISTS `kanban_board_comment_data`;
CREATE TABLE `kanban_board_comment_data` (
  `id` int(9) NOT NULL,
  `message_id` varchar(24) COLLATE utf8_bin NOT NULL,
  `content` varchar(1000) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kanban_board_data`
--

DROP TABLE IF EXISTS `kanban_board_data`;
CREATE TABLE `kanban_board_data` (
  `message_id` varchar(24) COLLATE utf8_bin NOT NULL,
  `board_c` varchar(16) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `percent` float NOT NULL DEFAULT '0',
  `sort_order` int(9) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kanban_board_mst`
--

DROP TABLE IF EXISTS `kanban_board_mst`;
CREATE TABLE `kanban_board_mst` (
  `board_c` varchar(16) COLLATE utf8_bin NOT NULL,
  `project_c` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `sort_order` int(2) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kanban_board_mst`
--

INSERT INTO `kanban_board_mst` (`board_c`, `project_c`, `title`, `sort_order`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('554911469421', '21423523', 'Docs', 1, '', '2021-05-22 11:41:06', '2021-05-22 11:41:06'),
('648246517313', '21423523', 'Done', 4, '', '2021-05-22 11:40:57', '2021-05-22 11:40:57'),
('772343583978051', '', '', 1, '', '2021-06-13 08:33:23', '2021-06-13 08:33:23'),
('785849759653', '21423523', 'Todo', 2, '', '2021-05-22 11:40:33', '2021-05-22 11:40:33'),
('925994129363', '21423523', 'In Progress', 3, '', '2021-05-22 11:40:51', '2021-05-22 11:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `kanban_board_project_mst`
--

DROP TABLE IF EXISTS `kanban_board_project_mst`;
CREATE TABLE `kanban_board_project_mst` (
  `project_c` varchar(16) COLLATE utf8_bin NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kanban_board_project_mst`
--

INSERT INTO `kanban_board_project_mst` (`project_c`, `title`, `status`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('21423523', 'Default', 1, '', '2021-05-19 08:01:33', '2021-05-19 08:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `kanban_task_checklist_data`
--

DROP TABLE IF EXISTS `kanban_task_checklist_data`;
CREATE TABLE `kanban_task_checklist_data` (
  `check_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `task_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `title` varchar(500) COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kanban_task_comment_data`
--

DROP TABLE IF EXISTS `kanban_task_comment_data`;
CREATE TABLE `kanban_task_comment_data` (
  `comment_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `task_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `attach_files` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kanban_task_data`
--

DROP TABLE IF EXISTS `kanban_task_data`;
CREATE TABLE `kanban_task_data` (
  `task_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `project_c` varchar(16) COLLATE utf8_bin NOT NULL,
  `title` varchar(500) COLLATE utf8_bin NOT NULL,
  `assigned_to` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `progress` int(3) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kanban_task_data`
--

INSERT INTO `kanban_task_data` (`task_id`, `project_c`, `title`, `assigned_to`, `progress`, `start_date`, `end_date`, `status`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('3407867696490430220', '21423523', 'This is test task in test project mangement plugin', '11015035', 70, '2021-06-15', '2021-06-29', 1, '11015035', '2021-06-22 14:41:31', '2021-06-22 14:41:31'),
('8267299739366316837', '21423523', 'test', '11015035', 100, '2021-06-22', '2021-07-22', 1, '11015035', '2021-06-22 14:33:36', '2021-06-22 14:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `kanboard_category_mst`
--

DROP TABLE IF EXISTS `kanboard_category_mst`;
CREATE TABLE `kanboard_category_mst` (
  `category_c` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_category_c` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptions` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contents` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `views` int(9) NOT NULL DEFAULT '0',
  `sort_order` int(9) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kanboard_category_mst`
--

INSERT INTO `kanboard_category_mst` (`category_c`, `title`, `parent_category_c`, `friendly_url`, `thumbnail`, `keywords`, `descriptions`, `contents`, `status`, `views`, `sort_order`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('9844612265587', 'Non Title', '', 'Non-Title', '', 'Non Title', 'Non Title', NULL, 1, 0, 0, '', '2021-06-05 09:36:23', '2021-06-05 09:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `language_mst`
--

DROP TABLE IF EXISTS `language_mst`;
CREATE TABLE `language_mst` (
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_data`
--

DROP TABLE IF EXISTS `media_data`;
CREATE TABLE `media_data` (
  `id` varchar(28) COLLATE utf8_bin NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `file_path` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `media_data`
--

INSERT INTO `media_data` (`id`, `name`, `file_path`, `user_id`, `ent_dt`) VALUES
('437960155639557805858369', '20402_031381225.JPG', '/public/uploads/medias/20402_031381225.JPG', 'Auto', '2021-03-15 16:23:51');

-- --------------------------------------------------------

--
-- Table structure for table `menu_data`
--

DROP TABLE IF EXISTS `menu_data`;
CREATE TABLE `menu_data` (
  `menu_id` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `parent_menu_id` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_url` int(1) NOT NULL DEFAULT '0',
  `page_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_type` int(3) DEFAULT '1',
  `content` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `sort_order` int(5) NOT NULL DEFAULT '0',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_data`
--

INSERT INTO `menu_data` (`menu_id`, `parent_menu_id`, `title`, `is_url`, `page_url`, `menu_type`, `content`, `status`, `sort_order`, `ent_dt`, `upd_dt`) VALUES
('11015030', '', 'Home', 0, '', 1, NULL, 1, -2, '2021-05-30 15:08:54', '2021-05-30 15:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `message_data`
--

DROP TABLE IF EXISTS `message_data`;
CREATE TABLE `message_data` (
  `message_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `to_user_id` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `is_guest` int(1) NOT NULL DEFAULT '0',
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_data`
--

DROP TABLE IF EXISTS `newsletter_data`;
CREATE TABLE `newsletter_data` (
  `id` int(9) NOT NULL,
  `email` varchar(155) COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `ip_add` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `user_agent` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `options_data`
--

DROP TABLE IF EXISTS `options_data`;
CREATE TABLE `options_data` (
  `option_c` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `target_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `target_value` text COLLATE utf8_unicode_ci,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options_mst`
--

DROP TABLE IF EXISTS `options_mst`;
CREATE TABLE `options_mst` (
  `option_c` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `option_type` int(5) NOT NULL DEFAULT '1',
  `title` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_data`
--

DROP TABLE IF EXISTS `page_data`;
CREATE TABLE `page_data` (
  `page_c` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `descriptions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `views` int(9) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions_mst`
--

DROP TABLE IF EXISTS `permissions_mst`;
CREATE TABLE `permissions_mst` (
  `permission_c` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions_mst`
--

INSERT INTO `permissions_mst` (`permission_c`, `title`, `status`, `user_id`, `ent_dt`) VALUES
('BB10001', 'Bulletinboard - Can view forum ', 1, '', '2021-03-28 10:07:14'),
('BB10002', 'Bulletinboard - Guest can register account ', 1, '', '2021-03-28 10:07:14'),
('BB10003', 'Bulletinboard - Can create new thread ', 1, '', '2021-03-28 10:07:14'),
('BB10004', 'Bulletinboard - Can reply post ', 1, '', '2021-03-28 10:07:14'),
('BB10005', 'Bulletinboard - Can send message to others ', 1, '', '2021-03-28 10:07:14'),
('BB10006', 'Bulletinboard - Can view thread ', 1, '', '2021-03-28 10:07:14'),
('BB10007', 'Bulletinboard - Can publish thread after submit ', 1, '', '2021-03-28 10:07:14'),
('BB10008', 'Bulletinboard - Can change status of other threads ', 1, '', '2021-03-28 10:07:14'),
('BB10009', 'Bulletinboard - Can change user group ', 1, '', '2021-03-28 10:07:14'),
('BB10010', 'Bulletinboard - Can delete thread', 1, '', '2021-03-28 10:07:14'),
('BB10011', 'Bulletinboard - Can add new sticky thread in forum ', 1, '', '2021-03-28 10:07:14'),
('BB10012', 'Bulletinboard - Can moderator in all forums ', 1, '', '2021-03-28 10:07:14'),
('BB10013', 'Bulletinboard - Can receive message from others ', 1, '', '2021-03-28 10:07:14'),
('BB10014', 'Bulletinboard - Can create poll ', 1, '', '2021-03-28 10:07:14'),
('BB10015', 'Bulletinboard - Guest can view thread ', 1, '', '2021-03-28 10:07:14'),
('BB10016', 'Bulletinboard - Guest can view reply ', 1, '', '2021-03-28 10:07:14'),
('BB10017', 'Bulletinboard - Can download attach files ', 1, '', '2021-03-28 10:07:14'),
('BB10018', 'Bulletinboard - Can views member list ', 1, '', '2021-03-28 10:07:14'),
('BB10019', 'Bulletinboard - Can views resources list ', 1, '', '2021-03-28 10:07:14'),
('BB20001', 'Bulletinboard - Disallow view forum ', 1, '', '2021-03-28 10:07:14'),
('BB20003', 'Bulletinboard - Disallow create new thread ', 1, '', '2021-03-28 10:07:14'),
('BB20004', 'Bulletinboard - Disallow reply post ', 1, '', '2021-03-28 10:07:14'),
('BB20005', 'Bulletinboard - Disallow send message to others ', 1, '', '2021-03-28 10:07:14'),
('BB20006', 'Bulletinboard - Disallow view thread ', 1, '', '2021-03-28 10:07:14'),
('BB20007', 'Bulletinboard - Disallow publish thread after submit ', 1, '', '2021-03-28 10:07:14'),
('BB20008', 'Bulletinboard - Disallow change status of other threads ', 1, '', '2021-03-28 10:07:14'),
('BB20009', 'Bulletinboard - Disallow change user group ', 1, '', '2021-03-28 10:07:14'),
('BB20010', 'Bulletinboard - Disallow delete thread', 1, '', '2021-03-28 10:07:14'),
('BB20011', 'Bulletinboard - Disallow add new sticky thread in forum ', 1, '', '2021-03-28 10:07:14'),
('BB20012', 'Bulletinboard - Disallow moderator in all forums ', 1, '', '2021-03-28 10:07:14'),
('BB20013', 'Bulletinboard - Disallow receive message from others ', 1, '', '2021-03-28 10:07:14'),
('BB20014', 'Bulletinboard - Disallow download attach files ', 1, '', '2021-03-28 10:07:14'),
('BB30013', 'Bulletinboard - Can manage ads', 1, '', '2021-03-28 10:07:14'),
('BB30014', 'Bulletinboard - Can view dashboard', 1, '', '2021-03-28 10:07:14'),
('BB30015', 'Bulletinboard - Can manage forums', 1, '', '2021-03-28 10:07:14'),
('BB30016', 'Bulletinboard - Can manage threads', 1, '', '2021-03-28 10:07:14'),
('BB30017', 'Bulletinboard - Can manage reactions', 1, '', '2021-03-28 10:07:14'),
('BB30018', 'Bulletinboard - Can manage smiles', 1, '', '2021-03-28 10:07:14'),
('BB30019', 'Bulletinboard - Can manage banned users', 1, '', '2021-03-28 10:07:14'),
('BB30020', 'Bulletinboard - Can manage banned email', 1, '', '2021-03-28 10:07:14'),
('BB30021', 'Bulletinboard - Can manage banned ip address', 1, '', '2021-03-28 10:07:14'),
('BB30022', 'Bulletinboard - Can manage attach files', 1, '', '2021-03-28 10:07:14'),
('BB30023', 'Bulletinboard - Can setting system', 1, '', '2021-03-28 10:07:14'),
('BB30024', 'Bulletinboard - Can clean data', 1, '', '2021-03-28 10:07:14'),
('BB30025', 'Bulletinboard - Can view admin panel', 1, '', '2021-03-28 10:07:14'),
('BB30026', 'Bulletinboard - Can manage users', 1, '', '2021-03-28 10:07:14'),
('BB30027', 'Bulletinboard - Can manage firewall', 1, '', '2021-03-28 10:07:14'),
('BB30028', 'Bulletinboard - Can access remote api', 1, '', '2021-03-28 10:07:14'),
('BB30029', 'Bulletinboard - Can manage ranks', 1, '', '2021-03-28 10:07:14'),
('BB30030', 'Bulletinboard - Can manage annoucements', 1, '', '2021-03-28 10:07:14'),
('BB30031', 'Bulletinboard - Can manage captcha questions', 1, '', '2021-03-28 10:07:14'),
('BB30032', 'Bulletinboard - Can manage post prefix', 1, '', '2021-03-28 10:07:14'),
('category01', 'Can manage categories ?', 1, '', '2021-03-28 10:07:14'),
('category02', 'Can edit all categories ?', 1, '', '2021-03-28 10:07:14'),
('menu01', 'Can manage pages ?', 1, '15904', '2021-03-27 16:36:56'),
('menu02', 'Can edit all page ?', 1, '15904', '2021-03-27 16:37:13'),
('menu03', 'Can manage plugins ?', 1, '15904', '2021-03-27 16:37:27'),
('menu04', 'Can manage themes ?', 1, '15904', '2021-03-27 16:37:38'),
('menu05', 'Can change system setting ?', 1, '15904', '2021-03-27 16:37:52'),
('menu06', 'Can manage post ?', 1, '15904', '2021-03-27 16:38:52'),
('menu07', 'Can manage users ?', 1, '15904', '2021-03-27 16:39:10'),
('menu08', 'Can edit all post ?', 1, '15904', '2021-03-27 16:39:55'),
('menu09', 'Can change system theme ?', 1, '15904', '2021-03-27 16:40:18'),
('menu10', 'Can activate plugin ?', 1, '15904', '2021-03-27 16:40:37'),
('menu11', 'Can deactivate plugin ?', 1, '15904', '2021-03-27 16:40:49'),
('per1101101', 'Can update all task ?', 1, '', '2021-03-28 10:05:49'),
('per1101102', 'Can view all task ?', 1, '', '2021-03-28 10:05:49'),
('per1101103', 'Can delete all task ?', 1, '', '2021-03-28 10:05:49'),
('per1101105', 'Can add new task ?', 1, '', '2021-03-28 10:05:49'),
('post01', 'Can change post status ?', 1, '', '2021-03-28 10:04:52'),
('post02', 'Can delete post ?', 1, '', '2021-03-28 10:05:03'),
('post04', 'Can view post ?', 1, '', '2021-03-28 10:05:49'),
('post05', 'Can add new post ?', 1, '', '2021-03-28 10:05:49'),
('post06', 'Can change page status ?', 1, '', '2021-03-28 10:04:52'),
('post08', 'Can add new page ?', 1, '', '2021-03-28 10:05:49'),
('post09', 'Can delete page ?', 1, '', '2021-03-28 10:05:49'),
('post10', 'Can manage short urls ?', 1, '', '2021-03-28 10:05:49'),
('post11', 'Can add new short url ?', 1, '', '2021-03-28 10:05:49'),
('post12', 'Can delete short url ?', 1, '', '2021-03-28 10:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `plugin_hook_data`
--

DROP TABLE IF EXISTS `plugin_hook_data`;
CREATE TABLE `plugin_hook_data` (
  `plugin_dir` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `hook_key` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `func_call` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plugin_mst`
--

DROP TABLE IF EXISTS `plugin_mst`;
CREATE TABLE `plugin_mst` (
  `plugin_dir` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plugin_mst`
--

INSERT INTO `plugin_mst` (`plugin_dir`, `status`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('bulletinboard', 1, '11015035', '2021-12-04 11:38:47', '2021-12-04 11:38:47'),
('bulletinboard_bbcode_collection', 1, 'root', '2021-12-04 11:38:48', '2021-12-04 11:38:48'),
('bulletinboard_bbcode_random', 1, 'root', '2021-12-04 11:38:48', '2021-12-04 11:38:48'),
('bulletinboard_bbcode_you', 1, 'root', '2021-12-04 11:38:48', '2021-12-04 11:38:48'),
('plugin_notify', 1, '11015035', '2021-10-14 08:14:37', '2021-10-14 08:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `post_cache_data`
--

DROP TABLE IF EXISTS `post_cache_data`;
CREATE TABLE `post_cache_data` (
  `post_c` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `descriptions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `parent_post_c` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `views` int(9) NOT NULL DEFAULT '0',
  `category_c` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_data`
--

DROP TABLE IF EXISTS `post_data`;
CREATE TABLE `post_data` (
  `post_c` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `friendly_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `descriptions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `post_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_post_c` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `views` int(9) NOT NULL DEFAULT '0',
  `category_c` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_data`
--

INSERT INTO `post_data` (`post_c`, `title`, `friendly_url`, `content`, `descriptions`, `keywords`, `thumbnail`, `password`, `tags`, `status`, `post_type`, `parent_post_c`, `views`, `category_c`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('59472994850914', 'What is Lorem Ipsum?', 'What_is_Lorem_Ipsum_59472994850914', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>\n', '', '', '', NULL, '', 1, '', NULL, 0, '9844612265587', '11015035', '2021-06-13 08:58:48', '2021-06-13 08:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag_data`
--

DROP TABLE IF EXISTS `post_tag_data`;
CREATE TABLE `post_tag_data` (
  `post_c` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tag` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_tag_view_data`
--

DROP TABLE IF EXISTS `post_tag_view_data`;
CREATE TABLE `post_tag_view_data` (
  `tag` varchar(255) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `post_type_data`
--

DROP TABLE IF EXISTS `post_type_data`;
CREATE TABLE `post_type_data` (
  `type_c` varchar(100) COLLATE utf8_bin NOT NULL,
  `title` varchar(155) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `post_type_data`
--

INSERT INTO `post_type_data` (`type_c`, `title`, `ent_dt`) VALUES
('normal', 'Normal', '2021-04-11 15:34:15'),
('page', 'Page', '2021-04-11 15:34:25'),
('image', 'Image', '2021-04-11 15:34:32'),
('video', 'Video', '2021-04-11 15:34:41'),
('fullwidth', 'Full Width', '2021-04-11 15:34:48'),
('news', 'News', '2021-04-11 15:34:57'),
('post', 'Post', '2021-04-11 15:35:03'),
('thread', 'Thread', '2021-04-11 15:35:11'),
('question', 'Question', '2021-04-11 15:35:18'),
('notify', 'Notify', '2021-04-11 15:35:24'),
('movie', 'Movie', '2021-04-11 15:35:32'),
('status', 'Status', '2021-04-11 15:35:38'),
('card', 'Card', '2021-04-11 15:35:43'),
('product', 'Product', '2021-04-11 15:35:49'),
('profile', 'Profile', '2021-04-11 15:35:56'),
('category', 'Category', '2021-04-11 15:37:19'),
('cart', 'Cart', '2021-04-11 15:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `post_view_data`
--

DROP TABLE IF EXISTS `post_view_data`;
CREATE TABLE `post_view_data` (
  `post_c` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_add` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting_data`
--

DROP TABLE IF EXISTS `setting_data`;
CREATE TABLE `setting_data` (
  `key_c` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `key_value` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `setting_data`
--

INSERT INTO `setting_data` (`key_c`, `title`, `key_value`, `status`) VALUES
('allow_comment', 'Allow Comments', 'yes', 1),
('default_guest_groupid', 'Default Guest Group', '11016017', 1),
('default_member_banned_groupid', 'default_member_banned_groupid', '11016014', 1),
('default_member_groupid', 'Default Member Group', '11016013', 1),
('default_member_levelid', 'Default Member Level', '11017013', 1),
('default_page', 'Default Page', '', 1),
('default_theme', 'Default Theme', 'bb_simple', 1),
('email_change_password_template', 'Change password template', '143664', 1),
('email_forgotpassword_template', 'Email forgot password template', '137454', 1),
('email_new_user_template', 'Email new user template', '124231', 1),
('email_sender', 'Sender Email', 'coffeecms@gmail.com', 1),
('email_sender_name', 'Sender Name', 'Coffee CMS', 1),
('email_smtp', 'Enable SMTP', 'no', 1),
('enable_rss', 'Enable RSS Feed', 'no', 1),
('frontend_lang ', 'Frontend Language', 'en', 1),
('is_construction', 'Is Construction', 'no', 1),
('mobile_website_url', 'Website url for mobile device', '', 1),
('post_back_when_add_new_payment', 'Postback url when add new payment', '', 1),
('post_back_when_add_new_product_success', 'Postback url when add new product success', '', 1),
('post_back_when_add_new_user', 'Postback url when have new user', '', 1),
('post_back_when_change_page_status', 'Postback url when change page status', '', 1),
('post_back_when_change_post_status', 'Postback url when change post status', '', 1),
('post_back_when_change_user_group', 'Postback url when change user group', '', 1),
('post_back_when_change_user_level', 'Postback url when change user level', '', 1),
('post_back_when_have_new_order', 'Postback url when have new order with status', '', 1),
('register_user_status', 'register_user_status', 'yes', 1),
('register_verify_email', 'register_verify_email', 'no', 1),
('require_login_if_is_guest', 'Require login if is guest', '1', 1),
('site_description', 'Descriptions', 'Site descriptions', 1),
('site_title', 'Title', 'Coffee CMS Site', 1),
('smtp_host', 'SMTP Host', 'smtp.gmail.com', 1),
('smtp_password', 'SMTP Password', '123456', 1),
('smtp_port', 'SMTP Port', '587', 1),
('smtp_username', 'SMTP Username', 'test', 1),
('system_admin_lang', 'Administrator Language', 'en', 1),
('system_category_id_len', 'System category id length', '12', 1),
('system_groupuser_id_len', 'System group user id length', '16', 1),
('system_post_id_len', 'System post id length', '12', 1),
('system_setting_cache', 'System Setting Cached', 'no', 1),
('system_status', 'system_status', 'working', 1),
('system_title', 'System title', 'Coffee CMS', 1),
('system_user_id_len', 'System user id length', '12', 1),
('tablet_website_url', 'Website url for tablet device', '', 1),
('theme_layout', 'Theme layout', 'default', 1),
('timezone', 'Timezone', 'America/Los_Angeles', 1),
('website_view_cache', 'Website View Cache', 'no', 1),
('site_keywords', 'site_keywords', 'Test', 1),
('bb_allow_socials_login', 'Allow login from socials', 'no', 1),
('bb_forum_status', 'Forum status', 'working', 1),
('bb_fb_url', 'Facebook fanpage url', '', 1),
('bb_forum_total_views', 'Total forum views', '0', 1),
('bb_github_url', 'Github url', '', 1),
('bb_thread_total_views', 'Total thread views', '0', 1),
('bb_today_total_users', 'Total users registed today', '0', 1),
('bb_total_ads', 'Total ads', '0', 1),
('bb_total_ads_activated', 'Total ads activated', '0', 1),
('bb_total_ads_pending', 'Total ads pending', '0', 1),
('bb_total_post', 'Total posts', '0', 1),
('bb_total_threads', 'Total threads', '0', 1),
('bb_total_threads_deactivate', 'Total threads deactivate', '0', 1),
('bb_total_forums', 'Total forums', '0', 1),
('bb_total_users', 'Total users', '1', 1),
('bb_total_visitors', 'Total visitors', '0', 1),
('bb_total_reactions', 'Total visitors', '0', 1),
('bb_total_shop_orders_completed', 'Total visitors', '0', 1),
('bb_total_attach_files', 'Total visitors', '0', 1),
('bb_total_messages', 'Total visitors', '0', 1),
('bb_total_user_wall_messages', 'Total visitors', '0', 1),
('bb_twitter_url', 'Twitter url', '', 1),
('bb_system_captcha_method', 'Captcha method', 'image', 1),
('bb_system_auto_detect_bot', 'Auto Bot detector', '0', 0),
('bb_system_poll', 'Allow user create poll', '1', 0),
('bb_allow_guest_view_forum', 'Allow guest view forum', '1', 0),
('bb_banned_email_status', 'Banned email status', '1', 0),
('bb_banned_ip_status', 'Banned ip status', '1', 0),
('bb_banned_users_status', 'Banned users status', '1', 0),
('bb_banned_browsers_status', 'Banned browsers status', '1', 0),
('bb_banned_os_status', 'Banned os status', '1', 0),
('bb_default_post_require_view', 'Default post url require view after login', '', 0),
('bb_firewall_require_refer_to_view_forum', 'Require refer inside to view forum', '1', 0),
('bb_thread_id_length', 'Thread id length', '12', 0),
('bb_post_id_length', 'Post id length', '12', 0),
('bb_forum_id_length', 'Forum id length', '12', 0),
('bb_message_id_length', 'Message id length', '12', 0),
('bb_latest_username', 'Latest member', 'admin', 0),
('bb_latest_user_id', 'Latest user id', '', 0),
('bb_max_number_threads_show', 'Max number threads show in forum', '30', 0),
('bb_max_number_posts_show', 'Max number posts show in thread', '10', 0),
('bb_enable_captcha_in_new_thread', 'Enable captcha in new thread', '1', 0),
('bb_enable_captcha_in_register', 'Enable captcha in new thread', '1', 0),
('bb_enable_captcha_in_login', 'Enable captcha in login page', '1', 0),
('bb_enable_news_system', 'bb_enable_news_system', '0', 0),
('bb_news_content_max_len', 'bb_news_content_max_len', '500', 0),
('bb_news_limitshow', 'bb_news_limitshow', '20', 0),
('bb_news_content_pagination', 'bb_news_content_pagination', '0', 0),
('bb_news_forums_id_show_content', 'bb_news_forums_id_show_content', '', 0),
('bb_enable_blog_system', 'bb_enable_blog_system', '0', 0),
('bb_thread_in_forum_order_by', 'bb_thread_in_forum_order_by', 'upd_dt', 0),
('bb_thread_author_info_type', 'bb_thread_author_info_type', 'vertical', 0),
('bb_site_logo', 'bb_site_logo', '', 0),
('bb_max_thread_file_size', 'bb_max_thread_file_size', '10000', 0),
('bb_max_profile_cover_image_size', 'bb_max_thread_file_size', '512', 0),
('bb_max_avatar_image_size', 'bb_max_thread_file_size', '512', 0),
('bb_max_message_receivers', 'bb_max_message_receivers', '10', 0),
('bb_enable_quick_reply', 'bb_enable_quick_reply', '1', 0),
('bb_enable_captcha_quick_reply', 'bb_enable_captcha_quick_reply', '1', 0),
('bb_enable_captcha_when_send_message', 'bb_enable_captcha_when_send_message', '1', 0),
('bb_enable_captcha_when_send_wall_message', 'bb_enable_captcha_when_send_wall_message', '1', 0),
('bb_allow_member_upload_image', 'bb_allow_member_upload_image', '1', 0),
('bb_allow_guest_access_search_page', 'bb_allow_guest_access_search_page', '0', 0),
('bb_allow_guest_download_attach_files', 'bb_allow_guest_download_attach_files', '0', 0),
('bb_allow_guest_see_member_onlines', 'bb_allow_guest_see_member_onlines', '0', 0),
('bb_show_member_online_status', 'bb_show_member_online_status', '1', 0),
('bb_allow_member_upload_attach_files', 'bb_allow_member_upload_attach_files', '1', 0),
('bb_site_icon', 'bb_site_icon', '', 0),
('bb_youtube_url', 'Youtube channel url', '', 1),
('bb_license_end_dt', 'bb_license_end_dt', '2050-01-01', 1),
('bb_license_key', 'license_key', '11111-11111-11111-11111-11111', 1),
('bb_license_key_status', 'bb_license_key_status', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shortcode_data`
--

DROP TABLE IF EXISTS `shortcode_data`;
CREATE TABLE `shortcode_data` (
  `name` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'plugin',
  `dirname` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(28) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `short_url_data`
--

DROP TABLE IF EXISTS `short_url_data`;
CREATE TABLE `short_url_data` (
  `code` varchar(30) COLLATE utf8_bin NOT NULL,
  `target_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `views` int(9) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `theme_hook_data`
--

DROP TABLE IF EXISTS `theme_hook_data`;
CREATE TABLE `theme_hook_data` (
  `theme_dir` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `hook_key` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `func_call` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theme_mst`
--

DROP TABLE IF EXISTS `theme_mst`;
CREATE TABLE `theme_mst` (
  `theme_dir` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `theme_mst`
--

INSERT INTO `theme_mst` (`theme_dir`, `status`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('bb_simple', 1, '11015035', '2021-11-07 16:30:06', '2021-11-07 16:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_api_key_data`
--

DROP TABLE IF EXISTS `user_api_key_data`;
CREATE TABLE `user_api_key_data` (
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `api_key` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_api_key_permission_data`
--

DROP TABLE IF EXISTS `user_api_key_permission_data`;
CREATE TABLE `user_api_key_permission_data` (
  `api_key` varchar(255) COLLATE utf8_bin NOT NULL,
  `permission_c` varchar(155) COLLATE utf8_bin NOT NULL,
  `insert_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_api_key_permission_mst`
--

DROP TABLE IF EXISTS `user_api_key_permission_mst`;
CREATE TABLE `user_api_key_permission_mst` (
  `permission_c` varchar(155) COLLATE utf8_bin NOT NULL,
  `permission_nm` varchar(255) COLLATE utf8_bin NOT NULL,
  `insert_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_group_mst`
--

DROP TABLE IF EXISTS `user_group_mst`;
CREATE TABLE `user_group_mst` (
  `group_c` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `left_str` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `right_str` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `priority` int(5) NOT NULL DEFAULT '0',
  `user_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_group_mst`
--

INSERT INTO `user_group_mst` (`group_c`, `title`, `left_str`, `right_str`, `status`, `priority`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('11016011', 'Administrator', '<span style=\"color:red;\">', '</span>', 1, 0, '11015035', '2021-03-28 10:01:17', '2021-03-28 10:01:17'),
('11016012', 'Moderator', '<span style=\"color:blue;\">', '</span>', 1, 2, '11015035', '2021-03-28 10:01:17', '2021-03-28 10:01:17'),
('11016013', 'User', NULL, NULL, 1, 3, '11015035', '2021-03-28 10:01:25', '2021-03-28 10:01:25'),
('11016014', 'Banned User', NULL, NULL, 1, 6, '11015035', '2021-03-28 10:01:53', '2021-03-28 10:01:53'),
('11016015', 'Pending activation user', NULL, NULL, 1, 4, '11015035', '2021-03-28 10:02:14', '2021-03-28 10:02:14'),
('11016017', 'Guest', NULL, NULL, 1, 5, '11015035', '2021-03-28 10:02:39', '2021-03-28 10:02:39'),
('11016018', 'Super Moderator', '', '', 1, 1, '11015035', '2021-11-06 10:39:12', '2021-11-06 10:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_info_data`
--

DROP TABLE IF EXISTS `user_info_data`;
CREATE TABLE `user_info_data` (
  `user_c` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'male',
  `passport` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_day` date DEFAULT NULL,
  `business_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'individual',
  `front_id_card` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `back_id_card` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_verify_id_card` int(1) NOT NULL DEFAULT '1',
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_level_mst`
--

DROP TABLE IF EXISTS `user_level_mst`;
CREATE TABLE `user_level_mst` (
  `level_id` varchar(30) COLLATE utf8_bin NOT NULL,
  `title` varchar(155) COLLATE utf8_bin NOT NULL,
  `title_left_string` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `title_right_string` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` varchar(28) COLLATE utf8_bin NOT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_level_mst`
--

INSERT INTO `user_level_mst` (`level_id`, `title`, `title_left_string`, `title_right_string`, `status`, `user_id`, `ent_dt`, `upd_dt`) VALUES
('11017011', 'Ultimate', NULL, NULL, 1, '', '2021-03-28 13:38:05', '2021-03-28 13:38:05'),
('11017012', 'Professional', NULL, NULL, 1, '', '2021-03-28 13:37:30', '2021-03-28 13:37:30'),
('11017013', 'Beginner', NULL, NULL, 1, '', '2021-03-28 13:35:20', '2021-03-28 13:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_mst`
--

DROP TABLE IF EXISTS `user_mst`;
CREATE TABLE `user_mst` (
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify_c` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_c` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_c` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pin_verify_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `left_str` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `right_str` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `forgot_password_c` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_logined` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_mst`
--

INSERT INTO `user_mst` (`user_id`, `username`, `password`, `email`, `fullname`, `avatar`, `verify_c`, `group_c`, `level_c`, `status`, `forgot_password_c`, `last_logined`, `ent_dt`, `upd_dt`) VALUES
('11015035', '{{admin_username}}', '{{admin_password}}', '{{admin_email}}', NULL, NULL, NULL, '11016011', '1101701', 1, NULL, '2021-05-17 13:33:42', '2021-05-06 16:40:54', '2021-05-06 16:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_online_data`
--

DROP TABLE IF EXISTS `user_online_data`;
CREATE TABLE `user_online_data` (
  `user_id` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_add` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ent_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_permission_menu_data`
--

DROP TABLE IF EXISTS `user_permission_menu_data`;
CREATE TABLE `user_permission_menu_data` (
  `group_c` varchar(20) COLLATE utf8_bin NOT NULL,
  `menu_type` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT 'admin',
  `menu_id` varchar(18) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_permission_menu_data`
--

INSERT INTO `user_permission_menu_data` (`group_c`, `menu_type`, `menu_id`) VALUES
('11016016', 'admin', '11011011'),
('11016016', 'admin', '11011012'),
('11016016', 'admin', '11015014'),
('11016016', 'admin', '11015011'),
('11016016', 'admin', '11015022'),
('11016016', 'admin', '11015018'),
('11016016', 'admin', '11011013'),
('11016016', 'admin', '11015016'),
('11016016', 'admin', '11015013'),
('11016016', 'admin', '11017121'),
('11016013', 'admin', '11011011'),
('11016013', 'admin', '11011012'),
('11016013', 'admin', '11015014'),
('11016013', 'admin', '11015011'),
('11016013', 'admin', '11015018'),
('11016013', 'admin', '11011013'),
('11016013', 'admin', '11015016'),
('11016013', 'admin', '11015013'),
('11016013', 'admin', '11011014'),
('11016013', 'admin', '11015424'),
('11016013', 'admin', '11011016'),
('11016013', 'admin', '11017121'),
('11016012', 'admin', '11011011'),
('11016012', 'admin', '11011012'),
('11016012', 'admin', '11015014'),
('11016012', 'admin', '11015011'),
('11016012', 'admin', '11015022'),
('11016012', 'admin', '11015018'),
('11016012', 'admin', '11011013'),
('11016012', 'admin', '11015016'),
('11016012', 'admin', '11015013'),
('11016012', 'admin', '11011014'),
('11016012', 'admin', '11015024'),
('11016012', 'admin', '11011015'),
('11016012', 'admin', '11015017'),
('11016012', 'admin', '11015020'),
('11016012', 'admin', '11011016'),
('11016012', 'admin', '11015015'),
('11016012', 'admin', '11015026'),
('11016012', 'admin', '11015025'),
('11016012', 'admin', '11015019'),
('11016012', 'admin', '11011017'),
('11016012', 'admin', '11015023'),
('11016012', 'admin', '11011018'),
('11016012', 'admin', '11015012'),
('11016012', 'admin', '11015021'),
('11016012', 'admin', '11017021'),
('11016012', 'admin', '11017121'),
('11016012', 'admin', '11015027'),
('11016012', 'admin', '11015034'),
('11016012', 'admin', '11015030'),
('11016012', 'admin', '11015035'),
('11016012', 'admin', '11015028'),
('11016012', 'admin', '11015029'),
('11016012', 'admin', '11015031'),
('11016012', 'admin', '11015032'),
('925680128', 'admin', '11011011'),
('925680128', 'admin', '11011012'),
('925680128', 'admin', '11015014'),
('925680128', 'admin', '11015011'),
('925680128', 'admin', '11015022'),
('925680128', 'admin', '11015018'),
('925680128', 'admin', '11011013'),
('925680128', 'admin', '11015016'),
('925680128', 'admin', '11015013'),
('925680128', 'admin', '11011014'),
('925680128', 'admin', '11015024'),
('925680128', 'admin', '11015424'),
('925680128', 'admin', '11011015'),
('925680128', 'admin', '11015017'),
('925680128', 'admin', '11015020'),
('925680128', 'admin', '11016117'),
('925680128', 'admin', '11011016'),
('925680128', 'admin', '11015015'),
('925680128', 'admin', '11015026'),
('925680128', 'admin', '11015025'),
('925680128', 'admin', '11015019'),
('925680128', 'admin', '11011017'),
('925680128', 'admin', '11015023'),
('925680128', 'admin', '11015123'),
('925680128', 'admin', '11011018'),
('925680128', 'admin', '11015012'),
('925680128', 'admin', '11015021'),
('925680128', 'admin', '11017021'),
('925680128', 'admin', '11017121'),
('925680128', 'admin', '11015027'),
('925680128', 'admin', '11015034'),
('925680128', 'admin', '11015030'),
('925680128', 'admin', '11015035'),
('925680128', 'admin', '11015028'),
('925680128', 'admin', '11015029'),
('925680128', 'admin', '11015031'),
('925680128', 'admin', '11015032'),
('11016011', 'admin', '11011011'),
('11016011', 'admin', '11011012'),
('11016011', 'admin', '11011013'),
('11016011', 'admin', '11011014'),
('11016011', 'admin', '11011015'),
('11016011', 'admin', '11011016'),
('11016011', 'admin', '11011017'),
('11016011', 'admin', '11011018'),
('11016011', 'admin', '11015011'),
('11016011', 'admin', '11015012'),
('11016011', 'admin', '11015013'),
('11016011', 'admin', '11015014'),
('11016011', 'admin', '11015015'),
('11016011', 'admin', '11015016'),
('11016011', 'admin', '11015017'),
('11016011', 'admin', '11015018'),
('11016011', 'admin', '11015019'),
('11016011', 'admin', '11015020'),
('11016011', 'admin', '11015021'),
('11016011', 'admin', '11015022'),
('11016011', 'admin', '11015023'),
('11016011', 'admin', '11015024'),
('11016011', 'admin', '11015025'),
('11016011', 'admin', '11015026'),
('11016011', 'admin', '11015027'),
('11016011', 'admin', '11015028'),
('11016011', 'admin', '11015029'),
('11016011', 'admin', '11015030'),
('11016011', 'admin', '11015031'),
('11016011', 'admin', '11015032'),
('11016011', 'admin', '11015034'),
('11016011', 'admin', '11015035'),
('11016011', 'admin', '11015123'),
('11016011', 'admin', '11015424'),
('11016011', 'admin', '11016117'),
('11016011', 'admin', '11017021'),
('11016011', 'admin', '11017121');

-- --------------------------------------------------------

--
-- Table structure for table `user_prefix_data`
--

DROP TABLE IF EXISTS `user_prefix_data`;
CREATE TABLE `user_prefix_data` (
  `user_id` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `prefix` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ent_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities_data`
--
ALTER TABLE `activities_data`
  ADD KEY `ix1` (`activity_c`),
  ADD KEY `ix2` (`user_id`),
  ADD KEY `ix3` (`ent_dt`);

--
-- Indexes for table `admin_menu_data`
--
ALTER TABLE `admin_menu_data`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `parent_menu_id` (`parent_menu_id`),
  ADD KEY `title` (`title`),
  ADD KEY `plugin_name` (`plugin_name`),
  ADD KEY `is_url` (`is_url`);

--
-- Indexes for table `bb_ads_thread_data`
--
ALTER TABLE `bb_ads_thread_data`
  ADD PRIMARY KEY (`ads_id`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `ads_id` (`ads_id`),
  ADD KEY `start_date` (`start_date`),
  ADD KEY `end_date` (`end_date`),
  ADD KEY `status` (`status`),
  ADD KEY `method` (`method`),
  ADD KEY `sort_order` (`sort_order`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `forum_id` (`forum_id`);

--
-- Indexes for table `bb_alert_data`
--
ALTER TABLE `bb_alert_data`
  ADD PRIMARY KEY (`alert_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `bb_annoucement_data`
--
ALTER TABLE `bb_annoucement_data`
  ADD KEY `a_id` (`a_id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `status` (`status`),
  ADD KEY `upd_dt` (`upd_dt`);

--
-- Indexes for table `bb_banned_browser_data`
--
ALTER TABLE `bb_banned_browser_data`
  ADD PRIMARY KEY (`browser_name`),
  ADD KEY `browser_name` (`browser_name`);

--
-- Indexes for table `bb_banned_ip_data`
--
ALTER TABLE `bb_banned_ip_data`
  ADD PRIMARY KEY (`ip_address`),
  ADD KEY `ip_address` (`ip_address`);

--
-- Indexes for table `bb_banned_os_data`
--
ALTER TABLE `bb_banned_os_data`
  ADD PRIMARY KEY (`os_name`),
  ADD KEY `os_name` (`os_name`);

--
-- Indexes for table `bb_banned_user_data`
--
ALTER TABLE `bb_banned_user_data`
  ADD KEY `data_method` (`data_method`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `bb_bbcode_data`
--
ALTER TABLE `bb_bbcode_data`
  ADD PRIMARY KEY (`bbcode_id`),
  ADD KEY `bbcode_id` (`bbcode_id`),
  ADD KEY `tagname` (`tagname`),
  ADD KEY `status` (`status`),
  ADD KEY `upd_dt` (`upd_dt`);

--
-- Indexes for table `bb_bbcode_hide_pay_data`
--
ALTER TABLE `bb_bbcode_hide_pay_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_type` (`data_type`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `pay_method` (`pay_method`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `buyer_id` (`buyer_id`),
  ADD KEY `status` (`status`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `bb_bot_detect_data`
--
ALTER TABLE `bb_bot_detect_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bb_buy_usergroup_data`
--
ALTER TABLE `bb_buy_usergroup_data`
  ADD KEY `target_user_id` (`target_user_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `start_date` (`start_date`),
  ADD KEY `end_date` (`end_date`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `bb_capcha_questions_data`
--
ALTER TABLE `bb_capcha_questions_data`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `status` (`status`),
  ADD KEY `upd_dt` (`upd_dt`);

--
-- Indexes for table `bb_captcha_image_session_data`
--
ALTER TABLE `bb_captcha_image_session_data`
  ADD KEY `session_id` (`session_id`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `bb_captcha_session_data`
--
ALTER TABLE `bb_captcha_session_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `captcha_id` (`captcha_id`),
  ADD KEY `answer` (`answer`);

--
-- Indexes for table `bb_category_mst`
--
ALTER TABLE `bb_category_mst`
  ADD PRIMARY KEY (`category_c`),
  ADD KEY `ix1` (`category_c`),
  ADD KEY `ix2` (`title`),
  ADD KEY `ix3` (`friendly_url`),
  ADD KEY `ix4` (`status`),
  ADD KEY `sort_order` (`sort_order`),
  ADD KEY `upd_dt` (`upd_dt`),
  ADD KEY `views` (`views`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bb_disallow_word_data`
--
ALTER TABLE `bb_disallow_word_data`
  ADD PRIMARY KEY (`word`);

--
-- Indexes for table `bb_forum_data`
--
ALTER TABLE `bb_forum_data`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `status` (`status`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `upd_dt` (`upd_dt`),
  ADD KEY `forum_type` (`forum_type`),
  ADD KEY `sort_order` (`sort_order`),
  ADD KEY `last_post_author` (`last_post_author`),
  ADD KEY `last_thread_author_username` (`last_thread_author_username`);

--
-- Indexes for table `bb_forum_message_data`
--
ALTER TABLE `bb_forum_message_data`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bb_forum_usergroup_permission_data`
--
ALTER TABLE `bb_forum_usergroup_permission_data`
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `bb_forum_user_permission_data`
--
ALTER TABLE `bb_forum_user_permission_data`
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bb_hook_content_key_data`
--
ALTER TABLE `bb_hook_content_key_data`
  ADD PRIMARY KEY (`key_c`),
  ADD KEY `key_c` (`key_c`);

--
-- Indexes for table `bb_html_global_data`
--
ALTER TABLE `bb_html_global_data`
  ADD PRIMARY KEY (`html_c`),
  ADD KEY `html_c` (`html_c`),
  ADD KEY `status` (`status`),
  ADD KEY `upd_dt` (`upd_dt`);

--
-- Indexes for table `bb_message_ads_data`
--
ALTER TABLE `bb_message_ads_data`
  ADD PRIMARY KEY (`ads_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `message_id` (`message_id`);

--
-- Indexes for table `bb_message_attach_files_data`
--
ALTER TABLE `bb_message_attach_files_data`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `file_size` (`file_size`),
  ADD KEY `file_path` (`file_path`),
  ADD KEY `views` (`views`),
  ADD KEY `last_download` (`last_download`),
  ADD KEY `file_type` (`file_type`),
  ADD KEY `file_name` (`file_name`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `bb_message_data`
--
ALTER TABLE `bb_message_data`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `subject` (`subject`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `username` (`username`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `is_read` (`is_read`);

--
-- Indexes for table `bb_message_user_data`
--
ALTER TABLE `bb_message_user_data`
  ADD KEY `message_id` (`message_id`),
  ADD KEY `target_username` (`target_username`),
  ADD KEY `target_user_id` (`target_user_id`),
  ADD KEY `source_user_id` (`source_user_id`);

--
-- Indexes for table `bb_notifies_data`
--
ALTER TABLE `bb_notifies_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bb_notifies_user_data`
--
ALTER TABLE `bb_notifies_user_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bb_payment_data`
--
ALTER TABLE `bb_payment_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `bb_poll_answer_data`
--
ALTER TABLE `bb_poll_answer_data`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `answer_id` (`answer_id`),
  ADD KEY `poll_id` (`poll_id`),
  ADD KEY `sort_order` (`sort_order`);

--
-- Indexes for table `bb_poll_data`
--
ALTER TABLE `bb_poll_data`
  ADD PRIMARY KEY (`poll_id`),
  ADD KEY `poll_id` (`poll_id`),
  ADD KEY `status` (`status`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `upd_dt` (`upd_dt`),
  ADD KEY `end_dt` (`end_dt`),
  ADD KEY `thread_id` (`thread_id`);

--
-- Indexes for table `bb_poll_member_answer_data`
--
ALTER TABLE `bb_poll_member_answer_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poll_id` (`poll_id`),
  ADD KEY `is_guest` (`is_guest`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `answer_id` (`answer_id`),
  ADD KEY `visitor_hash` (`visitor_hash`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `bb_posts_data`
--
ALTER TABLE `bb_posts_data`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `upd_dt` (`upd_dt`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `sort_order` (`sort_order`),
  ADD KEY `total_reactions` (`total_reactions`),
  ADD KEY `has_attach_files` (`has_attach_files`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `friendly_url` (`friendly_url`);

--
-- Indexes for table `bb_post_attach_files_data`
--
ALTER TABLE `bb_post_attach_files_data`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `file_size` (`file_size`),
  ADD KEY `file_path` (`file_path`),
  ADD KEY `views` (`views`),
  ADD KEY `last_download` (`last_download`),
  ADD KEY `file_type` (`file_type`),
  ADD KEY `file_name` (`file_name`);

--
-- Indexes for table `bb_post_prefix_data`
--
ALTER TABLE `bb_post_prefix_data`
  ADD PRIMARY KEY (`prefix_id`),
  ADD KEY `prefix_id` (`prefix_id`),
  ADD KEY `status` (`status`),
  ADD KEY `title` (`title`),
  ADD KEY `upd_dt` (`upd_dt`);

--
-- Indexes for table `bb_post_reactions_count_data`
--
ALTER TABLE `bb_post_reactions_count_data`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `total` (`total`),
  ADD KEY `reaction_id` (`reaction_id`);

--
-- Indexes for table `bb_post_reactions_data`
--
ALTER TABLE `bb_post_reactions_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `reaction_id` (`reaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reaction_text` (`reaction_text`);

--
-- Indexes for table `bb_post_tag_data`
--
ALTER TABLE `bb_post_tag_data`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `tag` (`tag`);

--
-- Indexes for table `bb_ranks_data`
--
ALTER TABLE `bb_ranks_data`
  ADD PRIMARY KEY (`rank_id`),
  ADD KEY `rank_id` (`rank_id`),
  ADD KEY `status` (`status`),
  ADD KEY `upd_dt` (`upd_dt`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `bb_reaction_data`
--
ALTER TABLE `bb_reaction_data`
  ADD PRIMARY KEY (`reaction_id`),
  ADD KEY `reaction_id` (`reaction_id`),
  ADD KEY `status` (`status`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `sort_order` (`sort_order`);

--
-- Indexes for table `bb_report_page_data`
--
ALTER TABLE `bb_report_page_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `bb_shop_cart_data`
--
ALTER TABLE `bb_shop_cart_data`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bb_shop_orders_data`
--
ALTER TABLE `bb_shop_orders_data`
  ADD KEY `upd_dt` (`upd_dt`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `status` (`status`),
  ADD KEY `payer_id` (`payer_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_title` (`product_title`);

--
-- Indexes for table `bb_shop_payment_method_data`
--
ALTER TABLE `bb_shop_payment_method_data`
  ADD KEY `payment_method` (`payment_method`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `bb_smiles_category_data`
--
ALTER TABLE `bb_smiles_category_data`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `status` (`status`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `bb_smiles_data`
--
ALTER TABLE `bb_smiles_data`
  ADD PRIMARY KEY (`smile_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `smile_id` (`smile_id`),
  ADD KEY `sort_order` (`sort_order`);

--
-- Indexes for table `bb_smile_most_recent_data`
--
ALTER TABLE `bb_smile_most_recent_data`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `bb_threads_data`
--
ALTER TABLE `bb_threads_data`
  ADD PRIMARY KEY (`thread_id`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `views` (`views`),
  ADD KEY `status` (`status`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `upd_dt` (`upd_dt`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `is_stick` (`is_stick`),
  ADD KEY `title` (`title`),
  ADD KEY `tags` (`tags`),
  ADD KEY `author` (`author`),
  ADD KEY `last_approved_time` (`last_approved_time`),
  ADD KEY `last_approved_username` (`last_approved_username`),
  ADD KEY `last_username_reply` (`last_username_reply`),
  ADD KEY `last_repy_time` (`last_repy_time`),
  ADD KEY `total_replies` (`total_replies`),
  ADD KEY `sort_order` (`sort_order`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `prefix_id` (`prefix_id`),
  ADD KEY `total_reactions` (`total_reactions`),
  ADD KEY `has_attach_files` (`has_attach_files`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `bb_threads_reactions_data`
--
ALTER TABLE `bb_threads_reactions_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reaction_id` (`reaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reaction_text` (`reaction_text`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `bb_thread_attach_files_data`
--
ALTER TABLE `bb_thread_attach_files_data`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `file_size` (`file_size`),
  ADD KEY `file_path` (`file_path`),
  ADD KEY `views` (`views`),
  ADD KEY `last_download` (`last_download`),
  ADD KEY `file_type` (`file_type`),
  ADD KEY `file_name` (`file_name`),
  ADD KEY `data_type` (`data_type`);

--
-- Indexes for table `bb_thread_tag_data`
--
ALTER TABLE `bb_thread_tag_data`
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `tag` (`tag`);

--
-- Indexes for table `bb_thread_transfer_data`
--
ALTER TABLE `bb_thread_transfer_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_type` (`data_type`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `target_user_id` (`target_user_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `transfer_method` (`transfer_method`);

--
-- Indexes for table `bb_usergroup_ranks_data`
--
ALTER TABLE `bb_usergroup_ranks_data`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `rank_id` (`rank_id`);

--
-- Indexes for table `bb_users_rank_data`
--
ALTER TABLE `bb_users_rank_data`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `rank_id` (`rank_id`);

--
-- Indexes for table `bb_user_bookmarks_data`
--
ALTER TABLE `bb_user_bookmarks_data`
  ADD PRIMARY KEY (`bookmark_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bb_visitor_views_data`
--
ALTER TABLE `bb_visitor_views_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_url` (`page_url`),
  ADD KEY `username` (`username`),
  ADD KEY `ip_address` (`ip_address`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `cache_data`
--
ALTER TABLE `cache_data`
  ADD KEY `ix1` (`cache_id`),
  ADD KEY `ix2` (`cache_key`),
  ADD KEY `ix3` (`ent_dt`),
  ADD KEY `ix4` (`plugin_c`),
  ADD KEY `ix5` (`theme_c`);

--
-- Indexes for table `calendar_data`
--
ALTER TABLE `calendar_data`
  ADD PRIMARY KEY (`calendar_id`),
  ADD KEY `calendar_id` (`calendar_id`),
  ADD KEY `start_dt` (`start_dt`),
  ADD KEY `end_dt` (`end_dt`),
  ADD KEY `all_day` (`all_day`),
  ADD KEY `status` (`status`),
  ADD KEY `color_c` (`color_c`);

--
-- Indexes for table `calendar_group`
--
ALTER TABLE `calendar_group`
  ADD PRIMARY KEY (`group_c`),
  ADD KEY `group_c` (`group_c`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `category_mst`
--
ALTER TABLE `category_mst`
  ADD PRIMARY KEY (`category_c`),
  ADD KEY `ix1` (`category_c`),
  ADD KEY `ix2` (`title`),
  ADD KEY `ix3` (`friendly_url`),
  ADD KEY `ix4` (`status`),
  ADD KEY `sort_order` (`sort_order`),
  ADD KEY `upd_dt` (`upd_dt`),
  ADD KEY `views` (`views`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comment_data`
--
ALTER TABLE `comment_data`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `ix1` (`comment_id`),
  ADD KEY `ix2` (`post_id`),
  ADD KEY `ix4` (`owner_id`),
  ADD KEY `ix6` (`ent_dt`),
  ADD KEY `ix7` (`parent_comment_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `contact_data`
--
ALTER TABLE `contact_data`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `ix1` (`ip`),
  ADD KEY `ix2` (`contact_id`),
  ADD KEY `ix3` (`user_agent`),
  ADD KEY `ix5` (`ent_dt`);

--
-- Indexes for table `cronjob_data`
--
ALTER TABLE `cronjob_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `cronjob_log_data`
--
ALTER TABLE `cronjob_log_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `emailmarketing_email_data`
--
ALTER TABLE `emailmarketing_email_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `emailmarketing_group_data`
--
ALTER TABLE `emailmarketing_group_data`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `upd_dt` (`upd_dt`);

--
-- Indexes for table `emailmarketing_jobs_data`
--
ALTER TABLE `emailmarketing_jobs_data`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `template_id` (`template_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `total_email` (`total_email`),
  ADD KEY `total_readed` (`total_readed`),
  ADD KEY `total_sended` (`total_sended`);

--
-- Indexes for table `emailmarketing_sent_data`
--
ALTER TABLE `emailmarketing_sent_data`
  ADD PRIMARY KEY (`send_id`),
  ADD KEY `send_id` (`send_id`),
  ADD KEY `to_email` (`to_email`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `status` (`status`),
  ADD KEY `is_readed` (`is_readed`);

--
-- Indexes for table `emailmarketing_unsubscrible_data`
--
ALTER TABLE `emailmarketing_unsubscrible_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `email_sent_data`
--
ALTER TABLE `email_sent_data`
  ADD PRIMARY KEY (`send_id`),
  ADD KEY `send_id` (`send_id`),
  ADD KEY `template_id` (`template_id`),
  ADD KEY `to_email` (`to_email`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `email_template_data`
--
ALTER TABLE `email_template_data`
  ADD PRIMARY KEY (`template_id`),
  ADD KEY `template_id` (`template_id`),
  ADD KEY `title` (`title`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `upd_dt` (`upd_dt`),
  ADD KEY `subject` (`subject`);

--
-- Indexes for table `group_permission_data`
--
ALTER TABLE `group_permission_data`
  ADD KEY `ix1` (`group_c`),
  ADD KEY `ix2` (`permission_c`);

--
-- Indexes for table `kanban_board_comment_data`
--
ALTER TABLE `kanban_board_comment_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `kanban_board_data`
--
ALTER TABLE `kanban_board_data`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `board_c` (`board_c`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `percent` (`percent`),
  ADD KEY `sort_order` (`sort_order`);

--
-- Indexes for table `kanban_board_mst`
--
ALTER TABLE `kanban_board_mst`
  ADD PRIMARY KEY (`board_c`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sort_order` (`sort_order`),
  ADD KEY `project_c` (`project_c`);

--
-- Indexes for table `kanban_board_project_mst`
--
ALTER TABLE `kanban_board_project_mst`
  ADD PRIMARY KEY (`project_c`),
  ADD KEY `status` (`status`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `upd_dt` (`upd_dt`);

--
-- Indexes for table `kanban_task_checklist_data`
--
ALTER TABLE `kanban_task_checklist_data`
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `check_id` (`check_id`);

--
-- Indexes for table `kanban_task_comment_data`
--
ALTER TABLE `kanban_task_comment_data`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `kanban_task_data`
--
ALTER TABLE `kanban_task_data`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `project_c` (`project_c`),
  ADD KEY `assigned_to` (`assigned_to`),
  ADD KEY `progress` (`progress`),
  ADD KEY `start_date` (`start_date`),
  ADD KEY `end_date` (`end_date`),
  ADD KEY `status` (`status`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `upd_dt` (`upd_dt`);

--
-- Indexes for table `kanboard_category_mst`
--
ALTER TABLE `kanboard_category_mst`
  ADD PRIMARY KEY (`category_c`),
  ADD KEY `ix1` (`category_c`),
  ADD KEY `ix2` (`title`),
  ADD KEY `ix3` (`friendly_url`),
  ADD KEY `ix4` (`status`),
  ADD KEY `sort_order` (`sort_order`),
  ADD KEY `upd_dt` (`upd_dt`),
  ADD KEY `views` (`views`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `language_mst`
--
ALTER TABLE `language_mst`
  ADD PRIMARY KEY (`code`),
  ADD KEY `code` (`code`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `media_data`
--
ALTER TABLE `media_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ix1` (`id`),
  ADD KEY `name` (`file_path`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ent_dt` (`ent_dt`),
  ADD KEY `name_2` (`name`);

--
-- Indexes for table `menu_data`
--
ALTER TABLE `menu_data`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `parent_menu_id` (`parent_menu_id`),
  ADD KEY `title` (`title`),
  ADD KEY `plugin_name` (`menu_type`),
  ADD KEY `is_url` (`is_url`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `message_data`
--
ALTER TABLE `message_data`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `ix1` (`is_guest`),
  ADD KEY `ix2` (`subject`),
  ADD KEY `ix4` (`ent_dt`),
  ADD KEY `ix5` (`to_user_id`),
  ADD KEY `ix6` (`message_id`),
  ADD KEY `user_id` (`user_id`);
ALTER TABLE `message_data` ADD FULLTEXT KEY `fl1` (`content`);

--
-- Indexes for table `newsletter_data`
--
ALTER TABLE `newsletter_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_agent` (`user_agent`),
  ADD KEY `ent_dt` (`ent_dt`);

--
-- Indexes for table `options_data`
--
ALTER TABLE `options_data`
  ADD KEY `option_c` (`option_c`),
  ADD KEY `target_id` (`target_id`);

--
-- Indexes for table `options_mst`
--
ALTER TABLE `options_mst`
  ADD PRIMARY KEY (`option_c`),
  ADD KEY `ix1` (`option_c`),
  ADD KEY `ix2` (`option_type`);

--
-- Indexes for table `page_data`
--
ALTER TABLE `page_data`
  ADD PRIMARY KEY (`page_c`),
  ADD KEY `ix1` (`page_c`),
  ADD KEY `ix2` (`title`),
  ADD KEY `ix3` (`friendly_url`),
  ADD KEY `ix7` (`status`),
  ADD KEY `ox10` (`ent_dt`),
  ADD KEY `ic2` (`page_type`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `views` (`views`),
  ADD KEY `password` (`password`);

--
-- Indexes for table `permissions_mst`
--
ALTER TABLE `permissions_mst`
  ADD PRIMARY KEY (`permission_c`),
  ADD KEY `ix1` (`permission_c`),
  ADD KEY `ix2` (`status`),
  ADD KEY `title` (`title`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `plugin_hook_data`
--
ALTER TABLE `plugin_hook_data`
  ADD KEY `ix1` (`plugin_dir`),
  ADD KEY `ix2` (`hook_key`),
  ADD KEY `ix3` (`status`);

--
-- Indexes for table `plugin_mst`
--
ALTER TABLE `plugin_mst`
  ADD PRIMARY KEY (`plugin_dir`),
  ADD KEY `ix1` (`plugin_dir`),
  ADD KEY `ix2` (`status`);

--
-- Indexes for table `post_cache_data`
--
ALTER TABLE `post_cache_data`
  ADD KEY `ix1` (`post_c`),
  ADD KEY `ix2` (`title`),
  ADD KEY `ix3` (`friendly_url`),
  ADD KEY `ix6` (`tags`),
  ADD KEY `ix7` (`status`),
  ADD KEY `ix9` (`parent_post_c`),
  ADD KEY `ox10` (`ent_dt`),
  ADD KEY `ix11` (`category_c`);

--
-- Indexes for table `post_data`
--
ALTER TABLE `post_data`
  ADD PRIMARY KEY (`post_c`),
  ADD KEY `ix1` (`post_c`),
  ADD KEY `ix2` (`title`),
  ADD KEY `ix3` (`friendly_url`),
  ADD KEY `ix6` (`tags`),
  ADD KEY `ix7` (`status`),
  ADD KEY `ix9` (`parent_post_c`),
  ADD KEY `ox10` (`ent_dt`),
  ADD KEY `ix11` (`category_c`),
  ADD KEY `post_type` (`post_type`),
  ADD KEY `views` (`views`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `password` (`password`),
  ADD KEY `upd_dt` (`upd_dt`);

--
-- Indexes for table `post_tag_data`
--
ALTER TABLE `post_tag_data`
  ADD KEY `ix1` (`post_c`),
  ADD KEY `ix2` (`tag`);

--
-- Indexes for table `post_tag_view_data`
--
ALTER TABLE `post_tag_view_data`
  ADD KEY `ix1` (`tag`),
  ADD KEY `ix2` (`ent_dt`);

--
-- Indexes for table `post_type_data`
--
ALTER TABLE `post_type_data`
  ADD KEY `ix1` (`type_c`),
  ADD KEY `ix2` (`ent_dt`);

--
-- Indexes for table `post_view_data`
--
ALTER TABLE `post_view_data`
  ADD KEY `ix1` (`post_c`),
  ADD KEY `ix3` (`user_agent`),
  ADD KEY `ix4` (`ip_add`),
  ADD KEY `ix5` (`ent_dt`);

--
-- Indexes for table `user_group_mst`
--
ALTER TABLE `user_group_mst`
  ADD PRIMARY KEY (`group_c`),
  ADD KEY `group_c` (`group_c`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `user_mst`
--
ALTER TABLE `user_mst`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `username` (`username`),
  ADD KEY `status` (`status`),
  ADD KEY `email` (`email`),
  ADD KEY `group_c` (`group_c`),
  ADD KEY `level_c` (`level_c`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bb_alert_data`
--
ALTER TABLE `bb_alert_data`
  MODIFY `alert_id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bb_bbcode_hide_pay_data`
--
ALTER TABLE `bb_bbcode_hide_pay_data`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bb_bot_detect_data`
--
ALTER TABLE `bb_bot_detect_data`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bb_capcha_questions_data`
--
ALTER TABLE `bb_capcha_questions_data`
  MODIFY `question_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bb_captcha_session_data`
--
ALTER TABLE `bb_captcha_session_data`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bb_message_ads_data`
--
ALTER TABLE `bb_message_ads_data`
  MODIFY `ads_id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bb_notifies_user_data`
--
ALTER TABLE `bb_notifies_user_data`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bb_payment_data`
--
ALTER TABLE `bb_payment_data`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bb_poll_member_answer_data`
--
ALTER TABLE `bb_poll_member_answer_data`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bb_post_reactions_data`
--
ALTER TABLE `bb_post_reactions_data`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bb_report_page_data`
--
ALTER TABLE `bb_report_page_data`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bb_threads_reactions_data`
--
ALTER TABLE `bb_threads_reactions_data`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bb_thread_transfer_data`
--
ALTER TABLE `bb_thread_transfer_data`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bb_user_bookmarks_data`
--
ALTER TABLE `bb_user_bookmarks_data`
  MODIFY `bookmark_id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bb_visitor_views_data`
--
ALTER TABLE `bb_visitor_views_data`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
