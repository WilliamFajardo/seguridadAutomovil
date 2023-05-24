-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-05-2023 a las 20:03:04
-- Versión del servidor: 10.5.16-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id20538731_db_monitoreoweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_dispositivo`
--

CREATE TABLE `datos_dispositivo` (
  `id` int(11) NOT NULL,
  `id_Upro` int(20) DEFAULT NULL,
  `estado_dispositivo` int(1) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datos_dispositivo`
--

INSERT INTO `datos_dispositivo` (`id`, `id_Upro`, `estado_dispositivo`, `fecha`, `hora`) VALUES
(1, 1, 0, '0000-00-00', ''),
(2, 2, 1, '2023-05-23', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_medidos`
--

CREATE TABLE `datos_medidos` (
  `id` int(11) NOT NULL,
  `idVeh` int(11) NOT NULL,
  `estado_vehiculo` varchar(50) NOT NULL,
  `idDis` int(11) NOT NULL,
  `estado_dispositivo` varchar(50) NOT NULL,
  `latitud` float NOT NULL,
  `longitud` float NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datos_medidos`
--

INSERT INTO `datos_medidos` (`id`, `idVeh`, `estado_vehiculo`, `idDis`, `estado_dispositivo`, `latitud`, `longitud`, `fecha`, `hora`) VALUES
(350, 2, 'Apagado', 3, '1', 2.45173, -76.8117, '2023-05-23', '04:39:53'),
(351, 2, 'Apagado', 3, '1', 0, 0, '2023-05-23', '04:40:01'),
(352, 2, 'Apagado', 3, '1', 0, 0, '2023-05-23', '04:40:11'),
(353, 2, 'Apagado', 3, '1', 0, 0, '2023-05-23', '04:40:20'),
(354, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '04:40:29'),
(355, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '04:40:36'),
(356, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '04:40:43'),
(357, 2, 'Apagado', 3, '1', 0, 0, '2023-05-23', '04:40:54'),
(358, 2, 'Apagado', 3, '1', 0, 0, '2023-05-23', '04:41:02'),
(359, 2, 'Apagado', 3, '1', 0, 0, '2023-05-23', '04:41:10'),
(360, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '04:41:19'),
(361, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '04:41:28'),
(362, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '04:54:37'),
(363, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '04:54:44'),
(364, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:04:04'),
(365, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:04:11'),
(366, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:04:19'),
(367, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:04:26'),
(368, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:04:33'),
(369, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:04:40'),
(370, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:04:47'),
(371, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:04:55'),
(372, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:05:02'),
(373, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:05:09'),
(374, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:05:19'),
(375, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:05:28'),
(376, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:05:38'),
(377, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:05:47'),
(378, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:05:56'),
(379, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:06:05'),
(380, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:06:14'),
(381, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:06:23'),
(382, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:06:33'),
(383, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:06:42'),
(384, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:06:51'),
(385, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:07:01'),
(386, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:07:12'),
(387, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:07:21'),
(388, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:07:30'),
(389, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:07:39'),
(390, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:07:48'),
(391, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:07:57'),
(392, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:08:07'),
(393, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:08:16'),
(394, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:08:25'),
(395, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:08:36'),
(396, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:08:45'),
(397, 2, 'Apagado', 3, '0', 1.6, -77.17, '2023-05-23', '05:08:55'),
(398, 2, 'Apagado', 3, '1', 0, 0, '2023-05-23', '05:09:17'),
(399, 2, 'Apagado', 3, '1', 0, 0, '2023-05-23', '05:09:25'),
(400, 2, 'Apagado', 3, '1', 0, 0, '2023-05-23', '05:09:33'),
(401, 2, 'Apagado', 3, '1', 0, 0, '2023-05-23', '05:09:40'),
(402, 2, 'Apagado', 3, '1', 0, 0, '2023-05-23', '05:09:48'),
(403, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:09:55'),
(404, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:10:02'),
(405, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:10:09'),
(406, 2, 'Apagado', 3, '0', 0, 0, '2023-05-23', '05:10:17'),
(457, 2, 'Encendido', 1, '0', 1.6, -77.17, '2023-05-23', '06:09:37'),
(458, 2, 'Encendido', 1, '0', 1.6, -77.17, '2023-05-23', '06:09:46'),
(459, 2, 'Apagado', 1, '0', 1.6, -77.17, '2023-05-23', '06:09:56'),
(460, 2, 'Apagado', 1, '0', 1.6, -77.17, '2023-05-23', '06:10:05'),
(461, 2, 'Apagado', 1, '0', 1.6, -77.17, '2023-05-23', '06:10:15'),
(462, 2, 'Apagado', 1, '0', 1.6, -77.17, '2023-05-23', '06:10:25'),
(463, 2, 'Apagado', 1, '0', 1.6, -77.17, '2023-05-23', '06:10:34'),
(464, 2, 'Apagado', 1, '0', 1.6, -77.17, '2023-05-23', '06:10:45'),
(465, 2, 'Apagado', 1, '0', 1.6, -77.17, '2023-05-23', '06:10:56'),
(466, 2, 'Apagado', 1, '0', 1.6, -77.17, '2023-05-23', '06:11:05'),
(467, 2, 'Apagado', 1, '0', 1.6, -77.17, '2023-05-23', '06:11:16'),
(468, 2, 'Apagado', 1, '0', 1.6, -77.17, '2023-05-23', '06:11:26'),
(469, 2, 'Encendido', 1, '0', 1.6, -77.17, '2023-05-23', '06:11:35'),
(470, 2, 'Apagado', 1, '0', 1.6, -77.17, '2023-05-23', '06:11:45'),
(471, 2, 'Encendido', 1, '0', 1.6, -77.17, '2023-05-23', '06:11:53'),
(472, 2, 'Encendido', 1, '0', 1.6, -77.17, '2023-05-23', '06:12:02'),
(473, 2, 'Encendido', 1, '1', 1.6, -77.17, '2023-05-23', '06:12:13'),
(474, 2, 'Encendido', 1, '1', 1.6, -77.17, '2023-05-23', '06:12:25'),
(475, 2, 'Apagado', 1, '1', 1.6, -77.17, '2023-05-23', '06:12:38'),
(476, 2, 'Encendido', 1, '1', 1.6, -77.17, '2023-05-23', '06:12:48'),
(477, 2, 'Encendido', 1, '1', 1.6, -77.17, '2023-05-23', '06:12:59'),
(478, 2, 'Apagado', 1, '1', 1.6, -77.17, '2023-05-23', '06:13:09'),
(479, 2, 'Encendido', 1, '1', 1.6, -77.17, '2023-05-23', '06:13:20'),
(480, 2, 'Apagado', 1, '1', 1.6, -77.17, '2023-05-23', '06:13:30'),
(481, 2, 'Apagado', 1, '1', 1.6, -77.17, '2023-05-23', '06:13:41'),
(482, 2, 'Apagado', 1, '1', 1.6, -77.17, '2023-05-23', '06:13:52'),
(483, 2, 'Apagado', 1, '1', 1.6, -77.17, '2023-05-23', '06:14:02'),
(484, 2, 'Apagado', 1, '1', 1.6, -77.17, '2023-05-23', '06:14:13'),
(485, 2, 'Apagado', 1, '0', 0, 0, '2023-05-23', '06:14:39'),
(486, 2, 'Apagado', 1, '1', 0, 0, '2023-05-23', '06:14:46'),
(487, 2, 'Apagado', 1, '1', 0, 0, '2023-05-23', '06:14:54'),
(488, 2, 'Apagado', 1, '0', 0, 0, '2023-05-23', '06:15:01'),
(489, 2, 'Apagado', 1, '0', 2.44453, -76.6003, '2023-05-23', '06:15:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_vehiculo`
--

CREATE TABLE `datos_vehiculo` (
  `id` int(5) NOT NULL,
  `idDis` int(5) NOT NULL,
  `estado_vehiculo` int(2) NOT NULL,
  `latitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datos_vehiculo`
--

INSERT INTO `datos_vehiculo` (`id`, `idDis`, `estado_vehiculo`, `latitud`, `longitud`, `fecha`, `hora`) VALUES
(1, 2, 1, 1.2, 1.3, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `descripcion_tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `descripcion_tipo`) VALUES
(1, 'Administrador'),
(2, 'Propietario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(60) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `login` varchar(20) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `id_dis` int(11) NOT NULL,
  `id_veh` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `cedula`, `login`, `passwd`, `tipo_usuario`, `estado`, `id_dis`, `id_veh`) VALUES
(1, 'Jose Zarama', '123456789', 'jjzarama', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, 0, 'UQI32P'),
(3, 'Pedro Gómez', '456789123', 'pedrogomez', '827ccb0eea8a706c4c34a16891f84e7b', 2, 1, 2, 'ZHY34J');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_dispositivo`
--
ALTER TABLE `datos_dispositivo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_medidos`
--
ALTER TABLE `datos_medidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idVeh` (`idVeh`),
  ADD KEY `idDis` (`idDis`);

--
-- Indices de la tabla `datos_vehiculo`
--
ALTER TABLE `datos_vehiculo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_medidos`
--
ALTER TABLE `datos_medidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=490;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
