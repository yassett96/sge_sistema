/* Procedimientos Y funcuiones */
/******************************/
CREATE DEFINER=`root`@`localhost` FUNCTION `Obtener_IDComisionEA`() RETURNS varchar(255) CHARSET utf8mb4
BEGIN
    DECLARE idEvento INT;
    DECLARE comisionesEA VARCHAR(255);
    
    SELECT ID_Evento INTO idEvento FROM evento WHERE Activo = 1 AND YEAR(Fecha) = YEAR(CURDATE());
    
    SELECT GROUP_CONCAT(ID_Comision_Evento SEPARATOR ',') INTO comisionesEA FROM comision_evento WHERE Activo = 1 AND ID_Evento = idEvento;
    
    RETURN comisionesEA;
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Cargar_DatosComisionA_Persona`(in idPersona bigint)
BEGIN
	declare p_idpersona int default idPersona;
    
    declare id_PA int;
    declare idEvento int;
    declare idscomisionevento text;
    
	SET idEvento = Obtener_EventoActual();
	SET id_PA = Obtener_IdPA(p_idpersona);
    SET idscomisionevento= Obtener_IDComisionEA(); 

    
    Select ce.ID_Comision_Evento, c.Nombre_Comision from integrante_comision as IC

    inner join comision_evento as ce on ce.ID_Comision_Evento = IC.ID_Comision_Evento
    inner join Comision as c on c.ID_Comision = ce.ID_Comision
    
    where FIND_IN_SET(IC.ID_Comision_Evento, idscomisionevento) > 0
    and IC.ID_Personal_Academico = id_PA;

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Responsable1_ComisionEvento`(in idcomisione bigint)
BEGIN

declare p_idcea int default idcomisione;

select p.ID_Persona, concat(p.Primer_Nombre,' ',p.Primer_Apellido) as NombreC from integrante_comision as IC

inner join personal_academico as PA on PA.ID_Personal_Academico = IC.ID_Personal_Academico
inner join persona_usuario as PU on PU.ID_Persona_Usuario = PA.ID_Persona_Usuario
inner join persona as p on p.ID_Persona = PU.ID_Persona


where IC.Responsable=1 and IC.ID_Comision_Evento = p_idcea AND PU.Activo = 1 and PU.ID_Tipo_Usuario in (3,4);

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_DatosComisionA_Persona`(in idPersona bigint)
BEGIN
	declare p_idpersona int default idPersona;
    
    declare id_PA int;
    declare idEvento int;
    declare idscomisionevento text;
    
	SET idEvento = Obtener_EventoActual();
	SET id_PA = Obtener_IdPA(p_idpersona);
    SET idscomisionevento= Obtener_IDComisionEA(); 

    select concat('<option value ="',ce.ID_Comision_Evento,'"','>', c.Nombre_Comision,'</option>') 
    
    from integrante_comision as IC

    inner join comision_evento as ce on ce.ID_Comision_Evento = IC.ID_Comision_Evento
    inner join Comision as c on c.ID_Comision = ce.ID_Comision
    
    where FIND_IN_SET(IC.ID_Comision_Evento, idscomisionevento) > 0
    and IC.ID_Personal_Academico = id_PA;

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Responsable2_ComisionEvento`(in idcomisione bigint)
BEGIN

declare p_idcea int default idcomisione;

select p.ID_Persona, concat(p.Primer_Nombre,' ',p.Primer_Apellido) as NombreC from integrante_comision as IC

inner join personal_academico as PA on PA.ID_Personal_Academico = IC.ID_Personal_Academico
inner join persona_usuario as PU on PU.ID_Persona_Usuario = PA.ID_Persona_Usuario
inner join persona as p on p.ID_Persona = PU.ID_Persona


where IC.Responsable=2 and IC.ID_Comision_Evento = p_idcea AND PU.Activo = 1 and PU.ID_Tipo_Usuario in (3,4);

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Responsable3_ComisionEvento`(in idcomisione bigint)
BEGIN

declare p_idcea int default idcomisione;

select p.ID_Persona, concat(p.Primer_Nombre,' ',p.Primer_Apellido) as NombreC from integrante_comision as IC

inner join personal_academico as PA on PA.ID_Personal_Academico = IC.ID_Personal_Academico
inner join persona_usuario as PU on PU.ID_Persona_Usuario = PA.ID_Persona_Usuario
inner join persona as p on p.ID_Persona = PU.ID_Persona


where IC.Responsable=3 and IC.ID_Comision_Evento = p_idcea AND PU.Activo = 1 and PU.ID_Tipo_Usuario in (3,4);

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Obtener_NombreIntegrantesCA`(in ID_ComisionAsi bigint)
BEGIN

Declare p_idcomasig bigint default ID_ComisionAsi;
    
    select concat ('<option value ="',IC.ID_Integrante_Comision,'"','>', P.Primer_Nombre,' ',P.Segundo_Nombre,
	' ',P.Primer_Apellido,' ',P.Segundo_Apellido,'</option>')
	
    from integrante_comision IC
    inner join personal_academico as  PA on PA.ID_Personal_Academico =IC.ID_Personal_Academico
	inner join persona_usuario PU  on PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
	inner join Persona P on  P.ID_Persona = PU.ID_Persona
    where  PA.Activo = 1 and PU.Activo = 1 AND P.Activo = 1
    AND (IC.ID_Comision_Evento = p_idcomasig);
   
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Listar_ComisionEvento_Actividad`(in id_ComisionAsig bigint )
BEGIN
	Declare p_idcomasig bigint default id_ComisionAsig;
    Declare idEvento int;
	SET idEvento = Obtener_EventoActual();
    
	select concat ('<option value ="',CE.ID_Comision_Evento,'"','>', C.Nombre_Comision,'</option>')
    
    from comision_evento CE
	inner join comision C on  CE.ID_Comision = C.ID_Comision
    where C.Activo = 1 and CE.Activo = 1
    AND CE.ID_Evento = idEvento
    AND CE.ID_Comision_Evento != p_idcomasig;
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_ComisionApoyo_Sel`(in id_ComisionAsig bigint)
BEGIN
	Declare p_idcomasig bigint default id_ComisionAsig;
	Declare idEvento int;
	SET idEvento = Obtener_EventoActual();
    SET @REG=0;

	Select  concat('<tr><td id="Anchio"><input hidden value = "',CE.ID_Comision_Evento,'"></td><td class="ordenCE">',@REG:= @REG+1,'</td><td class="NombreCEA">',C.Nombre_Comision,'</td><td><button  type="button" id="BtnEliminarCE" class=" btn-light CE" onclick="eliminarFila(this)"  >Eliminar Comisión</button></td></tr>')
	from comision_evento CE
     
	inner join comision C on  CE.ID_Comision = C.ID_Comision
    where C.Activo = 1 and CE.Activo = 1
    AND (CE.ID_Evento = idEvento)
    AND CE.ID_Comision_Evento = p_idcomasig;
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Obtener_NombrePAcademico_Comision`(in Id_personaA bigint)
BEGIN

Declare p_idper bigint default Id_personaA;

SET @REG=0;
Select DISTINCT concat('<tr><td id="Anchio"><input hidden value = "',IC.ID_Integrante_Comision,'"></td><td class="ordenIn">',@REG:= @REG+1,'</td><td>', P.Primer_Nombre,' ',P.Segundo_Nombre,
' ',P.Primer_Apellido,' ',P.Segundo_Apellido,'</td><td><button  type="button"  class=" btn-light IC" onclick="eliminarFila(this)" >Eliminar Integrante</button></td></tr>')

	from integrante_comision IC
    inner join personal_academico as  PA on PA.ID_Personal_Academico =IC.ID_Personal_Academico
     inner join persona_usuario PU  on PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
     inner join Persona P on  P.ID_Persona = PU.ID_Persona
    where  PA.Activo = 1 and PU.Activo = 1 AND P.Activo = 1
    AND (IC.ID_Integrante_Comision = p_idper);
    

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Listar_PersonaParaApoyo_Select`()
BEGIN

	select concat ('<option value ="',ID_PersonalApoyo,'"','>', NombreApoyos,'</option>')
    
    from personalapoyo
    where Activo = 1;
    
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Listar_PersonaParaApoyo_Tabla`(in id_PersonaApoyo bigint)
BEGIN
	Declare p_idpersonaApoyoA bigint default id_PersonaApoyo;
	
    SET @REG=0;

	Select  concat('<tr><td id="Anchio"><input hidden value = "',ID_PersonalApoyo,'"></td><td class="ordenPAA">',@REG:= @REG+1,'</td><td class="NombrePAA">',NombreApoyos,'</td><td><button  type="button" id="BtnEliminarPA" class=" btn-light PAA" onclick="eliminarFila(this)"  >Quitar participante</button></td></tr>')
	 from personalapoyo
    where Activo = 1
    AND ID_PersonalApoyo = p_idpersonaApoyoA;
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_ActividadComision`(in NombreAct varchar(100),in DescripAct varchar(400),in FechaI date, in FechaF date,IN DRequerimientos TEXT, IN NDReq INT, in DEncAct text, in NDEncAct int, in DComApoyo text, in NDComApoyo int, in DPerApoyo text, in NPerApoyo int,in IdComisionAsig bigint)
BEGIN
	
    declare p_idcoma int default IdComisionAsig; 
    declare p_nacti varchar(100) default NombreAct;
    declare p_descrip varchar(400) default DescripAct;
    declare p_fechai date default FechaI;
    declare p_fechaf date default FechaF;
    declare p_dreq  text default DRequerimientos; /**/
	declare p_requerimiento varchar(300); /**/
    declare p_creq int default NDReq;  /**/
    declare p_denc  text default DEncAct;  /**/
	declare p_idencargado bigint; /**/
    declare p_cenc int default NDEncAct; /**/
    declare p_dcomapoyo  text default DComApoyo; /**/
	declare p_idcomisiona bigint;/**/
    declare p_ccomap int default NDComApoyo;/**/
	declare p_dpersonalapo text default DPerApoyo;
	declare p_idpapoyo bigint;
    declare p_cperap int default NPerApoyo;
	declare delimitador CHAR(1) DEFAULT ',';
	declare contador1 INT DEFAULT 1;
    declare contador2 INT DEFAULT 1;
    declare contador3 INT DEFAULT 1;
    declare contador4 INT DEFAULT 1;
    declare idActividad int;
    declare idcomisionactividad int;
    declare idrequerimiento int;
    
    Insert into actividad (NombreActividad, Descripcion,FechaInicio,FechaFin,Activo) values (p_nacti,p_descrip,p_fechai,p_fechaf,1);
    set idActividad = last_insert_id();
    
    Insert into comision_actividad (ID_Comision_Evento,ID_Actividad,ID_Estado,Activo) values (p_idcoma,idActividad,4,1);
    set idcomisionactividad = last_insert_id();
    
    if p_dreq is not null then
		while contador1 <= p_creq do
			set p_requerimiento = TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX( p_dreq, delimitador, contador1), delimitador, -1));
			insert into requerimientos (NombreRequerimientos,Activo) values (p_requerimiento,1);
            set idrequerimiento = last_insert_id();
            insert into requerimiento_comisionactividad (ID_Comision_Actividad,ID_Requerimiento,Activo) values (idcomisionactividad,idrequerimiento,1);
			set contador1 = contador1 + 1;
		end while;
	end if;
    
    if p_denc is not null then
		while contador2 <= p_cenc do
			set p_idencargado = TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX( p_denc, delimitador, contador2), delimitador, -1));
			insert into responsable_actividad (ID_Comision_Actividad,ID_Integrante_Comision,Activo) values (idcomisionactividad,p_idencargado,1);
            set contador2 = contador2 + 1;
		end while;
	else
		insert into responsable_actividad (ID_Comision_Actividad,ID_Integrante_Comision,Activo) values (idcomisionactividad,NULL,1);
	end if;
    
    if p_dcomapoyo is not null then
		while contador3 <= p_ccomap do
			set p_idcomisiona = TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p_dcomapoyo, delimitador, contador3), delimitador, -1));
			insert into comisionapoyo_actividad (ID_Comision_Actividad,ID_Comision_Evento,Activo) values (idcomisionactividad,p_idcomisiona,1);
            set contador3 = contador3 + 1;
		end while;
	else
		insert into comisionapoyo_actividad (ID_Comision_Actividad,ID_Comision_Evento,Activo) values (idcomisionactividad,NULL,1);
	end if;
    
    if p_dpersonalapo is not null then
		while contador4 <= p_cperap do
			set p_idpapoyo = TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p_dpersonalapo, delimitador, contador4), delimitador, -1));
			insert into personalapoyo_actividad (ID_Comision_Actividad,ID_PersonalApoyo,Activo) values (idcomisionactividad,p_idpapoyo,1);
            set contador4 = contador4 + 1;
		end while;
	else
		insert into personalapoyo_actividad (ID_Comision_Actividad,ID_PersonalApoyo,Activo) values (idcomisionactividad,NULL,1);
	end if;

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Listar_ActividadComision`(in IdComisionAsignada bigint)
BEGIN
	Declare p_idcomasig int default IdComisionAsignada;

	SET @REG=0;

Select  concat('<tr><td id="Anchio"><input hidden value = "',CA.ID_Comision_Actividad,'"></td><td class="ordenConE">',@REG:= @REG+1,'</td><td class="NombreComA">',A.NombreActividad,'</td><td>',A.Descripcion,'</td><td>',DATE_FORMAT(A.FechaInicio	, '%d-%m-%Y'),'</td><td>',DATE_FORMAT(A.FechaFin	, '%d-%m-%Y'),'</td><td>',E.NombreEstado,'</td><td><button  type="button" id="BtnEliminarComA" class=" btn-light ComA" >Eliminar Actividad</button></td></tr>')
     
     from comision_actividad CA
     inner join actividad A on A.Id_Actividad = CA.ID_Actividad
     
     inner join estado_actividad E on E.ID_Estado = CA.ID_Estado
     
     
    where  CA.Activo = 1 and A.Activo=1
    AND (CA.ID_Comision_Evento = p_idcomasig)
    order by CA.ID_Comision_Actividad;

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Listar_IntegrantesComision`(in IdComisionAsignada bigint)
BEGIN

	Declare p_idcomasig int default IdComisionAsignada;
	SET @REG=0;
	Select DISTINCT concat('<tr><td id="Anchio"><input hidden value = "',IC.ID_Integrante_Comision,'"></td><td class="ordenComI">',@REG:= @REG+1,'</td><td>', P.Primer_Nombre,' ',P.Segundo_Nombre,' ',P.Primer_Apellido,' ',P.Segundo_Apellido,'</td></tr>')

	from integrante_comision IC
    inner join personal_academico as  PA on PA.ID_Personal_Academico =IC.ID_Personal_Academico
	inner join persona_usuario PU  on PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
	inner join Persona P on  P.ID_Persona = PU.ID_Persona
    where  PA.Activo = 1 and PU.Activo = 1 AND P.Activo = 1
    AND (IC.ID_Comision_Evento = p_idcomasig)
    
    GROUP BY IC.ID_Integrante_Comision;

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_RequerimientosActividad`(in Id_ComisionActividad bigint)
BEGIN

	Declare p_idcomactividad int default Id_ComisionActividad;
	SET @REG=0;

	Select  concat('<tr><td id="Anchio"><input hidden value = "',RA.ID_RequerimientoActividad,'"></td><td class="ordenRCA">',@REG:= @REG+1,'</td><td class="NombreCEA">',R.NombreRequerimientos,'</td></tr>')
	from requerimiento_comisionactividad RA
     
	inner join requerimientos R on  R.ID_Requerimiento = RA.ID_Requerimiento
    where RA.Activo = 1 and R.Activo = 1
    AND RA.ID_Comision_Actividad = p_idcomactividad;
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_ResponsablesActividad`(in Id_ComisionActividad bigint)
BEGIN

	Declare p_idcomactividad int default Id_ComisionActividad;
	SET @REG=0;

	Select  concat('<tr><td id="Anchio"><input hidden value = "',RA.ID_Responsable_Actividad,'"></td><td class="ordenRCA">',@REG:= @REG+1,'</td><td>', P.Primer_Nombre,' ',P.Segundo_Nombre,' ',P.Primer_Apellido,' ',P.Segundo_Apellido,'</td></tr>')
	from responsable_actividad RA
     
	inner join integrante_comision IC on  IC.ID_Integrante_Comision = RA.ID_Integrante_Comision
    inner join personal_academico as  PA on PA.ID_Personal_Academico =IC.ID_Personal_Academico
	inner join persona_usuario PU  on PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
	inner join Persona P on  P.ID_Persona = PU.ID_Persona
    where RA.Activo = 1 and IC.Activo = 1 and PA.Activo = 1 and PU.Activo = 1 AND P.Activo = 1
    AND RA.ID_Comision_Actividad = p_idcomactividad;
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_ComisionApoyo_Actividad`(in Id_ComisionActividad bigint)
BEGIN

	Declare p_idcomactividad int default Id_ComisionActividad;
	
    SET @REG=0;

	Select  concat('<tr><td id="Anchio"><input hidden value = "',CA.ID_Comision_Evento,'"></td><td class="ordenCE">',@REG:= @REG+1,'</td><td class="NombreCEA">',C.Nombre_Comision,'</td></tr>')
	from comisionapoyo_actividad CA
    
    inner join comision_evento CE on CE.ID_Comision_Evento = CA.ID_Comision_Evento
	inner join comision C on  C.ID_Comision = CE.ID_Comision
    where CA.Activo = 1 and C.Activo = 1 and CE.Activo = 1
    AND CA.ID_Comision_Actividad = p_idcomactividad;
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_PersonalApoyo_Actividad`(in Id_ComisionActividad bigint)
BEGIN

	Declare p_idcomactividad int default Id_ComisionActividad;
	
    SET @REG=0;

	Select  concat('<tr><td id="Anchio"><input hidden value = "',PAA.ID_PersonalApoyo_CA,'"></td><td class="ordenCE">',@REG:= @REG+1,'</td><td class="NombreCEA">',A.NombreApoyos,'</td></tr>')
	from personalapoyo_actividad PAA
    
    inner join personalapoyo A on A.ID_PersonalApoyo = PAA.ID_PersonalApoyo
	
    where PAA.Activo = 1 and A.Activo = 1 
    AND PAA.ID_Comision_Actividad = p_idcomactividad;
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Eliminar_ActividadCom`(in Id_ComisionActividad bigint)
BEGIN

	Declare p_idcomactividad int default Id_ComisionActividad;
	
    SET SQL_SAFE_UPDATES=0;
    
	UPDATE comision_actividad CA
    JOIN actividad as A ON CA.ID_Actividad = A.Id_Actividad
	SET CA.Activo = 0, A.Activo = 0
	WHERE CA.ID_Comision_Actividad = p_idcomactividad;
    
    UPDATE requerimiento_comisionactividad RCA
    JOIN requerimientos as R ON RCA.ID_Requerimiento = R.ID_Requerimiento
	SET RCA.Activo = 0, R.Activo = 0
	WHERE  RCA.ID_Comision_Actividad = p_idcomactividad;
    
    UPDATE responsable_actividad set Activo = 0 where ID_Comision_Actividad = p_idcomactividad;
    UPDATE comisionapoyo_actividad set Activo = 0 where ID_Comision_Actividad = p_idcomactividad;
    UPDATE personalapoyo_actividad set Activo = 0 where ID_Comision_Actividad = p_idcomactividad;
    
    
    SET SQL_SAFE_UPDATES=1;
    
   
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` FUNCTION `Obtener_EstadoActividad`(Id_ComisionActividad bigint) RETURNS int(11)
BEGIN
	DECLARE ID_EstadoA int;
     
	SELECT E.ID_Estado INTO ID_EstadoA
    FROM comision_actividad as CA
    inner join estado_actividad E on E.ID_Estado = CA.ID_Estado
	where CA.ID_Comision_Actividad=Id_ComisionActividad
	and CA.Activo= 1 and E.Activo=1;
     
	RETURN ID_EstadoA;
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_EstadoAct`(in Id_ComisionActividad bigint)
BEGIN

	Declare p_idcomactividad int default Id_ComisionActividad;
    Declare idestadoAct int;
    
    set idestadoAct = Obtener_EstadoActividad(p_idcomactividad);

	select concat ('<option value="',ID_Estado,'"',IF(ID_Estado = idestadoAct, 'selected',''),'>' ,NombreEstado, '</option>')
		FROM estado_actividad
		WHERE Activo = 1 ;
    
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Actualizar_EstadoAct`(in IdEstadoA bigint, in IdComAct bigint )
BEGIN
	declare p_idestado bigint default IdEstadoA;
	declare p_idcomact  bigint default IdComAct;
    
    UPDATE comision_actividad set ID_Estado =  p_idestado where ID_Comision_Actividad = p_idcomact and Activo = 1;
    
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerDatosTotalesAct`(in IdComisionActividad bigint)
BEGIN
	declare p_idComAct int default IdComisionActividad;
    
    select (select count(ID_Estado) as ACTFinalizadas  from comision_actividad where ID_Estado=3 and ID_Comision_Evento = p_idComAct
			and Activo= 1) as TotalFAct,
			(select count(ID_Estado) as ACTTotales  from comision_actividad where /*ID_Estado != 3 and*/ ID_Comision_Evento = p_idComAct 
			and Activo = 1) as TotalTAct;

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerCorreoR1_ComisionEvento`(in idcomisione bigint)
BEGIN

declare p_idcea int default idcomisione;

select p.ID_Persona, p.Correo_Electronico from integrante_comision as IC

inner join personal_academico as PA on PA.ID_Personal_Academico = IC.ID_Personal_Academico
inner join persona_usuario as PU on PU.ID_Persona_Usuario = PA.ID_Persona_Usuario
inner join persona as p on p.ID_Persona = PU.ID_Persona


where IC.Responsable=1 and IC.ID_Comision_Evento = p_idcea AND PU.Activo = 1 and PU.ID_Tipo_Usuario in (3,4);

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` FUNCTION `ObtenerID_integranteComision`(Id_persona bigint,Id_comisionevento bigint) RETURNS int(11)
BEGIN
    Declare F_IDPersona int default Id_persona;
    Declare F_IDComisionEvento int default Id_comisionevento;
    DECLARE F_IDPersonalAcademico int;
    Declare F_IDIntegranteComision int;
    
    SELECT pa.Id_Personal_Academico INTO F_IDPersonalAcademico
    FROM personal_academico pa 
    INNER JOIN persona_usuario pu ON pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
    INNER JOIN persona p ON p.ID_Persona = pu.Id_Persona
    WHERE pa.Activo = 1 AND pu.Activo = 1 AND pu.ID_Tipo_Usuario IN (3,4) AND p.Activo = 1 AND p.ID_Persona = F_IDPersona;
    
    SELECT ID_Integrante_Comision into F_IDIntegranteComision 
    FROM sge_bd_2.integrante_comision 
    where ID_Personal_Academico = F_IDPersonalAcademico and ID_Comision_Evento=F_IDComisionEvento;
    
    return F_IDIntegranteComision;
    
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insertar_SolitudRealizada`(in id_comisionenvia int, in id_comisionconsulta int, in id_integrantecomision int,in asunto varchar(200), in consulta varchar(1000), in fechaenvio date)
BEGIN
	declare p_idcomision_e int default id_comisionenvia;
    declare p_idcomision_con int default id_comisionconsulta;
    declare p_idintegrante int default  id_integrantecomision;
    declare p_asunto varchar(200) default (trim(asunto));
    declare p_consulta varchar(1000) default (trim(consulta));
    declare p_fechae date default fechaenvio;
    
    
    insert into  solicitudextra_comisionevento
	(ID_Comision_Evento_Consulta, IDComisionConsultada, ID_Integrante_Comision, Asunto, Solicitud, Fecha_Envio, Activo)
    values
    (p_idcomision_e,p_idcomision_con,p_idintegrante,p_asunto,p_consulta,p_fechae,1);
    
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerCorreoR2_ComisionEvento`(in idcomisione bigint)
BEGIN

declare p_idcea int default idcomisione;

select p.ID_Persona, p.Correo_Electronico from integrante_comision as IC

inner join personal_academico as PA on PA.ID_Personal_Academico = IC.ID_Personal_Academico
inner join persona_usuario as PU on PU.ID_Persona_Usuario = PA.ID_Persona_Usuario
inner join persona as p on p.ID_Persona = PU.ID_Persona


where IC.Responsable=2 and IC.ID_Comision_Evento = p_idcea AND PU.Activo = 1 and PU.ID_Tipo_Usuario in (3,4);

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerCorreoR3_ComisionEvento`(in idcomisione bigint)
BEGIN

declare p_idcea int default idcomisione;

select p.ID_Persona, p.Correo_Electronico from integrante_comision as IC

inner join personal_academico as PA on PA.ID_Personal_Academico = IC.ID_Personal_Academico
inner join persona_usuario as PU on PU.ID_Persona_Usuario = PA.ID_Persona_Usuario
inner join persona as p on p.ID_Persona = PU.ID_Persona


where IC.Responsable=3 and IC.ID_Comision_Evento = p_idcea AND PU.Activo = 1 and PU.ID_Tipo_Usuario in (3,4);

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Listar_SolicitudesRealizadas`(in Id_ComisionAsignada bigint)
BEGIN
	Declare p_idcomisionevento int default Id_ComisionAsignada;
	SET @REG=0;
    
	Select concat('<tr><td id="Anchio"><input hidden value = "',SR.ID_SolicitudComision,'"></td><td class="ordenConE">',@REG:= @REG+1,'</td><td>',SR.Asunto,'</td><td>',SR.Solicitud,'</td><td>',DATE_FORMAT(SR.Fecha_Envio, '%d-%m-%Y'),'</td><td>',C.Nombre_Comision,'</td><td>', P.Primer_Nombre,' ',P.Segundo_Nombre,' ',P.Primer_Apellido,' ',P.Segundo_Apellido,'</td></tr>')
    
    from solicitudextra_comisionevento SR
    
    inner join comision_evento CE on  CE.ID_Comision_Evento = SR.IDComisionConsultada
    inner join comision C on  CE.ID_Comision = C.ID_Comision
    
    inner join integrante_comision IC  on IC.ID_Integrante_Comision = SR.ID_Integrante_Comision
    inner join personal_academico PAca on IC.ID_Personal_Academico = PAca.ID_Personal_Academico
	inner join persona_usuario PU  on PAca.ID_Persona_Usuario = PU.ID_Persona_Usuario
	inner join Persona P on P.ID_Persona = PU.ID_Persona
    
    where SR.ID_Comision_Evento_Consulta = p_idcomisionevento
    and SR.Activo = 1 and CE.Activo = 1 and C.Activo = 1 and IC.Activo = 1 and PAca.Activo = 1 and PU.Activo = 1 and P.Activo = 1;
    
    
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Reporte_ActividadComision`(in IdComisionAsignada bigint)
BEGIN
	Declare p_idcomasig int default IdComisionAsignada;
    
    SET @REG=0;
SELECT
    CONCAT(
        '<tr><td id="Anchio"><input hidden value = "', CA.ID_Comision_Actividad, '"></td><td class="ordenConE">',
        @REG := @REG + 1,
        '</td><td class="NombreComA">',
        A.NombreActividad,
        '</td><td>',
        A.Descripcion,
        '</td><td>',
        DATE_FORMAT(A.FechaInicio, '%d-%m-%Y'),
        '</td><td>',
        DATE_FORMAT(A.FechaFin, '%d-%m-%Y'),
        '</td><td>',
        IFNULL(
            (
                SELECT GROUP_CONCAT(
					'• ',
                    P.Primer_Nombre,
                    ' ',
                    P.Segundo_Nombre,
                    ' ',
                    P.Primer_Apellido,
                    ' ',
                    P.Segundo_Apellido SEPARATOR '<br>'
                )
                FROM responsable_actividad RA
                INNER JOIN integrante_comision IC ON IC.ID_Integrante_Comision = RA.ID_Integrante_Comision
                INNER JOIN personal_academico PA ON PA.ID_Personal_Academico = IC.ID_Personal_Academico
                INNER JOIN persona_usuario PU ON PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
                INNER JOIN persona P ON P.ID_Persona = PU.ID_Persona
                WHERE RA.ID_Comision_Actividad = CA.ID_Comision_Actividad
            ),
            'Toda la comisión'
        ),
        '</td><td>',
        IFNULL(
            (
                SELECT GROUP_CONCAT(
                    DISTINCT '• ', C.Nombre_Comision SEPARATOR '<br>'
                )
                FROM responsable_actividad RA
                INNER JOIN comisionapoyo_actividad CAP on CAP.ID_Comision_Actividad = RA.ID_Comision_Actividad
                INNER JOIN comision_evento CE on CE.ID_Comision_Evento = CAP.ID_Comision_Evento
                INNER JOIN comision C ON C.ID_Comision = CE.ID_Comision
				WHERE RA.ID_Comision_Actividad = CA.ID_Comision_Actividad
            ),
            'No requiere'
        ),
        '</td><td>',
        IFNULL(
            (
                SELECT GROUP_CONCAT(
                     DISTINCT '• ',PAC.NombreApoyos SEPARATOR '<br>'
                )
                FROM responsable_actividad RA
                INNER JOIN personalapoyo_actividad PAA on PAA.ID_Comision_Actividad = RA.ID_Comision_Actividad
                INNER JOIN personalapoyo PAC on PAC.ID_PersonalApoyo = PAA.ID_PersonalApoyo
				WHERE RA.ID_Comision_Actividad = CA.ID_Comision_Actividad
            ),
            'Ninguno'
        ),
        '</td><td>',
         IFNULL(
            (
                SELECT GROUP_CONCAT(
                     DISTINCT '• ',R.NombreRequerimientos SEPARATOR '<br>'
                )
                FROM  requerimiento_comisionactividad REQ
                INNER JOIN requerimientos R on R.ID_Requerimiento = REQ.ID_Requerimiento
				WHERE REQ.ID_Comision_Actividad = CA.ID_Comision_Actividad
            ),
           'Ninguno'
        ),
        '</td></tr>'
    )
FROM
    comision_actividad CA
    INNER JOIN actividad A ON A.Id_Actividad = CA.ID_Actividad
WHERE
    CA.Activo = 1
    AND A.Activo = 1
    AND CA.ID_Comision_Evento = p_idcomasig
ORDER BY
    CA.ID_Comision_Actividad;
    END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insertar_ReporteFinalCE`(in id_ComisionEvento bigint, in nombrereporte varchar(255),in fecharegistro datetime,in reportefinal varchar(255),in dirdescarga varchar(255))
BEGIN
	declare p_idcomisionE bigint default id_ComisionEvento;
	declare p_nombreR varchar(255) default (trim(nombrereporte));  
    declare p_fechar datetime default fecharegistro;
    declare p_reporteFinal varchar(255) default reportefinal ;
    declare p_dirdescarga varchar(255) default dirdescarga;

	UPDATE reportefinal_comisionevento set Activo = 0 where ID_Comision_Evento = p_idcomisionE;
    
    Insert into reportefinal_comisionevento
    (ID_Comision_Evento, NombreReporteF,ReporteFinal,DirDescarga,FechaRegistro,Activo)
    values
    (p_idcomisionE, p_nombreR, p_reporteFinal,p_dirdescarga,p_fechar,1);
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Obtener_UltimoReporte`(in id_ComisionEvento bigint)
BEGIN
	declare p_idcomisionE bigint default id_ComisionEvento;
    
    SELECT ReporteFinal
	FROM reportefinal_comisionevento
	WHERE ID_Comision_Evento = p_idcomisionE AND Activo = 0
	ORDER BY FechaRegistro DESC
	LIMIT 1;
    
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `ReporteFinalCreado_Comision`(in idcomisione bigint)
BEGIN

declare p_idcea int default idcomisione;

select NombreReporteF,DirDescarga, Activo from reportefinal_comisionevento where Activo = 1 and ID_Comision_Evento = p_idcea;

END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Obtener_ReporteFinalActual`(in id_ComisionEvento bigint)
BEGIN
	declare p_idcomisionE bigint default id_ComisionEvento;
    
    SELECT ID_ReporteFinal_CE,ReporteFinal
	FROM reportefinal_comisionevento
	WHERE ID_Comision_Evento = p_idcomisionE AND Activo = 1
	ORDER BY FechaRegistro DESC
	LIMIT 1;
    
     
END
/******************************/

/******************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Eliminar_RegistroReporteFinal`(in IdReporteCS bigint)
BEGIN

declare id_Idreporte bigint default IdReporteCS;
	
    
    UPDATE reportefinal_comisionevento set Activo = 0 where ID_ReporteFinal_CE = id_Idreporte;
    
   
END
/******************************/