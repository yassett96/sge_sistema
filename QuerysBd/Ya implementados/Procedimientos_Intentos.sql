/* tabla intentos */

CREATE TABLE `intentos_usuarios` (
  `ID_Persona` bigint(20) NOT NULL,
  `fecha_Intento` datetime NOT NULL DEFAULT current_timestamp(),
  KEY `ID_Persona` (`ID_Persona`),
  CONSTRAINT `intento_usuario_ibfk_1` FOREIGN KEY (`ID_Persona`) REFERENCES `credenciales` (`ID_Persona`)
)

/* Consulta Intentos */

CREATE  PROCEDURE `Consulta_Intento_Usuario`(in id_usu bigint(20))
BEGIN

declare idu bigint(20)  default id_usu;

SET SQL_SAFE_UPDATES=0;

DELETE FROM intentos_usuarios where DATE_ADD(fecha_Intento, INTERVAL 1 MINUTE) < now();

SELECT COUNT(*) AS conteo FROM intentos_usuarios WHERE ID_Persona = idu;

SET SQL_SAFE_UPDATES=1;

END

/* Agrega Intentos */

CREATE  PROCEDURE `Insertar_Intentos`(in id_usu bigint(20))
BEGIN
declare idu bigint(20)  default id_usu;

INSERT INTO intentos_usuarios(ID_Persona,fecha_Intento) VALUES (idu,CURRENT_TIMESTAMP)   ;

END

/* Eliminar Intentos */

CREATE  PROCEDURE `Elimina_Intento`(in id_usu bigint(20))
BEGIN

declare idu bigint(20)  default id_usu;
DELETE FROM intentos_usuarios WHERE ID_Persona = idu;

END

CREATE  PROCEDURE `Obtener_Pasatiempo_Usuario`(in usu varchar(20))
BEGIN
declare pasa varchar(20) default usu;

select ID_Persona, Contraseña from credenciales where Usuario = pasa;


END