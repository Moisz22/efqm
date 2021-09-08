-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-09-2021 a las 22:55:35
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `efqm`
--
CREATE DATABASE IF NOT EXISTS `efqm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `efqm`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `perfil`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `perfil` (IN `p_id_rol` INT)  BEGIN
	INSERT INTO permiso (
        id_rol,
        opcion_permiso,
        opcion_padre)
    VALUES
    (p_id_rol, 2, 1),
    (p_id_rol, 3, 1),
    (p_id_rol, 4, 1),
    (p_id_rol, 5, 1),
    (p_id_rol, 6, 1),
    (p_id_rol, 7, 1),
    (p_id_rol, 8, 1),
    (p_id_rol, 9, 1),
    (p_id_rol, 10, 1),
    (p_id_rol, 11, 1),
    (p_id_rol, 12, 1),
    (p_id_rol, 13, 2),
    (p_id_rol, 14, 2),
    (p_id_rol, 15, 2),
    (p_id_rol, 16, 3),
    (p_id_rol, 17, 3),
    (p_id_rol, 18, 3),
    (p_id_rol, 19, 4),
    (p_id_rol, 20, 4),
    (p_id_rol, 21, 4),
    (p_id_rol, 22, 5);
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta`
--

DROP TABLE IF EXISTS `acta`;
CREATE TABLE `acta` (
  `id_acta` int(11) NOT NULL,
  `secuencial_acta` int(11) NOT NULL,
  `id_equipo_trabajo` int(11) NOT NULL,
  `orden_acta` varchar(255) NOT NULL,
  `fecha_acta` date NOT NULL,
  `hora_inicio_acta` time NOT NULL,
  `hora_finalizacion_acta` time NOT NULL,
  `id_lugar` int(11) NOT NULL,
  `desarrollo_acta` text NOT NULL,
  `bitacora_aprendizaje_acta` text NOT NULL,
  `estado_acta` tinyint(1) NOT NULL DEFAULT 1,
  `usuario_ing` int(11) NOT NULL,
  `fecha_ing` date NOT NULL,
  `usuario_mod` int(11) NOT NULL,
  `fecha_mod` date NOT NULL,
  `usuario_eli` int(11) NOT NULL,
  `fecha_eli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acta`
--

INSERT INTO `acta` (`id_acta`, `secuencial_acta`, `id_equipo_trabajo`, `orden_acta`, `fecha_acta`, `hora_inicio_acta`, `hora_finalizacion_acta`, `id_lugar`, `desarrollo_acta`, `bitacora_aprendizaje_acta`, `estado_acta`, `usuario_ing`, `fecha_ing`, `usuario_mod`, `fecha_mod`, `usuario_eli`, `fecha_eli`) VALUES
(1, 1, 1, 'Revisión de Acta anterior', '2021-09-01', '18:46:00', '19:47:00', 1, '1. Se retoma observaciones de la reunión pasada. \n2. Se envía correo formar para ayuda del Área académica, y se designa un nuevo integrante para el grupo de TTHH. ', 'Revisión y corrección de las fichas de procesos', 1, 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta_asistentes`
--

DROP TABLE IF EXISTS `acta_asistentes`;
CREATE TABLE `acta_asistentes` (
  `id_acta` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `es_miembro_equipo` tinyint(1) NOT NULL,
  `fl_asistencia` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acta_asistentes`
--

INSERT INTO `acta_asistentes` (`id_acta`, `id_persona`, `es_miembro_equipo`, `fl_asistencia`) VALUES
(1, 3, 0, 1),
(1, 1, 1, 1),
(1, 4, 0, 1),
(1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

DROP TABLE IF EXISTS `actividad`;
CREATE TABLE `actividad` (
  `id_actividad` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `orden_actividad` int(11) NOT NULL,
  `descripcion_actividad` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado_actividad` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id_actividad`, `id_proceso`, `orden_actividad`, `descripcion_actividad`, `estado_actividad`) VALUES
(1, 2, 1, 'Desarrollo de software', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexo_acta`
--

DROP TABLE IF EXISTS `anexo_acta`;
CREATE TABLE `anexo_acta` (
  `id_anexo_acta` int(11) NOT NULL,
  `id_acta` int(11) NOT NULL,
  `descripcion_anexo_acta` varchar(255) NOT NULL,
  `ruta_anexo_acta` varchar(255) NOT NULL,
  `estado_anexo_acta` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexo_proceso`
--

DROP TABLE IF EXISTS `anexo_proceso`;
CREATE TABLE `anexo_proceso` (
  `id_anexo_proceso` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `descripcion_anexo_proceso` varchar(255) NOT NULL,
  `ruta_anexo_proceso` varchar(255) NOT NULL,
  `estado_anexo_proceso` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `anexo_proceso`
--

INSERT INTO `anexo_proceso` (`id_anexo_proceso`, `id_proceso`, `id_actividad`, `id_tipo_documento`, `descripcion_anexo_proceso`, `ruta_anexo_proceso`, `estado_anexo_proceso`) VALUES
(1, 2, 1, 5, 'Requerimiento Funcional', 'Anexo_proceso_5_2_07092021_010506.pdf', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `descripcion_cargo` varchar(60) NOT NULL,
  `jefe_cargo` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Flag para identificar que cargo pertenecen a los jefes departamentales',
  `estado_cargo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `descripcion_cargo`, `jefe_cargo`, `estado_cargo`) VALUES
(1, 'Analista / Programador', 0, 1),
(2, 'Director de tecnología', 1, 1),
(3, 'Asistente de presidencia', 0, 1),
(4, 'Director administrativo', 1, 1),
(5, 'Asistente de compras', 0, 1),
(6, 'Consultor', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_indicador`
--

DROP TABLE IF EXISTS `categoria_indicador`;
CREATE TABLE `categoria_indicador` (
  `id_categoria_indicador` int(11) NOT NULL,
  `descripcion_categoria_indicador` varchar(200) NOT NULL,
  `estado_categoria_indicador` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_indicador`
--

INSERT INTO `categoria_indicador` (`id_categoria_indicador`, `descripcion_categoria_indicador`, `estado_categoria_indicador`) VALUES
(1, 'Académico', 1),
(2, 'Innovaciones y TICs', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_cambio`
--

DROP TABLE IF EXISTS `control_cambio`;
CREATE TABLE `control_cambio` (
  `id_control_cambio` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `id_version` int(11) NOT NULL,
  `descripcion_control_cambio` varchar(255) NOT NULL,
  `estado_control_cambio` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `control_cambio`
--

INSERT INTO `control_cambio` (`id_control_cambio`, `id_proceso`, `id_version`, `descripcion_control_cambio`, `estado_control_cambio`) VALUES
(1, 2, 1, 'Versión Inicial', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterio_efqm`
--

DROP TABLE IF EXISTS `criterio_efqm`;
CREATE TABLE `criterio_efqm` (
  `id_criterio_efqm` int(11) NOT NULL,
  `descripcion_criterio_efqm` varchar(200) NOT NULL,
  `abreviatura_criterio_efqm` varchar(5) NOT NULL,
  `estado_criterio_efqm` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `criterio_efqm`
--

INSERT INTO `criterio_efqm` (`id_criterio_efqm`, `descripcion_criterio_efqm`, `abreviatura_criterio_efqm`, `estado_criterio_efqm`) VALUES
(1, '6A – resultados en clientes – percepción', '6A', 1),
(2, '6B – resultados en clientes – rendimiento', '6B', 1),
(3, '7A – Resultados en personas – percepción', '7A', 1),
(4, '7B – resultados en personas – rendimiento', '7B', 1),
(5, '8A – Resultados en la sociedad – percepción', '8A', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

DROP TABLE IF EXISTS `entrada`;
CREATE TABLE `entrada` (
  `id_entrada` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `descripcion_entrada` varchar(255) NOT NULL,
  `estado_entrada` tinyint(1) NOT NULL DEFAULT 1,
  `usuario_ing` int(11) NOT NULL,
  `fecha_ing` date NOT NULL,
  `usuario_mod` int(11) NOT NULL,
  `fecha_mod` date NOT NULL,
  `usuario_eli` int(11) NOT NULL,
  `fecha_eli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`id_entrada`, `id_proceso`, `id_actividad`, `descripcion_entrada`, `estado_entrada`, `usuario_ing`, `fecha_ing`, `usuario_mod`, `fecha_mod`, `usuario_eli`, `fecha_eli`) VALUES
(1, 2, 1, 'Requerimiento de Presidencia', 1, 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_trabajo`
--

DROP TABLE IF EXISTS `equipo_trabajo`;
CREATE TABLE `equipo_trabajo` (
  `id_equipo_trabajo` int(11) NOT NULL,
  `descripcion_equipo_trabajo` varchar(50) NOT NULL,
  `estado_equipo_trabajo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipo_trabajo`
--

INSERT INTO `equipo_trabajo` (`id_equipo_trabajo`, `descripcion_equipo_trabajo`, `estado_equipo_trabajo`) VALUES
(1, 'Gestión TTHH', 1),
(2, 'Encuestas', 1),
(3, 'Gestión de procesos', 1),
(4, 'Comité de excelencia', 1),
(5, 'Gestión ambiental', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuencia`
--

DROP TABLE IF EXISTS `frecuencia`;
CREATE TABLE `frecuencia` (
  `id_frecuencia` int(11) NOT NULL,
  `descripcion_frecuencia` varchar(50) NOT NULL,
  `estado_frecuencia` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `frecuencia`
--

INSERT INTO `frecuencia` (`id_frecuencia`, `descripcion_frecuencia`, `estado_frecuencia`) VALUES
(1, 'Diario', 1),
(2, 'Semanal', 1),
(3, 'Quincenal', 1),
(4, 'Mensual', 1),
(5, 'Anual', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador`
--

DROP TABLE IF EXISTS `indicador`;
CREATE TABLE `indicador` (
  `id_indicador` int(11) NOT NULL,
  `id_criterio_efqm` int(11) NOT NULL,
  `descripcion_indicador` varchar(128) NOT NULL,
  `formula_indicador` varchar(200) NOT NULL,
  `id_frecuencia_indicador` int(11) NOT NULL,
  `estado_indicador` int(11) NOT NULL DEFAULT 1,
  `id_categoria_indicador` int(11) NOT NULL,
  `meta_indicador` int(11) NOT NULL,
  `usuario_ing` int(11) NOT NULL,
  `fecha_ing` date NOT NULL,
  `usuario_mod` int(11) NOT NULL,
  `fecha_mod` date NOT NULL,
  `usuario_eli` int(11) NOT NULL,
  `fecha_eli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `indicador`
--

INSERT INTO `indicador` (`id_indicador`, `id_criterio_efqm`, `descripcion_indicador`, `formula_indicador`, `id_frecuencia_indicador`, `estado_indicador`, `id_categoria_indicador`, `meta_indicador`, `usuario_ing`, `fecha_ing`, `usuario_mod`, `fecha_mod`, `usuario_eli`, `fecha_eli`) VALUES
(1, 1, '% Deserción estudiantil voluntarias que se producen', 'nº de bajas voluntarias (incluso abandono escolar) X 100 / nº de alumnos del centro ', 1, 1, 1, 10, 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00'),
(2, 2, 'Nº de nuevas tecnologías implementadas (aplicaciones e infraestructura)', 'nº total de nuevas tecnologias implementadas en los ultimos tres años / 3', 1, 1, 2, 5, 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador_detalle`
--

DROP TABLE IF EXISTS `indicador_detalle`;
CREATE TABLE `indicador_detalle` (
  `id_indicador_detalle` int(11) NOT NULL,
  `id_indicador` int(11) NOT NULL,
  `flag_codefe` int(11) NOT NULL DEFAULT 0,
  `anio_detalle` varchar(255) NOT NULL,
  `resultado_detalle` decimal(10,2) NOT NULL,
  `meta_detalle` decimal(10,2) NOT NULL,
  `estado_indicador_detalle` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `indicador_detalle`
--

INSERT INTO `indicador_detalle` (`id_indicador_detalle`, `id_indicador`, `flag_codefe`, `anio_detalle`, `resultado_detalle`, `meta_detalle`, `estado_indicador_detalle`) VALUES
(1, 1, 0, '2017', '6.00', '6.00', 1),
(2, 1, 0, '2018', '6.89', '5.00', 1),
(3, 1, 0, '2019', '15.00', '6.00', 1),
(4, 1, 1, 'CODEFE', '10.00', '0.00', 1),
(5, 2, 0, '2017', '2.40', '2.00', 1),
(6, 2, 0, '2018', '10.00', '3.00', 1),
(7, 2, 0, '2019', '2.74', '5.00', 1),
(8, 2, 1, 'CODEFE', '5.00', '0.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--

DROP TABLE IF EXISTS `lugar`;
CREATE TABLE `lugar` (
  `id_lugar` int(11) NOT NULL,
  `descripcion_lugar` varchar(150) NOT NULL,
  `estado_lugar` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lugar`
--

INSERT INTO `lugar` (`id_lugar`, `descripcion_lugar`, `estado_lugar`) VALUES
(1, 'Oficina de presidencia', 1),
(2, 'Biblioteca de Secundaria', 1),
(3, 'Oficina de tecnología', 1),
(4, 'Plataforma ZOOM', 1),
(5, 'Oficina Coordinadora de Calidad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametro`
--

DROP TABLE IF EXISTS `parametro`;
CREATE TABLE `parametro` (
  `ruta_vision_mision` varchar(254) NOT NULL,
  `ruta_organigrama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parametro`
--

INSERT INTO `parametro` (`ruta_vision_mision`, `ruta_organigrama`) VALUES
('Mision_vision_26082021_224819.pdf', 'Organigrama_26082021_225530.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

DROP TABLE IF EXISTS `permiso`;
CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `opcion_permiso` int(11) NOT NULL,
  `flag_permiso` int(11) NOT NULL DEFAULT 0,
  `opcion_padre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `id_rol`, `opcion_permiso`, `flag_permiso`, `opcion_padre`) VALUES
(22, 1, 2, 1, 1),
(23, 1, 3, 1, 1),
(24, 1, 4, 1, 1),
(25, 1, 5, 1, 1),
(26, 1, 6, 1, 1),
(27, 1, 7, 1, 1),
(28, 1, 8, 1, 1),
(29, 1, 9, 1, 1),
(30, 1, 10, 1, 1),
(31, 1, 11, 1, 1),
(32, 1, 12, 1, 1),
(33, 1, 13, 1, 2),
(34, 1, 14, 1, 2),
(35, 1, 15, 1, 2),
(36, 1, 16, 1, 3),
(37, 1, 17, 1, 3),
(38, 1, 18, 1, 3),
(39, 1, 19, 1, 4),
(40, 1, 20, 1, 4),
(41, 1, 21, 1, 4),
(42, 1, 22, 1, 5),
(43, 2, 2, 1, 1),
(44, 2, 3, 1, 1),
(45, 2, 4, 1, 1),
(46, 2, 5, 1, 1),
(47, 2, 6, 0, 1),
(48, 2, 7, 0, 1),
(49, 2, 8, 0, 1),
(50, 2, 9, 0, 1),
(51, 2, 10, 0, 1),
(52, 2, 11, 0, 1),
(53, 2, 12, 0, 1),
(54, 2, 13, 0, 2),
(55, 2, 14, 0, 2),
(56, 2, 15, 0, 2),
(57, 2, 16, 0, 3),
(58, 2, 17, 0, 3),
(59, 2, 18, 0, 3),
(60, 2, 19, 0, 4),
(61, 2, 20, 0, 4),
(62, 2, 21, 0, 4),
(63, 2, 22, 0, 5),
(64, 3, 2, 0, 1),
(65, 3, 3, 0, 1),
(66, 3, 4, 0, 1),
(67, 3, 5, 0, 1),
(68, 3, 6, 0, 1),
(69, 3, 7, 0, 1),
(70, 3, 8, 0, 1),
(71, 3, 9, 0, 1),
(72, 3, 10, 0, 1),
(73, 3, 11, 0, 1),
(74, 3, 12, 0, 1),
(75, 3, 13, 0, 2),
(76, 3, 14, 0, 2),
(77, 3, 15, 0, 2),
(78, 3, 16, 0, 3),
(79, 3, 17, 0, 3),
(80, 3, 18, 0, 3),
(81, 3, 19, 0, 4),
(82, 3, 20, 0, 4),
(83, 3, 21, 0, 4),
(84, 3, 22, 0, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `dni_persona` varchar(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `nombre_persona` varchar(255) NOT NULL,
  `apellido_persona` varchar(255) NOT NULL,
  `impresion_persona` varchar(255) NOT NULL COMMENT 'Este campo sirve para mostrar el nombre de la persona en las actas con sus  títulos de tercer o cuarto nivel.',
  `flag_empleado` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1) Para empleado 0) Para persona externa',
  `estado_persona` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `dni_persona`, `id_cargo`, `nombre_persona`, `apellido_persona`, `impresion_persona`, `flag_empleado`, `estado_persona`) VALUES
(1, '0956319404', 1, 'Jean Pierre', 'Chávez', 'Jean Pierre Chávez', 1, 1),
(2, '0913530556', 2, 'Pablo', 'Villao', 'Ing. Pablo Villao, MSIG.', 1, 1),
(3, '0974521402', 5, 'Pedro', 'Macías', 'Ing. Pedro Macías', 1, 1),
(4, '0945124736', 6, 'Lucía', 'Jiménez', 'Lic. Lucía Jiménez, MBA.', 0, 1),
(5, '0741523658', 6, 'Luis Andrés', 'Cercado', 'Luis Cercado', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `politica`
--

DROP TABLE IF EXISTS `politica`;
CREATE TABLE `politica` (
  `id_politica` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `orden_politica` int(11) NOT NULL,
  `descripcion_politica` text NOT NULL,
  `estado_politica` tinyint(1) NOT NULL DEFAULT 1,
  `usuario_ingreso` int(11) NOT NULL COMMENT 'Usuario que crea el registro',
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `politica`
--

INSERT INTO `politica` (`id_politica`, `id_proceso`, `id_actividad`, `orden_politica`, `descripcion_politica`, `estado_politica`, `usuario_ingreso`, `fecha_ingreso`) VALUES
(1, 2, 1, 1, 'Las TIcs deberán estar actualizadas acorde al manual de procedimiento de uso de tecnologías de la institución.', 1, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

DROP TABLE IF EXISTS `proceso`;
CREATE TABLE `proceso` (
  `id_proceso` int(11) NOT NULL,
  `secuencial_proceso` int(11) NOT NULL,
  `id_tipo_proceso` int(11) NOT NULL,
  `descripcion_proceso` varchar(100) NOT NULL,
  `abreviatura_proceso` varchar(5) NOT NULL,
  `id_version_proceso` int(11) NOT NULL,
  `id_propietario_proceso` int(11) NOT NULL,
  `fecha_elaboracion_proceso` date NOT NULL,
  `objetivo_proceso` text NOT NULL,
  `alcance_proceso` text NOT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `estado_proceso` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`id_proceso`, `secuencial_proceso`, `id_tipo_proceso`, `descripcion_proceso`, `abreviatura_proceso`, `id_version_proceso`, `id_propietario_proceso`, `fecha_elaboracion_proceso`, `objetivo_proceso`, `alcance_proceso`, `usuario_creacion`, `estado_proceso`) VALUES
(1, 1, 1, 'TICS', 'TIC', 1, 2, '2021-08-23', 'PRUEBA DE PROCESO', 'ALCANCE DE PROCESO', 0, 1),
(2, 1, 1, 'TICS', 'TIC', 1, 2, '2021-08-29', 'Planificar y Gestionar  los recursos TIC ; para realizar una adecuada distribución de los recursos siguiendo con los parámetros de calidad internacional y del Ministerio de Educación. ', 'Aplica a toda la institución', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso_aprobacion`
--

DROP TABLE IF EXISTS `proceso_aprobacion`;
CREATE TABLE `proceso_aprobacion` (
  `id_proceso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_aprobacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proceso_aprobacion`
--

INSERT INTO `proceso_aprobacion` (`id_proceso`, `id_usuario`, `fecha_aprobacion`) VALUES
(2, 2, '2021-09-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso_indicador`
--

DROP TABLE IF EXISTS `proceso_indicador`;
CREATE TABLE `proceso_indicador` (
  `id_proceso` int(11) NOT NULL,
  `id_indicador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proceso_indicador`
--

INSERT INTO `proceso_indicador` (`id_proceso`, `id_indicador`) VALUES
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso_relacionado`
--

DROP TABLE IF EXISTS `proceso_relacionado`;
CREATE TABLE `proceso_relacionado` (
  `id_proceso` int(11) NOT NULL,
  `id_proceso_relacionado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proceso_relacionado`
--

INSERT INTO `proceso_relacionado` (`id_proceso`, `id_proceso_relacionado`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recurso`
--

DROP TABLE IF EXISTS `recurso`;
CREATE TABLE `recurso` (
  `id_recurso` int(11) NOT NULL,
  `descripcion_recurso` varchar(200) NOT NULL,
  `estado_recurso` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recurso`
--

INSERT INTO `recurso` (`id_recurso`, `descripcion_recurso`, `estado_recurso`) VALUES
(1, 'Lápiz', 0),
(2, 'Malla Curricular del Ministerio', 1),
(3, 'Internet', 1),
(4, 'Correo Institucional', 1),
(5, 'Sistema de Marcaciones Electrónicas y relojes Biométricos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recurso_proceso`
--

DROP TABLE IF EXISTS `recurso_proceso`;
CREATE TABLE `recurso_proceso` (
  `id_recurso_proceso` int(11) NOT NULL,
  `id_recurso` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `estado_recurso_proceso` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recurso_proceso`
--

INSERT INTO `recurso_proceso` (`id_recurso_proceso`, `id_recurso`, `id_proceso`, `id_actividad`, `estado_recurso_proceso`) VALUES
(1, 3, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable_proceso`
--

DROP TABLE IF EXISTS `responsable_proceso`;
CREATE TABLE `responsable_proceso` (
  `id_cargo` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `responsable_proceso`
--

INSERT INTO `responsable_proceso` (`id_cargo`, `id_proceso`) VALUES
(1, 2),
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `descripcion_rol` varchar(200) NOT NULL,
  `estado_rol` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `descripcion_rol`, `estado_rol`) VALUES
(1, 'Administador', 1),
(2, 'Jefe departamental', 1),
(3, 'Coordinador de calidad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida`
--

DROP TABLE IF EXISTS `salida`;
CREATE TABLE `salida` (
  `id_salida` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `descripcion_salida` varchar(255) NOT NULL,
  `estado_salida` tinyint(1) NOT NULL DEFAULT 1,
  `usuario_ing` int(11) NOT NULL,
  `fecha_ing` date NOT NULL,
  `usuario_mod` int(11) NOT NULL,
  `fecha_mod` date NOT NULL,
  `usuario_eli` int(11) NOT NULL,
  `fecha_eli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salida`
--

INSERT INTO `salida` (`id_salida`, `id_proceso`, `id_actividad`, `descripcion_salida`, `estado_salida`, `usuario_ing`, `fecha_ing`, `usuario_mod`, `fecha_mod`, `usuario_eli`, `fecha_eli`) VALUES
(1, 2, 1, 'Aplicación de nuevas Tecnologías', 1, 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subactividad`
--

DROP TABLE IF EXISTS `subactividad`;
CREATE TABLE `subactividad` (
  `id_subactividad` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `descripcion_subactividad` text NOT NULL,
  `orden_subactividad` int(11) NOT NULL,
  `id_responsable` int(11) NOT NULL,
  `estado_subactividad` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subactividad`
--

INSERT INTO `subactividad` (`id_subactividad`, `id_actividad`, `descripcion_subactividad`, `orden_subactividad`, `id_responsable`, `estado_subactividad`) VALUES
(1, 1, 'Levantamiento de requerimientos', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL,
  `descripcion_tipo_documento` varchar(255) NOT NULL,
  `abreviatura_tipo_documento` varchar(10) NOT NULL,
  `estado_tipo_documento` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo_documento`, `descripcion_tipo_documento`, `abreviatura_tipo_documento`, `estado_tipo_documento`) VALUES
(1, 'Acta', 'ACT', 1),
(2, 'Convocatorias', 'CON', 1),
(3, 'Registro de asistencia', 'REG', 1),
(4, 'Acuerdos', 'ACU', 1),
(5, 'Manuales', 'MAN', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_proceso`
--

DROP TABLE IF EXISTS `tipo_proceso`;
CREATE TABLE `tipo_proceso` (
  `id_tipo_proceso` int(11) NOT NULL,
  `descripcion_tipo_proceso` varchar(50) NOT NULL,
  `abreviatura_tipo_proceso` varchar(3) NOT NULL,
  `estado_tipo_proceso` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_proceso`
--

INSERT INTO `tipo_proceso` (`id_tipo_proceso`, `descripcion_tipo_proceso`, `abreviatura_tipo_proceso`, `estado_tipo_proceso`) VALUES
(1, 'Estratégicos', 'EST', 1),
(2, 'Claves', 'CLA', 1),
(3, 'Apoyo', 'APO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` text NOT NULL,
  `equipo_usuario` int(11) NOT NULL,
  `acceso_usuario` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Sirve para habilitar el login',
  `estado_usuario` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_persona`, `id_rol`, `username`, `password`, `equipo_usuario`, `acceso_usuario`, `estado_usuario`) VALUES
(2, 2, 2, '0913530556', '92f39f7f2a869838cd5085e6f17fc82109bcf98cd62a47cbc379e38de80bbc0213a23cee6e4a13de6caae0add8a390272d6f0883c274320b1ff60dbcfc6dd750', 1, 1, 0),
(22, 1, 1, '0956319404', '9cf4db1049d56271cce31ee1cee02822183b4869c3bb245bb2b332ef086bb82c378cb516efbffcc3e328b7a828f68495228903bf9ecbe4f877495e4399f2fb6f', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `version`
--

DROP TABLE IF EXISTS `version`;
CREATE TABLE `version` (
  `id_version` int(11) NOT NULL,
  `descripcion_version` varchar(10) NOT NULL,
  `estado_version` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `version`
--

INSERT INTO `version` (`id_version`, `descripcion_version`, `estado_version`) VALUES
(1, 'V.1.0', 1),
(2, 'V.2.0', 1),
(3, 'V.3.0', 1),
(4, 'V.4.0', 1),
(5, 'V.5.0', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acta`
--
ALTER TABLE `acta`
  ADD PRIMARY KEY (`id_acta`),
  ADD KEY `fk_acta_lugar1_idx` (`id_lugar`),
  ADD KEY `fk_acta_equipo_trabajo_idx` (`id_equipo_trabajo`);

--
-- Indices de la tabla `acta_asistentes`
--
ALTER TABLE `acta_asistentes`
  ADD KEY `fk_tbl_acta_asistentes_acta_idx` (`id_acta`),
  ADD KEY `fk_acta_asistentes_persona1_idx` (`id_persona`);

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `fk_actividad_proceso1_idx` (`id_proceso`);

--
-- Indices de la tabla `anexo_acta`
--
ALTER TABLE `anexo_acta`
  ADD PRIMARY KEY (`id_anexo_acta`),
  ADD KEY `fk_anexo_acta_acta1_idx` (`id_acta`);

--
-- Indices de la tabla `anexo_proceso`
--
ALTER TABLE `anexo_proceso`
  ADD PRIMARY KEY (`id_anexo_proceso`),
  ADD KEY `fk_anexo_tipo_documento_idx` (`id_tipo_documento`),
  ADD KEY `fk_anexo_proceso_actividad_idx` (`id_actividad`),
  ADD KEY `fk_anexo_proceso_proceso_idx` (`id_proceso`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `categoria_indicador`
--
ALTER TABLE `categoria_indicador`
  ADD PRIMARY KEY (`id_categoria_indicador`);

--
-- Indices de la tabla `control_cambio`
--
ALTER TABLE `control_cambio`
  ADD PRIMARY KEY (`id_control_cambio`),
  ADD KEY `fk_control_cambio_version1_idx` (`id_version`),
  ADD KEY `fk_control_cambio_proceso1_idx` (`id_proceso`);

--
-- Indices de la tabla `criterio_efqm`
--
ALTER TABLE `criterio_efqm`
  ADD PRIMARY KEY (`id_criterio_efqm`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `fk_entrada_actividad_idx` (`id_actividad`),
  ADD KEY `fk_entrada_proceso_idx` (`id_proceso`);

--
-- Indices de la tabla `equipo_trabajo`
--
ALTER TABLE `equipo_trabajo`
  ADD PRIMARY KEY (`id_equipo_trabajo`);

--
-- Indices de la tabla `frecuencia`
--
ALTER TABLE `frecuencia`
  ADD PRIMARY KEY (`id_frecuencia`);

--
-- Indices de la tabla `indicador`
--
ALTER TABLE `indicador`
  ADD PRIMARY KEY (`id_indicador`),
  ADD KEY `fk_indicador_criterio_efqm1_idx` (`id_criterio_efqm`),
  ADD KEY `fk_indicador_frecuencia_idx` (`id_frecuencia_indicador`),
  ADD KEY `fk_indicador_categoria_indicador_idx` (`id_categoria_indicador`);

--
-- Indices de la tabla `indicador_detalle`
--
ALTER TABLE `indicador_detalle`
  ADD PRIMARY KEY (`id_indicador_detalle`),
  ADD KEY `fk_indicador_detalle_indicador_idx` (`id_indicador`);

--
-- Indices de la tabla `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`id_lugar`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `fk_permiso_rol1_idx` (`id_rol`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `fk_empleado_cargo1_idx` (`id_cargo`);

--
-- Indices de la tabla `politica`
--
ALTER TABLE `politica`
  ADD PRIMARY KEY (`id_politica`),
  ADD KEY `fk_politica_actividad1_idx` (`id_actividad`),
  ADD KEY `fk_politica_proceso_idx` (`id_proceso`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`id_proceso`),
  ADD KEY `fk_proceso_tipo_proceso_idx` (`id_tipo_proceso`),
  ADD KEY `fk_proceso_version_idx` (`id_version_proceso`),
  ADD KEY `fk_proceso_cargo_idx` (`id_propietario_proceso`);

--
-- Indices de la tabla `proceso_aprobacion`
--
ALTER TABLE `proceso_aprobacion`
  ADD KEY `fk_proceso_aprobacion_proceso1_idx` (`id_proceso`);

--
-- Indices de la tabla `proceso_indicador`
--
ALTER TABLE `proceso_indicador`
  ADD KEY `fk_tbl_proceso_indicador_proceso1_idx` (`id_proceso`),
  ADD KEY `fk_tbl_proceso_indicador_indicador1_idx` (`id_indicador`);

--
-- Indices de la tabla `proceso_relacionado`
--
ALTER TABLE `proceso_relacionado`
  ADD KEY `fk_proceso_relacionado_proceso_idx` (`id_proceso`);

--
-- Indices de la tabla `recurso`
--
ALTER TABLE `recurso`
  ADD PRIMARY KEY (`id_recurso`);

--
-- Indices de la tabla `recurso_proceso`
--
ALTER TABLE `recurso_proceso`
  ADD PRIMARY KEY (`id_recurso_proceso`),
  ADD KEY `fk_recurso_proceso_proceso1_idx` (`id_proceso`),
  ADD KEY `fk_recurso_proceso_recurso1_idx` (`id_recurso`),
  ADD KEY `fk_recurso_proceso_actividad_idx` (`id_actividad`);

--
-- Indices de la tabla `responsable_proceso`
--
ALTER TABLE `responsable_proceso`
  ADD KEY `fk_responsable_proceso_cargo1_idx` (`id_cargo`),
  ADD KEY `fk_responsable_proceso_proceso1_idx` (`id_proceso`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `salida`
--
ALTER TABLE `salida`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `fk_salida_actividad1_idx` (`id_actividad`),
  ADD KEY `fk_salida_proceso1_idx` (`id_proceso`);

--
-- Indices de la tabla `subactividad`
--
ALTER TABLE `subactividad`
  ADD PRIMARY KEY (`id_subactividad`),
  ADD KEY `fk_subactividad_actividad_idx` (`id_actividad`),
  ADD KEY `fk_subactividad_cargo_idx` (`id_responsable`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipo_documento`);

--
-- Indices de la tabla `tipo_proceso`
--
ALTER TABLE `tipo_proceso`
  ADD PRIMARY KEY (`id_tipo_proceso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario_unique` (`id_persona`),
  ADD KEY `fk_usuarios_persona1_idx` (`id_persona`),
  ADD KEY `fk_usuario_equipo_trabajo1_idx` (`equipo_usuario`),
  ADD KEY `fk_usuario_rol1_idx` (`id_rol`);

--
-- Indices de la tabla `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`id_version`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acta`
--
ALTER TABLE `acta`
  MODIFY `id_acta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `anexo_acta`
--
ALTER TABLE `anexo_acta`
  MODIFY `id_anexo_acta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anexo_proceso`
--
ALTER TABLE `anexo_proceso`
  MODIFY `id_anexo_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categoria_indicador`
--
ALTER TABLE `categoria_indicador`
  MODIFY `id_categoria_indicador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `control_cambio`
--
ALTER TABLE `control_cambio`
  MODIFY `id_control_cambio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `criterio_efqm`
--
ALTER TABLE `criterio_efqm`
  MODIFY `id_criterio_efqm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `equipo_trabajo`
--
ALTER TABLE `equipo_trabajo`
  MODIFY `id_equipo_trabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `frecuencia`
--
ALTER TABLE `frecuencia`
  MODIFY `id_frecuencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `indicador`
--
ALTER TABLE `indicador`
  MODIFY `id_indicador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `indicador_detalle`
--
ALTER TABLE `indicador_detalle`
  MODIFY `id_indicador_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `lugar`
--
ALTER TABLE `lugar`
  MODIFY `id_lugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `politica`
--
ALTER TABLE `politica`
  MODIFY `id_politica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `id_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `recurso`
--
ALTER TABLE `recurso`
  MODIFY `id_recurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `recurso_proceso`
--
ALTER TABLE `recurso_proceso`
  MODIFY `id_recurso_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `salida`
--
ALTER TABLE `salida`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `subactividad`
--
ALTER TABLE `subactividad`
  MODIFY `id_subactividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_proceso`
--
ALTER TABLE `tipo_proceso`
  MODIFY `id_tipo_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `version`
--
ALTER TABLE `version`
  MODIFY `id_version` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acta`
--
ALTER TABLE `acta`
  ADD CONSTRAINT `fk_acta_equipo_trabajo` FOREIGN KEY (`id_equipo_trabajo`) REFERENCES `equipo_trabajo` (`id_equipo_trabajo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_acta_lugar` FOREIGN KEY (`id_lugar`) REFERENCES `lugar` (`id_lugar`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `acta_asistentes`
--
ALTER TABLE `acta_asistentes`
  ADD CONSTRAINT `fk_acta_asistentes_persona1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_acta_asistentes_acta` FOREIGN KEY (`id_acta`) REFERENCES `acta` (`id_acta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `fk_actividad_proceso` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `anexo_acta`
--
ALTER TABLE `anexo_acta`
  ADD CONSTRAINT `fk_anexo_acta_acta` FOREIGN KEY (`id_acta`) REFERENCES `acta` (`id_acta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `anexo_proceso`
--
ALTER TABLE `anexo_proceso`
  ADD CONSTRAINT `fk_anexo__proceso_tipo_documento` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipo_documento` (`id_tipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_anexo_proceso_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_anexo_proceso_proceso` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `control_cambio`
--
ALTER TABLE `control_cambio`
  ADD CONSTRAINT `fk_control_cambio_proceso` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_control_cambio_version` FOREIGN KEY (`id_version`) REFERENCES `version` (`id_version`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `fk_entrada_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entrada_proceso` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `indicador`
--
ALTER TABLE `indicador`
  ADD CONSTRAINT `fk_indicador_categoria_indicador` FOREIGN KEY (`id_categoria_indicador`) REFERENCES `categoria_indicador` (`id_categoria_indicador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_indicador_criterio_efqm` FOREIGN KEY (`id_criterio_efqm`) REFERENCES `criterio_efqm` (`id_criterio_efqm`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_indicador_frecuencia` FOREIGN KEY (`id_frecuencia_indicador`) REFERENCES `frecuencia` (`id_frecuencia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `indicador_detalle`
--
ALTER TABLE `indicador_detalle`
  ADD CONSTRAINT `fk_indicador_detalle_indicador` FOREIGN KEY (`id_indicador`) REFERENCES `indicador` (`id_indicador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `fk_permiso_rol1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_empleado_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `politica`
--
ALTER TABLE `politica`
  ADD CONSTRAINT `fk_politica_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_politica_proceso` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD CONSTRAINT `fk_proceso_cargo` FOREIGN KEY (`id_propietario_proceso`) REFERENCES `cargo` (`id_cargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proceso_tipo_proceso` FOREIGN KEY (`id_tipo_proceso`) REFERENCES `tipo_proceso` (`id_tipo_proceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proceso_version` FOREIGN KEY (`id_version_proceso`) REFERENCES `version` (`id_version`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proceso_aprobacion`
--
ALTER TABLE `proceso_aprobacion`
  ADD CONSTRAINT `fk_proceso_aprobacion_proceso` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proceso_indicador`
--
ALTER TABLE `proceso_indicador`
  ADD CONSTRAINT `fk_id_indicador` FOREIGN KEY (`id_indicador`) REFERENCES `indicador` (`id_indicador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_proceso` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proceso_relacionado`
--
ALTER TABLE `proceso_relacionado`
  ADD CONSTRAINT `fk_proceso_relacionado_proceso` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recurso_proceso`
--
ALTER TABLE `recurso_proceso`
  ADD CONSTRAINT `fk_recurso_proceso_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recurso_proceso_proceso` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recurso_proceso_recurso` FOREIGN KEY (`id_recurso`) REFERENCES `recurso` (`id_recurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `responsable_proceso`
--
ALTER TABLE `responsable_proceso`
  ADD CONSTRAINT `fk_responsable_proceso_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_responsable_proceso_proceso` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `salida`
--
ALTER TABLE `salida`
  ADD CONSTRAINT `fk_salida_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salida_proceso` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subactividad`
--
ALTER TABLE `subactividad`
  ADD CONSTRAINT `fk_subactividad_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subactividad_cargo` FOREIGN KEY (`id_responsable`) REFERENCES `cargo` (`id_cargo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_equipo_trabajo1` FOREIGN KEY (`equipo_usuario`) REFERENCES `equipo_trabajo` (`id_equipo_trabajo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_rol1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
