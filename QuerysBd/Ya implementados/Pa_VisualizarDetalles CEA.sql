-- MComisionEA ---
/*En la mayoria se utila la funcion Obtener_eventoActual(), la cual en actualizaciones anterioes ya se las habia subido, por lo que 
no les deberia dar problema  siempre y cuendo la hayan creado*/


CREATE PROCEDURE `Cargar_IDNombre_ComisionEvento`(in idCEA bigint)
BEGIN
	declare Id_ComEActual int default idCEA;
    declare id_Eactual int;

	SET id_Eactual = Obtener_EventoActual();
    
    Select c.ID_Comision, c.Nombre_Comision from comision_evento as ce
    
    inner join Comision as c on c.ID_Comision = ce.ID_Comision
    
    where ce.ID_Comision_Evento = Id_ComEActual and ce.ID_Evento =  id_Eactual and c.Activo = 1 and ce.Activo=1;
END

/*********************************/

CREATE  PROCEDURE `Lista_FuncionCEA`(in IdComision bigint)
BEGIN

Declare p_idcom bigint default IdComision;

SET @REG=0;


Select  concat('<tr><td id="Anchio"><input hidden value ="',f.ID_Funcion,'"></td><td class="ordenCEA">',@REG:= @REG+1,'</td><td class="NombreFuncion">',f.Descripcion,'</td></tr>')

     from funcion_comision fc
     inner join funcion f  on fc.ID_Funcion = f.ID_Funcion
     inner join comision c on fc.ID_Comision = c.ID_Comision
    where f.Activo = 1 and c.Activo
    AND (c.ID_Comision = p_idcom)
    order by ID_Funcion_Comision;

END

/************************************************/
/*** No es nuevo, pero lo deben actualizar ******/

CREATE  PROCEDURE `Lista_FuncionSegunComision2`(in IdComision bigint)
BEGIN

Declare p_idcom bigint default IdComision;

SET @REG=0;

Select  concat('<tr><td id="Anchio"><input hidden value = "',f.ID_Funcion,'"></td><td class="orden">',@REG:= @REG+1,'</td><td class="NombreFuncion">',f.Descripcion,'</td><td><button  type="button" id="BtnEliminarFuncion" class="btn btn-light" onclick="eliminarFuncionF()" >Eliminar Funcion</button></td></tr>')
     from funcion_comision fc
     inner join funcion f  on fc.ID_Funcion = f.ID_Funcion
     inner join comision c on fc.ID_Comision = c.ID_Comision
    where f.Activo = 1 and c.Activo
    AND (c.ID_Comision = p_idcom)
    order by ID_Funcion_Comision;

END

/**************************************************************/
/*** No es nuevo, pero lo deben actualizar *******************/

CREATE  PROCEDURE `Listar_ComisionesEventoActual`()
BEGIN
Declare idEvento int;
SET idEvento = Obtener_EventoActual();
SET @REG=0;

Select  concat('<tr><td id="Anchio"><input hidden value = "',CE.ID_Comision_Evento,'"></td><td class="ordenCE">',@REG:= @REG+1,'</td><td class="NombreCEA">',C.Nombre_Comision,'</td><td><button  type="button" id="BtnEliminarCE" class=" btn-light CE" >Eliminar</button></td></tr>')
     from comision_evento CE
     
     inner join comision C on  CE.ID_Comision = C.ID_Comision
    where C.Activo = 1 and CE.Activo = 1
    AND (CE.ID_Evento = idEvento)
    order by CE.ID_Comision;
END

/*************************************************************/

/*Funciones para los responsables*/

CREATE  FUNCTION `IdP_R1_CEvento`(id_cea bigint) RETURNS int(11)
BEGIN
	declare Id_ComEA int default id_cea;
	DECLARE idresult  int;
    
	SELECT DISTINCT  P.ID_Persona INTO idresult
	FROM integrante_comision IC
	INNER JOIN personal_academico PA ON PA.ID_Personal_Academico = IC.ID_Personal_Academico
	INNER JOIN persona_usuario PU ON PU.ID_Persona_Usuario = PA.ID_Persona_Usuario
	INNER JOIN Persona P ON P.ID_Persona = PU.ID_Persona
	WHERE PA.Activo = 1 AND PU.Activo = 1 AND PU.ID_Tipo_Usuario IN (3,4) AND P.Activo = 1
	  AND IC.Responsable = 1 AND IC.ID_Comision_Evento = Id_ComEA;
	
	RETURN idresult;
END
/***********************************************************/

CREATE  FUNCTION `IdP_R2_CEvento`(id_cea bigint) RETURNS int(11)
BEGIN
	declare Id_ComEA int default id_cea;
	DECLARE idresult  int;
    
	SELECT DISTINCT  P.ID_Persona INTO idresult
	FROM integrante_comision IC
	INNER JOIN personal_academico PA ON PA.ID_Personal_Academico = IC.ID_Personal_Academico
	INNER JOIN persona_usuario PU ON PU.ID_Persona_Usuario = PA.ID_Persona_Usuario
	INNER JOIN Persona P ON P.ID_Persona = PU.ID_Persona
	WHERE PA.Activo = 1 AND PU.Activo = 1 AND PU.ID_Tipo_Usuario IN (3,4) AND P.Activo = 1
	  AND IC.Responsable = 2 AND IC.ID_Comision_Evento = Id_ComEA;
	
	RETURN idresult;
END

/**********************************************************/

CREATE FUNCTION `IdP_R3_CEvento`(id_cea bigint) RETURNS int(11)
BEGIN
	declare Id_ComEA int default id_cea;
	DECLARE idresult  int;
    
	SELECT DISTINCT  P.ID_Persona INTO idresult
	FROM integrante_comision IC
	INNER JOIN personal_academico PA ON PA.ID_Personal_Academico = IC.ID_Personal_Academico
	INNER JOIN persona_usuario PU ON PU.ID_Persona_Usuario = PA.ID_Persona_Usuario
	INNER JOIN Persona P ON P.ID_Persona = PU.ID_Persona
	WHERE PA.Activo = 1 AND PU.Activo = 1 AND PU.ID_Tipo_Usuario IN (3,4) AND P.Activo = 1
	  AND IC.Responsable = 3 AND IC.ID_Comision_Evento = Id_ComEA;
	
	RETURN idresult;
END

/*************************************************************/

CREATE  PROCEDURE `R1_Lista_PersonalAcemico`(in id_cea bigint)
BEGIN

declare Id_ComEA int default id_cea;
Declare idr1 int;

  SET idr1 = IdP_R1_CEvento(Id_ComEA);

select distinct CONCAT(P.Primer_Nombre,' ',P.Segundo_Nombre,' ',P.Primer_Apellido,' ',P.Segundo_Apellido) AS nombre_completo 
     from personal_academico PA 
     inner join persona_usuario PU  on PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
     inner join Persona P on P.ID_Persona = PU.ID_Persona
    where PA.Activo = 1 and PU.Activo = 1 and pu.ID_Tipo_Usuario in (3,4) AND P.Activo = 1 and P.ID_Persona = idr1
	order by P.Primer_Nombre,P.Primer_Apellido;

END

/****************************************************************/

CREATE  PROCEDURE `R2_Lista_PersonalAcemico`(in id_cea bigint)
BEGIN

declare Id_ComEA int default id_cea;
Declare idr1 int;

  SET idr1 = IdP_R2_CEvento(Id_ComEA);

select distinct CONCAT(P.Primer_Nombre,' ',P.Segundo_Nombre,' ',P.Primer_Apellido,' ',P.Segundo_Apellido) AS nombre_completo 
     from personal_academico PA 
     inner join persona_usuario PU  on PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
     inner join Persona P on P.ID_Persona = PU.ID_Persona
    where PA.Activo = 1 and PU.Activo = 1 and pu.ID_Tipo_Usuario in (3,4) AND P.Activo = 1 and P.ID_Persona = idr1
	order by P.Primer_Nombre,P.Primer_Apellido;

END

/********************************************************/

CREATE PROCEDURE `R3_Lista_PersonalAcemico`(in id_cea bigint)
BEGIN

declare Id_ComEA int default id_cea;
Declare idr1 int;

  SET idr1 = IdP_R3_CEvento(Id_ComEA);
  
select distinct  CONCAT(P.Primer_Nombre,' ',P.Segundo_Nombre,' ',P.Primer_Apellido,' ',P.Segundo_Apellido) AS nombre_completo 
     from personal_academico PA 
     inner join persona_usuario PU  on PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
     inner join Persona P on P.ID_Persona = PU.ID_Persona
    where PA.Activo = 1 and PU.Activo = 1 and pu.ID_Tipo_Usuario in (3,4) AND P.Activo = 1 and P.ID_Persona = idr1
	order by P.Primer_Nombre,P.Primer_Apellido;

END

/*******************************************************/


CREATE PROCEDURE `Obtener_IntegrantesComision_EA`(in id_cea bigint)
BEGIN

declare Id_ComEA int default id_cea;

SET @REG=0;
Select DISTINCT concat('<tr><td id="Anchio"><input hidden value = "',P.ID_Persona,'"></td><td class="ordenICEA">',@REG:= @REG+1,'</td><td>', P.Primer_Nombre,' ',P.Segundo_Nombre,
' ',P.Primer_Apellido,' ',P.Segundo_Apellido,'</td></tr>')

from integrante_comision IC 
	inner join personal_academico PAca on IC.ID_Personal_Academico = PAca.ID_Personal_Academico
     inner join persona_usuario PU  on PAca.ID_Persona_Usuario = PU.ID_Persona_Usuario
     inner join Persona P on P.ID_Persona = PU.ID_Persona
    where PAca.Activo = 1 and PU.Activo = 1 and IC.Activo = 1 and IC.Responsable=0 and IC.ID_Comision_Evento=Id_ComEA;

END