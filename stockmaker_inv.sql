-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2021 a las 21:32:32
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `stockmaker_inv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Alamacen_Armario 1'),
(4, 'Alamacen_Armario 2'),
(2, 'Tienda-Aramario1 '),
(3, 'Tienda-Aramario2 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` smallint(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `tipo_accion` enum('insert','update','delete') NOT NULL,
  `quantity` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `product_name`, `fecha_hora`, `tipo_accion`, `quantity`) VALUES
(0, 'd', '2021-05-18 21:18:00', 'insert', 21),
(0, 'd', '2021-05-18 21:24:22', 'update', 0),
(0, 'Filtro de gasolina', '2021-05-18 21:24:34', 'delete', 100),
(0, 'Tornillos', '2021-05-18 21:28:02', 'update', 679),
(0, 'Cadena Bici', '2021-05-18 21:28:31', 'insert', 21),
(0, 'Arendelas', '2021-05-18 21:29:17', 'insert', 150),
(0, 'Cable Azul 100 m', '2021-05-18 21:30:24', 'insert', 12),
(0, 'Cable Azul 100 m', '2021-05-18 21:30:32', 'update', 0),
(0, 'Arendelas', '2021-05-18 21:30:47', 'update', 0),
(0, 'Cadena Bici', '2021-05-18 21:30:52', 'update', 0),
(0, 'Cable Tierra 100 m', '2021-05-18 21:31:23', 'insert', 21),
(0, 'Cable Tierra 100 m', '2021-05-18 21:31:31', 'update', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(2, 'arandelas.jpg', 'image/jpeg'),
(3, 'cableA.jpg', 'image/jpeg'),
(4, 'tornillos.jpg', 'image/jpeg'),
(5, 'cablet.jpg', 'image/jpeg'),
(6, 'CADENA+BICICLETA+10+VELOCIDADES.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `minquantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `minquantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`) VALUES
(2, 'Tornillos', '700', '100', '12.00', '15.00', 2, 4, '2021-05-18 21:18:00'),
(3, 'Cadena Bici', '21', '21', '12.00', '25.00', 4, 6, '2021-05-18 21:28:31'),
(4, 'Arendelas', '150', '155', '12.00', '19.00', 1, 2, '2021-05-18 21:29:17'),
(5, 'Cable Azul 100 m', '12', '21', '31.00', '42.00', 4, 3, '2021-05-18 21:30:24'),
(6, 'Cable Tierra 100 m', '21', '12', '15.00', '21.00', 4, 5, '2021-05-18 21:31:23');

--
-- Disparadores `products`
--
DELIMITER $$
CREATE TRIGGER `products_delete` BEFORE DELETE ON `products` FOR EACH ROW INSERT INTO historial(id, product_name, tipo_accion, quantity, fecha_hora)
  VALUES('', OLD.name, 'delete', OLD.quantity, NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `products_insert` AFTER INSERT ON `products` FOR EACH ROW INSERT INTO historial(id, product_name, tipo_accion, quantity, fecha_hora)
  VALUES('', NEW.name, 'insert',  NEW.quantity, NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `products_update` AFTER UPDATE ON `products` FOR EACH ROW INSERT INTO historial(id, product_name, tipo_accion, quantity, fecha_hora)
  VALUES('', NEW.name, 'update', NEW.quantity - OLD.quantity, NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Guillermo_Administrador', 'Guillermo_Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'xrsenwz21.PNG', 1, '2021-05-18 21:22:31'),
(2, 'Sergi_Parpal', 'Sergi_encargado', 'b36fff89e3b60ca80e12a16d70289d58f6a50f31', 2, 'no_image.jpg', 1, '2021-05-18 21:22:19'),
(3, 'David_Iglesias', 'David_empleado', 'f9f011a553550aef31a8ee2690e1d1b5f261c9ff', 3, 'no_image.jpg', 1, '2021-05-18 21:22:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Administrador', 1, 1),
(2, 'Encargado', 2, 1),
(3, 'Empleado', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_level` (`user_level`);

--
-- Indices de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
