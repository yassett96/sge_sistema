-- Procedimiendo a Crear/Actualizar --

/****************************************/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_ParticipantesGenerales`()
BEGIN

	Declare idEvento int;
	SET idEvento = Obtener_EventoActual();

    SELECT
      Nombres,
      Apellidos,
      COALESCE(Cedula, 'No Tiene') AS Cedula,
      ID_Numero_Carnet,
      Correo_Electronico,
      Telefono,
      CASE 
        WHEN Confirmacion = 0 AND Activo = 1 THEN 'No Confirmado'
        WHEN Confirmacion = 1 AND Activo = 1 THEN 'Confirmado'
        WHEN Activo = 0 THEN 'Abandono'
        ELSE 'Estado Desconocido'
      END AS Estado
    FROM (
      SELECT 
        CONCAT(PAR.Primer_Nombre, ' ', PAR.Segundo_Nombre) AS Nombres,
        CONCAT(PAR.Primer_Apellido, ' ', PAR.Segundo_Apellido) As Apellidos,
        PAR.Cedula,
        PAP1.ID_Numero_Carnet,
        PAR.Correo_Electronico,
        PAR.Telefono,
        MAX(PP1.Confirmacion) AS Confirmacion,
        MAX(PP1.Activo) AS Activo
      FROM evento_proyecto EP
      INNER JOIN proyecto P ON P.ID_Proyecto = EP.ID_Proyecto
      INNER JOIN participante_proyecto PP1 ON PP1.ID_Proyecto = P.ID_Proyecto
      INNER JOIN participante PAP1 ON PAP1.ID_Numero_Carnet = PP1.ID_Participante
      INNER JOIN persona_usuario PAPU ON PAPU.ID_Persona_Usuario = PAP1.ID_Persona_Usuario
      INNER JOIN persona PAR ON PAR.ID_Persona = PAPU.ID_Persona
      WHERE EP.ID_Evento = idEvento
      AND P.Activo = 1
      GROUP BY Nombres, Apellidos, Cedula, ID_Numero_Carnet, Correo_Electronico, Telefono
    ) AS Resultado;
    
END

/****************************************/

/****************************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_ParticipantesGeneralesConfirmados`()
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
        AND EP.Activo = 2
        AND P.Activo = 1
        AND PP1.Activo = 1
    ) AS Resultado
    inner JOIN (
        SELECT DISTINCT
            PP2.ID_Participante_Proyecto
        FROM participante_proyecto PP2
        WHERE PP2.Confirmacion = 1
        AND PP2.Activo = 1
    ) AS Confirmados
    ON Resultado.ID_Participante_Proyecto = Confirmados.ID_Participante_Proyecto;
END

/****************************************/

/****************************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_ParticipantesAbandonados`()
BEGIN
    DECLARE idEvento INT;
    SET idEvento = Obtener_EventoActual();

    SELECT
        ROW_NUMBER() OVER (ORDER BY ID_Participante_Proyecto) AS Reg,
        P.Nombre,
        CONCAT(PAR.Primer_Nombre, ' ', PAR.Segundo_Nombre) AS Nombres,
        CONCAT(PAR.Primer_Apellido, ' ', PAR.Segundo_Apellido) AS Apellidos,
        COALESCE(PAR.Cedula, 'No Tiene') AS Cedula,
        PP1.ID_Participante,
        PAR.Correo_Electronico,
        PAR.Telefono
     FROM evento_proyecto EP
        INNER JOIN proyecto P ON P.ID_Proyecto = EP.ID_Proyecto
        INNER JOIN participante_proyecto PP1 ON PP1.ID_Proyecto = P.ID_Proyecto
        INNER JOIN participante PAP1 ON PAP1.ID_Numero_Carnet = PP1.ID_Participante
        INNER JOIN persona_usuario PAPU ON PAPU.ID_Persona_Usuario = PAP1.ID_Persona_Usuario
        INNER JOIN persona PAR ON PAR.ID_Persona = PAPU.ID_Persona
        WHERE EP.ID_Evento = idEvento
        AND EP.Activo in (1,3)
        AND P.Activo = 1
        AND PP1.Confirmacion = 0
        AND PP1.Activo = 0;
END
/****************************************/

/****************************************/
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
/****************************************/

/****************************************/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Tabla_IntegrantesProyecto`(in nproyecto int)
BEGIN

	declare idproyecto int default nproyecto;

    
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
	AND PP.Confirmacion = 0
	AND PP.Activo = 0


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
	AND PP.Confirmacion = 0
	AND PP.Activo = 0



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

	WHERE PP.ID_Proyecto = idproyecto
	AND PP.Confirmacion = 0
	AND PP.Activo = 0;
		

END

/****************************************/

/****************************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Tabla_IntegrantesProyecto_Confirmados`(in nproyecto int)
BEGIN

	declare idproyecto int default nproyecto;
    
    
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
	AND PP.Confirmacion = 1
	AND PP.Activo = 1

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
	AND PP.Confirmacion = 1
	AND PP.Activo = 1

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

	WHERE PP.ID_Proyecto = idproyecto
	AND PP.Confirmacion = 1
	AND PP.Activo = 1;
		

END

/****************************************/


/****************************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Tabla_IntegrantesProyecto_NoConfirmados`(in nproyecto int)
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
AND PP.Confirmacion = 0
AND PP.Activo = 1

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
AND PP.Confirmacion = 0
AND PP.Activo = 1

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

WHERE PP.ID_Proyecto = idproyecto
AND PP.Confirmacion = 0
AND PP.Activo = 1;
	

END
/****************************************/