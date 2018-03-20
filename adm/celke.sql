-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/11/2016 às 21:58
-- Versão do servidor: 5.7.11
-- Versão do PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `celke`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `nome_classe` varchar(220) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `classes`
--

INSERT INTO `classes` (`id`, `nome_classe`, `created`, `modified`) VALUES
(1, 'ControleHome', '2016-11-20 21:51:34', NULL),
(2, 'ControleLogin', '2016-11-20 21:51:34', NULL),
(3, 'ControleUsuario', '2016-11-20 21:51:34', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `methodos`
--

CREATE TABLE `methodos` (
  `id` int(11) NOT NULL,
  `nome_method` varchar(220) DEFAULT NULL,
  `classe_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `methodos`
--

INSERT INTO `methodos` (`id`, `nome_method`, `classe_id`, `created`, `modified`) VALUES
(1, 'index', 1, '2016-11-20 21:51:34', NULL),
(2, 'login', 2, '2016-11-20 21:51:34', NULL),
(3, 'logout', 2, '2016-11-20 21:51:34', NULL),
(4, 'listarClasseMethodo', 2, '2016-11-20 21:51:34', NULL),
(5, 'cadastrarClasse', 2, '2016-11-20 21:51:34', NULL),
(6, 'index', 3, '2016-11-20 21:51:34', NULL),
(7, 'cadastrar', 3, '2016-11-20 21:51:34', NULL),
(8, 'visualizar', 3, '2016-11-20 21:51:34', NULL),
(9, 'editar', 3, '2016-11-20 21:51:34', NULL),
(10, 'apagar', 3, '2016-11-20 21:51:34', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `niveis_acessos`
--

CREATE TABLE `niveis_acessos` (
  `id` int(11) NOT NULL,
  `nome_niveis_acesso` varchar(220) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `niveis_acessos`
--

INSERT INTO `niveis_acessos` (`id`, `nome_niveis_acesso`, `created`, `modified`) VALUES
(1, 'Administrador', '2016-10-13 00:00:00', NULL),
(2, 'Colaborador', '2016-10-13 00:00:00', NULL),
(3, 'Cliente', '2016-10-13 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissoes`
--

CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL,
  `classe_id` int(11) DEFAULT NULL,
  `methodo_id` int(11) DEFAULT NULL,
  `niveis_acesso_id` int(11) DEFAULT NULL,
  `situacao_permissao` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `permissoes`
--

INSERT INTO `permissoes` (`id`, `classe_id`, `methodo_id`, `niveis_acesso_id`, `situacao_permissao`, `created`, `modified`) VALUES
(1, 1, 1, 1, 1, '2016-11-20 21:56:17', NULL),
(2, 1, 1, 2, 2, '2016-11-20 21:56:17', NULL),
(3, 1, 1, 3, 2, '2016-11-20 21:56:17', NULL),
(4, 2, 2, 1, 1, '2016-11-20 21:56:17', NULL),
(5, 2, 2, 2, 2, '2016-11-20 21:56:17', NULL),
(6, 2, 2, 3, 2, '2016-11-20 21:56:17', NULL),
(7, 2, 3, 1, 1, '2016-11-20 21:56:17', NULL),
(8, 2, 3, 2, 2, '2016-11-20 21:56:17', NULL),
(9, 2, 3, 3, 2, '2016-11-20 21:56:17', NULL),
(10, 2, 4, 1, 1, '2016-11-20 21:56:17', NULL),
(11, 2, 4, 2, 2, '2016-11-20 21:56:17', NULL),
(12, 2, 4, 3, 2, '2016-11-20 21:56:17', NULL),
(13, 2, 5, 1, 1, '2016-11-20 21:56:17', NULL),
(14, 2, 5, 2, 2, '2016-11-20 21:56:17', NULL),
(15, 2, 5, 3, 2, '2016-11-20 21:56:17', NULL),
(16, 3, 6, 1, 1, '2016-11-20 21:56:17', NULL),
(17, 3, 6, 2, 2, '2016-11-20 21:56:17', NULL),
(18, 3, 6, 3, 2, '2016-11-20 21:56:17', NULL),
(19, 3, 7, 1, 1, '2016-11-20 21:56:17', NULL),
(20, 3, 7, 2, 2, '2016-11-20 21:56:17', NULL),
(21, 3, 7, 3, 2, '2016-11-20 21:56:17', NULL),
(22, 3, 8, 1, 1, '2016-11-20 21:56:17', NULL),
(23, 3, 8, 2, 2, '2016-11-20 21:56:17', NULL),
(24, 3, 8, 3, 2, '2016-11-20 21:56:17', NULL),
(25, 3, 9, 1, 1, '2016-11-20 21:56:17', NULL),
(26, 3, 9, 2, 2, '2016-11-20 21:56:17', NULL),
(27, 3, 9, 3, 2, '2016-11-20 21:56:17', NULL),
(28, 3, 10, 1, 1, '2016-11-20 21:56:17', NULL),
(29, 3, 10, 2, 2, '2016-11-20 21:56:17', NULL),
(30, 3, 10, 3, 2, '2016-11-20 21:56:17', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `situacoes_users`
--

CREATE TABLE `situacoes_users` (
  `id` int(11) NOT NULL,
  `nome_sit_user` varchar(220) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `situacoes_users`
--

INSERT INTO `situacoes_users` (`id`, `nome_sit_user`, `created`, `modified`) VALUES
(1, 'Ativo', '2016-10-13 00:00:00', NULL),
(2, 'Inativo', '2016-10-13 00:00:00', NULL),
(3, 'Aguardando Confirmação', '2016-10-13 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(220) DEFAULT NULL,
  `email` varchar(220) DEFAULT NULL,
  `password` varchar(220) DEFAULT NULL,
  `foto` varchar(220) DEFAULT NULL,
  `niveis_acesso_id` int(11) DEFAULT NULL,
  `situacoes_user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `foto`, `niveis_acesso_id`, `situacoes_user_id`, `created`, `modified`) VALUES
(1, 'Cesar7', 'cesar7@celke.com.br', '202cb962ac59075b964b07152d234b70', 'cesar_szpak.png', 1, 1, '2016-10-13 00:00:00', NULL),
(2, 'Cesar', 'cesar@celke.com.br', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL),
(3, 'Cesar3', 'cesar@celke.com.br', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL),
(4, 'Kelly1', 'kelly@celke.com.br', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL),
(5, 'Kelly5', 'kelly5@celke.com.br', 'e4da3b7fbbce2345d7772b0674a318d5', NULL, NULL, NULL, NULL, NULL),
(6, 'Kelly', 'kelly@celke.com.br', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL),
(7, 'Kelly', 'kelly@celke.com.br', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL),
(8, 'Cesar', 'cesar@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL),
(9, 'Cesar', 'cesar@celke.com.br', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL),
(10, 'Cesar', 'cesar@celke.com.br', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL),
(11, 'Cesar', 'cesar@celke.com.br', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL),
(12, 'Cesar12', 'cesar@celke.com.br', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL),
(13, 'Cesar13', 'cesar@celke.com.br', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL),
(14, 'Cesar', 'cesar@celke.com.br', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `methodos`
--
ALTER TABLE `methodos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `niveis_acessos`
--
ALTER TABLE `niveis_acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `situacoes_users`
--
ALTER TABLE `situacoes_users`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `methodos`
--
ALTER TABLE `methodos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de tabela `niveis_acessos`
--
ALTER TABLE `niveis_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de tabela `situacoes_users`
--
ALTER TABLE `situacoes_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
