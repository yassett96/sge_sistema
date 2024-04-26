DELIMITER //
Create Procedure Obtener_ProyectosInscritosSegunCodigoRegistroParticipante(
In vparCodigoRegistroParticipante int(6)
)
Begin
	Declare vlocCodigoRegistroParticipante int(6);    
    Declare vlocVerificador int(1) Default 0;
        
    Set vlocCodigoRegistroParticipante = vparCodigoRegistroParticipante;
    
    Set vlocVerificador = (
		Select count(*) from Participante p
		inner join participante_proyecto pp on pp.ID_Participante = p.ID_Numero_Carnet
		inner join proyecto pr on pr.ID_Proyecto = pp.ID_Proyecto
		Where p.CodigoRegistro = vlocCodigoRegistroParticipante
        );
        
	If (vlocVerificador > 0) Then
		Select pr.ID_Proyecto, pr.Nombre from Participante p
		inner join participante_proyecto pp on pp.ID_Participante = p.ID_Numero_Carnet
		inner join proyecto pr on pr.ID_Proyecto = pp.ID_Proyecto
		Where p.CodigoRegistro = vlocCodigoRegistroParticipante;
	Else		
		select vlocVerificador;
    End If;	
    
End;

DELIMITER //
Create Procedure Verificar_ExistenciaProyectoSegunCodigoRegistro(
	In Codigo_Registro int(6)
)
Begin
	Declare vlocCodigoRegistro int(6);
    Declare vlocVerificador int(10);
    
    Set vlocCodigoRegistro = Codigo_Registro;
    
    Set vlocVerificador = (Select count(*) from Participante p
							inner join participante_proyecto pp on pp.ID_Participante = p.ID_Numero_Carnet
							inner join proyecto pr on pr.ID_Proyecto = pp.ID_Proyecto
							Where p.CodigoRegistro = vlocCodigoRegistro);
                            
	If vlocVerificador is not null Then
		Select vlocVerificador As Verificacion;
	Else
		Set vlocVerificador = 0;
        Select vlocVerificador As Verficacion;        
    End If;
End;

DELIMITER //
Create Procedure Obtener_DatosProyectoSegunCodigoRegistroParticipanteEIdProyecto(
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
				Inner Join Categoria_Evento Ce On Ce.ID_Categoria_Evento = Pro.ID_Categoria_Evento
				Inner Join Categoria_SubCategoria Csc On Csc.ID_Categoria_SubCategoria = Ce.ID_Categoria_SubCategoria
				Inner Join Categoria C On C.Id_Categoria = Csc.ID_Categoria
				Inner Join SubCategoria Sc On Sc.Id_SubCategoria = Csc.ID_SubCategoria
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
			Inner Join Categoria_Evento Ce On Ce.ID_Categoria_Evento = Pro.ID_Categoria_Evento
			Inner Join Categoria_SubCategoria Csc On Csc.ID_Categoria_SubCategoria = Ce.ID_Categoria_SubCategoria
			Inner Join Categoria C On C.Id_Categoria = Csc.ID_Categoria
			Inner Join SubCategoria Sc On Sc.Id_SubCategoria = Csc.ID_SubCategoria
			Inner Join Personal_Academico Pa On Pa.ID_Personal_Academico = Pro.ID_Personal_Academico
			Inner Join Persona_Usuario Pu On Pu.ID_Persona_Usuario = Pa.ID_Persona_Usuario
			Inner Join Persona P On P.ID_Persona = Pu.Id_Persona
				Where Par.CodigoRegistro = vlocCodigoRegistroParticipante And Pro.ID_Proyecto = vlocIdProyecto;
	Else
		Set vlocIntVerificador = 0;
		Select vlocIntVerificador;
    End If; 
    
End;

DELIMITER //
Create Procedure Obtener_DatosIntegrantesSegunIdProyecto(
	In Id_Proyecto bigint(20)
)
Begin	
    Declare vlocIdProyecto Bigint(20);	
        
    Set vlocIdProyecto = Id_Proyecto;        
        
		Select  P.Primer_Nombre, P.Primer_Apellido, Par.ID_Numero_Carnet
			from Participante_Proyecto pp
				Inner Join Participante Par On Par.Id_Numero_Carnet= pp.Id_Participante
				Inner Join Proyecto Pro On Pro.Id_Proyecto = pp.Id_Proyecto
				Inner Join Categoria_Evento Ce On Ce.ID_Categoria_Evento = Pro.ID_Categoria_Evento
				Inner Join Categoria_SubCategoria Csc On Csc.ID_Categoria_SubCategoria = Ce.ID_Categoria_SubCategoria
				Inner Join Categoria C On C.Id_Categoria = Csc.ID_Categoria
				Inner Join SubCategoria Sc On Sc.Id_SubCategoria = Csc.ID_SubCategoria
				Inner Join Personal_Academico Pa On Pa.ID_Personal_Academico = Pro.ID_Personal_Academico
				Inner Join Persona_Usuario Pu On Pu.ID_Persona_Usuario = Pa.ID_Persona_Usuario
				Inner Join Persona P On P.ID_Persona = Pu.Id_Persona
					Where Pro.ID_Proyecto = vlocIdProyecto;		
End;