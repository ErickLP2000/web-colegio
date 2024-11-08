-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2024 a las 01:37:14
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
-- Base de datos: `sistema-escolar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `profesor_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `nivel_est` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`profesor_id`, `nombre`, `direccion`, `cedula`, `clave`, `telefono`, `correo`, `nivel_est`, `estado`) VALUES
(4, 'Jorges', 'Caracas', '123142', '$2y$10$oX3bCt9eoNYpHwZKTvci8usp.tccVx.DllrljgKrZbs6lDYjvqw1C', 942158348, 'luis@gmail.com', 'Técnico', 1),
(5, 'Jorge', 'Caracas', '1234567', '$2y$10$U2oztuWdzsZN89zH6Rr4D.9t4gpMCiwN/flDfWx9QdEEIPPYajLgi', 942158348, 'luis@gmail.com', 'Ingeniero de Sistemas', 1),
(6, 'Andres', 'Caracas', '4861231', '$2y$10$pOXekRLk8CWqO0iRNijouuybjFQmMRiQ5/DGLQxXVBEZ3IVMFwEtC', 94215491, 'andre@gmail.com', 'Ingeniero de Sistemas', 0),
(7, 'Andresasd', 'Caracas', '549611', '$2y$10$ml8VYOYsV6wSCw/DVzsj7uzr6DN6QtHOwd8Y9oGV4M1tXmhVUWe2m', 942154918, 'andru@gmail.com', 'Ingeniero de Sistemas', 1),
(8, 'Jomar', 'Callao', '14952', '$2y$10$UBzBKtql3PxDzJZQ7exlCe.jtJmOSVpHw6eZ4x.m/EKE1mkoKHFVW', 938157492, 'jomar@gmail.com', 'Técnico', 0),
(9, 'Carlitos Ñandu', 'Lima', '154982', '$2y$10$aaBO6O13ctV0ldiLotp0reWI8GMIgxYBlnmWYrV88KjeABX7VtA0W', 94174111, 'jomar@gmail.com', 'Ingeniero de Sistemas', 1),
(10, 'aSDasd', 'dasdasda', '1456123', '$2y$10$WmpmqUjChMs.lIR3yekWx.SjGeFQN8.7Gzst5mobPuscuEOgoYx/m', 978451615, 'luis@gmail.com', 'Técnico', 1),
(11, 'Luis Nogueraa', 'Comas', '545151', '$2y$10$O9l.yMM88My7iKgy4m/fh.s1ns3IpQcUNJtqLvt/H5pNI3GeADJ5S', 965196519, 'luis@gmail.com', 'Técnico', 1),
(12, 'Alfonso', 'Lima', '7514911', '$2y$10$Q9sYT0IL8bSj74CKqsAVkORQqCcaxLrKWnGtMIDGfmdjMkGh0Yk96', 97848716, 'miqui@gmail.com', 'Técnico', 1),
(13, 'asdasda', 'Lima', '14597115', '$2y$10$/kijAW52KyVakM.U.6Se6.uaAk26gBVl.K4yi6ylMQThMr.ZiAhwu', 98711561, 'luis@gmail.com', 'Ingeniero de Sistemas', 1),
(14, 'Andres', 'Comas', '1231442', '$2y$10$zZxw2ksX5inIsof/MJOUYOFZkC3kDUhbalodh9/h1aquq1eksd94G', 9235165, 'miqui@gmail.com', 'Ingeniero de Sistemas', 1),
(15, 'Tarde', 'Lima', '123124124', '$2y$10$X7Uz06GdRc5FAfVHZ1Wqge/zfa8vGWuErgn0UldBSOP1ID8fByLgm', 9874651651, 'luis@gmail.com', 'Ingeniero de Sistemas', 1),
(16, 'More', 'Lima', '153453245', '$2y$10$xk67GbPhMhwJL3KIYN.pCuWxlItJqrOVsXoe9ZgYkzgI6Z9ttOcca', 9174165, 'jomar@gmail.com', 'Técnico', 1),
(17, 'Tarde', 'Comas', '12345672', '$2y$10$le4E4F/sx5VXpE8aoSEl3eJ5Rumv32VOfkOWb4Fz8UwnQhC4hbH9O', 9451235, 'miqui@gmail.com', 'Técnico', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`profesor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `profesor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
