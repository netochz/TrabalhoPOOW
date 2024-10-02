-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/10/2024 às 04:53
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `parkplus_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarifas`
--

CREATE TABLE `tarifas` (
  `id` int(11) NOT NULL,
  `tipo_veiculo_id` int(11) DEFAULT NULL,
  `tarifa_inicial` decimal(10,2) DEFAULT NULL,
  `tarifa_por_hora` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tarifas`
--

INSERT INTO `tarifas` (`id`, `tipo_veiculo_id`, `tarifa_inicial`, `tarifa_por_hora`) VALUES
(1, 1, 4.00, 2.00),
(2, 2, 2.00, 2.00),
(3, 3, 6.00, 2.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_veiculo`
--

CREATE TABLE `tipo_veiculo` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo_veiculo`
--

INSERT INTO `tipo_veiculo` (`id`, `descricao`) VALUES
(1, 'Carro de passeio'),
(2, 'Moto'),
(3, 'Caminhonete');

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `tipo_veiculo_id` int(11) DEFAULT NULL,
  `hora_entrada` datetime DEFAULT NULL,
  `hora_saida` datetime DEFAULT NULL,
  `tempo_permanencia` float DEFAULT NULL,
  `valor_pago` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `veiculos`
--

INSERT INTO `veiculos` (`id`, `placa`, `tipo_veiculo_id`, `hora_entrada`, `hora_saida`, `tempo_permanencia`, `valor_pago`) VALUES
(23, 'IND1233', 2, '2024-09-30 10:47:20', '2024-09-30 10:47:58', 0.0105556, 0.00);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_veiculo_id` (`tipo_veiculo_id`);

--
-- Índices de tabela `tipo_veiculo`
--
ALTER TABLE `tipo_veiculo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_veiculo_id` (`tipo_veiculo_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipo_veiculo`
--
ALTER TABLE `tipo_veiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tarifas`
--
ALTER TABLE `tarifas`
  ADD CONSTRAINT `tarifas_ibfk_1` FOREIGN KEY (`tipo_veiculo_id`) REFERENCES `tipo_veiculo` (`id`);

--
-- Restrições para tabelas `veiculos`
--
ALTER TABLE `veiculos`
  ADD CONSTRAINT `veiculos_ibfk_1` FOREIGN KEY (`tipo_veiculo_id`) REFERENCES `tipo_veiculo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
