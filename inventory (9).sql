-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-09-2024 a las 10:36:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventory`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `administradores` (IN `doc_admin` VARCHAR(15), IN `primer_n` VARCHAR(45), IN `segundo_n` VARCHAR(45), IN `primer_a` VARCHAR(45), IN `segundo_a` VARCHAR(45), IN `telefono` VARCHAR(15), IN `correo` VARCHAR(75), IN `direccion` VARCHAR(105), IN `id_configuracion` INT(3))   BEGIN
insert into tbl_administradores (doc_admin, primer_n, segundo_n, primer_a, segundo_a, telefono, correo, direccion, id_configuracion) VALUES (doc_admin, primer_n, segundo_n, primer_a, segundo_a, telefono, correo, direccion, id_configuracion);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `categoria_pd` (IN `nombre_ct` VARCHAR(20), IN `descrip_ct` VARCHAR(100))   BEGIN
insert into tbl_categoria_pd (id_categoria, nombre_ct, descrip_ct, estado_ct) VALUES (NULL, nombre_ct, descrip_ct, 'Activo');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `devoluciones` (IN `motivo_dev` VARCHAR(70), IN `cant_producto` INT(3), IN `cod_producto` VARCHAR(22))   BEGIN
IF cant_producto>0 THEN
insert into tbl_devoluciones (fecha_dev, motivo_dev, cant_producto, cod_producto) VALUES (now(), motivo_dev, cant_producto, cod_producto);
ELSE
	SIGNAL SQLSTATE'45000'
	SET MESSAGE_TEXT='La cantidad no puede ser cero (0)';
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `entradas` (IN `fecha_entrada` DATETIME, IN `total_entrada` INT(7))   BEGIN 
insert into tbl_entradas (fecha_entrada, total_entrada) values (fecha_entrada, total_entrada);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `entradas_productos` (IN `id_entrada` INT(5), IN `cod_producto` VARCHAR(22), IN `cant_pd` INT(5), IN `precio_compra` INT(7), IN `precio_venta` INT(7))   begin
insert into tbl_entradas_productos (id_entrada, cod_producto, cant_pd,precio_compra, precio_venta) values (id_entrada,cod_producto, cant_pd,precio_compra, precio_venta);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pedidos` (IN `fecha_pedido` DATETIME, IN `estado_pedido` VARCHAR(15), IN `fecha_actualizacion_pd` DATETIME, IN `doc_admin` VARCHAR(15))   BEGIN
insert into tbl_pedidos (estado_pedido, fecha_actualizacion_pd, doc_admin) VALUES (estado_pedido, fecha_actualizacion_pd, doc_admin);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pedidos_productos` (IN `id_salida` INT(6), IN `cod_producto` VARCHAR(22), IN `cant_pd` INT(5), IN `precio_compra` INT(7), IN `precio_venta` INT(7))   begin
insert into tbl_pedidos_productos (id_salida,cod_producto,cant_pd,precio_compra,precio_venta) values (NULL,cod_producto,cant_pd,precio_venta,precio_compra);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `productos` (IN `cod_producto` VARCHAR(22), IN `nombre_pd` VARCHAR(30), IN `descrip_pd` VARCHAR(100), IN `precio_compra` INT(7), IN `precio_venta` INT(7), IN `unidades_maximas` INT(5), IN `unidades_minimas` INT(5), IN `unidades_existentes` INT(5), IN `id_categoria` INT, IN `rut_nit_pv` VARCHAR(10))   BEGIN
IF unidades_minimas>unidades_maximas THEN 
	SIGNAL SQLSTATE'45000'
SET MESSAGE_TEXT='Las unidades m�ximas deben ser superiores a las unidades m�nimas';
ELSE
insert into tbl_productos (cod_producto, nombre_pd, descrip_pd, precio_compra, precio_venta, unidades_maximas, unidades_minimas, unidades_existentes, fecha_creacion_pd, fecha_actualizacion_pd, estado_pd, id_categoria, rut_nit_pv) VALUES (cod_producto, nombre_pd, descrip_pd, precio_compra, precio_venta, unidades_maximas, unidades_minimas, unidades_existentes, now(), now(),  'Activo',id_categoria, rut_nit_pv);
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `productos_salidas` (IN `id_salida` INT(5), IN `cod_producto` VARCHAR(22), IN `cant_pd` INT(5), IN `precio_compra` INT(7), IN `precio_venta` INT(7))   begin
insert into tbl_productos_salidas (id_salida,cod_producto,cant_pd,precio_compra,precio_venta) values (id_salida,cod_producto,cant_pd,precio_compra,precio_venta);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proveedores` (IN `rut_nit_pv` VARCHAR(10), IN `nombre_pv` VARCHAR(20), IN `direccion_pv` VARCHAR(105), IN `correo_pv` VARCHAR(75), IN `telefono_pv` VARCHAR(15))   BEGIN
insert into tbl_proveedores (rut_nit_pv, nombre_pv, direccion_pv, correo_pv, telefono_pv, fecha_creacion_pv, fecha_actualizacion_pv, estado_pv) VALUES (rut_nit_pv, nombre_pv, direccion_pv, correo_pv, telefono_pv, now(), now(), 'Activo');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `salidas` (IN `fecha_salida` DATETIME, IN `total_salida` INT(7), IN `rut_nit_cli` VARCHAR(10))   BEGIN 
IF total_salida>0 THEN
insert into tbl_salidas (fecha_salida, total_salida, rut_nit_cli) VALUES (fecha_salida, total_salida, rut_nit_cli);
ELSE
	SIGNAL SQLSTATE'45000'
	SET MESSAGE_TEXT='El total no puede ser 0, ni inferior';
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `supermercados` (IN `rut_nit_cli` VARCHAR(10), IN `nombre_cli` VARCHAR(30), IN `direccion_cli` VARCHAR(105), IN `correo_cli` VARCHAR(75), IN `telefono_cli` VARCHAR(15), IN `fecha_creacion_cli` DATETIME, IN `fecha_actualizacion_cli` DATETIME)   BEGIN
insert into tbl_supermercados (rut_nit_cli, nombre_cli, direccion_cli, correo_cli, telefono_cli, fecha_creacion_cli, fecha_actualizacion_cli) VALUES (rut_nit_cli, nombre_cli, direccion_cli, correo_cli, telefono_cli, fecha_creacion_cli, fecha_actualizacion_cli) ;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_administradores`
--

CREATE TABLE `tbl_administradores` (
  `doc_admin` varchar(15) NOT NULL,
  `primer_n` varchar(45) NOT NULL,
  `segundo_n` varchar(45) NOT NULL,
  `primer_a` varchar(45) NOT NULL,
  `segundo_a` varchar(45) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(75) NOT NULL,
  `direccion` varchar(105) NOT NULL,
  `contraseña` varchar(101) NOT NULL,
  `cambio_contraseña` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `id_configuracion` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_administradores`
--

INSERT INTO `tbl_administradores` (`doc_admin`, `primer_n`, `segundo_n`, `primer_a`, `segundo_a`, `telefono`, `correo`, `direccion`, `contraseña`, `cambio_contraseña`, `estado`, `id_configuracion`) VALUES
('1013339830', 'Victor', 'Manuel', 'Roldán', 'Londoño', '3116277698', 'victorm.roldan@iefedericoozanam.edu.co', 'senactgi', '12345', 0, 'Activo', NULL),
('1013339831', 'Victor', 'Manuel', 'Roldán', 'Londoño', '3116277698', 'victorm.roldan@iefedericoozanam.edu.co', 'senactgi', '12345', 0, 'Activo', NULL),
('1013339832', 'Victor', 'Manuel', 'Roldán', 'Londoño', '3116277698', 'victorm.roldan@iefedericoozanam.edu.co', 'senactgi', '', 0, 'Activo', NULL),
('101333983200', 'aaaa', 'a', 'a', 'a', 'a', 'a', 'az', '12345', 0, 'Activo', NULL),
('1013339837', 'Victor', 'Manuel', 'Roldán', 'Londoño', '3116277698', 'victorm.roldan@iefedericoozanam.edu.co', 'senactgi', '12345', 0, 'Inactivo', NULL),
('1013339837a', 'Victor', 'Manuel', 'Roldán', 'Londoño', '3116277698', 'victorm.roldan@iefedericoozanam.edu.co', 'senactgi', '12345', 0, 'Inactivo', NULL),
('1110365882', 'Juan', 'Jose', 'Isaza', 'Sepulveda', '3107128111', 'juan@gmail.com', 'Calle', '1579', 0, 'Inactivo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria_pd`
--

CREATE TABLE `tbl_categoria_pd` (
  `id_categoria` int(11) NOT NULL,
  `nombre_ct` varchar(20) NOT NULL,
  `descrip_ct` varchar(100) NOT NULL,
  `estado_ct` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_categoria_pd`
--

INSERT INTO `tbl_categoria_pd` (`id_categoria`, `nombre_ct`, `descrip_ct`, `estado_ct`) VALUES
(1, 'Dulce', 'Todos los productos dulces estar?n disponibles aqu?', 'Activo'),
(2, 'Salado', 'Todos los productos salados estar?n disponibles aqu?', 'Activo'),
(12, 'Dulces', 's', 'Inactivo'),
(13, 'jojo', 'a', 'Inactivo'),
(14, 'hector', 'test', 'Inactivo'),
(15, 'hect', 'saa', 'Inactivo'),
(16, 'Hola', 'Ja', 'Inactivo'),
(17, 'test', 'jiji', 'Inactivo');

--
-- Disparadores `tbl_categoria_pd`
--
DELIMITER $$
CREATE TRIGGER `estado_categoria` AFTER UPDATE ON `tbl_categoria_pd` FOR EACH ROW BEGIN
	If new.estado_ct='Inactivo' THEN
update tbl_productos set estado_pd='Inactivo' where tbl_productos.id_categoria=new.id_categoria;
end if;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_configuracion`
--

CREATE TABLE `tbl_configuracion` (
  `id_configuracion` int(3) NOT NULL,
  `idioma` varchar(15) NOT NULL,
  `color_fondo` varchar(10) NOT NULL,
  `opcion_alertas` varchar(15) NOT NULL,
  `tipo_moneda` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_devoluciones`
--

CREATE TABLE `tbl_devoluciones` (
  `id_devolucion` int(5) NOT NULL,
  `fecha_dev` datetime NOT NULL,
  `motivo_dev` varchar(70) NOT NULL,
  `cant_producto` int(3) NOT NULL,
  `cod_producto` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_devoluciones`
--

INSERT INTO `tbl_devoluciones` (`id_devolucion`, `fecha_dev`, `motivo_dev`, `cant_producto`, `cod_producto`) VALUES
(3, '2023-11-21 23:46:00', '5', 20, '12101');

--
-- Disparadores `tbl_devoluciones`
--
DELIMITER $$
CREATE TRIGGER `devoluciones_productos` AFTER INSERT ON `tbl_devoluciones` FOR EACH ROW begin
UPDATE tbl_productos SET unidades_existentes=unidades_existentes - new.cant_producto WHERE cod_producto=new.cod_producto; 
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_entradas`
--

CREATE TABLE `tbl_entradas` (
  `id_entrada` int(5) NOT NULL,
  `fecha_entrada` datetime NOT NULL,
  `total_entrada` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_entradas`
--

INSERT INTO `tbl_entradas` (`id_entrada`, `fecha_entrada`, `total_entrada`) VALUES
(1, '2024-09-08 17:02:17', 8500),
(2, '2024-09-08 17:25:46', 206500),
(3, '2024-09-08 21:56:32', 3500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_entradas_productos`
--

CREATE TABLE `tbl_entradas_productos` (
  `id_entrada` int(5) DEFAULT NULL,
  `cod_producto` varchar(22) DEFAULT NULL,
  `cant_pd` int(5) NOT NULL,
  `precio_compra` int(7) NOT NULL,
  `precio_venta` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_entradas_productos`
--

INSERT INTO `tbl_entradas_productos` (`id_entrada`, `cod_producto`, `cant_pd`, `precio_compra`, `precio_venta`) VALUES
(1, '142345677', 1, 3000, 3500),
(1, '987654321', 2, 2000, 2500),
(2, '142345677', 59, 3000, 3500),
(3, '142345677', 1, 3000, 3500);

--
-- Disparadores `tbl_entradas_productos`
--
DELIMITER $$
CREATE TRIGGER `entradas_productos` AFTER INSERT ON `tbl_entradas_productos` FOR EACH ROW begin
UPDATE tbl_productos 
    SET unidades_existentes = unidades_existentes+ NEW.cant_pd WHERE cod_producto = NEW.cod_producto; 
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_passwords`
--

CREATE TABLE `tbl_passwords` (
  `id_password` int(3) NOT NULL,
  `password` varchar(101) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `password_antigua` varchar(101) NOT NULL,
  `doc_admin` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pedidos`
--

CREATE TABLE `tbl_pedidos` (
  `id_pedido` int(6) NOT NULL,
  `fecha_pedido` datetime NOT NULL,
  `estado_pedido` varchar(15) NOT NULL,
  `fecha_actualizacion_ped` datetime NOT NULL,
  `doc_admin` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pedidos_productos`
--

CREATE TABLE `tbl_pedidos_productos` (
  `id_pedido` int(6) DEFAULT NULL,
  `cod_producto` varchar(22) DEFAULT NULL,
  `cant_pd` int(5) NOT NULL,
  `precio_venta` int(7) NOT NULL,
  `precio_compra` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `cod_producto` varchar(22) NOT NULL,
  `nombre_pd` varchar(30) NOT NULL,
  `descrip_pd` varchar(100) NOT NULL,
  `precio_compra` int(7) NOT NULL,
  `precio_venta` int(7) NOT NULL,
  `unidades_maximas` int(5) NOT NULL,
  `unidades_minimas` int(5) NOT NULL,
  `unidades_existentes` int(5) NOT NULL,
  `fecha_creacion_pd` datetime NOT NULL,
  `fecha_actualizacion_pd` datetime NOT NULL,
  `estado_pd` varchar(10) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `rut_nit_pv` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`cod_producto`, `nombre_pd`, `descrip_pd`, `precio_compra`, `precio_venta`, `unidades_maximas`, `unidades_minimas`, `unidades_existentes`, `fecha_creacion_pd`, `fecha_actualizacion_pd`, `estado_pd`, `id_categoria`, `rut_nit_pv`) VALUES
('1200', 'testttttttt', '1451', 222, 8755, 145, 70, 112, '2024-07-09 22:07:46', '2024-09-08 22:10:19', 'Inactivo', 1, '925487'),
('12000', 'test', '1451', 222, 8755, 145, 145, 110, '2024-06-25 09:23:23', '2024-06-26 10:53:24', 'Inactivo', 14, '945654123'),
('12000000000000000', '1', '1451', 222, 8755, 145, 100, 150, '2024-06-25 07:57:50', '2024-09-08 16:00:38', 'Inactivo', 2, '925487'),
('12001', '1', '1451', 222, 8755, 145, 145, 111, '2024-06-25 08:37:52', '2024-06-25 08:38:04', 'Inactivo', 2, '945654123'),
('12005', '1', '1451', 222, 8755, 145, 145, 111, '2024-06-25 08:37:06', '2024-06-25 08:37:06', 'Activo', 2, '945654123'),
('12009', 'test', '1451', 222, 8755, 145, 145, 111, '2024-06-25 09:26:56', '2024-06-25 09:26:56', 'Inactivo', 13, '945654123'),
('120094', 'JAJAAJ', '1451', 222, 8755, 170, 140, 155, '2024-07-08 08:52:22', '2024-09-08 16:00:11', 'Activo', 1, '925487'),
('12022', 'JAJAAJ', '1451', 222, 8755, 145, 40, 112, '2024-08-02 11:25:25', '2024-09-08 16:00:56', 'Inactivo', 1, '925487'),
('12023', 'JAJAAJ', '1451', 222, 8755, 145, 145, 111, '2024-08-02 11:47:15', '2024-08-02 11:47:15', 'Inactivo', 15, '987674421'),
('12024', 'JAJAAJ', '1451', 222, 8755, 145, 145, 111, '2024-09-08 23:31:30', '2024-09-08 23:31:30', 'Activo', 1, '987674421'),
('12025', 'testGuillermo', '1451', 222, 8755, 20, 16, 18, '2024-08-16 10:32:08', '2024-09-08 13:31:01', 'Activo', 1, '925487'),
('12101', 'Ripio', 'prueba2', 5000, 5600, 60, 50, 55, '2023-10-03 22:40:23', '2023-11-24 01:06:51', 'Activo', 2, '987673341'),
('12103', 'aaa', 'aaa', 1200, 1300, 30, 15, 25, '2024-02-29 06:54:29', '2024-09-08 15:59:31', 'Activo', 1, '925487'),
('12229', 'prueba', 'aa', 12, 13, 456, 444, 444, '2023-10-03 22:40:23', '2023-11-23 13:34:43', 'Activo', 1, '9475956123'),
('122345987', 'Pandeyuca', 'x10 uds', 3000, 3600, 60, 50, 56, '2023-10-03 22:40:23', '2023-10-03 22:40:23', 'Activo', 2, '945654123'),
('123445638', 'Galleta cuca', 'x6 uds', 3500, 4000, 60, 50, 57, '2023-10-03 22:40:23', '2023-10-03 22:40:23', 'Activo', 1, '9475956123'),
('123455678', 'Pullpancito', 'x36 uds', 3200, 4000, 60, 50, 55, '2023-10-03 22:40:23', '2023-10-03 22:40:23', 'Activo', 2, '9876715942'),
('123456381', 'Rosquillas', 'x5 uds', 3500, 4000, 60, 50, 55, '2023-10-03 22:40:23', '2023-10-03 22:40:23', 'Inactivo', 2, '987651571'),
('123456777', 'Mini Croissant', 'x18 uds', 2000, 2500, 60, 50, 56, '2023-10-03 22:40:23', '2023-10-03 22:40:23', 'Activo', 2, '987654321'),
('123456780', 'Palitos', 'x5 uds', 2000, 2500, 60, 50, 57, '2023-10-03 22:40:23', '2023-10-03 22:40:23', 'Activo', 2, '987654321'),
('123456787', 'Croissant', 'x6 uds', 2000, 2500, 60, 50, 55, '2023-10-03 22:40:23', '2023-10-03 22:40:23', 'Activo', 2, '987654321'),
('123456788', 'Mini Croissant', 'x25 uds', 2000, 2500, 60, 50, 55, '2023-10-03 22:40:23', '2023-10-03 22:40:23', 'Activo', 2, '987654321'),
('123456789', 'Rolloss', 'x5 uds', 2000, 2500, 60, 50, 54, '2023-10-03 22:40:23', '2023-11-10 09:35:15', 'Activo', 1, '987654321'),
('123456987', 'Pastel de Guayaba', 'x15 uds', 3200, 3600, 60, 50, 54, '2023-10-03 22:40:23', '2023-11-22 22:56:11', 'Activo', 1, '9475956123'),
('123654479', 'Panelitas', 'x10 uds', 1900, 2000, 60, 50, 67, '2023-10-03 22:40:23', '2024-09-07 23:29:52', 'Activo', 1, '925487'),
('123654789', 'Piononos', 'x6 uds', 2000, 2500, 65, 50, 126, '2023-10-03 22:40:23', '2024-09-08 09:44:26', 'Activo', 1, '925487'),
('126345677', 'Caladitas', 'x30 uds', 2000, 2500, 60, 50, 52, '2023-10-03 22:40:23', '2023-10-03 22:40:23', 'Activo', 2, '9876715942'),
('142345677', 'Ripio', 'x350 gr', 3000, 3500, 60, 50, 117, '2023-10-03 22:40:23', '2024-09-08 13:32:05', 'Activo', 2, '925487'),
('17345677', 'Tost?n', 'x20 uds', 2000, 2500, 60, 50, 55, '2023-10-03 22:40:23', '2023-10-03 22:40:23', 'Activo', 2, '9876715942'),
('211456789', 'Blanqueados', 'x10 uds', 2000, 2500, 60, 50, 70, '2023-10-03 22:40:23', '2023-10-03 22:40:23', 'Activo', 1, '925487'),
('321456789', 'Pastel de Arequipe', 'x15 uds', 3000, 3400, 60, 50, 55, '2023-10-03 22:40:23', '2023-10-03 22:40:23', 'Activo', 1, '9475956123'),
('987654321', 'Peras', 'x8 uds', 2000, 2500, 60, 50, 67, '2023-10-03 22:40:23', '2023-10-03 22:40:23', 'Activo', 1, '925487');

--
-- Disparadores `tbl_productos`
--
DELIMITER $$
CREATE TRIGGER `productos_agotados` AFTER UPDATE ON `tbl_productos` FOR EACH ROW begin 
if new.unidades_existentes=0 THEN
INSERT INTO tbl_productos_agotados (id_productos_agotados, nombre_pd, descripcion_pd_a,fecha_ag, cod_producto) values (NULL, new.nombre_pd,'Producto agotado', now(),new.cod_producto); 
else 
if new.unidades_existentes<new.unidades_minimas then
	INSERT INTO tbl_productos_agotados (id_productos_agotados, nombre_pd, descripcion_pd_a,fecha_ag, cod_producto) values (NULL, new.nombre_pd,'Producto próximo a agotarse', now(),new.cod_producto); 
end if; 
end if;
if new.estado_pd='Inactivo' THEN
	delete from tbl_productos_agotados where cod_producto=new.cod_producto;
 end if;
 if new.unidades_existentes>new.unidades_minimas THEN
  DELETE FROM tbl_productos_agotados where cod_producto=new.cod_producto;
end if;
update tbl_productos_agotados set nombre_pd=new.nombre_pd where cod_producto=new.cod_producto;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos_agotados`
--

CREATE TABLE `tbl_productos_agotados` (
  `id_productos_agotados` int(5) NOT NULL,
  `nombre_pd` varchar(30) DEFAULT NULL,
  `descripcion_pd_a` varchar(100) NOT NULL,
  `fecha_ag` datetime NOT NULL,
  `cod_producto` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos_salidas`
--

CREATE TABLE `tbl_productos_salidas` (
  `id_salida` int(5) DEFAULT NULL,
  `cod_producto` varchar(22) DEFAULT NULL,
  `cant_pd` int(5) NOT NULL,
  `precio_compra` int(7) NOT NULL,
  `precio_venta` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_productos_salidas`
--

INSERT INTO `tbl_productos_salidas` (`id_salida`, `cod_producto`, `cant_pd`, `precio_compra`, `precio_venta`) VALUES
(1, '123654479', 1, 1900, 2000),
(2, '123654479', 1, 1900, 2000),
(3, '123654789', 1, 2000, 2500),
(4, '123456789', 1, 2000, 2500),
(4, '123456987', 2, 3200, 3600),
(4, '126345677', 1, 2000, 2500),
(5, '12229', 1, 12, 13),
(6, '123654789', 5, 2000, 2500);

--
-- Disparadores `tbl_productos_salidas`
--
DELIMITER $$
CREATE TRIGGER `salidas_productos` AFTER INSERT ON `tbl_productos_salidas` FOR EACH ROW begin
UPDATE tbl_productos SET unidades_existentes=unidades_existentes-new.cant_pd WHERE cod_producto=new.cod_producto; 
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proveedores`
--

CREATE TABLE `tbl_proveedores` (
  `rut_nit_pv` varchar(10) NOT NULL,
  `nombre_pv` varchar(20) NOT NULL,
  `direccion_pv` varchar(105) NOT NULL,
  `correo_pv` varchar(75) NOT NULL,
  `telefono_pv` varchar(15) NOT NULL,
  `fecha_creacion_pv` datetime NOT NULL,
  `fecha_actualizacion_pv` datetime NOT NULL,
  `estado_pv` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_proveedores`
--

INSERT INTO `tbl_proveedores` (`rut_nit_pv`, `nombre_pv`, `direccion_pv`, `correo_pv`, `telefono_pv`, `fecha_creacion_pv`, `fecha_actualizacion_pv`, `estado_pv`) VALUES
('111111', 'a', 'aaa', 'aaaaaa@gmail.com', '1111111111', '2024-08-02 11:28:40', '2024-08-02 11:28:40', 'Activo'),
('123456', 'TEST', 'sena', 'aaaa@gmail.com', '1234556788', '2024-06-25 09:02:10', '2024-06-25 09:02:10', 'Activo'),
('123654', 'as', 'si', 'hola@gmail.com', '3116277698', '2023-11-24 00:49:53', '2024-06-25 00:12:14', 'Activo'),
('917643321', 'Snacks', 'transversal31#41-20', 'ssa@hotmail.com', '3107546124', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Inactivo'),
('925487', 'Aguadas', 'carrera80#40-02', 'agu@hotmail.com', '3107588774', '2023-10-03 22:39:47', '2023-11-24 01:25:36', 'Activo'),
('945654123', 'Pandapan', 'carrera31#88-40', 'pandapan@gmail.com', '3104588438', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo'),
('9475956123', 'Rikipan', 'calle31#80-40', 'rikipan@gmail.com', '3107588459', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo'),
('975144384', 'Tifanny', 'medellin31#80-40', 'ripio@gmail.com', '3107288159', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo'),
('981047721', 'Comamas', 'calle10#35-47', 'cmas@hotmail.com', '3107598724', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo'),
('982657421', 'Pool', 'calle31#17-32', 'pool@gmail.com', '3107551474', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo'),
('984315321', 'Gustam?s', 'medellin31#80-40', 'gg@gmail.com', '3107588774', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo'),
('985210348', 'Rollitos', 'calle41#40-21', 'rollos@gmail.com', '3101586374', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo'),
('987187451', 'Full pan', 'calle41#47-30', 'fpan@gmail.com', '3107588774', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo'),
('9875937321', 'Margarita', 'medellin80#40-40', 'marg@gmail.comm', '3107542774', '2023-10-03 22:39:47', '2024-06-25 09:27:26', 'Activo'),
('987615421', 'Postobon', 'carrera45#24-18', 'pst@gmail.com', '3106418774', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo'),
('9876504321', 'Paisa pan', 'carrera52#75-10', 'paisap@gmail.com', '3137517774', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo'),
('987651571', 'Bunga bunga', 'calle10#48-63', 'bsnacks@gmail.com', '3101634774', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Inactivo'),
('987654321', 'El Paisa', 'medellin31#80-40', 'elpaisa@gmail.com', '3107588774', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo'),
('9876715942', 'Pull pan', 'carrera37#68-44', 'pullpan@gmail.com', '3107438452', '2023-10-03 22:39:47', '2023-11-23 12:50:01', 'Activo'),
('987673341', 'Ricas fritas', 'cra45#78-91', 'rpapas@hotmail.com', '3107588774', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo'),
('987674421', 'Fritolay', 'calle51#30-14', 'fritos@gmail.com', '3107588774', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo'),
('987987734', 'Alpina', 'Calle40a#38-45', 'alpina@gmail.com', '3144107674', '2023-10-03 22:39:47', '2023-10-03 22:39:47', 'Activo');

--
-- Disparadores `tbl_proveedores`
--
DELIMITER $$
CREATE TRIGGER `estado_proveedor` AFTER UPDATE ON `tbl_proveedores` FOR EACH ROW BEGIN
	If new.estado_pv='Inactivo' THEN
update tbl_productos set estado_pd='Inactivo' where tbl_productos.rut_nit_pv=new.rut_nit_pv;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_salidas`
--

CREATE TABLE `tbl_salidas` (
  `id_salida` int(5) NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `total_salida` int(7) NOT NULL,
  `rut_nit_cli` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_salidas`
--

INSERT INTO `tbl_salidas` (`id_salida`, `fecha_salida`, `total_salida`, `rut_nit_cli`) VALUES
(1, '2024-09-08 21:23:33', 2000, '123450'),
(2, '2024-09-08 21:48:29', 2000, '123450'),
(3, '2024-09-08 21:48:43', 2500, '123456'),
(4, '2024-09-08 21:55:05', 12200, '123456'),
(5, '2024-09-08 21:55:56', 13, '987659'),
(6, '2024-09-09 01:47:02', 12500, '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_supermercados`
--

CREATE TABLE `tbl_supermercados` (
  `rut_nit_cli` varchar(10) NOT NULL,
  `nombre_cli` varchar(30) NOT NULL,
  `direccion_cli` varchar(105) NOT NULL,
  `correo_cli` varchar(75) NOT NULL,
  `telefono_cli` varchar(15) NOT NULL,
  `fecha_creacion_cli` datetime NOT NULL,
  `fecha_actualizacion_cli` datetime NOT NULL,
  `estado_cli` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_supermercados`
--

INSERT INTO `tbl_supermercados` (`rut_nit_cli`, `nombre_cli`, `direccion_cli`, `correo_cli`, `telefono_cli`, `fecha_creacion_cli`, `fecha_actualizacion_cli`, `estado_cli`) VALUES
('1', 'Prueba', 'sena', 'hola@gmail.com', '1111111111', '2024-03-06 14:57:36', '2024-06-25 00:23:00', 'Inactivo'),
('123450', 'MIL VARIEDADES', 'senactgi', 'hola@gmail.com', '3116277698', '2024-06-25 09:02:51', '2024-09-08 18:36:56', 'Activo'),
('123452', 'Victor Manuel', 'senactgi', 'hola@gmail.com', '3116277698', '2024-08-02 11:31:15', '2024-08-02 11:31:21', 'Inactivo'),
('123456', 'LA 80', 'senactgi', 'victorm.roldan@iefedericoozanam.edu.co', '3116277698', '2024-06-24 23:24:45', '2024-09-08 18:37:11', 'Activo'),
('123457', 'TEST', 'senactgi', 'hola@gmail.com', '3116277698', '2024-06-25 09:29:04', '2024-06-25 09:29:29', 'Inactivo'),
('123459', 'SUPERM OR', 'senactgi', 'hola@gmail.com', '3116277698', '2024-06-26 10:51:32', '2024-09-08 18:41:01', 'Activo'),
('321765', 'DINASTÍA', 'Test', 'Test@gm.co', '0000000000', '2024-06-25 01:43:52', '2024-09-08 18:37:03', 'Activo'),
('987659', 'TEST', 'senactgi', 'hola@gmail.com', '3116277698', '2024-09-08 18:40:15', '2024-09-08 18:40:34', 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_administradores`
--
ALTER TABLE `tbl_administradores`
  ADD PRIMARY KEY (`doc_admin`),
  ADD KEY `id_configuracion` (`id_configuracion`);

--
-- Indices de la tabla `tbl_categoria_pd`
--
ALTER TABLE `tbl_categoria_pd`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tbl_configuracion`
--
ALTER TABLE `tbl_configuracion`
  ADD PRIMARY KEY (`id_configuracion`);

--
-- Indices de la tabla `tbl_devoluciones`
--
ALTER TABLE `tbl_devoluciones`
  ADD PRIMARY KEY (`id_devolucion`),
  ADD KEY `cod_producto` (`cod_producto`);

--
-- Indices de la tabla `tbl_entradas`
--
ALTER TABLE `tbl_entradas`
  ADD PRIMARY KEY (`id_entrada`);

--
-- Indices de la tabla `tbl_entradas_productos`
--
ALTER TABLE `tbl_entradas_productos`
  ADD KEY `id_entrada` (`id_entrada`),
  ADD KEY `cod_producto` (`cod_producto`);

--
-- Indices de la tabla `tbl_passwords`
--
ALTER TABLE `tbl_passwords`
  ADD PRIMARY KEY (`id_password`),
  ADD KEY `doc_admin` (`doc_admin`);

--
-- Indices de la tabla `tbl_pedidos`
--
ALTER TABLE `tbl_pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `doc_admin` (`doc_admin`);

--
-- Indices de la tabla `tbl_pedidos_productos`
--
ALTER TABLE `tbl_pedidos_productos`
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `cod_producto` (`cod_producto`);

--
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`cod_producto`),
  ADD KEY `rut_nit_pv` (`rut_nit_pv`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `tbl_productos_agotados`
--
ALTER TABLE `tbl_productos_agotados`
  ADD PRIMARY KEY (`id_productos_agotados`),
  ADD KEY `cod_producto` (`cod_producto`);

--
-- Indices de la tabla `tbl_productos_salidas`
--
ALTER TABLE `tbl_productos_salidas`
  ADD KEY `id_salida` (`id_salida`),
  ADD KEY `cod_producto` (`cod_producto`);

--
-- Indices de la tabla `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  ADD PRIMARY KEY (`rut_nit_pv`);

--
-- Indices de la tabla `tbl_salidas`
--
ALTER TABLE `tbl_salidas`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `rut_nit_cli` (`rut_nit_cli`);

--
-- Indices de la tabla `tbl_supermercados`
--
ALTER TABLE `tbl_supermercados`
  ADD PRIMARY KEY (`rut_nit_cli`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_categoria_pd`
--
ALTER TABLE `tbl_categoria_pd`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tbl_devoluciones`
--
ALTER TABLE `tbl_devoluciones`
  MODIFY `id_devolucion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_entradas`
--
ALTER TABLE `tbl_entradas`
  MODIFY `id_entrada` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_pedidos`
--
ALTER TABLE `tbl_pedidos`
  MODIFY `id_pedido` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_productos_agotados`
--
ALTER TABLE `tbl_productos_agotados`
  MODIFY `id_productos_agotados` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `tbl_salidas`
--
ALTER TABLE `tbl_salidas`
  MODIFY `id_salida` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_administradores`
--
ALTER TABLE `tbl_administradores`
  ADD CONSTRAINT `tbl_administradores_ibfk_1` FOREIGN KEY (`id_configuracion`) REFERENCES `tbl_configuracion` (`id_configuracion`);

--
-- Filtros para la tabla `tbl_devoluciones`
--
ALTER TABLE `tbl_devoluciones`
  ADD CONSTRAINT `tbl_devoluciones_ibfk_1` FOREIGN KEY (`cod_producto`) REFERENCES `tbl_productos` (`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_entradas_productos`
--
ALTER TABLE `tbl_entradas_productos`
  ADD CONSTRAINT `tbl_entradas_productos_ibfk_1` FOREIGN KEY (`id_entrada`) REFERENCES `tbl_entradas` (`id_entrada`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_entradas_productos_ibfk_2` FOREIGN KEY (`cod_producto`) REFERENCES `tbl_productos` (`cod_producto`);

--
-- Filtros para la tabla `tbl_passwords`
--
ALTER TABLE `tbl_passwords`
  ADD CONSTRAINT `tbl_passwords_ibfk_2` FOREIGN KEY (`doc_admin`) REFERENCES `tbl_administradores` (`doc_admin`);

--
-- Filtros para la tabla `tbl_pedidos`
--
ALTER TABLE `tbl_pedidos`
  ADD CONSTRAINT `tbl_pedidos_ibfk_1` FOREIGN KEY (`doc_admin`) REFERENCES `tbl_administradores` (`doc_admin`);

--
-- Filtros para la tabla `tbl_pedidos_productos`
--
ALTER TABLE `tbl_pedidos_productos`
  ADD CONSTRAINT `tbl_pedidos_productos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `tbl_pedidos` (`id_pedido`),
  ADD CONSTRAINT `tbl_pedidos_productos_ibfk_2` FOREIGN KEY (`cod_producto`) REFERENCES `tbl_productos` (`cod_producto`);

--
-- Filtros para la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `tbl_productos_ibfk_1` FOREIGN KEY (`rut_nit_pv`) REFERENCES `tbl_proveedores` (`rut_nit_pv`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_productos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categoria_pd` (`id_categoria`);

--
-- Filtros para la tabla `tbl_productos_agotados`
--
ALTER TABLE `tbl_productos_agotados`
  ADD CONSTRAINT `tbl_productos_agotados_ibfk_1` FOREIGN KEY (`cod_producto`) REFERENCES `tbl_productos` (`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_productos_salidas`
--
ALTER TABLE `tbl_productos_salidas`
  ADD CONSTRAINT `tbl_productos_salidas_ibfk_1` FOREIGN KEY (`id_salida`) REFERENCES `tbl_salidas` (`id_salida`),
  ADD CONSTRAINT `tbl_productos_salidas_ibfk_2` FOREIGN KEY (`cod_producto`) REFERENCES `tbl_productos` (`cod_producto`);

--
-- Filtros para la tabla `tbl_salidas`
--
ALTER TABLE `tbl_salidas`
  ADD CONSTRAINT `tbl_salidas_ibfk_1` FOREIGN KEY (`rut_nit_cli`) REFERENCES `tbl_supermercados` (`rut_nit_cli`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
