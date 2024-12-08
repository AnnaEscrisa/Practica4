-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: proxysql-01.dd.scip.local
-- Tiempo de generación: 04-12-2024 a las 18:52:41
-- Versión del servidor: 10.10.2-MariaDB-1:10.10.2+maria~deb11
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ddb238991`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `titol` varchar(40) NOT NULL,
  `cos` varchar(400) NOT NULL,
  `ingredients` varchar(500) DEFAULT NULL,
  `image` varchar(200) NOT NULL DEFAULT 'none.webp',
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`id`, `titol`, `cos`, `ingredients`, `image`, `user_id`) VALUES
(26, 'Vitalis Elixir', 'Per aixecar-se amb més energia.\r\n', 'Aigua lunar, essencia de violeta, 5 onces de sorra negra, 2 gotes de sang de Lamia', 'none.webp', 3),
(27, 'Stasis Magna', 'Paralitza el cos durant 2h.', 'Belladona, Reig de fageda, Pasiflora', 'none.webp', 8),
(29, 'Canis Gastrofinite', 'Calma l\'estòmag en cas de vòmits. Per consum caní exclusivament. ', 'Pastanaga, Aigua tibia, Valeriana, Camomila', 'none.webp', 6),
(35, 's', 's', NULL, 'none.webp', 0),
(37, 'f', 'f', NULL, 'none.webp', 0),
(44, 'w', 'w', NULL, 'none.webp', 0),
(45, 'e', 'e', NULL, 'none.webp', 0),
(46, 'r', 'r', NULL, 'none.webp', 0),
(47, 't', 't', NULL, 'none.webp', 0),
(48, 'y', 'y', NULL, 'none.webp', 0),
(51, 'Somnus Maligna', 'Dona malsons a qui la veu.', '', 'none.webp', 5),
(53, 'sdasd', 'dasdad', 'sdadasd', 'none.webp', 5),
(54, 'Sivilinus Imperterre', 'Inmunitza contra la majoria de verins del mercat', 'Bolet tendre de Rivendell, Ou de falcó de sang, Aigua lunar', 'none.webp', 5),
(59, 'article1', 'asdsadasdasdasdasd', 'asdasdasdasdasdasdasd', 'none.webp', 12),
(60, 'article2', 'sadasdasd', 'asfdsadasdasd', 'none.webp', 12),
(61, 'article3', 'asasdasd', '', 'none.webp', 12),
(62, 'article4', 'asdasdsadasdasd', 'asdasd', 'none.webp', 12),
(64, 'sdsdsds', 'kojji', '', 'none.webp', 9),
(67, 'sdfsdf', 'sdfsdfsdfhgkhgggkjgkjgjgkjg', 'dfsdfsdf', 'none.webp', 23),
(68, 'asddddd', 'sdsd', 'aaa', 'none.webp', 20),
(70, 'asasdasdasdasssssssssssss', 'asdasd', 'asdasd', 'none.webp', 1),
(71, '55555', '55', '', 'none.webp', 1),
(72, 'fffffffffff45341111111', 'aasdasdd', 'sdasdas', 'none.webp', 1),
(73, 'Prova 888', 'sdsdasd', 'asdsadasda', 'none.webp', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles1`
--

CREATE TABLE `articles1` (
  `id` int(10) UNSIGNED NOT NULL,
  `titol` varchar(40) NOT NULL,
  `cos` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articles1`
--

INSERT INTO `articles1` (`id`, `titol`, `cos`) VALUES
(26, 'Prova 18', '18 mes 18'),
(27, 'Prova 888', '888 999 111'),
(29, 'Altre prova', 'sadasdasdad'),
(31, 'Prova 12', '12121212'),
(32, 'Tirori', 'Super practica max'),
(34, 'a', 'a'),
(35, 's', 's'),
(36, 'd', 'd'),
(37, 'f', 'f'),
(38, 'g', 'g'),
(39, 'h', 'h'),
(40, 'j', 'j'),
(41, 'k', 'k'),
(42, 'l', 'l'),
(43, 'q', 'q'),
(44, 'w', 'w'),
(45, 'e', 'e'),
(46, 'r', 'r'),
(47, 't', 't'),
(48, 'y', 'y'),
(49, 'Prova2sadasd', 'asdasdad'),
(50, 'Prova 2444444', 'Una altre prova');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` varchar(40) NOT NULL,
  `password` varchar(300) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `isSocial` tinyint(1) NOT NULL DEFAULT 0,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `name`, `email`, `isSocial`, `isAdmin`) VALUES
(3, 'BS_Mad', '$2y$10$htm2l9MP6tmsceVvbU.Sdu2ts0U.MtgfPUzH0u4mHDstofRoYx5vC', 'Bruixa Superiora Madeleine', 'bsm@gmail.com', 0, 0),
(5, 'Prova29', '$2y$10$IdBsqMACEsmI6rMT3R44KuwCQfB/TX/13tWByyJwtTB7X8PxJ0e0q', 'Circe', 'porva@gamil.com', 0, 0),
(6, 'Bruixa_Lola', '$2y$10$BUi3hi8t0gR7nefEkCJOPuQTwfpCEMVUVtlphlEqxyrKuCqwEJU5u', 'Bruixa Lola', 'lola@bruixa.com', 0, 0),
(7, 'CMortic1', '$2y$10$INKnMj/6gB96vQmzWCKgQOYGS/.ihLGNi19LOEGLVyYKjmS6w.2gO', 'Comptessa Morticia', 'morti@gmail.com', 0, 0),
(8, 'SabSpell', '$2y$10$RwzMSnMy8H2qczkByfDyOONmcF8rtLT1mUeMCRjWG9XFkt9VTyAs2', 'Sabrina Spellman', 'sabi@gmail.com', 0, 0),
(9, 'Prova10', '$2y$10$E0j11AEf.L407yDMK8S9O.iLzLSiqPhyitAU87zI376Y/MnAg5/h.', 'Annaseeeiiii', 'anna.escrisa@gmail.com', 0, 0),
(10, 'Merlin_from_Camelot', '$2y$10$.mT9A/SVGg2z5jl2TJ7rD.L1IT4eWakJgce4UgTehoA9Sitn6EQZS', 'Merlin', 'merle@gmail.com', 0, 0),
(12, 'DarkVader', '$2y$10$.dOGOiHxchixeJzUjGBjJOaEsFLp.WaHV31XbdvwZ4/UUho2vlacy', 'AnaKin', 'backendisthedarkside@gmail.com', 0, 0),
(13, 'LastJedi', '$2y$10$rMYlwHvL4hAaG4FOaSlqYecVWvLxjzRQG9TKtSLrFDDyX8l0Bt/wK', 'LukeSkywalker', 'backendisthedarkside@gmail.com', 0, 0),
(15, 'hola', '$2y$10$XQSHGFRyTkXUqG8hSosnkeqf5x02JP0.l9kMYK5DgaNKtr7AHD8E6', 'pepe', 'pepe@pepe.com', 0, 0),
(16, 'aaaaaaaaaa', '$2y$10$lfWv0rwnbFLygoZb7MGxJONWmsiYgkwZFZus.81FwQwweboXV4MmW', 'aaaaaa', 'aaa@aaa.com', 0, 0),
(17, 'sadge', '$2y$10$GKK1KrMlI6VsnWWQ4HunjuqfwVXBoxOjWoUdFCj2LKfwhDGhxTMkq', 'sadge', 'anna.escrisa@gmail.com', 0, 0),
(20, 'user6743306007b64', NULL, NULL, 'anna.escrisa@gmail.com', 1, 0),
(23, 'Hertoria', NULL, '', '', 1, 0),
(25, 'user674c9cfe14c57', NULL, NULL, '', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_codes`
--

CREATE TABLE `user_codes` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `expiration` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_codes`
--

INSERT INTO `user_codes` (`user_id`, `code`, `expiration`) VALUES
(9, 'bc9fc2e0decb51a5635e64444b1e97c01fef9e1f', 1733340530);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_likes`
--

CREATE TABLE `user_likes` (
  `user_fk` int(11) NOT NULL,
  `article_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_social_tokens`
--

CREATE TABLE `user_social_tokens` (
  `user_fk` int(11) NOT NULL,
  `social_id` varchar(50) DEFAULT NULL,
  `token` varchar(200) NOT NULL,
  `social` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `user_social_tokens`
--

INSERT INTO `user_social_tokens` (`user_fk`, `social_id`, `token`, `social`) VALUES
(20, '109094406', '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', 'GitHub'),
(23, 'FFEE5307-A3D8-FCA9-1FAD-8C987592D430', '693dc31b465f4ecdbafa9a241007561aa7fad8cd33748d8d0e', 'DeviantArt');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titol_UNIQUE` (`titol`);

--
-- Indices de la tabla `articles1`
--
ALTER TABLE `articles1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titol_UNIQUE` (`titol`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_user` (`user`);

--
-- Indices de la tabla `user_codes`
--
ALTER TABLE `user_codes`
  ADD PRIMARY KEY (`user_id`,`code`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `articles1`
--
ALTER TABLE `articles1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user_codes`
--
ALTER TABLE `user_codes`
  ADD CONSTRAINT `uc_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
