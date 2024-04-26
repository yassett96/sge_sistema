/******** Procedimeintos a Agregar/Modificar **********************/

/**************/

CREATE DEFINER=`root`@`localhost` PROCEDURE `Listar_ComisionesEventoHistorial_V2`(in ID_Evento bigint)
BEGIN
Declare p_idEvento int default ID_Evento;

/*SET @REG=0;*/
/*<td><button  type="button" id="BtnEliminarFuncion" class="btn btn-light" onclick="eliminarFuncionF()" >Eliminar Funcion</button>*/
					/*<td class="ordenCatE">',@REG:= @REG+1,'</td>*/
SELECT 
    CONCAT('<tr><td id="Anchio"><input hidden value="', CE.ID_Comision_Evento, '"></td><td class="NombreCatEA">', C.Nombre_Comision, '</td><td>', 
           P1.Primer_Nombre, ' ', P1.Segundo_Nombre, ' ', P1.Primer_Apellido, ' ', P1.Segundo_Apellido, '</td><td>',
           IFNULL(CONCAT(P2.Primer_Nombre, ' ', P2.Segundo_Nombre, ' ', P2.Primer_Apellido, ' ', P2.Segundo_Apellido), 'No Asignado'), '</td><td>',
           IFNULL(CONCAT(P3.Primer_Nombre, ' ', P3.Segundo_Nombre, ' ', P3.Primer_Apellido, ' ', P3.Segundo_Apellido), 'No Asignado'), '</td>
           <td><button  type="button" id="BtnDReporteFinal" class=" btn-light Des btn-reporte-final" >Descargar Reporte </button></td>
           <td><button  type="button" id="BtnDPlanTrabajo" class=" btn-light Des btn-plan-trabajo" >Descargar Plan</button></td></tr>')
FROM comision_evento CE
INNER JOIN comision C ON CE.ID_Comision = C.ID_Comision
INNER JOIN integrante_comision IC1 ON IC1.ID_Comision_Evento = CE.ID_Comision_Evento AND IC1.Responsable = 1
LEFT JOIN integrante_comision IC2 ON IC2.ID_Comision_Evento = CE.ID_Comision_Evento AND IC2.Responsable = 2
LEFT JOIN integrante_comision IC3 ON IC3.ID_Comision_Evento = CE.ID_Comision_Evento AND IC3.Responsable = 3
INNER JOIN personal_academico PA1 ON PA1.ID_Personal_Academico = IC1.ID_Personal_Academico
LEFT JOIN personal_academico PA2 ON PA2.ID_Personal_Academico = IC2.ID_Personal_Academico
LEFT JOIN personal_academico PA3 ON PA3.ID_Personal_Academico = IC3.ID_Personal_Academico
INNER JOIN persona_usuario PU1 ON PA1.ID_Persona_Usuario = PU1.ID_Persona_Usuario
LEFT JOIN persona_usuario PU2 ON PA2.ID_Persona_Usuario = PU2.ID_Persona_Usuario
LEFT JOIN persona_usuario PU3 ON PA3.ID_Persona_Usuario = PU3.ID_Persona_Usuario
INNER JOIN persona P1 ON P1.ID_Persona = PU1.ID_Persona
LEFT JOIN persona P2 ON P2.ID_Persona = PU2.ID_Persona
LEFT JOIN persona P3 ON P3.ID_Persona = PU3.ID_Persona
WHERE C.Activo = 1
  AND PU1.ID_Tipo_Usuario IN (3, 4)
  AND (PU2.ID_Tipo_Usuario IN (3, 4) OR PU2.ID_Persona_Usuario IS NULL)
  AND (PU3.ID_Tipo_Usuario IN (3, 4) OR PU3.ID_Persona_Usuario IS NULL)
  AND CE.Activo = 0
  AND CE.ID_Evento = p_idEvento
GROUP BY CE.ID_Comision_Evento, P1.Primer_Nombre, P1.Segundo_Nombre, P1.Primer_Apellido, P1.Segundo_Apellido;
end

/****************/


/**************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Lista_ParticipantesGenerales`()
BEGIN

	Declare idEvento int;
	SET idEvento = Obtener_EventoActual();

    
    SELECT
      /*ROW_NUMBER() OVER (ORDER BY Nombres) AS Reg,*/
      Nombres,
      Apellidos,
      COALESCE(Cedula, 'No Tiene') AS Cedula,
      ID_Numero_Carnet,
      Correo_Electronico,
      Telefono,
      CASE 
        WHEN Confirmacion = 0 AND Activo = 1 THEN 'No confirmó'
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
/**************/

/**************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `Mostrar_EventoSeleccionado`( in IDEventoSel int)
Begin

declare pid_evento int default IDEventoSel;
	
Select e.Nombre_Evento, e.Eslogan, e.hora, e.Fecha, s.Nombre_Sitio from evento e 
inner join sitio s on s.ID_Sitio = e.ID_Sitio    
where ID_Evento = pid_evento;


End
/**************/

