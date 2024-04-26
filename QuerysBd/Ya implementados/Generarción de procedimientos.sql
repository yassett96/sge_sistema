-- Procedimiento para obtener la ID_Categoria_Evento dado la categoría y subcategoria
DELIMITER //
Create Procedure Obtener_IdCategoriaEvento_Por_CategoriaYSubCategoria(
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
    
    Set vlocIdEvento = (Select ID_Evento From Evento e Where year(e.Fecha) = year(curdate()));
    
    Set vlocIdCategoriaEvento = (Select ID_Categoria_Evento From Categoria_Evento ce Where ce.ID_Categoria_SubCategoria = vlocIdCategoriaSubCategoria And ce.ID_Evento = vlocIdEvento);
    
    Select vlocIdCategoriaEvento;    
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
Create Procedure Verificar_IntegranteProyectoSegunParticipante(
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
    Set vlocIdEventoFeriaActual = (Select ID_Evento FROM Evento e Where Year(e.Fecha) = year(curdate()) And e.ID_Tipo_Evento = 1);
    
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
    Set vlocIdEventoActual = (Select ID_Evento FROM Evento e Where Year(e.Fecha) = year(curdate()) And e.ID_Tipo_Evento = 1 And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00'));    
    
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
CREATE PROCEDURE `Cargar_Acceso_Participante`(in idpersona bigint)
BEGIN

declare id_per int default idpersona;
declare id_tipou int default 1;

select p.ID_Persona, p.Primer_Nombre, p.Segundo_Nombre, p.Primer_Apellido, p.Segundo_Apellido,p.Telefono,p.Correo_Electronico, 
p.Avatar,par.CodigoRegistro, pu.ID_Tipo_Usuario, g.grupo, par.ID_Grupo,  par.ID_Sede, p.Cedula,
c.Contraseña, par.ID_Numero_Carnet, s.Sede from persona as p

inner join persona_usuario as pu on pu.ID_Persona = p.ID_Persona
inner join participante as par on par.ID_Persona_Usuario = pu.ID_Persona_Usuario
inner join grupo as parg on parg.ID_Grupo = par.ID_Grupo
inner join credenciales as c on c.ID_Persona = p.ID_Persona
inner join grupo as g on g.ID_Grupo = par.ID_Grupo
inner join sede as s on s.Id_Sede = par.Id_Sede
where p.ID_Persona = id_per and pu.ID_Tipo_Usuario = id_tipou and pu.Activo=1 and p.Activo = 1;
END;

DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `Obtener_DatosParticipantePorCodigoRegistro`(
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
End

-- ==========================================================================
-- Nota: Se debe cambiar la relación de la tabla Evento_Proyecto, porque la relación de la tabla es solo los eventos y los proyectos y no el evento con el 'participante_proyecto'.
-- ==========================================================================


-- Inserciones necesarias
Insert Into Categoria_Evento (ID_Categoria_SubCategoria, ID_Evento, ID_Añoacademico, Activo)
values (2, 1, 4, 1);
Insert Into Categoria_Evento (ID_Categoria_SubCategoria, ID_Evento, ID_Añoacademico, Activo)
values (3, 1, 2, 1);
Insert Into Categoria_Evento (ID_Categoria_SubCategoria, ID_Evento, ID_Añoacademico, Activo)
values (4, 1, 1, 1);
Insert Into Categoria_Evento (ID_Categoria_SubCategoria, ID_Evento, ID_Añoacademico, Activo)
values (5, 1, 3, 1);
Insert Into Categoria_Evento (ID_Categoria_SubCategoria, ID_Evento, ID_Añoacademico, Activo)
values (6, 1, 1, 1);
Insert Into Categoria_Evento (ID_Categoria_SubCategoria, ID_Evento, ID_Añoacademico, Activo)
values (7, 1, 1, 1);
Insert Into Categoria_Evento (ID_Categoria_SubCategoria, ID_Evento, ID_Añoacademico, Activo)
values (8, 1, 4, 1);
Insert Into Categoria_Evento (ID_Categoria_SubCategoria, ID_Evento, ID_Añoacademico, Activo)
values (9, 1, 2, 1);
Insert Into Categoria_Evento (ID_Categoria_SubCategoria, ID_Evento, ID_Añoacademico, Activo)
values (10, 1, 1, 1);
Insert Into Categoria_Evento (ID_Categoria_SubCategoria, ID_Evento, ID_Añoacademico, Activo)
values (11, 1, 3, 1);
Insert Into Categoria_Evento (ID_Categoria_SubCategoria, ID_Evento, ID_Añoacademico, Activo)
values (12, 1, 3, 1);
Insert Into Categoria_Evento (ID_Categoria_SubCategoria, ID_Evento, ID_Añoacademico, Activo)
values (13, 1, 3, 1);
Insert Into Categoria_Evento (ID_Categoria_SubCategoria, ID_Evento, ID_Añoacademico, Activo)
values (14, 1, 5, 1);

-- Registros necesarios en la tabla AñoGrupo_Academico
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (2, 19, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (3, 20, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (4, 21, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (4, 22, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (5, 23, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (5, 24, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (1, 25, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (1, 26, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (2, 27, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (2, 28, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (3, 29, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (3, 30, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (4, 31, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (4, 32, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (5, 33, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (5, 34, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (1, 35, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (1, 36, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (2, 37, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (2, 38, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (3, 39, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (3, 40, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (4, 41, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (4, 42, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (5, 43, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (5, 44, 1);
Insert Into AñoGrupo_Academico (ID_Añoacademico, ID_Grupo, Activo) 
Values (5, 45, 1);

Insert Into añoacademico (Año, Activo) Values ('Libre', 1)
-- ===================================================================================================
DELIMITER //
CREATE PROCEDURE `Prueba_DetEvento`(in idpersona bigint)
BEGIN
declare id_per int default idpersona;
declare id_tipou int default 1;

select  pro.Nombre as Nombre_Proyecto, cat.Nombre_Categoria, sub.Nombre_Subcategoria, eve.Nombre_Evento

from persona as p

inner join persona_usuario as pusu on pusu.ID_Persona =p.Id_Persona
inner join participante as par on par.ID_Persona_Usuario = pusu.ID_Persona_Usuario
inner join participante_proyecto as ppro on ppro.Id_Participante = par.Id_Numero_Carnet
inner join proyecto as pro on pro.Id_Proyecto = ppro.Id_Proyecto

inner join categoria_evento as cae on cae.ID_Categoria_Evento = pro.ID_Categoria_Evento
inner join categoria_subcategoria as casub on casub.ID_Categoria_SubCategoria=  cae.ID_Categoria_SubCategoria
inner join categoria as cat on cat.ID_Categoria = casub.ID_Categoria
inner join subcategoria as sub on sub.ID_SubCategoria = casub.ID_SubCategoria

inner join evento_proyecto as epro on epro.ID_Proyecto = pro.ID_Proyecto
inner join evento as eve on eve.ID_Evento = epro.ID_Evento

where p.ID_Persona = id_per and p.Activo = 1;

END;

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

-- NO SE USA DE MOMENTO, VERIFICAR SI UN PARTICIPANTE PUEDE ESTAR EN MÁS DE UN PROYECTO
DELIMITER //
Create Procedure Verificar_ExistenciaParticipanteProyectoEventoActual(
	IN id_evento bigint(20),
    IN id_participante varchar(10)
)
Begin

	Declare vlocIdEvento bigint(20);
    Declare vlocIdParticipante varchar(10);
    Declare vlocVerificacion varchar(50);
    
    Set vlocIdEvento = id_evento;
    Set vlocIdParticipante = id_participante;
	
    Set vlocVerificacion = (Select p.Nombre from Proyecto p
	Inner Join Evento_Proyecto ep on ep.ID_Proyecto = p.ID_Proyecto
	Inner Join Participante_Proyecto pp on pp.ID_Proyecto = p.ID_Proyecto
	Where ep.ID_Evento = vlocIdEvento And pp.ID_Participante = vlocIdParticipante);
    
    If vlocVerificacion is not null then
		Select vlocVerificacion;
	Else
		Select 0;
    End if;    
End;
-- ==========================================================================================

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
CREATE FUNCTION `Verificar_ExistenciaEventoEnProyecto`(vparIntIdEvento bigint, vparIntIdProyecto bigint) RETURNS int(11)
Begin
	Declare vlocIntVerificador Int;
    Declare vlocCharConsulta varchar(20);
    
    Set vlocIntVerificador = 1;
    Set vlocCharConsulta = (Select ID_Evento_Proyecto From Evento_Proyecto where ID_Evento = vparIntIdEvento and ID_Proyecto = vparIntIdProyecto And Activo = 1);
    
    if vlocCharConsulta is null then
		Set vlocIntVerificador = 0;
    end if;
    
    Return vlocIntVerificador;    
End;

DELIMITER //
Create Procedure Obtener_EventoActual()
Begin
	Select ID_Evento from evento Where Year(Fecha) = Year(CurDate());
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
Create Procedure Insercion_ConfirmacionParticipante(
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
CREATE PROCEDURE `Verificar_ExistenciaParticipanteEnProyecto`(
	IN id_participante varchar(20),
    IN id_proyecto bigint(20)    
)
Begin
	Declare vlocIdParticipante varchar(20);
    Declare vlocIdProyecto bigint(20);
    Declare vlocExistenciaParticipanteEnProyecto bigint(20);
    
    Set vlocIdParticipante = id_participante;
    Set vlocIdProyecto = id_proyecto;
    
    Set vlocExistenciaParticipanteEnProyecto = (select ID_Proyecto from participante_proyecto py where py.ID_Participante = vlocIdParticipante and py.ID_Proyecto = vlocIdProyecto);
    
    if vlocExistenciaParticipanteEnProyecto is not null Then
		Select 1;
	Else
		Select 0;
    End If;  
End;

DELIMITER //
CREATE FUNCTION `Verificar_CargoTutorEnPersonalAcademico`(vparIntIDPersonalAcademico BigInt) RETURNS int(11)
Begin
	Declare vlocIntVerificador Int;
	Declare vlocIntIdCargo Int;
    Declare vlocCharCargo varchar(20);
    
    Set vlocIntIdCargo = (Select ID_Cargo From Personal_Academico Where ID_Personal_Academico = vparIntIDPersonalAcademico And Activo = 1);
    Set vlocCharCargo = (Select Cargo From Cargo Where ID_Cargo = vlocIntIdCargo And Activo = 1);
    Set vlocIntVerificador = 0;
    
    if vlocIntIdCargo is not null then
		if vlocCharCargo = 'Tutor' then
			Set vlocIntVerificador = 1;
		End If;		
    End If;
    
    Return vlocIntVerificador;
End;

DELIMITER //
CREATE PROCEDURE Obtener_NombreApellidoDocentes()
Begin
	Select p.Primer_Nombre, p.Primer_Apellido from Personal_Academico pa 		
    Inner Join Persona_Usuario pu On pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
	Inner Join Persona p On pu.ID_Persona = p.ID_Persona
	Where pa.id_cargo = 7 And pa.Activo = 1 And pu.Activo = 1 And p.Activo = 1;
End

DELIMITER //
Create Procedure Eliminar_RegistroConfirmacionParticipante(
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
Create Procedure Eliminar_CodConfirmacionParticipanteTiempoExedido(
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
Create Procedure Verificar_RegistroConfirmacionParticipante(
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
Create Procedure Verificar_CodConfirmacionParticipante(
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

/*Nuevos Procedimientos para los inicios de los participantes e indexes*/
DELIMITER //
CREATE FUNCTION `Verificar_ExistenciaEventoFeriaSegunAño`(vparDateAño Year) RETURNS int(11)
Begin
	Declare vlocIntVerificador Integer;
    Declare vlocIntProyecto BigInt;
    
    Set vlocIntProyecto = (Select e.ID_Evento From Evento e Where Year(e.Fecha) = vparDateAño And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00') And e.Activo = 1);
    Set vlocIntVerificador = 0;
    
    If vlocIntProyecto Is Not Null Then
		Set vlocIntVerificador = 1;
    End IF;
    
    Return vlocIntVerificador;    
End;

DELIMITER //
CREATE PROCEDURE `Obtener_FechaEventoFeriaSegunAño`(IN vparDateAño Year)
Begin	
    Set @vlocEvento = (Select Verificar_ExistenciaEventoFeriaSegunAño(vparDateAño));
	
	If @vlocEvento = 1 Then
		Select e.Fecha, e.Hora From Evento e Where Year(e.Fecha) = vparDateAño And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00') And e.Activo = 1;
	Else
		Select 'No existe Evento Para Este Año';
	End If;
End;

DELIMITER //
CREATE PROCEDURE `Verificar_ExistenciaEventoFeriaSegunAño`(vparDateAño Year)
Begin
	Declare vlocIntVerificador Integer;
    Declare vlocIntProyecto BigInt;
    
    Set vlocIntProyecto = (Select e.ID_Evento From Evento e Where Year(e.Fecha) = vparDateAño And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00') And e.Activo = 1);
    Set vlocIntVerificador = 0;
    
    If vlocIntProyecto Is Not Null Then
		Set vlocIntVerificador = 1;
    End IF;        
    
    Return vlocIntVerificador;    
End;
