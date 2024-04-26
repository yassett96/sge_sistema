/*************
Actualizar Procedimientos 
**************/

CREATE  PROCEDURE `Cargar_Acceso_PersonaUsuario`(in idpersona bigint, in idtipousuario bigint)
BEGIN

	
declare id_per int default idpersona;
	
declare id_tipou int default idtipousuario;

	
select p.ID_Persona,p.Primer_Nombre, p.Primer_Apellido,p.Telefono,p.Correo_Electronico, pu.ID_Tipo_Usuario,p.Avatar from persona as p
	inner join persona_usuario as pu on pu.ID_Persona = p.ID_Persona
	
where p.ID_Persona = id_per and pu.ID_Tipo_Usuario = id_tipou and pu.Activo=1 and p.Activo = 1;


END

/**************************/

/*********************
Crear Procedimientos
*********************/

CREATE  PROCEDURE `Actualizar_Datos_P_Academico`(in idpersona bigint, in tel char(16), in correo varchar(100))
BEGIN

	declare pid int default idpersona;
    declare ptel char(16) default tel;
    declare pcorreo varchar(100) default correo;
    
    UPDATE persona set Telefono = ptel,Correo_Electronico= pcorreo where ID_Persona = pid and Activo = 1;

END
 
 /**********************/
 
CREATE PROCEDURE `ValidarTipoUsuario`(in idpersona bigint)
BEGIN

declare p_idp int default idpersona;


select ID_Tipo_Usuario from persona_usuario where ID_Persona = p_idp and ID_Tipo_Usuario = 1;

END

/*********************/
 