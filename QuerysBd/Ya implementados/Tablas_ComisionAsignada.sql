/************** Tablas ************/
/* Como hay tablas que se crearon y otras que se modificaron, deben hacerlo en el siguiente orden*/

/* Modificar */
 /* --------------------------------  */
CREATE TABLE `actividad` (
  `Id_Actividad` bigint(20) NOT NULL AUTO_INCREMENT,
  `NombreActividad` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(400) DEFAULT NULL,
  `FechaInicio` date DEFAULT NULL,
  `FechaFin` date DEFAULT NULL,
  `Activo` int(11) NOT NULL,
  PRIMARY KEY (`Id_Actividad`)
)
 /* --------------------------------  */
 
 /* Nueva */
/* --------------------------------  */
Create table `Estado_Actividad` (
`ID_Estado` bigint(20) NOT NULL AUTO_INCREMENT,
  `NombreEstado` varchar(30) ,
 `Activo` int(11) not null,
  PRIMARY KEY (`ID_Estado`)

)

INSERT INTO `sge_bd_2`.`estado_actividad` (`ID_Estado`, `NombreEstado`, `Activo`) VALUES ('1', 'En Curso', '1');
INSERT INTO `sge_bd_2`.`estado_actividad` (`ID_Estado`, `NombreEstado`, `Activo`) VALUES ('2', 'Pendiente', '1');
INSERT INTO `sge_bd_2`.`estado_actividad` (`ID_Estado`, `NombreEstado`, `Activo`) VALUES ('3', 'Finalizada', '1');
INSERT INTO `sge_bd_2`.`estado_actividad` (`ID_Estado`, `NombreEstado`, `Activo`) VALUES ('4', 'No Iniciada', '1');
/* --------------------------------  */

/* Modificar */
/* --------------------------------  */
 CREATE TABLE `comision_actividad` (
  `ID_Comision_Actividad` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_Comision_Evento` bigint(20) NOT NULL,
  `ID_Actividad` bigint(20) NOT NULL,
  `ID_Estado` bigint(20) DEFAULT NULL,
  `Activo` int(11) NOT NULL,
  PRIMARY KEY (`ID_Comision_Actividad`),
  KEY `ID_Comision_Evento` (`ID_Comision_Evento`),
  KEY `ID_Actividad` (`ID_Actividad`),
  KEY `comision_actividad_ibfk_5` (`ID_Estado`),
  CONSTRAINT `comision_actividad_ibfk_1` FOREIGN KEY (`ID_Comision_Evento`) REFERENCES `comision_evento` (`ID_Comision_Evento`),
  CONSTRAINT `comision_actividad_ibfk_2` FOREIGN KEY (`ID_Actividad`) REFERENCES `actividad` (`Id_Actividad`),
  CONSTRAINT `comision_actividad_ibfk_5` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_actividad` (`ID_Estado`) 
)
/* --------------------------------  */

/* Modificar */
/* --------------------------------  */
CREATE TABLE `responsable_actividad` (
  `ID_Responsable_Actividad` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_Comision_Actividad` bigint(20) NOT NULL,
  `ID_Integrante_Comision` bigint(20) DEFAULT NULL,
  `Activo` int(11) NOT NULL,
  PRIMARY KEY (`ID_Responsable_Actividad`),
  KEY `ID_Integrante_Comision` (`ID_Integrante_Comision`),
  KEY `responsable_actividad_ibfk:2` (`ID_Comision_Actividad`),
  CONSTRAINT `responsable_actividad_ibfk:2` FOREIGN KEY (`ID_Comision_Actividad`) REFERENCES `comision_actividad` (`ID_Comision_Actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `responsable_actividad_ibfk_1` FOREIGN KEY (`ID_Integrante_Comision`) REFERENCES `integrante_comision` (`ID_Integrante_Comision`)
)
/* --------------------------------  */

/* Nueva */
/* --------------------------------  */
Create table `Requerimientos` (
`ID_Requerimiento` bigint(20) NOT NULL AUTO_INCREMENT,
  `NombreRequerimientos` varchar(300) ,
 `Activo` int(11) not null,
  PRIMARY KEY (`ID_Requerimiento`)

)
/* --------------------------------  */

/* --------------------------------  */
 CREATE TABLE `requerimiento_comisionactividad` (
  `ID_RequerimientoActividad` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_Comision_Actividad` bigint(20) DEFAULT NULL,
  `ID_Requerimiento` bigint(20) DEFAULT NULL,
  `Activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_RequerimientoActividad`),
  KEY `ID_Comision_Actividad` (`ID_Comision_Actividad`),
  KEY `ID_Requerimiento` (`ID_Requerimiento`),
  CONSTRAINT `requerimientoactividad_ibfk_1` FOREIGN KEY (`ID_Comision_Actividad`) REFERENCES `comision_actividad` (`ID_Comision_Actividad`),
  CONSTRAINT `requerimientoactividad_ibfk_2` FOREIGN KEY (`ID_Requerimiento`) REFERENCES `requerimientos` (`ID_Requerimiento`)
)
 /* --------------------------------  */

 /* --------------------------------  */
   Create Table ComisionApoyo_Actividad (
	ID_ComisionApoyo Bigint Auto_Increment,
    ID_Comision_Actividad Bigint,
    ID_Comision_Evento Bigint,
    Activo int,
    Primary Key (`ID_ComisionApoyo`),
    KEY `ID_Comision_Actividad` (`ID_Comision_Actividad`),
	KEY `ID_Comision_Evento` (`ID_Comision_Evento`),
    CONSTRAINT `comisionapoyo_ibfk_1` Foreign Key (`ID_Comision_Actividad`) References `comision_actividad`(`ID_Comision_Actividad`),
   CONSTRAINT `comisionapoyo_ibfk_2`  Foreign Key (`ID_Comision_Evento`) References `comision_evento`(`ID_Comision_Evento`)
 )
/* --------------------------------  */
 
 /* --------------------------------  */
  Create table `PersonalApoyo` (
`ID_PersonalApoyo` bigint(20) NOT NULL AUTO_INCREMENT,
  `NombreApoyos` varchar(50) ,
 `Activo` int(11) not null,
  PRIMARY KEY (`ID_PersonalApoyo`)

)

INSERT INTO `personalapoyo` VALUES (1,'No requiere',0),(2,'Decano',1),(3,'Docentes Rupap',1),(4,'Estudiantes',1),
(5,'Coordinador general del evento',1),(6,'Algunos miembros de las diferentes comisiones',1),(7,'Responsables de areas FCYS',1),
(8,'Coordinador de la carrera en las sedes',1),(9,'Docentes de las sedes',1),(10,'Equipos o Areas UNI',1),(11,'Proyectistas',1);
/* --------------------------------  */

/* --------------------------------  */
  Create Table PersonalApoyo_Actividad (
	ID_PersonalApoyo_CA Bigint Auto_Increment,
    ID_Comision_Actividad Bigint,
    ID_PersonalApoyo Bigint,
    Activo int,
    Primary Key (`ID_PersonalApoyo_CA`),
    KEY `ID_Comision_Actividad` (`ID_Comision_Actividad`),
	KEY `ID_PersonalApoyo` (`ID_PersonalApoyo`),
    CONSTRAINT `personalapoyoCA_ibfk_1` Foreign Key (`ID_Comision_Actividad`) References `comision_actividad`(`ID_Comision_Actividad`),
   CONSTRAINT `personalapoyoCA_ibfk_2`  Foreign Key (`ID_PersonalApoyo`) References `PersonalApoyo`(`ID_PersonalApoyo`)
 )
   /* --------------------------------  */
 
  /* --------------------------------  */
   Create Table SolicitudExtra_ComisionEvento (
	ID_SolicitudComision Bigint Auto_Increment,
    ID_Comision_Evento_Consulta Bigint,
    IDComisionConsultada Bigint,
    ID_Integrante_Comision bigint,
    Asunto varchar(200),
    Solicitud varchar(1000),
    Activo int,
    Primary Key (`ID_SolicitudComision`),
    KEY `ID_Comision_Evento_Consulta` (`ID_Comision_Evento_Consulta`),
	KEY `IDComisionConsultada` (`IDComisionConsultada`),
    KEY `ID_Integrante_Comision` (`ID_Integrante_Comision`),
    CONSTRAINT `solicitudc_ibfk_1` Foreign Key (`ID_Comision_Evento_Consulta`) References `comision_evento`(`ID_Comision_Evento`),
   CONSTRAINT `solicitudc_ibfk_2`  Foreign Key (`IDComisionConsultada`) References `comision_evento`(`ID_Comision_Evento`),
   CONSTRAINT `solicitudc_ibfk_3`  Foreign Key (`ID_Integrante_Comision`) References `integrante_comision`(`ID_Integrante_Comision`)
 )
   /* --------------------------------  */
 
  /* --------------------------------  */
  CREATE TABLE `reportefinal_comisionevento` (
  `ID_ReporteFinal_CE` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_Comision_Evento` bigint(20) DEFAULT NULL,
  `NombreReporteF` varchar(255) DEFAULT NULL,
  `ReporteFinal` varchar(255) DEFAULT NULL,
  `DirDescarga` varchar(255) DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT NULL,
  `Activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_ReporteFinal_CE`),
  KEY `ID_Comision_Evento` (`ID_Comision_Evento`),
  CONSTRAINT `reportefce_ibfk_1` FOREIGN KEY (`ID_Comision_Evento`) REFERENCES `comision_evento` (`ID_Comision_Evento`)
)

  /* --------------------------------  */
