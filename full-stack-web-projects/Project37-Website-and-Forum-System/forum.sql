-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Out-2017 às 21:56
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_forum.posts`
--

CREATE TABLE `tb_forum.posts` (
  `id` int(11) NOT NULL,
  `topico_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `mensagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_forum.posts`
--

INSERT INTO `tb_forum.posts` (`id`, `topico_id`, `nome`, `mensagem`) VALUES
(1, 1, 'Guilherme', 'Olá, me tira uma dúvida?'),
(2, 1, 'João', 'Lorem ipsums ilor domor amet'),
(3, 1, 'Felipe', 'Lorem'),
(4, 2, 'Guilherme', 'Discussão em outro tópico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_forum.topicos`
--

CREATE TABLE `tb_forum.topicos` (
  `id` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_forum.topicos`
--

INSERT INTO `tb_forum.topicos` (`id`, `forum_id`, `nome`) VALUES
(1, 2, 'PHP'),
(2, 2, 'HTML'),
(3, 2, 'CSS'),
(4, 1, 'Arcade'),
(5, 1, 'Ação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_foruns`
--

CREATE TABLE `tb_foruns` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_foruns`
--

INSERT INTO `tb_foruns` (`id`, `nome`) VALUES
(1, 'Games e geral'),
(2, 'Desenvolvimento web'),
(3, 'Outro fórum'),
(4, 'Outro fórum 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_forum.posts`
--
ALTER TABLE `tb_forum.posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_forum.topicos`
--
ALTER TABLE `tb_forum.topicos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_foruns`
--
ALTER TABLE `tb_foruns`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_forum.posts`
--
ALTER TABLE `tb_forum.posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_forum.topicos`
--
ALTER TABLE `tb_forum.topicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_foruns`
--
ALTER TABLE `tb_foruns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
