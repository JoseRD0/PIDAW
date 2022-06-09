-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-06-2022 a las 04:43:19
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mymangatracker`
--
CREATE DATABASE IF NOT EXISTS `mymangatracker` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mymangatracker`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `idcomentario` int(11) NOT NULL AUTO_INCREMENT,
  `idPublicacion` int(11) NOT NULL,
  `contenidoComentario` longtext NOT NULL,
  `fechaComentario` timestamp NOT NULL,
  PRIMARY KEY (`idcomentario`),
  KEY `comentarioPublicacion_idx` (`idPublicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

DROP TABLE IF EXISTS `fotos`;
CREATE TABLE IF NOT EXISTS `fotos` (
  `idFoto` int(11) NOT NULL AUTO_INCREMENT,
  `nombreFoto` varchar(200) NOT NULL,
  `rutaFoto` varchar(255) NOT NULL,
  PRIMARY KEY (`idFoto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `idlike` int(11) NOT NULL AUTO_INCREMENT,
  `idPublicacion` int(11) NOT NULL,
  PRIMARY KEY (`idlike`),
  KEY `publiLikes_idx` (`idPublicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE IF NOT EXISTS `mensajes` (
  `idmensaje` int(11) NOT NULL AUTO_INCREMENT,
  `usuarios_idusuario` int(11) NOT NULL,
  `usuarioMando` int(11) NOT NULL,
  `contenido` longtext NOT NULL,
  `fechaMensaje` timestamp NOT NULL,
  PRIMARY KEY (`idmensaje`),
  KEY `fk_mensajes_usuarios1_idx` (`usuarios_idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `idnotificacion` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `tipoNotificaion` int(11) NOT NULL,
  PRIMARY KEY (`idnotificacion`),
  KEY `usuarioNotificacion_idx` (`idUsuario`),
  KEY `fk_notificaciones_tiposNotificaciones1_idx` (`tipoNotificaion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `idperfil` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idFoto` int(11) NOT NULL,
  `nombreCompleto` varchar(100) NOT NULL,
  PRIMARY KEY (`idperfil`),
  KEY `perfilUser_idx` (`idUsuario`),
  KEY `fotoUsuario_idx` (`idFoto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

DROP TABLE IF EXISTS `privilegios`;
CREATE TABLE IF NOT EXISTS `privilegios` (
  `idPerfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePrivilegio` varchar(100) NOT NULL,
  PRIMARY KEY (`idPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`idPerfil`, `nombrePrivilegio`) VALUES
(1, 'Administrador'),
(2, 'Estudiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

DROP TABLE IF EXISTS `publicaciones`;
CREATE TABLE IF NOT EXISTS `publicaciones` (
  `idpublicacion` int(11) NOT NULL AUTO_INCREMENT,
  `idUserPublico` int(11) NOT NULL,
  `contenidoPublicacion` longtext NOT NULL,
  `fechaPublicacion` timestamp NOT NULL,
  PRIMARY KEY (`idpublicacion`),
  KEY `publicacioesUser_idx` (`idUserPublico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposnotificaciones`
--

DROP TABLE IF EXISTS `tiposnotificaciones`;
CREATE TABLE IF NOT EXISTS `tiposnotificaciones` (
  `idtiposNotificaciones` int(11) NOT NULL AUTO_INCREMENT,
  `nombreTipo` varchar(60) NOT NULL,
  `mensajeNotificacion` longtext NOT NULL,
  PRIMARY KEY (`idtiposNotificaciones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idPrivilegio` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `priviUser_idx` (`idPrivilegio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarioPublicacion` FOREIGN KEY (`idPublicacion`) REFERENCES `publicaciones` (`idpublicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `publiLikes` FOREIGN KEY (`idPublicacion`) REFERENCES `publicaciones` (`idpublicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `fk_mensajes_usuarios1` FOREIGN KEY (`usuarios_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_notificaciones_tiposNotificaciones1` FOREIGN KEY (`tipoNotificaion`) REFERENCES `tiposnotificaciones` (`idtiposNotificaciones`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarioNotificacion` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `fotoUsuario` FOREIGN KEY (`idFoto`) REFERENCES `fotos` (`idFoto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `perfilUser` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicacioesUser` FOREIGN KEY (`idUserPublico`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `priviUser` FOREIGN KEY (`idPrivilegio`) REFERENCES `privilegios` (`idPerfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
