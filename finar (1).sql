-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/03/2024 às 18:14
-- Versão do servidor: 10.4.21-MariaDB
-- Versão do PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `finar`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `banco`
--

CREATE TABLE `banco` (
  `id_banco` int(11) NOT NULL,
  `nome_banco` varchar(50) NOT NULL,
  `quantidade_maxima` decimal(18,4) NOT NULL,
  `quantidade_minima` decimal(18,4) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` char(14) NOT NULL,
  `cep` char(10) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` char(5) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` char(2) NOT NULL,
  `telefone` char(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_cobranca` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `data_registro` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gatilhos `cliente`
--
DELIMITER $$
CREATE TRIGGER `mascara_cpf` BEFORE INSERT ON `cliente` FOR EACH ROW BEGIN
    DECLARE cpf_temp CHAR(14);
    SET cpf_temp = NEW.cpf;
    
    IF LENGTH(cpf_temp) = 11 THEN
        SET NEW.cpf = CONCAT(SUBSTRING(cpf_temp, 1, 3), '.', SUBSTRING(cpf_temp, 4, 3), '.', SUBSTRING(cpf_temp, 7, 3), '-', SUBSTRING(cpf_temp, 10));
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `mascara_telefone` BEFORE INSERT ON `cliente` FOR EACH ROW BEGIN
    DECLARE telefone_temp CHAR(15);
    SET telefone_temp = NEW.telefone;
    
    IF LENGTH(telefone_temp) = 11 THEN
        SET NEW.telefone = CONCAT('(', SUBSTRING(telefone_temp, 1, 2), ') ', SUBSTRING(telefone_temp, 3, 4), '-', SUBSTRING(telefone_temp, 7));
    ELSEIF LENGTH(telefone_temp) = 10 THEN
        SET NEW.telefone = CONCAT('(', SUBSTRING(telefone_temp, 1, 2), ') ', SUBSTRING(telefone_temp, 3, 5), '-', SUBSTRING(telefone_temp, 8));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cobranca`
--

CREATE TABLE `cobranca` (
  `id_cobranca` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `data_cobranca` char(10) NOT NULL,
  `data_vencimento` char(10) NOT NULL,
  `documento` varchar(30) NOT NULL,
  `valor` decimal(18,4) NOT NULL,
  `link_boleto` varchar(30) NOT NULL,
  `id_forma_pagto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `documentos_localizacao`
--

CREATE TABLE `documentos_localizacao` (
  `id_documento_loc` int(11) NOT NULL,
  `arquivo` longblob NOT NULL,
  `id_localizacao` int(11) NOT NULL,
  `nome_documento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `documentos_produto`
--

CREATE TABLE `documentos_produto` (
  `id_documento_prod` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `arquivo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `documentos_produto`
--

INSERT INTO `documentos_produto` (`id_documento_prod`, `nome`, `id_produto`, `arquivo`) VALUES
(1, 'reste', 1, 'XOHR.gif');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `razao_social` varchar(50) NOT NULL,
  `nome_fantasia` varchar(50) NOT NULL,
  `cnpj` char(18) NOT NULL,
  `cep` char(10) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` char(5) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` char(2) NOT NULL,
  `telefone` char(14) NOT NULL,
  `situacao` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `razao_social`, `nome_fantasia`, `cnpj`, `cep`, `endereco`, `numero`, `bairro`, `complemento`, `cidade`, `uf`, `telefone`, `situacao`) VALUES
(1, 'ACADEMIA JAZZ BELL SC LTDA', 'JAZZ BELL', '36.073.921/0001-65', '17516740', 'teste', '12', 'teste', 'teste', 'Marilia', 'SP', '14991304050', 'T'),
(2, 'Register Software', 'Register Software', '05.123.456/0001-12', '17516740', 'Avenida João Procópio da Silva', '800', 'Jardim Esmeralda', 'Condominio Residencial', 'Marília', 'SP', '(14) 9912-1011', 'T');

--
-- Gatilhos `empresa`
--
DELIMITER $$
CREATE TRIGGER `mascara_cnpj` BEFORE INSERT ON `empresa` FOR EACH ROW BEGIN
    DECLARE cnpj_without_mask VARCHAR(14);
    DECLARE cnpj_with_mask VARCHAR(18);
    
    SET cnpj_without_mask = NEW.cnpj;
    
    -- Remove todos os caracteres não numéricos
    SET cnpj_without_mask = REPLACE(cnpj_without_mask, ".", "");
    SET cnpj_without_mask = REPLACE(cnpj_without_mask, "/", "");
    SET cnpj_without_mask = REPLACE(cnpj_without_mask, "-", "");
    
    -- Adiciona a máscara correta
    SET cnpj_with_mask = CONCAT(
        LEFT(cnpj_without_mask, 2), '.', 
        MID(cnpj_without_mask, 3, 3), '.', 
        MID(cnpj_without_mask, 6, 3), '/', 
        MID(cnpj_without_mask, 9, 4), '-', 
        RIGHT(cnpj_without_mask, 2)
    );
    
    -- Atualiza o valor do CNPJ na nova linha
    SET NEW.cnpj = cnpj_with_mask;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `mascara_telefone_empresa` BEFORE INSERT ON `empresa` FOR EACH ROW BEGIN
    DECLARE telefone_temp CHAR(15);
    SET telefone_temp = NEW.telefone;
    
    IF LENGTH(telefone_temp) = 11 THEN
        SET NEW.telefone = CONCAT('(', SUBSTRING(telefone_temp, 1, 2), ') ', SUBSTRING(telefone_temp, 3, 4), '-', SUBSTRING(telefone_temp, 7));
    ELSEIF LENGTH(telefone_temp) = 10 THEN
        SET NEW.telefone = CONCAT('(', SUBSTRING(telefone_temp, 1, 2), ') ', SUBSTRING(telefone_temp, 3, 5), '-', SUBSTRING(telefone_temp, 8));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `formas`
--

CREATE TABLE `formas` (
  `id_forma` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `formas`
--

INSERT INTO `formas` (`id_forma`, `nome`) VALUES
(1, 'Dinheiro'),
(2, 'Cartão'),
(3, 'Boleto'),
(4, 'Cheque'),
(5, 'Pix');

-- --------------------------------------------------------

--
-- Estrutura para tabela `forma_pagamento`
--

CREATE TABLE `forma_pagamento` (
  `id_forma_pagto` int(11) NOT NULL,
  `id_banco` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id_fornecedor` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cnpj` char(18) NOT NULL,
  `cep` char(9) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `numero` char(5) NOT NULL,
  `ie` varchar(18) NOT NULL,
  `telefone` char(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` char(1) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id_fornecedor`, `nome`, `cnpj`, `cep`, `endereco`, `bairro`, `complemento`, `cidade`, `numero`, `ie`, `telefone`, `email`, `status`, `id_empresa`) VALUES
(1, 'teste', '12.345.678/000-00', '17516740', 'teste', 'teste', 'teste', 'teste', '12', 'teste', 'teste', 'teste', 'T', 1);

--
-- Gatilhos `fornecedor`
--
DELIMITER $$
CREATE TRIGGER `mascara_cnpj_fornecedor` BEFORE INSERT ON `fornecedor` FOR EACH ROW BEGIN
    DECLARE cnpj_without_mask VARCHAR(14);
    DECLARE cnpj_with_mask VARCHAR(18);
    
    SET cnpj_without_mask = NEW.cnpj;
    
    -- Remove todos os caracteres não numéricos
    SET cnpj_without_mask = REPLACE(cnpj_without_mask, ".", "");
    SET cnpj_without_mask = REPLACE(cnpj_without_mask, "/", "");
    SET cnpj_without_mask = REPLACE(cnpj_without_mask, "-", "");
    
    -- Adiciona a máscara correta
    SET cnpj_with_mask = CONCAT(
        LEFT(cnpj_without_mask, 2), '.', 
        MID(cnpj_without_mask, 3, 3), '.', 
        MID(cnpj_without_mask, 6, 3), '/', 
        MID(cnpj_without_mask, 9, 4), '-', 
        RIGHT(cnpj_without_mask, 2)
    );
    
    -- Atualiza o valor do CNPJ na nova linha
    SET NEW.cnpj = cnpj_with_mask;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `mascara_telefone_fornecedor` BEFORE INSERT ON `fornecedor` FOR EACH ROW BEGIN
    DECLARE telefone_temp CHAR(15);
    SET telefone_temp = NEW.telefone;
    
    IF LENGTH(telefone_temp) = 11 THEN
        SET NEW.telefone = CONCAT('(', SUBSTRING(telefone_temp, 1, 2), ') ', SUBSTRING(telefone_temp, 3, 4), '-', SUBSTRING(telefone_temp, 7));
    ELSEIF LENGTH(telefone_temp) = 10 THEN
        SET NEW.telefone = CONCAT('(', SUBSTRING(telefone_temp, 1, 2), ') ', SUBSTRING(telefone_temp, 3, 5), '-', SUBSTRING(telefone_temp, 8));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_produto`
--

CREATE TABLE `historico_produto` (
  `id_historico` int(11) NOT NULL,
  `operacao` varchar(50) NOT NULL,
  `data_hora` datetime NOT NULL,
  `quantidade_antiga` decimal(18,4) NOT NULL,
  `quantidade_atual` decimal(18,4) NOT NULL,
  `id_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `localizacao`
--

CREATE TABLE `localizacao` (
  `id_localizacao` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `localizacao`
--

INSERT INTO `localizacao` (`id_localizacao`, `nome`, `id_empresa`, `status`) VALUES
(1, 'testeeeeee', 1, 'T');

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `cod_barras` varchar(100) NOT NULL,
  `cod_aux` varchar(100) NOT NULL,
  `custo` decimal(18,4) NOT NULL,
  `preco_venda` decimal(18,4) NOT NULL,
  `estoque_minimo` decimal(18,4) NOT NULL,
  `estoque_atual` decimal(18,4) NOT NULL,
  `id_localizacao` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `id_solicitacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `descricao`, `cod_barras`, `cod_aux`, `custo`, `preco_venda`, `estoque_minimo`, `estoque_atual`, `id_localizacao`, `id_fornecedor`, `id_empresa`, `status`, `id_solicitacao`) VALUES
(1, 'teste', '2321', 'dssadas3', '12.0000', '12.0000', '12.0000', '12.0000', 1, 1, 1, 'T', 0);

--
-- Gatilhos `produto`
--
DELIMITER $$
CREATE TRIGGER `historico_produto` AFTER UPDATE ON `produto` FOR EACH ROW BEGIN
    IF OLD.estoque_atual <> NEW.estoque_atual THEN
        INSERT INTO historico_produto(quantidade_antiga, quantidade_atual, operacao, id_produto, data_hora)
        VALUES (OLD.estoque_atual, NEW.estoque_atual, 'Movimenta Estoque', NEW.id_produto,CURRENT_TIMESTAMP());
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos_compra`
--

CREATE TABLE `produtos_compra` (
  `id_produtos_compra` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `quantidade` decimal(18,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `solicitacao_compra`
--

CREATE TABLE `solicitacao_compra` (
  `id_solicitacao` int(11) NOT NULL,
  `descricao` varchar(30) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `valor` decimal(18,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `status`
--

INSERT INTO `status` (`id_status`, `nome`) VALUES
(1, 'Em analise'),
(2, 'Vendido'),
(3, 'Negociando'),
(4, 'Experimental'),
(5, 'Pago'),
(7, 'Em atraso');

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `id_venda` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `quantidade_vendia` decimal(18,4) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_forma_pagto` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `valor_venda` decimal(18,4) NOT NULL,
  `id_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `viagem`
--

CREATE TABLE `viagem` (
  `id_viagem` int(11) NOT NULL,
  `descricao` int(11) NOT NULL,
  `data_viagem` char(10) NOT NULL,
  `valor` decimal(18,4) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`id_banco`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `cobranca`
--
ALTER TABLE `cobranca`
  ADD PRIMARY KEY (`id_cobranca`);

--
-- Índices de tabela `documentos_localizacao`
--
ALTER TABLE `documentos_localizacao`
  ADD PRIMARY KEY (`id_documento_loc`);

--
-- Índices de tabela `documentos_produto`
--
ALTER TABLE `documentos_produto`
  ADD PRIMARY KEY (`id_documento_prod`);

--
-- Índices de tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices de tabela `formas`
--
ALTER TABLE `formas`
  ADD PRIMARY KEY (`id_forma`);

--
-- Índices de tabela `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  ADD PRIMARY KEY (`id_forma_pagto`);

--
-- Índices de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices de tabela `historico_produto`
--
ALTER TABLE `historico_produto`
  ADD PRIMARY KEY (`id_historico`);

--
-- Índices de tabela `localizacao`
--
ALTER TABLE `localizacao`
  ADD PRIMARY KEY (`id_localizacao`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `produtos_compra`
--
ALTER TABLE `produtos_compra`
  ADD PRIMARY KEY (`id_produtos_compra`);

--
-- Índices de tabela `solicitacao_compra`
--
ALTER TABLE `solicitacao_compra`
  ADD PRIMARY KEY (`id_solicitacao`);

--
-- Índices de tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `banco`
--
ALTER TABLE `banco`
  MODIFY `id_banco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cobranca`
--
ALTER TABLE `cobranca`
  MODIFY `id_cobranca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `documentos_localizacao`
--
ALTER TABLE `documentos_localizacao`
  MODIFY `id_documento_loc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `documentos_produto`
--
ALTER TABLE `documentos_produto`
  MODIFY `id_documento_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `formas`
--
ALTER TABLE `formas`
  MODIFY `id_forma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  MODIFY `id_forma_pagto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `historico_produto`
--
ALTER TABLE `historico_produto`
  MODIFY `id_historico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `localizacao`
--
ALTER TABLE `localizacao`
  MODIFY `id_localizacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos_compra`
--
ALTER TABLE `produtos_compra`
  MODIFY `id_produtos_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `solicitacao_compra`
--
ALTER TABLE `solicitacao_compra`
  MODIFY `id_solicitacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
