-- ==============================================================================================================================================
-- Procedimientos a modificar
DELIMITER //
CREATE PROCEDURE `Obtener_InformacionNoticias`()
Begin
	Select n.Descripcion, n.Imagen From Noticias n Where ID_Noticias In (1, 2, 3);
End;
-- ==============================================================================================================================================
-- Procedimientos a crear
-- ==============================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_InformacionImagenesCarruselInicio`()
Begin
	Select n.Descripcion, n.Imagen From Noticias n Where ID_Noticias In (4, 5, 6);
End;
-- ==============================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_InformacionImagenesCarruselEvento`()
Begin
	Select n.Descripcion, n.Imagen From Noticias n Where ID_Noticias In (7, 8, 9);
End;
-- ==============================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Modificar_ImagenCarrusel`(
	in id_imagen bigint,
    in descripcion nvarchar(200),
    in imagen nvarchar(200)
)
Begin
	SET SQL_SAFE_UPDATES = 0;
    Update noticias n Set n.Descripcion = descripcion Where n.ID_Noticias = id_imagen;
    Update noticias n Set n.Imagen = imagen Where n.ID_Noticias = id_imagen;    
    SET SQL_SAFE_UPDATES = 1;
    Select 1 as Resultado_Modificacion;
    
End;

-- ==============================================================================================================================================

-- Es necesario ingresar las 3 imágenes que irán en el ID_Imagen 4, 5 y 6
Insert Into Noticias (Descripcion, Imagen) Values ('', '../../Assets/Imagenes/Noticias/calendario_actividades.jpg');
Insert Into Noticias (Descripcion, Imagen) Values ('', '../../Assets/Imagenes/Noticias/jornada_uni.jpg');
Insert Into Noticias (Descripcion, Imagen) Values ('', '../../Assets/Imagenes/Noticias/uni_farq.jpg');

-- Es necesario ingresar las 3 imágenes que irán en el ID_Imagen 7, 8 y 9
Insert Into Noticias (Descripcion, Imagen) Values ('', '../../Assets/Imagenes/Noticias/feria1.jpg');
Insert Into Noticias (Descripcion, Imagen) Values ('', '../../Assets/Imagenes/Noticias/feria2.jpg');
Insert Into Noticias (Descripcion, Imagen) Values ('', '../../Assets/Imagenes/Noticias/feria3.jpg');
