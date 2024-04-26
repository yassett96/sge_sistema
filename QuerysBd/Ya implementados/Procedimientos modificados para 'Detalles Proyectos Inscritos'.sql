DELIMITER //
CREATE PROCEDURE `Obtener_DatosProyectoSegunCodigoRegistroParticipanteEIdProyecto`(
	In Codigo_Registro_Participante int(6),
    In Id_Proyecto bigint(20)
)
Begin
	Declare vlocCodigoRegistroParticipante Int(6);
    Declare vlocIdProyecto Bigint(20);
    Declare vlocIntVerificador int(10) Default 0;
    
    Set vlocCodigoRegistroParticipante = Codigo_Registro_Participante;
    Set vlocIdProyecto = Id_Proyecto;
    
    Set vlocIntVerificador = (
		Select Pro.ID_Proyecto
			from Participante_Proyecto pp
				Inner Join Participante Par On Par.Id_Numero_Carnet= pp.Id_Participante
				Inner Join Proyecto Pro On Pro.Id_Proyecto = pp.Id_Proyecto
				Inner Join SubCategoria Sc On Sc.Id_SubCategoria = Pro.ID_SubCategoria
				Inner Join Categoria_SubCategoria Csc On Csc.ID_SubCategoria = Sc.ID_Subcategoria			
				Inner Join categoria C On C.ID_Categoria = Csc.Id_Categoria			
				Inner Join Personal_Academico Pa On Pa.ID_Personal_Academico = Pro.ID_Personal_Academico
				Inner Join Persona_Usuario Pu On Pu.ID_Persona_Usuario = Pa.ID_Persona_Usuario
				Inner Join Persona P On P.ID_Persona = Pu.Id_Persona
					Where Par.CodigoRegistro = vlocCodigoRegistroParticipante And Pro.ID_Proyecto = vlocIdProyecto
	);
    
    If (vlocIntVerificador is not null) Then		
		Select Pro.Nombre, Pro.Descripcion, C.Nombre_Categoria, Sc.Nombre_SubCategoria, P.Primer_Nombre, P.Primer_Apellido 
			from Participante_Proyecto pp
				Inner Join Participante Par On Par.Id_Numero_Carnet= pp.Id_Participante
				Inner Join Proyecto Pro On Pro.Id_Proyecto = pp.Id_Proyecto
				Inner Join SubCategoria Sc On Sc.Id_SubCategoria = Pro.ID_SubCategoria
				Inner Join Categoria_SubCategoria Csc On Csc.ID_SubCategoria = Sc.ID_Subcategoria			
				Inner Join categoria C On C.ID_Categoria = Csc.Id_Categoria			
				Inner Join Personal_Academico Pa On Pa.ID_Personal_Academico = Pro.ID_Personal_Academico
				Inner Join Persona_Usuario Pu On Pu.ID_Persona_Usuario = Pa.ID_Persona_Usuario
				Inner Join Persona P On P.ID_Persona = Pu.Id_Persona
					Where Par.CodigoRegistro = vlocCodigoRegistroParticipante And Pro.ID_Proyecto = vlocIdProyecto;
	Else
		Set vlocIntVerificador = 0;
		Select vlocIntVerificador;
    End If; 
    
End;