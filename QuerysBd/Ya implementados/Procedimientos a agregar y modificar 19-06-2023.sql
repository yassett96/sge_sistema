-- ============================================================================================================================================
-- Procedimientos a agregar
-- ============================================================================================================================================
DELIMITER //
CREATE FUNCTION `Verificar_CargoDocenteEnPersonalAcademico`(vparIntIDPersonalAcademico BigInt) RETURNS int(11)
Begin
	Declare vlocIntVerificador Int;
	Declare vlocIntIdCargo Int;
    
    Set vlocIntIdCargo = (Select ID_Cargo 
							From Personal_Academico pa
								Inner Join PersonalAcademico_Cargo pac on pac.ID_Personal_Academico = pa.ID_Personal_Academico
									Where pa.ID_Personal_Academico = vparIntIDPersonalAcademico And pac.ID_Cargo = 6 And pa.Activo = 1);
    Set vlocIntVerificador = 0;
    
    if vlocIntIdCargo is not null then
		if vlocIntIdCargo = 6 then
			Set vlocIntVerificador = 1;
		End If;		
    End If;
    
    Return vlocIntVerificador;
End;
Drop function Verificar_CargoDocenteEnPersonalAcademico
-- ============================================================================================================================================
-- Procedimientos a modificar
-- ============================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_Tutores`()
Begin
	Select pa.ID_Personal_Academico, p.Primer_Nombre, p.Primer_Apellido 
    from Personal_Academico pa 		
    Inner Join Persona_Usuario pu On pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
	Inner Join Persona p On pu.ID_Persona = p.ID_Persona
    Inner Join personalacademico_cargo pac on pac.ID_Personal_Academico = pa.ID_Personal_Academico
    Inner Join cargo c on c.ID_Cargo = pac.ID_Cargo
	Where pac.id_cargo = 6 And pa.Activo = 1 And pu.Activo = 1 And p.Activo = 1;
End;
-- ============================================================================================================================================
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
	Set @vlocIntCargoDocente = (Select Verificar_CargoDocenteEnPersonalAcademico(id_personal_academico));
    
	if @vlocIntCargoDocente = 1 then
		insert into proyecto (Nombre, Descripcion, ID_SubCategoria, ID_Personal_Academico, Requerimiento, Activo) values (nombre, descripcion, id_categoria_evento, id_personal_academico, requerimiento, 1);
        
        Set vlocVerificadorTutor = (Select pac.ID_PersonalAcademico_Cargo From personalacademico_cargo pac Where pac.ID_Personal_Academico = id_personal_academico And pac.ID_Cargo = 7);
        
        If vlocVerificadorTutor Is Not Null then
			Update personalacademico_cargo pac Set pac.Activo = 1
            Where pac.ID_Personal_Academico = id_personal_academico And pac.ID_Cargo = 7;		
		Else
			Insert Into PersonalAcademico_Cargo (ID_Personal_Academico, ID_Cargo, Activo) Values (id_personal_academico, 7, 1);
        End If;  
	Else
		Select 'La persona que está ingresando no es tutor.';
    End If;    	
End;

-- ============================================================================================================================================
Call Obtener_Grupos();
select*from grado_academico