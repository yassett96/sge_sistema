-- ===================================
-- A Modificar, el cambio fue solo texto que se muestra en la vista de 'Eliminar Jurados Asignados' a 'Eliminar jurados asignados'
DELIMITER //
CREATE PROCEDURE `Listar_JuradoEventoActual`()
BEGIN
Declare idEvento int;
DECLARE DSubcategoriasEvento TEXT;
    SET DSubcategoriasEvento = Obtener_SubcategAsignadasAJurEActual();
SET idEvento = Obtener_EventoActual();
SET @REG=0;

Select distinct concat('<tr><td id="Anchio"><input hidden value = "',S.ID_SubCategoria,'"></td><td class="ordenJE">',@REG:= @REG+1,'</td><td class="NombreCatEA">',C.Nombre_Categoria,'</td><td class="NombreSubCatEA">',S.Nombre_SubCategoria,'</td><td><button  type="button" id="BtnEliminarJE" class=" btn-light CE" >Eliminar jurados asignados</button></td></tr>')
	
	 From subcategoria S 
	INNER JOIN categoria_subcategoria CS ON CS.ID_SubCategoria = S.ID_SubCategoria
	INNER JOIN categoria_evento CE ON CE.ID_Categoria = CS.ID_Categoria
	INNER JOIN categoria C ON C.ID_Categoria = CE.ID_Categoria
	WHERE CE.ID_Evento = idEvento

	AND S.Activo = 1
    AND FIND_IN_SET(S.ID_SubCategoria, DSubcategoriasEvento) 
	AND CS.Activo = 1
	AND CE.Activo = 1
	AND C.Activo = 1

	ORDER BY S.ID_SubCategoria;

END;