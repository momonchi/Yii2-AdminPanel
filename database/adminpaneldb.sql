-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.9-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table adminpaneldb.adminrole
CREATE TABLE IF NOT EXISTS `adminrole` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_title` varchar(45) DEFAULT NULL,
  `page_permissions` text,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table adminpaneldb.adminrole: ~2 rows (approximately)
/*!40000 ALTER TABLE `adminrole` DISABLE KEYS */;
INSERT INTO `adminrole` (`role_id`, `role_title`, `page_permissions`) VALUES
	(1, 'Management', '1,2,3,4,5,6,7,31,32,33,34,35,71,72,151,201,202'),
	(2, 'Development', '1,2,3,4,5,6,7,31,32,33,34,35,71,151,201,202');
/*!40000 ALTER TABLE `adminrole` ENABLE KEYS */;


-- Dumping structure for table adminpaneldb.adminrolepermissions
CREATE TABLE IF NOT EXISTS `adminrolepermissions` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(100) DEFAULT NULL,
  `url` text,
  `permission` text,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table adminpaneldb.adminrolepermissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `adminrolepermissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `adminrolepermissions` ENABLE KEYS */;


-- Dumping structure for table adminpaneldb.adminuser
CREATE TABLE IF NOT EXISTS `adminuser` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `position` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table adminpaneldb.adminuser: ~2 rows (approximately)
/*!40000 ALTER TABLE `adminuser` DISABLE KEYS */;
INSERT INTO `adminuser` (`admin_id`, `userid`, `position`, `username`, `password`, `role_id`) VALUES
	(1, 1, 'Administrator', NULL, NULL, 1),
	(2, 3, 'Senior Developer', NULL, NULL, 2);
/*!40000 ALTER TABLE `adminuser` ENABLE KEYS */;


-- Dumping structure for table adminpaneldb.systemsetting
CREATE TABLE IF NOT EXISTS `systemsetting` (
  `system_setting` int(11) NOT NULL,
  `default_time_allowance` int(11) NOT NULL,
  `default_time_zone` varchar(255) NOT NULL,
  PRIMARY KEY (`system_setting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table adminpaneldb.systemsetting: ~0 rows (approximately)
/*!40000 ALTER TABLE `systemsetting` DISABLE KEYS */;
INSERT INTO `systemsetting` (`system_setting`, `default_time_allowance`, `default_time_zone`) VALUES
	(1, 3, 'Asia/Manila');
/*!40000 ALTER TABLE `systemsetting` ENABLE KEYS */;


-- Dumping structure for table adminpaneldb.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(150) NOT NULL,
  `auth_key` varchar(45) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `date_verified` datetime DEFAULT NULL,
  `is_veriied` tinyint(2) DEFAULT NULL,
  `verify_code` varchar(50) DEFAULT NULL,
  `status` smallint(6) DEFAULT '10' COMMENT 'Enabled\nDisabled',
  `title_prefix` varchar(45) DEFAULT NULL COMMENT 'ENUM;\nMr., Ms., Mrs.',
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `user_type` varchar(20) DEFAULT NULL COMMENT 'User types:\nAdmin, Member',
  `handle` varchar(150) DEFAULT NULL,
  `dev_apikey` varchar(250) DEFAULT NULL,
  `referred_by_userid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `handle` (`handle`),
  UNIQUE KEY `dev_apikey_UNIQUE` (`dev_apikey`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table adminpaneldb.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `email`, `auth_key`, `password_hash`, `password_reset_token`, `create_date`, `created_at`, `updated_at`, `date_verified`, `is_veriied`, `verify_code`, `status`, `title_prefix`, `fname`, `mname`, `lname`, `user_type`, `handle`, `dev_apikey`, `referred_by_userid`) VALUES
	(1, 'admin', 'admin@admin.com', '2emtXygM0qXHKLMn0b-TxQtQWJhBg_gV', '$2y$13$4JyKRqkcGpLXxt6yfvYhf.fgTYtmsJjTa7egHFSgtEzgEUiGls9hm', NULL, NULL, 1512755866, 1512755866, NULL, NULL, NULL, 10, NULL, 'Momonchi', '', 'Garciano', NULL, NULL, NULL, NULL),
	(3, 'momonchio8@gmail.com', 'momonchio8@gmail.com', 'QaPuXyatlPizG6nIO0V6EYvcos9eWeXz', '$2y$13$4JyKRqkcGpLXxt6yfvYhf.fgTYtmsJjTa7egHFSgtEzgEUiGls9hm', NULL, NULL, 1514889031, NULL, NULL, NULL, NULL, 10, NULL, 'Admin Developer', 'Garciano', 'Raymond', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
