/*Procedimiento utilizado en MInicio_Sesion*/

CREATE  PROCEDURE `Obtener_Pasatiempo_Usuario`(in usu varchar(20))
BEGIN
declare pasa varchar(20) default usu;

select Contraseña from credenciales where Usuario = pasa;


END