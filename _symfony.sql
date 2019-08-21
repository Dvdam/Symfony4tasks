-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-08-2019 a las 02:52:40
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `symfony`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `priority` varchar(20) DEFAULT NULL,
  `hours` int(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `content`, `priority`, `hours`, `created_at`) VALUES
(1, 1, 'Tarea 1', 'Contenido de prueba 1', 'high', 40, '2019-08-17 15:27:45'),
(2, 1, 'Tarea 2', 'Contenido de prueba 2', 'low', 20, '2019-08-17 15:27:45'),
(3, 2, 'Tarea 3', 'Contenido de prueba 3', 'medium', 10, '2019-08-17 15:27:45'),
(4, 3, 'Tarea 4', 'Contenido de prueba 4', 'high', 50, '2019-08-17 15:27:45'),
(7, 4, 'Maquetar pagina web con symfony', 'Maquetar la parte de el detalle de las tareas', 'low', 3, '2019-08-20 02:49:32'),
(8, 4, 'Soy un titulo muy muy muy largo con mucha información porque no se sintetizar textos más cortos', 'Soy un titulo muy muy muy largo con mucha información porque no se sintetizar textos más cortos', 'medium', 20, '2019-08-20 02:55:39'),
(9, 6, 'Jose Tareas 2 modificada', 'Mi tarea es ver mi tarea para editarla, modificada', 'medium', 222, '2019-08-20 03:55:08'),
(10, 4, 'Mi tarea copada 3', 'Esta es una super tarea y no puede ser mas copada que nunca', 'high', 3, '2019-08-21 02:25:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `surname`, `email`, `password`, `created_at`) VALUES
(1, 'ROLE_USER', 'David', 'Dam', 'david@david.com', 'password', '2019-08-17 15:24:18'),
(2, 'ROLE_USER', 'Ruben', 'Dam', 'ruben@ruben.com', 'password', '2019-08-17 15:24:18'),
(3, 'ROLE_USER', 'Duende', 'Dam', 'duende@duende.com', 'password', '2019-08-17 15:24:18'),
(4, 'ROLE_USER', 'carlos', 'carlos', 'carlos@mail.com', '$2y$04$cm/MsXNoIfvB0UR692h1XutztZAO.k1OQlpJNA4PrkhSzOTMONydC', '2019-08-18 20:17:20'),
(5, 'ROLE_USER', 'caer', 'dfaf', 'sdfaf@corre.com', '$2y$04$QFWPqqWL8QobIUXj2cCG2egtf7tesqL2S9kfxjPBCnQOB4LdMNJAG', '2019-08-19 16:03:41'),
(6, 'ROLE_USER', 'Jose', 'Jose', 'jose@mail.com', '$2y$04$1jtK7UaPDWO51MZ0g74FWeBVEwkAEzrnpNUtzEQlvs7KJILbcE56m', '2019-08-20 03:27:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_task_user` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_task_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
