-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306:4306
-- Tiempo de generación: 19-02-2024 a las 21:04:57
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `museook`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objeto`
--

CREATE TABLE `objeto` (
  `id` int(11) NOT NULL,
  `nombreO` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `historia` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fotoObj` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fotoUbi` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `date1` datetime NOT NULL DEFAULT current_timestamp(),
  `date2` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `objeto`
--


--
-- Disparadores `objeto`
--
DELIMITER $$
CREATE TRIGGER `tr_actualizacion_date2` AFTER UPDATE ON `objeto` FOR EACH ROW BEGIN
    IF NEW.date2 != OLD.date2 THEN
        INSERT INTO registro_actualizaciones (objeto_id, ubicacion_anterior, date1_anterior, date2_nuevo)
        VALUES (OLD.id, OLD.ubicacion, OLD.date1, NEW.date2);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_actualizaciones`
--

CREATE TABLE `registro_actualizaciones` (
  `id` int(11) NOT NULL,
  `objeto_id` int(11) DEFAULT NULL,
  `ubicacion_anterior` varchar(100) DEFAULT NULL,
  `date1_anterior` datetime DEFAULT NULL,
  `date2_nuevo` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro_actualizaciones`
--


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `objeto`
--
ALTER TABLE `objeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `descripcion` (`descripcion`),
  ADD KEY `nombreO` (`nombreO`);

--
-- Indices de la tabla `registro_actualizaciones`
--
ALTER TABLE `registro_actualizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `objeto_id` (`objeto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `objeto`
--
ALTER TABLE `objeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;
  
--
-- AUTO_INCREMENT de la tabla `registro_actualizaciones`
--
ALTER TABLE `registro_actualizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `registro_actualizaciones`
--
ALTER TABLE `registro_actualizaciones`
  ADD CONSTRAINT `registro_actualizaciones_ibfk_1` FOREIGN KEY (`objeto_id`) REFERENCES `objeto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
