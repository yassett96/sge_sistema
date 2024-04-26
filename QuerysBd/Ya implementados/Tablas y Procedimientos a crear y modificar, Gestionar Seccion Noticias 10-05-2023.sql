-- Tabla a Crear
-- ================================================================================================================================================
Create Table Noticias(
	ID_Noticias BigInt Primary Key Auto_Increment,
    Descripcion nVarchar(1000),
    Imagen varchar(255)
);
-- ================================================================================================================================================
-- Procedimientos a crear
-- ================================================================================================================================================
DELIMITER //
Create Procedure Obtener_InformacionNoticias ()
Begin
	Select n.Descripcion, n.Imagen From Noticias n;
End;
call obtener_informacionnoticias
-- ================================================================================================================================================
DELIMITER //
Create Procedure Modificar_Noticia(
	in id_noticia bigint,
    in descripcion nvarchar(200),
    in imagen nvarchar(200)
)
Begin
	SET SQL_SAFE_UPDATES = 0;
    Update noticias n Set n.Descripcion = descripcion Where n.ID_Noticias = id_noticia;
    Update noticias n Set n.Imagen = imagen Where n.ID_Noticias = id_noticia;    
    SET SQL_SAFE_UPDATES = 1;
    Select 1 as Resultado_Modificacion;
    
End;
-- ================================================================================================================================================