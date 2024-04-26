-- =======================================================================================================================================================
-- Tabla a crear
Create Table PersonalAcademico_Cargo (
	ID_PersonalAcademico_Cargo Bigint Auto_Increment,
    ID_Personal_Academico Bigint,
    ID_Cargo Bigint,
    Activo int,
    Primary Key (ID_PersonalAcademico_Cargo),
    Foreign Key (ID_Personal_Academico) References Personal_Academico(ID_Personal_Academico),
    Foreign Key (ID_Cargo) References Cargo(ID_Cargo);
-- =======================================================================================================================================================
-- Procedimientos a agregar
-- =======================================================================================================================================================
DELIMITER //
Create Procedure Verificar_ExistenciaNoCarnet(
	In no_carnet varchar(20)
)
Begin
	Declare vlocVerificador varchar(20);
    
    Set vlocVerificador = (Select par.ID_Numero_Carnet From Participante par Where par.ID_Numero_Carnet = no_carnet);
    
    If vlocVerificador Is Null Then
		Select 0 As Resultado_Verificacion;
	Else
		Select 1 As Resultado_Verificacion;    
    End If;
End;
-- =======================================================================================================================================================
DELIMITER //
Create Procedure Obtener_ListaEstudiantes()
Begin
Select par.ID_Numero_Carnet, p.Primer_Nombre, p.Segundo_Nombre, p.Primer_Apellido, p.Segundo_Apellido, p.Telefono, p.Correo_Electronico, p.Cedula, s.ID_Sede, s.Sede, g.grupo
		From participante par
			Inner Join persona_usuario pu on pu.ID_Persona_Usuario = par.ID_Persona_Usuario
			Inner Join Persona p on p.ID_Persona = pu.ID_Persona
			Inner Join tipo_usuario tu on tu.ID_Tipo_Usuario = pu.ID_Tipo_Usuario
            Inner Join Sede s on s.ID_Sede = par.ID_Sede
            Inner Join Grupo g on g.ID_Grupo = par.ID_Grupo
				Where pu.ID_Tipo_Usuario = 1 And par.Activo=1 And pu.Activo=1 And tu.Activo = 1;
End;
-- =======================================================================================================================================================
DELIMITER //
Create Procedure Modificar_Estudiante(
	In id_numero_carnet varchar(20),
	In telefono varchar(20),
    In correo_electronico varchar(100),
    In id_sede bigint,
    In id_grupo bigint
)
Begin
	Declare vlocIdPersona Bigint;
    Declare vlocIdPersonaUsuario Bigint;
    
    SET SQL_SAFE_UPDATES = 0;

	Update Participante par Set par.ID_Sede = id_sede, par.ID_Grupo = id_grupo Where par.ID_Numero_Carnet = id_numero_carnet;
    
    Set vlocIdPersonaUsuario = (Select par.ID_Persona_Usuario from Participante par Where par.ID_Numero_Carnet = id_numero_carnet);
    
    Set vlocIdPersona = (Select pu.ID_Persona from Persona_Usuario pu Where pu.ID_Persona_Usuario = vlocIdPersonaUsuario);
    
    Update Persona p Set p.Telefono = telefono, p.Correo_Electronico = correo_electronico;
    
    SET SQL_SAFE_UPDATES = 1;
    
    Select 1 As Resultado;
End;
-- =======================================================================================================================================================
DELIMITER //
Create Procedure Insercion_NuevoEstudiante(
	In numero_carnet varchar(20),
	In pnombre varchar(20),
    In snombre varchar(20),
    In papellido varchar(20),
    In sapellido varchar(20),
    In tel varchar(20),
    In cedula varchar(20),
    In correo varchar(100),
    In id_sede bigint,
    In id_grupo bigint,
    In idtipou bigint,
    In _user varchar(20),
    In passmod varchar(200),
    In target_path varchar(200)   
)
Begin

	Declare vlocUltimoCodigoRegistroParticipante int(6) zerofill;
    declare vlocCodigRegistroAIngresar int(6) zerofill;

	Insert Into Persona 
    (Primer_Nombre, Segundo_Nombre, Primer_Apellido, Segundo_Apellido, Telefono, Correo_Electronico, Cedula, Avatar, Activo)
    Values
    (pnombre, snombre, papellido, sapellido, tel, correo, cedula, target_path, 1);
    
    Insert Into Credenciales
    (ID_Persona, Usuario, Contraseña, Activo, Codigo, Fecha_Recuperacion)
    Values
    ((Select p.ID_Persona From Persona p Order By p.ID_Persona Desc Limit 1), _user, passmod, 1, Null, Null);
    
    Insert Into Persona_Usuario 
    (ID_Tipo_Usuario, ID_Persona, Activo) 
    Values 
    (1, (Select p.ID_Persona From Persona p Order By p.ID_Persona Desc Limit 1), 1);
    
    Set vlocUltimoCodigoRegistroParticipante = (Select par.CodigoRegistro From Participante par Order By par.CodigoRegistro Desc Limit 1);
    Set vlocCodigRegistroAIngresar = vlocUltimoCodigoRegistroParticipante + 1;
	
    Insert Into Participante 
    (ID_Numero_Carnet, ID_Persona_Usuario, CodigoRegistro, ID_Sede, ID_Grupo, Activo) 
    Values 
    (numero_carnet, (Select pu.ID_Persona_Usuario From Persona_Usuario pu Order By pu.ID_Persona Desc Limit 1), vlocCodigRegistroAIngresar, id_sede, id_grupo, 1);
    
    Select 1 As Resultado_Insercion;

End;
-- =======================================================================================================================================================
DELIMITER //
Create Procedure Eliminar_Estudiante(
	In id_numero_carnet varchar(20)
)
Begin
	Declare vlocPersonaUsuarioParticipante Bigint Default 0;

	Update Participante p Set p.Activo = 0 Where p.ID_Numero_Carnet = id_numero_carnet;
    
    Set vlocPersonaUsuarioParticipante = (select p.ID_Persona_Usuario From Participante p Where p.ID_Numero_Carnet = id_numero_carnet);
    
    Update Persona_Usuario pu Set pu.Activo = 0 Where pu.ID_Persona_Usuario = vlocPersonaUsuarioParticipante;
    
    Select 1 As Resultado_Eliminacion;
End;
-- =======================================================================================================================================================
DELIMITER //
Create Procedure Obtener_GruposSegunSede(
	In id_sede Bigint
)
Begin

	Select g.ID_Grupo, g.Grupo From sede_grupo sg
		Inner Join Grupo g on g.ID_Grupo = sg.ID_Grupo
			Where sg.Activo = 1 And sg.ID_Sede = id_sede;
    
End;

-- =======================================================================================================================================================
-- Procedimientos a modificar
-- =======================================================================================================================================================

DELIMITER //
CREATE PROCEDURE `Obtener_ListaPersonalAcademico`()
Begin
		Select pa.ID_Personal_Academico, p.Primer_Nombre, p.Segundo_Nombre, p.Primer_Apellido, p.Segundo_Apellido, ga.Grado_Academico, c.ID_Cargo, c.Cargo, s.Sede, p.Telefono, p.Correo_Electronico
			From personal_academico pa
				inner join persona_usuario pu on pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
				inner join grado_academico ga on ga.ID_Grado_Academico = pa.ID_Grado_Academico
                inner join PersonalAcademico_Cargo pac on pac.ID_Personal_Academico = pa.ID_Personal_Academico
				inner join cargo c on c.ID_Cargo = pac.ID_Cargo
				inner join persona p on p.ID_Persona = pu.ID_Persona
				inner join tipo_usuario tu on tu.ID_Tipo_Usuario = pu.ID_Tipo_Usuario
                inner join sede s on s.ID_Sede = pa.ID_Sede
					Where tu.ID_Tipo_Usuario = 3 And pa.Activo=1 And pu.Activo=1 And ga.Activo=1 And c.Activo=1 And p.activo=1 And tu.Activo=1
                    Order By pa.ID_Personal_Academico Asc;
End;

Call Obtener_ListaPersonalAcademico
-- =======================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_Sedes`(

)
Begin
	Select * From Sede s where s.Activo = 1 And s.ID_Sede Not In (6, 7, 8);
End;

Drop Procedure Obtener_Sedes;
select*from sede;
-- =======================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Modificar_PersonaAcademica`(in id_personal_academico bigint, in telefono char(16), in correo varchar(100),
 in id_grado_academico bigint, in id_cargo_a_modificar bigint, in id_cargo bigint, in id_sede bigint)
Begin
	Declare idPersona bigint;
    Declare idPersonaUsuarioVerificador bigint Default 0;
    Declare idPersonalAcademicoCargo bigint Default 0;
    
    Set idPersona = (
		Select p.ID_Persona From Personal_Academico pa
        Inner Join Persona_Usuario pu on pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
        Inner Join Persona p on p.ID_Persona = pu.ID_Persona
			Where pa.ID_Personal_Academico = id_personal_academico
        );
        
	If id_cargo = 4 Then
		Set idPersonaUsuarioVerificador = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = idPersona And pu.ID_Tipo_Usuario = 4);
        
        If idPersonaUsuarioVerificador is not Null Then
			Update Persona_Usuario pu Set pu.Activo = 1 
            Where pu.ID_Persona = idPersona And pu.ID_Persona_Usuario = idPersonaUsuarioVerificador;            
            
				Update Persona_Usuario pu Set pu.Activo = 0
				Where pu.ID_Persona = idPersona And pu.ID_Tipo_Usuario In (6);
            
		Else
			Insert Into Persona_Usuario (ID_Tipo_Usuario, ID_Persona, Activo) Values (4, idPersona, 1);
            
				Update Persona_Usuario pu Set pu.Activo = 0
				Where pu.ID_Persona = idPersona And pu.ID_Tipo_Usuario In (6);

        End If;
    
    Else If id_cargo = 10 Then
			Set idPersonaUsuarioVerificador = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = idPersona And pu.ID_Tipo_Usuario = 6);
			
			If idPersonaUsuarioVerificador is not Null Then
				Update Persona_Usuario pu Set pu.Activo = 1 
				Where pu.ID_Persona = idPersona And pu.ID_Persona_Usuario = idPersonaUsuarioVerificador;            
				
					Update Persona_Usuario pu Set pu.Activo = 0
					Where pu.ID_Persona = idPersona And pu.ID_Tipo_Usuario In (4);
				
			Else
				Insert Into Persona_Usuario (ID_Tipo_Usuario, ID_Persona, Activo) Values (6, idPersona, 1);
				
					Update Persona_Usuario pu Set pu.Activo = 0
					Where pu.ID_Persona = idPersona And pu.ID_Tipo_Usuario In (4);
				
			End If;
		Else 
				Update Persona_Usuario pu Set pu.Activo = 0
				Where pu.ID_Persona = idPersona And pu.ID_Tipo_Usuario In (4,6);
		End If;
    End if;
    
    
    Set idPersonalAcademicoCargo = (Select pac.ID_PersonalAcademico_Cargo From PersonalAcademico_Cargo pac 
								Where pac.ID_Personal_Academico = id_personal_academico And pac.ID_Cargo = id_cargo_a_modificar);
        
	Update Personal_Academico pa Set pa.ID_Grado_Academico = id_grado_academico, pa.ID_Sede = id_sede 
		Where pa.ID_Personal_Academico = id_personal_academico;
        
	Update PersonalAcademico_Cargo pac Set pac.ID_Cargo = id_cargo 
		Where pac.ID_PersonalAcademico_Cargo = idPersonalAcademicoCargo;
        
	Update Persona p Set p.Telefono = telefono, p.Correo_Electronico = correo 
		Where p.ID_Persona = idPersona;        
        
	Select 1 As Resultado;
 End;
-- =======================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Insercion_PersonaAcademica`(in pnombre varchar(50),in snombre varchar(50), in papellido varchar(50), sapellido varchar(50),
 in telefono char(16), in correo varchar(100),in tipou bigint, in usuario varchar(20), 
 in contraseña varchar(200), in cedula char(20), in avatar varchar(45), in id_grado_academico bigint,
 in id_cargo bigint, in id_sede bigint)
BEGIN

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
    declare id_grado_academico bigint default id_grado_academico;
    declare id_cargo bigint default id_cargo;    
    declare id_sede bigint default id_sede;
  
    
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
    ((SELECT ID_Persona as last_id FROM persona ORDER BY ID_Persona DESC LIMIT 1),p_usuario,p_contra,1);   
    
    If id_cargo = 4 Then
		insert into persona_usuario
		(ID_Tipo_Usuario,ID_Persona,Activo)
		values
		(4,(SELECT ID_Persona as last_id FROM persona ORDER BY ID_Persona DESC LIMIT 1),1);   
        
		insert into persona_usuario
		(ID_Tipo_Usuario,ID_Persona,Activo)
		values
		(p_tipo,(SELECT ID_Persona as last_id FROM persona ORDER BY ID_Persona DESC LIMIT 1),1);     
        
	Else If id_cargo = 10 Then    
			insert into persona_usuario
			(ID_Tipo_Usuario,ID_Persona,Activo)
			values
			(6,(SELECT ID_Persona as last_id FROM persona ORDER BY ID_Persona DESC LIMIT 1),1);             
            
			insert into persona_usuario
			(ID_Tipo_Usuario,ID_Persona,Activo)
			values
			(p_tipo,(SELECT ID_Persona as last_id FROM persona ORDER BY ID_Persona DESC LIMIT 1),1);
		
        Else
			insert into persona_usuario
			(ID_Tipo_Usuario,ID_Persona,Activo)
			values
			(p_tipo,(SELECT ID_Persona as last_id FROM persona ORDER BY ID_Persona DESC LIMIT 1),1);			
		End If;    
    End If ;    
    
    insert into personal_academico
    (ID_Persona_Usuario,ID_Grado_Academico,ID_Sede,Activo)
    values
    ((SELECT ID_Persona_Usuario as last_id FROM persona_usuario ORDER BY ID_Persona_Usuario DESC LIMIT 1), id_grado_academico, id_sede, 1);  
    
    insert into personalacademico_cargo 
    (ID_Personal_Academico, ID_Cargo, Activo)
    Values ((SELECT ID_Personal_Academico as last_id FROM personal_academico ORDER BY ID_Personal_Academico DESC LIMIT 1), id_cargo, 1);
    
    Select 1 As Resultado_Insercion;
    
END;
-- =======================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_ListaUsuarios`()
Begin
	Select pu.ID_Persona_Usuario, tu.ID_Tipo_Usuario, tu.Tipo_Usuario, p.Primer_Nombre, p.Segundo_Nombre, p.Primer_Apellido, p.Segundo_Apellido, p.Telefono, p.Correo_Electronico 
    From persona_usuario pu
    Inner Join tipo_usuario tu On tu.ID_Tipo_Usuario = pu.ID_Tipo_Usuario
    Inner Join persona p On p.ID_Persona = pu.ID_Persona
    Where pu.ID_Tipo_Usuario Not In (3, 1) And pu.Activo = 1 And tu.Activo = 1 And p.Activo = 1
    Order By tu.ID_Tipo_Usuario asc;
    
End;
-- =======================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Eliminar_Usuario`(
	In ID_Persona_Usuario BigInt
)
Begin
	
    Declare vlocIdTipoUsuario Bigint;
    Declare vlocIdPersona Bigint;
    Declare vlocIdPersonaUsuarioAcademico Bigint;
    Declare vlocIdPersonalAcademico Bigint;
    
    
    Set vlocIdTipoUsuario = (Select pu.ID_Tipo_usuario From Persona_Usuario pu Where pu.ID_Persona_Usuario = ID_Persona_Usuario);
    Set vlocIdPersona = (Select pu.ID_Persona From Persona_Usuario pu Where pu.ID_Persona_Usuario = ID_Persona_Usuario);    
    
    If vlocIdTipoUsuario = 4 Then
		Set vlocIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = vlocIdPersona And pu.ID_Tipo_Usuario = 3);
		Set vlocIdPersonalAcademico = (Select pa.ID_Personal_Academico From personal_academico pa Where pa.ID_Persona_Usuario = vlocIdPersonaUsuarioAcademico);
        
        Update personalacademico_cargo Set Activo = 0 Where ID_Personal_Academico = vlocIdPersonalAcademico And ID_Cargo = 4;
    End If;

	If vlocIdTipoUsuario = 6 Then
		Set vlocIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = vlocIdPersona And pu.ID_Tipo_Usuario = 3);
		Set vlocIdPersonalAcademico = (Select pa.ID_Personal_Academico From personal_academico pa Where pa.ID_Persona_Usuario = vlocIdPersonaUsuarioAcademico);
        
        Update personalacademico_cargo Set Activo = 0 Where ID_Personal_Academico = vlocIdPersonalAcademico And ID_Cargo = 10;
    End If;		
	
	Update Persona_Usuario pu Set pu.Activo = 0 Where pu.ID_Persona_Usuario = ID_Persona_Usuario;
    Select 1 As Resultado_Eliminacion;
End;
-- =======================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Listar_TipoU`()
BEGIN
select concat ('<option value ="',tu.Id_Tipo_Usuario,'"','>',tu.Tipo_Usuario,'</option>')
    from tipo_usuario tu
    where  tu.Activo = 1 And tu.ID_Tipo_Usuario Not In (3, 1)
    order by ID_Tipo_Usuario;
END;
-- =======================================================================================================================================================

-- Agregar el registro de 'PENDIENTE' en las tablas de 'Grado_Academico' y 'Sede'.
-- Debido a que cuando se registra un nuevo usuario, cuando se agrega con tipo de usuario 'Administrador' o 'Coordinador General' se debe de agregar un registro en la tabla
-- 'Personal_Academico' para poder ponerle el cargo de 'Admin' o 'Coordinador de área'.

-- No hay forma de saber que cargo se debe de
-- editar, además, para editar un usuario basta con agregar un usuario a la persona y eliminar el tipo de usuario que no se quiere.

-- Ejemplo de error al intentar editar el tipo de usuario en 'Editar Usuario':
-- Si se intenta editar un 
-- usuario de tipo de usuario 'Jurado' a tipo de usuario 'Administrador'
-- Habiendo ya agregado el tipo de usuario 'Administrador' a la persona en 'Agregar Usuario', habría 
-- redundancia del mismo tipo de usuario con la misma persona

-- Se hizo el proc 'Modificar_Tipousuario' para modificar los datos de la persona, pero el tipo de usuario No.

DELIMITER //
CREATE PROCEDURE `Modificar_TipoUsuario`(
	In id_persona_usuario bigint,
    In id_tipo_usuario_a_modificar bigint,
    In id_tipo_usuario bigint,
    In telefono varchar (20),
    In correo_electronico varchar (100)
)
Begin
	Declare vlocIdPersona bigint;
    Declare vlocIdPersonaUsuarioAcademico bigint;
    Declare vlocIdPersonalAcademico bigint;
    Declare vlocVerifIdPersonaUsuarioAcademico bigint;
    
    Set vlocIdPersona = (Select pu.ID_Persona From Persona_Usuario pu Where pu.ID_Persona_Usuario = id_persona_usuario);
    
    Update Persona p Set p.Telefono = telefono, p.Correo_Electronico = correo_electronico Where p.ID_Persona = vlocIdPersona;
    
    Select 1 As Resultado;
End;
-- =======================================================================================================================================================
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
	)
	AND tu.Id_Tipo_Usuario Not In (3, 1);
End;
-- =======================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Agregar_UsuarioAPersona`(
	In id_persona bigint,
    In id_tipo_usuario bigint
)
Begin
	Declare vlocExistenciaPersonaTipoUsuarioDeshabilitado BigInt Default 0;
    Declare vlocVerifIdPersonaUsuarioAcademico BigInt Default 0;
    Declare vlocIdPersonaUsuarioAcademico BigInt Default 0;
    Declare vlocIdPersonalAcademico BigInt Default 0;
    Declare personalacademico_cargo_Verificador BigInt Default 0;
    
    -- Set vlocIdPersona = (Select pu.ID_Persona From Persona_Usuario pu Where pu.ID_Persona_Usuario = id_persona_usuario);
    
    Set vlocExistenciaPersonaTipoUsuarioDeshabilitado = (
		Select Distinct pu.ID_Persona_Usuario 
			From Persona_Usuario pu 
				Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = id_tipo_usuario And pu.Activo = 0
    );

	if vlocExistenciaPersonaTipoUsuarioDeshabilitado is null Or vlocExistenciaPersonaTipoUsuarioDeshabilitado = 0 Then
    
		If id_tipo_usuario = 6 Then
        
			Set vlocVerifIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From persona_usuario pu Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = 3);
            Insert Into persona_usuario (ID_Tipo_Usuario, ID_Persona, Activo) Values (id_tipo_usuario, id_persona, 1);
                    
			If vlocVerifIdPersonaUsuarioAcademico Is Null Then 
            
				Insert Into Persona_Usuario (ID_Persona, ID_Tipo_Usuario, Activo) Values (id_persona, 3, 1);
				
				Set vlocIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = 3);
				
				Insert Into personal_academico (ID_Persona_Usuario, ID_Grado_academico, ID_Sede, Activo) Values (vlocIdPersonaUsuarioAcademico, 5, 8, 1);                        
				
				Set vlocIdPersonalAcademico = (Select pa.ID_Personal_Academico From personal_academico pa Where pa.ID_Persona_Usuario = vlocIdPersonaUsuarioAcademico);
				
				Insert Into personalacademico_cargo (ID_Personal_Academico, ID_Cargo, Activo) Values (vlocIdPersonalAcademico, 10, 1);
				
			Else
				
				Set vlocIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = 3);
				
				Set vlocIdPersonalAcademico = (Select pa.ID_Personal_Academico From personal_academico pa Where pa.ID_Persona_Usuario = vlocIdPersonaUsuarioAcademico);
				
                Insert Into personalacademico_cargo (ID_Personal_Academico, ID_Cargo, Activo) Values (vlocIdPersonalAcademico, 10, 1);
                
			End If;
        Else If id_tipo_usuario = 4 Then
			Set vlocVerifIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From persona_usuario pu Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = 3);
            Insert Into persona_usuario (ID_Tipo_Usuario, ID_Persona, Activo) Values (id_tipo_usuario, id_persona, 1);
                    
			If vlocVerifIdPersonaUsuarioAcademico Is Null Then 
            
				Insert Into Persona_Usuario (ID_Persona, ID_Tipo_Usuario, Activo) Values (id_persona, 3, 1);
				
				Set vlocIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = 3);
				
				Insert Into personal_academico (ID_Persona_Usuario, ID_Grado_academico, ID_Sede, Activo) Values (vlocIdPersonaUsuarioAcademico, 5, 8, 1);                        
				
				Set vlocIdPersonalAcademico = (Select pa.ID_Personal_Academico From personal_academico pa Where pa.ID_Persona_Usuario = vlocIdPersonaUsuarioAcademico);
				
				Insert Into personalacademico_cargo (ID_Personal_Academico, ID_Cargo, Activo) Values (vlocIdPersonalAcademico, 4, 1);
				
			Else
				
				Set vlocIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = 3);
				
				Set vlocIdPersonalAcademico = (Select pa.ID_Personal_Academico From personal_academico pa Where pa.ID_Persona_Usuario = vlocIdPersonaUsuarioAcademico);
				
                Insert Into personalacademico_cargo (ID_Personal_Academico, ID_Cargo, Activo) Values (vlocIdPersonalAcademico, 4, 1);
			End If;
            Else				 
                Insert Into persona_usuario (ID_Tipo_Usuario, ID_Persona, Activo) Values (id_tipo_usuario, id_persona, 1);
        End If;
        End If;
            
		else if vlocExistenciaPersonaTipoUsuarioDeshabilitado > 0 Then
		
			If id_tipo_usuario = 6 Then
        
				Set vlocVerifIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From persona_usuario pu Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = 3);
				-- Insert Into persona_usuario (ID_Tipo_Usuario, ID_Persona, Activo) Values (id_tipo_usuario, id_persona, 1);
				Update persona_usuario pu Set pu.Activo = 1 Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = id_tipo_usuario And pu.Activo = 0;
                    
			If vlocVerifIdPersonaUsuarioAcademico Is Null Then 
            
				Insert Into Persona_Usuario (ID_Persona, ID_Tipo_Usuario, Activo) Values (id_persona, 3, 1);
				
				Set vlocIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = 3);
				
				Insert Into personal_academico (ID_Persona_Usuario, ID_Grado_academico, ID_Sede, Activo) Values (vlocIdPersonaUsuarioAcademico, 5, 8, 1);                        
				
				Set vlocIdPersonalAcademico = (Select pa.ID_Personal_Academico From personal_academico pa Where pa.ID_Persona_Usuario = vlocIdPersonaUsuarioAcademico);
				
				Insert Into personalacademico_cargo (ID_Personal_Academico, ID_Cargo, Activo) Values (vlocIdPersonalAcademico, 10, 1);
				
			Else
				
				Set vlocIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = 3);
				
				Set vlocIdPersonalAcademico = (Select pa.ID_Personal_Academico From personal_academico pa Where pa.ID_Persona_Usuario = vlocIdPersonaUsuarioAcademico);
                
                Set personalacademico_cargo_Verificador = (Select pac.ID_PersonalAcademico_Cargo From PersonalAcademico_Cargo pac 
															Where pac.ID_Personal_Academico = vlocIdPersonalAcademico And pac.ID_Cargo = 10);
				
                If personalacademico_cargo_Verificador Is Null Then
					Insert Into personalacademico_cargo (ID_Personal_Academico, ID_Cargo, Activo) Values (vlocIdPersonalAcademico, 10, 1);
                    
				Else
                
					Update personalacademico_cargo Set Activo = 1 Where ID_Personal_Academico = vlocIdPersonalAcademico And ID_Cargo = 10;
                End If;
				
                
                
			End If;
        Else If id_tipo_usuario = 4 Then
			Set vlocVerifIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From persona_usuario pu Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = 3);
            -- Insert Into persona_usuario (ID_Tipo_Usuario, ID_Persona, Activo) Values (id_tipo_usuario, id_persona, 1);
            Update persona_usuario pu Set pu.Activo = 1 Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = id_tipo_usuario And pu.Activo = 0;
                    
			If vlocVerifIdPersonaUsuarioAcademico Is Null Then 
            
				Insert Into Persona_Usuario (ID_Persona, ID_Tipo_Usuario, Activo) Values (id_persona, 3, 1);
				
				Set vlocIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = 3);
				
				Insert Into personal_academico (ID_Persona_Usuario, ID_Grado_academico, ID_Sede, Activo) Values (vlocIdPersonaUsuarioAcademico, 5, 8, 1);                        
				
				Set vlocIdPersonalAcademico = (Select pa.ID_Personal_Academico From personal_academico pa Where pa.ID_Persona_Usuario = vlocIdPersonaUsuarioAcademico);
				
				Insert Into personalacademico_cargo (ID_Personal_Academico, ID_Cargo, Activo) Values (vlocIdPersonalAcademico, 4, 1);
				
			Else
				
                Set vlocIdPersonaUsuarioAcademico = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = 3);
				
				Set vlocIdPersonalAcademico = (Select pa.ID_Personal_Academico From personal_academico pa Where pa.ID_Persona_Usuario = vlocIdPersonaUsuarioAcademico);
                
                Set personalacademico_cargo_Verificador = (Select pac.ID_PersonalAcademico_Cargo From PersonalAcademico_Cargo pac 
															Where pac.ID_Personal_Academico = vlocIdPersonalAcademico And pac.ID_Cargo = 10);
				
                If personalacademico_cargo_Verificador Is Null Then
					Insert Into personalacademico_cargo (ID_Personal_Academico, ID_Cargo, Activo) Values (vlocIdPersonalAcademico, 4, 1);
                    
				Else
                
					Update personalacademico_cargo Set Activo = 1 Where ID_Personal_Academico = vlocIdPersonalAcademico And ID_Cargo = 4;
                End If;                
			End If;
            Else				 
                Update persona_usuario pu Set pu.Activo = 1 Where pu.ID_Persona = id_persona And pu.ID_Tipo_Usuario = id_tipo_usuario And pu.Activo = 0;
        End If;
        End If;            
				
		End If;
    End If;
    
    select 1 as Resultado_Insercion;
End;
-- =======================================================================================================================================================

DELIMITER //
CREATE PROCEDURE `Insercion_NuevoUsuario`(
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
    
    declare vlocIdPersonalAcademico bigint default 0;
    
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
    ((SELECT ID_Persona as last_id FROM persona Order By ID_Persona Desc Limit 1),p_usuario,p_contra,1);
    
    insert into persona_usuario
    (ID_Tipo_Usuario,ID_Persona,Activo)
    values
    (p_tipo,(SELECT ID_Persona as last_id FROM persona Order By ID_Persona Desc Limit 1),1);
    
    If p_tipo = 4 Then
    
		insert into persona_usuario
		(ID_Tipo_Usuario,ID_Persona,Activo)
		values
		(3,(SELECT ID_Persona as last_id FROM persona Order By ID_Persona Desc Limit 1),1);
        
        insert into personal_academico
        (ID_Persona_Usuario, ID_Grado_Academico, ID_Sede, Activo)
        values
        ((SELECT ID_Persona_Usuario as last_id FROM persona_usuario Order By ID_Persona Desc Limit 1), 5, 8, 1);
        
        insert into personalacademico_cargo 
        (ID_Personal_Academico, ID_Cargo, Activo)
        values
        ((SELECT ID_Personal_Academico as last_id FROM personal_academico Order By ID_Personal_Academico Desc Limit 1), 4, 1);
    
    End if;
    
    If p_tipo = 6 Then
    
		insert into persona_usuario
		(ID_Tipo_Usuario,ID_Persona,Activo)
		values
		(3,(SELECT ID_Persona as last_id FROM persona Order By ID_Persona Desc Limit 1),1);
        
        insert into personal_academico
        (ID_Persona_Usuario, ID_Grado_Academico, ID_Sede, Activo)
        values
        ((SELECT ID_Persona_Usuario as last_id FROM persona_usuario Order By ID_Persona Desc Limit 1), 5, 8, 1);
        
        insert into personalacademico_cargo 
        (ID_Personal_Academico, ID_Cargo, Activo)
        values
        ((SELECT ID_Personal_Academico as last_id FROM personal_academico Order By ID_Personal_Academico Desc Limit 1), 10, 1);
    
    End if;
    
    Select 1 As Resultado_Insercion;
End;
-- =======================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_ListaInvitados`()
Begin
	Select pa.ID_Personal_Academico, p.Primer_Nombre, p.Segundo_Nombre, p.Primer_Apellido, p.Segundo_Apellido, p.Telefono, p.Correo_Electronico, p.Cedula, ga.Grado_Academico, s.Sede
		From personal_academico pa
			Inner Join persona_usuario pu on pa.ID_Persona_Usuario = pu.ID_Persona_Usuario
			Inner Join Persona p on p.ID_Persona = pu.ID_Persona
			Inner Join PersonalAcademico_Cargo pac on pac.ID_Personal_Academico = pa.ID_Personal_Academico
            Inner Join Cargo c on c.ID_Cargo = pac.ID_Cargo
			Inner Join tipo_usuario tu on tu.ID_Tipo_Usuario = pu.ID_Tipo_Usuario
			Inner Join grado_academico ga on ga.ID_Grado_Academico = pa.ID_Grado_Academico
            Inner Join Sede s on s.ID_Sede = pa.ID_Sede
				Where pu.ID_Tipo_Usuario = 3 And pac.ID_Cargo = 9 And pa.Activo=1 And pu.Activo=1 And pac.Activo=1 And c.Activo = 1 And tu.Activo = 1;
End;
-- =======================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Insercion_NuevoInvitado`(
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
    Declare vlocIdUltimaPersonaAcademica BigInt;

	Insert Into Persona (Primer_Nombre, Segundo_Nombre, Primer_Apellido, Segundo_Apellido, Telefono, Correo_Electronico, Cedula, Avatar, Activo)
    Values (pnombre, snombre, papellido, sapellido, tel, correo, cedula, target_path, 1);
    
    Set vlocIdUltimaPersona = (Select p.ID_Persona From Persona p Order By p.ID_Persona Desc Limit 1);
    
    Insert Into Persona_Usuario (ID_Tipo_Usuario, ID_Persona, Activo) 
    Values (idTipoU, vlocIdUltimaPersona, 1);
    
	Insert Into Credenciales (ID_Persona, Usuario, Contraseña, Activo, Codigo)
    Values (vlocIdUltimaPersona, _user, passmod, 1, Null);
    
    Set vlocIdUltimaPersonaUsuario = (Select pu.ID_Persona_Usuario From Persona_Usuario pu Order By pu.ID_Persona_Usuario Desc Limit 1);
    
    Insert Into Personal_Academico (ID_Persona_Usuario, ID_Grado_Academico, ID_Sede, Activo)
    Values (vlocIdUltimaPersonaUsuario, idGrado_academico, idSede, 1);
    
    Set vlocIdUltimaPersonaAcademica = (Select pa.ID_Personal_Academico From Personal_Academico pa Order By pa.ID_Personal_Academico Desc Limit 1);
    
    Insert Into PersonalAcademico_Cargo (ID_Personal_Academico, ID_Cargo, Activo) Values (vlocIdUltimaPersonaAcademica, 9, 1);
    
    Select 1 As Resultado_Insercion;

End;
-- =======================================================================================================================================================
-- Para vista 'Inscripción Evento Feria'
DELIMITER //
CREATE PROCEDURE `Obtener_Tutores`()
Begin
	Select pa.ID_Personal_Academico, p.Primer_Nombre, p.Primer_Apellido 
    from Personal_Academico pa 		
    Inner Join Persona_Usuario pu On pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
	Inner Join Persona p On pu.ID_Persona = p.ID_Persona
    Inner Join personalacademico_cargo pac on pac.ID_Personal_Academico = pa.ID_Personal_Academico
    Inner Join cargo c on c.ID_Cargo = pac.ID_Cargo
	Where pac.id_cargo = 7 And pa.Activo = 1 And pu.Activo = 1 And p.Activo = 1;
End;
-- =======================================================================================================================================================
DELIMITER //
CREATE FUNCTION `Verificar_CargoTutorEnPersonalAcademico`(vparIntIDPersonalAcademico BigInt) RETURNS int(11)
Begin
	Declare vlocIntVerificador Int;
	Declare vlocIntIdCargo Int;
    
    Set vlocIntIdCargo = (Select ID_Cargo 
							From Personal_Academico pa
								Inner Join PersonalAcademico_Cargo pac on pac.ID_Personal_Academico = pa.ID_Personal_Academico
									Where pa.ID_Personal_Academico = vparIntIDPersonalAcademico And pac.ID_Cargo = 7 And pa.Activo = 1);
    Set vlocIntVerificador = 0;
    
    if vlocIntIdCargo is not null then
		if vlocIntIdCargo = 7 then
			Set vlocIntVerificador = 1;
		End If;		
    End If;
    
    Return vlocIntVerificador;
End;
-- =======================================================================================================================================================