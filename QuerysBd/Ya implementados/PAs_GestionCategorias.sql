/**************************************/

/* Realizar el cambio en las tablas subcategorias agregando la columna ID_AñoAcademico 
/* y a la tabla categoria_evento eliminar la columnas Id_Categoria_Subcategoria y ID_AñoAcademico y agregar la columna ID_Categoria

/***************************************/
/* ************* MCategoria.php *******/

CREATE  FUNCTION `Obtener_CatEventoActual`() RETURNS varchar(255) CHARSET utf8mb4
BEGIN	
    DECLARE idEvento INT;
    DECLARE catsub VARCHAR(255);
    
    SELECT ID_Evento INTO idEvento FROM evento WHERE Activo = 1 AND YEAR(Fecha) = YEAR(CURDATE());
    
    SELECT GROUP_CONCAT(ID_Categoria SEPARATOR ',') INTO catsub FROM categoria_evento WHERE Activo = 1 AND ID_Evento = idEvento;
    
    RETURN catsub;
END

/************************************/

CREATE  PROCEDURE `Lista_CategoriaValidadaX`()
BEGIN    
    DECLARE GrupoCatEvento TEXT;
    
    
    SET GrupoCatEvento = Obtener_CatEventoActual();
    
    IF LENGTH(GrupoCatEvento) > 0 THEN
        SELECT distinct CONCAT('<option value="', ID_Categoria, '">', Nombre_Categoria, '</option>')
		FROM categoria 
		WHERE Activo = 1 
		AND ID_Categoria AND FIND_IN_SET(ID_Categoria, GrupoCatEvento) = 0
		ORDER BY ID_Categoria;
    ELSE
        select distinct concat ('<option value="', ID_Categoria, '">', Nombre_Categoria, '</option>')
		FROM categoria 
		WHERE Activo = 1 
		 ORDER BY ID_Categoria;
    END IF;
    
END

/*************************************/

CREATE  PROCEDURE `Lista_SubcategoriaSegunCategoria`(in IdCat bigint)
BEGIN

Declare p_idcat bigint default IdCat;

SET @REG=0;  /*btn btn-light*/

Select  concat('<tr><td id="Anchio"><input hidden value ="',s.ID_SubCategoria,'"></td><td class="ordenS">',@REG:= @REG+1,'</td><td class="NombreSub">',s.Nombre_SubCategoria,'</td><td><input hidden value="',a.ID_AñoAcademico,'">',a.Año,'</td><td><button  type="button" id="BtnEliminarSubCat" class=" btnSC" onclick="eliminarSubCat()" >Eliminar Subcategoria</button></td></tr>')
     from categoria_subcategoria sc
     inner join subcategoria s  on sc.ID_SubCategoria = s.ID_SubCategoria
     inner join categoria c on sc.ID_Categoria = c.ID_Categoria
     inner join añoacademico a on a.ID_Añoacademico = s.ID_AñoAcademico
    where s.Activo = 1 and c.Activo = 1 and a.Activo = 1
    AND (c.ID_Categoria = p_idcat)
    order by ID_Categoria_SubCategoria;
END

/***************************************/

CREATE  PROCEDURE `Buscar_NombreCategoria`(in N_cat varchar(30))
BEGIN
	declare p_cat varchar(30) default (trim(N_cat));
	Select count(Nombre_Categoria) as coincidencia from categoria  where Nombre_Categoria = p_cat and Activo = 1; 
END

/*************************************/


CREATE  PROCEDURE `Insertar_Categoria`(in ncategoria varchar(30))
BEGIN
	declare p_categoria varchar(30) default (trim(ncategoria));
    
    insert into  categoria
	(Nombre_Categoria,Activo)
    values
    (p_categoria,1);
    
END

/***************************************/

CREATE PROCEDURE `Actualizar_Categoria`(in idcategoria bigint, in ncatgoria varchar(30) )
BEGIN
	declare id_cat bigint default idcategoria;
	declare p_cat varchar(30) default (trim(ncatgoria));
    
    UPDATE categoria set Nombre_Categoria = p_cat where ID_Categoria = id_cat and Activo = 1;
    
END

/*************************************/

CREATE PROCEDURE `Lista_CategoriaSeleccionada_V1`(in idcat bigint)
BEGIN

	DECLARE GrupoCatEvento TEXT;
    Declare P_idcat bigint default idcat;
    
    
    SET GrupoCatEvento = Obtener_CatEventoActual();
    
 
		IF LENGTH(GrupoCatEvento) > 0 THEN
			SELECT distinct CONCAT('<option value="', ID_Categoria,'"',if(ID_Categoria = P_idcat, 'selected',''),'>', Nombre_Categoria, '</option>')
			FROM categoria 
			WHERE Activo = 1 
            AND ID_Categoria AND FIND_IN_SET(ID_Categoria, GrupoCatEvento) = 0
			ORDER BY ID_Categoria;
		ELSE
			select distinct concat ('<option value="', ID_Categoria,'"',if(ID_Categoria = P_idcat, 'selected',''),'>', Nombre_Categoria, '</option>')
			FROM categoria 
			WHERE Activo = 1 
			ORDER BY ID_Categoria;
		END IF;
	
    
END

/**********************************************/
CREATE PROCEDURE `Lista_AñoAcademico`()
BEGIN    

        select concat ('<option value="', ID_Añoacademico, '">',Año, '</option>')
		FROM añoacademico 
		WHERE Activo = 1 
		 ORDER BY ID_Añoacademico;
    
    
END
/***************************************************/

CREATE  PROCEDURE `Insertar_Subcategoria`(IN IdCategoria BIGINT, IN cadenasc TEXT, IN contDatos INT)
BEGIN
    DECLARE p_idcat BIGINT DEFAULT IdCategoria;
    DECLARE p_cadena TEXT DEFAULT cadenasc;
    DECLARE p_subcadena TEXT;
    DECLARE p_subcategoria VARCHAR(1000);
    DECLARE p_annoacademico INT;
    Declare idSubcate int;
    DECLARE contador INT DEFAULT 1;
    DECLARE delimitador CHAR(1) DEFAULT '}';
    DECLARE subdelimitador CHAR(1) DEFAULT ',';

    WHILE contador <= contDatos DO
        SET p_subcadena = TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p_cadena, delimitador, contador), delimitador, -1));
        SET p_annoacademico = TRIM(SUBSTRING_INDEX(p_subcadena, subdelimitador, -1));
        SET p_subcategoria = TRIM(REPLACE(p_subcadena, CONCAT(subdelimitador, p_annoacademico), ''));
        INSERT INTO subcategoria (Nombre_SubCategoria, ID_Añoacademico, Activo) VALUES (p_subcategoria, p_annoacademico, 1);
        SET idSubcate = LAST_INSERT_ID();
		INSERT INTO categoria_subcategoria (ID_Categoria,ID_SubCategoria,Activo) VALUES (p_idcat, idSubcate,1);
        SET contador = contador + 1;
    END WHILE;
END
/*******************************************************/

CREATE  PROCEDURE `Lista_AñoAcademicoSUB`(in id_añoA bigint)
BEGIN    

        select concat ('<option value="', ID_Añoacademico,'"',IF(ID_Añoacademico = id_añoA, 'selected',''),'>' ,Año, '</option>')
		FROM añoacademico 
		WHERE Activo = 1 
		ORDER BY ID_Añoacademico;
    
END

/**********************************************************/

CREATE  PROCEDURE `Actualizar_Subcategoria`(in idsubcate bigint, in nsubcate varchar(1000), in idaacademico bigint )
BEGIN
	declare id_subc bigint default idsubcate;
    declare id_añoA bigint default idaacademico;
	declare p_sub varchar(1000) default (trim(nsubcate));
    
    UPDATE subcategoria set Nombre_SubCategoria = p_sub, ID_Añoacademico=id_añoA  where ID_SubCategoria = id_subc and Activo = 1;
    
END
/************************************************************/

CREATE PROCEDURE `Eliminar_Subcategoria`(in idsubcategoria bigint )
BEGIN
	declare id_subc bigint default idsubcategoria ;
	
    
    UPDATE subcategoria set Activo = 0 where ID_SubCategoria = id_subc;
    
    UPDATE categoria_subcategoria set Activo = 0 where ID_SubCategoria = id_subc;
    
END
/************************************************************/
CREATE  PROCEDURE `Agregar_CategoriaEvento`(in IdCategoria bigint)
BEGIN

	Declare p_idcat int default IdCategoria;
	Declare idEvento int;
  
	SET idEvento = Obtener_EventoActual();
    
	Insert into categoria_evento (ID_Categoria,ID_Evento,Activo) values (p_idcat,idEvento,1);

END
/**********************************************************/
CREATE  PROCEDURE `Listar_CategoriasEventoActual`()
BEGIN
Declare idEvento int;
SET idEvento = Obtener_EventoActual();
SET @REG=0;
Select  concat('<tr><td id="Anchio"><input hidden value = "',CE.ID_Categoria_Evento,'"></td><td class="ordenCatE">',@REG:= @REG+1,'</td><td class="NombreCatEA">',C.Nombre_Categoria,'</td><td><button  type="button" id="BtnEliminarCE" class=" btn-light CE" >Eliminar</button></td></tr>')
     from categoria_evento CE
     
     inner join categoria C on  CE.ID_Categoria = C.ID_Categoria
    where C.Activo = 1 and CE.Activo = 1
    AND (CE.ID_Evento = idEvento)
    order by CE.ID_Categoria;
END
/******************************************************/
CREATE  PROCEDURE `Eliminar_CategoriaE`(in idCatE bigint)
BEGIN

declare id_catE bigint default idCatE;
	
    
    UPDATE categoria_evento set Activo = 0 where ID_Categoria_Evento = id_catE;
    
   
END
/********************************************************/
CREATE PROCEDURE `Cargar_IDCategoriaEvento`(in idCatEA bigint)
BEGIN
	declare Id_CatEActual int default idCatEA;
    declare id_EventoA int;

	SET id_EventoA  = Obtener_EventoActual();
    
    Select c.ID_Categoria, c.Nombre_Categoria from categoria_evento as cate
    
    inner join categoria as c on c.ID_Categoria = cate.ID_Categoria
    
    where cate.ID_Categoria_Evento = Id_CatEActual and cate.ID_Evento = id_EventoA  and c.Activo = 1 and cate.Activo=1;
END
/******************************************/

CREATE  PROCEDURE `Lista_SubcategoriaEA`(in IdCategoria bigint)
BEGIN

Declare p_idcat bigint default IdCategoria;

SET @REG=0;

Select  concat('<tr><td id="Anchio"><input hidden value ="',s.ID_SubCategoria,'"></td><td class="ordenCatEA">',@REG:= @REG+1,'</td><td class="NombreSub">',s.Nombre_SubCategoria,'</td><td>',a.Año,'</td></tr>')
	from categoria_subcategoria sc
     inner join subcategoria s  on sc.ID_SubCategoria = s.ID_SubCategoria
     inner join categoria c on sc.ID_Categoria = c.ID_Categoria
     inner join añoacademico a on a.ID_Añoacademico = s.ID_AñoAcademico
    where s.Activo = 1 and c.Activo = 1 and a.Activo = 1
    AND (c.ID_Categoria = p_idcat)
    order by ID_Categoria_SubCategoria;

END
/****************************************/

/*/////Actualizacion de procedimientos Anteriores ///////*/

CREATE  PROCEDURE `Lista_ComisionSeleccionada`(in idcomi bigint)
BEGIN
DECLARE GrupoComisionEvento TEXT;
    
    
    SET GrupoComisionEvento = Obtener_ComisionEventoActual();
    
    IF LENGTH(GrupoComisionEvento) > 0 THEN
        SELECT CONCAT('<option value="', ID_Comision,'"',if(ID_Comision = idcomi, 'selected',''),'>', Nombre_Comision, '</option>')
        FROM comision
        WHERE Activo = 1 AND FIND_IN_SET(ID_Comision, GrupoComisionEvento) = 0
        ORDER BY ID_Comision;
    ELSE
        select concat ('<option value ="',ID_Comision,'"',if(ID_Comision = idcomi, 'selected',''),'>',Nombre_Comision,'</option>')
		from comision
		where Activo = 1
		order by ID_Comision;
    END IF;
	
    
END


/*****************************************************************/

CREATE PROCEDURE `Insertar_DatosGeneralesEvento`(in ptipo_evento bigint, in pnombre_evento varchar(255),
 in peslogan_evento varchar(300),in plogo_evento varchar(255), in phora_evento time,in pfecha_evento date, 
 in plugar_evento bigint )
BEGIN
	declare p_tipoE bigint default ptipo_evento;
	declare p_nombreE varchar(255) default (trim(pnombre_evento));  
    declare p_esloganE varchar(300) default (trim(peslogan_evento)); 
    declare p_logoE varchar(255) default plogo_evento;
    declare p_horaE time default  phora_evento;
    declare p_fechaE date default pfecha_evento;
    declare p_lugarE bigint default plugar_evento;
	declare id_EventoA int;

	SET id_EventoA  = Obtener_EventoActual();
    
      UPDATE evento set Activo = 0 where ID_Evento = id_EventoA;
    
    Insert into evento
    (Id_Tipo_Evento,Nombre_Evento,Eslogan,Logo,hora,Fecha,Id_Sitio,Activo)
    values
    (p_tipoE,p_nombreE,p_esloganE,p_logoE,p_horaE,p_fechaE,p_lugarE,1);
END

/****************************************/

CREATE  PROCEDURE `Cargar_DatosGEvento`()
BEGIN
	
    declare id_Eactual int;

	SET id_Eactual = Obtener_EventoActual();
    
    Select ID_Evento, Nombre_Evento,Eslogan, hora, Fecha, Logo from evento
    
    
    where ID_Evento =  id_Eactual and Activo = 1 and ID_Tipo_Evento=1;
END