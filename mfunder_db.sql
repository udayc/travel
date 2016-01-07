-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2015 at 03:11 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mfunder_db`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `core_config_data`(settings_key VARCHAR(250)) RETURNS varchar(200) CHARSET utf8mb4
BEGIN
  RETURN (SELECT `config_value` FROM core_config_data WHERE `config_key` = settings_key );
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getCoreConfigData`(settings_key VARCHAR(250)) RETURNS varchar(200) CHARSET utf8mb4
BEGIN
  RETURN (SELECT `config_value` FROM core_config_data WHERE `config_key` = settings_key );
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `activity_project_views`
--

CREATE TABLE IF NOT EXISTS `activity_project_views` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `P_ID` int(10) unsigned NOT NULL,
  `U_ID` int(10) unsigned NOT NULL,
  `hostname` varchar(128) NOT NULL,
  `viewd_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `view_type` varchar(100) NOT NULL DEFAULT 'Normal',
  PRIMARY KEY (`id`),
  KEY `P_ID` (`P_ID`),
  KEY `U_ID` (`U_ID`),
  KEY `U_ID_2` (`U_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `core_config_data`
--

CREATE TABLE IF NOT EXISTS `core_config_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `config_key` varchar(250) NOT NULL,
  `config_label` varchar(250) NOT NULL,
  `config_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `core_config_data`
--

INSERT INTO `core_config_data` (`id`, `config_key`, `config_label`, `config_value`) VALUES
(1, 'site_name', 'Site Name', 'Music Funder'),
(2, 'from_email_address', 'From Email Address', 'arnab@matrixnmedia.com'),
(3, 'reply_email_address', 'Reply To Email Address', ''),
(4, 'no_reply_address', 'No Reply Email Address', 'noreply@musicfunder.com'),
(5, 'contact_email', 'Contact email address', 'contact@musicfunder.com'),
(6, 'captcha_type', 'CAPTCHA Type', 'Normal'),
(7, 'site_default_language', 'Site language', 'en'),
(8, 'site_currency_symbol', 'Site Currency Symbol', '$'),
(9, 'currency', 'Currency', 'USD'),
(10, 'date_format', 'Date Format', '%b %d, %Y'),
(11, 'time_format', 'Time Format', '%I:%M %p'),
(12, 'date_time_format', 'Date-Time Format', '%b %d, %Y %I:%M %p');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_09_01_101840_add_field_to_users', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `P_CAT_ID` int(10) unsigned NOT NULL COMMENT 'PROJECT-CAT-ID(FK)',
  `short_description` text NOT NULL,
  `file_attachment` varchar(250) NOT NULL,
  `payment_method` int(10) NOT NULL,
  `funding_goal` double(10,2) NOT NULL,
  `allow_overfunding` tinyint(1) NOT NULL,
  `funding_end_date` date NOT NULL,
  `linkedIn_url` varchar(255) NOT NULL,
  `twitter_url` varchar(255) NOT NULL,
  `myspace_url` varchar(255) NOT NULL,
  `homepage_url` varchar(255) NOT NULL,
  `facebook_url` varchar(255) NOT NULL,
  `imdb_url` varchar(250) NOT NULL,
  `details_description` text NOT NULL,
  `address` varchar(250) NOT NULL,
  `address_alternate` varchar(250) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `country` int(10) NOT NULL,
  `feed_url` varchar(255) NOT NULL,
  `external_video_url` varchar(255) NOT NULL,
  `media_file_attachment` varchar(255) NOT NULL,
  `media_file_short_note` varchar(255) NOT NULL,
  `U_ID` int(10) unsigned NOT NULL COMMENT 'USER_ID(FK)',
  `status` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`U_ID`),
  KEY `project_category_id` (`P_CAT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_backer_rewards`
--

CREATE TABLE IF NOT EXISTS `project_backer_rewards` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pledge_amount` double(10,2) NOT NULL,
  `short_note` varchar(255) NOT NULL,
  `estimated_delivery` date NOT NULL,
  `shipping_details` varchar(250) NOT NULL,
  `user_limit` int(10) unsigned NOT NULL DEFAULT '1',
  `P_ID` int(10) unsigned NOT NULL COMMENT 'PROJECT-ID(Foreign-Key)',
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `P_ID` (`P_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

CREATE TABLE IF NOT EXISTS `project_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `parent_id` int(10) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_followers`
--

CREATE TABLE IF NOT EXISTS `project_followers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `P_ID` int(10) unsigned NOT NULL,
  `U_ID` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `P_ID` (`P_ID`),
  KEY `U_ID` (`U_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_funds`
--

CREATE TABLE IF NOT EXISTS `project_funds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `P_ID` int(10) unsigned NOT NULL COMMENT 'PROJECT-ID(Foreign-Key)',
  `U_ID` int(10) unsigned NOT NULL COMMENT 'Backers',
  `paid_amount` double(10,2) NOT NULL,
  `amount_to_project_owner` double(10,2) NOT NULL COMMENT 'Amount paid to project owner',
  `site_commission` double(10,2) NOT NULL,
  `funded_on` date NOT NULL,
  `status` char(10) NOT NULL COMMENT 'Pledged | Funded | Refunded | Cancelled',
  PRIMARY KEY (`id`),
  KEY `P_ID` (`P_ID`),
  KEY `U_ID` (`U_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_updates`
--

CREATE TABLE IF NOT EXISTS `project_updates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tags` varchar(250) NOT NULL,
  `P_ID` int(10) unsigned NOT NULL,
  `U_ID` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1-Active , 2-Suspended ,3-Flag',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `P_ID` (`P_ID`,`U_ID`),
  KEY `P_ID_2` (`P_ID`),
  KEY `U_ID` (`U_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_update_comments`
--

CREATE TABLE IF NOT EXISTS `project_update_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_body` text NOT NULL,
  `P_ID` int(10) unsigned NOT NULL COMMENT 'PROJECT-ID(Foreign-Key)',
  `U_ID` int(10) unsigned NOT NULL COMMENT 'USER-ID(Foreign-Key)',
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `P_ID` (`P_ID`,`U_ID`),
  KEY `U_ID` (`U_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_votings`
--

CREATE TABLE IF NOT EXISTS `project_votings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `P_ID` int(10) unsigned NOT NULL COMMENT 'PROJECT-ID(Foreign-Key)',
  `U_ID` int(10) unsigned NOT NULL COMMENT 'USER-ID(Foreign-Key)',
  `score` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `P_ID` (`P_ID`,`U_ID`),
  KEY `U_ID` (`U_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `site_activities`
--

CREATE TABLE IF NOT EXISTS `site_activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `U_ID` int(10) NOT NULL DEFAULT '0',
  `message` longtext NOT NULL,
  `hostname` varchar(128) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `U_ID` (`U_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `U_ID` int(10) unsigned NOT NULL,
  `credit` double(10,2) NOT NULL COMMENT 'Credit amout',
  `debit` double(10,2) NOT NULL COMMENT 'debit amount',
  `status` char(10) NOT NULL COMMENT 'Pledged | Funded | Refunded | Cancelled',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `U_ID` (`U_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Arnab Mallick', '', 'arnab@matrixnmedia.com', '$2y$10$CFDXKbyaruhPsgjV42O/o.QAu9XohBmy2fd4Hsu4Sj1cM3EqXIMwK', 'x9ekSYpqWo3hqsT7Di5Vev0x6b3fleAT8Ho3Y0XpTHTN8m6wo8YqRAIjzlxt', '2015-09-04 06:14:53', '2015-09-04 06:29:46'),
(2, 'James Smith', '', 'james@gmail.com', '$2y$10$JGNrTKNK/JNI4O3CoC5ds.AV88fGOCC10MflS6SdNHbb9FNuKx63W', 'I1APJHF3iSGxxcX53XuFMrjXSXvOxic2IM5e7w8ViNUgws0j6EBWwmetfRFx', '2015-09-04 06:33:45', '2015-09-04 06:57:27');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`P_CAT_ID`) REFERENCES `project_categories` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`U_ID`) REFERENCES `users` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `project_backer_rewards`
--
ALTER TABLE `project_backer_rewards`
  ADD CONSTRAINT `project_backer_rewards_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_followers`
--
ALTER TABLE `project_followers`
  ADD CONSTRAINT `project_followers_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_followers_ibfk_2` FOREIGN KEY (`U_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_funds`
--
ALTER TABLE `project_funds`
  ADD CONSTRAINT `project_funds_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `project_funds_ibfk_2` FOREIGN KEY (`U_ID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_updates`
--
ALTER TABLE `project_updates`
  ADD CONSTRAINT `project_updates_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `project_updates_ibfk_2` FOREIGN KEY (`U_ID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_update_comments`
--
ALTER TABLE `project_update_comments`
  ADD CONSTRAINT `project_update_comments_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `project_update_comments_ibfk_2` FOREIGN KEY (`U_ID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_votings`
--
ALTER TABLE `project_votings`
  ADD CONSTRAINT `project_votings_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_votings_ibfk_2` FOREIGN KEY (`U_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
