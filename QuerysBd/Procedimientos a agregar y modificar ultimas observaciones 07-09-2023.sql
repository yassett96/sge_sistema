-- ===================================================================================================================================================
-- Procedimientos a agregar
-- ===================================================================================================================================================
DELIMITER //
Create Procedure Obtener_SubCategoriasSegunJurado(
	In id_persona bigint
)
Begin
	Select sc.ID_SubCategoria, sc.Nombre_SubCategoria From Persona p
	Inner Join Persona_Usuario pu On pu.ID_Persona = p.ID_Persona
    Inner Join Personal_Academico pa On pa.ID_Persona_Usuario = pu.ID_Persona_Usuario
    Inner Join Jurado j On j.ID_Personal_Academico = pa.ID_Personal_Academico
    Inner Join Jurado_Subcategoria js On js.ID_Jurado = j.ID_Jurado
    Inner Join SubCategoria sc On sc.ID_SubCategoria = js.ID_Subcategoria
		Where p.ID_Persona = id_persona;
End;

-- ===================================================================================================================================================
DELIMITER //
Create Procedure Obtener_ConfirmacionParticipanteProyecto(
	In id_participante varchar(20),
    In id_proyecto Bigint
)
Begin
	Select pp.Confirmacion From Participante_Proyecto pp Where pp.ID_Participante = id_participante And pp.ID_Proyecto = id_proyecto And pp.Activo = 1;
End;
-- ===================================================================================================================================================
-- Procedimientos a modificar
-- ===================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_NoProyectosInscritosSegunCodRegParticipante`(
	In vparCodigoRegistroParticipante int(6)
)
Begin
	Declare vlocCodigoRegistroParticipante int(6);    
    Declare vlocVerificador int(1) Default 0;
        
    Set vlocCodigoRegistroParticipante = vparCodigoRegistroParticipante;
    
    Set vlocVerificador = (
			Select count(*) 
				from Participante p
					inner join participante_proyecto pp on pp.ID_Participante = p.ID_Numero_Carnet
					inner join proyecto pr on pr.ID_Proyecto = pp.ID_Proyecto
                    inner join Evento_Proyecto ep on ep.ID_Proyecto = pr.ID_Proyecto
						Where p.CodigoRegistro = vlocCodigoRegistroParticipante And pp.Activo = 1 And pr.Activo = 1 And ep.Activo In (1, 2)
        );
        
	If (vlocVerificador > 0) Then
		Select vlocVerificador As No_Proyectos;
	Else		
		select 0 As No_Proyectos;
    End If;	
    
End;
-- ===================================================================================================================================================

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
					Where Par.CodigoRegistro = vlocCodigoRegistroParticipante And Pro.ID_Proyecto = vlocIdProyecto And pp.Activo = 1
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

-- ===================================================================================================================================================

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
			Where p.ID_Proyecto = id_proyecto And pp.Activo = 1;
End;


-- ===================================================================================================================================================

DELIMITER //
CREATE PROCEDURE `Obtener_NoProyectosInscritosSegunCodRegParticipante`(
	In vparCodigoRegistroParticipante int(6)
)
Begin
	Declare vlocCodigoRegistroParticipante int(6);    
    Declare vlocVerificador int(1) Default 0;
        
    Set vlocCodigoRegistroParticipante = vparCodigoRegistroParticipante;
    
    Set vlocVerificador = (
			Select count(*) 
				from Participante p
					inner join participante_proyecto pp on pp.ID_Participante = p.ID_Numero_Carnet
					inner join proyecto pr on pr.ID_Proyecto = pp.ID_Proyecto
                    inner join Evento_Proyecto ep on ep.ID_Proyecto = pr.ID_Proyecto
                    inner join Evento e on e.ID_Evento = ep.ID_Evento
						Where p.CodigoRegistro = 000029 And pp.Activo = 1 And pr.Activo = 1 And ep.Activo In (1, 2) And e.Activo = 1
        );
        
	If (vlocVerificador > 0) Then
		Select vlocVerificador As No_Proyectos;
	Else		
		select 0 As No_Proyectos;
    End If;	
    
End;

-- ===================================================================================================================================================

DELIMITER //
CREATE PROCEDURE `Insercion_ParticipanteProyecto`(
	IN id_participante varchar(20),
    IN id_proyecto BigInt    
)
Begin
	
    set @vlocExistencia = (Select Verificar_ExistenciaParticipanteEnProyecto(id_participante, id_proyecto));
    
    If @vlocExistencia = 0 then
			Insert Into Participante_Proyecto(ID_Participante, ID_Proyecto, Confirmacion, Activo) values (id_participante, id_proyecto, 0, 1);
	Else
		Select 'El participante ya se encuentra inscrito en este proyecto';
    End If;	
	
End;

-- ===================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_ProyectosInscritosSegunCodigoRegistroParticipante`(
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
		Where p.CodigoRegistro = vlocCodigoRegistroParticipante And pp.Activo = 1
        );
        
	If (vlocVerificador > 0) Then
		Select pr.ID_Proyecto, pr.Nombre 
        from Participante p
		inner join participante_proyecto pp on pp.ID_Participante = p.ID_Numero_Carnet
		inner join proyecto pr on pr.ID_Proyecto = pp.ID_Proyecto
		Where p.CodigoRegistro = vlocCodigoRegistroParticipante And pp.Activo = 1;
	Else		
		select vlocVerificador As ID_Proyecto, vlocVerificador As Nombre;
    End If;	
    
End;
-- ===================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Eliminar_IntegranteDeProyecto`(
	In id_participante varchar(10),
    In id_proyecto bigint
)
Begin
	Update Participante_Proyecto pp Set pp.Activo = 0, pp.Confirmacion = 0 Where pp.ID_Participante = id_participante And pp.ID_Proyecto = id_proyecto;
    Select 1 As Resultado_Eliminacion;
End;
-- ===================================================================================================================================================                     
DELIMITER //
CREATE PROCEDURE `Obtener_NoProyectosInscritosSegunCodRegParticipante`(
	In vparCodigoRegistroParticipante int(6)
)
Begin
	Declare vlocCodigoRegistroParticipante int(6);    
    Declare vlocVerificador int(1) Default 0;
        
    Set vlocCodigoRegistroParticipante = vparCodigoRegistroParticipante;
    
    Set vlocVerificador = (
			Select count(*) 
				from Participante p
					inner join participante_proyecto pp on pp.ID_Participante = p.ID_Numero_Carnet
					inner join proyecto pr on pr.ID_Proyecto = pp.ID_Proyecto
                    inner join Evento_Proyecto ep on ep.ID_Proyecto = pr.ID_Proyecto
                    inner join Evento e on e.ID_Evento = ep.ID_Evento
						Where p.CodigoRegistro = vparCodigoRegistroParticipante And pp.Activo = 1 And pr.Activo = 1 And ep.Activo In (1, 2) And e.Activo = 1
        );
        
	If (vlocVerificador > 0) Then
		Select vlocVerificador As No_Proyectos;
	Else		
		select 0 As No_Proyectos;
    End If;	
    
End;
