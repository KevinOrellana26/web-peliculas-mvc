-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-02-2025 a las 19:19:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `peliculas`
--
CREATE DATABASE IF NOT EXISTS `peliculas` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `peliculas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_pelicula` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id_pelicula` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripción` text NOT NULL,
  `anio` year(4) NOT NULL,
  `portada` varchar(255) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id_pelicula`, `titulo`, `descripción`, `anio`, `portada`, `categoria`) VALUES
(1, 'La Era de Hielo', 'Una aventura en un mundo prehistórico', '2002', 'la_era_de_hielo.jpg', 'Animación'),
(2, 'El Señor de los Anillos: La Comunidad del Anillo', 'El primer capítulo de una épica aventura', '2001', 'senor_de_los_anillos.jpg', 'Fantasía'),
(7, 'Spider-Man 2', 'Como si Peter Parker no tuviera suficiente con sus propios problemas, estudios y su amor por Mary Jane, ahora tiene que salvar a la ciudad de un nuevo villano, el Doctor Octopus.', '2004', 'portada_679a7634ad3724.67350380.jpg', 'Acción'),
(10, 'We Live in Time', 'We Live in Time es una película de drama romántico dirigida por John Crowley a partir de un guion de Nick Payne. La película usa una narrativa no lineal.', '2024', 'portada_679bfb072155e6.32308744.jpg', 'Romance'),
(11, 'Spider-Man: Across the Spider-Verse', 'Tras encontrarse con Gwen Stacy, el agradable vecindario de Brooklyn en el que vive Mike Morales se ve transportado al multiverso, donde Spiderman conocerá a nuevos personajes y vivirá aventuras increíbles.Tras encontrarse con Gwen Stacy, el agradable vecindario de Brooklyn en el que vive Mike Morales se ve transportado al multiverso, donde Spiderman conocerá a nuevos personajes y vivirá aventuras increíbles.', '2023', 'portada_679bfb49e1eb40.31056547.jpg', 'Animacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token_validacion`
--

CREATE TABLE `token_validacion` (
  `id` int(255) NOT NULL,
  `id_usuario` int(255) NOT NULL,
  `token` varchar(500) NOT NULL,
  `valido_hasta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(550) NOT NULL,
  `nombre_usuario` varchar(550) NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT 'default.jpg',
  `nivel_usuario` int(11) NOT NULL DEFAULT 1,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(500) NOT NULL,
  `validado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `nombre_usuario`, `contrasenya`, `foto_perfil`, `nivel_usuario`, `fecha_registro`, `email`, `validado`) VALUES
(2, 'joan', 'morales', 'joan', '$2y$10$W1D9EJWoK0C.YU8g23ejPusou1RX7Ya.uVKlIG.ITMItVJ4zHXS2e', 'perfil_679a56f04a7e64.43331986.jpg', 2, '2025-01-29 16:27:28', '', 0),
(3, 'joan', 'morales', 'joan2', '$2y$10$.TLDdI/MDSs5QoRx9761K.uvbOZWPFL/bpo.R5gJiqUFA0RaFq5VW', 'perfil_679a593c891af4.75390223.jpg', 1, '2025-01-29 16:37:16', '', 0),
(4, 'joan', 'morales', 'joan3', '$2y$10$RzjqvqDAAt0WoCMuFfFfEepnxj7oc88jF5pWYsIaEXxhLi.w8scIe', 'perfil_679e5828b52ca9.28225713.gif', 1, '2025-02-01 17:21:44', '', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_pelicula` (`id_pelicula`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id_pelicula`);

--
-- Indices de la tabla `token_validacion`
--
ALTER TABLE `token_validacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `token_validacion`
--
ALTER TABLE `token_validacion`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `token_validacion`
--
ALTER TABLE `token_validacion`
  ADD CONSTRAINT `FK_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
