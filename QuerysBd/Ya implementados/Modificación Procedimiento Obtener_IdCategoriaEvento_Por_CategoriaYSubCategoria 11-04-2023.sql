-- Modificaciones
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `Obtener_IdCategoriaEvento_Por_CategoriaYSubCategoria`(
	IN ID_Categoria bigint (20),
	IN ID_Sub_Categoria bigint (20)
)
Begin
	Declare vlocIdCategoria bigint(20);
    Declare vlocIdSubCategoria bigint(20);
    Declare vlocIdCategoriaSubCategoria bigint(20);
    Declare vlocIdEvento bigint(20);
    Declare vlocIdCategoriaEvento bigint(20);
    
    Set vlocIdCategoria = ID_Categoria;
    Set vlocIdSubCategoria = ID_Sub_Categoria;
    
    Set vlocIdCategoriaSubCategoria = (Select ID_Categoria_SubCategoria From Categoria_Subcategoria cs Where cs.ID_Categoria = vlocIdCategoria And cs.ID_SubCategoria = vlocIdSubCategoria);
    
    Set vlocIdEvento = (Select e.ID_Evento From Evento e Where Year(e.Fecha) = year(curdate()) And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00' And Year(ee.Fecha) = year(curdate())) And e.Activo = 1);						
    
    Set vlocIdCategoriaEvento = (Select ID_Categoria_Evento From Categoria_Evento ce Where ce.ID_Categoria_SubCategoria = vlocIdCategoriaSubCategoria And ce.ID_Evento = vlocIdEvento);
    
    Select vlocIdCategoriaEvento;    
End