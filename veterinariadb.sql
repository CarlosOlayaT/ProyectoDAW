-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-02-2026 a las 05:25:11
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
-- Base de datos: `veterinariadb`
--
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `Id` int(11) NOT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `IdMascota` int(11) DEFAULT NULL,
  `Detalles` varchar(500) DEFAULT NULL,
  `FechaCita` datetime DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp(),
  `Tipo` varchar(500) DEFAULT NULL,
  `Observaciones` text DEFAULT NULL,
  `Etapa` varchar(60) DEFAULT 'Pendiente',
  `Estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`Id`, `IdCliente`, `IdMascota`, `Detalles`, `FechaCita`, `FechaRegistro`, `Tipo`, `Observaciones`, `Etapa`, `Estado`) VALUES
(1, 1, 1, 'Revisión por cojera', '2025-06-26 10:00:00', '2025-06-28 01:58:06', 'Cirugia', NULL, 'Completado', 1),
(2, 2, 2, 'Vacunación anual', '2025-06-27 14:00:00', '2025-06-28 01:58:06', 'Vacuna', NULL, 'Pendiente', 1),
(3, 3, 3, 'Chequeo general', '2025-07-28 11:30:00', '2025-06-28 01:58:06', 'Cirugia', NULL, 'Pendiente', 1),
(4, 4, 4, 'Control de peso', '2025-06-14 16:00:00', '2025-06-28 01:58:06', 'Vacuna', NULL, 'No asistio', 1),
(5, 5, 5, 'Baño y Peluquería', '2025-07-30 09:00:00', '2025-06-28 01:58:06', 'Cirugia', NULL, 'Completado', 1),
(6, 3, 3, 'Se realizara examenes basicos para chequeo general', '2025-07-24 00:22:01', '2025-07-12 00:24:09', 'Consulta', NULL, 'Pendiente', 1),
(7, 5, 5, 'Chequeo de rutina', '2025-07-30 00:33:08', '2025-07-12 00:33:52', 'Consulta', NULL, 'Pendiente', 1),
(8, 1, 1, 'Chequeo para ver evolucion de su enfemedad', '2025-07-23 00:49:32', '2025-07-12 00:50:18', 'Consulta', NULL, 'Pendiente', 1),
(9, 6, 6, 'Primera atencion de revision general', '2025-07-24 00:54:08', '2025-07-12 00:54:48', 'Consulta', NULL, 'Pendiente', 1),
(10, 2, 2, 'Se esterilizara al gato', '2025-07-26 01:05:27', '2025-07-12 01:06:32', 'Cirugia', NULL, 'Pendiente', 1),
(11, 3, 3, 'Consulta de rutina', '2026-02-16 14:00:00', '2025-07-13 14:06:20', 'Consulta', '', 'Pendiente', 1),
(12, 3, 3, 'Cirugia por tumor en el pecho', '2026-03-24 14:55:52', '2025-07-13 14:57:17', 'Cirugia', NULL, 'Pendiente', 1),
(13, NULL, 9, 'Revision diaria', '2026-02-22 12:00:00', '2026-02-07 17:10:49', 'consulta', NULL, 'Pendiente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas_servicios`
--

CREATE TABLE `citas_servicios` (
  `Id` int(11) NOT NULL,
  `IdServicios` int(11) DEFAULT NULL,
  `IdCitas` int(11) DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas_servicios`
--

INSERT INTO `citas_servicios` (`Id`, `IdServicios`, `IdCitas`, `FechaRegistro`) VALUES
(15, 1, 1, '2026-02-05 10:58:00'),
(16, 2, 2, '2026-02-05 10:58:00'),
(17, 1, 3, '2026-02-05 10:58:00'),
(18, 5, 5, '2026-02-05 10:58:00'),
(19, 3, 4, '2026-02-05 10:58:00'),
(20, 6, 6, '2026-02-05 10:58:00'),
(21, 7, 7, '2026-02-05 10:58:00'),
(22, 8, 8, '2026-02-05 10:58:00'),
(23, 9, 9, '2026-02-05 10:58:00'),
(24, 10, 10, '2026-02-05 10:58:00'),
(25, 11, 11, '2026-02-05 10:58:00'),
(26, 12, 12, '2026-02-05 10:58:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellido` varchar(100) DEFAULT NULL,
  `Cedula` varchar(10) DEFAULT NULL,
  `Telefono` varchar(10) DEFAULT NULL,
  `Direccion` varchar(150) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT 1,
  `Correo` varchar(100) DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`Id`, `Nombre`, `Apellido`, `Cedula`, `Telefono`, `Direccion`, `Estado`, `Correo`, `FechaRegistro`) VALUES
(1, 'Juan', 'Pérez', '0912345678', '0987654321', 'Av. Amazonas y Colón', 1, 'juan.perez@ejemplo.com', '2026-02-03 18:01:18'),
(2, 'María', 'Gómez', '0923456789', '0987123456', 'Calle 10 de Agosto', 1, 'maria.lopez@ejemplo.com', '2026-02-03 18:01:18'),
(3, 'Carlos', 'Sánchez', '0934567890', '0987651234', 'Av. Eloy Alfaro', 1, 'pedro.garcia@ejemplo.com', '2026-02-03 18:01:18'),
(4, 'Laura', 'Fernández', '0945678901', '0999999999', 'Calle Los Cipreses', 1, 'ana.morales@ejemplo.com', '2026-02-03 18:01:18'),
(5, 'Diego', 'Mendoza', '0956789012', '0976543210', 'Av. La Prensa', 1, 'carlos.ruiz@ejemplo.com', '2026-02-03 18:01:18'),
(6, 'Carlos', 'Toledo', '0967890123', '0101010101', 'Guayaquil', 1, 'carlos@gmail.com', '2026-02-03 18:01:18'),
(7, 'Roberto', 'Arevalo', '0978901234', '0986549349', 'Guayaquil', 1, 'roberto@gmail.com', '2026-02-03 18:01:18'),
(8, 'Andres', 'Mora', '0989012345', '0987654321', 'Guayaquil', 1, 'andres@gmail.com', '2026-02-03 18:01:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `Id` int(11) NOT NULL,
  `IdFacturas` int(11) DEFAULT NULL,
  `IdServicios` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Subtotal` decimal(10,2) DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`Id`, `IdFacturas`, `IdServicios`, `Cantidad`, `Subtotal`, `FechaRegistro`) VALUES
(1, 1, 1, 1, 15.00, '2026-02-05 10:58:43'),
(2, 1, 5, 1, 25.00, '2026-02-05 10:58:43'),
(3, 2, 4, 1, 200.00, '2026-02-05 10:58:43'),
(4, 2, 2, 1, 15.00, '2026-02-05 10:58:43'),
(5, 3, 3, 1, 18.50, '2026-02-05 10:58:43'),
(6, 4, 1, 1, 15.00, '2026-02-05 10:58:43'),
(7, 5, 1, 1, 15.00, '2026-02-05 10:58:43'),
(8, 5, 5, 1, 30.00, '2026-02-05 10:58:43'),
(9, 5, 2, 1, 10.00, '2026-02-05 10:58:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `Id` int(11) NOT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `PrecioTotal` decimal(10,2) DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp(),
  `IdMascota` int(11) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT 1,
  `Etapa` varchar(50) DEFAULT 'Pendiente',
  `IdCita` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`Id`, `IdCliente`, `PrecioTotal`, `FechaRegistro`, `IdMascota`, `Estado`, `Etapa`, `IdCita`) VALUES
(1, 1, 40.00, '2026-02-05 10:52:15', 1, 1, 'Pendiente', 1),
(2, 2, 215.00, '2026-02-05 10:52:15', 2, 1, 'Pendiente', 2),
(3, 3, 18.50, '2026-02-05 10:52:15', 3, 1, 'Pendiente', 3),
(4, 4, 15.00, '2026-02-05 10:52:15', 4, 1, 'Pendiente', 4),
(5, 5, 55.00, '2026-02-05 10:52:15', 5, 1, 'Pagada', 5),
(6, 3, 17.00, '2026-02-05 10:52:15', 3, 1, 'Pagada', 3),
(7, 5, 35.00, '2026-02-05 10:52:15', 5, 1, 'Pagada', 5),
(8, 3, 17.00, '2026-02-05 10:52:15', 3, 1, 'Pagada', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialmedico`
--

CREATE TABLE `historialmedico` (
  `Id` int(11) NOT NULL,
  `IdMascota` int(11) DEFAULT NULL,
  `IdServicios` int(11) DEFAULT NULL,
  `Diagnostico` varchar(500) DEFAULT NULL,
  `Tratamiento` varchar(500) DEFAULT NULL,
  `FechaConsulta` date DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp(),
  `Estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historialmedico`
--

INSERT INTO `historialmedico` (`Id`, `IdMascota`, `IdServicios`, `Diagnostico`, `Tratamiento`, `FechaConsulta`, `FechaRegistro`, `Estado`) VALUES
(1, 1, 1, 'Cojera leve en pata trasera', 'Reposo y analgésico', '2025-06-26', '2026-02-05 11:09:57', 1),
(2, 2, 2, 'Vacunación al día', 'Ninguna', '2025-06-27', '2026-02-05 11:09:57', 1),
(3, 3, 1, 'Buen estado general', 'Ninguno', '2025-06-28', '2026-02-05 11:09:57', 1),
(4, 4, 3, 'Ligero sobrepeso', 'Dieta balanceada', '2025-06-29', '2026-02-05 11:09:57', 1),
(5, 3, 6, 'Suciedad', 'Limpieza basica', '2025-07-22', '2026-02-05 11:09:57', 1),
(6, 5, 7, 'Suciedad', 'Baño y perfume', '2025-07-30', '2026-02-05 11:09:57', 1),
(7, 1, 8, 'Malestar muscular', 'Medicinas y reposo', '2025-07-23', '2026-02-05 11:09:57', 1),
(8, 6, 9, 'Pelo largo', 'Corte y cepillado', '2025-07-24', '2026-02-05 11:09:57', 1),
(9, 2, 10, 'Cirugía', 'Pastillas y reposo', '2025-07-25', '2026-02-05 11:09:57', 1),
(10, 3, 11, 'Otitis', 'Gotas en las orejas', '2025-07-16', '2026-02-05 11:09:57', 1),
(11, 3, 12, 'Dolor en el pecho', 'Medicamento', '2025-07-24', '2026-02-05 11:09:57', 1),
(12, 9, NULL, 'Suciedad', 'limpieza completa', '2026-02-06', '2026-02-06 22:53:29', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `Id` int(11) NOT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Tipo` int(11) DEFAULT NULL,
  `Raza` varchar(50) DEFAULT NULL,
  `Peso` decimal(5,2) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Sexo` varchar(10) DEFAULT NULL,
  `Etapa` varchar(50) DEFAULT 'Esperando',
  `Especie` varchar(50) DEFAULT NULL,
  `Observaciones` varchar(500) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT 1,
  `FechaRegistro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`Id`, `IdCliente`, `Nombre`, `Tipo`, `Raza`, `Peso`, `FechaNacimiento`, `Sexo`, `Etapa`, `Especie`, `Observaciones`, `Estado`, `FechaRegistro`) VALUES
(1, 1, 'Firulais', 1, 'Labrador', 25.80, '2025-07-08', 'Macho', 'Esperando', 'N/A', '', 1, '2026-02-03 18:05:54'),
(2, 2, 'Michi', 2, 'Siames', 4.20, '2019-06-10', 'Hembra', 'Esperando', 'N/A', NULL, 1, '2026-02-03 18:05:54'),
(3, 3, 'Rocky', 1, 'Bulldog', 30.00, '2021-03-20', 'Macho', 'Esperando', 'N/A', NULL, 1, '2026-02-03 18:05:54'),
(4, 4, 'Luna', 2, 'Persa', 3.80, '2022-07-05', 'Hembra', 'Esperando', 'N/A', NULL, 1, '2026-02-03 18:05:54'),
(5, 5, 'Max', 1, 'Pastor Alemán', 28.00, '2020-11-11', 'Macho', 'Esperando', 'N/A', NULL, 1, '2026-02-03 18:05:54'),
(6, 6, 'Coco', 1, 'Pitbull', 5.00, '2020-10-06', 'Macho', 'Esperando', 'N/A', NULL, 1, '2026-02-03 18:05:54'),
(7, 7, 'Leo', 2, 'Atigrado', 2.00, '2020-07-23', 'Hembra', 'Esperando', 'N/A', NULL, 1, '2026-02-03 18:05:54'),
(8, 8, 'Max', 4, 'Tortuga', 1.00, '2023-06-15', 'Macho', 'Esperando', 'N/A', '', 1, '2026-02-03 18:05:54'),
(9, 6, 'Garu', 3, 'Canario', 1.00, '2026-01-15', 'Macho', 'Esperando', 'N/A', '', 1, '2026-02-06 18:10:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `icono` varchar(50) NOT NULL,
  `controlador` varchar(50) NOT NULL,
  `funcion` varchar(50) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `estado` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `nombre`, `icono`, `controlador`, `funcion`, `orden`, `estado`) VALUES
(1, 'Dashboard', 'fa-house', 'index', 'index', 1, b'1'),
(2, 'Reportes', 'fa-chart-pie', 'reports', 'index', 2, b'1'),
(3, 'Clientes', 'fa-user-group', 'customer', 'index', 3, b'1'),
(4, 'Mascotas', 'fa-paw', 'pets', 'index', 4, b'1'),
(5, 'Facturas', 'fa-receipt', 'invoices', 'index', 5, b'1'),
(6, 'Recetas', 'fa-capsules', 'recipes', 'index', 6, b'1'),
(7, 'Configuración', 'fa-gear', 'configuration', 'index', 7, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_roles`
--

CREATE TABLE `menu_roles` (
  `menu_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu_roles`
--

INSERT INTO `menu_roles` (`menu_id`, `rol_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(6, 2),
(7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(3, 'Vendedor'),
(2, 'Veterinario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `Id` int(11) NOT NULL,
  `NombreServicio` varchar(100) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp(),
  `Detalles` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`Id`, `NombreServicio`, `Precio`, `FechaRegistro`, `Detalles`) VALUES
(1, 'Consulta General', 15.00, '2026-02-05 10:53:34', 'Atención médica veterinaria general'),
(2, 'Vacunación', 25.00, '2026-02-05 10:53:34', 'Aplicación de vacunas'),
(3, 'Desparasitación', 18.50, '2026-02-05 10:53:34', 'Eliminación de parásitos'),
(4, 'Cirugía', 200.00, '2026-02-05 10:53:34', 'Intervención quirúrgica'),
(5, 'Baño y Peluquería', 30.00, '2026-02-05 10:53:34', 'Higiene y corte de pelo'),
(6, 'Consulta', 15.00, '2026-02-05 10:53:34', 'Chequeo Diario'),
(7, 'Consulta', 15.00, '2026-02-05 10:53:34', 'Consulta basica'),
(8, 'Consulta', 17.00, '2026-02-05 10:53:34', 'Revision general'),
(9, 'Consulta', 12.00, '2026-02-05 10:53:34', 'Primera cita'),
(10, 'Cirugia', 30.00, '2026-02-05 10:53:34', 'Esterilizacion'),
(11, 'Consulta', 20.00, '2026-02-05 10:53:34', 'Chequeo de rutina'),
(12, 'Cirugia', 18.00, '2026-02-05 10:53:34', 'Cirugia por tumor'),
(13, 'Vacunas', 25.00, '2026-02-05 10:53:34', 'Vacuna antirrábica'),
(14, 'Vacunas', 25.00, '2026-02-05 10:53:34', 'Vacuna antirrábica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomascotas`
--

CREATE TABLE `tipomascotas` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `RutaIcono` varchar(200) NOT NULL,
  `Estado` tinyint(1) DEFAULT 1,
  `FechaRegistro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipomascotas`
--

INSERT INTO `tipomascotas` (`Id`, `Nombre`, `RutaIcono`, `Estado`, `FechaRegistro`) VALUES
(1, 'Perro', 'Perro.png', 1, '2026-02-03 18:03:18'),
(2, 'Gato', 'Gato.png', 1, '2026-02-03 18:03:18'),
(3, 'Loro', 'Loro.png', 1, '2026-02-03 18:03:18'),
(4, 'Tortuga', 'Tortuga.png', 1, '2026-02-03 18:03:18'),
(5, 'Hamster', 'Hamster.png', 1, '2026-02-03 18:03:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `Nombres` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Rol_id` int(11) NOT NULL DEFAULT 3,
  `User` varchar(25) NOT NULL,
  `Contrasenia` varchar(255) NOT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp(),
  `Estado` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Nombres`, `Apellidos`, `Rol_id`, `User`, `Contrasenia`, `FechaRegistro`, `Estado`) VALUES
(1, 'Carlos', 'Olaya', 1, 'CarlosO', 'admin', '2026-01-31 23:53:07', b'1'),
(2, 'Samuel', 'Cadena', 2, 'Samu', 'abcdef', '2026-01-31 23:53:07', b'1'),
(3, 'David', 'Sayay', 3, 'david', '123456', '2026-01-31 23:53:07', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacunas`
--

CREATE TABLE `vacunas` (
  `Id` int(11) NOT NULL,
  `IdMascota` int(11) DEFAULT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  `Enfermedad` varchar(100) DEFAULT NULL,
  `Vacuna` varchar(100) DEFAULT NULL,
  `FechaPrimeraDosis` date DEFAULT NULL,
  `FechaRefuerzo` date DEFAULT NULL,
  `Observaciones` varchar(300) DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp(),
  `Estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vacunas`
--

INSERT INTO `vacunas` (`Id`, `IdMascota`, `IdServicio`, `Enfermedad`, `Vacuna`, `FechaPrimeraDosis`, `FechaRefuerzo`, `Observaciones`, `FechaRegistro`, `Estado`) VALUES
(9, 1, 3, 'Rabia', 'Antirrábica', '2025-01-10', '2026-01-10', 'Revacunar cada año.', '2026-02-05 11:08:34', 1),
(10, 1, 4, 'Parvovirus', 'Vacuna Parvo', '2025-02-15', '2025-08-15', 'Refuerzo a los 6 meses.', '2026-02-05 11:08:34', 1),
(11, 2, 3, 'Distemper', 'Vacuna', '2025-03-02', NULL, 'Una sola dosis en etapa adulta.', '2026-02-05 11:08:34', 1),
(12, 2, 5, 'Hepatitis canina', 'Vacuna Hepatitis', '2025-03-01', '2025-09-01', 'Refuerzo semestral.', '2026-02-05 11:08:34', 1),
(13, 3, 4, 'Leptospirosis', 'Vacuna Lepto', '2025-01-20', '2025-07-20', 'Necesario para mascotas que salen al campo.', '2026-02-05 11:08:34', 0),
(14, 3, 3, 'Parvovirus', 'Vacuna', '2025-02-10', NULL, 'Reacción leve registrada. Revisar antes de revacunar.', '2026-02-05 11:08:34', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `analisis`
--
ALTER TABLE `analisis`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdMascota` (`IdMascota`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdCliente` (`IdCliente`),
  ADD KEY `IdMascota` (`IdMascota`);

--
-- Indices de la tabla `citas_servicios`
--
ALTER TABLE `citas_servicios`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdServicios` (`IdServicios`),
  ADD KEY `IdCitas` (`IdCitas`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdFacturas` (`IdFacturas`),
  ADD KEY `IdServicios` (`IdServicios`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdCliente` (`IdCliente`),
  ADD KEY `IdMascota` (`IdMascota`),
  ADD KEY `IdCita` (`IdCita`);

--
-- Indices de la tabla `historialmedico`
--
ALTER TABLE `historialmedico`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdMascota` (`IdMascota`),
  ADD KEY `IdServicios` (`IdServicios`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdCliente` (`IdCliente`),
  ADD KEY `Tipo` (`Tipo`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu_roles`
--
ALTER TABLE `menu_roles`
  ADD PRIMARY KEY (`menu_id`,`rol_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `tipomascotas`
--
ALTER TABLE `tipomascotas`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `rol_fk` (`Rol_id`);

--
-- Indices de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdMascota` (`IdMascota`),
  ADD KEY `IdServicio` (`IdServicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `analisis`
--
ALTER TABLE `analisis`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `citas_servicios`
--
ALTER TABLE `citas_servicios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `historialmedico`
--
ALTER TABLE `historialmedico`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tipomascotas`
--
ALTER TABLE `tipomascotas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `analisis`
--
ALTER TABLE `analisis`
  ADD CONSTRAINT `analisis_ibfk_1` FOREIGN KEY (`IdMascota`) REFERENCES `mascotas` (`Id`);

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`IdCliente`) REFERENCES `clientes` (`Id`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`IdMascota`) REFERENCES `mascotas` (`Id`);

--
-- Filtros para la tabla `citas_servicios`
--
ALTER TABLE `citas_servicios`
  ADD CONSTRAINT `citas_servicios_ibfk_1` FOREIGN KEY (`IdServicios`) REFERENCES `servicios` (`Id`),
  ADD CONSTRAINT `citas_servicios_ibfk_2` FOREIGN KEY (`IdCitas`) REFERENCES `citas` (`Id`);

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`IdFacturas`) REFERENCES `facturas` (`Id`),
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`IdServicios`) REFERENCES `servicios` (`Id`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`IdCliente`) REFERENCES `clientes` (`Id`),
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`IdMascota`) REFERENCES `mascotas` (`Id`),
  ADD CONSTRAINT `facturas_ibfk_3` FOREIGN KEY (`IdCita`) REFERENCES `citas` (`Id`);

--
-- Filtros para la tabla `historialmedico`
--
ALTER TABLE `historialmedico`
  ADD CONSTRAINT `historialmedico_ibfk_1` FOREIGN KEY (`IdMascota`) REFERENCES `mascotas` (`Id`),
  ADD CONSTRAINT `historialmedico_ibfk_2` FOREIGN KEY (`IdServicios`) REFERENCES `servicios` (`Id`);

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `mascotas_ibfk_1` FOREIGN KEY (`IdCliente`) REFERENCES `clientes` (`Id`),
  ADD CONSTRAINT `mascotas_ibfk_2` FOREIGN KEY (`Tipo`) REFERENCES `tipomascotas` (`Id`);

--
-- Filtros para la tabla `menu_roles`
--
ALTER TABLE `menu_roles`
  ADD CONSTRAINT `menu_roles_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  ADD CONSTRAINT `menu_roles_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `rol_fk` FOREIGN KEY (`Rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vacunas`
--
ALTER TABLE `vacunas`
  ADD CONSTRAINT `vacunas_ibfk_1` FOREIGN KEY (`IdMascota`) REFERENCES `mascotas` (`Id`),
  ADD CONSTRAINT `vacunas_ibfk_2` FOREIGN KEY (`IdServicio`) REFERENCES `servicios` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
