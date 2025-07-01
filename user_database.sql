-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 01/07/2025 às 22:08
-- Versão do servidor: 10.5.29-MariaDB-ubu2004
-- Versão do PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `user_database`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `token_blacklist`
--

CREATE TABLE `token_blacklist` (
  `token` text NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `token_blacklist`
--

INSERT INTO `token_blacklist` (`token`, `expires_at`) VALUES
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3NTE0MDY1NDYsIm5iZiI6MTc1MTQwNjU0NiwiZXhwIjoxNzUxNDEwMTQ2LCJ1aWQiOiIyIiwiZW1haWwiOiJqb2FvQGVtYWlsTWFsdWNvLmNvbSIsImxldmVsIjoiMSJ9.Kvu7DQyjLAd7QwF3jYnmp7TfSUhquwVnJdMvIueeMB4', '2025-07-01 22:49:06'),
('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3NTE0MDY1NDYsIm5iZiI6MTc1MTQwNjU0NiwiZXhwIjoxNzUxNDEwMTQ2LCJ1aWQiOiIyIiwiZW1haWwiOiJqb2FvQGVtYWlsTWFsdWNvLmNvbSIsImxldmVsIjoiMSJ9.Kvu7DQyjLAd7QwF3jYnmp7TfSUhquwVnJdMvIueeMB4', '2025-07-01 22:49:06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_level` int(11) NOT NULL COMMENT '1 - Admin , 2  - User',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `access_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'nome tdasdasdeste', 'joao@teste.com', '$2y$10$Ph5PD3t1TY6f0hjZ/Xw1..0Mr3SMGKD3uDR62PnpeAZcS1IgReWAK', 1, '2025-07-01 12:49:39', '2025-07-01 14:01:35', '2025-07-01 14:01:35'),
(2, 'nome teste222', 'joao@emailMaluco.com', '$2y$10$mWgZA47Z8XicY8.9oce1vebB3R6NTnzrViLS5W7FDVIuZYE5v7aa2', 1, '2025-07-01 12:49:45', '2025-07-01 21:28:50', NULL),
(3, 'nome teste', 'emasil@teste.com', '$2y$10$U.4XdMKzS5do/0.Yvwrs/eSvdev0EHjODDWNSrYJih6A86GT3F8v.', 1, '2025-07-01 13:40:57', '2025-07-01 20:57:17', '2025-07-01 20:57:17'),
(4, 'login teste', 'email@login.com', '$2y$10$ZzhQqaLHdMUxiK3QLCWDkulQbpiwwoUHsNZHOT0x0g9rf90I58BuK', 1, '2025-07-01 15:48:18', '2025-07-01 15:48:18', NULL),
(5, 'login teste', 'email2@login.com', '$2y$10$KnWVQ/bKY1VXiRYJcqJiUOAO.j2XZIQ8TDeMlr4O8NpleHg3jFu/y', 1, '2025-07-01 18:59:18', '2025-07-01 18:59:18', NULL),
(6, 'João Vitor Gonzaga Jota', 'joaovitorgonzaga18@gmail.com', '$2y$10$60H42AhwtVYT.IxibtUf5uDap.K.Arb0NYWmPGNoT6xAlh.wj2TbO', 1, '2025-07-01 20:50:30', '2025-07-01 20:50:30', NULL),
(7, 'João Vitor Gonzaga Jota', 'joaovitorgonza2ga18@gmail.com', '$2y$10$wiS1/FdHdlXPlSzhj7Y1m.Ze.dLGUNmas.y4cs6fTysOdL3rkTE6C', 1, '2025-07-01 20:51:57', '2025-07-01 20:51:57', NULL),
(8, 'asd', 'joao-1157@hotmail.com', '$2y$10$L2LGCxz7y1zawuosqr3qm.ilCrsxMbKtnEfLWnVPJ0RusqJJsC3T2', 2, '2025-07-01 20:52:47', '2025-07-01 21:30:49', '2025-07-01 21:30:49');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
