CREATE  PROCEDURE `Listar_CategoriasEventoHistorial`(in ID_Evento bigint)
BEGIN
Declare p_idEvento int default ID_Evento;

Select  concat('<tr><td id="Anchio"><input hidden value = "',CE.ID_Categoria_Evento,'"></td><td class="NombreCatEA">',C.Nombre_Categoria,'</td><td>',S.Nombre_SubCategoria,'</td><td>',AA.Año,'</td></tr>')
     from categoria_evento CE
     
     inner join categoria C on  CE.ID_Categoria = C.ID_Categoria
     
     inner join categoria_subcategoria CS on CS.ID_Categoria=CE.ID_Categoria
     inner join subcategoria S on S.ID_SubCategoria=CS.ID_SubCategoria
     inner join añoacademico AA on AA.ID_Añoacademico = S.ID_Añoacademico
    where  (CE.ID_Evento = p_idEvento)
    order by S.ID_SubCategoria;
END

/**********************************/

CREATE PROCEDURE `Listar_ComisionesEventoHistorial`(in ID_Evento bigint)
BEGIN
Declare p_idEvento int default ID_Evento;

SELECT 
    CONCAT('<tr><td id="Anchio"><input hidden value="', CE.ID_Comision_Evento, '"></td><td class="NombreCatEA">', C.Nombre_Comision, '</td><td>', 
           P1.Primer_Nombre, ' ', P1.Segundo_Nombre, ' ', P1.Primer_Apellido, ' ', P1.Segundo_Apellido, '</td><td>',
           IFNULL(CONCAT(P2.Primer_Nombre, ' ', P2.Segundo_Nombre, ' ', P2.Primer_Apellido, ' ', P2.Segundo_Apellido), 'No Asignado'), '</td><td>',
           IFNULL(CONCAT(P3.Primer_Nombre, ' ', P3.Segundo_Nombre, ' ', P3.Primer_Apellido, ' ', P3.Segundo_Apellido), 'No Asignado'), '</td></tr>')
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

/**************************/

CREATE  PROCEDURE `Listar_ConferenciasEventoHistorial`(in ID_Evento bigint)
BEGIN
Declare p_idEvento int default ID_Evento;

Select  concat('<tr><td id="Anchio"><input hidden value = "',CE.ID_Conferencia_Evento,'"></td><td class="NombreConFE">',CE.Nombre_Conferencia,'</td><td>',CE.Nombre_Conferencista,'</td><td>',CE.Detalles_Conferencista,'</td><td>',DATE_FORMAT(CE.Hora_Inicio, '%h:%i %p'),'</td><td>',DATE_FORMAT(CE.Hora_Fin, '%h:%i %p'),'</td><td>',S.Nombre_Sitio,'</td><td>',ss.NombreSalon,'</td></tr>')
     from conferencia_evento CE
     inner join salon ss on CE.ID_Salon = ss.ID_Salon
     inner join evento E on CE.ID_Evento = CE.ID_Evento
     inner join sitio S on S.ID_Sitio = E.ID_Sitio
     
    where (CE.ID_Evento = p_idEvento) 
    And CE.Activo=0
    group by CE.ID_Conferencia_Evento;
 
END