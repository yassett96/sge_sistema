CREATE  PROCEDURE `Mostrar_Historial_EventoFeria`(in ID_TipoE bigint)
BEGIN
	
declare p_idtipoE int default ID_TipoE;
    
DECLARE FechaAct DATETIME;
/*SET @REG=0;*/
    
    SET FechaAct = NOW(); --  <td class="ordenConE">',@REG:= @REG+1,'</td>
    Select  concat('<tr><td id="Anchio"><input hidden value = "',e.ID_Evento,'"></td><td class="NombreEH">',e.Nombre_Evento,'</td><td>', e.Eslogan,'</td><td>',DATE_FORMAT( e.hora, '%h:%i %p'),'</td><td>',e.Fecha,'</td><td>',s.Nombre_Sitio,'</td></tr>')
    
    FROM evento AS e 
    INNER JOIN sitio AS s ON s.ID_Sitio = e.ID_Sitio
    WHERE e.ID_Tipo_Evento = p_idtipoE
    AND e.Activo = 0
    AND e.Fecha < current_date  -- Filtrar por eventos cuya fecha sea menor que la actual
    AND e.Fecha != '0000-00-00'
    ORDER BY e.Fecha DESC;
    

END