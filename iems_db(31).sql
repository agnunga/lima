-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 31, 2016 at 07:33 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iems_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `aaref`
--

CREATE TABLE `aaref` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aaref`
--

INSERT INTO `aaref` (`id`, `name`) VALUES
(9, 'POO'),
(10, 'Pamelaa'),
(13, 'Mercy'),
(16, 'pop'),
(17, 'ASWARO');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `uname` varchar(45) NOT NULL,
  `pwd` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `natid` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `uname`, `pwd`, `fname`, `lname`, `natid`) VALUES
(1, 'admin', 'admin', 'Amin', 'Dada', '31254883');

-- --------------------------------------------------------

--
-- Table structure for table `ajax_example`
--

CREATE TABLE `ajax_example` (
  `name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `wpm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ajax_example`
--

INSERT INTO `ajax_example` (`name`, `age`, `sex`, `wpm`) VALUES
('Frank', 45, 'm', 87),
('Jerry', 120, 'm', 20),
('Jill', 22, 'f', 72),
('Julie', 35, 'f', 90),
('Regis', 75, 'm', 44),
('Tracy', 27, 'f', 0);

-- --------------------------------------------------------

--
-- Table structure for table `allocations`
--

CREATE TABLE `allocations` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `start_date` varchar(12) NOT NULL,
  `end_date` varchar(12) NOT NULL,
  `number` int(3) NOT NULL,
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `advert_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `relevance` varchar(255) NOT NULL,
  `applied_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ligible` enum('p','y','n') NOT NULL DEFAULT 'p'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `advert_id`, `applicant_id`, `relevance`, `applied_on`, `ligible`) VALUES
(11, 7, 665588855, 'Very hadworking was doing this in longonot', '2016-03-16 21:44:53', 'p'),
(13, 9, 665588855, 'Has many skills in computing including designing and quick typing', '2016-03-16 21:49:01', 'p'),
(22, 11, 665588855, 'gbjhgvjhgfvjhgfcjhgjfhgfjhgjfvghn', '2016-03-26 09:35:03', 'p'),
(25, 12, 665588855, 'Ollooo Dismiss Now now now', '2016-03-26 09:45:44', 'p'),
(28, 7, 665588855, 'Olooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo JJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJ', '2016-03-28 06:27:52', 'p'),
(38, 7, 665588855, 'Very proficient in the industry and can do everything to win this position. Trust me, I''m the best.', '2016-03-28 08:45:36', 'p'),
(41, 7, 2147483647, 'Devi is very qualified. Employ me, no regrets in the future.', '2016-03-28 17:22:01', 'p'),
(42, 12, 2147483647, 'Ojode Knows mw prety well, he is quite aware I can deliver...', '2016-03-28 17:25:08', 'p');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `natid` int(8) UNSIGNED NOT NULL,
  `check_in` varchar(45) NOT NULL,
  `checkin_by` varchar(45) NOT NULL,
  `check_out` varchar(45) NOT NULL,
  `checkout_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `natid`, `check_in`, `checkin_by`, `check_out`, `checkout_by`) VALUES
(79, 88888556, '2016-03-22 15:14:37', 'opoo', '2016-03-28 20:52:31', 'opoo'),
(81, 74684683, '2016-03-22 16:17:40', 'opoo', '', ''),
(82, 87788855, '2016-03-22 16:18:06', 'opoo', '', ''),
(83, 45856696, '2016-03-29 22:06:43', 'opoo', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `cuname` varchar(32) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `natid` int(8) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` int(10) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `location` varchar(45) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `pwd` varchar(45) NOT NULL,
  `created_on` varchar(45) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `cuname`, `fname`, `lname`, `natid`, `email`, `phone`, `company_name`, `location`, `status`, `pwd`, `created_on`, `updated_on`) VALUES
(29, 'osora', 'Osora ', 'Ocholla', 3125845, 'pep@pep.pep', 78589998, 'GROK DEALERS', 'Syokimau', '1', '8027fa68f0cbb6c0a11c210338ceb9dfe23aff14', '2016-03-03 17:34:44', '2016-03-03 14:34:44'),
(30, 'paulo', 'Paul', 'Paul0', 55886655, 'paulo@gmail.com', 254785898, 'Air Connection', 'JKIA Airport', '1', 'fd077434a7c3095bfe440741787d02f6a7bab07e', '2016-03-10 16:14:44', '2016-03-10 13:14:44'),
(31, 'pop', 'Popa', 'Popaa', 77885599, 'pop@gmail.com', 2147483647, 'EHG housing Corporation', 'Kolimani near Komarok', '1', '4f197c99a78b8411f1cf48ab409a0a6d176b99b7', '2016-03-10 18:45:10', '2016-03-10 15:45:10'),
(32, 'enkaii', 'Petro ', 'Petro ', 22552255, '44774@gmail.com', 2147483647, 'AddNilla Company', 'Embakasi', '1', '6f43d51af067c166cc4bed867d570576b7aa9f77', '', '2016-03-28 19:28:57'),
(34, 'diablo', 'Joseph', 'Diablo', 32565625, 'diablo@gmail.com', 2147483647, 'DIABLO CORPORATION', 'INDUSTRIAL AREA', '1', '449938cd38c82bcddc2b534548ddbe984adb8efc', '2016-03-28 22:37:11', '2016-03-28 19:37:11'),
(35, 'juma', 'Charles', 'Charles', 31658599, 'juma@gmail.com', 2147483647, 'THURDIBAR INSTITUTE', 'Katwerera', '1', 'e013f182f6792b7a6988a76b3ffb0da6a4b7d88b', '2016-03-28 23:37:33', '2016-03-28 20:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `client_requests`
--

CREATE TABLE `client_requests` (
  `id` int(11) NOT NULL,
  `req_client_id` varchar(45) NOT NULL,
  `num_req` int(3) NOT NULL,
  `start_date` varchar(25) NOT NULL,
  `end_date` varchar(13) NOT NULL,
  `req_desc` varchar(255) NOT NULL,
  `time_requested` varchar(45) NOT NULL,
  `response` enum('p','y','n') NOT NULL DEFAULT 'p',
  `resp_desc` varchar(255) NOT NULL,
  `respondent_id` varchar(45) DEFAULT NULL,
  `time_responded` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_requests`
--

INSERT INTO `client_requests` (`id`, `req_client_id`, `num_req`, `start_date`, `end_date`, `req_desc`, `time_requested`, `response`, `resp_desc`, `respondent_id`, `time_responded`) VALUES
(9, 'paulo', 20, '10/03/2016', '18/03/2016', 'Documenting', '2016-03-03 20:53:02', 'n', 'Oloo is busy', 'opoo', '2016-03-22 16:25:49'),
(10, 'paulo', 89, '16/03/2016', '25/03/2016', 'To offload minji', '2016-03-13 00:20:03', 'n', 'Possible.', '1111', '2016-03-13 16:42:50'),
(11, 'pop', 8, '16/03/2016', '31/03/2016', 'To do light job.', '', 'n', 'd', 'opoo', '2016-03-29 22:04:18'),
(12, 'pop', 85, '18/03/2016', '21/03/2016', 'Picking broken misaza', '2016-03-14 01:47:25', 'y', 'Experienced workers available. 10. ', 'opoo', '2016-03-14 02:07:13'),
(13, 'paulo', 886, '17/03/2016', '24/03/2016', 'All the rest', '2016-03-14 09:59:57', 'p', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(45) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `detailed` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `fname`, `lname`, `phone`, `email`, `subject`, `detailed`) VALUES
(2, 'pop', 'popa', '0', 'pop@gmail.com', 'Worker nor reporting', 'Ignore'),
(3, 'Pepelas', 'Luswetis', '254778889996', 'oloo@ojode.me', 'Wanting to be a partner', 'We are one. Lets show it.');

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `jadvid` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `uploaded_to` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`id`, `jadvid`, `user_id`, `uploaded_to`) VALUES
(1, NULL, 665588855, '../documents/cv665588855.pdf'),
(2, NULL, 0, '../uploads/665588855'),
(3, NULL, 665588855, '../uploads/8788682119.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `natid` int(8) UNSIGNED NOT NULL,
  `employee_no` int(11) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `job_desc` varchar(255) DEFAULT NULL,
  `department_code` int(4) DEFAULT NULL,
  `parmanent` enum('0','1') NOT NULL,
  `salary` float NOT NULL,
  `pwd` varchar(45) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1',
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `natid`, `employee_no`, `fname`, `lname`, `email`, `phone`, `job_desc`, `department_code`, `parmanent`, `salary`, `pwd`, `status`, `last_modified`) VALUES
(20, 77888555, 4547554, 'Oloo', 'Truth', 'chngfgh@hgvgv.dsbvhg', '45', '', 1, '0', 0, 'ca68af629ca39b60485b9de1df35a87df7dc7be', '0', '2016-02-11 20:58:06'),
(10, 55256655, 21474836, 'Rwali', 'Rauka', 'rwali@jah.jes', '+254755855522', 'A paletizer', 1, '1', 0, '9cd021986e4cb48c9e8a4f696eb5b39fb7342c93', '0', '2016-02-11 20:28:37'),
(25, 75468965, 86465486, 'Jade', 'Palase', 'jade@bvk.jhgvn', '+254712458865', 'A specialist in cleaning', 1, '0', 0, '6623ffa2a5c45a51fdcdc5940049253f66548bae', '1', '2016-02-13 11:31:18'),
(23, 74684683, 468444454, 'Esther', 'Cham', 'employee@yahoo.com', '6846412548465', 'A specialist in cleaning. Coldroom hygene.', 1, '1', 0, '4a451322bb2510f02e15363777ba903416fa59d2', '1', '2016-02-11 21:20:40'),
(32, 46846846, 468464646, 'John', 'Pop', 'john@bv.nh', '+254896446846', 'Wipper', NULL, '1', 0, 'c3f508118f0f7c74221dcd25ed2c40063fed7b3d', '1', '2016-03-20 21:57:27'),
(27, 55556465, 523646684, 'Paul', 'Pop', 'zigo@jade.me', '+254225555633', 'Floer inspector', 1, '1', 0, 'e8ad83af28542ebe6fce0a6d1e4b4337129287f0', '1', '2016-03-20 21:35:32'),
(26, 45856696, 665588855, 'Kimwanza', 'Nzemei', 'mqwa@d.l', '+254796584255', 'Palletizer and loader', 1, '0', 0, '705eee2efae941b1e4fe7d49cba77e4c9c9f42e7', '1', '2016-03-12 21:12:18'),
(24, 36985869, 856985698, 'Oloo ', 'Jade', 'agtyt@ggt.gz', '+254712486125', '', 2, '0', 0, 'fa85d9e73e50457fbfdc8b7c4800ac422702f553', '1', '2016-02-11 21:23:40'),
(22, 54386789, 864684864, 'Zakayo', 'Zaibu', 'juma@gmail.net', '+254766993633', 'A Technologist at the controls room.', 1, '1', 0, 'd4e79e537a9806b72e413731e804abd45a766561', '0', '2016-02-11 21:00:34'),
(21, 87788855, 886699558, 'Habakuk', 'Jamal', '7875@gfcgf.khbgjhg', '+254796558545', 'Loading supervisor.', 1, '0', 0, 'b43d0aec86947029d7ff71dd607d83b3acedd10f', '1', '2016-02-11 20:58:26'),
(29, 88558855, 996699669, 'Timo', 'Anto', 'tim@tin.me', '+254755662255', 'A paletizer and a loader', NULL, '1', 0, 'eefcb4a0033a9c1c9d95ea0134d64d564b15ef81', '0', '2016-03-20 21:48:39'),
(16, 88888556, 2147483647, 'Dveki', 'Djones', 'veki@paul.com', '5588566221', 'Electrician. Cold room maintenance', 1, '0', 0, '75878664309b1e12165b0823315376b0d27e4f80', '1', '2016-02-11 20:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `user_grup` enum('a','m','c','e','j') NOT NULL,
  `full_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `brief_description` varchar(45) NOT NULL,
  `posted_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `user_grup`, `full_name`, `email`, `title`, `brief_description`, `posted_time`) VALUES
(1, 'a', 'vngvnvhnmvmh', 'vmnhbvngvnbv', ' jhbnvmhjbhjbjmhbjg', '0', '2016-02-07 15:09:00'),
(2, 'a', 'FULL NAME', 'EMAIL@EXAMPLE', 'mY Iissue goes here', '0', '2016-02-07 15:11:01'),
(3, 'a', 'Second full name', 'user@gmail.com', 'Statement missing', 'its all about salary. unatunyanyasa', '2016-02-07 15:15:24'),
(4, 'c', 'ClientName', 'ClientEmail', 'Worker nor reporting', 'Lateness', '2016-03-04 11:17:58'),
(5, 'j', 'Oloo Ojode', 'oloo@ojode.me', 'Personal concern', 'All is a wreck here', '2016-03-04 11:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `job_advert`
--

CREATE TABLE `job_advert` (
  `id` int(11) NOT NULL,
  `advert_by` varchar(45) NOT NULL,
  `position` varchar(45) NOT NULL,
  `number_needed` int(4) NOT NULL,
  `apply_before` varchar(10) NOT NULL,
  `qualifications_needed` text NOT NULL,
  `duties` text NOT NULL,
  `time_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_advert`
--

INSERT INTO `job_advert` (`id`, `advert_by`, `position`, `number_needed`, `apply_before`, `qualifications_needed`, `duties`, `time_posted`, `status`) VALUES
(7, 'Jeff Kuta', 'Head cooks', 1, '04/21/2016', 'Diploma catering', 'Manage kitchen well', '2016-02-19 17:49:02', '1'),
(9, 'Jeff Kuta', 'Docummentation', 396, '03/27/2016', 'Computer literacy. That will suffice.', 'Entering data and stored record and submitting. Keenness is a key value the applicant must possess.', '2016-02-19 17:53:51', '1'),
(11, 'Jeff Kuta', 'Palletizers', 889, '03/19/2016', 'Must have worked i n a cold room before.', 'Palletized, loading and canvasing.', '2016-02-19 17:56:40', '1'),
(12, 'Jeff Kuta', 'IT Experts', 2, '03/29/2016', 'Must be a degree holder in Bsc Computer Science or any other related course\r\nAt least 3years experience.', 'To ensure data security in the organization. Manage and maintain all the equipments in the company.', '2016-02-20 05:16:05', '1'),
(13, 'Jeff Kuta', 'Drivers', 85, '03/31/2016', 'Must be a graduate. \r\nWork experience of at least 36 years... ', 'Will be a long distant driver.', '2016-03-28 19:56:21', '1'),
(14, 'Jeff Kuta', 'Drivers', 85, '03/31/2016', 'Must be a graduate. \r\nWork experience of at least 36 years... ', 'Will be a long distant driver.', '2016-03-28 20:09:00', '1'),
(15, 'opoo', 'Gold Digger', 5522, '03/31/2016', 'Experienced. Having tools. Good health.', 'Digging gold at Macalda', '2016-03-28 20:22:16', '1');

-- --------------------------------------------------------

--
-- Table structure for table `js_applications`
--

CREATE TABLE `js_applications` (
  `id` int(11) NOT NULL,
  `advert_id` int(11) NOT NULL,
  `natid` int(8) NOT NULL,
  `phone` int(12) NOT NULL,
  `full_name` varchar(45) NOT NULL,
  `relevance` varchar(255) NOT NULL,
  `time_applied` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `marked` enum('p','g','r') NOT NULL DEFAULT 'p'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `js_applications`
--

INSERT INTO `js_applications` (`id`, `advert_id`, `natid`, `phone`, `full_name`, `relevance`, `time_applied`, `marked`) VALUES
(26, 12, 31254668, 2147483647, 'Oloo Odero ', 'Better today', '2016-03-24 20:40:22', 'p'),
(50, 12, 22222222, 0, 'Okoth Chipo', 'Gorgious', '2016-03-24 21:01:32', 'p'),
(52, 11, 22332255, 65264165, 'nELOSON tINEGA', 'HBJHBJBBJHBJHB', '2016-03-24 21:39:47', 'r'),
(59, 9, 31288555, 721491328, 'George Orage', 'I can affirm I am smart. Give me the chance', '2016-03-25 04:59:54', 'p'),
(60, 12, 35625885, 2147483647, 'Wambui Wambugu', 'Wambui is good enough to kill it...', '2016-03-26 09:39:18', 'p'),
(61, 12, 35485654, 728546853, 'Antonio Okore', 'Proficient', '2016-03-28 06:08:35', 'p'),
(62, 11, 35485654, 725452525, 'Atonio Okore', 'Proficient', '2016-03-28 06:11:11', 'p');

-- --------------------------------------------------------

--
-- Table structure for table `kannel_tuto`
--

CREATE TABLE `kannel_tuto` (
  `id` int(11) NOT NULL,
  `number` varchar(50) NOT NULL,
  `message` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mngmt`
--

CREATE TABLE `mngmt` (
  `id` int(11) NOT NULL,
  `emp_no` int(11) NOT NULL,
  `uname` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `level` int(1) NOT NULL,
  `post` varchar(60) NOT NULL,
  `pwd` varchar(45) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mngmt`
--

INSERT INTO `mngmt` (`id`, `emp_no`, `uname`, `fname`, `lname`, `level`, `post`, `pwd`, `status`, `created_on`) VALUES
(5, 21474836, 'productionmanager', 'Juma', 'Makali', 3, '', 'd0f0cec612e217a7c17b01f4d65b21b192d6e5e6', '1', '2016-02-08 08:12:38'),
(6, 855866658, 'opoo', 'TOM', 'MUSA', 3, '', '263d2c7678426e1bbe12975e2931781790631530', '1', '2016-02-13 11:05:13');

-- --------------------------------------------------------

--
-- Table structure for table `mngmt_details`
--

CREATE TABLE `mngmt_details` (
  `idmngmt_details` int(11) NOT NULL,
  `emp_id` varchar(45) NOT NULL,
  `duties` varchar(45) NOT NULL,
  `salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `off_duty_requests`
--

CREATE TABLE `off_duty_requests` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `off_type` tinyint(1) NOT NULL,
  `start` varchar(12) NOT NULL,
  `end` varchar(12) NOT NULL,
  `off_desc` varchar(255) NOT NULL,
  `response` enum('p','g','r') NOT NULL DEFAULT 'p',
  `time_posted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `off_duty_requests`
--

INSERT INTO `off_duty_requests` (`id`, `emp_id`, `off_type`, `start`, `end`, `off_desc`, `response`, `time_posted`) VALUES
(12, 665588855, 1, '23/03/2016', '25/03/2016', 'Very sic', 'p', '2016-03-21 07:27:15'),
(13, 856985698, 1, '31/03/2016', '29/04/2016', 'Very sick. Heading tom Matta Hospital', 'p', '2016-03-30 01:45:40'),
(14, 856985698, 2, '31/03/2016', '13/04/2016', 'Oloooooooooooooooooooooooooo', 'p', '2016-03-30 22:40:45'),
(15, 856985698, 2, '31/03/2016', '14/04/2016', 'Olooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo', 'p', '2016-03-30 22:42:40'),
(16, 856985698, 2, '31/03/2016', '06/04/2016', 'Oloooooooooooooooooooooooooooooooooooooooooooooo', 'p', '2016-03-30 22:55:16'),
(17, 856985698, 3, '31/03/2016', '29/04/2016', 'The bid in ....', 'p', '2016-03-30 23:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `idpayment` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `worked_days` int(2) NOT NULL DEFAULT '0',
  `allowances` float NOT NULL DEFAULT '0',
  `deductions` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `qtitle` varchar(70) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `date_acquired` varchar(13) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `userid`, `qtitle`, `qualification`, `date_acquired`, `date_posted`) VALUES
(9, 864684864, 'Bsc. Computer Science and Applied Mathematics', 'Computing from Egerton University in the year 2012', '14/03/2006', '2016-03-04 12:44:01'),
(10, 665588855, 'BIOCHEM', 'Totally qqualified', '02/03/2016', '2016-03-21 06:10:06'),
(11, 856985698, 'Bsc. Logistics', 'A qualified bazar deemberladonner', '10/03/2016', '2016-03-21 06:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `roster`
--

CREATE TABLE `roster` (
  `1` char(1) DEFAULT NULL,
  `2` char(1) DEFAULT NULL,
  `3` char(1) DEFAULT NULL,
  `4` char(1) DEFAULT NULL,
  `5` char(1) DEFAULT NULL,
  `6` char(1) DEFAULT NULL,
  `7` char(1) DEFAULT NULL,
  `8` char(1) DEFAULT NULL,
  `9` char(1) DEFAULT NULL,
  `10` char(1) DEFAULT NULL,
  `11` char(1) DEFAULT NULL,
  `12` char(1) DEFAULT NULL,
  `13` char(1) DEFAULT NULL,
  `14` char(1) DEFAULT NULL,
  `15` char(1) NOT NULL,
  `16` char(1) DEFAULT NULL,
  `17` char(1) DEFAULT NULL,
  `18` char(1) DEFAULT NULL,
  `19` char(1) DEFAULT NULL,
  `20` char(1) DEFAULT NULL,
  `21` char(1) DEFAULT NULL,
  `22` char(1) DEFAULT NULL,
  `23` char(1) DEFAULT NULL,
  `24` char(1) DEFAULT NULL,
  `25` char(1) DEFAULT NULL,
  `26` char(1) DEFAULT NULL,
  `27` char(1) DEFAULT NULL,
  `28` char(1) DEFAULT NULL,
  `29` char(1) DEFAULT NULL,
  `30` char(1) DEFAULT NULL,
  `31` char(1) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `offs` char(1) DEFAULT NULL,
  `total` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `added_on` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sample`
--

CREATE TABLE `tbl_sample` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sample`
--

INSERT INTO `tbl_sample` (`id`, `first_name`, `last_name`) VALUES
(2, 'Pepela', 'Lusweti'),
(20, 'Petro', 'Mita'),
(23, 'Ouma', 'Saka'),
(24, 'Balton', 'Makupe'),
(26, 'Jade', 'Palace'),
(34, 'Peter', 'Olwal'),
(35, 'Javanese', 'Paul');

-- --------------------------------------------------------

--
-- Table structure for table `txss`
--

CREATE TABLE `txss` (
  `id` int(11) NOT NULL,
  `cxss` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `txss`
--

INSERT INTO `txss` (`id`, `cxss`) VALUES
(1, 'kjlkgjmhg'),
(2, '<script>alert(document.cookie);</script>'),
(3, '<script>alert(document.cookie);</script>'),
(5, '<script>alert(document.cookie);</script>'),
(6, 'jyhghfv');

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_pics`
--

CREATE TABLE `uploaded_pics` (
  `id` int(11) NOT NULL,
  `loc_name` varchar(255) NOT NULL,
  `userid` varchar(45) DEFAULT NULL,
  `time_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uploaded_pics`
--

INSERT INTO `uploaded_pics` (`id`, `loc_name`, `userid`, `time_uploaded`) VALUES
(66, '../images/665588855.jpg', '665588855', '2016-03-16 20:01:41'),
(87, '../images/856985698.jpg', '856985698', '2016-03-20 09:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `iduserprofile` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `residence` varchar(45) DEFAULT NULL,
  `marital` char(1) NOT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `type` enum('a','m','c','e','j') NOT NULL,
  `natid` int(8) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `sex` char(1) NOT NULL,
  `yob` varchar(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `pwd` varchar(45) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `natid`, `fname`, `lname`, `sex`, `yob`, `email`, `pwd`, `status`) VALUES
(16, 'j', 31254884, 'Peter', 'Mula', 'M', '3/3/1996', 'mula@mula.mula', '2c4a265729156d471e3f7a083d60e499adfaf64c', '1'),
(25, 'j', 12121212, 'ORIMBA ', 'RANDA', 'M', '1/1/1998', '4747@47.47', '618dcdfb0cd9ae4481164961c4796dd8e3930c8d', '1'),
(26, 'j', 88996655, 'werte', 'Wotee', 'M', '3/1/1995', 'erewr@yj.vl', 'b37f6ddcefad7e8657837d3177f9ef2462f98acf', '1'),
(28, 'j', 78541236, 'Paul', 'Jadenna', 'M', '1/1/1998', 'olliokk@kklo.com', 'eb4ac3033e8ab3591e0fcefa8c26ce3fd36d5a0f', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aaref`
--
ALTER TABLE `aaref`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `ajax_example`
--
ALTER TABLE `ajax_example`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `allocations`
--
ALTER TABLE `allocations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empatend_idx` (`natid`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `client_requests`
--
ALTER TABLE `client_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_req_idx` (`req_client_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cvowner_idx` (`user_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_no`),
  ADD UNIQUE KEY `natid_UNIQUE` (`natid`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `employee_no` (`employee_no`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_advert`
--
ALTER TABLE `job_advert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `js_applications`
--
ALTER TABLE `js_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kannel_tuto`
--
ALTER TABLE `kannel_tuto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mngmt`
--
ALTER TABLE `mngmt`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emp_no_UNIQUE` (`emp_no`),
  ADD UNIQUE KEY `uname_UNIQUE` (`uname`);

--
-- Indexes for table `mngmt_details`
--
ALTER TABLE `mngmt_details`
  ADD PRIMARY KEY (`idmngmt_details`);

--
-- Indexes for table `off_duty_requests`
--
ALTER TABLE `off_duty_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`idpayment`),
  ADD KEY `emp_pay_idx` (`emp_id`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sample`
--
ALTER TABLE `tbl_sample`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `txss`
--
ALTER TABLE `txss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploaded_pics`
--
ALTER TABLE `uploaded_pics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`iduserprofile`,`user_id`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userscol_UNIQUE` (`natid`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aaref`
--
ALTER TABLE `aaref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `allocations`
--
ALTER TABLE `allocations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `client_requests`
--
ALTER TABLE `client_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `job_advert`
--
ALTER TABLE `job_advert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `js_applications`
--
ALTER TABLE `js_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `kannel_tuto`
--
ALTER TABLE `kannel_tuto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `mngmt`
--
ALTER TABLE `mngmt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `off_duty_requests`
--
ALTER TABLE `off_duty_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `idpayment` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_sample`
--
ALTER TABLE `tbl_sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `txss`
--
ALTER TABLE `txss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `uploaded_pics`
--
ALTER TABLE `uploaded_pics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `iduserprofile` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `emp_natid` FOREIGN KEY (`natid`) REFERENCES `employee` (`natid`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `emp_pay` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`employee_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
