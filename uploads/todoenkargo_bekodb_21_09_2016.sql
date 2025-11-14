-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-09-2016 a las 16:49:17
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `todoenkargo_bekodb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_ambiente`
--

CREATE TABLE IF NOT EXISTS `beko_ambiente` (
  `ambi_id` int(11) NOT NULL,
  `ambi_valor` int(11) DEFAULT NULL,
  `ambi_etiqueta` varchar(20) DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `beko_ambiente`
--

INSERT INTO `beko_ambiente` (`ambi_id`, `ambi_valor`, `ambi_etiqueta`) VALUES
(1, 1, 'Pruebas'),
(2, 2, 'ProducciÃ³n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_bodega`
--

CREATE TABLE IF NOT EXISTS `beko_bodega` (
  `bode_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `bode_nombre` varchar(250) NOT NULL,
  `bode_observacion` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_bodega`
--

INSERT INTO `beko_bodega` (`bode_id`, `emp_id`, `bode_nombre`, `bode_observacion`) VALUES
(1, 1, 'BODEGA MATRIZ', ''),
(2, 2, 'CARAPUNGO', 'CARAPUNGO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_canton`
--

CREATE TABLE IF NOT EXISTS `beko_canton` (
  `cant_id` int(11) NOT NULL,
  `cant_codigo` varchar(25) NOT NULL,
  `cant_nombre` varchar(200) NOT NULL,
  `prob_codigo` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `beko_canton`
--

INSERT INTO `beko_canton` (`cant_id`, `cant_codigo`, `cant_nombre`, `prob_codigo`) VALUES
(1, '0101', 'CUENCA', '01'),
(2, '0102', 'GIRÓN', '01'),
(3, '0103', 'GUALACEO', '01'),
(4, '0104', 'NABÓN', '01'),
(5, '0105', 'PAUTE', '01'),
(6, '0106', 'PUCARÁ', '01'),
(7, '0107', 'SAN FERNANDO', '01'),
(8, '0108', 'SANTA ISABEL', '01'),
(9, '0109', 'SIGSIG', '01'),
(10, '0110', 'OÑA', '01'),
(11, '0111', 'CHORDELEG', '01'),
(12, '0112', 'EL PAN', '01'),
(13, '0113', 'SEVILLA DE ORO', '01'),
(14, '0114', 'GUACHAPALA', '01'),
(15, '0115', 'CAMILO PONCE ENRÍQUEZ', '01'),
(16, '0201', 'GUARANDA', '02'),
(17, '0202', 'CHILLANES', '02'),
(18, '0203', 'CHIMBO', '02'),
(19, '0204', 'ECHEANDÍA', '02'),
(20, '0205', 'SAN MIGUEL', '02'),
(21, '0206', 'CALUMA', '02'),
(22, '0207', 'LAS NAVES', '02'),
(23, '0301', 'AZOGUES', '03'),
(24, '0302', 'BIBLIÁN', '03'),
(25, '0303', 'CAÑAR', '03'),
(26, '0304', 'LA TRONCAL', '03'),
(27, '0305', 'EL TAMBO', '03'),
(28, '0306', 'DÉLEG', '03'),
(29, '0307', 'SUSCAL', '03'),
(30, '0401', 'TULCÁN', '04'),
(31, '0402', 'BOLÍVAR', '04'),
(32, '0403', 'ESPEJO', '04'),
(33, '0404', 'MIRA', '04'),
(34, '0405', 'MONTÚFAR', '04'),
(35, '0406', 'SAN PEDRO DE HUACA', '04'),
(36, '0501', 'LATACUNGA', '05'),
(37, '0502', 'LA MANÁ', '05'),
(38, '0503', 'PANGUA', '05'),
(39, '0504', 'PUJILÍ', '05'),
(40, '0505', 'SALCEDO', '05'),
(41, '0506', 'SAQUISILÍ', '05'),
(42, '0507', 'SIGCHOS', '05'),
(43, '0601', 'RIOBAMBA', '06'),
(44, '0602', 'ALAUSÍ', '06'),
(45, '0603', 'COLTA', '06'),
(46, '0604', 'CHAMBO', '06'),
(47, '0605', 'CHUNCHI', '06'),
(48, '0606', 'GUAMOTE', '06'),
(49, '0607', 'GUANO', '06'),
(50, '0608', 'PALLATANGA', '06'),
(51, '0609', 'PENIPE', '06'),
(52, '0610', 'CUMANDÁ', '06'),
(53, '0701', 'MACHALA', '07'),
(54, '0702', 'ARENILLAS', '07'),
(55, '0703', 'ATAHUALPA', '07'),
(56, '0704', 'BALSAS', '07'),
(57, '0705', 'CHILLA', '07'),
(58, '0706', 'EL GUABO', '07'),
(59, '0707', 'HUAQUILLAS', '07'),
(60, '0708', 'MARCABELI', '07'),
(61, '0709', 'PASAJE', '07'),
(62, '0710', 'PIÑAS', '07'),
(63, '0711', 'PORTOVELO', '07'),
(64, '0712', 'SANTA ROSA', '07'),
(65, '0713', 'ZARUMA', '07'),
(66, '0714', 'LAS LAJAS', '07'),
(67, '0801', 'ESMERALDAS', '08'),
(68, '0802', 'ELOY ALFARO', '08'),
(69, '0803', 'MUISNE', '08'),
(70, '0804', 'QUININDE', '08'),
(71, '0805', 'SAN LORENZO', '08'),
(72, '0806', 'ATACAMES', '08'),
(73, '0807', 'RIOVERDE', '08'),
(74, '0808', 'LA CONCORDIA', '08'),
(75, '0901', 'GUAYAQUIL', '09'),
(76, '0902', 'ALFREDO BAQUERIZO MORENO', '09'),
(77, '0903', 'BALAO', '09'),
(78, '0904', 'BALZAR', '09'),
(79, '0905', 'COLIMES', '09'),
(80, '0906', 'DAULE', '09'),
(81, '0907', 'DURÁN', '09'),
(82, '0908', 'EMPALME', '09'),
(83, '0909', 'EL TRIUNFO', '09'),
(84, '0910', 'MILAGRO', '09'),
(85, '0911', 'NARANJAL', '09'),
(86, '0912', 'NARANJITO', '09'),
(87, '0913', 'PALESTINA', '09'),
(88, '0914', 'PEDRO CARBO', '09'),
(89, '0916', 'SAMBORONDÓN', '09'),
(90, '0918', 'SANTA LUCÍA', '09'),
(91, '0919', 'SALITRE', '09'),
(92, '0920', 'SAN JACINTO DE YAGUACHI', '09'),
(93, '0921', 'PLAYAS', '09'),
(94, '0922', 'SIMÓN BOLÍVAR', '09'),
(95, '0923', 'MARCELINO MARIDUEÑA', '09'),
(96, '0924', 'LOMAS DE SARGENTILLO', '09'),
(97, '0925', 'NOBOL', '09'),
(98, '0927', 'GNRAL. ANTONIO ELIZALDE', '09'),
(99, '0928', 'ISIDRO AYORA', '09'),
(100, '1001', 'IBARRA', '10'),
(101, '1002', 'ANTONIO ANTE', '10'),
(102, '1003', 'COTACACHI', '10'),
(103, '1004', 'OTAVALO', '10'),
(104, '1005', 'PIMAMPIRO', '10'),
(105, '1006', 'SAN MIGUEL DE URCUQUÍ', '10'),
(106, '1101', 'LOJA', '11'),
(107, '1102', 'CALVAS', '11'),
(108, '1103', 'CATAMAYO', '11'),
(109, '1104', 'CELICA', '11'),
(110, '1105', 'CHAGUARPAMBA', '11'),
(111, '1106', 'ESPÍNDOLA', '11'),
(112, '1107', 'GONZANAMÁ', '11'),
(113, '1108', 'MACARÁ', '11'),
(114, '1109', 'PALTAS', '11'),
(115, '1110', 'PUYANGO', '11'),
(116, '1111', 'SARAGURO', '11'),
(117, '1112', 'SOZORANGA', '11'),
(118, '1113', 'ZAPOTILLO', '11'),
(119, '1114', 'PINDAL', '11'),
(120, '1115', 'QUILANGA', '11'),
(121, '1116', 'OLMEDO', '11'),
(122, '1201', 'BABAHOYO', '12'),
(123, '1202', 'BABA', '12'),
(124, '1203', 'MONTALVO', '12'),
(125, '1204', 'PUEBLOVIEJO', '12'),
(126, '1205', 'QUEVEDO', '12'),
(127, '1206', 'URDANETA', '12'),
(128, '1207', 'VENTANAS', '12'),
(129, '1208', 'VINCES', '12'),
(130, '1209', 'PALENQUE', '12'),
(131, '1210', 'BUENA FE', '12'),
(132, '1211', 'VALENCIA', '12'),
(133, '1212', 'MOCACHE', '12'),
(134, '1213', 'QUINSALOMA', '12'),
(135, '1301', 'PORTOVIEJO', '13'),
(136, '1302', 'BOLÍVAR', '13'),
(137, '1303', 'CHONE', '13'),
(138, '1304', 'EL CARMEN', '13'),
(139, '1305', 'FLAVIO ALFARO', '13'),
(140, '1306', 'JIPIJAPA', '13'),
(141, '1307', 'JUNÍN', '13'),
(142, '1308', 'MANTA', '13'),
(143, '1309', 'MONTECRISTI', '13'),
(144, '1310', 'PAJÁN', '13'),
(145, '1311', 'PICHINCHA', '13'),
(146, '1312', 'ROCAFUERTE', '13'),
(147, '1313', 'SANTA ANA', '13'),
(148, '1314', 'SUCRE', '13'),
(149, '1315', 'TOSAGUA', '13'),
(150, '1316', '24 DE MAYO', '13'),
(151, '1317', 'PEDERNALES', '13'),
(152, '1318', 'OLMEDO', '13'),
(153, '1319', 'PUERTO LÓPEZ', '13'),
(154, '1320', 'JAMA', '13'),
(155, '1321', 'JARAMIJÓ', '13'),
(156, '1322', 'SAN VICENTE', '13'),
(157, '1401', 'MORONA', '14'),
(158, '1402', 'GUALAQUIZA', '14'),
(159, '1403', 'LIMON INDANZA', '14'),
(160, '1404', 'PALORA', '14'),
(161, '1405', 'SANTIAGO', '14'),
(162, '1406', 'SUCUA', '14'),
(163, '1407', 'HUAMBOYA', '14'),
(164, '1408', 'SAN JUAN BOSCO', '14'),
(165, '1409', 'TAISHA', '14'),
(166, '1410', 'LOGRO', '14'),
(167, '1411', 'PABLO SEXTO', '14'),
(168, '1412', 'TIWINTZA', '14'),
(169, '1501', 'TENA', '15'),
(170, '1503', 'ARCHIDONA', '15'),
(171, '1504', 'EL CHACO', '15'),
(172, '1507', 'QUIJOS', '15'),
(173, '1509', 'CARLOS JULIO AROSEMENA TOLA', '15'),
(174, '1601', 'PASTAZA', '16'),
(175, '1602', 'MERA', '16'),
(176, '1603', 'SANTA CLARA', '16'),
(177, '1604', 'ARAJUNO', '16'),
(178, '1701', 'QUITO', '17'),
(179, '1702', 'CAYAMBE', '17'),
(180, '1703', 'MEJÍA', '17'),
(181, '1704', 'PEDRO MONCAYO', '17'),
(182, '1705', 'RUMIÑAHUI', '17'),
(183, '1707', 'SAN MIGUEL DE LOS BANCOS', '17'),
(184, '1708', 'PEDRO VICENTE MALDONADO', '17'),
(185, '1709', 'PUERTO QUITO', '17'),
(186, '1801', 'AMBATO', '18'),
(187, '1802', 'BAÑOS DE AGUA SANTA', '18'),
(188, '1803', 'CEVALLOS', '18'),
(189, '1804', 'MOCHA', '18'),
(190, '1805', 'PATATE', '18'),
(191, '1806', 'QUERO', '18'),
(192, '1807', 'SAN PEDRO DE PELILEO', '18'),
(193, '1808', 'SANTIAGO DE PÍLLARO', '18'),
(194, '1809', 'TISALEO', '18'),
(195, '1901', 'ZAMORA', '19'),
(196, '1902', 'CHINCHIPE', '19'),
(197, '1903', 'NANGARITZA', '19'),
(198, '1904', 'YACUAMBI', '19'),
(199, '1905', 'YANTZAZA', '19'),
(200, '1906', 'EL PANGUI', '19'),
(201, '1907', 'CENTINELA DEL CÓNDOR', '19'),
(202, '1908', 'PALANDA', '19'),
(203, '1909', 'PAQUISHA', '19'),
(204, '2001', 'SAN CRISTÓBAL', '20'),
(205, '2002', 'ISABELA', '20'),
(206, '2003', 'SANTA CRUZ', '20'),
(207, '2101', 'LAGO AGRIO', '21'),
(208, '2102', 'GONZALO PIZARRO', '21'),
(209, '2103', 'PUTUMAYO', '21'),
(210, '2104', 'SHUSHUFINDI', '21'),
(211, '2105', 'SUCUMBÍOS', '21'),
(212, '2106', 'CASCALES', '21'),
(213, '2107', 'CUYABENO', '21'),
(214, '2201', 'FRANCISCO DE ORELLANA', '22'),
(215, '2202', 'AGUARICO', '22'),
(216, '2203', 'LA JOYA DE LOS SACHAS', '22'),
(217, '2204', 'LORETO', '22'),
(218, '2301', 'SANTO DOMINGO', '23'),
(219, '2401', 'SANTA ELENA', '24'),
(220, '2402', 'LA LIBERTAD', '24'),
(221, '2403', 'SALINAS', '24'),
(222, '9001', 'LAS GOLONDRINAS', '90'),
(223, '9003', 'MANGA DEL CURA', '90'),
(224, '9004', 'EL PIEDRERO', '90');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_catgproducto`
--

CREATE TABLE IF NOT EXISTS `beko_catgproducto` (
  `catpr_id` int(11) NOT NULL,
  `catpr_nombre` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_catgproducto`
--

INSERT INTO `beko_catgproducto` (`catpr_id`, `catpr_nombre`) VALUES
(1, 'SERVICIOS'),
(2, 'ELECTRONICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_cliente`
--

CREATE TABLE IF NOT EXISTS `beko_cliente` (
  `clie_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `clie_rucci` varchar(90) NOT NULL,
  `clie_nombre` varchar(250) NOT NULL,
  `clie_direccion` text NOT NULL,
  `clie_telefono` varchar(250) NOT NULL,
  `clie_email` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_cliente`
--

INSERT INTO `beko_cliente` (`clie_id`, `emp_id`, `clie_rucci`, `clie_nombre`, `clie_direccion`, `clie_telefono`, `clie_email`) VALUES
(1, 1, '9999999999999', 'CONSUMIDOR FINAL', '.', '.', '.'),
(2, 1, '1711467884', 'FRANKLIN AGUAS', 'COTOCOLLAO', '2532445', 'falider@hotmail.com'),
(3, 1, '1212121212', 'Prueba g cliente', 'cass', '2222', 'lid@hotmail.com'),
(4, 1, '1802859163', 'Gerardo Badillo', 'Grosellas n47-81 y mortiÃ±os', '+593982025782', 'gerardo.badilloh@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_concepto`
--

CREATE TABLE IF NOT EXISTS `beko_concepto` (
  `conc_id` int(11) NOT NULL,
  `conc_nombre` varchar(90) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_concepto`
--

INSERT INTO `beko_concepto` (`conc_id`, `conc_nombre`) VALUES
(1, 'ALMUERZO'),
(2, 'TRABAJOS'),
(3, 'INTERNET'),
(4, 'CABINAS'),
(5, 'RECARGAS CLARO'),
(6, 'RECARGAS MOVI'),
(7, 'IMPRESIONES B/N'),
(8, 'FACTURACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_documentocabecera`
--

CREATE TABLE IF NOT EXISTS `beko_documentocabecera` (
  `doccab_id` varchar(250) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `estaf_id` int(11) NOT NULL,
  `ambi_valor` int(11) NOT NULL,
  `emis_valor` int(11) NOT NULL,
  `tipocmp_codigo` varchar(5) NOT NULL,
  `doccab_ndocumento` varchar(90) NOT NULL,
  `doccab_clavedeaccesos` varchar(250) NOT NULL,
  `doccab_rucempresa` varchar(90) NOT NULL,
  `doccab_rucci_cliente` varchar(90) NOT NULL,
  `doccab_nombrerazon_cliente` varchar(250) NOT NULL,
  `doccab_direccion_cliente` text NOT NULL,
  `doccab_telefono_cliente` varchar(90) NOT NULL,
  `doccab_email_cliente` varchar(250) NOT NULL,
  `doccab_fechaemision_cliente` date NOT NULL,
  `doccab_subtotaliva` double NOT NULL,
  `doccab_subtotalsiniva` double NOT NULL,
  `doccab_subtnoobjetoi` double NOT NULL,
  `doccab_subtexentoiva` double NOT NULL,
  `doccab_iva` double NOT NULL,
  `doccab_descuento` double NOT NULL,
  `doccab_propina` double NOT NULL,
  `doccab_ice` double NOT NULL,
  `doccab_total` double NOT NULL,
  `doccab_xml` longtext NOT NULL,
  `doccab_xmlfirmado` longtext NOT NULL,
  `doccab_firmado` int(11) NOT NULL,
  `doccab_estadosri` varchar(90) NOT NULL,
  `doccab_motivodev` varchar(250) NOT NULL,
  `doccab_nautorizacion` varchar(250) NOT NULL,
  `doccab_fechaaut` varchar(250) NOT NULL,
  `doccab_enviomail` int(11) NOT NULL,
  `doccab_enviomailfecha` datetime NOT NULL,
  `doccab_publicado` int(11) NOT NULL,
  `doccab_fechapublicado` datetime NOT NULL,
  `doccab_ndet` int(11) NOT NULL,
  `usua_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_documentocabecera`
--

INSERT INTO `beko_documentocabecera` (`doccab_id`, `emp_id`, `estaf_id`, `ambi_valor`, `emis_valor`, `tipocmp_codigo`, `doccab_ndocumento`, `doccab_clavedeaccesos`, `doccab_rucempresa`, `doccab_rucci_cliente`, `doccab_nombrerazon_cliente`, `doccab_direccion_cliente`, `doccab_telefono_cliente`, `doccab_email_cliente`, `doccab_fechaemision_cliente`, `doccab_subtotaliva`, `doccab_subtotalsiniva`, `doccab_subtnoobjetoi`, `doccab_subtexentoiva`, `doccab_iva`, `doccab_descuento`, `doccab_propina`, `doccab_ice`, `doccab_total`, `doccab_xml`, `doccab_xmlfirmado`, `doccab_firmado`, `doccab_estadosri`, `doccab_motivodev`, `doccab_nautorizacion`, `doccab_fechaaut`, `doccab_enviomail`, `doccab_enviomailfecha`, `doccab_publicado`, `doccab_fechapublicado`, `doccab_ndet`, `usua_id`) VALUES
('011711467884171146788400120160921041502426', 1, 1, 1, 1, '01', '001-001-000000020', '2109201601171146788400110010010000000204150242615', '1711467884001', '1711467884', 'FRANKLIN AGUAS', 'COTOCOLLAO', '2532445', 'falider@hotmail.com', '2016-09-21', 17, 0, 0, 0, 2.38, 0, 0, 0, 19.38, '', '', 0, '', '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 3, 30);

--
-- Disparadores `beko_documentocabecera`
--
DELIMITER $$
CREATE TRIGGER `registro_caja_TRIGGER` AFTER INSERT ON `beko_documentocabecera`
 FOR EACH ROW BEGIN
DECLARE regiscidrecibo varchar (250);

select regisc_idrecibo into regiscidrecibo from beko_registrocaja where regisc_idrecibo=NEW.doccab_id; 

IF regiscidrecibo IS NULL OR regiscidrecibo = '' THEN

    insert into beko_registrocaja (regisc_fechahora,regisc_idrecibo,regisc_concepto,regisc_valor,tipca_id,regisc_moneda,usua_id,conc_id,emp_id) VALUES (NEW.doccab_fechaemision_cliente,NEW.doccab_id,NEW.doccab_ndocumento,NEW.doccab_total,'1','DOLAR',NEW.usua_id,8,NEW.emp_id);
 

ELSE

    
   update beko_registrocaja set regisc_valor=NEW.doccab_total where regisc_idrecibo=NEW.doccab_id;
 END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `registro_cajaactualiza_TRIGGER` AFTER UPDATE ON `beko_documentocabecera`
 FOR EACH ROW BEGIN
DECLARE regiscidrecibo varchar (250);

select regisc_idrecibo into regiscidrecibo from beko_registrocaja where regisc_idrecibo=NEW.doccab_id; 

IF regiscidrecibo IS NULL OR regiscidrecibo = '' THEN

    insert into beko_registrocaja (regisc_fechahora,regisc_idrecibo,regisc_concepto,regisc_valor,tipca_id,regisc_moneda,usua_id) VALUES (NEW.doccab_fechaemision_cliente,NEW.doccab_id,NEW.doccab_ndocumento,NEW.doccab_total,'1','DOLAR',NEW.usua_id);
 

ELSE

    
   update beko_registrocaja set regisc_valor=NEW.doccab_total where regisc_idrecibo=NEW.doccab_id;
 END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_documentodetalle`
--

CREATE TABLE IF NOT EXISTS `beko_documentodetalle` (
  `docdet_id` int(11) NOT NULL,
  `doccab_id` varchar(250) NOT NULL DEFAULT '',
  `docdet_codprincipal` varchar(250) DEFAULT '',
  `docdet_codaux` varchar(250) NOT NULL DEFAULT '67',
  `docdet_cantidad` double NOT NULL,
  `docdet_descripcion` varchar(250) NOT NULL DEFAULT '',
  `docdet_detallea` varchar(250) NOT NULL DEFAULT '',
  `docdet_detalleb` varchar(250) NOT NULL DEFAULT '',
  `docdet_detallec` varchar(250) NOT NULL DEFAULT '',
  `docdet_preciou` double NOT NULL,
  `impu_codigo` int(11) NOT NULL,
  `tari_codigo` int(11) NOT NULL,
  `docdet_porcentaje` double NOT NULL,
  `docdet_valorimpuesto` double NOT NULL,
  `docdet_descuento` double NOT NULL,
  `docdet_porcent_descuento` double NOT NULL,
  `docdet_total` double NOT NULL,
  `usua_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `beko_documentodetalle`
--

INSERT INTO `beko_documentodetalle` (`docdet_id`, `doccab_id`, `docdet_codprincipal`, `docdet_codaux`, `docdet_cantidad`, `docdet_descripcion`, `docdet_detallea`, `docdet_detalleb`, `docdet_detallec`, `docdet_preciou`, `impu_codigo`, `tari_codigo`, `docdet_porcentaje`, `docdet_valorimpuesto`, `docdet_descuento`, `docdet_porcent_descuento`, `docdet_total`, `usua_id`) VALUES
(1, '011711467884171146788400120160921041502426', 'GHYNCMR14BP7EW20160313050633', '67', 1, 'Audifonos', '', '', '', 12, 2, 3, 14, 1.68, 0, 0, 12, 30),
(2, '011711467884171146788400120160921041502426', '7A12MWE2FD74WO20160827043204', '67', 1, 'BATERIA', '', '', '', 3, 2, 3, 14, 0.42, 0, 0, 3, 30),
(3, '011711467884171146788400120160921041502426', 'T3LC6NYUIX1X6Y20160827040318', '67', 2, 'CABLE', '', '', '', 1, 2, 3, 14, 0.28, 0, 0, 2, 30);

--
-- Disparadores `beko_documentodetalle`
--
DELIMITER $$
CREATE TRIGGER `registro_movimiento_antesde` BEFORE UPDATE ON `beko_documentodetalle`
 FOR EACH ROW BEGIN
DECLARE regis_detalle varchar (250);
DECLARE regis_producto int;

DECLARE regis_cantidad_actual double;
DECLARE regis_cantidad_actual_DETALLE int;

select produ_id into regis_producto from beko_producto where produ_codigoserial=NEW.docdet_codprincipal;
select produ_stockactual into regis_cantidad_actual from beko_producto where produ_codigoserial=NEW.docdet_codprincipal;

update beko_producto set produ_stockactual = regis_cantidad_actual + OLD.docdet_cantidad where produ_id=regis_producto;


END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `registro_movimiento_reciboac` AFTER UPDATE ON `beko_documentodetalle`
 FOR EACH ROW BEGIN
DECLARE regis_detalle varchar (250);
DECLARE regis_producto int;

DECLARE regis_cantidad_actual int;

select produ_id into regis_producto from beko_producto where produ_codigoserial=NEW.docdet_codprincipal;
select produ_stockactual into regis_cantidad_actual from beko_producto where produ_codigoserial=NEW.docdet_codprincipal;

select doccab_id into regis_detalle from beko_movimiento where doccab_id=NEW.doccab_id and produ_id=regis_producto; 

IF regis_detalle IS NULL OR regis_detalle = '' THEN

    insert into beko_movimiento 
	(produ_id,tipmv_id,movi_cantidad,movi_precio,movi_fecha,doccab_id) 
	VALUES (regis_producto,3,NEW.docdet_cantidad,NEW.docdet_preciou,now(),NEW.doccab_id);
 

ELSE


   
   update beko_movimiento set movi_cantidad=NEW.docdet_cantidad, movi_precio=NEW.docdet_preciou where  doccab_id=NEW.doccab_id and produ_id=regis_producto; 
   
   update beko_producto set produ_stockactual = regis_cantidad_actual- NEW.docdet_cantidad where produ_id=regis_producto;
   
 END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `registro_movimiento_reciboborra` AFTER DELETE ON `beko_documentodetalle`
 FOR EACH ROW BEGIN
DECLARE regis_detalle varchar (250);
DECLARE regis_producto int;
DECLARE regis_cantidad_actual double;


select produ_id into regis_producto from beko_producto where produ_codigoserial=OLD.docdet_codprincipal;
select produ_stockactual into regis_cantidad_actual from beko_producto where produ_codigoserial=OLD.docdet_codprincipal;

delete from beko_movimiento where  doccab_id=OLD.doccab_id and produ_id=regis_producto; 
   
update beko_producto set produ_stockactual = regis_cantidad_actual + OLD.docdet_cantidad where produ_id=regis_producto;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `registro_movimiento_recibop` AFTER INSERT ON `beko_documentodetalle`
 FOR EACH ROW BEGIN
DECLARE regis_detalle varchar (250);
DECLARE regis_producto int;
DECLARE regis_cantidad_actual double;

select produ_id into regis_producto from beko_producto where produ_codigoserial=NEW.docdet_codprincipal;
select produ_stockactual into regis_cantidad_actual from beko_producto where produ_codigoserial=NEW.docdet_codprincipal;


select doccab_id into regis_detalle from beko_movimiento where doccab_id=NEW.doccab_id and produ_id=regis_producto; 

IF regis_detalle IS NULL OR regis_detalle = '' THEN

    insert into beko_movimiento 
	(produ_id,tipmv_id,movi_cantidad,movi_precio,movi_fecha,doccab_id) 
	VALUES (regis_producto,3,NEW.docdet_cantidad,NEW.docdet_preciou,now(),NEW.doccab_id);
 
     update beko_producto set produ_stockactual = regis_cantidad_actual- NEW.docdet_cantidad where produ_id=regis_producto;
ELSE

   
   
   update beko_movimiento set movi_cantidad=NEW.docdet_cantidad, movi_precio=NEW.docdet_preciou where  doccab_id=NEW.doccab_id and produ_id=regis_producto; 
   
   
   
 END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_empdocumento`
--

CREATE TABLE IF NOT EXISTS `beko_empdocumento` (
  `empdoc_id` int(11) NOT NULL,
  `tipocmp_codigo` varchar(5) NOT NULL,
  `ambi_valor` int(11) NOT NULL,
  `tipoemi_codigo` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_empdocumento`
--

INSERT INTO `beko_empdocumento` (`empdoc_id`, `tipocmp_codigo`, `ambi_valor`, `tipoemi_codigo`, `emp_id`) VALUES
(1, '01', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_empresa`
--

CREATE TABLE IF NOT EXISTS `beko_empresa` (
  `emp_id` int(11) NOT NULL,
  `temp_id` int(11) NOT NULL,
  `prob_codigo` varchar(9) NOT NULL,
  `cant_codigo` varchar(9) NOT NULL,
  `emp_ruc` varchar(90) NOT NULL,
  `emp_nombre` varchar(250) NOT NULL,
  `emp_direccion` text NOT NULL,
  `emp_telefono` varchar(90) NOT NULL,
  `emp_estado` int(11) NOT NULL,
  `emp_logo` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_empresa`
--

INSERT INTO `beko_empresa` (`emp_id`, `temp_id`, `prob_codigo`, `cant_codigo`, `emp_ruc`, `emp_nombre`, `emp_direccion`, `emp_telefono`, `emp_estado`, `emp_logo`) VALUES
(1, 2, '01', '0101', '1711467884001', 'EXCELENTE WEB', 'EMPRESA', '234234234', 1, '51711IYYE20160806.png'),
(2, 3, '17', '1701', '1801201037001', 'PELO PICO PATAS', 'BADILLO CHAVEZ GERARDO MANUEL\nCarapungo Segunda Etapa Av. Luis Vacari B-12 E12', '098914850', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_establecimiento`
--

CREATE TABLE IF NOT EXISTS `beko_establecimiento` (
  `estbl_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `estbl_codigo` varchar(90) NOT NULL,
  `estbl_nombre` varchar(250) NOT NULL,
  `estbl_observacion` text NOT NULL,
  `estbl_activo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_establecimiento`
--

INSERT INTO `beko_establecimiento` (`estbl_id`, `emp_id`, `estbl_codigo`, `estbl_nombre`, `estbl_observacion`, `estbl_activo`) VALUES
(1, 1, '001', '001', '', 1),
(2, 2, '001', 'PELO PICO PATAS', 'PELO PICO PATAS CARAPUNGO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_estado`
--

CREATE TABLE IF NOT EXISTS `beko_estado` (
  `estaf_id` int(11) NOT NULL,
  `estaf_nombre` varchar(70) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_estado`
--

INSERT INTO `beko_estado` (`estaf_id`, `estaf_nombre`) VALUES
(1, 'Emitida'),
(2, 'Pagada'),
(3, 'Anulada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_historicoing`
--

CREATE TABLE IF NOT EXISTS `beko_historicoing` (
  `hiing_id` int(11) NOT NULL,
  `hiing_fecha` datetime NOT NULL,
  `hiing_cedula` varchar(90) NOT NULL,
  `hiing_ip` varchar(90) NOT NULL,
  `hiing_aceptapolitica` int(11) NOT NULL,
  `punto_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_historicoing`
--

INSERT INTO `beko_historicoing` (`hiing_id`, `hiing_fecha`, `hiing_cedula`, `hiing_ip`, `hiing_aceptapolitica`, `punto_id`) VALUES
(15, '2016-04-05 10:55:06', '1711467884', '127.0.0.1', 0, 0),
(16, '2016-04-05 12:27:16', '1711467884', '127.0.0.1', 0, 0),
(17, '2016-04-05 12:31:00', '1711467884', '127.0.0.1', 0, 1),
(18, '2016-04-05 19:20:25', '1711467884', '127.0.0.1', 0, 1),
(19, '2016-04-15 11:26:58', '1711467884', '127.0.0.1', 0, 1),
(20, '2016-04-15 12:28:57', '1711467884', '192.168.8.101', 0, 1),
(21, '2016-04-15 15:31:42', '1711467884', '127.0.0.1', 0, 1),
(22, '2016-04-15 16:39:24', '1711467884', '127.0.0.1', 0, 1),
(23, '2016-04-24 13:33:04', '1711467884', '127.0.0.1', 0, 1),
(24, '2016-04-24 15:36:38', '1711467884', '127.0.0.1', 0, 1),
(25, '2016-04-24 16:22:56', '1711467884', '127.0.0.1', 0, 1),
(26, '2016-04-25 16:29:41', '1711467884', '127.0.0.1', 0, 1),
(27, '2016-05-09 12:57:24', '1711467884', '127.0.0.1', 0, 1),
(28, '2016-05-09 15:03:21', '1711467884', '127.0.0.1', 0, 1),
(29, '2016-05-28 21:09:40', '1711467884', '127.0.0.1', 0, 1),
(30, '2016-05-29 11:00:33', '1711467884', '127.0.0.1', 0, 1),
(31, '2016-06-09 10:17:43', '1711467884', '127.0.0.1', 0, 1),
(32, '2016-06-18 16:47:19', '1711467884', '127.0.0.1', 0, 1),
(33, '2016-07-28 15:20:12', '1711467884', '127.0.0.1', 0, 1),
(34, '2016-07-29 14:30:39', '1711467884', '127.0.0.1', 0, 1),
(35, '2016-07-30 11:46:24', '1711467884', '127.0.0.1', 0, 1),
(36, '2016-07-30 11:57:51', '1711467884', '127.0.0.1', 0, 1),
(37, '2016-07-30 15:13:00', '1711467884', '127.0.0.1', 0, 1),
(38, '2016-07-30 23:31:40', '1711467884', '127.0.0.1', 0, 1),
(39, '2016-07-31 00:40:21', '1711467884', '127.0.0.1', 0, 1),
(40, '2016-07-31 10:00:08', '1711467884', '127.0.0.1', 0, 1),
(41, '2016-07-31 11:14:35', '1711467884', '127.0.0.1', 0, 1),
(42, '2016-08-06 11:09:20', '1711467884', '127.0.0.1', 0, 1),
(43, '2016-08-16 14:31:39', '1711467884', '186.46.113.39', 0, 1),
(44, '2016-08-16 19:49:46', '1711467884', '186.46.203.73', 0, 1),
(45, '2016-08-21 15:45:16', '1711467884', '201.217.82.215', 0, 1),
(46, '2016-08-21 16:03:35', '1711467884', '201.217.82.215', 0, 1),
(47, '2016-08-21 16:38:20', '1711467884', '201.217.82.215', 0, 1),
(48, '2016-08-25 15:51:40', '1711467884', '186.46.113.39', 0, 1),
(49, '2016-08-25 21:25:10', '1711467884', '200.85.83.98', 0, 1),
(50, '2016-08-25 16:50:16', '1711467884', '186.46.113.39', 0, 1),
(51, '2016-08-25 21:54:26', '1711467884', '186.46.113.39', 0, 1),
(52, '2016-08-27 15:41:04', '1711467884', '201.217.82.215', 0, 1),
(53, '2016-08-27 20:58:27', '1711467884', '186.46.206.155', 0, 1),
(54, '2016-08-27 22:55:05', '1711467884', '181.112.107.147', 0, 1),
(55, '2016-08-27 23:14:21', '1711467884', '181.112.107.147', 0, 1),
(56, '2016-09-03 20:42:01', '1711467884', '201.217.82.215', 0, 1),
(57, '2016-09-03 21:03:22', '18028591', '201.217.82.215', 0, 2),
(58, '2016-09-03 21:05:02', '1711467884', '201.217.82.215', 0, 1),
(59, '2016-09-03 21:05:05', '1711467884', '201.217.82.215', 0, 1),
(60, '2016-09-04 23:38:06', '1711467884', '181.199.68.30', 0, 1),
(61, '2016-09-08 03:31:48', '1711467884', '200.85.83.36', 0, 1),
(62, '2016-09-11 03:33:31', '1711467884', '201.217.82.215', 0, 1),
(63, '2016-09-11 04:59:30', '1711467884', '201.217.82.215', 0, 1),
(64, '2016-09-13 15:54:43', '18028591', '186.46.113.39', 0, 2),
(65, '2016-09-15 22:20:08', '1711467884', '186.46.113.39', 0, 1),
(66, '2016-09-15 23:37:29', '1711467884', '186.46.202.117', 0, 1),
(67, '2016-09-16 00:21:43', '1711467884', '186.46.202.117', 0, 1),
(68, '2016-09-18 17:16:57', '1711467884', '201.217.82.215', 0, 1),
(69, '2016-09-20 16:02:37', '1711467884', '127.0.0.1', 0, 1),
(70, '2016-09-21 08:46:52', '1711467884', '127.0.0.1', 0, 1),
(71, '2016-09-21 10:52:00', '1711467884', '127.0.0.1', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_impresion`
--

CREATE TABLE IF NOT EXISTS `beko_impresion` (
  `imp_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `imp_nombre` varchar(250) NOT NULL,
  `tipimp_id` int(11) NOT NULL,
  `imp_script` text NOT NULL,
  `imp_campoparametro` varchar(250) NOT NULL,
  `imp_activo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_impresion`
--

INSERT INTO `beko_impresion` (`imp_id`, `emp_id`, `imp_nombre`, `tipimp_id`, `imp_script`, `imp_campoparametro`, `imp_activo`) VALUES
(1, 1, 'Factura', 1, 'select * from 	beko_documentocabecera where doccab_id=-doccab_id-', 'doccab_id', 1),
(2, 2, 'Factura', 1, 'select * from 	beko_documentocabecera where doccab_id=-doccab_id-', 'doccab_id', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_impresioncampos`
--

CREATE TABLE IF NOT EXISTS `beko_impresioncampos` (
  `impcamp_id` int(11) NOT NULL,
  `imp_id` int(11) NOT NULL,
  `impcamp_campo` varchar(250) NOT NULL,
  `ticaimp_id` int(11) NOT NULL,
  `impcamp_script` text NOT NULL,
  `impcamp_parametrogrid` varchar(250) NOT NULL,
  `impcamp_x` varchar(90) NOT NULL,
  `impcamp_y` varchar(90) NOT NULL,
  `impcamp_activo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_impresioncampos`
--

INSERT INTO `beko_impresioncampos` (`impcamp_id`, `imp_id`, `impcamp_campo`, `ticaimp_id`, `impcamp_script`, `impcamp_parametrogrid`, `impcamp_x`, `impcamp_y`, `impcamp_activo`) VALUES
(1, 1, 'doccab_ndocumento', 1, '', '', '54', '34', 1),
(2, 1, 'doccab_rucci_cliente', 1, '', '', '56', '127', 1),
(3, 1, 'doccab_nombrerazon_cliente', 1, '', '', '54', '80', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_impuesto`
--

CREATE TABLE IF NOT EXISTS `beko_impuesto` (
  `impu_id` int(11) NOT NULL,
  `impu_nombre` varchar(250) NOT NULL DEFAULT '',
  `impu_codigo` int(11) NOT NULL,
  `impu_bloquea` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_impuesto`
--

INSERT INTO `beko_impuesto` (`impu_id`, `impu_nombre`, `impu_codigo`, `impu_bloquea`) VALUES
(1, 'IVA', 2, 1),
(2, 'ICE', 3, 1),
(3, 'IRBPNR', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_movimiento`
--

CREATE TABLE IF NOT EXISTS `beko_movimiento` (
  `movi_id` int(11) NOT NULL,
  `produ_id` int(11) NOT NULL,
  `tipmv_id` int(11) NOT NULL,
  `movi_observacion` text NOT NULL,
  `movi_cantidad` float NOT NULL,
  `movi_disponibles` double NOT NULL,
  `movi_precio` double NOT NULL,
  `movi_fecha` date NOT NULL,
  `doccab_id` varchar(250) NOT NULL,
  `usua_id` int(11) NOT NULL,
  `docdet_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_movimiento`
--

INSERT INTO `beko_movimiento` (`movi_id`, `produ_id`, `tipmv_id`, `movi_observacion`, `movi_cantidad`, `movi_disponibles`, `movi_precio`, `movi_fecha`, `doccab_id`, `usua_id`, `docdet_id`) VALUES
(1, 1, 1, '', 20, 0, 0, '2016-09-21', '0', 30, 0),
(2, 2, 1, '', 40, 0, 123, '2016-09-21', '0', 30, 0),
(3, 4, 1, '', 10, 0, 0, '2016-09-21', '0', 30, 0),
(4, 5, 1, '', 20, 0, 0, '2016-09-21', '0', 30, 0),
(5, 7, 1, '', 100, 0, 0, '2016-09-21', '0', 30, 0),
(6, 8, 1, '', 15, 0, 0, '2016-09-21', '0', 30, 0),
(7, 1, 3, '', 1, 0, 12, '2016-09-21', '2147483647', 0, 0),
(8, 1, 3, '', 1, 0, 12, '2016-09-21', '2147483647', 0, 0),
(9, 1, 3, '', 1, 0, 12, '2016-09-21', '011711467884171146788400120160921041502426', 0, 0),
(10, 3, 3, '', 1, 0, 3, '2016-09-21', '011711467884171146788400120160921041502426', 0, 0),
(11, 4, 3, '', 2, 0, 1, '2016-09-21', '011711467884171146788400120160921041502426', 0, 0),
(12, 3, 2, '', 10, 0, 3, '2016-09-21', '', 30, 0);

--
-- Disparadores `beko_movimiento`
--
DELIMITER $$
CREATE TRIGGER `actualizar_beko_movimiento` AFTER UPDATE ON `beko_movimiento`
 FOR EACH ROW BEGIN
 

 DECLARE total_producto float;
 
SET @total_producto=(select sum((tipmv_signo * movi_cantidad)) as ntotal from beko_movimiento 
inner join beko_tipomov on beko_movimiento.tipmv_id=beko_tipomov.tipmv_id 
inner join beko_producto on beko_movimiento.produ_id=beko_producto.produ_id
where beko_movimiento.produ_id=OLD.produ_id);

update beko_producto set produ_stockactual=@total_producto where produ_id=OLD.produ_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `borrar_beko_movimiento` AFTER DELETE ON `beko_movimiento`
 FOR EACH ROW BEGIN
 

 DECLARE total_producto float;
 
SET @total_producto=(select sum((tipmv_signo * movi_cantidad)) as ntotal from beko_movimiento 
inner join beko_tipomov on beko_movimiento.tipmv_id=beko_tipomov.tipmv_id 
inner join beko_producto on beko_movimiento.produ_id=beko_producto.produ_id
where beko_movimiento.produ_id=OLD.produ_id);

update beko_producto set produ_stockactual=@total_producto where produ_id=OLD.produ_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inser_beko_movimiento` AFTER INSERT ON `beko_movimiento`
 FOR EACH ROW BEGIN
 

 DECLARE total_producto float;
 
SET @total_producto=(select sum((tipmv_signo * movi_cantidad)) as ntotal from beko_movimiento 
inner join beko_tipomov on beko_movimiento.tipmv_id=beko_tipomov.tipmv_id 
inner join beko_producto on beko_movimiento.produ_id=beko_producto.produ_id
where beko_movimiento.produ_id=NEW.produ_id);

update beko_producto set produ_stockactual=@total_producto where produ_id=NEW.produ_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `beko_movimiento_vista`
--
CREATE TABLE IF NOT EXISTS `beko_movimiento_vista` (
`movi_id` int(11)
,`produ_id` int(11)
,`produ_nombre` varchar(250)
,`tipmv_id` int(11)
,`tipmv_nombre` varchar(90)
,`movi_observacion` text
,`movi_cantidad` float
,`movi_fecha` date
,`usua_id` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_producto`
--

CREATE TABLE IF NOT EXISTS `beko_producto` (
  `produ_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `bode_id` int(11) NOT NULL,
  `catpr_id` int(11) NOT NULL,
  `produ_codigoserial` varchar(250) NOT NULL,
  `produ_nombre` varchar(250) NOT NULL,
  `produ_caracteristica` text NOT NULL,
  `produ_foto` varchar(250) NOT NULL,
  `produ_preciogen` float NOT NULL,
  `produ_activo` int(11) NOT NULL,
  `produ_fechareg` date NOT NULL,
  `produ_stokminimo` float NOT NULL,
  `produ_stockactual` float NOT NULL,
  `impu_codigo` int(11) NOT NULL,
  `tari_codigo` int(11) NOT NULL,
  `produ_pedido` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_producto`
--

INSERT INTO `beko_producto` (`produ_id`, `emp_id`, `bode_id`, `catpr_id`, `produ_codigoserial`, `produ_nombre`, `produ_caracteristica`, `produ_foto`, `produ_preciogen`, `produ_activo`, `produ_fechareg`, `produ_stokminimo`, `produ_stockactual`, `impu_codigo`, `tari_codigo`, `produ_pedido`) VALUES
(1, 1, 1, 2, 'GHYNCMR14BP7EW20160313050633', 'Audifonos', 'Samsung', '', 12, 1, '2016-03-13', 10, 18, 2, 3, 0),
(2, 1, 1, 1, 'FYRHV5TUJFRBPR20160825093440', 'Estuches', 'Varios colores', '89742DNTNK20160816.png', 123, 1, '2016-08-16', 10, 40, 2, 3, 0),
(3, 1, 1, 2, '7A12MWE2FD74WO20160827043204', 'BATERIA', 'BATERIA 9 V 8', '', 3, 1, '2016-08-27', 10, 9, 2, 3, 0),
(4, 1, 1, 2, 'T3LC6NYUIX1X6Y20160827040318', 'CABLE', 'CABLE AZUL', '', 1, 1, '2016-08-27', 10, 8, 2, 3, 0),
(5, 1, 1, 1, 'TTBV67FPWGZY5J20160827045031', 'MOUSE', 'IMATION', '', 12, 1, '2016-08-27', 10, 20, 2, 3, 0),
(6, 1, 1, 2, 'HI7ZCKUSVACT7E20160827041935', 'ANTENA', 'ACME', '', 12, 1, '2016-08-27', 10, 76, 2, 7, 0),
(7, 1, 1, 2, 'CQ6DX3M7SBXCBI20160827045642', 'FOCO', 'FOCO 50 W', '', 2, 1, '2016-08-27', 10, 100, 2, 6, 0),
(8, 1, 1, 2, 'JJYQ83Z008Y8WI20160827043944', 'CELULAR', 'IOS', '', 456, 1, '2016-08-27', 10, 15, 2, 3, 0),
(9, 1, 1, 2, '4895137914735', 'pinturas', 'temperas', '98018WSD20160827.jpg', 2.4, 1, '2016-08-27', 2, 5, 2, 0, 0),
(10, 2, 2, 1, '2J4RZ5LIBLMPPC20160827095230', 'Primer Producto', '', '', 3, 1, '2016-08-27', 5, 49, 2, 3, 0),
(11, 1, 1, 2, '90WFG49ZNC20160921102902', 'MP3 PLAYER', 'Sony', '', 95, 1, '2016-09-21', 10, 0, 2, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_provincia`
--

CREATE TABLE IF NOT EXISTS `beko_provincia` (
  `prob_id` int(11) NOT NULL,
  `prob_codigo` varchar(25) NOT NULL,
  `prob_nombre` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `beko_provincia`
--

INSERT INTO `beko_provincia` (`prob_id`, `prob_codigo`, `prob_nombre`) VALUES
(1, '01', 'AZUAY'),
(2, '02', 'BOLÍVAR'),
(3, '03', 'CAÑAR'),
(4, '04', 'CARCHI'),
(5, '05', 'COTOPAXI'),
(6, '06', 'CHIMBORAZO'),
(7, '07', 'EL ORO'),
(8, '08', 'ESMERALDAS'),
(9, '09', 'GUAYAS'),
(10, '10', 'IMBABURA'),
(11, '11', 'LOJA'),
(12, '12', 'LOS RÍOS'),
(13, '13', 'MANABÍ'),
(14, '14', 'MORONA SANTIAGO'),
(15, '15', 'NAPO'),
(16, '16', 'PASTAZA'),
(17, '17', 'PICHINCHA'),
(18, '18', 'TUNGURAHUA'),
(19, '19', 'ZAMORA CHINCHIPE'),
(20, '20', 'GALÁPAGOS'),
(21, '21', 'SUCUMBÍOS'),
(22, '22', 'ORELLANA'),
(23, '23', 'SANTO DOMINGO DE LOS TSÁCHILAS'),
(24, '24', 'SANTA ELENA'),
(25, '77', 'TODOS'),
(26, '99', 'CORTE NACIONAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_puntoemision`
--

CREATE TABLE IF NOT EXISTS `beko_puntoemision` (
  `punto_id` int(11) NOT NULL,
  `estbl_id` int(11) NOT NULL,
  `punto_codigo` varchar(90) NOT NULL,
  `punto_nombre` varchar(250) NOT NULL,
  `punto_inicia` int(11) NOT NULL,
  `punto_activo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_puntoemision`
--

INSERT INTO `beko_puntoemision` (`punto_id`, `estbl_id`, `punto_codigo`, `punto_nombre`, `punto_inicia`, `punto_activo`) VALUES
(1, 1, '001', '001', 20, 1),
(2, 2, '001', '001', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_registrocaja`
--

CREATE TABLE IF NOT EXISTS `beko_registrocaja` (
  `regisc_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `conc_id` int(11) NOT NULL,
  `regisc_fechahora` datetime NOT NULL,
  `regisc_idfactura` varchar(250) NOT NULL,
  `regisc_idrecibo` varchar(250) NOT NULL,
  `regisc_concepto` varchar(250) NOT NULL,
  `regisc_valor` double NOT NULL,
  `tipca_id` int(11) NOT NULL,
  `regisc_moneda` varchar(90) NOT NULL,
  `usua_id` int(11) NOT NULL,
  `usua_idalt` int(11) NOT NULL,
  `regisc_cerrado` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_registrocaja`
--

INSERT INTO `beko_registrocaja` (`regisc_id`, `emp_id`, `conc_id`, `regisc_fechahora`, `regisc_idfactura`, `regisc_idrecibo`, `regisc_concepto`, `regisc_valor`, `tipca_id`, `regisc_moneda`, `usua_id`, `usua_idalt`, `regisc_cerrado`) VALUES
(1, 1, 7, '2016-09-16 00:13:07', '', '', 'COBRO IMP', 10, 1, 'DOLAR', 30, 0, ''),
(3, 1, 8, '2016-09-21 00:00:00', '', '011711467884171146788400120160921112041252', '001-001-000000020', 13.68, 1, 'DOLAR', 30, 0, ''),
(4, 1, 8, '2016-09-21 00:00:00', '', '011711467884171146788400120160921041502426', '001-001-000000020', 19.38, 1, 'DOLAR', 30, 0, '');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `beko_registrocaja_vista`
--
CREATE TABLE IF NOT EXISTS `beko_registrocaja_vista` (
`regisc_id` int(11)
,`emp_id` int(11)
,`regisc_fechahora` datetime
,`regisc_concepto` varchar(250)
,`regisc_moneda` varchar(90)
,`usua_id` int(11)
,`usua_usuario` varchar(90)
,`tipca_id` int(11)
,`tipca_nombre` varchar(90)
,`regisc_valor` double
,`conc_id` int(11)
,`conc_nombre` varchar(90)
,`usua_idalt` int(11)
,`regisc_cerrado` varchar(250)
,`regisc_idfactura` varchar(250)
,`regisc_idrecibo` varchar(250)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_tarifa`
--

CREATE TABLE IF NOT EXISTS `beko_tarifa` (
  `tari_id` int(11) NOT NULL,
  `impu_codigo` int(11) NOT NULL,
  `tari_nombre` varchar(60) NOT NULL,
  `tari_codigo` int(11) NOT NULL,
  `tari_valor` double NOT NULL,
  `tari_bloquear` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_tarifa`
--

INSERT INTO `beko_tarifa` (`tari_id`, `impu_codigo`, `tari_nombre`, `tari_codigo`, `tari_valor`, `tari_bloquear`) VALUES
(1, 2, '12%', 2, 12, 1),
(2, 2, '0%', 0, 0, 1),
(3, 2, 'No obj Impuesto', 6, 0, 1),
(4, 2, 'Exento de IVA', 7, 0, 1),
(5, 2, '14%', 3, 14, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_tipocaja`
--

CREATE TABLE IF NOT EXISTS `beko_tipocaja` (
  `tipca_id` int(11) NOT NULL,
  `tipca_nombre` varchar(90) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_tipocaja`
--

INSERT INTO `beko_tipocaja` (`tipca_id`, `tipca_nombre`) VALUES
(1, 'ENTRADA'),
(2, 'SALIDA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_tipocampoimp`
--

CREATE TABLE IF NOT EXISTS `beko_tipocampoimp` (
  `ticaimp_id` int(11) NOT NULL,
  `ticaimp_nombre` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_tipocampoimp`
--

INSERT INTO `beko_tipocampoimp` (`ticaimp_id`, `ticaimp_nombre`) VALUES
(1, 'CAMPO'),
(2, 'LISTA'),
(3, 'GRAFICO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_tipocomprobante`
--

CREATE TABLE IF NOT EXISTS `beko_tipocomprobante` (
  `tipocmp_id` int(11) NOT NULL,
  `tipocmp_codigo` varchar(5) NOT NULL,
  `tipocmp_nombre` varchar(250) NOT NULL,
  `tipocmp_ret` varchar(3) NOT NULL,
  `tipocmp_notascd` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_tipocomprobante`
--

INSERT INTO `beko_tipocomprobante` (`tipocmp_id`, `tipocmp_codigo`, `tipocmp_nombre`, `tipocmp_ret`, `tipocmp_notascd`) VALUES
(1, '01', 'FACTURA', '1', ''),
(2, '04', 'NOTA DE CREDITO', '', '1'),
(3, '05', 'NOTA DE DEBITO', '', '1'),
(4, '06', 'GUIA DE REMISION', '', ''),
(5, '07', 'COMPROBANTE DE RETENCION', '', ''),
(6, '100', 'RECIBO', '', ''),
(7, '101', 'NOTA DE ENTREGA', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_tipoemision`
--

CREATE TABLE IF NOT EXISTS `beko_tipoemision` (
  `tipoemi_id` int(11) NOT NULL,
  `emis_valor` int(11) NOT NULL,
  `tipoemi_nombre` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_tipoemision`
--

INSERT INTO `beko_tipoemision` (`tipoemi_id`, `emis_valor`, `tipoemi_nombre`) VALUES
(1, 1, 'EmisiÃ³n Normal'),
(2, 2, 'EmisiÃ³n por Indisponibilidad del Sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_tipoemp`
--

CREATE TABLE IF NOT EXISTS `beko_tipoemp` (
  `temp_id` int(11) NOT NULL,
  `temp_nombre` varchar(90) NOT NULL,
  `temp_tiempo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_tipoemp`
--

INSERT INTO `beko_tipoemp` (`temp_id`, `temp_nombre`, `temp_tiempo`) VALUES
(1, 'TECNOLOGIA', 12),
(2, 'VARIOS', 6),
(3, 'Veterinaria', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_tipoimp`
--

CREATE TABLE IF NOT EXISTS `beko_tipoimp` (
  `tipimp_id` int(11) NOT NULL,
  `tipimp_nombre` varchar(90) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_tipoimp`
--

INSERT INTO `beko_tipoimp` (`tipimp_id`, `tipimp_nombre`) VALUES
(1, 'IMPRESORA'),
(2, 'PDF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_tipomov`
--

CREATE TABLE IF NOT EXISTS `beko_tipomov` (
  `tipmv_id` int(11) NOT NULL,
  `tipmv_nombre` varchar(90) NOT NULL,
  `tipmv_signo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_tipomov`
--

INSERT INTO `beko_tipomov` (`tipmv_id`, `tipmv_nombre`, `tipmv_signo`) VALUES
(1, 'INICIAL', 1),
(2, 'COMPRA', 1),
(3, 'VENTA', -1),
(4, 'BAJA', -1),
(5, 'TRASLADO', -1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_tipopersonal`
--

CREATE TABLE IF NOT EXISTS `beko_tipopersonal` (
  `tipo_id` int(11) NOT NULL,
  `tipo_nombre` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_tipopersonal`
--

INSERT INTO `beko_tipopersonal` (`tipo_id`, `tipo_nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'CAJERO'),
(3, 'SISTEMAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_usuario`
--

CREATE TABLE IF NOT EXISTS `beko_usuario` (
  `usua_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `usua_ciruc` varchar(90) NOT NULL,
  `usua_nombre` varchar(250) NOT NULL,
  `usua_apellido` varchar(250) NOT NULL,
  `usua_celular` varchar(90) NOT NULL,
  `usua_direcciondom` text NOT NULL,
  `usua_telefonodom` varchar(90) NOT NULL,
  `usua_periodo` int(11) NOT NULL,
  `usua_usuario` varchar(90) NOT NULL,
  `usua_clave` varchar(250) NOT NULL,
  `usua_email` varchar(250) NOT NULL,
  `usua_fecha_uingreso` date NOT NULL,
  `usua_hora_uingreso` time NOT NULL,
  `usua_fecha_cambioclv` date NOT NULL,
  `usua_estado` int(11) NOT NULL,
  `usua_code` varchar(250) NOT NULL,
  `usua_adm` int(11) NOT NULL,
  `usua_caja` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_usuario`
--

INSERT INTO `beko_usuario` (`usua_id`, `emp_id`, `tipo_id`, `usua_ciruc`, `usua_nombre`, `usua_apellido`, `usua_celular`, `usua_direcciondom`, `usua_telefonodom`, `usua_periodo`, `usua_usuario`, `usua_clave`, `usua_email`, `usua_fecha_uingreso`, `usua_hora_uingreso`, `usua_fecha_cambioclv`, `usua_estado`, `usua_code`, `usua_adm`, `usua_caja`) VALUES
(30, 1, 3, '1711467884', 'Franklin', 'Oswaldo', '094873893', 'Direccion  de prueba', '2322343', 2015, 'franklin.aguas', '25d55ad283aa400af464c76d713c07ad', 'franklin.aguas@funcionjudicial.gob.ec', '2016-09-21', '10:52:00', '0000-00-00', 1, '42020151022023554', 1, 1),
(36, 1, 2, '1711467889', 'Pepe', 'Luis', '', '', '', 0, 'luis', '502ff82f7f1f8218dd41201fe4353687', 'luis@hotmail.com', '2016-02-24', '09:05:25', '0000-00-00', 1, '', 0, 0),
(37, 2, 1, '18028591', 'DIANA CAROLINA', 'BADILLO HERRERA', '0995709887', 'Vasco de Contreras', '', 0, 'diana.badillo', '2f38bf5ebb611e3f73878c1111e4da08', 'diana.badillo@gmail.com', '2016-09-13', '15:54:43', '0000-00-00', 1, '', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_usuariosperfil`
--

CREATE TABLE IF NOT EXISTS `beko_usuariosperfil` (
  `per_id` int(11) NOT NULL,
  `usua_id` int(11) DEFAULT NULL,
  `per_codobj` int(11) NOT NULL,
  `per_activo` varchar(5) DEFAULT NULL,
  `per_fechamod` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_usuariosperfil`
--

INSERT INTO `beko_usuariosperfil` (`per_id`, `usua_id`, `per_codobj`, `per_activo`, `per_fechamod`) VALUES
(18, 30, 13, '1', '2015-10-22 14:35:54'),
(19, 30, 43, '1', '2015-10-22 14:35:54'),
(20, 30, 45, '1', '2015-10-22 14:35:54'),
(21, 30, 47, '1', '2015-10-22 14:35:54'),
(38, 36, 43, '1', '0000-00-00 00:00:00'),
(39, 36, 45, '1', '0000-00-00 00:00:00'),
(40, 36, 47, '0', '0000-00-00 00:00:00'),
(42, 30, 48, '1', '0000-00-00 00:00:00'),
(43, 30, 49, '1', '0000-00-00 00:00:00'),
(44, 30, 50, '1', '0000-00-00 00:00:00'),
(45, 37, 43, '1', '0000-00-00 00:00:00'),
(46, 37, 45, '1', '0000-00-00 00:00:00'),
(47, 37, 48, '1', '0000-00-00 00:00:00'),
(48, 37, 49, '1', '0000-00-00 00:00:00'),
(49, 37, 50, '1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beko_usuario_caja`
--

CREATE TABLE IF NOT EXISTS `beko_usuario_caja` (
  `fuca_id` int(11) NOT NULL,
  `usua_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `estbl_id` int(11) NOT NULL,
  `punto_id` int(11) NOT NULL,
  `fuca_activo` int(11) NOT NULL,
  `fuca_ingreso` date NOT NULL,
  `fuca_estadoingreso` varchar(3) NOT NULL,
  `fuca_ip` varchar(90) NOT NULL,
  `fuca_fechamod` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beko_usuario_caja`
--

INSERT INTO `beko_usuario_caja` (`fuca_id`, `usua_id`, `emp_id`, `estbl_id`, `punto_id`, `fuca_activo`, `fuca_ingreso`, `fuca_estadoingreso`, `fuca_ip`, `fuca_fechamod`) VALUES
(1, 30, 1, 1, 1, 1, '0000-00-00', '', '', '0000-00-00 00:00:00'),
(2, 37, 2, 2, 2, 1, '0000-00-00', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_aplication`
--

CREATE TABLE IF NOT EXISTS `gogess_aplication` (
  `ap_id` bigint(64) NOT NULL,
  `ap_nombre` char(100) DEFAULT 'NULL',
  `ap_detalle` text,
  `ap_creador` char(200) DEFAULT 'NULL',
  `ap_path` char(200) DEFAULT 'NULL',
  `ap_activo` int(32) DEFAULT '0',
  `ap_protec` int(32) DEFAULT '0',
  `ap_logo` char(250) DEFAULT 'NULL'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_aplication`
--

INSERT INTO `gogess_aplication` (`ap_id`, `ap_nombre`, `ap_detalle`, `ap_creador`, `ap_path`, `ap_activo`, `ap_protec`, `ap_logo`) VALUES
(1, 'Registro', 'Registro de Datos', 'unaq.com', 'aplications/registro/', 1, 0, ''),
(3, 'Consultas', 'Consultas y como contactarnos', 'unaq.com', 'aplications/consultas/', 1, 0, ''),
(5, 'Mapa Sitio', 'Mapa del sitio', 'unaq.com', 'aplications/mapa/', 1, 0, ''),
(6, 'Activar', 'Micro sistema para activar cuentas.', 'unaq.com', 'aplicativos/activar/', 1, 0, ''),
(7, 'Recuperar Clave', 'Recuperar Clave', 'Franklin Aguas', 'aplications/recuperar/', 1, 0, ''),
(8, 'Buscardor', 'Buscardor', 'Franklin Aguas', 'aplications/buscador/', 1, 0, ''),
(16, 'Suscripcion', '', 'FA', 'aplications/suscripcion/', 1, 0, ''),
(17, 'Acceso Usuario', 'Permite el acceso a usuarios', 'Franklin', 'aplicativos/documental/', 1, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_aplicationadm`
--

CREATE TABLE IF NOT EXISTS `gogess_aplicationadm` (
  `ap_id` int(32) NOT NULL,
  `ap_nombre` char(100) DEFAULT 'NULL',
  `ap_detalle` text,
  `ap_creador` char(200) DEFAULT 'NULL',
  `ap_path` char(200) DEFAULT 'NULL',
  `ap_activo` int(32) DEFAULT '0',
  `ap_protec` int(32) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_aplicationadm`
--

INSERT INTO `gogess_aplicationadm` (`ap_id`, `ap_nombre`, `ap_detalle`, `ap_creador`, `ap_path`, `ap_activo`, `ap_protec`) VALUES
(1, 'Reportes', 'Subaplicativo de reportes', 'pv', 'aplicativos/reportes/', 1, 1),
(2, 'Clave', 'Aplicativo para cambiar de clave', 'pv', 'aplicativos/clave/', 1, 1),
(6, 'Lista Reportes', 'Lista de reportes almacenados para acceso rapido', 'pv', 'aplicativos/listareportes/', 1, 1),
(10, 'xmlformato', 'Detalle de datos en xml', 'Franklin Aguas', 'aplicativos/xmlformato/', 1, 1),
(13, 'Opciones', '', 'Franklin Aguas', 'aplicativos/mantenimiento/', 1, 1),
(14, 'Generar codigo', 'Genera un arreglo de la estructura de cada formulario', 'Franklin', 'aplicativos/generadorcode/', 1, 1),
(18, 'OPCIONES', '', 'FA', 'aplicativos/opciones_menu/', 1, 1),
(19, 'Carga', '', 'ap', 'aplicativos/carga/', 1, 1),
(20, 'consola', '', 'FA', 'aplicativos/consola/', 1, 1),
(21, 'Inventario', '', '', 'aplicativos/inventario/', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_areausuarios`
--

CREATE TABLE IF NOT EXISTS `gogess_areausuarios` (
  `accw_id` bigint(64) NOT NULL,
  `tab_id` int(32) DEFAULT '0',
  `accw_logo` char(250) DEFAULT NULL,
  `accw_cusuario` char(80) DEFAULT 'NULL',
  `accw_cnombre` char(80) DEFAULT 'NULL',
  `accw_cclave` char(80) DEFAULT 'NULL',
  `accw_cemail` char(80) DEFAULT 'NULL',
  `accw_tituloemail` char(200) DEFAULT 'NULL',
  `accw_replyto` char(250) DEFAULT 'NULL',
  `accw_paginaweb` char(200) DEFAULT 'NULL',
  `accw_codigo` char(20) DEFAULT 'NULL',
  `accw_cidtabla` char(20) DEFAULT 'NULL',
  `accw_rclave` int(32) DEFAULT '0',
  `accw_rregistro` int(32) DEFAULT '0',
  `accw_activo` int(32) DEFAULT '0',
  `accw_campoextra1` char(80) DEFAULT NULL,
  `accw_campoextra2` char(80) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_areausuarios`
--

INSERT INTO `gogess_areausuarios` (`accw_id`, `tab_id`, `accw_logo`, `accw_cusuario`, `accw_cnombre`, `accw_cclave`, `accw_cemail`, `accw_tituloemail`, `accw_replyto`, `accw_paginaweb`, `accw_codigo`, `accw_cidtabla`, `accw_rclave`, `accw_rregistro`, `accw_activo`, `accw_campoextra1`, `accw_campoextra2`) VALUES
(1, 184, '86485VCWHH20131021.png', 'usua_usuario', 'usua_nombre', 'usua_clave', 'usua_email', 'CJ', 'prueba@hotmail.com', 'http://http://www.funcionjudicial.gob.ec/', 'guia_codes', 'usua_id', 0, 0, 1, 'usua_ciruc', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_conocimiento`
--

CREATE TABLE IF NOT EXISTS `gogess_conocimiento` (
  `cono_id` int(32) NOT NULL,
  `cono_codigo` char(70) NOT NULL,
  `cono_nombre` char(250) NOT NULL,
  `field_type` char(250) NOT NULL,
  `field_flags` char(250) NOT NULL,
  `fie_type` char(70) NOT NULL,
  `fie_typeweb` char(70) NOT NULL,
  `fie_obl` int(32) NOT NULL,
  `fie_attrib` text NOT NULL,
  `fie_tabledb` char(70) NOT NULL,
  `fie_datadb` char(250) NOT NULL,
  `fie_sql` char(250) NOT NULL,
  `fie_value` char(250) NOT NULL,
  `fie_sendvar` char(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_conocimiento`
--

INSERT INTO `gogess_conocimiento` (`cono_id`, `cono_codigo`, `cono_nombre`, `field_type`, `field_flags`, `fie_type`, `fie_typeweb`, `fie_obl`, `fie_attrib`, `fie_tabledb`, `fie_datadb`, `fie_sql`, `fie_value`, `fie_sendvar`) VALUES
(1, 'txtovt', '', '', '', 'text', 'text', 1, 'onkeyup="this.value = this.value.replace (/[^@._A-ZÃƒâ€˜a-zÃƒÂ± ]/, chr39chr39);"', '', '', '', '', ''),
(2, 'ml', '', '', '', 'textarea', 'textarea', -1, '', '', '', '', '', ''),
(3, 'txtvn', '', '', '', 'text', 'text', -1, 'onkeyup="this.value = this.value.replace (/[^._0-9- ]/, chr39chr39);"', '', '', '', '', ''),
(4, 'freg', '', '', '', 'hidden2', 'hidden2', -1, '', '', '', '', '', 'fechax'),
(5, 'ur', 'Usuario registra:', '', '', 'hidden2', 'hidden2', -1, '', 'gogess_sisusers', 'sisu_id,sisu_usu', 'where sisu_id=', 'replace', 'sisu_idx'),
(6, 'txto', '', '', '', 'text', 'text', 1, '', '', '', '', '', ''),
(7, 'arch', '', '', '', 'txtarchivo', 'txtarchivo', 0, '', '', '', '', '', ''),
(8, 'chk', '', '', '', 'checkbox', 'checkbox', 0, '', '', '', '', '', ''),
(9, 'txtoem', '', '', '', 'mail', 'mail', 1, '', '', '', '', '', ''),
(10, 'txtem', '', '', '', 'mail', 'mail', 0, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_datosg`
--

CREATE TABLE IF NOT EXISTS `gogess_datosg` (
  `em_id` bigint(64) NOT NULL,
  `em_titulo` char(120) DEFAULT 'NULL',
  `em_timp` text,
  `em_pimp` text,
  `em_patharchivo` char(250) DEFAULT 'NULL',
  `em_ncolumnasicono` int(32) DEFAULT '0',
  `em_logoimp` char(250) DEFAULT 'NULL',
  `em_creditos` int(32) DEFAULT '0',
  `em_creditosv` int(32) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_datosg`
--

INSERT INTO `gogess_datosg` (`em_id`, `em_titulo`, `em_timp`, `em_pimp`, `em_patharchivo`, `em_ncolumnasicono`, `em_logoimp`, `em_creditos`, `em_creditosv`) VALUES
(1, 'BEKO', '', '', '/beko/archivo/', 5, '', 170, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_detperfil`
--

CREATE TABLE IF NOT EXISTS `gogess_detperfil` (
  `detp_id` bigint(64) NOT NULL,
  `per_id` int(32) DEFAULT '0',
  `detp_obj` char(20) DEFAULT 'NULL',
  `detp_codigo` text
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_detperfil`
--

INSERT INTO `gogess_detperfil` (`detp_id`, `per_id`, `detp_obj`, `detp_codigo`) VALUES
(1, 1, 'menu', '-1-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_iconomenuhome`
--

CREATE TABLE IF NOT EXISTS `gogess_iconomenuhome` (
  `iico_id` bigint(64) NOT NULL,
  `men_id` int(32) DEFAULT '0',
  `ite_id` int(32) DEFAULT '0',
  `iico_icono` char(250) DEFAULT 'NULL',
  `iico_acitvo` int(32) DEFAULT '0',
  `iico_orden` int(32) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_iconomenuhome`
--

INSERT INTO `gogess_iconomenuhome` (`iico_id`, `men_id`, `ite_id`, `iico_icono`, `iico_acitvo`, `iico_orden`) VALUES
(1, 5, 1, '41407RMOKU20130512.png', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_instancia`
--

CREATE TABLE IF NOT EXISTS `gogess_instancia` (
  `instan_id` int(32) NOT NULL,
  `instan_nombre` char(200) NOT NULL,
  `instan_detalle` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_instancia`
--

INSERT INTO `gogess_instancia` (`instan_id`, `instan_nombre`, `instan_detalle`) VALUES
(1, 'Framework', 'Agrupa todas las tablas del sistema'),
(2, 'Sistema local', 'Agrupa todas las tablas de Huawei'),
(3, 'Combos', 'Agrupa todas las Tablas de mantenimiento de Huawei');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_itemmenu`
--

CREATE TABLE IF NOT EXISTS `gogess_itemmenu` (
  `ite_id` bigint(64) NOT NULL,
  `men_id` int(32) DEFAULT '0',
  `ite_titulo` char(70) DEFAULT 'NULL',
  `ite_tipd` int(32) DEFAULT '0',
  `ite_linktable` char(250) DEFAULT 'NULL',
  `ite_link` char(250) DEFAULT 'NULL',
  `ite_detalle` text,
  `ite_style` char(70) DEFAULT 'NULL',
  `ite_active` int(32) DEFAULT '0',
  `ite_order` int(32) DEFAULT '0',
  `ite_extra` text,
  `ite_submenu` int(32) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_itemmenu`
--

INSERT INTO `gogess_itemmenu` (`ite_id`, `men_id`, `ite_titulo`, `ite_tipd`, `ite_linktable`, `ite_link`, `ite_detalle`, `ite_style`, `ite_active`, `ite_order`, `ite_extra`, `ite_submenu`) VALUES
(1, 5, 'Usuarios Sistema', 1, 'gogess_sisusers', '0', '0', '', 1, 1, '', -1),
(2, 3, 'Menu', 1, 'gogess_menu', '0', '0', 'cuadro_txtmenu', 1, 2, '', 0),
(3, 3, 'Tablas', 1, 'gogess_sistable', '0', 'Administracion de tabla', 'cuadro_txtmenu', 1, 4, '', 0),
(4, 1, 'Templates', 1, 'gogess_template', '0', 'Templates', '', 0, 6, '', -1),
(5, 5, 'Perfiles sistema', 1, 'gogess_perfil', '0', 'Perfiles', '', 1, 2, '', -1),
(6, 3, 'Template T', 1, 'gogess_styletable', '0', 'Estilo de distrivucion de tablas', 'cuadro_txtmenu', 1, 7, '', 0),
(7, 1, 'Relaciones', 1, '-1', '0', 'Relaciones', '', 0, 5, '', -1),
(8, 1, 'Parametros', 1, 'gogess_datosg', '0', 'Parametros', '', 0, 3, '', -1),
(9, 1, 'Variables', 1, '-1', '0', 'Variables', '', 0, 8, '', -1),
(10, 2, 'Portal Web', 1, 'gogess_sys', '', 'Portal Web', 'cuadro_txtmenu', 1, 1, '', 0),
(14, 2, 'Icono de acceso rapido', 1, 'gogess_iconomenuhome', '', 'Icono de acceso rapido', 'cuadro_txtmenu', 1, 2, '', 0),
(27, 2, 'Sub aplicaciones', 1, 'gogess_aplicationadm', '', 'Sub aplicaciones', 'cuadro_txtmenu', 1, 3, '', 0),
(28, 2, 'Generador de codigo', 0, '', '14', '', 'cuadro_txtmenu', 1, 4, '', 0),
(29, 5, 'Mantenimiento del sistema', 0, '', '13', '', '', 0, 14, '', 0),
(30, 3, 'Iconos home acceso rapido', 1, 'gogess_iconomenuhome', '', '', 'cuadro_txtmenu', 1, 14, '', 0),
(44, 3, 'Conocimiento', 1, 'gogess_conocimiento', '', '', 'cuadro_txtmenu', 1, 32, '', 0),
(51, 3, 'Validaciones', 1, 'gogess_prgvalidar', '', '', 'cuadro_txtmenu', 1, 33, '', 0),
(52, 7, 'Configuraci&oacute;n de carga', 1, 'gogess_cfgcarga', '', '', '', 1, 1, '', 0),
(58, 2, 'Aplicaciones web', 1, 'gogess_aplication', '', '', 'cuadro_txtmenu', 1, 5, '', 0),
(59, 3, 'Configuracion Acceso', 1, 'gogess_areausuarios', '', '', 'cuadro_txtmenu', 1, 34, '', 0),
(64, 3, 'Opciones de carga', 1, 'gogess_opcioncarga', '', '', 'cuadro_txtmenu', 1, 36, '', 0),
(66, 2, 'Reportes', 1, 'sth_report', '', '', 'cuadro_txtmenu', 1, 7, '', 0),
(71, 5, 'Preferencias', 0, '', '18', '', '', 1, 15, '', 0),
(76, 3, 'Templates Admin', 1, 'gogess_template', '', '', '', 1, 37, '', 0),
(79, 3, 'Tipo emisiÃ³n', 1, 'factura_emision', '', '', '', 1, 38, '', 0),
(80, 3, 'Tipo ambiente', 1, 'factura_ambiente', '', '', '', 1, 39, '', 0),
(81, 4, 'Correo', 1, 'gogess_correo', '', '', '', 0, 3, '', 0),
(82, 4, 'Reportes', 1, 'sth_report', '', '', '', 0, 4, '', 0),
(89, 4, 'Empresa', 1, 'beko_empresa', '', '', '', 1, 1, '', 0),
(90, 4, 'Categoria formulario', 1, 'beko_categoriaform', '', '', '', 0, 5, '', 0),
(91, 4, 'Formularios', 1, 'beko_formulario', '', '', '', 0, 6, '', 0),
(92, 4, 'Pais', 1, 'beko_pais', '', '', '', 1, 7, '', 0),
(93, 4, 'Reglas', 1, 'beko_reglas', '', '', '', 0, 8, '', 0),
(94, 3, 'Consola', 0, '', '20', '', '', 1, 40, '', 0),
(96, 4, 'Reportes', 0, '', '1', '', '', 1, 11, '', 0),
(97, 4, 'Inventarios', 0, '', '21', '', '', 1, 12, '', 0),
(98, 4, 'Impuesto', 1, 'beko_impuesto', '', '', '', 1, 13, '', 0),
(99, 4, 'Tipo empresa', 1, 'beko_tipoemp', '', '', '', 1, 14, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_itemmenuaplicativo`
--

CREATE TABLE IF NOT EXISTS `gogess_itemmenuaplicativo` (
  `itmenap_id` bigint(64) NOT NULL,
  `menap_id` bigint(64) DEFAULT NULL,
  `itmenap_nombre` char(100) DEFAULT NULL,
  `opap_id` bigint(64) DEFAULT NULL,
  `smenap_id` bigint(64) DEFAULT NULL,
  `itmenap_observacion` text,
  `itmenap_activo` char(3) DEFAULT NULL,
  `itmenap_orden` int(32) NOT NULL,
  `menap_icono` varchar(250) NOT NULL,
  `itmenap_rapido` int(11) NOT NULL,
  `itmenap_graficoacceso` varchar(250) NOT NULL,
  `itmenap_paraus` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_itemmenuaplicativo`
--

INSERT INTO `gogess_itemmenuaplicativo` (`itmenap_id`, `menap_id`, `itmenap_nombre`, `opap_id`, `smenap_id`, `itmenap_observacion`, `itmenap_activo`, `itmenap_orden`, `menap_icono`, `itmenap_rapido`, `itmenap_graficoacceso`, `itmenap_paraus`) VALUES
(13, 1, 'Opciones', 0, 2, '', '1', 1, '', 0, '', 0),
(43, 2, 'Inicio', 1, 0, '', '1', 1, '', 0, '', 1),
(45, 2, 'Mis datos', 11, 0, '', '1', 2, '', 1, '52472UPHZU20160405.png', 1),
(47, 2, 'Usuarios', 33, 0, '', '1', 3, '', 0, '', 1),
(48, 2, 'Factura-recibo', 36, 0, '', '1', 4, '', 1, '36566XJGKY20160405.png', 1),
(49, 2, 'Productos', 37, 0, '', '1', 7, '', 1, '64740QCSV20160916.png', 1),
(50, 2, 'Cierre caja', 38, 0, '', '1', 6, '', 1, '55967BGMB20160806.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_menu`
--

CREATE TABLE IF NOT EXISTS `gogess_menu` (
  `men_id` bigint(64) NOT NULL,
  `men_titulo` char(70) DEFAULT 'NULL',
  `men_style` char(70) DEFAULT 'NULL',
  `men_uvic` char(20) DEFAULT 'NULL',
  `men_ord` int(32) DEFAULT '0',
  `men_active` int(32) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_menu`
--

INSERT INTO `gogess_menu` (`men_id`, `men_titulo`, `men_style`, `men_uvic`, `men_ord`, `men_active`) VALUES
(1, 'Administrador', 'toc', 't', 2, 1),
(2, 'Portal Web', 'occmenuv', '5', 1, 1),
(3, 'Mantenimiento', 'occmenuv', '5', 1, 1),
(4, 'APP Administrador', 'occmenuv', '3', 1, 1),
(5, 'Sistema', 'occmenuv', '1', 1, 1),
(7, 'GOGESS', 'occmenuv', '3', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_menuaplicativo`
--

CREATE TABLE IF NOT EXISTS `gogess_menuaplicativo` (
  `menap_id` bigint(64) NOT NULL,
  `ap_id` int(32) DEFAULT NULL,
  `menap_nombre` char(100) DEFAULT NULL,
  `menap_style` text,
  `menap_observacion` text,
  `menap_activo` char(3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_menuaplicativo`
--

INSERT INTO `gogess_menuaplicativo` (`menap_id`, `ap_id`, `menap_nombre`, `menap_style`, `menap_observacion`, `menap_activo`) VALUES
(1, 17, 'Menu inicial', 'nav_menustandar', 'Menu inicial', '1'),
(2, 17, 'Opciones', '', '', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_menuopcion`
--

CREATE TABLE IF NOT EXISTS `gogess_menuopcion` (
  `meopap_id` bigint(64) NOT NULL,
  `menap_id` int(32) DEFAULT NULL,
  `opap_id` int(32) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gogess_menuopcion`
--

INSERT INTO `gogess_menuopcion` (`meopap_id`, `menap_id`, `opap_id`) VALUES
(1, 1, 1),
(7, 1, 11),
(8, 1, 34),
(9, 1, 33),
(10, 1, 35),
(11, 1, 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_objetos`
--

CREATE TABLE IF NOT EXISTS `gogess_objetos` (
  `ob_id` bigint(20) NOT NULL,
  `ob_value` varchar(20) DEFAULT 'NULL',
  `ob_etiqueta` varchar(20) DEFAULT 'NULL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_objetos`
--

INSERT INTO `gogess_objetos` (`ob_id`, `ob_value`, `ob_etiqueta`) VALUES
(1, 'menu', 'Menu'),
(2, 'boton', 'Boton'),
(3, 'imenu', 'Item menu'),
(4, 'tabla', 'Tabla'),
(5, 'contenidos', 'Contenido Secc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_objtable`
--

CREATE TABLE IF NOT EXISTS `gogess_objtable` (
  `ot_id` bigint(64) NOT NULL,
  `ot_etiqueta` char(40) DEFAULT 'NULL'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_objtable`
--

INSERT INTO `gogess_objtable` (`ot_id`, `ot_etiqueta`) VALUES
(1, 'Tabla-Lista'),
(2, 'Solo-Tabla'),
(3, 'Solo-Lista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_obl`
--

CREATE TABLE IF NOT EXISTS `gogess_obl` (
  `obl_id` bigint(64) NOT NULL,
  `obl_value` char(70) DEFAULT 'NULL',
  `obl_etiqueta` char(70) DEFAULT 'NULL'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_obl`
--

INSERT INTO `gogess_obl` (`obl_id`, `obl_value`, `obl_etiqueta`) VALUES
(1, '1', 'Obligatorio'),
(2, '0', 'Libre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_opcionaplicativo`
--

CREATE TABLE IF NOT EXISTS `gogess_opcionaplicativo` (
  `opap_id` bigint(64) NOT NULL,
  `ap_id` int(32) DEFAULT NULL,
  `opap_nombre` char(250) DEFAULT NULL,
  `opap_ejecuta` char(250) DEFAULT NULL,
  `opap_activo` char(3) DEFAULT NULL,
  `opap_intro` char(3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_opcionaplicativo`
--

INSERT INTO `gogess_opcionaplicativo` (`opap_id`, `ap_id`, `opap_nombre`, `opap_ejecuta`, `opap_activo`, `opap_intro`) VALUES
(1, 17, 'Inicio', 'inicio_code', '1', '1'),
(3, 17, 'Empresa', 'empresa_code', '1', ''),
(7, 17, 'Reportes', 'reportes_code', '1', '0'),
(8, 17, 'Generar reporte', 'greporte_code', '1', ''),
(11, 17, 'Mis Datos', 'misdatos_code', '1', ''),
(18, 16, 'Registro', 'registro_code', '1', ''),
(33, 17, 'Usuarios', 'usuarios_code', '1', ''),
(36, 17, 'Factura-Recibo', 'facturarecibo_code', '1', ''),
(37, 17, 'Productos', 'productos_code', '1', ''),
(38, 17, 'Cierre de caja', 'cierre_code', '1', ''),
(39, 17, 'Bodega', 'bodega_code', '1', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_parametroimenu`
--

CREATE TABLE IF NOT EXISTS `gogess_parametroimenu` (
  `paraim_id` int(32) NOT NULL,
  `ite_id` int(32) NOT NULL,
  `paraim_nombre` char(90) NOT NULL,
  `paraim_tipo` char(90) NOT NULL,
  `paraim_valor` char(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_parametroimenu`
--

INSERT INTO `gogess_parametroimenu` (`paraim_id`, `ite_id`, `paraim_nombre`, `paraim_tipo`, `paraim_valor`) VALUES
(1, 29, 'menu', 'FIJA', '6,5'),
(2, 71, 'p_menu', 'FIJA', '3,2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_perfil`
--

CREATE TABLE IF NOT EXISTS `gogess_perfil` (
  `per_id` bigint(64) NOT NULL,
  `per_nombre` char(100) DEFAULT 'NULL',
  `per_detalle` text
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_perfil`
--

INSERT INTO `gogess_perfil` (`per_id`, `per_nombre`, `per_detalle`) VALUES
(1, 'ADMINISTRADOR', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_prgvalidar`
--

CREATE TABLE IF NOT EXISTS `gogess_prgvalidar` (
  `prgv_id` int(32) NOT NULL,
  `prgv_nombre` char(250) DEFAULT NULL,
  `prgv_nfuncion` char(250) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_prgvalidar`
--

INSERT INTO `gogess_prgvalidar` (`prgv_id`, `prgv_nombre`, `prgv_nfuncion`) VALUES
(1, 'Obligatorio', 'required'),
(2, 'Archivo remoto de verificaci&oacute;n', 'remote'),
(3, 'Minimos caracteres', 'minlength'),
(4, 'Maximos caracteres', 'maxlength'),
(5, 'Rango de caracteres', 'rangelength'),
(6, 'Minimo valor', 'min'),
(7, 'Maximo valor', 'max'),
(8, 'Rango de valor', 'range'),
(9, 'Email', 'email'),
(10, 'Formato URL', 'url'),
(11, 'Formato fecha', 'date'),
(12, 'Debe ser numerico', 'number'),
(13, 'Solo digitos', 'digits'),
(14, 'Igual a', 'equalTo'),
(15, 'Solo letras', 'lettersonly');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_ptemplate`
--

CREATE TABLE IF NOT EXISTS `gogess_ptemplate` (
  `temp_id` bigint(64) NOT NULL,
  `sys_id` int(32) DEFAULT '0',
  `temp_nombre` char(150) DEFAULT 'NULL',
  `temp_autor` char(150) DEFAULT 'NULL',
  `temp_detalle` char(250) DEFAULT 'NULL',
  `temp_url` char(250) DEFAULT 'NULL',
  `temp_path` char(250) DEFAULT 'NULL',
  `temp_active` int(32) DEFAULT '0',
  `temp_fondo` char(250) DEFAULT 'NULL'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_ptemplate`
--

INSERT INTO `gogess_ptemplate` (`temp_id`, `sys_id`, `temp_nombre`, `temp_autor`, `temp_detalle`, `temp_url`, `temp_path`, `temp_active`, `temp_fondo`) VALUES
(1, 1, 'Beko_template', 'Franklin', '', 'www.gogess.com', 'templates/beko/', 1, '.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_sess`
--

CREATE TABLE IF NOT EXISTS `gogess_sess` (
  `sess_id` char(200) DEFAULT 'NULL',
  `sess_usu` char(60) DEFAULT 'NULL',
  `sess_pwd` char(60) DEFAULT 'NULL',
  `sess_name` char(60) DEFAULT 'NULL',
  `sess_perid` int(32) DEFAULT '0',
  `idg` int(32) DEFAULT '0',
  `sess_ci` char(30) DEFAULT 'NULL',
  `sess_pin` int(32) DEFAULT '0',
  `sess_apl` char(10) DEFAULT 'NULL'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gogess_sess`
--

INSERT INTO `gogess_sess` (`sess_id`, `sess_usu`, `sess_pwd`, `sess_name`, `sess_perid`, `idg`, `sess_ci`, `sess_pin`, `sess_apl`) VALUES
('aqualis1434559337', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1434732560', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1434945505', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1434953606', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1434988400', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1434988418', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1434989403', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1434994875', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1435073080', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1435204433', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1435248807', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1435334074', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1435338949', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1435348358', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1435357705', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1435588066', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1435638562', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1435642978', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1435703471', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1435857911', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1435899552', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1436538966', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1436549426', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1436842403', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1436901165', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1436972871', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1437057517', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1437405673', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1438558017', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1438615153', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1438704922', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1438791545', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1438892134', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1440431578', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1440613033', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1440613252', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1440631028', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1440632061', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1440632178', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1440632492', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1440713187', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1443016564', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1443629192', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1443809435', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1443810135', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1443810665', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1444493057', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1444712606', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1444935605', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1444944721', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1444945430', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1444946370', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1444947712', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445015403', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445033824', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445261018', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445434037', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445465310', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445535167', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445553381', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445605478', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445608985', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445620136', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445633817', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445636941', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445896014', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1445953497', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1446038659', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1446059302', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1446069566', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1446212038', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1446661944', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1446667577', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1452720789', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1452866788', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1453044036', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1453135472', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1453218127', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1453240644', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1453320603', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1453817289', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1453925269', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1454003339', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1454020909', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1454087313', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1454358516', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1454530029', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1454535387', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1454535454', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1454603536', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1454620244', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1454677670', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1454688747', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1454707240', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1455122537', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1455220425', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1455305034', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1455543043', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1456235132', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1456320985', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1456322037', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1456322466', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1456322738', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1456322888', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1456323079', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1456325730', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1456327155', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1456346339', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1456840054', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1456849618', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1457028193', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1457365235', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1457730635', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1457732661', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1457733436', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1457902871', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1457990040', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1457992717', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1458227048', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1459636558', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1459862558', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1459871076', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1459871785', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1459878951', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1459890829', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1459902000', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1460737902', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1460744303', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1460756439', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1461522728', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1461530830', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1461619705', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1461620389', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1462825596', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1464446545', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1464487680', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1464571073', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1465485526', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1466286463', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1467197354', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1469737169', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1469894724', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1469897889', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1469938381', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1469941890', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1469946622', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1469981640', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1470498795', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1470892938', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1471376653', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1471812972', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1472158499', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1472313790', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1472331556', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1472332970', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1472339770', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1472936433', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1472936446', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1473032348', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1473305624', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1473568492', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1473569855', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1473782239', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1473982796', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1473985666', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1474405502', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1474467683', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL'),
('aqualis1474475427', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', 1, 0, 'NULL', 0, 'NULL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_sino`
--

CREATE TABLE IF NOT EXISTS `gogess_sino` (
  `si_id` bigint(64) NOT NULL,
  `value` char(100) DEFAULT 'NULL',
  `etiqueta` char(100) DEFAULT 'NULL',
  `nombre` char(20) DEFAULT 'NULL',
  `activo` char(40) DEFAULT 'NULL'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_sino`
--

INSERT INTO `gogess_sino` (`si_id`, `value`, `etiqueta`, `nombre`, `activo`) VALUES
(1, '1', 'Si', 'Bloqueado', 'Activo'),
(2, '0', 'No', 'Desbloqueado', 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_sisfield`
--

CREATE TABLE IF NOT EXISTS `gogess_sisfield` (
  `fie_id` bigint(64) NOT NULL,
  `field_type` char(200) DEFAULT NULL,
  `field_flags` char(200) DEFAULT NULL,
  `fie_name` char(60) DEFAULT NULL,
  `tab_name` char(60) DEFAULT NULL,
  `fie_title` char(250) DEFAULT NULL,
  `fie_titlereporte` varchar(250) NOT NULL,
  `fie_txtextra` text,
  `fie_txtizq` text,
  `fie_type` char(70) DEFAULT NULL,
  `fie_typeweb` char(70) DEFAULT NULL,
  `fie_evitaambiguo` char(250) DEFAULT NULL,
  `fie_campoafecta` char(200) DEFAULT NULL,
  `fie_camporecibe` char(200) DEFAULT NULL,
  `fie_naleatorio` int(32) DEFAULT '0',
  `fie_style` char(200) DEFAULT NULL,
  `fie_styleobj` char(200) DEFAULT NULL,
  `fie_attrib` text,
  `fie_valiextra` text,
  `fie_value` text,
  `fie_tabledb` char(70) DEFAULT NULL,
  `fie_datadb` char(200) DEFAULT NULL,
  `fie_sqlconexiontabla` char(250) DEFAULT NULL,
  `fie_sqlorder` char(250) DEFAULT NULL,
  `fie_active` int(32) DEFAULT '0',
  `fie_activesearch` int(32) DEFAULT '0',
  `fie_activelista` int(32) DEFAULT '0',
  `fie_activarprt` int(32) DEFAULT '0',
  `fie_obl` int(32) DEFAULT '0',
  `fie_sql` char(250) DEFAULT NULL,
  `fie_group` char(5) DEFAULT NULL,
  `fie_sendvar` char(200) DEFAULT NULL,
  `fie_tactive` int(32) DEFAULT '0',
  `fie_lencampo` int(32) DEFAULT '0',
  `fie_lineas` int(32) DEFAULT '0',
  `fie_tabindex` int(32) DEFAULT '0',
  `fie_verificac` int(32) DEFAULT '0',
  `fie_tablac` text,
  `fie_xmlactivo` int(32) DEFAULT '0',
  `fie_xmlformato` char(250) DEFAULT 'NULL',
  `fie_inactivoftabla` char(2) DEFAULT NULL,
  `fie_activogrid` char(2) DEFAULT NULL,
  `fie_orden` int(32) DEFAULT NULL,
  `fie_limpiarengrid` char(3) DEFAULT NULL,
  `field_maxcaracter` char(20) DEFAULT NULL,
  `fie_archivo` char(250) DEFAULT NULL,
  `fie_mascara` char(250) DEFAULT NULL,
  `fie_iconoarchivo` char(250) DEFAULT NULL,
  `fie_activarbuscador` char(3) DEFAULT NULL,
  `fie_tablabusca` char(250) DEFAULT NULL,
  `fie_camposbusca` char(250) DEFAULT NULL,
  `fie_campodevuelve` char(250) DEFAULT NULL,
  `fie_ordengrid` int(32) DEFAULT NULL,
  `fie_typereport` char(90) DEFAULT NULL,
  `fie_guarda` int(11) NOT NULL,
  `fie_x` double NOT NULL,
  `fie_y` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3197 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_sisfield`
--

INSERT INTO `gogess_sisfield` (`fie_id`, `field_type`, `field_flags`, `fie_name`, `tab_name`, `fie_title`, `fie_titlereporte`, `fie_txtextra`, `fie_txtizq`, `fie_type`, `fie_typeweb`, `fie_evitaambiguo`, `fie_campoafecta`, `fie_camporecibe`, `fie_naleatorio`, `fie_style`, `fie_styleobj`, `fie_attrib`, `fie_valiextra`, `fie_value`, `fie_tabledb`, `fie_datadb`, `fie_sqlconexiontabla`, `fie_sqlorder`, `fie_active`, `fie_activesearch`, `fie_activelista`, `fie_activarprt`, `fie_obl`, `fie_sql`, `fie_group`, `fie_sendvar`, `fie_tactive`, `fie_lencampo`, `fie_lineas`, `fie_tabindex`, `fie_verificac`, `fie_tablac`, `fie_xmlactivo`, `fie_xmlformato`, `fie_inactivoftabla`, `fie_activogrid`, `fie_orden`, `fie_limpiarengrid`, `field_maxcaracter`, `fie_archivo`, `fie_mascara`, `fie_iconoarchivo`, `fie_activarbuscador`, `fie_tablabusca`, `fie_camposbusca`, `fie_campodevuelve`, `fie_ordengrid`, `fie_typereport`, `fie_guarda`, `fie_x`, `fie_y`) VALUES
(1, '', '', 'fie_evitaambiguo', 'gogess_sisfield', 'Evita ambiguo en el enlace de combos anidados campo afecta:', '', 'Colocar el nombre de la tabla', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 1, 0, 1, 0, '', '3', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 11, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2, '', '', 'fie_styleobj', 'gogess_sisfield', 'Estilo Objeto', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', 'cssobj', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '5', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 16, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3, '', '', 'fie_sqlorder', 'gogess_sisfield', 'Sql de Orden', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 0, 0, 1, 0, '', '3', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 23, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(4, 'int', '', 'fie_activarprt', 'gogess_sisfield', 'Activar ImpresiÃ³n', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '4', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 27, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(5, '', '', 'fie_tablac', 'gogess_sisfield', 'Tablas de Enlace', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 0, 0, 1, 0, '', '2', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 37, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(6, 'int', '', 'fie_verificac', 'gogess_sisfield', 'Verificar Enlace', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sino', 'value,etiqueta', '', '', 1, 0, 0, 1, 0, 'where value =', '2', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 36, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(7, '', '', 'fie_txtizq', 'gogess_sisfield', 'Texto Izquierda', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 1, 0, 1, 0, '', '5', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 8, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(8, 'int', '', 'fie_lineas', 'gogess_sisfield', 'NÃºmero Lineas', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '4', 'gogess_sisfield', '', '', '', 1, 0, 0, 1, 0, '', '5', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 34, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(9, 'int', '', 'fie_tabindex', 'gogess_sisfield', 'Orden Tab', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 0, 0, 1, 0, '', '2', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 35, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(10, '', '', 'fie_valiextra', 'gogess_sisfield', 'Funcion Valdacion extra', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'msg_sisfield', '', '', '', 1, 0, 0, 1, 0, '', '6', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 18, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(11, '', '', 'fie_attrib', 'gogess_sisfield', 'Script cortos', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', '0', '', '', '', 1, 0, 0, 1, 0, '', '6', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 17, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(12, '', '', 'fie_txtextra', 'gogess_sisfield', 'Texto derecha', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 0, 0, 1, 0, '', '5', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(13, '', '', 'fie_typeweb', 'gogess_sisfield', 'Tipo ingreso en web:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_typecmp', 'tyc_value,tyc_etiqueta', '', '', 1, 1, 1, 1, 1, '0', '5', '0', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 10, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(14, '', '', 'fie_lencampo', 'gogess_sisfield', 'Longitud campo', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '25', 'gogess_sisfield', '0', '', '', 1, 1, 1, 1, 1, '0', '5', '0', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 33, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(15, 'int', 'auto_increment primary', 'fie_id', 'gogess_sisfield', 'Id', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sistable', '0', '', '', 1, 1, 1, 1, 0, '0', '1', '0', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 1, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(16, '', '', 'fie_name', 'gogess_sisfield', 'Nombre Campo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sistable', 'none', '', '', 1, 1, 1, 1, 1, '0', '1', '0', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 4, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(17, '', '', 'tab_name', 'gogess_sisfield', 'Tabla', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', 'replace', 'gogess_sistable', 'tab_name,tab_title', '', '', 1, 1, 0, 1, 0, 'where tab_name like', '1', 'tab_namex', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 5, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(18, '', '', 'fie_title', 'gogess_sisfield', 'Etiqueta', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '5', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 6, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(19, '', '', 'fie_type', 'gogess_sisfield', 'Tipo de Ingreso', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_typecmp', 'tyc_value,tyc_etiqueta', '', '', 1, 1, 1, 1, 0, '', '5', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 9, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(20, '', '', 'fie_tabledb', 'gogess_sisfield', 'Tablas para el combo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sistable', 'tab_name,tab_title', '', '', 1, 1, 1, 1, 0, '', '3', '', 1, 40, 5, 0, 0, '', 0, '', '0', '-1', 20, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(21, '', '', 'fie_datadb', 'gogess_sisfield', 'Camps value y etiqueta', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '3', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 21, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(22, 'int', '', 'fie_active', 'gogess_sisfield', 'Activado', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value =', '4', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 24, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(23, 'int', '', 'fie_activesearch', 'gogess_sisfield', 'Activar Buscar', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '4', '0', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 25, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(24, 'int', '', 'fie_obl', 'gogess_sisfield', 'Obligatoriedad', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_obl', 'obl_value,obl_etiqueta', '', '', 1, 1, 1, 1, 0, '', '6', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 28, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(25, '', '', 'fie_value', 'gogess_sisfield', 'Valor', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 0, 0, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 19, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(26, '', '', 'fie_style', 'gogess_sisfield', 'Estilo Titulo', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', 'cmbforms', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '5', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 15, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(27, '', '', 'fie_group', 'gogess_sisfield', 'Gropu Pantalla', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 1, '', '4', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 30, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(28, '', '', 'fie_sql', 'gogess_sisfield', 'SQL extra', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 0, 0, 1, 0, '', '3', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 29, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(29, '', '', 'fie_sendvar', 'gogess_sisfield', 'Variable externa', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 0, 0, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 31, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(30, 'int', '', 'fie_tactive', 'gogess_sisfield', 'Titulo activo', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 0, 0, 1, 0, 'where value=', '5', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 32, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(31, '', '', 'fie_inactivoftabla', 'gogess_sisfield', 'Inactivo formato tabla:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '5', 'fie_inactivoftablax', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 40, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(32, 'int', 'primary auto_increment', 'men_id', 'gogess_menu', 'Menu ID', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 1, 'gogess_itemmenu', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(33, 'varchar', '', 'men_titulo', 'gogess_menu', 'Menu nombre', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(34, 'varchar', '', 'men_style', 'gogess_menu', 'Style', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(35, 'varchar', '', 'men_uvic', 'gogess_menu', 'Posicion', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_uvic', 'uvic_value,uvic_etiqueta', '', '', 1, 1, 1, 1, 0, 'where uvic_value like', '1', 'uvic_valuex', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(36, 'int', '', 'men_active', 'gogess_menu', 'Activo', '', '', '', 'select', '', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(37, 'int', '', 'men_ord', 'gogess_menu', 'Orden', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'msg_menu', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(38, 'int', 'auto_increment primary', 'ite_id', 'gogess_itemmenu', 'Item ID', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(39, 'int', '', 'men_id', 'gogess_itemmenu', 'Menu', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_menu', 'men_id,men_titulo', '', '', 1, 1, 1, 1, 0, 'where men_id =', '1', 'men_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(40, '', '', 'ite_titulo', 'gogess_itemmenu', 'Titulo', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(41, '', '', 'ite_link', 'gogess_itemmenu', 'Link', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(42, '', '', 'ite_detalle', 'gogess_itemmenu', 'Detalle', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', 'No', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(43, '', '', 'ite_style', 'gogess_itemmenu', 'Style', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(44, 'int', '', 'ite_active', 'gogess_itemmenu', 'Activo', '', '', '', 'select', '', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(45, 'int', '', 'ite_order', 'gogess_itemmenu', 'Orden', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_itemmenu', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(46, '', '', 'ite_extra', 'gogess_itemmenu', 'CÃƒÂ³digo extra', '', '', '', 'textarea', '0', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_itemmenu', '', '', '', 1, 0, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(47, '', '', 'ite_linktable', 'gogess_itemmenu', 'Link table', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', 'tab_name,tab_name', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(48, 'int', '', 'ite_tipd', 'gogess_itemmenu', 'Tipo Enl', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_tl', 'tl_id,tl_etiqueta', '', '', 1, 1, 1, 1, 0, 'where tl_id=', '1', 'tl_idx', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(49, '', '', 'tab_name', 'gogess_sistable', 'Nombre Tabla', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 1, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(50, '', '', 'tab_title', 'gogess_sistable', 'Titulo Tabla', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '0', '', '', 1, 1, 1, 1, 0, '0', '1', '', 1, 25, 5, 2, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(51, '', '', 'tab_information', 'gogess_sistable', 'Detalle Ayuda:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 0, 0, 1, 0, '', '1', '', 1, 50, 7, 3, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(52, 'int', 'primary_key auto_increment', 'tab_id', 'gogess_sistable', 'Tabla ID', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', 'no', '', '', 1, 1, 1, 1, 0, '0', '1', '0', 1, 25, 5, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(53, 'int', '', 'st_id', 'gogess_sistable', 'Estilo tabla', '', '', '', 'select', '', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_styletable', 'st_id,st_nombre', '', '', 1, 1, 1, 1, 1, 'where st_id =', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(54, '', '', 'tab_bextras', 'gogess_sistable', 'Campos extras', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 0, 0, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(55, '', '', 'tab_rel', 'gogess_sistable', 'Tabla Relacionada', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sistable', 'tab_name,tab_title', '', '', 1, 1, 0, 1, 0, 'where tab_name like', '1', 'tab_namex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(56, '', '', 'tab_crel', 'gogess_sistable', 'Campo Relacionado', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sisfield', 'fie_name,fie_name', '', '', 1, 1, 0, 1, 0, 'where fie_name like', '1', 'fie_namex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 11, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(57, 'int', '', 'tab_trel', 'gogess_sistable', 'Tipo enlace', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_trel', 'trel_value,trel_etiqueta', '', '', 1, 1, 0, 1, 0, 'where trel_value=', '1', 'trel_valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 12, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(58, '', '', 'tab_mdobuscar', 'gogess_sistable', 'Modulo Buscar', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'msg_sistable', '', '', '', 1, 0, 0, 1, 0, '', '1', '', 1, 30, 5, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(59, 'int', '', 'tab_actv', 'gogess_sistable', 'Activo', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_objtable', 'ot_id,ot_etiqueta', '', '', 1, 1, 1, 1, 0, 'where ot_id=', '1', 'ot_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(60, '', '', 'fie_campoafecta', 'gogess_sisfield', 'Campo afecta:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 1, 0, 1, 0, '', '3', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 12, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(61, 'int', '', 'fie_activelista', 'gogess_sisfield', 'Activar despliegue lista:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '4', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 26, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(62, '', '', 'fie_xmlformato', 'gogess_sisfield', 'Formato xml:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 0, 0, 0, 0, '', '2', '', 1, 40, 5, 0, 0, '', 0, '', '0', '-1', 39, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(63, 'int', '', 'fie_xmlactivo', 'gogess_sisfield', 'Xml Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 0, 0, 0, 0, 'where value=', '2', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 38, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(64, '', '', 'fie_sqlconexiontabla', 'gogess_sisfield', 'Sql conexion tabla combo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 1, 0, 1, 0, '', '2', '', 1, 30, 5, 0, 0, '', 0, '', '0', '-1', 22, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(65, 'int', '', 'fie_naleatorio', 'gogess_sisfield', 'Numero dÃ­gitos aleatorios:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 1, 0, 1, 0, '', '2', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 14, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(66, 'int', '', 'ite_submenu', 'gogess_itemmenu', 'Sub Menu', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_menu', 'men_id,men_titulo', '', '', 1, 1, 1, 1, 0, 'where men_id =', '1', 'men_idx', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(67, 'int', 'auto_increment primary', 'sisu_id', 'gogess_sisusers', 'Usuario ID', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(68, '', '', 'sisu_usu', 'gogess_sisusers', 'Usuario:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(69, '', '', 'sisu_pwd', 'gogess_sisusers', 'Password', '', '', '', 'password', 'password', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sistable', '', '', '', 1, 0, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(70, '', '', 'sisu_name', 'gogess_sisusers', 'Nombres y apellidos:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', 'onkeyup="this.value = this.value.replace (/[^@._A-ZÃƒâ€˜a-zÃƒÂ± ]/, chr39chr39);"', '', '', 'gogess_sistable', '0', '', '', 1, 1, 1, 1, 1, '0', '1', '0', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(71, '', '', 'sisu_email', 'gogess_sisusers', 'Email', '', '', '', 'mail', 'mail', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(72, 'int', '', 'sys_id', 'gogess_sisusers', 'Sistema', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '0', 'gogess_sys', 'sys_id,sys_titulo', '', '', 1, 1, 1, 0, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(73, 'int', '', 'per_id', 'gogess_sisusers', 'Perfil', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_perfil', 'per_id,per_nombre', '', '', 1, 1, 1, 1, 1, 'where per_id=', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '1', 'gogess_perfil', 'per_nombre like', 'per_id,per_nombre', 0, '', 1, 0, 0),
(74, 'int', '', 'cod_oficina', 'gogess_sisusers', 'Oficina:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '0', 'ibat_oficina', 'cod_oficina,nombre', '', '', 1, 1, 1, 1, 0, 'where cod_oficina=', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(75, 'int', 'auto_increment primary', 'per_id', 'gogess_perfil', 'Id', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_perfil', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '-1', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(76, '', '', 'per_nombre', 'gogess_perfil', 'Nombre perfil', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', 'onkeyup="this.value = this.value.replace (/[^@._A-ZÃ‘a-zÃ± ]/,chr39chr39);"', '', '', 'gogess_perfil', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(77, '', '', 'per_detalle', 'gogess_perfil', 'Detalle', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_perfil', '', '', '', 1, 0, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(78, 'int', 'primary_key auto_increment', 'detp_id', 'gogess_detperfil', 'Id:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '0', '', '', 1, 1, 1, 1, 0, '0', '1', '0', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(79, '', '', 'per_id', 'gogess_detperfil', 'Perfil', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_perfil', 'per_id,per_nombre', '', '', 1, 1, 1, 1, 1, 'where per_id=', '1', 'per_idex', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(80, '', '', 'detp_obj', 'gogess_detperfil', 'Objeto', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', 'onClick="showUser_seleccionar(window.document.fa.detp_obj.value,0,0,0,0,0,0,0,0,0,0)"', '', 'replace', 'gogess_objetos', 'ob_value,ob_etiqueta', '', '', 1, 1, 1, 1, 1, 'where ob_value like', '1', '0', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(81, '', '', 'detp_codigo', 'gogess_detperfil', 'Codigo perfil', '', '', '', 'textarea', '', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_detperfil', '0', '', '', 1, 0, 1, 1, 1, '0', '1', '0', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(82, 'int', '', 'ap_id', 'gogess_pitemmenu', 'Aplicacion:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_aplication', 'ap_id,ap_nombre', '', '', 1, 1, 1, 1, 0, 'where ap_id=', '1', 'ap_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(83, 'int', '', 'con_id', 'gogess_pitemmenu', 'Art&iacute;culo:', '', '', '', 'select', 'select', '', '', '', 0, 'cbmforms', 'OKcombo', '', '', 'replace', 'gogess_contenido', 'con_id,con_titulo', '', '', 1, 1, 1, 1, 0, 'where con_id=', '1', 'con_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(84, 'int', '', 'sub_orden', 'gogess_subtabla', 'Ord&eacute;n:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampocorto', '', '', '', 'gogess_subtabla', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 3, 5, 0, 0, '', 0, '', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(85, 'int', 'auto_increment primary', 'sub_id', 'gogess_subtabla', 'ID:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_subtabla', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(86, 'int', '', 'tab_id', 'gogess_subtabla', 'Tabla Principal:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sistable', 'tab_id,tab_name', '', '', 1, 1, 1, 1, 0, 'where tab_id=', '1', 'tab_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(87, '', '', 'sub_nameenlace', 'gogess_subtabla', 'Tabla enlace:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_subtabla', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(88, '', '', 'sub_campoenlace', 'gogess_subtabla', 'Campo enlace:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_subtabla', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(89, '', '', 'sub_tipoenlace', 'gogess_subtabla', 'Tipo enlace:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_subtabla', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(90, '', '', 'sub_nombreenlace', 'gogess_subtabla', 'Nombre enlace:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_subtabla', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(91, 'int', '', 'sub_activo', 'gogess_subtabla', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(92, 'int', '', 'itep_menu', 'gogess_pitemmenu', 'Menu a Desplegar:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_pmenu', 'menp_id,menp_titulo', '', '', 1, 1, 1, 1, 0, 'where menp_id =', '1', 'menp_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 16, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(93, '', '', 'itep_parametro', 'gogess_pitemmenu', 'Parametros aplicativo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_pitemmenu', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 30, 5, 0, 0, '', 0, '', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(94, 'int', '', 'tab_id', 'gogess_subtablatr', 'Tabla Principal:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sistable', 'tab_id,tab_name', '', '', 1, 1, 1, 1, 0, 'where tab_id=', '1', 'tab_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(95, 'int', 'auto_increment primary', 'subtr_id', 'gogess_subtablatr', 'ID:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subtablatr', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(96, '', '', 'subtr_nameenlace', 'gogess_subtablatr', 'Tabla enlace:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subtablatr', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(97, '', '', 'subtr_campoenlace', 'gogess_subtablatr', 'Campo enlace:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subtablatr', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(98, '', '', 'subtr_tipoenlace', 'gogess_subtablatr', 'Tipo enlace:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subtablatr', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(99, '', '', 'subtr_nombreenlace', 'gogess_subtablatr', 'Nombre enlace:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subtablatr', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(100, 'int', '', 'subtr_activo', 'gogess_subtablatr', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(101, '', '', 'field_type', 'gogess_sisfield', 'Campo tipo:', '', 'int, string...', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 2, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(102, '', '', 'field_flags', 'gogess_sisfield', 'Campo bandera:', '', 'primary_key auto_increment...', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 3, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(103, 'int', 'auto_increment primary', 'sys_id', 'gogess_sys', 'Sys ID', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_sys', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(104, '', '', 'sys_titulo', 'gogess_sys', 'Nombre', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_sys', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(105, '', '', 'sys_detalle', 'gogess_sys', 'Detalle', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_sys', '', '', '', 1, 0, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(106, '', '', 'sys_pathfavicon', 'gogess_sys', 'Path Favicon:', '', '', '', 'txtarchivo', 'txtarchivo', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sys', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(107, 'int', 'auto_increment primary', 'temp_id', 'gogess_ptemplate', 'ID:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_ptemplate', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(108, '', '', 'sys_id', 'gogess_ptemplate', 'Sistema/Portal', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', '', 'style=" width:300px"', '', 'replace', 'gogess_sys', 'sys_id,sys_titulo', '', '', 1, 1, 1, 1, 1, 'where sys_id =', '1', 'sys_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(109, '', '', 'temp_nombre', 'gogess_ptemplate', 'Nombre', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_ptemplate', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(110, '', '', 'temp_autor', 'gogess_ptemplate', 'Autor', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_ptemplate', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(111, '', '', 'temp_detalle', 'gogess_ptemplate', 'Detalle', '', '', '', 'textarea', '', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_ptemplate', '', '', '', 1, 0, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(112, '', '', 'temp_url', 'gogess_ptemplate', 'URL', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_ptemplate', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(113, '', '', 'temp_active', 'gogess_ptemplate', 'Active', '', '', '', 'select', '', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(114, '', '', 'temp_path', 'gogess_ptemplate', 'Path', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_ptemplate', '', '', '', 1, 0, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(115, '', '', 'temp_fondo', 'gogess_ptemplate', 'Fondo:', '', '', '', 'txtarchivografico', 'txtarchivografico', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_ptemplate', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(116, '', '', 'menp_style', 'gogess_pmenu', 'Style:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_pmenu', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(117, '', '', 'menp_separador', 'gogess_pmenu', 'Separador:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_pmenu', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(118, '', '', 'menp_titulo', 'gogess_pmenu', 'Menu nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_pmenu', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(119, 'int', 'auto_increment primary', 'menp_id', 'gogess_pmenu', 'ID:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_pmenu', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(120, 'int', '', 'menp_active', 'gogess_pmenu', 'Activo', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(121, '', '', 'menp_uvic', 'gogess_pmenu', 'Posicion', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_uvic', 'uvic_value,uvic_etiqueta', '', '', 1, 1, 1, 1, 0, 'uvic_value like', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(122, '', '', 'sys_id', 'gogess_pmenu', 'Sistema/Portal', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sys', 'sys_id,sys_titulo', '', '', 1, 1, 1, 1, 1, 'where sys_id=', '1', 'sys_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(123, '', '', 'tab_valextguardar', 'gogess_sistable', 'ValidaciÃƒÂ³n Extra en script Guardar:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 0, 0, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(124, 'int', '', 'tab_datosf', 'gogess_sistable', 'Ultimo Dato en Pantalla', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'tab_datosfx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 13, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(125, 'int', '', 'instan_id', 'gogess_sistable', 'Instancia:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_instancia', 'instan_id,instan_nombre', '', '', 1, 1, 1, 1, 0, 'where instan_id=', '1', 'instan_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 19, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(126, '', '', 'tab_sqlimp', 'gogess_sistable', 'Sql Impresi&oacute;n:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 40, 7, 0, 0, '', 0, '', '0', '', 23, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(127, '', '', 'tab_archivoimp', 'gogess_sistable', 'Archivo Impresi&oacute;n:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 40, 7, 0, 0, '', 0, '', '0', '', 21, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(128, 'int', '', 'tab_tipoimp', 'gogess_sistable', 'Archivo extreno para imp:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 20, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(129, 'int', '', 'tab_archivo', 'gogess_sistable', 'Funcion para subir archivos:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 0, 1, 0, 'where value=', '1', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 14, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(130, 'int', '', 'tab_formatotabla', 'gogess_sistable', 'Formato Tabla:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'tab_formatotablax', 1, 25, 5, 0, 0, '', 0, '', '0', '', 15, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(131, 'int', '', 'ayu_id', 'gogess_sistable', 'Asignar ayuda:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_ayuda', 'ayu_id,ayu_titulo', '', '', 1, 1, 1, 1, 0, 'where ayu_id=', '1', 'ayu_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 16, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(132, 'int', '', 'tab_nlista', 'gogess_sistable', 'N. Registros por lista:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '30', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 17, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(133, '', '', 'tab_tablaregreso', 'gogess_sistable', 'Tabla regreso:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 18, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(134, '', '', 'fie_camporecibe', 'gogess_sisfield', 'Campo recibe:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', '', 'gogess_sisfield', '', '', '', 1, 1, 0, 1, 0, '', '3', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 13, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(135, 'int', 'auto_increment primary', 'em_id', 'gogess_datosg', 'ID:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_datosg', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(136, '', '', 'em_titulo', 'gogess_datosg', 'Titulo del sistema', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_datosg', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 50, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(137, '', '', 'em_timp', 'gogess_datosg', 'Encabezado Imp', '', '', '', 'editorsimple', 'editorsimple', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_datosg', '', '', '', 1, 0, 1, 0, 0, '', '1', '', 1, 400, 300, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(138, '', '', 'em_pimp', 'gogess_datosg', 'Pie Imp', '', '', '', 'editorsimple', 'editorsimple', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_datosg', '', '', '', 1, 0, 1, 0, 0, '', '1', '', 1, 400, 300, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(139, '', '', 'em_logoimp', 'gogess_datosg', 'Logo ImpresiÃ³n:', '', '', '', 'txtarchivografico', 'txtarchivografico', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_datosg', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(140, '', '', 'em_patharchivo', 'gogess_datosg', 'Path para carga de archivos:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_datosg', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(141, '', '', 'em_ncolumnasicono', 'gogess_datosg', 'N columnas para iconos:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_datosg', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 3, 3, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(142, 'int', 'auto_increment primary', 'tem_id', 'gogess_template', 'ID Template', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_template', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '-1', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(143, '', '', 'tem_nombre', 'gogess_template', 'Nombre', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_template', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(144, '', '', 'tem_autor', 'gogess_template', 'Autor', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_template', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(145, '', '', 'tem_detalle', 'gogess_template', 'Detalle', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_template', '', '', '', 1, 0, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(146, '', '', 'tem_url', 'gogess_template', 'URL', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_template', '', '', '', 1, 0, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(147, '', '', 'tem_path', 'gogess_template', 'Path', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_template', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(148, '', '', 'tem_active', 'gogess_template', 'Active', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value =', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(149, 'int', 'auto_increment primary', 'st_id', 'gogess_styletable', 'Id', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_styletable', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '-1', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(150, '', '', 'st_nombre', 'gogess_styletable', 'Nombre Template', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_styletable', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(151, '', '', 'st_path', 'gogess_styletable', 'Path Administrador', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_styletable', '0', '', '', 1, 1, 1, 1, 1, '0', '1', '0', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(152, '', '', 'st_pathweb', 'gogess_styletable', 'Path Web', '', '', '', 'text', '', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_styletable', '', '', '', 1, 0, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(153, '', '', 'st_timp', 'gogess_styletable', 'Encabezado Imp', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_styletable', '', '', '', 1, 0, 1, 0, 0, '', '1', '', 1, 70, 8, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(154, '', '', 'st_pimp', 'gogess_styletable', 'Pie Imp', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_styletable', '', '', '', 1, 0, 1, 0, 0, '', '1', '', 1, 70, 8, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(155, '', '', 'itep_link', 'gogess_pitemmenu', 'Link:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_pitemmenu', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(156, '', '', 'itep_detalle', 'gogess_pitemmenu', 'Detalle', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampomultiline', '', '', '', 'gogess_pitemmenu', '', '', '', 1, 0, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(157, '', '', 'itep_titulo', 'gogess_pitemmenu', 'Titulo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_pitemmenu', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(158, 'int', '', 'menp_id', 'gogess_pitemmenu', 'Menu', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_pmenu', 'menp_id,menp_titulo', '', '', 1, 1, 1, 1, 0, 'where menp_id=', '1', 'menp_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0);
INSERT INTO `gogess_sisfield` (`fie_id`, `field_type`, `field_flags`, `fie_name`, `tab_name`, `fie_title`, `fie_titlereporte`, `fie_txtextra`, `fie_txtizq`, `fie_type`, `fie_typeweb`, `fie_evitaambiguo`, `fie_campoafecta`, `fie_camporecibe`, `fie_naleatorio`, `fie_style`, `fie_styleobj`, `fie_attrib`, `fie_valiextra`, `fie_value`, `fie_tabledb`, `fie_datadb`, `fie_sqlconexiontabla`, `fie_sqlorder`, `fie_active`, `fie_activesearch`, `fie_activelista`, `fie_activarprt`, `fie_obl`, `fie_sql`, `fie_group`, `fie_sendvar`, `fie_tactive`, `fie_lencampo`, `fie_lineas`, `fie_tabindex`, `fie_verificac`, `fie_tablac`, `fie_xmlactivo`, `fie_xmlformato`, `fie_inactivoftabla`, `fie_activogrid`, `fie_orden`, `fie_limpiarengrid`, `field_maxcaracter`, `fie_archivo`, `fie_mascara`, `fie_iconoarchivo`, `fie_activarbuscador`, `fie_tablabusca`, `fie_camposbusca`, `fie_campodevuelve`, `fie_ordengrid`, `fie_typereport`, `fie_guarda`, `fie_x`, `fie_y`) VALUES
(159, 'int', 'auto_increment primary', 'itep_id', 'gogess_pitemmenu', 'Item ID', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_pitemmenu', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(160, '', '', 'itep_active', 'gogess_pitemmenu', 'Activo', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 12, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(161, '', '', 'itep_icono', 'gogess_pitemmenu', 'Icono', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_sistable', '', '', '', 1, 0, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 13, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(162, 'int', '', 'itep_order', 'gogess_pitemmenu', 'Orden:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampocorto', '', '', '', 'gogess_pitemmenu', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 14, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(163, 'int', '', 'secp_id', 'gogess_pitemmenu', 'Seccion', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_seccp', 'secp_id,etiqueta', '', '', 1, 1, 1, 1, 0, 'where secp_id=', '1', 'secp_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(164, '', '', 'itep_extra', 'gogess_pitemmenu', 'Codigo extra', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampomultiline', '', '', '', 'gogess_pitemmenu', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 15, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(165, '', '', 'itep_style', 'gogess_pitemmenu', 'Style:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_pitemmenu', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 11, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(166, 'int', '', 'itep_ltype', 'gogess_pitemmenu', 'Tipo Link:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_tlink', 'tlk_id,tlk_nombre', '', '', 1, 1, 1, 1, 0, 'where tlk_id=', '1', 'tlk_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(167, 'int', '', 'em_creditos', 'gogess_datosg', 'Creditos practicas:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_datosg', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 7, 5, 0, -1, '', -1, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(168, '', '', 'em_creditosv', 'gogess_datosg', 'Creditos vinculacion:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_datosg', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 7, 5, 0, -1, '', -1, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(169, '', '', 'sub_filtro', 'gogess_subtabla', 'Filtro:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampocorto', '', '', '', 'gogess_subtabla', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 5, 5, 0, 0, '', 0, '', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(170, 'int', 'auto_increment primary', 'iico_id', 'gogess_iconomenuhome', 'ID:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_iconomenuhome', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(171, 'int', '', 'men_id', 'gogess_iconomenuhome', 'Menu:', '', '', '', 'selectafecta', 'selectafecta', '', 'ite_id', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_menu', 'men_id,men_titulo', '', '', 1, 1, 1, 1, 1, 'where men_id=', '1', 'men_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(172, 'int', '', 'ite_id', 'gogess_iconomenuhome', 'Item menu:', '', '', '', 'selectrecibe', 'selectrecibe', '', '', 'men_id', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_itemmenu', 'ite_id,ite_titulo', '', '', 1, 1, 1, 1, 1, 'where ite_id=', '1', 'ite_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(173, '', '', 'iico_icono', 'gogess_iconomenuhome', 'Icono:', '', '', '', 'txtarchivografico', 'txtarchivografico', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_iconomenuhome', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(174, 'int', '', 'iico_acitvo', 'gogess_iconomenuhome', 'Acitvo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(218, 'int', 'auto_increment primary', 'subgri_id', 'gogess_subgrid', 'ID:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subgrid', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(219, 'int', '', 'tab_id', 'gogess_subgrid', 'Tabla Principal:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sistable', 'tab_id,tab_name', '', '', 1, 1, 1, 1, 0, 'where tab_id=', '1', 'tab_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(220, '', '', 'subgri_nameenlace', 'gogess_subgrid', 'Tabla enlace:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subgrid', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(221, '', '', 'subgri_campoenlace', 'gogess_subgrid', 'Campo enlace:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subgrid', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(222, '', '', 'subgri_tipoenlace', 'gogess_subgrid', 'Tipo enlace:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subgrid', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(223, '', '', 'subgri_nombreenlace', 'gogess_subgrid', 'Nombre enlace:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subgrid', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(224, 'int', '', 'subgri_activo', 'gogess_subgrid', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 5, 0, -1, '', -1, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(225, 'int', '', 'subgri_orden', 'gogess_subgrid', 'OrdÃ©n:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subgrid', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 5, 5, 0, -1, '', -1, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(226, '', '', 'subgri_filtro', 'gogess_subgrid', 'Filtro:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subgrid', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 5, 5, 0, -1, '', -1, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(233, '', '', 'subgri_campoidts', 'gogess_subgrid', 'Campo id tabla secundaria:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subgrid', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(234, '', '', 'subgri_tipocampoidts', 'gogess_subgrid', 'Tipo campo id tabla secundaria:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_subgrid', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(235, '', '', 'fie_activogrid', 'gogess_sisfield', 'Activo grid:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '0', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '7', 'valuex', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 41, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(293, 'int', 'primary_key auto_increment', 'ap_id', 'gogess_aplicationadm', 'ID:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_aplicationadm', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(294, '', '', 'ap_nombre', 'gogess_aplicationadm', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_aplicationadm', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(295, '', '', 'ap_detalle', 'gogess_aplicationadm', 'Detalle:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_aplicationadm', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(296, '', '', 'ap_creador', 'gogess_aplicationadm', 'Creador:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_aplicationadm', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(297, '', '', 'ap_path', 'gogess_aplicationadm', 'Path:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_aplicationadm', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(298, 'int', '', 'ap_activo', 'gogess_aplicationadm', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', 'valuex', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(299, 'int', '', 'ap_protec', 'gogess_aplicationadm', 'Proteccion:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', 'valuex', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(301, 'int', 'primary_key auto_increment', 'gri_id', 'gogess_gridfunciones', 'ID:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_gridfunciones', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(302, 'int', '', 'subgri_id', 'gogess_gridfunciones', 'Grid:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_subgrid', 'subgri_id,subgri_nombreenlace', '', '', 1, 1, 1, 1, 1, 'where subgri_id=', '1', 'subgri_idx', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(303, '', '', 'gri_funcion', 'gogess_gridfunciones', 'Funcion:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_gridfunciones', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(304, '', '', 'gri_detalle', 'gogess_gridfunciones', 'Detalle:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_gridfunciones', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(305, '', '', 'gri_activo', 'gogess_gridfunciones', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', 'valuex', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(306, '', '', 'gri_icono', 'gogess_gridfunciones', 'Icono:', '', '', '', 'txtarchivografico', 'txtarchivografico', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_gridfunciones', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(319, 'int', '', 'iico_orden', 'gogess_iconomenuhome', 'Orden:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '0', 'gogess_iconomenuhome', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(333, 'int', 'primary_key auto_increment', 'secp_id', 'gogess_seccp', 'ID:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_seccp', '', '', '', 1, 1, 0, 0, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(334, 'int', '', 'sys_id', 'gogess_seccp', 'Portal:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', '', '', '', 'replace', 'gogess_sys', 'sys_id,sys_titulo', '', '', 1, 1, -1, -1, 1, 'where sys_id=', '1', 'sys_idx', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(335, '', '', 'etiqueta', 'gogess_seccp', 'Etiqueta:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_seccp', '', '', '', 1, 1, -1, -1, 1, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(336, '', '', 'grafico', 'gogess_seccp', 'grafico', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_seccp', '', '', '', 1, 1, -1, -1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(337, '', '', 'detalle', 'gogess_seccp', 'Detalle:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_seccp', '', '', '', 1, 1, -1, -1, 1, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(338, 'int', '', 'activopartede', 'gogess_seccp', 'Activar ser parte de seccion:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', '', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, -1, -1, 1, 'where value=', '1', 'valuex', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(339, 'int', '', 'partede', 'gogess_seccp', 'Es parte de la seccion:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', '', '', '', 'replace', 'gogess_seccp', 'secp_id,etiqueta', '', '', 1, 1, -1, -1, 0, 'where secp_id=', '1', 'partedex', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(340, 'int', '', 'activo_inicio', 'gogess_seccp', 'Activo inicio:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', '', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, -1, -1, 1, 'where value=', '1', 'valuex', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(341, 'int', '', 'activo', 'gogess_seccp', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', '', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, -1, -1, 1, 'where value=', '1', 'valuex', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(342, 'int', '', 'activomapa', 'gogess_seccp', 'Activo mapa:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, -1, -1, 1, 'where value=', '1', 'valuex', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(361, 'int', '', 'fie_orden', 'gogess_sisfield', 'Orden en formulario:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 42, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(449, '', '', 'fie_limpiarengrid', 'gogess_sisfield', 'Limpar campo en grid:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', '', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, -1, -1, 0, 'where value=', '7', 'valuex', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 43, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(486, '', '', 'field_maxcaracter', 'gogess_sisfield', 'Max caracter:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 10, 0, 0, -1, '', -1, '', '0', '-1', 44, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(489, 'int', 'auto_increment primary', 'cono_id', 'gogess_conocimiento', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_conocimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(490, '', '', 'cono_codigo', 'gogess_conocimiento', 'CÃ³digo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_conocimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(491, '', '', 'fie_type', 'gogess_conocimiento', 'Tipo de Ingreso:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_typecmp', 'tyc_value,tyc_etiqueta', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(492, '', '', 'fie_typeweb', 'gogess_conocimiento', 'Tipo ingreso en web:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_typecmp', 'tyc_value,tyc_etiqueta', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(493, '', '', 'fie_obl', 'gogess_conocimiento', 'Obligatoriedad:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_obl', 'obl_value,obl_etiqueta', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(494, '', '', 'fie_attrib', 'gogess_conocimiento', 'Script cortos', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_conocimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(495, '', '', 'fie_tabledb', 'gogess_conocimiento', 'Tablas para el combo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_conocimiento', '', '', '', 1, 1, -1, -1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(496, '', '', 'fie_datadb', 'gogess_conocimiento', 'Camps value y etiqueta:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_conocimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(497, '', '', 'fie_sql', 'gogess_conocimiento', 'SQL extra:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_conocimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(498, '', '', 'fie_value', 'gogess_conocimiento', 'Valor:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_conocimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(499, '', '', 'fie_sendvar', 'gogess_conocimiento', 'Variable externa:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_conocimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(500, '', '', 'field_type', 'gogess_conocimiento', 'Field_type:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_conocimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(501, '', '', 'field_flags', 'gogess_conocimiento', 'Field_flags:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_conocimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(515, '', '', 'cono_nombre', 'gogess_conocimiento', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_conocimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(579, 'int', 'primary_key auto_increment', 'valid_id', 'gogess_validaciones', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_validaciones', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(580, 'int', '', 'fie_id', 'gogess_validaciones', 'Campo:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', '', '', '', 'replace', 'gogess_sisfield', 'fie_id,fie_name', '', '', 1, 1, 1, 1, 1, 'where fie_id=', '1', 'fie_idx', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(581, 'int', '', 'prgv_id', 'gogess_validaciones', 'Tipo validacion:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', '', '', '', 'replace', 'gogess_prgvalidar', 'prgv_id,prgv_nombre', '', '', 1, 1, 1, 1, 1, 'where prgv_id=', '1', 'prgv_idx', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(583, 'int', 'primary_key auto_increment', 'prgv_id', 'gogess_prgvalidar', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_prgvalidar', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(584, '', '', 'prgv_nombre', 'gogess_prgvalidar', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_prgvalidar', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(586, '', '', 'sisu_telefono', 'gogess_sisusers', 'Tel&eacute;fono:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sisusers', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(608, 'int', 'primary_key auto_increment', 'fiecon_id', 'gogess_sisfieldconcatena', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sisfieldconcatena', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 2, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(609, 'int', '', 'fie_id', 'gogess_sisfieldconcatena', 'Campo principal:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sisfield', 'fie_id,fie_name', '', '', 1, 1, 1, 1, 0, 'where fie_id=', '1', 'fie_idx', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 1, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(610, 'int', '', 'fieenlace_id', 'gogess_sisfieldconcatena', 'Campo:', '', '', '', 'selectrecibe', 'selectrecibe', '', '', 'tab_name', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_sisfield', 'fie_id,fie_name', '', '', 1, 1, 1, 1, 0, 'where fie_id=', '1', 'fieenlace_idx', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 4, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(611, '', '', 'tab_name', 'gogess_sisfieldconcatena', 'Tabla:', '', '', '', 'selectafecta', 'selectafecta', '', 'fieenlace_id', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_sistable', 'tab_name,tab_title', '', '', 1, 1, 1, 1, 0, 'where tab_name like', '1', 'tab_namex', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(617, '', '', 'fie_archivo', 'gogess_sisfield', 'Archivo:', '', '', '', 'txtarchivo', 'txtarchivo', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '8', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(637, '', '', 'prgv_nfuncion', 'gogess_prgvalidar', 'Nombre de funcion:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_prgvalidar', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(639, '', '', 'valid_parametro', 'gogess_validaciones', 'Parametro:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_validaciones', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(640, '', '', 'valid_mensaje_error', 'gogess_validaciones', 'Mensaje Error:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_validaciones', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(641, '', '', 'fie_mascara', 'gogess_sisfield', 'Mascara:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '5', '', 1, 25, 0, 0, -1, '', -1, '', '0', '-1', 0, '-1', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(702, '', '', 'fie_iconoarchivo', 'gogess_sisfield', 'Iconoarchivo:', '', '', '', 'txtarchivografico', 'txtarchivografico', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '8', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(716, 'int', 'primary_key auto_increment', 'ap_id', 'gogess_aplication', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_aplication', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(717, '', '', 'ap_nombre', 'gogess_aplication', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_aplication', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(718, '', '', 'ap_detalle', 'gogess_aplication', 'Detalle:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_aplication', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(719, '', '', 'ap_creador', 'gogess_aplication', 'Creador:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_aplication', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(720, '', '', 'ap_path', 'gogess_aplication', 'Path:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_aplication', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(721, 'int', '', 'ap_activo', 'gogess_aplication', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(722, 'int', '', 'ap_protec', 'gogess_aplication', 'Protecci&oacute;n:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(723, '', '', 'ap_logo', 'gogess_aplication', 'Logo:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_aplication', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(724, 'int', 'primary_key auto_increment', 'csecc_id', 'gogess_cseccp', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_cseccp', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(725, 'int', '', 'secp_id', 'gogess_cseccp', 'Secci&oacute;n:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_seccp', 'secp_id,etiqueta', '', '', 1, 1, 1, 1, 0, 'where secp_id=', '1', 'secp_idx', 1, 25, 0, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(726, '', '', 'csecc_type', 'gogess_cseccp', 'Tipo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_tconte', 'tcon_value,tcon_etiqueta', '', '', 1, 1, 1, 1, 0, 'where tcon_value=', '1', 'tcon_valuex', 1, 25, 0, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(727, 'int', '', 'csecc_codem', 'gogess_cseccp', 'Menu:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_pmenu', 'menp_id,menp_titulo', '', '', 1, 1, 1, 1, 0, 'where menp_id=', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(728, 'int', '', 'csecc_codea', 'gogess_cseccp', 'Art&iacute;culo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_contenido', 'con_id,con_titulo', '', '', 1, 1, 1, 1, 0, 'where con_id=', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(729, '', '', 'csecc_uvic', 'gogess_cseccp', 'Uvic:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_uvic', 'uvic_value,uvic_etiqueta', '', '', 1, 1, 1, 1, 0, 'where uvic_value=', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(730, '', '', 'csecc_order', 'gogess_cseccp', 'Order:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampocorto', '', '', '', 'gogess_cseccp', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(731, 'int', 'primary_key auto_increment', 'con_id', 'gogess_contenido', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_contenido', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(732, 'int', '', 'secp_id', 'gogess_contenido', 'Secci&oacute;n:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_seccp', 'secp_id,etiqueta', '', '', 1, 1, 1, 1, 0, 'where secp_id=', '1', 'secp_idx', 1, 25, 0, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(733, '', '', 'con_titulo', 'gogess_contenido', 'Titulo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_contenido', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(734, '', '', 'con_detalle', 'gogess_contenido', 'Detalle:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampomultiline', '', '', '', 'gogess_contenido', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(735, '', '', 'con_fechai', 'gogess_contenido', 'Fechai:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_contenido', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(736, '', '', 'con_fechaf', 'gogess_contenido', 'Fechaf:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_contenido', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(737, '', '', 'con_contenido', 'gogess_contenido', 'Contenido:', '', '', '', 'editor', 'editor', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_contenido', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 500, 450, 0, 0, '', 0, '', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(738, '', '', 'con_contenidomovil', 'gogess_contenido', 'Contenidomovil:', '', '', '', 'editor', 'editor', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_contenido', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 500, 450, 0, 0, '', 0, '', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(739, 'int', '', 'con_menu', 'gogess_contenido', 'Menu:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_pmenu', 'menp_id,menp_titulo', '', '', 1, 1, 1, 1, 0, 'where menp_id=', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(740, '', '', 'foto_peq', 'gogess_contenido', 'Peq:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_contenido', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(741, '', '', 'foto_gran', 'gogess_contenido', 'Gran:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_contenido', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 11, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(742, 'int', '', 'con_activo', 'gogess_contenido', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 12, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(744, '', '', 'fie_activarbuscador', 'gogess_sisfield', 'Activar buscador:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '51', 'valuex', 1, 25, 0, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(745, '', '', 'fie_tablabusca', 'gogess_sisfield', 'Tabla busca:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '51', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(746, '', '', 'fie_camposbusca', 'gogess_sisfield', 'Campos busca:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '51', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(747, '', '', 'fie_campodevuelve', 'gogess_sisfield', 'Campo devuelve:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '51', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(748, 'int', 'primary_key auto_increment', 'accw_id', 'gogess_areausuarios', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_areausuarios', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(750, 'int', '', 'tab_id', 'gogess_areausuarios', 'Tabla:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sistable', 'tab_id,tab_name', '', '', 1, 1, 1, 1, 1, 'where tab_id=', '1', 'tab_idx', 1, 25, 0, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(751, '', '', 'accw_logo', 'gogess_areausuarios', 'Logo:', '', '', '', 'txtarchivografico', 'txtarchivografico', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_areausuarios', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(752, '', '', 'accw_cusuario', 'gogess_areausuarios', 'Campo usuario:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_areausuarios', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(753, '', '', 'accw_cnombre', 'gogess_areausuarios', 'Campo nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_areausuarios', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(754, '', '', 'accw_cclave', 'gogess_areausuarios', 'Campo clave:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_areausuarios', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(755, '', '', 'accw_cemail', 'gogess_areausuarios', 'Campo email:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_areausuarios', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(756, '', '', 'accw_tituloemail', 'gogess_areausuarios', 'Titulo email:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_areausuarios', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(757, '', '', 'accw_replyto', 'gogess_areausuarios', 'Reply to:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_areausuarios', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(758, '', '', 'accw_paginaweb', 'gogess_areausuarios', 'Pagina web:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_areausuarios', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(759, '', '', 'accw_codigo', 'gogess_areausuarios', 'Codigo activacion:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_areausuarios', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 11, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(760, '', '', 'accw_cidtabla', 'gogess_areausuarios', 'Campo enlace:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_areausuarios', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 12, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(761, 'int', '', 'accw_rclave', 'gogess_areausuarios', 'Activar recuperar clave:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, '', '0', '', 13, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(762, 'int', '', 'accw_rregistro', 'gogess_areausuarios', 'Activar registro:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, '', '0', '', 14, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(763, 'int', '', 'accw_activo', 'gogess_areausuarios', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, '', '0', '', 15, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(767, '', '', 'accw_campoextra1', 'gogess_areausuarios', 'Campo validar extra1:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_areausuarios', '', '', '', 1, 1, 1, 1, 0, '', '2', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(768, '', '', 'accw_campoextra2', 'gogess_areausuarios', 'Campo validar extra2:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_areausuarios', '', '', '', 1, 1, 1, 1, 0, '', '2', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(769, 'int', 'primary_key auto_increment', 'menap_id', 'gogess_menuaplicativo', 'ID:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_menuaplicativo', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(770, 'int', '', 'ap_id', 'gogess_menuaplicativo', 'Aplicacion:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_aplication', 'ap_id,ap_nombre', '', '', 1, 1, 1, 1, 0, 'where ap_id=', '1', 'ap_idx', 1, 25, 0, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(772, '', '', 'menap_nombre', 'gogess_menuaplicativo', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_menuaplicativo', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(773, '', '', 'menap_style', 'gogess_menuaplicativo', 'Css:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_menuaplicativo', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(774, '', '', 'menap_observacion', 'gogess_menuaplicativo', 'Observacion:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampomultiline', '', '', '', 'gogess_menuaplicativo', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(775, '', '', 'menap_activo', 'gogess_menuaplicativo', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, '', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(776, 'int', 'primary_key auto_increment', 'opap_id', 'gogess_opcionaplicativo', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_opcionaplicativo', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(777, 'int', '', 'ap_id', 'gogess_opcionaplicativo', 'Aplicacion:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_aplication', 'ap_id,ap_nombre', '', '', 1, 1, 1, 1, 0, 'where ap_id=', '1', 'ap_idx', 1, 25, 0, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(778, '', '', 'opap_nombre', 'gogess_opcionaplicativo', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_opcionaplicativo', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(779, '', '', 'opap_ejecuta', 'gogess_opcionaplicativo', 'Ejecuta:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_opcionaplicativo', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(780, '', '', 'opap_activo', 'gogess_opcionaplicativo', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(781, '', '', 'opap_intro', 'gogess_opcionaplicativo', 'Intro:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(782, 'int', 'primary_key auto_increment', 'meopap_id', 'gogess_menuopcion', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_menuopcion', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(784, 'int', '', 'menap_id', 'gogess_menuopcion', 'Menu:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_menuaplicativo', 'menap_id,menap_nombre', '', '', 1, 1, 1, 1, 1, 'where menap_id=', '1', 'menap_idx', 1, 25, 0, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(785, 'int', '', 'opap_id', 'gogess_menuopcion', 'Opciones:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_opcionaplicativo', 'opap_id,opap_nombre', '', '', 1, 1, 1, 1, 0, 'where opap_id=', '1', 'opap_idx', 1, 25, 0, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(786, 'int', 'primary_key auto_increment', 'itmenap_id', 'gogess_itemmenuaplicativo', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_itemmenuaplicativo', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(787, 'int', '', 'menap_id', 'gogess_itemmenuaplicativo', 'Menu aplicativo:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_menuaplicativo', 'menap_id,menap_nombre', '', '', 1, 1, 1, 1, 0, 'where menap_id=', '1', 'menap_idx', 1, 25, 0, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(788, '', '', 'itmenap_nombre', 'gogess_itemmenuaplicativo', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_itemmenuaplicativo', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(789, 'int', '', 'opap_id', 'gogess_itemmenuaplicativo', 'Opciones:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_opcionaplicativo', 'opap_id,opap_nombre', '', '', 1, 1, 1, 1, 0, 'where opap_id=', '1', 'opap_idx', 1, 25, 0, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(790, '', '', 'itmenap_observacion', 'gogess_itemmenuaplicativo', 'Observacion:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampomultiline', '', '', '', 'gogess_itemmenuaplicativo', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(791, '', '', 'itmenap_activo', 'gogess_itemmenuaplicativo', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(792, 'int', '', 'smenap_id', 'gogess_itemmenuaplicativo', 'Sub Menu:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcombo', '', '', 'replace', 'gogess_menuaplicativo', 'menap_id,menap_nombre', '', '', 1, 1, 1, 1, 0, 'where menap_id=', '1', 'smenap_idx', 1, 25, 0, 0, 0, '', 0, '', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0);
INSERT INTO `gogess_sisfield` (`fie_id`, `field_type`, `field_flags`, `fie_name`, `tab_name`, `fie_title`, `fie_titlereporte`, `fie_txtextra`, `fie_txtizq`, `fie_type`, `fie_typeweb`, `fie_evitaambiguo`, `fie_campoafecta`, `fie_camporecibe`, `fie_naleatorio`, `fie_style`, `fie_styleobj`, `fie_attrib`, `fie_valiextra`, `fie_value`, `fie_tabledb`, `fie_datadb`, `fie_sqlconexiontabla`, `fie_sqlorder`, `fie_active`, `fie_activesearch`, `fie_activelista`, `fie_activarprt`, `fie_obl`, `fie_sql`, `fie_group`, `fie_sendvar`, `fie_tactive`, `fie_lencampo`, `fie_lineas`, `fie_tabindex`, `fie_verificac`, `fie_tablac`, `fie_xmlactivo`, `fie_xmlformato`, `fie_inactivoftabla`, `fie_activogrid`, `fie_orden`, `fie_limpiarengrid`, `field_maxcaracter`, `fie_archivo`, `fie_mascara`, `fie_iconoarchivo`, `fie_activarbuscador`, `fie_tablabusca`, `fie_camposbusca`, `fie_campodevuelve`, `fie_ordengrid`, `fie_typereport`, `fie_guarda`, `fie_x`, `fie_y`) VALUES
(808, 'int', 'primary_key auto_increment', 'accesor_id', 'gogess_accesorapido', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_accesorapido', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(809, 'int', '', 'ap_id', 'gogess_accesorapido', 'Aplicacion:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_aplication', 'ap_id,ap_nombre', '', '', 1, 1, 1, 1, 0, 'where ap_id=', '1', 'ap_idx', 1, 25, 0, 0, 0, '', 0, '', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(810, '', '', 'accesor_nombre', 'gogess_accesorapido', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_accesorapido', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(811, '', '', 'accesor_icono', 'gogess_accesorapido', 'Icono:', '', '', '', 'txtarchivografico', 'txtarchivografico', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_accesorapido', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(812, 'int', '', 'menap_id', 'gogess_accesorapido', 'Menu:', '', '', '', 'selectafecta', 'selectafecta', '', 'itmenap_id', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_menuaplicativo', 'menap_id,menap_nombre', '', '', 1, 1, 1, 1, 0, 'where menap_id=', '1', 'menap_idx', 1, 25, 0, 0, 0, '', 0, '', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(813, 'int', '', 'itmenap_id', 'gogess_accesorapido', 'Item Menu:', '', '', '', 'selectrecibe', 'selectrecibe', '', '', 'menap_id', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_itemmenuaplicativo', 'itmenap_id,itmenap_nombre', '', '', 1, 1, 1, 1, 0, 'where itmenap_id=', '1', 'itmenap_idx', 1, 25, 0, 0, 0, '', 0, '', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(814, '', '', 'accesor_activo', 'gogess_accesorapido', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, '', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(857, '', '', 'tab_campoprimario', 'gogess_sistable', 'Campo primario:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(858, '', '', 'tab_tipocampoprimariio', 'gogess_sistable', 'Tipo campo primario:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, '', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(959, '', '', 'itmenap_orden', 'gogess_itemmenuaplicativo', 'Orden:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_itemmenuaplicativo', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 5, 0, 0, 0, '', 0, 'NULL', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1145, '', '', 'tab_camposgrid', 'gogess_sistable', 'Campos grid:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, 'NULL', '0', '', 24, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1146, '', '', 'tab_scriptorden', 'gogess_sistable', 'Script orden:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 4, 0, 0, '', 0, 'NULL', '0', '', 25, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1351, '', '', 'plant_id', 'gogess_reportes', 'Plantilla:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', '', '', '', '', 1, 1, 1, 1, 0, 'where plant_id=', '1', 'plant_idx', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1352, '', '', 'repi_detalle', 'gogess_reportes', 'Detalle:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1353, '', '', 'repi_nombre', 'gogess_reportes', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1354, '', '', 'repi_fecha', 'gogess_reportes', 'Fecha reporte:', '', '', '', 'fecha', 'fecha', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1355, 'int', 'auto_increment primary', 'repi_id', 'gogess_reportes', 'ID:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1356, '', '', 'tbas_id', 'gogess_reportes', 'Tipo Base:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_tipobase', 'tbas_id,tbas_nombre', '', '', 1, 1, 1, 1, 1, 'where tbas_id=', '1', 'tbas_idx', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1357, '', '', 'repi_coneccion', 'gogess_reportes', 'Conexion Base de datos alterna:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1358, '', '', 'repi_usuario', 'gogess_reportes', 'Usuario base alterna:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1359, '', '', 'repi_clave', 'gogess_reportes', 'Clave alterna:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1360, '', '', 'repi_basedb', 'gogess_reportes', 'Base de Datos alterna:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1361, '', '', 'repi_personalizado', 'gogess_reportes', 'Personalizado:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1362, '', '', 'repi_archpersonalizado', 'gogess_reportes', 'Archivo reporte personalizado:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1363, '', '', 'repi_listo', 'gogess_reportes', 'Listo', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '1', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1364, '', '', 'repi_sqldinamico', 'gogess_reportes', 'Sql Dinamico', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '7', '', 0, 70, 7, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1365, '', '', 'repi_dinamicotitulo', 'gogess_reportes', 'Titulo reporte dinamico:', '', '', '', 'hidden', 'hidden', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '7', '', 0, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1366, '', '', 'tab_namec', 'gogess_reportes', 'Tabla:', '', '', '', 'selectafecta', 'selectafecta', '', 'fie_namec', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sistable', 'tab_name,tab_name', '', 'where instan_id=2', 1, 1, 0, 1, 0, 'where  tab_name like', '2', 'tab_namex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1367, '', '', 'fie_namec', 'gogess_reportes', 'Campo:', '', '', '', 'selectrecibe', 'selectrecibe', '', '', 'tab_name', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sisfield', 'fie_name,fie_title', '', '', 1, 1, 0, 1, 0, 'where  fie_name like', '2', 'fie_namex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1368, '', '', 'repi_campos', 'gogess_reportes', 'Campos:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '2', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1369, '', '', 'tab_namet', 'gogess_reportes', 'Tabla:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sistable', 'tab_name,tab_name', '', 'where instan_id=2', 1, 1, 0, 1, 0, 'where  tab_name like', '3', 'tab_namex', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1370, '', '', 'repi_tabla', 'gogess_reportes', 'Tablas:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '3', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1371, '', '', 'tab_namee1', 'gogess_reportes', 'Tabla1:', '', '', '', 'selectafecta', 'selectafecta', '', 'fie_namee1', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_sistable', 'tab_name,tab_name', '', 'where instan_id=2', 1, 1, 0, 1, 0, 'where  tab_name like', '5', 'tab_namex', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1372, '', '', 'repi_enlace', 'gogess_reportes', 'Enlace:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '5', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1373, '', '', 'tab_namee2', 'gogess_reportes', 'Tabla2:', '', '', '', 'selectafecta', 'selectafecta', '', 'fie_namee2', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sistable', 'tab_name,tab_name', '', 'where instan_id=2', 1, 1, 0, 1, 0, 'where  tab_name like', '5', 'tab_namex', 1, 25, 5, 0, 0, '', 0, '', '0', '-1', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1374, '', '', 'repi_nregistros', 'gogess_reportes', 'N registros por pantalla:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '20', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 1, '', '1', '', 1, 7, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1375, '', '', 'repi_agruparpor', 'gogess_reportes', 'Agrupar por y contar:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '1', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1376, '', '', 'repi_vercuadro', 'gogess_reportes', 'Ver cuadro:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 0, 1, 0, 'where  value =', '1', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1377, '', '', 'fie_namee2', 'gogess_reportes', 'Campo enlace 2:', '', '', '', 'selectrecibe', 'selectrecibe', '', '', 'tab_name', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sisfield', 'fie_name,fie_name', '', '', 1, 1, 0, 1, 0, 'where fie_name=', '5', 'fie_namex', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1378, '', '', 'fie_namee1', 'gogess_reportes', 'Campo enlace 1:', '', '', '', 'selectrecibe', 'selectrecibe', '', '', 'tab_name', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sisfield', 'fie_name,fie_name', '', '', 1, 1, 0, 1, 0, 'where fie_name=', '5', 'fie_namex', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1379, '', '', 'tgr_id', 'gogess_reportes', 'Tipo Grafico:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_tgrafico', 'tgr_id,tgr_nombre', '', '', 1, 1, 0, 1, 0, 'where tgr_id=', '1', 'tgr_idx', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1380, '', '', 'repi_titulocontados', 'gogess_reportes', 'Titulo contados:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '6', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1381, '', '', 'repi_tituloref', 'gogess_reportes', 'Titulo refrencia:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '6', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1382, '', '', 'repi_campoacontar', 'gogess_reportes', 'Campo a contar de la consulta principal:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '6', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1383, '', '', 'repi_sqlreferenciat', 'gogess_reportes', 'Sql totaliza referencia:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'cssobj', '', '', '', 'gogess_reportes', '', '', '', 1, 1, 0, 1, 0, '', '6', '', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1384, '', '', 'repi_activo', 'gogess_reportes', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '0', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1385, '', '', 'repi_verresumen', 'gogess_reportes', 'Ver resumen:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'cssobj', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 5, 0, 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1389, 'int', '', 'fie_ordengrid', 'gogess_sisfield', 'Orden grid:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 45, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1496, '', '', 'usr_nombre', 'spag_postulante', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'spag_postulante', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1497, '', '', 'usr_username', 'spag_postulante', 'Usuario:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'spag_postulante', '', '', '', 1, 1, 1, 1, 0, '', '2', '', 1, 20, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1499, '', '', 'usr_telefono', 'spag_postulante', 'Telefono:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'spag_postulante', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1500, '', '', 'usr_telefono_alternativo', 'spag_postulante', 'Telefono  celular:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'spag_postulante', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1506, '', '', 'usr_usuarioactiva', 'spag_postulante', 'Usuarioactiva:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'spag_postulante', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '', '', 15, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1509, '', '', 'usr_intentos_fallidos', 'spag_postulante', 'Intentos:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'spag_postulante', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '', '', 18, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1526, 'int', 'primary_key auto_increment', 'paraim_id', 'gogess_parametroimenu', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_parametroimenu', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1527, 'int', '', 'ite_id', 'gogess_parametroimenu', 'Imenu:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_itemmenu', 'ite_id,ite_titulo', '', '', 1, 1, 1, 1, 0, 'where ite_id=', '1', 'ite_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1528, '', '', 'paraim_nombre', 'gogess_parametroimenu', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_parametroimenu', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1529, '', '', 'paraim_tipo', 'gogess_parametroimenu', 'Tipo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_tipovariable', 'tipov_nombre,tipov_nombre', '', '', 1, 1, 1, 1, 1, 'where tipov_nombre like', '1', 'paraim_tipox', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1530, '', '', 'paraim_valor', 'gogess_parametroimenu', 'Valor:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_parametroimenu', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 10, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1587, '', '', 'tab_campogeneracion', 'gogess_sistable', 'Campogeneracion:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1588, '', '', 'tab_campoorden', 'gogess_sistable', 'Campoorden:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(1589, 'int', '', 'tab_compilar', 'gogess_sistable', 'Compilar:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2005, '', '', 'valid_extradata', 'gogess_validaciones', 'Extradata:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_validaciones', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 40, 5, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2106, 'int', 'primary_key auto_increment', 'auto_id', 'gogess_automatico', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_automatico', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2107, '', '', 'auto_titulo', 'gogess_automatico', 'Titulo:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'gogess_automatico', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2108, '', '', 'auto_formatoarchivo', 'gogess_automatico', 'Formato archivo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_automatico', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 40, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2109, '', '', 'auto_patharch', 'gogess_automatico', 'OrÃ­gen:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', '', '', '', '', 'gogess_automatico', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 40, 8, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2110, '', '', 'auto_destinopdf', 'gogess_automatico', 'Destino pdf:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_automatico', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 40, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2111, '', '', 'auto_destinoxml', 'gogess_automatico', 'Destino xml:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_automatico', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 40, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2112, '', '', 'auto_publicar', 'gogess_automatico', 'Publicar:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value like', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2113, '', '', 'auto_separadorcmp', 'gogess_automatico', 'Separador campos txt:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_automatico', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2114, '', '', 'opcg_id', 'gogess_automatico', 'Id:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'gogess_automatico', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2115, 'int', '', 'emp_id', 'gogess_automatico', 'Empresa:', '', '', '', 'selectafecta', 'selectafecta', '', 'estab_id', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'factura_empresa', 'emp_id,emp_nombre', '', '', 1, 1, 1, 1, 0, 'where emp_id=', '1', 'emp_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2117, '', '', 'auto_activo', 'gogess_automatico', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value like', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 12, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2119, 'int', '', 'tpifin_id', 'gogess_automatico', 'Resultado Final:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'factura_tipofinal', 'tpifin_id,tpifin_nombre', '', '', 1, 1, 1, 1, 0, 'where tpifin_id=', '1', 'tpifin_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 14, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2120, '', '', 'tipocmp_codigo', 'gogess_automatico', 'Comprobante:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'factura_tipocomprobante', 'tipocmp_codigo,tipocmp_nombre', '', '', 1, 1, 1, 1, 0, 'where tipocmp_codigo like', '1', 'tipocmp_codigox', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 15, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2481, '', '', 'auto_tipo', 'gogess_automatico', 'Tipo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_tipoenlace', 'enlace_nombre,enlace_nombre', '', '', 1, 1, 1, 1, 0, 'where enlace_nombre like', '1', 'auto_tipoX', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2613, '', '', 'auto_cedulafirma', 'gogess_automatico', 'Cedula firma:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_automatico', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 16, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2616, 'int', '', 'estab_id', 'gogess_automatico', 'Establecimiento:', '', '', '', 'selectafectarecibe', 'selectafectarecibe', '', 'emi_id', 'emp_id', 0, 'cmbforms', 'OKcampo', '', '', '', 'factura_establecimiento', 'estab_id,estab_codigo', '', '', 1, 1, 1, 1, 0, 'where estab_id=', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 11, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2617, 'int', '', 'emi_id', 'gogess_automatico', 'Punto de emisiÃ³n:', '', '', '', 'selectrecibe', 'selectrecibe', '', '', 'estab_id', 0, 'cmbforms', 'OKcampo', '', '', '', 'factura_puntoemision', 'emi_id,emi_num', '', '', 1, 1, 1, 1, 0, 'where emi_id=', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 11, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2618, 'int', 'primary_key auto_increment', 'corre_id', 'gogess_correo', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_correo', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2619, '', '', 'corre_email', 'gogess_correo', 'Email:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'gogess_correo', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2620, '', '', 'corre_smtp', 'gogess_correo', 'Smtp:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'gogess_correo', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2621, '', '', 'corre_clave', 'gogess_correo', 'Clave:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'gogess_correo', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2622, '', '', 'corre_titulo', 'gogess_correo', 'Titulo:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'gogess_correo', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2623, '', '', 'corre_mensaje', 'gogess_correo', 'Mensaje:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_correo', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 40, 7, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2758, '', '', 'rept_activo', 'gogess_report', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2759, '', '', 'rept_aleatunico', 'gogess_report', 'Aleat unico:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_report', '', '', '', 1, 1, 1, 1, 0, '', '1', 'rept_aleatunicox', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2760, '', '', 'rept_campos', 'gogess_report', 'Campos agregados:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_report', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2761, 'int', 'primary_key auto_increment', 'rept_id', 'gogess_report', 'ID:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_report', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2762, '', '', 'rept_nombre', 'gogess_report', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_report', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2763, '', '', 'rept_tabla', 'gogess_report', 'Tablas agregadas:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_report', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2764, '', '', 'rept_orden', 'gogess_report', 'Orden:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_report', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2767, 'int', 'primary_key auto_increment', 'usua_id', 'beko_usuario', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2768, 'int', '', 'emp_id', 'beko_usuario', 'Centro:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', '', '', '', 'replace', 'beko_empresa', 'emp_id,emp_nombre', '', '', 1, 1, 1, 1, 0, 'where emp_id=', '1', 'emp_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2769, '', '', 'usua_ciruc', 'beko_usuario', 'RUC. / C.I.:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'form-control', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2770, '', '', 'usua_nombre', 'beko_usuario', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'form-control', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2771, '', '', 'usua_usuario', 'beko_usuario', 'Usuario:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'form-control', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 0, '', '2', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2772, '', '', 'usua_clave', 'beko_usuario', 'Clave:', '', '', '', 'password', 'password', '', '', '', 0, 'cmbforms', 'form-control', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 0, '', '2', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2773, '', '', 'usua_email', 'beko_usuario', 'Email:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'form-control', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 1, '', '2', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2774, '', '', 'usua_fecha_uingreso', 'beko_usuario', 'Fecha:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2775, '', '', 'usua_hora_uingreso', 'beko_usuario', 'Hora:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2776, '', '', 'usua_fecha_cambioclv', 'beko_usuario', 'Fecha:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2777, 'int', '', 'usua_estado', 'beko_usuario', 'Permitir ingreso al sistema:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '2', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 11, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2778, 'int', 'primary_key auto_increment', 'emp_id', 'beko_empresa', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_empresa', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2779, '', '', 'emp_ruc', 'beko_empresa', 'Ruc:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_empresa', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2780, '', '', 'emp_nombre', 'beko_empresa', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_empresa', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2781, '', '', 'emp_direccion', 'beko_empresa', 'Direccion:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_empresa', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 4, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2782, '', '', 'emp_telefono', 'beko_empresa', 'Telefono:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_empresa', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2783, 'int', '', 'emp_estado', 'beko_empresa', 'Estado:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'form-control', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2784, 'int', 'primary_key auto_increment', 'per_id', 'beko_usuariosperfil', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuariosperfil', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2785, '', '', 'usua_id', 'beko_usuariosperfil', 'Usuario:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_usuario', 'usua_id,usua_nombre', '', '', 1, 1, 1, 1, 0, 'where usua_id=', '1', 'usua_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2786, '', '', 'per_codobj', 'beko_usuariosperfil', 'Codobj:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_itemmenuaplicativo', 'itmenap_id,itmenap_nombre', '', '', 1, 1, 1, 1, 0, 'where itmenap_id=', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2787, 'int', '', 'per_activo', 'beko_usuariosperfil', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2788, '', '', 'per_fechamod', 'beko_usuariosperfil', 'Fechamod:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_usuariosperfil', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2791, '', '', 'menap_icono', 'gogess_itemmenuaplicativo', 'Icono:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_itemmenuaplicativo', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2807, 'int', '', 'itmenap_rapido', 'gogess_itemmenuaplicativo', 'Acceso Rapido:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2808, '', '', 'itmenap_graficoacceso', 'gogess_itemmenuaplicativo', 'Grafico acceso:', '', '', '', 'txtarchivografico', 'txtarchivografico', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_itemmenuaplicativo', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 11, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2839, '', '', 'usua_apellido', 'beko_usuario', 'Apellido:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'form-control', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2841, '', '', 'usua_periodo', 'beko_usuario', 'Periodo:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'form-control', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2842, '', '', 'usua_code', 'beko_usuario', 'Code:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 14, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2880, '', '', 'prob_codigo', 'beko_empresa', 'Provincia:', '', '', '', 'selectafecta', 'selectafecta', '', 'cant_codigo', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_provincia', 'prob_codigo,prob_nombre', '', '', 1, 1, 1, 1, 0, 'where prob_codigo like', '1', 'prob_codigox', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2881, '', '', 'cant_codigo', 'beko_empresa', 'Cant&oacute;n:', '', '', '', 'selectrecibe', 'selectrecibe', '', '', 'prob_codigo', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_canton', 'cant_codigo,cant_nombre', '', '', 1, 1, 1, 1, 0, 'where cant_codigo like', '1', 'cant_codigox', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2882, 'int', '', 'tipo_id', 'beko_usuario', 'Tipo personal:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_tipopersonal', 'tipo_id,tipo_nombre', '', '', 1, 1, 1, 1, 0, 'where tipo_id=', '1', 'tipo_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2893, 'int', 'primary_key auto_increment', 'caucab_id', 'beko_causascab_vista', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_causascab_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2894, '', '', 'emp_nombre', 'beko_causascab_vista', 'Nombre:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_causascab_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2897, '', '', 'caucab_fechareg', 'beko_causascab_vista', 'Fecha Reg.:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_causascab_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2898, '', '', 'caucab_nregistro', 'beko_causascab_vista', 'No.Registro:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_causascab_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2899, '', '', 'caucab_sede', 'beko_causascab_vista', 'Sede:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_causascab_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2900, '', '', 'usua_nombre', 'beko_causascab_vista', 'Usuario Reg.:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_causascab_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2901, 'int', '', 'emp_id', 'beko_causascab_vista', 'Empresa_id:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_causascab_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2902, '', '', 'usua_id', 'beko_usuario_vista', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2903, '', '', 'emp_id', 'beko_usuario_vista', 'Empresa_id:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2904, '', '', 'emp_nombre', 'beko_usuario_vista', 'Centro:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2905, '', '', 'tipo_id', 'beko_usuario_vista', 'Id_tipo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2906, '', '', 'tipo_nombre', 'beko_usuario_vista', 'Tipo personal:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2907, '', '', 'usua_ciruc', 'beko_usuario_vista', 'Ciruc:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_usuario_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2908, '', '', 'usua_nombre', 'beko_usuario_vista', 'Nombre:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_usuario_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2909, '', '', 'usua_apellido', 'beko_usuario_vista', 'Apellido:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_usuario_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2910, '', '', 'usua_usuario', 'beko_usuario_vista', 'Usuario:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_usuario_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2911, '', '', 'usua_email', 'beko_usuario_vista', 'Email:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_usuario_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2912, '', '', 'usua_estado', 'beko_usuario_vista', 'Estado:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_usuario_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2913, '', '', 'etiqueta', 'beko_usuario_vista', 'Estado:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 12, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2914, 'int', '', 'itmenap_paraus', 'gogess_itemmenuaplicativo', 'Para usuario extreno:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2915, 'int', '', 'usua_adm', 'beko_usuario', 'Administrador:', '', '', '', 'select', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '2', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 15, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2916, '', '', 'usua_adm', 'beko_usuario_vista', 'Adm:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_usuario_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2928, 'int', '', 'temp_id', 'beko_empresa', 'Tipo:', '', '', '', 'select', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_tipoemp', 'temp_id,temp_nombre', '', '', 1, 1, 1, 1, 0, 'where temp_id=', '1', 'temp_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2939, 'int', 'primary_key auto_increment', 'capapr_id', 'beko_capacitacionprestada', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_capacitacionprestada', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2940, 'int', '', 'usua_id', 'beko_capacitacionprestada', 'Usuario:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_usuario', 'usua_id,usua_nombre,usua_apellido', '', '', 1, 1, 1, 1, 0, 'where usua_id=', '1', 'usua_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2941, '', '', 'capapr_numero', 'beko_capacitacionprestada', 'N&uacute;mero:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_capacitacionprestada', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2942, '', '', 'capapr_fechainicio', 'beko_capacitacionprestada', 'Fecha de inicio de la capacitación:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_capacitacionprestada', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 12, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2943, '', '', 'capapr_fin', 'beko_capacitacionprestada', 'Fecha de conclucón de la capacitación:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_capacitacionprestada', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 12, 0, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0);
INSERT INTO `gogess_sisfield` (`fie_id`, `field_type`, `field_flags`, `fie_name`, `tab_name`, `fie_title`, `fie_titlereporte`, `fie_txtextra`, `fie_txtizq`, `fie_type`, `fie_typeweb`, `fie_evitaambiguo`, `fie_campoafecta`, `fie_camporecibe`, `fie_naleatorio`, `fie_style`, `fie_styleobj`, `fie_attrib`, `fie_valiextra`, `fie_value`, `fie_tabledb`, `fie_datadb`, `fie_sqlconexiontabla`, `fie_sqlorder`, `fie_active`, `fie_activesearch`, `fie_activelista`, `fie_activarprt`, `fie_obl`, `fie_sql`, `fie_group`, `fie_sendvar`, `fie_tactive`, `fie_lencampo`, `fie_lineas`, `fie_tabindex`, `fie_verificac`, `fie_tablac`, `fie_xmlactivo`, `fie_xmlformato`, `fie_inactivoftabla`, `fie_activogrid`, `fie_orden`, `fie_limpiarengrid`, `field_maxcaracter`, `fie_archivo`, `fie_mascara`, `fie_iconoarchivo`, `fie_activarbuscador`, `fie_tablabusca`, `fie_camposbusca`, `fie_campodevuelve`, `fie_ordengrid`, `fie_typereport`, `fie_guarda`, `fie_x`, `fie_y`) VALUES
(2944, '', '', 'capapr_cargahoraria', 'beko_capacitacionprestada', 'Horas de Duraci&oacute;n:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_capacitacionprestada', '', '', '', 1, 1, 1, 1, 0, '', '2', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2945, 'int', '', 'capapr_nparticipantes', 'beko_capacitacionprestada', 'N&uacute;mero de participantes:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_capacitacionprestada', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 6, 0, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2946, '', '', 'capapr_code', 'beko_capacitacionprestada', 'Code:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_capacitacionprestada', '', '', '', 1, 1, 1, 1, 0, '', '1', 'capapr_codex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2952, 'int', 'primary_key auto_increment', 'rept_id', 'sth_report', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'sth_report', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2953, '', '', 'rept_aleatunico', 'sth_report', 'Aleatunico:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'sth_report', '', '', '', 1, 1, 1, 1, 0, '', '1', 'rept_aleatunicox', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2954, '', '', 'rept_nombre', 'sth_report', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'sth_report', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2955, 'int', '', 'rept_activo', 'sth_report', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2956, '', '', 'rept_tabla', 'sth_report', 'Tabla:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'sth_report', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2957, '', '', 'rept_campos', 'sth_report', 'Campos:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'sth_report', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, NULL, 1, 0, 0),
(2958, '', '', 'fie_titlereporte', 'gogess_sisfield', 'Titulo para reporte:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '5', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2959, '', '', 'fie_typereport', 'gogess_sisfield', 'Tipo campo reporte:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_typecmp', 'tyc_value,tyc_etiqueta', '', '', 1, 1, 1, 1, 0, '', '5', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2961, 'int', 'primary_key auto_increment', 'temp_id', 'beko_tipoemp', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_tipoemp', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2962, '', '', 'temp_nombre', 'beko_tipoemp', 'Nombre:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_tipoemp', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2963, 'int', '', 'temp_tiempo', 'beko_tipoemp', 'Tiempo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_tipoemp', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2967, '', '', 'rept_archivopersonalizado', 'sth_report', 'Archivo personalizado:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'sth_report', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2987, 'int', '', 'tipocap_id', 'beko_capacitacionprestada', 'Brindado/Recibido:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_tipocapacitacion', 'tipocap_id,tipocap_nombre', '', '', 1, 1, 1, 1, 1, 'where tipocap_id=', '1', 'tipocap_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2988, '', '', 'capapr_tema', 'beko_capacitacionprestada', 'Tema:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_capacitacionprestada', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2989, '', '', 'capapr_lugar', 'beko_capacitacionprestada', 'Lugar:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_capacitacionprestada', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2990, '', '', 'capapr_observacion', 'beko_capacitacionprestada', 'Observacion:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', '', '', '', '', 'beko_capacitacionprestada', '', '', '', 1, 1, 1, 1, 0, '', '2', '', 1, 25, 4, 0, 0, '', 0, 'NULL', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2991, 'int', '', 'tipocur_id', 'beko_capacitacionprestada', 'Tipo (Curso,Taller):', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_tipocurso', 'tipocur_id,tipocur_nombre', '', '', 1, 1, 1, 1, 1, 'where tipocur_id=', '1', 'tipocur_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2992, '', '', 'usua_celular', 'beko_usuario', 'Celular:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2993, '', '', 'usua_direcciondom', 'beko_usuario', 'Direcci&oacute;n domicilio:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 4, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2994, '', '', 'usua_telefonodom', 'beko_usuario', 'Tel&eacute;fono domicilio:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(2997, '', '', 'caucab_fechainicio', 'beko_causascab_vista', 'Fechainicio:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_causascab_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2998, '', '', 'caucab_fechafin', 'beko_causascab_vista', 'Fechafin:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_causascab_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(2999, '', '', 'caucab_codigointerno', 'beko_causascab_vista', 'Codigointerno:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_causascab_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(3000, '', '', 'caucab_cerrado', 'beko_causascab_vista', 'Cerrado:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_causascab_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 11, '', 1, 0, 0),
(3015, 'int', 'primary_key auto_increment', 'estbl_id', 'beko_establecimiento', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_establecimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3016, 'int', '', 'emp_id', 'beko_establecimiento', 'Empresa:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_empresa', 'emp_id,emp_nombre', '', '', 1, 1, 1, 1, 0, 'where emp_id=', '1', 'emp_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3017, '', '', 'estbl_codigo', 'beko_establecimiento', 'Codigo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_establecimiento', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '###', '', '', '', '', '', 0, '', 1, 0, 0),
(3018, '', '', 'estbl_nombre', 'beko_establecimiento', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_establecimiento', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3019, '', '', 'estbl_observacion', 'beko_establecimiento', 'Observacion:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_establecimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 4, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3020, 'int', '', 'estbl_activo', 'beko_establecimiento', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3021, 'int', 'primary_key auto_increment', 'punto_id', 'beko_puntoemision', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_puntoemision', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3022, 'int', '', 'estbl_id', 'beko_puntoemision', 'Establecimiento:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_establecimiento', 'estbl_id,estbl_codigo', '', '', 1, 1, 1, 1, 0, 'where estbl_id=', '1', 'estbl_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3023, '', '', 'punto_codigo', 'beko_puntoemision', 'Codigo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_puntoemision', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '###', '', '', '', '', '', 0, '', 1, 0, 0),
(3024, '', '', 'punto_nombre', 'beko_puntoemision', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_puntoemision', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3025, 'int', '', 'punto_activo', 'beko_puntoemision', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3026, 'int', 'primary_key auto_increment', 'produ_id', 'beko_producto', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_producto', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3027, 'int', '', 'emp_id', 'beko_producto', 'Empresa:', '', '', '', 'hidden2', 'hidden2', '', 'bode_id', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_empresa', 'emp_id,emp_nombre', '', '', 1, 1, 1, 1, 0, 'where emp_id=', '1', 'emp_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3028, 'int', '', 'catpr_id', 'beko_producto', 'Categor&iacute;a:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_catgproducto', 'catpr_id,catpr_nombre', '', '', 1, 1, 1, 1, 1, 'where catpr_id=', '1', 'catpr_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3029, '', '', 'produ_nombre', 'beko_producto', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_producto', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3030, '', '', 'produ_caracteristica', 'beko_producto', 'Caracteristica:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_producto', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 4, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3031, '', '', 'produ_foto', 'beko_producto', 'Foto:', '', '', '', 'txtarchivo', 'txtarchivo', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_producto', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3032, 'int', '', 'produ_preciogen', 'beko_producto', 'Precio:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_producto', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 5, 0, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3033, 'int', '', 'produ_activo', 'beko_producto', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3034, '', '', 'produ_fechareg', 'beko_producto', 'Fecha registro:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_producto', '', '', '', 1, 1, 1, 1, 0, '', '2', 'fechax', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3035, 'int', 'primary_key auto_increment', 'bode_id', 'beko_bodega', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_bodega', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3036, 'int', '', 'emp_id', 'beko_bodega', 'Empresa:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_empresa', 'emp_id,emp_nombre', '', '', 1, 1, 1, 1, 0, 'where emp_id=', '1', 'emp_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3037, '', '', 'bode_nombre', 'beko_bodega', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_bodega', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3038, '', '', 'bode_observacion', 'beko_bodega', 'Observacion:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_bodega', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 4, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3039, 'int', '', 'bode_id', 'beko_producto', 'Bodega:', '', '', '', 'selectrecibe', 'selectrecibe', '', '', 'emp_id', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_bodega', 'bode_id,bode_nombre', '', '', 1, 1, 1, 1, 1, 'where bode_id=', '1', 'bode_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3040, '', '', 'produ_codigoserial', 'beko_producto', 'Codigo:', '', '<table border="0" cellpadding="0" cellspacing="0">\n  <tr>\n    <td><input type="button" name="Submit" value="Generar" onClick="genera_serial()"></td>\n    <td><div id="div_serial" ></div></td>\n  </tr>\n</table>', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_producto', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 30, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3041, 'int', '', 'produ_stokminimo', 'beko_producto', 'Stok minimo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_producto', '', '', '', 1, 1, 1, 1, 1, '', '2', '', 1, 5, 0, 0, 0, '', 0, 'NULL', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3042, '', '', 'produ_stockactual', 'beko_producto', 'Stock actual:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_producto', '', '', '', 1, 1, 1, 1, 0, '', '2', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 11, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3043, 'int', 'primary_key auto_increment', 'movi_id', 'beko_movimiento', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_movimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3044, 'int', '', 'produ_id', 'beko_movimiento', 'Producto:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_producto', 'produ_id,produ_nombre', '', '', 1, 1, 1, 1, 0, 'where produ_id=', '1', 'produ_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3045, 'int', '', 'tipmv_id', 'beko_movimiento', 'Tipo movimiento:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_tipomov', 'tipmv_id,tipmv_nombre', '', '', 1, 1, 1, 1, 1, 'where tipmv_id=', '1', 'tipmv_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3046, '', '', 'movi_observacion', 'beko_movimiento', 'Observacion:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_movimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 3, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3047, 'int', '', 'movi_cantidad', 'beko_movimiento', 'Cantidad:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_movimiento', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 7, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3048, '', '', 'movi_fecha', 'beko_movimiento', 'Fecha:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_movimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', 'fechax', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3049, 'int', '', 'usua_id', 'beko_movimiento', 'Usuario:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_movimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', 'usua_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3050, 'int', 'primary_key auto_increment', 'movi_id', 'beko_movimiento_vista', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_movimiento_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3051, '', '', 'produ_id', 'beko_movimiento_vista', 'Id producto:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_movimiento_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3052, '', '', 'produ_nombre', 'beko_movimiento_vista', 'Nombre producto:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_movimiento_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3053, '', '', 'tipmv_id', 'beko_movimiento_vista', 'Id movimiento:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_movimiento_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3054, '', '', 'tipmv_nombre', 'beko_movimiento_vista', 'Nombre movimiento:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_movimiento_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3055, '', '', 'movi_observacion', 'beko_movimiento_vista', 'Observacion:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_movimiento_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(3056, '', '', 'movi_cantidad', 'beko_movimiento_vista', 'Cantidad:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_movimiento_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(3057, '', '', 'movi_fecha', 'beko_movimiento_vista', 'Fecha:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_movimiento_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(3058, '', '', 'usua_id', 'beko_movimiento_vista', 'Id:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_movimiento_vista', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0),
(3059, 'int', 'primary_key auto_increment', 'fuca_id', 'beko_usuario_caja', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario_caja', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3060, 'int', '', 'usua_id', 'beko_usuario_caja', 'Usuario:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_usuario', 'usua_id,usua_usuario', '', '', 1, 1, 1, 1, 0, 'where usua_id=', '1', 'usua_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3061, 'int', '', 'emp_id', 'beko_usuario_caja', 'Empresa:', '', '', '', 'hidden2', 'hidden2', '', 'estbl_id', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_empresa', 'emp_id,emp_nombre', '', '', 1, 1, 1, 1, 1, 'where emp_id=', '1', 'emp_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3062, 'int', '', 'estbl_id', 'beko_usuario_caja', 'Establecimiento:', '', '', '', 'selectafectarecibe', 'selectafectarecibe', '', 'punto_id', 'emp_id', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_establecimiento', 'estbl_id,estbl_codigo', '', '', 1, 1, 1, 1, 1, 'where estbl_id=', '1', 'estbl_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3063, 'int', '', 'punto_id', 'beko_usuario_caja', 'Punto emisi&oacute;n:', '', '', '', 'selectrecibe', 'selectrecibe', '', '', 'estbl_id', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_puntoemision', 'punto_id,punto_codigo', '', '', 1, 1, 1, 1, 1, 'where punto_id=', '1', 'punto_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3064, 'int', '', 'fuca_activo', 'beko_usuario_caja', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3065, '', '', 'fuca_ingreso', 'beko_usuario_caja', 'Ingreso:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario_caja', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3066, '', '', 'fuca_estadoingreso', 'beko_usuario_caja', 'Estado ingreso:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario_caja', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3067, '', '', 'fuca_ip', 'beko_usuario_caja', 'Ip:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario_caja', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3068, '', '', 'fuca_fechamod', 'beko_usuario_caja', 'Fecha mod:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_usuario_caja', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3069, 'string', 'primary_key', 'doccab_id', 'beko_documentocabecera', 'Id:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 1, 1, 1, 1, 0, '', '1', 'doccab_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 16, 195),
(3070, 'int', '', 'emp_id', 'beko_documentocabecera', 'Empresa:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', 'replace', 'beko_empresa', 'emp_id,emp_nombre', '', '', 1, 1, 1, 1, 0, 'where emp_id=', '1', 'emp_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 636, 39),
(3071, 'int', '', 'estaf_id', 'beko_documentocabecera', 'Estado_local:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', 'replace', 'beko_estado', 'estaf_id,estaf_nombre', '', '', 1, 1, 1, 1, 0, 'where estaf_id=', '1', 'estaf_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 361, 39),
(3072, 'int', '', 'ambi_valor', 'beko_documentocabecera', 'Ambiente:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', 'replace', 'beko_ambiente', 'ambi_valor,ambi_etiqueta', '', '', 1, 1, 1, 1, 0, 'where ambi_valor=', '1', 'ambi_valorx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 634, 93),
(3073, 'int', '', 'emis_valor', 'beko_documentocabecera', 'Emisi&oacute;n:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', 'replace', 'beko_tipoemision', 'emis_valor,tipoemi_nombre', '', '', 1, 1, 1, 1, 0, 'where emis_valor=', '1', 'emis_valorx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 361, 91),
(3074, '', '', 'tipocmp_codigo', 'beko_documentocabecera', 'Tipo documento:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', 'replace', 'beko_tipocomprobante', 'tipocmp_codigo,tipocmp_nombre', '', '', 1, 1, 1, 1, 0, 'where tipocmp_codigo like', '1', 'tipocmp_codigox', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 361, 12),
(3075, '', '', 'doccab_ndocumento', 'beko_documentocabecera', 'No.Documento:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', '-documento-', 'beko_documentocabecera', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 16, 11),
(3076, '', '', 'doccab_clavedeaccesos', 'beko_documentocabecera', 'Clave de acceso:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 1, 1, 1, 1, 0, '', '1', 'doccab_clavedeaccesosx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 360, 115),
(3077, '', '', 'doccab_rucempresa', 'beko_documentocabecera', 'Ruc empresa:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 1, 1, 1, 1, 0, '', '1', 'doccab_rucempresax', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 362, 144),
(3078, '', '', 'doccab_rucci_cliente', 'beko_documentocabecera', 'Ruc-ci:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, '', 1, 16, 36),
(3079, '', '', 'doccab_nombrerazon_cliente', 'beko_documentocabecera', 'Nombre-Razon cliente:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 11, '', '', '', '', '', '', '', '', '', 0, '', 1, 16, 61),
(3080, '', '', 'doccab_direccion_cliente', 'beko_documentocabecera', 'Direccion:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 12, '', '', '', '', '', '', '', '', '', 0, '', 1, 16, 93),
(3081, '', '', 'doccab_telefono_cliente', 'beko_documentocabecera', 'Tel&eacute;fono:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 13, '', '', '', '', '', '', '', '', '', 0, '', 1, 16, 118),
(3082, '', '', 'doccab_email_cliente', 'beko_documentocabecera', 'Email:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 14, '', '', '', '', '', '', '', '', '', 0, '', 1, 17, 144),
(3083, '', '', 'doccab_fechaemision_cliente', 'beko_documentocabecera', 'Fecha emision:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 1, 1, 1, 1, 0, '', '1', 'fechax', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 15, '', '', '', '', '', '', '', '', '', 0, '', 1, 636, 12),
(3084, '', '', 'doccab_xml', 'beko_documentocabecera', 'Xml:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 0, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 16, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3085, '', '', 'doccab_xmlfirmado', 'beko_documentocabecera', 'Xmlfirmado:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 0, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 17, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3086, '', '', 'doccab_firmado', 'beko_documentocabecera', 'Firmado:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 0, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 18, '', '', '', '', '', '', '', '', '', 0, '', 0, 464, 231),
(3087, '', '', 'doccab_estadosri', 'beko_documentocabecera', 'Estadosri:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 0, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 19, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3088, '', '', 'doccab_motivodev', 'beko_documentocabecera', 'Motivodev:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 0, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 20, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3089, '', '', 'doccab_nautorizacion', 'beko_documentocabecera', 'No. Autorizaci&oacute;n:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 21, '', '', '', '', '', '', '', '', '', 0, '', 1, 361, 65),
(3090, '', '', 'doccab_fechaaut', 'beko_documentocabecera', 'Fecha. Aut:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms_titulo', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 22, '', '', '', '', '', '', '', '', '', 0, '', 1, 636, 65),
(3091, '', '', 'doccab_enviomail', 'beko_documentocabecera', 'Enviomail:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 0, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 23, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3092, '', '', 'doccab_enviomailfecha', 'beko_documentocabecera', 'Envio mail fecha:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 0, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 24, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3093, '', '', 'doccab_publicado', 'beko_documentocabecera', 'Publicado:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 0, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 25, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3094, '', '', 'doccab_fechapublicado', 'beko_documentocabecera', 'Fecha publicado:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentocabecera', '', '', '', 0, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 26, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3095, 'int', '', 'fie_guarda', 'gogess_sisfield', 'Guarda:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3096, '', '', 'fie_x', 'gogess_sisfield', 'X:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '4', '', 1, 10, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3097, '', '', 'fie_y', 'gogess_sisfield', 'Y:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sisfield', '', '', '', 1, 1, 1, 1, 0, '', '4', '', 1, 10, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3098, 'int', 'primary_key auto_increment', 'impu_id', 'beko_impuesto', 'Impuesto:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_impuesto', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3099, '', '', 'impu_nombre', 'beko_impuesto', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_impuesto', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3100, 'int', '', 'impu_codigo', 'beko_impuesto', 'Codigo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_impuesto', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3102, 'int', '', 'impu_bloquea', 'beko_impuesto', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 1, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3103, 'int', 'primary_key auto_increment', 'tari_id', 'beko_tarifa', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_tarifa', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3104, 'int', '', 'impu_codigo', 'beko_tarifa', 'Codigo:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_impuesto', 'impu_codigo,impu_nombre', '', '', 1, 1, 1, 1, 0, 'where impu_codigo=', '1', 'impu_codigox', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3105, '', '', 'tari_nombre', 'beko_tarifa', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_tarifa', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3106, 'int', '', 'tari_codigo', 'beko_tarifa', 'Codigo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_tarifa', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3107, 'int', '', 'tari_valor', 'beko_tarifa', 'Valor:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_tarifa', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3108, 'int', '', 'tari_bloquear', 'beko_tarifa', 'Bloquear:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', 'valuex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3109, 'int', '', 'impu_codigo', 'beko_producto', 'Impuesto:', '', '', '', 'selectafecta', 'selectafecta', '', 'tari_codigo', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_impuesto', 'impu_codigo,impu_nombre', '', '', 1, 1, 1, 1, 0, 'where impu_codigo=', '2', 'impu_codigox', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 12, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3110, 'int', '', 'tari_codigo', 'beko_producto', 'Codigo:', '', '', '', 'selectrecibe', 'selectrecibe', '', '', 'impu_codigo', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_tarifa', 'tari_codigo,tari_nombre', '', '', 1, 1, 1, 1, 0, 'where tari_codigo=', '2', 'tari_codigox', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 13, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3111, '', '', 'doccab_subtotaliva', 'beko_documentocabecera', 'Subtotaliva:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentocabecera', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3112, '', '', 'doccab_subtotalsiniva', 'beko_documentocabecera', 'Subtotalsiniva:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentocabecera', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3113, '', '', 'doccab_subtnoobjetoi', 'beko_documentocabecera', 'Subtnoobjetoi:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentocabecera', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3114, '', '', 'doccab_subtexentoiva', 'beko_documentocabecera', 'Subtexentoiva:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentocabecera', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3115, '', '', 'doccab_iva', 'beko_documentocabecera', 'Iva:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentocabecera', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3116, '', '', 'doccab_descuento', 'beko_documentocabecera', 'Descuento:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentocabecera', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3117, '', '', 'doccab_propina', 'beko_documentocabecera', 'Propina:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentocabecera', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3118, '', '', 'doccab_ice', 'beko_documentocabecera', 'Ice:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentocabecera', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3119, '', '', 'doccab_total', 'beko_documentocabecera', 'Total:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentocabecera', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3120, '', '', 'subgri_camposlista', 'gogess_subgrid', 'Camposlista:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_subgrid', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3121, 'int', 'primary_key auto_increment', 'docdet_id', 'beko_documentodetalle', 'Id:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentodetalle', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3122, '', '', 'doccab_id', 'beko_documentodetalle', 'Cabecera:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_documentodetalle', '', '', '', 1, 1, 1, 1, 0, '', '1', 'doccab_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3123, '', '', 'docdet_codprincipal', 'beko_documentodetalle', 'Cod. Principal:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentodetalle', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3124, '', '', 'docdet_codaux', 'beko_documentodetalle', 'Cod. Auxiliar:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentodetalle', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3125, '', '', 'docdet_cantidad', 'beko_documentodetalle', 'Cantidad:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentodetalle', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3126, '', '', 'docdet_descripcion', 'beko_documentodetalle', 'Descripci&oacute;n:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentodetalle', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3127, '', '', 'docdet_detallea', 'beko_documentodetalle', 'Detallea:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentodetalle', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3128, '', '', 'docdet_detalleb', 'beko_documentodetalle', 'Detalleb:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentodetalle', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3129, '', '', 'docdet_detallec', 'beko_documentodetalle', 'Detallec:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentodetalle', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3130, '', '', 'docdet_preciou', 'beko_documentodetalle', 'Precio:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentodetalle', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3131, '', '', 'impu_codigo', 'beko_documentodetalle', 'Codigo:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentodetalle', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3132, '', '', 'tari_codigo', 'beko_documentodetalle', 'Codigo:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentodetalle', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3133, '', '', 'docdet_porcentaje', 'beko_documentodetalle', 'Porcentaje:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentodetalle', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3134, '', '', 'docdet_valorimpuesto', 'beko_documentodetalle', 'Valorimpuesto:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentodetalle', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3135, '', '', 'docdet_descuento', 'beko_documentodetalle', 'Descuento:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentodetalle', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3136, '', '', 'docdet_porcent_descuento', 'beko_documentodetalle', 'Porcent:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentodetalle', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0);
INSERT INTO `gogess_sisfield` (`fie_id`, `field_type`, `field_flags`, `fie_name`, `tab_name`, `fie_title`, `fie_titlereporte`, `fie_txtextra`, `fie_txtizq`, `fie_type`, `fie_typeweb`, `fie_evitaambiguo`, `fie_campoafecta`, `fie_camporecibe`, `fie_naleatorio`, `fie_style`, `fie_styleobj`, `fie_attrib`, `fie_valiextra`, `fie_value`, `fie_tabledb`, `fie_datadb`, `fie_sqlconexiontabla`, `fie_sqlorder`, `fie_active`, `fie_activesearch`, `fie_activelista`, `fie_activarprt`, `fie_obl`, `fie_sql`, `fie_group`, `fie_sendvar`, `fie_tactive`, `fie_lencampo`, `fie_lineas`, `fie_tabindex`, `fie_verificac`, `fie_tablac`, `fie_xmlactivo`, `fie_xmlformato`, `fie_inactivoftabla`, `fie_activogrid`, `fie_orden`, `fie_limpiarengrid`, `field_maxcaracter`, `fie_archivo`, `fie_mascara`, `fie_iconoarchivo`, `fie_activarbuscador`, `fie_tablabusca`, `fie_camposbusca`, `fie_campodevuelve`, `fie_ordengrid`, `fie_typereport`, `fie_guarda`, `fie_x`, `fie_y`) VALUES
(3137, '', '', 'docdet_total', 'beko_documentodetalle', 'Total:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_documentodetalle', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 17, '', '', '', '', '', '', '', '', '', 0, '', 0, 0, 0),
(3138, '', '', 'usua_id', 'beko_documentodetalle', 'Id:', '', NULL, NULL, 'text', 'text', NULL, NULL, NULL, 0, 'cmbforms', 'OKcampo', '', NULL, '', 'beko_documentodetalle', '', NULL, NULL, 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, NULL, 0, 'NULL', NULL, NULL, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0),
(3139, 'int', '', 'tab_sri', 'gogess_sistable', 'Tabla Sri:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 26, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3140, '', '', 'tab_camposecsri', 'gogess_sistable', 'Campo secuencial SRI:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'gogess_sistable', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 27, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3141, 'int', '', 'doccab_ndet', 'beko_documentocabecera', 'Ndet:', '', '', '', 'textblock', 'textblock', '', '', '', 0, 'cmbforms', '', '', '', '', 'beko_documentocabecera', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 3, 0, 0, 0, '', 0, 'NULL', '0', '', 27, '', '', '', '', '', '', '', '', '', 0, '', 1, 16, 170),
(3142, '', '', 'emp_logo', 'beko_empresa', 'Logo:', '', '', '', 'txtarchivo', 'txtarchivo', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_empresa', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3143, 'int', 'primary_key auto_increment', 'imp_id', 'beko_impresion', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_impresion', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3144, 'int', '', 'emp_id', 'beko_impresion', 'Empresa:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_empresa', 'emp_id,emp_nombre', '', '', 1, 1, 1, 1, 0, 'where emp_id=', '1', 'emp_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3145, '', '', 'imp_nombre', 'beko_impresion', 'Nombre:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_impresion', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3146, 'int', '', 'tipimp_id', 'beko_impresion', 'Tipo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_tipoimp', 'tipimp_id,tipimp_nombre', '', '', 1, 1, 1, 1, 0, 'where tipimp_id=', '1', 'tipimp_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3147, '', '', 'imp_script', 'beko_impresion', 'Script:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', '', '', '', '', 'beko_impresion', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 50, 5, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3148, '', '', 'imp_campoparametro', 'beko_impresion', 'Campo parametro:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_impresion', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3149, 'int', '', 'imp_activo', 'beko_impresion', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3150, 'int', 'primary_key auto_increment', 'impcamp_id', 'beko_impresioncampos', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_impresioncampos', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3151, 'int', '', 'imp_id', 'beko_impresioncampos', 'Impresion:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_impresion', 'imp_id,imp_nombre', '', '', 1, 1, 1, 1, 0, 'where imp_id=', '1', 'imp_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3152, '', '', 'impcamp_campo', 'beko_impresioncampos', 'Campo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_impresioncampos', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3153, 'int', '', 'ticaimp_id', 'beko_impresioncampos', 'Tipo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_tipocampoimp', 'ticaimp_id,ticaimp_nombre', '', '', 1, 1, 1, 1, 0, 'where ticaimp_id=', '1', 'ticaimp_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3154, '', '', 'impcamp_script', 'beko_impresioncampos', 'Script:', '', '', '', 'textarea', 'textarea', '', '', '', 0, 'cmbforms', '', '', '', '', 'beko_impresioncampos', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 50, 7, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3155, '', '', 'impcamp_parametrogrid', 'beko_impresioncampos', 'Parametro grid:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_impresioncampos', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3156, 'int', '', 'impcamp_activo', 'beko_impresioncampos', 'Activo:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3157, '', '', 'impcamp_x', 'beko_impresioncampos', 'X:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_impresioncampos', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3158, '', '', 'impcamp_y', 'beko_impresioncampos', 'Y:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_impresioncampos', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3159, '', '', 'punto_inicia', 'beko_puntoemision', 'Inicia secuencial:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', '', '', '', '1', 'beko_puntoemision', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 10, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3160, 'int', 'primary_key auto_increment', 'regisc_id', 'beko_registrocaja', 'Id:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3161, 'int', '', 'conc_id', 'beko_registrocaja', 'Concepto:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_concepto', 'conc_id,conc_nombre', '', '', 1, 1, 1, 1, 1, 'where conc_id=', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3162, '', '', 'regisc_fechahora', 'beko_registrocaja', 'Fechahora:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja', '', '', '', 1, 1, 1, 1, 0, '', '1', 'fechax', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3163, '', '', 'regisc_idfactura', 'beko_registrocaja', 'Idfactura:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3164, '', '', 'regisc_idrecibo', 'beko_registrocaja', 'Idrecibo:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3165, '', '', 'regisc_concepto', 'beko_registrocaja', 'Concepto:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3166, 'int', '', 'regisc_valor', 'beko_registrocaja', 'Valor:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja', '', '', '', 1, 1, 1, 1, 1, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3167, 'int', '', 'tipca_id', 'beko_registrocaja', 'Tipo transaccion:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_tipocaja', 'tipca_id,tipca_nombre', '', '', 1, 1, 1, 1, 1, 'where tipca_id=', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3168, '', '', 'regisc_moneda', 'beko_registrocaja', 'Moneda:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'DOLAR', 'beko_registrocaja', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3169, 'int', '', 'usua_id', 'beko_registrocaja', 'Usuario:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_usuario', 'usua_id,usua_nombre', '', '', 1, 1, 1, 1, 0, 'where usua_id=', '1', 'usua_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3170, '', '', 'usua_idalt', 'beko_registrocaja', 'Usuarioalt:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_usuario', 'usua_id,usua_nombre', '', '', 1, 1, 1, 1, 0, 'where usua_id=', '1', 'usua_idaltx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 11, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3171, '', '', 'regisc_cerrado', 'beko_registrocaja', 'Cerrado:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 12, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3172, 'int', '', 'emp_id', 'beko_registrocaja', 'Empresa:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_empresa', 'emp_id,emp_nombre', '', '', 1, 1, 1, 1, 0, 'where emp_id=', '1', 'emp_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3173, 'int', '', 'usua_caja', 'beko_usuario', 'Caja:', '', '', '', 'select', 'select', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'gogess_sino', 'value,etiqueta', '', '', 1, 1, 1, 1, 0, 'where value=', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 16, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3174, 'int', 'auto_increment primary', 'regisc_id', 'beko_registrocaja_vista', 'Id:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3175, '', '', 'regisc_fechahora', 'beko_registrocaja_vista', 'Fecha hora:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3176, '', '', 'regisc_concepto', 'beko_registrocaja_vista', 'Concepto:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3177, '', '', 'regisc_moneda', 'beko_registrocaja_vista', 'Moneda:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3178, 'int', '', 'usua_id', 'beko_registrocaja_vista', 'Id_usuario:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3179, '', '', 'usua_usuario', 'beko_registrocaja_vista', 'Usuario:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3180, 'int', '', 'tipca_id', 'beko_registrocaja_vista', 'ID_Tipo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 7, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3181, '', '', 'tipca_nombre', 'beko_registrocaja_vista', 'Tipo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 8, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3182, 'int', '', 'regisc_valor', 'beko_registrocaja_vista', 'Valor:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 9, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3183, 'int', '', 'conc_id', 'beko_registrocaja_vista', 'Id_concepto:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 10, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3184, '', '', 'conc_nombre', 'beko_registrocaja_vista', 'Concepto:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 11, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3185, '', '', 'usua_idalt', 'beko_registrocaja_vista', 'Idalt:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 12, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3186, '', '', 'regisc_cerrado', 'beko_registrocaja_vista', 'Cerrado:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 13, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3187, '', '', 'regisc_idfactura', 'beko_registrocaja_vista', 'Idfactura:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 14, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3188, '', '', 'regisc_idrecibo', 'beko_registrocaja_vista', 'Idrecibo:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 15, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3189, '', '', 'emp_id', 'beko_registrocaja_vista', 'Empresa:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_registrocaja_vista', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3191, 'int', '', 'movi_precio', 'beko_movimiento', 'Precio:', '', '', '', 'text', 'text', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_movimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 7, 0, 0, 0, '', 0, 'NULL', '0', '', 5, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3193, '', '', 'docdet_id', 'beko_movimiento', 'Id:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_movimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3194, 'int', '', 'movi_disponibles', 'beko_movimiento', 'Disponibles:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_movimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3195, '', '', 'doccab_id', 'beko_movimiento', 'Id:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', '', 'beko_movimiento', '', '', '', 1, 1, 1, 1, 0, '', '1', '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0),
(3196, 'int', '', 'usua_id', 'beko_documentocabecera', 'Usuario registra:', '', '', '', 'hidden2', 'hidden2', '', '', '', 0, 'cmbforms', 'OKcampo', '', '', 'replace', 'beko_usuario', 'usua_id,usua_usuario', '', '', 1, 1, 1, 1, 0, 'where usua_id=', '1', 'usua_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 362, 178);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_sisfieldconcatena`
--

CREATE TABLE IF NOT EXISTS `gogess_sisfieldconcatena` (
  `fiecon_id` bigint(64) NOT NULL,
  `fie_id` int(32) NOT NULL,
  `tab_name` char(60) DEFAULT NULL,
  `fieenlace_id` int(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_sisfieldconcatena`
--

INSERT INTO `gogess_sisfieldconcatena` (`fiecon_id`, `fie_id`, `tab_name`, `fieenlace_id`) VALUES
(1, 599, 'spag_empresa', 600),
(2, 599, 'spag_empresa', 601),
(3, 664, 'spag_banco', 665),
(4, 664, 'spag_banco', 666);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_sistable`
--

CREATE TABLE IF NOT EXISTS `gogess_sistable` (
  `tab_id` bigint(64) NOT NULL,
  `tab_name` char(60) DEFAULT 'NULL',
  `tab_campoprimario` char(250) DEFAULT NULL,
  `tab_tipocampoprimariio` char(250) DEFAULT NULL,
  `tab_title` char(100) DEFAULT 'NULL',
  `tab_information` text,
  `tab_actv` int(32) DEFAULT '0',
  `tab_mdobuscar` char(200) DEFAULT 'NULL',
  `st_id` int(32) DEFAULT '0',
  `tab_bextras` char(250) DEFAULT 'NULL',
  `tab_valextguardar` text,
  `tab_rel` char(60) DEFAULT 'NULL',
  `tab_crel` char(60) DEFAULT 'NULL',
  `tab_trel` int(32) DEFAULT '0',
  `tab_datosf` int(32) DEFAULT '0',
  `tab_archivo` int(32) DEFAULT '0',
  `tab_formatotabla` int(32) DEFAULT '0',
  `ayu_id` int(32) DEFAULT '0',
  `tab_nlista` int(32) DEFAULT '0',
  `tab_tablaregreso` char(100) DEFAULT 'NULL',
  `instan_id` int(32) DEFAULT '0',
  `tab_tipoimp` int(32) DEFAULT '0',
  `tab_sqlimp` text,
  `tab_archivoimp` char(250) DEFAULT 'NULL',
  `tab_camposgrid` char(250) DEFAULT NULL,
  `tab_scriptorden` text,
  `tab_campogeneracion` char(250) DEFAULT NULL,
  `tab_campoorden` char(250) DEFAULT NULL,
  `tab_compilar` int(32) DEFAULT NULL,
  `tab_sri` int(11) NOT NULL,
  `tab_camposecsri` varchar(90) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=228 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_sistable`
--

INSERT INTO `gogess_sistable` (`tab_id`, `tab_name`, `tab_campoprimario`, `tab_tipocampoprimariio`, `tab_title`, `tab_information`, `tab_actv`, `tab_mdobuscar`, `st_id`, `tab_bextras`, `tab_valextguardar`, `tab_rel`, `tab_crel`, `tab_trel`, `tab_datosf`, `tab_archivo`, `tab_formatotabla`, `ayu_id`, `tab_nlista`, `tab_tablaregreso`, `instan_id`, `tab_tipoimp`, `tab_sqlimp`, `tab_archivoimp`, `tab_camposgrid`, `tab_scriptorden`, `tab_campogeneracion`, `tab_campoorden`, `tab_compilar`, `tab_sri`, `tab_camposecsri`) VALUES
(1, 'gogess_sistable', 'tab_id', 'int', 'ESTRUCTURA TABLAS', 'Tabla que registra las tablas del sistema bbb', 1, '', 3, '', '', '', '', 0, 0, 0, 1, 0, 20, '', 1, 0, '', '', 'tab_id,tab_name,tab_title,', 'order by tab_id desc', 'tab_name', 'tab_id', 1, 0, ''),
(2, 'gogess_sisfield', 'fie_id', 'int', 'CAMPOS', 'Contiene la informacion de los campos de cada tabla', 1, '', 4, '0', '', '', '', 0, 0, 1, 1, 0, 40, '', 1, 0, '', '', 'fie_id,fie_name,tab_name,fie_title,fie_orden,fie_type,fie_typeweb,fie_group,field_type,fie_guarda,fie_active', 'order by fie_id desc', '', 'fie_orden', 1, 0, ''),
(3, 'gogess_sys', 'sys_id', 'int', 'Sistemas', 'Sistemas disponibles', 1, '', 6, '0', '', '', '', 0, 0, 1, 1, 0, 10, '', 0, 0, '', '', 'sys_id,sys_titulo,sys_detalle', 'order by sys_id desc', '', '', 0, 0, ''),
(4, 'gogess_ptemplate', 'temp_id', 'int', 'Template Portal', 'Template Portal', 1, '', 7, '0', '', '', '', 0, 0, 1, 1, 0, 10, 'gogess_sys', 0, 0, '', '', 'temp_id,sys_id,temp_nombre', 'order by temp_id desc', '', '', 0, 0, ''),
(5, 'gogess_pmenu', 'menp_id', 'int', 'Menu Portal', 'Menus para el portal web', 1, '', 7, '0', '', '', '', 0, 0, 0, 1, 0, 10, 'gogess_sys', 0, 0, '', '', 'menp_id,sys_id,menp_titulo', 'order by menp_id desc', '', '', 0, 0, ''),
(6, 'gogess_menu', 'men_id', 'int', 'Menu', 'Manus', 1, '', 6, '0', '', '', 'men_id', 0, 0, 1, 1, 0, 10, '', 0, 0, '', '', 'men_id,men_titulo,men_ord,men_active', 'order by men_id desc', '', '', 0, 0, ''),
(7, 'gogess_datosg', '', '', 'Datos generales', 'Detalle de campos y datos generales de la aplicacion', 1, '', 6, '', '', '-1', '-1', -1, 1, 1, 1, -1, 10, '', -1, 0, '', '', '', '', '', '', 0, 0, ''),
(8, 'gogess_template', 'tem_id', 'int', 'Templates', 'Templates', 1, '', 6, '', '', '', '', 0, 0, 0, 1, 0, 10, '', 0, 0, '', '', 'tem_id,tem_nombre,tem_active', 'order by tem_id desc', '', '', 0, 0, ''),
(9, 'gogess_styletable', 'st_id', 'int', 'Estilo Tabla', 'Estilo tabla', 1, '', 6, '', '', '', '', 0, 0, 0, 1, 0, 10, '', 0, 0, '', '', 'st_id,st_nombre,st_path', 'order by st_id desc', '', '', 0, 0, ''),
(10, 'gogess_pitemmenu', 'itep_id', 'int', 'Itemmenu Portal', 'Items del menu portal', 1, '', 7, '0', '', '', '', 0, 0, 1, 1, 0, 20, '', 0, 0, '', '', '', '', '', '', 0, 0, ''),
(11, 'gogess_subtablatr', 'subtr_id', 'int', 'SubTabla Nivel3', '', 1, '', 7, '', '', '', '', 0, 0, 1, 1, 0, 20, 'gogess_sistable', 0, 0, '', '', 'subtr_id,subtr_nameenlace,subtr_nombreenlace,subtr_activo', 'order by subtr_id desc', '', '', 0, 0, ''),
(12, 'gogess_itemmenu', 'ite_id', 'int', 'Itemmenu', 'Item de los menus', 1, '', 7, '0', '', '', '', 0, 0, 0, 1, 0, 10, 'gogess_menu', 0, 0, '', '', 'ite_id,men_id,ite_titulo,ite_order,ite_active', 'order by ite_id desc', '', '', 0, 0, ''),
(13, 'gogess_sisusers', 'sisu_id', 'int', 'Usuarios', 'Usuarios sistema Qualis', 1, '', 6, '', '', '', '', 0, 0, 0, 1, 0, 10, '', 0, 0, '', '', 'sisu_id,sisu_name,per_id', 'order by sisu_id desc', '', '', 0, 0, ''),
(14, 'gogess_perfil', 'per_id', 'int', 'Perfiles', 'Tabla para manejo de perfiles', 1, '', 6, '0', '', '', '', 0, 0, 0, 1, 0, 10, '', 0, 0, '', '', 'per_id,per_nombre', 'order by per_id desc', '', '', 0, 0, ''),
(15, 'gogess_detperfil', 'detp_id', 'int', 'Detalle perfil', 'Configuracion de cada perfil', 1, '', 8, '0', '', '', '', 0, 0, 0, 1, 0, 10, 'gogess_perfil', 0, 0, '', '', 'detp_id,per_id,detp_obj', 'order by detp_id desc', '', '', 0, 0, ''),
(16, 'gogess_subtabla', 'sub_id', 'int', 'Subtablas', '', 1, '', 7, '', '', '', '', 0, 0, 0, 1, 0, 20, 'gogess_sistable', 0, 0, '', '', 'sub_id,tab_id,sub_nameenlace,sub_nombreenlace,sub_orden', 'order by sub_id desc', '', '', 0, 0, ''),
(17, 'gogess_iconomenuhome', 'iico_id', 'int', 'Icono de acceso directo', '', 1, '', 6, '', '', '', '', 0, 0, 1, 1, 0, 10, '', 0, 0, '', '', 'iico_id,men_id,ite_id,iico_icono,iico_acitvo,iico_orden', 'order by iico_id desc', '', '', 0, 0, ''),
(25, 'gogess_subgrid', 'subgri_id', 'int', 'Grid', '', 1, '', 7, '', '', '', '', 0, 0, 1, 1, 0, 10, 'gogess_sistable', 0, 0, '', '', 'subgri_id,tab_id,subgri_nameenlace,subgri_campoenlace,subgri_tipoenlace,subgri_campoidts', 'order by subgri_id desc', '', '', 0, 0, ''),
(39, 'gogess_aplicationadm', 'ap_id', 'int', 'Sub aplicaciones', '', 1, '', 6, '', '', '', '', 0, 0, 1, 1, 0, 10, '', 0, 0, '', '', 'ap_id,ap_nombre', 'order by ap_id desc', '', '', 0, 0, ''),
(40, 'gogess_gridfunciones', '', '', 'Funciones grid', '', 1, '', 7, '', '', '-1', '-1', -1, 0, 1, 1, -1, 10, '', -1, -1, '', '', '', '', '', '', 0, 0, ''),
(44, 'gogess_seccp', '', '', 'Seccion Contenido', '', 1, '', 7, '', '', '-1', '-1', -1, 0, 1, 1, -1, 10, 'gogess_sys', -1, -1, '', '', '', '', '', '', 0, 0, ''),
(68, 'gogess_conocimiento', '', '', 'Base conocimiento', '', 1, '', 6, '', '', '-1', '-1', -1, 0, 1, 1, -1, 10, '', -1, -1, '', '', '', '', '', '', 0, 0, ''),
(75, 'gogess_validaciones', 'valid_id', 'int', 'Validaciones', '', 1, '', 7, '', '', '', '', 0, 0, 1, 1, 0, 10, '', 0, 0, '', '', '', '', '', '', 0, 0, ''),
(76, 'gogess_prgvalidar', '', '', 'Programacion Validaciones', '', 1, '', 6, '', '', '-1', '-1', -1, 0, 1, 1, -1, 10, '', -1, -1, '', '', '', '', '', '', 0, 0, ''),
(78, 'gogess_sisfieldconcatena', '', '', 'Concateca campos', '', 1, '', 7, '', '', '-1', '-1', -1, 0, 1, 1, -1, 10, '', -1, -1, '', '', '', '', '', '', 0, 0, ''),
(93, 'gogess_aplication', 'ap_id', 'int', 'Aplicaciones web', '', 1, '', 6, '', '', '', '', 0, 0, 1, 1, 0, 20, '', 0, 0, '', '', 'ap_id,ap_nombre,ap_path,ap_activo', 'order by ap_id desc', '', '', 0, 0, ''),
(95, 'gogess_cseccp', '', '', 'Seccion contenido', '', 1, '', 7, '', '', '', '', 0, 0, 1, 1, 0, 10, '', 0, 0, '', '', '', '', '', '', 0, 0, ''),
(96, 'gogess_contenido', '', '', 'Contenido', '', 1, '', 7, '', '', '', '', 0, 0, 1, 1, 0, 10, '', 0, 0, '', '', '', '', '', '', 0, 0, ''),
(97, 'gogess_areausuarios', 'accw_id', 'int', 'Configuracio acceso usuarios', '', 1, '', 6, '', '', '', '', 0, 0, 1, 1, 0, 20, '', 0, 0, '', '', 'accw_id,tab_id,accw_cusuario', 'order by accw_id desc', '', '', 0, 0, ''),
(98, 'gogess_menuaplicativo', 'menap_id', 'int', 'Menu aplicativo', '', 1, '', 7, '', '', '', '', 0, 0, 1, 1, 0, 30, 'gogess_aplication', 0, 0, '', '', 'menap_id,ap_id,menap_nombre,menap_style,menap_activo', 'order by menap_id desc', '', '', 0, 0, ''),
(99, 'gogess_opcionaplicativo', 'opap_id', 'int', 'Opcion aplicativo', '', 1, '', 7, '', '', '', '', 0, 0, 1, 1, 0, 30, 'gogess_aplication', 0, 0, '', '', 'opap_id,ap_id,opap_nombre,opap_ejecuta,opap_activo,opap_intro', 'order by opap_id desc', '', '', 0, 0, ''),
(100, 'gogess_menuopcion', 'meopap_id', 'int', 'Asignar menu a opcion', '', 1, '', 7, '', '', '', '', 0, 0, 1, 1, 0, 30, '', 0, 0, '', '', '', '', '', '', 0, 0, ''),
(101, 'gogess_itemmenuaplicativo', 'itmenap_id', 'int', 'Item menu aplicativo', '', 1, '', 7, '', '', '', '', 0, 0, 1, 1, 0, 10, '', 0, 0, '', '', '', '', '', '', 0, 0, ''),
(104, 'gogess_accesorapido', 'accesor_id', 'int', 'Acceso rapido', '', 1, '', 7, '', '', '', '', 0, 0, 1, 1, 0, 10, 'gogess_aplication', 0, 0, '', '', '', '', '', '', 0, 0, ''),
(139, 'gogess_reportes', 'repi_id', 'int', 'Reportes', '', 1, '', 43, '', '', '', '', 0, 0, 1, 1, 0, 10, '', 0, 0, '', '', 'repi_id,repi_nombre,', 'order by repi_id desc', '', '', 0, 0, ''),
(147, 'gogess_parametroimenu', 'paraim_id', 'int', 'Parametros Imenu', '', 1, '', 7, '', '', '', '', 0, 0, 1, 1, 0, 10, '', 0, 0, '', '', 'paraim_id,ite_id,paraim_nombre,paraim_tipo', 'order by paraim_id desc', '', '', 0, 0, ''),
(160, 'gogess_automatico', 'auto_id', 'int', 'Automatico', '', 1, '', 6, '', '', '', '', 0, 0, 1, 1, 0, 10, '', 0, 0, '', '', 'auto_id,auto_titulo,id_empresa,tipocmp_codigo,auto_titulo,opcg_id,auto_activo,emp_id,auto_tipo', 'order by auto_id desc', '', '', 0, 0, ''),
(181, 'gogess_correo', 'corre_id', 'int', 'Correo', '', 1, '', 6, '', '', '', '', 0, 0, 1, 1, 0, 10, '', 0, 0, '', '', 'corre_id,corre_email,corre_smtp', 'order by corre_id asc', '', '', 0, 0, ''),
(182, 'gogess_report', 'rept_id', 'int', 'Reporte', '', 1, '', 50, '', '', '', '', 0, 0, 1, 1, 0, 10, '', 0, 0, '', '', 'rept_id,rept_nombre,rept_tipobase,rept_nombrebase', 'order by rept_id desc', '', '', 0, 0, ''),
(184, 'beko_usuario', 'usua_id', 'int', 'Usuarios', '', 1, '', 7, '', '', '', '', 0, 0, 1, 1, 0, 10, 'beko_empresa', 2, 0, '', '', 'usua_id,emp_id,usua_ciruc,usua_nombre,usua_usuario', 'order by usua_id desc', '', '', 0, 0, ''),
(185, 'beko_empresa', 'emp_id', 'int', 'EMPRESA', '', 1, '', 57, '', '', '', '', 0, 0, 1, 1, 0, 10, '', 2, 0, '', '', 'emp_id,emp_ruc,emp_nombre,emp_estado', 'order by emp_id desc', '', '', 0, 0, ''),
(186, 'beko_usuariosperfil', 'per_id', 'int', 'Usuario Perfil', '', 1, '', 7, '', '', '', '', 0, 0, 1, 1, 0, 10, '', 2, 0, '', '', 'per_id,usua_ciruc,per_codobj,per_activo,per_fechamod', 'order by per_id desc', '', '', 0, 0, ''),
(194, 'beko_causascab_vista', 'caucab_id', 'int', 'Causas Vista', '', 1, '', 6, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', 'caucab_id', 'order by caucab_id desc', '', '', 0, 0, ''),
(195, 'beko_usuario_vista', 'usua_id', 'int', 'Usuarios', '', 1, '', 6, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', 'usua_id', 'order by usua_id desc', '', '', 0, 0, ''),
(203, 'beko_capacitacionprestada', 'capapr_id', 'int', 'Capacitaciones prestadas', '', 1, '', 6, '', '', '', '', 0, 0, 1, 1, 0, 30, '', 2, 0, '', '', 'capapr_id,usua_id,capapr_numero,capapr_fechainicio,capapr_fin,capapr_cargahoraria,capapr_nparticipantes', 'order by capapr_id desc', '', '', 0, 0, ''),
(205, 'sth_report', 'rept_id', 'int', 'Crear Reportes', '', 1, '', 58, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', 'rept_id,rept_nombre,rept_activo', 'order by rept_id desc', '', '', 0, 0, ''),
(206, 'beko_tipoemp', 'temp_id', 'int', 'Tipo centro', '', 1, '', 6, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', 'temp_id,temp_nombre,temp_tiempo', 'order by temp_id desc', '', '', 0, 0, ''),
(212, 'beko_establecimiento', 'estbl_id', 'int', 'Establecimiento', '', 1, '', 7, '', '', '', '', 0, 0, 0, 1, 0, 30, 'beko_empresa', 2, 0, '', '', 'estbl_id,emp_id,estbl_codigo,	estbl_nombre,estbl_activo', 'order by estbl_id desc', '', '', 0, 0, ''),
(213, 'beko_puntoemision', 'punto_id', 'int', 'Punto de emisi&oacute;n', '', 1, '', 7, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', 'punto_id,estbl_id,punto_codigo,punto_nombre,punto_activo', 'order by punto_id desc', '', '', 0, 0, ''),
(214, 'beko_producto', 'produ_id', 'int', 'Productos', '', 1, '', 59, '', '', '', '', 0, 0, 1, 1, 0, 30, 'beko_empresa', 2, 0, '', '', 'produ_id,	emp_id,catpr_id,produ_nombre,produ_preciogen,produ_activo', 'order by produ_id desc', '', '', 0, 0, ''),
(215, 'beko_bodega', 'bode_id', 'int', 'Bodega', '', 1, '', 7, '', '', '', '', 0, 0, 0, 1, 0, 30, 'beko_empresa', 2, 0, '', '', 'bode_id,emp_id,bode_nombre', 'order by bode_id desc', '', '', 0, 0, ''),
(216, 'beko_movimiento', 'movi_id', 'int', 'Movimiento Producto', '', 1, '', 6, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', 'movi_id,produ_id,tipmv_id,movi_cantidad,movi_fecha,', 'order by movi_id desc', '', '', 0, 0, ''),
(217, 'beko_movimiento_vista', 'movi_id', 'int', 'Movimiento vista', '', 1, '', 6, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', 'movi_id,produ_id,tipmv_id', 'order by movi_id desc', '', '', 0, 0, ''),
(218, 'beko_usuario_caja', 'fuca_id', 'int', 'Usuario caja', '', 1, '', 60, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', 'fuca_id,usr_cedula,emp_id,estbl_id,punto_id,fuca_activo,fuca_ingreso', 'order by fuca_id desc', '', '', 0, 0, ''),
(219, 'beko_documentocabecera', 'doccab_id', 'string', 'Cabecera Documento', '', 1, '', 6, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', 'doccab_id,emp_id,estaf_id,ambi_valor,emis_valor,tipocmp_codigo,doccab_ndocumento,doccab_fechaemision_cliente', 'order by doccab_id desc', '', '', 0, 1, 'doccab_ndocumento'),
(220, 'beko_impuesto', 'impu_id', 'int', 'Impuesto', '', 1, '', 6, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', 'impu_id,impu_nombre,impu_codigo,impu_bloquea', 'order by impu_id desc', '', '', 0, 0, ''),
(221, 'beko_tarifa', 'tari_id', 'int', 'Tarifa', '', 1, '', 7, '', '', '', '', 0, 0, 0, 1, 0, 30, 'beko_impuesto', 2, 0, '', '', 'tari_id,impu_codigo,tari_nombre,tari_codigo,tari_valor,tari_bloquear', 'order by 	tari_id desc', '', '', 0, 0, ''),
(222, 'beko_documentodetalle', 'docdet_id', 'int', 'Detalle documento', '', 1, '', 7, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', 'docdet_id,doccab_id,docdet_codprincipal,docdet_codaux', 'order by docdet_id desc', '', '', 0, 0, ''),
(224, 'beko_impresion', 'imp_id', 'int', 'Modulo Impresion', '', 1, '', 61, '', '', '', '', 0, 0, 0, 1, 0, 30, 'beko_empresa', 2, 0, '', '', 'imp_id,emp_id,imp_nombre,tipimp_id,imp_activo', 'order by imp_id desc', '', '', 0, 0, ''),
(225, 'beko_impresioncampos', 'impcamp_id', 'int', 'Campos impresion', '', 1, '', 7, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', 'impcamp_id,imp_id,impcamp_campo,ticaimp_idb,impcamp_activo', 'order by 	impcamp_id desc', '', '', 0, 0, ''),
(226, 'beko_registrocaja', 'regisc_id', 'int', 'Registro Caja', '', 1, '', 6, '', '', '', '', 0, 0, 0, 1, 0, 30, '', 2, 0, '', '', 'regisc_id,conc_id,regisc_fechahora,regisc_idfactura,regisc_idrecibo,regisc_concepto,regisc_valor,tipca_id,regisc_moneda,id_usuario,id_usuarioalt,regisc_cerrado', 'order by regisc_id desc', '', '', 0, 0, ''),
(227, 'beko_registrocaja_vista', 'regisc_id', 'int', 'Registro Caja', '', 1, '', 6, '', '', '', '', 0, 0, 1, 1, 0, 30, '', 2, 0, '', '', 'regisc_id', 'order by regisc_id desc', '', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_sisusers`
--

CREATE TABLE IF NOT EXISTS `gogess_sisusers` (
  `sisu_id` bigint(64) NOT NULL,
  `sisu_usu` char(60) DEFAULT 'NULL',
  `sisu_pwd` char(250) DEFAULT 'NULL',
  `sisu_name` char(150) DEFAULT 'NULL',
  `sisu_telefono` char(80) NOT NULL,
  `cod_oficina` int(32) DEFAULT '0',
  `sisu_email` char(200) DEFAULT 'NULL',
  `sys_id` int(32) DEFAULT '0',
  `per_id` int(32) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_sisusers`
--

INSERT INTO `gogess_sisusers` (`sisu_id`, `sisu_usu`, `sisu_pwd`, `sisu_name`, `sisu_telefono`, `cod_oficina`, `sisu_email`, `sys_id`, `per_id`) VALUES
(1, 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'Sistemas', '2900621', -1, 'sistemas-ec@schryver.com', 1, 1),
(2, 'usuario', 'f8032d5cae3de20fcec887f395ec9a6a', 'usuario', '', 0, 'usuario@hotmail.com', 1, 2),
(4, 'digitador1', 'e362cbd36b34a6a36fdf9fccc33593c0', 'Digitador uno', '', 0, 'di@hotmail.com', 0, 3),
(5, 'digitador2', '5402fd2c5285dbbdf20ec83cbaadda4a', 'Digitador dos', '', 0, 'di@hotmail.com', 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_styletable`
--

CREATE TABLE IF NOT EXISTS `gogess_styletable` (
  `st_id` bigint(64) NOT NULL,
  `st_nombre` char(100) DEFAULT 'NULL',
  `st_path` char(250) DEFAULT 'NULL',
  `st_pathweb` char(250) DEFAULT 'NULL',
  `st_timp` text,
  `st_pimp` text
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_styletable`
--

INSERT INTO `gogess_styletable` (`st_id`, `st_nombre`, `st_path`, `st_pathweb`, `st_timp`, `st_pimp`) VALUES
(1, 'Perfiles', 'templateforms/perfil/', '', '', ''),
(2, 'Detalle perfil', 'templateforms/detperfil/', '', '', ''),
(3, 'Tablas', 'templateforms/tablas/', '', '', ''),
(4, 'Campos', 'templateforms/campos/', '', '', ''),
(5, 'Menu Apli', 'templateforms/menu/', '', '', ''),
(6, 'Mestro', 'templateforms/maestro/', 'templateformsweb/maestro/', '', ''),
(7, 'Detalle', 'templateforms/detalle/', 'templateformsweb/detalle/', '', ''),
(8, 'detperfil', 'templateforms/detperfil/', 'templateformsweb/detperfil/', '', ''),
(9, 'maestro_registro', 'templateforms/maestro/', 'templateformsweb/registro_vendedor/', '', ''),
(10, 'detalle_formato', 'templateforms/detalle_formato/', 'templateformsweb/detalle_formato/', '', ''),
(11, 'maestro_reporte', 'templateforms/maestro_reporte/', 'templateformsweb/maestro_reporte/', '', ''),
(18, 'detalle_grid', 'templateforms/detalle_grid/', 'templateformsweb/detalle_grid/', '', ''),
(21, 'maestro_archivo', 'templateforms/maestro_archivo/', 'templateformsweb/maestro_archivo/', '', ''),
(23, 'maestro_suscripcion', 'templateforms/maestro_suscripcion/', 'templateformsweb/maestro_suscripcion/', '', ''),
(24, 'detalleUsuario', 'templateforms/detalleUsuario/', 'templateformsweb/detalleUsuario/', '', ''),
(33, 'detalle_formato', 'templateforms/detalle_formato/', 'templateformsweb/detalle_formato/', '', ''),
(37, 'maestro_carga', 'templateforms/maestro_carga/', 'templateformsweb/maestro_carga/', '', ''),
(47, 'recibos', 'templateforms/recibos/', 'templateformsweb/recibos/', '', ''),
(48, 'maestro_empresa', 'templateforms/maestro_empresa/', 'templateformsweb/maestro_empresa/', '', ''),
(50, 'maestro_standar_report', 'templateforms/maestro_standar_report/', 'templateformsweb/maestro_standar_report/', '', ''),
(57, 'maestro_empresa', 'templateforms/maestro_empresa/', 'templateformsweb/maestro_empresa/', '', ''),
(58, 'maestro_standar_report', 'templateforms/maestro_standar_report/', 'templateformsweb/maestro_standar_report/', '', ''),
(59, 'detalle_producto', 'templateforms/detalle_producto/', 'templateformsweb/detalle_producto/', '', ''),
(60, 'detalle_usuario_caja', 'templateforms/detalle_usuario_caja/', 'templateformsweb/detalle_usuario_caja/', '', ''),
(61, 'detalle_imp', 'templateforms/detalle_imp/', 'templateformsweb/detalle_imp/', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_subgrid`
--

CREATE TABLE IF NOT EXISTS `gogess_subgrid` (
  `subgri_id` bigint(20) NOT NULL,
  `tab_id` int(11) DEFAULT '0',
  `subgri_nameenlace` varchar(100) DEFAULT 'NULL',
  `subgri_campoenlace` varchar(100) DEFAULT 'NULL',
  `subgri_tipoenlace` varchar(100) DEFAULT 'NULL',
  `subgri_campoidts` varchar(100) DEFAULT 'NULL',
  `subgri_tipocampoidts` varchar(100) DEFAULT 'NULL',
  `subgri_nombreenlace` varchar(100) DEFAULT 'NULL',
  `subgri_activo` int(11) DEFAULT '0',
  `subgri_orden` int(11) DEFAULT '0',
  `subgri_filtro` varchar(20) DEFAULT 'NULL',
  `subgri_camposlista` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_subgrid`
--

INSERT INTO `gogess_subgrid` (`subgri_id`, `tab_id`, `subgri_nameenlace`, `subgri_campoenlace`, `subgri_tipoenlace`, `subgri_campoidts`, `subgri_tipocampoidts`, `subgri_nombreenlace`, `subgri_activo`, `subgri_orden`, `subgri_filtro`, `subgri_camposlista`) VALUES
(1, 219, 'beko_documentodetalle', 'doccab_id', 'string', 'docdet_id', 'int', 'FacturaDetalle', 1, 1, '', 'docdet_descripcion,docdet_cantidad,docdet_preciou,docdet_descuento,docdet_total');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_subtabla`
--

CREATE TABLE IF NOT EXISTS `gogess_subtabla` (
  `sub_id` bigint(64) NOT NULL,
  `tab_id` int(32) DEFAULT '0',
  `sub_nameenlace` char(100) DEFAULT 'NULL',
  `sub_campoenlace` char(100) DEFAULT 'NULL',
  `sub_tipoenlace` char(100) DEFAULT 'NULL',
  `sub_nombreenlace` char(100) DEFAULT 'NULL',
  `sub_activo` int(32) DEFAULT '0',
  `sub_orden` int(32) DEFAULT '0',
  `sub_filtro` char(20) DEFAULT 'NULL'
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_subtabla`
--

INSERT INTO `gogess_subtabla` (`sub_id`, `tab_id`, `sub_nameenlace`, `sub_campoenlace`, `sub_tipoenlace`, `sub_nombreenlace`, `sub_activo`, `sub_orden`, `sub_filtro`) VALUES
(1, 1, 'gogess_subtabla', 'tab_id', 'num', 'Subtablas nivel2', 1, 0, ''),
(2, 1, 'gogess_subtablatr', 'tab_id', 'num', 'Subtablas nivel3', 1, 0, ''),
(5, 144, 'ca_lotefacturas', 'em_id', 'num', 'Lotes Factura', 1, 2, ''),
(6, 18, 'mant_contacto', 'provee_ruc', 'str', 'Contactos', 1, 1, ''),
(7, 18, 'mant_tecnico', 'provee_ruc', 'str', 'TÃ©cnico', 1, 2, ''),
(8, 18, 'mant_contrato', 'provee_ruc', 'str', 'Contratos', 1, 3, ''),
(9, 14, 'gogess_detperfil', 'per_id', 'num', 'Detalle perfil', 1, 1, ''),
(10, 1, 'gogess_subgrid', 'tab_id', 'num', 'Grid', 1, 3, ''),
(11, 27, 'mant_elemento', 'actm_id', 'num', 'Elementos', 0, 1, ''),
(12, 24, 'mant_tarea', 'mante_id', 'num', 'Tareas', 0, 1, ''),
(14, 35, 'mant_sucursal', 'institu_id', 'num', 'Sucursales', 1, 1, ''),
(15, 3, 'gogess_ptemplate', 'sys_id', 'num', 'DiseÃ±o', 1, 1, ''),
(16, 3, 'gogess_seccp', 'sys_id', 'num', 'Seccion Contenidos', 1, 2, ''),
(17, 43, 'sgm_producto', 'client_id', 'num', 'PRODUCTOS', 1, 1, ''),
(18, 46, 'sgm_subcategoria', 'categ_id', 'num', 'Sub categorias', 1, 1, ''),
(19, 51, 'gogess_actividad', 'estud_id', 'num', 'Actividad', 1, 1, ''),
(20, 51, 'gogess_cliente', 'estud_id', 'num', 'Usuarios', 1, 2, ''),
(21, 58, 'gogess_tcasos', 'mater_id', 'num', 'Tipo casos', 1, 1, ''),
(22, 77, 'spag_usuarios', 'em_id', 'num', 'Usuarios', 1, 1, ''),
(23, 77, 'spag_recepcionfactura', 'em_id', 'num', 'Recepcion de Facturas (Gratuito)', 0, 2, ''),
(24, 77, 'spag_emisionfactura', 'em_id', 'num', 'Emision factura', 0, 3, ''),
(25, 28, 'ca_cfgempresa', 'em_id', 'num', 'Cfg Empresa', 1, 3, ''),
(28, 3, 'gogess_pmenu', 'sys_id', 'num', 'Menu', 1, 3, ''),
(29, 93, 'gogess_menuaplicativo', 'ap_id', 'num', 'Menu aplicativo', 1, 1, ''),
(30, 93, 'gogess_opcionaplicativo', 'ap_id', 'num', 'Opciones', 1, 2, ''),
(31, 93, 'gogess_accesorapido', 'ap_id', 'num', 'Iconos Acceso rapido', 1, 3, ''),
(32, 144, 'ca_formatoimp', 'em_id', 'num', 'Formato de impresiÃ³n', 1, 3, ''),
(33, 77, 'spag_factura_cabecera', 'em_id', 'num', 'FacturaciÃƒÂ³n', 0, 8, ''),
(34, 6, 'gogess_itemmenu', 'men_id', 'num', 'Item Menu', 1, 1, ''),
(35, 77, 'spag_cfgempresa', 'em_id', 'num', 'Cfg', 1, 9, ''),
(36, 77, 'spag_cliente', 'em_id', 'num', 'Clientes', 1, 10, ''),
(37, 77, 'spag_producto', 'em_id', 'num', 'Productos', 1, 11, ''),
(38, 111, 'notaria_tipodocumento', 'nolib_idlibro', 'num', 'Tipo Documento', 1, 1, ''),
(39, 77, 'spag_caja', 'em_id', 'num', 'Punto de emisi&oacute;n', 1, 12, ''),
(40, 77, 'spag_lotefacturas', 'em_id', 'num', 'Lote numÃƒÂ©rico facturas', 1, 13, ''),
(41, 77, 'spag_formatoimp', 'em_id', 'num', 'Formato de impresion factura', 0, 14, ''),
(42, 77, 'spag_cfgempsistema', 'em_id', 'num', 'Cfg Sistema', 0, 15, ''),
(43, 77, 'spag_cuenta', 'em_id', 'num', 'Productos Proveedores', 1, 16, ''),
(44, 77, 'spag_lotecredito', 'em_id', 'num', 'Lote  numÃƒÂ©rico notas de credito', 1, 14, ''),
(45, 77, 'spag_lotedebito', 'em_id', 'num', 'Lote  numÃƒÂ©rico notas de debito', 1, 15, ''),
(46, 77, 'spag_loteretencion', 'em_id', 'num', 'Lote  numÃƒÂ©rico retenciones', 1, 16, ''),
(47, 130, 'spag_porcentajes', 'id_impuesto', 'num', 'Porcentajes', 1, 1, ''),
(48, 144, 'spag_postulante', 'empr_id', 'num', 'Postulantes', 1, 1, ''),
(49, 28, 'ca_formatoimp', 'em_id', 'num', 'Formato de impresiÃ³n', 1, 1, ''),
(50, 148, 'cobr_telefono', 'clie_id', 'num', 'Telefonos', 1, 1, ''),
(51, 148, 'cobr_direccion', 'clie_id', 'num', 'direccion', 1, 2, ''),
(52, 148, 'cobr_operacion', 'clie_id', 'num', 'Operaciones', 1, 3, ''),
(53, 150, 'cobr_usuario', 'empr_id', 'num', 'Usuario', 1, 1, ''),
(54, 52, 'ca_asignacantidad', 'parament_id', 'num', 'Asignar cantidad', 1, 1, ''),
(55, 156, 'factura_usuario', 'emp_id', 'num', 'Usuario', 1, 1, ''),
(56, 156, 'factura_establecimiento', 'emp_id', 'num', 'Establecimientos', 1, 2, ''),
(62, 184, 'kyr_representante', 'alu_id', 'num', 'Representante', 1, 1, ''),
(63, 184, 'kyr_matricula', 'alu_id', 'num', 'MatrÃ­cula', 1, 2, ''),
(66, 185, 'beko_usuario', 'emp_id', 'num', 'Usuarios', 1, 1, ''),
(69, 187, 'beko_preguntas', 'form_id', 'num', 'Preguntas', 1, 1, ''),
(71, 185, 'beko_establecimiento', 'emp_id', 'num', 'Establecimiento', 1, 2, ''),
(72, 185, 'beko_producto', 'emp_id', 'num', 'Productos', 1, 3, ''),
(73, 185, 'beko_bodega', 'emp_id', 'num', 'Bodega', 1, 4, ''),
(74, 185, 'beko_impresion', 'emp_id', 'num', 'Cfg Impresion', 1, 5, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_subtablatr`
--

CREATE TABLE IF NOT EXISTS `gogess_subtablatr` (
  `subtr_id` bigint(64) NOT NULL,
  `tab_id` int(32) DEFAULT '0',
  `subtr_nameenlace` char(100) DEFAULT 'NULL',
  `subtr_campoenlace` char(100) DEFAULT 'NULL',
  `subtr_tipoenlace` char(100) DEFAULT 'NULL',
  `subtr_nombreenlace` char(100) DEFAULT 'NULL',
  `subtr_activo` int(32) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_subtablatr`
--

INSERT INTO `gogess_subtablatr` (`subtr_id`, `tab_id`, `subtr_nameenlace`, `subtr_campoenlace`, `subtr_tipoenlace`, `subtr_nombreenlace`, `subtr_activo`) VALUES
(1, 22, 'ca_usuarios_perfil', 'us_cedula', 'str', 'Permisos', 1),
(2, 22, 'ca_usuario_caja', 'us_cedula', 'str', 'Perfil Usuario', 1),
(3, 33, 'mant_riesgo', 'evar_id', 'num', 'Riesgo', 0),
(4, 25, 'gogess_gridfunciones', 'subgri_id', 'num', 'Fucniones extras', 1),
(5, 36, 'mant_departamento', 'sucur_id', 'num', 'Departamento', 1),
(6, 44, 'gogess_contenido', 'secp_id', 'num', 'Contenido', 1),
(7, 44, 'gogess_cseccp', 'secp_id', 'num', 'Partes de la secciÃ³n', 1),
(8, 45, 'ca_camposformato', 'forimp_id', 'num', 'Campos', 1),
(10, 53, 'gogess_asistencia', 'activ_id', 'num', 'Registro de asistencia', 1),
(11, 53, 'gogess_calificacion', 'activ_id', 'num', 'Calificaciones', 1),
(12, 2, 'gogess_validaciones', 'fie_id', 'num', 'Validaciones', 1),
(13, 2, 'gogess_sisfieldconcatena', 'fie_id', 'num', 'Concatena campos', 1),
(14, 84, 'spag_cuentapagofac', 'id_pagofacturas', 'num', 'Detalle campos', 1),
(15, 5, 'gogess_pitemmenu', 'menp_id', 'num', 'Item menu', 1),
(17, 98, 'gogess_menuopcion', 'menap_id', 'num', 'Asignacion menu a opciones', 1),
(18, 98, 'gogess_itemmenuaplicativo', 'menap_id', 'num', 'Item Menu', 1),
(20, 117, 'spag_camposformato', 'forimp_id', 'num', 'Campos a mostrar', 1),
(21, 80, 'spag_llavescert', 'usr_cedula', 'str', 'Certificados', 1),
(22, 12, 'gogess_parametroimenu', 'ite_id', 'num', 'Parametros Envio', 1),
(23, 154, 'cobr_usuariocargo', 'us_id', 'num', 'Asignar cargo', 1),
(24, 154, 'cobr_asigusuario', 'us_id', 'num', 'Tipo OperaciÃƒÂ³n asignar', 1),
(25, 158, 'factura_puntoemision', 'estab_id', 'num', 'Punto de emision', 1),
(26, 158, 'factura_lotecredito', 'estab_id', 'num', 'Lote Creditos', 1),
(27, 158, 'factura_lotedebito', 'estab_id', 'num', 'Lote Debitos', 1),
(28, 158, 'factura_loteretencion', 'estab_id', 'num', 'Lote Retenciones', 1),
(29, 158, 'factura_loteguias', 'estab_id', 'num', 'Lote Guias', 1),
(30, 158, 'factura_lotefacturas', 'estab_id', 'num', 'Lote Facturas', 1),
(31, 157, 'factura_cerficado', 'usua_ciruc', 'str', 'Certificado', 1),
(33, 184, 'beko_usuariosperfil', 'usua_id', 'num', 'Perfil', 1),
(34, 189, 'beko_respuesta', 'pregf_id', 'num', 'Respuestas', 1),
(35, 212, 'beko_puntoemision', 'estbl_id', 'num', 'Punto Emisi&oacute;n', 1),
(36, 184, 'beko_usuario_caja', 'usua_id', 'num', 'Usuario Caja', 1),
(37, 220, 'beko_tarifa', 'impu_codigo', 'str', 'Tarifa', 1),
(38, 224, 'beko_impresioncampos', 'imp_id', 'num', 'Campos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_sys`
--

CREATE TABLE IF NOT EXISTS `gogess_sys` (
  `sys_id` bigint(64) NOT NULL,
  `sys_titulo` char(250) DEFAULT 'NULL',
  `sys_detalle` text,
  `sys_pathfavicon` char(250) DEFAULT 'NULL'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_sys`
--

INSERT INTO `gogess_sys` (`sys_id`, `sys_titulo`, `sys_detalle`, `sys_pathfavicon`) VALUES
(1, 'BEKO', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_template`
--

CREATE TABLE IF NOT EXISTS `gogess_template` (
  `tem_id` bigint(64) NOT NULL,
  `tem_nombre` char(150) DEFAULT 'NULL',
  `tem_autor` char(150) DEFAULT 'NULL',
  `tem_detalle` char(250) DEFAULT 'NULL',
  `tem_url` char(250) DEFAULT 'NULL',
  `tem_path` char(250) DEFAULT 'NULL',
  `tem_active` int(32) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_template`
--

INSERT INTO `gogess_template` (`tem_id`, `tem_nombre`, `tem_autor`, `tem_detalle`, `tem_url`, `tem_path`, `tem_active`) VALUES
(1, 'GOGESS - FACTURA', 'GOGESS - FACTURA', 'Administrador', 'www.gogess.com', 'pantalla_maestra/tmp_gogess/', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_tl`
--

CREATE TABLE IF NOT EXISTS `gogess_tl` (
  `tl_id` bigint(64) NOT NULL,
  `tl_etiqueta` char(40) DEFAULT 'NULL'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_tl`
--

INSERT INTO `gogess_tl` (`tl_id`, `tl_etiqueta`) VALUES
(1, 'Tabla Formulario'),
(2, 'Tabla Lista Reportes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_typecmp`
--

CREATE TABLE IF NOT EXISTS `gogess_typecmp` (
  `tyc_id` bigint(64) NOT NULL,
  `tyc_value` char(60) DEFAULT 'NULL',
  `tyc_etiqueta` char(60) DEFAULT 'NULL',
  `tyc_detalle` text
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_typecmp`
--

INSERT INTO `gogess_typecmp` (`tyc_id`, `tyc_value`, `tyc_etiqueta`, `tyc_detalle`) VALUES
(1, 'text', 'Campo texto', ''),
(2, 'textarea', 'Campo texto multi line', ''),
(3, 'select', 'Combo list', ''),
(4, 'password', 'Campo Password', ''),
(5, 'editor', 'Campo Editor', ''),
(6, 'hidden', 'Campo Oculto', ''),
(7, 'hidden2', 'Campo Oculto despliegue datos', ''),
(8, 'hidden3', 'Oculto sin titulo', ''),
(9, 'mail', 'Campo email', ''),
(10, 'fechae', 'Fecha Edad', ''),
(11, 'fecha', 'Campo fecha', ''),
(12, 'checkbox', 'Campo Checkbox', ''),
(13, 'editorsimple', 'Editor BÃƒÂ¡sico', ''),
(14, 'textblock', 'Texto Bloqueado', ''),
(15, 'txtarchivo', 'Campo Archivo', 'Campo para subir archivos'),
(16, 'hora', 'Campo Hora', ''),
(17, 'selectr', 'Campo List actualizable', ''),
(18, 'textblocka', 'Campo Aleatorio', ''),
(19, 'fechahora', 'Campo Fecha y Hora', 'Campo que permite agregar la fecha y la hora'),
(20, 'textnf', 'Campo texto sin formato', 'Campo texto sin formato para tabla.'),
(21, 'selectnf', 'Campo lista sin formato', 'Campo lista sin formato'),
(22, 'checkboxmul', 'Checkbox multiple', 'Check box multiple'),
(23, 'fechasf', 'Fecha sin formato', 'Fecha sin formato'),
(24, 'checkboxsf', 'Checkbox sin formato', 'Checkbox sin formato'),
(25, 'hidden3nf', 'Oculto sin titulo sin formato', 'Oculto sin titulo sin formato'),
(26, 'hidden2nf', 'Campo Oculto despliegue datos sin formato', 'Campo Oculto despliegue datos sin formato'),
(27, 'txtarchivonf', 'Campo archivo sin formato', 'Campo archivo sin formato'),
(28, 'txtarchivover', 'Campo archivo ver', 'Campo archivo ver'),
(29, 'checkboxver', 'Check ver visto', 'Check ver visto'),
(30, 'textareanf', 'Texto multi linea sin formato', 'Texto multi linea sin formato'),
(31, 'selectafecta', 'Campo lista afecta', ''),
(32, 'selectrecibe', 'Campo lista recibe', ''),
(33, 'selectafectarecibe', 'Campo lista afecta y recibe', 'Campo lista afecta y recibe'),
(34, 'hora', 'Campo Hora', ''),
(35, 'sfecha', 'Solo fecha', ''),
(36, 'shora', 'Solo hora', ''),
(37, 'txtarchivografico', 'Archivo Grafico', ''),
(38, 'codigo', 'Campo codigo incremental', ''),
(39, 'selectvalorcero', 'Lista con valor cero', ''),
(40, 'selectbuscador', 'Lista con Buscador', ''),
(41, 'textareablock', 'Campo textarea bloqueado', ''),
(42, 'hidden2num', 'Campo oculto con despliegue de datos numerico', ''),
(43, 'radio', 'campo radio', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_uvic`
--

CREATE TABLE IF NOT EXISTS `gogess_uvic` (
  `uvic_id` bigint(64) NOT NULL,
  `uvic_value` char(100) DEFAULT 'NULL',
  `uvic_etiqueta` char(100) DEFAULT 'NULL'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_uvic`
--

INSERT INTO `gogess_uvic` (`uvic_id`, `uvic_value`, `uvic_etiqueta`) VALUES
(1, 'i', 'Izquierda'),
(2, 'd', 'Derecha'),
(3, 'c', 'Centro'),
(4, 't', 'Top'),
(5, 'p', 'Pie'),
(6, 'pr', 'Proyecto'),
(7, 'n', 'Noticias'),
(8, '1', 'Posicion 1'),
(9, '2', 'Posicion 2'),
(10, '3', 'Posicion 3'),
(11, '4', 'Posicion 4'),
(12, '5', 'Posicion 5'),
(13, '6', 'Posicion 6'),
(14, '7', 'Posicion 7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gogess_validaciones`
--

CREATE TABLE IF NOT EXISTS `gogess_validaciones` (
  `valid_id` int(32) NOT NULL,
  `fie_id` int(32) DEFAULT NULL,
  `prgv_id` int(32) DEFAULT NULL,
  `valid_parametro` char(250) DEFAULT NULL,
  `valid_mensaje_error` char(250) DEFAULT NULL,
  `valid_extradata` text
) ENGINE=InnoDB AUTO_INCREMENT=420 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gogess_validaciones`
--

INSERT INTO `gogess_validaciones` (`valid_id`, `fie_id`, `prgv_id`, `valid_parametro`, `valid_mensaje_error`, `valid_extradata`) VALUES
(1, 16, 1, '9', '', ''),
(2, 68, 1, '9', '', ''),
(3, 1695, 2, 'validar_cedula.php', 'CI ya existe o no es correcta...', ''),
(4, 69, 1, '9', '', ''),
(5, 71, 1, '9', '', ''),
(6, 1708, 1, 'true', 'Campo Obligatorio', ''),
(7, 70, 1, '9', '', ''),
(8, 586, 1, '9', '', ''),
(9, 589, 1, 'true', 'El campo Ruc es obligatorio', ''),
(10, 619, 1, 'true', 'El campo Cedula es obligatorio.', ''),
(11, 619, 4, '11', 'Es permitodo m&aacute;ximo 11 caracteres', ''),
(12, 620, 1, 'true', 'El campo Apellido es obligatorio.', ''),
(13, 1696, 1, 'true', 'Campo Obligatorio', ''),
(14, 619, 2, 'validar_cedula.php', 'C&eacute;dula incorrecta o ya existe', ''),
(15, 621, 1, 'true', 'El campo Nombre es obligatorio.', ''),
(16, 622, 1, 'true', 'El campo Usuario es obligatorio.', ''),
(17, 623, 1, 'true', 'El campo Clave es obligatorio.', ''),
(18, 1695, 1, 'true', 'Campo Obligatorio', ''),
(19, 623, 5, '[8,100]', 'M&iacute;Ã‚Â­nimo 8  caracteres', ''),
(20, 624, 1, 'true', 'El campo Tel&eacute;fono es obligatorio', ''),
(21, 627, 9, 'true', 'Formato email incorrecto', ''),
(22, 627, 1, 'true', 'El campo email es obligatorio', ''),
(23, 628, 1, 'true', 'El campo Cargo es obligatorio', ''),
(24, 629, 1, 'true', 'El campo Sector es obligatorio', ''),
(25, 630, 1, 'true', 'El campo Idioma es obligatorio', ''),
(26, 1697, 1, 'true', 'Campo Obligatorio', ''),
(27, 589, 2, 'validar_ruc_emp.php', 'Ruc incorrecto o ya existe', ''),
(28, 648, 1, 'true', 'Campo obligatorio', ''),
(29, 1698, 9, 'true', 'Formato email incorrecto', ''),
(30, 679, 1, 'true', 'Campo obligatorio', ''),
(31, 686, 1, 'true', 'Campo obligatorio', ''),
(32, 686, 4, '16', 'Maximo 16 digitos', ''),
(33, 690, 1, 'true', 'Campo obligatorio', ''),
(34, 692, 1, 'true', 'Campo obligatorio', ''),
(35, 693, 1, 'true', 'Campo obligatorio', ''),
(36, 691, 1, 'true', 'Campo obligatorio', ''),
(37, 1698, 1, 'true', 'Campo Obligatorio', ''),
(38, 1700, 1, 'true', 'Campo Obligatorio', ''),
(39, 1676, 1, 'true', 'Campo Obligatorio', ''),
(40, 704, 1, 'true', 'Campo obligatorio', ''),
(41, 705, 1, 'true', 'Campo obligatorio', ''),
(42, 701, 1, 'true', 'Campo obligatorio', ''),
(43, 703, 1, 'true', 'Campo obligatorio', ''),
(44, 706, 1, 'true', 'Campo obligatorio', ''),
(45, 707, 1, 'true', 'Campo obligatorio', ''),
(46, 708, 1, 'true', 'Campo obligatorio', ''),
(47, 710, 1, 'true', 'Campo obligatorio', ''),
(48, 590, 1, 'true', 'Este campo debe completarse', ''),
(49, 592, 1, 'true', 'Este campo debe completarse', ''),
(50, 596, 1, 'true', 'Este campo debe completarse', ''),
(51, 606, 1, 'true', 'Este campo debe completarse', ''),
(52, 605, 1, 'true', 'Este campo debe completarse', ''),
(53, 607, 1, 'true', 'Este campo debe completarse', ''),
(54, 614, 1, 'true', 'Este campo debe completarse', ''),
(55, 615, 1, 'true', 'Este campo debe completarse', ''),
(56, 616, 1, 'true', 'Este campo debe completarse', ''),
(57, 598, 1, 'true', 'Este campo debe completarse', ''),
(58, 599, 1, 'true', 'Este campo debe completarse', ''),
(59, 602, 1, 'true', 'Este campo debe completarse', ''),
(60, 601, 1, 'true', 'Este campo debe completarse', ''),
(61, 600, 1, 'true', 'Este campo debe completarse', ''),
(62, 714, 1, 'true', 'Campo obligatorio', ''),
(63, 717, 1, 'true', 'Campo obligatorio', ''),
(64, 719, 1, 'true', 'Campo obligatorio', ''),
(65, 720, 1, 'true', 'Campo obligatorio', ''),
(66, 742, 1, 'true', 'Campo obligatorio', ''),
(67, 818, 9, 'true', 'Formato email erroneo', ''),
(68, 818, 1, 'true', 'Campo obligatorio', ''),
(69, 820, 9, 'true', 'Formato email erroneo', ''),
(70, 824, 9, 'true', 'Formato email erroneo', ''),
(71, 826, 9, 'true', 'Formato email erroneo', ''),
(72, 828, 9, 'true', 'Formato email erroneo', ''),
(74, 830, 9, 'true', 'Formato email erroneo', ''),
(75, 832, 9, 'true', 'Formato email erroneo', ''),
(76, 834, 9, 'true', 'Formato email erroneo', ''),
(77, 817, 1, 'true', 'Campo obligatorio', ''),
(78, 596, 9, 'true', 'Formato email erroneo', ''),
(80, 837, 1, 'true', 'Campo obligatorio', ''),
(81, 848, 1, 'true', 'Campo obligatorio', ''),
(83, 839, 1, 'true', 'Campo Obligatorio', ''),
(84, 841, 1, 'true', 'Campo Obligatorio', ''),
(86, 893, 9, 'true', 'Campo sin formato email', ''),
(87, 889, 11, 'true', 'Formato Fecha', ''),
(88, 885, 2, 'validar_ruc_cliente.php', 'Ruc - Ci incorrecto o cliente ya existe', ''),
(89, 899, 1, 'true', 'Campo obligatorio', ''),
(91, 901, 1, 'true', 'Campo obligatorio', ''),
(92, 902, 1, 'true', 'Campo obligatorio', ''),
(93, 906, 1, 'true', 'Campo Obligatorio', ''),
(94, 909, 1, 'true', 'Campo Obligatorio', ''),
(95, 922, 1, 'true', 'Campo Obligatorio', ''),
(96, 916, 1, 'true', 'Campo Obligatorio', ''),
(97, 925, 1, 'true', 'Campo Obligatorio', ''),
(98, 943, 1, 'true', 'Campo obligatorio', ''),
(99, 1048, 1, 'true', 'Campo Obligatorio', ''),
(100, 1049, 1, 'true', 'Campo Obligatorio', ''),
(101, 1050, 1, 'true', 'Campo Obligatorio', ''),
(102, 1051, 1, 'true', 'Campo Obligatorio', ''),
(103, 1052, 1, 'true', 'Campo Obligatorio', ''),
(104, 1133, 1, 'true', 'Campo obligatorio', ''),
(105, 623, 2, 'validar_clave.php', 'La clave debe tener m&iacute;nimo una mayuscula y un caracter especial', ''),
(106, 856, 2, 'validar_total.php', 'El valor no puede ser menor a 0', ''),
(107, 880, 1, 'true', 'Campo obligatorio', ''),
(110, 1147, 1, 'true', 'Campo Obligatorio', ''),
(111, 1149, 1, 'true', 'Campo Obligatorio', ''),
(112, 881, 1, 'true', 'Campo Obligatorio', ''),
(113, 1143, 1, 'true', 'Campo Obligatorio', ''),
(114, 885, 1, 'true', 'Campo Obligatorio', ''),
(115, 1166, 1, 'true', 'Campo Obligatorio', ''),
(116, 1165, 1, 'true', 'Campo Obligatorio', ''),
(117, 1167, 1, 'true', 'Campo Obligatorio', ''),
(118, 1083, 1, 'true', 'Campo Obligatorio', ''),
(119, 1084, 1, 'true', 'Campo Obligatorio', ''),
(120, 840, 1, 'true', 'Campo Obligatorio', ''),
(121, 1085, 1, 'true', 'Campo Obligatorio', ''),
(122, 849, 1, 'true', 'Campo Obligatorio', ''),
(123, 1267, 1, 'true', 'Campo Obligatorio', ''),
(124, 1237, 1, 'true', 'Campo Obligatorio', ''),
(125, 1253, 1, 'true', 'Campo Obligatorio', ''),
(126, 970, 1, 'true', 'Campo Obligatorio', ''),
(127, 967, 1, 'true', 'Campo Obligatorio', ''),
(128, 969, 1, 'true', 'Campo Obligatorio', ''),
(129, 971, 1, 'true', 'Campo Obligatorio', ''),
(130, 854, 1, 'true', 'Campo Obligatorio', ''),
(131, 1348, 1, 'true', 'Ingresar al menos un detalle para esta factura', ''),
(132, 1386, 1, 'true', 'Ingresar al menos un detalle para este comprobante', ''),
(134, 1412, 1, 'true', 'Ingresar al menos un detalle para esta factura', ''),
(135, 1488, 1, 'true', 'Este campo es obligatorio', ''),
(136, 1489, 1, 'true', 'Campo Obligatorio', ''),
(137, 1491, 1, 'true', 'Campo obligatorio', ''),
(138, 1491, 9, 'true', 'Formato email incorrecto', ''),
(139, 1494, 1, 'true', 'Campo Obligatorio', ''),
(140, 1494, 2, 'validar_cedula.php', 'Cedula Incorrecta', ''),
(141, 1495, 1, 'true', 'Campo Obligatorio', ''),
(142, 1496, 1, 'true', 'Campo Obligatorio', ''),
(143, 1499, 1, 'true', 'Campo Obligatorio', ''),
(144, 1500, 1, 'true', 'Campo Obligatorio', ''),
(145, 1502, 9, 'true', 'Formato email incorrecto', ''),
(146, 1502, 1, 'true', 'Campo Obligatorio', ''),
(147, 1497, 1, 'true', 'Campo Obligatorio', ''),
(148, 1498, 1, 'true', 'El campo Clave es obligatorio', ''),
(149, 1498, 5, '[8,100]', 'MiÃ‚Â­nimo 8  caracteres', ''),
(150, 1528, 1, 'true', 'Campo Obligatorio', ''),
(151, 1529, 1, 'true', 'Campo Obligatorio', ''),
(152, 1570, 2, 'validar_cedula.php', 'Cedula incorrecta', ''),
(153, 1570, 1, 'true', 'Campo Obligatorio', ''),
(154, 1574, 1, 'true', 'Campo Obligatorio', ''),
(155, 1574, 2, 'validar_clave.php', 'La clave debe tener almenos una mayuscula y un numero', ''),
(156, 1571, 1, 'true', 'Campo Obligatorio', ''),
(157, 1590, 9, 'true', 'campo obligatorio', ''),
(158, 1549, 1, 'true', 'campo obligatorio', ''),
(159, 1536, 1, 'true', 'Campo Obligatorio', ''),
(160, 1567, 1, 'true', 'Campo Obligatorio', ''),
(161, 1538, 1, 'true', 'Campo Obligatorio', ''),
(162, 1566, 1, 'true', 'Campo Obligatorio', ''),
(181, 1676, 2, 'validar_cedulabene.php', 'CI ya existe o no es correcta...', 'tipoci_id:function() {return $("#tipoci_id").val();}'),
(182, 1677, 1, 'true', 'Campo Nombre es obligatorio', ''),
(183, 1678, 1, 'true', 'Campo Obligatorio', ''),
(184, 1679, 1, 'true', 'Campo Obligatorio', ''),
(185, 1680, 1, 'true', 'Campo Obligatorio', ''),
(186, 1681, 1, 'true', 'Campo Obligatorio', ''),
(187, 1714, 1, 'true', 'Campo Obligatorio', ''),
(188, 1715, 1, 'true', 'Campo Obligatorio', ''),
(190, 1719, 1, 'true', 'Campo Obligatorio', ''),
(191, 1846, 1, 'true', 'Campo Obligatorio', ''),
(192, 1720, 1, 'true', 'Campo obligatorio', ''),
(193, 1721, 1, 'true', 'Campo obligatorio', ''),
(194, 1722, 1, 'true', 'Campo obligatorio', ''),
(195, 1723, 1, 'true', 'Campo obligatorio', ''),
(196, 1716, 1, 'true', 'Campo obligatorio', ''),
(197, 1731, 1, 'true', 'Campo obligatorio', ''),
(198, 1726, 1, 'true', 'Campo obligatorio', ''),
(199, 1727, 1, 'true', 'Campo obligatorio', ''),
(200, 1728, 1, 'true', 'Campo obligatorio', ''),
(201, 1729, 1, 'true', 'Campo obligatorio', ''),
(202, 1730, 1, 'true', 'Campo obligatorio', ''),
(204, 1926, 1, 'true', 'Campo obligatorio', ''),
(205, 1928, 1, 'true', 'Campo obligatorio', ''),
(206, 1918, 1, 'true', 'Campo obligatorio', ''),
(207, 1917, 1, 'true', 'Campo obligatorio', ''),
(208, 1919, 1, 'true', 'Campo obligatorio', ''),
(209, 1920, 1, 'true', 'Campo obligatorio', ''),
(210, 1921, 1, 'true', 'Campo obligatorio', ''),
(211, 1931, 1, 'true', 'Campo obligatorio', ''),
(212, 1932, 1, 'true', 'Campo obligatorio', ''),
(213, 1933, 1, 'true', 'Campo obligatorio', ''),
(214, 1934, 1, 'true', 'Campo obligatorio', ''),
(215, 1935, 1, 'true', 'Campo obligatorio', ''),
(216, 1937, 9, 'true', 'Correo electrÃ³nico', ''),
(217, 1931, 2, 'validar_ruc_proveedor.php', 'RUC incorrecto o ya existe en el sistema', ''),
(218, 1849, 1, 'true', 'Campo Obligatorio', ''),
(219, 1847, 1, 'true', 'Campo Obligatorio', ''),
(220, 1845, 1, 'true', 'Campo Obligatorio', ''),
(221, 1784, 1, 'true', 'Por favor ingresar un item en la factura', ''),
(222, 1940, 1, 'true', 'Campo Obligatorio', ''),
(223, 1943, 1, 'true', 'Campo Obligatorio', ''),
(224, 1999, 1, 'true', 'Campo obligatorio', ''),
(225, 2003, 1, 'true', 'Campo obligatorio', ''),
(226, 1682, 1, 'true', 'Campo obligatorio', ''),
(227, 1683, 1, 'true', 'Campo obligatorio', ''),
(228, 1684, 1, 'true', 'Campo obligatorio', ''),
(229, 2004, 1, 'true', 'Campo obligatorio', ''),
(230, 2007, 1, 'true', 'Campo obligatorio', ''),
(231, 2013, 1, 'true', 'Campo obligatorio', ''),
(232, 2014, 1, 'true', 'Campo obligatorio', ''),
(233, 2019, 1, 'true', 'Campo obligatorio', ''),
(234, 2023, 1, 'true', 'Campo obligatorio', ''),
(235, 2022, 1, 'true', 'Campo Obligatorio', ''),
(237, 2024, 1, 'true', 'Campo Obligatorio', ''),
(238, 2030, 1, 'true', 'Campo Obligatorio', ''),
(239, 2034, 1, 'true', 'Campo Obligatorio', ''),
(240, 2036, 1, 'true', 'Campo Obligatorio', ''),
(241, 2041, 1, 'true', 'Campo Obligatorio', ''),
(242, 2040, 1, 'true', 'Campo Obligatorio', ''),
(243, 2044, 1, 'true', 'Campo Obligatorio', ''),
(244, 2045, 1, 'true', 'Campo Obligatorio', ''),
(245, 2046, 1, 'true', 'Campo Obligatorio', ''),
(246, 2048, 1, 'true', 'Campo Obligatorio', ''),
(247, 2050, 1, 'true', 'Campo Obligatorio', ''),
(248, 2052, 1, 'true', 'Campo Obligatorio', ''),
(249, 2053, 1, 'true', 'Campo Obligatorio', ''),
(250, 2031, 1, 'true', 'Campo Obligatorio', ''),
(251, 2032, 1, 'true', 'Campo Obligatorio', ''),
(252, 2009, 1, 'true', 'Campo Obligatorio', ''),
(253, 2010, 1, 'true', 'Campo Obligatorio', ''),
(254, 2011, 1, 'true', 'Campo Obligatorio', ''),
(255, 2012, 1, 'true', 'Campo Obligatorio', ''),
(256, 2020, 1, 'true', 'Campo Obligatorio', ''),
(257, 2057, 1, 'true', 'Campo Obligatorio', ''),
(258, 2058, 1, 'true', 'Campo Obligatorio', ''),
(259, 2063, 1, 'true', 'Campo Obligatorio', ''),
(260, 2081, 1, 'true', 'Campo Obligatorio', ''),
(261, 2081, 2, 'validar_ruc_emp.php', 'Ruc incorrecto o ya existe', ''),
(262, 2082, 1, 'true', 'Campo Obligatorio', ''),
(263, 2083, 1, 'true', 'Campo Obligatorio', ''),
(264, 2085, 1, 'true', 'Campo Obligatorio', ''),
(265, 2088, 1, 'true', 'Campo Obligatorio', ''),
(266, 2089, 1, 'true', 'Campo Obligatorio', ''),
(267, 2090, 1, 'true', 'Campo Obligatorio', ''),
(268, 2092, 1, 'true', 'Campo Obligatorio', ''),
(269, 2092, 2, 'validar_cedula.php', 'CI incorrecto o ya existe', ''),
(270, 2095, 1, 'true', 'Campo obligatorio', ''),
(271, 2096, 1, 'true', 'Campo obligatorio', ''),
(272, 2099, 1, 'true', 'Campo obligatorio', ''),
(273, 2100, 1, 'true', 'Campo obligatorio', ''),
(274, 2102, 9, 'true', 'Campo email incorrecto', ''),
(275, 2107, 1, 'true', 'Campo obligatorio', ''),
(276, 2115, 1, 'true', 'Campo obligatorio', ''),
(277, 2117, 1, 'true', 'Campo obligatorio', ''),
(278, 2120, 1, 'true', 'Campo obligatorio', ''),
(279, 2120, 1, 'true', 'Campo obligatorio', ''),
(280, 2123, 1, 'true', 'Campo obligatorio', ''),
(281, 2124, 1, 'true', 'Campo obligatorio', ''),
(282, 2125, 1, 'true', 'Campo obligatorio', ''),
(283, 2614, 1, 'true', 'Campo obligatorio', ''),
(284, 2762, 1, 'true', 'Campo Obligatorio', ''),
(285, 2758, 1, 'true', 'Campo Obligatorio', ''),
(286, 2766, 1, 'true', 'Campo Obligatorio', ''),
(287, 2767, 1, 'true', 'Campo Obligatorio', ''),
(288, 2769, 1, 'true', 'Campo Obligatorio', ''),
(289, 2813, 1, 'true', 'Campo Obligatorio', ''),
(290, 2815, 1, 'true', 'Campo Obligatorio', ''),
(291, 2817, 1, 'true', 'Campo Obligatorio', ''),
(292, 2818, 1, 'true', 'Campo Obligatorio', ''),
(293, 2821, 1, 'true', 'Campo Obligatorio', ''),
(294, 2823, 1, 'true', 'Campo Obligatorio', ''),
(295, 2824, 1, 'true', 'Campo Obligatorio', ''),
(296, 2827, 1, 'true', 'Campo Obligatorio', ''),
(297, 2845, 1, 'true', 'Campo Obligatorio', ''),
(298, 2846, 1, 'true', 'Campo Obligatorio', ''),
(299, 2847, 1, 'true', 'Campo Obligatorio', ''),
(300, 2848, 1, 'true', 'Campo Obligatorio', ''),
(301, 2849, 1, 'true', 'Campo Obligatorio', ''),
(302, 2851, 1, 'true', 'Campo Obligatorio', ''),
(303, 2852, 1, 'true', 'Campo Obligatorio', ''),
(304, 2855, 1, 'true', 'Campo Obligatorio', ''),
(307, 2864, 1, 'true', 'Campo Obligatorio', ''),
(308, 2865, 1, 'true', 'Campo Obligatorio', ''),
(310, 2868, 1, 'true', 'Campo Obligatorio', ''),
(311, 2867, 1, 'true', 'Campo Obligatorio', ''),
(314, 2844, 1, 'true', 'Campo obligatorio', ''),
(315, 2881, 1, 'true', 'Campo obligatorio', ''),
(316, 2889, 1, 'true', 'Campo obligatorio', ''),
(317, 2891, 1, 'true', 'Campo obligatorio', ''),
(318, 2892, 1, 'true', 'Campo obligatorio', ''),
(319, 2894, 1, 'true', 'Campo obligatorio', ''),
(320, 2895, 1, 'true', 'Campo obligatorio', ''),
(321, 2896, 1, 'true', 'Campo obligatorio', ''),
(322, 2897, 1, 'true', 'Campo obligatorio', ''),
(323, 2898, 1, 'true', 'Campo obligatorio', ''),
(324, 2899, 9, 'true', 'Campo Email', ''),
(325, 2899, 1, 'true', 'Campo obligatorio', ''),
(326, 2901, 1, 'true', 'Campo obligatorio', ''),
(327, 2902, 1, 'true', 'Campo obligatorio', ''),
(328, 2910, 1, 'true', 'Campo obligatorio', ''),
(329, 2875, 1, 'true', 'Campo obligatorio', ''),
(330, 2783, 1, 'true', 'Campo obligatorio', ''),
(331, 2772, 1, 'true', 'Campo obligatorio', ''),
(333, 2770, 1, 'true', 'Campo obligatorio', ''),
(334, 2771, 1, 'true', 'Campo obligatorio', ''),
(335, 2780, 1, 'true', 'Campo Obligatorio', ''),
(336, 2796, 1, 'true', 'Campo Obligatorio', ''),
(337, 2797, 1, 'true', 'Campo Obligatorio', ''),
(338, 2809, 1, 'true', 'Campo obligatorio', ''),
(339, 2819, 1, 'true', 'Campo obligatorio', ''),
(340, 2820, 1, 'true', 'Campo obligatorio', ''),
(341, 2825, 1, 'true', 'Campo obligatorio', ''),
(342, 2828, 1, 'true', 'Campo obligatorio', ''),
(343, 2832, 1, 'true', 'Campo obligatorio', ''),
(344, 2833, 1, 'true', 'Campo obligatorio', ''),
(345, 2834, 1, 'true', 'Campo obligatorio', ''),
(346, 2835, 1, 'true', 'Campo obligatorio', ''),
(347, 2838, 1, 'true', 'Campo obligatorio', ''),
(348, 2839, 1, 'true', 'Campo Obligatorio', ''),
(349, 2840, 1, 'true', 'Campo Obligatorio', ''),
(350, 2841, 1, 'true', 'Campo Obligatorio', ''),
(351, 2773, 1, 'true', 'Campo Email', ''),
(352, 2862, 1, 'true', 'Campo Obligatorio', ''),
(353, 2870, 1, 'true', 'Campo Obligatorio', ''),
(354, 2872, 1, 'true', 'Campo Obligatorio', ''),
(355, 2890, 1, 'true', 'Campo obligatorio', ''),
(356, 2915, 1, 'true', 'Campo obligatorio', ''),
(357, 2919, 1, 'true', 'Campo obligatorio', ''),
(358, 2931, 1, 'true', 'Campo obligatorio', ''),
(359, 2954, 1, 'true', 'Campo obligatorio', ''),
(360, 2955, 1, 'true', 'Campo obligatorio', ''),
(361, 2960, 1, 'true', 'Campo obligatorio', ''),
(362, 2962, 1, 'true', 'Campo obligatorio', ''),
(363, 2963, 1, 'true', 'Campo obligatorio', ''),
(364, 2928, 1, 'true', 'Campo obligatorio', ''),
(365, 2969, 1, 'true', 'Campo obligatorio', ''),
(366, 2972, 1, 'true', 'Campo obligatorio', ''),
(367, 2973, 1, 'true', 'Campo obligatorio', ''),
(368, 2970, 1, 'true', 'Campo obligatorio', ''),
(369, 2921, 1, 'true', 'Campo obligatorio', ''),
(370, 2923, 1, 'true', 'Campo obligatorio', ''),
(371, 2987, 1, 'true', 'Campo obligatorio', ''),
(372, 2988, 1, 'true', 'Campo obligatorio', ''),
(373, 2989, 1, 'true', 'Campo obligatorio', ''),
(374, 2991, 1, 'true', 'Campo obligatorio', ''),
(375, 2995, 1, 'true', 'Campo obligatorio', ''),
(376, 3017, 1, 'true', 'Campo obligatorio', ''),
(377, 3018, 1, 'true', 'Campo obligatorio', ''),
(378, 3020, 1, 'true', 'Campo obligatorio', ''),
(379, 3023, 1, 'true', 'Campo obligatorio', ''),
(380, 3024, 1, 'true', 'Campo obligatorio', ''),
(381, 3025, 1, 'true', 'Campo obligatorio', ''),
(382, 3028, 1, 'true', 'Campo obligatorio', ''),
(383, 3029, 1, 'true', 'Campo obligatorio', ''),
(384, 3033, 1, 'true', 'Campo obligatorio', ''),
(385, 3037, 1, 'true', 'Campo obligatorio', ''),
(386, 3039, 1, 'true', 'Campo obligatorio', ''),
(387, 3040, 1, 'true', 'Campo obligatorio', ''),
(388, 3041, 1, 'true', 'Campo obligatorio', ''),
(389, 3045, 1, 'true', 'Campo obligatorio', ''),
(390, 3047, 1, 'true', 'Campo obligatorio', ''),
(391, 3063, 1, 'true', 'Campo obligatorio', ''),
(392, 3062, 1, 'true', 'Campo obligatorio', ''),
(393, 3061, 1, 'true', 'Campo obligatorio', ''),
(394, 3064, 1, 'true', 'Campo obligatorio', ''),
(395, 3078, 1, 'true', 'Campo obligatorio', ''),
(396, 3079, 1, 'true', 'Campo obligatorio', ''),
(397, 3080, 1, 'true', 'Campo obligatorio', ''),
(398, 3081, 1, 'true', 'Campo obligatorio', ''),
(399, 3099, 1, 'true', 'Campo obligatorio', ''),
(400, 3100, 1, 'true', 'Campo obligatorio', ''),
(401, 3102, 1, 'true', 'Campo obligatorio', ''),
(402, 3105, 1, 'true', 'Campo obligatorio', ''),
(403, 3106, 1, 'true', 'Campo obligatorio', ''),
(404, 3141, 1, 'true', 'Debe tener al menos un detalle', ''),
(405, 3145, 1, 'true', 'Campo obligatorio', ''),
(406, 3147, 1, 'true', 'Campo obligatorio', ''),
(407, 3146, 1, 'true', 'Campo obligatorio', ''),
(408, 3148, 1, 'true', 'Campo obligatorio', ''),
(409, 3149, 1, 'true', 'Campo obligatorio', ''),
(410, 3152, 1, 'true', 'Campo obligatorio', ''),
(411, 3153, 1, 'true', 'Campo obligatorio', ''),
(414, 3156, 1, 'true', 'Campo obligatorio', ''),
(415, 3159, 1, 'true', 'Campo obligatorio', ''),
(416, 3167, 1, 'true', 'Campo Obligatorio', ''),
(417, 3161, 1, 'true', 'Campo Obligatorio', ''),
(418, 3165, 1, 'true', 'Campo Obligatorio', ''),
(419, 3166, 1, 'true', 'Campo Obligatorio', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media_provincia`
--

CREATE TABLE IF NOT EXISTS `media_provincia` (
  `prob_id` int(11) NOT NULL,
  `prob_codigo` varchar(25) NOT NULL,
  `prob_nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sth_report`
--

CREATE TABLE IF NOT EXISTS `sth_report` (
  `rept_id` int(11) NOT NULL,
  `rept_aleatunico` varchar(250) NOT NULL,
  `rept_nombre` varchar(250) NOT NULL,
  `rept_activo` int(11) NOT NULL,
  `rept_tabla` text,
  `rept_campos` text,
  `rept_archivopersonalizado` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sth_report`
--

INSERT INTO `sth_report` (`rept_id`, `rept_aleatunico`, `rept_nombre`, `rept_activo`, `rept_tabla`, `rept_campos`, `rept_archivopersonalizado`) VALUES
(1, '', 'REPORTE GENERAL', 1, '', '', ''),
(4, '20160205091438133', 'REPORTE ANUAL', 1, '', '', 'reporte_anual.php'),
(5, '20160301084740102', 'Usuario', 1, '', '', ''),
(6, '171146788420160405072325184', 'Lista facturas', 1, '', '', ''),
(7, '171146788420160405072552266', 'Productos', 1, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sth_reportdetalle`
--

CREATE TABLE IF NOT EXISTS `sth_reportdetalle` (
  `reptdet_id` int(11) NOT NULL,
  `rept_id` int(11) NOT NULL,
  `reptdet_tabla` text,
  `reptdet_campo` text
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sth_reportdetalle`
--

INSERT INTO `sth_reportdetalle` (`reptdet_id`, `rept_id`, `reptdet_tabla`, `reptdet_campo`) VALUES
(13, 1, 'beko_causascab', 'emp_id'),
(16, 1, 'beko_causascab', 'caucab_fechareg'),
(17, 1, 'beko_causascab', 'caucab_nregistro'),
(18, 1, 'beko_causascab', 'caucab_sede'),
(20, 1, 'beko_causascab', 'caucab_fechafin'),
(21, 1, 'beko_causascab', 'caucab_fechainicio'),
(23, 1, 'beko_causascab', 'caucab_codigointerno'),
(24, 5, 'beko_empresa', 'emp_nombre'),
(26, 5, 'beko_empresa', 'emp_telefono'),
(27, 5, 'beko_empresa', 'prob_codigo'),
(28, 5, 'beko_empresa', 'cant_codigo'),
(29, 5, 'beko_empresa', 'temp_id'),
(30, 5, 'beko_empresa', 'emp_nregistro'),
(31, 1, 'beko_empresa', 'emp_nombre'),
(32, 6, 'beko_documentocabecera', 'emp_id'),
(33, 6, 'beko_documentocabecera', 'estaf_id'),
(34, 6, 'beko_documentocabecera', 'ambi_valor'),
(35, 6, 'beko_documentocabecera', 'tipocmp_codigo'),
(36, 6, 'beko_documentocabecera', 'doccab_ndocumento'),
(37, 6, 'beko_documentocabecera', 'doccab_clavedeaccesos'),
(38, 6, 'beko_documentocabecera', 'doccab_rucempresa'),
(39, 7, 'beko_movimiento_vista', 'produ_id'),
(40, 7, 'beko_movimiento_vista', 'produ_nombre'),
(41, 7, 'beko_movimiento_vista', 'tipmv_id'),
(42, 7, 'beko_movimiento_vista', 'tipmv_nombre'),
(43, 7, 'beko_movimiento_vista', 'movi_observacion'),
(44, 7, 'beko_movimiento_vista', 'movi_cantidad'),
(45, 7, 'beko_movimiento_vista', 'movi_fecha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sth_reportenlaces`
--

CREATE TABLE IF NOT EXISTS `sth_reportenlaces` (
  `rptenlc_id` int(11) NOT NULL,
  `rept_id` int(11) NOT NULL,
  `rptenlc_tabla` varchar(250) NOT NULL,
  `rptenlc_campoa` varchar(250) NOT NULL,
  `rptenlc_campob` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sth_reportenlaces`
--

INSERT INTO `sth_reportenlaces` (`rptenlc_id`, `rept_id`, `rptenlc_tabla`, `rptenlc_campoa`, `rptenlc_campob`) VALUES
(2, 1, 'beko_causascab', '', ''),
(3, 5, 'beko_empresa', '', ''),
(4, 1, 'beko_empresa', 'beko_causascab.caucab_id', 'beko_empresa.emp_id'),
(5, 6, 'beko_documentocabecera', '', ''),
(6, 7, 'beko_movimiento_vista', '', '');

-- --------------------------------------------------------

--
-- Estructura para la vista `beko_movimiento_vista`
--
DROP TABLE IF EXISTS `beko_movimiento_vista`;

CREATE  VIEW `beko_movimiento_vista` AS select `beko_movimiento`.`movi_id` AS `movi_id`,`beko_movimiento`.`produ_id` AS `produ_id`,`beko_producto`.`produ_nombre` AS `produ_nombre`,`beko_movimiento`.`tipmv_id` AS `tipmv_id`,`beko_tipomov`.`tipmv_nombre` AS `tipmv_nombre`,`beko_movimiento`.`movi_observacion` AS `movi_observacion`,`beko_movimiento`.`movi_cantidad` AS `movi_cantidad`,`beko_movimiento`.`movi_fecha` AS `movi_fecha`,`beko_movimiento`.`usua_id` AS `usua_id` from ((`beko_movimiento` join `beko_producto` on((`beko_movimiento`.`produ_id` = `beko_producto`.`produ_id`))) join `beko_tipomov` on((`beko_movimiento`.`tipmv_id` = `beko_tipomov`.`tipmv_id`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `beko_registrocaja_vista`
--
DROP TABLE IF EXISTS `beko_registrocaja_vista`;

CREATE  VIEW `beko_registrocaja_vista` AS select `beko_registrocaja`.`regisc_id` AS `regisc_id`,`beko_registrocaja`.`emp_id` AS `emp_id`,`beko_registrocaja`.`regisc_fechahora` AS `regisc_fechahora`,`beko_registrocaja`.`regisc_concepto` AS `regisc_concepto`,`beko_registrocaja`.`regisc_moneda` AS `regisc_moneda`,`beko_registrocaja`.`usua_id` AS `usua_id`,`beko_usuario`.`usua_usuario` AS `usua_usuario`,`beko_registrocaja`.`tipca_id` AS `tipca_id`,`beko_tipocaja`.`tipca_nombre` AS `tipca_nombre`,`beko_registrocaja`.`regisc_valor` AS `regisc_valor`,`beko_registrocaja`.`conc_id` AS `conc_id`,`beko_concepto`.`conc_nombre` AS `conc_nombre`,`beko_registrocaja`.`usua_idalt` AS `usua_idalt`,`beko_registrocaja`.`regisc_cerrado` AS `regisc_cerrado`,`beko_registrocaja`.`regisc_idfactura` AS `regisc_idfactura`,`beko_registrocaja`.`regisc_idrecibo` AS `regisc_idrecibo` from (((`beko_registrocaja` join `beko_concepto` on((`beko_registrocaja`.`conc_id` = `beko_concepto`.`conc_id`))) join `beko_tipocaja` on((`beko_registrocaja`.`tipca_id` = `beko_tipocaja`.`tipca_id`))) join `beko_usuario` on((`beko_registrocaja`.`usua_id` = `beko_usuario`.`usua_id`)));

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beko_ambiente`
--
ALTER TABLE `beko_ambiente`
  ADD PRIMARY KEY (`ambi_id`);

--
-- Indices de la tabla `beko_bodega`
--
ALTER TABLE `beko_bodega`
  ADD PRIMARY KEY (`bode_id`);

--
-- Indices de la tabla `beko_canton`
--
ALTER TABLE `beko_canton`
  ADD PRIMARY KEY (`cant_id`);

--
-- Indices de la tabla `beko_catgproducto`
--
ALTER TABLE `beko_catgproducto`
  ADD PRIMARY KEY (`catpr_id`);

--
-- Indices de la tabla `beko_cliente`
--
ALTER TABLE `beko_cliente`
  ADD PRIMARY KEY (`clie_id`),
  ADD UNIQUE KEY `clie_rucci` (`clie_rucci`);

--
-- Indices de la tabla `beko_concepto`
--
ALTER TABLE `beko_concepto`
  ADD PRIMARY KEY (`conc_id`);

--
-- Indices de la tabla `beko_documentocabecera`
--
ALTER TABLE `beko_documentocabecera`
  ADD PRIMARY KEY (`doccab_id`),
  ADD UNIQUE KEY `doccab_ndocumento` (`doccab_ndocumento`),
  ADD UNIQUE KEY `doccab_clavedeaccesos` (`doccab_clavedeaccesos`);

--
-- Indices de la tabla `beko_documentodetalle`
--
ALTER TABLE `beko_documentodetalle`
  ADD PRIMARY KEY (`docdet_id`),
  ADD KEY `doccab_idindex` (`doccab_id`);

--
-- Indices de la tabla `beko_empdocumento`
--
ALTER TABLE `beko_empdocumento`
  ADD PRIMARY KEY (`empdoc_id`);

--
-- Indices de la tabla `beko_empresa`
--
ALTER TABLE `beko_empresa`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indices de la tabla `beko_establecimiento`
--
ALTER TABLE `beko_establecimiento`
  ADD PRIMARY KEY (`estbl_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indices de la tabla `beko_estado`
--
ALTER TABLE `beko_estado`
  ADD PRIMARY KEY (`estaf_id`);

--
-- Indices de la tabla `beko_historicoing`
--
ALTER TABLE `beko_historicoing`
  ADD PRIMARY KEY (`hiing_id`);

--
-- Indices de la tabla `beko_impresion`
--
ALTER TABLE `beko_impresion`
  ADD PRIMARY KEY (`imp_id`);

--
-- Indices de la tabla `beko_impresioncampos`
--
ALTER TABLE `beko_impresioncampos`
  ADD PRIMARY KEY (`impcamp_id`);

--
-- Indices de la tabla `beko_impuesto`
--
ALTER TABLE `beko_impuesto`
  ADD PRIMARY KEY (`impu_id`);

--
-- Indices de la tabla `beko_movimiento`
--
ALTER TABLE `beko_movimiento`
  ADD PRIMARY KEY (`movi_id`),
  ADD KEY `produ_id` (`produ_id`);

--
-- Indices de la tabla `beko_producto`
--
ALTER TABLE `beko_producto`
  ADD PRIMARY KEY (`produ_id`),
  ADD UNIQUE KEY `produ_codigoserial` (`produ_codigoserial`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indices de la tabla `beko_provincia`
--
ALTER TABLE `beko_provincia`
  ADD PRIMARY KEY (`prob_id`);

--
-- Indices de la tabla `beko_puntoemision`
--
ALTER TABLE `beko_puntoemision`
  ADD PRIMARY KEY (`punto_id`),
  ADD KEY `estbl_id` (`estbl_id`);

--
-- Indices de la tabla `beko_registrocaja`
--
ALTER TABLE `beko_registrocaja`
  ADD PRIMARY KEY (`regisc_id`);

--
-- Indices de la tabla `beko_tarifa`
--
ALTER TABLE `beko_tarifa`
  ADD PRIMARY KEY (`tari_id`);

--
-- Indices de la tabla `beko_tipocaja`
--
ALTER TABLE `beko_tipocaja`
  ADD PRIMARY KEY (`tipca_id`);

--
-- Indices de la tabla `beko_tipocampoimp`
--
ALTER TABLE `beko_tipocampoimp`
  ADD PRIMARY KEY (`ticaimp_id`);

--
-- Indices de la tabla `beko_tipocomprobante`
--
ALTER TABLE `beko_tipocomprobante`
  ADD PRIMARY KEY (`tipocmp_id`);

--
-- Indices de la tabla `beko_tipoemision`
--
ALTER TABLE `beko_tipoemision`
  ADD PRIMARY KEY (`tipoemi_id`);

--
-- Indices de la tabla `beko_tipoemp`
--
ALTER TABLE `beko_tipoemp`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indices de la tabla `beko_tipoimp`
--
ALTER TABLE `beko_tipoimp`
  ADD PRIMARY KEY (`tipimp_id`);

--
-- Indices de la tabla `beko_tipomov`
--
ALTER TABLE `beko_tipomov`
  ADD PRIMARY KEY (`tipmv_id`);

--
-- Indices de la tabla `beko_tipopersonal`
--
ALTER TABLE `beko_tipopersonal`
  ADD PRIMARY KEY (`tipo_id`);

--
-- Indices de la tabla `beko_usuario`
--
ALTER TABLE `beko_usuario`
  ADD PRIMARY KEY (`usua_id`),
  ADD UNIQUE KEY `usua_usuario` (`usua_usuario`),
  ADD UNIQUE KEY `usua_email` (`usua_email`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indices de la tabla `beko_usuariosperfil`
--
ALTER TABLE `beko_usuariosperfil`
  ADD PRIMARY KEY (`per_id`),
  ADD KEY `FK_beko_usuariosperfil` (`usua_id`);

--
-- Indices de la tabla `beko_usuario_caja`
--
ALTER TABLE `beko_usuario_caja`
  ADD PRIMARY KEY (`fuca_id`),
  ADD UNIQUE KEY `usr_cedula` (`usua_id`);

--
-- Indices de la tabla `gogess_aplication`
--
ALTER TABLE `gogess_aplication`
  ADD PRIMARY KEY (`ap_id`);

--
-- Indices de la tabla `gogess_aplicationadm`
--
ALTER TABLE `gogess_aplicationadm`
  ADD PRIMARY KEY (`ap_id`);

--
-- Indices de la tabla `gogess_areausuarios`
--
ALTER TABLE `gogess_areausuarios`
  ADD PRIMARY KEY (`accw_id`);

--
-- Indices de la tabla `gogess_conocimiento`
--
ALTER TABLE `gogess_conocimiento`
  ADD PRIMARY KEY (`cono_id`);

--
-- Indices de la tabla `gogess_datosg`
--
ALTER TABLE `gogess_datosg`
  ADD PRIMARY KEY (`em_id`);

--
-- Indices de la tabla `gogess_detperfil`
--
ALTER TABLE `gogess_detperfil`
  ADD PRIMARY KEY (`detp_id`);

--
-- Indices de la tabla `gogess_iconomenuhome`
--
ALTER TABLE `gogess_iconomenuhome`
  ADD PRIMARY KEY (`iico_id`);

--
-- Indices de la tabla `gogess_instancia`
--
ALTER TABLE `gogess_instancia`
  ADD PRIMARY KEY (`instan_id`);

--
-- Indices de la tabla `gogess_itemmenu`
--
ALTER TABLE `gogess_itemmenu`
  ADD PRIMARY KEY (`ite_id`);

--
-- Indices de la tabla `gogess_itemmenuaplicativo`
--
ALTER TABLE `gogess_itemmenuaplicativo`
  ADD PRIMARY KEY (`itmenap_id`);

--
-- Indices de la tabla `gogess_menu`
--
ALTER TABLE `gogess_menu`
  ADD PRIMARY KEY (`men_id`);

--
-- Indices de la tabla `gogess_menuaplicativo`
--
ALTER TABLE `gogess_menuaplicativo`
  ADD PRIMARY KEY (`menap_id`);

--
-- Indices de la tabla `gogess_menuopcion`
--
ALTER TABLE `gogess_menuopcion`
  ADD PRIMARY KEY (`meopap_id`);

--
-- Indices de la tabla `gogess_objtable`
--
ALTER TABLE `gogess_objtable`
  ADD PRIMARY KEY (`ot_id`);

--
-- Indices de la tabla `gogess_obl`
--
ALTER TABLE `gogess_obl`
  ADD PRIMARY KEY (`obl_id`);

--
-- Indices de la tabla `gogess_opcionaplicativo`
--
ALTER TABLE `gogess_opcionaplicativo`
  ADD PRIMARY KEY (`opap_id`);

--
-- Indices de la tabla `gogess_parametroimenu`
--
ALTER TABLE `gogess_parametroimenu`
  ADD PRIMARY KEY (`paraim_id`);

--
-- Indices de la tabla `gogess_perfil`
--
ALTER TABLE `gogess_perfil`
  ADD PRIMARY KEY (`per_id`);

--
-- Indices de la tabla `gogess_prgvalidar`
--
ALTER TABLE `gogess_prgvalidar`
  ADD PRIMARY KEY (`prgv_id`);

--
-- Indices de la tabla `gogess_ptemplate`
--
ALTER TABLE `gogess_ptemplate`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indices de la tabla `gogess_sess`
--
ALTER TABLE `gogess_sess`
  ADD KEY `gogess_sess_gogess_sess_IX_gogess_sess` (`sess_id`);

--
-- Indices de la tabla `gogess_sino`
--
ALTER TABLE `gogess_sino`
  ADD PRIMARY KEY (`si_id`);

--
-- Indices de la tabla `gogess_sisfield`
--
ALTER TABLE `gogess_sisfield`
  ADD PRIMARY KEY (`fie_id`),
  ADD UNIQUE KEY `gogess_sisfield_fie_name_tab_name_key` (`tab_name`,`fie_name`);

--
-- Indices de la tabla `gogess_sisfieldconcatena`
--
ALTER TABLE `gogess_sisfieldconcatena`
  ADD PRIMARY KEY (`fiecon_id`);

--
-- Indices de la tabla `gogess_sistable`
--
ALTER TABLE `gogess_sistable`
  ADD PRIMARY KEY (`tab_id`),
  ADD UNIQUE KEY `gogess_sistable_tab_name_key` (`tab_name`);

--
-- Indices de la tabla `gogess_sisusers`
--
ALTER TABLE `gogess_sisusers`
  ADD PRIMARY KEY (`sisu_id`);

--
-- Indices de la tabla `gogess_styletable`
--
ALTER TABLE `gogess_styletable`
  ADD PRIMARY KEY (`st_id`);

--
-- Indices de la tabla `gogess_subgrid`
--
ALTER TABLE `gogess_subgrid`
  ADD PRIMARY KEY (`subgri_id`);

--
-- Indices de la tabla `gogess_subtabla`
--
ALTER TABLE `gogess_subtabla`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indices de la tabla `gogess_subtablatr`
--
ALTER TABLE `gogess_subtablatr`
  ADD PRIMARY KEY (`subtr_id`);

--
-- Indices de la tabla `gogess_sys`
--
ALTER TABLE `gogess_sys`
  ADD PRIMARY KEY (`sys_id`);

--
-- Indices de la tabla `gogess_template`
--
ALTER TABLE `gogess_template`
  ADD PRIMARY KEY (`tem_id`);

--
-- Indices de la tabla `gogess_tl`
--
ALTER TABLE `gogess_tl`
  ADD PRIMARY KEY (`tl_id`);

--
-- Indices de la tabla `gogess_typecmp`
--
ALTER TABLE `gogess_typecmp`
  ADD PRIMARY KEY (`tyc_id`);

--
-- Indices de la tabla `gogess_uvic`
--
ALTER TABLE `gogess_uvic`
  ADD PRIMARY KEY (`uvic_id`);

--
-- Indices de la tabla `gogess_validaciones`
--
ALTER TABLE `gogess_validaciones`
  ADD PRIMARY KEY (`valid_id`);

--
-- Indices de la tabla `media_provincia`
--
ALTER TABLE `media_provincia`
  ADD PRIMARY KEY (`prob_id`);

--
-- Indices de la tabla `sth_report`
--
ALTER TABLE `sth_report`
  ADD PRIMARY KEY (`rept_id`),
  ADD UNIQUE KEY `sth_report_rept_aleatunico_key` (`rept_aleatunico`);

--
-- Indices de la tabla `sth_reportdetalle`
--
ALTER TABLE `sth_reportdetalle`
  ADD PRIMARY KEY (`reptdet_id`);

--
-- Indices de la tabla `sth_reportenlaces`
--
ALTER TABLE `sth_reportenlaces`
  ADD PRIMARY KEY (`rptenlc_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `beko_ambiente`
--
ALTER TABLE `beko_ambiente`
  MODIFY `ambi_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `beko_bodega`
--
ALTER TABLE `beko_bodega`
  MODIFY `bode_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `beko_canton`
--
ALTER TABLE `beko_canton`
  MODIFY `cant_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=225;
--
-- AUTO_INCREMENT de la tabla `beko_catgproducto`
--
ALTER TABLE `beko_catgproducto`
  MODIFY `catpr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `beko_cliente`
--
ALTER TABLE `beko_cliente`
  MODIFY `clie_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `beko_concepto`
--
ALTER TABLE `beko_concepto`
  MODIFY `conc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `beko_documentodetalle`
--
ALTER TABLE `beko_documentodetalle`
  MODIFY `docdet_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `beko_empdocumento`
--
ALTER TABLE `beko_empdocumento`
  MODIFY `empdoc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `beko_empresa`
--
ALTER TABLE `beko_empresa`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `beko_establecimiento`
--
ALTER TABLE `beko_establecimiento`
  MODIFY `estbl_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `beko_estado`
--
ALTER TABLE `beko_estado`
  MODIFY `estaf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `beko_historicoing`
--
ALTER TABLE `beko_historicoing`
  MODIFY `hiing_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT de la tabla `beko_impresion`
--
ALTER TABLE `beko_impresion`
  MODIFY `imp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `beko_impresioncampos`
--
ALTER TABLE `beko_impresioncampos`
  MODIFY `impcamp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `beko_impuesto`
--
ALTER TABLE `beko_impuesto`
  MODIFY `impu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `beko_movimiento`
--
ALTER TABLE `beko_movimiento`
  MODIFY `movi_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `beko_producto`
--
ALTER TABLE `beko_producto`
  MODIFY `produ_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `beko_provincia`
--
ALTER TABLE `beko_provincia`
  MODIFY `prob_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `beko_puntoemision`
--
ALTER TABLE `beko_puntoemision`
  MODIFY `punto_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `beko_registrocaja`
--
ALTER TABLE `beko_registrocaja`
  MODIFY `regisc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `beko_tarifa`
--
ALTER TABLE `beko_tarifa`
  MODIFY `tari_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `beko_tipocaja`
--
ALTER TABLE `beko_tipocaja`
  MODIFY `tipca_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `beko_tipocampoimp`
--
ALTER TABLE `beko_tipocampoimp`
  MODIFY `ticaimp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `beko_tipocomprobante`
--
ALTER TABLE `beko_tipocomprobante`
  MODIFY `tipocmp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `beko_tipoemision`
--
ALTER TABLE `beko_tipoemision`
  MODIFY `tipoemi_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `beko_tipoemp`
--
ALTER TABLE `beko_tipoemp`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `beko_tipoimp`
--
ALTER TABLE `beko_tipoimp`
  MODIFY `tipimp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `beko_tipomov`
--
ALTER TABLE `beko_tipomov`
  MODIFY `tipmv_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `beko_tipopersonal`
--
ALTER TABLE `beko_tipopersonal`
  MODIFY `tipo_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `beko_usuario`
--
ALTER TABLE `beko_usuario`
  MODIFY `usua_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `beko_usuariosperfil`
--
ALTER TABLE `beko_usuariosperfil`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `beko_usuario_caja`
--
ALTER TABLE `beko_usuario_caja`
  MODIFY `fuca_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `gogess_aplication`
--
ALTER TABLE `gogess_aplication`
  MODIFY `ap_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `gogess_aplicationadm`
--
ALTER TABLE `gogess_aplicationadm`
  MODIFY `ap_id` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `gogess_areausuarios`
--
ALTER TABLE `gogess_areausuarios`
  MODIFY `accw_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gogess_conocimiento`
--
ALTER TABLE `gogess_conocimiento`
  MODIFY `cono_id` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `gogess_datosg`
--
ALTER TABLE `gogess_datosg`
  MODIFY `em_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gogess_detperfil`
--
ALTER TABLE `gogess_detperfil`
  MODIFY `detp_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gogess_iconomenuhome`
--
ALTER TABLE `gogess_iconomenuhome`
  MODIFY `iico_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gogess_instancia`
--
ALTER TABLE `gogess_instancia`
  MODIFY `instan_id` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `gogess_itemmenu`
--
ALTER TABLE `gogess_itemmenu`
  MODIFY `ite_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT de la tabla `gogess_itemmenuaplicativo`
--
ALTER TABLE `gogess_itemmenuaplicativo`
  MODIFY `itmenap_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT de la tabla `gogess_menu`
--
ALTER TABLE `gogess_menu`
  MODIFY `men_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `gogess_menuaplicativo`
--
ALTER TABLE `gogess_menuaplicativo`
  MODIFY `menap_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `gogess_menuopcion`
--
ALTER TABLE `gogess_menuopcion`
  MODIFY `meopap_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `gogess_objtable`
--
ALTER TABLE `gogess_objtable`
  MODIFY `ot_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `gogess_obl`
--
ALTER TABLE `gogess_obl`
  MODIFY `obl_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `gogess_opcionaplicativo`
--
ALTER TABLE `gogess_opcionaplicativo`
  MODIFY `opap_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `gogess_parametroimenu`
--
ALTER TABLE `gogess_parametroimenu`
  MODIFY `paraim_id` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `gogess_perfil`
--
ALTER TABLE `gogess_perfil`
  MODIFY `per_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gogess_prgvalidar`
--
ALTER TABLE `gogess_prgvalidar`
  MODIFY `prgv_id` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `gogess_ptemplate`
--
ALTER TABLE `gogess_ptemplate`
  MODIFY `temp_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gogess_sino`
--
ALTER TABLE `gogess_sino`
  MODIFY `si_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `gogess_sisfield`
--
ALTER TABLE `gogess_sisfield`
  MODIFY `fie_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3197;
--
-- AUTO_INCREMENT de la tabla `gogess_sisfieldconcatena`
--
ALTER TABLE `gogess_sisfieldconcatena`
  MODIFY `fiecon_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `gogess_sistable`
--
ALTER TABLE `gogess_sistable`
  MODIFY `tab_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=228;
--
-- AUTO_INCREMENT de la tabla `gogess_sisusers`
--
ALTER TABLE `gogess_sisusers`
  MODIFY `sisu_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `gogess_styletable`
--
ALTER TABLE `gogess_styletable`
  MODIFY `st_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de la tabla `gogess_subgrid`
--
ALTER TABLE `gogess_subgrid`
  MODIFY `subgri_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gogess_subtabla`
--
ALTER TABLE `gogess_subtabla`
  MODIFY `sub_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT de la tabla `gogess_subtablatr`
--
ALTER TABLE `gogess_subtablatr`
  MODIFY `subtr_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `gogess_sys`
--
ALTER TABLE `gogess_sys`
  MODIFY `sys_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gogess_template`
--
ALTER TABLE `gogess_template`
  MODIFY `tem_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gogess_tl`
--
ALTER TABLE `gogess_tl`
  MODIFY `tl_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `gogess_typecmp`
--
ALTER TABLE `gogess_typecmp`
  MODIFY `tyc_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `gogess_uvic`
--
ALTER TABLE `gogess_uvic`
  MODIFY `uvic_id` bigint(64) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `gogess_validaciones`
--
ALTER TABLE `gogess_validaciones`
  MODIFY `valid_id` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=420;
--
-- AUTO_INCREMENT de la tabla `media_provincia`
--
ALTER TABLE `media_provincia`
  MODIFY `prob_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sth_report`
--
ALTER TABLE `sth_report`
  MODIFY `rept_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `sth_reportdetalle`
--
ALTER TABLE `sth_reportdetalle`
  MODIFY `reptdet_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `sth_reportenlaces`
--
ALTER TABLE `sth_reportenlaces`
  MODIFY `rptenlc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `beko_establecimiento`
--
ALTER TABLE `beko_establecimiento`
  ADD CONSTRAINT `beko_establecimiento_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `beko_empresa` (`emp_id`);

--
-- Filtros para la tabla `beko_movimiento`
--
ALTER TABLE `beko_movimiento`
  ADD CONSTRAINT `beko_movimiento_ibfk_1` FOREIGN KEY (`produ_id`) REFERENCES `beko_producto` (`produ_id`);

--
-- Filtros para la tabla `beko_producto`
--
ALTER TABLE `beko_producto`
  ADD CONSTRAINT `beko_producto_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `beko_empresa` (`emp_id`);

--
-- Filtros para la tabla `beko_puntoemision`
--
ALTER TABLE `beko_puntoemision`
  ADD CONSTRAINT `beko_puntoemision_ibfk_1` FOREIGN KEY (`estbl_id`) REFERENCES `beko_establecimiento` (`estbl_id`);

--
-- Filtros para la tabla `beko_usuario`
--
ALTER TABLE `beko_usuario`
  ADD CONSTRAINT `beko_usuario_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `beko_empresa` (`emp_id`);

--
-- Filtros para la tabla `beko_usuariosperfil`
--
ALTER TABLE `beko_usuariosperfil`
  ADD CONSTRAINT `FK_beko_usuariosperfil` FOREIGN KEY (`usua_id`) REFERENCES `beko_usuario` (`usua_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
