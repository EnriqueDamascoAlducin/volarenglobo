-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2019 a las 02:48:23
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `volarenglobo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_actualizaciones_volar`
--

CREATE TABLE `bitacora_actualizaciones_volar` (
  `id_bit` int(11) NOT NULL COMMENT 'Llave Primaria',
  `idres_bit` int(11) DEFAULT NULL COMMENT 'Id Rserva',
  `idusu_bit` int(11) DEFAULT NULL COMMENT 'Solicita:',
  `idvalid_bit` int(11) DEFAULT NULL COMMENT 'Valida:',
  `campo_bit` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Campo',
  `valor_bit` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Valor',
  `tipo_bit` tinyint(4) DEFAULT NULL COMMENT 'Tipo de Movimiento',
  `confirmacion_bit` tinyint(4) DEFAULT NULL COMMENT 'Confirmación',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Reistro',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitpagos_volar`
--

CREATE TABLE `bitpagos_volar` (
  `id_bp` int(11) NOT NULL COMMENT 'Llave Primaria',
  `idres_bp` int(11) NOT NULL COMMENT 'No. Reserva',
  `idreg_bp` int(11) NOT NULL COMMENT 'Usuario que registra',
  `metodo_bp` tinyint(4) NOT NULL COMMENT 'Método de Pago',
  `banco_bp` int(11) NOT NULL COMMENT 'Banco',
  `referencia_bp` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT '# Referencia',
  `cantidad_bp` decimal(10,2) NOT NULL COMMENT 'Monto',
  `fecha_bp` date NOT NULL COMMENT 'Fecha de Pago',
  `idconc_bp` int(11) DEFAULT NULL COMMENT 'Usuario que Coincilia',
  `fechaconc_bp` datetime DEFAULT NULL COMMENT 'Fecha de Conciliación',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Register',
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Bitácora de Pagos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_servicios_volar`
--

CREATE TABLE `cat_servicios_volar` (
  `id_cat` int(11) NOT NULL COMMENT 'Llave Primaria',
  `nombre_cat` varchar(200) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del Servicio',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cat_servicios_volar`
--

INSERT INTO `cat_servicios_volar` (`id_cat`, `nombre_cat`, `register`, `status`) VALUES
(1, 'Vuelo en globo compartido de 45 a 60 min', '2019-04-08 23:01:49', 1),
(2, 'Brindis con vino espumoso Freixenet', '2019-04-09 04:20:41', 1),
(3, 'Certificado de vuelo personalizado', '2019-04-09 04:32:39', 1),
(4, 'Transportación local', '2019-04-09 04:33:04', 1),
(5, 'Seguro viajero', '2019-04-09 04:34:29', 1),
(6, 'Coffee Break', '2019-04-09 04:34:53', 1),
(7, 'Desayuno tipo Buffet', '2019-04-09 04:35:40', 1),
(8, 'Despliegue de lona', '2019-04-09 04:36:25', 1),
(9, 'Pagan 7 y el cumpleañero gratis', '2019-04-09 04:37:03', 1),
(10, 'Transportación local durante la actividad', '2019-04-09 04:38:21', 1),
(11, 'Despliegue de lona Feliz Cumpleaños', '2019-04-09 04:38:42', 1),
(12, 'Foto Impresa', '2019-04-09 04:40:02', 1),
(13, 'Brindis con Champagne Moët durante el vuelo', '2019-04-09 04:44:02', 1),
(14, 'Paquete de fotos de vuelo', '2019-04-09 04:44:22', 1),
(15, 'Souvenir', '2019-04-09 04:44:40', 1),
(16, '', '2019-04-10 20:46:52', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extras_volar`
--

CREATE TABLE `extras_volar` (
  `id_extra` int(11) NOT NULL COMMENT 'Llave Primaria',
  `abrev_extra` char(5) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Abreviación',
  `nombre_extra` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre',
  `clasificacion_extra` varchar(15) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'estados' COMMENT 'Clasificación',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `extras_volar`
--

INSERT INTO `extras_volar` (`id_extra`, `abrev_extra`, `nombre_extra`, `clasificacion_extra`, `register`, `status`) VALUES
(1, 'Ags', 'Aguascalientes', 'estados', '2019-03-31 17:30:30', 0),
(2, 'Ags', 'Aguascalientes', 'estados', '2019-03-31 17:30:30', 1),
(3, 'BCN', 'Baja California	', 'estados', '2019-03-31 17:30:30', 1),
(4, 'BCS.', 'Baja California Sur	', 'estados', '2019-03-31 17:30:30', 1),
(5, 'Camp.', 'Campeche', 'estados', '2019-03-31 17:30:30', 1),
(6, 'Chis', 'Chiapas', 'estados', '2019-03-31 17:30:30', 1),
(7, 'Chih.', 'Chihuahua', 'estados', '2019-03-31 17:30:30', 1),
(8, 'Coah', 'Coahuila', 'estados', '2019-03-31 17:30:30', 1),
(9, 'Coah', 'Coahuila', 'estados', '2019-03-31 17:30:30', 1),
(10, 'Col', 'Colima', 'estados', '2019-03-31 17:30:25', 1),
(11, 'D.F.', 'Distrito Federal	', 'estados', '2019-03-31 17:30:33', 1),
(12, 'Dgo', 'Durango	', 'estados', '2019-03-31 17:30:55', 1),
(13, 'Gto.', 'Guanajuato	', 'estados', '2019-03-31 17:31:24', 1),
(14, 'Gro.', 'Guerrero	', 'estados', '2019-03-31 17:32:26', 1),
(15, 'Hgo.', 'Hidalgo	', 'estados', '2019-03-31 17:33:09', 1),
(16, 'Jal.', 'Jalisco	', 'estados', '2019-03-31 17:33:33', 1),
(17, 'Edo.', 'México	', 'estados', '2019-03-31 17:34:04', 1),
(18, 'Mich.', 'Michoacan', 'estados', '2019-03-31 17:34:28', 1),
(19, 'Mor.', 'Morelos	', 'estados', '2019-03-31 17:34:52', 1),
(20, 'Nay.', 'Nayarit	', 'estados', '2019-03-31 17:39:19', 1),
(21, 'NLL.', 'Nuevo León	', 'estados', '2019-03-31 17:40:02', 1),
(22, 'Oax.', 'Oaxaca	', 'estados', '2019-03-31 17:41:08', 1),
(23, 'Pue.', 'Puebla	', 'estados', '2019-03-31 17:41:29', 1),
(24, 'Roo.', 'Quintana Roo	', 'estados', '2019-03-31 17:42:09', 0),
(25, 'Roo.', 'Quintana Roo	', 'estados', '2019-03-31 17:43:26', 1),
(26, 'SLP.', 'San Luis Potosí', 'estados', '2019-03-31 17:43:55', 1),
(27, 'Sin.', 'Sinaloa	', 'estados', '2019-03-31 17:44:49', 1),
(28, 'Son.	', 'Sonora	', 'estados', '2019-03-31 17:46:04', 1),
(29, 'Tab.', 'Tabasco	', 'estados', '2019-03-31 17:46:32', 1),
(30, 'Tamps', 'Tamaulipas', 'estados', '2019-03-31 17:47:34', 1),
(31, 'Tlx.', 'Tlaxcala	', 'estados', '2019-03-31 17:48:03', 1),
(32, 'Ver.', 'Veracruz	', 'estados', '2019-03-31 17:48:36', 1),
(33, 'Yuc.', 'Yucatan', 'estados', '2019-03-31 17:48:58', 1),
(34, 'Zac.', 'Zacatecas	', 'estados', '2019-03-31 17:49:21', 1),
(35, 'Ext.', 'Extranjero', 'estados', '2019-03-31 17:50:37', 1),
(36, '', 'Experiencia', 'motivos', '2019-03-31 19:22:54', 1),
(37, '', 'Aniversario', 'motivos', '2019-03-31 19:24:02', 1),
(38, '', 'Cumpleaños', 'motivos', '2019-03-31 19:24:27', 1),
(39, '', 'Entrega de Anillo de Compromiso ', 'motivos', '2019-03-31 19:25:19', 1),
(40, '', 'Grupo', 'motivos', '2019-03-31 19:25:43', 1),
(41, '', 'Otros', 'motivos', '2019-03-31 19:25:57', 0),
(42, '', 'Otro', 'motivos', '2019-03-31 19:26:42', 1),
(43, '', 'Feliz Vuelo', 'motivos', '2019-03-31 19:33:23', 1),
(44, '', 'Quieres Ser Mi Novi@', 'motivos', '2019-03-31 19:34:25', 1),
(45, '', 'Te Amo', 'motivos', '2019-03-31 19:34:44', 1),
(46, 'Priv.', 'Privado', 'tiposv', '2019-03-31 19:40:57', 1),
(47, 'Comp.', 'Compartido', 'tiposv', '2019-03-31 19:41:23', 1),
(48, 'Descr', 'Normal', 'tarifas', '2019-03-31 19:45:02', 1),
(49, 'Prom.', 'Promoción 1', 'tarifas', '2019-03-31 19:45:44', 1),
(50, 'Prom', 'Promoción 2', 'tarifas', '2019-03-31 19:46:19', 1),
(51, 'MIX', 'Mixto', 'tiposv', '2019-04-07 20:34:45', 1),
(52, NULL, 'Ventas', 'deptousu', '2019-04-09 14:19:43', 1),
(53, NULL, 'Compras', 'deptousu', '2019-04-09 14:19:43', 1),
(54, NULL, 'Sistemas', 'deptousu', '2019-04-09 14:20:03', 1),
(55, NULL, 'PAYPAL', 'metodopago', '2019-04-11 21:22:01', 1),
(56, NULL, 'Oxxo', 'metodopago', '2019-04-11 21:22:01', 1),
(57, NULL, 'Transferencia', 'metodopago', '2019-04-11 21:22:01', 1),
(58, NULL, 'Cheque', 'metodopago', '2019-04-11 21:22:01', 1),
(59, NULL, 'Deposito en Ventanilla', 'metodopago', '2019-04-11 21:22:01', 1),
(60, NULL, 'Efectivo', 'metodopago', '2019-04-11 21:22:01', 1),
(61, NULL, 'Deposito en Linea', 'metodopago', '2019-04-11 21:22:01', 1),
(62, NULL, 'SITIO', 'deptousu', '2019-04-17 17:53:44', 1),
(63, NULL, 'FINANZAS', 'deptousu', '2019-04-17 18:28:21', 1),
(64, NULL, 'BBVA VGAP', 'cuentasvolar', '2019-04-17 20:46:06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `globos_volar`
--

CREATE TABLE `globos_volar` (
  `id_globo` int(11) NOT NULL COMMENT 'Llave Primaria',
  `placa_globo` char(15) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Placa',
  `nombre_globo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Nombre',
  `peso_globo` decimal(10,2) DEFAULT NULL COMMENT 'Peso Maximo(Kg)',
  `maxpersonas_globo` tinyint(4) DEFAULT NULL COMMENT 'Personas Máximas',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `globos_volar`
--

INSERT INTO `globos_volar` (`id_globo`, `placa_globo`, `nombre_globo`, `peso_globo`, `maxpersonas_globo`, `register`, `status`) VALUES
(1, '9878-LKJH', 'Globo Amarillo', '840.20', 12, '2019-05-12 15:06:29', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones_volar`
--

CREATE TABLE `habitaciones_volar` (
  `id_habitacion` int(11) NOT NULL COMMENT 'Llave Primaria',
  `nombre_habitacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de la Habitación',
  `idhotel_habitacion` int(11) NOT NULL COMMENT 'Hotel',
  `precio_habitacion` decimal(8,2) NOT NULL COMMENT 'Precio/Noche',
  `capacidad_habitacion` mediumint(9) DEFAULT NULL COMMENT 'Personas',
  `descripcion_habitacion` varchar(250) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Habitaciones por Hotel';

--
-- Volcado de datos para la tabla `habitaciones_volar`
--

INSERT INTO `habitaciones_volar` (`id_habitacion`, `nombre_habitacion`, `idhotel_habitacion`, `precio_habitacion`, `capacidad_habitacion`, `descripcion_habitacion`, `register`, `status`) VALUES
(1, 'Sencilla', 1, '500.00', NULL, 'Habitación Sencilla para 1 persona', '0000-00-00 00:00:00', 0),
(3, 'Doble', 1, '500.00', 6, 'Habitación Sencilla', '2019-05-12 18:20:32', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoteles_volar`
--

CREATE TABLE `hoteles_volar` (
  `id_hotel` int(11) NOT NULL COMMENT 'Llave Primaria',
  `nombre_hotel` varchar(150) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del Hotel',
  `calle_hotel` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Calle del Hotel',
  `noint_hotel` varchar(7) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'No. Interior',
  `noext_hotel` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'No. Ext/Mz.',
  `colonia_hotel` varchar(75) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Colonia',
  `municipio_hotel` varchar(85) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Municipio',
  `estado_hotel` int(11) DEFAULT NULL COMMENT 'Estado',
  `cp_hotel` mediumint(9) DEFAULT NULL COMMENT 'Código Postal',
  `telefono_hotel` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Teléfono',
  `telefono2_hotel` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Teléfono opc.',
  `correo_hotel` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Correo',
  `img_hotel` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Imagen',
  `pagina_hotel` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Pagina Web',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla de Hoteles';

--
-- Volcado de datos para la tabla `hoteles_volar`
--

INSERT INTO `hoteles_volar` (`id_hotel`, `nombre_hotel`, `calle_hotel`, `noint_hotel`, `noext_hotel`, `colonia_hotel`, `municipio_hotel`, `estado_hotel`, `cp_hotel`, `telefono_hotel`, `telefono2_hotel`, `correo_hotel`, `img_hotel`, `pagina_hotel`, `register`, `status`) VALUES
(1, 'Quinto Sol', 'Ninguna', '24', NULL, 'Teotihuacan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-12 18:12:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imghoteles_volar`
--

CREATE TABLE `imghoteles_volar` (
  `id_img` int(11) NOT NULL COMMENT 'Llave Primaria',
  `idref_img` int(11) NOT NULL COMMENT 'Referencia',
  `tipo_img` tinyint(4) NOT NULL COMMENT 'Hotel/Habitación',
  `ruta_img` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Imagen',
  `register` datetime NOT NULL COMMENT 'Registro',
  `status` tinyint(4) NOT NULL COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Imagenes';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisosusuarios_volar`
--

CREATE TABLE `permisosusuarios_volar` (
  `id_puv` int(11) NOT NULL COMMENT 'Llave Primaria',
  `idusu_puv` int(11) NOT NULL COMMENT 'Usuario',
  `idsp_puv` int(11) NOT NULL COMMENT 'Sub Permiso',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permisosusuarios_volar`
--

INSERT INTO `permisosusuarios_volar` (`id_puv`, `idusu_puv`, `idsp_puv`, `register`, `status`) VALUES
(32, 2, 1, '2019-04-10 18:11:22', 1),
(33, 1, 1, '2019-04-10 18:12:12', 1),
(34, 1, 3, '2019-04-10 18:12:46', 1),
(35, 1, 4, '2019-04-10 18:12:47', 1),
(36, 1, 6, '2019-04-10 18:13:31', 1),
(37, 1, 5, '2019-04-10 18:13:45', 1),
(38, 2, 3, '2019-04-10 18:14:05', 1),
(39, 2, 4, '2019-04-10 18:14:06', 1),
(40, 1, 2, '2019-04-10 20:44:52', 1),
(41, 1, 7, '2019-04-10 21:05:58', 1),
(42, 1, 8, '2019-04-10 21:26:30', 1),
(43, 1, 9, '2019-04-10 21:26:32', 0),
(44, 1, 11, '2019-04-10 22:32:03', 1),
(45, 1, 12, '2019-04-11 11:03:16', 1),
(46, 1, 13, '2019-04-11 11:41:39', 1),
(47, 1, 26, '2019-04-11 14:37:28', 0),
(48, 1, 10, '2019-04-14 10:32:03', 1),
(49, 1, 28, '2019-04-14 15:06:41', 1),
(50, 1, 27, '2019-04-15 11:34:03', 1),
(51, 1, 18, '2019-04-16 11:19:09', 1),
(52, 1, 23, '2019-04-16 16:53:29', 1),
(53, 2, 2, '2019-04-17 21:09:27', 1),
(54, 2, 23, '2019-04-17 21:09:59', 1),
(55, 2, 9, '2019-04-17 21:10:02', 0),
(56, 2, 26, '2019-04-17 21:10:17', 1),
(57, 1, 30, '2019-04-18 12:44:54', 1),
(58, 1, 32, '2019-04-18 12:44:58', 1),
(59, 1, 16, '2019-04-18 12:45:08', 0),
(60, 1, 17, '2019-04-18 12:45:09', 0),
(61, 1, 15, '2019-04-18 12:45:11', 0),
(62, 1, 14, '2019-04-18 12:45:13', 1),
(63, 1, 31, '2019-04-18 12:45:18', 1),
(64, 1, 33, '2019-05-12 14:37:42', 1),
(65, 1, 34, '2019-05-12 15:07:31', 1),
(66, 1, 35, '2019-05-12 15:07:32', 1),
(67, 1, 36, '2019-05-12 15:26:05', 1),
(68, 1, 37, '2019-05-12 18:13:26', 1),
(69, 1, 38, '2019-05-12 18:14:24', 1),
(70, 1, 39, '2019-05-12 18:14:25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_volar`
--

CREATE TABLE `permisos_volar` (
  `id_per` int(11) NOT NULL COMMENT 'Llave Primaria',
  `nombre_per` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del Permiso',
  `img_per` varchar(150) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Imagen',
  `ruta_per` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Ruta delarchivo',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permisos_volar`
--

INSERT INTO `permisos_volar` (`id_per`, `nombre_per`, `img_per`, `ruta_per`, `register`, `status`) VALUES
(1, 'Captura Diaria', '../img/modulos/captura.png', 'captura_nueva/', '2019-03-30 22:56:21', 0),
(2, 'Reservas', '../img/modulos/newc.png', 'captura_nuevo/', '2019-03-31 10:29:44', 1),
(3, 'Conciliar Pagos', '../img/modulos/conciliar.jpg', 'conciliar_pago/', '2019-03-31 14:19:37', 0),
(4, 'Registrar Estados', '../img/modulos/registro.png', 'estados/', '2019-03-31 17:05:13', 1),
(5, 'Servicios Extra', '../img/modulos/servicio.png', 'agregar_servicio/', '2019-03-31 20:14:55', 1),
(6, 'Tipo de Vuelos', '../img/modulos/globo.png', 'registro_cat_vuelos/', '2019-04-05 13:37:32', 1),
(7, 'Servicios', '../img/modulos/catalogo.png', 'catalogo_servicios/', '2019-04-08 22:42:53', 1),
(8, 'Usuarios', '../img/modulos/users.png', 'usuarios_volar/', '2019-04-09 12:59:39', 1),
(9, 'Hoteles', '../img/modulos/hotel.png', 'registro_hoteles/', '2019-04-14 14:00:31', 1),
(10, 'Globos', '../img/modulos/globo.png', 'globos/', '2019-05-12 14:37:06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos_volar`
--

CREATE TABLE `puestos_volar` (
  `id_puesto` int(11) NOT NULL COMMENT 'Llave Primaria',
  `nombre_puesto` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Puesto',
  `depto_puesto` int(11) NOT NULL COMMENT 'Departamento',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `puestos_volar`
--

INSERT INTO `puestos_volar` (`id_puesto`, `nombre_puesto`, `depto_puesto`, `register`, `status`) VALUES
(1, 'Desarrollador', 54, '2019-04-09 14:45:21', 1),
(2, 'PILOTO', 62, '2019-04-17 17:59:11', 1),
(3, 'CONTADOR(A)', 63, '2019-04-17 19:51:44', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_permisos`
--

CREATE TABLE `relacion_permisos` (
  `id_rel` int(11) NOT NULL COMMENT 'Llave Primaria',
  `idusu_rel` int(11) NOT NULL COMMENT 'Usuario',
  `idper_rel` int(11) NOT NULL COMMENT 'Permiso',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `relacion_permisos`
--

INSERT INTO `relacion_permisos` (`id_rel`, `idusu_rel`, `idper_rel`, `register`, `status`) VALUES
(1, 1, 1, '2019-03-30 23:03:31', 1),
(2, 1, 2, '2019-03-31 10:49:33', 1),
(3, 1, 3, '2019-03-31 14:19:50', 1),
(4, 1, 4, '2019-03-31 17:05:21', 1),
(5, 1, 5, '2019-03-31 20:15:24', 1),
(6, 1, 6, '2019-04-05 13:37:56', 1),
(7, 1, 7, '2019-04-08 22:43:07', 1),
(8, 1, 8, '2019-04-09 12:59:57', 1),
(9, 2, 6, '2019-04-09 22:32:29', 1),
(10, 2, 1, '2019-04-09 22:34:17', 0),
(11, 2, 1, '2019-04-09 22:35:16', 0),
(12, 2, 5, '2019-04-09 22:35:16', 1),
(13, 2, 2, '2019-04-09 22:35:16', 1),
(14, 2, 7, '2019-04-09 22:35:16', 1),
(15, 2, 8, '2019-04-09 22:35:16', 1),
(16, 1, 9, '2019-04-14 15:06:04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_catvuelos_volar`
--

CREATE TABLE `rel_catvuelos_volar` (
  `id_rel` int(11) NOT NULL COMMENT 'Llave Primaria',
  `idvc_rel` int(11) NOT NULL COMMENT 'Categoría de Vuelo',
  `idcat_rel` int(11) NOT NULL COMMENT 'Servicio',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Servicios por tipo de vuelo';

--
-- Volcado de datos para la tabla `rel_catvuelos_volar`
--

INSERT INTO `rel_catvuelos_volar` (`id_rel`, `idvc_rel`, `idcat_rel`, `register`, `status`) VALUES
(14, 1, 1, '2019-04-09 12:56:22', 0),
(15, 1, 6, '2019-04-09 12:56:35', 0),
(16, 1, 7, '2019-04-09 13:08:01', 0),
(17, 1, 1, '2019-04-09 22:22:43', 0),
(18, 1, 1, '2019-04-09 22:34:38', 0),
(19, 1, 2, '2019-04-09 22:34:53', 0),
(20, 1, 3, '2019-04-09 22:35:08', 0),
(21, 1, 4, '2019-04-09 22:38:30', 0),
(22, 1, 5, '2019-04-09 22:38:43', 0),
(23, 1, 6, '2019-04-09 22:39:12', 0),
(24, 2, 1, '2019-04-09 22:40:21', 1),
(25, 2, 2, '2019-04-09 22:40:30', 1),
(26, 2, 3, '2019-04-09 22:40:48', 0),
(27, 2, 7, '2019-04-09 22:41:08', 0),
(28, 2, 4, '2019-04-09 22:41:29', 0),
(29, 2, 8, '2019-04-09 22:41:55', 0),
(30, 2, 4, '2019-04-09 22:44:42', 0),
(31, 2, 7, '2019-04-09 22:45:57', 0),
(32, 2, 4, '2019-04-09 22:47:29', 0),
(33, 2, 8, '2019-04-09 22:47:46', 0),
(34, 2, 5, '2019-04-09 22:48:12', 0),
(35, 2, 6, '2019-04-09 22:48:30', 0),
(36, 2, 12, '2019-04-09 22:49:45', 0),
(37, 2, 3, '2019-04-09 22:50:04', 0),
(38, 2, 3, '2019-04-09 22:51:15', 0),
(39, 3, 9, '2019-04-09 23:00:29', 1),
(40, 3, 1, '2019-04-09 23:00:43', 1),
(41, 3, 2, '2019-04-09 23:01:04', 1),
(42, 3, 3, '2019-04-09 23:01:16', 1),
(43, 3, 7, '2019-04-09 23:01:57', 1),
(44, 3, 10, '2019-04-09 23:02:16', 1),
(45, 3, 11, '2019-04-09 23:02:31', 1),
(46, 3, 5, '2019-04-09 23:02:47', 1),
(47, 3, 6, '2019-04-09 23:02:57', 1),
(48, 4, 1, '2019-04-09 23:07:08', 1),
(49, 4, 2, '2019-04-09 23:07:19', 1),
(50, 4, 3, '2019-04-09 23:08:32', 1),
(51, 4, 7, '2019-04-09 23:09:46', 1),
(52, 4, 4, '2019-04-09 23:09:59', 1),
(53, 4, 8, '2019-04-09 23:10:11', 1),
(54, 4, 12, '2019-04-09 23:10:32', 1),
(55, 4, 5, '2019-04-09 23:10:47', 1),
(56, 4, 6, '2019-04-09 23:10:55', 1),
(57, 2, 3, '2019-04-10 21:35:01', 1),
(58, 2, 7, '2019-04-10 21:35:14', 1),
(59, 2, 4, '2019-04-10 21:35:26', 1),
(60, 2, 8, '2019-04-10 21:35:40', 1),
(61, 2, 5, '2019-04-10 21:35:52', 1),
(62, 2, 6, '2019-04-10 21:36:05', 1),
(63, 5, 1, '2019-04-10 21:41:11', 1),
(64, 5, 13, '2019-04-10 21:42:07', 1),
(65, 5, 3, '2019-04-10 21:42:22', 1),
(66, 5, 7, '2019-04-10 21:42:36', 1),
(67, 5, 4, '2019-04-10 21:43:24', 1),
(68, 5, 8, '2019-04-10 21:43:47', 1),
(69, 5, 14, '2019-04-10 21:44:01', 1),
(70, 5, 15, '2019-04-10 21:44:14', 1),
(71, 5, 5, '2019-04-10 21:44:23', 1),
(72, 5, 6, '2019-04-10 21:44:31', 1),
(73, 1, 1, '2019-04-10 21:47:55', 1),
(74, 1, 2, '2019-04-10 21:51:10', 1),
(75, 1, 3, '2019-04-10 21:51:43', 1),
(76, 1, 4, '2019-04-10 21:51:50', 1),
(77, 1, 5, '2019-04-10 21:51:58', 1),
(78, 1, 6, '2019-04-10 21:52:12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_volar`
--

CREATE TABLE `servicios_volar` (
  `id_servicio` int(11) NOT NULL COMMENT 'Llave Primaria',
  `nombre_servicio` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Nombre',
  `precio_servicio` float DEFAULT NULL COMMENT 'Precio',
  `img_servicio` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT '../../img/image-not-found.gif' COMMENT 'Imagen',
  `cortesia_servicio` tinyint(4) DEFAULT '1' COMMENT 'Con Cortesia',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicios_volar`
--

INSERT INTO `servicios_volar` (`id_servicio`, `nombre_servicio`, `precio_servicio`, `img_servicio`, `cortesia_servicio`, `register`, `status`) VALUES
(1, 'Flores', 200, '../img/flores.png', 1, '2019-03-31 20:21:40', 1),
(2, 'Vino', 1350, '../img/vino.png', 1, '2019-03-31 20:22:30', 1),
(3, 'Lona Personalizada', 600, '../img/lona_personalizada.png', 0, '2019-03-31 20:25:04', 1),
(4, 'Trio', 2000, '../img/trio.jpg', 1, '2019-03-31 20:29:58', 1),
(5, 'Desayuno', 140, '../img/desayuno.png', 1, '2019-03-31 20:31:16', 1),
(6, 'Cena', 350, '../img/cena.png', 1, '2019-03-31 20:32:08', 1),
(7, 'Fotos', 500, '../img/foto.jpg', 1, '2019-03-31 21:33:58', 1),
(8, 'Video', 500, '../img/video.png', 1, '2019-03-31 21:35:45', 1),
(9, 'Teotihuacan en Bici', 500, '../img/bici.png', 1, '2019-03-31 21:36:20', 1),
(10, 'spa', 1500, '../img/spa.png', 1, '2019-03-31 21:37:07', 1),
(11, 'Temazcal', 600, '../img/temazcal.jpg', 1, '2019-03-31 21:37:26', 1),
(12, 'Cuatrimotos', 800, '../img/cuatrimotos.png', 1, '2019-03-31 21:37:42', 1),
(13, 'Entremes', 400, '../img/entremes.jpeg', 1, '2019-03-31 21:38:01', 1),
(14, 'Transporte Redondo', 500, '../img/vredondo.jpg', 1, '2019-03-31 21:38:32', 1),
(15, 'Viaje Sencillo', 300, '../img/vsencillo.png', 1, '2019-03-31 21:39:28', 1),
(16, 'Foto Impresa', 200, '../img/fimpresa.png', 1, '2019-03-31 21:39:50', 1),
(17, 'Guia de 1 a 4', 900, '../img/3pers.png', 1, '2019-03-31 21:40:15', 1),
(18, 'Guia de 5 a 10', 1500, '../img/5pers.jpg', 1, '2019-03-31 21:40:35', 1),
(19, 'Servcio', 200, '../img/../img/newc.png', 1, '2019-04-01 08:26:22', 0),
(20, 'prueba2', 100, '../img/../img/newc.png', 1, '2019-04-01 10:47:38', 0),
(21, 'Prueba', 500, '../img/../img/newc.png', 0, '2019-04-02 20:44:23', 0),
(22, 'otro', 1250, '../img/../img/new.png', 1, '2019-04-08 22:38:29', 0),
(23, 'sa', 32, '../img/newc.png', 1, '2019-04-08 22:40:12', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_vuelo_temp`
--

CREATE TABLE `servicios_vuelo_temp` (
  `id_sv` int(11) NOT NULL COMMENT 'Llave Primaria',
  `idtemp_sv` int(11) NOT NULL COMMENT 'Reserva',
  `idservi_sv` int(11) NOT NULL COMMENT 'Servicio',
  `tipo_sv` tinyint(4) DEFAULT '0' COMMENT 'Tipo',
  `cantidad_sv` mediumint(9) NOT NULL DEFAULT '0' COMMENT 'Cantidad',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicios_vuelo_temp`
--

INSERT INTO `servicios_vuelo_temp` (`id_sv`, `idtemp_sv`, `idservi_sv`, `tipo_sv`, `cantidad_sv`, `register`, `status`) VALUES
(21, 27, 1, 1, 0, '2019-05-12 13:33:25', 2),
(22, 27, 1, 2, 0, '2019-05-12 13:33:25', 2),
(23, 27, 2, 1, 0, '2019-05-12 13:33:25', 2),
(24, 27, 2, 2, 0, '2019-05-12 13:33:25', 2),
(25, 27, 3, 1, 0, '2019-05-12 13:33:25', 2),
(26, 27, 3, 2, 0, '2019-05-12 13:33:25', 2),
(27, 27, 4, 1, 0, '2019-05-12 13:33:25', 2),
(28, 27, 4, 2, 0, '2019-05-12 13:33:25', 2),
(29, 27, 5, 1, 0, '2019-05-12 13:33:25', 2),
(30, 27, 5, 2, 0, '2019-05-12 13:33:25', 2),
(31, 27, 6, 1, 0, '2019-05-12 13:33:25', 2),
(32, 27, 6, 2, 0, '2019-05-12 13:33:25', 2),
(33, 27, 7, 1, 0, '2019-05-12 13:33:25', 2),
(34, 27, 7, 2, 0, '2019-05-12 13:33:25', 2),
(35, 27, 8, 1, 0, '2019-05-12 13:33:25', 2),
(36, 27, 8, 2, 0, '2019-05-12 13:33:25', 2),
(37, 27, 9, 1, 0, '2019-05-12 13:33:25', 2),
(38, 27, 9, 2, 0, '2019-05-12 13:33:25', 2),
(39, 27, 10, 1, 0, '2019-05-12 13:33:25', 2),
(40, 27, 10, 2, 0, '2019-05-12 13:33:25', 2),
(41, 27, 11, 1, 0, '2019-05-12 13:33:25', 2),
(42, 27, 11, 2, 0, '2019-05-12 13:33:25', 2),
(43, 27, 12, 1, 0, '2019-05-12 13:33:25', 2),
(44, 27, 12, 2, 0, '2019-05-12 13:33:25', 2),
(45, 27, 13, 1, 0, '2019-05-12 13:33:25', 2),
(46, 27, 13, 2, 0, '2019-05-12 13:33:25', 2),
(47, 27, 14, 1, 0, '2019-05-12 13:33:25', 2),
(48, 27, 14, 2, 0, '2019-05-12 13:33:25', 2),
(49, 27, 15, 1, 0, '2019-05-12 13:33:25', 2),
(50, 27, 15, 2, 0, '2019-05-12 13:33:25', 2),
(51, 27, 16, 1, 0, '2019-05-12 13:33:25', 2),
(52, 27, 16, 2, 0, '2019-05-12 13:33:25', 2),
(53, 27, 17, 1, 0, '2019-05-12 13:33:25', 2),
(54, 27, 17, 2, 0, '2019-05-12 13:33:25', 2),
(55, 27, 18, 1, 0, '2019-05-12 13:33:25', 2),
(56, 27, 18, 2, 0, '2019-05-12 13:33:25', 2),
(57, 1, 1, 1, 0, '2019-05-12 15:26:36', 2),
(58, 1, 1, 2, 0, '2019-05-12 15:26:36', 2),
(59, 1, 2, 1, 0, '2019-05-12 15:26:36', 2),
(60, 1, 2, 2, 0, '2019-05-12 15:26:36', 2),
(61, 1, 3, 1, 0, '2019-05-12 15:26:36', 2),
(62, 1, 3, 2, 0, '2019-05-12 15:26:36', 2),
(63, 1, 4, 1, 0, '2019-05-12 15:26:36', 2),
(64, 1, 4, 2, 0, '2019-05-12 15:26:36', 2),
(65, 1, 5, 1, 0, '2019-05-12 15:26:36', 2),
(66, 1, 5, 2, 0, '2019-05-12 15:26:36', 2),
(67, 1, 6, 1, 0, '2019-05-12 15:26:36', 2),
(68, 1, 6, 2, 0, '2019-05-12 15:26:36', 2),
(69, 1, 7, 1, 0, '2019-05-12 15:26:36', 2),
(70, 1, 7, 2, 0, '2019-05-12 15:26:36', 2),
(71, 1, 8, 1, 0, '2019-05-12 15:26:36', 2),
(72, 1, 8, 2, 0, '2019-05-12 15:26:37', 2),
(73, 1, 9, 1, 0, '2019-05-12 15:26:37', 2),
(74, 1, 9, 2, 0, '2019-05-12 15:26:37', 2),
(75, 1, 10, 1, 0, '2019-05-12 15:26:37', 2),
(76, 1, 10, 2, 0, '2019-05-12 15:26:37', 2),
(77, 1, 11, 1, 0, '2019-05-12 15:26:37', 2),
(78, 1, 11, 2, 0, '2019-05-12 15:26:37', 2),
(79, 1, 12, 1, 0, '2019-05-12 15:26:37', 2),
(80, 1, 12, 2, 0, '2019-05-12 15:26:37', 2),
(81, 1, 13, 1, 0, '2019-05-12 15:26:37', 2),
(82, 1, 13, 2, 0, '2019-05-12 15:26:37', 2),
(83, 1, 14, 1, 0, '2019-05-12 15:26:37', 2),
(84, 1, 14, 2, 0, '2019-05-12 15:26:37', 2),
(85, 1, 15, 1, 0, '2019-05-12 15:26:37', 2),
(86, 1, 15, 2, 0, '2019-05-12 15:26:37', 2),
(87, 1, 16, 1, 0, '2019-05-12 15:26:37', 2),
(88, 1, 16, 2, 0, '2019-05-12 15:26:37', 2),
(89, 1, 17, 1, 0, '2019-05-12 15:26:37', 2),
(90, 1, 17, 2, 0, '2019-05-12 15:26:37', 2),
(91, 1, 18, 1, 0, '2019-05-12 15:26:37', 2),
(92, 1, 18, 2, 0, '2019-05-12 15:26:37', 2),
(93, 29, 1, 1, 0, '2019-05-12 15:31:35', 2),
(94, 29, 1, 2, 0, '2019-05-12 15:31:35', 2),
(95, 29, 2, 1, 0, '2019-05-12 15:31:35', 2),
(96, 29, 2, 2, 0, '2019-05-12 15:31:35', 2),
(97, 29, 3, 1, 0, '2019-05-12 15:31:35', 2),
(98, 29, 3, 2, 0, '2019-05-12 15:31:35', 2),
(99, 29, 4, 1, 0, '2019-05-12 15:31:35', 2),
(100, 29, 4, 2, 0, '2019-05-12 15:31:35', 2),
(101, 29, 5, 1, 0, '2019-05-12 15:31:35', 2),
(102, 29, 5, 2, 0, '2019-05-12 15:31:35', 2),
(103, 29, 6, 1, 0, '2019-05-12 15:31:35', 2),
(104, 29, 6, 2, 0, '2019-05-12 15:31:35', 2),
(105, 29, 7, 1, 0, '2019-05-12 15:31:35', 2),
(106, 29, 7, 2, 0, '2019-05-12 15:31:35', 2),
(107, 29, 8, 1, 0, '2019-05-12 15:31:35', 2),
(108, 29, 8, 2, 0, '2019-05-12 15:31:35', 2),
(109, 29, 9, 1, 0, '2019-05-12 15:31:35', 2),
(110, 29, 9, 2, 0, '2019-05-12 15:31:35', 2),
(111, 29, 10, 1, 0, '2019-05-12 15:31:35', 2),
(112, 29, 10, 2, 0, '2019-05-12 15:31:35', 2),
(113, 29, 11, 1, 0, '2019-05-12 15:31:35', 2),
(114, 29, 11, 2, 0, '2019-05-12 15:31:35', 2),
(115, 29, 12, 1, 0, '2019-05-12 15:31:35', 2),
(116, 29, 12, 2, 0, '2019-05-12 15:31:35', 2),
(117, 29, 13, 1, 0, '2019-05-12 15:31:35', 2),
(118, 29, 13, 2, 0, '2019-05-12 15:31:35', 2),
(119, 29, 14, 1, 3, '2019-05-12 15:31:35', 2),
(120, 29, 14, 2, 0, '2019-05-12 15:31:35', 2),
(121, 29, 15, 1, 0, '2019-05-12 15:31:35', 2),
(122, 29, 15, 2, 0, '2019-05-12 15:31:35', 2),
(123, 29, 16, 1, 0, '2019-05-12 15:31:35', 2),
(124, 29, 16, 2, 0, '2019-05-12 15:31:35', 2),
(125, 29, 17, 1, 0, '2019-05-12 15:31:35', 2),
(126, 29, 17, 2, 0, '2019-05-12 15:31:35', 2),
(127, 29, 18, 1, 0, '2019-05-12 15:31:35', 2),
(128, 29, 18, 2, 0, '2019-05-12 15:31:35', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subpermisos_volar`
--

CREATE TABLE `subpermisos_volar` (
  `id_sp` int(11) NOT NULL COMMENT 'Llave Primaria',
  `nombre_sp` varchar(12) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Permiso',
  `permiso_sp` int(11) NOT NULL COMMENT 'Modulo',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subpermisos_volar`
--

INSERT INTO `subpermisos_volar` (`id_sp`, `nombre_sp`, `permiso_sp`, `register`, `status`) VALUES
(1, 'AGREGAR', 8, '2019-04-10 15:37:07', 1),
(2, 'CONCILIAR', 2, '2019-04-10 15:47:56', 1),
(3, 'PERMISOS', 8, '2019-04-10 16:36:49', 1),
(4, 'VER', 8, '2019-04-10 16:36:49', 1),
(5, 'ELIMINAR', 8, '2019-04-10 16:36:49', 1),
(6, 'EDITAR', 8, '2019-04-10 16:36:49', 1),
(7, 'AGREGAR', 2, '2019-04-10 21:05:45', 1),
(8, 'VER', 2, '2019-04-10 21:26:10', 1),
(9, 'EDITAR', 2, '2019-04-10 21:26:10', 1),
(10, 'ELIMINAR', 2, '2019-04-10 22:11:05', 1),
(11, 'COTIZACION', 2, '2019-04-10 22:11:05', 1),
(12, 'AGREGAR PAGO', 2, '2019-04-10 22:11:05', 1),
(13, 'BITACORA', 2, '2019-04-10 22:11:05', 1),
(14, 'EDITAR', 6, '2019-04-10 22:14:02', 1),
(15, 'ELIMINAR ', 6, '2019-04-10 22:14:02', 1),
(16, 'VER', 6, '2019-04-10 22:14:02', 1),
(17, 'SERVICIOS', 6, '2019-04-10 22:14:02', 1),
(18, 'EDITAR', 7, '2019-04-10 22:18:47', 1),
(19, 'ELIMINAR ', 7, '2019-04-10 22:18:47', 1),
(23, 'EDITAR GRAL', 2, '2019-04-11 14:34:14', 1),
(24, 'VER GRAL', 2, '2019-04-11 14:34:14', 1),
(25, 'BITACORA GRA', 2, '2019-04-11 14:34:14', 1),
(26, 'GENERAL', 2, '2019-04-11 14:35:42', 1),
(27, 'CAMBIOS', 2, '2019-04-11 20:42:25', 1),
(28, 'AGREGAR', 9, '2019-04-14 15:06:33', 1),
(29, 'ELIMINAR GRL', 2, '2019-04-15 09:19:54', 1),
(30, 'AGREGAR', 4, '2019-04-18 12:44:10', 1),
(31, 'AGREGAR', 7, '2019-04-18 12:44:24', 1),
(32, 'AGREGAR', 5, '2019-04-18 12:44:45', 1),
(33, 'AGREGAR', 10, '2019-05-12 14:37:22', 1),
(34, 'EDITAR', 10, '2019-05-12 15:07:22', 1),
(35, 'ELIMINAR', 10, '2019-05-12 15:07:22', 1),
(36, 'REPORTES', 2, '2019-05-12 15:25:57', 1),
(37, 'EDITAR', 9, '2019-05-12 18:13:23', 1),
(38, 'ELIMINAR', 9, '2019-05-12 18:14:18', 1),
(39, 'HABITACIONES', 9, '2019-05-12 18:14:18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_volar`
--

CREATE TABLE `temp_volar` (
  `id_temp` int(11) NOT NULL COMMENT 'Llave Primaria',
  `idusu_temp` int(11) NOT NULL COMMENT 'Usuario',
  `clave_temp` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Clave',
  `nombre_temp` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Nombre',
  `apellidos_temp` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Apellidos',
  `mail_temp` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'E-mail',
  `telfijo_temp` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Telefono FIjo',
  `telcelular_temp` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Telefono Celular',
  `procedencia_temp` tinyint(4) DEFAULT NULL COMMENT 'Procedencia',
  `pasajerosa_temp` tinyint(4) DEFAULT NULL COMMENT 'Pasajeros Adultos',
  `pasajerosn_temp` tinyint(4) DEFAULT '0' COMMENT 'Pasajeros Niños',
  `motivo_temp` tinyint(4) DEFAULT NULL COMMENT 'Motivo',
  `tipo_temp` tinyint(4) DEFAULT NULL COMMENT 'Tipo',
  `fechavuelo_temp` date DEFAULT NULL COMMENT 'Fecha de Vuelo',
  `tarifa_temp` tinyint(4) DEFAULT NULL COMMENT 'Tipo de Tarifa',
  `hotel_temp` tinyint(4) DEFAULT NULL COMMENT 'Hotel',
  `habitacion_temp` tinyint(4) DEFAULT NULL COMMENT 'Habitación',
  `checkin_temp` date DEFAULT NULL COMMENT 'Check In',
  `checkout_temp` date DEFAULT NULL COMMENT 'Check Out',
  `comentario_temp` tinytext COLLATE utf8_spanish_ci COMMENT 'Comentarios',
  `otroscar1_temp` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Otros Cargos',
  `precio1_temp` decimal(11,2) DEFAULT NULL COMMENT 'Precio',
  `otroscar2_temp` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Otros CArgos',
  `precio2_temp` decimal(11,2) DEFAULT NULL COMMENT 'Precio',
  `tdescuento_temp` tinyint(4) DEFAULT NULL COMMENT 'Tipo de Descuento',
  `cantdescuento_temp` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT 'Cantidad de Desuento',
  `total_temp` double(10,2) DEFAULT '0.00' COMMENT 'Total',
  `piloto_temp` int(11) DEFAULT '0' COMMENT 'Piloto',
  `kg_temp` decimal(10,2) DEFAULT '0.00' COMMENT 'Peso',
  `globo_temp` int(11) DEFAULT '0' COMMENT 'Globo',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla Temporal';

--
-- Volcado de datos para la tabla `temp_volar`
--

INSERT INTO `temp_volar` (`id_temp`, `idusu_temp`, `clave_temp`, `nombre_temp`, `apellidos_temp`, `mail_temp`, `telfijo_temp`, `telcelular_temp`, `procedencia_temp`, `pasajerosa_temp`, `pasajerosn_temp`, `motivo_temp`, `tipo_temp`, `fechavuelo_temp`, `tarifa_temp`, `hotel_temp`, `habitacion_temp`, `checkin_temp`, `checkout_temp`, `comentario_temp`, `otroscar1_temp`, `precio1_temp`, `otroscar2_temp`, `precio2_temp`, `tdescuento_temp`, `cantdescuento_temp`, `total_temp`, `piloto_temp`, `kg_temp`, `globo_temp`, `register`, `status`) VALUES
(29, 1, NULL, 'ENRIQUE', 'DAMASCO', 'enriquealducin@outlook.com', NULL, '5529227672', 5, 8, 0, 37, 2, '2019-05-09', 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 0.00, 0, '0.00', 0, '2019-05-12 15:31:35', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `volar_usuarios`
--

CREATE TABLE `volar_usuarios` (
  `id_usu` int(4) NOT NULL COMMENT 'Llave Primaria',
  `nombre_usu` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre',
  `apellidop_usu` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Apellido Paterno',
  `apellidom_usu` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Apellido Materno',
  `depto_usu` tinyint(50) NOT NULL COMMENT 'Departamento',
  `puesto_usu` tinyint(4) NOT NULL COMMENT 'Puesto',
  `correo_usu` varchar(150) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Correo',
  `telefono_usu` varchar(13) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0' COMMENT 'Teléfono',
  `contrasena_usu` varchar(150) COLLATE utf8_spanish_ci NOT NULL DEFAULT '202cb962ac59075b964b07152d234b70' COMMENT 'Contraseña',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `volar_usuarios`
--

INSERT INTO `volar_usuarios` (`id_usu`, `nombre_usu`, `apellidop_usu`, `apellidom_usu`, `depto_usu`, `puesto_usu`, `correo_usu`, `telefono_usu`, `contrasena_usu`, `register`, `status`) VALUES
(1, 'Enrique', 'Damasco', 'Alducin', 54, 1, 'enriquealducin@outlook.com', '55-2922-7672', '202cb962ac59075b964b07152d234b70', '2019-03-29 23:20:06', 1),
(2, 'Verenice', 'Gomez', 'Martinez', 54, 3, 'verenicegm@gmail.com', '5524628183', '202cb962ac59075b964b07152d234b70', '2019-04-09 14:55:40', 1),
(3, 'Sonia', 'Alducin', 'Guajardo', 63, 3, 'enriquealducin@outlook.com', '5529212556', '202cb962ac59075b964b07152d234b70', '2019-04-10 09:27:49', 1),
(5, 'Victor', 'Vazquez', 'Velazquez', 54, 1, 'vvv-nas@outlook.com', '55-2654-5234', '202cb962ac59075b964b07152d234b70', '2019-04-18 11:07:42', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vueloscat_volar`
--

CREATE TABLE `vueloscat_volar` (
  `id_vc` int(11) NOT NULL COMMENT 'Llave Primaria',
  `nombre_vc` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Nombre',
  `tipo_vc` tinyint(4) DEFAULT NULL COMMENT 'TIpo de Vuelo',
  `precioa_vc` decimal(10,2) NOT NULL COMMENT 'Precio de Adultos',
  `precion_vc` decimal(10,2) DEFAULT NULL COMMENT 'Precio de Niños',
  `register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vueloscat_volar`
--

INSERT INTO `vueloscat_volar` (`id_vc`, `nombre_vc`, `tipo_vc`, `precioa_vc`, `precion_vc`, `register`, `status`) VALUES
(1, 'Compartido básico', 47, '2299.00', '1700.00', '2019-04-05 11:03:46', 1),
(2, 'Compartido Plus', 47, '2399.00', '1799.00', '2019-04-05 11:03:46', 1),
(3, 'Cumpleañero', 47, '2399.00', '1799.00', '2019-04-05 11:04:31', 1),
(4, 'Privado', 46, '7000.00', '1700.00', '2019-04-05 11:28:14', 1),
(5, 'Privado VIP', 46, '9000.00', '1700.00', '2019-04-05 11:28:53', 1),
(14, ' preuba', 47, '43.00', '22.00', '2019-04-09 12:52:38', 0),
(15, ' prueba35', 47, '3.00', '2.00', '2019-04-09 12:56:06', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora_actualizaciones_volar`
--
ALTER TABLE `bitacora_actualizaciones_volar`
  ADD PRIMARY KEY (`id_bit`);

--
-- Indices de la tabla `bitpagos_volar`
--
ALTER TABLE `bitpagos_volar`
  ADD PRIMARY KEY (`id_bp`);

--
-- Indices de la tabla `cat_servicios_volar`
--
ALTER TABLE `cat_servicios_volar`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `extras_volar`
--
ALTER TABLE `extras_volar`
  ADD PRIMARY KEY (`id_extra`);

--
-- Indices de la tabla `globos_volar`
--
ALTER TABLE `globos_volar`
  ADD PRIMARY KEY (`id_globo`);

--
-- Indices de la tabla `habitaciones_volar`
--
ALTER TABLE `habitaciones_volar`
  ADD PRIMARY KEY (`id_habitacion`);

--
-- Indices de la tabla `hoteles_volar`
--
ALTER TABLE `hoteles_volar`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Indices de la tabla `imghoteles_volar`
--
ALTER TABLE `imghoteles_volar`
  ADD PRIMARY KEY (`id_img`);

--
-- Indices de la tabla `permisosusuarios_volar`
--
ALTER TABLE `permisosusuarios_volar`
  ADD PRIMARY KEY (`id_puv`),
  ADD KEY `idusu_puv` (`idusu_puv`),
  ADD KEY `idsp_puv` (`idsp_puv`);

--
-- Indices de la tabla `permisos_volar`
--
ALTER TABLE `permisos_volar`
  ADD PRIMARY KEY (`id_per`);

--
-- Indices de la tabla `puestos_volar`
--
ALTER TABLE `puestos_volar`
  ADD PRIMARY KEY (`id_puesto`),
  ADD KEY `depto_puesto` (`depto_puesto`);

--
-- Indices de la tabla `relacion_permisos`
--
ALTER TABLE `relacion_permisos`
  ADD PRIMARY KEY (`id_rel`),
  ADD KEY `idusu_rel` (`idusu_rel`),
  ADD KEY `idper_rel` (`idper_rel`);

--
-- Indices de la tabla `rel_catvuelos_volar`
--
ALTER TABLE `rel_catvuelos_volar`
  ADD PRIMARY KEY (`id_rel`);

--
-- Indices de la tabla `servicios_volar`
--
ALTER TABLE `servicios_volar`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `servicios_vuelo_temp`
--
ALTER TABLE `servicios_vuelo_temp`
  ADD PRIMARY KEY (`id_sv`);

--
-- Indices de la tabla `subpermisos_volar`
--
ALTER TABLE `subpermisos_volar`
  ADD PRIMARY KEY (`id_sp`),
  ADD KEY `permiso_sp` (`permiso_sp`);

--
-- Indices de la tabla `temp_volar`
--
ALTER TABLE `temp_volar`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indices de la tabla `volar_usuarios`
--
ALTER TABLE `volar_usuarios`
  ADD PRIMARY KEY (`id_usu`);

--
-- Indices de la tabla `vueloscat_volar`
--
ALTER TABLE `vueloscat_volar`
  ADD PRIMARY KEY (`id_vc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora_actualizaciones_volar`
--
ALTER TABLE `bitacora_actualizaciones_volar`
  MODIFY `id_bit` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria';

--
-- AUTO_INCREMENT de la tabla `bitpagos_volar`
--
ALTER TABLE `bitpagos_volar`
  MODIFY `id_bp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria';

--
-- AUTO_INCREMENT de la tabla `cat_servicios_volar`
--
ALTER TABLE `cat_servicios_volar`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `extras_volar`
--
ALTER TABLE `extras_volar`
  MODIFY `id_extra` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `globos_volar`
--
ALTER TABLE `globos_volar`
  MODIFY `id_globo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `habitaciones_volar`
--
ALTER TABLE `habitaciones_volar`
  MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `hoteles_volar`
--
ALTER TABLE `hoteles_volar`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `imghoteles_volar`
--
ALTER TABLE `imghoteles_volar`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria';

--
-- AUTO_INCREMENT de la tabla `permisosusuarios_volar`
--
ALTER TABLE `permisosusuarios_volar`
  MODIFY `id_puv` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `permisos_volar`
--
ALTER TABLE `permisos_volar`
  MODIFY `id_per` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `puestos_volar`
--
ALTER TABLE `puestos_volar`
  MODIFY `id_puesto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `relacion_permisos`
--
ALTER TABLE `relacion_permisos`
  MODIFY `id_rel` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `rel_catvuelos_volar`
--
ALTER TABLE `rel_catvuelos_volar`
  MODIFY `id_rel` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `servicios_volar`
--
ALTER TABLE `servicios_volar`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `servicios_vuelo_temp`
--
ALTER TABLE `servicios_vuelo_temp`
  MODIFY `id_sv` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT de la tabla `subpermisos_volar`
--
ALTER TABLE `subpermisos_volar`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `temp_volar`
--
ALTER TABLE `temp_volar`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `volar_usuarios`
--
ALTER TABLE `volar_usuarios`
  MODIFY `id_usu` int(4) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vueloscat_volar`
--
ALTER TABLE `vueloscat_volar`
  MODIFY `id_vc` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permisosusuarios_volar`
--
ALTER TABLE `permisosusuarios_volar`
  ADD CONSTRAINT `permisosusuarios_volar_ibfk_1` FOREIGN KEY (`idusu_puv`) REFERENCES `volar_usuarios` (`id_usu`),
  ADD CONSTRAINT `permisosusuarios_volar_ibfk_2` FOREIGN KEY (`idsp_puv`) REFERENCES `subpermisos_volar` (`id_sp`);

--
-- Filtros para la tabla `puestos_volar`
--
ALTER TABLE `puestos_volar`
  ADD CONSTRAINT `puestos_volar_ibfk_1` FOREIGN KEY (`depto_puesto`) REFERENCES `extras_volar` (`id_extra`);

--
-- Filtros para la tabla `relacion_permisos`
--
ALTER TABLE `relacion_permisos`
  ADD CONSTRAINT `relacion_permisos_ibfk_1` FOREIGN KEY (`idusu_rel`) REFERENCES `volar_usuarios` (`id_usu`),
  ADD CONSTRAINT `relacion_permisos_ibfk_2` FOREIGN KEY (`idper_rel`) REFERENCES `permisos_volar` (`id_per`);

--
-- Filtros para la tabla `subpermisos_volar`
--
ALTER TABLE `subpermisos_volar`
  ADD CONSTRAINT `subpermisos_volar_ibfk_1` FOREIGN KEY (`permiso_sp`) REFERENCES `permisos_volar` (`id_per`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
