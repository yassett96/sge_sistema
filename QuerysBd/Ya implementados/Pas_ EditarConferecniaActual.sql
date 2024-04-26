/*********************************

Actualizar Procedimiento */

CREATE  PROCEDURE `Listar_ConferenciasEventoActual`()
BEGIN
Declare idEvento int;
SET idEvento = Obtener_EventoActual();
																								
Select  concat('<tr><td id="Anchio"><input hidden value = "',CE.ID_Conferencia_Evento,'"></td><td class="NombreConFE">',CE.Nombre_Conferencia,'</td><td>',CE.Nombre_Conferencista,'</td><td>',CE.Detalles_Conferencista,'</td><td>',DATE_FORMAT(CE.Hora_Inicio, '%h:%i %p'),'</td><td>',DATE_FORMAT(CE.Hora_Fin, '%h:%i %p'),'</td><td>',ss.NombreSalon,'</td><td><button  type="button" id="BtnEliminarConFE" class=" btn-light CE" >Eliminar Conferencia</button></td></tr>')
     from conferencia_evento CE
     inner join salon ss on CE.ID_Salon = ss.ID_Salon
     
    where  CE.Activo = 1 and ss.Activo=1
    AND (CE.ID_Evento = idEvento)
    order by CE.Hora_Inicio;

END

/*****************************
Procedimiento a crear */

CREATE PROCEDURE `Cargar_DatosConferenciaEvento`(in IDconferencia int)
BEGIN
	 declare p_idconf int default IDconferencia;
    
    Select Nombre_Conferencia,Nombre_Conferencista,Detalles_Conferencista,Hora_Inicio,Hora_Fin,ID_Salon 
    from conferencia_evento
    where ID_Conferencia_Evento = p_idconf
    and Activo = 1;
END

/*****************************/

CREATE  PROCEDURE `Cargar_ListaSalonConferencia`(in idsitioE bigint, in idsalonconf bigint)
BEGIN

declare p_idsitio int default idsitioE;
declare p_idsalonc int default idsalonconf;


     select concat ('<option value ="',s.ID_Salon,'"',IF(s.ID_Salon = p_idsalonc, 'selected',''),'>',s.NombreSalon,'</option>')
     from sitio_salon ss
     inner join salon s  on ss.ID_Salon = s.ID_Salon
     inner join sitio st on ss.ID_Sitio = st.ID_Sitio
     
    where s.Activo = 1 and st.Activo = 1 
    AND (st.ID_Sitio = p_idsitio)
    order by ID_Sitio_Salon;


END

/*********************/

CREATE  PROCEDURE `Actualizar_Conferencia`(in idconfEA bigint,in NomConf varchar(100), in NombreConfer varchar(100), in DetConfer varchar(100),in HoraInicio TIME, in HoraFin TIME, In IdSalonC bigint )
BEGIN
	declare p_idconfea bigint default idconfEA;
    
	declare p_NombreConferencia varchar(100) default (trim(NomConf));
	declare p_NomConferencista varchar(100) default (trim(NombreConfer));	
	declare p_DetConferencista varchar(100) default (trim(DetConfer));
	declare p_HoraI time default HoraInicio;
	declare p_HoraF time default HoraFin;
	declare p_idsalon int default IdSalonC;
    
    UPDATE conferencia_evento set Nombre_Conferencia=p_NombreConferencia, Nombre_Conferencista=p_NomConferencista, Detalles_Conferencista=p_DetConferencista, 
    Hora_Inicio=p_HoraI,Hora_Fin=p_HoraF,ID_Salon=p_idsalon 
    where ID_Conferencia_Evento =p_idconfea and Activo = 1;
    
END

/************************/

CREATE PROCEDURE `VerificarRangoConferenciasUPDATE`(IN p_hora_inicio TIME, IN p_hora_fin TIME, in psalon int, in idConfEA bigint)
BEGIN
	declare p_idconea int default idConfEA;
	declare id_EA int;
	SET id_EA = Obtener_EventoActual();
    
SELECT COUNT(*) AS p_num_conflictos
FROM conferencia_evento AS ce
WHERE ce.ID_Evento = id_EA and ce.ID_Salon = psalon and ce.Activo=1
AND ((p_hora_inicio >= ce.Hora_Inicio AND p_hora_inicio < ce.Hora_Fin)
OR (p_hora_fin > ce.Hora_Inicio AND p_hora_fin <= ce.Hora_Fin)
OR (p_hora_inicio < ce.Hora_Inicio AND p_hora_fin > ce.Hora_Fin))
And ce.ID_Conferencia_Evento != p_idconea;
END


/***********************/
