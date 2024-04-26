-- Actualizar Procedimiento--
-- PlanificacionE ----

CREATE PROCEDURE `Cargar_DatosGEvento`()
BEGIN
	
    declare id_Eactual int;

	SET id_Eactual = Obtener_EventoActual();
    
    Select ID_Evento, Nombre_Evento,Eslogan, hora, Fecha, Logo,ID_Sitio from evento
    
    
    where ID_Evento =  id_Eactual and Activo = 1 and ID_Tipo_Evento=1;
END


-- MPersona ---

CREATE  PROCEDURE `Insercion_PersonaParticipante`(in pnombre varchar(50),in snombre varchar(50), in papellido varchar(50), sapellido varchar(50), in telefono char(16), in correo varchar(100),in vsede bigint, in vgrupo bigint, in usuario varchar(20), in contraseña varchar(200), in ncarnet varchar(10), in cedula char(20), in avatar varchar(45))
BEGIN
	
    declare p_pnombre varchar(50) default (trim(pnombre));
    declare p_snombre varchar(50) default (trim(snombre));
    declare p_papellido varchar(50) default (trim(papellido));
    declare p_sapellido varchar(50) default (trim(sapellido));
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

-- MAcademico --

CREATE PROCEDURE `Insercion_PersonaAcademica`(in pnombre varchar(50),in snombre varchar(50), in papellido varchar(50), sapellido varchar(50),
 in telefono char(16), in correo varchar(100),in tipou bigint, in usuario varchar(20), 
 in contraseña varchar(200), in cedula char(20), in avatar varchar(45))
BEGIN

declare p_pnombre varchar(50) default (trim(pnombre));
    declare p_snombre varchar(50) default (trim(snombre));
    declare p_papellido varchar(50) default (trim(papellido));
    declare p_sapellido varchar(50) default (trim(sapellido));
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

-- Nuevo Procedimiento --
-- MConferencia --

CREATE  PROCEDURE `Cargar_ListaSalon`(in idsitioE bigint)
BEGIN

declare p_idsitio int default idsitioE;


     select concat ('<option value ="',s.ID_Salon,'"','>',s.NombreSalon,'</option>')
     from sitio_salon ss
     inner join salon s  on ss.ID_Salon = s.ID_Salon
     inner join sitio st on ss.ID_Sitio = st.ID_Sitio
     
    where s.Activo = 1 and st.Activo = 1 
    AND (st.ID_Sitio = p_idsitio)
    order by ID_Sitio_Salon;


END

/*******************************************/

CREATE  PROCEDURE `VerificarRangoConferencias2`(IN p_hora_inicio TIME, IN p_hora_fin TIME, in psalon int)
BEGIN

  declare id_EA int;
	SET id_EA = Obtener_EventoActual();
    
SELECT COUNT(*) AS p_num_conflictos
FROM conferencia_evento AS ce
WHERE ce.ID_Evento = id_EA and ce.ID_Salon = psalon and ce.Activo=1
AND ((p_hora_inicio >= ce.Hora_Inicio AND p_hora_inicio < ce.Hora_Fin)
OR (p_hora_fin > ce.Hora_Inicio AND p_hora_fin <= ce.Hora_Fin)
OR (p_hora_inicio < ce.Hora_Inicio AND p_hora_fin > ce.Hora_Fin));
END

/*******************************/

CREATE  PROCEDURE `Agregar_Conferencia`(in NomConf varchar(100), in NombreConfer varchar(100), in DetConfer varchar(100),in HoraInicio TIME, in HoraFin TIME, In IdSalonC bigint)
BEGIN

 declare p_NombreConferencia varchar(100) default (trim(NomConf));
 declare p_NomConferencista varchar(100) default (trim(NombreConfer));
 declare p_DetConferencista varchar(100) default (trim(DetConfer));
 declare p_HoraI time default HoraInicio;
 declare p_HoraF time default HoraFin;
 declare p_idsalon int default IdSalonC;
 declare id_EA int;

	SET id_EA = Obtener_EventoActual();
    
    insert into conferencia_evento
    (Nombre_Conferencia, Nombre_Conferencista,Detalles_Conferencista,Hora_Inicio,Hora_Fin,ID_Salon,ID_Evento,Activo)
    values
    (p_NombreConferencia,p_NomConferencista,p_DetConferencista,p_HoraI, p_HoraF,p_idsalon,id_EA,1);
 
 

END

/******************************/

CREATE  PROCEDURE `Listar_ConferenciasEventoActual`()
BEGIN
Declare idEvento int;
SET idEvento = Obtener_EventoActual();

    
    SELECT  CONCAT('<tr><td id="Anchio"><input hidden value="',CE.ID_Conferencia_Evento,'"></td><td class="ordenConE">', ROW_NUMBER() OVER (ORDER BY CE.Hora_Inicio), '</td><td class="NombreConFE">', CE.Nombre_Conferencia, '</td><td>', CE.Nombre_Conferencista, '</td><td>', CE.Detalles_Conferencista, '</td><td>', DATE_FORMAT(CE.Hora_Inicio, '%h:%i %p'), '</td><td>', DATE_FORMAT(CE.Hora_Fin, '%h:%i %p'), '</td><td>', ss.NombreSalon, '</td><td><button type="button" id="BtnEliminarConFE" class="btn-light CE">Eliminar Conferencia</button></td></tr>')
    FROM conferencia_evento CE
    INNER JOIN salon ss ON CE.ID_Salon = ss.ID_Salon
    WHERE CE.Activo = 1 AND ss.Activo = 1 AND CE.ID_Evento = idEvento
    ORDER BY CE.Hora_Inicio;
    

    
  
END

/**************************/

CREATE  PROCEDURE `Eliminar_ConferenciaE`(in idconfe bigint)
BEGIN

declare id_confe bigint default idconfe;
	
    
    UPDATE conferencia_evento set Activo = 0 where ID_Conferencia_Evento = id_confe;
    
   
END