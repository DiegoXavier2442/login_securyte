-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2025 a las 22:52:11
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
-- Base de datos: `login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `token` text NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `intentos_fallidos` int(11) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `token`, `usuario`, `email`, `contrasenia`, `intentos_fallidos`, `fecha_registro`) VALUES
(10, '8bc622a7fa10df60d9800659c13faff3', 'Pablo ', 'pablo@gmail.com', '123456', 3, '2025-11-04 03:31:27'),
(11, '740ce32d5b415753059d7ad81f3797bb', 'Diego', 'diego@gmail.com', '$6$rounds=xavier$ycvMgSrNEvD6My4Aq0hiHLgOsNJNOLd2bLJQiHkLoAk276gv1c9/u0LuxyNGWgBRjEjxYz.vRRkYetsiCGzvT0', 0, '2025-11-04 03:40:39'),
(12, 'cbdf45bd5f7b1381fdbe75de01f952ad', 'xavier ', 'xavier@gmail.com', '$6$rounds=xavier$M/7t9oMdDSaTRKC0xy4.vN5obrMRacWPkNzd2cGgZ.wECaJVsonvn7eXpPtXbmXnhGlK27fWxBKpfg0Y7m7Wi/', 3, '2025-11-04 03:44:26'),
(13, '9a8fdd5efe165ddd1c0c6fede0078194', 'lucas ', 'lucas@gmail.com', '$6$rounds=xavier$h8G4tSVj7MEaRNUO4Yt1xqFsW.wR2CNrytJFXb/.d7l8/WW4a7d5foa7ZOD22VVMd6jJgHGhPRmi.IW3f2xL4/', 0, '2025-11-04 03:48:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `correo` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
