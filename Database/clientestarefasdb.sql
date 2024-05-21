-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Maio-2024 às 19:25
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clientestarefasdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `Empresa` varchar(255) NOT NULL,
  `Endereco` varchar(255) DEFAULT NULL,
  `Contacto` varchar(50) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `Objecto` varchar(255) DEFAULT NULL,
  `ContabilidadeFiscalidade` varchar(255) DEFAULT NULL,
  `Auditoria` varchar(255) DEFAULT NULL,
  `Rh` varchar(255) DEFAULT NULL,
  `Acessoria_Juridica` varchar(255) DEFAULT NULL,
  `Expectativa` varchar(255) DEFAULT NULL,
  `Criterios` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefasdiarias`
--

CREATE TABLE `tarefasdiarias` (
  `Item` int(11) NOT NULL,
  `Actividade` varchar(255) NOT NULL,
  `Recursos_Necessarios` varchar(255) DEFAULT NULL,
  `Resp_Actividade` varchar(255) DEFAULT NULL,
  `Data_Inicio` date DEFAULT NULL,
  `Data_Fim` date DEFAULT NULL,
  `Observacoes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tarefasdiarias`
--
ALTER TABLE `tarefasdiarias`
  ADD PRIMARY KEY (`Item`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tarefasdiarias`
--
ALTER TABLE `tarefasdiarias`
  MODIFY `Item` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
