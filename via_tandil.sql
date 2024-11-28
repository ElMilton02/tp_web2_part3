-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2024 a las 21:39:54
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `via_tandil`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time(4) NOT NULL,
  `id_destinos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`id`, `fecha`, `hora`, `id_destinos`) VALUES
(1, '2024-09-16', '00:00:00.0000', 1),
(2, '2024-09-16', '00:00:00.0000', 2),
(3, '2024-09-16', '00:00:00.0000', 3),
(4, '2024-09-16', '00:00:00.0000', 4),
(5, '2024-09-16', '00:00:00.0000', 5),
(6, '2025-12-10', '00:00:00.0000', 1),
(7, '2025-12-10', '00:00:00.0000', 2),
(8, '2025-12-10', '00:00:00.0000', 3),
(9, '2025-12-10', '00:00:00.0000', 4),
(10, '2025-12-10', '00:00:00.0000', 5),
(11, '2025-01-01', '00:00:00.0000', 1),
(12, '2025-01-01', '00:00:00.0000', 2),
(13, '2025-01-01', '00:00:00.0000', 3),
(14, '2025-01-01', '00:00:00.0000', 4),
(15, '2025-01-01', '00:00:00.0000', 5),
(16, '2024-09-16', '08:00:00.0000', 1),
(17, '2024-09-16', '08:00:00.0000', 2),
(18, '2024-09-16', '08:00:00.0000', 3),
(19, '2024-09-16', '08:00:00.0000', 4),
(20, '2024-09-16', '08:00:00.0000', 5),
(21, '2025-11-10', '08:00:00.0000', 1),
(22, '2025-11-10', '08:00:00.0000', 2),
(23, '2025-11-10', '08:00:00.0000', 3),
(24, '2025-11-10', '08:00:00.0000', 4),
(25, '2025-11-10', '08:00:00.0000', 5),
(26, '2025-01-01', '08:00:00.0000', 1),
(27, '2025-01-01', '08:00:00.0000', 2),
(28, '2025-01-01', '08:00:00.0000', 3),
(29, '2025-01-01', '08:00:00.0000', 4),
(30, '2025-01-01', '08:00:00.0000', 5),
(31, '2024-08-16', '14:00:00.0000', 1),
(32, '2024-08-16', '14:00:00.0000', 2),
(33, '2024-08-16', '14:00:00.0000', 3),
(34, '2024-08-16', '14:00:00.0000', 4),
(35, '2024-08-16', '14:00:00.0000', 5),
(36, '2025-11-10', '14:00:00.0000', 1),
(37, '2025-11-10', '14:00:00.0000', 2),
(38, '2025-11-10', '14:00:00.0000', 3),
(39, '2025-11-10', '14:00:00.0000', 4),
(40, '2025-11-10', '14:00:00.0000', 5),
(41, '2025-01-01', '14:00:00.0000', 1),
(42, '2025-01-01', '14:00:00.0000', 2),
(43, '2025-01-01', '14:00:00.0000', 3),
(44, '2025-01-01', '14:00:00.0000', 4),
(45, '2025-01-01', '14:00:00.0000', 5),
(46, '2024-08-16', '22:00:00.0000', 1),
(47, '2024-08-16', '22:00:00.0000', 2),
(48, '2024-08-16', '22:00:00.0000', 3),
(49, '2024-08-16', '22:00:00.0000', 4),
(50, '2024-08-16', '22:00:00.0000', 5),
(51, '2025-11-10', '22:00:00.0000', 1),
(52, '2025-11-10', '22:00:00.0000', 2),
(53, '2025-11-10', '22:00:00.0000', 3),
(54, '2025-11-10', '22:00:00.0000', 4),
(55, '2025-11-10', '22:00:00.0000', 5),
(56, '2025-03-01', '22:00:00.0000', 1),
(57, '2025-03-01', '22:00:00.0000', 2),
(58, '2025-03-01', '22:00:00.0000', 3),
(59, '2025-03-01', '22:00:00.0000', 4),
(60, '2025-03-01', '22:00:00.0000', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_destinos` (`id_destinos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD CONSTRAINT `viajes_ibfk_2` FOREIGN KEY (`id_destinos`) REFERENCES `destinos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
