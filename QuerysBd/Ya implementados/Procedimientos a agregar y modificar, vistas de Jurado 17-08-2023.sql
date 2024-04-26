-- ====================================================================================================================================================================================
-- Procedimientos a crear
-- ====================================================================================================================================================================================
DELIMITER //
Create Procedure Obtener_ProyectosAsignadosJurado(
	In id_persona bigint
)
Begin
	SELECT
		pro.ID_Proyecto,
		pro.nombre,
		c.Nombre_Categoria,
		sc.Nombre_SubCategoria,
		CONCAT(pp.Primer_Nombre, ' ', pp.Primer_Apellido) AS Tutor
			FROM Persona p
				Inner Join Persona_Usuario pu On p.ID_Persona = pu.ID_Persona
				Inner Join Personal_Academico pa On pa.ID_Persona_Usuario = pu.ID_Persona_Usuario
				Inner Join Jurado j On j.ID_Personal_Academico = pa.ID_Personal_Academico
				Inner Join Categoria_Evento ce On ce.ID_Categoria_Evento = j.ID_Categoria_Evento
				Inner Join Categoria_SubCategoria csc On csc.ID_Categoria = ce.Id_Categoria
				Inner Join Proyecto pro On pro.ID_SubCategoria = csc.ID_SubCategoria
                Inner Join Evento_Proyecto ep On ep.ID_Proyecto = pro.ID_Proyecto
				Inner Join Categoria c On c.ID_Categoria = csc.ID_Categoria
				Inner Join SubCategoria sc On sc.ID_SubCategoria = csc.ID_SubCategoria

				Inner Join Personal_Academico pap On pap.ID_Personal_Academico = pro.ID_Personal_Academico
				Inner Join Persona_Usuario pup On pup.ID_Persona_Usuario = pap.ID_Persona_Usuario
				Inner Join Persona pp On pp.ID_Persona = pup.ID_Persona
					WHERE p.ID_Persona = id_persona And (ep.CalificacionFinal = '' Or ep.CalificacionFinal Is Null);
End;
-- ====================================================================================================================================================================================
DELIMITER //
Create Procedure Obtener_ProyectosEvaluadosJurado(
	In id_persona bigint
)
Begin
	SELECT
		pro.ID_Proyecto,
		pro.nombre,
		c.Nombre_Categoria,
		sc.Nombre_SubCategoria,
		CONCAT(pp.Primer_Nombre, ' ', pp.Primer_Apellido) AS Tutor,
        ep.CalificacionFinal
			FROM Persona p
				Inner Join Persona_Usuario pu On p.ID_Persona = pu.ID_Persona
				Inner Join Personal_Academico pa On pa.ID_Persona_Usuario = pu.ID_Persona_Usuario
				Inner Join Jurado j On j.ID_Personal_Academico = pa.ID_Personal_Academico
				Inner Join Categoria_Evento ce On ce.ID_Categoria_Evento = j.ID_Categoria_Evento
				Inner Join Categoria_SubCategoria csc On csc.ID_Categoria = ce.Id_Categoria
				Inner Join Proyecto pro On pro.ID_SubCategoria = csc.ID_SubCategoria
                Inner Join Evento_Proyecto ep On ep.ID_Proyecto = pro.ID_Proyecto
				Inner Join Categoria c On c.ID_Categoria = csc.ID_Categoria
				Inner Join SubCategoria sc On sc.ID_SubCategoria = csc.ID_SubCategoria

				Inner Join Personal_Academico pap On pap.ID_Personal_Academico = pro.ID_Personal_Academico
				Inner Join Persona_Usuario pup On pup.ID_Persona_Usuario = pap.ID_Persona_Usuario
				Inner Join Persona pp On pp.ID_Persona = pup.ID_Persona
					WHERE p.ID_Persona = id_persona And (ep.CalificacionFinal != '' And ep.CalificacionFinal Is Not Null);
End;
-- ====================================================================================================================================================================================
DELIMITER //
Create Procedure Obtener_DatosProyectosSegunIdProyecto(
	In id_proyecto Bigint
)
Begin	
    Select p.Nombre, c.Nombre_Categoria, sc.Nombre_SubCategoria, p.Descripcion From Proyecto p
		Inner Join Categoria_Subcategoria csc On csc.ID_SubCategoria = p.ID_SubCategoria
        Inner Join Categoria c On c.ID_Categoria = csc.ID_Categoria
        Inner Join SubCategoria sc On sc.ID_SubCategoria = csc.ID_SubCategoria
			Where p.ID_Proyecto = id_proyecto;
End;
-- ====================================================================================================================================================================================
DELIMITER //
Create Procedure Obtener_DatosIntegrantesSegunIdProyecto(
	In id_proyecto Bigint
)
Begin
	Select per.Primer_Nombre, per.Segundo_Nombre, per.Primer_Apellido, per.Segundo_Apellido From Proyecto p
		Inner Join Participante_Proyecto pp On pp.ID_Proyecto = p.ID_Proyecto
        Inner Join Participante par On par.ID_Numero_Carnet = pp.ID_Participante
        Inner Join Persona_Usuario pu On pu.ID_Persona_Usuario = par.ID_Persona_Usuario
        Inner Join Persona per On per.ID_Persona = pu.ID_Persona
			Where p.ID_Proyecto = id_proyecto;
End;
-- ====================================================================================================================================================================================
DELIMITER //
Create Procedure Modificar_EvaluacionProyecto(
	In id_evento bigint,
    In id_proyecto bigint,
    In calificacion_final varchar(5),
    In comentario varchar(1000)
)
Begin
	Update Evento_Proyecto ep Set ep.CalificacionFinal = calificacion_final, ep.Comentario = comentario Where ep.ID_Evento = id_evento And ep.ID_Proyecto = id_proyecto;
    Select 1 As Resultado_Modificacion;
End;
-- ====================================================================================================================================================================================

DELIMITER //
Create Procedure Obtener_CriteriosEvaluacionJurado(
	In id_persona_jurado Bigint
)
Begin
	Declare vlocIdTipoFormato Bigint;
    
    Set vlocIdTipoFormato = (
		Select j.ID_Formato From Persona p
			Inner Join Persona_Usuario pu On p.ID_Persona = pu.ID_Persona
			Inner Join Personal_Academico pa On pa.ID_Persona_Usuario = pu.ID_Persona_Usuario
			Inner Join Jurado j On j.ID_Personal_Academico = pa.ID_Personal_Academico
				Where p.ID_Persona = id_persona_jurado
    );
    
    If vlocIdTipoFormato = 1 Then
		Select c.ID_Criterio, c.NombreCriterios, c.Descripcion, c.Activo 
			From Criterios c
				Where c.ID_Criterio In (1,2,3,4);
    End If;
    
    If vlocIdTipoFormato = 2 Then
		Select c.ID_Criterio, c.NombreCriterios, c.Descripcion, c.Activo 
			From Criterios c
				Where c.ID_Criterio In (2,3,4);
    End If;

End;
-- ====================================================================================================================================================================================

DELIMITER //
Create Procedure Obtener_DatosProyectosGanadores(
	In id_subcategoria bigint
)
Begin
	Declare vlocIdEventoFeriaActual Bigint;
    
    Set vlocIdEventoFeriaActual= (SELECT e.ID_Evento FROM Evento e WHERE e.Activo=1 AND YEAR(e.Fecha) = YEAR(CURDATE()) And e.ID_Tipo_Evento = 1);
    
	Select p.ID_Proyecto, p.Nombre, per.Primer_Nombre, per.Primer_Apellido, ep.CalificacionFinal 
		From Proyecto p 
			Inner Join SubCategoria sc On sc.ID_SubCategoria = p.ID_SubCategoria
			Inner Join Evento_Proyecto ep On ep.ID_Proyecto = p.ID_Proyecto
			Inner Join Personal_Academico pa On pa.ID_Personal_Academico = p.ID_Personal_Academico
			Inner Join Persona_Usuario pu On pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
			Inner Join Persona per On per.ID_Persona = pu.ID_Persona
				Where sc.ID_SubCategoria = id_subcategoria And ep.ID_Evento = vlocIdEventoFeriaActual And ep.CalificacionFinal != '' And ep.CalificacionFinal Is Not Null
					Order By ep.CalificacionFinal Desc Limit 2;
End;
-- ====================================================================================================================================================================================
-- Tablas a modificar
-- ====================================================================================================================================================================================
Alter Table Evento_Proyecto Add Comentario Varchar(1000) After CalificacionFinal;
-- ====================================================================================================================================================================================
-- Procedimientos a modificar
-- ====================================================================================================================================================================================
-- Drop Procedure Obtener_SubCategorias
DELIMITER //
Create Procedure Obtener_SubCategorias()
Begin
	Declare vlocIdEventoActual Bigint;
    
    Set vlocIdEventoActual = (Select Obtener_EventoActual());

	select distinct sc.ID_SubCategoria, sc.Nombre_SubCategoria, sc.Id_Añoacademico from Categoria_Evento ce
		Inner Join Categoria_SubCategoria csc On csc.ID_Categoria = ce.ID_Categoria
		Inner Join SubCategoria sc On sc.ID_SubCategoria = csc.ID_SubCategoria
			Where ce.ID_Evento = vlocIdEventoActual And sc.Activo = 1 And csc.Activo = 1 And sc.Activo = 1;
End;
-- ====================================================================================================================================================================================