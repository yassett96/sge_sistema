-- MComision --
/****************************/
CREATE  PROCEDURE `Buscar_NombreComision`(in N_com varchar(100))
BEGIN
	declare p_com varchar(100) default (trim(N_com));
	Select count(Nombre_Comision) as coincidencia from comision  where Nombre_Comision = N_com and Activo = 1; 
END

-- PlanificacionE --
/*******************************/

CREATE  FUNCTION `Obtener_ComisionEventoActual`() RETURNS varchar(255) 
BEGIN
    DECLARE idEvento INT;
    DECLARE comisiones VARCHAR(255);
    
    SELECT ID_Evento INTO idEvento FROM evento WHERE Activo = 1 AND YEAR(Fecha) = YEAR(CURDATE());
    
    SELECT GROUP_CONCAT(ID_Comision SEPARATOR ',') INTO comisiones FROM comision_evento WHERE Activo = 1 AND ID_Evento = idEvento;
    
    RETURN comisiones;
END

/**********************/

CREATE  PROCEDURE `Lista_ComisionValidadaX`()
BEGIN    
    DECLARE GrupoComisionEvento TEXT;
    
    
    SET GrupoComisionEvento = Obtener_ComisionEventoActual();
    
    IF LENGTH(GrupoComisionEvento) > 0 THEN
        SELECT CONCAT('<option value="', ID_Comision, '">', Nombre_Comision, '</option>')
        FROM comision
        WHERE Activo = 1 AND FIND_IN_SET(ID_Comision, GrupoComisionEvento) = 0
        ORDER BY ID_Comision;
    ELSE
        select concat ('<option value ="',ID_Comision,'"','>',Nombre_Comision,'</option>')
		from comision
		where Activo = 1
		order by ID_Comision;
    END IF;
    
END