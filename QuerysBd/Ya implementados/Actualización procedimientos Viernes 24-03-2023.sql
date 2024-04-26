-- Procedimiento a actualizar
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
    Set vlocIdEventoActual = (Select ID_Evento FROM Evento e Where Year(e.Fecha) = year(curdate()) And e.ID_Tipo_Evento = 1 And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00' And Year(ee.Fecha) = Year(curdate())) And e.Activo = 1);
    
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