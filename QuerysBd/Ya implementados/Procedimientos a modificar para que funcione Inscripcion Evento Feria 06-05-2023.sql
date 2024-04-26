-- ====================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_CategoriasSegunParticipante`(
In ID_Numero_Carnet varchar (10)
)
Begin

	Declare vlocIdNumeroCarnet varchar(10);
    Declare vlocIdGrupoParticipante bigint(20);
    Declare vlocIdAñoAcademico bigint(20);
    Declare vlocIdEventoActual bigint(20);
    Declare vlocIdCategoriasSubCategorias bigint(20);
    Declare vlocIdCategorias bigint(20);
    
    Set vlocIdNumeroCarnet = ID_Numero_Carnet;
    Set vlocIdGrupoParticipante = (Select ID_Grupo From Participante p Where p.ID_Numero_Carnet = vlocIdNumeroCarnet);
    Set vlocIdAñoAcademico = (Select ID_Añoacademico From añogrupo_academico aa Where aa.ID_Grupo = vlocIdGrupoParticipante);
    Set vlocIdEventoActual = (Select Obtener_EventoActual());    
    
    SELECT DISTINCT csc.ID_Categoria, c.Nombre_Categoria 
	FROM Categoria_Evento ce 
	INNER JOIN Categoria_SubCategoria csc ON csc.ID_Categoria = ce.ID_Categoria 
    INNER JOIN Categoria c ON c.Id_Categoria = csc.Id_Categoria
    INNER JOIN SubCategoria sc ON sc.ID_SubCategoria = csc.Id_SubCategoria
	WHERE ((ce.ID_Evento = vlocIdEventoActual AND sc.ID_Añoacademico = vlocIdAñoAcademico) OR (ce.ID_Evento = vlocIdEventoActual AND sc.ID_Añoacademico = 6)) And ce.Activo = 1 And csc.Activo = 1 And c.Activo = 1 And sc.Activo = 1;
End;

	SELECT DISTINCT csc.ID_Categoria, c.Nombre_Categoria 
	FROM Categoria_Evento ce 
	INNER JOIN Categoria_SubCategoria csc ON csc.ID_Categoria = ce.ID_Categoria 
    INNER JOIN Categoria c ON c.Id_Categoria = csc.Id_Categoria
    INNER JOIN SubCategoria sc ON sc.ID_SubCategoria = csc.Id_SubCategoria
	WHERE ((ce.ID_Evento = 1 AND sc.ID_Añoacademico = 2) OR (ce.ID_Evento = 1 AND sc.ID_Añoacademico = 6)) And ce.Activo = 1 And csc.Activo = 1 And c.Activo = 1 And sc.Activo = 1;
    
    
    Select Distinct csc.ID_SubCategoria, sc.Nombre_SubCategoria From Categoria_Evento ce 
	Inner Join Categoria_SubCategoria csc on csc.ID_Categoria_SubCategoria = ce.ID_Categoria_Evento 
    Inner Join SubCategoria sc On sc.Id_SubCategoria = csc.Id_SubCategoria
    Where (ce.ID_Evento = 1 And sc.ID_Añoacademico = 2 And csc.ID_Categoria = 1)

-- ==============================================================================================================================================================================

DELIMITER //
CREATE PROCEDURE `Obtener_SubCategoriasSegunCategoriaYParticipante`(
In ID_Numero_Carnet varchar (10),
In ID_Categoria bigint(20)
)
Begin

	Declare vlocIdNumeroCarnet varchar(10);
    Declare vlocIdCategoria varchar(20);
    Declare vlocIdGrupoParticipante bigint(20);
    Declare vlocIdAñoAcademico bigint(20);
    Declare vlocIdEventoActual bigint(20);
    Declare vlocIdCategoriasSubCategorias bigint(20);
    Declare vlocIdCategorias bigint(20);
    
    Set vlocIdNumeroCarnet = ID_Numero_Carnet;
    Set vlocIdCategoria = ID_Categoria;
    Set vlocIdGrupoParticipante = (Select ID_Grupo From Participante p Where p.ID_Numero_Carnet = vlocIdNumeroCarnet);
    Set vlocIdAñoAcademico = (Select ID_Añoacademico From añogrupo_academico aa Where aa.ID_Grupo = vlocIdGrupoParticipante);
    Set vlocIdEventoActual = (Select Obtener_EventoActual());
    
    Select Distinct csc.ID_SubCategoria, sc.Nombre_SubCategoria From Categoria_Evento ce 
	Inner Join Categoria_SubCategoria csc on csc.ID_Categoria = ce.ID_Categoria 
    Inner Join SubCategoria sc On sc.Id_SubCategoria = csc.Id_SubCategoria
    Where (ce.ID_Evento = vlocIdEventoActual And sc.ID_Añoacademico = vlocIdAñoAcademico And csc.ID_Categoria = vlocIdCategoria)
    Union
    Select Distinct csc.ID_SubCategoria, sc.Nombre_SubCategoria From Categoria_Evento ce 
	Inner Join Categoria_SubCategoria csc on csc.ID_Categoria = ce.ID_Categoria
    Inner Join SubCategoria sc On sc.Id_SubCategoria = csc.Id_SubCategoria
    Where (ce.ID_Evento = vlocIdEventoActual And sc.ID_Añoacademico = 6 And csc.ID_Categoria = vlocIdCategoria); 
    
End;
-- ==============================================================================================================================================================================
