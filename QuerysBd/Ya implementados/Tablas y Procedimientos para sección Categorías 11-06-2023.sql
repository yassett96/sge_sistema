-- ==============================================================================================================================
-- Procedimientos a agregar
-- ==============================================================================================================================
DELIMITER //
Create Procedure Obtener_InformacionEventoActual()
Begin
	Select e.Nombre_Evento, c.Nombre_Categoria, sc.Nombre_SubCategoria, aa.Año From Evento e
		Inner Join Categoria_Evento ce On ce.ID_Evento = e.ID_Evento
		Inner Join Categoria c on c.ID_Categoria = ce.ID_Categoria
		Inner Join Categoria_Subcategoria csc on csc.ID_Categoria = c.ID_Categoria
		Inner Join Subcategoria sc on sc.ID_SubCategoria = csc.ID_SubCategoria
		Inner Join Añoacademico aa on aa.ID_Añoacademico = sc.Id_Añoacademico
			Where e.Activo = 1 And ce.Activo = 1 And c.Activo = 1 And csc.Activo = 1 And sc.Activo = 1 And aa.Activo = 1
				Order By c.Nombre_Categoria Asc;
End;
-- ==============================================================================================================================