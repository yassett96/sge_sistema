/* PROCEDIMIENTOS IMPLEMENTADOS EN LOS MODELOS (MGRUPO-MSEDE-MACTUALIZARICONO-MDATOSEVENTOS-MPERSONA)*/
CREATE DEFINER=`` PROCEDURE `Listar_SedeGrupo`(in P_IdSede int)
BEGIN
	select concat ('<option value ="',g.ID_Grupo,'"','>',G.Grupo,'</option>')
    from sede_grupo sg 
    inner join  Grupo G on G.ID_Grupo = sg.ID_Grupo
    where sg.Activo = 1 and G.Activo = 1
    And (sg.ID_Sede = P_IdSede) 
    order by g.grupo;
END
/*****************************************************************************************/
CREATE DEFINER=`` PROCEDURE `Listar_Sede`()
BEGIN
	select concat ('<option value ="',Id_Sede,'"','>',Sede,'</option>')
    from sede
    where Activo = 1
    order by Id_Sede;
END
/*****************************************************************************************/
CREATE DEFINER=`` PROCEDURE `ActualizarAvatar_PersonaParticipante`(in Idpersona bigint, in avatar varchar(60))
BEGIN
	declare id_per int default idpersona;
	declare p_avatar varchar(60) default avatar;
    
    UPDATE persona SET  Avatar = p_avatar WHERE ID_Persona = id_per and Activo = 1;
    
END
/*****************************************************************************************/
CREATE DEFINER=`` PROCEDURE `Cargar_Acceso_Participante`(in idpersona bigint)
BEGIN

declare id_per int default idpersona;
declare id_tipou int default 1;

select p.ID_Persona, p.Primer_Nombre, p.Primer_Apellido,p.Telefono,p.Correo_Electronico, p.Avatar,par.CodigoRegistro, pu.ID_Tipo_Usuario, g.grupo, par.ID_Grupo, par.ID_Sede, c.Contraseña from persona as p

inner join persona_usuario as pu on pu.ID_Persona = p.ID_Persona
inner join participante as par on par.ID_Persona_Usuario = pu.ID_Persona_Usuario
inner join grupo as parg on parg.ID_Grupo = par.ID_Grupo
inner join credenciales as c on c.ID_Persona = p.ID_Persona
inner join grupo as g on g.ID_Grupo = par.ID_Grupo

where p.ID_Persona = id_per and pu.ID_Tipo_Usuario = id_tipou and pu.Activo=1 and p.Activo = 1;


END
/*****************************************************************************************/
CREATE DEFINER=`` PROCEDURE `Prueba_DetEvento`(in idpersona bigint)
BEGIN
declare id_per int default idpersona;
declare id_tipou int default 1;

select  pro.Nombre as Nombre_Proyecto, cat.Nombre_Categoria, sub.Nombre_Subcategoria, eve.Nombre_Evento

from persona as p

inner join persona_usuario as pusu on pusu.ID_Persona =p.Id_Persona
inner join participante as par on par.ID_Persona_Usuario = pusu.ID_Persona_Usuario
inner join participante_proyecto as ppro on ppro.Id_Participante = par.Id_Numero_Carnet
inner join proyecto as pro on pro.Id_Proyecto = ppro.Id_Proyecto

inner join categoria_evento as cae on cae.ID_Categoria_Evento = pro.ID_Categoria_Evento
inner join categoria_subcategoria as casub on casub.ID_Categoria_SubCategoria=  cae.ID_Categoria_SubCategoria
inner join categoria as cat on cat.ID_Categoria = casub.ID_Categoria
inner join subcategoria as sub on sub.ID_SubCategoria = casub.ID_SubCategoria

inner join evento_proyecto as epro on epro.ID_Participante_Proyecto = ppro.ID_Participante_Proyecto
inner join evento as eve on eve.ID_Evento = epro.ID_Evento

where p.ID_Persona = id_per and p.Activo = 1;

END

/*****************************************************************************************/

CREATE DEFINER=`` PROCEDURE `Insercion_PersonaParticipante`(in pnombre varchar(50),in snombre varchar(50), in papellido varchar(50), sapellido varchar(50), in telefono char(16), in correo varchar(100),in vsede bigint, in vgrupo bigint, in usuario varchar(20), in contraseña varchar(200), in ncarnet varchar(10), in cedula char(20), in avatar varchar(45))
BEGIN
	
    declare p_pnombre varchar(50) default upper(trim(pnombre));
    declare p_snombre varchar(50) default upper(trim(snombre));
    declare p_papellido varchar(50) default upper(trim(papellido));
    declare p_sapellido varchar(50) default upper(trim(sapellido));
    declare p_tel char(16) default telefono;
    declare p_correo varchar(100) default correo;
    declare p_sede bigint default vsede;
    declare p_usuario varchar(20) default usuario;
    declare p_contra varchar(200) default contraseña;
    declare p_ncarnet varchar(10) default ncarnet;
	declare p_avatar varchar(45) default avatar;
    declare p_cedula char(20) default cedula;
    declare valor char(20) default NULL;
    declare p_grupo int default vgrupo;

    
    if (cedula = '') then
	set p_cedula = valor;
    end if;

    
    Insert persona
    (Primer_Nombre, Segundo_Nombre, Primer_Apellido, Segundo_Apellido, Telefono, Correo_Electronico,Cedula,Avatar,Activo)
    values
    (p_pnombre,p_snombre,p_papellido,p_sapellido,p_tel,p_correo,p_cedula,p_avatar,1);
    
    insert into credenciales
    (Id_Persona,Usuario, Contraseña,Activo)
    values
    ((SELECT MAX(ID_Persona) as last_id FROM persona),p_usuario,p_contra,1);
    
    insert into persona_usuario
    (ID_Tipo_Usuario,ID_Persona,Activo)
    values
    (1,(SELECT MAX(ID_Persona) as last_id FROM persona),1);
    
    
    insert into participante
    (Id_Numero_Carnet,ID_Persona_Usuario,CodigoRegistro,ID_Sede,ID_Grupo,Activo)
    values
    (p_ncarnet,(SELECT MAX(ID_Persona_Usuario) as last_id FROM persona_usuario),(((SELECT MAX(ID_Persona) as last_id FROM persona)*2)-1),p_sede,p_grupo,1);
END

/*****************************************************************************************/

CREATE DEFINER=`` PROCEDURE `Buscar_Telefono`(in tel char(16))
BEGIN
	Declare ptel char(16) default tel;
    
    Select count(Telefono) as coincidencia from persona  where Telefono = ptel and Activo = 1; 
END

/*****************************************************************************************/

CREATE DEFINER=`` PROCEDURE `Buscar_CorreoE`(in email varchar(100))
BEGIN
	Declare pcorreo varchar(100) default upper(trim(email));
    
    Select count(Correo_Electronico) as coincidencia from persona  where Correo_Electronico = pcorreo and Activo = 1; 
END

/*****************************************************************************************/

CREATE DEFINER=`` PROCEDURE `Buscar_Usuario`(in usu varchar(20))
BEGIN
	Declare p_usuario varchar(20) default usu;
    
    Select count(Usuario) as coincidencia from credenciales  where Usuario = p_usuario and Activo = 1; 
END


/*****************************************************************************************/

CREATE DEFINER=`` PROCEDURE `Buscar_Carnet`(in carnet varchar(10))
BEGIN
	Declare pcarnet varchar(10) default carnet;
    Select count(Id_Numero_Carnet) as coincidencia from participante  where Id_Numero_Carnet = pcarnet and Activo = 1; 
END

/*****************************************************************************************/

CREATE DEFINER=`` PROCEDURE `Obtener_Usuario_PersonalAcademico`(in usuario varchar(20), in contra varchar(200))
BEGIN

declare pusuario varchar(20) default usuario;
declare pcontra varchar(200) default contra;
    
select c.Usuario, c.Contraseña, c.ID_Persona from credenciales as c

inner join persona as p on c.ID_Persona = p.ID_Persona
inner join persona_usuario as u on p.ID_Persona = u.ID_Persona
inner join personal_academico as a on u.ID_Persona_Usuario = a.ID_Persona_Usuario

where c.Usuario = pusuario and c.Contraseña = pcontra  and c.Activo = 1;

END


/*****************************************************************************************/

CREATE DEFINER=`` PROCEDURE `Listar_Tipo_Usuario`(in id_persona bigint)
BEGIN
	
	
select concat('<option value ="',t.ID_Tipo_Usuario,'"','>',t.Tipo_Usuario,'</option>')
    
from persona_usuario as p inner join tipo_usuario as t 
    
on t.ID_Tipo_Usuario = p.ID_Tipo_Usuario
    
where p.Activo = 1 and t.Activo = 1 and p.ID_Persona = id_persona order by t.ID_Tipo_Usuario;


END


/*****************************************************************************************/

CREATE DEFINER=`` PROCEDURE `Cargar_Acceso_PersonaUsuario`(in idpersona bigint, in idtipousuario bigint)
BEGIN
	
declare id_per int default idpersona;
declare id_tipou int default idtipousuario;

	
select p.Primer_Nombre, p.Primer_Apellido,p.Telefono,p.Correo_Electronico, pu.ID_Tipo_Usuario from persona as p
	inner join persona_usuario as pu on pu.ID_Persona = p.ID_Persona
	
where p.ID_Persona = id_per and pu.ID_Tipo_Usuario = id_tipou and pu.Activo=1 and p.Activo = 1;

END

/*****************************************************************************************/

CREATE DEFINER=`` PROCEDURE `Obtener_Usuario_Participante`(in usuario varchar(20), in contra varchar(200))
BEGIN

declare pusuario varchar(20) default usuario;
declare pcontra varchar(200) default contra;

	
select c.Usuario, c.Contraseña, c.ID_Persona from credenciales as c
    
inner join persona as p on c.ID_Persona = p.ID_Persona	
inner join persona_usuario as u on p.ID_Persona = u.ID_Persona
inner join participante as a on u.ID_Persona_Usuario = a.ID_Persona_Usuario
    
where c.Usuario = pusuario and c.Contraseña = pcontra  and c.Activo = 1;

END

/*****************************************************************************************/

CREATE PROCEDURE `Listar_TipoU`()
BEGIN
select concat ('<option value ="',Id_Tipo_Usuario,'"','>',Tipo_Usuario,'</option>')
    from tipo_usuario
    where  ID_Tipo_Usuario not in (1) and Activo = 1
    order by ID_Tipo_Usuario;

END


/********************************************************************************************/

CREATE PROCEDURE `Insercion_PersonaAcademica`(in pnombre varchar(50),in snombre varchar(50), in papellido varchar(50), sapellido varchar(50),
 in telefono char(16), in correo varchar(100),in tipou bigint, in usuario varchar(20), 
 in contraseña varchar(200), in cedula char(20), in avatar varchar(45))
BEGIN

declare p_pnombre varchar(50) default upper(trim(pnombre));
    declare p_snombre varchar(50) default upper(trim(snombre));
    declare p_papellido varchar(50) default upper(trim(papellido));
    declare p_sapellido varchar(50) default upper(trim(sapellido));
    declare p_tel char(16) default telefono;
    declare p_correo varchar(100) default correo;
    declare p_tipo bigint default tipou;
    declare p_usuario varchar(20) default usuario;
    declare p_contra varchar(200) default contraseña;
    declare p_avatar varchar(45) default avatar;
    declare p_cedula char(20) default cedula;
    declare valor char(20) default NULL;
  
    
    if (cedula = '') then
	set p_cedula = valor;
    end if;
    
    Insert persona
    (Primer_Nombre, Segundo_Nombre, Primer_Apellido, Segundo_Apellido, Telefono, Correo_Electronico,Cedula,Avatar,Activo)
    values
    (p_pnombre,p_snombre,p_papellido,p_sapellido,p_tel,p_correo,p_cedula,p_avatar,1);
    
    insert into credenciales
    (Id_Persona,Usuario, Contraseña,Activo)
    values
    ((SELECT MAX(ID_Persona) as last_id FROM persona),p_usuario,p_contra,1);
    
    insert into persona_usuario
    (ID_Tipo_Usuario,ID_Persona,Activo)
    values
    (p_tipo,(SELECT MAX(ID_Persona) as last_id FROM persona),1);
    
    insert into personal_academico
    (ID_Persona_Usuario,ID_Grado_Academico,ID_Cargo,ID_Sede,Activo)
    values
    ((SELECT MAX(ID_Persona_Usuario) as last_id FROM persona_usuario),2,6,1,1);
    
    
    
END
