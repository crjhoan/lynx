-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2018 a las 15:50:23
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lynx`
--
CREATE DATABASE IF NOT EXISTS `pm17182031` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pm17182031`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `id_articulo` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `precio` double NOT NULL,
  `calificacion` double NOT NULL,
  `dir_imagen` varchar(60) NOT NULL,
  `caracteristicas` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id_articulo`, `nombre`, `precio`, `calificacion`, `dir_imagen`, `caracteristicas`, `descripcion`) VALUES
(15, 'Carro', 1200, 3, 'imagenes_arti/2.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?'),
(16, 'NiÃ±os', 1200, 5, 'imagenes_arti/1.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?'),
(17, 'Ave', 12000, 3, 'imagenes_arti/6.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?'),
(18, 'Aguila', 1200, 2, 'imagenes_arti/3.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?'),
(19, 'Movilidad', 1300, 10, 'imagenes_arti/4.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?'),
(20, 'Movilidad2', 1300, 12, 'imagenes_arti/movilidad.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?'),
(21, 'camara', 1200, 3, 'imagenes_arti/1.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit reiciendis magni, ipsa illo soluta consequatur? Officiis quibusdam, minus numquam rem qui ipsum corrupti consectetur sit possimus non quia nam a?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `comentario` varchar(1000) NOT NULL,
  `id_usuario` varchar(60) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `comentario`, `id_usuario`, `id_articulo`, `calificacion`, `num`) VALUES
(1, 'Muy bueno', '10', 15, 10, 1),
(2, 'Muy bueno', '10', 15, 10, 1),
(3, 'comentario', '10', 19, 10, 0),
(4, 'comentario2', '10', 19, 12, 0),
(5, 'comantario3', '10', 15, 12, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle_venta` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `nombre_completo` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mensaje` varchar(250) NOT NULL,
  `id_mensaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`nombre_completo`, `telefono`, `email`, `mensaje`, `id_mensaje`) VALUES
('cristian jhoanamado avila', 2147483647, 'crjhoan@gmail.com', 'mensaje de prueba', 1),
('David Felipe Quintero Reina', 2147483647, 'crjhoan@gmail.com', 'Buen dia, ', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usernam` varchar(60) NOT NULL,
  `contrasena` varchar(60) NOT NULL,
  `nombre_completo` varchar(90) NOT NULL,
  `direccion` varchar(90) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sexo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usernam`, `contrasena`, `nombre_completo`, `direccion`, `email`, `sexo`) VALUES
(9, 'Q', '$2y$10$lTEGSrd23iM5qGtPFptPVeN.XKQDPPrCQ8eD4gMuOt3PIp8g2f6RO', 'C', 'Q', '', ''),
(10, 'crjhoan', '$2y$10$tUbjCJG887YfwHddmAxn3.w.tF8BFi.vFrkQ3fV5f8IeWBpWD9zDK', 'Cristian Amado', '0, San Luis PotosÃ¬, San Luis PotosÃ¬, San Luis PotosÃ¬, San Luis PotosÃ¬', 'crjhoan@gmail.com', 'masculino'),
(11, 'admin', '$2y$10$pTzZZxKZUvyCywML5.l54.vlywDS9H2/.ydE1Z7HstfQz4.35Geae', 'ADMINISTRADOR', '0', '', ''),
(12, 'david', '$2y$10$ZerN9eiunjc8Hm.9MTRpN.PKhOLUsgxsVmOzRqvBASoyDckNI2c56', 'david felipe quintero', '0', '', ''),
(13, 'maria', '$2y$10$YNnO8oiUdwLZz2xfYWWqT.s4B3qLZ.2TbqMoeJ7o.wnGRBaXndZpS', 'maria di', 'calle 12, San Luis PotosÃ¬, San Luis PotosÃ¬', '', ''),
(14, 'felipe', '$2y$10$UrogNywf1CjBs96Xxzn9JegPlthP8MeogW.mtB3BTID6MVG5WaTcO', 'david felipe', 'calle 13, San Luis PotosÃ¬, San Luis PotosÃ¬', 'crjhoan@gmail.com', 'masculino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `total` double NOT NULL,
  `id_usuario` varchar(60) NOT NULL,
  `num_tarjeta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`id_articulo`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle_venta`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
