-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 14, 2021 at 12:49 AM
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
-- Database: `coffeecms`
--

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
('4355292', 'Help', '#F23412', 1, '11015035', '2021-09-11 09:34:30', '2021-09-11 09:34:30'),
('5405054', 'Bug', '#8F8F8F', 1, '11015035', '2021-09-11 09:35:10', '2021-09-11 09:35:10'),
('6654585', 'Free', '#2DBA60', 1, '11015035', '2021-09-11 09:35:25', '2021-09-11 09:35:25'),
('8459333', 'Question', '#F19425', 1, '11015035', '2021-09-11 09:35:51', '2021-09-11 09:35:51'),
('1102911', 'Normal', '#F19425', 1, '11015035', '2021-09-11 09:35:51', '2021-09-11 09:35:51'),
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

--
-- Dumping data for table `bb_threads_data`
--

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

--
-- Dumping data for table `bb_user_follow_data`
--

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

--
-- Indexes for dumped tables
--

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
-- Indexes for table `bb_chatbox_data`
--

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
