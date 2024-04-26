-- ============================================================================================================================================================
-- Nuevo
DELIMITER //
Create Procedure Obtener_ListaUsuarios()
Begin
	Select pu.ID_Persona_Usuario, tu.Tipo_Usuario, p.Primer_Nombre, p.Segundo_Nombre, p.Primer_Apellido, p.Segundo_Apellido, p.Telefono, p.Correo_Electronico 
    From persona_usuario pu
    Inner Join tipo_usuario tu On tu.ID_Tipo_Usuario = pu.ID_Tipo_Usuario
    Inner Join persona p On p.ID_Persona = pu.ID_Persona
    Where pu.Activo = 1 And tu.Activo = 1 And p.Activo = 1
    Order By tu.ID_Tipo_Usuario asc;
    
End;

-- ============================================================================================================================================================
DELIMITER //
Create Procedure Eliminar_Usuario(
	In ID_Persona_Usuario BigInt
)
Begin
	
	Update Persona_Usuario pu Set pu.Activo = 0 Where pu.ID_Persona_Usuario = ID_Persona_Usuario;
    Select 1 As Resultado_Eliminacion;
End;

-- ============================================================================================================================================================
-- A Modificar
DELIMITER //
CREATE PROCEDURE `Listar_TipoU`()
BEGIN
	select concat ('<option value ="',tu.Id_Tipo_Usuario,'"','>',tu.Tipo_Usuario,'</option>')
    from tipo_usuario tu
    where  tu.Activo = 1 And tu.ID_Tipo_Usuario <> 3
    order by ID_Tipo_Usuario;
END;
-- ============================================================================================================================================================
-- Nuevo
Delimiter //
Create Procedure Modificar_TipoUsuario(
	In id_persona_usuario bigint,
    In id_tipo_usuario bigint,
    In telefono varchar (20),
    In correo_electronico varchar (100)
)
Begin
	Declare vlocIdPersona bigint;
    
    Set vlocIdPersona = (Select pu.ID_Persona From Persona_Usuario pu Where pu.ID_Persona_Usuario = id_tipo_usuario);
    
    Update Persona_Usuario pu Set pu.ID_Tipo_Usuario = id_tipo_usuario Where pu.ID_Persona_Usuario = id_persona_usuario;
    
    Update Persona p Set p.Telefono = telefono, p.Correo_Electronico = correo_electronico Where p.ID_Persona = vlocIdPersona;
    
    Select 1 As Resultado;
End;
 
-- ============================================================================================================================================================
-- Nuevo
DELIMITER //
Create Procedure Insercion_NuevoUsuario(
in pnombre varchar(50),in snombre varchar(50), in papellido varchar(50), sapellido varchar(50),
in telefono char(16), in correo varchar(100),in tipou bigint, in usuario varchar(20), 
in contraseña varchar(200), in cedula char(20), in avatar varchar(45)
)
Begin
	declare p_pnombre varchar(50) default (trim(pnombre));
    declare p_snombre varchar(50) default (trim(snombre));
    declare p_papellido varchar(50) default (trim(papellido));
    declare p_sapellido varchar(50) default (trim(sapellido));
    declare p_tel char(16) default telefono;
    declare p_correo varchar(100) default correo;
    declare p_tipo bigint default tipou;
    declare p_usuario varchar(20) default usuario;
    declare p_contra varchar(200) default contraseña;
    declare p_avatar varchar(45) default avatar;
    declare p_cedula char(20) default cedula;
	declare valor char(20) default NULL;
    
     if (cedula = '') then
	set p_cedula = valor;
    end if;
    
    Insert persona
    (Primer_Nombre, Segundo_Nombre, Primer_Apellido, Segundo_Apellido, Telefono, Correo_Electronico,Cedula,Avatar,Activo)
    values
    (p_pnombre,p_snombre,p_papellido,p_sapellido,p_tel,p_correo,p_cedula,p_avatar,1);
    
     insert into credenciales
    (Id_Persona,Usuario, Contraseña,Activo)
    values
    ((SELECT MAX(ID_Persona) as last_id FROM persona),p_usuario,p_contra,1);
    
    insert into persona_usuario
    (ID_Tipo_Usuario,ID_Persona,Activo)
    values
    (p_tipo,(SELECT MAX(ID_Persona) as last_id FROM persona),1);
    
    Select 1 As Resultado_Insercion;
End;
-- ============================================================================================================================================================
-- Nuevo
DELIMITER //
Create Procedure Obtener_IdPersonaSegunIDPersonaUsuario(
	In id_persona_usuario bigint
)
Begin
	Declare vlocIdPersona BigInt;
    
    Set vlocIdPersona = (
		Select Distinct p.Id_Persona 
			From Persona p
				Inner Join Persona_Usuario pu On pu.ID_Persona = p.ID_Persona
					Where pu.ID_Persona_Usuario = id_persona_usuario
    );
    
    If vlocIdPersona Is Null Then
		Select 0 As Id_Persona;
	Else
		Select vlocIdPersona As Id_Persona;
    End If;
End;
Call Obtener_IdPersonaSegunIDPersonaUsuario(10);
Drop procedure Obtener_IdPersonaSegunIDPersonaUsuario
-- ============================================================================================================================================================
-- Nuevo
DELIMITER //
Create Procedure Obtener_ListaUsuariosNoAsignadosAPersonaParaSelect(
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
	  AND p.ID_Persona = 10
	)
	AND tu.Id_Tipo_Usuario <> 3;
End;

select*from persona Where Id_Persona = 10;
select*from persona_usuario Where ID_Persona = 10;
select*from tipo_usuario;

Call Obtener_ListaUsuariosNoAsignadosAPersonaParaSelect(9)
Drop Procedure Obtener_ListaUsuariosNoAsignadosAPersonaParaSelect
-- ============================================================================================================================================================
-- Nuevo
DELIMITER //
Create Procedure Agregar_UsuarioAPersona (
	In id_persona bigint,
    In id_tipo_usuario bigint
)
Begin
	Declare vlocExistenciaPersonaTipoUsuarioDeshabilitado BigInt Default 0;
    
    Set vlocExistenciaPersonaTipoUsuarioDeshabilitado = (
		Select Distinct pu.ID_Persona_Usuario 
			From Persona_Usuario pu 
				Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = id_tipo_usuario And pu.Activo = 0
    );

	if vlocExistenciaPersonaTipoUsuarioDeshabilitado is null Or vlocExistenciaPersonaTipoUsuarioDeshabilitado = 0 Then
			insert into persona_usuario (ID_Tipo_Usuario, ID_Persona, Activo) values (id_tipo_usuario, id_persona, 1);
	else if vlocExistenciaPersonaTipoUsuarioDeshabilitado > 0 Then
			SET SQL_SAFE_UPDATES = 0;
			Update Persona_Usuario pu Set pu.Activo = 1 Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = id_tipo_usuario;
			SET SQL_SAFE_UPDATES = 1;
		End If;
    End If;
    
    select 1 as Resultado_Insercion;
End;
-- ============================================================================================================================================================