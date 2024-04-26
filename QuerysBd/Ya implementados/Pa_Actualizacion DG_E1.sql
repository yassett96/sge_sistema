-- PlanificacionE.php --
CREATE  PROCEDURE `Cargar_DatosGEvento`()
BEGIN
	
    declare id_Eactual int;

	SET id_Eactual = Obtener_EventoActual();
    
    Select ID_Evento, Nombre_Evento,Eslogan, hora, Fecha from evento
    
    
    where ID_Evento =  id_Eactual and Activo = 1 and ID_Tipo_Evento=1;
END

/****************************/

CREATE  FUNCTION `Obtener_SitioEventoActual`() RETURNS int(11)
BEGIN
    DECLARE IdSitioEventoA INT;
    Select ID_Sitio INTO IdSitioEventoA from evento Where Activo=1 and Year(Fecha) = Year(CurDate());
    RETURN IdSitioEventoA;
END

/****************************/

CREATE  PROCEDURE `Lista_Sitio_DGE1`()
BEGIN

	declare id_SitioEA int;
	SET id_SitioEA = Obtener_SitioEventoActual();
    
	select concat ('<option value ="',S.ID_Sitio,'"',IF(S.ID_Sitio = id_SitioEA, 'selected',''),'>',S.Nombre_Sitio,'</option>')
    from sitio as S
    where Activo = 1 
    order by ID_Sitio;
END

/******************************/

CREATE  PROCEDURE `Actualizar_DatosGeneralesEvento`(in ptipo_evento bigint, in pnombre_evento varchar(255),
 in peslogan_evento varchar(300),in plogo_evento varchar(255), in phora_evento time,in pfecha_evento date, 
 in plugar_evento bigint, in pid_eventoa bigint )
BEGIN
	declare p_tipoE bigint default ptipo_evento;
	declare p_nombreE varchar(255) default (trim(pnombre_evento));  
    declare p_esloganE varchar(300) default (trim(peslogan_evento)); 
    declare p_logoE varchar(255) default plogo_evento;
    declare p_horaE time default  phora_evento;
    declare p_fechaE date default pfecha_evento;
    declare p_lugarE bigint default plugar_evento;
    declare p_ideventoa bigint default pid_eventoa;
    
    update evento set
    Nombre_Evento=p_nombreE,Eslogan=p_esloganE,Logo=p_logoE,hora=p_horaE,Fecha=p_fechaE,Id_Sitio=p_lugarE
    
    where
    ID_Evento = p_ideventoa and Activo=1; 
    
END

/**********************************************/

CREATE  PROCEDURE `Insertar_DatosGeneralesEvento`(in ptipo_evento bigint, in pnombre_evento varchar(255),
 in peslogan_evento varchar(300),in plogo_evento varchar(255), in phora_evento time,in pfecha_evento date, 
 in plugar_evento bigint )
BEGIN
	declare p_tipoE bigint default ptipo_evento;
	declare p_nombreE varchar(255) default (trim(pnombre_evento));  
    declare p_esloganE varchar(300) default (trim(peslogan_evento)); 
    declare p_logoE varchar(255) default plogo_evento;
    declare p_horaE time default  phora_evento;
    declare p_fechaE date default pfecha_evento;
    declare p_lugarE bigint default plugar_evento;
    
    Insert into evento
    (Id_Tipo_Evento,Nombre_Evento,Eslogan,Logo,hora,Fecha,Id_Sitio,Activo)
    values
    (p_tipoE,p_nombreE,p_esloganE,p_logoE,p_horaE,p_fechaE,p_lugarE,1);
END