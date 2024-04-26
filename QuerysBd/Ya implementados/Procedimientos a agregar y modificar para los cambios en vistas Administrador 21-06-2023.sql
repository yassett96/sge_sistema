-- ============================================================================================================================================
-- Procedimientos a agregar
-- ============================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Listar_TipoU_AdminUsuarios`()
BEGIN
select concat ('<option value ="',tu.Id_Tipo_Usuario,'"','>',tu.Tipo_Usuario,'</option>')
    from tipo_usuario tu
    where  tu.Activo = 1
    order by ID_Tipo_Usuario;
END;
-- ============================================================================================================================================
DELIMITER //
Create Procedure Verificar_ExistenciaCedula(
	In cedula varchar(30)
)
Begin
	Declare vlocVerificador Varchar(30) Default '';
    
    Set vlocVerificador = (Select p.Cedula From Persona p Where p.cedula = cedula Limit 1);
    
    If vlocVerificador <> '' And vlocVerificador Is Not Null Then
		Select 1 As Resultado_Verificacion;	
	Else
		Select 0 As Resultado_Verificacion;
	End If;
End;

-- ============================================================================================================================================
-- A CONSTRUÍR EL PROCEDIMIENTO PARA AGREGADO DE TIPO DE USUARIO, DESPUÉS TERMINAR EL FORMULARIO DE NUEVO USUARIO Y VERIFICAR RESPONSIEVE.
-- ============================================================================================================================================
-- ============================================================================================================================================
-- Procedimientos a modificar
-- ============================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Agregar_UsuarioAPersona`(
	In id_persona bigint,
    In id_tipo_usuario bigint,
    In id_sede_participante bigint,
    In id_grupo_participante bigint,
    In id_carnet_participante varchar(20),
    In id_sede_personal_academico bigint,
    In id_grado_academico_personal_academico bigint,
    In id_rol_personal_academico bigint,
    In cargo_personal_academico varchar(50)
)
Begin
	Declare vlocVerificador BigInt Default 0;
	Declare vlocIdPersonaUsuarioParticipante Bigint;
	Declare vlocIdPersonaUsuarioPersonalAcademico Bigint;
    Declare vlocIdPersonalAcademico Bigint;
    Declare vlocUltimoCodigoRegistro bigint;

	If id_tipo_usuario = 3 Then
		Set vlocVerificador = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = id_persona And pu.id_tipo_usuario = 3 And pu.Activo = 0);
        
        If vlocVerificador > 0 Then
			Update Persona_Usuario pu Set pu.Activo = 1 Where pu.ID_Persona = id_persona And pu.id_tipo_usuario = 3 And pu.Activo = 0;
            
            Set vlocIdPersonaUsuarioPersonalAcademico = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = id_persona And pu.id_tipo_usuario = 3);
            
            Update Personal_Academico pa Set pa.ID_Grado_Academico = id_grado_academico_personal_academico, pa.ID_Sede = id_sede_personal_academico, pa.Cargo = cargo_personal_academico 
				Where pa.ID_Persona_Usuario = vlocIdPersonaUsuarioPersonalAcademico;
                
			Set vlocIdPersonalAcademico = (Select pa.Id_Personal_Academico From Personal_Academico pa Where pa.ID_Persona_Usuario = vlocIdPersonalAcademico);
                
            Update PersonalAcademico_Rol par Set par.ID_Rol = id_rol_personal_academico Where par.ID_Personal_Academico = vlocIdPersonalAcademico;
            
            Select 1 As Resultado_Agregado;
		Else
			Insert Into Persona_Usuario (ID_Tipo_Usuario, ID_Persona, Activo) Values (id_tipo_usuario, id_persona, 1);
        
			Set vlocIdPersonaUsuarioPersonalAcademico = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Tipo_Usuario = id_tipo_usuario And pu.ID_Persona = id_persona);
			
			Insert Into Personal_Academico (id_persona_usuario, ID_Grado_Academico, ID_Sede, Cargo, Tutor, Activo) Values (vlocIdPersonaUsuarioPersonalAcademico, id_grado_academico_personal_academico, id_sede_personal_academico, cargo_personal_academico, 0, 1);
			
			Set vlocIdPersonalAcademico = (Select pa.ID_Personal_Academico From Personal_Academico pa Order By pa.ID_Personal_Academico Desc Limit 1);
			
			Insert Into PersonalAcademico_Rol (ID_Personal_Academico, ID_Rol, Activo) Values (vlocIdPersonalAcademico, id_rol_personal_academico, 1);
			
			Select 1 As Resultado_Agregado;
        End If;	
		
        
		Else If id_tipo_usuario = 1 Then
			Set vlocVerificador = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = id_persona And pu.id_tipo_usuario = 1 And pu.Activo = 0);
            
            If vlocVerificador > 0 Then
				Update Persona_Usuario pu Set pu.Activo = 1 Where pu.ID_Persona = id_persona And pu.id_tipo_usuario = 1 And pu.Activo = 0;
            
				Set vlocIdPersonaUsuarioParticipante = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = id_persona And pu.id_tipo_usuario = 1);
                
                Update Participante p Set p.ID_Sede = id_sede_participante, p.ID_Grupo = id_grupo_participante Where p.ID_Persona_Usuario = vlocIdPersonaUsuarioParticipante;               
                
                Select 1 As Resultado_Agregado;
                
			Else
				Insert Into Persona_Usuario (ID_Tipo_Usuario, ID_Persona, Activo) Values (id_tipo_usuario, id_persona, 1);
            
				Set vlocIdPersonaUsuarioParticipante = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Tipo_Usuario = id_tipo_usuario And pu.ID_Persona = id_persona);
				
				Set vlocUltimoCodigoRegistro = (Select LPAD(p.CodigoRegistro + 1, 6, '0') As Codigo_Registro From Participante p Order By p.CodigoRegistro Desc Limit 1);
				
				Insert Into Participante (ID_Numero_Carnet, ID_Persona_Usuario, CodigoRegistro, ID_Sede, ID_Grupo, Activo) Values (id_carnet_participante, vlocIdPersonaUsuarioParticipante, vlocUltimoCodigoRegistro, id_sede_participante, id_grupo_participante, 1);
				
				Select 1 As Resultado_Agregado;                
            End If;
            
            Else 
            
				Insert Into Persona_Usuario (ID_Tipo_Usuario, ID_Persona, Activo) Values (id_tipo_usuario, id_persona, 1);
				
				Select 1 As Resultado_Agregado;            
		End If;
    End If;    
End;
-- ============================================================================================================================================
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
	);
End;
-- ============================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_ListaUsuarios`()
Begin
	SELECT pu.ID_Persona_Usuario, tu.ID_Tipo_Usuario, tu.Tipo_Usuario, p.Primer_Nombre, p.Segundo_Nombre, 
    p.Primer_Apellido, p.Segundo_Apellido, p.Telefono, p.Correo_Electronico, p.Cedula, 
    COALESCE(sp.Sede, '') as Sede_Participante, COALESCE(spa.Sede, '') as Sede_Personal_Academico, COALESCE(g.grupo, '') As Grupo, 
    COALESCE(ga.Grado_Academico, '')As Grado_Academico, COALESCE(c.Cargo, '') AS Cargo, COALESCE(par.ID_Numero_Carnet, '') AS ID_Numero_Carnet
		FROM persona_usuario pu
			INNER JOIN tipo_usuario tu ON tu.ID_Tipo_Usuario = pu.ID_Tipo_Usuario
			INNER JOIN persona p ON p.ID_Persona = pu.ID_Persona
			LEFT JOIN personal_academico pa ON pa.ID_Persona_Usuario = pu.ID_Persona_Usuario
			LEFT JOIN personalacademico_cargo pac ON pac.ID_Personal_Academico = pa.ID_Personal_Academico
			LEFT JOIN Cargo c ON c.ID_Cargo = pac.ID_Cargo
			LEFT JOIN Participante par ON par.ID_Persona_Usuario = pu.ID_Persona_Usuario
            LEFT JOIN Sede sp ON sp.ID_Sede = par.ID_Sede
            LEFT JOIN Grupo g ON g.ID_Grupo = par.ID_Grupo
            LEFT JOIN grado_academico ga ON ga.ID_Grado_Academico = pa.ID_Grado_Academico
            LEFT JOIN Sede spa ON spa.ID_Sede = pa.ID_Sede
				WHERE pu.Activo = 1 AND tu.Activo = 1 AND p.Activo = 1
					ORDER BY tu.ID_Tipo_Usuario ASC;    
End;
-- ============================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Eliminar_Usuario`(
	In ID_Persona_Usuario BigInt
)
Begin		
	Update Persona_Usuario pu Set pu.Activo = 0 Where pu.ID_Persona_Usuario = ID_Persona_Usuario;
    Select 1 As Resultado_Eliminacion;
End;
-- ============================================================================================================================================
DELIMITER //
Create Procedure Obtener_ListaGradoAcademico()
Begin
	Select*From Grado_Academico ga Where ga.Activo = 1;
End;
-- ============================================================================================================================================
-- Se debe de eliminar el procedimiento 'Modificar_TipoUsuario', está mal nombrado y se debe de crear el siguiente:
DELIMITER //
CREATE PROCEDURE `Modificar_Usuario`(
	In id_persona_usuario bigint,
    In id_tipo_usuario_a_modificar bigint,
    In id_tipo_usuario_participante bigint,
    In telefono_participante varchar (20),
    In correo_electronico_participante varchar (100),
    In id_sede_participante bigint,
    In id_grupo_participante bigint,
    In id_tipo_usuario_personal_academico bigint,
    In telefono_personal_academico varchar (20),
    In correo_electronico_personal_academico varchar(100),
    In id_sede_personal_academico bigint,
    In id_grado_academico_personal_academico bigint,
    In id_rol_personal_academico bigint,
    In cargo_personal_academico nvarchar(50),
    In rol_a_editar_personal_academico varchar(50),
    In id_tipo_usuario bigint,
    In telefono varchar(20),
    In correo_electronico varchar(100)
)
Begin
	Declare vlocIdPersona Bigint;
    Declare vlocIdPersonalAcademico Bigint;
    Declare vlocIdRolPersonalAcademico BigInt;
    
    Set vlocIdPersona = (Select pu.ID_Persona From Persona_Usuario pu Where pu.ID_Persona_Usuario = id_persona_usuario);

	If id_tipo_usuario_participante Is Not Null And id_tipo_usuario_participante != '' Then
		Update Persona p Set p.Telefono = telefono_participante, p.Correo_Electronico = correo_electronico_participante Where p.ID_Persona = vlocIdPersona;
        Update Participante p Set p.ID_Sede = id_sede_participante, p.ID_Grupo = id_grupo_participante Where p.ID_Persona_Usuario = id_persona_usuario;
        
        Select 1 As Resultado_Edicion;
        
		Else If id_tipo_usuario_personal_academico Is Not Null And id_tipo_usuario_personal_academico != '' Then
			Set vlocIdPersonalAcademico = (Select pa.ID_Personal_Academico From Personal_Academico pa Where pa.ID_Persona_Usuario = id_persona_usuario);
            Set vlocIdRolPersonalAcademico = (Select r.ID_Rol From Rol r Where r.Rol = rol_a_editar_personal_academico);
        
			Update Persona p Set p.Telefono = telefono_personal_academico, p.Correo_Electronico = correo_electronico_personal_academico Where p.ID_Persona = vlocIdPersona;
			Update Personal_Academico pa Set pa.ID_Sede = id_sede_personal_academico, 
					pa.ID_Grado_Academico = id_grado_academico_personal_academico,
                    pa.Cargo = cargo_personal_academico
                    Where pa.ID_Persona_Usuario = id_persona_usuario;
                    
			Update PersonalAcademico_Rol par Set par.ID_Rol = id_rol_personal_academico Where par.ID_Personal_Academico = vlocIdPersonalAcademico And par.ID_Rol = vlocIdRolPersonalAcademico;
			
			Select 1 As Resultado_Edicion;
            
            Else If id_tipo_usuario Is Not Null And id_tipo_usuario != '' Then
				Update Persona p Set p.Telefono = telefono, p.Correo_Electronico = correo_electronico Where p.ID_Persona = vlocIdPersona;
				
				Select 1 As Resultado_Edicion;
                Else
					Select 0 As Resultado_Edicion;
			End If;
		End If;
    End If;    
End;

-- ============================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_Roles`()
Begin
	Select r.ID_Rol, r.Rol From Rol r Where r.Activo = 1;
End;

-- ============================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_ListaUsuarios`()
Begin
	SELECT pu.ID_Persona_Usuario, tu.ID_Tipo_Usuario, tu.Tipo_Usuario, p.Primer_Nombre, p.Segundo_Nombre, 
    p.Primer_Apellido, p.Segundo_Apellido, p.Telefono, p.Correo_Electronico, p.Cedula, 
    COALESCE(sp.Sede, '') as Sede_Participante, COALESCE(spa.Sede, '') as Sede_Personal_Academico, COALESCE(g.grupo, '') As Grupo, 
    COALESCE(ga.Grado_Academico, '')As Grado_Academico, COALESCE(r.Rol, '') AS Rol, COALESCE(pa.Cargo) As Cargo ,COALESCE(par.ID_Numero_Carnet, '') AS ID_Numero_Carnet
		FROM persona_usuario pu
			INNER JOIN tipo_usuario tu ON tu.ID_Tipo_Usuario = pu.ID_Tipo_Usuario
			INNER JOIN persona p ON p.ID_Persona = pu.ID_Persona
			LEFT JOIN personal_academico pa ON pa.ID_Persona_Usuario = pu.ID_Persona_Usuario
			LEFT JOIN personalacademico_rol parol ON parol.ID_Personal_Academico = pa.ID_Personal_Academico
			LEFT JOIN Rol r ON r.ID_Rol = parol.ID_Rol
			LEFT JOIN Participante par ON par.ID_Persona_Usuario = pu.ID_Persona_Usuario
            LEFT JOIN Sede sp ON sp.ID_Sede = par.ID_Sede
            LEFT JOIN Grupo g ON g.ID_Grupo = par.ID_Grupo
            LEFT JOIN grado_academico ga ON ga.ID_Grado_Academico = pa.ID_Grado_Academico
            LEFT JOIN Sede spa ON spa.ID_Sede = pa.ID_Sede
				WHERE pu.Activo = 1 AND tu.Activo = 1 AND p.Activo = 1
					ORDER BY tu.ID_Tipo_Usuario ASC;    
End;
-- ============================================================================================================================================
-- Eliminar Obtener_Cargos(), ahora es Obtener_Roles()
Drop Procedure Obtener_cargos
DELIMITER //
CREATE PROCEDURE `Obtener_Roles`()
Begin
	Select r.ID_Rol, r.Rol From Rol r;
End;

-- ============================================================================================================================================

DELIMITER //
CREATE PROCEDURE `Insercion_NuevoUsuario`(
in pnombre varchar(50),in snombre varchar(50), in papellido varchar(50), sapellido varchar(50),
in telefono char(16), in correo varchar(100),in tipou bigint, in usuario varchar(20), 
in contraseña varchar(200), in cedula char(20), in avatar varchar(45), in noCarnet varchar(12),
in id_sede_participante bigint, in id_grupo_participante bigint, in id_grado_academico_personal_academico bigint,
in id_sede_personal_academico bigint, in cargo_personal_academico varchar(50), in id_rol_personal_academico bigint
)
Begin
    declare vlocIdPersonalAcademico bigint default 0;
    declare vlocIdUltimaPersonaRegistrada Bigint;
    declare vlocIdUltimaPersonaUsuarioRegistrada Bigint;
    declare vlocIdUltimoPersonalAcademicoRegistrado BigInt;
    declare vlocCodigoRegistroNuevo Bigint;
    
    Insert persona
    (Primer_Nombre, Segundo_Nombre, Primer_Apellido, Segundo_Apellido, Telefono, Correo_Electronico,Cedula,Avatar,Activo)
    values
    (pnombre,snombre,papellido,sapellido,telefono,correo,cedula,avatar,1);
    
    Set vlocIdUltimaPersonaRegistrada = (Select p.Id_Persona From Persona p Order By p.Id_Persona Desc Limit 1);
    
	Insert Into Credenciales 
    (ID_Persona, Usuario, Contraseña, Activo, Codigo, Fecha_Recuperacion) 
    Values 
    (vlocIdUltimaPersonaRegistrada, usuario, contraseña, 1, Null, Null);
    
    Insert into persona_usuario
    (ID_Tipo_Usuario, ID_Persona, Activo)
    Values
    (tipou, vlocIdUltimaPersonaRegistrada, 1);
    
    Set vlocIdUltimaPersonaUsuarioRegistrada = (Select pu.Id_Persona_Usuario From Persona_Usuario pu Order By pu.ID_Persona_Usuario Desc Limit 1);
    
    If tipou = 1 Then
		Set vlocCodigoRegistroNuevo = (Select LPAD(p.CodigoRegistro + 1, 6, '0') As Codigo_Registro From Participante p Order By p.CodigoRegistro Desc Limit 1);
		Insert Into Participante (ID_Numero_Carnet, ID_persona_Usuario, CodigoRegistro, ID_Sede, ID_Grupo, Activo) Values (noCarnet, vlocIdUltimapersonaUsuarioRegistrada, vlocCodigoRegistroNuevo, id_sede_participante, id_grupo_participante, 1);
        Select 1 As Resultado_Insercion;
    End If;   
    
    If tipou = 3 Then
		Insert Into Personal_Academico (ID_Persona_Usuario, ID_Grado_Academico, ID_Sede, Cargo, Tutor, Activo) Values (vlocIdUltimaPersonaUsuarioRegistrada, id_grado_academico_personal_academico, id_sede_personal_academico, cargo_personal_academico, 0, 1);
        Set vlocIdUltimoPersonalAcademicoRegistrado = (Select pa.ID_Personal_Academico From Personal_Academico pa Order By pa.ID_Personal_Academico Desc Limit 1);
        Insert Into PersonalAcademico_Rol (ID_Personal_Academico, ID_Rol, Activo) Values (vlocIdUltimoPersonalAcademicoRegistrado, id_rol_personal_academico, 1);
        Select 1 As Resultado_Insercion;
    End If;
    
    If tipou != 1 And tipou != 3 Then
		Select 1 As Resultado_Insercion;
    End If;	
    
End;