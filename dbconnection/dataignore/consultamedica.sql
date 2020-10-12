-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2020 a las 00:21:56
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `consultamedica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosconsultas`
--

CREATE TABLE `datosconsultas` (
  `idconsultas` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipoconsulta` int(3) DEFAULT NULL,
  `fechaconsulta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosconsulta_sintomas`
--

CREATE TABLE `datosconsulta_sintomas` (
  `Idconsultas` int(11) NOT NULL,
  `IdSintomas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialistas`
--

CREATE TABLE `especialistas` (
  `ccespe` int(11) NOT NULL,
  `nombreespe` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidoespe` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Idtipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `especialistas`
--

INSERT INTO `especialistas` (`ccespe`, `nombreespe`, `apellidoespe`, `Idtipo`) VALUES
(109370, 'Carla', 'Mayoral', 11),
(123744, 'Saray', 'Molero', 9),
(125212, 'Cesar', 'Morales', 4),
(135446, 'Andrea', 'Aviles', 6),
(341266, 'Celestina', 'Mosquera', 12),
(424728, 'Diana', 'Zhou', 10),
(506200, 'Juanito', 'Bergollinni', 3),
(520704, 'Judith', 'Criado', 5),
(756043, 'Letícia', 'Ali', 7),
(972936, 'Juan', 'Carlos', 8),
(1004879, 'Jose', 'Pimienta', 2),
(1005439, 'Pepito', 'Bartollinni', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inquietud`
--

CREATE TABLE `inquietud` (
  `idinquietud` int(11) NOT NULL,
  `email` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcioni` longtext COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sintomas`
--

CREATE TABLE `sintomas` (
  `idsintomas` int(11) NOT NULL,
  `nombresintoma` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sintomas`
--

INSERT INTO `sintomas` (`idsintomas`, `nombresintoma`) VALUES
(1, 'Fiebre'),
(2, 'Paranoias'),
(3, 'Secreción vaginal'),
(4, 'Fatiga'),
(5, 'Escalofríos'),
(6, 'Dolores musculares'),
(7, 'Tos'),
(8, 'Vómito'),
(9, 'Congestión o Moqueo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoespecialista`
--

CREATE TABLE `tipoespecialista` (
  `idtipo` int(11) NOT NULL,
  `nombretipoesp` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipoespecialista`
--

INSERT INTO `tipoespecialista` (`idtipo`, `nombretipoesp`) VALUES
(1, 'Especialista en Hematología'),
(2, 'Especialista en Pediatría'),
(3, 'Especialista en Psiquiatría'),
(4, 'Especialista en Urología'),
(5, 'Especialista en Dermatología'),
(6, 'Especialista en Geriatría'),
(7, 'Especialista en Oftalmología'),
(8, 'Especialista en Radiología'),
(9, 'Especialista en Neumología'),
(10, 'Especialista en Nutriología'),
(11, 'Especialista en Toxicología'),
(12, 'Especialista en Odontología');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ccusuario` int(11) NOT NULL,
  `nombres` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `genero` int(3) DEFAULT NULL,
  `fechaexpedicion` date DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` bigint(12) DEFAULT NULL,
  `correo` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `adjuntar` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Idconsultas` int(11) NOT NULL,
  `Ccespe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datosconsultas`
--
ALTER TABLE `datosconsultas`
  ADD PRIMARY KEY (`idconsultas`);

--
-- Indices de la tabla `datosconsulta_sintomas`
--
ALTER TABLE `datosconsulta_sintomas`
  ADD PRIMARY KEY (`Idconsultas`,`IdSintomas`),
  ADD KEY `fk_DatosConsultas_has_Sintomas_Sintomas1_idx` (`IdSintomas`),
  ADD KEY `fk_DatosConsultas_has_Sintomas_DatosConsultas1_idx` (`Idconsultas`);

--
-- Indices de la tabla `especialistas`
--
ALTER TABLE `especialistas`
  ADD PRIMARY KEY (`ccespe`),
  ADD KEY `fk_Especialistas_tipoEspecialista1_idx` (`Idtipo`);

--
-- Indices de la tabla `inquietud`
--
ALTER TABLE `inquietud`
  ADD PRIMARY KEY (`idinquietud`);

--
-- Indices de la tabla `sintomas`
--
ALTER TABLE `sintomas`
  ADD PRIMARY KEY (`idsintomas`);

--
-- Indices de la tabla `tipoespecialista`
--
ALTER TABLE `tipoespecialista`
  ADD PRIMARY KEY (`idtipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ccusuario`),
  ADD KEY `fk_Usuario_DatosConsultas1_idx` (`Idconsultas`),
  ADD KEY `fk_Usuario_Especialistas1_idx` (`Ccespe`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datosconsultas`
--
ALTER TABLE `datosconsultas`
  MODIFY `idconsultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `inquietud`
--
ALTER TABLE `inquietud`
  MODIFY `idinquietud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `sintomas`
--
ALTER TABLE `sintomas`
  MODIFY `idsintomas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipoespecialista`
--
ALTER TABLE `tipoespecialista`
  MODIFY `idtipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datosconsulta_sintomas`
--
ALTER TABLE `datosconsulta_sintomas`
  ADD CONSTRAINT `fk_DatosConsultas_has_Sintomas_DatosConsultas1` FOREIGN KEY (`Idconsultas`) REFERENCES `datosconsultas` (`Idconsultas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DatosConsultas_has_Sintomas_Sintomas1` FOREIGN KEY (`IdSintomas`) REFERENCES `sintomas` (`IdSintomas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `especialistas`
--
ALTER TABLE `especialistas`
  ADD CONSTRAINT `fk_Especialistas_tipoEspecialista1` FOREIGN KEY (`Idtipo`) REFERENCES `tipoespecialista` (`idtipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_DatosConsultas1` FOREIGN KEY (`Idconsultas`) REFERENCES `datosconsultas` (`Idconsultas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_Especialistas1` FOREIGN KEY (`Ccespe`) REFERENCES `especialistas` (`Ccespe`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
