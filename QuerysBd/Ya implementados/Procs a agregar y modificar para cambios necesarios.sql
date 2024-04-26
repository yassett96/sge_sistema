-- ===============================================================================================================================================================================
-- Tablas a modificar
-- ===============================================================================================================================================================================
CREATE TABLE `personal_academico` (
  `ID_Personal_Academico` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_Persona_Usuario` bigint(20) NOT NULL,
  `ID_Grado_Academico` bigint(20) NOT NULL,
  `ID_Sede` bigint(20) NOT NULL,
  `Cargo` varchar(50) DEFAULT NULL,
  `Tutor` smallint(6) DEFAULT NULL,
  `Activo` int(11) NOT NULL,
  PRIMARY KEY (`ID_Personal_Academico`),
  KEY `ID_Persona_Usuario` (`ID_Persona_Usuario`),
  KEY `ID_Grado_Academico` (`ID_Grado_Academico`),
  KEY `ID_Sede` (`ID_Sede`),
  CONSTRAINT `personal_academico_ibfk_1` FOREIGN KEY (`ID_Persona_Usuario`) REFERENCES `persona_usuario` (`ID_Persona_Usuario`),
  CONSTRAINT `personal_academico_ibfk_2` FOREIGN KEY (`ID_Grado_Academico`) REFERENCES `grado_academico` (`ID_Grado_Academico`),
  CONSTRAINT `personal_academico_ibfk_4` FOREIGN KEY (`ID_Sede`) REFERENCES `sede` (`ID_Sede`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;
-- ===============================================================================================================================================================================
CREATE TABLE `personalacademico_rol` (
  `ID_PersonalAcademico_Rol` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_Personal_Academico` bigint(20) DEFAULT NULL,
  `ID_Rol` bigint(20) DEFAULT NULL,
  `Activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_PersonalAcademico_Rol`),
  KEY `ID_Personal_Academico` (`ID_Personal_Academico`),
  KEY `personalacademico_cargo_ibfk_2` (`ID_Rol`),
  CONSTRAINT `personalacademico_rol_ibfk_1` FOREIGN KEY (`ID_Personal_Academico`) REFERENCES `personal_academico` (`ID_Personal_Academico`),
  CONSTRAINT `personalacademico_rol_ibfk_2` FOREIGN KEY (`ID_Rol`) REFERENCES `rol` (`ID_Rol`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
-- ===============================================================================================================================================================================
-- Procedimientos a agregar
-- ===============================================================================================================================================================================
DELIMITER //
Create Procedure Confirmar_Participacion (
	In id_proyecto Bigint,
    In id_participante varchar(50)
)
Begin
	Update Participante_Proyecto pp Set pp.Confirmacion = 1 Where pp.ID_Proyecto = id_proyecto And pp.ID_Participante = id_participante;
    Update Proyecto p Set p.Activo = 2 Where p.ID_Proyecto = id_proyecto;
    
    Select 1 As Resultado_Confirmacion;
End;
-- ===============================================================================================================================================================================
DELIMITER //
Create Procedure Abandonar_ProyectoSiEsNecesario(
	In id_proyecto Bigint
)
Begin
	Declare vlocParticipantesActivos Bigint;

	Set vlocParticipantesActivos = (Select Count(*) from participante_proyecto pp Where pp.ID_Proyecto = id_proyecto And pp.Activo = 0);
    
    If vlocParticipantesActivos = 0 Or vlocParticipantesActivos Is Null Then
		Update proyecto p Set p.Activo = 3 Where p.ID_Proyecto = id_proyecto;
        Select 1 As Resultado_Abandono;
	Else
		Select 0 As Resultado_Abandono;
    End If;    
End;
-- ===============================================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Buscar_TelefonoRepetido`(in tel char(16), id_persona bigint)
BEGIN
	Declare ptel char(16) default tel;
    
    Select count(p.Telefono) as coincidencia from persona p where p.Telefono = ptel and p.ID_Persona != id_persona and Activo = 1; 

END;
-- ===============================================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Buscar_CorreoRepetido`(in correo varchar(100), id_persona bigint)
BEGIN
    
    Select count(p.Correo_Electronico) as coincidencia from persona p where p.Correo_Electronico = correo and p.ID_Persona != id_persona and Activo = 1; 

END;
select*from persona;
-- ===============================================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Buscar_CedulaRepetida`(in cedula varchar(100), id_persona bigint)
BEGIN
    
    Select count(p.Cedula) as coincidencia from persona p where p.Cedula = cedula and p.ID_Persona != id_persona and Activo = 1; 

END;

-- ===============================================================================================================================================================================
-- Procedimientos a modificar
-- ===============================================================================================================================================================================

DELIMITER //
CREATE PROCEDURE `Obtener_Tutores`()
Begin
	Select pa.ID_Personal_Academico, p.Primer_Nombre, p.Primer_Apellido 
    from Personal_Academico pa 		
    Inner Join Persona_Usuario pu On pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
	Inner Join Persona p On pu.ID_Persona = p.ID_Persona
    Inner Join personalacademico_rol par on par.ID_Personal_Academico = pa.ID_Personal_Academico
    Inner Join rol r on r.ID_Rol = par.ID_Rol
	Where par.id_rol = 3 And pa.Activo = 1 And pu.Activo = 1 And p.Activo = 1;
End;

-- ===============================================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Insercion_Proyecto`(
	IN nombre varchar(50),
    IN descripcion varchar(1000),
    IN id_categoria_evento bigint,
    IN id_personal_academico bigint,
    IN requerimiento varchar(1000)
)
Begin
	Declare vlocVerificadorTutor Bigint;
	Set @vlocIntRolDocente = (Select Verificar_RolDocenteEnPersonalAcademico(id_personal_academico));
    
	if @vlocIntRolDocente = 1 then
		insert into proyecto (Nombre, Descripcion, ID_SubCategoria, ID_Personal_Academico, Requerimiento, Activo) values (nombre, descripcion, id_categoria_evento, id_personal_academico, requerimiento, 1);
        
		Update personal_academico pa Set pa.Tutor = 1
			Where pa.ID_Personal_Academico = id_personal_academico;		
        
        Select 1 As Resultado_Insercion;
	Else
		Select 'La persona que está ingresando no es tutor.';
    End If;    	
End;
-- ===============================================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Insercion_ParticipanteProyecto`(
	IN id_participante varchar(20),
    IN id_proyecto BigInt    
)
Begin
	
    set @vlocExistencia = (Select Verificar_ExistenciaParticipanteEnProyecto(id_participante, id_proyecto));
    
    If @vlocExistencia = 0 then
			Insert Into Participante_Proyecto(ID_Participante, ID_Proyecto, Confirmacion, Activo) values (id_participante, id_proyecto, 1, 1);
	Else
		Select 'El participante ya se encuentra inscrito en este proyecto';
    End If;	
	
End;

-- ===============================================================================================================================================================================
-- Eliminar: Drop procedure Verificar_CargoDocenteEnPersonalAcademico, Se creará con otro nombre 'Rol' en vez de 'cargo'
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
		if vlocIntIdRol = 6 then
			Set vlocIntVerificador = 1;
		End If;		
    End If;
    
    Return vlocIntVerificador;
End;
-- ===============================================================================================================================================================================

DELIMITER //
CREATE PROCEDURE `Confirmar_Participacion`(
	In id_proyecto Bigint,
    In id_participante_1 varchar(50),
    In id_participante_2 varchar(50),
    In id_participante_3 varchar(50)
)
Begin
	Update Participante_Proyecto pp Set pp.Confirmacion = 1 Where pp.ID_Proyecto = id_proyecto And pp.ID_Participante = id_participante_1;
    
    If id_participante_2 != '' And id_participante_2 Is Not Null Then
		Update Participante_Proyecto pp Set pp.Confirmacion = 1 Where pp.ID_Proyecto = id_proyecto And pp.ID_Participante = id_participante_2;
    End If;
    
    If id_participante_3 != '' And id_participante_3 Is Not Null Then
		Update Participante_Proyecto pp Set pp.Confirmacion = 1 Where pp.ID_Proyecto = id_proyecto And pp.ID_Participante = id_participante_3;
    End If;
    
    Update Proyecto p Set p.Activo = 2 Where p.ID_Proyecto = id_proyecto;
    
    Select 1 As Resultado_Confirmacion;
End;

-- ===============================================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Cargar_Acceso_Participante`(in idpersona bigint)
BEGIN

declare id_per int default idpersona;
declare id_tipou int default 1;

select p.ID_Persona, p.Primer_Nombre, p.Segundo_Nombre, p.Primer_Apellido, p.Segundo_Apellido,p.Telefono,p.Correo_Electronico, 
p.Avatar,par.CodigoRegistro, pu.ID_Tipo_Usuario, g.grupo, par.ID_Grupo,  par.ID_Sede, p.Cedula,
c.Contraseña, par.ID_Numero_Carnet, s.Sede, par.ID_Numero_Carnet from persona as p

inner join persona_usuario as pu on pu.ID_Persona = p.ID_Persona
inner join participante as par on par.ID_Persona_Usuario = pu.ID_Persona_Usuario
inner join grupo as parg on parg.ID_Grupo = par.ID_Grupo
inner join credenciales as c on c.ID_Persona = p.ID_Persona
inner join grupo as g on g.ID_Grupo = par.ID_Grupo
inner join sede as s on s.Id_Sede = par.Id_Sede
where p.ID_Persona = id_per and pu.ID_Tipo_Usuario = id_tipou and pu.Activo=1 and p.Activo = 1;
END;
-- ===============================================================================================================================================================================
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
						Where p.CodigoRegistro = vlocCodigoRegistroParticipante And pp.Activo = 1 And pr.Activo In (1, 2) And ep.Activo = 1
        );
        
	If (vlocVerificador > 0) Then
		Select vlocVerificador As No_Proyectos;
	Else		
		select 0 As No_Proyectos;
    End If;	
    
End
-- ===============================================================================================================================================================================

DELIMITER //
CREATE PROCEDURE `Actualizar_Datos_Participante`(in id bigint, in telefono char(16),
	in correo varchar(100), in idg bigint, in cedula varchar(50))
BEGIN
	
    
declare idp bigint default id;
    
declare p_telefono char(16) default telefono;
    
declare p_correo varchar(100) default correo;
    
declare pidg bigint default idg;
    
    
    

update persona as p inner join persona_usuario as pu on p.ID_Persona = pu.ID_Persona 
    
inner join participante as pa on pa.ID_Persona_Usuario = pu.ID_Persona_Usuario
   set p.Telefono = p_telefono, p.Correo_Electronico = p_correo, pa.ID_Grupo = pidg, p.Cedula = cedula
 where p.ID_Persona = idp and p.Activo = 1;
    

END;
-- ===============================================================================================================================================================================