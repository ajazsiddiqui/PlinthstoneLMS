-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2021 at 05:54 PM
-- Server version: 5.6.49-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plinthstonelms`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `status`, `type`, `created_by`, `date_created`) VALUES
(1, 'Ample Parking', 1, '1', 1, '2017-08-21 06:49:39'),
(2, 'Cricket Pitch', 1, '2', 1, '2017-08-21 06:51:54'),
(3, 'Club House', 1, '2', 1, '2017-10-06 00:45:33'),
(4, 'Children Play Zone', 1, '2', 1, '2017-10-06 00:45:45'),
(5, 'Pipe Gas Connection', 1, '1', 1, '2017-10-06 00:45:57'),
(6, 'Guest Room', 1, '1', 1, '2017-10-06 00:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(10) NOT NULL,
  `campaign_name` varchar(255) NOT NULL,
  `total_budget` varchar(255) NOT NULL,
  `total_spent` varchar(255) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `virtual_number` varchar(255) NOT NULL,
  `campaign_type` varchar(255) NOT NULL,
  `status` int(10) NOT NULL,
  `campaign_description` text NOT NULL,
  `created_by` int(10) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `campaign_name`, `total_budget`, `total_spent`, `from_date`, `to_date`, `virtual_number`, `campaign_type`, `status`, `campaign_description`, `created_by`, `date_created`) VALUES
(1, 'Signature Microsite', '0', '0', '2021-01-27 17:47:03', '2021-01-27 17:47:03', '3', '1', 1, '', 1, '2021-01-27 17:47:03'),
(2, 'Saffron Microsite', '0', '0', '2021-01-27 17:47:32', '2021-01-27 17:47:32', '1', '1', 1, '', 1, '2021-01-27 17:47:32'),
(3, 'Adityaraj Avenue Microsite', '0', '0', '2021-01-27 17:48:06', '2021-01-27 17:48:06', '2', '1', 1, '', 1, '2021-01-27 17:48:06'),
(4, 'Signature Facebook Campaign', '0', '0', '2021-02-04 14:35:36', '2021-02-07 14:35:36', '1', '1', 1, '', 1, '2021-02-04 14:35:36'),
(5, 'Mrugarchana Microsite', '0', '0', '2021-04-20 06:01:16', '2021-04-30 06:01:16', '1', '1', 1, '', 1, '2021-04-21 06:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `campaign_projects`
--

CREATE TABLE `campaign_projects` (
  `id` int(10) NOT NULL,
  `campaign_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaign_projects`
--

INSERT INTO `campaign_projects` (`id`, `campaign_id`, `project_id`, `created_by`, `date_created`) VALUES
(36, 3, 3, 1, '2019-02-06 20:48:37'),
(37, 4, 3, 1, '2019-02-10 03:13:33'),
(38, 2, 2, 1, '2019-02-14 18:59:45'),
(39, 1, 1, 1, '2019-02-14 18:59:53'),
(40, 5, 4, 1, '2019-05-01 01:17:18'),
(41, 6, 5, 1, '2019-05-14 00:17:31'),
(42, 7, 6, 1, '2019-11-30 00:41:39'),
(43, 8, 8, 1, '2019-12-06 00:12:44'),
(44, 9, 6, 1, '2020-01-08 00:49:54'),
(45, 10, 8, 1, '2020-01-09 18:56:07'),
(46, 11, 8, 1, '2020-01-16 18:19:08'),
(47, 12, 3, 1, '2020-01-27 20:04:49'),
(48, 1, 1, 1, '2021-01-28 00:47:03'),
(49, 2, 2, 1, '2021-01-28 00:47:32'),
(50, 3, 3, 1, '2021-01-28 00:48:06'),
(51, 4, 1, 1, '2021-02-04 21:35:36'),
(52, 5, 4, 1, '2021-04-21 13:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state`) VALUES
(1, 'Kolhapur', 'Maharashtra'),
(2, 'Port Blair', 'Andaman and Nicobar Islands'),
(3, 'Adilabad', 'Andhra Pradesh'),
(4, 'Adoni', 'Andhra Pradesh'),
(5, 'Amadalavalasa', 'Andhra Pradesh'),
(6, 'Amalapuram', 'Andhra Pradesh'),
(7, 'Anakapalle', 'Andhra Pradesh'),
(8, 'Anantapur', 'Andhra Pradesh'),
(9, 'Badepalle', 'Andhra Pradesh'),
(10, 'Banganapalle', 'Andhra Pradesh'),
(11, 'Bapatla', 'Andhra Pradesh'),
(12, 'Bellampalle', 'Andhra Pradesh'),
(13, 'Bethamcherla', 'Andhra Pradesh'),
(14, 'Bhadrachalam', 'Andhra Pradesh'),
(15, 'Bhainsa', 'Andhra Pradesh'),
(16, 'Bheemunipatnam', 'Andhra Pradesh'),
(17, 'Bhimavaram', 'Andhra Pradesh'),
(18, 'Bhongir', 'Andhra Pradesh'),
(19, 'Bobbili', 'Andhra Pradesh'),
(20, 'Bodhan', 'Andhra Pradesh'),
(21, 'Chilakaluripet', 'Andhra Pradesh'),
(22, 'Chirala', 'Andhra Pradesh'),
(23, 'Chittoor', 'Andhra Pradesh'),
(24, 'Cuddapah', 'Andhra Pradesh'),
(25, 'Devarakonda', 'Andhra Pradesh'),
(26, 'Dharmavaram', 'Andhra Pradesh'),
(27, 'Eluru', 'Andhra Pradesh'),
(28, 'Farooqnagar', 'Andhra Pradesh'),
(29, 'Gadwal', 'Andhra Pradesh'),
(30, 'Gooty', 'Andhra Pradesh'),
(31, 'Gudivada', 'Andhra Pradesh'),
(32, 'Gudur', 'Andhra Pradesh'),
(33, 'Guntakal', 'Andhra Pradesh'),
(34, 'Guntur', 'Andhra Pradesh'),
(35, 'Hanuman Junction', 'Andhra Pradesh'),
(36, 'Hindupur', 'Andhra Pradesh'),
(37, 'Hyderabad', 'Andhra Pradesh'),
(38, 'Ichchapuram', 'Andhra Pradesh'),
(39, 'Jaggaiahpet', 'Andhra Pradesh'),
(40, 'Jagtial', 'Andhra Pradesh'),
(41, 'Jammalamadugu', 'Andhra Pradesh'),
(42, 'Jangaon', 'Andhra Pradesh'),
(43, 'Kadapa', 'Andhra Pradesh'),
(44, 'Kadiri', 'Andhra Pradesh'),
(45, 'Kagaznagar', 'Andhra Pradesh'),
(46, 'Kakinada', 'Andhra Pradesh'),
(47, 'Kalyandurg', 'Andhra Pradesh'),
(48, 'Kamareddy', 'Andhra Pradesh'),
(49, 'Kandukur', 'Andhra Pradesh'),
(50, 'Karimnagar', 'Andhra Pradesh'),
(51, 'Kavali', 'Andhra Pradesh'),
(52, 'Khammam', 'Andhra Pradesh'),
(53, 'Koratla', 'Andhra Pradesh'),
(54, 'Kothagudem', 'Andhra Pradesh'),
(55, 'Kothapeta', 'Andhra Pradesh'),
(56, 'Kovvur', 'Andhra Pradesh'),
(57, 'Kurnool', 'Andhra Pradesh'),
(58, 'Kyathampalle', 'Andhra Pradesh'),
(59, 'Macherla', 'Andhra Pradesh'),
(60, 'Machilipatnam', 'Andhra Pradesh'),
(61, 'Madanapalle', 'Andhra Pradesh'),
(62, 'Mahbubnagar', 'Andhra Pradesh'),
(63, 'Mancherial', 'Andhra Pradesh'),
(64, 'Mandamarri', 'Andhra Pradesh'),
(65, 'Mandapeta', 'Andhra Pradesh'),
(66, 'Manuguru', 'Andhra Pradesh'),
(67, 'Markapur', 'Andhra Pradesh'),
(68, 'Medak', 'Andhra Pradesh'),
(69, 'Miryalaguda', 'Andhra Pradesh'),
(70, 'Mogalthur', 'Andhra Pradesh'),
(71, 'Nagari', 'Andhra Pradesh'),
(72, 'Nagarkurnool', 'Andhra Pradesh'),
(73, 'Nandyal', 'Andhra Pradesh'),
(74, 'Narasapur', 'Andhra Pradesh'),
(75, 'Narasaraopet', 'Andhra Pradesh'),
(76, 'Narayanpet', 'Andhra Pradesh'),
(77, 'Narsipatnam', 'Andhra Pradesh'),
(78, 'Nellore', 'Andhra Pradesh'),
(79, 'Nidadavole', 'Andhra Pradesh'),
(80, 'Nirmal', 'Andhra Pradesh'),
(81, 'Nizamabad', 'Andhra Pradesh'),
(82, 'Nuzvid', 'Andhra Pradesh'),
(83, 'Ongole', 'Andhra Pradesh'),
(84, 'Palacole', 'Andhra Pradesh'),
(85, 'Palasa Kasibugga', 'Andhra Pradesh'),
(86, 'Palwancha', 'Andhra Pradesh'),
(87, 'Parvathipuram', 'Andhra Pradesh'),
(88, 'Pedana', 'Andhra Pradesh'),
(89, 'Peddapuram', 'Andhra Pradesh'),
(90, 'Pithapuram', 'Andhra Pradesh'),
(91, 'Pondur', 'Andhra pradesh'),
(92, 'Ponnur', 'Andhra Pradesh'),
(93, 'Proddatur', 'Andhra Pradesh'),
(94, 'Punganur', 'Andhra Pradesh'),
(95, 'Puttur', 'Andhra Pradesh'),
(96, 'Rajahmundry', 'Andhra Pradesh'),
(97, 'Rajam', 'Andhra Pradesh'),
(98, 'Ramachandrapuram', 'Andhra Pradesh'),
(99, 'Ramagundam', 'Andhra Pradesh'),
(100, 'Rayachoti', 'Andhra Pradesh'),
(101, 'Rayadurg', 'Andhra Pradesh'),
(102, 'Renigunta', 'Andhra Pradesh'),
(103, 'Repalle', 'Andhra Pradesh'),
(104, 'Sadasivpet', 'Andhra Pradesh'),
(105, 'Salur', 'Andhra Pradesh'),
(106, 'Samalkot', 'Andhra Pradesh'),
(107, 'Sangareddy', 'Andhra Pradesh'),
(108, 'Sattenapalle', 'Andhra Pradesh'),
(109, 'Siddipet', 'Andhra Pradesh'),
(110, 'Singapur', 'Andhra Pradesh'),
(111, 'Sircilla', 'Andhra Pradesh'),
(112, 'Srikakulam', 'Andhra Pradesh'),
(113, 'Srikalahasti', 'Andhra Pradesh'),
(115, 'Suryapet', 'Andhra Pradesh'),
(116, 'Tadepalligudem', 'Andhra Pradesh'),
(117, 'Tadpatri', 'Andhra Pradesh'),
(118, 'Tandur', 'Andhra Pradesh'),
(119, 'Tanuku', 'Andhra Pradesh'),
(120, 'Tenali', 'Andhra Pradesh'),
(121, 'Tirupati', 'Andhra Pradesh'),
(122, 'Tuni', 'Andhra Pradesh'),
(123, 'Uravakonda', 'Andhra Pradesh'),
(124, 'Venkatagiri', 'Andhra Pradesh'),
(125, 'Vicarabad', 'Andhra Pradesh'),
(126, 'Vijayawada', 'Andhra Pradesh'),
(127, 'Vinukonda', 'Andhra Pradesh'),
(128, 'Visakhapatnam', 'Andhra Pradesh'),
(129, 'Vizianagaram', 'Andhra Pradesh'),
(130, 'Wanaparthy', 'Andhra Pradesh'),
(131, 'Warangal', 'Andhra Pradesh'),
(132, 'Yellandu', 'Andhra Pradesh'),
(133, 'Yemmiganur', 'Andhra Pradesh'),
(134, 'Yerraguntla', 'Andhra Pradesh'),
(135, 'Zahirabad', 'Andhra Pradesh'),
(136, 'Rajampet', 'Andra Pradesh'),
(137, 'Along', 'Arunachal Pradesh'),
(138, 'Bomdila', 'Arunachal Pradesh'),
(139, 'Itanagar', 'Arunachal Pradesh'),
(140, 'Naharlagun', 'Arunachal Pradesh'),
(141, 'Pasighat', 'Arunachal Pradesh'),
(142, 'Abhayapuri', 'Assam'),
(143, 'Amguri', 'Assam'),
(144, 'Anandnagaar', 'Assam'),
(145, 'Barpeta', 'Assam'),
(146, 'Barpeta Road', 'Assam'),
(147, 'Bilasipara', 'Assam'),
(148, 'Bongaigaon', 'Assam'),
(149, 'Dhekiajuli', 'Assam'),
(150, 'Dhubri', 'Assam'),
(151, 'Dibrugarh', 'Assam'),
(152, 'Digboi', 'Assam'),
(153, 'Diphu', 'Assam'),
(154, 'Dispur', 'Assam'),
(156, 'Gauripur', 'Assam'),
(157, 'Goalpara', 'Assam'),
(158, 'Golaghat', 'Assam'),
(159, 'Guwahati', 'Assam'),
(160, 'Haflong', 'Assam'),
(161, 'Hailakandi', 'Assam'),
(162, 'Hojai', 'Assam'),
(163, 'Jorhat', 'Assam'),
(164, 'Karimganj', 'Assam'),
(165, 'Kokrajhar', 'Assam'),
(166, 'Lanka', 'Assam'),
(167, 'Lumding', 'Assam'),
(168, 'Mangaldoi', 'Assam'),
(169, 'Mankachar', 'Assam'),
(170, 'Margherita', 'Assam'),
(171, 'Mariani', 'Assam'),
(172, 'Marigaon', 'Assam'),
(173, 'Nagaon', 'Assam'),
(174, 'Nalbari', 'Assam'),
(175, 'North Lakhimpur', 'Assam'),
(176, 'Rangia', 'Assam'),
(177, 'Sibsagar', 'Assam'),
(178, 'Silapathar', 'Assam'),
(179, 'Silchar', 'Assam'),
(180, 'Tezpur', 'Assam'),
(181, 'Tinsukia', 'Assam'),
(182, 'Amarpur', 'Bihar'),
(183, 'Araria', 'Bihar'),
(184, 'Areraj', 'Bihar'),
(185, 'Arrah', 'Bihar'),
(186, 'Asarganj', 'Bihar'),
(187, 'Aurangabad', 'Bihar'),
(188, 'Bagaha', 'Bihar'),
(189, 'Bahadurganj', 'Bihar'),
(190, 'Bairgania', 'Bihar'),
(191, 'Bakhtiarpur', 'Bihar'),
(192, 'Banka', 'Bihar'),
(193, 'Banmankhi Bazar', 'Bihar'),
(194, 'Barahiya', 'Bihar'),
(195, 'Barauli', 'Bihar'),
(196, 'Barbigha', 'Bihar'),
(197, 'Barh', 'Bihar'),
(198, 'Begusarai', 'Bihar'),
(199, 'Behea', 'Bihar'),
(200, 'Bettiah', 'Bihar'),
(201, 'Bhabua', 'Bihar'),
(202, 'Bhagalpur', 'Bihar'),
(203, 'Bihar Sharif', 'Bihar'),
(204, 'Bikramganj', 'Bihar'),
(205, 'Bodh Gaya', 'Bihar'),
(206, 'Buxar', 'Bihar'),
(207, 'Chandan Bara', 'Bihar'),
(208, 'Chanpatia', 'Bihar'),
(209, 'Chhapra', 'Bihar'),
(210, 'Colgong', 'Bihar'),
(211, 'Dalsinghsarai', 'Bihar'),
(212, 'Darbhanga', 'Bihar'),
(213, 'Daudnagar', 'Bihar'),
(214, 'Dehri-on-Sone', 'Bihar'),
(215, 'Dhaka', 'Bihar'),
(216, 'Dighwara', 'Bihar'),
(217, 'Dumraon', 'Bihar'),
(218, 'Fatwah', 'Bihar'),
(219, 'Forbesganj', 'Bihar'),
(220, 'Gaya', 'Bihar'),
(221, 'Gogri Jamalpur', 'Bihar'),
(222, 'Gopalganj', 'Bihar'),
(223, 'Hajipur', 'Bihar'),
(224, 'Hilsa', 'Bihar'),
(225, 'Hisua', 'Bihar'),
(226, 'Islampur', 'Bihar'),
(227, 'Jagdispur', 'Bihar'),
(228, 'Jamalpur', 'Bihar'),
(229, 'Jamui', 'Bihar'),
(230, 'Jehanabad', 'Bihar'),
(231, 'Jhajha', 'Bihar'),
(232, 'Jhanjharpur', 'Bihar'),
(233, 'Jogabani', 'Bihar'),
(234, 'Kanti', 'Bihar'),
(235, 'Katihar', 'Bihar'),
(236, 'Khagaria', 'Bihar'),
(237, 'Kharagpur', 'Bihar'),
(238, 'Kishanganj', 'Bihar'),
(239, 'Lakhisarai', 'Bihar'),
(240, 'Lalganj', 'Bihar'),
(241, 'Madhepura', 'Bihar'),
(242, 'Madhubani', 'Bihar'),
(243, 'Maharajganj', 'Bihar'),
(244, 'Mahnar Bazar', 'Bihar'),
(245, 'Makhdumpur', 'Bihar'),
(246, 'Maner', 'Bihar'),
(247, 'Manihari', 'Bihar'),
(248, 'Marhaura', 'Bihar'),
(249, 'Masaurhi', 'Bihar'),
(250, 'Mirganj', 'Bihar'),
(251, 'Mokameh', 'Bihar'),
(252, 'Motihari', 'Bihar'),
(253, 'Motipur', 'Bihar'),
(254, 'Munger', 'Bihar'),
(255, 'Murliganj', 'Bihar'),
(256, 'Muzaffarpur', 'Bihar'),
(257, 'Narkatiaganj', 'Bihar'),
(258, 'Naugachhia', 'Bihar'),
(259, 'Nawada', 'Bihar'),
(260, 'Nokha', 'Bihar'),
(261, 'Patna', 'Bihar'),
(262, 'Piro', 'Bihar'),
(263, 'Purnia', 'Bihar'),
(264, 'Rafiganj', 'Bihar'),
(265, 'Rajgir', 'Bihar'),
(266, 'Ramnagar', 'Bihar'),
(267, 'Raxaul Bazar', 'Bihar'),
(268, 'Revelganj', 'Bihar'),
(269, 'Rosera', 'Bihar'),
(270, 'Saharsa', 'Bihar'),
(271, 'Samastipur', 'Bihar'),
(272, 'Sasaram', 'Bihar'),
(273, 'Sheikhpura', 'Bihar'),
(274, 'Sheohar', 'Bihar'),
(275, 'Sherghati', 'Bihar'),
(276, 'Silao', 'Bihar'),
(277, 'Sitamarhi', 'Bihar'),
(278, 'Siwan', 'Bihar'),
(279, 'Sonepur', 'Bihar'),
(280, 'Sugauli', 'Bihar'),
(281, 'Sultanganj', 'Bihar'),
(282, 'Supaul', 'Bihar'),
(283, 'Warisaliganj', 'Bihar'),
(284, 'Ahiwara', 'Chhattisgarh'),
(285, 'Akaltara', 'Chhattisgarh'),
(286, 'Ambagarh Chowki', 'Chhattisgarh'),
(287, 'Ambikapur', 'Chhattisgarh'),
(288, 'Arang', 'Chhattisgarh'),
(289, 'Bade Bacheli', 'Chhattisgarh'),
(290, 'Balod', 'Chhattisgarh'),
(291, 'Baloda Bazar', 'Chhattisgarh'),
(292, 'Bemetra', 'Chhattisgarh'),
(293, 'Bhatapara', 'Chhattisgarh'),
(294, 'Bilaspur', 'Chhattisgarh'),
(295, 'Birgaon', 'Chhattisgarh'),
(296, 'Champa', 'Chhattisgarh'),
(297, 'Chirmiri', 'Chhattisgarh'),
(298, 'Dalli-Rajhara', 'Chhattisgarh'),
(299, 'Dhamtari', 'Chhattisgarh'),
(300, 'Dipka', 'Chhattisgarh'),
(301, 'Dongargarh', 'Chhattisgarh'),
(302, 'Durg-Bhilai Nagar', 'Chhattisgarh'),
(303, 'Gobranawapara', 'Chhattisgarh'),
(304, 'Jagdalpur', 'Chhattisgarh'),
(305, 'Janjgir', 'Chhattisgarh'),
(306, 'Jashpurnagar', 'Chhattisgarh'),
(307, 'Kanker', 'Chhattisgarh'),
(308, 'Kawardha', 'Chhattisgarh'),
(309, 'Kondagaon', 'Chhattisgarh'),
(310, 'Korba', 'Chhattisgarh'),
(311, 'Mahasamund', 'Chhattisgarh'),
(312, 'Mahendragarh', 'Chhattisgarh'),
(313, 'Mungeli', 'Chhattisgarh'),
(314, 'Naila Janjgir', 'Chhattisgarh'),
(315, 'Raigarh', 'Chhattisgarh'),
(316, 'Raipur', 'Chhattisgarh'),
(317, 'Rajnandgaon', 'Chhattisgarh'),
(318, 'Sakti', 'Chhattisgarh'),
(319, 'Tilda Newra', 'Chhattisgarh'),
(320, 'Amli', 'Dadra & Nagar Haveli'),
(321, 'Silvassa', 'Dadra and Nagar Haveli'),
(322, 'Daman and Diu', 'Daman & Diu'),
(323, 'Daman and Diu', 'Daman & Diu'),
(324, 'Asola', 'Delhi'),
(325, 'Delhi', 'Delhi'),
(326, 'Aldona', 'Goa'),
(327, 'Curchorem Cacora', 'Goa'),
(328, 'Madgaon', 'Goa'),
(329, 'Mapusa', 'Goa'),
(330, 'Margao', 'Goa'),
(331, 'Marmagao', 'Goa'),
(332, 'Panaji', 'Goa'),
(333, 'Ahmedabad', 'Gujarat'),
(334, 'Amreli', 'Gujarat'),
(335, 'Anand', 'Gujarat'),
(336, 'Ankleshwar', 'Gujarat'),
(337, 'Bharuch', 'Gujarat'),
(338, 'Bhavnagar', 'Gujarat'),
(339, 'Bhuj', 'Gujarat'),
(340, 'Cambay', 'Gujarat'),
(341, 'Dahod', 'Gujarat'),
(342, 'Deesa', 'Gujarat'),
(344, 'Dholka', 'Gujarat'),
(345, 'Gandhinagar', 'Gujarat'),
(346, 'Godhra', 'Gujarat'),
(347, 'Himatnagar', 'Gujarat'),
(348, 'Idar', 'Gujarat'),
(349, 'Jamnagar', 'Gujarat'),
(350, 'Junagadh', 'Gujarat'),
(351, 'Kadi', 'Gujarat'),
(352, 'Kalavad', 'Gujarat'),
(353, 'Kalol', 'Gujarat'),
(354, 'Kapadvanj', 'Gujarat'),
(355, 'Karjan', 'Gujarat'),
(356, 'Keshod', 'Gujarat'),
(357, 'Khambhalia', 'Gujarat'),
(358, 'Khambhat', 'Gujarat'),
(359, 'Kheda', 'Gujarat'),
(360, 'Khedbrahma', 'Gujarat'),
(361, 'Kheralu', 'Gujarat'),
(362, 'Kodinar', 'Gujarat'),
(363, 'Lathi', 'Gujarat'),
(364, 'Limbdi', 'Gujarat'),
(365, 'Lunawada', 'Gujarat'),
(366, 'Mahesana', 'Gujarat'),
(367, 'Mahuva', 'Gujarat'),
(368, 'Manavadar', 'Gujarat'),
(369, 'Mandvi', 'Gujarat'),
(370, 'Mangrol', 'Gujarat'),
(371, 'Mansa', 'Gujarat'),
(372, 'Mehmedabad', 'Gujarat'),
(373, 'Modasa', 'Gujarat'),
(374, 'Morvi', 'Gujarat'),
(375, 'Nadiad', 'Gujarat'),
(376, 'Navsari', 'Gujarat'),
(377, 'Padra', 'Gujarat'),
(378, 'Palanpur', 'Gujarat'),
(379, 'Palitana', 'Gujarat'),
(380, 'Pardi', 'Gujarat'),
(381, 'Patan', 'Gujarat'),
(382, 'Petlad', 'Gujarat'),
(383, 'Porbandar', 'Gujarat'),
(384, 'Radhanpur', 'Gujarat'),
(385, 'Rajkot', 'Gujarat'),
(386, 'Rajpipla', 'Gujarat'),
(387, 'Rajula', 'Gujarat'),
(388, 'Ranavav', 'Gujarat'),
(389, 'Rapar', 'Gujarat'),
(390, 'Salaya', 'Gujarat'),
(391, 'Sanand', 'Gujarat'),
(392, 'Savarkundla', 'Gujarat'),
(393, 'Sidhpur', 'Gujarat'),
(394, 'Sihor', 'Gujarat'),
(395, 'Songadh', 'Gujarat'),
(396, 'Surat', 'Gujarat'),
(397, 'Talaja', 'Gujarat'),
(398, 'Thangadh', 'Gujarat'),
(399, 'Tharad', 'Gujarat'),
(400, 'Umbergaon', 'Gujarat'),
(401, 'Umreth', 'Gujarat'),
(402, 'Una', 'Gujarat'),
(403, 'Unjha', 'Gujarat'),
(404, 'Upleta', 'Gujarat'),
(405, 'Vadnagar', 'Gujarat'),
(406, 'Vadodara', 'Gujarat'),
(407, 'Valsad', 'Gujarat'),
(408, 'Vapi', 'Gujarat'),
(409, 'Vapi', 'Gujarat'),
(410, 'Veraval', 'Gujarat'),
(411, 'Vijapur', 'Gujarat'),
(412, 'Viramgam', 'Gujarat'),
(413, 'Visnagar', 'Gujarat'),
(414, 'Vyara', 'Gujarat'),
(415, 'Wadhwan', 'Gujarat'),
(416, 'Wankaner', 'Gujarat'),
(417, 'Adalaj', 'Gujrat'),
(418, 'Adityana', 'Gujrat'),
(419, 'Alang', 'Gujrat'),
(420, 'Ambaji', 'Gujrat'),
(421, 'Ambaliyasan', 'Gujrat'),
(422, 'Andada', 'Gujrat'),
(423, 'Anjar', 'Gujrat'),
(424, 'Anklav', 'Gujrat'),
(425, 'Antaliya', 'Gujrat'),
(426, 'Arambhada', 'Gujrat'),
(427, 'Atul', 'Gujrat'),
(428, 'Ballabhgarh', 'Hariyana'),
(429, 'Ambala', 'Haryana'),
(430, 'Ambala', 'Haryana'),
(431, 'Asankhurd', 'Haryana'),
(432, 'Assandh', 'Haryana'),
(433, 'Ateli', 'Haryana'),
(434, 'Babiyal', 'Haryana'),
(435, 'Bahadurgarh', 'Haryana'),
(436, 'Barwala', 'Haryana'),
(437, 'Bhiwani', 'Haryana'),
(438, 'Charkhi Dadri', 'Haryana'),
(439, 'Cheeka', 'Haryana'),
(440, 'Ellenabad 2', 'Haryana'),
(441, 'Faridabad', 'Haryana'),
(442, 'Fatehabad', 'Haryana'),
(443, 'Ganaur', 'Haryana'),
(444, 'Gharaunda', 'Haryana'),
(445, 'Gohana', 'Haryana'),
(446, 'Gurgaon', 'Haryana'),
(447, 'Haibat(Yamuna Nagar)', 'Haryana'),
(448, 'Hansi', 'Haryana'),
(449, 'Hisar', 'Haryana'),
(450, 'Hodal', 'Haryana'),
(451, 'Jhajjar', 'Haryana'),
(452, 'Jind', 'Haryana'),
(453, 'Kaithal', 'Haryana'),
(454, 'Kalan Wali', 'Haryana'),
(455, 'Kalka', 'Haryana'),
(456, 'Karnal', 'Haryana'),
(457, 'Ladwa', 'Haryana'),
(458, 'Mahendragarh', 'Haryana'),
(459, 'Mandi Dabwali', 'Haryana'),
(460, 'Narnaul', 'Haryana'),
(461, 'Narwana', 'Haryana'),
(462, 'Palwal', 'Haryana'),
(463, 'Panchkula', 'Haryana'),
(464, 'Panipat', 'Haryana'),
(465, 'Pehowa', 'Haryana'),
(466, 'Pinjore', 'Haryana'),
(467, 'Rania', 'Haryana'),
(468, 'Ratia', 'Haryana'),
(469, 'Rewari', 'Haryana'),
(470, 'Rohtak', 'Haryana'),
(471, 'Safidon', 'Haryana'),
(472, 'Samalkha', 'Haryana'),
(473, 'Shahbad', 'Haryana'),
(474, 'Sirsa', 'Haryana'),
(475, 'Sohna', 'Haryana'),
(476, 'Sonipat', 'Haryana'),
(477, 'Taraori', 'Haryana'),
(478, 'Thanesar', 'Haryana'),
(479, 'Tohana', 'Haryana'),
(480, 'Yamunanagar', 'Haryana'),
(481, 'Arki', 'Himachal Pradesh'),
(482, 'Baddi', 'Himachal Pradesh'),
(483, 'Bilaspur', 'Himachal Pradesh'),
(484, 'Chamba', 'Himachal Pradesh'),
(485, 'Dalhousie', 'Himachal Pradesh'),
(486, 'Dharamsala', 'Himachal Pradesh'),
(487, 'Hamirpur', 'Himachal Pradesh'),
(488, 'Mandi', 'Himachal Pradesh'),
(489, 'Nahan', 'Himachal Pradesh'),
(490, 'Shimla', 'Himachal Pradesh'),
(491, 'Solan', 'Himachal Pradesh'),
(492, 'Sundarnagar', 'Himachal Pradesh'),
(493, 'Jammu', 'Jammu & Kashmir'),
(494, 'Achabbal', 'Jammu and Kashmir'),
(495, 'Akhnoor', 'Jammu and Kashmir'),
(496, 'Anantnag', 'Jammu and Kashmir'),
(497, 'Arnia', 'Jammu and Kashmir'),
(498, 'Awantipora', 'Jammu and Kashmir'),
(499, 'Bandipore', 'Jammu and Kashmir'),
(500, 'Baramula', 'Jammu and Kashmir'),
(501, 'Kathua', 'Jammu and Kashmir'),
(502, 'Leh', 'Jammu and Kashmir'),
(503, 'Punch', 'Jammu and Kashmir'),
(504, 'Rajauri', 'Jammu and Kashmir'),
(505, 'Sopore', 'Jammu and Kashmir'),
(506, 'Srinagar', 'Jammu and Kashmir'),
(507, 'Udhampur', 'Jammu and Kashmir'),
(508, 'Amlabad', 'Jharkhand'),
(509, 'Ara', 'Jharkhand'),
(510, 'Barughutu', 'Jharkhand'),
(511, 'Bokaro Steel City', 'Jharkhand'),
(512, 'Chaibasa', 'Jharkhand'),
(513, 'Chakradharpur', 'Jharkhand'),
(514, 'Chandrapura', 'Jharkhand'),
(515, 'Chatra', 'Jharkhand'),
(516, 'Chirkunda', 'Jharkhand'),
(517, 'Churi', 'Jharkhand'),
(518, 'Daltonganj', 'Jharkhand'),
(519, 'Deoghar', 'Jharkhand'),
(520, 'Dhanbad', 'Jharkhand'),
(521, 'Dumka', 'Jharkhand'),
(522, 'Garhwa', 'Jharkhand'),
(523, 'Ghatshila', 'Jharkhand'),
(524, 'Giridih', 'Jharkhand'),
(525, 'Godda', 'Jharkhand'),
(526, 'Gomoh', 'Jharkhand'),
(527, 'Gumia', 'Jharkhand'),
(528, 'Gumla', 'Jharkhand'),
(529, 'Hazaribag', 'Jharkhand'),
(530, 'Hussainabad', 'Jharkhand'),
(531, 'Jamshedpur', 'Jharkhand'),
(532, 'Jamtara', 'Jharkhand'),
(533, 'Jhumri Tilaiya', 'Jharkhand'),
(534, 'Khunti', 'Jharkhand'),
(535, 'Lohardaga', 'Jharkhand'),
(536, 'Madhupur', 'Jharkhand'),
(537, 'Mihijam', 'Jharkhand'),
(538, 'Musabani', 'Jharkhand'),
(539, 'Pakaur', 'Jharkhand'),
(540, 'Patratu', 'Jharkhand'),
(541, 'Phusro', 'Jharkhand'),
(542, 'Ramngarh', 'Jharkhand'),
(543, 'Ranchi', 'Jharkhand'),
(544, 'Sahibganj', 'Jharkhand'),
(545, 'Saunda', 'Jharkhand'),
(546, 'Simdega', 'Jharkhand'),
(547, 'Tenu Dam-cum- Kathhara', 'Jharkhand'),
(548, 'Arasikere', 'Karnataka'),
(549, 'Bangalore', 'Karnataka'),
(550, 'Belgaum', 'Karnataka'),
(551, 'Bellary', 'Karnataka'),
(552, 'Chamrajnagar', 'Karnataka'),
(553, 'Chikkaballapur', 'Karnataka'),
(554, 'Chintamani', 'Karnataka'),
(555, 'Chitradurga', 'Karnataka'),
(556, 'Gulbarga', 'Karnataka'),
(557, 'Gundlupet', 'Karnataka'),
(558, 'Hassan', 'Karnataka'),
(559, 'Hospet', 'Karnataka'),
(560, 'Hubli', 'Karnataka'),
(561, 'Karkala', 'Karnataka'),
(562, 'Karwar', 'Karnataka'),
(563, 'Kolar', 'Karnataka'),
(564, 'Kota', 'Karnataka'),
(565, 'Lakshmeshwar', 'Karnataka'),
(566, 'Lingsugur', 'Karnataka'),
(567, 'Maddur', 'Karnataka'),
(568, 'Madhugiri', 'Karnataka'),
(569, 'Madikeri', 'Karnataka'),
(570, 'Magadi', 'Karnataka'),
(571, 'Mahalingpur', 'Karnataka'),
(572, 'Malavalli', 'Karnataka'),
(573, 'Malur', 'Karnataka'),
(574, 'Mandya', 'Karnataka'),
(575, 'Mangalore', 'Karnataka'),
(576, 'Manvi', 'Karnataka'),
(577, 'Mudalgi', 'Karnataka'),
(578, 'Mudbidri', 'Karnataka'),
(579, 'Muddebihal', 'Karnataka'),
(580, 'Mudhol', 'Karnataka'),
(581, 'Mulbagal', 'Karnataka'),
(582, 'Mundargi', 'Karnataka'),
(583, 'Mysore', 'Karnataka'),
(584, 'Nanjangud', 'Karnataka'),
(585, 'Pavagada', 'Karnataka'),
(586, 'Puttur', 'Karnataka'),
(587, 'Rabkavi Banhatti', 'Karnataka'),
(588, 'Raichur', 'Karnataka'),
(589, 'Ramanagaram', 'Karnataka'),
(590, 'Ramdurg', 'Karnataka'),
(591, 'Ranibennur', 'Karnataka'),
(592, 'Robertson Pet', 'Karnataka'),
(593, 'Ron', 'Karnataka'),
(594, 'Sadalgi', 'Karnataka'),
(595, 'Sagar', 'Karnataka'),
(596, 'Sakleshpur', 'Karnataka'),
(597, 'Sandur', 'Karnataka'),
(598, 'Sankeshwar', 'Karnataka'),
(599, 'Saundatti-Yellamma', 'Karnataka'),
(600, 'Savanur', 'Karnataka'),
(601, 'Sedam', 'Karnataka'),
(602, 'Shahabad', 'Karnataka'),
(603, 'Shahpur', 'Karnataka'),
(604, 'Shiggaon', 'Karnataka'),
(605, 'Shikapur', 'Karnataka'),
(606, 'Shimoga', 'Karnataka'),
(607, 'Shorapur', 'Karnataka'),
(608, 'Shrirangapattana', 'Karnataka'),
(609, 'Sidlaghatta', 'Karnataka'),
(610, 'Sindgi', 'Karnataka'),
(611, 'Sindhnur', 'Karnataka'),
(612, 'Sira', 'Karnataka'),
(613, 'Sirsi', 'Karnataka'),
(614, 'Siruguppa', 'Karnataka'),
(615, 'Srinivaspur', 'Karnataka'),
(616, 'Talikota', 'Karnataka'),
(617, 'Tarikere', 'Karnataka'),
(618, 'Tekkalakota', 'Karnataka'),
(619, 'Terdal', 'Karnataka'),
(620, 'Tiptur', 'Karnataka'),
(621, 'Tumkur', 'Karnataka'),
(622, 'Udupi', 'Karnataka'),
(623, 'Vijayapura', 'Karnataka'),
(624, 'Wadi', 'Karnataka'),
(625, 'Yadgir', 'Karnataka'),
(626, 'Adoor', 'Kerala'),
(627, 'Akathiyoor', 'Kerala'),
(628, 'Alappuzha', 'Kerala'),
(629, 'Ancharakandy', 'Kerala'),
(630, 'Aroor', 'Kerala'),
(631, 'Ashtamichira', 'Kerala'),
(632, 'Attingal', 'Kerala'),
(633, 'Avinissery', 'Kerala'),
(634, 'Chalakudy', 'Kerala'),
(635, 'Changanassery', 'Kerala'),
(636, 'Chendamangalam', 'Kerala'),
(637, 'Chengannur', 'Kerala'),
(638, 'Cherthala', 'Kerala'),
(639, 'Cheruthazham', 'Kerala'),
(640, 'Chittur-Thathamangalam', 'Kerala'),
(641, 'Chockli', 'Kerala'),
(642, 'Erattupetta', 'Kerala'),
(643, 'Guruvayoor', 'Kerala'),
(644, 'Irinjalakuda', 'Kerala'),
(645, 'Kadirur', 'Kerala'),
(646, 'Kalliasseri', 'Kerala'),
(647, 'Kalpetta', 'Kerala'),
(648, 'Kanhangad', 'Kerala'),
(649, 'Kanjikkuzhi', 'Kerala'),
(650, 'Kannur', 'Kerala'),
(651, 'Kasaragod', 'Kerala'),
(652, 'Kayamkulam', 'Kerala'),
(653, 'Kochi', 'Kerala'),
(654, 'Kodungallur', 'Kerala'),
(655, 'Kollam', 'Kerala'),
(656, 'Koothuparamba', 'Kerala'),
(657, 'Kothamangalam', 'Kerala'),
(658, 'Kottayam', 'Kerala'),
(659, 'Kozhikode', 'Kerala'),
(660, 'Kunnamkulam', 'Kerala'),
(661, 'Malappuram', 'Kerala'),
(662, 'Mattannur', 'Kerala'),
(663, 'Mavelikkara', 'Kerala'),
(664, 'Mavoor', 'Kerala'),
(665, 'Muvattupuzha', 'Kerala'),
(666, 'Nedumangad', 'Kerala'),
(667, 'Neyyattinkara', 'Kerala'),
(668, 'Ottappalam', 'Kerala'),
(669, 'Palai', 'Kerala'),
(670, 'Palakkad', 'Kerala'),
(671, 'Panniyannur', 'Kerala'),
(672, 'Pappinisseri', 'Kerala'),
(673, 'Paravoor', 'Kerala'),
(674, 'Pathanamthitta', 'Kerala'),
(675, 'Payyannur', 'Kerala'),
(676, 'Peringathur', 'Kerala'),
(677, 'Perinthalmanna', 'Kerala'),
(678, 'Perumbavoor', 'Kerala'),
(679, 'Ponnani', 'Kerala'),
(680, 'Punalur', 'Kerala'),
(681, 'Quilandy', 'Kerala'),
(682, 'Shoranur', 'Kerala'),
(683, 'Taliparamba', 'Kerala'),
(684, 'Thiruvalla', 'Kerala'),
(685, 'Thiruvananthapuram', 'Kerala'),
(686, 'Thodupuzha', 'Kerala'),
(687, 'Thrissur', 'Kerala'),
(688, 'Tirur', 'Kerala'),
(689, 'Vadakara', 'Kerala'),
(690, 'Vaikom', 'Kerala'),
(691, 'Varkala', 'Kerala'),
(692, 'Kavaratti', 'Lakshadweep'),
(693, 'Ashok Nagar', 'Madhya Pradesh'),
(694, 'Balaghat', 'Madhya Pradesh'),
(695, 'Betul', 'Madhya Pradesh'),
(696, 'Bhopal', 'Madhya Pradesh'),
(697, 'Burhanpur', 'Madhya Pradesh'),
(698, 'Chhatarpur', 'Madhya Pradesh'),
(699, 'Dabra', 'Madhya Pradesh'),
(700, 'Datia', 'Madhya Pradesh'),
(701, 'Dewas', 'Madhya Pradesh'),
(702, 'Dhar', 'Madhya Pradesh'),
(703, 'Fatehabad', 'Madhya Pradesh'),
(704, 'Gwalior', 'Madhya Pradesh'),
(705, 'Indore', 'Madhya Pradesh'),
(706, 'Itarsi', 'Madhya Pradesh'),
(707, 'Jabalpur', 'Madhya Pradesh'),
(708, 'Katni', 'Madhya Pradesh'),
(709, 'Kotma', 'Madhya Pradesh'),
(710, 'Lahar', 'Madhya Pradesh'),
(711, 'Lundi', 'Madhya Pradesh'),
(712, 'Maharajpur', 'Madhya Pradesh'),
(713, 'Mahidpur', 'Madhya Pradesh'),
(714, 'Maihar', 'Madhya Pradesh'),
(715, 'Malajkhand', 'Madhya Pradesh'),
(716, 'Manasa', 'Madhya Pradesh'),
(717, 'Manawar', 'Madhya Pradesh'),
(718, 'Mandideep', 'Madhya Pradesh'),
(719, 'Mandla', 'Madhya Pradesh'),
(720, 'Mandsaur', 'Madhya Pradesh'),
(721, 'Mauganj', 'Madhya Pradesh'),
(722, 'Mhow Cantonment', 'Madhya Pradesh'),
(723, 'Mhowgaon', 'Madhya Pradesh'),
(724, 'Morena', 'Madhya Pradesh'),
(725, 'Multai', 'Madhya Pradesh'),
(726, 'Murwara', 'Madhya Pradesh'),
(727, 'Nagda', 'Madhya Pradesh'),
(728, 'Nainpur', 'Madhya Pradesh'),
(729, 'Narsinghgarh', 'Madhya Pradesh'),
(730, 'Narsinghgarh', 'Madhya Pradesh'),
(731, 'Neemuch', 'Madhya Pradesh'),
(732, 'Nepanagar', 'Madhya Pradesh'),
(733, 'Niwari', 'Madhya Pradesh'),
(734, 'Nowgong', 'Madhya Pradesh'),
(735, 'Nowrozabad', 'Madhya Pradesh'),
(736, 'Pachore', 'Madhya Pradesh'),
(737, 'Pali', 'Madhya Pradesh'),
(738, 'Panagar', 'Madhya Pradesh'),
(739, 'Pandhurna', 'Madhya Pradesh'),
(740, 'Panna', 'Madhya Pradesh'),
(741, 'Pasan', 'Madhya Pradesh'),
(742, 'Pipariya', 'Madhya Pradesh'),
(743, 'Pithampur', 'Madhya Pradesh'),
(744, 'Porsa', 'Madhya Pradesh'),
(745, 'Prithvipur', 'Madhya Pradesh'),
(746, 'Raghogarh-Vijaypur', 'Madhya Pradesh'),
(747, 'Rahatgarh', 'Madhya Pradesh'),
(748, 'Raisen', 'Madhya Pradesh'),
(749, 'Rajgarh', 'Madhya Pradesh'),
(750, 'Ratlam', 'Madhya Pradesh'),
(751, 'Rau', 'Madhya Pradesh'),
(752, 'Rehli', 'Madhya Pradesh'),
(753, 'Rewa', 'Madhya Pradesh'),
(754, 'Sabalgarh', 'Madhya Pradesh'),
(755, 'Sagar', 'Madhya Pradesh'),
(756, 'Sanawad', 'Madhya Pradesh'),
(757, 'Sarangpur', 'Madhya Pradesh'),
(758, 'Sarni', 'Madhya Pradesh'),
(759, 'Satna', 'Madhya Pradesh'),
(760, 'Sausar', 'Madhya Pradesh'),
(761, 'Sehore', 'Madhya Pradesh'),
(762, 'Sendhwa', 'Madhya Pradesh'),
(763, 'Seoni', 'Madhya Pradesh'),
(764, 'Seoni-Malwa', 'Madhya Pradesh'),
(765, 'Shahdol', 'Madhya Pradesh'),
(766, 'Shajapur', 'Madhya Pradesh'),
(767, 'Shamgarh', 'Madhya Pradesh'),
(768, 'Sheopur', 'Madhya Pradesh'),
(769, 'Shivpuri', 'Madhya Pradesh'),
(770, 'Shujalpur', 'Madhya Pradesh'),
(771, 'Sidhi', 'Madhya Pradesh'),
(772, 'Sihora', 'Madhya Pradesh'),
(773, 'Singrauli', 'Madhya Pradesh'),
(774, 'Sironj', 'Madhya Pradesh'),
(775, 'Sohagpur', 'Madhya Pradesh'),
(776, 'Tarana', 'Madhya Pradesh'),
(777, 'Tikamgarh', 'Madhya Pradesh'),
(778, 'Ujhani', 'Madhya Pradesh'),
(779, 'Ujjain', 'Madhya Pradesh'),
(780, 'Umaria', 'Madhya Pradesh'),
(781, 'Vidisha', 'Madhya Pradesh'),
(782, 'Wara Seoni', 'Madhya Pradesh'),
(783, 'Ahmednagar', 'Maharashtra'),
(784, 'Akola', 'Maharashtra'),
(785, 'Amravati', 'Maharashtra'),
(786, 'Aurangabad', 'Maharashtra'),
(787, 'Baramati', 'Maharashtra'),
(788, 'Chalisgaon', 'Maharashtra'),
(789, 'Chinchani', 'Maharashtra'),
(790, 'Devgarh', 'Maharashtra'),
(791, 'Dhule', 'Maharashtra'),
(792, 'Dombivli', 'Maharashtra'),
(793, 'Durgapur', 'Maharashtra'),
(794, 'Ichalkaranji', 'Maharashtra'),
(795, 'Jalna', 'Maharashtra'),
(796, 'Kalyan', 'Maharashtra'),
(797, 'Latur', 'Maharashtra'),
(798, 'Loha', 'Maharashtra'),
(799, 'Lonar', 'Maharashtra'),
(800, 'Lonavla', 'Maharashtra'),
(801, 'Mahad', 'Maharashtra'),
(802, 'Mahuli', 'Maharashtra'),
(803, 'Malegaon', 'Maharashtra'),
(804, 'Malkapur', 'Maharashtra'),
(805, 'Manchar', 'Maharashtra'),
(806, 'Mangalvedhe', 'Maharashtra'),
(807, 'Mangrulpir', 'Maharashtra'),
(808, 'Manjlegaon', 'Maharashtra'),
(809, 'Manmad', 'Maharashtra'),
(810, 'Manwath', 'Maharashtra'),
(811, 'Mehkar', 'Maharashtra'),
(812, 'Mhaswad', 'Maharashtra'),
(813, 'Miraj', 'Maharashtra'),
(814, 'Morshi', 'Maharashtra'),
(815, 'Mukhed', 'Maharashtra'),
(816, 'Mul', 'Maharashtra'),
(817, 'Mumbai', 'Maharashtra'),
(818, 'Murtijapur', 'Maharashtra'),
(819, 'Nagpur', 'Maharashtra'),
(820, 'Nalasopara', 'Maharashtra'),
(821, 'Nanded-Waghala', 'Maharashtra'),
(822, 'Nandgaon', 'Maharashtra'),
(823, 'Nandura', 'Maharashtra'),
(824, 'Nandurbar', 'Maharashtra'),
(825, 'Narkhed', 'Maharashtra'),
(826, 'Nashik', 'Maharashtra'),
(827, 'Navi Mumbai', 'Maharashtra'),
(828, 'Nawapur', 'Maharashtra'),
(829, 'Nilanga', 'Maharashtra'),
(830, 'Osmanabad', 'Maharashtra'),
(831, 'Ozar', 'Maharashtra'),
(832, 'Pachora', 'Maharashtra'),
(833, 'Paithan', 'Maharashtra'),
(834, 'Palghar', 'Maharashtra'),
(835, 'Pandharkaoda', 'Maharashtra'),
(836, 'Pandharpur', 'Maharashtra'),
(837, 'Panvel', 'Maharashtra'),
(838, 'Parbhani', 'Maharashtra'),
(839, 'Parli', 'Maharashtra'),
(840, 'Parola', 'Maharashtra'),
(841, 'Partur', 'Maharashtra'),
(842, 'Pathardi', 'Maharashtra'),
(843, 'Pathri', 'Maharashtra'),
(844, 'Patur', 'Maharashtra'),
(845, 'Pauni', 'Maharashtra'),
(846, 'Pen', 'Maharashtra'),
(847, 'Phaltan', 'Maharashtra'),
(848, 'Pulgaon', 'Maharashtra'),
(849, 'Pune', 'Maharashtra'),
(850, 'Purna', 'Maharashtra'),
(851, 'Pusad', 'Maharashtra'),
(852, 'Rahuri', 'Maharashtra'),
(853, 'Rajura', 'Maharashtra'),
(854, 'Ramtek', 'Maharashtra'),
(855, 'Ratnagiri', 'Maharashtra'),
(856, 'Raver', 'Maharashtra'),
(857, 'Risod', 'Maharashtra'),
(858, 'Sailu', 'Maharashtra'),
(859, 'Sangamner', 'Maharashtra'),
(860, 'Sangli', 'Maharashtra'),
(861, 'Sangole', 'Maharashtra'),
(862, 'Sasvad', 'Maharashtra'),
(863, 'Satana', 'Maharashtra'),
(864, 'Satara', 'Maharashtra'),
(865, 'Savner', 'Maharashtra'),
(866, 'Sawantwadi', 'Maharashtra'),
(867, 'Shahade', 'Maharashtra'),
(868, 'Shegaon', 'Maharashtra'),
(869, 'Shendurjana', 'Maharashtra'),
(870, 'Shirdi', 'Maharashtra'),
(871, 'Shirpur-Warwade', 'Maharashtra'),
(872, 'Shirur', 'Maharashtra'),
(873, 'Shrigonda', 'Maharashtra'),
(874, 'Shrirampur', 'Maharashtra'),
(875, 'Sillod', 'Maharashtra'),
(876, 'Sinnar', 'Maharashtra'),
(877, 'Solapur', 'Maharashtra'),
(878, 'Soyagaon', 'Maharashtra'),
(879, 'Talegaon Dabhade', 'Maharashtra'),
(880, 'Talode', 'Maharashtra'),
(881, 'Tasgaon', 'Maharashtra'),
(882, 'Tirora', 'Maharashtra'),
(883, 'Tuljapur', 'Maharashtra'),
(884, 'Tumsar', 'Maharashtra'),
(885, 'Uran', 'Maharashtra'),
(886, 'Uran Islampur', 'Maharashtra'),
(887, 'Wadgaon Road', 'Maharashtra'),
(888, 'Wai', 'Maharashtra'),
(889, 'Wani', 'Maharashtra'),
(890, 'Wardha', 'Maharashtra'),
(891, 'Warora', 'Maharashtra'),
(892, 'Warud', 'Maharashtra'),
(893, 'Washim', 'Maharashtra'),
(894, 'Yevla', 'Maharashtra'),
(895, 'Uchgaon', 'Maharashtra'),
(896, 'Udgir', 'Maharashtra'),
(897, 'Umarga', 'Maharashtra'),
(898, 'Umarkhed', 'Maharashtra'),
(899, 'Umred', 'Maharashtra'),
(900, 'Vadgaon Kasba', 'Maharashtra'),
(901, 'Vaijapur', 'Maharashtra'),
(902, 'Vasai', 'Maharashtra'),
(903, 'Virar', 'Maharashtra'),
(904, 'Vita', 'Maharashtra'),
(905, 'Yavatmal', 'Maharashtra'),
(906, 'Yawal', 'Maharashtra'),
(907, 'Imphal', 'Manipur'),
(908, 'Kakching', 'Manipur'),
(909, 'Lilong', 'Manipur'),
(910, 'Mayang Imphal', 'Manipur'),
(911, 'Thoubal', 'Manipur'),
(912, 'Jowai', 'Meghalaya'),
(913, 'Nongstoin', 'Meghalaya'),
(914, 'Shillong', 'Meghalaya'),
(915, 'Tura', 'Meghalaya'),
(916, 'Aizawl', 'Mizoram'),
(917, 'Champhai', 'Mizoram'),
(918, 'Lunglei', 'Mizoram'),
(919, 'Saiha', 'Mizoram'),
(920, 'Dimapur', 'Nagaland'),
(921, 'Kohima', 'Nagaland'),
(922, 'Mokokchung', 'Nagaland'),
(923, 'Tuensang', 'Nagaland'),
(924, 'Wokha', 'Nagaland'),
(925, 'Zunheboto', 'Nagaland'),
(950, 'Anandapur', 'Orissa'),
(951, 'Anugul', 'Orissa'),
(952, 'Asika', 'Orissa'),
(953, 'Balangir', 'Orissa'),
(954, 'Balasore', 'Orissa'),
(955, 'Baleshwar', 'Orissa'),
(956, 'Bamra', 'Orissa'),
(957, 'Barbil', 'Orissa'),
(958, 'Bargarh', 'Orissa'),
(959, 'Bargarh', 'Orissa'),
(960, 'Baripada', 'Orissa'),
(961, 'Basudebpur', 'Orissa'),
(962, 'Belpahar', 'Orissa'),
(963, 'Bhadrak', 'Orissa'),
(964, 'Bhawanipatna', 'Orissa'),
(965, 'Bhuban', 'Orissa'),
(966, 'Bhubaneswar', 'Orissa'),
(967, 'Biramitrapur', 'Orissa'),
(968, 'Brahmapur', 'Orissa'),
(969, 'Brajrajnagar', 'Orissa'),
(970, 'Byasanagar', 'Orissa'),
(971, 'Cuttack', 'Orissa'),
(972, 'Debagarh', 'Orissa'),
(973, 'Dhenkanal', 'Orissa'),
(974, 'Gunupur', 'Orissa'),
(975, 'Hinjilicut', 'Orissa'),
(976, 'Jagatsinghapur', 'Orissa'),
(977, 'Jajapur', 'Orissa'),
(978, 'Jaleswar', 'Orissa'),
(979, 'Jatani', 'Orissa'),
(980, 'Jeypur', 'Orissa'),
(981, 'Jharsuguda', 'Orissa'),
(982, 'Joda', 'Orissa'),
(983, 'Kantabanji', 'Orissa'),
(984, 'Karanjia', 'Orissa'),
(985, 'Kendrapara', 'Orissa'),
(986, 'Kendujhar', 'Orissa'),
(987, 'Khordha', 'Orissa'),
(988, 'Koraput', 'Orissa'),
(989, 'Malkangiri', 'Orissa'),
(990, 'Nabarangapur', 'Orissa'),
(991, 'Paradip', 'Orissa'),
(992, 'Parlakhemundi', 'Orissa'),
(993, 'Pattamundai', 'Orissa'),
(994, 'Phulabani', 'Orissa'),
(995, 'Puri', 'Orissa'),
(996, 'Rairangpur', 'Orissa'),
(997, 'Rajagangapur', 'Orissa'),
(998, 'Raurkela', 'Orissa'),
(999, 'Rayagada', 'Orissa'),
(1000, 'Sambalpur', 'Orissa'),
(1001, 'Soro', 'Orissa'),
(1002, 'Sunabeda', 'Orissa'),
(1003, 'Sundargarh', 'Orissa'),
(1004, 'Talcher', 'Orissa'),
(1005, 'Titlagarh', 'Orissa'),
(1006, 'Umarkote', 'Orissa'),
(1007, 'Karaikal', 'Pondicherry'),
(1008, 'Mahe', 'Pondicherry'),
(1009, 'Pondicherry', 'Pondicherry'),
(1010, 'Yanam', 'Pondicherry'),
(1011, 'Ahmedgarh', 'Punjab'),
(1012, 'Amritsar', 'Punjab'),
(1013, 'Barnala', 'Punjab'),
(1014, 'Batala', 'Punjab'),
(1015, 'Bathinda', 'Punjab'),
(1016, 'Bhagha Purana', 'Punjab'),
(1017, 'Budhlada', 'Punjab'),
(1018, 'Chandigarh', 'Punjab'),
(1019, 'Dasua', 'Punjab'),
(1020, 'Dhuri', 'Punjab'),
(1021, 'Dinanagar', 'Punjab'),
(1022, 'Faridkot', 'Punjab'),
(1023, 'Fazilka', 'Punjab'),
(1024, 'Firozpur', 'Punjab'),
(1025, 'Firozpur Cantt.', 'Punjab'),
(1026, 'Giddarbaha', 'Punjab'),
(1027, 'Gobindgarh', 'Punjab'),
(1028, 'Gurdaspur', 'Punjab'),
(1029, 'Hoshiarpur', 'Punjab'),
(1030, 'Jagraon', 'Punjab'),
(1031, 'Jaitu', 'Punjab'),
(1032, 'Jalalabad', 'Punjab'),
(1033, 'Jalandhar', 'Punjab'),
(1034, 'Jalandhar Cantt.', 'Punjab'),
(1035, 'Jandiala', 'Punjab'),
(1036, 'Kapurthala', 'Punjab'),
(1037, 'Karoran', 'Punjab'),
(1038, 'Kartarpur', 'Punjab'),
(1039, 'Khanna', 'Punjab'),
(1040, 'Kharar', 'Punjab'),
(1041, 'Kot Kapura', 'Punjab'),
(1042, 'Kurali', 'Punjab'),
(1043, 'Longowal', 'Punjab'),
(1044, 'Ludhiana', 'Punjab'),
(1045, 'Malerkotla', 'Punjab'),
(1046, 'Malout', 'Punjab'),
(1047, 'Mansa', 'Punjab'),
(1048, 'Maur', 'Punjab'),
(1049, 'Moga', 'Punjab'),
(1050, 'Mohali', 'Punjab'),
(1051, 'Morinda', 'Punjab'),
(1052, 'Mukerian', 'Punjab'),
(1053, 'Muktsar', 'Punjab'),
(1054, 'Nabha', 'Punjab'),
(1055, 'Nakodar', 'Punjab'),
(1056, 'Nangal', 'Punjab'),
(1057, 'Nawanshahr', 'Punjab'),
(1058, 'Pathankot', 'Punjab'),
(1059, 'Patiala', 'Punjab'),
(1060, 'Patran', 'Punjab'),
(1061, 'Patti', 'Punjab'),
(1062, 'Phagwara', 'Punjab'),
(1063, 'Phillaur', 'Punjab'),
(1064, 'Qadian', 'Punjab'),
(1065, 'Raikot', 'Punjab'),
(1066, 'Rajpura', 'Punjab'),
(1067, 'Rampura Phul', 'Punjab'),
(1068, 'Rupnagar', 'Punjab'),
(1069, 'Samana', 'Punjab'),
(1070, 'Sangrur', 'Punjab'),
(1071, 'Sirhind Fatehgarh Sahib', 'Punjab'),
(1072, 'Sujanpur', 'Punjab'),
(1073, 'Sunam', 'Punjab'),
(1074, 'Talwara', 'Punjab'),
(1075, 'Tarn Taran', 'Punjab'),
(1076, 'Urmar Tanda', 'Punjab'),
(1077, 'Zira', 'Punjab'),
(1078, 'Zirakpur', 'Punjab'),
(1079, 'Bali', 'Rajastan'),
(1080, 'Banswara', 'Rajastan'),
(1081, 'Ajmer', 'Rajasthan'),
(1082, 'Alwar', 'Rajasthan'),
(1083, 'Bandikui', 'Rajasthan'),
(1084, 'Baran', 'Rajasthan'),
(1085, 'Barmer', 'Rajasthan'),
(1086, 'Bikaner', 'Rajasthan'),
(1087, 'Fatehpur', 'Rajasthan'),
(1088, 'Jaipur', 'Rajasthan'),
(1089, 'Jaisalmer', 'Rajasthan'),
(1090, 'Jodhpur', 'Rajasthan'),
(1091, 'Kota', 'Rajasthan'),
(1092, 'Lachhmangarh', 'Rajasthan'),
(1093, 'Ladnu', 'Rajasthan'),
(1094, 'Lakheri', 'Rajasthan'),
(1095, 'Lalsot', 'Rajasthan'),
(1096, 'Losal', 'Rajasthan'),
(1097, 'Makrana', 'Rajasthan'),
(1098, 'Malpura', 'Rajasthan'),
(1099, 'Mandalgarh', 'Rajasthan'),
(1100, 'Mandawa', 'Rajasthan'),
(1101, 'Mangrol', 'Rajasthan'),
(1102, 'Merta City', 'Rajasthan'),
(1103, 'Mount Abu', 'Rajasthan'),
(1104, 'Nadbai', 'Rajasthan'),
(1105, 'Nagar', 'Rajasthan'),
(1106, 'Nagaur', 'Rajasthan'),
(1107, 'Nargund', 'Rajasthan'),
(1108, 'Nasirabad', 'Rajasthan'),
(1109, 'Nathdwara', 'Rajasthan'),
(1110, 'Navalgund', 'Rajasthan'),
(1111, 'Nawalgarh', 'Rajasthan'),
(1112, 'Neem-Ka-Thana', 'Rajasthan'),
(1113, 'Nelamangala', 'Rajasthan'),
(1114, 'Nimbahera', 'Rajasthan'),
(1115, 'Nipani', 'Rajasthan'),
(1116, 'Niwai', 'Rajasthan'),
(1117, 'Nohar', 'Rajasthan'),
(1118, 'Nokha', 'Rajasthan'),
(1119, 'Pali', 'Rajasthan'),
(1120, 'Phalodi', 'Rajasthan'),
(1121, 'Phulera', 'Rajasthan'),
(1122, 'Pilani', 'Rajasthan'),
(1123, 'Pilibanga', 'Rajasthan'),
(1124, 'Pindwara', 'Rajasthan'),
(1125, 'Pipar City', 'Rajasthan'),
(1126, 'Prantij', 'Rajasthan'),
(1127, 'Pratapgarh', 'Rajasthan'),
(1128, 'Raisinghnagar', 'Rajasthan'),
(1129, 'Rajakhera', 'Rajasthan'),
(1130, 'Rajaldesar', 'Rajasthan'),
(1131, 'Rajgarh (Alwar)', 'Rajasthan'),
(1132, 'Rajgarh (Churu', 'Rajasthan'),
(1133, 'Rajsamand', 'Rajasthan'),
(1134, 'Ramganj Mandi', 'Rajasthan'),
(1135, 'Ramngarh', 'Rajasthan'),
(1136, 'Ratangarh', 'Rajasthan'),
(1137, 'Rawatbhata', 'Rajasthan'),
(1138, 'Rawatsar', 'Rajasthan'),
(1139, 'Reengus', 'Rajasthan'),
(1140, 'Sadri', 'Rajasthan'),
(1141, 'Sadulshahar', 'Rajasthan'),
(1142, 'Sagwara', 'Rajasthan'),
(1143, 'Sambhar', 'Rajasthan'),
(1144, 'Sanchore', 'Rajasthan'),
(1145, 'Sangaria', 'Rajasthan'),
(1146, 'Sardarshahar', 'Rajasthan'),
(1147, 'Sawai Madhopur', 'Rajasthan'),
(1148, 'Shahpura', 'Rajasthan'),
(1149, 'Shahpura', 'Rajasthan'),
(1150, 'Sheoganj', 'Rajasthan'),
(1151, 'Sikar', 'Rajasthan'),
(1152, 'Sirohi', 'Rajasthan'),
(1153, 'Sojat', 'Rajasthan'),
(1154, 'Sri Madhopur', 'Rajasthan'),
(1155, 'Sujangarh', 'Rajasthan'),
(1156, 'Sumerpur', 'Rajasthan'),
(1157, 'Suratgarh', 'Rajasthan'),
(1158, 'Taranagar', 'Rajasthan'),
(1159, 'Todabhim', 'Rajasthan'),
(1160, 'Todaraisingh', 'Rajasthan'),
(1161, 'Tonk', 'Rajasthan'),
(1162, 'Udaipur', 'Rajasthan'),
(1163, 'Udaipurwati', 'Rajasthan'),
(1164, 'Vijainagar', 'Rajasthan'),
(1165, 'Gangtok', 'Sikkim'),
(1166, 'Calcutta', 'West Bengal'),
(1167, 'Arakkonam', 'Tamil Nadu'),
(1168, 'Arcot', 'Tamil Nadu'),
(1169, 'Aruppukkottai', 'Tamil Nadu'),
(1170, 'Bhavani', 'Tamil Nadu'),
(1171, 'Chengalpattu', 'Tamil Nadu'),
(1172, 'Chennai', 'Tamil Nadu'),
(1173, 'Chinna salem', 'Tamil nadu'),
(1174, 'Coimbatore', 'Tamil Nadu'),
(1175, 'Coonoor', 'Tamil Nadu'),
(1176, 'Cuddalore', 'Tamil Nadu'),
(1177, 'Dharmapuri', 'Tamil Nadu'),
(1178, 'Dindigul', 'Tamil Nadu'),
(1179, 'Erode', 'Tamil Nadu'),
(1180, 'Gudalur', 'Tamil Nadu'),
(1181, 'Gudalur', 'Tamil Nadu'),
(1182, 'Gudalur', 'Tamil Nadu'),
(1183, 'Kanchipuram', 'Tamil Nadu'),
(1184, 'Karaikudi', 'Tamil Nadu'),
(1185, 'Karungal', 'Tamil Nadu'),
(1186, 'Karur', 'Tamil Nadu'),
(1187, 'Kollankodu', 'Tamil Nadu'),
(1188, 'Lalgudi', 'Tamil Nadu'),
(1189, 'Madurai', 'Tamil Nadu'),
(1190, 'Nagapattinam', 'Tamil Nadu'),
(1191, 'Nagercoil', 'Tamil Nadu'),
(1192, 'Namagiripettai', 'Tamil Nadu'),
(1193, 'Namakkal', 'Tamil Nadu'),
(1194, 'Nandivaram-Guduvancheri', 'Tamil Nadu'),
(1195, 'Nanjikottai', 'Tamil Nadu'),
(1196, 'Natham', 'Tamil Nadu'),
(1197, 'Nellikuppam', 'Tamil Nadu'),
(1198, 'Neyveli', 'Tamil Nadu'),
(1199, 'O\' Valley', 'Tamil Nadu'),
(1200, 'Oddanchatram', 'Tamil Nadu'),
(1201, 'P.N.Patti', 'Tamil Nadu'),
(1202, 'Pacode', 'Tamil Nadu'),
(1203, 'Padmanabhapuram', 'Tamil Nadu'),
(1204, 'Palani', 'Tamil Nadu'),
(1205, 'Palladam', 'Tamil Nadu'),
(1206, 'Pallapatti', 'Tamil Nadu'),
(1207, 'Pallikonda', 'Tamil Nadu'),
(1208, 'Panagudi', 'Tamil Nadu'),
(1209, 'Panruti', 'Tamil Nadu'),
(1210, 'Paramakudi', 'Tamil Nadu'),
(1211, 'Parangipettai', 'Tamil Nadu'),
(1212, 'Pattukkottai', 'Tamil Nadu'),
(1213, 'Perambalur', 'Tamil Nadu'),
(1214, 'Peravurani', 'Tamil Nadu'),
(1215, 'Periyakulam', 'Tamil Nadu'),
(1216, 'Periyasemur', 'Tamil Nadu'),
(1217, 'Pernampattu', 'Tamil Nadu'),
(1218, 'Pollachi', 'Tamil Nadu'),
(1219, 'Polur', 'Tamil Nadu'),
(1220, 'Ponneri', 'Tamil Nadu'),
(1221, 'Pudukkottai', 'Tamil Nadu'),
(1222, 'Pudupattinam', 'Tamil Nadu'),
(1223, 'Puliyankudi', 'Tamil Nadu'),
(1224, 'Punjaipugalur', 'Tamil Nadu'),
(1225, 'Rajapalayam', 'Tamil Nadu'),
(1226, 'Ramanathapuram', 'Tamil Nadu'),
(1227, 'Rameshwaram', 'Tamil Nadu'),
(1228, 'Rasipuram', 'Tamil Nadu'),
(1229, 'Salem', 'Tamil Nadu'),
(1230, 'Sankarankoil', 'Tamil Nadu'),
(1231, 'Sankari', 'Tamil Nadu'),
(1232, 'Sathyamangalam', 'Tamil Nadu'),
(1233, 'Sattur', 'Tamil Nadu'),
(1234, 'Shenkottai', 'Tamil Nadu'),
(1235, 'Sholavandan', 'Tamil Nadu'),
(1236, 'Sholingur', 'Tamil Nadu'),
(1237, 'Sirkali', 'Tamil Nadu'),
(1238, 'Sivaganga', 'Tamil Nadu'),
(1239, 'Sivagiri', 'Tamil Nadu'),
(1240, 'Sivakasi', 'Tamil Nadu'),
(1241, 'Srivilliputhur', 'Tamil Nadu'),
(1242, 'Surandai', 'Tamil Nadu'),
(1243, 'Suriyampalayam', 'Tamil Nadu'),
(1244, 'Tenkasi', 'Tamil Nadu'),
(1245, 'Thammampatti', 'Tamil Nadu'),
(1246, 'Thanjavur', 'Tamil Nadu'),
(1247, 'Tharamangalam', 'Tamil Nadu'),
(1248, 'Tharangambadi', 'Tamil Nadu'),
(1249, 'Theni Allinagaram', 'Tamil Nadu'),
(1250, 'Thirumangalam', 'Tamil Nadu'),
(1251, 'Thirunindravur', 'Tamil Nadu'),
(1252, 'Thiruparappu', 'Tamil Nadu'),
(1253, 'Thirupuvanam', 'Tamil Nadu'),
(1254, 'Thiruthuraipoondi', 'Tamil Nadu'),
(1255, 'Thiruvallur', 'Tamil Nadu'),
(1256, 'Thiruvarur', 'Tamil Nadu'),
(1257, 'Thoothukudi', 'Tamil Nadu'),
(1258, 'Thuraiyur', 'Tamil Nadu'),
(1259, 'Tindivanam', 'Tamil Nadu'),
(1260, 'Tiruchendur', 'Tamil Nadu'),
(1261, 'Tiruchengode', 'Tamil Nadu'),
(1262, 'Tiruchirappalli', 'Tamil Nadu'),
(1263, 'Tirukalukundram', 'Tamil Nadu'),
(1264, 'Tirukkoyilur', 'Tamil Nadu'),
(1265, 'Tirunelveli', 'Tamil Nadu'),
(1266, 'Tirupathur', 'Tamil Nadu'),
(1267, 'Tirupathur', 'Tamil Nadu'),
(1268, 'Tiruppur', 'Tamil Nadu'),
(1269, 'Tiruttani', 'Tamil Nadu'),
(1270, 'Tiruvannamalai', 'Tamil Nadu'),
(1271, 'Tiruvethipuram', 'Tamil Nadu'),
(1272, 'Tittakudi', 'Tamil Nadu'),
(1273, 'Udhagamandalam', 'Tamil Nadu'),
(1274, 'Udumalaipettai', 'Tamil Nadu'),
(1275, 'Unnamalaikadai', 'Tamil Nadu'),
(1276, 'Usilampatti', 'Tamil Nadu'),
(1277, 'Uthamapalayam', 'Tamil Nadu'),
(1278, 'Uthiramerur', 'Tamil Nadu'),
(1279, 'Vadakkuvalliyur', 'Tamil Nadu'),
(1280, 'Vadalur', 'Tamil Nadu'),
(1281, 'Vadipatti', 'Tamil Nadu'),
(1282, 'Valparai', 'Tamil Nadu'),
(1283, 'Vandavasi', 'Tamil Nadu'),
(1284, 'Vaniyambadi', 'Tamil Nadu'),
(1285, 'Vedaranyam', 'Tamil Nadu'),
(1286, 'Vellakoil', 'Tamil Nadu'),
(1287, 'Vellore', 'Tamil Nadu'),
(1288, 'Vikramasingapuram', 'Tamil Nadu'),
(1289, 'Viluppuram', 'Tamil Nadu'),
(1290, 'Virudhachalam', 'Tamil Nadu'),
(1291, 'Virudhunagar', 'Tamil Nadu'),
(1292, 'Viswanatham', 'Tamil Nadu'),
(1293, 'Agartala', 'Tripura'),
(1294, 'Badharghat', 'Tripura'),
(1295, 'Dharmanagar', 'Tripura'),
(1296, 'Indranagar', 'Tripura'),
(1297, 'Jogendranagar', 'Tripura'),
(1298, 'Kailasahar', 'Tripura'),
(1299, 'Khowai', 'Tripura'),
(1300, 'Pratapgarh', 'Tripura'),
(1301, 'Udaipur', 'Tripura'),
(1302, 'Achhnera', 'Uttar Pradesh'),
(1303, 'Adari', 'Uttar Pradesh'),
(1304, 'Agra', 'Uttar Pradesh'),
(1305, 'Aligarh', 'Uttar Pradesh'),
(1306, 'Allahabad', 'Uttar Pradesh'),
(1307, 'Amroha', 'Uttar Pradesh'),
(1308, 'Azamgarh', 'Uttar Pradesh'),
(1309, 'Bahraich', 'Uttar Pradesh'),
(1310, 'Ballia', 'Uttar Pradesh'),
(1311, 'Balrampur', 'Uttar Pradesh'),
(1312, 'Banda', 'Uttar Pradesh'),
(1313, 'Bareilly', 'Uttar Pradesh'),
(1314, 'Chandausi', 'Uttar Pradesh'),
(1315, 'Dadri', 'Uttar Pradesh'),
(1316, 'Deoria', 'Uttar Pradesh'),
(1317, 'Etawah', 'Uttar Pradesh'),
(1318, 'Fatehabad', 'Uttar Pradesh'),
(1319, 'Fatehpur', 'Uttar Pradesh'),
(1320, 'Fatehpur', 'Uttar Pradesh'),
(1321, 'Greater Noida', 'Uttar Pradesh'),
(1322, 'Hamirpur', 'Uttar Pradesh'),
(1323, 'Hardoi', 'Uttar Pradesh'),
(1324, 'Jajmau', 'Uttar Pradesh'),
(1325, 'Jaunpur', 'Uttar Pradesh'),
(1326, 'Jhansi', 'Uttar Pradesh'),
(1327, 'Kalpi', 'Uttar Pradesh'),
(1328, 'Kanpur', 'Uttar Pradesh'),
(1329, 'Kota', 'Uttar Pradesh'),
(1330, 'Laharpur', 'Uttar Pradesh'),
(1331, 'Lakhimpur', 'Uttar Pradesh'),
(1332, 'Lal Gopalganj Nindaura', 'Uttar Pradesh'),
(1333, 'Lalganj', 'Uttar Pradesh'),
(1334, 'Lalitpur', 'Uttar Pradesh'),
(1335, 'Lar', 'Uttar Pradesh'),
(1336, 'Loni', 'Uttar Pradesh'),
(1337, 'Lucknow', 'Uttar Pradesh'),
(1338, 'Mathura', 'Uttar Pradesh'),
(1339, 'Meerut', 'Uttar Pradesh'),
(1340, 'Modinagar', 'Uttar Pradesh'),
(1341, 'Muradnagar', 'Uttar Pradesh'),
(1342, 'Nagina', 'Uttar Pradesh'),
(1343, 'Najibabad', 'Uttar Pradesh'),
(1344, 'Nakur', 'Uttar Pradesh'),
(1345, 'Nanpara', 'Uttar Pradesh'),
(1346, 'Naraura', 'Uttar Pradesh'),
(1347, 'Naugawan Sadat', 'Uttar Pradesh'),
(1348, 'Nautanwa', 'Uttar Pradesh'),
(1349, 'Nawabganj', 'Uttar Pradesh'),
(1350, 'Nehtaur', 'Uttar Pradesh'),
(1351, 'NOIDA', 'Uttar Pradesh'),
(1352, 'Noorpur', 'Uttar Pradesh'),
(1353, 'Obra', 'Uttar Pradesh'),
(1354, 'Orai', 'Uttar Pradesh'),
(1355, 'Padrauna', 'Uttar Pradesh'),
(1356, 'Palia Kalan', 'Uttar Pradesh'),
(1357, 'Parasi', 'Uttar Pradesh'),
(1358, 'Phulpur', 'Uttar Pradesh'),
(1359, 'Pihani', 'Uttar Pradesh'),
(1360, 'Pilibhit', 'Uttar Pradesh'),
(1361, 'Pilkhuwa', 'Uttar Pradesh'),
(1362, 'Powayan', 'Uttar Pradesh'),
(1363, 'Pukhrayan', 'Uttar Pradesh'),
(1364, 'Puranpur', 'Uttar Pradesh'),
(1365, 'Purquazi', 'Uttar Pradesh'),
(1366, 'Purwa', 'Uttar Pradesh'),
(1367, 'Rae Bareli', 'Uttar Pradesh'),
(1368, 'Rampur', 'Uttar Pradesh'),
(1369, 'Rampur Maniharan', 'Uttar Pradesh'),
(1370, 'Rasra', 'Uttar Pradesh'),
(1371, 'Rath', 'Uttar Pradesh'),
(1372, 'Renukoot', 'Uttar Pradesh'),
(1373, 'Reoti', 'Uttar Pradesh'),
(1374, 'Robertsganj', 'Uttar Pradesh'),
(1375, 'Rudauli', 'Uttar Pradesh'),
(1376, 'Rudrapur', 'Uttar Pradesh'),
(1377, 'Sadabad', 'Uttar Pradesh'),
(1378, 'Safipur', 'Uttar Pradesh'),
(1379, 'Saharanpur', 'Uttar Pradesh'),
(1380, 'Sahaspur', 'Uttar Pradesh'),
(1381, 'Sahaswan', 'Uttar Pradesh'),
(1382, 'Sahawar', 'Uttar Pradesh'),
(1383, 'Sahjanwa', 'Uttar Pradesh'),
(1384, 'Saidpur', ' Ghazipur'),
(1385, 'Sambhal', 'Uttar Pradesh'),
(1386, 'Samdhan', 'Uttar Pradesh'),
(1387, 'Samthar', 'Uttar Pradesh'),
(1388, 'Sandi', 'Uttar Pradesh'),
(1389, 'Sandila', 'Uttar Pradesh'),
(1390, 'Sardhana', 'Uttar Pradesh'),
(1391, 'Seohara', 'Uttar Pradesh'),
(1392, 'Shahabad', ' Hardoi'),
(1393, 'Shahabad', ' Rampur'),
(1394, 'Shahganj', 'Uttar Pradesh'),
(1395, 'Shahjahanpur', 'Uttar Pradesh'),
(1396, 'Shamli', 'Uttar Pradesh'),
(1397, 'Shamsabad', ' Agra'),
(1398, 'Shamsabad', ' Farrukhabad'),
(1399, 'Sherkot', 'Uttar Pradesh'),
(1400, 'Shikarpur', ' Bulandshahr'),
(1401, 'Shikohabad', 'Uttar Pradesh'),
(1402, 'Shishgarh', 'Uttar Pradesh'),
(1403, 'Siana', 'Uttar Pradesh'),
(1404, 'Sikanderpur', 'Uttar Pradesh'),
(1405, 'Sikandra Rao', 'Uttar Pradesh'),
(1406, 'Sikandrabad', 'Uttar Pradesh'),
(1407, 'Sirsaganj', 'Uttar Pradesh'),
(1408, 'Sirsi', 'Uttar Pradesh'),
(1409, 'Sitapur', 'Uttar Pradesh'),
(1410, 'Soron', 'Uttar Pradesh'),
(1411, 'Suar', 'Uttar Pradesh'),
(1412, 'Sultanpur', 'Uttar Pradesh'),
(1413, 'Sumerpur', 'Uttar Pradesh'),
(1414, 'Tanda', 'Uttar Pradesh'),
(1415, 'Tanda', 'Uttar Pradesh'),
(1416, 'Tetri Bazar', 'Uttar Pradesh'),
(1417, 'Thakurdwara', 'Uttar Pradesh'),
(1418, 'Thana Bhawan', 'Uttar Pradesh'),
(1419, 'Tilhar', 'Uttar Pradesh'),
(1420, 'Tirwaganj', 'Uttar Pradesh'),
(1421, 'Tulsipur', 'Uttar Pradesh'),
(1422, 'Tundla', 'Uttar Pradesh'),
(1423, 'Unnao', 'Uttar Pradesh'),
(1424, 'Utraula', 'Uttar Pradesh'),
(1425, 'Varanasi', 'Uttar Pradesh'),
(1426, 'Vrindavan', 'Uttar Pradesh'),
(1427, 'Warhapur', 'Uttar Pradesh'),
(1428, 'Zaidpur', 'Uttar Pradesh'),
(1429, 'Zamania', 'Uttar Pradesh'),
(1430, 'Almora', 'Uttarakhand'),
(1431, 'Bazpur', 'Uttarakhand'),
(1432, 'Chamba', 'Uttarakhand'),
(1433, 'Dehradun', 'Uttarakhand'),
(1434, 'Haldwani', 'Uttarakhand'),
(1435, 'Haridwar', 'Uttarakhand'),
(1436, 'Jaspur', 'Uttarakhand'),
(1437, 'Kashipur', 'Uttarakhand'),
(1438, 'kichha', 'Uttarakhand'),
(1439, 'Kotdwara', 'Uttarakhand'),
(1440, 'Manglaur', 'Uttarakhand'),
(1441, 'Mussoorie', 'Uttarakhand'),
(1442, 'Nagla', 'Uttarakhand'),
(1443, 'Nainital', 'Uttarakhand'),
(1444, 'Pauri', 'Uttarakhand'),
(1445, 'Pithoragarh', 'Uttarakhand'),
(1446, 'Ramnagar', 'Uttarakhand'),
(1447, 'Rishikesh', 'Uttarakhand'),
(1448, 'Roorkee', 'Uttarakhand'),
(1449, 'Rudrapur', 'Uttarakhand'),
(1450, 'Sitarganj', 'Uttarakhand'),
(1451, 'Tehri', 'Uttarakhand'),
(1452, 'Muzaffarnagar', 'Uttarpradesh'),
(1453, 'Adra', ' Purulia'),
(1454, 'Alipurduar', 'West Bengal'),
(1455, 'Arambagh', 'West Bengal'),
(1456, 'Asansol', 'West Bengal'),
(1457, 'Baharampur', 'West Bengal'),
(1458, 'Bally', 'West Bengal'),
(1459, 'Balurghat', 'West Bengal'),
(1460, 'Bankura', 'West Bengal'),
(1461, 'Barakar', 'West Bengal'),
(1462, 'Barasat', 'West Bengal'),
(1463, 'Bardhaman', 'West Bengal'),
(1464, 'Bidhan Nagar', 'West Bengal'),
(1465, 'Chinsura', 'West Bengal'),
(1466, 'Contai', 'West Bengal'),
(1467, 'Cooch Behar', 'West Bengal'),
(1468, 'Darjeeling', 'West Bengal'),
(1469, 'Durgapur', 'West Bengal'),
(1470, 'Haldia', 'West Bengal'),
(1471, 'Howrah', 'West Bengal'),
(1472, 'Islampur', 'West Bengal'),
(1473, 'Jhargram', 'West Bengal'),
(1474, 'Kharagpur', 'West Bengal'),
(1475, 'Kolkata', 'West Bengal'),
(1476, 'Mainaguri', 'West Bengal'),
(1477, 'Mal', 'West Bengal'),
(1478, 'Mathabhanga', 'West Bengal'),
(1479, 'Medinipur', 'West Bengal'),
(1480, 'Memari', 'West Bengal'),
(1481, 'Monoharpur', 'West Bengal'),
(1482, 'Murshidabad', 'West Bengal'),
(1483, 'Nabadwip', 'West Bengal'),
(1484, 'Naihati', 'West Bengal'),
(1485, 'Panchla', 'West Bengal'),
(1486, 'Pandua', 'West Bengal'),
(1487, 'Paschim Punropara', 'West Bengal'),
(1488, 'Purulia', 'West Bengal'),
(1489, 'Raghunathpur', 'West Bengal'),
(1490, 'Raiganj', 'West Bengal'),
(1491, 'Rampurhat', 'West Bengal'),
(1492, 'Ranaghat', 'West Bengal'),
(1493, 'Sainthia', 'West Bengal'),
(1494, 'Santipur', 'West Bengal'),
(1495, 'Siliguri', 'West Bengal'),
(1496, 'Sonamukhi', 'West Bengal'),
(1497, 'Srirampore', 'West Bengal'),
(1498, 'Suri', 'West Bengal'),
(1499, 'Taki', 'West Bengal'),
(1500, 'Tamluk', 'West Bengal'),
(1501, 'Tarakeswar', 'West Bengal'),
(1502, 'Chikmagalur', 'Karnataka'),
(1503, 'Davanagere', 'Karnataka'),
(1504, 'Dharwad', 'Karnataka'),
(1505, 'Gadag', 'Karnataka'),
(1506, 'Chennai', 'Tamil Nadu'),
(1507, 'Coimbatore', 'Tamil Nadu');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` int(10) NOT NULL,
  `content` text NOT NULL,
  `created_by` int(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `title`, `subject`, `status`, `content`, `created_by`, `date_created`) VALUES
(2, ' Welcome Email', 'Subject', 1, '<p>&nbsp;</p><p>Hi&nbsp;&nbsp;{first_name},</p><p>Regards,</p><p>{system_user_name}</p><p>&nbsp;</p>', 1, '2017-11-29 01:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `followups`
--

CREATE TABLE `followups` (
  `id` int(10) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `followup_type` varchar(255) DEFAULT NULL,
  `follow_date` date DEFAULT NULL,
  `remarks` text,
  `created_by` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followups`
--

INSERT INTO `followups` (`id`, `lead_id`, `followup_type`, `follow_date`, `remarks`, `created_by`, `date_created`) VALUES
(2, 6, '2', '2018-10-11', 'Site at 12:00 AM', '1', '2018-10-07 23:28:13'),
(6, 7, '1', '2018-10-08', 'Dummy', '1', '2018-10-08 15:26:37'),
(7, 1, '2', '2018-10-30', 'aa', '1', '2018-10-09 12:22:56'),
(8, 419, '0', NULL, '', '1', '2019-02-09 21:20:01'),
(9, 420, '0', NULL, '', '1', '2019-02-09 21:21:22'),
(10, 433, '0', NULL, '', '1', '2019-02-14 12:07:50'),
(11, 434, '0', NULL, '', '1', '2019-02-14 12:09:14'),
(12, 435, '0', NULL, '', '1', '2019-02-14 12:10:36'),
(13, 436, '0', NULL, '', '1', '2019-02-14 12:11:09'),
(14, 437, '0', NULL, '', '1', '2019-02-14 12:11:48'),
(15, 438, '0', NULL, '', '1', '2019-02-14 12:13:31'),
(16, 491, '0', NULL, '', '1', '2019-03-20 16:08:32'),
(17, 1908, '0', NULL, '', '1', '2020-01-09 12:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `followup_types`
--

CREATE TABLE `followup_types` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followup_types`
--

INSERT INTO `followup_types` (`id`, `name`, `status`, `date_created`) VALUES
(1, 'Telephonic', 1, '2017-12-07 11:27:56'),
(2, 'Site Visit', 1, '2017-12-07 11:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `location` int(10) DEFAULT NULL,
  `configuration` varchar(255) DEFAULT NULL,
  `project` int(10) DEFAULT NULL,
  `campaign` int(10) DEFAULT NULL,
  `source` int(10) DEFAULT NULL,
  `interested` int(10) DEFAULT '0',
  `remarks` text,
  `status` varchar(255) DEFAULT NULL,
  `junk` tinyint(1) DEFAULT '0',
  `visited` tinyint(1) DEFAULT '0',
  `closed` int(2) DEFAULT '0',
  `created_by` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `first_name`, `last_name`, `contact`, `email`, `city`, `state`, `location`, `configuration`, `project`, `campaign`, `source`, `interested`, `remarks`, `status`, `junk`, `visited`, `closed`, `created_by`, `date_created`) VALUES
(1, 'Vikas', 'Agale', '9820808025', 'vikas_agale@yahoo.com', '817', '1', 8, '1', 1, 1, 10, 0, '', '1', NULL, NULL, NULL, '1', '2021-01-27 17:53:37'),
(2, 'Sanjay', 'Nayak', '9892256921', 'sanjaynayakco@gmail', '817', '1', 8, '1', 1, 1, 10, 0, '', '1', NULL, NULL, NULL, '1', '2021-01-27 17:54:38'),
(3, 'Sachin', 'Parab', '09987315666', 'beingsachin@rocketmail.com', '817', '1', 8, '1', 1, 1, 10, 0, '', '1', NULL, NULL, NULL, '1', '2021-01-27 17:55:31'),
(4, 'Shelley ', 'Sanders', '+1 (383) 149-7183', 'wuwawipyxy@mailinator.com', NULL, '0', 7, '1', 1, 3, 10, 0, '', '1', 0, 0, 0, '1', '2021-01-27 06:30:49'),
(5, 'Benjamin Yang', '', '+1 (786) 505-9552', 'kaqalo@mailinator.com', '0', '0', 0, '1', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-01-27 06:36:34'),
(6, 'Yvonne Calhoun', '', '+1 (706) 603-1671', 'kidohaqucy@mailinator.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-01-27 06:40:39'),
(7, 'Rickie Bayer', '', '14367059755', 'meesh401@gmail.com', '0', '0', 0, '1', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-01-27 09:23:56'),
(8, 'LMXkDrxlCPq', '', '2246625186', 'randallmariah7@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-01-29 20:58:14'),
(9, 'Madonna Summers', '', '+1 (714) 416-5973', 'vavyry@mailinator.com', '0', '0', 0, '3', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-02 03:09:07'),
(10, 'test lead: dummy data for full_name', '-', 'test lead: dummy data for phone_number', 'test@fb.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-04 14:31:09'),
(11, 'Dharmendra Tiwari', '-', '+919869678533', 'dtt9869@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-04 23:42:19'),
(12, 'Dinesh Kukreja', '-', '+919819422186', 'dadkuk@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-05 01:52:41'),
(13, 'Sunil Shahakar', '-', '+919869072616', 'sunilshahakar@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-05 08:16:35'),
(14, 'Asma qazi', '', '9930857533', 'najmaqazi17@gmail.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-05 05:17:16'),
(15, 'Aurora Ramirez', '', '998-646-18-05', 'AuroraRamirez.253825208@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-05 17:06:04'),
(16, 'niWPRXtAO', '', '8636456770', 'weimannddpta89@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-06 06:19:15'),
(17, 'kIdCfSoMDAjiP', '', '2302775937', 'weimannddpta89@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-06 06:19:18'),
(18, 'Lekhraj Narashing Chorotiya', '', '+8779830284', 'lekhrajchorotiya97@gmail.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-06 09:02:44'),
(19, 'Lekhraj Narashing Chorotiya', '', '+8779830284', 'lekhrajchorotiya97@gmail.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-06 09:03:17'),
(20, 'Lekhraj Narashing Chorotiya', '', '8779830284', 'lekhrajchorotiya97@gmail.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-06 09:03:38'),
(21, 'Lekhraj Narashing Chorotiya', '', '+918879046005', 'lekhrajchorotiya97@gmail.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-06 09:03:48'),
(22, 'Lekhraj Narashing Chorotiya', '', '+8779830284', 'lekhrajchorotiya97@gmail.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-06 09:04:10'),
(23, 'realsquarevalue.com', '-', '+919820058503', 'contact@realsquarevalue.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-07 00:55:45'),
(24, 'Audrey Long', '', '553-406-47-01', 'AudreyLong.255978902@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-06 13:43:50'),
(25, 'Joe Miller', '', '+12548593423', 'info@domainregistercorp.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-06 21:03:59'),
(26, 'Joe Miller', '', '+12548593423', 'info@domainregistercorp.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-06 23:45:04'),
(27, 'Joe Miller', '', '+12548593423', 'info@domainregistercorp.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-07 02:33:17'),
(28, 'Joe Miller', '', '+12548593423', 'info@domainregistercorp.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-07 02:57:55'),
(29, 'Aria Baker', '', '088-716-36-97', 'AriaBaker.258366107@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-07 13:42:33'),
(30, 'Mayuresh Thakur', '-', '+919819710508', 'thakur_mayuresh@yahoo.co.in', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-08 20:30:50'),
(31, 'Miles Parker', '', '746-091-18-99', 'MilesParker.260796908@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-08 13:37:45'),
(32, 'Matthew James', '', '216-570-95-84', 'MatthewJames.263433308@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-09 13:36:32'),
(33, 'qnJYdOFfBUQy', '', '6911291389', 'grimesvafth54@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-09 19:18:47'),
(34, 'QUvthmEGbBTXV', '', '2703933185', 'grimesvafth54@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-09 19:18:50'),
(35, 'Charles Anderson', '', '836-692-74-44', 'CharlesAnderson.265927808@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-10 13:20:39'),
(36, 'GAUTAM MANGAL', '', '+919820911882', 'gautam.mangal@gmail.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-10 22:48:46'),
(37, 'Nathan Brown', '', '625-054-19-45', 'NathanBrown.268499108@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-11 13:40:49'),
(38, 'Kamal Rajpal', '-', '+8613566006216', 'sumaco@vip.sina.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-12 18:45:47'),
(39, 'Sanjay Shah', '-', '+919820549962', 'Karianshah@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-12 18:54:08'),
(40, 'Sandesh', '-', '+919167221126', 'jainsandesh@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-12 21:11:15'),
(41, 'Cooper Gray', '', '354-127-24-82', 'CooperGray.270986108@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-12 13:32:01'),
(42, 'Uday Chitnis', '-', '+919321863629', 'uchitnis3@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-13 09:02:09'),
(43, 'R.bhukan ji', '-', '+918378031094', 'tevri123@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-13 17:41:30'),
(44, 'Nikesh Jain ', '', '9768907775', 'remaxsunrealtors@gmail.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-13 05:17:12'),
(45, 'Suman Bhatia (Channel Partner)', '-', '+919619454593', 'sumanbhatia_5@hotmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-13 19:06:37'),
(46, 'BpdWsnGtfVQhL', '', '8441358612', 'christiansenksa80@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-13 07:08:16'),
(47, 'iKvrjstUnFSBOMWu', '', '6186730617', 'christiansenksa80@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-13 07:08:21'),
(48, 'sudhakar mhatre', '-', '+919967584069', 'mhatre@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-13 21:32:06'),
(49, 'Attique Ahmad', '-', '+918976689692', 'attique9403@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-13 23:22:06'),
(50, 'Naidu Biswajeet', '-', '+9109820072744', 'biswajeetnaidu@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-14 00:04:36'),
(51, 'Connor Adams', '', '250-486-22-57', 'ConnorAdams.273436508@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-13 13:31:41'),
(52, 'Sanjay Singh', '-', '+919833553082', 'startupbiz1972@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-14 12:59:56'),
(53, 'Sunil Chaudhari', '-', '+919892656199', 'sunchau2003@yahoo.co.in', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-14 15:06:27'),
(54, 'Bashir Ahmad Bashir Bhai', '-', '+918433684723', 'basheersheikh922@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-14 18:13:03'),
(55, 'akshar mistry', '-', '+919320304297', 'prdpmistry@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-14 22:35:31'),
(56, 'Ethan Price', '', '915-715-72-14', 'EthanPrice.275879708@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-14 13:27:18'),
(57, 'Devanand Jaiswal', '-', '+919892645159', 'jaiswaldevanand0@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-15 20:10:04'),
(58, 'Layla Foster', '', '014-870-92-93', 'LaylaFoster.278145797@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-15 13:45:08'),
(59, 'Ravikant Jaiswal', '-', '+917039866544', 'ravikantjaiswal201@gmailhay.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-16 08:25:02'),
(60, 'Subhash  singh Rathod', '-', '+919371884925', 'vardanconsultancy77@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-16 11:08:38'),
(61, 'Shafeeq Rahim', '-', '+919326862012', 'arrowimpex@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-16 11:23:20'),
(62, 'Sunil Kumar Ramsay', '-', '+919821254234', 'sunilramsay@crematrix.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-16 16:21:59'),
(63, 'Shahid Ali', '-', '+919503745692', 'shahid95037@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-16 16:51:58'),
(64, 'Vishal More', '-', '+917045048103', 'vishalmore5@yahoo.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-16 18:17:29'),
(65, 'Dhashrath Rwalunj', '-', '+918898715265', 'dashrathwalunj1111@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-16 21:50:04'),
(66, 'Ramji Shahu', '-', '+17802961379', 'ramjisahu0846@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-16 23:27:44'),
(67, 'Audrey Flores', '', '733-056-73-35', 'AudreyFlores.280337108@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-16 14:19:02'),
(68, 'Anil Manyal ( KHUSHAL PROPERTIES REAL ESTATE AGENT)', '-', '+919821093577', 'khushalproperties@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-17 08:55:36'),
(69, 'Shaitan Singh', '-', '+917023184016', 'ddchundawat@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-17 12:31:55'),
(70, 'Rajesh Kashyap', '-', '+918655471072', 'rkelectricalsid@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-17 14:21:23'),
(71, 'Sanjay Ghanekar', '-', '+918291219755', 'sanjayghanekar179@gmail.com', '7', '1', 7, '1', 1, 4, 13, 1, 'Facebook Lead', '1', 0, 0, 0, '1', '2021-02-17 14:36:23'),
(72, 'Lucas Bailey', '', '740-199-03-85', 'LucasBailey.282463208@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-17 14:16:24'),
(73, 'Abhishek', '', '8898007893', 'abhishek@mettleadvertising.in', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-17 23:32:17'),
(74, 'suprita Kulal', '', '8692071672', 'suprita99kulal@gmail.com', '0', '0', 0, '2', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-18 04:33:51'),
(75, 'Pearl Delgado', '', '+1 (304) 587-2841', 'mipiqof@mailinator.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-18 08:02:08'),
(76, 'Kaylee Howard', '', '042-223-96-49', 'KayleeHoward.284537108@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-18 14:01:41'),
(77, 'Vuvek singh', '', '7208480227', 'viveksingh8517@gmail.com', '0', '0', 0, '7', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-19 01:48:23'),
(78, 'Vuvek singh', '', '7208480227', 'viveksingh8517@gmail.com', '0', '0', 0, '7', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-19 01:48:24'),
(79, 'CiWrYZjOsd', '', '4800934419', 'naglefzkn22@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-19 03:50:05'),
(80, 'Brayden Ward', '', '774-460-86-12', 'BraydenWard.286362008@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-19 14:44:35'),
(81, 'rSdcihLInokmgyu', '', '4690694533', 'eversegkms17@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-19 19:41:50'),
(82, 'HbPUflEFoyIOisAk', '', '9336534414', 'eversegkms17@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-19 19:41:53'),
(83, 'Manu', '', '9867660973', 'Mohit.manu05@gmail.com', '0', '0', 0, '1', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-19 22:46:19'),
(84, 'Manu', '', '9867660973', 'Mohit.manu05@gmail.com', '0', '0', 0, '1', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-19 22:47:06'),
(85, 'Scarlett Bryant', '', '064-142-63-95', 'ScarlettBryant.288091208@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-20 15:33:40'),
(86, 'Noah Rivera', '', '162-283-60-38', 'NoahRivera.289697408@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-21 16:13:57'),
(87, 'Haresh khatwani ', '', '9920722623', 'sixsquarerealestate@gmail.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-22 03:22:58'),
(88, 'Emilia Lopez', '', '386-350-85-87', 'EmiliaLopez.291103808@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-22 15:28:10'),
(89, 'wSAPVfhpcyRDJ', '', '9375814665', 'anthonywhite3733@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-22 18:45:42'),
(90, 'oCErecfTl', '', '6219780453', 'anthonywhite3733@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-22 18:45:45'),
(91, 'Alice Lewis', '', '753-044-64-67', 'AliceLewis.293316384@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-23 13:28:32'),
(92, 'Hudson Stewart', '', '997-239-03-39', 'HudsonStewart.295810608@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-24 13:34:08'),
(93, 'viraj', '', '9987563469', 'viraj@mpchitale.com', '0', '0', 0, '8', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-24 20:29:38'),
(94, 'Roman Russell', '', '718-196-29-27', 'RomanRussell.298252208@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-25 13:31:44'),
(95, 'Rajesh', '', '9323434936', 'rla.rajeshagarwal@gmail.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-25 20:36:42'),
(96, 'Rajesh', '', '9323434936', 'rla.rajeshagarwal@gmail.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-25 20:37:34'),
(97, 'Rajesh', '', '9323434936', 'rla.rajeshagarwal@gmail.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-25 20:37:34'),
(98, 'Rajesh', '', '9323434936', 'rla.rajeshagarwal@gmail.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-25 20:37:35'),
(99, 'Rajesh', '', '9323434936', 'rla.rajeshagarwal@gmail.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-25 20:37:35'),
(100, 'Natalie Morgan', '', '052-035-14-68', 'NatalieMorgan.300708008@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-26 13:29:33'),
(101, 'Shabnam fayyaz', '', '9819734273', 'shabnamfayyaz8301@gmail.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-27 02:45:39'),
(102, 'Shabnam fayyaz', '', '9819734273', 'shabnamfayyaz8301@gmail.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-27 02:46:05'),
(103, 'Shabnam fayyaz', '', '9819734273', 'shabnamfayyaz8301@gmail.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-27 02:47:18'),
(104, 'Munira Rangwala', '', '07738875199', 'munniyusuf@hotmail.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-27 06:49:27'),
(105, 'OMKAR NILKANTH SHINDE', '', '07304714405', 'Shindeomkar170@gmail.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-27 10:41:14'),
(106, 'Luna Adams', '', '220-707-84-37', 'LunaAdams.303119108@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-27 13:36:26'),
(107, 'Chava Carney', '', '9876543210', 'gityfenu@mailinator.com', '0', '0', 0, '3', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-27 15:34:48'),
(108, 'Jameson Howard', '', '123-841-00-37', 'JamesonHoward.305501520@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-02-28 13:37:47'),
(109, 'Nevada Alvarez', '', '9876543210', 'pykoguj@mailinator.com', '0', '0', 0, '1', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-01 11:51:13'),
(110, 'Nathan Reed', '', '490-103-49-94', 'NathanReed.307885208@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-01 13:30:07'),
(111, 'Emilia Taylor', '', '715-876-32-44', 'EmiliaTaylor.310312808@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-02 13:33:57'),
(112, 'William Carter', '', '307-899-34-30', 'WilliamCarter.312726308@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-03 13:38:12'),
(113, 'CutEXnAdBKrF', '', '9486910800', 'bryantami366@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-04 00:38:31'),
(114, 'aGfvOCEhzou', '', '3692278174', 'bryantami366@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-04 00:38:54'),
(115, 'Brooklyn Bailey', '', '414-906-16-14', 'BrooklynBailey.315102608@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-04 13:34:29'),
(116, 'mohit ', '', '7977780023', 'etzzvmohit@gmail.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-05 04:31:32'),
(117, 'Hazel Perez', '', '845-840-70-47', 'HazelPerez.317500796@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-05 15:39:07'),
(118, 'Cora Phillips', '', '765-550-83-26', 'CoraPhillips.319717808@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-06 13:31:11'),
(119, 'dTCiHLPFwcxV', '', '5470653287', 'jettawgz06@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-06 21:21:18'),
(120, 'Chauhan', '', '7738069173', 'hsschauhan@gmail.com', '0', '0', 0, '1', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-07 10:25:33'),
(121, 'Chauhan', '', '7738069173', 'hsschauhan@gmail.com', '0', '0', 0, '1', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-07 10:37:03'),
(122, 'Charlotte Roberts', '', '220-960-52-70', 'CharlotteRoberts.322153508@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-07 13:35:09'),
(123, 'Guinevere Salazar', '', '9876543210', 'gyzogo@mailinator.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-08 04:13:29'),
(124, 'Maverick Harris', '', '029-423-68-07', 'MaverickHarris.324577508@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-08 13:32:12'),
(125, 'Oliver Baker', '', '283-459-84-78', 'OliverBaker.326996408@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-09 13:36:22'),
(126, 'Zoey Morris', '', '659-520-89-26', 'ZoeyMorris.329385008@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-10 13:33:38'),
(127, 'Sarah Carter', '', '312-504-67-47', 'SarahCarter.331771808@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-11 13:40:07'),
(128, 'Tasneem Kausar', '', '7506079643', 'tkausar117@gmail.com', '0', '0', 0, '2', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-12 07:55:10'),
(129, 'Autumn King', '', '864-336-46-16', 'AutumnKing.334164308@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-12 13:40:42'),
(130, 'Rajubhai R Gujarathi', '', '7666608728', 'raju1gujarathi@gmail.com', '0', '0', 0, '8', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-12 21:46:22'),
(131, 'Rajubhai R Gujarathi', '', '7666608728', 'raju1gujarathi@gmail.com', '0', '0', 0, '8', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-12 21:46:54'),
(132, 'Ashfaq Bukhari', '', '7303099993', 'iworld16@gmail.com', '0', '0', 0, '1', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-13 03:13:07'),
(133, 'LALITA', '', '8657432423', 'admindesk@tdfjewellery.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-13 05:50:43'),
(134, 'Gabriella Torres', '', '210-994-71-65', 'GabriellaTorres.336570308@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-13 13:42:54'),
(135, 'Nolan Russell', '', '500-992-68-12', 'NolanRussell.338994008@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-14 13:31:20'),
(136, 'Madeline Richardson', '', '402-743-19-07', 'MadelineRichardson.341424738@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-15 13:34:51'),
(137, 'William Thompson', '', '847-452-93-02', 'WilliamThompson.343797641@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-16 13:32:56'),
(138, 'KsaRQnPUmtolwAyS', '', '3827716919', 'parkscharles645@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-16 17:23:26'),
(139, 'Connor Evans', '', '503-577-74-54', 'ConnorEvans.346260616@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-17 13:35:21'),
(140, 'Amey Desai', '', '9833669811', 'arameydesai@gmail.com', '0', '0', 0, '1', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-18 02:39:10'),
(141, 'Sadie Patterson', '', '243-378-93-58', 'SadiePatterson.348634208@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-18 13:47:13'),
(142, 'Aaron White', '', '401-498-43-13', 'AaronWhite.350950208@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-19 13:39:03'),
(143, 'VjvUrwRAEutaDsbI', '', '6533176140', 'quentinblack709@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-19 14:19:30'),
(144, 'hZmIUaQnbsT', '', '7278071995', 'quentinblack709@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-19 14:19:32'),
(145, 'AAR ENETREPRIZE ', '', '8879098988', 'aarenetreprize1025@gmail.com', '0', '0', 0, '1', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-20 09:01:38'),
(146, 'santosh', '', '00971506709181', 'sanshetty786@yahoo.com', '0', '0', 0, '2', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-20 11:06:26'),
(147, 'santosh', '', '00971506709181', 'sanshetty786@yahoo.com', '0', '0', 0, '2', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-20 11:06:45'),
(148, 'Carter Campbell', '', '826-074-59-86', 'CarterCampbell.353369108@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-20 13:47:23'),
(149, 'santosh', '', '00971506709181', 'sanshetty786@Yahoo.com', '0', '0', 0, '2', 3, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-21 01:23:26'),
(150, 'Avery Ward', '', '483-021-51-69', 'AveryWard.355660208@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-21 13:45:57'),
(151, 'Vilash', '', '9663454530', 'vilashrathod2043@gmail.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-21 17:29:31'),
(152, 'Grace Baker', '', '548-835-48-53', 'GraceBaker.357945608@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-22 13:48:01'),
(153, 'PUmRyoubGlTCM', '', '2534794996', 'kennethbates838@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-22 18:01:43'),
(154, 'cxGNhzntDfdPMuH', '', '4342616091', 'kennethbates838@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-22 18:01:44'),
(155, 'Matthew Coleman', '', '147-967-51-87', 'MatthewColeman.360250208@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-23 13:46:55'),
(156, 'Kinsley Cook', '', '783-515-04-35', 'KinsleyCook.362563208@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-24 13:51:47'),
(157, 'Charles Alexander', '', '749-180-36-32', 'CharlesAlexander.364793708@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-25 13:55:53'),
(158, 'Levi Alexander', '', '819-015-40-37', 'LeviAlexander.367011608@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-26 13:47:28'),
(159, 'Liam Adams', '', '460-228-82-79', 'LiamAdams.369292208@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-27 13:47:42'),
(160, 'VvRFflyO', '', '9245824817', 'histeratenhz@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-27 22:49:09'),
(161, 'mangesh kadam', '', '08898831231', 'maksharu1976@gmail.com', '0', '0', 0, '2', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-28 00:03:55'),
(162, 'mangesh kadam', '', '08898831231', 'maksharu1976@gmail.com', '0', '0', 0, '2', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-28 00:04:01'),
(163, 'Gurvinder Singh', '', '9821160179', 'romy7975@gmail.com', '0', '0', 0, '8', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-28 05:17:09'),
(164, 'Valentina Sanders', '', '668-799-52-25', 'ValentinaSanders.371580308@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-28 13:48:57'),
(165, 'Chloe Parker', '', '583-366-47-73', 'ChloeParker.373861208@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-29 13:49:24'),
(166, 'Cameron Davis', '', '967-831-15-81', 'CameronDavis.376112708@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-30 14:01:55'),
(167, 'Isaiah Perry', '', '803-520-96-31', 'IsaiahPerry.378266708@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-03-31 14:07:40'),
(168, 'Noah Miller', '', '281-915-30-29', 'NoahMiller.380409608@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-01 14:08:17'),
(169, 'iCgGstPZNfTDJk', '', '4847718952', 'beftecouldqi@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-02 03:46:46'),
(170, 'Bella Foster', '', '250-406-03-70', 'BellaFoster.382557008@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-02 14:07:18'),
(171, 'Stella Thompson', '', '882-757-11-33', 'StellaThompson.384729608@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-03 14:10:03'),
(172, 'Samuel James', '', '107-593-82-20', 'SamuelJames.386837828@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-04 14:26:41'),
(173, 'John Foster', '', '741-821-35-11', 'JohnFoster.388871408@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-05 14:08:44'),
(174, 'Jameson Lewis', '', '214-543-05-83', 'JamesonLewis.390982808@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-06 14:08:29'),
(175, 'Noah King', '', '677-029-85-56', 'NoahKing.392995928@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-07 14:13:09'),
(176, 'AfXnPFBvgQhJ', '', '5684364942', 'houltioniw@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-07 14:42:31'),
(177, 'PpnHWhlIvy', '', '9308054463', 'houltioniw@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-07 14:42:33'),
(178, 'Sawyer Evans', '', '630-295-03-39', 'SawyerEvans.395121410@bimmering.shop', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-08 13:56:09'),
(179, 'Kirti Shankhdhar ', '', '9137486309', 'kirtishankhdhar@gmail.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-08 23:36:51'),
(180, 'Evan Morgan', '', '247-650-27-16', 'EvanMorgan.397287008@pluminclast.work', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-09 14:01:48'),
(181, 'Brayden Ward', '', '082-845-97-96', 'BraydenWard.399499208@pluminclast.work', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-10 14:00:53'),
(182, 'Owen Cook', '', '844-754-83-26', 'OwenCook.401685308@pluminclast.work', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-11 14:02:09'),
(183, 'Alankrita Shankhdhar Kirti Shankhdhar ', '', '9137486309', 'kirtishankhdhar@gmail.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-12 02:55:20'),
(184, 'Alankrita Shankhdhar Kirti Shankhdhar Kirti Shankhdhar ', '', '9137486309', 'kirtishankhdhar@gmail.com', '0', '0', 0, '6', 1, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-12 02:56:01'),
(185, 'Ava Kelly', '', '597-635-12-13', 'AvaKelly.403836908@pluminclast.work', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-12 14:02:29'),
(186, 'Noah Lee', '', '192-592-34-24', 'NoahLee.406020608@pluminclast.work', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-13 14:07:10'),
(187, 'Stella Parker', '', '746-653-79-53', 'StellaParker.408203108@pluminclast.work', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-14 14:00:41'),
(188, 'Hazel Perez', '', '372-144-89-15', 'HazelPerez.410324708@pluminclast.work', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-15 14:07:42'),
(189, 'Elijah Stewart', '', '759-213-63-63', 'ElijahStewart.412467308@pluminclast.work', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-16 14:07:09'),
(190, 'Eliana Wright', '', '827-705-52-00', 'ElianaWright.414655208@pluminclast.work', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-17 14:07:37'),
(191, 'PJuTMYzkhn', '', '8993305370', 'exachighbb@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-17 19:20:45'),
(192, 'oUOGiQnPyKked', '', '9718121133', 'exachighbb@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-17 19:20:48'),
(193, 'Shoeb', '', '9867221448', 'shoeb.ansari79@gmail.com', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-18 03:32:37'),
(194, 'Ruby Kelly', '', '859-217-00-24', 'RubyKelly.416827508@pluminclast.work', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-18 14:04:27'),
(195, 'IGfXyNWRBbhHseZ', '', '7339383666', 'thirsolyfa@gmail.com', '0', '0', 0, '9', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-19 12:57:01'),
(196, 'Carson Campbell', '', '873-317-43-58', 'CarsonCampbell.418979108@pluminclast.work', '0', '0', 0, '1', 2, 14, 10, 1, '0', '1', 0, 0, 0, NULL, '2021-04-19 14:08:31');

-- --------------------------------------------------------

--
-- Table structure for table `lead_source`
--

CREATE TABLE `lead_source` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT 'fa fa-internet-explorer',
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lead_source`
--

INSERT INTO `lead_source` (`id`, `name`, `icon`, `status`, `created_by`, `date_created`) VALUES
(4, 'Instagram', 'fab fa-flickr', 1, 1, '2018-10-07 12:49:52'),
(5, 'SMS', 'fas fa-comment-alt', 1, 1, '2018-10-08 13:10:27'),
(9, 'Website', 'fa fa-globe', 1, 1, '2018-10-07 12:48:39'),
(10, 'Microsite', 'fab fa-internet-explorer', 1, 1, '2018-10-07 12:48:25'),
(12, 'Google', 'fab fa-google', 1, 1, '2018-10-07 12:50:21'),
(13, 'Facebook', 'fab fa-facebook', 1, 1, '2018-10-07 12:47:29'),
(14, 'Chatbot', 'fas fa-rocket', 1, 1, '2019-12-06 00:13:28'),
(27, 'Consultants', 'far fa-handshake', 1, 1, '2020-01-16 18:21:02');

-- --------------------------------------------------------

--
-- Table structure for table `lead_status`
--

CREATE TABLE `lead_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `color` varchar(255) DEFAULT '#000',
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lead_status`
--

INSERT INTO `lead_status` (`id`, `name`, `status`, `color`, `created_by`, `date_created`) VALUES
(1, 'Hot', 1, '#f55753', 1, '2018-10-07 09:29:54'),
(2, 'Cold', 1, '#47bf9c', 1, '2018-10-07 09:32:49'),
(3, 'Warm', 1, '#fbe444', 1, '2018-10-07 09:33:24');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `action_name` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `action`, `action_name`, `user`, `date_created`) VALUES
(1, 'SmsTemplates Edited', 'title', 'admin@centrumrema.co.in', '2018-10-11 00:31:19'),
(2, 'EmailTemplates Edited', ' Welcome Email', 'admin@centrumrema.co.in', '2018-10-11 00:36:05'),
(3, 'Campaign Added', '2', 'admin@centrumrema.co.in', '2018-12-06 19:07:07'),
(4, 'Lead Added', '392', 'admin@centrumrema.co.in', '2018-12-13 21:08:40'),
(5, 'Lead Added', '393', 'admin@centrumrema.co.in', '2018-12-13 21:09:42'),
(6, 'Lead Added', '394', 'admin@centrumrema.co.in', '2018-12-13 21:10:43'),
(7, 'Lead Added', '395', 'admin@centrumrema.co.in', '2018-12-13 21:11:41'),
(8, 'Lead Added', '396', 'admin@centrumrema.co.in', '2018-12-13 21:12:15'),
(9, 'Lead Added', '397', 'admin@centrumrema.co.in', '2018-12-13 21:13:03'),
(10, 'Lead Added', '398', 'admin@centrumrema.co.in', '2018-12-13 21:13:48'),
(11, 'Lead Added', '399', 'admin@centrumrema.co.in', '2018-12-13 21:14:47'),
(12, 'Lead Added', '400', 'admin@centrumrema.co.in', '2018-12-13 21:16:17'),
(13, 'Lead Added', '401', 'admin@centrumrema.co.in', '2018-12-13 21:17:06'),
(14, 'Lead Added', '402', 'admin@centrumrema.co.in', '2018-12-13 21:18:23'),
(15, 'Lead Added', '403', 'admin@centrumrema.co.in', '2018-12-13 21:19:48'),
(16, 'Lead Added', '404', 'admin@centrumrema.co.in', '2018-12-13 21:20:45'),
(17, 'Lead Added', '405', 'admin@centrumrema.co.in', '2018-12-13 21:21:36'),
(18, 'Lead Added', '406', 'admin@centrumrema.co.in', '2018-12-13 21:22:27'),
(19, 'Lead Added', '407', 'admin@centrumrema.co.in', '2018-12-13 21:23:15'),
(20, 'Lead Added', '408', 'admin@centrumrema.co.in', '2018-12-13 21:23:56'),
(21, 'Lead Added', '409', 'admin@centrumrema.co.in', '2018-12-13 21:24:48'),
(22, 'Lead Added', '410', 'admin@centrumrema.co.in', '2018-12-13 21:25:32'),
(23, 'PreferredLocation Added', 'Mahim', 'admin@centrumrema.co.in', '2019-02-06 20:42:37'),
(24, 'Project Added', 'Zinnia', 'admin@centrumrema.co.in', '2019-02-06 20:43:37'),
(25, 'Project Edited', 'Zinnia', 'admin@centrumrema.co.in', '2019-02-06 20:44:00'),
(26, 'Campaign Added', '3', 'admin@centrumrema.co.in', '2019-02-06 20:47:33'),
(27, 'Virtual Number Added', '022 5080 1090', 'admin@centrumrema.co.in', '2019-02-06 20:48:17'),
(28, 'Campaign Edited', 'Zinnia Microsite', 'admin@centrumrema.co.in', '2019-02-06 20:48:37'),
(29, 'Campaign Added', '4', 'admin@centrumrema.co.in', '2019-02-10 03:13:33'),
(30, 'Lead Added', '419', 'admin@centrumrema.co.in', '2019-02-10 04:20:01'),
(31, 'Lead Added', '420', 'admin@centrumrema.co.in', '2019-02-10 04:21:22'),
(32, 'Campaign Edited', 'Silverscape Facebook Campaign', 'admin@centrumrema.co.in', '2019-02-14 18:59:45'),
(33, 'Campaign Edited', 'Elina Facebook Campaign', 'admin@centrumrema.co.in', '2019-02-14 18:59:53'),
(34, 'Lead Added', '433', 'admin@centrumrema.co.in', '2019-02-14 19:07:50'),
(35, 'Lead Added', '434', 'admin@centrumrema.co.in', '2019-02-14 19:09:14'),
(36, 'Lead Added', '435', 'admin@centrumrema.co.in', '2019-02-14 19:10:36'),
(37, 'Lead Added', '436', 'admin@centrumrema.co.in', '2019-02-14 19:11:09'),
(38, 'Lead Added', '437', 'admin@centrumrema.co.in', '2019-02-14 19:11:48'),
(39, 'Lead Added', '438', 'admin@centrumrema.co.in', '2019-02-14 19:13:31'),
(40, 'Lead Added', '491', 'admin@centrumrema.co.in', '2019-03-20 23:08:32'),
(41, 'Project Added', 'Residency', 'admin@centrumrema.co.in', '2019-05-01 01:16:08'),
(42, 'Project Edited', 'Residency', 'admin@centrumrema.co.in', '2019-05-01 01:16:21'),
(43, 'Campaign Added', '5', 'admin@centrumrema.co.in', '2019-05-01 01:17:18'),
(44, 'Campaign Added', '6', 'admin@centrumrema.co.in', '2019-05-14 00:17:31'),
(45, 'Lead Added', '1216', 'admin@centrumrema.co.in', '2019-07-22 18:41:37'),
(46, 'Lead Added', '1217', 'admin@centrumrema.co.in', '2019-07-22 18:42:28'),
(47, 'Lead Added', '1218', 'admin@centrumrema.co.in', '2019-07-22 18:43:07'),
(48, 'Lead Deleted ', '1215', 'admin@centrumrema.co.in', '2019-07-22 18:43:20'),
(49, 'Lead Deleted ', '1214', 'admin@centrumrema.co.in', '2019-07-22 18:43:26'),
(50, 'Project Added', 'Akshay Paradise', 'admin@centrumrema.co.in', '2019-11-30 00:37:24'),
(51, 'Project Edited', 'Akshay Paradise', 'admin@centrumrema.co.in', '2019-11-30 00:37:36'),
(52, 'Campaign Added', '7', 'admin@centrumrema.co.in', '2019-11-30 00:41:39'),
(53, 'Lead Uploaded', '1345', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(54, 'Lead Uploaded', '1346', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(55, 'Lead Uploaded', '1347', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(56, 'Lead Uploaded', '1348', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(57, 'Lead Uploaded', '1349', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(58, 'Lead Uploaded', '1350', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(59, 'Lead Uploaded', '1351', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(60, 'Lead Uploaded', '1352', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(61, 'Lead Uploaded', '1353', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(62, 'Lead Uploaded', '1354', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(63, 'Lead Uploaded', '1355', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(64, 'Lead Uploaded', '1356', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(65, 'Lead Uploaded', '1357', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(66, 'Lead Uploaded', '1358', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(67, 'Lead Uploaded', '1359', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(68, 'Lead Uploaded', '1360', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(69, 'Lead Uploaded', '1361', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(70, 'Lead Uploaded', '1362', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(71, 'Lead Uploaded', '1363', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(72, 'Lead Uploaded', '1364', 'admin@centrumrema.co.in', '2019-12-02 18:01:41'),
(73, 'Lead Uploaded', '1365', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(74, 'Lead Uploaded', '1366', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(75, 'Lead Uploaded', '1367', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(76, 'Lead Uploaded', '1368', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(77, 'Lead Uploaded', '1369', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(78, 'Lead Uploaded', '1370', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(79, 'Lead Uploaded', '1371', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(80, 'Lead Uploaded', '1372', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(81, 'Lead Uploaded', '1373', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(82, 'Lead Uploaded', '1374', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(83, 'Lead Uploaded', '1375', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(84, 'Lead Uploaded', '1376', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(85, 'Lead Uploaded', '1377', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(86, 'Lead Uploaded', '1378', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(87, 'Lead Uploaded', '1379', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(88, 'Lead Uploaded', '1380', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(89, 'Lead Uploaded', '1381', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(90, 'Lead Uploaded', '1382', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(91, 'Lead Uploaded', '1383', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(92, 'Lead Uploaded', '1384', 'admin@centrumrema.co.in', '2019-12-02 18:02:08'),
(93, 'Lead Uploaded', '1365', 'admin@centrumrema.co.in', '2019-12-02 22:32:35'),
(94, 'Lead Uploaded', '1366', 'admin@centrumrema.co.in', '2019-12-02 22:32:35'),
(95, 'Lead Uploaded', '1367', 'admin@centrumrema.co.in', '2019-12-02 22:32:35'),
(96, 'Lead Uploaded', '1368', 'admin@centrumrema.co.in', '2019-12-02 22:32:35'),
(97, 'Lead Uploaded', '1369', 'admin@centrumrema.co.in', '2019-12-02 22:32:35'),
(98, 'Lead Uploaded', '1370', 'admin@centrumrema.co.in', '2019-12-02 22:32:35'),
(99, 'Lead Uploaded', '1371', 'admin@centrumrema.co.in', '2019-12-02 22:32:35'),
(100, 'Lead Uploaded', '1372', 'admin@centrumrema.co.in', '2019-12-02 22:32:35'),
(101, 'Lead Uploaded', '1373', 'admin@centrumrema.co.in', '2019-12-02 22:32:35'),
(102, 'Lead Uploaded', '1374', 'admin@centrumrema.co.in', '2019-12-03 23:18:10'),
(103, 'Lead Uploaded', '1375', 'admin@centrumrema.co.in', '2019-12-03 23:18:10'),
(104, 'Lead Uploaded', '1376', 'admin@centrumrema.co.in', '2019-12-03 23:18:10'),
(105, 'Lead Uploaded', '1377', 'admin@centrumrema.co.in', '2019-12-03 23:18:10'),
(106, 'Lead Uploaded', '1378', 'admin@centrumrema.co.in', '2019-12-03 23:18:10'),
(107, 'Lead Uploaded', '1379', 'admin@centrumrema.co.in', '2019-12-03 23:18:10'),
(108, 'Lead Uploaded', '1380', 'admin@centrumrema.co.in', '2019-12-03 23:18:10'),
(109, 'Lead Uploaded', '1381', 'admin@centrumrema.co.in', '2019-12-03 23:18:10'),
(110, 'Lead Uploaded', '1382', 'admin@centrumrema.co.in', '2019-12-03 23:18:10'),
(111, 'Lead Uploaded', '1383', 'admin@centrumrema.co.in', '2019-12-03 23:18:30'),
(112, 'Lead Uploaded', '1384', 'admin@centrumrema.co.in', '2019-12-03 23:18:30'),
(113, 'Lead Uploaded', '1385', 'admin@centrumrema.co.in', '2019-12-03 23:18:30'),
(114, 'Lead Uploaded', '1386', 'admin@centrumrema.co.in', '2019-12-03 23:18:30'),
(115, 'Lead Uploaded', '1387', 'admin@centrumrema.co.in', '2019-12-03 23:18:30'),
(116, 'Lead Uploaded', '1388', 'admin@centrumrema.co.in', '2019-12-03 23:18:30'),
(117, 'Lead Uploaded', '1389', 'admin@centrumrema.co.in', '2019-12-03 23:18:30'),
(118, 'Lead Uploaded', '1390', 'admin@centrumrema.co.in', '2019-12-03 23:18:30'),
(119, 'Lead Uploaded', '1391', 'admin@centrumrema.co.in', '2019-12-03 23:18:30'),
(120, 'Lead Uploaded', '1392', 'admin@centrumrema.co.in', '2019-12-03 23:18:35'),
(121, 'Lead Uploaded', '1393', 'admin@centrumrema.co.in', '2019-12-03 23:18:35'),
(122, 'Lead Uploaded', '1394', 'admin@centrumrema.co.in', '2019-12-03 23:18:35'),
(123, 'Lead Uploaded', '1395', 'admin@centrumrema.co.in', '2019-12-03 23:18:35'),
(124, 'Lead Uploaded', '1396', 'admin@centrumrema.co.in', '2019-12-03 23:18:35'),
(125, 'Lead Uploaded', '1397', 'admin@centrumrema.co.in', '2019-12-03 23:18:35'),
(126, 'Lead Uploaded', '1398', 'admin@centrumrema.co.in', '2019-12-03 23:18:35'),
(127, 'Lead Uploaded', '1399', 'admin@centrumrema.co.in', '2019-12-03 23:18:35'),
(128, 'Lead Uploaded', '1400', 'admin@centrumrema.co.in', '2019-12-03 23:18:35'),
(129, 'Project Added', 'Brynn Oneill', 'admin@centrumrema.co.in', '2019-12-03 23:39:46'),
(130, 'Project Edited', 'Brynn Oneill', 'admin@centrumrema.co.in', '2019-12-03 23:41:05'),
(131, 'Project Deleted', 'Brynn Oneill', 'admin@centrumrema.co.in', '2019-12-03 23:41:10'),
(132, 'Lead Uploaded', '1401', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(133, 'Lead Uploaded', '1402', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(134, 'Lead Uploaded', '1403', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(135, 'Lead Uploaded', '1404', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(136, 'Lead Uploaded', '1405', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(137, 'Lead Uploaded', '1406', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(138, 'Lead Uploaded', '1407', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(139, 'Lead Uploaded', '1408', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(140, 'Lead Uploaded', '1409', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(141, 'Lead Uploaded', '1410', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(142, 'Lead Uploaded', '1411', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(143, 'Lead Uploaded', '1412', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(144, 'Lead Uploaded', '1413', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(145, 'Lead Uploaded', '1414', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(146, 'Lead Uploaded', '1415', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(147, 'Lead Uploaded', '1416', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(148, 'Lead Uploaded', '1417', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(149, 'Lead Uploaded', '1418', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(150, 'Lead Uploaded', '1419', 'admin@centrumrema.co.in', '2019-12-03 23:46:23'),
(151, 'Lead set to Visited ', '703', 'admin@centrumrema.co.in', '2019-12-04 17:50:23'),
(152, 'Lead Uploaded', '1420', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(153, 'Lead Uploaded', '1421', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(154, 'Lead Uploaded', '1422', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(155, 'Lead Uploaded', '1423', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(156, 'Lead Uploaded', '1424', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(157, 'Lead Uploaded', '1425', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(158, 'Lead Uploaded', '1426', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(159, 'Lead Uploaded', '1427', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(160, 'Lead Uploaded', '1428', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(161, 'Lead Uploaded', '1429', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(162, 'Lead Uploaded', '1430', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(163, 'Lead Uploaded', '1431', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(164, 'Lead Uploaded', '1432', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(165, 'Lead Uploaded', '1433', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(166, 'Lead Uploaded', '1434', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(167, 'Lead Uploaded', '1435', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(168, 'Lead Uploaded', '1436', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(169, 'Lead Uploaded', '1437', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(170, 'Lead Uploaded', '1438', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(171, 'Lead Uploaded', '1439', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(172, 'Lead Uploaded', '1440', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(173, 'Lead Uploaded', '1441', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(174, 'Lead Uploaded', '1442', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(175, 'Lead Uploaded', '1443', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(176, 'Lead Uploaded', '1444', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(177, 'Lead Uploaded', '1445', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(178, 'Lead Uploaded', '1446', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(179, 'Lead Uploaded', '1447', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(180, 'Lead Uploaded', '1448', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(181, 'Lead Uploaded', '1449', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(182, 'Lead Uploaded', '1450', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(183, 'Lead Uploaded', '1451', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(184, 'Lead Uploaded', '1452', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(185, 'Lead Uploaded', '1453', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(186, 'Lead Uploaded', '1454', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(187, 'Lead Uploaded', '1455', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(188, 'Lead Uploaded', '1456', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(189, 'Lead Uploaded', '1457', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(190, 'Lead Uploaded', '1458', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(191, 'Lead Uploaded', '1459', 'admin@centrumrema.co.in', '2019-12-04 19:11:48'),
(192, 'Campaign Added', '8', 'admin@centrumrema.co.in', '2019-12-06 00:12:44'),
(193, 'LeadSource Added', 'Chatbot', 'admin@centrumrema.co.in', '2019-12-06 00:13:28'),
(194, 'LeadSource Edited', 'Chatbot', 'admin@centrumrema.co.in', '2019-12-06 00:14:17'),
(195, 'Lead Uploaded', '1460', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(196, 'Lead Uploaded', '1461', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(197, 'Lead Uploaded', '1462', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(198, 'Lead Uploaded', '1463', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(199, 'Lead Uploaded', '1464', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(200, 'Lead Uploaded', '1465', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(201, 'Lead Uploaded', '1466', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(202, 'Lead Uploaded', '1467', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(203, 'Lead Uploaded', '1468', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(204, 'Lead Uploaded', '1469', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(205, 'Lead Uploaded', '1470', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(206, 'Lead Uploaded', '1471', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(207, 'Lead Uploaded', '1472', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(208, 'Lead Uploaded', '1473', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(209, 'Lead Uploaded', '1474', 'admin@centrumrema.co.in', '2019-12-12 00:06:16'),
(210, 'Lead Uploaded', '1475', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(211, 'Lead Uploaded', '1476', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(212, 'Lead Uploaded', '1477', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(213, 'Lead Uploaded', '1478', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(214, 'Lead Uploaded', '1479', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(215, 'Lead Uploaded', '1480', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(216, 'Lead Uploaded', '1481', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(217, 'Lead Uploaded', '1482', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(218, 'Lead Uploaded', '1483', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(219, 'Lead Uploaded', '1484', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(220, 'Lead Uploaded', '1485', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(221, 'Lead Uploaded', '1486', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(222, 'Lead Uploaded', '1487', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(223, 'Lead Uploaded', '1488', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(224, 'Lead Uploaded', '1489', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(225, 'Lead Uploaded', '1490', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(226, 'Lead Uploaded', '1491', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(227, 'Lead Uploaded', '1492', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(228, 'Lead Uploaded', '1493', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(229, 'Lead Uploaded', '1494', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(230, 'Lead Uploaded', '1495', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(231, 'Lead Uploaded', '1496', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(232, 'Lead Uploaded', '1497', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(233, 'Lead Uploaded', '1498', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(234, 'Lead Uploaded', '1499', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(235, 'Lead Uploaded', '1500', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(236, 'Lead Uploaded', '1501', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(237, 'Lead Uploaded', '1502', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(238, 'Lead Uploaded', '1503', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(239, 'Lead Uploaded', '1504', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(240, 'Lead Uploaded', '1505', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(241, 'Lead Uploaded', '1506', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(242, 'Lead Uploaded', '1507', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(243, 'Lead Uploaded', '1508', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(244, 'Lead Uploaded', '1509', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(245, 'Lead Uploaded', '1510', 'admin@centrumrema.co.in', '2019-12-12 21:50:56'),
(246, 'Lead Uploaded', '1511', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(247, 'Lead Uploaded', '1512', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(248, 'Lead Uploaded', '1513', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(249, 'Lead Uploaded', '1514', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(250, 'Lead Uploaded', '1515', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(251, 'Lead Uploaded', '1516', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(252, 'Lead Uploaded', '1517', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(253, 'Lead Uploaded', '1518', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(254, 'Lead Uploaded', '1519', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(255, 'Lead Uploaded', '1520', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(256, 'Lead Uploaded', '1521', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(257, 'Lead Uploaded', '1522', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(258, 'Lead Uploaded', '1523', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(259, 'Lead Uploaded', '1524', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(260, 'Lead Uploaded', '1525', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(261, 'Lead Uploaded', '1526', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(262, 'Lead Uploaded', '1527', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(263, 'Lead Uploaded', '1528', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(264, 'Lead Uploaded', '1529', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(265, 'Lead Uploaded', '1530', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(266, 'Lead Uploaded', '1531', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(267, 'Lead Uploaded', '1532', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(268, 'Lead Uploaded', '1533', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(269, 'Lead Uploaded', '1534', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(270, 'Lead Uploaded', '1535', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(271, 'Lead Uploaded', '1536', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(272, 'Lead Uploaded', '1537', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(273, 'Lead Uploaded', '1538', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(274, 'Lead Uploaded', '1539', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(275, 'Lead Uploaded', '1540', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(276, 'Lead Uploaded', '1541', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(277, 'Lead Uploaded', '1542', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(278, 'Lead Uploaded', '1543', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(279, 'Lead Uploaded', '1544', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(280, 'Lead Uploaded', '1545', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(281, 'Lead Uploaded', '1546', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(282, 'Lead Uploaded', '1547', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(283, 'Lead Uploaded', '1548', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(284, 'Lead Uploaded', '1549', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(285, 'Lead Uploaded', '1550', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(286, 'Lead Uploaded', '1551', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(287, 'Lead Uploaded', '1552', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(288, 'Lead Uploaded', '1553', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(289, 'Lead Uploaded', '1554', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(290, 'Lead Uploaded', '1555', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(291, 'Lead Uploaded', '1556', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(292, 'Lead Uploaded', '1557', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(293, 'Lead Uploaded', '1558', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(294, 'Lead Uploaded', '1559', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(295, 'Lead Uploaded', '1560', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(296, 'Lead Uploaded', '1561', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(297, 'Lead Uploaded', '1562', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(298, 'Lead Uploaded', '1563', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(299, 'Lead Uploaded', '1564', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(300, 'Lead Uploaded', '1565', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(301, 'Lead Uploaded', '1566', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(302, 'Lead Uploaded', '1567', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(303, 'Lead Uploaded', '1568', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(304, 'Lead Uploaded', '1569', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(305, 'Lead Uploaded', '1570', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(306, 'Lead Uploaded', '1571', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(307, 'Lead Uploaded', '1572', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(308, 'Lead Uploaded', '1573', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(309, 'Lead Uploaded', '1574', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(310, 'Lead Uploaded', '1575', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(311, 'Lead Uploaded', '1576', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(312, 'Lead Uploaded', '1577', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(313, 'Lead Uploaded', '1578', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(314, 'Lead Uploaded', '1579', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(315, 'Lead Uploaded', '1580', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(316, 'Lead Uploaded', '1581', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(317, 'Lead Uploaded', '1582', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(318, 'Lead Uploaded', '1583', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(319, 'Lead Uploaded', '1584', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(320, 'Lead Uploaded', '1585', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(321, 'Lead Uploaded', '1586', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(322, 'Lead Uploaded', '1587', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(323, 'Lead Uploaded', '1588', 'admin@centrumrema.co.in', '2019-12-14 23:30:57'),
(324, 'Lead Uploaded', '1589', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(325, 'Lead Uploaded', '1590', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(326, 'Lead Uploaded', '1591', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(327, 'Lead Uploaded', '1592', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(328, 'Lead Uploaded', '1593', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(329, 'Lead Uploaded', '1594', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(330, 'Lead Uploaded', '1595', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(331, 'Lead Uploaded', '1596', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(332, 'Lead Uploaded', '1597', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(333, 'Lead Uploaded', '1598', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(334, 'Lead Uploaded', '1599', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(335, 'Lead Uploaded', '1600', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(336, 'Lead Uploaded', '1601', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(337, 'Lead Uploaded', '1602', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(338, 'Lead Uploaded', '1603', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(339, 'Lead Uploaded', '1604', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(340, 'Lead Uploaded', '1605', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(341, 'Lead Uploaded', '1606', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(342, 'Lead Uploaded', '1607', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(343, 'Lead Uploaded', '1608', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(344, 'Lead Uploaded', '1609', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(345, 'Lead Uploaded', '1610', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(346, 'Lead Uploaded', '1611', 'admin@centrumrema.co.in', '2019-12-14 23:30:58'),
(347, 'Lead Uploaded', '1612', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(348, 'Lead Uploaded', '1613', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(349, 'Lead Uploaded', '1614', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(350, 'Lead Uploaded', '1615', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(351, 'Lead Uploaded', '1616', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(352, 'Lead Uploaded', '1617', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(353, 'Lead Uploaded', '1618', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(354, 'Lead Uploaded', '1619', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(355, 'Lead Uploaded', '1620', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(356, 'Lead Uploaded', '1621', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(357, 'Lead Uploaded', '1622', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(358, 'Lead Uploaded', '1623', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(359, 'Lead Uploaded', '1624', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(360, 'Lead Uploaded', '1625', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(361, 'Lead Uploaded', '1626', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(362, 'Lead Uploaded', '1627', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(363, 'Lead Uploaded', '1628', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(364, 'Lead Uploaded', '1629', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(365, 'Lead Uploaded', '1630', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(366, 'Lead Uploaded', '1631', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(367, 'Lead Uploaded', '1632', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(368, 'Lead Uploaded', '1633', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(369, 'Lead Uploaded', '1634', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(370, 'Lead Uploaded', '1635', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(371, 'Lead Uploaded', '1636', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(372, 'Lead Uploaded', '1637', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(373, 'Lead Uploaded', '1638', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(374, 'Lead Uploaded', '1639', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(375, 'Lead Uploaded', '1640', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(376, 'Lead Uploaded', '1641', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(377, 'Lead Uploaded', '1642', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(378, 'Lead Uploaded', '1643', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(379, 'Lead Uploaded', '1644', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(380, 'Lead Uploaded', '1645', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(381, 'Lead Uploaded', '1646', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(382, 'Lead Uploaded', '1647', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(383, 'Lead Uploaded', '1648', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(384, 'Lead Uploaded', '1649', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(385, 'Lead Uploaded', '1650', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(386, 'Lead Uploaded', '1651', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(387, 'Lead Uploaded', '1652', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(388, 'Lead Uploaded', '1653', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(389, 'Lead Uploaded', '1654', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(390, 'Lead Uploaded', '1655', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(391, 'Lead Uploaded', '1656', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(392, 'Lead Uploaded', '1657', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(393, 'Lead Uploaded', '1658', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(394, 'Lead Uploaded', '1659', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(395, 'Lead Uploaded', '1660', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(396, 'Lead Uploaded', '1661', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(397, 'Lead Uploaded', '1662', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(398, 'Lead Uploaded', '1663', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(399, 'Lead Uploaded', '1664', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(400, 'Lead Uploaded', '1665', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(401, 'Lead Uploaded', '1666', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(402, 'Lead Uploaded', '1667', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(403, 'Lead Uploaded', '1668', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(404, 'Lead Uploaded', '1669', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(405, 'Lead Uploaded', '1670', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(406, 'Lead Uploaded', '1671', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(407, 'Lead Uploaded', '1672', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(408, 'Lead Uploaded', '1673', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(409, 'Lead Uploaded', '1674', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(410, 'Lead Uploaded', '1675', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(411, 'Lead Uploaded', '1676', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(412, 'Lead Uploaded', '1677', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(413, 'Lead Uploaded', '1678', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(414, 'Lead Uploaded', '1679', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(415, 'Lead Uploaded', '1680', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(416, 'Lead Uploaded', '1681', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(417, 'Lead Uploaded', '1682', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(418, 'Lead Uploaded', '1683', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(419, 'Lead Uploaded', '1684', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(420, 'Lead Uploaded', '1685', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(421, 'Lead Uploaded', '1686', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(422, 'Lead Uploaded', '1687', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(423, 'Lead Uploaded', '1688', 'admin@centrumrema.co.in', '2019-12-16 18:15:53'),
(424, 'Lead Uploaded', '1692', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(425, 'Lead Uploaded', '1693', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(426, 'Lead Uploaded', '1694', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(427, 'Lead Uploaded', '1695', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(428, 'Lead Uploaded', '1696', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(429, 'Lead Uploaded', '1697', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(430, 'Lead Uploaded', '1698', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(431, 'Lead Uploaded', '1699', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(432, 'Lead Uploaded', '1700', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(433, 'Lead Uploaded', '1701', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(434, 'Lead Uploaded', '1702', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(435, 'Lead Uploaded', '1703', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(436, 'Lead Uploaded', '1704', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(437, 'Lead Uploaded', '1705', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(438, 'Lead Uploaded', '1706', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(439, 'Lead Uploaded', '1707', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(440, 'Lead Uploaded', '1708', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(441, 'Lead Uploaded', '1709', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(442, 'Lead Uploaded', '1710', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(443, 'Lead Uploaded', '1711', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(444, 'Lead Uploaded', '1712', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(445, 'Lead Uploaded', '1713', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(446, 'Lead Uploaded', '1714', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(447, 'Lead Uploaded', '1715', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(448, 'Lead Uploaded', '1716', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(449, 'Lead Uploaded', '1717', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(450, 'Lead Uploaded', '1718', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(451, 'Lead Uploaded', '1719', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(452, 'Lead Uploaded', '1720', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(453, 'Lead Uploaded', '1721', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(454, 'Lead Uploaded', '1722', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(455, 'Lead Uploaded', '1723', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(456, 'Lead Uploaded', '1724', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(457, 'Lead Uploaded', '1725', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(458, 'Lead Uploaded', '1726', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(459, 'Lead Uploaded', '1727', 'admin@centrumrema.co.in', '2019-12-18 23:12:40'),
(460, 'Lead Uploaded', '1728', 'admin@centrumrema.co.in', '2019-12-19 18:05:39'),
(461, 'Lead Uploaded', '1729', 'admin@centrumrema.co.in', '2019-12-19 18:05:39'),
(462, 'Lead Uploaded', '1730', 'admin@centrumrema.co.in', '2019-12-19 18:05:39'),
(463, 'Lead Uploaded', '1731', 'admin@centrumrema.co.in', '2019-12-19 18:05:39'),
(464, 'Lead Uploaded', '1732', 'admin@centrumrema.co.in', '2019-12-19 18:05:39'),
(465, 'Lead Uploaded', '1733', 'admin@centrumrema.co.in', '2019-12-19 18:05:39'),
(466, 'Lead Uploaded', '1734', 'admin@centrumrema.co.in', '2019-12-19 18:05:39'),
(467, 'Lead Uploaded', '1735', 'admin@centrumrema.co.in', '2019-12-19 18:05:39'),
(468, 'Lead Uploaded', '1736', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(469, 'Lead Uploaded', '1737', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(470, 'Lead Uploaded', '1738', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(471, 'Lead Uploaded', '1739', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(472, 'Lead Uploaded', '1740', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(473, 'Lead Uploaded', '1741', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(474, 'Lead Uploaded', '1742', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(475, 'Lead Uploaded', '1743', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(476, 'Lead Uploaded', '1744', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(477, 'Lead Uploaded', '1745', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(478, 'Lead Uploaded', '1746', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(479, 'Lead Uploaded', '1747', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(480, 'Lead Uploaded', '1748', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(481, 'Lead Uploaded', '1749', 'admin@centrumrema.co.in', '2019-12-19 23:20:47'),
(482, 'PreferredLocation Added', 'Malad', 'admin@centrumrema.co.in', '2019-12-19 23:22:21'),
(483, 'Project Added', 'Sunrise Orlem', 'admin@centrumrema.co.in', '2019-12-19 23:23:20'),
(484, 'Project Edited', 'Sunrise Orlem', 'admin@centrumrema.co.in', '2019-12-19 23:24:36'),
(485, 'Lead Uploaded', '1750', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(486, 'Lead Uploaded', '1751', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(487, 'Lead Uploaded', '1752', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(488, 'Lead Uploaded', '1753', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(489, 'Lead Uploaded', '1754', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(490, 'Lead Uploaded', '1755', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(491, 'Lead Uploaded', '1756', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(492, 'Lead Uploaded', '1757', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(493, 'Lead Uploaded', '1758', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(494, 'Lead Uploaded', '1759', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(495, 'Lead Uploaded', '1760', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(496, 'Lead Uploaded', '1761', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(497, 'Lead Uploaded', '1762', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(498, 'Lead Uploaded', '1763', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(499, 'Lead Uploaded', '1764', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(500, 'Lead Uploaded', '1765', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(501, 'Lead Uploaded', '1766', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(502, 'Lead Uploaded', '1767', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(503, 'Lead Uploaded', '1768', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(504, 'Lead Uploaded', '1769', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(505, 'Lead Uploaded', '1770', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(506, 'Lead Uploaded', '1771', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(507, 'Lead Uploaded', '1772', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(508, 'Lead Uploaded', '1773', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(509, 'Lead Uploaded', '1774', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(510, 'Lead Uploaded', '1775', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(511, 'Lead Uploaded', '1776', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(512, 'Lead Uploaded', '1777', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(513, 'Lead Uploaded', '1778', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(514, 'Lead Uploaded', '1779', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(515, 'Lead Uploaded', '1780', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(516, 'Lead Uploaded', '1781', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(517, 'Lead Uploaded', '1782', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(518, 'Lead Uploaded', '1783', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(519, 'Lead Uploaded', '1784', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(520, 'Lead Uploaded', '1785', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(521, 'Lead Uploaded', '1786', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(522, 'Lead Uploaded', '1787', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(523, 'Lead Uploaded', '1788', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(524, 'Lead Uploaded', '1789', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(525, 'Lead Uploaded', '1790', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(526, 'Lead Uploaded', '1791', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(527, 'Lead Uploaded', '1792', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(528, 'Lead Uploaded', '1793', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(529, 'Lead Uploaded', '1794', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(530, 'Lead Uploaded', '1795', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(531, 'Lead Uploaded', '1796', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(532, 'Lead Uploaded', '1797', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(533, 'Lead Uploaded', '1798', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(534, 'Lead Uploaded', '1799', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(535, 'Lead Uploaded', '1800', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(536, 'Lead Uploaded', '1801', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(537, 'Lead Uploaded', '1802', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(538, 'Lead Uploaded', '1803', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(539, 'Lead Uploaded', '1804', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(540, 'Lead Uploaded', '1805', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(541, 'Lead Uploaded', '1806', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(542, 'Lead Uploaded', '1807', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(543, 'Lead Uploaded', '1808', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(544, 'Lead Uploaded', '1809', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(545, 'Lead Uploaded', '1810', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(546, 'Lead Uploaded', '1811', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(547, 'Lead Uploaded', '1812', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(548, 'Lead Uploaded', '1813', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(549, 'Lead Uploaded', '1814', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(550, 'Lead Uploaded', '1815', 'admin@centrumrema.co.in', '2019-12-19 23:27:25'),
(551, 'Lead Uploaded', '1750', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(552, 'Lead Uploaded', '1751', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(553, 'Lead Uploaded', '1752', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(554, 'Lead Uploaded', '1753', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(555, 'Lead Uploaded', '1754', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(556, 'Lead Uploaded', '1755', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(557, 'Lead Uploaded', '1756', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(558, 'Lead Uploaded', '1757', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(559, 'Lead Uploaded', '1758', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(560, 'Lead Uploaded', '1759', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(561, 'Lead Uploaded', '1760', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(562, 'Lead Uploaded', '1761', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(563, 'Lead Uploaded', '1762', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(564, 'Lead Uploaded', '1763', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(565, 'Lead Uploaded', '1764', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(566, 'Lead Uploaded', '1765', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(567, 'Lead Uploaded', '1766', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(568, 'Lead Uploaded', '1767', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(569, 'Lead Uploaded', '1768', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(570, 'Lead Uploaded', '1769', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(571, 'Lead Uploaded', '1770', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(572, 'Lead Uploaded', '1771', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(573, 'Lead Uploaded', '1772', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(574, 'Lead Uploaded', '1773', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(575, 'Lead Uploaded', '1774', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(576, 'Lead Uploaded', '1775', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(577, 'Lead Uploaded', '1776', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(578, 'Lead Uploaded', '1777', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(579, 'Lead Uploaded', '1778', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(580, 'Lead Uploaded', '1779', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(581, 'Lead Uploaded', '1780', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(582, 'Lead Uploaded', '1781', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(583, 'Lead Uploaded', '1782', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(584, 'Lead Uploaded', '1783', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(585, 'Lead Uploaded', '1784', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(586, 'Lead Uploaded', '1785', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(587, 'Lead Uploaded', '1786', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(588, 'Lead Uploaded', '1787', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(589, 'Lead Uploaded', '1788', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(590, 'Lead Uploaded', '1789', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(591, 'Lead Uploaded', '1790', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(592, 'Lead Uploaded', '1791', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(593, 'Lead Uploaded', '1792', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(594, 'Lead Uploaded', '1793', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(595, 'Lead Uploaded', '1794', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(596, 'Lead Uploaded', '1795', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(597, 'Lead Uploaded', '1796', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(598, 'Lead Uploaded', '1797', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(599, 'Lead Uploaded', '1798', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(600, 'Lead Uploaded', '1799', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(601, 'Lead Uploaded', '1800', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(602, 'Lead Uploaded', '1801', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(603, 'Lead Uploaded', '1802', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(604, 'Lead Uploaded', '1803', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(605, 'Lead Uploaded', '1804', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(606, 'Lead Uploaded', '1805', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(607, 'Lead Uploaded', '1806', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(608, 'Lead Uploaded', '1807', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(609, 'Lead Uploaded', '1808', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(610, 'Lead Uploaded', '1809', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(611, 'Lead Uploaded', '1810', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(612, 'Lead Uploaded', '1811', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(613, 'Lead Uploaded', '1812', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(614, 'Lead Uploaded', '1813', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(615, 'Lead Uploaded', '1814', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(616, 'Lead Uploaded', '1815', 'admin@centrumrema.co.in', '2019-12-19 23:30:29'),
(617, 'Lead Uploaded', '1818', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(618, 'Lead Uploaded', '1819', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(619, 'Lead Uploaded', '1820', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(620, 'Lead Uploaded', '1821', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(621, 'Lead Uploaded', '1822', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(622, 'Lead Uploaded', '1823', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(623, 'Lead Uploaded', '1824', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(624, 'Lead Uploaded', '1825', 'admin@centrumrema.co.in', '2019-12-20 22:16:34');
INSERT INTO `logs` (`id`, `action`, `action_name`, `user`, `date_created`) VALUES
(625, 'Lead Uploaded', '1826', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(626, 'Lead Uploaded', '1827', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(627, 'Lead Uploaded', '1828', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(628, 'Lead Uploaded', '1829', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(629, 'Lead Uploaded', '1830', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(630, 'Lead Uploaded', '1831', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(631, 'Lead Uploaded', '1832', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(632, 'Lead Uploaded', '1833', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(633, 'Lead Uploaded', '1834', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(634, 'Lead Uploaded', '1835', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(635, 'Lead Uploaded', '1836', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(636, 'Lead Uploaded', '1837', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(637, 'Lead Uploaded', '1838', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(638, 'Lead Uploaded', '1839', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(639, 'Lead Uploaded', '1840', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(640, 'Lead Uploaded', '1841', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(641, 'Lead Uploaded', '1842', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(642, 'Lead Uploaded', '1843', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(643, 'Lead Uploaded', '1844', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(644, 'Lead Uploaded', '1845', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(645, 'Lead Uploaded', '1846', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(646, 'Lead Uploaded', '1847', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(647, 'Lead Uploaded', '1848', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(648, 'Lead Uploaded', '1849', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(649, 'Lead Uploaded', '1850', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(650, 'Lead Uploaded', '1851', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(651, 'Lead Uploaded', '1852', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(652, 'Lead Uploaded', '1853', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(653, 'Lead Uploaded', '1854', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(654, 'Lead Uploaded', '1855', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(655, 'Lead Uploaded', '1856', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(656, 'Lead Uploaded', '1857', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(657, 'Lead Uploaded', '1858', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(658, 'Lead Uploaded', '1859', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(659, 'Lead Uploaded', '1860', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(660, 'Lead Uploaded', '1861', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(661, 'Lead Uploaded', '1862', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(662, 'Lead Uploaded', '1863', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(663, 'Lead Uploaded', '1864', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(664, 'Lead Uploaded', '1865', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(665, 'Lead Uploaded', '1866', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(666, 'Lead Uploaded', '1867', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(667, 'Lead Uploaded', '1868', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(668, 'Lead Uploaded', '1869', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(669, 'Lead Uploaded', '1870', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(670, 'Lead Uploaded', '1871', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(671, 'Lead Uploaded', '1872', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(672, 'Lead Uploaded', '1873', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(673, 'Lead Uploaded', '1874', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(674, 'Lead Uploaded', '1875', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(675, 'Lead Uploaded', '1876', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(676, 'Lead Uploaded', '1877', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(677, 'Lead Uploaded', '1878', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(678, 'Lead Uploaded', '1879', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(679, 'Lead Uploaded', '1880', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(680, 'Lead Uploaded', '1881', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(681, 'Lead Uploaded', '1882', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(682, 'Lead Uploaded', '1883', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(683, 'Lead Uploaded', '1884', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(684, 'Lead Uploaded', '1885', 'admin@centrumrema.co.in', '2019-12-20 22:16:34'),
(685, 'Campaign Added', '9', 'admin@centrumrema.co.in', '2020-01-08 00:49:54'),
(686, 'Campaign Added', '10', 'admin@centrumrema.co.in', '2020-01-09 18:56:07'),
(687, 'Lead Added', '1907', 'admin@centrumrema.co.in', '2020-01-09 19:11:26'),
(688, 'Lead Added', '1908', 'admin@centrumrema.co.in', '2020-01-09 19:13:27'),
(689, 'Lead Added', '1909', 'admin@centrumrema.co.in', '2020-01-09 19:14:20'),
(690, 'Lead Edited', '1908', 'admin@centrumrema.co.in', '2020-01-09 19:14:42'),
(691, 'Lead Added', '1931', 'admin@centrumrema.co.in', '2020-01-10 22:55:59'),
(692, 'Campaign Added', '11', 'admin@centrumrema.co.in', '2020-01-16 18:19:08'),
(693, 'LeadSource Added', 'Consultants', 'admin@centrumrema.co.in', '2020-01-16 18:21:02'),
(694, 'Lead Uploaded', '1975', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(695, 'Lead Uploaded', '1976', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(696, 'Lead Uploaded', '1977', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(697, 'Lead Uploaded', '1978', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(698, 'Lead Uploaded', '1979', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(699, 'Lead Uploaded', '1980', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(700, 'Lead Uploaded', '1981', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(701, 'Lead Uploaded', '1982', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(702, 'Lead Uploaded', '1983', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(703, 'Lead Uploaded', '1984', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(704, 'Lead Uploaded', '1985', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(705, 'Lead Uploaded', '1986', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(706, 'Lead Uploaded', '1987', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(707, 'Lead Uploaded', '1988', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(708, 'Lead Uploaded', '1989', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(709, 'Lead Uploaded', '1990', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(710, 'Lead Uploaded', '1991', 'admin@centrumrema.co.in', '2020-01-16 18:22:39'),
(711, 'Lead Uploaded', '1992', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(712, 'Lead Uploaded', '1993', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(713, 'Lead Uploaded', '1994', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(714, 'Lead Uploaded', '1995', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(715, 'Lead Uploaded', '1996', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(716, 'Lead Uploaded', '1997', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(717, 'Lead Uploaded', '1998', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(718, 'Lead Uploaded', '1999', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(719, 'Lead Uploaded', '2000', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(720, 'Lead Uploaded', '2001', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(721, 'Lead Uploaded', '2002', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(722, 'Lead Uploaded', '2003', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(723, 'Lead Uploaded', '2004', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(724, 'Lead Uploaded', '2005', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(725, 'Lead Uploaded', '2006', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(726, 'Lead Uploaded', '2007', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(727, 'Lead Uploaded', '2008', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(728, 'Lead Uploaded', '2009', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(729, 'Lead Uploaded', '2010', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(730, 'Lead Uploaded', '2011', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(731, 'Lead Uploaded', '2012', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(732, 'Lead Uploaded', '2013', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(733, 'Lead Uploaded', '2014', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(734, 'Lead Uploaded', '2015', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(735, 'Lead Uploaded', '2016', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(736, 'Lead Uploaded', '2017', 'admin@centrumrema.co.in', '2020-01-16 18:22:40'),
(737, 'Lead Uploaded', '2034', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(738, 'Lead Uploaded', '2035', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(739, 'Lead Uploaded', '2036', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(740, 'Lead Uploaded', '2037', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(741, 'Lead Uploaded', '2038', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(742, 'Lead Uploaded', '2039', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(743, 'Lead Uploaded', '2040', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(744, 'Lead Uploaded', '2041', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(745, 'Lead Uploaded', '2042', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(746, 'Lead Uploaded', '2043', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(747, 'Lead Uploaded', '2044', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(748, 'Lead Uploaded', '2045', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(749, 'Lead Uploaded', '2046', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(750, 'Lead Uploaded', '2047', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(751, 'Lead Uploaded', '2048', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(752, 'Lead Uploaded', '2049', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(753, 'Lead Uploaded', '2050', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(754, 'Lead Uploaded', '2051', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(755, 'Lead Uploaded', '2052', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(756, 'Lead Uploaded', '2053', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(757, 'Lead Uploaded', '2054', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(758, 'Lead Uploaded', '2055', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(759, 'Lead Uploaded', '2056', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(760, 'Lead Uploaded', '2057', 'admin@centrumrema.co.in', '2020-01-21 19:10:01'),
(761, 'Lead Uploaded', '2061', 'admin@centrumrema.co.in', '2020-01-23 00:02:32'),
(762, 'Lead Uploaded', '2062', 'admin@centrumrema.co.in', '2020-01-23 00:02:32'),
(763, 'Lead Uploaded', '2063', 'admin@centrumrema.co.in', '2020-01-23 00:02:32'),
(764, 'Lead Uploaded', '2064', 'admin@centrumrema.co.in', '2020-01-23 00:02:32'),
(765, 'Lead Uploaded', '2065', 'admin@centrumrema.co.in', '2020-01-23 00:02:32'),
(766, 'Lead Uploaded', '2066', 'admin@centrumrema.co.in', '2020-01-23 00:02:32'),
(767, 'Lead Uploaded', '2067', 'admin@centrumrema.co.in', '2020-01-23 00:02:32'),
(768, 'Lead Uploaded', '2068', 'admin@centrumrema.co.in', '2020-01-23 00:02:32'),
(769, 'Lead Uploaded', '2069', 'admin@centrumrema.co.in', '2020-01-23 00:02:32'),
(770, 'Lead Uploaded', '2070', 'admin@centrumrema.co.in', '2020-01-23 00:02:32'),
(771, 'Lead Uploaded', '2071', 'admin@centrumrema.co.in', '2020-01-23 00:02:32'),
(772, 'Lead Uploaded', '2072', 'admin@centrumrema.co.in', '2020-01-23 00:02:32'),
(773, 'Lead Uploaded', '2075', 'admin@centrumrema.co.in', '2020-01-23 00:36:47'),
(774, 'Lead Uploaded', '2076', 'admin@centrumrema.co.in', '2020-01-23 00:36:47'),
(775, 'Lead Uploaded', '2077', 'admin@centrumrema.co.in', '2020-01-23 00:36:47'),
(776, 'Lead Uploaded', '2078', 'admin@centrumrema.co.in', '2020-01-23 00:36:47'),
(777, 'Lead Uploaded', '2079', 'admin@centrumrema.co.in', '2020-01-23 00:36:47'),
(778, 'Lead Uploaded', '2080', 'admin@centrumrema.co.in', '2020-01-23 00:36:47'),
(779, 'Lead Uploaded', '2086', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(780, 'Lead Uploaded', '2087', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(781, 'Lead Uploaded', '2088', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(782, 'Lead Uploaded', '2089', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(783, 'Lead Uploaded', '2090', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(784, 'Lead Uploaded', '2091', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(785, 'Lead Uploaded', '2092', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(786, 'Lead Uploaded', '2093', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(787, 'Lead Uploaded', '2094', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(788, 'Lead Uploaded', '2095', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(789, 'Lead Uploaded', '2096', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(790, 'Lead Uploaded', '2097', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(791, 'Lead Uploaded', '2098', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(792, 'Lead Uploaded', '2099', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(793, 'Lead Uploaded', '2100', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(794, 'Lead Uploaded', '2101', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(795, 'Lead Uploaded', '2102', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(796, 'Lead Uploaded', '2103', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(797, 'Lead Uploaded', '2104', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(798, 'Lead Uploaded', '2105', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(799, 'Lead Uploaded', '2106', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(800, 'Lead Uploaded', '2107', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(801, 'Lead Uploaded', '2108', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(802, 'Lead Uploaded', '2109', 'admin@centrumrema.co.in', '2020-01-24 22:33:49'),
(803, 'Campaign Added', '12', 'admin@centrumrema.co.in', '2020-01-27 20:04:49'),
(804, 'Lead Uploaded', '2114', 'admin@centrumrema.co.in', '2020-01-27 20:06:48'),
(805, 'Lead Uploaded', '2115', 'admin@centrumrema.co.in', '2020-01-27 20:06:48'),
(806, 'Lead Uploaded', '2116', 'admin@centrumrema.co.in', '2020-01-27 20:06:48'),
(807, 'Lead Uploaded', '2117', 'admin@centrumrema.co.in', '2020-01-27 20:06:48'),
(808, 'Lead Uploaded', '2118', 'admin@centrumrema.co.in', '2020-01-27 20:06:48'),
(809, 'Lead Uploaded', '2119', 'admin@centrumrema.co.in', '2020-01-27 20:06:48'),
(810, 'Project Added', '39 Anthea', 'admin@centrumrema.co.in', '2020-03-12 21:51:55'),
(811, 'File Deleted', 'SilverscapeFileDesign.pdf', 'admin@plinthstonerema.co.in', '2021-01-27 23:55:36'),
(812, 'PreferredLocation Added', 'Chembur', 'admin@plinthstonerema.co.in', '2021-01-28 00:01:32'),
(813, 'PreferredLocation Added', 'Kurla', 'admin@plinthstonerema.co.in', '2021-01-28 00:01:38'),
(814, 'PreferredLocation Added', 'Vikhroli', 'admin@plinthstonerema.co.in', '2021-01-28 00:02:09'),
(815, 'Virtual Number Added', '1246520188', 'admin@plinthstonerema.co.in', '2021-01-28 00:03:11'),
(816, 'Virtual Number Added', '1246520195', 'admin@plinthstonerema.co.in', '2021-01-28 00:03:30'),
(817, 'Virtual Number Added', '1246520197', 'admin@plinthstonerema.co.in', '2021-01-28 00:05:48'),
(818, 'Project Added', 'Signature Business Park', 'admin@plinthstonerema.co.in', '2021-01-28 00:42:28'),
(819, 'Project Added', 'Saffron Residency', 'admin@plinthstonerema.co.in', '2021-01-28 00:43:19'),
(820, 'Project Added', 'Adityaraj Avenue', 'admin@plinthstonerema.co.in', '2021-01-28 00:44:05'),
(821, 'Campaign Added', '1', 'admin@plinthstonerema.co.in', '2021-01-28 00:47:03'),
(822, 'Campaign Added', '2', 'admin@plinthstonerema.co.in', '2021-01-28 00:47:32'),
(823, 'Campaign Added', '3', 'admin@plinthstonerema.co.in', '2021-01-28 00:48:06'),
(824, 'Lead Added', '1', 'admin@plinthstonerema.co.in', '2021-01-28 00:53:37'),
(825, 'Lead Added', '2', 'admin@plinthstonerema.co.in', '2021-01-28 00:54:38'),
(826, 'Lead Added', '3', 'admin@plinthstonerema.co.in', '2021-01-28 00:55:31'),
(827, 'Lead Edited', '4', 'admin@plinthstonerema.co.in', '2021-01-28 02:02:58'),
(828, 'Campaign Added', '4', 'admin@plinthstonerema.co.in', '2021-02-04 21:35:36'),
(829, 'Project Added', 'Mrugarchana', 'admin@plinthstonerema.co.in', '2021-04-21 12:58:00'),
(830, 'Campaign Added', '5', 'admin@plinthstonerema.co.in', '2021-04-21 13:01:16'),
(831, 'Lead Deleted ', '202', 'admin@plinthstonerema.co.in', '2021-04-21 13:14:42'),
(832, 'Lead Deleted ', '201', 'admin@plinthstonerema.co.in', '2021-04-21 13:14:45'),
(833, 'Lead Deleted ', '200', 'admin@plinthstonerema.co.in', '2021-04-21 13:14:49'),
(834, 'Lead Deleted ', '199', 'admin@plinthstonerema.co.in', '2021-04-21 13:14:52'),
(835, 'Lead Deleted ', '198', 'admin@plinthstonerema.co.in', '2021-04-21 13:14:57'),
(836, 'Lead Deleted ', '197', 'admin@plinthstonerema.co.in', '2021-04-21 13:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`, `description`, `date_created`) VALUES
(1, 'user.manage', 'Manage users', '2017-08-03 09:14:52'),
(2, 'permission.manage', 'Manage permissions', '2017-08-03 09:14:52'),
(3, 'role.manage', 'Manage roles', '2017-08-03 09:14:52'),
(4, 'profile.any.view', 'View anyone\'s profile', '2017-08-03 09:14:52'),
(5, 'profile.own.view', 'View own profile', '2017-08-03 09:14:52'),
(6, 'folders.manage', 'Manage Folders', '2017-12-16 06:10:34'),
(10, 'projects.manage', 'Manage Projects', '2017-12-16 06:11:17'),
(13, 'leads.manage', 'Manage Leads', '2017-12-16 06:11:50'),
(14, 'followups.manage', 'Manage Followups', '2017-12-16 06:12:03'),
(16, 'walkins.manage', 'Manage Walkins', '2017-12-16 06:12:25'),
(18, 'campaign.manage', 'Manage Campaign', '2017-12-16 06:13:15'),
(19, 'customers.manage', 'Manage Customers', '2017-12-16 06:13:25'),
(21, 'settings.manage', 'Manage Settings', '2017-12-16 06:23:21'),
(22, 'masters.manage', 'Manage Masters', '2017-12-16 06:23:40'),
(24, 'reports.manage', 'Manage Reports', '2018-01-04 11:46:39'),
(25, 'telephony.manage', 'Manage Telephony', '2018-01-13 06:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `preferred_location`
--

CREATE TABLE `preferred_location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `preferred_location`
--

INSERT INTO `preferred_location` (`id`, `name`, `status`, `created_by`, `date_created`) VALUES
(3, 'Tilak Nagar', 1, 1, '2017-10-09 05:39:07'),
(4, 'Mulund', 1, 1, '2017-10-09 05:39:18'),
(5, 'Mahim', 1, 1, '2019-02-06 20:42:37'),
(6, 'Malad', 1, 1, '2019-12-19 23:22:21'),
(7, 'Chembur', 1, 1, '2021-01-28 00:01:32'),
(8, 'Kurla', 1, 1, '2021-01-28 00:01:38'),
(9, 'Vikhroli', 1, 1, '2021-01-28 00:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `developer` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT '0',
  `city` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `internal_amenities` text NOT NULL,
  `external_amenities` text NOT NULL,
  `status` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `developer`, `logo`, `city`, `address`, `internal_amenities`, `external_amenities`, `status`, `created_by`, `date_created`) VALUES
(1, 'Signature Business Park', 'Shreenathji Developers', 'signature.jpg', '7', 'Chembur', '1,', '4,', 1, 1, '2021-01-28 00:42:28'),
(2, 'Saffron Residency', 'Ayodhya Constructions', 'saffron.jpg', '8', 'Kurla', '1,', '4,', 1, 1, '2021-01-28 00:43:19'),
(3, 'Adityaraj Avenue', 'Adityaraj Developers', 'avenue.jpg', '9', 'Vikhroli', '1,', '4,', 1, 1, '2021-01-28 00:44:05'),
(5, 'Mrugarchana', 'Shreeji Buildcon', 'mrugarchana.png', '4', 'Siddharth Nagar, Mulund West, Mumbai, Maharashtra 400080', '1,', '4,', 1, 1, '2021-04-21 12:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `date_created`) VALUES
(1, 'Administrator', 'A person who manages users, roles, etc.', '2017-08-03 09:14:52'),
(3, 'Marketing', 'Marketing Department Access Control', '2017-12-08 18:45:37'),
(4, 'Call Center', 'call center', '2017-12-16 05:58:29'),
(5, 'Lead Viewer', 'Lead Viewer', '2019-02-11 11:33:17');

-- --------------------------------------------------------

--
-- Table structure for table `role_hierarchy`
--

CREATE TABLE `role_hierarchy` (
  `id` int(11) NOT NULL,
  `parent_role_id` int(11) NOT NULL,
  `child_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`id`, `role_id`, `permission_id`) VALUES
(55, 3, 18),
(56, 3, 19),
(58, 3, 6),
(59, 3, 14),
(62, 3, 13),
(64, 3, 2),
(65, 3, 4),
(66, 3, 5),
(67, 3, 10),
(68, 3, 3),
(69, 3, 21),
(71, 3, 1),
(72, 3, 16),
(101, 1, 18),
(102, 1, 19),
(104, 1, 6),
(105, 1, 14),
(108, 1, 13),
(109, 1, 22),
(111, 1, 2),
(112, 1, 4),
(113, 1, 5),
(114, 1, 10),
(115, 1, 24),
(116, 1, 3),
(117, 1, 21),
(119, 1, 25),
(120, 1, 1),
(121, 1, 16),
(129, 4, 14),
(130, 4, 13),
(131, 4, 5),
(132, 4, 25),
(133, 4, 16),
(134, 5, 13),
(135, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_brief` text NOT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `brand_color` varchar(255) DEFAULT NULL,
  `cp_approval` int(10) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `name_emailer` varchar(255) DEFAULT NULL,
  `email_emailer` varchar(255) DEFAULT NULL,
  `birthday_reminder` varchar(255) DEFAULT NULL,
  `sms_enabled` int(10) DEFAULT NULL,
  `sms_api` varchar(255) DEFAULT NULL,
  `kookoo_api` varchar(255) DEFAULT NULL,
  `call_api` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `company_brief`, `company_logo`, `favicon`, `brand_color`, `cp_approval`, `page_title`, `name_emailer`, `email_emailer`, `birthday_reminder`, `sms_enabled`, `sms_api`, `kookoo_api`, `call_api`, `created_by`, `date_created`) VALUES
(1, 'Plinthstone REMA', '-', 'logo.png', 'favicon.png', '#2A3F54', 1, 'PlinthstoneLMS', 'PlinthstoneLMS', 'admin@plinthstonerema.co.in', 'ajaz.siddiqui@plinthstonerema.co.in', 1, '', '', '', '1', '2017-11-21 07:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `sms_templates`
--

CREATE TABLE `sms_templates` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` int(10) NOT NULL,
  `content` text NOT NULL,
  `created_by` int(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_templates`
--

INSERT INTO `sms_templates` (`id`, `title`, `status`, `content`, `created_by`, `date_created`) VALUES
(2, 'title', 1, 'content is ok', 1, '2017-11-28 07:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `system_user_type`
--

CREATE TABLE `system_user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `negotiation_percent` double NOT NULL,
  `number_mask` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `eod_status` int(11) NOT NULL,
  `confidential` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_user_type`
--

INSERT INTO `system_user_type` (`id`, `name`, `negotiation_percent`, `number_mask`, `status`, `eod_status`, `confidential`, `created_by`, `date_created`) VALUES
(1, 'Super Admin', 5, 1, 1, 1, 1, 1, '2017-08-22 02:17:23'),
(2, 'Sales Manager', 0, 0, 1, 1, 1, 1, '2017-12-08 12:22:53'),
(3, 'Sales Head', 0, 0, 1, 1, 1, 1, '2017-12-08 12:23:13'),
(4, 'Customer', 0, 0, 1, 1, 1, 1, '2017-12-08 12:23:18'),
(5, 'Director/higher Authority', 0, 0, 1, 1, 1, 1, '2017-12-08 12:23:23'),
(6, 'Contact Center Executive', 0, 0, 1, 1, 1, 1, '2017-12-08 12:23:28'),
(7, 'Channel Partner', 0, 0, 1, 1, 1, 1, '2017-12-08 12:23:34'),
(8, 'Marketing Head', 0, 0, 1, 1, 1, 1, '2017-12-08 12:23:39'),
(9, 'Marketing Manager', 0, 0, 1, 1, 1, 1, '2017-12-08 12:23:44'),
(10, 'Sales Executive', 0, 0, 1, 1, 1, 1, '2017-12-08 12:23:49'),
(11, 'Receptionist', 0, 0, 1, 1, 1, 1, '2017-12-08 12:23:53'),
(12, 'Contact Center Tl', 0, 0, 1, 1, 1, 1, '2017-12-08 12:23:58'),
(13, 'Crm Executive', 0, 0, 1, 1, 1, 1, '2017-12-08 12:24:02'),
(14, 'Crm Head', 0, 0, 1, 1, 1, 1, '2017-12-08 12:24:07'),
(15, 'Admin', 0, 0, 1, 1, 1, 1, '2017-12-08 12:24:13'),
(16, 'Contact Center Manager', 0, 0, 1, 1, 1, 1, '2017-12-08 12:24:35'),
(17, 'Contact Center Quality', 0, 0, 1, 1, 1, 1, '2017-12-08 12:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `telephony`
--

CREATE TABLE `telephony` (
  `id` int(10) NOT NULL,
  `call_id` varchar(255) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `caller_number` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `event` int(10) DEFAULT NULL,
  `filename` text,
  `reciever` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_interest`
--

CREATE TABLE `transaction_interest` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_interest`
--

INSERT INTO `transaction_interest` (`id`, `name`, `status`, `created_by`, `date_created`) VALUES
(2, 'Bank Loan', 1, 1, '2017-08-22 02:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `full_name` varchar(512) NOT NULL,
  `password` varchar(256) NOT NULL,
  `status` int(11) NOT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `pwd_reset_token` varchar(32) DEFAULT NULL,
  `pwd_reset_token_creation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `full_name`, `password`, `status`, `contact_no`, `user_type`, `profile_pic`, `date_created`, `pwd_reset_token`, `pwd_reset_token_creation_date`) VALUES
(1, 'admin@plinthstonerema.co.in', 'Administrator', '$2y$10$P9kZOjeTTzPZ7o3LiEc2Kevyf8u0Q.yEeJall2vSQ22CmY5Naj2WC', 1, '8108533575', '15', 'index.jpg', '2017-08-03 09:14:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role_id`, `user_id`) VALUES
(38, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `virtual_number`
--

CREATE TABLE `virtual_number` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `virtual_number`
--

INSERT INTO `virtual_number` (`id`, `name`, `status`, `remarks`, `created_by`, `date_created`) VALUES
(1, '1246520188', 1, 'Saffron', 1, '2021-01-28 00:03:11'),
(2, '1246520195', 1, 'Adityaraj Avenue', 1, '2021-01-28 00:03:30'),
(3, '1246520197', 1, 'Signature', 1, '2021-01-28 00:05:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaign_projects`
--
ALTER TABLE `campaign_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followups`
--
ALTER TABLE `followups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followup_types`
--
ALTER TABLE `followup_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_source`
--
ALTER TABLE `lead_source`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_status`
--
ALTER TABLE `lead_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferred_location`
--
ALTER TABLE `preferred_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `role_hierarchy`
--
ALTER TABLE `role_hierarchy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parent_role_id` (`parent_role_id`),
  ADD UNIQUE KEY `child_role_id` (`child_role_id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `permission_id_2` (`permission_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `permission_id_3` (`permission_id`),
  ADD KEY `role_id_2` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_templates`
--
ALTER TABLE `sms_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_user_type`
--
ALTER TABLE `system_user_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telephony`
--
ALTER TABLE `telephony`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_interest`
--
ALTER TABLE `transaction_interest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_idx` (`email`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `virtual_number`
--
ALTER TABLE `virtual_number`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `campaign_projects`
--
ALTER TABLE `campaign_projects`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1624;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `followups`
--
ALTER TABLE `followups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `followup_types`
--
ALTER TABLE `followup_types`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `lead_source`
--
ALTER TABLE `lead_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `lead_status`
--
ALTER TABLE `lead_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=837;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `preferred_location`
--
ALTER TABLE `preferred_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role_hierarchy`
--
ALTER TABLE `role_hierarchy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_templates`
--
ALTER TABLE `sms_templates`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_user_type`
--
ALTER TABLE `system_user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `telephony`
--
ALTER TABLE `telephony`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_interest`
--
ALTER TABLE `transaction_interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `virtual_number`
--
ALTER TABLE `virtual_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_hierarchy`
--
ALTER TABLE `role_hierarchy`
  ADD CONSTRAINT `role_role_child_role_id_fk` FOREIGN KEY (`child_role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_role_parent_role_id_fk` FOREIGN KEY (`parent_role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_permission_id_fk` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`),
  ADD CONSTRAINT `role_permission_role_id_fk` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_role_id_fk` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_role_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
