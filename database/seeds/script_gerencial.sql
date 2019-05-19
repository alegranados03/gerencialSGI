-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2019 a las 01:11:06
-- Versión del servidor: 10.1.22-MariaDB
-- Versión de PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `expediente_clinico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexo`
--

CREATE TABLE `anexo` (
  `id` int(11) NOT NULL,
  `examen_solicitado_id` int(11) NOT NULL,
  `nombre_archivo` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camilla`
--

CREATE TABLE `camilla` (
  `id` int(11) NOT NULL,
  `habitacion_id` int(11) DEFAULT NULL,
  `numero_camilla` int(11) NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `expediente_id` int(11) NOT NULL,
  `fecha_reservacion` datetime NOT NULL,
  `consulta_por` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_examen`
--

CREATE TABLE `cita_examen` (
  `id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL,
  `fecha_examen` datetime NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clinica`
--

CREATE TABLE `clinica` (
  `id` int(11) NOT NULL,
  `nombre_clinica` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

CREATE TABLE `diagnostico` (
  `id` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id` int(11) NOT NULL,
  `nombre_especialidad` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_heces_macroscopico`
--

CREATE TABLE `examen_heces_macroscopico` (
  `id` int(11) NOT NULL,
  `examen_solicitado_id` int(11) NOT NULL,
  `aspecto` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `consistencia` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `olor` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `presencia_de_sangre` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `restos_alimenticios` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `presencia_moco` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_heces_microscopico`
--

CREATE TABLE `examen_heces_microscopico` (
  `id` int(11) NOT NULL,
  `examen_solicitado_id` int(11) NOT NULL,
  `hematies` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `leucocito` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `flora_bacteriana` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `levadura` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_heces_quimico`
--

CREATE TABLE `examen_heces_quimico` (
  `id_examen_heces_quimico` int(11) NOT NULL,
  `examen_solicitado_id` int(11) NOT NULL,
  `ph` double NOT NULL,
  `azucares_reductores` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sangre_oculta` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_hematologico`
--

CREATE TABLE `examen_hematologico` (
  `id` int(11) NOT NULL,
  `examen_solicitado_id` int(11) NOT NULL,
  `tipo_serie` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_referencia` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_orina_cristaluria`
--

CREATE TABLE `examen_orina_cristaluria` (
  `id` int(11) NOT NULL,
  `examen_solicitado_id` int(11) NOT NULL,
  `uratos_amorfos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `acido_urico` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `oxalatos_calcicos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fosfatos_amorfos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fosfatos_calcicos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fosfatos_amonicos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `riesgo_litogenico` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_orina_macroscopico`
--

CREATE TABLE `examen_orina_macroscopico` (
  `id` int(11) NOT NULL,
  `examen_solicitado_id` int(11) NOT NULL,
  `color` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `aspecto` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sedimento` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_orina_microscopico`
--

CREATE TABLE `examen_orina_microscopico` (
  `id` int(11) NOT NULL,
  `examen_solicitado_id` int(11) NOT NULL,
  `uretral` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `urotelio` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `renal` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `leucocitos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `piocitos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `eritrocitos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `bacteria` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parasitos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `funguria` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `filamento_de_mucina` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `proteina_uromocoide` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cilindros` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_orina_quimico`
--

CREATE TABLE `examen_orina_quimico` (
  `id` int(11) NOT NULL,
  `examen_solicitado_id` int(11) NOT NULL,
  `densidad` double NOT NULL,
  `ph` double NOT NULL,
  `glucosa` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `proteinas` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `hemoglobina` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuerpo_cetonico` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pigmento_biliar` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `urobilinogeno` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nitritos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_quimica_sanguinea`
--

CREATE TABLE `examen_quimica_sanguinea` (
  `id` int(11) NOT NULL,
  `examen_solicitado_id` int(11) NOT NULL,
  `parametro` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultado` int(11) NOT NULL,
  `comentario` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidades` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rango` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_solicitado`
--

CREATE TABLE `examen_solicitado` (
  `id` int(11) NOT NULL,
  `cita_examen_id` int(11) NOT NULL,
  `tipo_examen` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expediente`
--

CREATE TABLE `expediente` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `genero_id` int(11) NOT NULL,
  `numero_expediente` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` datetime NOT NULL,
  `direccion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_casada` longtext COLLATE utf8mb4_unicode_ci,
  `estado_civil` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiar`
--

CREATE TABLE `familiar` (
  `id` int(11) NOT NULL,
  `nombres` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` datetime NOT NULL,
  `telefono` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiares_expediente`
--

CREATE TABLE `familiares_expediente` (
  `id` int(11) NOT NULL,
  `familiar_id` int(11) NOT NULL,
  `expediente_id` int(11) NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL,
  `responsable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `id` int(11) NOT NULL,
  `sala_id` int(11) NOT NULL,
  `tipo_habitacion_id` int(11) NOT NULL,
  `numero_habitacion` int(11) NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_familiar`
--

CREATE TABLE `historial_familiar` (
  `id` int(11) NOT NULL,
  `familiar_id` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_propio`
--

CREATE TABLE `historial_propio` (
  `id` int(11) NOT NULL,
  `expediente_id` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_medica`
--

CREATE TABLE `historia_medica` (
  `id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL,
  `diagnostico_id` int(11) NOT NULL,
  `consulta_por` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `signos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sintomas` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresado`
--

CREATE TABLE `ingresado` (
  `id` int(11) NOT NULL,
  `camilla_id` int(11) NOT NULL,
  `expediente_id` int(11) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `permiso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_tabla` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_rol`
--

CREATE TABLE `permiso_rol` (
  `permiso_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_tratamiento`
--

CREATE TABLE `plan_tratamiento` (
  `id` int(11) NOT NULL,
  `diagnostico_id` int(11) NOT NULL,
  `dosis` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `medicamento` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `frecuencia` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_medicamento` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre_rol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE `sala` (
  `id` int(11) NOT NULL,
  `id_hospital_id` int(11) NOT NULL,
  `nombre_sala` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `signo_vital`
--

CREATE TABLE `signo_vital` (
  `id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL,
  `peso` double NOT NULL,
  `temperatura` double NOT NULL,
  `estatura` double NOT NULL,
  `presion_arterial` double NOT NULL,
  `ritmo_cardiaco` double NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

CREATE TABLE `tipo_habitacion` (
  `id` int(11) NOT NULL,
  `tipo_habitacion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado_en` datetime DEFAULT NULL,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `clinica_id` int(11) DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_especialidad`
--

CREATE TABLE `user_especialidad` (
  `user_id` int(11) NOT NULL,
  `especialidad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anexo`
--
ALTER TABLE `anexo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CD7EAF2C43CA3347` (`examen_solicitado_id`);

--
-- Indices de la tabla `camilla`
--
ALTER TABLE `camilla`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_712619ADB009290D` (`habitacion_id`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3E379A62DB38439E` (`usuario_id`),
  ADD KEY `IDX_3E379A624BF37E4E` (`expediente_id`);

--
-- Indices de la tabla `cita_examen`
--
ALTER TABLE `cita_examen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B5EEB821E011DDF` (`cita_id`);

--
-- Indices de la tabla `clinica`
--
ALTER TABLE `clinica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `examen_heces_macroscopico`
--
ALTER TABLE `examen_heces_macroscopico`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B368264143CA3347` (`examen_solicitado_id`);

--
-- Indices de la tabla `examen_heces_microscopico`
--
ALTER TABLE `examen_heces_microscopico`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9ABC70443CA3347` (`examen_solicitado_id`);

--
-- Indices de la tabla `examen_heces_quimico`
--
ALTER TABLE `examen_heces_quimico`
  ADD PRIMARY KEY (`id_examen_heces_quimico`),
  ADD UNIQUE KEY `UNIQ_49A805AC43CA3347` (`examen_solicitado_id`);

--
-- Indices de la tabla `examen_hematologico`
--
ALTER TABLE `examen_hematologico`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_AE3CB97343CA3347` (`examen_solicitado_id`);

--
-- Indices de la tabla `examen_orina_cristaluria`
--
ALTER TABLE `examen_orina_cristaluria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7AC4955A43CA3347` (`examen_solicitado_id`);

--
-- Indices de la tabla `examen_orina_macroscopico`
--
ALTER TABLE `examen_orina_macroscopico`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C81E2D0043CA3347` (`examen_solicitado_id`);

--
-- Indices de la tabla `examen_orina_microscopico`
--
ALTER TABLE `examen_orina_microscopico`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_72DDCC4543CA3347` (`examen_solicitado_id`);

--
-- Indices de la tabla `examen_orina_quimico`
--
ALTER TABLE `examen_orina_quimico`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D422CE0343CA3347` (`examen_solicitado_id`);

--
-- Indices de la tabla `examen_quimica_sanguinea`
--
ALTER TABLE `examen_quimica_sanguinea`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D8F766BE43CA3347` (`examen_solicitado_id`);

--
-- Indices de la tabla `examen_solicitado`
--
ALTER TABLE `examen_solicitado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_779218FBB5A95C01` (`cita_examen_id`);

--
-- Indices de la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D59CA413DB38439E` (`usuario_id`),
  ADD KEY `IDX_D59CA413BCE7B795` (`genero_id`);

--
-- Indices de la tabla `familiar`
--
ALTER TABLE `familiar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `familiares_expediente`
--
ALTER TABLE `familiares_expediente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B24733AA10C20D71` (`familiar_id`),
  ADD KEY `IDX_B24733AA4BF37E4E` (`expediente_id`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F45995BAC51CDF3F` (`sala_id`),
  ADD KEY `IDX_F45995BAB0BA7A53` (`tipo_habitacion_id`);

--
-- Indices de la tabla `historial_familiar`
--
ALTER TABLE `historial_familiar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_523A50F910C20D71` (`familiar_id`);

--
-- Indices de la tabla `historial_propio`
--
ALTER TABLE `historial_propio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_60EB986D4BF37E4E` (`expediente_id`);

--
-- Indices de la tabla `historia_medica`
--
ALTER TABLE `historia_medica`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_328E741C1E011DDF` (`cita_id`),
  ADD UNIQUE KEY `UNIQ_328E741C7A94BA1A` (`diagnostico_id`);

--
-- Indices de la tabla `ingresado`
--
ALTER TABLE `ingresado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6682CB4BFEEC2797` (`camilla_id`),
  ADD KEY `IDX_6682CB4B4BF37E4E` (`expediente_id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  ADD PRIMARY KEY (`permiso_id`,`rol_id`),
  ADD KEY `IDX_DD501D066CEFAD37` (`permiso_id`),
  ADD KEY `IDX_DD501D064BAB96C` (`rol_id`);

--
-- Indices de la tabla `plan_tratamiento`
--
ALTER TABLE `plan_tratamiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_951D78177A94BA1A` (`diagnostico_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E226041C1E2F769E` (`id_hospital_id`);

--
-- Indices de la tabla `signo_vital`
--
ALTER TABLE `signo_vital`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_75668911E011DDF` (`cita_id`);

--
-- Indices de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D6494BAB96C` (`rol_id`),
  ADD KEY `IDX_8D93D6499CD3F6D6` (`clinica_id`);

--
-- Indices de la tabla `user_especialidad`
--
ALTER TABLE `user_especialidad`
  ADD PRIMARY KEY (`user_id`,`especialidad_id`),
  ADD KEY `IDX_2C7C18FBA76ED395` (`user_id`),
  ADD KEY `IDX_2C7C18FB16A490EC` (`especialidad_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anexo`
--
ALTER TABLE `anexo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `camilla`
--
ALTER TABLE `camilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cita_examen`
--
ALTER TABLE `cita_examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clinica`
--
ALTER TABLE `clinica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `examen_heces_macroscopico`
--
ALTER TABLE `examen_heces_macroscopico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `examen_heces_microscopico`
--
ALTER TABLE `examen_heces_microscopico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `examen_heces_quimico`
--
ALTER TABLE `examen_heces_quimico`
  MODIFY `id_examen_heces_quimico` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `examen_hematologico`
--
ALTER TABLE `examen_hematologico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `examen_orina_cristaluria`
--
ALTER TABLE `examen_orina_cristaluria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `examen_orina_macroscopico`
--
ALTER TABLE `examen_orina_macroscopico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `examen_orina_microscopico`
--
ALTER TABLE `examen_orina_microscopico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `examen_orina_quimico`
--
ALTER TABLE `examen_orina_quimico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `examen_quimica_sanguinea`
--
ALTER TABLE `examen_quimica_sanguinea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `examen_solicitado`
--
ALTER TABLE `examen_solicitado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `expediente`
--
ALTER TABLE `expediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `familiar`
--
ALTER TABLE `familiar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `familiares_expediente`
--
ALTER TABLE `familiares_expediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `historial_familiar`
--
ALTER TABLE `historial_familiar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `historial_propio`
--
ALTER TABLE `historial_propio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `historia_medica`
--
ALTER TABLE `historia_medica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ingresado`
--
ALTER TABLE `ingresado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `plan_tratamiento`
--
ALTER TABLE `plan_tratamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `signo_vital`
--
ALTER TABLE `signo_vital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anexo`
--
ALTER TABLE `anexo`
  ADD CONSTRAINT `FK_CD7EAF2C43CA3347` FOREIGN KEY (`examen_solicitado_id`) REFERENCES `examen_solicitado` (`id`);

--
-- Filtros para la tabla `camilla`
--
ALTER TABLE `camilla`
  ADD CONSTRAINT `FK_712619ADB009290D` FOREIGN KEY (`habitacion_id`) REFERENCES `habitacion` (`id`);

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `FK_3E379A624BF37E4E` FOREIGN KEY (`expediente_id`) REFERENCES `expediente` (`id`),
  ADD CONSTRAINT `FK_3E379A62DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `cita_examen`
--
ALTER TABLE `cita_examen`
  ADD CONSTRAINT `FK_B5EEB821E011DDF` FOREIGN KEY (`cita_id`) REFERENCES `cita` (`id`);

--
-- Filtros para la tabla `examen_heces_macroscopico`
--
ALTER TABLE `examen_heces_macroscopico`
  ADD CONSTRAINT `FK_B368264143CA3347` FOREIGN KEY (`examen_solicitado_id`) REFERENCES `examen_solicitado` (`id`);

--
-- Filtros para la tabla `examen_heces_microscopico`
--
ALTER TABLE `examen_heces_microscopico`
  ADD CONSTRAINT `FK_9ABC70443CA3347` FOREIGN KEY (`examen_solicitado_id`) REFERENCES `examen_solicitado` (`id`);

--
-- Filtros para la tabla `examen_heces_quimico`
--
ALTER TABLE `examen_heces_quimico`
  ADD CONSTRAINT `FK_49A805AC43CA3347` FOREIGN KEY (`examen_solicitado_id`) REFERENCES `examen_solicitado` (`id`);

--
-- Filtros para la tabla `examen_hematologico`
--
ALTER TABLE `examen_hematologico`
  ADD CONSTRAINT `FK_AE3CB97343CA3347` FOREIGN KEY (`examen_solicitado_id`) REFERENCES `examen_solicitado` (`id`);

--
-- Filtros para la tabla `examen_orina_cristaluria`
--
ALTER TABLE `examen_orina_cristaluria`
  ADD CONSTRAINT `FK_7AC4955A43CA3347` FOREIGN KEY (`examen_solicitado_id`) REFERENCES `examen_solicitado` (`id`);

--
-- Filtros para la tabla `examen_orina_macroscopico`
--
ALTER TABLE `examen_orina_macroscopico`
  ADD CONSTRAINT `FK_C81E2D0043CA3347` FOREIGN KEY (`examen_solicitado_id`) REFERENCES `examen_solicitado` (`id`);

--
-- Filtros para la tabla `examen_orina_microscopico`
--
ALTER TABLE `examen_orina_microscopico`
  ADD CONSTRAINT `FK_72DDCC4543CA3347` FOREIGN KEY (`examen_solicitado_id`) REFERENCES `examen_solicitado` (`id`);

--
-- Filtros para la tabla `examen_orina_quimico`
--
ALTER TABLE `examen_orina_quimico`
  ADD CONSTRAINT `FK_D422CE0343CA3347` FOREIGN KEY (`examen_solicitado_id`) REFERENCES `examen_solicitado` (`id`);

--
-- Filtros para la tabla `examen_quimica_sanguinea`
--
ALTER TABLE `examen_quimica_sanguinea`
  ADD CONSTRAINT `FK_D8F766BE43CA3347` FOREIGN KEY (`examen_solicitado_id`) REFERENCES `examen_solicitado` (`id`);

--
-- Filtros para la tabla `examen_solicitado`
--
ALTER TABLE `examen_solicitado`
  ADD CONSTRAINT `FK_779218FBB5A95C01` FOREIGN KEY (`cita_examen_id`) REFERENCES `cita_examen` (`id`);

--
-- Filtros para la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD CONSTRAINT `FK_D59CA413BCE7B795` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`),
  ADD CONSTRAINT `FK_D59CA413DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `familiares_expediente`
--
ALTER TABLE `familiares_expediente`
  ADD CONSTRAINT `FK_B24733AA10C20D71` FOREIGN KEY (`familiar_id`) REFERENCES `familiar` (`id`),
  ADD CONSTRAINT `FK_B24733AA4BF37E4E` FOREIGN KEY (`expediente_id`) REFERENCES `expediente` (`id`);

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `FK_F45995BAB0BA7A53` FOREIGN KEY (`tipo_habitacion_id`) REFERENCES `tipo_habitacion` (`id`),
  ADD CONSTRAINT `FK_F45995BAC51CDF3F` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`id`);

--
-- Filtros para la tabla `historial_familiar`
--
ALTER TABLE `historial_familiar`
  ADD CONSTRAINT `FK_523A50F910C20D71` FOREIGN KEY (`familiar_id`) REFERENCES `familiar` (`id`);

--
-- Filtros para la tabla `historial_propio`
--
ALTER TABLE `historial_propio`
  ADD CONSTRAINT `FK_60EB986D4BF37E4E` FOREIGN KEY (`expediente_id`) REFERENCES `expediente` (`id`);

--
-- Filtros para la tabla `historia_medica`
--
ALTER TABLE `historia_medica`
  ADD CONSTRAINT `FK_328E741C1E011DDF` FOREIGN KEY (`cita_id`) REFERENCES `cita` (`id`),
  ADD CONSTRAINT `FK_328E741C7A94BA1A` FOREIGN KEY (`diagnostico_id`) REFERENCES `diagnostico` (`id`);

--
-- Filtros para la tabla `ingresado`
--
ALTER TABLE `ingresado`
  ADD CONSTRAINT `FK_6682CB4B4BF37E4E` FOREIGN KEY (`expediente_id`) REFERENCES `expediente` (`id`),
  ADD CONSTRAINT `FK_6682CB4BFEEC2797` FOREIGN KEY (`camilla_id`) REFERENCES `camilla` (`id`);

--
-- Filtros para la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  ADD CONSTRAINT `FK_DD501D064BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DD501D066CEFAD37` FOREIGN KEY (`permiso_id`) REFERENCES `permiso` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `plan_tratamiento`
--
ALTER TABLE `plan_tratamiento`
  ADD CONSTRAINT `FK_951D78177A94BA1A` FOREIGN KEY (`diagnostico_id`) REFERENCES `diagnostico` (`id`);

--
-- Filtros para la tabla `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `FK_E226041C1E2F769E` FOREIGN KEY (`id_hospital_id`) REFERENCES `clinica` (`id`);

--
-- Filtros para la tabla `signo_vital`
--
ALTER TABLE `signo_vital`
  ADD CONSTRAINT `FK_75668911E011DDF` FOREIGN KEY (`cita_id`) REFERENCES `cita` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6494BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `FK_8D93D6499CD3F6D6` FOREIGN KEY (`clinica_id`) REFERENCES `clinica` (`id`);

--
-- Filtros para la tabla `user_especialidad`
--
ALTER TABLE `user_especialidad`
  ADD CONSTRAINT `FK_2C7C18FB16A490EC` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidad` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2C7C18FBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
