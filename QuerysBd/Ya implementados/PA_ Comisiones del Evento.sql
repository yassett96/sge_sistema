-- PlanificacionE.php ---

CREATE  PROCEDURE `Listar_ComisionesEventoActual`()
BEGIN
Declare idEvento int;
SET idEvento = Obtener_EventoActual();
SET @REG=0;
/*<td><button  type="button" id="BtnEliminarFuncion" class="btn btn-light" onclick="eliminarFuncionF()" >Eliminar Funcion</button>*/

Select  concat('<tr><td id="Anchio"><input hidden value = "',CE.ID_Comision_Evento,'"></td><td class="ordenCE">',@REG:= @REG+1,'</td><td>',C.Nombre_Comision,'</td><td><button  type="button" id="BtnEliminarCE" class=" btn-light CE" >Eliminar</button></td></tr>')
     from comision_evento CE
     
     inner join comision C on  CE.ID_Comision = C.ID_Comision
    where C.Activo = 1 and CE.Activo = 1
    AND (CE.ID_Evento = idEvento)
    order by CE.ID_Comision;
END

-- MComision --
CREATE  PROCEDURE `Eliminar_ComisionE`(in idCE bigint)
BEGIN
declare id_comE bigint default idCE;

    UPDATE Comision_evento set Activo = 0 where ID_Comision_Evento = id_comE;
   
END