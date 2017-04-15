-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2016 at 04:04 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ieee`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` smallint(6) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `slug` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 for admin',
  `allow_registration` tinyint(4) NOT NULL DEFAULT '0',
  `level` smallint(6) NOT NULL DEFAULT '1',
  `is_public` tinyint(4) NOT NULL DEFAULT '1',
  `flag` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `slug`, `description`, `is_admin`, `allow_registration`, `level`, `is_public`, `flag`) VALUES
(1, 'Super Administrator', 'super_admin', '', 1, 0, 100, 0, 1),
(10, 'Administrator', 'admin', '', 1, 0, 90, 0, 1),
(11, 'Student', 'student', 'student', 0, 1, 40, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(16) COLLATE utf8_bin NOT NULL,
  `user_agent` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `action` varchar(50) COLLATE utf8_bin NOT NULL,
  `data` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10076 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `time`, `ip`, `user_agent`, `action`, `data`) VALUES
(9969, 1, 1433873369, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 'login', ''),
(9970, 1, 1433873453, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 'login', ''),
(9971, 1, 1433873459, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 'login', ''),
(9972, 1, 1433873465, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 'login', ''),
(9973, 73, 1433874444, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 'register', ''),
(9974, 73, 1433874499, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 'login', ''),
(9975, 1, 1433911795, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 'login', ''),
(9976, 74, 1433912097, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 'register', ''),
(9977, 74, 1433912788, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 'login', ''),
(9978, 74, 1433912864, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 'login', ''),
(9979, 1, 1433921057, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 'login', ''),
(9980, 73, 1433947206, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 'login', ''),
(9981, 1, 1434008859, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(9982, 73, 1434012544, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(9983, 73, 1434024689, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(9984, 73, 1434084311, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(9985, 72, 1434096423, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(9986, 72, 1434105610, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(9987, 72, 1434345806, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(9988, 75, 1434351104, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(9989, 76, 1434351204, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(9990, 77, 1434351312, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(9991, 78, 1434351528, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(9992, 79, 1434351826, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(9993, 80, 1434352026, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(9994, 81, 1434352107, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(9995, 82, 1434352218, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(9996, 83, 1434352317, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(9997, 84, 1434352354, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(9998, 85, 1434352409, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(9999, 86, 1434352441, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(10000, 87, 1434363645, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(10001, 72, 1434386103, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10002, 72, 1434431728, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10003, 88, 1434440216, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(10004, 89, 1434447821, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(10005, 90, 1434448969, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(10006, 91, 1434452206, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(10007, 92, 1434454112, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(10008, 72, 1434475779, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10009, 93, 1434480856, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'register', ''),
(10010, 72, 1434515768, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10011, 1, 1434539641, '10.11.11.104', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10012, 72, 1434603489, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10013, 72, 1434690439, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10014, 72, 1434702697, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10015, 72, 1434734935, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10016, 72, 1434808502, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10017, 72, 1434949925, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10018, 72, 1434973523, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10019, 72, 1434991125, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10020, 72, 1435024603, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10021, 72, 1435037676, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10022, 72, 1435054098, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10023, 72, 1435141149, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10024, 72, 1435208622, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10025, 1, 1435226511, '10.11.11.104', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10026, 72, 1435226604, '10.11.11.104', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10027, 72, 1435229637, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10028, 72, 1435293710, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10029, 72, 1435304857, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10030, 72, 1435306455, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 'login', ''),
(10031, 72, 1435310711, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10032, 72, 1435554236, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10033, 72, 1435572568, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10034, 72, 1435602403, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10035, 72, 1435640649, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10036, 72, 1435728273, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10037, 72, 1435813299, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10038, 72, 1435822570, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10039, 72, 1435850058, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10040, 72, 1435899619, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10041, 72, 1436157451, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10042, 72, 1436203728, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10043, 72, 1436245389, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10044, 94, 1436251948, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'register', ''),
(10045, 95, 1436252132, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'register', ''),
(10046, 72, 1436331842, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10047, 72, 1436373245, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10048, 72, 1436381628, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10049, 72, 1436417606, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10050, 72, 1436436360, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 'login', ''),
(10051, 1, 1454884608, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10052, 1, 1454884658, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10053, 1, 1454948747, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10054, 72, 1454948774, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10055, 1, 1454953058, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10056, 1, 1454953365, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10057, 72, 1454953580, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10058, 1, 1454954923, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10059, 1, 1455002726, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10060, 96, 1455007662, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'register', ''),
(10061, 96, 1455007678, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10062, 97, 1455008840, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'register', ''),
(10063, 97, 1455008863, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10064, 1, 1455096673, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10065, 97, 1455096962, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10066, 97, 1455099467, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10067, 1, 1455099492, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10068, 97, 1455099520, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10069, 98, 1455101093, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'register', ''),
(10070, 98, 1455101102, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10071, 1, 1455101304, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10072, 97, 1455102894, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10073, 1, 1455201928, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10074, 97, 1455202222, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', ''),
(10075, 1, 1455202683, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36', 'login', '');

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE IF NOT EXISTS `meta` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `key` varchar(100) COLLATE utf8_bin NOT NULL,
  `options` text COLLATE utf8_bin,
  `groups` text COLLATE utf8_bin NOT NULL,
  `list` tinyint(4) NOT NULL DEFAULT '1',
  `flag` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL,
  `sender_user_id` int(11) NOT NULL,
  `receiver_user_id` int(11) NOT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL,
  `read` int(10) unsigned NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `sender_user_id`, `receiver_user_id`, `lead_id`, `message`, `sent`, `read`, `flag`) VALUES
(1, 1, 50, 1143, 'testing...', 1430573472, 1430579280, 1),
(2, 1, 65, 1153, 'testing', 1430730070, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE IF NOT EXISTS `papers` (
  `pid` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_bin NOT NULL,
  `subject` varchar(20) COLLATE utf8_bin NOT NULL,
  `time` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `created_by` varchar(20) COLLATE utf8_bin NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flag` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`pid`, `name`, `subject`, `time`, `start_time`, `end_time`, `created_by`, `last_modified`, `flag`) VALUES
(1, 'Test Subject 1', 'nothing', 2, '2016-02-08 03:59:15', '2016-02-08 03:59:15', 'shashak', '2016-02-07 22:29:15', 1),
(2, 'Test Paper 2', 'nothing 2', 2, '2016-02-08 04:00:40', '2016-02-08 04:00:40', 'shashank', '2016-02-07 22:30:40', 1),
(3, 'Test Paper 3', 'nothing 2', 2, '2016-02-08 04:01:02', '2016-02-08 04:01:02', 'sha', '2016-02-07 22:31:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paper_questions`
--

CREATE TABLE IF NOT EXISTS `paper_questions` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `flag` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `paper_questions`
--

INSERT INTO `paper_questions` (`id`, `pid`, `qid`, `flag`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE IF NOT EXISTS `preferences` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `key` varchar(100) COLLATE utf8_bin NOT NULL,
  `groups` text COLLATE utf8_bin NOT NULL,
  `options` text COLLATE utf8_bin,
  `default` varchar(255) COLLATE utf8_bin NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE IF NOT EXISTS `privileges` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `slug` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `name`, `slug`, `description`, `flag`) VALUES
(1, 'Add User', 'insert_user', '', 1),
(2, 'Update User', 'update_user', NULL, 1),
(3, 'View Users', 'view_user', NULL, 1),
(4, 'Delete Users', 'delete_user', NULL, 1),
(5, 'View Groups', 'view_group', NULL, 1),
(6, 'Insert Group', 'insert_group', NULL, 1),
(7, 'Update Group', 'update_group', NULL, 1),
(8, 'Delete Group', 'delete_group', NULL, 1),
(9, 'Create Privilege', 'insert_privilege', NULL, 1),
(10, 'Update Privilege', 'update_privilege', NULL, 1),
(11, 'View Privilege', 'view_privilege', NULL, 1),
(12, 'Delete Privilege', 'delete_privilege', NULL, 1),
(14, 'View Admin', 'view_admin', '', 1),
(18, 'Update Group Privilege', 'update_group_privilege', '', 1),
(19, 'Update User Privilege', 'update_user_privilege', '', 1),
(28, 'View Settings', 'view_settings', '', 1),
(29, 'Update User Group', 'update_user_group', '', 1),
(39, 'View Log', 'view_log', '', 1),
(40, 'View Report', 'view_report', '', 1),
(47, 'Send Message', 'insert_message', '', 1),
(48, 'View Notification', 'view_notification', '', 0),
(49, 'View Students', 'view_students', '', 1),
(50, 'Update Students', 'update_students', '', 1),
(51, 'Delete Student', 'delete_student', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `privileges_groups`
--

CREATE TABLE IF NOT EXISTS `privileges_groups` (
  `id` bigint(20) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `privileges_groups`
--

INSERT INTO `privileges_groups` (`id`, `privilege_id`, `group_id`) VALUES
(99, 1, 1),
(100, 2, 1),
(101, 3, 1),
(123, 3, 10),
(131, 3, 11),
(102, 4, 1),
(103, 5, 1),
(124, 5, 10),
(132, 5, 11),
(104, 6, 1),
(105, 7, 1),
(106, 8, 1),
(107, 9, 1),
(108, 10, 1),
(109, 11, 1),
(125, 11, 10),
(133, 11, 11),
(110, 12, 1),
(111, 14, 1),
(126, 14, 10),
(134, 14, 11),
(112, 18, 1),
(113, 19, 1),
(114, 28, 1),
(127, 28, 10),
(135, 28, 11),
(115, 29, 1),
(122, 39, 1),
(128, 39, 10),
(116, 40, 1),
(129, 40, 10),
(136, 40, 11),
(117, 44, 1),
(118, 45, 1),
(119, 46, 1),
(120, 47, 1),
(130, 47, 10),
(121, 48, 1),
(137, 49, 1),
(140, 49, 10),
(138, 50, 1),
(141, 50, 10),
(139, 51, 1);

-- --------------------------------------------------------

--
-- Table structure for table `privileges_users`
--

CREATE TABLE IF NOT EXISTS `privileges_users` (
  `id` bigint(20) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=add,0=minus'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `qid` int(11) NOT NULL,
  `question` varchar(250) COLLATE utf8_bin NOT NULL,
  `option1` varchar(250) COLLATE utf8_bin NOT NULL,
  `option2` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `option3` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `option4` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `answer` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `image_url` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flag` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `marks`, `image_url`, `last_modified`, `flag`) VALUES
(1, 'What is my name?', 'Javed', 'Khalifa', 'Tony', 'Picolo', 2, 10, NULL, '2016-02-07 22:33:33', 1),
(2, 'What is your name?', 'Meko', 'Coni', 'Touy', 'Polo', 3, 15, NULL, '2016-02-07 22:34:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `slug` varchar(255) COLLATE utf8_bin NOT NULL,
  `value` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `group_id` smallint(6) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(50) COLLATE utf8_bin NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group_id`, `firstname`, `lastname`, `username`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, 1, 'System', 'Administrator', 'superadmin', '$P$ByXtxHRWQFJobFPuHpVtDZbiCZ/l.h/', 'ankit@pinnacleworks.net', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2016-02-11 20:28:03', '2013-03-20 13:08:35', '2016-02-11 14:58:03'),
(53, 10, 'Pritima', 'Chillar', '', '$P$B6e4fyEYVnI0/Zi1EBs/Zj0phZXPXf/', 'pchhillar@pinnacleworks.net', 1, 1, NULL, NULL, NULL, NULL, NULL, '182.64.19.91', '2015-05-07 10:35:05', '2014-09-23 12:44:35', '2016-02-11 14:59:50'),
(63, 10, 'System', 'Administrator', '', '$P$BlzmWZHaCSDVMYiL7gD77wwHDx2o8E.', 'admin@tulasinstitute.edu.in', 1, 0, NULL, NULL, NULL, NULL, NULL, '106.205.42.113', '2015-03-29 21:50:42', '2015-03-29 21:47:37', '2015-03-29 16:20:42'),
(72, 1, 'Shashank', 'Dwivedi', '', '$P$BUrH/N3LgEm4dxbTzin4LUO5E8n1pw0', 'sha@sha1.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2016-02-08 23:16:20', '2015-06-09 23:57:24', '2016-02-08 17:46:20'),
(74, 11, 'Employee', 'Kumar', '', '$P$BCdjjUTNqK/m/0Cydx9poEGdbvJdL90', 'employee@kumar.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2015-06-10 10:37:44', '2015-06-10 10:24:56', '2015-06-10 05:07:44'),
(86, 11, 'Foo', 'Bar', '', '$P$BUQLT69f7miM7OGCidTNXsywWYvpuf1', 'foo@bar1.in', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '0000-00-00 00:00:00', '2015-06-15 12:44:01', '2015-06-15 07:14:01'),
(89, 11, 'Arhenius', 'Jose', '', '$P$B7iJgP6GXVa9UMvc.82AmqVz3ujdb1/', 'foo2@bar2.in', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '0000-00-00 00:00:00', '2015-06-16 15:13:41', '2015-07-07 05:23:56'),
(90, 11, 'Khalifa', 'Franks', '', '$P$BR8xpD8vJjsRutx0rt4Z4UujOyOtI/.', 'foo3@bar3.in', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '0000-00-00 00:00:00', '2015-06-16 15:32:49', '2015-07-07 05:25:33'),
(91, 11, 'foo4', 'bar4', '', '$P$BMrznK9MfedxWqLPTK1qG5xf1kvPos1', 'foo@bar4.in', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '0000-00-00 00:00:00', '2015-06-16 16:26:45', '2015-06-16 10:56:45'),
(92, 11, 'foo5', 'bar5', '', '$P$BO8YWB5S0uXkG7gWszfSPHoVEseKVQ.', 'foo@bar5.in', 1, 1, NULL, NULL, NULL, NULL, NULL, '::1', '0000-00-00 00:00:00', '2015-06-16 16:58:32', '2015-06-16 18:41:42'),
(93, 11, 'foo6', 'bar6', '', '$P$BCd1xH/LY8Wtg3DGNESwC2bjTwPdAT1', 'foo@bar6.in', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '0000-00-00 00:00:00', '2015-06-17 00:24:16', '2015-06-16 18:54:16'),
(95, 11, 'Selenium', 'Oxide', '', '$P$BoMeUalSrzkmmig56RKlZMscR4yWYG1', 'sele@chem.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '0000-00-00 00:00:00', '2015-07-07 12:25:32', '2015-07-07 07:00:18'),
(96, 11, 'Deepshikha', 'Dvd', '', '$P$BVgx4CzWSxEwIodZ1Ik0pxu9J.15c.1', 'deepshikha2349@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2016-02-09 14:17:58', '2016-02-09 14:17:41', '2016-02-09 08:47:58'),
(97, 11, 'deep', 'shikha', '', '$P$BV7IxDls.1nfVBXSbdGf49WwpkDFbc1', 'deep@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2016-02-11 20:20:22', '2016-02-09 14:37:20', '2016-02-11 14:50:22'),
(98, 11, 'Kartikey', 'Mishra', '', '$P$BfB1aJ3.D3gxg4uoptCqwBLIgO7WQj1', 'kk@kk.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2016-02-10 16:15:02', '2016-02-10 16:14:53', '2016-02-10 10:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_answer`
--

CREATE TABLE IF NOT EXISTS `user_answer` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `ans` int(11) NOT NULL,
  `submit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE IF NOT EXISTS `user_meta` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_id` int(11) NOT NULL,
  `value` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_performance`
--

CREATE TABLE IF NOT EXISTS `user_performance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comments` text COLLATE utf8_bin NOT NULL,
  `time` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_preferences`
--

CREATE TABLE IF NOT EXISTS `user_preferences` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `preferences` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `user_id` int(11) NOT NULL,
  `middlename` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8_bin NOT NULL,
  `sex` varchar(7) COLLATE utf8_bin NOT NULL,
  `address1` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `address2` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `state` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `country` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `zipcode` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  `nationality` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `language_preferred` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `profile_pic` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `linkedin` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `facebook` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Profile of user id';

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`user_id`, `middlename`, `dob`, `mobile`, `sex`, `address1`, `address2`, `city`, `state`, `country`, `zipcode`, `nationality`, `language_preferred`, `profile_pic`, `linkedin`, `facebook`, `lastmodified`) VALUES
(1, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-26 06:37:10'),
(53, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-26 06:37:10'),
(63, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-26 06:37:10'),
(72, NULL, '1996-10-02', '1234', 'Male', '15072, ATS Advantage', NULL, 'Lucknow', 'UP', 'India', '201010', 'Indian', 'English', NULL, NULL, NULL, '2015-06-26 06:37:10'),
(74, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-26 06:37:10'),
(86, NULL, NULL, '7878787878', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-26 06:37:10'),
(89, NULL, NULL, '787845', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-26 06:37:10'),
(90, NULL, NULL, '53468', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-26 06:37:10'),
(91, NULL, NULL, '45634', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-26 06:37:10'),
(92, NULL, NULL, '5134654', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-26 06:37:10'),
(93, NULL, NULL, '543669', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-26 06:37:10'),
(95, NULL, NULL, '9494', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-07 06:55:32'),
(96, NULL, NULL, '9955626469', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-09 08:47:42'),
(97, NULL, '2015-09-28', '9955626468', 'Female', '25', 'gh', 'jsr', 'JH', 'In', '225468', 'Indian', 'English', NULL, NULL, NULL, '2016-02-10 09:40:38'),
(98, NULL, NULL, '996546', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-10 10:44:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `paper_questions`
--
ALTER TABLE `paper_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privileges_groups`
--
ALTER TABLE `privileges_groups`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `privilege_id` (`privilege_id`,`group_id`);

--
-- Indexes for table `privileges_users`
--
ALTER TABLE `privileges_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_answer`
--
ALTER TABLE `user_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_autologin`
--
ALTER TABLE `user_autologin`
  ADD PRIMARY KEY (`key_id`,`user_id`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_performance`
--
ALTER TABLE `user_performance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_preferences`
--
ALTER TABLE `user_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10076;
--
-- AUTO_INCREMENT for table `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `paper_questions`
--
ALTER TABLE `paper_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `privileges_groups`
--
ALTER TABLE `privileges_groups`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `privileges_users`
--
ALTER TABLE `privileges_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `user_answer`
--
ALTER TABLE `user_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_performance`
--
ALTER TABLE `user_performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_preferences`
--
ALTER TABLE `user_preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
ADD CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
