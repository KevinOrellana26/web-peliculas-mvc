CREATE DATABASE IF NOT EXISTS `peliculas` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `peliculas`;

-- TABLA: USUARIOS
CREATE TABLE `usuarios` (
    `id_usuario` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(40) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `foto_perfil` VARCHAR(255) DEFAULT 'default.jpg',
    `nivel_usuario` int(11) NOT NULL DEFAULT 0,     --0=invitado 1=general 2=admin
    `fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABLA: PELICULAS
CREATE TABLE `peliculas` (
    `id_pelicula` INT AUTO_INCREMENT PRIMARY KEY,
    `titulo` VARCHAR(255) NOT NULL,
    `descripción` TEXT NOT NULL,
    `anio` YEAR NOT NULL,
    `portada` VARCHAR(255) NOT NULL,
    `categoria` VARCHAR(100) NOT NULL
);

-- TABLA: COMENTARIOS
CREATE TABLE `comentarios` (
    `id_comentario` INT AUTO_INCREMENT PRIMARY KEY,
    `id_pelicula` INT NOT NULL,
    `id_usuario` INT NOT NULL,
    `contenido` TEXT NOT NULL,
    `fecha` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- CASCADE SIGNIFICA QUE SI SE ELIMINA UN USUARIO/PELICULA, TAMBIÉN SE ELIMINAN LOS COMENTARIOS ASOCIADOS A EL.
    FOREIGN KEY (`id_pelicula`) REFERENCES peliculas(id_pelicula) ON DELETE CASCADE, 
    FOREIGN KEY (`id_usuario`) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

-- INSERCION DE PELICULAS EN TABLA PELICULAS
INSERT INTO `peliculas` (`titulo`, `descripción`, `anio`, `portada`, `categoria`) VALUES 
('La Era de Hielo', 'Una aventura en un mundo prehistórico', 2002, 'la_era_de_hielo.jpg', 'Animación'),
('El Señor de los Anillos: La Comunidad del Anillo', 'El primer capítulo de una épica aventura', 2001, 'senor_de_los_anillos.jpg', 'Fantasía'),
('Avengers: Endgame', 'La lucha final contra Thanos para salvar el universo', 2019, 'avengers_endgame.jpg', 'Acción');