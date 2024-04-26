/*** Procedimiento Y Funciona a Crear para vistas de comisiones generales**/
/*------------*/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Datos_ComisionesEventoActual`()
BEGIN
	Declare idEvento int;
	SET idEvento = Obtener_EventoActual();
    
    SELECT CONCAT('(', CONCAT_WS(',', CE.ID_Comision_Evento, C.Nombre_Comision, IFNULL(
        (
            SELECT GROUP_CONCAT(
                CONCAT(P1.Primer_Nombre, ' ', P1.Primer_Apellido ) 
            )
            FROM integrante_comision IC
            INNER JOIN personal_academico PA ON PA.ID_Personal_Academico = IC.ID_Personal_Academico
            INNER JOIN persona_usuario PU ON PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
            INNER JOIN persona P1 ON P1.ID_Persona = PU.ID_Persona
            WHERE IC.Responsable = 1 AND IC.ID_Comision_Evento = CE.ID_Comision_Evento
        ),
        'No Asignado'
    ),IFNULL(
        (
            SELECT GROUP_CONCAT(
                CONCAT(P2.Primer_Nombre, ' ',P2.Primer_Apellido) 
            )
            FROM integrante_comision IC
            INNER JOIN personal_academico PA ON PA.ID_Personal_Academico = IC.ID_Personal_Academico
            INNER JOIN persona_usuario PU ON PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
            INNER JOIN persona P2 ON P2.ID_Persona = PU.ID_Persona
            WHERE IC.Responsable = 2 AND IC.ID_Comision_Evento = CE.ID_Comision_Evento
        ),
        'No Asignado'
    ),IFNULL((SELECT GROUP_CONCAT(CONCAT(P3.Primer_Nombre, ' ',P3.Primer_Apellido) )
            FROM integrante_comision IC
            INNER JOIN personal_academico PA ON PA.ID_Personal_Academico = IC.ID_Personal_Academico
            INNER JOIN persona_usuario PU ON PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
            INNER JOIN persona P3 ON P3.ID_Persona = PU.ID_Persona
            WHERE IC.Responsable = 3 AND IC.ID_Comision_Evento = CE.ID_Comision_Evento),'No Asignado'
    ),(select count(CAC.ID_Estado)
		from comision_actividad CAC
        where CAC.ID_Estado=3 and CAC.ID_Comision_Evento = CE.ID_Comision_Evento and CAC.Activo= 1),
	(select count(CAC.ID_Estado) 
		from comision_actividad CAC 
        where  CAC.ID_Comision_Evento = CE.ID_Comision_Evento and CAC.Activo= 1)
        )) AS Comisiones_Evento
    
FROM comision_evento CE
INNER JOIN comision C ON CE.ID_Comision = C.ID_Comision
WHERE CE.Activo = 1 AND C.Activo = 1 AND ID_Evento = idEvento;
    

END

/*------------*/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Listar_ActividadComision_VCS`(in IdComisionAsignada bigint)
BEGIN
	Declare p_idcomasig int default IdComisionAsignada;

	SET @REG=0;

Select  concat('<tr><td id="Anchio"><input hidden value = "',CA.ID_Comision_Actividad,'"></td><td class="ordenConE">',@REG:= @REG+1,'</td><td class="NombreComA">',A.NombreActividad,'</td><td>',A.Descripcion,'</td><td>',DATE_FORMAT(A.FechaInicio	, '%d-%m-%Y'),'</td><td>',DATE_FORMAT(A.FechaFin	, '%d-%m-%Y'),'</td><td>',E.NombreEstado,'</td></tr>')
     
     from comision_actividad CA
     inner join actividad A on A.Id_Actividad = CA.ID_Actividad
     
     inner join estado_actividad E on E.ID_Estado = CA.ID_Estado
     
     
    where  CA.Activo = 1 and A.Activo=1
    AND (CA.ID_Comision_Evento = p_idcomasig)
    order by CA.ID_Comision_Actividad;

END

/************/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_DatosComisionA_Persona_VCS`(in idPersona bigint)
BEGIN
	declare p_idpersona int default idPersona;
    
    declare id_PA int;
    declare idEvento int;
    declare idscomisionevento text;
    
	SET idEvento = Obtener_EventoActual();
	SET id_PA = Obtener_IdPA(p_idpersona);
    SET idscomisionevento= Obtener_IDComisionEA(); 

    select ID_Comision_Evento

    from integrante_comision as IC

    
    
    where FIND_IN_SET(ID_Comision_Evento, idscomisionevento) > 0
    and ID_Personal_Academico = id_PA;

END

/*********/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Reporte_ActividadComision_EXCEL`(in IdComisionAsignada bigint)
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
					
                    P.Primer_Nombre,
                    ' ',
                    P.Segundo_Nombre,
                    ' ',
                    P.Primer_Apellido,
                    ' ',
                    P.Segundo_Apellido
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
                    DISTINCT  C.Nombre_Comision 
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
                     DISTINCT PAC.NombreApoyos 
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
                    R.NombreRequerimientos 
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
    
/************************/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Listar_ComisionesEvento_Select`()
BEGIN
Declare idEvento int;
SET idEvento = Obtener_EventoActual();

Select  concat('<option value="',CE.ID_Comision_Evento,'">',C.Nombre_Comision,'</option>')
     from comision_evento CE
     
     inner join comision C on  CE.ID_Comision = C.ID_Comision
    where C.Activo = 1 and CE.Activo = 1
    AND (CE.ID_Evento = idEvento)
    order by CE.ID_Comision;
END

/***********************/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Reporte_IntegranteComision`(in IdComisionAsignada bigint)
BEGIN
	Declare p_idcomasig int default IdComisionAsignada;
    
	DECLARE IdResponsables VARCHAR(255);

SET IdResponsables = ListaResponsables_CE(p_idcomasig);

SET @REG = 0;

SELECT DISTINCT
    CONCAT(
        '<tr><td id="Anchio"><input hidden value = "', IC.ID_Integrante_Comision, '"></td><td class="ordenComI">',
        @REG := @REG + 1,
        '</td><td>',
        P.Primer_Nombre,
        ' ',
        P.Segundo_Nombre,
        ' ',
        P.Primer_Apellido,
        ' ',
        P.Segundo_Apellido,
        '</td><td>',
        CASE WHEN FIND_IN_SET(PA.ID_Personal_Academico, IdResponsables) > 0 THEN 'SI' ELSE ' ' END,
        '</td></tr>'
    )
FROM
    integrante_comision IC
    INNER JOIN personal_academico AS PA ON PA.ID_Personal_Academico = IC.ID_Personal_Academico
    INNER JOIN persona_usuario PU ON PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
    INNER JOIN persona P ON P.ID_Persona = PU.ID_Persona
WHERE
    PA.Activo = 1
    AND PU.Activo = 1
    AND P.Activo = 1
    AND IC.ID_Comision_Evento = p_idcomasig
GROUP BY
    IC.ID_Integrante_Comision;

END

/***************/

CREATE DEFINER=`root`@`localhost` FUNCTION `ListaResponsables_CE`(idcomisione bigint) RETURNS varchar(255) CHARSET utf8mb4
BEGIN

DECLARE p_idcea INT DEFAULT idcomisione;
DECLARE responsables VARCHAR(255);

SELECT GROUP_CONCAT(PA.ID_Personal_Academico SEPARATOR ',') INTO responsables
FROM integrante_comision AS IC
INNER JOIN personal_academico AS PA ON PA.ID_Personal_Academico = IC.ID_Personal_Academico
INNER JOIN persona_usuario AS PU ON PU.ID_Persona_Usuario = PA.ID_Persona_Usuario
INNER JOIN persona AS p ON p.ID_Persona = PU.ID_Persona
WHERE IC.Responsable IN (1, 2, 3)
    AND IC.ID_Comision_Evento = p_idcea
    AND PU.Activo = 1
    AND PU.ID_Tipo_Usuario IN (3, 4);

RETURN responsables;

END

/*********************************/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Tabla_IntegrantesProyecto`(in nproyecto int)
BEGIN

	declare idproyecto int default nproyecto;
    
    /*set idproyecto = (Select ID_Proyecto from proyecto where Nombre = nproyecto);*/
    
    SELECT
  CONCAT(PER1.Primer_Nombre, ' ', PER1.Segundo_Nombre, ' ', PER1.Primer_Apellido, ' ', PER1.Segundo_Apellido) AS NombreParticipante,
  COALESCE(PER1.Cedula, 'No Tiene') AS Cedula,
  PER1.Correo_Electronico,
  PER1.Telefono,
  PAP1.ID_Numero_Carnet,
  SPER.Sede AS Sede,
  G.grupo AS Grupo,
  A1.Año
FROM participante_proyecto PP
LEFT JOIN participante PAP1 ON PAP1.ID_Numero_Carnet = PP.ID_Participante
LEFT JOIN persona_usuario PUP1 ON PUP1.ID_Persona_Usuario = PAP1.ID_Persona_Usuario
LEFT JOIN persona PER1 ON PER1.ID_Persona = PUP1.ID_Persona
LEFT JOIN sede SPER ON SPER.ID_Sede = PAP1.ID_Sede
LEFT JOIN grupo G ON G.ID_Grupo = PAP1.ID_Grupo
LEFT JOIN añogrupo_academico AGA1 ON AGA1.ID_Grupo = PAP1.ID_Grupo
LEFT JOIN añoacademico A1 ON A1.ID_Añoacademico = AGA1.ID_Añoacademico

WHERE PP.ID_Proyecto = idproyecto

UNION

SELECT
  CONCAT(PER2.Primer_Nombre, ' ', PER2.Segundo_Nombre, ' ', PER2.Primer_Apellido, ' ', PER2.Segundo_Apellido) AS NombreParticipante,
   COALESCE(PER2.Cedula, 'No Tiene') AS Cedula,
  PER2.Correo_Electronico,
  PER2.Telefono,
  PAP2.ID_Numero_Carnet,
  SPER2.Sede AS Sede,
  G2.grupo AS Grupo,
  A2.Año
FROM participante_proyecto PP
LEFT JOIN participante PAP2 ON PAP2.ID_Numero_Carnet = PP.ID_Participante
LEFT JOIN persona_usuario PUP2 ON PUP2.ID_Persona_Usuario = PAP2.ID_Persona_Usuario
LEFT JOIN persona PER2 ON PER2.ID_Persona = PUP2.ID_Persona
LEFT JOIN sede SPER2 ON SPER2.ID_Sede = PAP2.ID_Sede
LEFT JOIN grupo G2 ON G2.ID_Grupo = PAP2.ID_Grupo
LEFT JOIN añogrupo_academico AGA2 ON AGA2.ID_Grupo = PAP2.ID_Grupo
LEFT JOIN añoacademico A2 ON A2.ID_Añoacademico = AGA2.ID_Añoacademico

WHERE PP.ID_Proyecto = idproyecto

UNION

SELECT
  CONCAT(PER3.Primer_Nombre, ' ', PER3.Segundo_Nombre, ' ', PER3.Primer_Apellido, ' ', PER3.Segundo_Apellido) AS NombreParticipante,
   COALESCE(PER3.Cedula, 'No Tiene') AS Cedula,
  PER3.Correo_Electronico,
  PER3.Telefono,
  PAP3.ID_Numero_Carnet,
  SPER3.Sede AS Sede,
  G3.grupo AS Grupo,
  A3.Año
FROM participante_proyecto PP
LEFT JOIN participante PAP3 ON PAP3.ID_Numero_Carnet = PP.ID_Participante
LEFT JOIN persona_usuario PUP3 ON PUP3.ID_Persona_Usuario = PAP3.ID_Persona_Usuario
LEFT JOIN persona PER3 ON PER3.ID_Persona = PUP3.ID_Persona
LEFT JOIN sede SPER3 ON SPER3.ID_Sede = PAP3.ID_Sede
LEFT JOIN grupo G3 ON G3.ID_Grupo = PAP3.ID_Grupo
LEFT JOIN añogrupo_academico AGA3 ON AGA3.ID_Grupo = PAP3.ID_Grupo
LEFT JOIN añoacademico A3 ON A3.ID_Añoacademico = AGA3.ID_Añoacademico

WHERE PP.ID_Proyecto = idproyecto;
	

END

/*****************/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_ParticipantesGenerales`()
BEGIN

	Declare idEvento int;
	SET idEvento = Obtener_EventoActual();
    
    SELECT
	  ROW_NUMBER() OVER (ORDER BY Nombres) AS Reg,
	  Nombres,
      Apellidos,
	  COALESCE(Cedula, 'No Tiene') AS Cedula,
      ID_Numero_Carnet,
	  Correo_Electronico,
	  Telefono
	FROM (
	  SELECT DISTINCT
		CONCAT(PAR.Primer_Nombre, ' ', PAR.Segundo_Nombre) AS Nombres,
		CONCAT(PAR.Primer_Apellido, ' ', PAR.Segundo_Apellido) As Apellidos,
		PAR.Cedula,
        PAP1.ID_Numero_Carnet,
		PAR.Correo_Electronico,
		PAR.Telefono
	  FROM evento_proyecto EP
	  INNER JOIN proyecto P ON P.ID_Proyecto = EP.ID_Proyecto
	  INNER JOIN participante_proyecto PP1 ON PP1.ID_Proyecto = P.ID_Proyecto
	  INNER JOIN participante PAP1 ON PAP1.ID_Numero_Carnet = PP1.ID_Participante
	  INNER JOIN persona_usuario PAPU ON PAPU.ID_Persona_Usuario = PAP1.ID_Persona_Usuario
	  INNER JOIN persona PAR ON PAR.ID_Persona = PAPU.ID_Persona
	  WHERE EP.ID_Evento = idEvento
	   AND EP.Activo = 1
	  AND P.Activo = 1
	  GROUP BY PAR.Primer_Nombre, PAR.Segundo_Nombre, PAR.Primer_Apellido, PAR.Segundo_Apellido, PAR.Cedula, PAR.Correo_Electronico, PAR.Telefono
	) AS Resultado;
END

/********************/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_ProyectosConfirmados_EA`()
BEGIN

	Declare idEvento int;
	SET idEvento = Obtener_EventoActual();
    
    SELECT P.Id_Proyecto,
  P.Nombre,
  P.Descripcion,
  C.Nombre_Categoria,
  S.Nombre_SubCategoria,
  A.Año,
  SPER.Sede,
  CONCAT(PAR.Primer_Nombre,' ',PAR.Segundo_Nombre,' ',PAR.Primer_Apellido,' ',PAR.Segundo_Apellido) AS NombreTutor,
  SPAR.Sede AS SedeTutor
FROM evento_proyecto EP
INNER JOIN proyecto P ON P.ID_Proyecto = EP.ID_Proyecto
INNER JOIN subcategoria S ON S.ID_SubCategoria = P.ID_Subcategoria
INNER JOIN categoria_subcategoria CS ON CS.ID_SubCategoria = S.ID_SubCategoria
INNER JOIN categoria C ON C.ID_Categoria = CS.ID_Categoria
INNER join añoacademico A ON A.ID_Añoacademico = S.ID_Añoacademico
LEFT JOIN participante_proyecto PP1 ON PP1.ID_Proyecto = P.ID_Proyecto
LEFT JOIN participante PAP1 ON PAP1.ID_Numero_Carnet = PP1.ID_Participante

LEFT JOIN sede SPER ON SPER.ID_Sede = PAP1.ID_Sede

INNER JOIN personal_academico PA ON PA.ID_Personal_Academico = P.ID_Personal_Academico
INNER JOIN persona_usuario PAPU ON PAPU.ID_Persona_Usuario = PA.ID_Persona_Usuario
INNER JOIN persona PAR ON PAR.ID_Persona = PAPU.ID_Persona
INNER JOIN sede SPAR ON SPAR.ID_Sede = PA.ID_Sede

WHERE EP.ID_Evento = idEvento
  AND EP.Activo = 2
  AND P.Activo = 1

  group by P.ID_Proyecto;
  

END

/***********/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_ProyectosNoConfirmados_EA`()
BEGIN

	Declare idEvento int;
	SET idEvento = Obtener_EventoActual();
    
    SELECT P.Id_Proyecto,
  P.Nombre,
  P.Descripcion,
  C.Nombre_Categoria,
  S.Nombre_SubCategoria,
  A.Año,
  SPER.Sede,
  CONCAT(PAR.Primer_Nombre,' ',PAR.Segundo_Nombre,' ',PAR.Primer_Apellido,' ',PAR.Segundo_Apellido) AS NombreTutor,
  SPAR.Sede AS SedeTutor
FROM evento_proyecto EP
INNER JOIN proyecto P ON P.ID_Proyecto = EP.ID_Proyecto
INNER JOIN subcategoria S ON S.ID_SubCategoria = P.ID_Subcategoria
INNER JOIN categoria_subcategoria CS ON CS.ID_SubCategoria = S.ID_SubCategoria
INNER JOIN categoria C ON C.ID_Categoria = CS.ID_Categoria
INNER join añoacademico A ON A.ID_Añoacademico = S.ID_Añoacademico
LEFT JOIN participante_proyecto PP1 ON PP1.ID_Proyecto = P.ID_Proyecto
LEFT JOIN participante PAP1 ON PAP1.ID_Numero_Carnet = PP1.ID_Participante

LEFT JOIN sede SPER ON SPER.ID_Sede = PAP1.ID_Sede

INNER JOIN personal_academico PA ON PA.ID_Personal_Academico = P.ID_Personal_Academico
INNER JOIN persona_usuario PAPU ON PAPU.ID_Persona_Usuario = PA.ID_Persona_Usuario
INNER JOIN persona PAR ON PAR.ID_Persona = PAPU.ID_Persona
INNER JOIN sede SPAR ON SPAR.ID_Sede = PA.ID_Sede

WHERE EP.ID_Evento = idEvento
  AND EP.Activo = 1
  AND P.Activo = 1

  group by P.ID_Proyecto;
END

/********************/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_ProyectosAbandonados_EA`()
BEGIN

	Declare idEvento int;
	SET idEvento = Obtener_EventoActual();
    
    SELECT P.Id_Proyecto,
  P.Nombre,
  P.Descripcion,
  C.Nombre_Categoria,
  S.Nombre_SubCategoria,
  A.Año,
  SPER.Sede,
  CONCAT(PAR.Primer_Nombre,' ',PAR.Segundo_Nombre,' ',PAR.Primer_Apellido,' ',PAR.Segundo_Apellido) AS NombreTutor,
  SPAR.Sede AS SedeTutor
FROM evento_proyecto EP
INNER JOIN proyecto P ON P.ID_Proyecto = EP.ID_Proyecto
INNER JOIN subcategoria S ON S.ID_SubCategoria = P.ID_Subcategoria
INNER JOIN categoria_subcategoria CS ON CS.ID_SubCategoria = S.ID_SubCategoria
INNER JOIN categoria C ON C.ID_Categoria = CS.ID_Categoria
INNER join añoacademico A ON A.ID_Añoacademico = S.ID_Añoacademico
LEFT JOIN participante_proyecto PP1 ON PP1.ID_Proyecto = P.ID_Proyecto
LEFT JOIN participante PAP1 ON PAP1.ID_Numero_Carnet = PP1.ID_Participante

LEFT JOIN sede SPER ON SPER.ID_Sede = PAP1.ID_Sede

INNER JOIN personal_academico PA ON PA.ID_Personal_Academico = P.ID_Personal_Academico
INNER JOIN persona_usuario PAPU ON PAPU.ID_Persona_Usuario = PA.ID_Persona_Usuario
INNER JOIN persona PAR ON PAR.ID_Persona = PAPU.ID_Persona
INNER JOIN sede SPAR ON SPAR.ID_Sede = PA.ID_Sede

WHERE EP.ID_Evento = idEvento
  AND EP.Activo = 3
  AND P.Activo = 1

  group by P.ID_Proyecto;
END

/******************/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_ParticipantesGeneralesNoConfirmados`()
BEGIN
    DECLARE idEvento INT;
    SET idEvento = Obtener_EventoActual();

    SELECT
        ROW_NUMBER() OVER ( ORDER BY ID) AS Reg,
        NombreProyecto,
        Nombres,
        Apellidos,
        COALESCE(Cedula, 'No Tiene') AS Cedula,
        ID_Numero_Carnet,
        Correo_Electronico,
        Telefono
    FROM (
        SELECT
			P.ID_Proyecto as ID,
            P.Nombre as NombreProyecto,
            CONCAT(PAR.Primer_Nombre, ' ', PAR.Segundo_Nombre) AS Nombres,
            CONCAT(PAR.Primer_Apellido, ' ', PAR.Segundo_Apellido) As Apellidos,
            PAR.Cedula,
            PAP1.ID_Numero_Carnet,
            PAR.Correo_Electronico,
            PAR.Telefono,
            PP1.ID_Participante_Proyecto
        FROM evento_proyecto EP
        INNER JOIN proyecto P ON P.ID_Proyecto = EP.ID_Proyecto
        INNER JOIN participante_proyecto PP1 ON PP1.ID_Proyecto = P.ID_Proyecto
        INNER JOIN participante PAP1 ON PAP1.ID_Numero_Carnet = PP1.ID_Participante
        INNER JOIN persona_usuario PAPU ON PAPU.ID_Persona_Usuario = PAP1.ID_Persona_Usuario
        INNER JOIN persona PAR ON PAR.ID_Persona = PAPU.ID_Persona
        WHERE EP.ID_Evento = idEvento
        AND EP.Activo = 1
        AND P.Activo = 1
        AND PP1.Activo = 1
    ) AS Resultado
    LEFT JOIN (
        SELECT DISTINCT
            PP2.ID_Participante_Proyecto
        FROM participante_proyecto PP2
        WHERE PP2.Confirmacion = 1
        AND PP2.Activo = 1
    ) AS Confirmados
    ON Resultado.ID_Participante_Proyecto = Confirmados.ID_Participante_Proyecto
    WHERE Confirmados.ID_Participante_Proyecto IS NULL;
END

/*******************/ FIN /*********************/

