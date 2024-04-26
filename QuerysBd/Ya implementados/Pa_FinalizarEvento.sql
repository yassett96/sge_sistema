/*********  PlanificacionE.php ****************/

CREATE DEFINER=`` PROCEDURE `Finalizar_EventoActualYRelaciones`()
BEGIN
	declare id_EventoA int;
	SET id_EventoA  = Obtener_EventoActual();
    
    UPDATE categoria_evento set Activo = 0 where ID_Evento = id_EventoA;
    UPDATE comision_evento set Activo = 0 where ID_Evento = id_EventoA;
	UPDATE conferencia_evento set Activo = 0 where ID_Evento = id_EventoA;
    SET SQL_SAFE_UPDATES=0;
    UPDATE jurado_subcategoria SET Activo = 0 WHERE ID_Jurado IN (SELECT ID_Jurado FROM jurado WHERE ID_Evento = id_EventoA );
	UPDATE jurado  set Activo = 0 where ID_Evento = id_EventoA;
    
    UPDATE participante_proyecto SET Activo = 0 WHERE ID_Proyecto IN (SELECT ID_Proyecto FROM proyecto WHERE ID_Proyecto IN ( SELECT ID_Proyecto FROM evento_proyecto WHERE ID_Evento  = id_EventoA ));
	UPDATE proyecto SET Activo = 0 WHERE ID_Proyecto IN ( SELECT ID_Proyecto FROM evento_proyecto WHERE ID_Evento  = id_EventoA);
	UPDATE evento_proyecto SET Activo = 0 WHERE ID_Evento = id_EventoA;
    SET SQL_SAFE_UPDATES=1;
    
    UPDATE evento set Activo = 0 where ID_Evento = id_EventoA;
    
END