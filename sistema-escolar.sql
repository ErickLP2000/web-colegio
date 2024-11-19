-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2024 a las 04:40:45
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
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `actividad_id` int(11) NOT NULL,
  `nombre_actividad` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`actividad_id`, `nombre_actividad`, `estado`) VALUES
(4, 'Olimpiadas', 0),
(5, 'Evaluación 01', 1),
(6, 'Evaluación 02', 1),
(7, 'Evaluación 03', 1),
(8, 'Evaluación 04', 1),
(9, 'Simulacro', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(10, 'Jose ÑuÑez', 12, 'Comas', '121541', 1, '2024-11-11', '2024-11-27', 1),
(11, 'Andres', 10, 'Lima', '91165161', 1, '2024-11-15', '2024-11-30', 1),
(12, 'Luis Nogueraa', 10, 'Comas', '1231442', 1, '2024-11-22', '2024-11-23', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apoderado`
--

INSERT INTO `apoderado` (`apoderado_id`, `nombre_apoderado`, `direccion`, `documento`, `clave`, `telefono`, `correo`, `estado`) VALUES
(1, 'Carlos Jiménez Vargas', 'Av. La Marina 1234, Lima', '74896187', '$2y$10$MOt60KiKGtr6MqOVOMOInOBoBQO1USiZxPMabTfzwFoBNeKYEg1yK', 987654321, 'carlos.jimenez@gmail.com', 1),
(2, 'María Pérez Castro', 'Jr. Los Olivos 567, Arequipa', 'Q234567', '$2y$10$Uk6mCygVVNZY75DHLZKN.eCuiDws91iID6462s.0JxS5aQOkns4ii', 912345678, 'maria.perez@yahoo.com', 1),
(3, 'José Alvarado Mendoza', 'Av. Grau 1111, Trujillo', '87654321', '$2y$10$cmsX38KE.Xgbg59ACq0wkuuW9uPAZCHBbS0HVK36Ph0kXKcxt582y', 976543210, 'jose.alvarado@hotmail.com', 1),
(4, 'Ana López Martínez', 'Calle Independencia 876, Cusco', 'Z789012', '$2y$10$jNAnjgN/2qiuqgTRiz7MCOJRYmPvpvcQT1yh8EKCa2WDuFt/nJ2WW', 923456789, 'ana.lopez@outlook.com', 1),
(5, 'Luis Torres Salazar', 'Av. Argentina 234, Chiclayo', '56781234', '$2y$10$L/MPF/ihqd5WBr.6RAQlZ.2VJnizMoSlyK6oQ.waDIoztlpXixCBu', 998765432, 'luis.torres@gmail.com', 1),
(6, 'Marcelo Hidalgo Torres', 'Av. Primavera 1234, Surco, Lima', 'DNI 12345678', '', 987654321, 'marcelo.hidalgo@gmail.com', 1),
(7, 'Mercedes Vargas Montoya', 'Jr. Los Claveles 567, Miraflores, Arequipa', 'Pasaporte Q234567', '', 912345678, 'mercedes.vargas@yahoo.com', 1),
(8, 'Daniel Grimaldo Cruz', 'Jr. Los Claveles 567, Miraflores, Arequipa', '78416253', '', 976543210, 'daniel.grimaldo@hotmail.com', 1),
(9, 'Ana López Martínez', 'Calle Independencia 876, Cusco', 'Pasaporte Z789012', '', 923456789, 'ana.lopez@outlook.com', 1),
(10, 'Luis Torres Salazar', 'Av. Argentina 234, Chiclayo', 'DNI 56781234', '', 998765432, 'luis.torres@gmail.com', 1),
(11, 'Pilar García Rodríguez', 'Av. La Paz 987, Iquitos', 'DNI 76543218', '', 912345678, 'pilar.garcia@correo.com', 1),
(12, 'Enrique Gutiérrez Bravo', 'Jr. Colmena 345, Lima', 'Pasaporte T345678', '', 943210987, 'enrique.gutierrez@gmail.com', 1),
(13, 'Rosa Castillo Chávez', 'Calle Las Flores 123, Puno', 'DNI 19876543', '', 986532471, 'rosa.castillo@hotmail.com', 1),
(14, 'Juan Rojas Paredes', 'Av. Colonial 567, Tacna', 'DNI 43218976', '', 912345678, 'juan.rojas@yahoo.com', 1),
(15, 'Carmen Quiroz Romero', 'Calle Comercio 456, Lima', 'DNI 54321678', '', 987654321, 'carmen.quiroz@outlook.com', 1),
(16, 'Alfredo Flores Vega', 'Av. Pardo 765, Ica', 'DNI 43217654', '', 986532147, 'alfredo.flores@gmail.com', 1),
(17, 'Marisol Sánchez Silva', 'Av. Perú 987, Ayacucho', 'Pasaporte P876543', '', 945673210, 'marisol.sanchez@correo.com', 1),
(18, 'Julio Herrera Díaz', 'Calle Central 678, Huaraz', 'DNI 32149876', '', 932156478, 'julio.herrera@yahoo.com', 1),
(19, 'Teresa Cruz Morales', 'Jr. Progreso 123, Huánuco', 'DNI 54378921', '', 921347856, 'teresa.cruz@gmail.com', 1),
(20, 'Fernando Cárdenas Ruiz', 'Av. Arequipa 432, Huancayo', 'DNI 65432198', '', 918765432, 'fernando.cardenas@hotmail.com', 1),
(21, 'Marta Peña Villar', 'Calle Comercio 789, Cajamarca', 'Pasaporte M789654', '', 974562318, 'marta.pena@gmail.com', 1),
(22, 'Oscar Miranda Tello', 'Av. Salaverry 654, Piura', 'DNI 12348976', '', 934567821, 'oscar.miranda@outlook.com', 1),
(23, 'Daniela Valdez García', 'Jr. Amazonas 456, Iquitos', 'DNI 23456781', '', 987654321, 'daniela.valdez@yahoo.com', 1),
(24, 'René Pérez Alarcón', 'Calle Alameda 321, Lima', 'DNI 65432871', '', 912345678, 'rene.perez@gmail.com', 1),
(25, 'Florencio Oliva Torres', 'Jr. Tarapacá 234, Cusco', 'Pasaporte L543298', '', 987543210, 'florencio.oliva@correo.com', 1),
(26, 'Silvia Bustamante Vera', 'Av. Los Héroes 987, Moquegua', 'DNI 12348765', '', 921345678, 'silvia.bustamante@gmail.com', 1),
(27, 'Gabriela Medina Palma', 'Calle Grau 654, Arequipa', 'DNI 67854312', '', 945673210, 'gabriela.medina@outlook.com', 1),
(28, 'Mario Huerta Carrillo', 'Jr. San Martín 432, Lima', 'DNI 43216789', '', 983216547, 'mario.huerta@correo.com', 1),
(29, 'Julia Cárdenas Zúñiga', 'Av. Bolognesi 876, Tumbes', 'Pasaporte Q198754', '', 934567812, 'julia.cardenas@yahoo.com', 1),
(30, 'Ricardo Ramos Pacheco', 'Jr. Los Andes 123, Huacho', 'DNI 54328765', '', 918654321, 'ricardo.ramos@gmail.com', 1),
(31, 'Elena Ramos Luna', 'Av. Las Magnolias 234, Lima', 'DNI 43212345', '', 921234567, 'elena.ramos@gmail.com', 1),
(32, 'Pedro Ávila Chacón', 'Calle Unión 987, Cusco', 'Pasaporte L987654', '', 987654321, 'pedro.avila@hotmail.com', 1),
(33, 'Susana Rojas Becerra', 'Jr. Comercio 876, Arequipa', 'DNI 67898765', '', 931234567, 'susana.rojas@outlook.com', 1),
(34, 'Manuel Vargas Torres', 'Av. Libertad 654, Trujillo', 'DNI 32165498', '', 932165478, 'manuel.vargas@gmail.com', 1),
(35, 'Laura Calderón Álvarez', 'Calle Pizarro 432, Lima', 'Pasaporte M876543', '', 943210876, 'laura.calderon@correo.com', 1),
(36, 'Gustavo Prado Castro', 'Av. Arica 321, Lima', 'DNI 56723489', '', 987654321, 'gustavo.prado@gmail.com', 1),
(37, 'Elvira Torres García', 'Calle Los Eucaliptos 987, Arequipa', 'DNI 54321789', '', 921356478, 'elvira.torres@yahoo.com', 1),
(38, 'Tomás Vega Herrera', 'Jr. Grau 876, Lima', 'Pasaporte K123456', '', 912348765, 'tomas.vega@correo.com', 1),
(39, 'Rocío Flores Olivares', 'Av. Grau 234, Cusco', 'DNI 87654321', '', 923456789, 'rocio.flores@hotmail.com', 1),
(40, 'Héctor López Ruiz', 'Calle Colón 456, Arequipa', 'DNI 32165487', '', 913245678, 'hector.lopez@gmail.com', 1),
(41, 'Yolanda Castro Peña', 'Av. San Martín 789, Tacna', 'Pasaporte P765432', '', 976543210, 'yolanda.castro@outlook.com', 1),
(42, 'Alberto Suárez Gálvez', 'Jr. Perú 654, Puno', 'DNI 98765432', '', 945672310, 'alberto.suarez@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `aula_id` int(11) NOT NULL,
  `nombre_aula` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`aula_id`, `nombre_aula`, `estado`) VALUES
(6, 'B15', 0),
(7, 'A101', 1),
(8, 'A102', 1),
(9, 'A103', 1),
(10, 'A201', 1),
(11, 'A202', 1),
(12, 'A203', 1),
(13, 'A204', 1),
(14, 'B101', 1),
(15, 'B102', 1),
(16, 'B103', 1),
(17, 'B104', 1),
(18, 'B201', 1),
(19, 'B202', 1),
(20, 'B203', 1),
(21, 'B204', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenidos`
--

CREATE TABLE `contenidos` (
  `contenido_id` int(11) NOT NULL,
  `nombre_contenido` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `pg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contenidos`
--

INSERT INTO `contenidos` (`contenido_id`, `nombre_contenido`, `descripcion`, `material`, `pg_id`) VALUES
(1, 'Tarea 01', 'Realizar un informe de la cultura incas', '../../../uploads/8641/Lista_Profesor_Grado_PDF.pdf', 6),
(2, 'Taller 01', 'Realizar una presentación de historias', '../../../uploads/4938/curso.jpg', 6),
(3, 'Exposicion 01', 'asdasd', '../../../uploads/3780/Lista_Profesor_Grado_PDF.pdf', 6),
(6, 'Expo', 'asfadfasfdasd', '', 21);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `grado_id` int(11) NOT NULL,
  `nombre_grado` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`grado_id`, `nombre_grado`, `estado`) VALUES
(7, 'Primer grado A', 1),
(8, 'Primer grado B', 1),
(9, 'Biologia', 0),
(10, 'Segundo grado A', 1),
(11, 'Segundo grado B', 1),
(12, 'Tercer grado A', 1),
(13, 'Tercer grado B', 1),
(14, 'Cuarto grado A', 1),
(15, 'Cuarto grado B', 1),
(16, 'Quinto grado A', 1),
(17, 'Quinto grado B', 1),
(18, 'Quinto grado C', 1),
(19, 'Sexto grado A', 1),
(20, 'Sexto grado B', 1),
(21, 'Sexto grado C', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `materia_id` int(11) NOT NULL,
  `nombre_materia` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`materia_id`, `nombre_materia`, `estado`) VALUES
(6, 'Matematicas', 1),
(7, 'Comunicación', 1),
(8, 'Ciencia y tecnología', 1),
(9, 'Personal social', 1),
(10, 'Arte y cultura', 1),
(11, 'Educación Religiosa', 1),
(12, 'Tutoría', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `periodo_id` int(11) NOT NULL,
  `nombre_periodo` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`profesor_id`, `nombre`, `direccion`, `cedula`, `clave`, `telefono`, `correo`, `nivel_est`, `estado`) VALUES
(4, 'Juan Carlos Fernández García', 'Caracas', '123456789', '$2y$10$ZgfR2ZDRpspLO6GDbAlif.UUo4I7jXq7JDjXbxWhv2GX1oy9.y3AW', 942158348, 'luis@gmail.com', 'Técnico', 1),
(5, 'María José Rodríguez López', 'Caracas', '1234567', '$2y$10$U2oztuWdzsZN89zH6Rr4D.9t4gpMCiwN/flDfWx9QdEEIPPYajLgi', 942158348, 'luis@gmail.com', 'Ingeniero de Sistemas', 1),
(6, 'Andres', 'Caracas', '4861231', '$2y$10$pOXekRLk8CWqO0iRNijouuybjFQmMRiQ5/DGLQxXVBEZ3IVMFwEtC', 94215491, 'andre@gmail.com', 'Ingeniero de Sistemas', 0),
(7, 'Luis Alberto Martínez Pérez', 'Caracas', '549611', '$2y$10$ml8VYOYsV6wSCw/DVzsj7uzr6DN6QtHOwd8Y9oGV4M1tXmhVUWe2m', 942154918, 'andru@gmail.com', 'Ingeniero de Sistemas', 1),
(8, 'Jomar', 'Callao', '14952', '$2y$10$UBzBKtql3PxDzJZQ7exlCe.jtJmOSVpHw6eZ4x.m/EKE1mkoKHFVW', 938157492, 'jomar@gmail.com', 'Técnico', 0),
(9, 'Ana Patricia Gómez Torres', 'Lima', '1549821231', '$2y$10$aaBO6O13ctV0ldiLotp0reWI8GMIgxYBlnmWYrV88KjeABX7VtA0W', 94174111, 'jomar@gmail.com', 'Ingeniero de Sistemas', 1),
(10, 'José Miguel López Sánchez', 'dasdasda', '1456123', '$2y$10$WmpmqUjChMs.lIR3yekWx.SjGeFQN8.7Gzst5mobPuscuEOgoYx/m', 978451615, 'luis@gmail.com', 'Técnico', 1),
(11, 'Karla Andrea Ruiz Castro', 'Comas', '545151', '$2y$10$O9l.yMM88My7iKgy4m/fh.s1ns3IpQcUNJtqLvt/H5pNI3GeADJ5S', 965196519, 'luis@gmail.com', 'Técnico', 1),
(12, 'Carlos Eduardo Morales Ortiz', 'Lima', '7514911', '$2y$10$Q9sYT0IL8bSj74CKqsAVkORQqCcaxLrKWnGtMIDGfmdjMkGh0Yk96', 97848716, 'miqui@gmail.com', 'Técnico', 1),
(13, 'Diana Carolina Vargas León', 'Lima', '14597115', '$2y$10$/kijAW52KyVakM.U.6Se6.uaAk26gBVl.K4yi6ylMQThMr.ZiAhwu', 98711561, 'luis@gmail.com', 'Ingeniero de Sistemas', 1),
(14, 'Pedro Pablo Sánchez Ríos', 'Comas', '1231442', '$2y$10$zZxw2ksX5inIsof/MJOUYOFZkC3kDUhbalodh9/h1aquq1eksd94G', 9235165, 'miqui@gmail.com', 'Ingeniero de Sistemas', 1),
(15, 'Rosa Elena Delgado Muñoz', 'Lima', '123124124', '$2y$10$X7Uz06GdRc5FAfVHZ1Wqge/zfa8vGWuErgn0UldBSOP1ID8fByLgm', 9874651651, 'luis@gmail.com', 'Ingeniero de Sistemas', 1),
(16, 'Miguel Ángel Navarro Cruz', 'Lima', '153453245', '$2y$10$xk67GbPhMhwJL3KIYN.pCuWxlItJqrOVsXoe9ZgYkzgI6Z9ttOcca', 9174165, 'jomar@gmail.com', 'Técnico', 1),
(17, 'Claudia Beatriz Herrera Álvarez', 'Comas', '12345672', '$2y$10$le4E4F/sx5VXpE8aoSEl3eJ5Rumv32VOfkOWb4Fz8UwnQhC4hbH9O', 9451235, 'miqui@gmail.com', 'Técnico', 1),
(18, 'Ángel David Peña Flores', 'Lima', '72495318', '$2y$10$zilCviBTXSjwylxzYO1BVezIets4mv2tP5hKwzwTYC0zU1Avrpl1q', 935782416, 'angel.pena@gmail.com', 'Técnico', 1),
(19, 'Lucía Fernanda Blanco Silva', 'Comas', '75422848', '$2y$10$2tZ2YS2bbYzSKifvHDt9LeqI3YtycBRhO75C2IYFVfXn37mwbs8ki', 954233655, 'lucia.blanco@gmail.com', 'Técnico', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_grado`
--

CREATE TABLE `profesor_grado` (
  `pg_id` int(11) NOT NULL,
  `grado_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `estadopg` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesor_grado`
--

INSERT INTO `profesor_grado` (`pg_id`, `grado_id`, `aula_id`, `profesor_id`, `materia_id`, `periodo_id`, `estadopg`) VALUES
(6, 7, 7, 4, 6, 7, 1),
(7, 8, 8, 5, 6, 7, 1),
(8, 10, 9, 7, 6, 7, 1),
(9, 11, 10, 9, 6, 7, 1),
(10, 7, 9, 4, 6, 4, 0),
(11, 12, 11, 10, 6, 7, 1),
(12, 13, 12, 11, 6, 7, 1),
(13, 14, 13, 12, 6, 7, 1),
(14, 15, 14, 13, 6, 7, 1),
(15, 16, 15, 14, 6, 7, 1),
(16, 17, 16, 15, 6, 7, 1),
(17, 18, 17, 16, 6, 7, 1),
(18, 19, 18, 17, 6, 7, 1),
(19, 20, 19, 18, 6, 7, 1),
(20, 21, 20, 19, 6, 7, 1),
(21, 7, 7, 4, 7, 7, 1),
(22, 7, 7, 4, 8, 7, 1),
(23, 7, 7, 4, 9, 7, 1),
(24, 7, 7, 4, 10, 7, 1),
(25, 7, 7, 4, 11, 7, 1),
(26, 7, 7, 4, 12, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `nombre_rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `usuario`, `clave`, `rol`, `estado`) VALUES
(1, 'Admin', 'admin', '$2y$10$l1am85ajTECt9z8Ooe0NZ.tXQzgclpjLBMKlHAkPHdm3Y4ZmrcDpe', 1, 1),
(2, 'Jesus Mirelese', 'jesus1', '$2y$10$V.pRVxMWFJv6ZhMzUNLE3OvdzW3P1QwALYAljBXi4LlX/n2NtUGMK', 2, 1),
(3, 'Andres', 'andres1', '$2y$10$lW5PaQB4lrIXNKKg16xAKO0GOkC123mC7Spz4/lQjJQEnB8wAHmK2', 1, 1),
(4, 'Luis Nogueraa', 'RORO', '$2y$10$35BYYyjCNBCQoN8CmvIeA.jm4qH.cwmdlJGzE1glWsBRlGAa/vHxC', 1, 1),
(5, 'Andres', 'FAS', '$2y$10$M2UNLMiGaach0MrpFmCLaO/GCIUxHW7CWH9CR.IOFXPs6Kidwp7QS', 1, 1),
(6, 'More', 'MORE', '$2y$10$qgbGwXKiZeYtIVg1nx1tIeKSxo7nthfbAHdNgNDEQ0usmv5msTCqq', 1, 1),
(7, 'Marco Alfonso', 'MARQUITOS', '$2y$10$oTVMABNAVua1DnClZs4s8.8bcpXuPO9exYDySmvYvWAhGNqNtPQpW', 2, 1),
(8, 'Luisito', 'LULOS', '$2y$10$TyQ5Jw32kAiIBS39tSz3WeNYhB6WPsFOKUJwTqXBOlJT2dCaWJdWK', 1, 1),
(9, 'Marco', 'MARE', '$2y$10$1XDxir5VYGj1Oa/H6USkouKF19/g9Nrea1VrL.NY0EoJWHeJMzSLS', 1, 1),
(10, 'Fernando', 'FERO', '$2y$10$n9ryBmouMn0o9CQMJrc7h.Jvd4aToxQCSjj7bY0TGztvOuvV3NRE2', 1, 1),
(11, 'More Morales', 'PEPE', '$2y$10$bzr7Mmo0KK7h6gvDNdFOx.C.doG1icxAqrAjMB4OuujNjqSfGcY.a', 1, 1),
(13, 'Andres', 'FEDEÑ', '$2y$10$73OnzmxKKosJxjIwPxBPaOsCrBE5S3mNszWVzY0OMmPbA75g4rLjy', 1, 1);

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
-- Indices de la tabla `apoderado`
--
ALTER TABLE `apoderado`
  ADD PRIMARY KEY (`apoderado_id`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`aula_id`);

--
-- Indices de la tabla `contenidos`
--
ALTER TABLE `contenidos`
  ADD PRIMARY KEY (`contenido_id`),
  ADD KEY `pg_id` (`pg_id`);

--
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`evaluacion_id`),
  ADD KEY `contenido_id` (`contenido_id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `periodo_id` (`periodo_id`);

--
-- Indices de la tabla `ev_entregadas`
--
ALTER TABLE `ev_entregadas`
  ADD PRIMARY KEY (`ev_entregada_id`),
  ADD KEY `evaluacion_id` (`evaluacion_id`),
  ADD KEY `alumno_id` (`alumno_id`);

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
  ADD KEY `fk_pm_periodo` (`periodo_id`),
  ADD KEY `fk_pg_materia` (`materia_id`);

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
  MODIFY `actividad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `alumno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `apoderado`
--
ALTER TABLE `apoderado`
  MODIFY `apoderado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `aula_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `contenidos`
--
ALTER TABLE `contenidos`
  MODIFY `contenido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `grado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `materia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `profesor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `profesor_grado`
--
ALTER TABLE `profesor_grado`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `fk_id_apoderados` FOREIGN KEY (`apoderado_id`) REFERENCES `apoderado` (`apoderado_id`);

--
-- Filtros para la tabla `contenidos`
--
ALTER TABLE `contenidos`
  ADD CONSTRAINT `contenidos_ibfk_1` FOREIGN KEY (`pg_id`) REFERENCES `profesor_grado` (`pg_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD CONSTRAINT `evaluaciones_ibfk_1` FOREIGN KEY (`contenido_id`) REFERENCES `contenidos` (`contenido_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluaciones_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluaciones_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ev_entregadas`
--
ALTER TABLE `ev_entregadas`
  ADD CONSTRAINT `ev_entregadas_ibfk_1` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluaciones` (`evaluacion_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ev_entregadas_ibfk_2` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_pg_materia` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`),
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
