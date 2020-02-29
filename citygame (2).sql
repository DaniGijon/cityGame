-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-02-2020 a las 10:20:22
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `citygame`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrios`
--

DROP TABLE IF EXISTS `barrios`;
CREATE TABLE IF NOT EXISTS `barrios` (
  `idB` int(255) NOT NULL,
  `nombreBarrio` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcionInicio` varchar(2500) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idB`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `barrios`
--

INSERT INTO `barrios` (`idB`, `nombreBarrio`, `descripcionInicio`) VALUES
(1, 'Ca&ntilde;amares\r\n', 'Los vecinos de Ca&ntilde;amares tienen una visi&oacute;n privilegiada que han desarrollado a lo largo de generaciones. &lt;br&gt;Esa habilidad unida a un f&iacute;sico escurridizo convierte a estas personas en una buena opci&oacute;n inicial para adentrarse en los lugares m&aacute;s rec&oacute;nditos en busca de Aventuras, tesoros y fortuna.\r\n'),
(2, 'Libertad', 'El barrio Libertad siempre ha sido el hogar de ingeniosos comerciantes que manejan todo tipo de artes oscuras. Sus vecinos adem&aacute;s son fuertes de Esp&iacute;ritu debido al templo que dedican a su patr&oacute;n San Jos&eacute;.\r\n'),
(3, 'Constituci&oacute;n\r\n', 'El juego preferido de los ni&ntilde;os en el Barrio Constituci&oacute;n es disparar con el tirachinas. La Destreza manejando armas les hace buenos en combate y adem&aacute;s son &aacute;giles en movimiento.\r\n'),
(4, 'El Poblado', 'Los vecinos de El Poblado son en su mayor&iacute;a ingenieros o hijos de ellos. En definitiva, familias adineradas y con acceso al conocimiento industrial.\r\n'),
(5, 'Santa Ana', 'Habitan en la ladera del cerro Santa Ana y por naturaleza son personas resistentes, que suben cuestas con facilidad. Adem&aacute;s, sienten una fuerte devoci&oacute;n espiritual al ser una zona de origen salesiano.\r\n'),
(6, 'Centro Sur', 'En el Centro-Sur se aglomeran gran parte de las zonas ajardinadas de Puertollano. Sus vecinos son muy perceptivos y tambi&eacute;n tienen cierto Estilo.\r\n'),
(7, 'Las Mercedes', 'Aqu&iacute; impera la &quot;ley del m&aacute;s fuerte&quot;, por lo que la selecci&oacute;n natural ha dotado a estas personas de una Agilidad y Fuerza superior a la media.\r\n'),
(8, 'El Carmen', 'Vivir en las alturas ha dotado a los vecinos de El Carmen con una resistencia envidiable. Son adem&aacute;s personas muy avispadas, con gran sentido de la orientaci&oacute;n.\r\n'),
(9, 'Fraternidad', 'Los vecinos del barrio Fraternidad son los defensores del Muro en el norte. Esto requiere que sean fuertes y diestros con las armas.'),
(10, 'Ciudad Jard&iacute;n\r\n', 'Este bello y tranquilo paraje cuenta con s&oacute;lo unos pocos vecinos que viven apartados de todo el jaleo de la urbe. Son gente con gran Estilo y un buen poder adquisitivo.\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cacerias`
--

DROP TABLE IF EXISTS `cacerias`;
CREATE TABLE IF NOT EXISTS `cacerias` (
  `idP` int(11) NOT NULL,
  `idM` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`idP`,`idM`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cacerias`
--

INSERT INTO `cacerias` (`idP`, `idM`, `cantidad`) VALUES
(1, 94, 9),
(1, 96, 1),
(1, 81, 2),
(1, 90, 4),
(1, 89, 2),
(1, 88, 1),
(1, 208, 1),
(1, 33, 3),
(1, 34, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos`
--

DROP TABLE IF EXISTS `codigos`;
CREATE TABLE IF NOT EXISTS `codigos` (
  `clave` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `insignia` int(255) NOT NULL,
  PRIMARY KEY (`clave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `codigos`
--

INSERT INTO `codigos` (`clave`, `insignia`) VALUES
('pescanova', 31),
('bimbo', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coleccionismo`
--

DROP TABLE IF EXISTS `coleccionismo`;
CREATE TABLE IF NOT EXISTS `coleccionismo` (
  `idP` int(255) NOT NULL,
  `idO` int(255) NOT NULL,
  `imagen` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idP`,`idO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `coleccionismo`
--

INSERT INTO `coleccionismo` (`idP`, `idO`, `imagen`, `fecha`) VALUES
(1, 1001, '1001.png', '2019-06-20 20:12:48'),
(1, 302, '302.png', '2019-06-05 08:42:08'),
(1, 1000, '1000.png', '2019-04-16 18:57:18'),
(1, 105, '105.png', '2019-05-29 07:05:54'),
(1, 104, '104.png', '2019-05-26 12:36:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empenos`
--

DROP TABLE IF EXISTS `empenos`;
CREATE TABLE IF NOT EXISTS `empenos` (
  `idP` int(255) NOT NULL,
  `slot` int(255) NOT NULL,
  `idO` int(255) NOT NULL,
  PRIMARY KEY (`idP`,`slot`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `empenos`
--

INSERT INTO `empenos` (`idP`, `slot`, `idO`) VALUES
(1, 1, 307),
(1, 0, 103),
(1, 2, 104),
(1, 3, 314),
(1, 4, 1000),
(1, 5, 1001),
(1, 6, 907),
(1, 7, 314);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insignias`
--

DROP TABLE IF EXISTS `insignias`;
CREATE TABLE IF NOT EXISTS `insignias` (
  `idP` int(255) NOT NULL,
  `idI` int(255) NOT NULL,
  `imagen` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idP`,`idI`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `insignias`
--

INSERT INTO `insignias` (`idP`, `idI`, `imagen`, `fecha`) VALUES
(1, 21, '21.png', '2019-05-26 06:43:51'),
(1, 3, '3.png', '2019-04-17 00:21:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `idP` int(255) NOT NULL,
  `slot` int(255) NOT NULL,
  `idO` int(255) NOT NULL,
  PRIMARY KEY (`idP`,`slot`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`idP`, `slot`, `idO`) VALUES
(1, 0, 110),
(1, 1, 200),
(1, 2, 400),
(1, 3, 310),
(1, 4, 307),
(1, 5, 20),
(1, 6, 7),
(1, 7, 0),
(1, 8, 102),
(1, 9, 907),
(35, 0, 0),
(35, 1, 0),
(35, 2, 0),
(35, 3, 0),
(35, 4, 0),
(35, 5, 0),
(35, 6, 0),
(35, 7, 0),
(35, 8, 0),
(35, 9, 0),
(36, 0, 0),
(36, 1, 0),
(36, 2, 0),
(36, 3, 0),
(36, 4, 0),
(36, 5, 0),
(36, 6, 0),
(36, 7, 0),
(36, 8, 0),
(36, 9, 0),
(37, 0, 0),
(37, 1, 0),
(37, 2, 0),
(37, 3, 0),
(37, 4, 0),
(37, 5, 0),
(37, 6, 0),
(37, 7, 0),
(37, 8, 0),
(37, 9, 0),
(38, 0, 0),
(38, 1, 0),
(38, 2, 0),
(38, 3, 0),
(38, 4, 0),
(38, 5, 0),
(38, 6, 0),
(38, 7, 0),
(38, 8, 0),
(38, 9, 0),
(39, 0, 0),
(39, 1, 0),
(39, 2, 0),
(39, 3, 0),
(39, 4, 0),
(39, 5, 0),
(39, 6, 0),
(39, 7, 0),
(39, 8, 0),
(39, 9, 0),
(40, 0, 0),
(40, 1, 0),
(40, 2, 0),
(40, 3, 0),
(40, 4, 0),
(40, 5, 0),
(40, 6, 3),
(40, 7, 0),
(40, 8, 0),
(40, 9, 0),
(41, 0, 0),
(41, 1, 0),
(41, 2, 0),
(41, 3, 0),
(41, 4, 0),
(41, 5, 0),
(41, 6, 0),
(41, 7, 0),
(41, 8, 0),
(41, 9, 0),
(42, 0, 0),
(42, 1, 0),
(42, 2, 0),
(42, 3, 0),
(42, 4, 0),
(42, 5, 0),
(42, 6, 0),
(42, 7, 0),
(42, 8, 0),
(42, 9, 0),
(43, 0, 0),
(43, 1, 0),
(43, 2, 0),
(43, 3, 0),
(43, 4, 0),
(43, 5, 0),
(43, 6, 0),
(43, 7, 0),
(43, 8, 0),
(43, 9, 0),
(44, 0, 0),
(44, 1, 0),
(44, 2, 0),
(44, 3, 0),
(44, 4, 0),
(44, 5, 0),
(44, 6, 0),
(44, 7, 0),
(44, 8, 0),
(44, 9, 0),
(45, 0, 0),
(45, 1, 200),
(45, 2, 0),
(45, 3, 0),
(45, 4, 0),
(45, 5, 0),
(45, 6, 0),
(45, 7, 0),
(45, 8, 0),
(45, 9, 0),
(46, 0, 0),
(46, 1, 0),
(46, 2, 0),
(46, 3, 0),
(46, 4, 0),
(46, 5, 0),
(46, 6, 0),
(46, 7, 0),
(46, 8, 0),
(46, 9, 0),
(47, 0, 0),
(47, 1, 0),
(47, 2, 0),
(47, 3, 0),
(47, 4, 0),
(47, 5, 0),
(47, 6, 0),
(47, 7, 0),
(47, 8, 0),
(47, 9, 0),
(48, 0, 0),
(48, 1, 0),
(48, 2, 0),
(48, 3, 0),
(48, 4, 0),
(48, 5, 0),
(48, 6, 0),
(48, 7, 0),
(48, 8, 0),
(48, 9, 0),
(49, 0, 0),
(49, 1, 0),
(49, 2, 0),
(49, 3, 0),
(49, 4, 0),
(49, 5, 0),
(49, 6, 0),
(49, 7, 0),
(49, 8, 0),
(49, 9, 0),
(50, 0, 0),
(50, 1, 0),
(50, 2, 0),
(50, 3, 0),
(50, 4, 0),
(50, 5, 0),
(50, 6, 0),
(50, 7, 0),
(50, 8, 0),
(50, 9, 0),
(1, 10, 928),
(1, 14, 7),
(1, 15, 401),
(51, 0, 0),
(51, 1, 0),
(51, 2, 0),
(51, 3, 0),
(51, 4, 0),
(51, 5, 0),
(51, 6, 0),
(51, 7, 0),
(51, 8, 0),
(51, 9, 0),
(52, 0, 0),
(52, 1, 0),
(52, 2, 0),
(52, 3, 0),
(52, 4, 0),
(52, 5, 0),
(52, 6, 0),
(52, 7, 0),
(52, 8, 0),
(52, 9, 0),
(53, 0, 0),
(53, 1, 0),
(53, 2, 0),
(53, 3, 0),
(53, 4, 0),
(53, 5, 0),
(53, 6, 0),
(53, 7, 0),
(53, 8, 0),
(53, 9, 0),
(1, 11, 313),
(1, 12, 22),
(1, 13, 300),
(1, 16, 3),
(1, 17, 901),
(1, 18, 506),
(1, 19, 109);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jackpots`
--

DROP TABLE IF EXISTS `jackpots`;
CREATE TABLE IF NOT EXISTS `jackpots` (
  `id` int(255) NOT NULL,
  `cantidad` int(255) NOT NULL,
  `nombre` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `jackpots`
--

INSERT INTO `jackpots` (`id`, `cantidad`, `nombre`) VALUES
(1, 1127, 'luckia'),
(2, 1471, 'joker');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE IF NOT EXISTS `mensajes` (
  `idM` int(255) NOT NULL AUTO_INCREMENT,
  `idP` int(255) NOT NULL,
  `asunto` varchar(2500) COLLATE utf8_spanish_ci NOT NULL,
  `contenido` varchar(2500) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `leido` int(255) NOT NULL DEFAULT '0',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idM`)
) ENGINE=MyISAM AUTO_INCREMENT=703 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`idM`, `idP`, `asunto`, `contenido`, `imagen`, `leido`, `fecha`) VALUES
(564, 51, 'Emboscada', 'Ã¡Ã©Ã­Ã³ÃºÃ±!ÃÃ‰ÃÃ“Ãš En el silencio de la noche, casanova camina apresuradamente de camino a casa. Al pasar por delante de un montÃ³n de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es la sombra de un bate de bÃ©isbol empuÃ±ado por daniTest.<br>Â¡Comienza la Batalla!<br>Cuando al fÃ­n cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de casanova herido, mientras daniTest huye de la escena con un botÃ­n de 25 Monedas y 2 Puntos de Respeto que casanova echarÃ¡ en falta.', 'emboscada.png', 0, '2019-07-22 07:35:48'),
(581, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-08-14 10:00:05'),
(571, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-07-28 10:14:02'),
(532, 52, 'Bienvenida', 'Dar la bienvenida al juego y explicar un poco', 'bienvenida.png', 0, '2019-06-27 16:52:59'),
(533, 53, 'Bienvenida', 'Dar la bienvenida al juego y explicar un poco', 'bienvenida.png', 0, '2019-06-27 16:53:33'),
(544, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.2 puntos. Ahora tengo un 1.7% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-07-04 10:00:02'),
(545, 1, 'Emboscada', 'En el silencio de la noche, sweet camina apresuradamente de camino a casa. Al pasar por delante de un montÃ³n de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es la sombra de un bate de bÃ©isbol empuÃ±ado por daniTest.<br>Â¡Comienza la Batalla!<br>Cuando al fÃ­n cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de sweet herido, mientras daniTest huye de la escena con un botÃ­n de 3 Monedas y 8 Puntos de Respeto que sweet echarÃ¡ en falta.', 'emboscada.png', 1, '2019-07-04 19:02:55'),
(279, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.2 puntos. Ahora tengo un 4.9% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-06-04 10:00:06'),
(573, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-08-05 11:07:18'),
(614, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -3.4 puntos. Ahora tengo un 28.8% de reconocimiento entre mis vecinos.', 'deterioro.png', 1, '2019-10-12 10:00:04'),
(575, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-08-09 10:00:04'),
(165, 42, 'Emboscada', 'En el silencio de la noche, sweet camina apresuradamente de camino a casa. Al pasar por delante de un montÃ³n de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es el caÃ±Ã³n de una Desert Eagle 12.7mm empuÃ±ada por daniTest.<br>Â¡Comienza la Batalla!<br>Cuando al fÃ­n cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de sweet herido, mientras daniTest huye de la escena con un botÃ­n de 22 Monedas y 3 Puntos de Respeto que sweet echarÃ¡ en falta.', 'emboscada.png', 0, '2019-05-03 07:56:54'),
(166, 44, 'Bienvenida', 'Dar la bienvenida al juego y explicar un poco', 'bienvenida.png', 0, '2019-05-03 08:22:30'),
(167, 45, 'Bienvenida', 'Dar la bienvenida al juego y explicar un poco', 'bienvenida.png', 1, '2019-05-03 15:39:48'),
(168, 46, 'Bienvenida', 'Dar la bienvenida al juego y explicar un poco', 'bienvenida.png', 0, '2019-05-03 15:39:58'),
(169, 47, 'Bienvenida', 'Dar la bienvenida al juego y explicar un poco', 'bienvenida.png', 0, '2019-05-03 16:40:23'),
(261, 41, 'Deterioro Popularidad', 'Mi Popularidad en Puertollano ha caÃ­do ', 'bienvenida.png', 0, '2019-05-29 11:35:28'),
(275, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.6 puntos. Ahora tengo un 5.1% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-06-03 10:00:03'),
(263, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.4 puntos. Ahora tengo un 7.1000% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-05-29 11:37:25'),
(171, 2, 'Emboscada', 'En el silencio de la noche, pepe camina apresuradamente de camino a casa. Al pasar por delante de un montÃ³n de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es el caÃ±Ã³n de una Desert Eagle 12.7mm empuÃ±ada por daniTest.<br>Â¡Comienza la Batalla!<br>Cuando al fÃ­n cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de pepe herido, mientras daniTest huye de la escena con un botÃ­n de 93 Monedas y 18 Puntos de Respeto que pepe echarÃ¡ en falta.', 'emboscada.png', 0, '2019-05-03 17:38:26'),
(128, 16, 'Resultado Survival', 'Gana vale', 'survival.png', 0, '2019-05-01 13:24:43'),
(129, 21, 'Resultado Survival', 'Gana vale', 'survival.png', 0, '2019-05-01 13:24:43'),
(131, 26, 'Resultado Survival', 'Gana mimimimimim', 'survival.png', 0, '2019-05-01 13:29:46'),
(132, 27, 'Resultado Survival', 'Gana mimimimimim', 'survival.png', 0, '2019-05-01 13:29:46'),
(265, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -1.4 puntos. Ahora tengo un 5.7% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-05-29 11:38:35'),
(615, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-10-12 10:00:04'),
(142, 43, 'Bienvenida', 'Dar la bienvenida al juego y explicar un poco', 'bienvenida.png', 1, '2019-05-01 14:26:47'),
(407, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.8 puntos. Ahora tengo un 5.9% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-06-17 10:00:02'),
(569, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-07-24 10:01:37'),
(552, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.8 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-07-08 10:00:02'),
(266, 45, 'Aventura', 'Me enfrento a un Ardilla de los Pinos Furiosa ... Toma ya! He derrotado al monstruo y gano 19 EXP. <br> Mi respeto sube 2 puntos.<br>El monstruo llevaba una bolsita. La abro y miro dentro. Consigo 21 monedas.<br> Le arrebato un objeto que llevaba consigo: Blusa rasgada', '1.png', 1, '2019-05-29 12:13:32'),
(605, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -6.3 puntos. Ahora tengo un 43.7% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-09-08 10:00:04'),
(550, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0.8% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-07-07 10:00:04'),
(173, 2, 'Emboscada', 'En el silencio de la noche, pepe camina apresuradamente de camino a casa. Al pasar por delante de un montÃ³n de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es el caÃ±Ã³n de una Desert Eagle 12.7mm empuÃ±ada por daniTest.<br>Â¡Comienza la Batalla!<br>Cuando al fÃ­n cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de pepe herido, mientras daniTest huye de la escena con un botÃ­n de 45 Monedas y 19 Puntos de Respeto que pepe echarÃ¡ en falta.', 'emboscada.png', 0, '2019-05-03 17:39:15'),
(259, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.1 puntos. Ahora tengo un 7.5000% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-05-29 11:35:28'),
(177, 48, 'Bienvenida', 'Dar la bienvenida al juego y explicar un poco', 'bienvenida.png', 1, '2019-05-03 21:52:40'),
(611, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-09-15 10:00:04'),
(181, 49, 'Bienvenida', 'Dar la bienvenida al juego y explicar un poco', 'bienvenida.png', 0, '2019-05-04 12:48:34'),
(182, 50, 'Bienvenida', 'Dar la bienvenida al juego y explicar un poco', 'bienvenida.png', 0, '2019-05-04 16:48:13'),
(606, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-09-08 10:00:04'),
(548, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.9 puntos. Ahora tengo un 0.8% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-07-06 17:35:31'),
(422, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.6 puntos. Ahora tengo un 5.3% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-06-18 10:00:04'),
(553, 1, 'MisiÃ³n Cumplida', 'Â¡Has completado la Etapa 1 de la misiÃ³n <i>Por Viejo o por Diablo</i>!<br>Al poner ese dinero, te inscribes junto con tu compaÃ±ero para participar en el torneo de Petanca que tanta ilusiÃ³n le hace al hombre. Â¡Espero que merezca la pena!<br>Ganas +25 EXP. Â¡Bien hecho!', 'etapa.png', 1, '2019-07-08 16:45:41'),
(612, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -4.2 puntos. Ahora tengo un 32.2% de reconocimiento entre mis vecinos.', 'deterioro.png', 1, '2019-09-22 10:00:04'),
(608, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -3.7 puntos. Ahora tengo un 40% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-09-09 10:13:49'),
(609, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-09-09 10:13:49'),
(431, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.9 puntos. Ahora tengo un 4.4% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-06-20 11:47:40'),
(546, 42, 'Emboscada', 'Ã¡Ã©Ã­Ã³ÃºÃ±!ÃÃ‰ÃÃ“Ãš En el silencio de la noche, sweet camina apresuradamente de camino a casa. Al pasar por delante de un montÃ³n de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es la sombra de un bate de bÃ©isbol empuÃ±ado por daniTest.<br>Â¡Comienza la Batalla!<br>Cuando al fÃ­n cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de sweet herido, mientras daniTest huye de la escena con un botÃ­n de 3 Monedas y 8 Puntos de Respeto que sweet echarÃ¡ en falta.', 'emboscada.png', 0, '2019-07-04 19:02:55'),
(554, 1, 'Cobro', 'Â¡AquÃ­ estÃ¡ el cobro por 1 hora de duro trabajo! Ahora mi bolsillo pesa un poco mÃ¡s, exactamente 100 monedas mÃ¡s.', 'cobro.png', 1, '2019-07-09 07:07:55'),
(607, 1, 'CerrajerÃ­a', 'El dependiente pasa largo rato mirando la caja bloqueada... parece estar pensando. Al fin entra a la trastienda a por las herramientas. Se escucha cÃ³mo pronuncia unas palabras mÃ¡gicas Â¡a la vez que saca una maza! Un instante despuÃ©s, la caja estÃ¡ abierta ante tus ojos. Consigues su contenido : Bolsa de Rafia', 'cerrajeria.png', 0, '2019-09-08 10:46:03'),
(556, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-07-12 10:39:38'),
(603, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-09-05 10:00:03'),
(558, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-07-14 10:00:04'),
(604, 1, 'CerrajerÃ­a', 'El dependiente pasa largo rato mirando la caja bloqueada... parece estar pensando. Al fin entra a la trastienda a por las herramientas. Se escucha cÃ³mo pronuncia unas palabras mÃ¡gicas Â¡a la vez que saca una maza! Un instante despuÃ©s, la caja estÃ¡ abierta ante tus ojos. Consigues su contenido : Pulsera Luminosa', 'cerrajeria.png', 1, '2019-09-06 08:10:20'),
(560, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-07-16 10:00:02'),
(610, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -3.6 puntos. Ahora tengo un 36.4% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-09-15 10:00:04'),
(268, 47, 'Emboscada', 'Ã¡Ã©Ã­Ã³ÃºÃ±!ÃÃ‰ÃÃ“Ãš En el silencio de la noche, vanvan camina apresuradamente de camino a casa. Al pasar por delante de un montÃ³n de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es el caÃ±Ã³n de una Desert Eagle 12.7mm empuÃ±ada por daniTest.<br>Â¡Comienza la Batalla!<br>Cuando al fÃ­n cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de vanvan herido, mientras daniTest huye de la escena con un botÃ­n de 21 Monedas y 3 Puntos de Respeto que vanvan echarÃ¡ en falta.', 'emboscada.png', 0, '2019-05-31 14:08:37'),
(567, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-07-22 10:00:07'),
(270, 34, 'Emboscada', 'Ã¡Ã©Ã­Ã³ÃºÃ±!ÃÃ‰ÃÃ“Ãš En el silencio de la noche, abuelo camina apresuradamente de camino a casa. Al pasar por delante de un montÃ³n de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es la sombra de un bate de bÃ©isbol empuÃ±ado por daniTest.<br>Â¡Comienza la Batalla!<br>Cuando al fÃ­n cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de abuelo herido, mientras daniTest huye de la escena con un botÃ­n de 15 Monedas y 6 Puntos de Respeto que abuelo echarÃ¡ en falta.', 'emboscada.png', 0, '2019-05-31 14:57:48'),
(616, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -4.8 puntos. Ahora tengo un 24% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-10-13 10:00:05'),
(577, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-08-12 10:05:15'),
(579, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-08-13 10:00:04'),
(303, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -1 puntos. Ahora tengo un 3.9% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-06-05 10:00:02'),
(670, 1, 'CerrajerÃ­a', 'El dependiente pasa largo rato mirando la caja bloqueada... parece estar pensando. Al fin entra a la trastienda a por las herramientas. Se escucha cÃ³mo pronuncia unas palabras mÃ¡gicas Â¡a la vez que saca una maza! Golpea la cerradura y un instante despuÃ©s la caja estÃ¡ abierta ante tus ojos. Consigues su contenido : Navaja', 'cerrajeria.png', 1, '2019-12-29 15:33:31'),
(671, 1, 'CerrajerÃ­a', 'Te preguntas, Â¿cÃ³mo va a hacer para abrir la caja? De repente saca un hacha, apunta sobre la cerradura y... Â¡CRASH! la cajita ya no estÃ¡ bloqueada. Consigues su contenido : Bolsa de Rafia', 'cerrajeria.png', 1, '2019-12-29 15:39:49'),
(586, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-08-21 10:00:04'),
(617, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-10-13 10:00:05'),
(613, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-09-22 10:00:04'),
(589, 1, 'Aventura', 'Me enfrento a un Mono Callejero ... Toma ya! He derrotado al monstruo y gano 19 EXP. <br> Mi respeto sube 4 puntos.<br>El monstruo llevaba una bolsita. La abro y miro dentro. Consigo 21 monedas.<br> Le arrebato un objeto que llevaba consigo: Sand&iacute;a Hermosa. No puedo llevarme el botÃ­n porque mi inventario estÃ¡ lleno.', '', 1, '2019-08-21 15:57:57'),
(590, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -4 puntos. Ahora tengo un 71.7% de reconocimiento entre mis vecinos.', 'deterioro.png', 1, '2019-08-26 10:39:48'),
(591, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-08-26 10:39:48'),
(592, 1, 'Mejora de Habilidad', 'Necesitaba contÃ¡rselo a alguien, es asÃ­. Me siento ahora con el EspÃ­ritu mÃ¡s tranquilo por fÃ­n.<br><br>He mejorado 0.05 puntos de EspÃ­ritu.', 'rezo.png', 1, '2019-08-26 13:36:49'),
(593, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -5.6 puntos. Ahora tengo un 66.1% de reconocimiento entre mis vecinos.', 'deterioro.png', 1, '2019-08-27 10:00:03'),
(594, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-08-27 10:00:03'),
(595, 1, 'Popularidad', 'El PregÃ³n ha sido todo un Ã©xito y los habitantes de todo Puertollano hablan mejor de mÃ­ ahora mismo.<br>Mi Popularidad asciende un poquito en cada zona de Puertollano. Tengo un 71% de valoraciÃ³n positiva.', 'popularidad.png', 1, '2019-08-27 10:13:45'),
(596, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -5.8 puntos. Ahora tengo un 65.2% de reconocimiento entre mis vecinos.', 'deterioro.png', 1, '2019-08-28 10:00:04'),
(597, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-08-28 10:00:04'),
(598, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -6.4 puntos. Ahora tengo un 58.8% de reconocimiento entre mis vecinos.', 'deterioro.png', 1, '2019-08-29 10:00:04'),
(599, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-08-29 10:00:04'),
(600, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -4.9 puntos. Ahora tengo un 53.9% de reconocimiento entre mis vecinos.', 'deterioro.png', 1, '2019-08-30 10:00:05'),
(601, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-08-30 10:00:05'),
(618, 1, 'CerrajerÃ­a', 'El dependiente pasa largo rato mirando la caja bloqueada... parece estar pensando. Al fin entra a la trastienda a por las herramientas. Se escucha cÃ³mo pronuncia unas palabras mÃ¡gicas Â¡a la vez que saca una maza! Un instante despuÃ©s, la caja estÃ¡ abierta ante tus ojos. Consigues su contenido : Blusa rasgada', 'cerrajeria.png', 1, '2019-10-14 21:36:25'),
(619, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -6 puntos. Ahora tengo un 18% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-10-20 10:00:03'),
(620, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-10-20 10:00:03'),
(621, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -4.9 puntos. Ahora tengo un 13.1% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-10-27 11:00:04'),
(622, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-10-27 11:00:04'),
(623, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -4.7 puntos. Ahora tengo un 8.4% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-12-24 11:20:04'),
(624, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-12-24 11:20:04'),
(625, 1, 'Rebuscar', 'Â¡Anda! Alguien ha perdido su cambio por aquÃ­. Obtengo 76 monedas.', 'rebuscar.png', 1, '2019-12-24 20:21:51'),
(626, 1, 'Aventura', 'pescar', '', 1, '2019-12-29 09:11:56'),
(627, 1, 'Pesca', 'Â¡EEEH! Han mordido el anzuelo, Â¡cacho pez cÃ³mo tira!  Lo devolverÃ© al agua, porque mi inventario estÃ¡ lleno.', 'pescar.png', 1, '2019-12-29 09:13:14'),
(628, 1, 'Aventura', 'pescar', '', 0, '2019-12-29 09:13:14'),
(629, 1, 'Pesca', 'Â¡EEEH! Han mordido el anzuelo, Â¡cacho pez cÃ³mo tira!  Â¡Meeee lo llevo!', 'pescar.png', 1, '2019-12-29 09:13:46'),
(630, 1, 'Aventura', 'pescar', '', 0, '2019-12-29 09:13:46'),
(631, 1, 'Pesca', 'Â¡EEEH! Han mordido el anzuelo, Â¡cacho pez cÃ³mo tira!  Lo devolverÃ© al agua, porque mi inventario estÃ¡ lleno.\n\nObtengo 1x Pescado Crudo', 'pescar.png', 1, '2019-12-29 09:15:02'),
(632, 1, 'Aventura', 'pescar', '', 0, '2019-12-29 09:15:02'),
(633, 1, 'Pesca', 'Â¡EEEH! Han mordido el anzuelo, Â¡cacho pez cÃ³mo tira!  Â¡Meeee lo llevo! \n\nObtengo 1x Pescado Crudo', 'pescar.png', 1, '2019-12-29 09:15:59'),
(634, 1, 'Aventura', 'pescar', '', 1, '2019-12-29 09:15:59'),
(635, 1, 'Pescar', 'Â¡Anda! Al recoger sedal vienen unas monedas enganchadas al anzuelo. Â¿SerÃ¡ que hay un tesoro hundido ahÃ­ abajo? Obtengo 20 monedas.', 'rebuscar.png', 1, '2019-12-29 09:29:23'),
(636, 1, 'Aventura', 'pescar', '', 1, '2019-12-29 09:29:23'),
(637, 1, 'Pescar', 'Â¡Anda! Al recoger sedal vienen unas monedas enganchadas al anzuelo. Â¿SerÃ¡ que hay un tesoro hundido ahÃ­ abajo? Obtengo 44 monedas.', 'rebuscar.png', 1, '2019-12-29 10:46:18'),
(638, 1, 'Aventura', 'pescar', '', 0, '2019-12-29 10:46:18'),
(639, 1, 'Pesca', 'Algo se ha enganchado al anzuelo.  Â¡Anda! es un pequeÃ±o cofre, y pesa lo suyo.  \n\nObtengo 1x Cofre pequeÃ±o de metal', 'pescar.png', 1, '2019-12-29 10:46:53'),
(640, 1, 'Aventura', 'pescar', '', 0, '2019-12-29 10:46:53'),
(641, 1, 'Pesca', 'Algo se ha enganchado al anzuelo.  Â¡Oh! la madera estÃ¡ algo podrida pero el cofre parece intacto.  \n\nObtengo 1x Cofre pequeÃ±o de madera', 'pescar.png', 1, '2019-12-29 10:47:14'),
(642, 1, 'Aventura', 'pescar', '', 0, '2019-12-29 10:47:14'),
(643, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -2.7 puntos. Ahora tengo un 5.7% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-12-29 11:00:04'),
(644, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-12-29 11:00:04'),
(645, 1, 'Pesca', 'Â¡AYYY! Han mordido el anzuelo y sea lo que sea Â¡estÃ¡ gordÃ­simo!...  Â¡Hola Teniii! \n\nObtengo 1x Tenacitas', 'pescar.png', 1, '2019-12-29 11:09:29'),
(646, 1, 'Aventura', 'pescar', '', 0, '2019-12-29 11:09:29'),
(647, 1, 'Pesca', 'Â¡AYYY! Han mordido el anzuelo y sea lo que sea Â¡estÃ¡ gordÃ­simo!...  Lo devolverÃ© al agua, porque mi inventario estÃ¡ lleno.', 'pescar.png', 0, '2019-12-29 11:12:04'),
(648, 1, 'Aventura', 'pescar', '', 1, '2019-12-29 11:12:04'),
(649, 1, 'Pesca', 'Â¡AYYY! Han mordido el anzuelo y sea lo que sea Â¡estÃ¡ gordÃ­simo!...  Lo devolverÃ© al agua, porque mi inventario estÃ¡ lleno.', 'pescar.png', 0, '2019-12-29 11:14:25'),
(650, 1, 'Pesca', 'Â¡AYYY! Han mordido el anzuelo y sea lo que sea Â¡estÃ¡ gordÃ­simo!...  Lo devolverÃ© al agua, porque mi inventario estÃ¡ lleno.', 'pescar.png', 1, '2019-12-29 11:14:57'),
(651, 1, 'Pesca', 'No pican...', 'pescar.png', 1, '2019-12-29 11:17:20'),
(652, 1, 'Pesca', 'No pican...', 'pescar.png', 1, '2019-12-29 11:17:35'),
(653, 1, 'Pesca', 'No pican...', 'pescar.png', 1, '2019-12-29 11:17:42'),
(654, 1, 'Pesca', 'No pican...', 'pescar.png', 1, '2019-12-29 11:17:52'),
(655, 1, 'Pesca', 'Â¡EEEH! Han mordido el anzuelo, Â¡cacho pez cÃ³mo tira!  Lo devolverÃ© al agua, porque mi inventario estÃ¡ lleno.', 'pescar.png', 1, '2019-12-29 11:17:59'),
(656, 1, 'Pesca', 'No pican...', 'pescar.png', 1, '2019-12-29 11:22:19'),
(657, 1, 'MisiÃ³n Aceptada', 'Acabas de aceptar la misiÃ³n <i>Buscando a Tenacitas</i>.<br>Su dueÃ±a dice que les atacaron en el <b>Estanque de Patos</b> y ya no volviÃ³ a saber nada mÃ¡s de la pobre criaturita. Â¿QuÃ© tal si empiezo a buscar por allÃ­?', 'subirNivel.png', 1, '2019-12-29 13:15:51'),
(658, 1, 'MisiÃ³n Aceptada', 'Acabas de aceptar la misiÃ³n <i>Buscando a Tenacitas</i>.<br>Su dueÃ±a dice que les atacaron en el <b>Estanque de Patos</b> y ya no volviÃ³ a saber nada mÃ¡s de la pobre criaturita. Â¿QuÃ© tal si empiezo a buscar por allÃ­?', 'subirNivel.png', 0, '2019-12-29 13:18:04'),
(367, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.5 puntos. Ahora tengo un 3.4% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-06-07 10:00:02'),
(673, 1, 'CerrajerÃ­a', 'El cofrecito estÃ¡ tan oxidado que cuando el dependiente lo lanza contra la pared, se abre con facilidad. Consigues su contenido : Queso Especiado', 'cerrajeria.png', 1, '2019-12-29 16:22:44'),
(674, 1, 'CerrajerÃ­a', 'El dependiente mira al cofre de madera con la misma cara que yo mirarÃ­a a un cubo de rubik. Mejor me lo llevo a otro sitio, este tÃ­o no tiene ni id.... Â¡Ostras! Â¡Â¿Acaba de sacar una sierra?!... Lo es. Â¡Cofre abierto! Consigues su contenido : Queso Especiado', 'cerrajeria.png', 1, '2019-12-29 18:56:13'),
(675, 1, 'CerrajerÃ­a', 'El dependiente mira al cofre de madera con la misma cara que yo mirarÃ­a a un cubo de rubik. Mejor me lo llevo a otro sitio, este tÃ­o no tiene ni id.... Â¡Ostras! Â¡Â¿Acaba de sacar una sierra?!... Lo es. Â¡Cofre abierto! Consigues su contenido : Gafas de Intelectual', 'cerrajeria.png', 1, '2019-12-29 19:07:08'),
(495, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.8 puntos. Ahora tengo un 3.6% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-06-23 10:00:05'),
(676, 1, 'CerrajerÃ­a', 'Un cofre de metal ya estÃ¡ listo para darse su baÃ±o en Ã¡cido nÃ­trico. Â¡Cofre abierto! Consigues su contenido : Alfombra M&aacute;gica', 'cerrajeria.png', 1, '2019-12-29 19:15:53'),
(677, 1, 'CerrajerÃ­a', 'Â¡Vaya! Este cofre es grandote. El dependiente te pide ayuda para entre los dos poner un buen cinturÃ³n de petardos que enseguida volarÃ¡n esa cerradura. Â¡Cofre abierto! Consigues su contenido : Macuto de Acampar', 'cerrajeria.png', 1, '2019-12-29 19:23:10'),
(678, 1, 'CerrajerÃ­a', 'Â¡CuÃ¡nta pedrerÃ­a! Este es sin duda un trabajo para mi mujer. Â¡MARÃAAAA, ven pa acÃ¡! Al cabo de un rato viene la mujer, que empieza a quitar las piedras preciosas como si no hubiera un maÃ±ana. Con tanta ansia araÃ±a la MarÃ­a que hace un agujero en la estructura del cofre. Â¡Cofre abierto! Consigues su contenido : Halc&oacute;n Milenario', 'cerrajeria.png', 1, '2019-12-29 19:47:22'),
(679, 1, 'Pesca', 'No pican...', 'pescar.png', 1, '2019-12-29 19:51:46'),
(680, 1, 'CerrajerÃ­a', 'Una cajita tan oxidada podrÃ­a deshacerse al minimo contacto, espero que la trate con delicadeza. El dependiente mira la caja bloqueada... parece estar pensando. Al fin entra a la trastienda a por sus herramientas y un instante despuÃ©s, vuelve con una maza. Â¡Â¡POMMM!! la cajita se abre ante tus ojos. Consigues su contenido : Pieza de Fruta Fresca', 'cerrajeria.png', 0, '2019-12-29 19:53:56'),
(681, 1, 'CerrajerÃ­a', 'Una cajita tan oxidada podrÃ­a deshacerse al minimo contacto, espero que la trate con delicadeza. El dependiente mira la caja bloqueada... parece estar pensando. Al fin entra a la trastienda a por sus herramientas y un instante despuÃ©s, vuelve con una maza. Â¡Â¡POMMM!! la cajita se abre ante tus ojos. Consigues su contenido : Pieza de Fruta Fresca', 'cerrajeria.png', 0, '2019-12-29 19:55:17'),
(682, 1, 'CerrajerÃ­a', 'Una cajita tan oxidada podrÃ­a deshacerse al minimo contacto, espero que la trate con delicadeza. El dependiente mira la caja bloqueada... parece estar pensando. Al fin entra a la trastienda a por sus herramientas y un instante despuÃ©s, vuelve con una maza. Â¡Â¡POMMM!! la cajita se abre ante tus ojos. Consigues su contenido : Pieza de Fruta Fresca', 'cerrajeria.png', 1, '2019-12-29 20:00:38'),
(683, 1, 'Aventura', 'Necesito una CaÃ±a para pescar y un poco de energÃ­a para tirar con fuerza.', '', 1, '2019-12-29 20:31:39'),
(684, 1, 'Aventura', 'Necesito una CaÃ±a para pescar y un poco de energÃ­a para tirar con fuerza.', '', 1, '2019-12-29 20:32:30'),
(685, 1, 'Pesca', 'Necesito una CaÃ±a para pescar y un poco de energÃ­a para tirar con fuerza.', 'pescar.png', 1, '2019-12-29 20:36:06'),
(686, 1, 'Pesca', 'Â¡EEEH! Han mordido el anzuelo, Â¡cacho pez cÃ³mo tira!  Lo devolverÃ© al agua, porque mi inventario estÃ¡ lleno.', 'pescar.png', 1, '2019-12-29 20:36:27'),
(687, 1, 'Pesca', 'Â¡EEEH! Han mordido el anzuelo, Â¡cacho pez cÃ³mo tira!  Lo devolverÃ© al agua, porque mi inventario estÃ¡ lleno.', 'pescar.png', 1, '2019-12-29 20:37:43'),
(688, 1, 'Emboscada', 'En el silencio de la noche, vale camina apresuradamente de camino a casa. Al pasar por delante de un montÃ³n de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es la sombra de un bate de bÃ©isbol empuÃ±ado por daniTest.<br>Â¡Comienza la Batalla!<br>Cuando al fÃ­n cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de vale herido, mientras daniTest huye de la escena con un botÃ­n de 34 Monedas y 8 Puntos de Respeto que vale echarÃ¡ en falta.', 'emboscada.png', 1, '2020-02-03 15:27:16'),
(383, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.3 puntos. Ahora tengo un 6.7% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-06-16 10:01:42'),
(689, 16, 'Emboscada', 'Ã¡Ã©Ã­Ã³ÃºÃ±!ÃÃ‰ÃÃ“Ãš En el silencio de la noche, vale camina apresuradamente de camino a casa. Al pasar por delante de un montÃ³n de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es la sombra de un bate de bÃ©isbol empuÃ±ado por daniTest.<br>Â¡Comienza la Batalla!<br>Cuando al fÃ­n cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de vale herido, mientras daniTest huye de la escena con un botÃ­n de 34 Monedas y 8 Puntos de Respeto que vale echarÃ¡ en falta.', 'emboscada.png', 0, '2020-02-03 15:27:16'),
(690, 1, 'Emboscada', 'En el silencio de la noche, vale camina apresuradamente de camino a casa. Al pasar por delante de un montÃ³n de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es la sombra de un bate de bÃ©isbol empuÃ±ado por daniTest.<br>Â¡Comienza la Batalla!<br>Cuando al fÃ­n cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de vale herido, mientras daniTest huye de la escena con un botÃ­n de 35 Monedas y 7 Puntos de Respeto que vale echarÃ¡ en falta.', 'emboscada.png', 1, '2020-02-03 15:28:49'),
(691, 16, 'Emboscada', 'Ã¡Ã©Ã­Ã³ÃºÃ±!ÃÃ‰ÃÃ“Ãš En el silencio de la noche, vale camina apresuradamente de camino a casa. Al pasar por delante de un montÃ³n de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es la sombra de un bate de bÃ©isbol empuÃ±ado por daniTest.<br>Â¡Comienza la Batalla!<br>Cuando al fÃ­n cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de vale herido, mientras daniTest huye de la escena con un botÃ­n de 35 Monedas y 7 Puntos de Respeto que vale echarÃ¡ en falta.', 'emboscada.png', 0, '2020-02-03 15:28:49'),
(702, 1, 'MisiÃ³n Aceptada', 'Â¡Has aceptado la MisiÃ³n <i>Reparto RelÃ¡mpago</i>!<br>Â¡Deja ya de leer y aligera para entregar ese pedido a tiempo!', 'etapa.png', 1, '2020-02-28 19:36:14'),
(693, 16, 'Emboscada', 'En la vida conocÃ­, mujer igual a vale, coral negro de La Habana, tremendÃ­sima mulata. Cien libras de piel y hueso, cuarenta kilos de salsa, y en la cara dos soles que sin palabras hablan. daniTest darÃ­a lo que fuera, aunque solo uno fuera.', 'emboscada.png', 0, '2020-02-03 15:38:07'),
(672, 1, 'CerrajerÃ­a', 'Una caja de hierro sÃ³lido no debe ser fÃ¡cil de abrir. Â¿CÃ³mo se las va a apaÃ±ar? Oyes un chisporroteo, es la mecha de lo que parece Â¡Â¿un cartucho de dinamita!?... Â¡Â¡Â¡BOOOOM!!! la cajita ya no estÃ¡ bloqueada. Consigues su contenido : Mochila de Cuerdas', 'cerrajeria.png', 1, '2019-12-29 16:02:52'),
(659, 1, 'MisiÃ³n Cumplida', 'Â¡Has completado la MisiÃ³n <i>Buscando a Tenacitas</i>!<br>Al devolver la criaturita a su dueÃ±a ganas +300 EXP y ademÃ¡s estÃ¡ tan feliz que decide recompensarte con un dinerillo. Obtienes +500 monedas. Â¡Bien hecho!', 'etapa.png', 1, '2019-12-29 13:19:22'),
(660, 1, 'MisiÃ³n Cumplida', 'Â¡Has completado la MisiÃ³n <i>Buscando a Tenacitas</i>!<br>Al devolver la criaturita a su dueÃ±a ganas +300 EXP y ademÃ¡s estÃ¡ tan feliz que decide recompensarte con un dinerillo. Obtienes +500 monedas. Â¡Bien hecho!', 'etapa.png', 1, '2019-12-29 13:21:27'),
(661, 1, 'Subiste de Nivel', 'Â¡Enhorabuena! Acabas de subir a Nivel 4. <br> Obtienes 5 Avances para mejorar habilidades en la ventana de Personaje.', 'subirNivel.png', 0, '2019-12-29 13:21:27'),
(662, 1, 'MisiÃ³n Aceptada', 'Acabas de aceptar la misiÃ³n <i>Buscando a Tenacitas</i>.<br>Su dueÃ±a dice que les atacaron en el <b>Estanque de Patos</b> y ya no volviÃ³ a saber nada mÃ¡s de la pobre criaturita. Â¿QuÃ© tal si empiezo a buscar por allÃ­?', 'subirNivel.png', 1, '2019-12-29 13:22:42'),
(663, 1, 'Pesca', 'Â¡EEEH! Han mordido el anzuelo, Â¡cacho pez cÃ³mo tira!  Â¡Meeee lo llevo! \n\nObtengo 1x Pescado Crudo', 'pescar.png', 1, '2019-12-29 13:23:24'),
(664, 1, 'Pesca', 'Â¡EEEH! Han mordido el anzuelo, Â¡cacho pez cÃ³mo tira!  Lo devolverÃ© al agua, porque mi inventario estÃ¡ lleno.', 'pescar.png', 1, '2019-12-29 13:25:35'),
(665, 1, 'MisiÃ³n Cumplida', 'Â¡Has completado la MisiÃ³n <i>Buscando a Tenacitas</i>!<br>Al devolver la criaturita a su dueÃ±a ganas +300 EXP y ademÃ¡s estÃ¡ tan feliz que decide recompensarte con un dinerillo. Obtienes +500 monedas. Â¡Bien hecho!', 'etapa.png', 1, '2019-12-29 13:25:50'),
(666, 1, 'Pesca', 'No pican...', 'pescar.png', 1, '2019-12-29 13:27:16'),
(667, 1, 'CerrajerÃ­a', 'El dependiente pasa largo rato mirando la caja bloqueada... parece estar pensando. Al fin entra a la trastienda a por las herramientas. Se escucha cÃ³mo pronuncia unas palabras mÃ¡gicas Â¡a la vez que saca una maza! Un instante despuÃ©s, la caja estÃ¡ abierta ante tus ojos. Consigues su contenido : Pieza de Fruta Fresca', 'cerrajeria.png', 1, '2019-12-29 15:26:11'),
(668, 1, 'CerrajerÃ­a', 'El dependiente pasa largo rato mirando la caja bloqueada... parece estar pensando. Al fin entra a la trastienda a por las herramientas. Se escucha cÃ³mo pronuncia unas palabras mÃ¡gicas Â¡a la vez que saca una maza! Un instante despuÃ©s, la caja estÃ¡ abierta ante tus ojos. Consigues su contenido : Pulsera Luminosa', 'cerrajeria.png', 1, '2019-12-29 15:27:02'),
(669, 1, 'CerrajerÃ­a', 'El dependiente pasa largo rato mirando la caja bloqueada... parece estar pensando. Al fin entra a la trastienda a por las herramientas. Se escucha cÃ³mo pronuncia unas palabras mÃ¡gicas Â¡a la vez que saca una maza! Un instante despuÃ©s, la caja estÃ¡ abierta ante tus ojos. Consigues su contenido : Pulsera Luminosa', 'cerrajeria.png', 1, '2019-12-29 15:27:19'),
(525, 1, 'MisiÃ³n Aceptada', 'Â¡Has aceptado la MisiÃ³n <i>Sin Respiro</i>!<br>Entrena tu Resistencia si hace falta y vuelve rÃ¡pido a la ChocolaterÃ­a de El Carmen para empezar con los juegos de aguantar la respiraciÃ³n.', 'etapa.png', 1, '2019-06-24 16:50:37'),
(536, 1, 'Mejora de Habilidad', 'Buen ritmito de piernas. He mejorado 0.02 puntos de Resistencia y tambiÃ©n 0.01 puntos de Agilidad.', 'entrenamiento.png', 1, '2019-06-30 18:22:03'),
(537, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -1.1 puntos. Ahora tengo un 26% de reconocimiento entre mis vecinos.', 'deterioro.png', 1, '2019-07-01 10:01:15'),
(538, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.7 puntos. Ahora tengo un 2.9% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-07-01 10:01:15'),
(539, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -2.3 puntos. Ahora tengo un 23.7% de reconocimiento entre mis vecinos.', 'deterioro.png', 1, '2019-07-02 11:20:23'),
(540, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.4 puntos. Ahora tengo un 2.5% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-07-02 11:20:23'),
(542, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.6 puntos. Ahora tengo un 1.9% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2019-07-03 19:27:11'),
(543, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -1.6 puntos. Ahora tengo un 20.7% de reconocimiento entre mis vecinos.', 'deterioro.png', 1, '2019-07-04 10:00:02'),
(531, 51, 'Bienvenida', 'Dar la bienvenida al juego y explicar un poco', 'bienvenida.png', 0, '2019-06-27 15:25:59'),
(694, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -1.2 puntos. Ahora tengo un 4.5% de reconocimiento entre mis vecinos.', 'deterioro.png', 1, '2020-02-04 11:00:03'),
(695, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2020-02-04 11:00:03'),
(696, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -1.6 puntos. Ahora tengo un 2.9% de reconocimiento entre mis vecinos.', 'deterioro.png', 1, '2020-02-21 11:00:05'),
(697, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2020-02-21 11:00:05'),
(698, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.6 puntos. Ahora tengo un 2.3% de reconocimiento entre mis vecinos.', 'deterioro.png', 1, '2020-02-22 12:31:49'),
(699, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2020-02-22 12:31:50'),
(700, 1, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do -0.9 puntos. Ahora tengo un 1.4% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2020-02-24 12:50:51'),
(701, 41, 'Deterioro Popularidad', 'Lamentablemente, la gente va olvidando dÃ­a a dÃ­a lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caÃ­do 0 puntos. Ahora tengo un 0% de reconocimiento entre mis vecinos.', 'deterioro.png', 0, '2020-02-24 12:50:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `misiones`
--

DROP TABLE IF EXISTS `misiones`;
CREATE TABLE IF NOT EXISTS `misiones` (
  `idM` int(11) NOT NULL,
  `titulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `etapas` int(11) NOT NULL,
  `zona` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `e1` varchar(800) COLLATE utf8_spanish_ci NOT NULL,
  `r1` varchar(800) COLLATE utf8_spanish_ci NOT NULL,
  `e2` varchar(800) COLLATE utf8_spanish_ci NOT NULL,
  `r2` varchar(800) COLLATE utf8_spanish_ci NOT NULL,
  `e3` varchar(800) COLLATE utf8_spanish_ci NOT NULL,
  `r3` varchar(800) COLLATE utf8_spanish_ci NOT NULL,
  `e4` varchar(800) COLLATE utf8_spanish_ci NOT NULL,
  `r4` varchar(800) COLLATE utf8_spanish_ci NOT NULL,
  `e5` varchar(800) COLLATE utf8_spanish_ci NOT NULL,
  `r5` varchar(800) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idM`,`titulo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `misiones`
--

INSERT INTO `misiones` (`idM`, `titulo`, `etapas`, `zona`, `e1`, `r1`, `e2`, `r2`, `e3`, `r3`, `e4`, `r4`, `e5`, `r5`) VALUES
(1, 'El Proverbio de Maim&oacute;nides\r\n', 3, 'San Jos&eacute;', 'Tengo hambre, igual que el perro del chocapic. Tr&aacute;eme alguna chocolatina o algo.', '+100 exp', 'Con estos harapos paso m&aacute;s fr&iacute;o que el picaporte de un igl&uacute;. Trae un Abrigo Polar.', '+200 exp', '&quot;Dale a un hombre un pescado y lo alimentar&aacute;s por un d&iacute;a. Ense&ntilde;a a ese hombre a pescar y lo alimentar&aacute;s para toda la vida&quot;. Es de Maim&oacute;nides... Ser&eacute; directo: Quiero una Ca&ntilde;a de Pescar.', 'Callejero Puertollano +400 exp', '', '', '', ''),
(21, 'Buscando a Tenacitas', 1, 'Recinto Ferial', '&iexcl;Ayuda! Tenacitas se ha perdido. Nos atacaron en el &lt;b&gt;Estanque de Patos&lt;/b&gt;, corr&iacute;, pero su pinzita se solt&oacute; de mi mano. Pobre peque&ntilde;&iacute;n', '+100 exp +500 monedas', '', '', '', '', '', '', '', ''),
(2, 'P&aacute;nico en el Cine', 1, 'Ayuntamiento', '&iexcl;Oh no! He perdido la Bobina de la pel&iacute;cula mientras transportaba el carrito. Ha debido caer por aqu&iacute;, en alg&uacute;n sitio, pero todo est&aacute; oscuro. &iexcl;Oh! Si no fuese tan miedoso... pero no me atrevo a entrar yo s&oacute;lo sin ninguna luz. &iexcl;Mi jefe me va a matar!', '?????', '', '', '', '', '', '', '', ''),
(3, 'Hogar, dulce hogar', 5, 'Varias', 'S&iacute;gueme de cerca. Nos reuniremos en la trastienda del Restaurante Los Arcos, situado en El Abulagar.', '+100 exp', 'No hay tiempo que perder. Nos reuniremos en El Asador del Club, situado en El Poblado.', '+100 exp', 'El camino es corto pero no te conf&iacute;es\r\n. Mantente alerta hasta llegar al Lounge Bar La Plaza, situado en los Salesianos.\r\n', '+100 exp', 'Bien, bien. Ya estoy terminando mis asuntos, pero necesito que sigas siendo prudente y me lleves al Restaurante Casa Gin&eacute;s, situado en el Terri.', '+100 exp', 'Un brillante trabajo, chico. S&oacute;lo nos queda un &uacute;ltimo lugar que visitar. Esc&oacute;ltame hasta el Doctor Lim&oacute;n, situado en El Pino.', '+100 exp Bolsa Grande'),
(4, 'Reparto Rel&aacute;mpago', 2, 'Paseo San Gregorio', '&iexcl;Corre! Debes entregar el pedido en el Lavacoches situado en Recinto Ferial y volver al Bar Bohemios antes de que pasen 40 Minutos o toda la comida se va a echar a perder.', '?????', '&iexcl;Corre! Debes entregar el pedido en el Lavacoches situado en Recinto Ferial y volver al Bar Bohemios antes de que pasen 40 Minutos o toda la comida se va a echar a perder.', '+300 exp +600 monedas', '', '', '', '', '', ''),
(5, 'Pico y Pala', 3, 'Terri', 'No suelo pedir favores pero necesito comprar un ramo de flores, ya sabes, para mi enana. &iquest;Tienes suelto?', '+100 exp', '&iexcl;Gracias, crack! Oye, el floripondio le va a molar, pero tendr&eacute; que ir guapete, &iquest;no? Quiz&aacute; puedes prestarme algo de ropa Elegante.', '+200 exp', '&iexcl;Qu&eacute; percha, nene! Se va a quedar loquita. Oc&uacute;pate porfa de mi turno de curro.', '+300 exp', '', '', '', ''),
(6, 'Mi preciado Tesoro', 1, 'Gran Capit&aacute;n', 'Nos llamaban &quot;El Bomba&quot;. &iexcl;La M&aacute;scara Bomba y yo &eacute;ramos uno! Pero nos traicionaron, nos la robarooon. Mi preciado Tesoro.', '+300 exp +Objeto', '', '', '', '', '', '', '', ''),
(7, '&iexcl;Qu&eacute; Esc&aacute;ndalo!', 4, 'Las 600', 'Ashley T. tiene un 60% de Popularidad en Las 600. Nunca ser&aacute;s ni su sombra de maquillaje.', '+250 exp + 250 monedas', 'Ashley Q. es la m&aacute;s querida en Gran Capit&aacute;n. Supera su 60% o ap&aacute;rtate.', '+500 exp + 500 monedas', 'Ashley B. con 75% tiene el Recinto Ferial rendido a sus pies. Consigue t&uacute; eso sin quitarte esas apestosas botas.', '+750 exp + 750 monedas', 'Ashley A. es la m&aacute;s popular de la historia. Mantiene todo un 75% en las discotecas del Tauro.', '+1000 exp + 1000 monedas', '', ''),
(8, 'Por Viejo o por Diablo', 2, 'El Poblado', '&iexcl;Joven y con decisi&oacute;n! Vamos a ser el equipo ganador... previo pago de 150 monedas, ejem.', '+25 exp', 'No te preocupes, recuperar&aacute;s ese dinero cuando ganemos el torneo. &iquest;Empezamos?', '+125 exp +150 monedas', '', '', '', '', '', ''),
(9, '&Eacute;xtasis del Oro', 3, 'Varias', '&iexcl;Muero de sed! Por favor, agua...&iexcl;Agua Agria! Como me traigas del grifo de tu casa lo notar&eacute;, no intentes enga&ntilde;os.', '+50 exp', '&iexcl;Ni un paso m&aacute;s! El Rubio y otro hombre te apuntan con su arma mientras tambi&eacute;n se apuntan entre ellos.', '+100 exp +150 monedas', 'Aqu&iacute; abajo hay mucho Oro enterrado, pero &iexcl;&iquest;d&oacute;nde cavar?! Son miles de l&aacute;pidas', '+300 exp +50% del Oro ', '', '', '', ''),
(10, 'Santo Voto', 3, 'Paseo El Bosque', 'Voy a necesitar patatas para echar al guiso.', '+50 exp', 'Ac&eacute;rcate a por Pan. El Santo Voto siempre se ha comido junto con su panecillo.', '+100 exp', 'Trae madera. Las ollas no se van a encender solas.', '+200 exp', '', '', '', ''),
(11, 'Desde las Cenizas', 4, 'Recinto Ferial', 'Mi licencia ha caducado. Necesito dinero para recuperar el negocio.', '+50 exp', 'La caseta qued&oacute; destrozada. Voy a necesitar Madera para reparar esto.', '+100 exp', 'Una Pistola de Bolas me ir&iacute;a bien. Da el pego y as&iacute; no volver&aacute;n a meterse conmigo.', '+200 exp', 'Con un juego de Luces LED atraer&iacute;a muchos clientes. Fijo que puedes ayudarme.', '+400 exp', '', ''),
(12, 'Para la Foto', 1, 'La Copa', 'Pronto va a venir la Alcaldesa a inaugurar esto. Asusta a 10 Jabalies para que no se cuelen en la foto.', '500 exp + 500 monedas', '', '', '', '', '', '', '', ''),
(13, 'Danza del Agua', 3, 'PAU', 'Est&aacute; bien, chico. Veamos qu&eacute; tal bailas con Espadas de Madera.', '150 exp + 200 monedas', 'Ahora lucharemos con Dos Espadas. &iexcl;Firme! como mugre de tal&oacute;n.', '400 exp + 600 monedas', '&iquest;Qu&eacute; tal si probamos con Acero? &iexcl;Duro! Como Turr&oacute;n del que sobra siempre en Navidad.', '1000 exp + 1500 monedas', '', '', '', ''),
(14, 'Magic Money', 1, 'Ciudad Jard&iacute;n', '&iexcl;Tenemos voluntario! Por favor, ve contando una a una las 25.000 monedas mientras yo preparo el truco.', '+500 exp + Objeto', '', '', '', '', '', '', '', ''),
(15, 'Temor y Respeto', 5, 'El Pino', '&iquest;Qu&eacute; dices gu...g&uuml;ito? 4.000 pu..puntos de Respeto tengo. Su..&iexcl;Sup&eacute;ralo!', '+100 exp', 'Mi primo chico est&aacute; empezando, pero a mi me respetan ya con 9.000 puntos, chulo.', '+400 exp', 'Los muchachos llevan poco en el negocio, pero una ya tiene sus 16.000 puntos de Respeto en el barrio.', '+900 exp', 'Mi hermana tiene mucha boca, pero de respeto va cortita. A ninguna gitana la respetan con 25.000 puntos como a mi. Supera eso.', '+1600 exp', 'Has venido a dar con el Patriarca Montoya. Defiendo el poder de toda mi familia con 40.000 puntos de Respeto. &iexcl;Largo de aqu&iacute;!', '+2500 exp'),
(16, 'Huele a Cerrao', 1, 'Tauro', 'Las Galer&iacute;as del Tauro llevan a&ntilde;os sin ventilarse. Entra y acaba con 20 de esos monstruos putrefactos.', '+1000 exp +3000 monedas', '', '', '', '', '', '', '', ''),
(17, 'Triple 6', 3, 'San Jos&eacute;', 'El primer encargo ser&aacute; sencillo: Silencia a 6 de esas Mujeres Chillonas, Enfermeras o Nubes de Polillas que no dejan pegar ojo a todo el vecindario.', '+400 exp +500 monedas', 'Tu siguiente encargo va a ser silenciar a 6 de las siguientes criaturas: Hombre sin Brazos, Graznador A&eacute;reo o Monstruo de Maniqu&iacute;es.', '+900 exp + 1500 monedas', 'El encargo final ser&aacute; silenciar a 6 de los monstruos m&aacute;s ruidosos: Chupasangre, Sin Rostro y Grupos de Graznadores A&eacute;reos.', '+1600 exp +2500 monedas', '', '', '', ''),
(18, 'Boda Express', 2, 'Salesianos', 'Utiliza tu Esp&iacute;ritu entrenado para hablar con el novio.', '+400 exp +150 monedas', 'Ahora utiliza tu Esp&iacute;ritu para hacer lo propio con la novia.', '+900 exp +350 monedas', '', '', '', '', '', ''),
(19, 'Veo-veo', 4, 'Pozo Norte', 'Evaluaremos tu vista. Te pongo un panel de s&iacute;mbolos y me los vas leyendo.', '+250 exp', 'Ahora mirar&aacute;s lienzos con manchas de tinta. Dime lo primero que te venga a la cabeza.', '+500 exp', 'Voy a tapar tus ojos. Gu&iacute;ate por los otros 4 sentidos para superar esta prueba.', '+750 exp', 'Por &uacute;ltimo voy a ponerte un \'listening\' del C1 de Alem&aacute;n. Si percibes alguna frase completa, eres la hostia.', '+1000 exp', '', ''),
(20, 'Sin Respiro', 4, 'El Carmen', 'Mmm, algo f&aacute;cil para ir calentando: \r\n1 Minuto sin respirar.', '+250 exp + 300 monedas', 'Vale, ahora 3 Minutos y te apuesto 600 monedas a que te fundo.', '+500 exp +600 monedas', 'Vaya, qu&eacute; chulo eso. Pero estoy segura de que luego no aguantas m&aacute;s de 5 minutos.', '+750 exp +1000 monedas', 'Oye, &iquest;lo intentas a 10 Minutos sin respirar? Es algo que s&oacute;lo consigui&oacute; una vez un tal Threepwood.', '+1000 exp +2000 monedas', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monstruos`
--

DROP TABLE IF EXISTS `monstruos`;
CREATE TABLE IF NOT EXISTS `monstruos` (
  `idM` int(255) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` int(255) NOT NULL,
  `zona` int(255) NOT NULL,
  `barrio` int(255) NOT NULL,
  `destreza` float NOT NULL,
  `fuerza` float NOT NULL,
  `agilidad` float NOT NULL,
  `resistencia` float NOT NULL,
  `salud` float NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `imagenMonstruo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idM`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `monstruos`
--

INSERT INTO `monstruos` (`idM`, `nombre`, `nivel`, `zona`, `barrio`, `destreza`, `fuerza`, `agilidad`, `resistencia`, `salud`, `descripcion`, `imagenMonstruo`) VALUES
(5, 'Delincuente menor\r\n', 5, 1, 1, 7, 7, 10, 10, 20, '- &iquest;Qu&eacute; miras, Pinfl&oacute;i? O me dejas la bici o vas a mi primo.', '5.png'),
(3, 'CerDominguero', 3, 1, 1, 5, 5, 5, 5, 30, 'Los Cerdomingueros nunca se acuerdan de recoger su basura. Alguien deber&iacute;a darles educaci&oacute;n', '3.png'),
(4, 'Mordedor del Rio Ojail&eacute;n', 4, 1, 1, 1, 1, 15, 5, 25, 'Si el Ojail&eacute;n deseas cruzar a nado, no creo que te libres de alg&uacute;n que otro bocado.', '4.png'),
(7, 'Delincuente Mayor\r\n', 7, 1, 1, 1, 1, 20, 6, 40, '- Dame 20 leuro pa gasolina, que tengo que recoger a mi hermano de la c&aacute;rcel\r\n', '7.png'),
(8, 'Cocodrilo del Rio Ojail&eacute;n\r\n', 8, 1, 1, 1, 1, 20, 8, 45, '', '8.png'),
(9, 'Pandilla de delincuentes de Asdr&uacute;bal\r\n', 9, 1, 1, 1, 1, 20, 12, 50, '', '9.png'),
(1, 'Ardilla de los Pinos Furiosa', 1, 1, 1, 2, 2, 3, 3, 10, 'Unos animalitos adorables, pero no te acerques demasiado porque... &iexcl;protegen su territorio!', '1.png'),
(2, 'Enjambre de Abejas', 2, 1, 1, 5, 5, 3, 3, 15, '- &iexcl;Escuadr&oacute;n, tomen sus puestos! &iquest;Algo para picar?\r\n', '2.png'),
(6, 'Gallo de Pelea', 6, 1, 1, 1, 1, 20, 6, 35, 'Sus ganchos duelen a&uacute;n m&aacute;s que o&iacute;r su kikirik&iacute;iii de las 6 AM.', '6.png'),
(201, 'Drag&oacute;n Okupa\r\n', 10, 2, 1, 50, 50, 50, 50, 50, '', '201.png'),
(200, 'Senderista Matutino', 10, 1, 1, 36, 70, 20, 80, 75, 'Cada ma&ntilde;ana al amanecer sale a hacer su rutita por alg&uacute;n sendero de Los Pinos para mantenerse con buen tip&iacute;n y empezar el d&iacute;a a tope.', '200.png'),
(11, 'Pe&oacute;n Minero\r\n', 1, 2, 1, 1, 1, 1, 1, 1, '', '11.png'),
(12, 'Perito Minero', 2, 2, 1, 1, 1, 1, 1, 1, '', '12.png'),
(13, 'Capataz Minero', 3, 2, 1, 1, 1, 1, 1, 1, '', '13.png'),
(14, 'Dinamitero', 4, 2, 1, 1, 1, 1, 1, 1, '', '14.png'),
(15, 'Ingeniero Minero', 5, 2, 1, 1, 1, 1, 1, 1, '', '15.png'),
(16, 'Gremio de Mineros', 6, 2, 1, 1, 11, 1, 11, 1, '', '16.png'),
(17, 'Geom&aacute;ntico\r\n', 7, 2, 1, 1, 1, 1, 1, 1, '', '17.png'),
(18, 'Troll de las Cavernas', 8, 2, 1, 1, 1, 1, 1, 1, '', '18.png'),
(19, 'Elemental de Fuego', 9, 2, 1, 1, 1, 1, 1, 1, '', '20.png'),
(41, 'Murci&eacute;lago del Pozo Norte\r\n', 1, 3, 2, 1, 1, 1, 1, 1, '', ''),
(42, 'Serpiente sigilosa', 2, 3, 2, 1, 1, 1, 1, 1, '', ''),
(43, 'Orbe fantasmal', 3, 3, 2, 1, 1, 1, 1, 1, '', ''),
(44, 'Perro peligroso', 4, 3, 2, 1, 1, 1, 1, 1, '', ''),
(45, 'Minero Errante', 5, 3, 2, 11, 1, 1, 1, 1, '', ''),
(47, 'Pantera del Parque', 7, 3, 2, 1, 1, 1, 1, 1, '', ''),
(46, 'Grupo de j&oacute;venes fumetas', 6, 3, 2, 1, 11, 1, 1, 1, '', ''),
(48, 'Vengador', 8, 3, 2, 1, 1, 1, 1, 1, '', ''),
(49, 'Buruburu', 9, 3, 2, 1, 1, 1, 1, 1, '', ''),
(61, 'Mu&ntilde;eco Vud&uacute;', 1, 1, 4, 1, 1, 1, 1, 1, '', ''),
(62, 'Zombi Resacoso', 2, 1, 4, 1, 1, 1, 1, 1, '', ''),
(63, 'Cuervo Cabreado', 3, 1, 4, 1, 1, 1, 11, 1, '', ''),
(64, 'Enterrador Sombr&iacute;o', 4, 1, 4, 1, 1, 1, 1, 1, '', ''),
(65, 'Vidente Vud&uacute;', 5, 1, 4, 1, 1, 1, 1, 1, '', ''),
(66, 'Calavera Parlante', 6, 1, 4, 1, 1, 1, 1, 1, '', ''),
(67, 'Tr&iacute;o Canibal\r\n', 7, 1, 4, 1, 1, 1, 1, 1, '', ''),
(68, 'Maestra de la Espada', 8, 1, 4, 1, 1, 1, 1, 1, '', ''),
(69, 'Mono de Tres Cabezas', 9, 1, 4, 1, 11, 1, 1, 1, '', ''),
(206, 'Escalopendro', 10, 1, 4, 1, 1, 1, 1, 1, '', ''),
(151, 'Chivato de Patio', 1, 1, 9, 11, 1, 1, 1, 1, '', ''),
(152, 'Ni&ntilde;a Columpiadora\r\n', 2, 1, 9, 1, 1, 1, 1, 1, '', ''),
(153, 'Chico Gur&uacute;', 3, 1, 9, 11, 1, 1, 1, 1, '', ''),
(154, 'P&aacute;rvulo Salvaje\r\n', 4, 1, 9, 1, 1, 1, 1, 1, '', ''),
(155, 'Grupo de Chicas Populares', 5, 1, 9, 1, 1, 1, 1, 1, '', ''),
(156, 'D&uacute;o de excavadores\r\n', 6, 1, 9, 1, 1, 11, 1, 1, '', ''),
(159, 'Clan de P&aacute;rvulos Salvajes', 9, 1, 9, 1, 1, 1, 1, 1, '', ''),
(158, 'Mat&oacute;n del Patio\r\n', 8, 1, 9, 1, 1, 1, 1, 1, '', ''),
(157, 'Joven Estafador', 7, 1, 9, 1, 1, 1, 1, 1, '', ''),
(215, 'Rey del Recreo', 10, 1, 9, 1, 1, 1, 1, 1, '', ''),
(171, 'Rat&oacute;nido del estanque\r\n', 1, 3, 9, 1, 1, 1, 1, 1, '', ''),
(172, 'Pato Atontao', 2, 3, 9, 1, 1, 1, 1, 1, '', ''),
(173, 'Banco de Carpas hambrientas', 3, 3, 9, 1, 1, 1, 1, 1, '', ''),
(174, 'Mercader de Alfombras', 4, 3, 9, 1, 1, 1, 1, 1, '', ''),
(175, 'Yonki del Estanque', 5, 3, 9, 1, 1, 1, 1, 1, '', ''),
(176, 'Mercader de Melones', 6, 3, 9, 1, 1, 1, 1, 1, '', ''),
(177, 'Camalechuro del Estanque', 7, 3, 9, 11, 1, 1, 1, 1, '', ''),
(178, 'Jinete de Camalechuro', 8, 3, 9, 1, 1, 1, 1, 1, '', ''),
(179, 'Cangr&eacute;lago', 9, 3, 9, 1, 11, 1, 1, 1, '', ''),
(217, 'Kraken del Estanque', 10, 3, 9, 1, 1, 1, 1, 1, '', ''),
(141, 'Duendecillo Ebrio', 1, 1, 8, 1, 1, 11, 1, 1, '', ''),
(142, 'Hechicerilla', 2, 1, 8, 1, 1, 1, 1, 1, '', ''),
(143, 'Gnomo harto de Setas', 3, 1, 8, 1, 1, 1, 1, 1, '', ''),
(144, 'Centinela a Caballo', 4, 1, 8, 1, 1, 11, 1, 1, '', ''),
(145, 'Morador de las Antenas', 5, 1, 8, 1, 1, 1, 1, 11, '', ''),
(146, 'Arp&iacute;a Hechicera', 6, 1, 8, 1, 1, 1, 1, 1, '', ''),
(147, 'Ninfa', 7, 1, 8, 1, 1, 1, 1, 1, '', ''),
(148, 'Sierpe Hipnotizadora', 8, 1, 8, 12, 1, 1, 1, 1, '', ''),
(149, 'Tigre a rayas', 9, 1, 8, 1, 1, 1, 1, 1, '', ''),
(202, 'Rey de los Piratas', 10, 1, 2, 1, 1, 1, 1, 1, '', ''),
(21, 'Mono Callejero', 1, 1, 2, 1, 1, 1, 1, 1, '', ''),
(22, 'Pillastre', 2, 1, 2, 1, 1, 11, 1, 1, '', ''),
(23, 'Apostante Ebrio', 3, 1, 2, 1, 1, 1, 1, 1, '', ''),
(24, 'Mercader Misterioso', 4, 1, 2, 1, 1, 1, 1, 1, '', ''),
(25, 'Trilero', 5, 1, 2, 1, 1, 1, 1, 1, '', ''),
(26, 'Pandilla de Rateros', 6, 1, 2, 1, 1, 1, 1, 1, '', ''),
(27, 'Adivinador', 7, 1, 2, 1, 1, 1, 1, 1, '', ''),
(28, 'Hombre de Negocios', 8, 1, 2, 1, 1, 11, 1, 1, '', ''),
(29, 'Traficante de Armas', 9, 1, 2, 1, 1, 1, 1, 1, '', ''),
(31, 'Mujer Chillona', 1, 2, 2, 1, 1, 1, 1, 1, '', ''),
(32, 'Enfermera', 2, 2, 2, 11, 1, 1, 1, 1, '', ''),
(33, 'Nube de Polillas', 3, 2, 2, 1, 1, 11, 1, 1, '', ''),
(34, 'Hombre sin Brazos', 4, 2, 2, 1, 1, 1, 1, 1, '', ''),
(35, 'Graznador A&eacute;reo', 5, 2, 2, 1, 1, 1, 1, 1, '', ''),
(36, 'Monstruo de Maniqu&iacute;es', 6, 2, 2, 1, 1, 11, 1, 1, '', ''),
(37, 'Chupasangre', 7, 2, 2, 1, 1, 11, 1, 1, '', ''),
(38, 'Sin Rostro', 8, 2, 2, 1, 1, 1, 1, 11, '', ''),
(39, 'Grupo de Graznadores A&eacute;reos', 9, 2, 2, 1, 1, 11, 111, 1, '', ''),
(203, 'CabezaDado', 10, 2, 2, 1, 1, 1, 1, 1, '', ''),
(58, 'Joven Lanzaflechas', 8, 1, 3, 1, 1, 1, 1, 1, '', ''),
(57, 'Joven Cerbatanero', 7, 1, 3, 1, 1, 1, 1, 1, '', ''),
(56, 'Pandilla de Nenes del Abulagar', 6, 1, 3, 1, 1, 1, 1, 1, '', ''),
(55, 'Nene Lanzapañales', 5, 1, 3, 1, 1, 1, 1, 1, '', ''),
(54, 'Nena Lanzahuevos', 4, 1, 3, 1, 1, 1, 1, 1, '', ''),
(53, 'Nena del Tirachinas', 3, 1, 3, 1, 1, 1, 1, 1, '', ''),
(52, 'Nene del Boomerang', 2, 1, 3, 1, 1, 1, 1, 1, '', ''),
(51, 'Nene Lanzaglobos', 1, 1, 3, 1, 1, 1, 1, 1, '', ''),
(205, 'Joven Lanzabutano', 10, 1, 3, 1, 1, 1, 1, 1, '', ''),
(59, 'Joven Lanzapiñas', 9, 1, 3, 1, 1, 1, 1, 1, '', ''),
(214, 'EntreNereidas', 10, 1, 8, 1, 1, 1, 1, 1, '', ''),
(71, 'Grupo de Adeptos', 1, 1, 5, 1, 1, 1, 1, 1, '', ''),
(72, 'Catequista Carterista', 2, 1, 5, 1, 1, 1, 1, 1, '', ''),
(73, 'Misionero Evangelizador', 3, 1, 5, 1, 1, 1, 1, 1, '', ''),
(74, 'Monja Trapichera', 4, 1, 5, 1, 1, 1, 1, 1, '', ''),
(75, 'Monje Salesiano', 5, 1, 5, 1, 1, 1, 1, 1, '', ''),
(76, 'Abad Bugneverdies', 6, 1, 5, 1, 1, 1, 1, 1, '', ''),
(77, 'Di&aacute;cono', 7, 1, 5, 1, 1, 1, 1, 1, '', ''),
(78, 'Sacerdote', 8, 1, 5, 1, 1, 1, 1, 1, '', ''),
(79, '&quot;El Cardenales&quot;', 9, 1, 5, 1, 1, 1, 1, 1, '', ''),
(81, 'Escarabajo', 1, 2, 5, 1, 1, 1, 1, 1, '', ''),
(82, 'Escorpi&oacute;n Venenoso', 2, 2, 5, 1, 1, 1, 1, 1, '', ''),
(83, 'Esqueleto Espadach&iacute;n', 3, 2, 5, 1, 1, 1, 1, 1, '', ''),
(84, 'Serpiente de Cascabel', 4, 2, 5, 1, 1, 1, 1, 1, '', ''),
(85, 'Monstruo Arenoso', 5, 2, 5, 1, 1, 1, 1, 1, '', ''),
(86, 'Jinete Huesudo', 6, 2, 5, 1, 1, 1, 1, 1, '', ''),
(87, 'Momia en Movimiento', 7, 2, 5, 1, 1, 1, 1, 1, '', ''),
(88, 'Cham&aacute;n', 8, 2, 5, 1, 1, 1, 1, 1, '', ''),
(89, 'Ej&eacute;rcito Huesudo', 9, 2, 5, 1, 1, 1, 1, 1, '', ''),
(91, 'Jabatillo Asustado', 1, 3, 5, 1, 1, 1, 1, 1, '', ''),
(92, 'Ni&ntilde;ato del Botell&oacute;n', 2, 3, 5, 1, 1, 1, 1, 1, '', ''),
(93, 'Temeraria del Selfie', 3, 3, 5, 1, 11, 1, 11, 1, '', ''),
(94, 'Mami Jabal&iacute;', 4, 3, 5, 1, 1, 1, 1, 1, '', ''),
(95, 'Gatosombra Fam&eacute;lico', 5, 3, 5, 1, 1, 1, 1, 1, '', ''),
(96, 'Papi Jabal&iacute;', 6, 3, 5, 1, 1, 1, 1, 1, '', ''),
(97, 'Runner Romper&eacute;cords', 7, 3, 5, 1, 1, 1, 1, 1, '', ''),
(98, 'Familia Jabal&iacute;', 8, 3, 5, 1, 1, 1, 1, 1, '', ''),
(99, 'Chupacabras', 9, 3, 5, 1, 1, 1, 1, 1, '', ''),
(111, 'Rat&oacute;nido Junior del Paseo', 1, 2, 6, 1, 1, 1, 1, 1, '', ''),
(112, 'Soplatobillos Municipal', 2, 2, 6, 1, 1, 1, 1, 1, '', ''),
(113, 'Patrulla Cazapokemon', 3, 2, 6, 1, 1, 1, 1, 1, '', ''),
(114, 'Tontolabici', 4, 2, 6, 1, 1, 1, 1, 1, '', ''),
(115, 'Rat&oacute;nido Gordo del Paseo\r\n', 5, 2, 6, 1, 1, 1, 1, 1, '', ''),
(116, 'Tontolpatinete', 6, 2, 6, 1, 1, 1, 1, 1, '', ''),
(117, 'Tontolamoto', 7, 2, 6, 1, 1, 1, 1, 1, '', ''),
(118, 'Tontoltuning', 8, 2, 6, 1, 1, 1, 1, 1, '', ''),
(119, 'Elemental de Agua Agria', 9, 2, 6, 1, 1, 1, 1, 1, '', ''),
(121, 'Palomo Palomitero', 1, 3, 6, 1, 1, 1, 1, 1, '', ''),
(122, 'Iniciado del Parkour', 2, 3, 6, 1, 1, 1, 1, 1, '', ''),
(123, 'Delincuente Menor del Paseo', 3, 3, 6, 1, 11, 1, 1, 1, '', ''),
(124, 'Delincuente Mayor del Paseo', 4, 3, 6, 1, 1, 1, 1, 1, '', ''),
(125, 'Banda de Palomas Palomiteras', 5, 3, 6, 1, 1, 1, 1, 1, '', ''),
(126, 'Maestro del Parkour', 6, 3, 6, 1, 1, 1, 1, 1, '', ''),
(127, 'Apostante en Mala Racha', 7, 3, 6, 1, 1, 1, 1, 1, '', ''),
(128, 'Ni&ntilde;ato Rayacoches', 8, 3, 6, 1, 1, 1, 1, 1, '', ''),
(129, 'Pandilla Parkour', 9, 3, 6, 1, 1, 1, 1, 1, '', ''),
(131, 'Cabra Gitana', 1, 1, 7, 1, 1, 1, 1, 1, '', ''),
(132, 'Aguilucho bien entrenado', 2, 1, 7, 1, 1, 1, 1, 1, '', ''),
(133, 'Gumia Oculto', 3, 1, 7, 1, 1, 1, 1, 1, '', ''),
(134, 'Buitre Merodeador', 4, 1, 7, 1, 1, 1, 1, 1, '', ''),
(135, 'La Nayara', 5, 1, 7, 1, 1, 1, 1, 1, '', ''),
(136, 'Coleccionista de Bicis', 6, 1, 7, 1, 1, 1, 1, 1, '', ''),
(137, 'Tribu de Gumias Ocultos', 7, 1, 7, 1, 1, 1, 1, 1, '', ''),
(138, 'La Saray', 8, 1, 7, 1, 1, 1, 1, 1, '', ''),
(139, 'D&uacute;o de Hermanas Cantantes', 9, 1, 7, 1, 1, 1, 1, 1, '', ''),
(161, 'Lobato Huargo', 1, 2, 9, 1, 1, 1, 1, 1, '', ''),
(162, 'Cuervo del Norte', 2, 2, 9, 1, 1, 1, 1, 1, '', ''),
(163, 'Centinela de Bazagonia', 3, 2, 9, 1, 1, 1, 1, 1, '', ''),
(164, 'Huargo Feroz', 4, 2, 9, 1, 1, 1, 11, 1, '', ''),
(165, 'Gigante del Norte Extremo', 5, 2, 9, 1, 1, 1, 1, 1, '', ''),
(166, 'Guerrero de Bazagonia', 6, 2, 9, 1, 1, 1, 1, 1, '', ''),
(167, 'Espectro G&eacute;lido', 7, 2, 9, 1, 1, 1, 1, 1, '', ''),
(168, 'Manada de Huargos', 8, 2, 9, 1, 1, 1, 1, 1, '', ''),
(169, 'Jinete Gigante', 9, 2, 9, 1, 1, 11, 1, 1, '', ''),
(181, 'Abejorro de Jard&iacute;n', 1, 1, 10, 1, 1, 1, 1, 1, '', ''),
(182, 'Culebra de Jard&iacute;n', 2, 1, 10, 1, 1, 1, 1, 1, '', ''),
(183, 'Sapo Venenoso', 3, 1, 10, 1, 1, 1, 1, 1, '', ''),
(184, 'Espantap&aacute;jaros Siniestro', 4, 1, 10, 1, 1, 1, 1, 1, '', ''),
(185, 'Fumigador Furioso', 5, 1, 10, 1, 1, 1, 1, 1, '', ''),
(186, 'C&aacute;ctus Boxeador', 6, 1, 10, 1, 1, 1, 1, 1, '', ''),
(187, 'Planta Carn&iacute;vora', 7, 1, 10, 1, 1, 1, 1, 1, '', ''),
(188, 'Zorro de la Zona', 8, 1, 10, 1, 1, 1, 1, 1, '', ''),
(189, 'Caim&aacute;n Guardi&aacute;n', 9, 1, 10, 1, 1, 1, 1, 1, '', ''),
(204, 'Banshee', 10, 3, 2, 1, 1, 1, 1, 1, '', '210.png'),
(216, 'Loca del Drogon', 10, 2, 9, 1, 1, 1, 1, 1, '', ''),
(218, 'Gigante Verde', 10, 1, 10, 1, 1, 1, 1, 1, '', ''),
(213, 'Patriarca GiThanos', 10, 1, 7, 1, 1, 1, 1, 1, '', ''),
(212, 'El Aullador', 10, 3, 6, 1, 1, 1, 1, 1, '', ''),
(211, 'Rat&oacute;nido Astilla', 10, 2, 6, 1, 1, 1, 1, 1, '', ''),
(209, 'Druida del Minero', 10, 3, 5, 1, 1, 1, 1, 1, '', ''),
(208, 'Miniontauro', 10, 2, 5, 1, 1, 1, 1, 1, '', ''),
(207, 'Sumo Pont&iacute;fice', 10, 1, 5, 1, 1, 1, 1, 1, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetos`
--

DROP TABLE IF EXISTS `objetos`;
CREATE TABLE IF NOT EXISTS `objetos` (
  `id` int(255) NOT NULL,
  `nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `nivelMin` int(11) NOT NULL,
  `destreza` float NOT NULL,
  `fuerza` float NOT NULL,
  `agilidad` float NOT NULL,
  `resistencia` float NOT NULL,
  `espiritu` float NOT NULL,
  `estilo` float NOT NULL,
  `ingenio` float NOT NULL,
  `percepcion` float NOT NULL,
  `especial` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `precioCompra` int(50) NOT NULL,
  `precioVenta` int(50) NOT NULL,
  `imagenObjeto` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `reliquia` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `objetos`
--

INSERT INTO `objetos` (`id`, `nombre`, `nivelMin`, `destreza`, `fuerza`, `agilidad`, `resistencia`, `espiritu`, `estilo`, `ingenio`, `percepcion`, `especial`, `precioCompra`, `precioVenta`, `imagenObjeto`, `reliquia`) VALUES
(1, 'Pez', 3, 1, 2, 0, 0, 0, 2, 0, 0, 'nada', 10, 50000, '1.png', 0),
(2, 'H&aacute;mster', 1, 2, 1, 0, 0, 0, 4, 0, 0, 'recaudador', 30, 15, '2.png', 0),
(20, 'Longboard', 1, 4, 10, 10, 0, 0, 0, 0, 0, 'nada', 0, 0, '', 0),
(21, 'Bici de Paseo', 7, 0, 0, 10, 5, 0, 12, 0, 0, 'nada', 2200, 220, '', 0),
(100, 'Gorrito de papel', 1, 0, 0, 0, 2, 0, 1, 0, 0, 'nada', 0, 0, '', 0),
(101, 'Bandana', 3, 0, 0, 2, 0, 0, 1, 0, 0, 'nada', 0, 0, '', 0),
(200, 'Blusa rasgada', 1, 0, 0, 2, 4, 0, 0, 0, 0, 'nada', 0, 0, '', 0),
(201, 'Camiseta de tirantes', 3, 0, 0, 1, 4, 0, 0, 0, 0, 'nada', 0, 0, '201.png', 0),
(300, 'Remo de Madera', 1, 2, 4, 0, 0, 0, 0, 0, 0, 'aturdidor', 0, 0, '300.png', 0),
(301, 'Sello de discoteca', 3, 0, 0, 0, 0, 0, 3, 0, 0, 'nada', 0, 0, '', 0),
(400, 'Chanclas de piscina', 1, 1, 1, 0, 3, 0, 0, 0, 0, 'nada', 170, 17, '400.png', 0),
(401, 'Zapatillas deportivas', 3, 0, 0, 6, 3, 0, 5, 0, 0, 'nada', 0, 20, '401.png', 0),
(500, 'Ri&ntilde;onera\r\n', 1, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 3 Slots', 100, 10, '500.png', 0),
(501, 'Bolsa de Rafia', 22, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 3 Slots', 100, 10, '501.png', 0),
(0, 'Vacio', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'nada', 0, 0, '', 0),
(3, 'Gallo', 3, 2, 2, 0, 0, 0, 4, 0, 0, 'nada', 500, 50, '3.png', 0),
(1000, 'SFX Arwing', 25, 0, 0, 0, 0, 0, 0, 0, 0, 'Sirve para Aeromodelismo', 5000, 500, '1000.png', 1),
(900, 'Cajita oxidada', 1, 0, 0, 0, 0, 0, 0, 0, 0, 'nada', 0, 20, '900.png', 0),
(105, 'Casco Minero', 100, 0, 0, 0, 10, 0, 0, 0, 10, 'nada', 300, 30, '105.png', 1),
(102, 'Capucha de Conejo', 100, 0, 0, 7, 0, 0, 0, 0, 0, 'veloz', 500, 50, '102.png', 0),
(103, 'M&aacute;scara Bomba', 100, 0, 7, 0, 0, 0, 0, 0, 0, 'aturdidor', 300, 30, '103.png', 0),
(104, 'M&aacute;scara de Mejoras', 100, 0, 0, 0, 0, 0, 7, 0, 0, 'avance extra', 1000, 100, '104.png', 1),
(106, 'Sombrero de paja', 50, 0, 0, 0, 10, 0, 10, 0, 0, 'nada', 5000, 500, '106.png', 1),
(107, 'Visor de Energ&iacute;a', 3, 0, 0, 0, 0, 0, 3, 0, 5, 'nada', 300, 30, '107.png', 1),
(109, 'Sombrero de Pescador', 2, 0, 0, 0, 3, 0, 1, 0, 0, 'nada', 100, 10, '109.png', 0),
(307, 'Ca&ntilde;a de Pesca', 3, 2, 4, 0, 0, 0, 0, 0, 0, 'Sirve para Pescar', 130, 13, '307.png', 0),
(407, 'Botas de Pescador', 2, 0, 2, 3, 0, 0, 0, 0, 0, 'nada', 100, 10, '407.png', 0),
(502, 'Malet&iacute;n', 2, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 4 Slots', 200, 20, '502.png', 0),
(503, 'Cesta de Mimbre', 2, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 4 Slots', 700, 20, '503.png', 0),
(504, 'Mochila de Cuerdas', 23, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 5 Slots', 500, 50, '504.png', 0),
(505, 'Cesta Grande', 3, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 5 Slots', 300, 30, '505.png', 0),
(506, 'Mochila Grande', 4, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 6 Slots', 900, 90, '506.png', 0),
(507, 'Bolsa de Deporte', 4, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 6 Slots', 900, 90, '507.png', 0),
(508, 'Saco', 25, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 7 Slots', 600, 600, '508.png', 0),
(509, 'Carro de la Compra', 5, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 7 Slots', 500, 50, '509.png', 0),
(510, 'Maleta de Viaje', 27, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 8 Slots', 600, 60, '510.png', 0),
(511, 'Carro de Supermercado', 6, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 8 Slots', 600, 60, '511.png', 0),
(513, 'Servicio de Criados', 7, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 10 Slots', 700, 70, '512.png', 0),
(514, 'Portal Dimensional', 50, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 12 Slots', 1000, 100, '513.png', 0),
(920, 'Chocolatina Derretida', 1, 0, 0, 0, 0, 0, 0, 0, 0, '+2 Salud', 0, 2, '920.png', 0),
(207, 'Abrigo Polar', 5, 0, 0, 0, 8, 0, 0, 0, 0, 'nada', 400, 40, '207.png', 0),
(302, 'Callejero de Puertollano', 100, 0, 0, 0, 0, 0, 0, 0, 0, 'veloz', 3000, 300, '302.png', 1),
(921, 'Bobina de Pel&iacute;cula', 100, 0, 0, 0, 0, 0, 0, 0, 0, 'Ning&uacute;n uso aparente', 0, 20, '921.png', 0),
(512, 'Macuto de Acampar', 26, 0, 0, 0, 0, 0, 0, 0, 0, 'Inventario = 8 Slots', 0, 100, '512.png', 0),
(208, 'Conjunto Elegante', 24, 0, 0, 0, 2, 0, 5, 0, 0, 'nada', 1400, 140, '208.png', 0),
(922, 'Roca Tallada', 100, 0, 0, 0, 0, 0, 0, 0, 0, 'Pone: &quot;Arch Stanton&quot;', 100, 10, '922.png', 0),
(926, 'Pepita de Oro', 100, 0, 0, 0, 0, 0, 0, 0, 0, 'nada', 800, 80, '926.png', 0),
(308, 'Pico de Minero', 3, 3, 3, 0, 0, 0, 0, 0, 0, 'nada', 150, 15, '308.png', 1),
(309, 'Recetario de Cocina Manchega', 100, 0, 0, 0, 0, 0, 0, 5, 0, 'Contiene recetas manchegas', 0, 0, '309.png', 0),
(923, 'Botella Agua Agria', 100, 0, 0, 0, 0, 0, 0, 0, 0, '+1 Salud', 0, 0, '923.png', 0),
(310, 'Rev&oacute;lver', 28, 7, 10, 0, 0, 0, 0, 0, 0, 'nada', 1600, 160, '310.png', 0),
(924, 'Saco de Patatas', 1, 0, 0, 0, 0, 0, 0, 0, 0, 'Ingrediente de cocina', 30, 3, '924.png', 0),
(311, 'Barra de Pan duro', 1, 2, 1, 0, 0, 0, 0, 0, 0, 'nada', 60, 6, '311.png', 0),
(925, 'Sand&iacute;a Hermosa', 1, 0, 0, 0, 0, 0, 0, 0, 0, '+3 Salud', 150, 15, '925.png', 0),
(110, 'Sombrero de Aventurero', 3, 0, 0, 0, 3, 0, 2, 0, 2, 'nada', 270, 27, '110.png', 0),
(22, 'Alfombra M&aacute;gica', 26, 0, 0, 4, 0, 0, 6, 0, 0, 'nada', 3000, 300, '22.png', 0),
(312, 'Pistola de Bolas', 3, 5, 3, 0, 0, 0, 0, 0, 0, 'nada', 1200, 120, '312.png', 0),
(927, 'Luces de LED', 100, 0, 0, 0, 0, 0, 0, 0, 0, 'Iluminan de lujo', 2000, 200, '927.png', 0),
(1001, 'Halc&oacute;n Milenario', 30, 0, 0, 0, 0, 0, 0, 0, 0, 'Sirve para Aeromodelismo', 20000, 2000, '1001.png', 1),
(313, 'Linterna de mano', 22, 2, 2, 0, 0, 0, 0, 0, 5, 'Ilumina', 600, 60, '313.png', 0),
(314, 'Pulsera Luminosa', 21, 0, 0, 0, 0, 0, 3, 0, 2, 'Ilumina', 300, 30, '314.png', 0),
(408, 'Botas de Hierro Pesado', 5, 0, 5, 0, 7, 0, 0, 0, 0, 'nada', 850, 85, '408.png', 0),
(928, 'Pieza de Fruta Fresca', 21, 0, 0, 0, 0, 0, 0, 0, 0, '+2 Salud', 30, 3, '928.png', 0),
(929, 'Pan del Camino', 26, 0, 0, 0, 0, 0, 0, 0, 0, '+4 Salud', 50, 5, '929.png', 0),
(111, 'Casco de Moto', 5, 0, 0, 0, 8, 0, 0, 0, 0, 'nada', 1500, 150, '111.png', 0),
(23, 'Moto de Carreras', 8, 0, 0, 12, 0, 0, 20, 0, 0, 'nada', 11500, 1150, '23.png', 0),
(24, 'Minimoto Infantil', 29, 0, 0, 5, 0, 0, 7, 0, 0, 'nada', 4750, 475, '24.png', 0),
(112, 'Purpurina Cosm&eacute;tica', 2, 0, 0, 0, 0, 0, 3, 0, 0, 'nada', 250, 25, '112.png', 0),
(315, 'Revista Cient&iacute;fica', 3, 0, 0, 0, 0, 0, 0, 3, 0, 'nada', 300, 30, '315.png', 0),
(4, 'Gato', 1, 0, 1, 0, 0, 0, 0, 0, 2, 'nada', 200, 20, '4.png', 0),
(5, 'Perro', 2, 2, 3, 0, 0, 0, 0, 0, 0, 'nada', 350, 35, '5.png', 0),
(6, 'Caballo', 4, 0, 0, 4, 3, 0, 0, 0, 0, 'veloz', 1750, 175, '6.png', 0),
(113, 'Casco de Bici', 3, 0, 0, 0, 5, 0, 0, 0, 0, 'nada', 600, 60, '113.png', 0),
(930, 'Berenjenas de Almagro', 22, 0, 0, 0, 0, 0, 0, 0, 0, '+4 Salud', 250, 25, '930.png', 0),
(931, 'Queso Especiado', 24, 0, 0, 0, 0, 0, 0, 0, 0, '+5 Salud', 400, 40, '931.png', 0),
(932, 'Galletas de Ma&iacute;z', 23, 0, 0, 0, 0, 0, 0, 0, 0, '+3 Salud', 200, 20, '932.png', 0),
(114, 'Parche para Ojo izquierdo', 1, 0, 0, 0, 0, 0, 2, 0, 0, 'nada', 150, 15, '114.png', 0),
(115, 'Gafas de Intelectual', 23, 0, 0, 0, 0, 0, 2, 3, 0, 'nada', 500, 50, '115.png', 0),
(116, 'Gafas de Sol polarizadas', 3, 0, 0, 0, 0, 0, 2, 0, 3, 'nada', 500, 50, '116.png', 0),
(209, 'Kit de Camuflaje', 24, 0, 0, 5, 2, 0, 0, 0, 0, 'nada', 600, 60, '209.png', 0),
(316, 'Machete afilado', 5, 6, 4, 0, 0, 0, 0, 0, 0, 'nada', 1000, 100, '316.png', 0),
(32, 'Bici de Monta&ntilde;a', 6, 0, 0, 6, 3, 0, 0, 0, 0, 'nada', 4250, 425, '32.png', 0),
(33, 'Bici de Carretera', 27, 0, 0, 8, 3, 0, 0, 0, 0, 'nada', 6750, 675, '33.png', 0),
(317, 'Tirachinas', 2, 4, 1, 0, 0, 0, 0, 0, 0, 'nada', 150, 15, '317.png', 0),
(318, 'Navaja', 21, 1, 4, 0, 0, 0, 0, 0, 0, 'nada', 240, 24, '318.png', 0),
(210, 'Kit Deportivo', 2, 0, 0, 2, 2, 0, 1, 0, 0, 'nada', 200, 20, '210.png', 0),
(409, 'Botas de Levitaci&oacute;n', 28, 0, 0, 7, 0, 0, 0, 0, 3, 'nada', 6250, 625, '409.png', 0),
(25, 'Moto Scooter', 5, 0, 0, 8, 0, 0, 13, 0, 0, 'nada', 8000, 800, '25.png', 0),
(933, 'Pescado Crudo', 100, 0, 0, 0, 0, 0, 0, 0, 0, 'Ingrediente de cocina', 0, 10, '933.png', 0),
(901, 'Cajita de Madera', 2, 0, 0, 0, 0, 0, 0, 0, 0, 'nada', 0, 40, '901.png', 0),
(902, 'Cajita de Metal', 3, 0, 0, 0, 0, 0, 0, 0, 0, 'nada', 0, 60, '902.png', 0),
(903, 'Cofre peque&ntilde;o oxidado', 4, 0, 0, 0, 0, 0, 0, 0, 0, 'nada', 0, 80, '903.png', 0),
(904, 'Cofre peque&ntilde;o de madera', 5, 0, 0, 0, 0, 0, 0, 0, 0, 'nada', 0, 100, '904.png', 0),
(905, 'Cofre peque&ntilde;o de metal', 6, 0, 0, 0, 0, 0, 0, 0, 0, 'nada', 0, 120, '905.png', 0),
(906, 'Cofre grande oxidado', 7, 0, 0, 0, 0, 0, 0, 0, 0, 'nada', 0, 140, '906.png', 0),
(907, 'Cofre grande de madera', 8, 0, 0, 0, 0, 0, 0, 0, 0, 'nada', 0, 160, '907.png', 0),
(908, 'Cofre grande de metal', 9, 0, 0, 0, 0, 0, 0, 0, 0, 'nada', 0, 180, '908.png', 0),
(909, 'Cofre con piedras preciosas', 10, 0, 0, 0, 0, 0, 0, 0, 0, 'nada', 0, 200, '909.png', 0),
(7, 'Tenacitas', 100, 8, 5, 0, 0, 0, 0, 0, 0, 'nada', 0, 300, '7.png', 0),
(117, 'Pa&ntilde;uelo motero', 3, 0, 0, 0, 2, 0, 6, 0, 0, 'nada', 700, 70, '117.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personajes`
--

DROP TABLE IF EXISTS `personajes`;
CREATE TABLE IF NOT EXISTS `personajes` (
  `id` int(255) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `origen` int(255) NOT NULL,
  `experiencia` int(255) NOT NULL,
  `nivel` int(255) NOT NULL,
  `barrio` int(255) NOT NULL,
  `zona` int(255) NOT NULL,
  `destreza` float NOT NULL,
  `fuerza` float NOT NULL,
  `agilidad` float NOT NULL,
  `resistencia` float NOT NULL,
  `espiritu` float NOT NULL,
  `estilo` float NOT NULL,
  `ingenio` float NOT NULL,
  `percepcion` float NOT NULL,
  `salud` int(255) NOT NULL,
  `energia` int(255) NOT NULL,
  `respeto` int(255) NOT NULL,
  `popularidad` float NOT NULL,
  `cash` int(255) NOT NULL,
  `enBanco` int(255) NOT NULL,
  `avances` int(50) NOT NULL,
  `survival` int(10) NOT NULL,
  `accion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `viaje` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emboscada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personajes`
--

INSERT INTO `personajes` (`id`, `nombre`, `sexo`, `origen`, `experiencia`, `nivel`, `barrio`, `zona`, `destreza`, `fuerza`, `agilidad`, `resistencia`, `espiritu`, `estilo`, `ingenio`, `percepcion`, `salud`, `energia`, `respeto`, `popularidad`, `cash`, `enBanco`, `avances`, `survival`, `accion`, `viaje`, `emboscada`) VALUES
(1, 'daniTest', 'Hombre', 1, 1470, 4, 6, 2, 1, 1, 1, 1, 1, 1, 1, 96.21, 86, 77, 41397, 1.4, 720, 707, 13, 0, '2019-12-29 20:38:43', '2020-02-28 20:29:55', '2020-02-03 16:38:07'),
(2, 'pepe', 'Hombre', 1, 50, 2, 1, 1, 10, 10, 10, 10, 2, 2, 2, 2, 100, 100, 18, 0, 547, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(14, 'macario', 'Hombre', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(15, 'lulu', 'Mujer', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(16, 'vale', 'Hombre', 3, 0, 1, 1, 2, 30, 30, 20, 20, 1, 1, 1, 1, 47, 100, 275, 0, 1384, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(17, 'felgica', 'Hombre', 7, 0, 1, 7, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(18, 'eulalio', 'Hombre', 9, 0, 1, 9, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(19, 'manuela', 'Mujer', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 58, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(20, 'genoveva', 'Mujer', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(21, 'consti', 'Hombre', 3, 0, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(22, 'blas', 'Hombre', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 30, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(23, 'petras', 'Mujer', 2, 0, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 5, 0, 95, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(24, 'papadopoulos', 'Hombre', 3, 0, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(25, 'cosilla', 'Hombre', 4, 0, 1, 4, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(26, 'mimimimimim', 'Mujer', 5, 0, 1, 5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 15, 0, 325, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(27, 'parachute', 'Hombre', 6, 0, 1, 6, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(28, 'pirori', 'Hombre', 7, 0, 1, 7, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(29, 'chele', 'Mujer', 8, 0, 1, 8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(30, 'borracho', 'Hombre', 9, 0, 1, 9, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 2135, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(31, 'nene', 'Hombre', 10, 0, 6, 9, 3, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 300, 6, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(32, 'cantador', 'Hombre', 5, 0, 1, 5, 2, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 15, 0, 80, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(33, 'testtest', 'Mujer', 6, 0, 1, 6, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(34, 'abuelo', 'Hombre', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 85, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(35, 'anabelen', 'Mujer', 2, 0, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(37, 'anubis', 'Hombre', 9, 0, 1, 2, 2, 123, 35, 135, 123, 1, 1, 2, 234, 100, 100, 0, 0, 100, 0, 3, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(38, 'sagate', 'Hombre', 6, 0, 1, 6, 1, 1000, 2, 3, 1, 2, 3, 3, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(39, 'uruk', 'Hombre', 1, 0, 1, 2, 3, 1, 1, 3, 1, 1, 1, 1, 2, 49, 100, 0, 0, 700, 0, 3, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(40, 'nombrelarguisimo', 'Hombre', 2, 0, 1, 2, 1, 1, 1, 1, 2, 1, 1, 1, 3, 100, 100, 0, 0, 64, 0, 0, 0, '2019-04-22 08:46:10', '2019-04-22 13:21:11', '2019-04-22 13:21:11'),
(41, 'keane', 'Hombre', 9, 0, 1, 9, 1, 3, 1, 1, 1, 1, 1, 2, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-04-24 12:14:32', '2019-04-24 12:14:32', '2019-04-24 12:14:32'),
(49, 'obelix', 'Hombre', 9, 0, 1, 1, 1, 2, 3, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-05-04 12:48:34', '2019-05-04 12:48:34', '2019-05-04 12:48:34'),
(42, 'sweet', 'Mujer', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 62, 0, 0, 0, '2019-05-01 14:25:13', '2019-05-01 14:25:13', '2019-05-01 14:25:13'),
(43, 'sweet', 'Mujer', 4, 0, 1, 4, 1, 1, 1, 1, 1, 1, 1, 2, 1, 100, 100, 0, 0, 100, 100, 0, 0, '2019-05-01 14:26:47', '2019-05-01 14:26:47', '2019-05-01 14:26:47'),
(44, 'superfrog', 'Mujer', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-05-03 08:22:30', '2019-05-03 08:22:30', '2019-05-03 08:22:30'),
(45, 'bimbo', 'Mujer', 1, 19, 1, 1, 1, 123, 123, 123, 123, 123, 123, 123, 123, 100, 70, 2, 0, 121, 0, 0, 0, '2019-05-03 15:39:48', '2019-05-03 15:39:48', '2019-05-03 15:39:48'),
(46, 'bimbo', 'Mujer', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-05-03 15:39:58', '2019-05-03 15:39:58', '2019-05-03 15:39:58'),
(47, 'vanvan', 'Mujer', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 79, 0, 0, 0, '2019-05-03 16:40:23', '2019-05-03 16:40:23', '2019-05-03 16:40:23'),
(48, 'guido', 'Mujer', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-05-03 21:52:40', '2019-05-03 21:52:40', '2019-05-03 21:52:40'),
(50, 'Rikka', 'Hombre', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-05-04 16:48:13', '2019-05-04 16:48:13', '2019-05-04 16:48:13'),
(51, 'casanova', 'Hombre', 1, 0, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 3, 100, 100, 0, 0, 75, 0, 0, 0, '2019-06-27 15:25:59', '2019-06-27 15:25:59', '2019-06-27 15:25:59'),
(52, 'lechugo', 'Mujer', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-06-27 16:52:59', '2019-06-27 16:52:59', '2019-06-27 16:52:59'),
(53, 'lechugo', 'Mujer', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, 100, 0, 0, 100, 0, 0, 0, '2019-06-27 16:53:33', '2019-06-27 16:53:33', '2019-06-27 16:53:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `popularidad`
--

DROP TABLE IF EXISTS `popularidad`;
CREATE TABLE IF NOT EXISTS `popularidad` (
  `idP` int(11) NOT NULL,
  `idS` int(11) NOT NULL,
  `puntos` int(11) NOT NULL,
  PRIMARY KEY (`idP`,`idS`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `popularidad`
--

INSERT INTO `popularidad` (`idP`, `idS`, `puntos`) VALUES
(41, 22, 0),
(41, 45, 0),
(41, 65, 0),
(41, 85, 0),
(41, 95, 0),
(41, 105, 0),
(41, 175, 0),
(41, 135, 0),
(41, 155, 0),
(41, 165, 0),
(1, 22, 11),
(1, 45, 0),
(1, 65, 0),
(1, 85, 0),
(1, 95, 0),
(1, 105, 3),
(1, 175, 0),
(1, 135, 0),
(1, 155, 0),
(1, 165, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progresos`
--

DROP TABLE IF EXISTS `progresos`;
CREATE TABLE IF NOT EXISTS `progresos` (
  `idP` int(11) NOT NULL,
  `idM` int(11) NOT NULL,
  `progreso` int(11) NOT NULL,
  `completada` int(11) NOT NULL,
  PRIMARY KEY (`idP`,`idM`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `progresos`
--

INSERT INTO `progresos` (`idP`, `idM`, `progreso`, `completada`) VALUES
(1, 1, 3, 1),
(1, 3, 2, 0),
(1, 7, 3, 0),
(1, 6, 1, 0),
(1, 8, 2, 0),
(1, 10, 3, 1),
(1, 11, 4, 1),
(1, 13, 3, 1),
(1, 14, 1, 1),
(1, 15, 5, 1),
(1, 2, 1, 1),
(1, 17, 3, 0),
(1, 18, 2, 1),
(1, 19, 4, 1),
(1, 20, 4, 1),
(1, 21, 1, 1),
(1, 4, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `siguientespot`
--

DROP TABLE IF EXISTS `siguientespot`;
CREATE TABLE IF NOT EXISTS `siguientespot` (
  `idP` int(255) NOT NULL,
  `idS` int(255) NOT NULL,
  `idZ` int(255) NOT NULL,
  `idB` int(255) NOT NULL,
  PRIMARY KEY (`idP`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `siguientespot`
--

INSERT INTO `siguientespot` (`idP`, `idS`, `idZ`, `idB`) VALUES
(1, 110, 2, 6),
(43, 1, 1, 1),
(44, 1, 1, 9),
(45, 0, 1, 9),
(46, 1, 1, 9),
(47, 1, 1, 1),
(48, 1, 1, 4),
(49, 1, 1, 1),
(50, 1, 1, 7),
(51, 1, 1, 3),
(52, 1, 1, 5),
(53, 1, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `spots`
--

DROP TABLE IF EXISTS `spots`;
CREATE TABLE IF NOT EXISTS `spots` (
  `idS` int(255) NOT NULL,
  `idZ` int(255) NOT NULL,
  `idB` int(255) NOT NULL,
  `nombre` varchar(80) COLLATE latin1_spanish_ci NOT NULL,
  `corto` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `principal` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `secundario` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `fila` varchar(1) COLLATE latin1_spanish_ci NOT NULL,
  `columna` int(20) NOT NULL,
  `tipo` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `imagenSpot` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`idS`,`idZ`,`idB`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `spots`
--

INSERT INTO `spots` (`idS`, `idZ`, `idB`, `nombre`, `corto`, `principal`, `secundario`, `fila`, `columna`, `tipo`, `imagenSpot`) VALUES
(9, 1, 1, 'Fogata Ritual', 'eventoFogataRitual', '', '', 'J', 5, 'evento', 'fogataRitual.png'),
(3, 1, 1, 'Bar Un Alto en el Camino', 'barUnAlto', '', '', 'G', 10, 'bar', 'unAlto.png'),
(4, 1, 1, 'Parroquia de Ca&ntilde;amares\r', 'iglesiaParroquia', '', '', 'G', 4, 'iglesia', 'parroquia.png'),
(8, 1, 1, 'Todo para tu Mascota', 'tiendaTodoParaTuMascota', '', '', 'I', 9, 'tienda', 'todoParaTuMascota.png'),
(22, 1, 2, 'Centro de la Mujer', 'socialCentroMujer', '', '', 'D', 6, 'social', 'centroMujer.png'),
(1, 1, 1, 'Plaza Pilanc&oacute;n de los Burros\r\n', 'emboscadaPilancon', '', '', 'C', 11, 'emboscada', 'pilanconBurros.png'),
(6, 1, 1, 'Carril Bici', 'entrenamientoCarrilBici', 'Resistencia: Media-Alta', 'Agilidad: Media-Alta', 'L', 7, 'entrenamiento', 'carrilbiciasdrubal.png'),
(5, 1, 1, 'Excursi&oacute;n a Los Pinos\r\n', 'aventuraLosPinos', 'Visibilidad: Alta', 'Dificultad: Media', 'L', 9, 'aventura', 'losPinos.png'),
(110, 2, 6, 'Bar Bohemios', 'barBohemios', '', '', 'B', 3, 'bar', 'bohemios.png'),
(2, 1, 1, 'Rio Ojail&eacute;n Grand Prix\r\n', 'apuestasCocodrilos', '', '', 'M', 3, 'apuestas', 'cocodrilos.jpg'),
(111, 2, 6, 'Tatuajes La Mala Vida', 'estiloTatuajes', '', '', 'G', 3, 'estilo', 'estiloTatuajes.png'),
(20, 1, 2, 'Plaza del Gongo', 'apuestasCaras', '', '', 'B', 7, 'apuestas', 'caras.png'),
(80, 2, 5, 'Sal&oacute;n Joker\r\n', 'apuestasRuletaJoker', '', '', 'L', 4, 'apuestas', 'joker.png'),
(100, 1, 6, 'Luckia Tragaperras', 'apuestasTragaperrasLuckia', '', '', 'L', 11, 'apuestas', 'luckia.png'),
(41, 3, 2, 'Aeromodelismo Survival', 'apuestasAviones', '', '', 'M', 9, 'apuestas', 'aviones.png'),
(7, 1, 1, 'Cerrajer&iacute;a Puertollano SL\r\n', 'cerrajeriaPuertollano', '', '', 'E', 8, 'cerrajeria', 'cerrajeriaPuertollano.png'),
(21, 1, 2, 'PescaBass', 'tiendaPescaBass', '', '', 'H', 5, 'tienda', 'pescabass.png'),
(160, 2, 9, 'El Muro', 'trabajoMuro', '', '', 'D', 6, 'trabajo', 'muro.png'),
(112, 2, 6, 'Hotel Santa Eulalia', 'hotelSantaEulalia', '', '', 'G', 10, 'hotel', 'santaEulalia.png'),
(120, 3, 6, 'Peluquer&iacute;a El Paisano\r\n', 'estiloElPaisano', '', '', 'G', 4, 'estilo', 'elPaisano.png'),
(0, 1, 1, 'Corredor de Apuestas', 'trabajoApuestas', '', '', 'L', 4, 'trabajo', 'trabajoApuestas.png'),
(49, 3, 2, 'Emergencia Fantasma', 'eventoEmergenciaFantasma', '', '', 'K', 7, 'evento', ''),
(19, 2, 1, 'Cronoescalada', 'eventoCronoescalada', '', '', 'J', 3, 'evento', ''),
(79, 1, 5, 'Subida a Chimenea Cuadr&aacute;', 'eventoChimenea', '', '', 'B', 10, 'evento', 'chimeneaCuadra.png'),
(69, 1, 4, 'Errante Dial&eacute;ctico', 'eventoErrante', '', '', 'G', 10, 'evento', 'errante.png'),
(99, 3, 5, 'Mural de Okuda San Miguel', 'eventoOkuda', '', '', 'G', 6, 'evento', 'okuda2.png'),
(139, 1, 7, 'Patriarca GiThanos', 'eventoPatriarca', '', '', 'K', 5, 'evento', ''),
(179, 3, 9, 'T&oacute;mbola Carrera de Camellos', 'eventoTombola', '', '', 'I', 7, 'evento', ''),
(119, 2, 6, 'Viejo M&uacute;sico', 'eventoMusico', '', '', 'K', 8, 'evento', ''),
(149, 1, 8, 'Fuente de Hadas', 'eventoHadas', '', '', 'F', 7, 'evento', ''),
(129, 3, 6, 'Ollas del Santo Voto', 'eventoVoto', '', '', 'E', 8, 'evento', 'ollasVoto.png'),
(109, 1, 6, 'Desvalijador de Tiendas', 'eventoDesvalijador', '', '', 'I', 7, 'evento', ''),
(159, 1, 9, 'Cubos frente al Wok', 'eventoWok', '', '', 'F', 4, 'evento', ''),
(189, 1, 10, 'Susurro del Bosque', 'eventoSusurro', '', '', 'L', 6, 'evento', ''),
(29, 1, 2, 'La M&aacute;scara Feliz', 'eventoMascaras', '', '', 'D', 4, 'evento', 'mascara.png'),
(59, 1, 3, 'Fiestas de la Barriada', 'eventoFiesta', '', '', 'E', 6, 'evento', 'fiestaBarriada'),
(89, 2, 5, 'Concierto Krater Rock City', 'eventoKrater', '', '', 'C', 4, 'evento', 'krater.png'),
(169, 2, 9, 'Maestre Trapichero', 'eventoMaestre', '', '', 'G', 4, 'evento', 'maestre.png'),
(39, 2, 2, 'Altar de Sacrificio', 'eventoSacrificio', '', '', 'F', 4, 'evento', 'sacrificio.png'),
(101, 1, 6, 'Multicines Ortega', 'culturaCine', 'Percepci&oacute;n', 'Ingenio', 'G', 3, 'cultura', 'cine.png'),
(50, 1, 3, 'Saloon Los Arcos', 'barLosArcos', '', '', 'C', 7, 'bar', 'losArcos.png'),
(60, 1, 4, 'El Asador del Club', 'barAsador', '', '', 'D', 6, 'bar', 'asador.png'),
(70, 1, 5, 'Lounge Bar La Plaza', 'barLounge', '', '', 'H', 8, 'bar', 'lounge.png'),
(10, 2, 1, 'Asador Casa Gin&eacute;s', 'barGines', '', '', 'C', 12, 'bar', 'gines.png'),
(130, 1, 7, 'Cafeter&iacute;a del Doctor Lim&oacute;n', 'barLimon', '', '', 'G', 5, 'bar', 'barDoctorLimon.png'),
(170, 3, 9, 'Lavacoches San Cristobal', 'estiloLavacoches', '', '', 'C', 11, 'estilo', 'lavacoches.png'),
(11, 2, 1, 'Criba de Oro', 'trabajoCriba', '', '', 'L', 7, 'trabajo', 'criba.png'),
(23, 1, 2, 'Bar El Bomba', 'barBomba', '', '', 'I', 7, 'bar', 'barBomba.png'),
(151, 1, 9, 'Colegio Severo Ochoa', 'aventuraColegio', 'Dificultad: Baja', 'Visibilidad: Alta', 'C', 4, 'aventuras', 'colegio.png'),
(155, 1, 9, 'Hospital Santa B&aacute;rbara', 'socialHospital', '', '', 'B', 7, 'social', 'hospital.png'),
(175, 3, 9, 'Plaza de Toros', 'socialToros', '', '', 'K', 4, 'social', 'toros.png'),
(85, 2, 5, 'Discotecas de la Numancia', 'socialDiscotecas', '', '', 'D', 3, 'social', 'discotecas.png'),
(61, 1, 4, 'Campo de Petanca', 'entrenamientoPetanca', 'Destreza', 'Fuerza', 'F', 5, 'gimnasio', 'petanca.png'),
(51, 1, 3, 'Cruce de Caminos', 'emboscadaAbulagar', '', '', 'I', 9, 'emboscada', 'cruceCaminos.png'),
(62, 1, 4, 'Cementerio', 'aventuraCementerio', 'Dificultad: Alta', 'Visibilidad: Baja', 'H', 12, 'aventura', 'cementerio.png'),
(90, 3, 5, 'Subir al Minero', 'aventuraMinero', 'Dificultad: Media', 'Visibilidad: Alta', 'C', 11, 'aventura', 'minero.png'),
(171, 3, 9, 'Mercadillo', 'tiendaMercadillo', '', '', 'G', 9, 'tienda', 'mercadillo.png'),
(161, 2, 9, 'Patio de Armas', 'gimnasioPatio', '', '', 'F', 7, 'gimnasio', 'patioEntrenamiento.png'),
(180, 1, 10, 'Club Social Los Juncos', 'barJuncos', '', '', 'B', 2, 'bar', 'juncos.png'),
(131, 1, 7, 'Solar en Obras', 'trabajoObras', '', '', 'J', 6, 'trabajo', 'obras.png'),
(81, 2, 5, 'Galer&iacute;as del Tauro', 'aventuraTauro', 'Dificultad: Media', 'Visibilidad: Baja', 'K', 5, 'aventura', 'galeriasTauro.png'),
(30, 2, 2, 'Bar Longinos', 'barLonginos', '', '', 'F', 10, 'bar', 'longinos.png'),
(31, 2, 2, 'Niebla Espesa', 'aventuraNiebla', 'Dificultad: Media', 'Visibilidad: Muy Baja', 'G', 6, 'aventura', 'niebla.png'),
(71, 1, 5, 'Parroquia de Mar&iacute;a Auxiliadora', 'aventuraSalesianos', 'Esp&iacute;ritu: Alto', '', 'G', 10, 'aventura', 'iglesiaSalesianos.png'),
(40, 3, 2, 'Escuela Oficial de Idiomas', 'culturaEOI', 'Ingenio', 'Percepci&oacute;n', 'E', 2, 'cultura', 'eoi.png'),
(140, 1, 8, 'Chocolater&iacute;a Osiris', 'barOsiris', '', '', 'H', 8, 'bar', 'osiris.png'),
(24, 1, 2, 'Euroel', 'tiendaEuroel', '', '', 'H', 10, 'tienda', 'euroel.png'),
(12, 2, 1, 'Puesto de Intendencia', 'tiendaIntendencia', '', '', 'G', 11, 'tienda', 'intendencia.png'),
(13, 2, 1, 'Cerrajer&iacute;a de Thorin', 'cerrajeriaThorin', '', '', 'F', 9, 'cerrajeria', 'cerrajeriaThorin.png'),
(14, 2, 1, 'Entrada al Terri', 'aventuraTerri', 'Visibilidad: Media', 'Dificultad: Baja', 'L', 3, 'aventura', 'entradaTerri.png'),
(15, 2, 1, 'Traves&iacute;a Minera', 'emboscadaTravesiaMinera', '', '', 'I', 6, 'emboscada', 'travesiaMinera.png'),
(16, 2, 1, 'C&aacute;mara del Oro', 'bancoCamaraOro', '', '', 'F', 6, 'banco', 'camaraOro.png'),
(25, 1, 2, 'Motos Carrasco', 'tiendaMotosCarrasco', '', '', 'K', 6, 'tienda', 'motosCarrasco.png'),
(26, 1, 2, 'Plaza del Minero', 'emboscadaPlazaMinero', '', '', 'M', 3, 'emboscada', 'plazaMinero.png'),
(27, 1, 2, 'Bulevar Comercial', 'aventuraBulevar', 'Visibilidad: Alta', 'Dificultad: Media', 'F', 5, 'aventura', 'bulevarComercial.png'),
(28, 1, 2, 'Saboteador', 'trabajoSaboteador', '', '', 'G', 7, 'trabajo', 'saboteador.png'),
(32, 2, 2, 'Plaza del Padre Poveda', 'emboscadaPoveda', '', '', 'E', 8, 'emboscada', 'poveda.png'),
(33, 2, 2, 'Kiosko Mois&eacute;s', 'tiendaMoises', '', '', 'C', 2, 'tienda', 'moises.png'),
(34, 2, 2, 'Quitanieves', 'trabajoQuitanieves', '', '', 'J', 6, 'trabajo', 'quitanieves.png'),
(35, 2, 2, 'Iglesia de San Jos&eacute;', 'iglesiaSanJose', '', '', 'H', 4, 'iglesia', 'sanJose.png'),
(42, 3, 2, 'Piscina Modesto Eiroa', 'entrenamientoModesto', '', '', 'B', 5, 'entrenamiento', 'modesto.png'),
(45, 3, 2, 'Circuito Carrera del D&iacute;a del Chorizo\r\n', 'socialChorizo', '', '', 'G', 8, 'social', 'chorizo.png'),
(43, 3, 2, 'Parque Pozo Norte', 'aventuraPozo', '', '', 'I', 6, 'aventura', 'parquePozoNorte.png'),
(44, 3, 2, 'Museo de la Miner&iacute;a', 'trabajoMuseo', '', '', 'J', 8, 'trabajo', 'museoMineria.png'),
(46, 3, 2, 'Aparcamiento Pozo Norte', 'emboscadaPozo', '', '', 'J', 10, 'emboscada', 'aparcamientoPozo.png'),
(47, 3, 2, 'Kebab-Truck', 'barKebab', '', '', 'C', 3, 'bar', 'kebabTruck.png'),
(52, 1, 3, 'C.E.P.A. Antonio Machado', 'culturaCEPA', '', '', 'E', 2, 'cultura', 'CEPA.png'),
(53, 1, 3, 'Protectora Animal Huellas', 'tiendaHuellas', '', '', 'L', 11, 'tienda', 'huellas.png'),
(54, 1, 3, 'Posada Los Arcos', 'hotelLosArcos', '', '', 'C', 8, 'hotel', 'posadaLosArcos.png'),
(55, 1, 3, 'Tierras &Aacute;ridas', 'aventuraAbulagar', '', '', 'K', 7, 'aventura', 'tierrasAridas.png'),
(56, 1, 3, 'Patrulla Sheriff', 'trabajoSheriff', '', '', 'E', 8, 'trabajo', 'sheriff.png'),
(57, 1, 3, 'Rodeo', 'gimnasioRodeo', '', '', 'J', 3, 'gimnasio', 'rodeo.png'),
(58, 1, 3, 'Banco', 'bancoAbulagar', '', '', 'G', 6, 'banco', 'bancoAbulagar.png'),
(63, 1, 4, 'Iglesia Santa B&aacute;rbara', 'iglesiaSantaBarbara', '', '', 'C', 3, 'iglesia', 'iglesiaSantaBarbara.png'),
(64, 1, 4, 'Campo de Entrenamiento de F&uacute;tbol\r\n', 'trabajoFutbol', '', '', 'J', 8, 'trabajo', 'trabajoFutbol.png'),
(65, 1, 4, 'Estadio El Cerr&uacute;', 'socialCerru', '', '', 'H', 8, 'social', 'cerru.png'),
(66, 1, 4, 'C&eacute;sped del Poblado\r\n', 'emboscadaCesped', '', '', 'F', 2, 'emboscada', 'cespedPoblado.png'),
(67, 1, 4, 'Pistas del Gali', 'entrenamientoGali', '', '', 'H', 6, 'entrenamiento', 'gali.png'),
(72, 1, 5, 'Gimnasio &Eacute;lite\r\n', 'gimnasioElite', '', '', 'K', 11, 'gimnasio', 'elite.png'),
(73, 1, 5, 'Plaza Mar&iacute;a Auxiliadora', 'emboscadaSalesianos', '', '', 'I', 10, 'emboscada', 'plazaMariaAux.png'),
(74, 1, 5, 'Pasar el Cepillo', 'trabajoCepillo', '', '', 'G', 11, 'trabajo', 'cepillo.png'),
(75, 1, 5, 'Cerrajer&iacute;a CLAUS', 'cerrajeriaCLAUS', '', '', 'J', 4, 'cerrajeria', 'claus.png'),
(76, 1, 5, 'Enruedas Bike', 'tiendaEnruedas', '', '', 'J', 7, 'tienda', 'enruedas.png'),
(77, 1, 5, 'Hostal Emi-Ros', 'hotelEmi', '', '', 'K', 9, 'hotel', 'emiros.png'),
(82, 2, 5, 'Mercado Municipal de Abastos', 'tiendaMercado', '', '', 'I', 4, 'tienda', 'mercado.png'),
(83, 2, 5, 'Hostal de la Angelita', 'hotelAngelita', '', '', 'G', 9, 'hotel', 'angelita.png'),
(84, 2, 5, 'Helados Romero', 'barRomero', '', '', 'L', 7, 'bar', 'heladosRomero.png'),
(86, 2, 5, 'Plaza del Doctor Fleming', 'emboscadaFleming', '', '', 'K', 10, 'emboscada', 'fleming.png'),
(87, 2, 5, 'Relaciones P&uacute;blicas', 'trabajoRelaciones', '', '', 'F', 3, 'trabajo', 'relacionesPublicas.png'),
(88, 2, 5, 'Gimnasio Titanes', 'gimnasioTitanes', '', '', 'C', 2, 'gimnasio', 'titanes.png'),
(92, 3, 5, 'VideoWorld', 'tiendaVideoworld', '', '', 'L', 7, 'tienda', 'videoworld.png'),
(91, 3, 5, 'Casa de la Cultura', 'culturaCasaCultura', '', '', 'E', 4, 'cultura', 'casaCultura.png'),
(93, 3, 5, 'Pistas de Tenis', 'gimnasioTenis', '', '', 'G', 8, 'gimnasio', 'tenis.png'),
(95, 3, 5, 'Auditorio Municipal', 'socialAuditorio', '', '', 'G', 4, 'social', 'auditorio.png'),
(96, 3, 5, 'Bar La Copa', 'barLaCopa', '', '', 'H', 2, 'bar', 'barLaCopa.png'),
(97, 3, 5, 'Los Pinillos', 'emboscadaPinillos', '', '', 'C', 7, 'emboscada', 'pinillos.png'),
(94, 3, 5, 'Piscina de Verano', 'trabajoPiscina', '', '', 'F', 7, 'trabajo', 'piscinaCopa.png'),
(102, 1, 6, 'Plaza de la Tercia', 'emboscadaTercia', '', '', 'K', 6, 'emboscada', 'tercia.png'),
(103, 1, 6, 'Restaurante El Mesoncito', 'barMesoncito', '', '', 'H', 8, 'bar', 'mesoncito.png'),
(104, 1, 6, '&Oacute;ptica Epat', 'tiendaOpticaEpat', '', '', 'J', 7, 'tienda', 'opticaEpat.png'),
(105, 1, 6, 'Museo Municipal', 'socialMuseo', '', '', 'F', 3, 'social', 'museoMunicipal.png'),
(106, 1, 6, 'Iglesia de la Asunci&oacute;n\r\n', 'iglesiaAsuncion', '', '', 'G', 2, 'iglesia', 'iglesiaAsuncion.png'),
(107, 1, 6, 'Soborno de Autoridades', 'trabajoSoborno', '', '', 'G', 5, 'trabajo', 'soborno.png'),
(108, 1, 6, 'Ayuntamiento de Puertollano', 'aventuraAyuntamiento', '', '', 'E', 5, 'aventura', 'ayuntamiento.png'),
(113, 2, 6, 'Armer&iacute;a Peral', 'tiendaArmeriaPeral', '', '', 'B', 9, 'tienda', 'armeriaPeral.png'),
(78, 1, 5, 'Cl&iacute;nica PuertoDental\r\n', 'estiloPuertodental', '', '', 'K', 2, 'estilo', 'puertodental.png'),
(115, 2, 6, 'Fuente Agria', 'tiendaFuenteAgria', '', '', 'H', 7, 'tienda', 'fuenteAgria.png'),
(116, 2, 6, 'Concha de la M&uacute;sica\r\n', 'emboscadaConcha', '', '', 'F', 6, 'emboscada', 'concha.png'),
(117, 2, 6, 'Fuentes del Paseo', 'trabajoFuentes', '', '', 'C', 6, 'trabajo', 'fuentesPaseo.png'),
(118, 2, 6, 'Jardines del Paseo', 'aventuraPaseoSanGregorio', '', '', 'J', 5, 'aventura', 'jardinesPaseo.png'),
(121, 3, 6, 'Bicis Ruta', 'tiendaRuta', '', '', 'I', 2, 'tienda', 'ruta.png'),
(122, 3, 6, 'Gimnasio Kim', 'gimnasioKim', '', '', 'L', 2, 'gimnasio', 'kim.png'),
(123, 3, 6, 'Iglesia Virgen de Gracia', 'iglesiaVirgenGracia', '', '', 'D', 6, 'iglesia', 'virgenGracia.png'),
(124, 3, 6, 'Venta de Romero', 'trabajoRomero', '', '', 'C', 5, 'trabajo', 'ventaRomero.png'),
(125, 3, 6, 'Bar Molina', 'barMolina', '', '', 'J', 4, 'bar', 'molina.png'),
(126, 3, 6, 'Caminillo', 'emboscadaCaminillo', '', '', 'B', 11, 'emboscada', 'caminillo.png'),
(127, 3, 6, 'Ruinas Romanas', 'aventuraPaseoElBosque', '', '', 'H', 7, 'aventura', 'aventuraPaseoElBosque.png'),
(132, 1, 7, 'Parroquia de Las Mercedes', 'iglesiaMercedes', '', '', 'H', 2, 'iglesia', 'iglesiaMercedes.png'),
(133, 1, 7, 'Sala de Lecturas P&uacute;blica', 'culturaLecturas', '', '', 'H', 7, 'cultura', 'lecturas.png'),
(134, 1, 7, 'Plaza El Laurel', 'emboscadaLaurel', '', '', 'J', 9, 'emboscada', 'plazaLaurel.png'),
(135, 1, 7, 'La Central - Palacio de Congresos y Exposiciones', 'socialCentral', '', '', 'L', 2, 'social', 'laCentral.png'),
(136, 1, 7, 'Chozas en Derribo', 'aventuraChozas', '', '', 'C', 7, 'aventura', 'derribo.png'),
(137, 1, 7, 'Top Manta', 'tiendaTopManta', '', '', 'D', 9, 'tienda', 'topManta.png'),
(141, 1, 8, 'Las Antenas', 'aventuraAntena', '', '', 'B', 4, 'aventura', 'antena.png'),
(142, 1, 8, 'Monumento a la Miner&iacute;a', 'emboscadaMonumentoMineria', '', '', 'L', 9, 'emboscada', 'monumentoMineria.png'),
(143, 1, 8, 'C&aacute;rtel del Carmen', 'trabajoCartel', '', '', 'D', 6, 'trabajo', 'cartelCarmen.png'),
(144, 1, 8, 'Banco M&aacute;gico de Gringotts\r\n', 'bancoGringotts', '', '', 'H', 5, 'banco', 'gringotts.png'),
(145, 1, 8, 'Calzados Perea', 'tiendaPerea', '', '', 'I', 10, 'tienda', 'calzadosPerea.png'),
(150, 1, 9, 'Hotel Caba&ntilde;as', 'hotelCabanas', '', '', 'J', 8, 'hotel', 'hotelcabanas.png'),
(152, 1, 9, 'Aparcamiento del Hospital', 'trabajoAparcamiento', '', '', 'C', 9, 'trabajo', 'aparcamientoHospital.png'),
(153, 1, 9, 'Bar Vigar', 'barVigar', '', '', 'H', 5, 'bar', 'barVigar.png'),
(154, 1, 9, 'Conservatorio de M&uacute;sica', 'culturaConservatorio', '', '', 'G', 6, 'cultura', 'conservatorio.png'),
(156, 1, 9, 'Parque las Pocitas', 'emboscadaPocitas', '', '', 'J', 5, 'emboscada', 'parquePocitas.png'),
(157, 1, 9, 'Circuito de Karts', 'entrenamientoKarts', '', '', 'J', 10, 'entrenamiento', 'karts.png'),
(162, 2, 9, 'M&aacute;s all&aacute; del Muro\r\n', 'aventuraMuro', '', '', 'B', 7, 'aventura', 'masMuro.png'),
(163, 2, 9, 'Biblioteca del viejo Maestre', 'culturaMaestre', '', '', 'F', 3, 'cultura', 'bibliotecaMaestre.png'),
(165, 2, 9, 'Ofrenda a los Antiguos Dioses', 'socialAntiguos', '', '', 'K', 3, 'social', 'ofrendaDioses.png'),
(164, 2, 9, 'Burdel Villa Topo', 'hotelBurdel', '', '', 'L', 9, 'hotel', 'burdel.png'),
(166, 2, 9, 'Carreta de V&iacute;veres', 'barViveres', '', '', 'J', 8, 'bar', 'carretaViveres.png'),
(167, 2, 9, 'Guardaoriente', 'emboscadaPAU', '', '', 'E', 11, 'emboscada', 'guardaoriente.png'),
(172, 3, 9, 'Hotel Verona', 'hotelVerona', '', '', 'B', 10, 'hotel', 'hotelVerona.png'),
(173, 3, 9, 'Centro de Especialidades Deportivas', 'gimnasioCED', '', '', 'E', 6, 'gimnasio', 'ced.png'),
(174, 3, 9, 'Estanque de Los Patos', 'aventuraPatos', '', '', 'G', 4, 'aventura', 'patos.png'),
(176, 3, 9, 'Aparcamiento del Estadio', 'emboscadaEstadio', '', '', 'E', 10, 'emboscada', 'aparcamientoEstadio.png'),
(177, 3, 9, 'Carterismo', 'trabajoCarterismo', '', '', 'I', 9, 'trabajo', 'carterismo.png'),
(178, 3, 9, 'Bar Deportivo', 'barDeportivo', '', '', 'L', 7, 'bar', 'barDeportivo.png'),
(181, 1, 10, 'Centro Nacional del Hidr&oacute;geno', 'culturaHidrogeno', '', '', 'D', 5, 'cultura', 'hidrogeno.png'),
(182, 1, 10, 'Senda de la Bici', 'entrenamientoSenda', '', '', 'H', 7, 'entrenamiento', 'sendaBici.png'),
(183, 1, 10, 'Luchena Motorbikes', 'tiendaLuchena', '', '', 'I', 11, 'tienda', 'luchena.png'),
(184, 1, 10, 'Parada de Bus', 'emboscadaBus', '', '', 'H', 4, 'emboscada', 'paradaBus.png'),
(185, 1, 10, 'Aduana Ciudad Jard&iacute;n', 'trabajoAduana', '', '', 'H', 9, 'trabajo', 'aduana.png'),
(186, 1, 10, 'Hamaca entre Palmeras', 'hotelHamaca', '', '', 'E', 2, 'hotel', 'hamacaPalmeras.png'),
(187, 1, 10, 'Jardines Privados', 'aventuraJardines', '', '', 'K', 3, 'aventura', 'jardinesPrivados.png'),
(36, 2, 2, 'Banco Mystery\r\n', 'bancoSilentJose', '', '', 'I', 9, 'banco', 'bancoSilentJose.png'),
(98, 3, 5, 'Centro de Est&eacute;tica CyM', 'estiloCyM', '', '', 'J', 6, 'estilo', 'cym.png'),
(17, 2, 1, 'MotoClub Mineros', 'tiendaMotoclub', '', '', 'D', 6, 'tienda', '17.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `survivals`
--

DROP TABLE IF EXISTS `survivals`;
CREATE TABLE IF NOT EXISTS `survivals` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL,
  `ganador` int(11) NOT NULL,
  `premio` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `survivals`
--

INSERT INTO `survivals` (`id`, `fecha`, `ganador`, `premio`) VALUES
(5, '2019-04-17 08:00:00', 39, 888),
(8, '2019-04-26 22:00:00', 26, 205),
(9, '2019-05-05 10:00:00', 1, 135),
(1, '2019-05-03 22:00:00', 0, 370),
(0, '2019-05-10 22:00:00', 0, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiempos`
--

DROP TABLE IF EXISTS `tiempos`;
CREATE TABLE IF NOT EXISTS `tiempos` (
  `idM` int(255) NOT NULL,
  `idP` int(255) NOT NULL,
  `deadline` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idM`,`idP`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tiempos`
--

INSERT INTO `tiempos` (`idM`, `idP`, `deadline`) VALUES
(4, 1, '2019-06-06 17:52:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `password` char(60) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(60) COLLATE latin1_spanish_ci NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `creationDate`) VALUES
(1, 'dani', '$2y$12$73JgfYT6gRtUM7vkdtcZFu2LJV/UAabCHbd1IhQINQ7KfS0KY3lWW', 'dani91gr@hotmail.com', '2019-02-11 10:53:31'),
(2, 'pepe', '$2y$12$LZneGEbKYTYETCHTu.r2keqn0TaoCt0Yez2qIcawemVaPAn75EUIy', 'pepe@go', '2019-02-11 10:54:10'),
(3, 'prueba', '$2y$12$/M8RjsNa02R9Wg0.1KrM7eNrV.ZZADby9FPJXoVR5VOizSRiMt9Sm', 'sa@as', '2019-02-13 18:44:29'),
(4, 'samu', '$2y$12$FLmA.2koKFDa3uchLJwbqeShBLn2xriFNs5YkM6cF62MAgaayDEtS', 'samu@asd', '2019-02-13 18:49:32'),
(5, 'andres', '$2y$12$ZgrEpJHumD6lFJtN.01Rw.kC8yppm4g407ztNOpCJ27HUeLYNVsCO', 'andres@moon', '2019-02-13 18:55:38'),
(6, 'valencia', '$2y$12$apURjM32cTJoXrGM9bXfcuWZlb4W.V3lA6PYJsCExzId5TtBpReAe', 'asafsafa@asd', '2019-02-13 18:57:50'),
(7, 'Andrea', '$2y$12$3uGaOUupqIW2FUpmNwoJ3eaCY7MFszRLLfVc5Tzwusy6sVQ4iaHGK', 'asdafasg@asdasf', '2019-02-13 18:59:27'),
(8, 'blanca', '$2y$12$gBcW.tRrMYMancoSnKtWWeJPb9gmZzqAuVjTOQFp9Lt/XvxrFBU2O', 'asdasfg@asfa', '2019-02-13 19:08:14'),
(9, 'rafael', '$2y$12$x8JC82XFIvvyZxVLLcInhO8g3XYCTmfiQkCV24wKYt8VC2CKLKF.G', 'asfdag@asfasfg', '2019-02-13 19:12:45'),
(10, 'roberto', '$2y$12$RD7O/j/Rr9xYQ/uRxQKVz.b0KyU7Wisdvyj3MsLo44Z18YZ9JVbGq', 'asd@asda', '2019-02-13 20:22:15'),
(11, 'miau', '$2y$12$toKXb9up4FU7R3dAQONk5u48XJHS/ukEm.LB0539LD.g/vohcVcYi', 'asdasf2as@asf', '2019-02-13 20:23:47'),
(12, 'alberto', '$2y$12$.VdS9bywt1eLKmSK8BZUHu3Nb/otV4MjbQ4k1HcwcDxzJcF6O.BRG', 'asdaf@dgg', '2019-02-13 20:27:06'),
(13, 'insertalo', '$2y$12$eqtU0uMeimrxHTRACzouz.UJNezWJyCcmXMF6J3PmW70eqjJLGpte', 'ansd@as', '2019-02-13 20:40:50'),
(14, 'macario', '$2y$12$HXLKfL5dGMCB2mG1ITo1peSP9Z6MWsbQ8/Z5Gqv/TK2dFURi2FsI.', 'asdafasgas@asfasf', '2019-02-13 20:46:50'),
(15, 'lulu', '$2y$12$y6oCSNcXHe9qXfaHeddCG.gGSblzjZdGbafvvGKGgd43jhTZMk42i', 'insul@ina', '2019-02-13 21:02:46'),
(16, 'vale', '$2y$12$O9ISigvM0m/2/gQl8LozwezWAdmnIJPa8vL3/d8nnNLvLmX5WaBEq', 'asdasf@asfasf', '2019-02-13 21:04:18'),
(17, 'felix', '$2y$12$nZe71BS.85OoPNNcxAfTFeoGAIVYw6Rb/IAcJYM6o7TO9.VRzmxae', 'asaga@asf', '2019-02-13 21:06:40'),
(18, 'eulalio', '$2y$12$iuec0S3.ky9j3zDB5gZt6O3L6DRmbVojqbzeB1f9PnTKcICGK8dEW', 'asd@dg', '2019-02-13 21:08:13'),
(19, 'manuela', '$2y$12$hJaFEFFTZtOogQwXIoNxre/A.xY5vSeOOFXayJFKUOF04mRttKpV.', 'asdkakfasgf@vj', '2019-02-13 21:13:00'),
(20, 'genoveva', '$2y$12$c2MtIh1zEFLXHZugOhLVO.XfM2aQ0WHz/xGRu5p7Mn/IvnnaBeO0.', 'gfeno@asf', '2019-02-13 21:15:52'),
(21, 'consti', '$2y$12$XywNiIKRgAxifw/Ds5n1aOaE92odZ0FszZSt1AbI9Xaf2zZRil./e', 'qta@asf', '2019-02-13 21:19:51'),
(22, 'blas', '$2y$12$AW9DXN7KvEfgUKQUvrPNGOUe6/S.7KeyXJV5CiuisnT4WmlqbES2u', 'blas@as', '2019-02-13 21:22:47'),
(23, 'petras', '$2y$12$2.qyQAmAwbEVupaMeHQ7uOIXOOkZfwSfghSVfHUUmFaMojW8zqsQm', 'asda@asf', '2019-02-13 21:23:07'),
(24, 'papadopoulos', '$2y$12$m.6YAd6HJ9UnqHahLKlMveLDHHrNxJ4k9uHPXVUs4rUdcPTvIGUQe', 'asfasf@ghk', '2019-02-13 21:23:30'),
(25, 'cosilla', '$2y$12$JwXh/NrYkhTW5PgejqdGO.ujmCTQpnLe.iBR9NfW/6YfjvAL9DpCu', 'cosi@lla', '2019-02-13 21:23:52'),
(26, 'mimimimimim', '$2y$12$GszBUTmNbbSCwKDO6JnK3O9kQp/.rL6C0L3rXpJtS3DHteEqw9.E6', 'dfgdg@zgdgdgxd', '2019-02-13 21:24:23'),
(27, 'parachute', '$2y$12$ZiaTegLskvxUaK/47i6R3e9Lj7HduPhCLZHmKQiGud69RsKfMn49a', 'asdadasd2asfgasg@asd', '2019-02-13 21:24:56'),
(28, 'pirori', '$2y$12$e4pY2IRgmQsGGgi7F2Avduxots/VmtZDV1a5a7vXQpCu3TEow6WBe', 'safa@as', '2019-02-13 21:25:14'),
(29, 'chele', '$2y$12$EibVGr86JVNfr1fL.qOcke5juPnK0KGcDYMMH0k.eoVoR8M.KXjq2', 'asda@asf', '2019-02-13 21:25:30'),
(30, 'borracho', '$2y$12$ABcx0G5V1wvGgkfFP7qCFOPFSyT6Xhq.judJKrfdJR3zmzJhowgku', 'awrawr2asfd@ghj', '2019-02-13 21:25:50'),
(31, 'nene', '$2y$12$vQxU/StJB8LwRhtIWzGiiOVeBd4MQoF3fNikF9f3pJY/gOTAlcniO', 'sadsa@asda', '2019-02-13 21:26:05'),
(32, 'cantador', '$2y$12$LA0AWhacPklOUHJXd5jJM.Z2KOvcdqSM6SgiXXMNyR/RtBwEKKWfO', 'asdfaf2asfafg@asd', '2019-02-13 23:49:45'),
(33, 'testtest', '$2y$12$e6yqaO/GeSWMHDY7Cm.e3e60GsF/II9nQXoXegOXTSJfVFUN.ECAu', 'dani91gr@hotmail.com', '2019-02-14 00:01:01'),
(34, 'abuelo', '$2y$12$.98ikVqq2pITSVMGA6s8ZO5/1qLkClfOLdxc1YYtTzvuIJvO94cmW', 'asd@asd', '2019-02-14 10:12:03'),
(35, 'anabelen', '$2y$12$kYP8KIwoije1M7kYTySJlu5BxbUwFh2Jykc1ClC.e6Y0HyjdCru/K', 'ana@bel', '2019-02-15 10:01:53'),
(37, 'anubis', '$2y$12$h.KwUzI6CqGHR/IjAdtdiuoSMU7m5kfd2OP56QJH0WzqiaVIRDxa2', 'anu@ko', '2019-04-06 22:22:55'),
(38, 'sagate', '$2y$12$AWGsLpDQnZ4BHDa7e.JZF.1Pqlw04S1j6oo4Z0ZcgjsQTt9J0i.YO', 'asdad@as', '2019-04-06 22:24:19'),
(39, 'uruk', '$2y$12$45LaI2ahBwAR/H/h6RitbOD9B3L4OyXSvtQk3IJmp8z.6OGJ2LJuq', 'uruk@hai', '2019-04-06 22:38:49'),
(40, 'nombrelarguisimo', '$2y$12$lrCqxeiJAeLPXiUoe0Pt3eKyYjjt/KlQfl/Z0GJGLH0PFb43PvB9y', '0000@0', '2019-04-21 15:57:16'),
(41, 'keane', '$2y$12$uSk04mhPijYm/VtwraMEDegb7ugulQiNk8TA4CE5cBRVA9L0m74N2', 'keane@ne', '2019-04-24 14:14:32'),
(42, 'sweet', '$2y$12$UnMffPZiR0h2DhwqvvaP2OCbttomaViFx/pxvYxhTfBuKgfHfsLIi', 'swee@et', '2019-05-01 16:25:13'),
(43, 'sweet', '$2y$12$5EiPNUXIZTDEqLTQzzYJj.SBejGzYWIkAWm.KtHackHigNbczjyze', 'swee@et', '2019-05-01 16:26:47'),
(44, 'superfrog', '$2y$12$YHAocr9OLhLJmhhN0W63k.65Gdfsiyv5uZgQgk6RXvx728BN/qKeS', 'super@frog', '2019-05-03 10:22:30'),
(45, 'bimbo', '$2y$12$b7KEns.0GQw2cLQCCNcW7e7A0jGGx1wwBTdtYT6EqlsXykAxF6g.O', 'bim@bo', '2019-05-03 17:39:48'),
(46, 'bimbo', '$2y$12$pSAYqUhbOqWxJMWbICTTX.nhNo7cWeY9g1gBRgj9KUEb.glgIjsrW', 'bim@bo', '2019-05-03 17:39:58'),
(47, 'vanvan', '$2y$12$L0fdbFfboarEENNuPh5hXuicdYpyGR48LzAlar02FmyxPrUwIjZ82', 'van@va', '2019-05-03 18:40:23'),
(48, 'guido', '$2y$12$ZqlREvR/bfy0wg9ABfPqderEGqITscnE6FaODImN5TA.BiCba8i6K', 'gui@do', '2019-05-03 23:52:40'),
(49, 'obelix', '$2y$12$15U1Hf9N6Fq5tSYeUMnIBuu4E3Fw0ymujZPw0cmkSsRCYeKhVDTpm', 'obe@lix', '2019-05-04 14:48:34'),
(50, 'Rikka', '$2y$12$GSw39YaFTF9UHzsnOMi0v.e.BLichWU2z0QeZ0/umW09Hp/sy63lS', 'rikka@as', '2019-05-04 18:48:13'),
(51, 'casanova', '$2y$12$ocG.wGu4c7GSLy0ibTi2OOHy.g3a07pzrmW1Amt5y7mxMvd1UMDW.', 'asasf@fasf', '2019-06-27 17:25:59'),
(52, 'lechugo', '$2y$12$nQes3P/UJtI1abVqIqUmFuRUxh2tdFOhGTK//1H5ONmN9QnXrhk/.', 'lechu@go', '2019-06-27 18:52:59'),
(53, 'lechugo', '$2y$12$uV1gaL02fydN9CRN.sJcQ.7KnNFO9j2SVPriQb040.zKeKuKxJM.2', 'lechu@go', '2019-06-27 18:53:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `victorias`
--

DROP TABLE IF EXISTS `victorias`;
CREATE TABLE IF NOT EXISTS `victorias` (
  `idP` int(11) NOT NULL,
  `idM` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`idP`,`idM`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `victorias`
--

INSERT INTO `victorias` (`idP`, `idM`, `cantidad`) VALUES
(1, 200, 1),
(1, 30, 50),
(1, 43, 109),
(1, 4, 50),
(1, 20, 62),
(1, 5, 21),
(1, 7, 8),
(1, 6, 15),
(1, 8, 3),
(1, 1, 57),
(1, 2, 3),
(1, 3, 4),
(45, 1, 1),
(1, 209, 1),
(1, 95, 3),
(1, 92, 1),
(1, 96, 3),
(1, 94, 1),
(1, 90, 6),
(1, 89, 3),
(1, 208, 3),
(1, 81, 3),
(1, 91, 1),
(1, 93, 1),
(1, 97, 1),
(1, 88, 1),
(1, 33, 3),
(1, 31, 4),
(1, 34, 2),
(1, 32, 1),
(1, 11, 6),
(1, 12, 6),
(1, 15, 1),
(1, 23, 1),
(1, 21, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

DROP TABLE IF EXISTS `zonas`;
CREATE TABLE IF NOT EXISTS `zonas` (
  `idZ` int(255) NOT NULL,
  `idB` int(255) NOT NULL,
  `nombreZona` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `textoZona` varchar(1000) COLLATE latin1_spanish_ci NOT NULL,
  `imagenZona` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `tiendaarmas` int(11) NOT NULL,
  `tiendamascotas` int(11) NOT NULL,
  `tiendavehiculos` int(11) NOT NULL,
  `tiendavariedades` int(11) NOT NULL,
  `banco` int(11) NOT NULL,
  `hotel` int(11) NOT NULL,
  `cerrajeria` int(11) NOT NULL,
  `apuestas` int(11) NOT NULL,
  `social` int(11) NOT NULL,
  `estilo` int(11) NOT NULL,
  `gimnasio` int(11) NOT NULL,
  `entrenamiento` int(11) NOT NULL,
  `iglesia` int(11) NOT NULL,
  `cultura` int(11) NOT NULL,
  PRIMARY KEY (`idZ`,`idB`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`idZ`, `idB`, `nombreZona`, `textoZona`, `imagenZona`, `tiendaarmas`, `tiendamascotas`, `tiendavehiculos`, `tiendavariedades`, `banco`, `hotel`, `cerrajeria`, `apuestas`, `social`, `estilo`, `gimnasio`, `entrenamiento`, `iglesia`, `cultura`) VALUES
(1, 1, 'Asdr&uacute;bal\r\n', 'Asdr&uacute;bal debe su nombre al peque&ntilde;o poblado minero construido durante el siglo XX en el sur de Puertollano.\r\n', 'asd.png', 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 1, 1, 0),
(2, 1, 'Terri', 'Cuentas las leyendas que un antiguo Drag&oacute;n duerme en las profundidades del Terri y a&uacute;n en el silencio de la noche puede oirse el crepitar de la bestia respirando.\r\n', 'terri.png', 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 2, 'Gran Capit&aacute;n', 'Una de las zonas m&aacute;s transitadas de la ciudad. Mercaderes y todo tipo de oportunistas compiten por ganarse la vida.\r\n', 'granCapitan.png', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 2, 'San Jos&eacute;', 'M&aacute;s conocida como &quot;Silent Jos&eacute;&quot;, esta zona suele estar cubierta por nieve y niebla espesa que ocultan incluso las dos torres del templo religioso que alberga en su interior.', 'sanJose.png', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 2, 'Pozo Norte', 'El Parque Norte es un referente de Puertollano. Un lugar para el retiro, pasear y hacer deporte durante el d&iacute;a, aunque al caer la noche vagan los esp&iacute;ritus de quienes tiempo atr&aacute;s dejaron su vida en el antiguo pozo minero.\r\n', 'pozoNorte.png', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 3, 'Abulagar', 'La vegetaci&oacute;n t&iacute;pica de la zona le da su nombre. Una vistosa planta de flores amarillas que en primavera pone de muy mala leche a los al&eacute;rgicos.\r\n', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 4, 'El Poblado', 'El auge petroqu&iacute;mico motiv&oacute; la construcci&oacute;n de viviendas para ingenieros en este barrio que fue un referente del lujo durante gran parte del siglo XX\r\n', 'elPoblado.png', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 6, 'Ayuntamiento', 'Ayuntamiento y otros edificios administrativos se sit&uacute;an en esta zona del coraz&oacute;n de Puertollano\r\n', 'viacrucis.png', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 6, 'Paseo de San Gregorio', 'Los habitantes de Puertollano disfrutan paseando entre bellos jardines y refrescantes fuentes que llenan de vida esta zona de la ciudad\r\n', 'paseoSanGregorio.png', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 6, 'Paseo El Bosque', 'Es la parte norte del Paseo de San Gregorio. A veces muy saturada de tr&aacute;fico, pero no por ello deja de ser un lugar encantador.', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 7, 'El Pino', 'Sombras sigilosas y asaltantes nocturnos aguardan en las callejuelas derruidas de este barrio.', 'pino.png', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 5, 'Salesianos', 'El empe&ntilde;o de antiguos monjes salesianos hizo posible la construcci&oacute;n de la mayor&iacute;a de edificios en esta zona\r\n', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 5, 'Tauro', 'Debe su nombre a la abominable bestia h&iacute;brida que deambula por las profundidades de esta barriada\r\n', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 5, 'La Copa', 'Un oasis de cultura y tambi&eacute;n un referente del ocio nocturno\r\n', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 8, 'El Carmen', 'Su t&uacute;nel te lleva hacia un mundo habitado por seres de fantas&iacute;a. S&oacute;lo los m&aacute;s valientes aventureros se adentran en busca de misterios\r\n', 'carmen.png', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 10, 'Ciudad Jard&iacute;n', 'Bello paraje donde descansar alejado del ruido de la urbe', 'ciudadJardin.png', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 9, 'Las 600', 'Barrio residencial... en el que no s&oacute;lamente residen humanos\r\n', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 9, 'PAU', 'Una vez aqu&iacute;, s&oacute;lo el enorme muro que se levanta al norte separa a Puertollano de lo desconocido\r\n', 'pau.png', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 9, 'Recinto Ferial', 'Lugar dedicado al Ocio, junto a su estanque de patos. Tambi&eacute;n acoge un coqueto mercadillo cada S&aacute;bado del a&ntilde;o\r\n', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
