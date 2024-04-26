-- ================================================================================================================================================================
-- Procedimientos a modificar
-- ================================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Listar_TipoU_AdminUsuarios`()
BEGIN
select concat ('<option value ="',tu.Id_Tipo_Usuario,'"','>',tu.Tipo_Usuario,'</option>')
    from tipo_usuario tu
    where  tu.Activo = 1 And tu.ID_Tipo_Usuario Not In (2, 4, 6)
    order by tu.ID_Tipo_Usuario;
END;

-- ================================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_ListaUsuariosNoAsignadosAPersonaParaSelect`(
	In ID_Persona BigInt
)
Begin    
    SELECT CONCAT('<option value ="',tu.Id_Tipo_Usuario,'"','>',tu.Tipo_Usuario,'</option>')
	FROM tipo_usuario tu
	WHERE tu.Activo = 1 
	AND NOT EXISTS (
	  SELECT 1
	  FROM persona_usuario pu
	  INNER JOIN persona p ON p.ID_Persona = pu.ID_Persona
	  WHERE pu.Id_Tipo_Usuario = tu.Id_Tipo_Usuario
	  AND p.Activo = 1
      AND pu.Activo = 1
	  AND p.ID_Persona = ID_Persona
	)
    AND tu.ID_Tipo_Usuario Not In (2);
End;

-- ================================================================================================================================================================
Drop Procedure Obtener_ProyectosAsignadosJurado
call Obtener_ProyectosAsignadosJurado(15)
DELIMITER //
CREATE PROCEDURE `Obtener_ProyectosAsignadosJurado`(
	In id_persona bigint
)
Begin	
	Declare vlocIdEventoActual Bigint;
    
    Set vlocIdEventoActual = (Select Obtener_EventoActual());
                    
	Select
		pro.ID_Proyecto,
		pro.nombre,
		c.Nombre_Categoria,
		sc.Nombre_SubCategoria,
		CONCAT(pt.Primer_Nombre, ' ', pt.Primer_Apellido) AS Tutor
		 From Persona p
			Inner Join Persona_Usuario pu On pu.ID_Persona = p.ID_Persona
			Inner Join Personal_Academico pa On pa.ID_Persona_Usuario = pu.ID_Persona_Usuario
			Inner Join Jurado j On j.ID_Personal_Academico = pa.ID_Personal_Academico
			Inner Join Jurado_SubCategoria jsc On jsc.ID_Jurado = j.ID_Jurado
			Inner Join SubCategoria sc On sc.ID_SubCategoria = jsc.ID_SubCategoria
			Inner Join Proyecto pro On pro.ID_SubCategoria = sc.ID_SubCategoria
			Inner Join Evento_Proyecto ep On ep.ID_Proyecto = pro.ID_Proyecto
			Inner Join Categoria_SubCategoria csc On csc.ID_SubCategoria = pro.ID_SubCategoria
			Inner Join Categoria c On c.ID_Categoria = csc.ID_Categoria
			
			Inner Join Personal_Academico pat On pat.ID_Personal_Academico = pro.ID_Personal_Academico
			Inner Join Persona_Usuario put On put.ID_Persona_Usuario = pat.ID_Persona_Usuario
			Inner Join Persona pt On pt.ID_Persona = put.ID_Persona
				Where p.ID_Persona = id_persona And (ep.CalificacionFinal = '' Or ep.CalificacionFinal Is Null) And ep.ID_Evento = vlocIdEventoActual And sc.ID_SubCategoria = jsc.ID_SubCategoria And
					p.Activo = 1 And pu.Activo = 1 And pa.Activo = 1 And j.Activo = 1 And jsc.Activo = 1 And sc.Activo = 1 And pro.Activo = 1 And ep.Activo = 2 And csc.Activo = 1 And c.Activo = 1 And
                    pat.Activo = 1 And put.Activo = 1 And pt.Activo = 1;

End;
-- ================================================================================================================================================================
-- Procedimientos a agregar
-- ================================================================================================================================================================
DELIMITER //
Create Procedure Obtener_InformacionEventoActualParaIndex()
begin
	Select te.Nombre_Eventos, e.Nombre_Evento, e.Eslogan, e.Logo, e.hora, e.Fecha, s.Nombre_Sitio From Evento e 
		Inner Join Sitio s On s.ID_Sitio = e.ID_Sitio
        Inner Join Tipo_Eventos te On te.ID_Tipo_Evento = e.ID_Tipo_Evento
        Where e.Activo = 1;
End;
-- ===================================================================================================================================================
DELIMITER //
Create Procedure Obtener_InformacionJuradoSegunIdPersona(
	In id_persona Bigint
)
Begin
	Select j.ID_Jurado, j.ID_Personal_Academico, ID_Formato, j.JuradoPos From Jurado j
		Inner Join Personal_Academico pa On pa.ID_Personal_Academico = j.ID_Personal_Academico
        Inner Join Persona_Usuario pu On pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
        Inner Join Persona p On p.ID_Persona = pu.ID_Persona
			Where p.ID_Persona = id_persona;
End;
-- ===================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_DatosProyectosGanadores`(
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
-- ===================================================================================================================================================

DELIMITER //
Create Procedure Obtener_CriteriosSegunIdFormato(
	In id_formato Bigint
)
Begin
	Select
	f.NombreFormato, c.ID_Criterio, c.NombreCriterios, fc.Valor, c.Descripcion
		from formato_criterio fc
			Inner Join Criterios c On c.ID_Criterio = fc.ID_Criterio
			Inner Join Tipo_Formato f On f.ID_Tipo_Formato = fc.ID_Tipo_Formato
				Where fc.ID_Tipo_Formato = id_formato;
End;

-- ===================================================================================================================================================

DELIMITER //
CREATE PROCEDURE `Obtener_ProyectosEvaluadosJurado`(
	In id_persona bigint
)
Begin
	Declare vlocIdEventoActual Bigint;
    
    Set vlocIdEventoActual = (Select Obtener_Eventoactual());
    
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
					WHERE p.ID_Persona = id_persona And (ep.CalificacionFinal != '' And ep.CalificacionFinal Is Not Null) And ep.Activo=2 And pro.Activo=1 And ce.ID_Evento = vlocIdEventoActual;
End;
-- ==========================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_CriteriosEvaluacionJurado`(
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