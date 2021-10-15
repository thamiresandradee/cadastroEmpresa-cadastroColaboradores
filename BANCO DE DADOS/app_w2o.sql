-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Out-2021 às 16:49
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `app_w2o`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `colaborador_id` int(11) NOT NULL,
  `colaborador_id_empresa` int(11) NOT NULL,
  `colaborador_nome` varchar(45) NOT NULL,
  `colaborador_sobrenome` varchar(150) NOT NULL,
  `colaborador_data_nascimento` date DEFAULT NULL,
  `colaborador_email` varchar(50) NOT NULL,
  `colaborador_telefone` varchar(20) NOT NULL,
  `colaborador_celular` varchar(20) NOT NULL,
  `colaborador_status` tinyint(1) NOT NULL,
  `dt_cadastro` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dt_modificacao` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `colaboradores`
--

INSERT INTO `colaboradores` (`colaborador_id`, `colaborador_id_empresa`, `colaborador_nome`, `colaborador_sobrenome`, `colaborador_data_nascimento`, `colaborador_email`, `colaborador_telefone`, `colaborador_celular`, `colaborador_status`, `dt_cadastro`, `dt_modificacao`) VALUES
(1, 2, 'Thamires', 'Andrade', '1989-10-24', 'thamires@gmail.com', '(13) 9999-9888', '(13) 88888-9999', 1, '2021-10-15 12:20:57', '2021-01-22 17:30:30'),
(14, 2, 'Thamires1', 'Andrade1', NULL, 'thamires.andradee@gmail.com', '(99) 1368-4891', '(12) 22222-2222', 1, '2021-10-15 13:05:05', '2021-10-15 13:05:05'),
(15, 3, 'Thamires2', 'Andrade', NULL, 'thamires.andradee2@gmail.com', '(13) 3227-3005', '(13) 99136-8489', 1, '2021-10-15 13:07:11', '2021-10-15 13:07:11'),
(16, 3, 'Thamires 3', 'Teste', NULL, 'thamires3@teste.com.br', '(12) 1121-1212', '(12) 12122-1121', 1, '2021-10-15 13:08:41', '2021-10-15 13:08:41'),
(18, 3, 'Thamires34', 'Andrade', NULL, 'thamires.andrade4e@gmail.com', '(99) 1368-4895', '(55) 55555-5555', 1, '2021-10-15 13:11:04', '2021-10-15 13:11:04'),
(19, 3, 'Thamires23', 'Andrade', NULL, 'thamire2s.andradee@gmail.com', '(99) 1368-4893', '(33) 33333-3333', 1, '2021-10-15 13:12:38', '2021-10-15 13:12:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `empresa_id` int(11) NOT NULL,
  `empresa_razao_social` varchar(145) DEFAULT NULL,
  `empresa_cnpj` varchar(19) DEFAULT NULL,
  `empresa_telefone` varchar(25) DEFAULT NULL,
  `empresa_celular` varchar(25) NOT NULL,
  `empresa_email` varchar(100) DEFAULT NULL,
  `empresa_cep` varchar(25) DEFAULT NULL,
  `empresa_endereco` varchar(145) DEFAULT NULL,
  `empresa_bairro` varchar(100) NOT NULL,
  `empresa_numero_endereco` varchar(25) DEFAULT NULL,
  `empresa_complemento` varchar(20) NOT NULL,
  `empresa_cidade` varchar(45) DEFAULT NULL,
  `empresa_uf` varchar(2) DEFAULT NULL,
  `empresa_status` tinyint(1) NOT NULL,
  `dt_cadastro` datetime NOT NULL DEFAULT current_timestamp(),
  `dt_modificacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`empresa_id`, `empresa_razao_social`, `empresa_cnpj`, `empresa_telefone`, `empresa_celular`, `empresa_email`, `empresa_cep`, `empresa_endereco`, `empresa_bairro`, `empresa_numero_endereco`, `empresa_complemento`, `empresa_cidade`, `empresa_uf`, `empresa_status`, `dt_cadastro`, `dt_modificacao`) VALUES
(2, 'System W2O Pojeto', '21.103.539/0001-46', '(13) 99164-8105', '(13) 99164-8105', '', '11015-002', 'Avenida Conselheiro Nébias', 'Vila Mathias', '248', '', 'Santos', 'SP', 0, '2021-10-14 23:30:32', '2021-10-14 23:30:32'),
(3, 'Teste de Empresa 2', '09.553.466/0001-99', '(12) 1111-1111', '(12) 12121-1111', 'teste@teste.com.br', '', '', '', '', '', '', '', 1, '2021-10-15 10:06:43', '2021-10-15 10:06:43');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`colaborador_id`);

--
-- Índices para tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`empresa_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `colaborador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `empresa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
