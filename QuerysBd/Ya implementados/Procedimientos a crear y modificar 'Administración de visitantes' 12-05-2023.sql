-- Procedimientos a crear
-- =====================================================================================================================================================================
DELIMITER //
Create Procedure Obtener_ListaInvitados()
Begin
	Select pa.ID_Personal_Academico, p.Primer_Nombre, p.Segundo_Nombre, p.Primer_Apellido, p.Segundo_Apellido, p.Telefono, p.Correo_Electronico, p.Cedula, ga.Grado_Academico, s.Sede
		From personal_academico pa
			Inner Join persona_usuario pu on pa.ID_Persona_Usuario = pu.ID_Persona_Usuario
			Inner Join Persona p on p.ID_Persona = pu.ID_Persona
			Inner Join cargo c on c.ID_Cargo = pa.ID_Cargo
			Inner Join tipo_usuario tu on tu.ID_Tipo_Usuario = pu.ID_Tipo_Usuario
			Inner Join grado_academico ga on ga.ID_Grado_Academico = pa.ID_Grado_Academico
            Inner Join Sede s on s.ID_Sede = pa.ID_Sede
				Where pu.ID_Tipo_Usuario = 3 And pa.ID_Cargo = 9 And pa.Activo=1 And pu.Activo=1 And c.Activo=1 And tu.Activo=1;
End;             
-- =====================================================================================================================================================================
DELIMITER //
Create Procedure Eliminar_Invitado(
	In id_personal_academico bigint
)
Begin
	Declare vlocIdPersonaUsuario bigint;
    
    Set vlocIdPersonaUsuario = (Select pa.ID_Persona_Usuario From Personal_Academico pa Where pa.ID_Personal_Academico = id_personal_academico);
    
    Update personal_academico pa Set pa.Activo = 0 Where pa.ID_Personal_Academico = ID_Personal_Academico;
    
    Update persona_usuario pu Set pu.Activo = 0 Where pu.ID_Persona_Usuario = vlocIdPersonaUsuario;
    
    Select 1 As Resultado_Eliminacion;
End;
-- =====================================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_SedesInvitados`()
Begin
	Select * From Sede s where s.Activo = 1 And s.ID_Sede In (6, 7);
End;

-- =====================================================================================================================================================================
DELIMITER //
Create Procedure Modificar_Invitado(
	In id_personal_academico bigint,
    In telefono varchar(20),
    In correo_electronico varchar(100),
    In id_grado_academico bigint,
    In id_sede bigint
)
Begin
	Declare vlocIdPersona BigInt;
    
    Set vlocIdPersona = (Select p.ID_Persona 
							From Personal_Academico pa
								Inner Join Persona_Usuario pu on pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
								Inner Join Persona p on p.ID_Persona = pu.ID_Persona
									Where pa.ID_Personal_Academico = id_personal_academico);	
	
    SET SQL_SAFE_UPDATES = 0;
    
    Update Personal_Academico pa Set pa.ID_Grado_Academico = id_grado_academico, pa.ID_Sede = id_sede Where pa.ID_Personal_Academico = id_personal_academico;
    
    Update Persona p Set p.Telefono = telefono, p.Correo_Electronico = correo_electronico Where p.ID_Persona = vlocIdPersona;
    
    SET SQL_SAFE_UPDATES = 1;
    
    Select 1 As Resultado;

End;

-- =====================================================================================================================================================================

DELIMITER //
Create Procedure Insercion_NuevoInvitado(
	in pnombre varchar(20),
    in snombre varchar(20),
    in papellido varchar(20),
    in sapellido varchar(20),
    in tel varchar(10),
    in cedula varchar(20),
    in correo varchar(200),
    in idGrado_academico bigint,
    in idTipoU bigint,
    in idCargo bigint,
    in idSede bigint,
    in _user varchar(20),
    in passmod varchar(200),
    in target_path varchar(200)    
)
Begin
	Declare vlocIdUltimaPersona BigInt;
    Declare vlocIdUltimaPersonaUsuario BigInt;

	Insert Into Persona (Primer_Nombre, Segundo_Nombre, Primer_Apellido, Segundo_Apellido, Telefono, Correo_Electronico, Cedula, Avatar, Activo)
    Values (pnombre, snombre, papellido, sapellido, tel, correo, cedula, target_path, 1);
    
    Set vlocIdUltimaPersona = (Select p.ID_Persona From Persona p Order By p.ID_Persona Desc Limit 1);
    
    Insert Into Persona_Usuario (ID_Tipo_Usuario, ID_Persona, Activo) 
    Values (idTipoU, vlocIdUltimaPersona, 1);
    
	Insert Into Credenciales (ID_Persona, Usuario, Contraseña, Activo, Codigo)
    Values (vlocIdUltimaPersona, _user, passmod, 1, Null);
    
    Set vlocIdUltimaPersonaUsuario = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Order By pu.ID_Persona_Usuario Desc Limit 1);
    
    Insert Into Personal_Academico (ID_Persona_Usuario, ID_Grado_Academico, ID_Cargo, ID_Sede, Activo)
    Values (vlocIdUltimaPersonaUsuario, idGrado_academico, idCargo, idSede, 1);
    
    Select 1 As Resultado_Insercion;

End;
-- =====================================================================================================================================================================
-- Procedimientos a modificar
-- =====================================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_Sedes`(

)
Begin
	Select * From Sede s where s.Activo = 1 And s.ID_Sede Not In (6, 7);
End;
-- =====================================================================================================================================================================