-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2023 at 04:11 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_01`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin.customers`
--

CREATE TABLE `tb_admin.customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin.customers`
--

INSERT INTO `tb_admin.customers` (`id`, `name`, `email`, `type`, `cpf_cnpj`, `image`) VALUES
(18, 'Jonathan P. Peixoto', 'jonathanppeixoto@gmail.com', 'private-individual', '000.000.000-00', '61d3b8185f872.png'),
(19, 'CybertimeUP', 'cybertimeup@gmail.com', 'legal-entity', '99.999.999/9999-99', '61d3b85807a88.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin.online`
--

CREATE TABLE `tb_admin.online` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `last_action` datetime NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `ip`, `last_action`, `token`) VALUES
(85, '::1', '2023-06-17 00:14:17', '648cec44f2cf1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin.users`
--

CREATE TABLE `tb_admin.users` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `office` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin.users`
--

INSERT INTO `tb_admin.users` (`id`, `user`, `password`, `img`, `name`, `office`) VALUES
(1, 'admin', 'admin', '64876a4b8ffc8.jpg', 'Jony', 2),
(2, 'thaycopim', '123456', 'thay.jpg', 'Thayná Copim', 0),
(3, 'jamesjeff', '123456', 'JamesJeff.jpg', 'jamesjeff', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin.visits`
--

CREATE TABLE `tb_admin.visits` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin.visits`
--

INSERT INTO `tb_admin.visits` (`id`, `ip`, `day`) VALUES
(17, '199.168.0.2', '2023-06-10'),
(18, '::1', '2023-06-11'),
(19, '::1', '2023-06-11'),
(20, '::1', '2023-06-11'),
(21, '::1', '2023-06-11'),
(22, '::1', '2023-06-11'),
(23, '::1', '2023-06-11'),
(24, '::1', '2023-06-11'),
(25, '::1', '2023-06-11'),
(26, '::1', '2023-06-11'),
(27, '::1', '2023-06-11'),
(28, '::1', '2023-06-11'),
(29, '::1', '2023-06-11'),
(30, '::1', '2023-06-11'),
(31, '::1', '2023-06-11'),
(32, '::1', '2023-06-11'),
(33, '::1', '2023-06-11'),
(34, '::1', '2023-06-11'),
(35, '::1', '2023-06-11'),
(36, '::1', '2023-06-11'),
(37, '::1', '2023-06-11'),
(38, '::1', '2023-06-11'),
(39, '::1', '2023-06-12'),
(40, '::1', '2023-06-12'),
(41, '::1', '2023-06-12'),
(42, '::1', '2023-06-12'),
(43, '::1', '2023-06-12'),
(44, '::1', '2023-06-12'),
(45, '::1', '2023-06-12'),
(46, '::1', '2023-06-12'),
(47, '::1', '2023-06-12'),
(48, '::1', '2023-06-12'),
(49, '::1', '2023-06-12'),
(50, '::1', '2023-06-12'),
(51, '::1', '2023-06-12'),
(52, '::1', '2023-06-12'),
(53, '::1', '2023-06-12'),
(54, '::1', '2023-06-12'),
(55, '::1', '2023-06-13'),
(56, '::1', '2023-06-13'),
(57, '::1', '2023-06-13'),
(58, '::1', '2023-06-13'),
(59, '::1', '2023-06-13'),
(60, '::1', '2023-06-13'),
(61, '::1', '2023-06-13'),
(62, '::1', '2023-06-13'),
(63, '::1', '2023-06-13'),
(64, '::1', '2023-06-13'),
(65, '::1', '2023-06-13'),
(66, '::1', '2023-06-13'),
(67, '::1', '2023-06-13'),
(68, '::1', '2023-06-13'),
(69, '::1', '2023-06-13'),
(70, '::1', '2023-06-13'),
(71, '::1', '2023-06-13'),
(72, '::1', '2023-06-13'),
(73, '::1', '2023-06-13'),
(74, '::1', '2023-06-13'),
(75, '::1', '2023-06-13'),
(76, '::1', '2023-06-13'),
(77, '::1', '2023-06-13'),
(78, '::1', '2023-06-13'),
(79, '::1', '2023-06-13'),
(80, '::1', '2023-06-13'),
(81, '::1', '2023-06-13'),
(82, '::1', '2023-06-13'),
(83, '::1', '2023-06-13'),
(84, '::1', '2023-06-13'),
(85, '::1', '2023-06-13'),
(86, '::1', '2023-06-13'),
(87, '::1', '2023-06-13'),
(88, '::1', '2023-06-13'),
(89, '::1', '2023-06-13'),
(90, '::1', '2023-06-13'),
(91, '::1', '2023-06-13'),
(92, '::1', '2023-06-13'),
(93, '::1', '2023-06-13'),
(94, '::1', '2023-06-13'),
(95, '::1', '2023-06-13'),
(96, '::1', '2023-06-13'),
(97, '::1', '2023-06-13'),
(98, '::1', '2023-06-13'),
(99, '::1', '2023-06-13'),
(100, '::1', '2023-06-13'),
(101, '::1', '2023-06-13'),
(102, '::1', '2023-06-13'),
(103, '::1', '2023-06-13'),
(104, '::1', '2023-06-13'),
(105, '::1', '2023-06-13'),
(106, '::1', '2023-06-13'),
(107, '::1', '2023-06-13'),
(108, '::1', '2023-06-13'),
(109, '::1', '2023-06-13'),
(110, '::1', '2023-06-13'),
(111, '::1', '2023-06-13'),
(112, '::1', '2023-06-13'),
(113, '::1', '2023-06-13'),
(114, '::1', '2023-06-13'),
(115, '::1', '2023-06-13'),
(116, '::1', '2023-06-13'),
(117, '::1', '2023-06-13'),
(118, '::1', '2023-06-13'),
(119, '::1', '2023-06-13'),
(120, '::1', '2023-06-13'),
(121, '::1', '2023-06-13'),
(122, '::1', '2023-06-13'),
(123, '::1', '2023-06-13'),
(124, '::1', '2023-06-13'),
(125, '::1', '2023-06-13'),
(126, '::1', '2023-06-13'),
(127, '::1', '2023-06-13'),
(128, '::1', '2023-06-13'),
(129, '::1', '2023-06-13'),
(130, '::1', '2023-06-13'),
(131, '::1', '2023-06-13'),
(132, '::1', '2023-06-13'),
(133, '::1', '2023-06-13'),
(134, '::1', '2023-06-13'),
(135, '::1', '2023-06-13'),
(136, '::1', '2023-06-13'),
(137, '::1', '2023-06-13'),
(138, '::1', '2023-06-13'),
(139, '::1', '2023-06-13'),
(140, '::1', '2023-06-13'),
(141, '::1', '2023-06-13'),
(142, '::1', '2023-06-13'),
(143, '::1', '2023-06-13'),
(144, '::1', '2023-06-13'),
(145, '::1', '2023-06-13'),
(146, '::1', '2023-06-13'),
(147, '::1', '2023-06-13'),
(148, '::1', '2023-06-13'),
(149, '::1', '2023-06-13'),
(150, '::1', '2023-06-13'),
(151, '::1', '2023-06-13'),
(152, '::1', '2023-06-14'),
(153, '::1', '2023-06-14'),
(154, '::1', '2023-06-14'),
(155, '::1', '2023-06-14'),
(156, '::1', '2023-06-14'),
(157, '::1', '2023-06-14'),
(158, '::1', '2023-06-14'),
(159, '::1', '2023-06-14'),
(160, '::1', '2023-06-14'),
(161, '::1', '2023-06-14'),
(162, '::1', '2023-06-14'),
(163, '::1', '2023-06-14'),
(164, '::1', '2023-06-14'),
(165, '::1', '2023-06-14'),
(166, '::1', '2023-06-14'),
(167, '::1', '2023-06-14'),
(168, '::1', '2023-06-14'),
(169, '::1', '2023-06-14'),
(170, '::1', '2023-06-14'),
(171, '::1', '2023-06-14'),
(172, '::1', '2023-06-14'),
(173, '::1', '2023-06-14'),
(174, '::1', '2023-06-14'),
(175, '::1', '2023-06-14'),
(176, '::1', '2023-06-14'),
(177, '::1', '2023-06-14'),
(178, '::1', '2023-06-14'),
(179, '::1', '2023-06-14'),
(180, '::1', '2023-06-14'),
(181, '::1', '2023-06-14'),
(182, '::1', '2023-06-14'),
(183, '::1', '2023-06-14'),
(184, '::1', '2023-06-14'),
(185, '::1', '2023-06-14'),
(186, '::1', '2023-06-14'),
(187, '::1', '2023-06-14'),
(188, '::1', '2023-06-14'),
(189, '::1', '2023-06-14'),
(190, '::1', '2023-06-14'),
(191, '::1', '2023-06-14'),
(192, '::1', '2023-06-14'),
(193, '::1', '2023-06-14'),
(194, '::1', '2023-06-14'),
(195, '::1', '2023-06-14'),
(196, '::1', '2023-06-14'),
(197, '::1', '2023-06-14'),
(198, '::1', '2023-06-14'),
(199, '::1', '2023-06-14'),
(200, '::1', '2023-06-14'),
(201, '::1', '2023-06-14'),
(202, '::1', '2023-06-14'),
(203, '::1', '2023-06-15'),
(204, '::1', '2023-06-15'),
(205, '::1', '2023-06-15'),
(206, '::1', '2023-06-15'),
(207, '::1', '2023-06-15'),
(208, '::1', '2023-06-15'),
(209, '::1', '2023-06-15'),
(210, '::1', '2023-06-15'),
(211, '::1', '2023-06-15'),
(212, '::1', '2023-06-15'),
(213, '::1', '2023-06-15'),
(214, '::1', '2023-06-15'),
(215, '::1', '2023-06-15'),
(216, '::1', '2023-06-15'),
(217, '::1', '2023-06-15'),
(218, '::1', '2023-06-15'),
(219, '::1', '2023-06-15'),
(220, '::1', '2023-06-15'),
(221, '::1', '2023-06-15'),
(222, '::1', '2023-06-15'),
(223, '::1', '2023-06-15'),
(224, '::1', '2023-06-15'),
(225, '::1', '2023-06-15'),
(226, '::1', '2023-06-15'),
(227, '::1', '2023-06-15'),
(228, '::1', '2023-06-15'),
(229, '::1', '2023-06-15'),
(230, '::1', '2023-06-15'),
(231, '::1', '2023-06-15'),
(232, '::1', '2023-06-15'),
(233, '::1', '2023-06-15'),
(234, '::1', '2023-06-15'),
(235, '::1', '2023-06-15'),
(236, '::1', '2023-06-15'),
(237, '::1', '2023-06-15'),
(238, '::1', '2023-06-15'),
(239, '::1', '2023-06-15'),
(240, '::1', '2023-06-15'),
(241, '::1', '2023-06-15'),
(242, '::1', '2023-06-15'),
(243, '::1', '2023-06-15'),
(244, '::1', '2023-06-15'),
(245, '::1', '2023-06-15'),
(246, '::1', '2023-06-15'),
(247, '::1', '2023-06-16'),
(248, '::1', '2023-06-16'),
(249, '::1', '2023-06-16'),
(250, '::1', '2023-06-16'),
(251, '::1', '2023-06-16'),
(252, '::1', '2023-06-16'),
(253, '::1', '2023-06-16'),
(254, '::1', '2023-06-16'),
(255, '::1', '2023-06-16'),
(256, '::1', '2023-06-16'),
(257, '::1', '2023-06-16'),
(258, '::1', '2023-06-16'),
(259, '::1', '2023-06-16'),
(260, '::1', '2023-06-16'),
(261, '::1', '2023-06-16'),
(262, '::1', '2023-06-16'),
(263, '::1', '2023-06-16'),
(264, '::1', '2023-06-16'),
(265, '::1', '2023-06-16'),
(266, '::1', '2023-06-16'),
(267, '::1', '2023-06-16'),
(268, '::1', '2023-06-16'),
(269, '::1', '2023-06-16'),
(270, '::1', '2023-06-16'),
(271, '::1', '2023-06-16'),
(272, '::1', '2023-06-16'),
(273, '::1', '2023-06-16'),
(274, '::1', '2023-06-16'),
(275, '::1', '2023-06-16'),
(276, '::1', '2023-06-16'),
(277, '::1', '2023-06-16'),
(278, '::1', '2023-06-16'),
(279, '::1', '2023-06-16'),
(280, '::1', '2023-06-16'),
(281, '::1', '2023-06-16'),
(282, '::1', '2023-06-16'),
(283, '::1', '2023-06-16'),
(284, '::1', '2023-06-16'),
(285, '::1', '2023-06-16'),
(286, '::1', '2023-06-16'),
(287, '::1', '2023-06-16'),
(288, '::1', '2023-06-16'),
(289, '::1', '2023-06-16'),
(290, '::1', '2023-06-16'),
(291, '::1', '2023-06-16'),
(292, '::1', '2023-06-16'),
(293, '::1', '2023-06-16'),
(294, '::1', '2023-06-16'),
(295, '::1', '2023-06-16'),
(296, '::1', '2023-06-16'),
(297, '::1', '2023-06-16'),
(298, '::1', '2023-06-16'),
(299, '::1', '2023-06-16'),
(300, '::1', '2023-06-16'),
(301, '::1', '2023-06-16'),
(302, '::1', '2023-06-16'),
(303, '::1', '2023-06-16'),
(304, '::1', '2023-06-16'),
(305, '::1', '2023-06-16'),
(306, '::1', '2023-06-16'),
(307, '::1', '2023-06-16'),
(308, '::1', '2023-06-16'),
(309, '::1', '2023-06-16'),
(310, '::1', '2023-06-16'),
(311, '::1', '2023-06-16'),
(312, '::1', '2023-06-16'),
(313, '::1', '2023-06-16'),
(314, '::1', '2023-06-16'),
(315, '::1', '2023-06-16'),
(316, '::1', '2023-06-16'),
(317, '::1', '2023-06-16'),
(318, '::1', '2023-06-16'),
(319, '::1', '2023-06-16'),
(320, '::1', '2023-06-16'),
(321, '::1', '2023-06-16'),
(322, '::1', '2023-06-16'),
(323, '::1', '2023-06-16'),
(324, '::1', '2023-06-16'),
(325, '::1', '2023-06-16'),
(326, '::1', '2023-06-16'),
(327, '::1', '2023-06-16'),
(328, '::1', '2023-06-16'),
(329, '::1', '2023-06-16'),
(330, '::1', '2023-06-16'),
(331, '::1', '2023-06-16'),
(332, '::1', '2023-06-16'),
(333, '::1', '2023-06-16'),
(334, '::1', '2023-06-16'),
(335, '::1', '2023-06-16'),
(336, '::1', '2023-06-16'),
(337, '::1', '2023-06-16'),
(338, '::1', '2023-06-16'),
(339, '::1', '2023-06-16'),
(340, '::1', '2023-06-16'),
(341, '::1', '2023-06-16'),
(342, '::1', '2023-06-16'),
(343, '::1', '2023-06-16'),
(344, '::1', '2023-06-16'),
(345, '::1', '2023-06-16'),
(346, '::1', '2023-06-16'),
(347, '::1', '2023-06-16'),
(348, '::1', '2023-06-16'),
(349, '::1', '2023-06-16'),
(350, '::1', '2023-06-16'),
(351, '::1', '2023-06-16'),
(352, '::1', '2023-06-16'),
(353, '::1', '2023-06-16'),
(354, '::1', '2023-06-16'),
(355, '::1', '2023-06-16'),
(356, '::1', '2023-06-16'),
(357, '::1', '2023-06-16'),
(358, '::1', '2023-06-16'),
(359, '::1', '2023-06-16'),
(360, '::1', '2023-06-16'),
(361, '::1', '2023-06-16'),
(362, '::1', '2023-06-16'),
(363, '::1', '2023-06-16'),
(364, '::1', '2023-06-16'),
(365, '::1', '2023-06-16'),
(366, '::1', '2023-06-16'),
(367, '::1', '2023-06-16'),
(368, '::1', '2023-06-16'),
(369, '::1', '2023-06-16'),
(370, '::1', '2023-06-16'),
(371, '::1', '2023-06-16'),
(372, '::1', '2023-06-16'),
(373, '::1', '2023-06-16'),
(374, '::1', '2023-06-16'),
(375, '::1', '2023-06-16'),
(376, '::1', '2023-06-16'),
(377, '::1', '2023-06-16'),
(378, '::1', '2023-06-16'),
(379, '::1', '2023-06-16'),
(380, '::1', '2023-06-16'),
(381, '::1', '2023-06-16'),
(382, '::1', '2023-06-16'),
(383, '::1', '2023-06-16'),
(384, '::1', '2023-06-16'),
(385, '::1', '2023-06-16'),
(386, '::1', '2023-06-16'),
(387, '::1', '2023-06-16'),
(388, '::1', '2023-06-16'),
(389, '::1', '2023-06-16'),
(390, '::1', '2023-06-16'),
(391, '::1', '2023-06-16'),
(392, '::1', '2023-06-16'),
(393, '::1', '2023-06-16'),
(394, '::1', '2023-06-16'),
(395, '::1', '2023-06-16'),
(396, '::1', '2023-06-16'),
(397, '::1', '2023-06-17'),
(398, '::1', '2023-06-17'),
(399, '::1', '2023-06-17'),
(400, '::1', '2023-06-17'),
(401, '::1', '2023-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `tb_site.categories`
--

CREATE TABLE `tb_site.categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_site.categories`
--

INSERT INTO `tb_site.categories` (`id`, `name`, `slug`, `order_id`) VALUES
(13, 'General', 'general', 13),
(14, 'Daily', 'daily', 14);

-- --------------------------------------------------------

--
-- Table structure for table `tb_site.config`
--

CREATE TABLE `tb_site.config` (
  `title` varchar(255) NOT NULL,
  `name_author` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon1` varchar(255) NOT NULL,
  `description1` text NOT NULL,
  `icon2` varchar(255) NOT NULL,
  `description2` text NOT NULL,
  `icon3` varchar(255) NOT NULL,
  `description3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_site.config`
--

INSERT INTO `tb_site.config` (`title`, `name_author`, `description`, `icon1`, `description1`, `icon2`, `description2`, `icon3`, `description3`) VALUES
('Project 01', 'Jony Peixoto', 'This is the content of the site author em ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies urna at massa posuere fermentum. In nec ultricies nulla. Donec eget ligula sit amet libero pharetra blandit id sed nisi. Nulla tincidunt luctus sapien et volutpat. In at ante a purus pellentesque porttitor in ac lacus. Sed eget posuere leo. In non ligula porta, posuere odio placerat, convallis metus.\r\n<br/><br/>\r\n\r\n In malesuada, ligula sed accumsan volutpat, ipsum neque tincidunt sem, eu lacinia nunc urna semper arcu. Nunc faucibus urna dolor, et pharetra tortor tempor at. Donec nec dapibus elit, quis pretium nibh. Aenean in vulputate lectus, vel interdum sem. Nunc molestie, leo quis ullamcorper laoreet, risus magna fermentum felis, at congue sem nibh id urna. Quisque in condimentum massa. In placerat accumsan felis, eu tempus dui malesuada tincidunt. In gravida quam eu aliquam eleifend..', 'fa fa-gg-circle', 'JavaScript description\r\n\r\nIt has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ', 'fa fa-html5', 'HTML5 description\r\n\r\nIt has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ', 'fa fa-gg-circle', 'JavaScript description\r\n\r\nIt has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_site.news`
--

CREATE TABLE `tb_site.news` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `cover` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_site.news`
--

INSERT INTO `tb_site.news` (`id`, `category_id`, `date`, `title`, `content`, `cover`, `slug`, `order_id`) VALUES
(19, 13, '2021-12-30', 'Lorem Ipsum', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget egestas leo. Curabitur molestie ligula urna, ut convallis turpis tristique et. Aenean quis vehicula diam. Praesent eget elit sapien. Praesent ac velit iaculis, ullamcorper nunc eu, iaculis est. Nunc et rutrum sem, et convallis nisi. In hac habitasse platea dictumst. Morbi ut mauris molestie, ultrices nibh id, suscipit diam. Nulla facilisi. Vestibulum gravida at nisi id posuere. Donec metus arcu, ultricies ut commodo sit amet, laoreet ut sapien. Etiam dui est, rhoncus non lacinia sed, convallis vel est. Duis ut ligula sed nulla vehicula consectetur. Aenean sit amet accumsan ex. In consequat porttitor pellentesque.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Donec augue ligula, lobortis sed odio facilisis, semper dictum risus. Nullam et felis quis odio facilisis ultricies. Ut condimentum leo sit amet lobortis tempus. Etiam cursus nulla in dui tincidunt consequat. Phasellus id sapien eget sem imperdiet malesuada. Donec massa quam, sodales vel fermentum sed, pellentesque nec nisl. Sed enim arcu, facilisis sed nulla non, pharetra cursus mi. Sed mattis sed quam eget dictum. Nullam urna est, hendrerit volutpat porta eu, volutpat at nulla. Aliquam in vestibulum arcu. Ut congue maximus volutpat. Mauris non lacus tempor, iaculis arcu id, dictum ligula.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nulla non vestibulum mi. In et lobortis urna. Pellentesque metus mauris, tristique ac felis sit amet, facilisis consectetur augue. Donec blandit libero viverra elit sollicitudin, quis convallis nibh sagittis. Quisque tristique est tellus, nec cursus arcu dictum sit amet. Etiam iaculis lorem a velit mollis mollis. Cras metus ipsum, aliquam at dolor id, interdum mollis ex. Suspendisse vitae tincidunt nibh, in ornare enim. Suspendisse venenatis enim sed auctor facilisis. Aliquam quis orci sit amet dolor condimentum euismod. Quisque facilisis felis iaculis augue congue, non viverra ante faucibus.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Morbi vitae risus euismod, ullamcorper ligula sed, tempus purus. In erat libero, maximus non ullamcorper a, pellentesque ut turpis. Duis non dui non metus mollis porta sit amet vitae nisl. Vivamus in leo in metus suscipit sollicitudin et vel diam. In ultrices leo vehicula mollis tempor. Vivamus pretium magna lectus, in facilisis est lobortis quis. Donec fermentum accumsan risus eget laoreet. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Mauris feugiat porttitor mattis. Sed elementum velit in tempus fermentum. Etiam sed pretium ex. Aliquam suscipit consectetur fermentum. Proin imperdiet fermentum venenatis. Nunc non diam id nulla ultrices varius at nec purus. Nulla elementum porttitor varius. Fusce ut magna at ex mollis interdum sed id enim. Praesent tristique nibh lectus, non malesuada justo molestie sit amet.</p>\r\n<p><img src=\"https://c0.wallpaperflare.com/preview/29/686/326/manaus-brazil-city-people.jpg\" alt=\"Cotidiano 1080P, 2K, 4K, 5K HD wallpapers free download | Wallpaper Flare\" /></p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget egestas leo. Curabitur molestie ligula urna, ut convallis turpis tristique et. Aenean quis vehicula diam. Praesent eget elit sapien. Praesent ac velit iaculis, ullamcorper nunc eu, iaculis est. Nunc et rutrum sem, et convallis nisi. In hac habitasse platea dictumst. Morbi ut mauris molestie, ultrices nibh id, suscipit diam. Nulla facilisi. Vestibulum gravida at nisi id posuere. Donec metus arcu, ultricies ut commodo sit amet, laoreet ut sapien. Etiam dui est, rhoncus non lacinia sed, convallis vel est. Duis ut ligula sed nulla vehicula consectetur. Aenean sit amet accumsan ex. In consequat porttitor pellentesque.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Donec augue ligula, lobortis sed odio facilisis, semper dictum risus. Nullam et felis quis odio facilisis ultricies. Ut condimentum leo sit amet lobortis tempus. Etiam cursus nulla in dui tincidunt consequat. Phasellus id sapien eget sem imperdiet malesuada. Donec massa quam, sodales vel fermentum sed, pellentesque nec nisl. Sed enim arcu, facilisis sed nulla non, pharetra cursus mi. Sed mattis sed quam eget dictum. Nullam urna est, hendrerit volutpat porta eu, volutpat at nulla. Aliquam in vestibulum arcu. Ut congue maximus volutpat. Mauris non lacus tempor, iaculis arcu id, dictum ligula.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nulla non vestibulum mi. In et lobortis urna. Pellentesque metus mauris, tristique ac felis sit amet, facilisis consectetur augue. Donec blandit libero viverra elit sollicitudin, quis convallis nibh sagittis. Quisque tristique est tellus, nec cursus arcu dictum sit amet. Etiam iaculis lorem a velit mollis mollis. Cras metus ipsum, aliquam at dolor id, interdum mollis ex. Suspendisse vitae tincidunt nibh, in ornare enim. Suspendisse venenatis enim sed auctor facilisis. Aliquam quis orci sit amet dolor condimentum euismod. Quisque facilisis felis iaculis augue congue, non viverra ante faucibus.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Morbi vitae risus euismod, ullamcorper ligula sed, tempus purus. In erat libero, maximus non ullamcorper a, pellentesque ut turpis. Duis non dui non metus mollis porta sit amet vitae nisl. Vivamus in leo in metus suscipit sollicitudin et vel diam. In ultrices leo vehicula mollis tempor. Vivamus pretium magna lectus, in facilisis est lobortis quis. Donec fermentum accumsan risus eget laoreet. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Mauris feugiat porttitor mattis. Sed elementum velit in tempus fermentum. Etiam sed pretium ex. Aliquam suscipit consectetur fermentum. Proin imperdiet fermentum venenatis. Nunc non diam id nulla ultrices varius at nec purus. Nulla elementum porttitor varius. Fusce ut magna at ex mollis interdum sed id enim. Praesent tristique nibh lectus, non malesuada justo molestie sit amet.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\"><em>CybertimeUP&nbsp;<strong>Corporation</strong></em></p>', '61ce1439d3130.jpg', 'lorem-ipsum', 19);

-- --------------------------------------------------------

--
-- Table structure for table `tb_site.services`
--

CREATE TABLE `tb_site.services` (
  `id` int(11) NOT NULL,
  `service` text NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_site.services`
--

INSERT INTO `tb_site.services` (`id`, `service`, `order_id`) VALUES
(5, 'My service #1', 5),
(6, 'My service #2 EDITED AGAIN', 9),
(7, 'My service #3 EDITED manually', 7),
(8, 'My service #4', 6),
(9, 'My service #5', 8),
(10, 'My service #6\r\n', 10),
(11, 'My service #7\r\n', 11),
(12, 'My service #8\r\n', 12),
(13, 'Ok, I understood!', 13);

-- --------------------------------------------------------

--
-- Table structure for table `tb_site.slides`
--

CREATE TABLE `tb_site.slides` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slide` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_site.slides`
--

INSERT INTO `tb_site.slides` (`id`, `name`, `slide`, `order_id`) VALUES
(13, 'Slide #1', '648c769116a54.jpg', 13),
(14, 'Slide #2', '648c77260da0c.jpg', 14),
(15, 'Slide now #3', '648c7742bd7d1.jpg', 15),
(16, 'Slide test #11', '648c775873d3f.jpg', 16),
(17, 'Slide registered #12', '648c77767c27c.jpg', 17);

-- --------------------------------------------------------

--
-- Table structure for table `tb_site.testimonials`
--

CREATE TABLE `tb_site.testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `testimonial` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_site.testimonials`
--

INSERT INTO `tb_site.testimonials` (`id`, `name`, `testimonial`, `date`, `order_id`) VALUES
(29, 'Jony Peixoto', 'Hey, Update now on panel!', '15/11/2020', 1),
(31, 'Mendes', 'Another testimonial here.', '15/06/2102', 2),
(34, 'Brenno', 'Hey, how are you ? (Eddited)', '12/12/2022', 3),
(35, 'Aroldo Fernandez', 'Test testimonial', '12/12/2013', 4),
(37, 'Jefrey', 'testing now', '15/05/2016', 5),
(38, 'Harni', 'ok,I am testing now!', '15/05/2023', 6),
(40, 'Howfran', 'I am alpha.', '10052014', 7),
(42, 'JOnei', 'ok, brother!', '10102070', 8),
(43, 'Walter Francis', 'I am walter francis here', '11/07/2075', 43),
(44, 'Walter Francis', 'I am walter francis here', '11/07/2075', 44),
(45, 'Kelly', 'testimonial test', '10102010', 45),
(46, 'Kelly', 'testimonial test', '10102010', 46);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin.customers`
--
ALTER TABLE `tb_admin.customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.users`
--
ALTER TABLE `tb_admin.users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.visits`
--
ALTER TABLE `tb_admin.visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.categories`
--
ALTER TABLE `tb_site.categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.news`
--
ALTER TABLE `tb_site.news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.services`
--
ALTER TABLE `tb_site.services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.testimonials`
--
ALTER TABLE `tb_site.testimonials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin.customers`
--
ALTER TABLE `tb_admin.customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tb_admin.users`
--
ALTER TABLE `tb_admin.users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_admin.visits`
--
ALTER TABLE `tb_admin.visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT for table `tb_site.categories`
--
ALTER TABLE `tb_site.categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_site.news`
--
ALTER TABLE `tb_site.news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_site.services`
--
ALTER TABLE `tb_site.services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_site.testimonials`
--
ALTER TABLE `tb_site.testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
