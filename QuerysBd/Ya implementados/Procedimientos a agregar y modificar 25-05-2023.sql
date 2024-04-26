-- =====================================================================================================
-- Cambios en tablas
-- =====================================================================================================
	ALTER TABLE Proyecto ADD Requerimiento Varchar(1000) AFTER ID_Personal_Academico;
-- =====================================================================================================
-- Procedimientos a agregar
-- =====================================================================================================
DELIMITER //
Create Procedure Eliminar_IntegranteDeProyecto(
	In id_participante varchar(10),
    In id_proyecto bigint
)
Begin
	Update Participante_Proyecto pp Set pp.Activo = 0 Where pp.ID_Participante = id_participante And pp.ID_Proyecto = id_proyecto;
    Select 1 As Resultado_Eliminacion;
End;
-- =====================================================================================================
-- Procedimientos a modificar
-- =====================================================================================================
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
		select vlocVerificador;
    End If;	
    
End;
Drop procedure Obtener_ProyectosInscritosSegunCodigoRegistroParticipante
-- =====================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_DatosIntegrantesSegunIdProyecto`(
	In Id_Proyecto bigint(20)
)
Begin	
    Declare vlocIdProyecto Bigint(20);	
        
    Set vlocIdProyecto = Id_Proyecto;        
        
		Select per.Primer_Nombre, per.Segundo_Nombre, per.Primer_Apellido, per.Segundo_Apellido, per.Cedula, par.ID_Numero_Carnet, g.grupo, s.Sede
			from Proyecto p
				inner join Participante_Proyecto pp On pp.Id_Proyecto = p.ID_Proyecto
				inner join Participante par on par.ID_Numero_Carnet = pp.Id_Participante
				inner join Persona_Usuario pu on pu.Id_Persona_Usuario = par.Id_Persona_Usuario
				inner join Persona per on per.Id_Persona = pu.Id_Persona
                inner join Grupo g on g.ID_Grupo = par.ID_Grupo
                inner join Sede s on s.ID_Sede = par.ID_Sede
					Where p.Id_Proyecto = vlocIdProyecto And pp.Activo = 1;		
End;
-- =====================================================================================================
delimiter $$
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
    
    Set vlocIdGrupo = (Select ID_Grupo From Participante p Where p.CodigoRegistro = vlocCodigoRegistro And p.Activo = 1);
                                            
    Set vlocAñoAcademico = (Select ID_Añoacademico From añogrupo_academico Where ID_Grupo = vlocIdGrupo);    
    Set vlocIdEventoFeriaActual = (Select e.ID_Evento From Evento e Where Year(e.Fecha) = year(curdate()) And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00' And Year(ee.Fecha) = year(curdate())) And e.Activo = 1);
    
    Set vlocVerificacion = (Select ID_Categoria_Evento From Categoria_Evento ce	
							Inner Join Categoria as cat on cat.ID_Categoria = ce.ID_Categoria
							Inner Join Categoria_SubCategoria csc On csc.ID_Categoria = cat.ID_Categoria
                            Inner Join Subcategoria sc On sc.ID_Subcategoria = csc.ID_Subcategoria
							Where (sc.ID_Añoacademico = vlocAñoAcademico And ce.ID_Evento = vlocIdEventoFeriaActual And csc.ID_Categoria = vlocIdCategoria And csc.ID_SubCategoria = vlocIdSubCategoria)
                            
                            UNION
                            
                            Select ID_Categoria_Evento From Categoria_Evento ce	
                            Inner Join Categoria as cat on cat.ID_Categoria = ce.ID_Categoria
							Inner Join Categoria_SubCategoria csc On csc.ID_Categoria = cat.ID_Categoria
                            Inner Join Subcategoria sc On sc.ID_Subcategoria = csc.ID_Subcategoria
							Where (sc.ID_Añoacademico = 6 And ce.ID_Evento = vlocIdEventoFeriaActual And csc.ID_Categoria = vlocIdCategoria And csc.ID_SubCategoria = vlocIdSubCategoria) Limit 1
                            );
                            
	If vlocVerificacion Is Not Null Then
		Set vlocVerificacion = 1;
        Select vlocVerificacion;
	Else
		Select vlocVerificacion;
    End If;    
End$$
-- ===================================================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Insercion_Proyecto`(
	IN nombre varchar(50),
    IN descripcion varchar(1000),
    IN id_categoria_evento bigint,
    IN id_personal_academico bigint,
    IN requerimiento varchar(1000)
)
Begin
	Set @vlocIntCargoDocente = (Select Verificar_CargoTutorEnPersonalAcademico(id_personal_academico));
    
	if @vlocIntCargoDocente = 1 then
		insert into proyecto (Nombre, Descripcion, ID_SubCategoria, ID_Personal_Academico, Requerimiento, Activo) values (nombre, descripcion, id_categoria_evento, id_personal_academico, requerimiento, 1);
	Else
		Select 'La persona que está ingresando no es tutor.';
    End If;    	
End;
-- ===================================================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Mostrar_Historial_Participante`(in idp bigint)
BEGIN	

declare p_id bigint default idp;   
    
select te.Nombre_Eventos, e.Nombre_Evento, e.Eslogan, pro.Nombre, sc.Nombre_SubCategoria, e.Fecha, s.Nombre_Sitio, ep.CalificacionFinal    
	from persona as per 
		inner join persona_usuario as pu on per.ID_Persona = pu.ID_Persona    
		inner join participante as p on p.ID_Persona_Usuario = pu.ID_Persona_Usuario    
		inner join participante_proyecto as pp on pp.ID_Participante = p.ID_Numero_Carnet
        inner join proyecto as pro on pro.ID_Proyecto = pp.ID_Proyecto
        inner join subcategoria as sc on sc.ID_SubCategoria = pro.ID_SubCategoria
		inner join evento_proyecto as ep on ep.ID_Proyecto = pp.ID_Proyecto    
		inner join evento as e on e.ID_Evento = ep.ID_Evento    
		inner join tipo_eventos as te on te.ID_Tipo_Evento = e.ID_Tipo_Evento    
		inner join sitio as s on s.ID_Sitio = e.ID_Sitio    
			where per.ID_Persona = p_id and per.Activo = 1 and e.Activo	= 0; 

END;
-- ===================================================================================================================================================================================