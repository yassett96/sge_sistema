DELIMITER //

CREATE DEFINER=`root`@`localhost` PROCEDURE `Verificar_IntegranteProyectoSegunParticipante`(
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
							Inner Join Categoria_SubCategoria csc On csc.ID_Categoria_SubCategoria = ce.ID_Categoria_Subcategoria
							Where (ce.ID_Añoacademico = vlocAñoAcademico And ce.ID_Evento = vlocIdEventoFeriaActual And csc.ID_Categoria = vlocIdCategoria And csc.ID_SubCategoria = vlocIdSubCategoria)
                            
                            UNION
                            
                            Select ID_Categoria_Evento From Categoria_Evento ce	
							Inner Join Categoria_SubCategoria csc On csc.ID_Categoria_SubCategoria = ce.ID_Categoria_Subcategoria
							Where (ce.ID_Añoacademico = 6 And ce.ID_Evento = vlocIdEventoFeriaActual And csc.ID_Categoria = vlocIdCategoria And csc.ID_SubCategoria = vlocIdSubCategoria)
                            );
                            
	If vlocVerificacion Is Not Null Then
		Set vlocVerificacion = 1;
        Select vlocVerificacion;
	Else
		Select vlocVerificacion;
    End If;    
End;