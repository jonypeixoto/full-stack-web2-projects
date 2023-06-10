-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 11:02 AM
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
(34, '::1', '2022-03-24 14:54:13', '623c86080d7b6'),
(35, '::1', '2022-03-31 14:03:59', '6245a6bf664e4'),
(36, '::1', '2023-05-21 05:54:03', '64699fb888709'),
(37, '::1', '2023-05-31 15:32:33', '64753fce8feda');

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
(1, 'admin', 'admin', 'jony.jpg', 'Jony P. Peixoto', 2),
(2, 'thaycopim', '123456', 'thay.jpg', 'Thayná Copim', 0);

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
(1, '::1', '2021-11-25'),
(2, '162.154.8-2', '2021-11-23'),
(3, '::1', '2021-11-29'),
(4, '::1', '2021-12-10'),
(5, '::1', '2021-12-10'),
(6, '::1', '2021-12-28'),
(7, '::1', '2021-12-30'),
(8, '::1', '2022-01-10'),
(9, '::1', '2022-01-17'),
(10, '::1', '2022-01-29'),
(11, '::1', '2022-02-11'),
(12, '::1', '2022-03-24'),
(13, '::1', '2022-03-31'),
(14, '::1', '2023-05-21'),
(15, '::1', '2023-05-30');

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
('Project 01', 'Jony Peixoto', 'm Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently.\r\n\r\nm Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently.', 'fa fa-css3', 'CSS3 description\r\n\r\nIt has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ', 'fa fa-html5', 'HTML5 description\r\n\r\nIt has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ', 'fa fa-gg-circle', 'JavaScript description\r\n\r\nIt has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ');

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
(6, 'My service #2 EDITED AGAIN', 6),
(7, 'My service #3 EDITED manually', 8),
(8, 'My service #4', 7),
(9, 'My service #5', 9);

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
(7, 'Test image', '61b3a68c5e4a7.jpg', 7),
(8, 'Test image #2', '61b3a706181a4.jpg', 8),
(9, 'Test image #2', '61b4b7091649c.jpg', 9),
(10, 'Slide YouTube Logo', '61b4ee9bd56a0.png', 10);

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
(29, 'Jony Peixoto', 'Hey, okay!', '15/1/2020', 29),
(31, 'Mendes', 'Another testimonial here.', '15/06/2102', 31),
(32, 'Another', 'Ok', '12/12/2022', 30),
(33, 'Another testimonial #4', 'Here it is another testimonial', '15/01/2014', 33),
(34, 'Brenno', 'Hey, how are you ? (Eddited)', '12/12/2022', 34),
(35, 'Aroldo Fernandez', 'Test testimonial', '12/12/2013', 35);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_admin.users`
--
ALTER TABLE `tb_admin.users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_admin.visits`
--
ALTER TABLE `tb_admin.visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_site.testimonials`
--
ALTER TABLE `tb_site.testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
