-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2024 a las 00:09:44
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
-- Base de datos: `comite`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta`
--

CREATE TABLE `acta` (
  `id_acta` int(11) NOT NULL,
  `id_comite` int(11) NOT NULL,
  `id_informe` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `estado` int(60) NOT NULL,
  `fecha_creacion` int(11) NOT NULL,
  `fecha_actualizacion` int(11) NOT NULL,
  `usuario_crea` varchar(60) NOT NULL,
  `usuario_actualiza` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendiz`
--

CREATE TABLE `aprendiz` (
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `celular` varchar(45) NOT NULL,
  `documento` varchar(11) NOT NULL,
  `correo_electronico` varchar(60) NOT NULL,
  `id_grupo` varchar(20) NOT NULL,
  `jornada` varchar(40) NOT NULL,
  `programa_formacion` varchar(60) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_actualizacion` date NOT NULL,
  `usuario_crea` varchar(60) NOT NULL,
  `usuario_actualiza` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aprendiz`
--

INSERT INTO `aprendiz` (`nombres`, `apellidos`, `celular`, `documento`, `correo_electronico`, `id_grupo`, `jornada`, `programa_formacion`, `estado`, `fecha_creacion`, `fecha_actualizacion`, `usuario_crea`, `usuario_actualiza`) VALUES
('Daniela', 'Valencia Soto ', '3102251006', '1053839467', 'danyvalenciasoto@gmail.com', '2613934', 'Noche', 'ANALISIS Y DESARROLLO DE SOFTWARE', 'Activo ', '0000-00-00', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comite`
--

CREATE TABLE `comite` (
  `id_comite` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `lugar` varchar(60) NOT NULL,
  `observacion` varchar(300) NOT NULL,
  `estado` varchar(60) NOT NULL,
  `fecha_creacion` int(11) NOT NULL,
  `fecha_actualizacion` int(11) NOT NULL,
  `usuario_crea` varchar(60) NOT NULL,
  `usuario_actualiza` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comite`
--

INSERT INTO `comite` (`id_comite`, `fecha_inicio`, `fecha_fin`, `lugar`, `observacion`, `estado`, `fecha_creacion`, `fecha_actualizacion`, `usuario_crea`, `usuario_actualiza`) VALUES
(1, '0000-00-00', '0000-00-00', 'Salon de gerencia', 'Se cita a comite', 'Programado', 0, 0, '', ''),
(2, '2024-12-10', '2024-12-10', 'Salon de gerencia', 'si', 'Programado', 0, 0, '', ''),
(3, '2024-12-03', '2024-12-03', 'Sala de gerencia', 'ff', 'Programado', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe`
--

CREATE TABLE `informe` (
  `id` int(11) NOT NULL,
  `fecha_informe` datetime NOT NULL,
  `documento_aprendiz` varchar(100) NOT NULL,
  `nombre_aprendiz` varchar(255) NOT NULL,
  `correo_aprendiz` varchar(255) NOT NULL,
  `programa_formacion` varchar(255) NOT NULL,
  `id_grupo` varchar(100) NOT NULL,
  `reporte` text NOT NULL,
  `documento_instructor` varchar(20) NOT NULL,
  `nombre_instructor` varchar(255) NOT NULL,
  `correo_instructor` varchar(255) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `usuario_crea` varchar(45) NOT NULL,
  `usuario_actualiza` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `informe`
--

INSERT INTO `informe` (`id`, `fecha_informe`, `documento_aprendiz`, `nombre_aprendiz`, `correo_aprendiz`, `programa_formacion`, `id_grupo`, `reporte`, `documento_instructor`, `nombre_instructor`, `correo_instructor`, `estado`, `fecha_creacion`, `fecha_actualizacion`, `usuario_crea`, `usuario_actualiza`) VALUES
(35, '2024-12-03 00:00:00', '1053678544', 'Camilo Blanco', 'jhonccuartas@gmail.com', 'adso', '2613934', 'prnnn', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Programado', '2024-12-03 20:17:24', '0000-00-00 00:00:00', '', ''),
(36, '2024-12-03 00:00:00', '1053678544', 'Camilo Blanco', 'jhonccuartas@gmail.com', 'adso', '2613934', 'prueba 1', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Programado', '2024-12-03 20:17:27', '0000-00-00 00:00:00', '', ''),
(37, '2024-12-03 23:54:00', '1053678544', 'Camilo Blanco', 'jhonccuartas@gmail.com', 'adso', '2613934', 'prueba reporte', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Programado', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(38, '2024-12-03 12:11:00', '1053678544', 'Camilo Blanco', 'jhonccuartas@gmail.com', 'adso', '2613934', 'probando correo', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Programado', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(39, '2024-12-04 20:22:00', '1053839467', 'Daniela Valencia Soto ', 'danyvalenciasoto@gmail.com', 'ANALISIS Y DESARROLLO DE SOFTWARE', '2613934', 'Matematicas', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Pendiente', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(40, '2024-12-04 20:22:00', '1053839467', 'Daniela Valencia Soto ', 'danyvalenciasoto@gmail.com', 'ANALISIS Y DESARROLLO DE SOFTWARE', '2613934', 'Matematicas', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Pendiente', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(41, '2024-12-04 20:22:00', '1053839467', 'Daniela Valencia Soto ', 'danyvalenciasoto@gmail.com', 'ANALISIS Y DESARROLLO DE SOFTWARE', '2613934', 'Matematicas', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Pendiente', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(42, '2024-12-04 20:22:00', '1053839467', 'Daniela Valencia Soto ', 'danyvalenciasoto@gmail.com', 'ANALISIS Y DESARROLLO DE SOFTWARE', '2613934', 'Matematicas', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Pendiente', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(43, '2024-12-04 20:22:00', '1053839467', 'Daniela Valencia Soto ', 'danyvalenciasoto@gmail.com', 'ANALISIS Y DESARROLLO DE SOFTWARE', '2613934', 'Matematicas', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Pendiente', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(44, '2024-12-04 20:22:00', '1053839467', 'Daniela Valencia Soto ', 'danyvalenciasoto@gmail.com', 'ANALISIS Y DESARROLLO DE SOFTWARE', '2613934', 'Matematicas', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Pendiente', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(45, '2024-12-05 12:02:00', '1053839467', 'Daniela Valencia Soto ', 'danyvalenciasoto@gmail.com', 'ANALISIS Y DESARROLLO DE SOFTWARE', '2613934', 'NO APROBO MATEMATICAS', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Programado', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(46, '2024-12-05 17:34:00', '1053839467', 'Daniela Valencia Soto ', 'danyvalenciasoto@gmail.com', 'ANALISIS Y DESARROLLO DE SOFTWARE', '2613934', 'NO APRUEBA MATEMATICAS', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Programado', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(47, '2024-12-05 17:52:00', '1053839467', 'Daniela Valencia Soto ', 'danyvalenciasoto@gmail.com', 'ANALISIS Y DESARROLLO DE SOFTWARE', '2613934', 'no aprobo matematicas ', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Programado', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(48, '2024-12-06 17:55:00', '1053839467', 'Daniela Valencia Soto ', 'danyvalenciasoto@gmail.com', 'ANALISIS Y DESARROLLO DE SOFTWARE', '2613934', 'no aprueba matematicas ', '30315403', 'Libia Valencia', 'lauravblanco93@gmail.com', 'Programado', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

CREATE TABLE `instructor` (
  `documento` int(11) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `celular` int(45) NOT NULL,
  `correo_electronico` varchar(60) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `fecha_creacion` int(11) NOT NULL,
  `fecha_actualizacion` int(11) NOT NULL,
  `usuario_crea` varchar(60) NOT NULL,
  `usuario_actualiza` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`documento`, `nombres`, `apellidos`, `celular`, `correo_electronico`, `estado`, `fecha_creacion`, `fecha_actualizacion`, `usuario_crea`, `usuario_actualiza`) VALUES
(30315403, 'Libia', 'Valencia', 2147483647, 'lauravblanco93@gmail.com', 'Activo', 0, 0, '', ''),
(55555555, 'Daniela', 'Valencia Soto ', 2147483647, 'libia@gmail.com', 'Activo', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `perfil` varchar(50) NOT NULL,
  `lectura` tinyint(1) DEFAULT 0,
  `escritura` tinyint(1) DEFAULT 0,
  `administracion` tinyint(1) DEFAULT 0,
  `detalles` text DEFAULT NULL,
  `permisos` int(11) DEFAULT 0,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `perfil`, `lectura`, `escritura`, `administracion`, `detalles`, `permisos`, `estado`) VALUES
(1, 'Usuario Básico', 1, 0, 0, NULL, 0, 1),
(2, 'Moderador', 1, 1, 0, NULL, 0, 1),
(3, 'Administrador', 1, 1, 1, NULL, 0, 1),
(5, 'mono', 4, 4, 4, 'mono', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_mejoramiento`
--

CREATE TABLE `plan_mejoramiento` (
  `id_plan` int(11) NOT NULL,
  `id_comite` int(11) NOT NULL,
  `id_informe` int(11) NOT NULL,
  `acciones` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_creacion` int(11) NOT NULL,
  `fecha_actualizacion` int(11) NOT NULL,
  `usuario_crea` varchar(60) NOT NULL,
  `usuario_actualiza` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id` int(11) NOT NULL,
  `fecha_informe` date DEFAULT NULL,
  `nombre_aprendiz` varchar(100) DEFAULT NULL,
  `documento_aprendiz` varchar(50) DEFAULT NULL,
  `programa_formacion` varchar(100) DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `descripcion_queja` text DEFAULT NULL,
  `testigos_pruebas` text DEFAULT NULL,
  `correo_quejoso` varchar(100) DEFAULT NULL,
  `nombre_quejoso` varchar(100) DEFAULT NULL,
  `correo_docente` varchar(100) DEFAULT NULL,
  `nombre_docente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_actualizacion` date NOT NULL,
  `usuario_crea` varchar(60) NOT NULL,
  `usuario_actualiza` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `contrasenia`, `nombres`, `apellidos`, `id_perfil`, `estado`, `fecha_creacion`, `fecha_actualizacion`, `usuario_crea`, `usuario_actualiza`) VALUES
(3, 'usuario3', 'contraseña3', 'Luis', 'Martínez', 3, '1', '0000-00-00', '0000-00-00', '', ''),
(4, 'usuario4', 'contraseña4', 'María', 'Rodríguez', 1, '1', '0000-00-00', '0000-00-00', '', ''),
(5, 'usuario5', 'contraseña5', 'Pedro', 'Hernández', 2, '1', '0000-00-00', '0000-00-00', '', ''),
(8, 'usuario8', 'contraseña8', 'Laura', 'Jiménez', 2, '1', '0000-00-00', '0000-00-00', '', ''),
(9, 'usuario5', 'contraseña9', 'Pedro', 'Hernández', 2, '2', '0000-00-00', '0000-00-00', '', ''),
(11, 'usuario11', '$2y$10$zpRpmsY0LB6mn1C6Aq3K4ur8AkZqFIuG/ZuiUB7yCoiIqnAvpqD2.', 'Rosa', 'Valencia Soto ', 3, 'inactivo', '0000-00-00', '0000-00-00', '', ''),
(14, 'usuario2', '$2y$10$k8SKOnN5gFu0bl6kbWOdJeROfJ07h3JwAItDJdH49ClH3c1B/vpRO', 'Lijia', 'Valencia', 1, '1', '0000-00-00', '0000-00-00', '', ''),
(15, 'prueba', '$2y$10$EjsbFepYiHcQziMWVctUqeUw9/P.Odu7gFZmVxosRM4aWyTxwvkSC', 'DANIELA', 'Lopez', 2, 'activo', '0000-00-00', '0000-00-00', '', ''),
(16, 'prueba1', '$2y$10$b4pf96FKb82V7dYiVDDpbO8WiBn8frPav9J17uyuabab2VPE0wZIK', 'Danielo', 'Cuartas', 1, 'activo', '0000-00-00', '0000-00-00', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD PRIMARY KEY (`documento`);

--
-- Indices de la tabla `comite`
--
ALTER TABLE `comite`
  ADD PRIMARY KEY (`id_comite`);

--
-- Indices de la tabla `informe`
--
ALTER TABLE `informe`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`documento`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perfil` (`id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comite`
--
ALTER TABLE `comite`
  MODIFY `id_comite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `informe`
--
ALTER TABLE `informe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
