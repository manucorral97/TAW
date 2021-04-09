-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-12-2020 a las 11:15:44
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Volant`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Datos_Clientes`
--

CREATE TABLE `Datos_Clientes` (
  `ID_Clientes` int(9) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Pass` varchar(50) NOT NULL,
  `Tipo` varchar(10) NOT NULL,
  `Fecha_Registro` date NOT NULL,
  `Privilegio` char(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Datos_Clientes`
--

INSERT INTO `Datos_Clientes` (`ID_Clientes`, `Nombre`, `Email`, `DNI`, `Pass`, `Tipo`, `Fecha_Registro`, `Privilegio`) VALUES
(1, 'Usuario', 'user@gmail.com', '12345678H', 'user', 'Alumno', '2020-12-17', '2'),
(2, 'Admin', 'admin@gmail.com', '12345678T', 'admin', 'Profesor', '2020-12-17', '1'),
(3, 'Manuel', 'manuelcorral97@gmail.com', '45573817F', '1234', 'Alumno', '2020-12-19', '2'),
(5, 'Borrar', 'Borrar@borrar.com', '12345678O', 'borrar', 'Alumno', '2020-12-19', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedidos`
--

CREATE TABLE `Pedidos` (
  `ID_Pedido` int(9) NOT NULL,
  `ID_Usuario` int(9) NOT NULL,
  `PrecioTotal` float(6,2) NOT NULL,
  `FechaCompra` datetime NOT NULL,
  `FechaEnvio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Pedidos`
--

INSERT INTO `Pedidos` (`ID_Pedido`, `ID_Usuario`, `PrecioTotal`, `FechaCompra`, `FechaEnvio`) VALUES
(1, 1, 29.00, '2020-12-17 19:00:17', '2020-12-19'),
(2, 3, 40.00, '2020-12-19 01:59:18', '2020-12-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedido_vuelo`
--

CREATE TABLE `Pedido_vuelo` (
  `ID_Pedido` int(9) NOT NULL,
  `ID_Vuelo` int(9) NOT NULL,
  `Cantidad` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Pedido_vuelo`
--

INSERT INTO `Pedido_vuelo` (`ID_Pedido`, `ID_Vuelo`, `Cantidad`) VALUES
(1, 1, 1),
(1, 5, 1),
(2, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Vuelos`
--

CREATE TABLE `Vuelos` (
  `ID_Vuelos` int(9) NOT NULL,
  `Origen` varchar(30) NOT NULL,
  `Destino` varchar(30) NOT NULL,
  `Salida` datetime NOT NULL,
  `Llegada` datetime NOT NULL,
  `Precio` int(9) NOT NULL,
  `Company` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Vuelos`
--

INSERT INTO `Vuelos` (`ID_Vuelos`, `Origen`, `Destino`, `Salida`, `Llegada`, `Precio`, `Company`) VALUES
(1, 'Madrid', 'Londres', '2020-12-17 18:56:00', '2020-12-17 20:57:00', 12, 'Iberia'),
(2, 'Madrid', 'Milan', '2020-12-27 18:57:00', '2020-12-28 18:57:00', 15, 'Air Europa'),
(3, 'Londres', 'Madrid', '2020-12-25 18:57:00', '2020-12-26 18:57:00', 20, 'Ryanair'),
(4, 'Londres', 'Milan', '2021-01-01 18:58:00', '2021-01-02 18:58:00', 10, 'Ryanair'),
(5, 'Milan', 'Madrid', '2020-12-18 18:58:00', '2020-12-19 18:58:00', 17, 'Air France');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Datos_Clientes`
--
ALTER TABLE `Datos_Clientes`
  ADD PRIMARY KEY (`ID_Clientes`);

--
-- Indices de la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  ADD PRIMARY KEY (`ID_Pedido`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `Pedido_vuelo`
--
ALTER TABLE `Pedido_vuelo`
  ADD KEY `ID_Pedido` (`ID_Pedido`),
  ADD KEY `ID_Vuelo` (`ID_Vuelo`);

--
-- Indices de la tabla `Vuelos`
--
ALTER TABLE `Vuelos`
  ADD PRIMARY KEY (`ID_Vuelos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Datos_Clientes`
--
ALTER TABLE `Datos_Clientes`
  MODIFY `ID_Clientes` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  MODIFY `ID_Pedido` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Vuelos`
--
ALTER TABLE `Vuelos`
  MODIFY `ID_Vuelos` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  ADD CONSTRAINT `Pedidos_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `Datos_Clientes` (`ID_Clientes`);

--
-- Filtros para la tabla `Pedido_vuelo`
--
ALTER TABLE `Pedido_vuelo`
  ADD CONSTRAINT `Pedido_vuelo_ibfk_1` FOREIGN KEY (`ID_Pedido`) REFERENCES `Pedidos` (`ID_Pedido`),
  ADD CONSTRAINT `Pedido_vuelo_ibfk_2` FOREIGN KEY (`ID_Vuelo`) REFERENCES `Vuelos` (`ID_Vuelos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
