-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2025 a las 00:15:18
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
-- Base de datos: `citas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `AdIdentificacion` char(10) NOT NULL,
  `AdNombres` varchar(50) NOT NULL,
  `AdApellidos` varchar(50) NOT NULL,
  `AdContrasena` varchar(40) NOT NULL,
  `Rol` int(1) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`AdIdentificacion`, `AdNombres`, `AdApellidos`, `AdContrasena`, `Rol`) VALUES
('1111', 'Sas', 'Ars', '01234', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `CitNumero` int(11) NOT NULL,
  `CitFecha` date NOT NULL,
  `CitHora` varchar(10) NOT NULL,
  `CitPaciente` char(10) NOT NULL,
  `CitMedico` char(10) NOT NULL,
  `CitConsultorio` int(3) NOT NULL,
  `CitEstado` enum('Solicitada','Atendida','Cancelada') NOT NULL DEFAULT 'Solicitada',
  `CitObservaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`CitNumero`, `CitFecha`, `CitHora`, `CitPaciente`, `CitMedico`, `CitConsultorio`, `CitEstado`, `CitObservaciones`) VALUES
(1, '2025-05-21', '11:20:00', '1', '12345', 1, 'Cancelada', 'Ninguna'),
(2, '2025-05-21', '11:00:00', '1', '12345', 1, 'Cancelada', 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorios`
--

CREATE TABLE `consultorios` (
  `ConNumero` int(3) NOT NULL,
  `ConNombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consultorios`
--

INSERT INTO `consultorios` (`ConNumero`, `ConNombre`) VALUES
(1, 'Consultas'),
(2, 'Tratamientos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas`
--

CREATE TABLE `horas` (
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horas`
--

INSERT INTO `horas` (`hora`) VALUES
('08:00:00'),
('08:20:00'),
('08:40:00'),
('09:00:00'),
('09:20:00'),
('09:40:00'),
('10:00:00'),
('10:20:00'),
('10:40:00'),
('11:00:00'),
('11:20:00'),
('11:40:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `MedIdentificacion` char(10) NOT NULL,
  `MedNombres` varchar(50) NOT NULL,
  `MedApellidos` varchar(50) NOT NULL,
  `MedContrasena` varchar(40) NOT NULL,
  `Rol` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`MedIdentificacion`, `MedNombres`, `MedApellidos`, `MedContrasena`, `Rol`) VALUES
('12345', 'Pepito', 'Pérez', '010101', 1),
('1313', 'Steven', 'Perez', '', 1),
('67890', 'Pepita', 'Mendieta', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `PacIdentificacion` char(10) NOT NULL,
  `PacNombres` varchar(50) NOT NULL,
  `PacApellidos` varchar(50) DEFAULT NULL,
  `PacFechaNacimiento` date NOT NULL,
  `PacSexo` enum('M','F') NOT NULL,
  `PacContrasena` varchar(40) NOT NULL,
  `Rol` int(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`PacIdentificacion`, `PacNombres`, `PacApellidos`, `PacFechaNacimiento`, `PacSexo`, `PacContrasena`, `Rol`) VALUES
('', '', '', '0000-00-00', '', '', 2),
('0', 'deded', 'rfrft', '2015-04-12', 'F', '0o0', 2),
('01', 'edrftg', 'ikujyt', '2025-04-27', 'M', '$2y$10$wvvzuOEhhyta6JKhzAXJ4OVFLZPin55tF', 2),
('1', 'th', 'j', '0000-00-00', 'M', '', 2),
('12', 'dad', 'dadd', '2025-04-27', 'F', '', 2),
('1212', 'Pepe', 'Rojas', '2005-02-23', 'M', '121212', 2),
('123', 'Joan', 'G', '2005-10-25', 'M', '', 2),
('124', 'Joas', 'Ldea', '2025-05-04', 'M', '', 2),
('13', 'sdfgh', 'mkl', '1975-11-11', 'M', '$2y$10$qOHQ/uM/geukyLpoLNu.IO3v/QQx2Ccmc', 2),
('3', 'def', 'grgr', '2025-04-28', 'M', '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

CREATE TABLE `tratamientos` (
  `TraNumero` int(11) NOT NULL,
  `TraFechaAsignado` date NOT NULL,
  `TraDescripcion` text NOT NULL,
  `TraFechaInicio` date NOT NULL,
  `TraFechaFin` date NOT NULL,
  `TraObservaciones` text NOT NULL,
  `TraPaciente` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tratamientos`
--

INSERT INTO `tratamientos` (`TraNumero`, `TraFechaAsignado`, `TraDescripcion`, `TraFechaInicio`, `TraFechaFin`, `TraObservaciones`, `TraPaciente`) VALUES
(2, '0000-00-00', '234789098764', '2025-05-04', '2025-05-24', 'chcn  ejjec ', '1212'),
(3, '2025-05-13', 'dwwdwd', '2025-05-25', '2025-06-04', 'wdefr', ''),
(4, '2025-05-18', 'edededed', '2025-06-01', '2025-06-07', 'vvffvfv', ''),
(6, '2025-05-13', 'dsa', '2025-05-27', '2025-05-30', 'FDSA', ''),
(10, '2025-05-13', 'sdfghj', '2025-06-07', '2025-07-30', 'dfghjh', ''),
(11, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(13, '2025-05-05', 'sfghjkjhgfhjkjhghk1111', '2025-05-07', '2025-06-04', 'azazazaz', ''),
(14, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(15, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(16, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(17, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(18, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(19, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(21, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(22, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(23, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(24, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(25, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(26, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(27, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(28, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(29, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(30, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(31, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(32, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(33, '0000-00-00', '', '0000-00-00', '0000-00-00', '', ''),
(34, '0000-00-00', '', '0000-00-00', '0000-00-00', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`AdIdentificacion`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`CitNumero`),
  ADD KEY `CitPaciente` (`CitPaciente`),
  ADD KEY `CitMedico` (`CitMedico`),
  ADD KEY `CitConsultorio` (`CitConsultorio`);

--
-- Indices de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`ConNumero`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`MedIdentificacion`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`PacIdentificacion`);

--
-- Indices de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD PRIMARY KEY (`TraNumero`),
  ADD KEY `TraPaciente` (`TraPaciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `CitNumero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `TraNumero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`CitPaciente`) REFERENCES `pacientes` (`PacIdentificacion`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`CitMedico`) REFERENCES `medicos` (`MedIdentificacion`),
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`CitConsultorio`) REFERENCES `consultorios` (`ConNumero`);

--
-- Filtros para la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD CONSTRAINT `Tratamientos_ibfk_1` FOREIGN KEY (`TraPaciente`) REFERENCES `pacientes` (`PacIdentificacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
