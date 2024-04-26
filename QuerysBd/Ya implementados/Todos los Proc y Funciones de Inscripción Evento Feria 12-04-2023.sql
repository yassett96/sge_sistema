DELIMITER //
CREATE FUNCTION `Verificar_ExistenciaParticipantePorCodigoRegistro`(vparCodigoRegistro varchar(10)) RETURNS int(11)
Begin
	Declare vlocParticipante varchar(10) Default '';
    Declare vlocVerificador Int Default 0;
    
    Set vlocParticipante = (Select ID_Numero_Carnet From Participante Where CodigoRegistro = vparCodigoRegistro And Activo = 1);
    if vlocParticipante != '' then
		Set vlocVerificador = 1;
    End If;
    
    Return vlocVerificador;
End;

DELIMITER //
CREATE PROCEDURE `Insercion_Proyecto`(
	IN nombre varchar(50),
    IN descripcion varchar(1000),
    IN id_categoria_evento bigint,
    IN id_personal_academico bigint    
)
Begin
	Set @vlocIntCargoDocente = (Select Verificar_CargoTutorEnPersonalAcademico(id_personal_academico));
    
	if @vlocIntCargoDocente = 1 then
		insert into proyecto (Nombre, Descripcion, ID_Categoria_Evento, ID_Personal_Academico, Activo) values (nombre, descripcion, id_categoria_evento, id_personal_academico, 1);
	Else
		Select 'La persona que está ingresando no es tutor.';
    End If;    	
End;


DELIMITER //
CREATE PROCEDURE `Insercion_ParticipanteProyecto`(
	IN id_participante varchar(20),
    IN id_proyecto BigInt    
)
Begin
	
    set @vlocExistencia = (Select Verificar_ExistenciaParticipanteEnProyecto(id_participante, id_proyecto));
    
    If @vlocExistencia = 0 then
			Insert Into Participante_Proyecto(ID_Participante, ID_Proyecto, Activo) values (id_participante, id_proyecto, 1);
	Else
		Select 'El participante ya se encuentra inscrito en este proyecto';
    End If;	
	
End;

DELIMITER //
CREATE PROCEDURE `Insercion_EventoProyecto`(
    IN id_evento bigint(20),
    IN id_proyecto bigint(20)
)
Begin	
    
    Set @vlocIntExistencia = (Select Verificar_ExistenciaEventoEnProyecto(id_evento, id_proyecto));
    
    If @vlocIntExistencia = 0 then
		insert into evento_proyecto (ID_Evento, ID_Proyecto, CalificacionFinal, Activo) Values (id_evento, id_proyecto, '', 1);
        select 1;
    Else
		Select 0;
    End If;    
End;

DELIMITER //
CREATE FUNCTION `Verificar_ExistenciaParticipanteEnProyecto`(vlocIdParticipante varchar(20), vlocIdProyecto int) RETURNS int(11)
Begin
	Declare vlocVerificador Int;
    Declare vlocConsulta varchar(20);
    
    Set vlocVerificador = 1;
    Set vlocConsulta = (select ID_Participante from participante_proyecto where ID_Participante = vlocIdParticipante and ID_Proyecto = vlocIdProyecto and Activo = 1 );
    
    if vlocConsulta is null then
		Set vlocVerificador = 0;
	End If;    
    
    return vlocVerificador;
End;

DELIMITER //
CREATE PROCEDURE `Obtener_EventoActual`()
Begin
	Select ID_Evento from evento Where Activo=1 and Year(Fecha) = Year(CurDate());
End;

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
    Set vlocIdEventoActual = (Select ID_Evento FROM Evento e Where Year(e.Fecha) = year(curdate()) And e.ID_Tipo_Evento = 1 And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00'));    
    
    Select Distinct csc.ID_Categoria, c.Nombre_Categoria From Categoria_Evento ce 
	Inner Join Categoria_SubCategoria csc on csc.ID_Categoria_SubCategoria = ce.ID_Categoria_Evento 
    Inner Join Categoria c On c.Id_Categoria = csc.Id_Categoria
    Where (ce.ID_Evento = vlocIdEventoActual And ce.ID_Añoacademico = vlocIdAñoAcademico) Or ce.ID_Añoacademico = 6;        
End;

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
    Set vlocIdEventoActual = (Select ID_Evento FROM Evento e Where Year(e.Fecha) = year(curdate()) And e.ID_Tipo_Evento = 1 And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00' And Year(ee.Fecha) = Year(curdate())) And e.Activo = 1);
    
    Select Distinct csc.ID_SubCategoria, sc.Nombre_SubCategoria From Categoria_Evento ce 
	Inner Join Categoria_SubCategoria csc on csc.ID_Categoria_SubCategoria = ce.ID_Categoria_Evento 
    Inner Join SubCategoria sc On sc.Id_SubCategoria = csc.Id_SubCategoria
    Where (ce.ID_Evento = vlocIdEventoActual And ce.ID_Añoacademico = vlocIdAñoAcademico And csc.ID_Categoria = vlocIdCategoria)
    Union
    Select Distinct csc.ID_SubCategoria, sc.Nombre_SubCategoria From Categoria_Evento ce 
	Inner Join Categoria_SubCategoria csc on csc.ID_Categoria_SubCategoria = ce.ID_Categoria_Evento 
    Inner Join SubCategoria sc On sc.Id_SubCategoria = csc.Id_SubCategoria
    Where (ce.ID_Evento = vlocIdEventoActual And ce.ID_Añoacademico = 6 And csc.ID_Categoria = vlocIdCategoria);        
End;

DELIMITER //
CREATE PROCEDURE `Obtener_IdCategoriaEvento_Por_CategoriaYSubCategoria`(
	IN ID_Categoria bigint (20),
	IN ID_Sub_Categoria bigint (20)
)
Begin
	Declare vlocIdCategoria bigint(20);
    Declare vlocIdSubCategoria bigint(20);
    Declare vlocIdCategoriaSubCategoria bigint(20);
    Declare vlocIdEvento bigint(20);
    Declare vlocIdCategoriaEvento bigint(20);
    
    Set vlocIdCategoria = ID_Categoria;
    Set vlocIdSubCategoria = ID_Sub_Categoria;
    
    Set vlocIdCategoriaSubCategoria = (Select ID_Categoria_SubCategoria From Categoria_Subcategoria cs Where cs.ID_Categoria = vlocIdCategoria And cs.ID_SubCategoria = vlocIdSubCategoria);
    
    Set vlocIdEvento = (Select e.ID_Evento From Evento e Where Year(e.Fecha) = year(curdate()) And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00' And Year(ee.Fecha) = year(curdate())) And e.Activo = 1);						
    
    Set vlocIdCategoriaEvento = (Select ID_Categoria_Evento From Categoria_Evento ce Where ce.ID_Categoria_SubCategoria = vlocIdCategoriaSubCategoria And ce.ID_Evento = vlocIdEvento);
    
    Select vlocIdCategoriaEvento;    
End;

DELIMITER //
CREATE PROCEDURE `Obtener_Grupos`()
Begin
	select*from Grupo Where Activo = 1;
End


DELIMITER //
CREATE PROCEDURE `Obtener_GrupoSegunIdGrupo`(
In id_grupo bigint(20)
)
Begin
	Declare vlocIdGrupo bigint(20);
    Declare vlocGrupo varchar(10) Default '';
    
    Set vlocIdGrupo = id_grupo;
    Set vlocGrupo = (Select g.Grupo From Grupo g Where g.ID_Grupo = vlocIdGrupo);
    
    select vlocGrupo;
    
End;

DELIMITER //
CREATE PROCEDURE `Obtener_Sedes`(

)
Begin
	Select * From Sede where Activo = 1;
End;

DELIMITER //
CREATE PROCEDURE `Obtener_SedeSegunIdSede`(
IN id_sede bigint(20)
)
Begin
	Declare vlocIdSede bigint(20);
    Declare vlocSede varchar(50);
    
    Set vlocIdSede = id_sede;
    Set vlocSede  = (Select s.Sede From Sede s Where s.ID_Sede = vlocIdSede);
    
    Select vlocSede;
End;

DELIMITER //
CREATE PROCEDURE `Obtener_Tutores`()
Begin
	Select pa.ID_Personal_Academico, p.Primer_Nombre, p.Primer_Apellido from Personal_Academico pa 		
    Inner Join Persona_Usuario pu On pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
	Inner Join Persona p On pu.ID_Persona = p.ID_Persona
	Where pa.id_cargo = 7 And pa.Activo = 1 And pu.Activo = 1 And p.Activo = 1;
End;

DELIMITER //
CREATE PROCEDURE `Obtener_DatosParticipantePorCodigoRegistro`(
	IN codigo_registro int
    )
Begin
	
    Set @vlocParticipante = (Select ID_Numero_Carnet From Participante where CodigoRegistro = codigo_registro);
    
    If @vlocParticipante Is Not Null Then
			Select Ps.ID_Persona,P.CodigoRegistro, Ps.Primer_Nombre, Ps.Segundo_Nombre, Ps.Primer_Apellido, Ps.Segundo_Apellido, Ps.Cedula, P.ID_Numero_Carnet, 
					G.ID_Grupo, S.ID_Sede, Ps.Telefono, Ps.Correo_Electronico
			From Participante P
            Inner Join Persona_Usuario Pu on Pu.ID_Persona_Usuario = P.ID_Persona_Usuario
			Inner Join Persona Ps on Ps.ID_Persona = Pu.ID_Persona
			Inner Join Sede S on S.ID_Sede = P.ID_Sede
			Inner Join Grupo G on G.ID_Grupo = P.ID_Grupo
			where P.CodigoRegistro = codigo_registro And P.Activo=1 And Pu.Activo=1 And Ps.Activo=1 And S.Activo=1 And G.Activo=1;	
    End If;
End;

DELIMITER //
CREATE PROCEDURE `Modificar_IdGrupoParticipantePorCodigoRegistro`(
	IN codigo_registro char(10),
    IN id_grupo varchar(10)
)
Begin 
	Declare vlocParticipante varchar(10) Default '';
    Declare vlocIdGrupoParticipante bigint;
    
    Set vlocIdGrupoParticipante = (Select g.ID_Grupo From Grupo g Where g.Grupo = id_grupo);
    Set vlocParticipante = (Select Verificar_ExistenciaParticipantePorCodigoRegistro(codigo_registro));
    
	if vlocParticipante = 1 then
		SET SQL_SAFE_UPDATES = 0;
		Update Participante p Set p.ID_Grupo = vlocIdGrupoParticipante Where p.CodigoRegistro = codigo_registro And p.Activo = 1;        
        SET SQL_SAFE_UPDATES = 1;
	else
		Select 'Participante con código registro no existe en base de datos';
	end if;
End;

DELIMITER //
CREATE PROCEDURE `Insercion_ConfirmacionParticipante`(
In ID_Persona_Inscribiendo bigint(20),
In ID_Persona_A_Inscribir bigint(20),
In Codigo_Confirmacion char(6)
)
Begin
	Declare vlocIdPersonaInscribiendo bigint(10);
    Declare vlocIdPersonaAInscribir bigint(20);
    Declare vlocCodigoConfirmacion char(6);
    Declare vlocFechaRegistro datetime;

	Set vlocIdPersonaInscribiendo = ID_Persona_Inscribiendo;
    Set vlocIdPersonaAInscribir = ID_Persona_A_Inscribir;
    Set vlocCodigoConfirmacion = Codigo_Confirmacion;
    Set vlocFechaRegistro = current_timestamp();
    
    If (vlocIdPersonaInscribiendo != '' && vlocIdPersonaAInscribir != '' && vlocCodigoConfirmacion != '') Then
		Insert Into Mensaje_Confirmacion_Participante (ID_Persona_Inscribiendo, ID_Persona_A_Inscribir, Fecha_Envio_Codigo, Codigo_Confirmacion) 
			Values (vlocIdPersonaInscribiendo, vlocIdPersonaAInscribir, vlocFechaRegistro, vlocCodigoConfirmacion);
		
        Select 1;
	else
		Select 0;
    End If;
End;

DELIMITER //
CREATE PROCEDURE `Eliminar_CodConfirmacionParticipanteTiempoExedido`(
In ID_Persona_Inscribiendo bigint(20),
In ID_Persona_A_Inscribir bigint(20)
)
Begin	
    Declare vlocIdPersonaInscribiendo bigint(20);
    Declare vlocIdPersonaAInscribir bigint(20);
    Declare vlocDateTimeInscripcion DateTime;
    Declare vlocDiferenciaMinutos bigint(20);
        
    Set vlocIdPersonaInscribiendo = ID_Persona_Inscribiendo;
    Set vlocIdPersonaAInscribir = ID_Persona_A_Inscribir;
    
    Set vlocDateTimeInscripcion = (Select Fecha_Envio_Codigo From mensaje_confirmacion_participante mcp
									Where mcp.Id_Persona_Inscribiendo = vlocIdPersonaInscribiendo 										
                                        And mcp.Id_Persona_A_Inscribir = vlocIdPersonaAInscribir);
    
    If vlocDateTimeInscripcion is not null Then
		Set vlocDiferenciaMinutos = timestampdiff(MINUTE, vlocDateTimeInscripcion, current_timestamp());
        
        If vlocDiferenciaMinutos > 1 Then
			Set SQL_SAFE_UPDATES = 0;
			Delete From mensaje_confirmacion_participante
				Where ID_Persona_Inscribiendo = vlocIdPersonaInscribiendo 					
                    And ID_Persona_A_Inscribir = vlocIdPersonaAInscribir;
			Set SQL_SAFE_UPDATES = 1;
                    
			Select 1 as result;
		Else
			Select 0 as result;
        End If;
	else
		select 0 as result;
    End If;    
End;

DELIMITER //
CREATE PROCEDURE `Eliminar_RegistroConfirmacionParticipante`(
In ID_Persona_Inscribiendo bigint(20),
In ID_Persona_A_Inscribir bigint(20)
)
Begin
	Declare vlocIdPersonaInscribiendo bigint(20);
    Declare vlocIdPersonaAInscribir bigint(20);    
    
    Set vlocIdPersonaInscribiendo = ID_Persona_Inscribiendo;
    Set vlocIdPersonaAInscribir = ID_Persona_A_Inscribir;
    
    Set SQL_SAFE_UPDATES = 0;
    Delete From Mensaje_Confirmacion_Participante Where ID_Persona_Inscribiendo = vlocIdPersonaInscribiendo And ID_Persona_A_Inscribir = vlocIdPersonaAInscribir;
    Set SQL_SAFE_UPDATES = 1;
    
End;

DELIMITER //
CREATE  PROCEDURE `Verificar_CodConfirmacionParticipante`(
In Codigo_Confirmacion char(6),
In ID_Persona_Inscribiendo bigint(20),
In ID_Persona_A_inscribir bigint(20)
)
Begin
	Declare vlocCodigoConfirmacion char(6);
    Declare vlocIdPersonaInscribiendo bigint(20);
    Declare vlocIdPersonaAInscribir bigint(20);
    Declare vlocPersona bigint(20);
    
    Set vlocCodigoConfirmacion = Codigo_Confirmacion;
    Set vlocIdPersonaInscribiendo = ID_Persona_Inscribiendo;
    Set vlocIdPersonaAInscribir = ID_Persona_A_Inscribir;
    
    Set vlocPersona = (Select ID_Mensaje_Confirmacion_Participante From Mensaje_Confirmacion_Participante mcp
						Where mcp.Codigo_Confirmacion = vlocCodigoConfirmacion
							And mcp.ID_Persona_A_Inscribir = vlocIdPersonaAInscribir
							And mcp.ID_Persona_Inscribiendo = vlocIdPersonaInscribiendo);
    
	if vlocPersona is not null Then
		Select 1 As result;
	Else 
		Select 0 As result;		
    End If;               
	
End;

DELIMITER //
CREATE PROCEDURE `Verificar_RegistroConfirmacionParticipante`(
In ID_Persona_Inscribiendo bigint(20),
In ID_Persona_A_Inscribir bigint(20)
)
Begin
	Declare vlocIdPersonaInscribiendo bigint(20);
    Declare vlocIdPersonaAInscribir bigint(20);
    Declare vlocConfirmacionParticipante bigint(20);
    
    Set vlocIdPersonaInscribiendo = ID_Persona_Inscribiendo;
    Set vlocIdPersonaAInscribir = ID_Persona_A_Inscribir;
    
    Set vlocConfirmacionParticipante = (Select ID_Persona_Inscribiendo From mensaje_confirmacion_participante mcp
										Where mcp.Id_Persona_Inscribiendo = vlocIdPersonaInscribiendo 										
											And mcp.Id_Persona_A_Inscribir = vlocIdPersonaAInscribir);
	
    if vlocConfirmacionParticipante is not null Then
		select 1;
	Else
		Select 0;
    End If;
End;

DELIMITER //
CREATE PROCEDURE `Verificar_IntegranteProyectoSegunParticipante`(
IN codigo_registro int(6),
IN id_categoria bigint(20),
IN id_subcategoria bigint(20)
)
Begin
	Declare vlocCodigoRegistro int(6);
    Declare vlocIdCategoria bigint(20);
    Declare vlocIdSubCategoria bigint(20);
    Declare vlocIdEventoFeriaActual bigint(20);
    Declare vlocIdGrupo bigint(20);
    Declare vlocAñoAcademico bigint(20);
    Declare vlocVerificacion bigint(20) Default 0;
    
    Set vlocCodigoRegistro = codigo_registro;
    Set vlocIdCategoria = id_categoria;
    Set vlocIdSubCategoria = id_subcategoria;    
    
    Set vlocIdGrupo = (Select ID_Grupo From Participante p Where p.CodigoRegistro = vlocCodigoRegistro);
    Set vlocAñoAcademico = (Select ID_Añoacademico From añogrupo_academico Where ID_Grupo = vlocIdGrupo);    
    Set vlocIdEventoFeriaActual = (Select e.ID_Evento From Evento e Where Year(e.Fecha) = year(curdate()) And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00' And Year(ee.Fecha) = year(curdate())) And e.Activo = 1);
    
    Set vlocVerificacion = (Select ID_Categoria_Evento From Categoria_Evento ce	
							Inner Join Categoria_SubCategoria csc On csc.ID_Categoria_SubCategoria = ce.ID_Categoria_Subcategoria
							Where (ce.ID_Añoacademico = vlocAñoAcademico And ce.ID_Evento = vlocIdEventoFeriaActual And csc.ID_Categoria = vlocIdCategoria And csc.ID_SubCategoria = vlocIdSubCategoria)
                            
                            UNION
                            
                            Select ID_Categoria_Evento From Categoria_Evento ce	
							Inner Join Categoria_SubCategoria csc On csc.ID_Categoria_SubCategoria = ce.ID_Categoria_Subcategoria
							Where (ce.ID_Añoacademico = 6 And ce.ID_Evento = vlocIdEventoFeriaActual And csc.ID_Categoria = vlocIdCategoria And csc.ID_SubCategoria = vlocIdSubCategoria)
                            );
                            
	If vlocVerificacion Is Not Null Then
		Set vlocVerificacion = 1;
        Select vlocVerificacion;
	Else
		Select vlocVerificacion;
    End If;    
End;