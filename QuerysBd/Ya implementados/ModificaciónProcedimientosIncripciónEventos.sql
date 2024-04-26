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
End

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
CREATE PROCEDURE `Obtener_SedeSegunIdSede`(
IN id_sede bigint(20)
)
Begin
	Declare vlocIdSede bigint(20);
    Declare vlocSede varchar(50);
    
    Set vlocIdSede = id_sede;
    Set vlocSede  = (Select s.Sede From Sede s Where s.ID_Sede = vlocIdSede);
    
    Select vlocSede;
End




DELIMITER //
CREATE PROCEDURE `Verificar_ExistenciaEventoFeriaSegunAño`(vparDateAño Year)
Begin
	Declare vlocIntVerificador Integer;
    Declare vlocIntProyecto BigInt;
    
    Set vlocIntProyecto = (Select e.ID_Evento From Evento e Where Year(e.Fecha) = vparDateAño And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00' And Year(ee.Fecha) = vparDateAño) And e.Activo = 1);
    Set vlocIntVerificador = 0;
    
    If vlocIntProyecto Is Not Null Then
		Set vlocIntVerificador = 1;
    End IF;        
    
    Select vlocIntVerificador;    
End;


DELIMITER //
CREATE PROCEDURE `Obtener_FechaEventoFeriaSegunAño`(IN vparDateAño Year)
Begin	
    Set @vlocEvento = (Select Verificar_ExistenciaEventoFeriaSegunAño(vparDateAño));
	
	If @vlocEvento = 1 Then
		Select e.Fecha, e.Hora From Evento e Where Year(e.Fecha) = vparDateAño And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00' And Year(ee.Fecha) = vparDateAño) And e.Activo = 1;
	Else
		Select 'No existe Evento Para Este Año';
	End If;
End;

DELIMITER //
CREATE FUNCTION `Verificar_ExistenciaEventoFeriaSegunAño`(vparDateAño Year) RETURNS int(11)
Begin
	Declare vlocIntVerificador Integer;
    Declare vlocIntProyecto BigInt;
    
    Set vlocIntProyecto = (Select e.ID_Evento From Evento e Where Year(e.Fecha) = vparDateAño And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00' And Year(e.Fecha) = vparDateAño) And e.Activo = 1);
    Set vlocIntVerificador = 0;
    
    If vlocIntProyecto Is Not Null Then
		Set vlocIntVerificador = 1;
    End IF;
    
    Return vlocIntVerificador;    
End;