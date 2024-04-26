-- =====================================================================================================================
DELIMITER //
CREATE PROCEDURE `Prueba_DetEvento`(in idpersona bigint)
BEGIN
declare id_per int default idpersona;
declare id_tipou int default 1;

select  pro.Nombre as Nombre_Proyecto, cat.Nombre_Categoria, sc.Nombre_Subcategoria, eve.Nombre_Evento 
from Proyecto as pro
inner join participante_proyecto as parPro on parPro.ID_Proyecto = pro.ID_Proyecto
inner join participante as par on par.ID_Numero_Carnet = parPro.ID_Participante
inner join persona_usuario as perUsu on perUsu.ID_Persona_usuario = par.ID_Persona_Usuario
inner join Persona as per on per.ID_Persona = perUsu.ID_Persona
inner join evento_proyecto as ePro on ePro.ID_Proyecto = pro.ID_Proyecto
inner join evento as eve on eve.ID_Evento = ePro.ID_Evento
inner join SubCategoria as sc on sc.ID_subcategoria = pro.ID_Subcategoria
inner join Categoria_Subcategoria as csc on csc.Id_SubCategoria = sc.ID_SubCategoria
inner join Categoria as cat on cat.ID_Categoria = csc.ID_Categoria

Where per.ID_Persona = 15 And per.Activo = 1;

END;

-- =====================================================================================================================
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
    Inner Join SubCategoria sc On sc.ID_SubCategoria = csc.Id_SubCategoria
    Where (ce.ID_Evento = vlocIdEventoActual And sc.ID_Añoacademico = vlocIdAñoAcademico) Or sc.ID_Añoacademico = 6;        
End;

-- =====================================================================================================================
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
    Where (ce.ID_Evento = vlocIdEventoActual And sc.ID_Añoacademico = vlocIdAñoAcademico And csc.ID_Categoria = vlocIdCategoria)
    Union
    Select Distinct csc.ID_SubCategoria, sc.Nombre_SubCategoria From Categoria_Evento ce 
	Inner Join Categoria_SubCategoria csc on csc.ID_Categoria_SubCategoria = ce.ID_Categoria_Evento 
    Inner Join SubCategoria sc On sc.Id_SubCategoria = csc.Id_SubCategoria
    Where (ce.ID_Evento = vlocIdEventoActual And sc.ID_Añoacademico = 6 And csc.ID_Categoria = vlocIdCategoria);        
End;

-- =====================================================================================================================
delimiter //

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
    
    Set vlocIdGrupo = (Select ID_Grupo From Participante p Where p.CodigoRegistro = vlocCodigoRegistro);
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
End;

-- =====================================================================================================================
DELIMITER //
CREATE PROCEDURE `Insercion_Proyecto`(
	IN nombre varchar(50),
    IN descripcion varchar(1000),
    IN id_categoria_evento bigint,
    IN id_personal_academico bigint    
)
Begin
	Set @vlocIntCargoDocente = (Select Verificar_CargoTutorEnPersonalAcademico(id_personal_academico));
    
	if @vlocIntCargoDocente = 1 then
		insert into proyecto (Nombre, Descripcion, ID_SubCategoria, ID_Personal_Academico, Activo) values (nombre, descripcion, id_categoria_evento, id_personal_academico, 1);
	Else
		Select 'La persona que está ingresando no es tutor.';
    End If;    	
End;

-- =====================================================================================================================

select*from categoria_subcategoria;
select*from categoria;
select*from subcategoria;
select*from categoria_evento;
select*from subcategoria;
select*from proyecto;
select*from participante;
select*from participante_proyecto;
select*from persona_usuario;
select*from evento_proyecto;
select*from persona;
select*from evento;
select*from mensaje_confirmacion_participante;