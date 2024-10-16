-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2024 a las 06:07:37
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
-- Base de datos: `ofbms_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nombre_admin` varchar(20) NOT NULL,
  `email_admin` varchar(50) NOT NULL,
  `pwd_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `nombre_admin`, `email_admin`, `pwd_admin`) VALUES
(1, 'admin', 'admin@mail.com', '$2y$10$AFMhdlwEaWjjBzoCfdq62uNQqopNGW4vk8GXrDBNGKPAgB0mON0TC'),
(2, 'josue', 'josue@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aerolinea`
--

CREATE TABLE `aerolinea` (
  `id_aerolinea` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `asientos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `aerolinea`
--

INSERT INTO `aerolinea` (`id_aerolinea`, `nombre`, `asientos`) VALUES
(6, 'UnachAir', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id_ciudad` int(25) NOT NULL,
  `ciudad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id_ciudad`, `ciudad`) VALUES
(6, 'Tuxtla Gutiérrez'),
(7, 'Tamaulipas'),
(8, 'Monterrey'),
(9, 'Ciudad de México');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feedback`
--

CREATE TABLE `feedback` (
  `id_feed` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `q1` varchar(250) NOT NULL,
  `q2` varchar(20) NOT NULL,
  `q3` varchar(250) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `card_no` varchar(16) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_vuelo` int(11) NOT NULL,
  `expire_date` varchar(5) DEFAULT NULL,
  `monto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`card_no`, `id_usuario`, `id_vuelo`, `expire_date`, `monto`) VALUES
('1111111111111111', 7, 11, '1111', 11),
('1111111111111111', 7, 11, '1111', 11),
('1111111111111111', 7, 11, '1111', 11),
('1111111111111111', 7, 11, '1111', 11),
('1111111111111111', 7, 11, '1111', 11),
('1111111111111111', 7, 11, '1111', 11),
('1111111111111111', 7, 11, '1111', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajero`
--

CREATE TABLE `pasajero` (
  `id_pasajero` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_vuelo` int(11) NOT NULL,
  `telefono` varchar(110) NOT NULL,
  `dob` datetime NOT NULL,
  `f_name` varchar(20) DEFAULT NULL,
  `m_name` varchar(20) DEFAULT NULL,
  `l_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pasajero`
--

INSERT INTO `pasajero` (`id_pasajero`, `id_usuario`, `id_vuelo`, `telefono`, `dob`, `f_name`, `m_name`, `l_name`) VALUES
(1, 7, 11, '9921173224', '2005-01-12 00:00:00', 'josue', 'wilber', 'galvez roblero'),
(2, 7, 11, '9921172324', '2004-01-22 00:00:00', 'josue', 'wilber', 'galvez roblero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwd_reset_id` int(11) NOT NULL,
  `pwd_reset_email` varchar(50) NOT NULL,
  `pwd_reset_selector` varchar(80) NOT NULL,
  `pwd_reset_token` varchar(120) NOT NULL,
  `pwd_reset_expires` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL,
  `id_pasajero` int(11) NOT NULL,
  `id_vuelo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `seat_no` varchar(10) NOT NULL,
  `cost` int(11) NOT NULL,
  `class` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `id_pasajero`, `id_vuelo`, `id_usuario`, `seat_no`, `cost`, `class`) VALUES
(14, 1, 11, 7, '21B', 11, 'E'),
(15, 2, 11, 7, '21C', 11, 'E');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `email`, `password`) VALUES
(3, 'andre', 'andre@mail.com', '$2y$10$KRXGkY.dxYjD8FLZclW/Tu04wl76lD7IA4Z3nAsxtpdZxHNbYo4ZW'),
(4, 'james', 'james@mail.com', '$2y$10$KRXGkY.dxYjD8FLZclW/Tu04wl76lD7IA4Z3nAsxtpdZxHNbYo4ZW'),
(5, 'mcooper', 'mcooper@mail.com', '$2y$10$.FUiqi1YNqPBTxstbratouNEux7TsPPZ8/YOrV.Bd2JbVFD95G1nS'),
(6, 'Joshua', 'prueba@gmail.com', '$2y$10$LbyfgqoHV/kCcPrQd.ug7u3ndhNLhOt1.QpwwxZ.VISBj4Mwmq4wa'),
(7, 'Josue Galvez', 'eljosuexd1914@gmail.com', '$2y$10$nyznGer0yVIg8pbIy/HWk.HktbLku2kBRFJkoI9jJKL/9E/ALVf2S'),
(8, 'javier', 'eljavi@gmail.com', '$2y$10$jW9UakWsWQeKKQG1CvwTVeQ6tQ7Zg25zrqgVkRvcAgVXBFJ8WGqne');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelo`
--

CREATE TABLE `vuelo` (
  `id_vuelo` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `fecha_llegada` datetime NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `destino` varchar(20) NOT NULL,
  `salida` varchar(20) NOT NULL,
  `aerolinea` varchar(20) NOT NULL,
  `asientos` varchar(110) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `precio` int(11) NOT NULL,
  `status` varchar(6) DEFAULT NULL,
  `issue` varchar(50) DEFAULT NULL,
  `last_seat` varchar(5) DEFAULT '',
  `bus_seats` int(11) DEFAULT 20,
  `last_bus_seat` varchar(5) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `vuelo`
--

INSERT INTO `vuelo` (`id_vuelo`, `id_admin`, `fecha_llegada`, `fecha_salida`, `destino`, `salida`, `aerolinea`, `asientos`, `duration`, `precio`, `status`, `issue`, `last_seat`, `bus_seats`, `last_bus_seat`) VALUES
(11, 1, '2024-10-12 15:43:00', '2024-10-12 14:43:00', 'Tamaulipas', 'Tuxtla Gutiérrez', 'UnachAir', '197', '1', 11, '', '', '21C', 20, ''),
(12, 1, '2024-10-13 20:37:00', '2024-10-13 08:37:00', 'Tamaulipas', 'Tuxtla Gutiérrez', 'UnachAir', '200', '12 horas', 1200, '', '', '', 20, ''),
(13, 1, '2024-10-13 09:00:00', '2024-10-12 21:00:00', 'Tamaulipas', 'Tuxtla Gutiérrez', 'UnachAir', '200', '12 horas', 2147483647, '', '', '', 20, ''),
(14, 1, '2024-12-01 12:00:00', '2024-12-01 10:00:00', 'Ciudad_Destino', 'Ciudad_Origen', 'Aerolínea_Prueba', '100', '2:00', 200, '', '', '', 20, ''),
(15, 1, '2024-10-13 09:26:00', '2024-10-12 21:26:00', 'Tamaulipas', 'Monterrey', 'UnachAir', '200', '12 horas', 222222, '', '', '', 20, ''),
(16, 1, '2024-10-13 09:35:00', '2024-10-12 09:35:00', 'Tuxtla Gutiérrez', 'Ciudad de México', 'UnachAir', '200', '12 horas', 3000, '', '', '', 20, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `aerolinea`
--
ALTER TABLE `aerolinea`
  ADD PRIMARY KEY (`id_aerolinea`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id_ciudad`);

--
-- Indices de la tabla `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feed`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD KEY `user_id` (`id_usuario`),
  ADD KEY `vuelo` (`id_vuelo`);

--
-- Indices de la tabla `pasajero`
--
ALTER TABLE `pasajero`
  ADD PRIMARY KEY (`id_pasajero`),
  ADD KEY `user_id` (`id_usuario`),
  ADD KEY `flight_id` (`id_vuelo`);

--
-- Indices de la tabla `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwd_reset_id`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `user_id` (`id_usuario`),
  ADD KEY `flight_id` (`id_vuelo`),
  ADD KEY `passenger_id` (`id_pasajero`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `vuelo`
--
ALTER TABLE `vuelo`
  ADD PRIMARY KEY (`id_vuelo`),
  ADD KEY `admin` (`id_admin`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `aerolinea`
--
ALTER TABLE `aerolinea`
  MODIFY `id_aerolinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id_ciudad` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feed` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pasajero`
--
ALTER TABLE `pasajero`
  MODIFY `id_pasajero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwd_reset_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `vuelo`
--
ALTER TABLE `vuelo`
  MODIFY `id_vuelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `vuelo` FOREIGN KEY (`id_vuelo`) REFERENCES `vuelo` (`id_vuelo`);

--
-- Filtros para la tabla `pasajero`
--
ALTER TABLE `pasajero`
  ADD CONSTRAINT `pasajero_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pasajero_ibfk_2` FOREIGN KEY (`id_vuelo`) REFERENCES `vuelo` (`id_vuelo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`id_vuelo`) REFERENCES `vuelo` (`id_vuelo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vuelo`
--
ALTER TABLE `vuelo`
  ADD CONSTRAINT `admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
