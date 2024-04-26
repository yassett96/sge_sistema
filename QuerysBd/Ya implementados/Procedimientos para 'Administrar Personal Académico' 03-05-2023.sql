-- Procedimientos a agregar
-- ===============================
DELIMITER //
Create Procedure Obtener_ListaPersonalAcademico()
Begin
		Select pa.ID_Personal_Academico, p.Primer_Nombre, p.Segundo_Nombre, p.Primer_Apellido, p.Segundo_Apellido, ga.Grado_Academico, c.Cargo, s.Sede, p.Telefono, p.Correo_Electronico
			From personal_academico pa
				inner join persona_usuario pu on pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
				inner join grado_academico ga on ga.ID_Grado_Academico = pa.ID_Grado_Academico
				inner join cargo c on c.ID_Cargo = pa.ID_Cargo
				inner join persona p on p.ID_Persona = pu.ID_Persona
				inner join tipo_usuario tu on tu.ID_Tipo_Usuario = pu.ID_Tipo_Usuario
                inner join sede s on s.ID_Sede = pa.ID_Sede
					Where tu.ID_Tipo_Usuario = 3 And pa.Activo=1 And pu.Activo=1 And ga.Activo=1 And c.Activo=1 And p.activo=1 And tu.Activo=1
                    Order By pa.ID_Personal_Academico Asc;
End;
-- ===============================
DELIMITER //
Create Procedure Eliminar_PersonalAcademico(
IN id_personal_academico Bigint
)
Begin
	Declare vlocIdPersonalAcademico BigInt;
    Declare vlocIdPersonaUsuario BigInt;
    Declare vlocIdPersona BigInt;
    
    Set vlocIdPersonalAcademico = id_personal_academico;    
    
    Set vlocIdPersonaUsuario = (
		Select pu.ID_Persona_Usuario From personal_academico pa 
			inner join persona_usuario pu on pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
				Where pa.ID_Personal_Academico = vlocIdPersonalAcademico
    );
    
    Set vlocIdPersona = (
		Select p.ID_Persona From personal_academico pa 
			inner join persona_usuario pu on pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
            inner join persona p on p.Id_Persona = pu.ID_Persona
				Where pa.ID_Personal_Academico = vlocIdPersonalAcademico
    );
    
    Update personal_academico pa Set pa.Activo = 0 Where pa.ID_Personal_Academico = vlocIdPersonalAcademico;
    Update persona_usuario pu Set pu.Activo = 0 Where pu.ID_Persona_Usuario = vlocIdPersonaUsuario;
    Update credenciales cre Set cre.Activo = 0 Where cre.ID_Persona = vlocIdPersona;
    Update persona p Set p.Activo = 0 Where p.ID_Persona = vlocIdPersona;
    
    select 1 As Resultado_Eliminacion;    
End;
-- ===============================
DELIMITER //
Create Procedure Obtener_ListagradoAcademico()
Begin
	select ID_Grado_Academico, Grado_Academico from grado_academico;
End;
-- ===============================
DELIMITER //
Create Procedure Obtener_Cargos()
Begin
	Select c.ID_Cargo, c.Cargo From Cargo c;
End;
-- ===============================
DELIMITER //
Create Procedure Modificar_PersonaAcademica(in id_personal_academico bigint, in telefono char(16), in correo varchar(100),
 in id_grado_academico bigint, in id_cargo bigint, in id_sede bigint)
 Begin
	Declare idPersona bigint;
    
    Set idPersona = (
		Select p.ID_Persona From Personal_Academico pa
        Inner Join Persona_Usuario pu on pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
        Inner Join Persona p on p.ID_Persona = pu.ID_Persona
			Where pa.ID_Personal_Academico = id_personal_academico
        );
        
	Update Personal_Academico pa Set pa.ID_Grado_Academico = id_grado_academico, pa.ID_Cargo = id_cargo, pa.ID_Sede = id_sede 
		Where pa.ID_Personal_Academico = id_personal_academico;
        
	Update Persona p Set p.Telefono = telefono, p.Correo_Electronico = correo 
		Where p.ID_Persona = idPersona;        
        
	Select 1 As Resultado;
 End;
 -- ===============================
-- Procedimientos a modificar
-- ===============================
DELIMITER //
CREATE PROCEDURE `Insercion_PersonaAcademica`(in pnombre varchar(50),in snombre varchar(50), in papellido varchar(50), sapellido varchar(50),
 in telefono char(16), in correo varchar(100),in tipou bigint, in usuario varchar(20), 
 in contraseña varchar(200), in cedula char(20), in avatar varchar(45), in id_grado_academico bigint, in id_cargo bigint, in id_sede bigint)
BEGIN

declare p_pnombre varchar(50) default upper(trim(pnombre));
    declare p_snombre varchar(50) default upper(trim(snombre));
    declare p_papellido varchar(50) default upper(trim(papellido));
    declare p_sapellido varchar(50) default upper(trim(sapellido));
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
    ((SELECT MAX(ID_Persona) as last_id FROM persona),p_usuario,p_contra,1);
    
    insert into persona_usuario
    (ID_Tipo_Usuario,ID_Persona,Activo)
    values
    (p_tipo,(SELECT MAX(ID_Persona) as last_id FROM persona),1);
    
    insert into personal_academico
    (ID_Persona_Usuario,ID_Grado_Academico,ID_Cargo,ID_Sede,Activo)
    values
    ((SELECT MAX(ID_Persona_Usuario) as last_id FROM persona_usuario),id_grado_academico,id_cargo,id_sede,1);
END;
-- ===============================
-- Ya enviado por Whatssap
DELIMITER //
CREATE PROCEDURE `Obtener_DireccionLogoEsloganEventoActual`()
Begin

	Select e.Logo, e.Eslogan, e.Nombre_Evento From Evento e Where Year(e.Fecha) = Year(Now()) And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00' And Year(ee.Fecha) = year(now())) And e.Activo = 1;

End;