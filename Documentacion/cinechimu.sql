-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2022 a las 06:50:34
-- Versión del servidor: 5.7.32-log
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cinechimu`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ingreso`
--

CREATE TABLE `detalle_ingreso` (
  `codDetalleIngreso` int(11) NOT NULL,
  `codProducto` int(11) NOT NULL,
  `codIngreso` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `codDetalleVenta` int(11) NOT NULL,
  `codVenta` int(11) NOT NULL,
  `codProducto` int(11) NOT NULL,
  `precioVenta` float NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `codEntrada` int(11) NOT NULL,
  `precio` float NOT NULL,
  `codFuncion` int(11) NOT NULL,
  `nombrePersona` varchar(500) NOT NULL,
  `codIntencion` int(11) DEFAULT NULL,
  `codUsuarioComprador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`codEntrada`, `precio`, `codFuncion`, `nombrePersona`, `codIntencion`, `codUsuarioComprador`) VALUES
(6, 2, 7, 'diego ernesto', 5, 1),
(7, 2, 7, '', 5, 1),
(8, 2, 7, '', 5, 1),
(9, 2, 7, 'leslie', 5, 1),
(10, 2, 7, '', 5, 1),
(11, 13, 5, 'uan', 6, 1),
(12, 13, 5, '', 6, 1),
(13, 13, 5, 'valdez', 6, 1),
(14, 15, 2, '', 7, 1),
(15, 15, 2, '', 7, 1),
(16, 15, 2, '', 7, 1),
(17, 15, 2, '', 7, 1),
(18, 51, 4, '', 9, 1),
(19, 51, 4, '', 9, 1),
(20, 51, 4, '', 9, 1),
(21, 51, 4, '', 9, 1),
(22, 51, 4, '', 9, 1),
(23, 51, 4, '', 9, 1),
(24, 25, 6, '', 10, 1),
(25, 25, 6, '', 10, 1),
(26, 25, 6, '', 10, 1),
(27, 25, 6, '', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `error_historial`
--

CREATE TABLE `error_historial` (
  `codErrorHistorial` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `controllerDondeOcurrio` varchar(100) NOT NULL,
  `funcionDondeOcurrio` varchar(200) NOT NULL,
  `fechaHora` datetime NOT NULL,
  `fechaHoraSolucion` datetime DEFAULT NULL,
  `ipEmpleado` varchar(40) NOT NULL,
  `descripcionError` varchar(55000) NOT NULL,
  `estadoError` tinyint(4) NOT NULL,
  `razon` varchar(200) DEFAULT NULL,
  `solucion` varchar(500) DEFAULT NULL,
  `formulario` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_intencion`
--

CREATE TABLE `estado_intencion` (
  `codEstado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_intencion`
--

INSERT INTO `estado_intencion` (`codEstado`, `nombre`) VALUES
(1, 'Creado'),
(2, 'Pendiente'),
(3, 'Confirmado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcion`
--

CREATE TABLE `funcion` (
  `codFuncion` int(11) NOT NULL,
  `precioEntrada` float NOT NULL,
  `cantidadEntradasVirtuales` int(11) NOT NULL,
  `cantidadEntradasVendidas` int(11) NOT NULL,
  `cantidadEntradasVentaPresencial` int(11) NOT NULL,
  `codUsuarioCreador` int(11) NOT NULL,
  `codSala` int(11) NOT NULL,
  `codPelicula` int(11) NOT NULL,
  `fechaHoraCreacion` datetime NOT NULL,
  `fechaHoraFuncion` datetime NOT NULL,
  `comentario` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `funcion`
--

INSERT INTO `funcion` (`codFuncion`, `precioEntrada`, `cantidadEntradasVirtuales`, `cantidadEntradasVendidas`, `cantidadEntradasVentaPresencial`, `codUsuarioCreador`, `codSala`, `codPelicula`, `fechaHoraCreacion`, `fechaHoraFuncion`, `comentario`) VALUES
(2, 15, 50, 0, 10, 1, 1, 2, '2022-09-14 13:30:52', '2022-09-19 20:00:00', 'gaaaaaa assaas'),
(3, 5, 50, 0, 10, 1, 1, 2, '2022-09-14 13:30:52', '2022-09-15 21:07:00', ''),
(4, 51, 5, 0, 1, 1, 1, 1, '2022-09-14 21:07:13', '2022-10-15 05:15:00', 'adwad awd'),
(5, 13, 25, 0, 1, 1, 1, 2, '2022-09-14 21:08:02', '2022-12-24 12:55:00', NULL),
(6, 25, 155, 0, 52, 1, 1, 1, '2022-09-14 21:16:48', '2022-09-24 05:01:00', NULL),
(7, 2, 2, 0, 3, 1, 1, 3, '2022-09-15 17:32:46', '2022-09-24 11:25:00', 'a'),
(8, 15, 5, 0, 1, 1, 1, 1, '2022-09-19 21:36:38', '2022-03-01 20:20:00', 'awd'),
(9, 21, 2, 0, 3, 1, 1, 1, '2022-10-11 04:46:04', '2022-10-11 11:11:00', 'adasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_almacen`
--

CREATE TABLE `ingreso_almacen` (
  `fechaHora` int(11) NOT NULL,
  `codUsuarioCreador` int(11) NOT NULL,
  `comentario` varchar(1000) NOT NULL,
  `codIngreso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intencion_compra`
--

CREATE TABLE `intencion_compra` (
  `codIntencion` int(11) NOT NULL,
  `cantidadEntradas` int(11) NOT NULL,
  `precioUnitario` float NOT NULL,
  `montoTotal` float NOT NULL,
  `arrayNombres` varchar(500) NOT NULL,
  `codFuncion` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `codEstado` int(11) NOT NULL,
  `fechaHoraCreacion` datetime NOT NULL COMMENT '1 Momento en el que el usuario confirma que sí quiere comprar las entradas',
  `fechaHoraConfirmacionPago` datetime DEFAULT NULL COMMENT 'momento en el que el servidor de la pasarela de pago nos responde que ya se efectuó la transaccion',
  `fechaHoraSubmitPago` datetime DEFAULT NULL COMMENT 'Momento en el que el usuario ya ingresó sus datos de tarjeta y le da a PAGAR'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `intencion_compra`
--

INSERT INTO `intencion_compra` (`codIntencion`, `cantidadEntradas`, `precioUnitario`, `montoTotal`, `arrayNombres`, `codFuncion`, `codUsuario`, `codEstado`, `fechaHoraCreacion`, `fechaHoraConfirmacionPago`, `fechaHoraSubmitPago`) VALUES
(1, 2, 15, 30, ',', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 15, 30, ',', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 15, 45, 'diego,,ernesto', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 51, 204, 'Diego ernesto,novia de diego XD,,', 4, 1, 1, '2022-09-17 22:43:46', NULL, NULL),
(5, 5, 2, 10, 'diego ernesto,,,leslie,', 7, 1, 3, '2022-09-17 23:05:32', NULL, NULL),
(6, 3, 13, 39, 'uan,,valdez', 5, 1, 3, '2022-09-17 23:06:44', NULL, NULL),
(7, 4, 15, 60, ',,,', 2, 1, 3, '2022-09-17 23:09:11', NULL, NULL),
(8, 3, 51, 153, ',,', 4, 1, 1, '2022-09-19 21:27:55', NULL, NULL),
(9, 3, 51, 153, ',,', 4, 1, 3, '2022-09-19 21:28:13', NULL, NULL),
(10, 4, 25, 100, ',,,', 6, 1, 3, '2022-09-19 21:40:22', NULL, NULL),
(11, 4, 2, 8, ',flaca,,', 7, 1, 1, '2022-09-20 16:29:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logeo_historial`
--

CREATE TABLE `logeo_historial` (
  `codLogeoHistorial` int(11) NOT NULL,
  `fechaHora` datetime NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `codMetodo` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametro_sistema`
--

CREATE TABLE `parametro_sistema` (
  `codParametro` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `valor` varchar(1000) NOT NULL,
  `fechaHoraCreacion` datetime NOT NULL,
  `fechaHoraBaja` datetime DEFAULT NULL,
  `fechaHoraActualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `codPelicula` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `duracionMinutos` int(11) NOT NULL,
  `urlFoto` varchar(1000) NOT NULL,
  `director` varchar(500) NOT NULL,
  `fechaHoraDesactivacion` datetime DEFAULT NULL,
  `codUsuarioDesactivador` int(11) DEFAULT NULL,
  `añoEstreno` int(11) NOT NULL,
  `fechaHoraCreacion` datetime NOT NULL,
  `codUsuarioCreador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`codPelicula`, `nombre`, `descripcion`, `duracionMinutos`, `urlFoto`, `director`, `fechaHoraDesactivacion`, `codUsuarioDesactivador`, `añoEstreno`, `fechaHoraCreacion`, `codUsuarioCreador`) VALUES
(1, 'Tumba de las luciernagas', 'Un adolescente se ve obligado a cuidar a su hermana menor después de que un bombardeo aliado durante la Segunda Guerra Mundial destruye su casa. ADA', 500, '/img/Posters/poster_1.png', 'Isao Takahata.', NULL, NULL, 2000, '2022-09-15 18:58:16', 1),
(2, 'La noche de los lápices', 'La película recrea la historia desde el comienzo de las protestas estudiantiles de 1975 hasta 1980, cuando el único sobreviviente del grupo secuestrado fue liberado. La primera parte de la película relata la actividad de los adolescentes y la ominosa razzia en la que fueron secuestrados y encarcelados; la segunda narra las circunstancias de la prisión y tortura de los jóvenes, siguiendo paralelamente la situación de las familias de los cautivos y la de sus captores.1​', 55, '/img/Posters/NocheLapices.jpg', 'Héctor Olivera', NULL, NULL, 1920, '2022-09-08 18:58:19', 1),
(3, 'Coca cola', 'awd', 2155, '/img/Posters/poster_3.jpg', 'Isao Takahata.X', NULL, NULL, 2512, '2022-09-15 17:32:11', 1),
(4, 'da', '2awd', 251, '/img/Posters/poster_4.jpg', 'adwawd', NULL, NULL, 2525, '2022-09-15 17:42:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codProducto` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `stock` int(11) NOT NULL,
  `precioVenta` float NOT NULL,
  `fechaHoraCreacion` datetime NOT NULL,
  `codUsuarioCreador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `codRol` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`codRol`, `nombre`) VALUES
(1, 'Admin'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE `sala` (
  `codSala` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `cantidadAforo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`codSala`, `nombre`, `cantidadAforo`) VALUES
(1, 'Sala Olaya', 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codUsuario` int(11) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `nombres` varchar(300) NOT NULL,
  `apellidos` varchar(300) NOT NULL,
  `codRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codUsuario`, `dni`, `usuario`, `password`, `nombres`, `apellidos`, `codRol`) VALUES
(1, '', 'admin', '$2y$10$eYaebX38eMUNIzu4rHgafuWdvwOcOjsxOiXd4rev0Cjfefcb0E5J.', 'Diego Ernesto', 'Vigo Briones', 1),
(2, '11223344', 'silvia', '$2y$10$NP8b9c6Ro59wncs/2XYHu.pF6DGhyEe0c5gclrO4UX49erpHVmsde', 'Silvia', 'Arellano Rojas', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `codVenta` int(11) NOT NULL,
  `fechaHora` datetime NOT NULL,
  `codUsuarioComprador` int(11) NOT NULL,
  `montoTotal` float NOT NULL,
  `codMetodo` int(11) NOT NULL,
  `comentario` varchar(1000) DEFAULT NULL,
  `codUsuarioCajero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD PRIMARY KEY (`codDetalleIngreso`),
  ADD KEY `detalle_ingreso_ingreso` (`codIngreso`),
  ADD KEY `detalle_ingreso_producto` (`codProducto`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`codDetalleVenta`),
  ADD KEY `detalle_venta` (`codVenta`),
  ADD KEY `detalle_producto` (`codProducto`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`codEntrada`),
  ADD KEY `entrada_funcion_relacion` (`codFuncion`),
  ADD KEY `entrada_intencion_relacion` (`codIntencion`),
  ADD KEY `entrada_usuariocomprador_relacion` (`codUsuarioComprador`);

--
-- Indices de la tabla `error_historial`
--
ALTER TABLE `error_historial`
  ADD PRIMARY KEY (`codErrorHistorial`),
  ADD KEY `error_usuario_relacion` (`codUsuario`);

--
-- Indices de la tabla `estado_intencion`
--
ALTER TABLE `estado_intencion`
  ADD PRIMARY KEY (`codEstado`);

--
-- Indices de la tabla `funcion`
--
ALTER TABLE `funcion`
  ADD PRIMARY KEY (`codFuncion`),
  ADD KEY `funcion_usuarioProgramador_relacion` (`codUsuarioCreador`),
  ADD KEY `funcion_sala_relacion` (`codSala`),
  ADD KEY `funcion_pelicula_relacion` (`codPelicula`);

--
-- Indices de la tabla `ingreso_almacen`
--
ALTER TABLE `ingreso_almacen`
  ADD PRIMARY KEY (`codIngreso`);

--
-- Indices de la tabla `intencion_compra`
--
ALTER TABLE `intencion_compra`
  ADD PRIMARY KEY (`codIntencion`),
  ADD KEY `intencion_estado` (`codEstado`),
  ADD KEY `intencion_funcion` (`codFuncion`),
  ADD KEY `intencion_usuario` (`codUsuario`);

--
-- Indices de la tabla `logeo_historial`
--
ALTER TABLE `logeo_historial`
  ADD PRIMARY KEY (`codLogeoHistorial`),
  ADD KEY `logeo_usuario_relacion` (`codUsuario`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`codMetodo`);

--
-- Indices de la tabla `parametro_sistema`
--
ALTER TABLE `parametro_sistema`
  ADD PRIMARY KEY (`codParametro`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`codPelicula`),
  ADD KEY `usuario_desactivador_relacion` (`codUsuarioDesactivador`),
  ADD KEY `usuario_creador` (`codUsuarioCreador`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codProducto`),
  ADD KEY `producto_usuario` (`codUsuarioCreador`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`codRol`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`codSala`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codUsuario`),
  ADD KEY `usuario_rol_relacion` (`codRol`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`codVenta`),
  ADD KEY `venta_metodo` (`codMetodo`),
  ADD KEY `venta_usuario_comprador` (`codUsuarioComprador`),
  ADD KEY `venta_usuario_cajero` (`codUsuarioCajero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  MODIFY `codDetalleIngreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `codDetalleVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `codEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `error_historial`
--
ALTER TABLE `error_historial`
  MODIFY `codErrorHistorial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado_intencion`
--
ALTER TABLE `estado_intencion`
  MODIFY `codEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `funcion`
--
ALTER TABLE `funcion`
  MODIFY `codFuncion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ingreso_almacen`
--
ALTER TABLE `ingreso_almacen`
  MODIFY `codIngreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `intencion_compra`
--
ALTER TABLE `intencion_compra`
  MODIFY `codIntencion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `logeo_historial`
--
ALTER TABLE `logeo_historial`
  MODIFY `codLogeoHistorial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `codMetodo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parametro_sistema`
--
ALTER TABLE `parametro_sistema`
  MODIFY `codParametro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `codPelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codProducto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `codRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sala`
--
ALTER TABLE `sala`
  MODIFY `codSala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `codVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD CONSTRAINT `detalle_ingreso_ingreso` FOREIGN KEY (`codIngreso`) REFERENCES `ingreso_almacen` (`codIngreso`),
  ADD CONSTRAINT `detalle_ingreso_producto` FOREIGN KEY (`codProducto`) REFERENCES `producto` (`codProducto`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_producto` FOREIGN KEY (`codProducto`) REFERENCES `producto` (`codProducto`),
  ADD CONSTRAINT `detalle_venta` FOREIGN KEY (`codVenta`) REFERENCES `venta` (`codVenta`);

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_funcion_relacion` FOREIGN KEY (`codFuncion`) REFERENCES `funcion` (`codFuncion`),
  ADD CONSTRAINT `entrada_intencion_relacion` FOREIGN KEY (`codIntencion`) REFERENCES `intencion_compra` (`codIntencion`),
  ADD CONSTRAINT `entrada_usuariocomprador_relacion` FOREIGN KEY (`codUsuarioComprador`) REFERENCES `usuario` (`codUsuario`);

--
-- Filtros para la tabla `error_historial`
--
ALTER TABLE `error_historial`
  ADD CONSTRAINT `error_usuario_relacion` FOREIGN KEY (`codUsuario`) REFERENCES `usuario` (`codUsuario`);

--
-- Filtros para la tabla `funcion`
--
ALTER TABLE `funcion`
  ADD CONSTRAINT `funcion_pelicula_relacion` FOREIGN KEY (`codPelicula`) REFERENCES `pelicula` (`codPelicula`),
  ADD CONSTRAINT `funcion_sala_relacion` FOREIGN KEY (`codSala`) REFERENCES `sala` (`codSala`),
  ADD CONSTRAINT `funcion_usuarioProgramador_relacion` FOREIGN KEY (`codUsuarioCreador`) REFERENCES `usuario` (`codUsuario`);

--
-- Filtros para la tabla `intencion_compra`
--
ALTER TABLE `intencion_compra`
  ADD CONSTRAINT `intencion_estado` FOREIGN KEY (`codEstado`) REFERENCES `estado_intencion` (`codEstado`),
  ADD CONSTRAINT `intencion_funcion` FOREIGN KEY (`codFuncion`) REFERENCES `funcion` (`codFuncion`),
  ADD CONSTRAINT `intencion_usuario` FOREIGN KEY (`codUsuario`) REFERENCES `usuario` (`codUsuario`);

--
-- Filtros para la tabla `logeo_historial`
--
ALTER TABLE `logeo_historial`
  ADD CONSTRAINT `logeo_usuario_relacion` FOREIGN KEY (`codUsuario`) REFERENCES `usuario` (`codUsuario`);

--
-- Filtros para la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD CONSTRAINT `usuario_creador` FOREIGN KEY (`codUsuarioCreador`) REFERENCES `usuario` (`codUsuario`),
  ADD CONSTRAINT `usuario_desactivador_relacion` FOREIGN KEY (`codUsuarioDesactivador`) REFERENCES `usuario` (`codUsuario`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_usuario` FOREIGN KEY (`codUsuarioCreador`) REFERENCES `usuario` (`codUsuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_rol_relacion` FOREIGN KEY (`codRol`) REFERENCES `rol` (`codRol`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_metodo` FOREIGN KEY (`codMetodo`) REFERENCES `metodo_pago` (`codMetodo`),
  ADD CONSTRAINT `venta_usuario_cajero` FOREIGN KEY (`codUsuarioCajero`) REFERENCES `usuario` (`codUsuario`),
  ADD CONSTRAINT `venta_usuario_comprador` FOREIGN KEY (`codUsuarioComprador`) REFERENCES `usuario` (`codUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
