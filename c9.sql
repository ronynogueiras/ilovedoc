-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Máquina: 127.0.0.1
-- Data de Criação: 04-Jun-2016 às 12:02
-- Versão do servidor: 5.5.49-0ubuntu0.14.04.1
-- versão do PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `c9`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE IF NOT EXISTS `documentos` (
  `dc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dc_nome` varchar(128) NOT NULL,
  `dc_modelo` int(11) DEFAULT NULL,
  `dc_conteudo` text,
  `dc_projeto` int(11) NOT NULL,
  `dc_original` int(11) DEFAULT NULL,
  `dc_modificado` datetime DEFAULT NULL,
  `dc_modificador` int(11) DEFAULT NULL,
  `dc_momento` datetime NOT NULL,
  PRIMARY KEY (`dc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

CREATE TABLE IF NOT EXISTS `projetos` (
  `pr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pr_usuario` int(11) NOT NULL,
  `pr_nome` varchar(128) NOT NULL,
  `pr_descricao` text,
  `pr_modelo` int(11) DEFAULT NULL,
  `pr_situacao` enum('Ativo','Desativado') NOT NULL,
  `pr_momento` datetime NOT NULL,
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `projetos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos_usuarios`
--

CREATE TABLE IF NOT EXISTS `projetos_usuarios` (
  `pu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pu_usuario` int(11) NOT NULL,
  `pu_projeto` int(11) NOT NULL,
  `pu_momento` datetime NOT NULL,
  PRIMARY KEY (`pu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_usuario`
--

CREATE TABLE IF NOT EXISTS `tipos_usuario` (
  `tp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tp_nome` varchar(128) NOT NULL,
  PRIMARY KEY (`tp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `us_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `us_usuario` varchar(128) NOT NULL,
  `us_email` varchar(128) NOT NULL,
  `us_senha` varchar(32) NOT NULL,
  `us_situacao` enum('Ativo','Desativado') DEFAULT NULL,
  `us_tipo` int(11) DEFAULT NULL,
  `us_momento` datetime DEFAULT NULL,
  PRIMARY KEY (`us_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `usuarios`
--
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
