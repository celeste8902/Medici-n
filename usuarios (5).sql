-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:33065
-- Tiempo de generación: 05-05-2026 a las 00:58:00
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `limites`
--

CREATE TABLE `limites` (
  `id` int(11) NOT NULL,
  `nominal_diam` decimal(10,5) DEFAULT NULL,
  `tol_diam` decimal(10,5) DEFAULT NULL,
  `lim_red` decimal(10,5) DEFAULT NULL,
  `lim_arm` decimal(10,5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `limites`
--

INSERT INTO `limites` (`id`, `nominal_diam`, `tol_diam`, `lim_red`, `lim_arm`) VALUES
(1, '97.00000', '0.01000', '0.00500', '0.30000'),
(2, '97.00000', '0.01000', '0.00500', '0.30000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mediciones`
--

CREATE TABLE `mediciones` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL,
  `diam1` float DEFAULT NULL,
  `diam2` float DEFAULT NULL,
  `diam3` float DEFAULT NULL,
  `diam4` float DEFAULT NULL,
  `red1` float DEFAULT NULL,
  `red2` float DEFAULT NULL,
  `red3` float DEFAULT NULL,
  `red4` float DEFAULT NULL,
  `arm1` float DEFAULT NULL,
  `arm2` float DEFAULT NULL,
  `arm3` float DEFAULT NULL,
  `arm4` float DEFAULT NULL,
  `resultado` varchar(20) DEFAULT NULL,
  `turno` int(11) DEFAULT NULL,
  `tiempo_muerto` varchar(50) DEFAULT NULL,
  `motivo` text DEFAULT NULL,
  `maquina` varchar(20) DEFAULT NULL,
  `modelo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mediciones`
--

INSERT INTO `mediciones` (`id`, `fecha`, `usuario_id`, `diam1`, `diam2`, `diam3`, `diam4`, `red1`, `red2`, `red3`, `red4`, `arm1`, `arm2`, `arm3`, `arm4`, `resultado`, `turno`, `tiempo_muerto`, `motivo`, `maquina`, `modelo`) VALUES
(1, '2026-04-20 09:08:36', 2, 0, 0, 0, 1, 0, 0, 0, 0, 9.91, 0.002, 0.003, 0.001, 'NO OK', NULL, NULL, NULL, NULL, NULL),
(2, '2026-04-20 09:09:34', 2, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 'NO OK', NULL, NULL, NULL, NULL, NULL),
(3, '2026-04-20 09:16:52', 2, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 'NO OK', NULL, NULL, NULL, NULL, NULL),
(4, '2026-04-20 09:21:20', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'NO OK', NULL, NULL, NULL, NULL, NULL),
(5, '2026-04-20 09:26:50', 2, 0.002, 0.002, 0.003, 0.001, 0.002, 0.001, 0.003, 0.001, 0.001, 0.001, 0.002, 0.002, 'NO OK', NULL, NULL, NULL, NULL, NULL),
(6, '2026-04-20 09:26:55', 2, 0.002, 0.002, 0.003, 0.001, 0.002, 0.001, 0.003, 0.001, 0.001, 0.001, 0.002, 0.002, 'NO OK', NULL, NULL, NULL, NULL, NULL),
(7, '2026-04-20 10:05:17', 2, 97, 96.995, 96.995, 96.995, 0.002, 0.001, 0.002, 0.001, 0.24, 0.32, 0.21, 0.33, 'DESVIADO', NULL, NULL, NULL, NULL, NULL),
(8, '2026-04-26 05:08:11', 2, 0.002, 0.002, 0.003, 0.001, 0.002, 0.001, 0.003, 0.001, 0.001, 0.001, 0.002, 0.001, 'NO OK', NULL, NULL, NULL, NULL, NULL),
(9, '2026-04-26 05:11:27', 2, 97, 96.995, 96.995, 96.995, 0.002, 0.001, 0.002, 0.001, 0.001, 0.001, 0.002, 0.001, 'OK', NULL, NULL, NULL, NULL, NULL),
(10, '2026-04-26 05:31:03', 0, 97, 96.995, 96.995, 96.995, 0.002, 0.001, 0.002, 0.001, 0.001, 0.001, 0.002, 0.001, 'OK', NULL, NULL, NULL, NULL, NULL),
(11, '2026-04-26 05:35:13', 0, 97, 96.995, 96.995, 96.995, 0.002, 0.001, 0.002, 0.001, 0.001, 0.001, 0.002, 0.001, 'OK', 1, NULL, NULL, 'C', '413176'),
(12, '2026-04-26 05:35:50', 0, 97, 96.995, 96.995, 96.995, 0.002, 0.001, 0.003, 0.001, 0.001, 0.002, 0.003, 0.002, 'OK', 1, NULL, NULL, 'C', '413176'),
(13, '2026-04-26 05:36:24', 0, 0.002, 0.002, 0.003, 0.001, 0.002, 0.001, 0.002, 0.001, 0.001, 0.001, 0.002, 0.001, 'NO OK', 1, NULL, NULL, 'C', '413176'),
(14, '2026-04-26 06:24:39', 0, 97, 96.995, 96.995, 96.995, 0.002, 0.001, 0.002, 0.001, 0.001, 0.001, 0.002, 0.001, 'OK', 1, NULL, NULL, 'C', '413176'),
(15, '2026-04-26 06:28:37', 0, 97, 96.995, 96.995, 96.995, 0.002, 0.001, 0.002, 0.001, 0.001, 0.001, 0.002, 0.001, 'OK', 1, NULL, NULL, 'C', '413177'),
(16, '2026-04-26 08:50:04', 2, 97, 96.995, 96.995, 96.995, 0.002, 0.001, 0.002, 0, 0.001, 0.001, 0.003, 0.002, 'OK', 1, NULL, NULL, 'B', '413111'),
(17, '2026-04-26 08:50:43', 2, 0.002, 0.002, 0.003, 0.001, 0.002, 0.001, 0.002, 0.001, 0.001, 0.002, 0.002, 0.001, 'NO OK', 1, NULL, NULL, 'B', '413177'),
(18, '2026-04-26 08:51:24', 2, 97, 96.995, 96.995, 96.995, 0.002, 0.001, 0.002, 0.001, 0.001, 0.001, 0.002, 0.002, 'OK', 1, NULL, NULL, 'B', '413177'),
(19, '2026-05-01 22:46:42', 2, 97, 96.995, 96.995, 96.995, 0.002, 0.001, 0.002, 0.001, 0.001, 0.001, 0.002, 0.001, 'OK', 2, NULL, NULL, 'B', '413177'),
(20, '2026-05-01 22:47:35', 2, 97, 0.002, 0.003, 96.995, 0.002, 0.001, 0.002, 0.001, 0.001, 0.001, 0.002, 0.001, 'NO OK', 2, NULL, NULL, 'B', '413111');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `rol`) VALUES
(1, 'supervisor', '81dc9bdb52d04dc20036dbd8313ed055', 'supervisor'),
(2, 'inspector', 'e2fc714c4727ee9395f324cd2e7f331f', 'inspector');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `limites`
--
ALTER TABLE `limites`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mediciones`
--
ALTER TABLE `mediciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `limites`
--
ALTER TABLE `limites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mediciones`
--
ALTER TABLE `mediciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
