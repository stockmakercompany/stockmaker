-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2021 a las 20:02:43
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
(1, 'Tienda-Aramario2 '),
(2, 'Alamacen_Armario 1'),
(3, 'Tienda-Aramario1');

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
(1, 'Tornillos', '2021-05-17 09:10:30', 'update', 110),
(2, 'Cadena Bici', '2021-05-17 09:14:29', 'delete', 12),
(3, 'Tornillos', '2021-05-17 09:14:30', 'delete', 122),
(4, 'Tornillos', '2021-05-17 09:20:42', 'insert', 400),
(5, 'Tornillos', '2021-05-17 09:40:22', 'update', 0),
(6, 'Cadena Bici', '2021-05-17 09:41:12', 'insert', 13),
(7, 'Tornillos', '2021-05-17 09:41:20', 'update', 0),
(8, 'Cadena Bici', '2021-05-17 09:43:30', 'update', 0),
(9, 'Tornillos', '2021-05-17 09:43:38', 'update', 0),
(10, 'Cadena Bici', '2021-05-17 09:43:43', 'update', 0),
(11, 'Tornillos', '2021-05-17 09:43:53', 'update', 0),
(12, 'Cadena Bici', '2021-05-17 09:44:01', 'update', 0),
(13, 'Arendelas', '2021-05-17 09:45:31', 'insert', 12),
(14, 'Arendelas', '2021-05-17 09:48:43', 'update', 0),
(15, 'd', '2021-05-17 10:24:13', 'insert', 20),
(16, 'Tornillos', '2021-05-17 10:34:44', 'update', 300),
(17, 'd', '2021-05-17 10:35:01', 'update', 0),
(18, 'd', '2021-05-17 10:35:06', 'update', 0),
(19, 'd', '2021-05-17 10:35:28', 'update', -5);

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
(1, 'images.jpg', 'image/jpeg'),
(2, 'tornillos.jpg', 'image/jpeg'),
(3, 'arandelas.jpg', 'image/jpeg'),
(4, 'imagen_2021-05-16_202219.png', 'image/png'),
(5, 'descarga.jpg', 'image/jpeg'),
(6, 'filter.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT 0,
  `date` datetime NOT NULL,
  `minquantity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`, `minquantity`) VALUES
(4, 'Tornillos', '700', '20.00', '29.00', 2, 2, '2021-05-17 09:20:42', '60'),
(5, 'Cadena Bici', '13', '2.00', '5.00', 2, 1, '2021-05-17 09:41:12', '15'),
(6, 'Arendelas', '12', '2.00', '5.00', 1, 3, '2021-05-17 09:45:31', '15'),
(7, 'd', '15', '21.00', '31.00', 1, 4, '2021-05-17 10:24:13', '19');

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
(1, 'Guillermo_Administrador', 'Guillermo_Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'hsze4ut1.jpg', 1, '2021-05-17 20:01:33'),
(10, 'Sergi Parpal', 'Sergi_encargado', '1b27e0ed61ce6f20050b2a5184c17d14d9d280ec', 2, '2i0o8prk10.jpg', 1, '2021-05-17 04:09:55'),
(11, 'David_iglesias', 'David_empleado', 'f9f011a553550aef31a8ee2690e1d1b5f261c9ff', 3, 'ity4rhx11.jpg', 1, '2021-05-17 04:07:57'),
(12, 'Pepe Lozada', 'Pepe_empleado', 'e5a83a10ba9cbdc8107acf0cdafc6369b385e4c2', 3, 'jgro2eat12.jpeg', 1, '2021-05-17 04:06:05'),
(15, 'Mimeme', 'Mememe_admin', '58117e24e4d0b8a958146c9eaa28336184f4d491', 1, '', 1, '2021-05-17 10:51:51');

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
(4, 'Encargado', 2, 1),
(5, 'Empleado', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
