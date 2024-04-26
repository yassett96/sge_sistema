-- ================================================================================================================================
-- Procedimientos a crear
-- ================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_DatosIntegrantesSegunIdProyectoDetallesProyecto`(
	In id_proyecto Bigint
)
Begin
	Select per.Primer_Nombre, per.Segundo_Nombre, per.Primer_Apellido, per.Segundo_Apellido, per.Cedula, par.ID_Numero_Carnet, g.grupo, s.Sede From Proyecto p
		Inner Join Participante_Proyecto pp On pp.ID_Proyecto = p.ID_Proyecto
        Inner Join Participante par On par.ID_Numero_Carnet = pp.ID_Participante
        Inner Join Grupo g On g.ID_Grupo = par.Id_Grupo
        Inner Join Sede s On s.ID_Sede = par.ID_Sede
        Inner Join Persona_Usuario pu On pu.ID_Persona_Usuario = par.ID_Persona_Usuario
        Inner Join Persona per On per.ID_Persona = pu.ID_Persona
			Where p.ID_Proyecto = id_proyecto;
End;

-- ================================================================================================================================
-- Funciones a modificar
-- ================================================================================================================================
Drop Function Verificar_RolDocenteEnPersonalAcademico;
DELIMITER //
CREATE FUNCTION `Verificar_RolDocenteEnPersonalAcademico`(vparIntIDPersonalAcademico BigInt) RETURNS int(11)
Begin
	Declare vlocIntVerificador Int;
	Declare vlocIntIdRol Int;
    
    Set vlocIntIdRol = (Select ID_Rol 
							From Personal_Academico pa
								Inner Join PersonalAcademico_Rol par on par.ID_Personal_Academico = pa.ID_Personal_Academico
									Where pa.ID_Personal_Academico = vparIntIDPersonalAcademico And par.ID_Rol = 3 And pa.Activo = 1);
    Set vlocIntVerificador = 0;
    
    if vlocIntIdRol is not null then
		if vlocIntIdRol = 3 then
			Set vlocIntVerificador = 1;
		End If;		
    End If;
    
    Return vlocIntVerificador;
End;