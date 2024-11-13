-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 12-11-2024 a las 20:59:06
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

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
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `actividad_id` int(11) NOT NULL,
  `nombre_actividad` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`actividad_id`, `nombre_actividad`, `estado`) VALUES
(4, 'Olimpiadas', 0),
(5, 'Olimpiadas', 1),
(6, 'Entrega de libretas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `alumno_id` int(11) NOT NULL,
  `nombre_alumno` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `apoderado_id` int(11) NOT NULL,
  `fecha_nac` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`alumno_id`, `nombre_alumno`, `edad`, `direccion`, `documento`, `apoderado_id`, `fecha_nac`, `fecha_registro`, `estado`) VALUES
(4, 'Andres', 13, 'Comas', '165123', 1, '2024-11-13', '2024-11-22', 1),
(5, 'Luis Nogueraa', 24, 'Caracas', '1234567', 1, '2024-10-30', '2024-11-27', 1),
(6, 'Luis Nogueraa', 24, 'Comas', '4861231', 1, '2024-10-29', '2024-11-28', 1),
(7, 'Andres', 24, 'Comas', '91165161', 1, '2024-10-30', '2024-12-07', 0),
(8, 'Maria', 14, 'Lima', '496121', 2, '2024-11-11', '2024-11-29', 1),
(9, 'More', 10, 'Comas', '11111111', 1, '2024-11-22', '2024-12-04', 1),
(10, 'Jose dada', 12, 'Comas', '121541', 1, '2024-11-11', '2024-11-27', 1),
(11, 'Andres', 10, 'Lima', '91165161', 1, '2024-11-15', '2024-11-30', 1),
(12, 'Luis Nogueraa', 10, 'Comas', '1231442', 1, '2024-11-22', '2024-11-23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_profesor`
--

CREATE TABLE `alumno_profesor` (
  `ap_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `pg_id` int(11) NOT NULL,
  `estadop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderado`
--

CREATE TABLE `apoderado` (
  `apoderado_id` int(11) NOT NULL,
  `nombre_apoderado` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `apoderado`
--

INSERT INTO `apoderado` (`apoderado_id`, `nombre_apoderado`, `direccion`, `documento`, `clave`, `telefono`, `correo`, `estado`) VALUES
(1, 'Andres', 'Comas', '71235416', '$2y$10$6yPHQHuZWmhR1AAwqAN3iu7XRowxGVs7BpkQlCIf44GZykaqeAU42', 942154918, 'luis@gmail.com', 1),
(2, 'Luis Nogueraa', 'Caracas', '71235416', '$2y$10$gMaCCd4i.FLe.ABh.MiFzOXNsqpXARfZZsQRl06ovsOsSJiR8e6M.', 942154918, 'luis@gmail.com', 1),
(3, 'qweqwe', 'sadasdasd', 'qweqwe', '$2y$10$SJlJvzXd7MjscP7n0r6hr.R10YCrEw5zwcBi/zvQox7VWMOppjnWm', 1231231231232, 'danielechegaray5@gmail.com', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderadosaunnoregistrados`
--

CREATE TABLE `apoderadosaunnoregistrados` (
  `id` int(11) NOT NULL,
  `nombre_apoderado` varchar(255) NOT NULL,
  `apellido_apoderado` varchar(255) NOT NULL,
  `direccion_apoderado` varchar(255) NOT NULL,
  `telefono_apoderado` varchar(20) NOT NULL,
  `dni_apoderado` varchar(20) NOT NULL,
  `nombre_estudiante` varchar(255) NOT NULL,
  `apellido_estudiante` varchar(255) NOT NULL,
  `grado_estudiante` enum('1ero de primaria','2do de primaria','3ro de primaria','4to de primaria','5to de primaria','6to de primaria') NOT NULL,
  `correo_apoderado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `apoderadosaunnoregistrados`
--

INSERT INTO `apoderadosaunnoregistrados` (`id`, `nombre_apoderado`, `apellido_apoderado`, `direccion_apoderado`, `telefono_apoderado`, `dni_apoderado`, `nombre_estudiante`, `apellido_estudiante`, `grado_estudiante`, `correo_apoderado`) VALUES
(16, 'Daniel', 'Gonzales', 'Comas Av Micaela', '986107799', '31231231', 'Daniel', 'Gonzales', '1ero de primaria', 'danielechegaray5@gmail.com'),
(17, 'Soñia', 'ñuñez', 'Comas Av Micaela', '213123123', '32324324', 'ñuña', 'ñuñez', '3ro de primaria', 'dsadsd@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `aula_id` int(11) NOT NULL,
  `nombre_aula` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`aula_id`, `nombre_aula`, `estado`) VALUES
(6, 'B15', 0),
(7, 'A12', 2),
(8, 'C15', 1),
(9, '2A', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenidos`
--

CREATE TABLE `contenidos` (
  `contenido_id` int(11) NOT NULL,
  `nombre_contenido` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `evaluacion_id` int(11) NOT NULL,
  `nombre_evaluacion` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `porcentaje` varchar(100) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `contenido_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ev_entregadas`
--

CREATE TABLE `ev_entregadas` (
  `ev_entregada_id` int(11) NOT NULL,
  `material` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `evaluacion_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `grado_id` int(11) NOT NULL,
  `nombre_grado` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`grado_id`, `nombre_grado`, `estado`) VALUES
(7, 'Primer grado', 1),
(8, 'Segundo grado', 1),
(9, 'Biologia', 0),
(10, 'Tercer grado', 1),
(11, 'Cuarto grado', 1),
(12, 'Quinto grado', 1),
(13, 'Sexto grado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `materia_id` int(11) NOT NULL,
  `nombre_materia` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`materia_id`, `nombre_materia`, `estado`) VALUES
(5, 'Fisicas', 0),
(6, 'Matematicas', 1),
(7, 'Lengua', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `nota_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `valor_nota` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `periodo_id` int(11) NOT NULL,
  `nombre_periodo` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`periodo_id`, `nombre_periodo`, `estado`) VALUES
(4, '2020-2021', 1),
(5, '2021-2022', 1),
(6, '2022-2023', 1),
(7, '2023-2024', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_grado`
--

CREATE TABLE `profesor_grado` (
  `pg_id` int(11) NOT NULL,
  `grado_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `estadopg` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesor_grado`
--

INSERT INTO `profesor_grado` (`pg_id`, `grado_id`, `aula_id`, `profesor_id`, `periodo_id`, `estadopg`) VALUES
(6, 7, 8, 4, 4, 1),
(7, 8, 9, 5, 4, 1),
(8, 12, 8, 7, 4, 1),
(9, 7, 8, 4, 5, 1),
(10, 7, 9, 4, 4, 0),
(11, 8, 8, 4, 4, 1),
(12, 7, 8, 4, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `nombre_rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Asistente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `usuario`, `clave`, `rol`, `estado`) VALUES
(1, 'Admin', 'admin', '$2y$10$0R6PdfuRSnsORi1WtYlTAuxZcEHS2t0b97OuhmTBDbf2c6zNphFhC', 1, 1),
(2, 'Jesus Mirelese', 'jesus1', '$2y$10$r/EsSQq.YqBoLHITCgcOruWv0AwfFNYz7gpCVhXXX4ayTSnE.NtMS', 2, 1),
(3, 'Andres', 'andres1', '$2y$10$4i8rXPFZb58ImZqWWj8vPe388JV8MJZ6LFMchFAr9nhSkKhdUaFf6', 1, 1),
(4, 'Luis Nogueraa', 'RORO', '$2y$10$35BYYyjCNBCQoN8CmvIeA.jm4qH.cwmdlJGzE1glWsBRlGAa/vHxC', 1, 1),
(5, 'Andres', 'FAS', '$2y$10$M2UNLMiGaach0MrpFmCLaO/GCIUxHW7CWH9CR.IOFXPs6Kidwp7QS', 1, 1),
(6, 'More', 'MORE', '$2y$10$TM7RdJOjBKANjmdGXF9fGeoqzHjmAI0mPIPFRTAaGz.pqeGeTtv2O', 1, 1),
(7, 'Marco Alfonso', 'MARQUITOS', '$2y$10$oTVMABNAVua1DnClZs4s8.8bcpXuPO9exYDySmvYvWAhGNqNtPQpW', 2, 1),
(8, 'Luisito', 'LULOS', '$2y$10$TyQ5Jw32kAiIBS39tSz3WeNYhB6WPsFOKUJwTqXBOlJT2dCaWJdWK', 1, 1),
(9, 'Marco', 'MARE', '$2y$10$1XDxir5VYGj1Oa/H6USkouKF19/g9Nrea1VrL.NY0EoJWHeJMzSLS', 1, 1),
(10, 'Fernando', 'FERO', '$2y$10$n9ryBmouMn0o9CQMJrc7h.Jvd4aToxQCSjj7bY0TGztvOuvV3NRE2', 1, 1),
(11, 'More Morales', 'PEPE', '$2y$10$bzr7Mmo0KK7h6gvDNdFOx.C.doG1icxAqrAjMB4OuujNjqSfGcY.a', 1, 1),
(13, 'Wilman daniel', 'dani', '$2y$10$qokhHzLPjm78Dwhf15nYH.gKzKMgO17y49vE.lgf4cGWr4SjJhSHG', 1, 0),
(14, 'Elver', 'Sano', '$2y$10$TW4u2bMhcYqdXyeiRq8PX.40XAtUY.SgVoe1L0btD4NiTRJNVqYDW', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`actividad_id`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`alumno_id`),
  ADD KEY `fk_id_apoderados` (`apoderado_id`);

--
-- Indices de la tabla `alumno_profesor`
--
ALTER TABLE `alumno_profesor`
  ADD PRIMARY KEY (`ap_id`) USING BTREE,
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `proceso_id` (`pg_id`);

--
-- Indices de la tabla `apoderado`
--
ALTER TABLE `apoderado`
  ADD PRIMARY KEY (`apoderado_id`);

--
-- Indices de la tabla `apoderadosaunnoregistrados`
--
ALTER TABLE `apoderadosaunnoregistrados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`aula_id`);

--
-- Indices de la tabla `contenidos`
--
ALTER TABLE `contenidos`
  ADD PRIMARY KEY (`contenido_id`);

--
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`evaluacion_id`);

--
-- Indices de la tabla `ev_entregadas`
--
ALTER TABLE `ev_entregadas`
  ADD PRIMARY KEY (`ev_entregada_id`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`grado_id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`materia_id`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`nota_id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `actividad_id` (`actividad_id`),
  ADD KEY `periodo_id` (`periodo_id`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`periodo_id`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`profesor_id`);

--
-- Indices de la tabla `profesor_grado`
--
ALTER TABLE `profesor_grado`
  ADD PRIMARY KEY (`pg_id`),
  ADD KEY `grado_id` (`grado_id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `profesor_id` (`profesor_id`),
  ADD KEY `fk_pm_periodo` (`periodo_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `actividad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `alumno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `alumno_profesor`
--
ALTER TABLE `alumno_profesor`
  MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `apoderado`
--
ALTER TABLE `apoderado`
  MODIFY `apoderado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `apoderadosaunnoregistrados`
--
ALTER TABLE `apoderadosaunnoregistrados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `aula_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `contenidos`
--
ALTER TABLE `contenidos`
  MODIFY `contenido_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `evaluacion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ev_entregadas`
--
ALTER TABLE `ev_entregadas`
  MODIFY `ev_entregada_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `grado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `materia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `nota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
  MODIFY `periodo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `profesor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `profesor_grado`
--
ALTER TABLE `profesor_grado`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `fk_id_apoderados` FOREIGN KEY (`apoderado_id`) REFERENCES `apoderado` (`apoderado_id`);

--
-- Filtros para la tabla `alumno_profesor`
--
ALTER TABLE `alumno_profesor`
  ADD CONSTRAINT `alumno_profesor_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumno_profesor_ibfk_2` FOREIGN KEY (`pg_id`) REFERENCES `profesor_grado` (`pg_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_3` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`actividad_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_4` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesor_grado`
--
ALTER TABLE `profesor_grado`
  ADD CONSTRAINT `fk_pm_periodo` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`),
  ADD CONSTRAINT `profesor_grado_ibfk_1` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesor_grado_ibfk_2` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`grado_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesor_grado_ibfk_3` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`profesor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
