/**************************************/
/******* Tablas A crear ***************/
Create table `criterios` (
`ID_Criterio` bigint(20) NOT NULL AUTO_INCREMENT,
  `NombreCriterios` varchar(30) ,
  `Descripcion` varchar(200) ,
  `Valor` int(11) ,
 `Activo` int(11) not null,
  PRIMARY KEY (`ID_Criterio`)

)

Create table `tipo_formato` (
`ID_Tipo_Formato` bigint(20) NOT NULL AUTO_INCREMENT,
  `NombreFormato` varchar(30) ,
 `Activo` int(11) not null,
  PRIMARY KEY (`ID_Tipo_Formato`)

)
CREATE TABLE `formato_criterio` (
  `ID_formato_criterio` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_Tipo_Formato` bigint(20) NOT NULL,
  `ID_Criterio` bigint(20) NOT NULL,
  `Activo` int(11) not null,
  PRIMARY KEY (`ID_formato_criterio`),
  KEY `ID_Tipo_Formato` (`ID_Tipo_Formato`),
  KEY `ID_Criterio` (`ID_Criterio`),
  CONSTRAINT `formato_criterio_ibfk_1` FOREIGN KEY (`ID_Tipo_Formato`) REFERENCES `tipo_formato` (`ID_Tipo_Formato`),
  CONSTRAINT `formato_criterio_ibfk_2` FOREIGN KEY (`ID_Criterio`) REFERENCES `criterios` (`ID_Criterio`)
)

/************** LA TABLA DE JURADOS SE MODIFICO, ASI QUE ESA IMAGEN ESTARA EN EL DOCUMENTO WORD************/

CREATE TABLE `jurado_subcategoria` (
  `ID_Jurado_Subcategoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_Jurado` bigint(20) NOT NULL,
  `ID_SubCategoria` bigint(20) NOT NULL,
  `Activo` int(11) not null,
  PRIMARY KEY (`ID_Jurado_Subcategoria`),
  KEY `ID_Jurado` (`ID_Jurado`),
  KEY `ID_SubCategoria` (`ID_SubCategoria`),
  CONSTRAINT `jurado_subcategoria_ibfk_1` FOREIGN KEY (`ID_Jurado`) REFERENCES `jurado` (`ID_Jurado`),
  CONSTRAINT `jurado_subcategoria_ibfk_2` FOREIGN KEY (`ID_SubCategoria`) REFERENCES `subcategoria` (`ID_SubCategoria`)
)

/********  MJurado              *******/

/**********************/
CREATE  FUNCTION `Obtener_TutorXSubcategoriaProyecto`(idsubcate bigint) RETURNS varchar(255) CHARSET utf8mb4
BEGIN
    DECLARE idEvento INT;
    DECLARE IdpersonaA VARCHAR(255);
    
    SELECT ID_Evento INTO idEvento FROM evento WHERE Activo = 1 AND YEAR(Fecha) = YEAR(CURDATE());
    
    SELECT GROUP_CONCAT(distinct P.ID_Personal_Academico SEPARATOR ',') INTO IdpersonaA 
    
    from proyecto as P
    inner join evento_proyecto as ep on ep.ID_Proyecto = P.ID_Proyecto
	inner join evento as e on e.ID_Evento = ep.ID_Evento
    
    where e.ID_Evento = idEvento and P.ID_SubCategoria=idsubcate
	and e.Activo =1 and P.Activo=1;
    
    RETURN IdpersonaA;
END

/********************/

CREATE  PROCEDURE `Lista_PersonalAcemicoJurado`(in valoridpa bigint )
BEGIN

Declare idEvento int;

DECLARE GrupoIdPAlEventoXSub TEXT;
    SET GrupoIdPAlEventoXSub = Obtener_TutorXSubcategoriaProyecto(valoridpa);
    
    SET idEvento = Obtener_EventoActual();
    
    IF GrupoIdPAlEventoXSub IS NOT NULL THEN
        SELECT DISTINCT CONCAT('<option value ="', P.ID_Persona, '">', P.Primer_Nombre, ' ', P.Segundo_Nombre, ' ', P.Primer_Apellido, ' ', P.Segundo_Apellido, '</option>')
        FROM personal_academico PA 
        INNER JOIN persona_usuario PU ON PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
        INNER JOIN persona P ON P.ID_Persona = PU.ID_Persona
        WHERE PA.Activo = 1 AND PU.Activo = 1 AND PU.ID_Tipo_Usuario IN (3, 4) AND P.Activo = 1 AND FIND_IN_SET(PA.ID_Personal_Academico, GrupoIdPAlEventoXSub) = 0 
        AND (
                SELECT COUNT(ID_Personal_Academico)
                FROM jurado J
                WHERE J.ID_Personal_Academico = PA.ID_Personal_Academico and J.ID_Evento=idEvento and J.activo=1
            ) < 2
        ORDER BY P.Primer_Nombre, P.Primer_Apellido;
    ELSE
        SELECT DISTINCT CONCAT('<option value ="', P.ID_Persona, '">', P.Primer_Nombre, ' ', P.Segundo_Nombre, ' ', P.Primer_Apellido, ' ', P.Segundo_Apellido, '</option>')
        FROM personal_academico PA 
        INNER JOIN persona_usuario PU ON PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
        INNER JOIN persona P ON P.ID_Persona = PU.ID_Persona
        WHERE PA.Activo = 1 AND PU.Activo = 1 AND PU.ID_Tipo_Usuario IN (3, 4) AND P.Activo = 1 
        AND (
                SELECT COUNT(ID_Personal_Academico)
                FROM jurado J
                WHERE J.ID_Personal_Academico = PA.ID_Personal_Academico and J.ID_Evento=idEvento and J.activo=1
            ) < 2
        ORDER BY P.Primer_Nombre, P.Primer_Apellido;
    END IF;


END

/********************/

CREATE  PROCEDURE `Lista_PersonalAcemicoJurado2`(in valoridpa bigint,in idpaJ1 bigint)
BEGIN
Declare idEvento int;
DECLARE GrupoIdPAlEventoXSub TEXT;
    SET GrupoIdPAlEventoXSub = Obtener_TutorXSubcategoriaProyecto(valoridpa);
	SET idEvento = Obtener_EventoActual();
IF GrupoIdPAlEventoXSub IS NOT NULL THEN
        SELECT DISTINCT CONCAT('<option value ="', P.ID_Persona, '">', P.Primer_Nombre, ' ', P.Segundo_Nombre, ' ', P.Primer_Apellido, ' ', P.Segundo_Apellido, '</option>')
        FROM personal_academico PA 
        INNER JOIN persona_usuario PU ON PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
        INNER JOIN persona P ON P.ID_Persona = PU.ID_Persona
        WHERE PA.Activo = 1 AND PU.Activo = 1 AND PU.ID_Tipo_Usuario IN (3, 4) AND P.Activo = 1 AND P.ID_Persona not in(idpaJ1) AND FIND_IN_SET(PA.ID_Personal_Academico, GrupoIdPAlEventoXSub) = 0 
         AND (
                SELECT COUNT(ID_Personal_Academico)
                FROM jurado J
                WHERE J.ID_Personal_Academico = PA.ID_Personal_Academico and J.ID_Evento=idEvento and J.activo=1
            ) < 2
        ORDER BY P.Primer_Nombre, P.Primer_Apellido;
    ELSE
        SELECT DISTINCT CONCAT('<option value ="', P.ID_Persona, '">', P.Primer_Nombre, ' ', P.Segundo_Nombre, ' ', P.Primer_Apellido, ' ', P.Segundo_Apellido, '</option>')
        FROM personal_academico PA 
        INNER JOIN persona_usuario PU ON PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
        INNER JOIN persona P ON P.ID_Persona = PU.ID_Persona
        WHERE PA.Activo = 1 AND PU.Activo = 1 AND PU.ID_Tipo_Usuario IN (3, 4) AND P.Activo = 1 AND P.ID_Persona not in(idpaJ1)
         AND (
                SELECT COUNT(ID_Personal_Academico)
                FROM jurado J
                WHERE J.ID_Personal_Academico = PA.ID_Personal_Academico and J.ID_Evento=idEvento and J.activo=1
            ) < 2
        ORDER BY P.Primer_Nombre, P.Primer_Apellido;
    END IF;
END

/********************/

CREATE  PROCEDURE `Lista_PersonalAcemicoJurado3`(in valoridpa bigint,in idpaJ1 bigint,in idpaJ2 bigint)
BEGIN

Declare idEvento int;
DECLARE GrupoIdPAlEventoXSub TEXT;
    SET GrupoIdPAlEventoXSub = Obtener_TutorXSubcategoriaProyecto(valoridpa);
    SET idEvento = Obtener_EventoActual();
    
IF GrupoIdPAlEventoXSub IS NOT NULL THEN
        SELECT DISTINCT CONCAT('<option value ="', P.ID_Persona, '">', P.Primer_Nombre, ' ', P.Segundo_Nombre, ' ', P.Primer_Apellido, ' ', P.Segundo_Apellido, '</option>')
        FROM personal_academico PA 
        INNER JOIN persona_usuario PU ON PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
        INNER JOIN persona P ON P.ID_Persona = PU.ID_Persona
        WHERE PA.Activo = 1 AND PU.Activo = 1 AND PU.ID_Tipo_Usuario IN (3, 4) AND P.Activo = 1 AND P.ID_Persona not in(idpaJ1,idpaJ2) AND FIND_IN_SET(PA.ID_Personal_Academico, GrupoIdPAlEventoXSub) = 0 
        AND (
                SELECT COUNT(ID_Personal_Academico)
                FROM jurado J
                WHERE J.ID_Personal_Academico = PA.ID_Personal_Academico and J.ID_Evento=idEvento and J.activo=1
            ) < 2
        ORDER BY P.Primer_Nombre, P.Primer_Apellido;
    ELSE
        SELECT DISTINCT CONCAT('<option value ="', P.ID_Persona, '">', P.Primer_Nombre, ' ', P.Segundo_Nombre, ' ', P.Primer_Apellido, ' ', P.Segundo_Apellido, '</option>')
        FROM personal_academico PA 
        INNER JOIN persona_usuario PU ON PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
        INNER JOIN persona P ON P.ID_Persona = PU.ID_Persona
        WHERE PA.Activo = 1 AND PU.Activo = 1 AND PU.ID_Tipo_Usuario IN (3, 4) AND P.Activo = 1 AND P.ID_Persona not in(idpaJ1,idpaJ2)
        AND (
                SELECT COUNT(ID_Personal_Academico)
                FROM jurado J
                WHERE J.ID_Personal_Academico = PA.ID_Personal_Academico and J.ID_Evento=idEvento and J.activo=1
            ) < 2
        ORDER BY P.Primer_Nombre, P.Primer_Apellido;
    END IF;
END

/********************/

CREATE  PROCEDURE `ListarCategoriasEvento`()
BEGIN
	
    declare id_EA int;
	SET id_EA = Obtener_EventoActual();
    
    SELECT distinct CONCAT('<option value="', CE.ID_Categoria_Evento, '">', c.Nombre_Categoria, '</option>')
	FROM categoria_evento CE 
    inner join categoria as c on CE.ID_Categoria =c.ID_Categoria
	WHERE CE.ID_Evento = id_EA and CE.Activo = 1 
	ORDER BY CE.ID_Categoria;
END

/********************/

CREATE  PROCEDURE `ListarSubCategoriasCategoria`(in IdCat bigint)
BEGIN
	
    
    DECLARE p_idcat_evento BIGINT DEFAULT IdCat;
    DECLARE GrupoSubcatAsignadas TEXT;
    
    
    SET GrupoSubcatAsignadas = Obtener_SubcategAsignadasAJurEActual();
	
    IF LENGTH(GrupoSubcatAsignadas) > 0 THEN
		SELECT DISTINCT CONCAT('<option value="', s.ID_SubCategoria, '">', s.Nombre_SubCategoria, '</option>')
		FROM categoria_subcategoria cs
		INNER JOIN subcategoria s ON cs.ID_SubCategoria = s.ID_SubCategoria
		WHERE s.Activo = 1 AND cs.Activo = 1 AND cs.ID_Categoria = (
			SELECT ID_Categoria
			FROM categoria_evento
			WHERE ID_Categoria_Evento = p_idcat_evento AND Activo = 1
		)
		AND FIND_IN_SET(s.ID_SubCategoria, GrupoSubcatAsignadas) = 0
		ORDER BY s.ID_SubCategoria;
	else
    SELECT DISTINCT CONCAT('<option value="', s.ID_SubCategoria, '">', s.Nombre_SubCategoria, '</option>')
		FROM categoria_subcategoria cs
		INNER JOIN subcategoria s ON cs.ID_SubCategoria = s.ID_SubCategoria
		WHERE s.Activo = 1 AND cs.Activo = 1 AND cs.ID_Categoria = (
			SELECT ID_Categoria
			FROM categoria_evento
			WHERE ID_Categoria_Evento = p_idcat_evento AND Activo = 1
		)
		
		ORDER BY s.ID_SubCategoria;
	end if;
END

/********************/

CREATE PROCEDURE `ListarFormatoCriterios`()
BEGIN
	
    SELECT  CONCAT('<option value="', ID_Tipo_Formato, '">', NombreFormato, '</option>')
	FROM tipo_formato
	WHERE Activo = 1 
	ORDER BY ID_Tipo_Formato;
END

/********************/

CREATE  PROCEDURE `Lista_CriterioSegunFormato`(in Idformat bigint)
BEGIN

Declare p_idfor bigint default Idformat;

SET @REG=0;  /*btn btn-light*/

Select  concat('<tr><td id="Anchio"><input hidden value ="',s.ID_Criterio,'"></td><td class="ordenCri">',@REG:= @REG+1,'</td><td class="NombreCri">',s.NombreCriterios,'</td><td class="DesCri">',s.Descripcion,'</td><td class="datoValor">',sc.Valor,'</td><td><button  type="button" id="BtnEliminarCri" class=" btnCri" onclick="eliminarCri()" >Eliminar Criterio</button></td></tr>')
     from formato_criterio sc
     inner join criterios s  on sc.ID_Criterio = s.ID_Criterio
     inner join tipo_formato c on sc.ID_Tipo_Formato = c.ID_Tipo_Formato
     
    where s.Activo = 1 and c.Activo = 1 and sc.Activo=1
    AND (c.ID_Tipo_Formato = p_idfor)
    order by ID_formato_criterio;
END


/********************/

CREATE  PROCEDURE `Eliminar_Criterio`(in idcriterio bigint, in idtipoformat bigint)
BEGIN
	declare id_cri bigint default idcriterio ;
    declare id_format bigint default idtipoformat ;
	
    
    UPDATE criterios set Activo = 0 where ID_Criterio = id_cri;
    
    UPDATE formato_criterio set Activo = 0 where ID_Criterio = id_cri and ID_Tipo_Formato=id_format;
    
END
/********************/
CREATE  FUNCTION `Obtener_SubcategAsignadasAJurEActual`() RETURNS varchar(255) CHARSET utf8mb4
BEGIN
    DECLARE idEvento INT;
    DECLARE subcomisionesE VARCHAR(255);
    
    SELECT ID_Evento INTO idEvento FROM evento WHERE Activo = 1 AND YEAR(Fecha) = YEAR(CURDATE());
    
    SELECT GROUP_CONCAT(ID_SubCategoria SEPARATOR ',') INTO subcomisionesE FROM jurado_subcategoria JS
    INNER JOIN jurado J ON J.ID_Jurado = JS.ID_Jurado
    WHERE JS.Activo = 1 AND J.ID_Evento = idEvento;
    
    RETURN subcomisionesE;
END

/*******************/
CREATE  PROCEDURE `Listar_JuradoEventoActual`()
BEGIN
Declare idEvento int;
DECLARE DSubcategoriasEvento TEXT;
    SET DSubcategoriasEvento = Obtener_SubcategAsignadasAJurEActual();
SET idEvento = Obtener_EventoActual();
SET @REG=0;

Select distinct concat('<tr><td id="Anchio"><input hidden value = "',S.ID_SubCategoria,'"></td><td class="ordenJE">',@REG:= @REG+1,'</td><td class="NombreCatEA">',C.Nombre_Categoria,'</td><td class="NombreSubCatEA">',S.Nombre_SubCategoria,'</td><td><button  type="button" id="BtnEliminarJE" class=" btn-light CE" >Eliminar Jurados Asignados</button></td></tr>')

	INNER JOIN categoria_subcategoria CS ON CS.ID_SubCategoria = S.ID_SubCategoria
	INNER JOIN categoria_evento CE ON CE.ID_Categoria = CS.ID_Categoria
	INNER JOIN categoria C ON C.ID_Categoria = CE.ID_Categoria
	WHERE CE.ID_Evento = idEvento
	AND S.Activo = 1
    AND FIND_IN_SET(S.ID_SubCategoria, DSubcategoriasEvento) 
	AND CS.Activo = 1
	AND CE.Activo = 1
	AND C.Activo = 1
	ORDER BY S.ID_SubCategoria;

END
/********************/
CREATE  PROCEDURE `Eliminar_JuradoE`(in idSubcateJurE bigint)
BEGIN

declare id_subcatejur bigint default idSubcateJurE;
	
    UPDATE jurado_subcategoria SET Activo = 0
	WHERE ID_SubCategoria = id_subcatejur;

	UPDATE jurado J JOIN jurado_subcategoria JS ON J.ID_Jurado = JS.ID_Jurado
	SET J.Activo = 0
	WHERE JS.ID_SubCategoria = id_subcatejur;

END
/********************/
CREATE  FUNCTION `IdPer_J1_CEvento`(id_subcatEA bigint) RETURNS int(11)
BEGIN
	declare Id_SubCEA int default id_subcatEA;
	DECLARE idresult  int;
    
	SELECT DISTINCT  P.ID_Persona INTO idresult
	FROM jurado_subcategoria JS
	INNER JOIN jurado J ON J.ID_Jurado = JS.ID_Jurado
    INNER JOIN personal_academico PA ON PA.ID_Personal_Academico = J.ID_Personal_Academico
	INNER JOIN persona_usuario PU ON PU.ID_Persona_Usuario = PA.ID_Persona_Usuario
	INNER JOIN Persona P ON P.ID_Persona = PU.ID_Persona
	WHERE JS.Activo=1 and J.Activo=1 and PA.Activo = 1 AND PU.Activo = 1 AND PU.ID_Tipo_Usuario IN (3,4) AND P.Activo = 1
	  AND J.JuradoPos = 1 AND JS.ID_SubCategoria = Id_SubCEA;
	
	RETURN idresult;
END
/**********************/
CREATE  FUNCTION `IdPer_J2_CEvento`(id_subcatEA bigint) RETURNS int(11)
BEGIN
	declare Id_SubCEA int default id_subcatEA;
	DECLARE idresult  int;
    
	SELECT DISTINCT  P.ID_Persona INTO idresult
	FROM jurado_subcategoria JS
	INNER JOIN jurado J ON J.ID_Jurado = JS.ID_Jurado
    INNER JOIN personal_academico PA ON PA.ID_Personal_Academico = J.ID_Personal_Academico
	INNER JOIN persona_usuario PU ON PU.ID_Persona_Usuario = PA.ID_Persona_Usuario
	INNER JOIN Persona P ON P.ID_Persona = PU.ID_Persona
	WHERE JS.Activo=1 and J.Activo=1 and PA.Activo = 1 AND PU.Activo = 1 AND PU.ID_Tipo_Usuario IN (3,4) AND P.Activo = 1
	  AND J.JuradoPos = 2 AND JS.ID_SubCategoria = Id_SubCEA;
	
	RETURN idresult;
END
/*************************/
CREATE  FUNCTION `IdPer_J3_CEvento`(id_subcatEA bigint) RETURNS int(11)
BEGIN
	declare Id_SubCEA int default id_subcatEA;
	DECLARE idresult  int;
    
	SELECT DISTINCT  P.ID_Persona INTO idresult
	FROM jurado_subcategoria JS
	INNER JOIN jurado J ON J.ID_Jurado = JS.ID_Jurado
    INNER JOIN personal_academico PA ON PA.ID_Personal_Academico = J.ID_Personal_Academico
	INNER JOIN persona_usuario PU ON PU.ID_Persona_Usuario = PA.ID_Persona_Usuario
	INNER JOIN Persona P ON P.ID_Persona = PU.ID_Persona
	WHERE JS.Activo=1 and J.Activo=1 and PA.Activo = 1 AND PU.Activo = 1 AND PU.ID_Tipo_Usuario IN (3,4) AND P.Activo = 1
	  AND J.JuradoPos = 3 AND JS.ID_SubCategoria = Id_SubCEA;
	
	RETURN idresult;
END
/**************************/
CREATE  PROCEDURE `J1_Jurado_PersonalAcemico`(in id_subCEA bigint)
BEGIN

declare Id_subcea int default id_subCEA;
Declare idj1 int;

  SET idj1 = IdPer_J1_CEvento(Id_subcea);

select distinct  CONCAT(P.Primer_Nombre,' ',P.Segundo_Nombre,' ',P.Primer_Apellido,' ',P.Segundo_Apellido) AS nombre_completo 
     from personal_academico PA 
     inner join persona_usuario PU  on PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
     inner join Persona P on P.ID_Persona = PU.ID_Persona
    where PA.Activo = 1 and PU.Activo = 1 and pu.ID_Tipo_Usuario in (3,4) AND P.Activo = 1 and P.ID_Persona = idj1
	order by P.Primer_Nombre,P.Primer_Apellido;

END
/**************************/
CREATE  PROCEDURE `J2_Jurado_PersonalAcemico`(in id_subCEA bigint)
BEGIN

declare Id_subcea int default id_subCEA;
Declare idj2 int;

  SET idj2 = IdPer_J2_CEvento(Id_subcea);

select distinct CONCAT(P.Primer_Nombre,' ',P.Segundo_Nombre,' ',P.Primer_Apellido,' ',P.Segundo_Apellido) AS nombre_completo 
     from personal_academico PA 
     inner join persona_usuario PU  on PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
     inner join Persona P on P.ID_Persona = PU.ID_Persona
    where PA.Activo = 1 and PU.Activo = 1 and pu.ID_Tipo_Usuario in (3,4) AND P.Activo = 1 and P.ID_Persona = idj2
	order by P.Primer_Nombre,P.Primer_Apellido;

END
/**************************/
CREATE PROCEDURE `J3_Jurado_PersonalAcemico`(in id_subCEA bigint)
BEGIN

declare Id_subcea int default id_subCEA;
Declare idj3 int;

  SET idj3 = IdPer_J3_CEvento(Id_subcea);

select distinct  CONCAT(P.Primer_Nombre,' ',P.Segundo_Nombre,' ',P.Primer_Apellido,' ',P.Segundo_Apellido) AS nombre_completo 
     from personal_academico PA 
     inner join persona_usuario PU  on PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
     inner join Persona P on P.ID_Persona = PU.ID_Persona
    where PA.Activo = 1 and PU.Activo = 1 and pu.ID_Tipo_Usuario in (3,4) AND P.Activo = 1 and P.ID_Persona = idj3
	order by P.Primer_Nombre,P.Primer_Apellido;

END
/*************************/
CREATE  PROCEDURE `Cargar_Datos_FormatoCriterio`(in id_subCEA bigint)
BEGIN
	declare Id_SubCEA int default id_subCEA;
    declare id_Eactual int;

	SET id_Eactual = Obtener_EventoActual();
    
    Select distinct TF.ID_Tipo_Formato,	TF.NombreFormato from jurado_subcategoria as ce
    
    inner join jurado as c on c.ID_Jurado = ce.ID_Jurado
   /* inner join formato_criterio as FC on FC.ID_formato_criterio = c.ID_formato_criterio*/
    inner join tipo_formato as TF on TF.ID_Tipo_Formato = c.ID_Formato
    
    where ce.ID_SubCategoria = Id_SubCEA  and c.ID_Evento = id_Eactual and c.Activo = 1 and ce.Activo=1 and TF.Activo=1;
END

/**************************/
CREATE  PROCEDURE `Lista_CriterioFormatoJE`(in Idformat bigint)
BEGIN

Declare p_idfor bigint default Idformat;

SET @REG=0;  

Select  concat('<tr><td id="Anchio"><input hidden value ="',s.ID_Criterio,'"></td><td class="ordenCri">',@REG:= @REG+1,'</td><td class="NombreCri">',s.NombreCriterios,'</td><td class="DesCri">',s.Descripcion,'</td><td class="datoValor">',sc.Valor,'</td></tr>')
     from formato_criterio sc
     inner join criterios s  on sc.ID_Criterio = s.ID_Criterio
     inner join tipo_formato c on sc.ID_Tipo_Formato = c.ID_Tipo_Formato
     
    where s.Activo = 1 and c.Activo = 1 and sc.Activo=1
    AND (c.ID_Tipo_Formato = p_idfor)
    order by ID_formato_criterio;
END


/**************************/
/********  MFormato              *******/

/********************/
CREATE  PROCEDURE `Buscar_NombreFormato`(in N_For varchar(30))
BEGIN
	declare p_for varchar(30) default (trim(N_For));
	Select count(NombreFormato) as coincidencia from tipo_formato  where NombreFormato =  p_for and Activo = 1; 
END
/********************/

CREATE  PROCEDURE `Insertar_Formato`(in nformato varchar(30))
BEGIN
	declare p_formato varchar(100) default (trim(nformato));
    
    insert into  tipo_formato
	(NombreFormato,Activo)
    values
    (p_formato,1);
    
END

/********************/

CREATE  PROCEDURE `ListarFormatoCriterios_Seleccionado`(in nformato varchar(30))
BEGIN

declare IDFormat int;
set IDFormat = (select ID_Tipo_Formato FROM tipo_formato Where NombreFormato = nformato);


SELECT  CONCAT('<option value="', ID_Tipo_Formato, '"',if(ID_Tipo_Formato = IDFormat, 'selected',''),'>', NombreFormato, '</option>')
	FROM tipo_formato
	WHERE Activo = 1 
	ORDER BY ID_Tipo_Formato;

END

/********************/

CREATE  PROCEDURE `Actualizar_Formato`(in idtformat bigint, in nformato varchar(30) )
BEGIN
	declare id_for bigint default idtformat;
	declare p_for varchar(100) default (trim(nformato));
    
    UPDATE tipo_formato set NombreFormato = p_for where ID_Tipo_Formato = id_for and Activo = 1;
    
END

/********************/

CREATE  PROCEDURE `Listar_ID_FormatoCriterios_Seleccionado`(in idformat bigint)
BEGIN

SELECT  CONCAT('<option value="', ID_Tipo_Formato, '"',if(ID_Tipo_Formato = idformat, 'selected',''),'>', NombreFormato, '</option>')
	FROM tipo_formato
	WHERE Activo = 1 
	ORDER BY ID_Tipo_Formato;

END

/*********************/

CREATE  PROCEDURE `Insertar_Criterio`(IN Idformato BIGINT, IN cadenacri TEXT, IN criDatos INT)
BEGIN
     DECLARE p_idcat BIGINT DEFAULT Idformato;
    DECLARE p_cadena TEXT DEFAULT cadenacri;
    DECLARE p_subcadena TEXT;
    DECLARE p_criterio VARCHAR(1000);
    DECLARE p_descripcion VARCHAR(1000);
    DECLARE p_valorcri INT;
    DECLARE idcriterio int;
    DECLARE contador INT DEFAULT 1;
    DECLARE delimitador CHAR(1) DEFAULT '}';
    DECLARE subdelimitador CHAR(1) DEFAULT ',';
    DECLARE subdelimitador2 CHAR(1) DEFAULT '|';

    
    WHILE contador <= criDatos DO
    SET p_subcadena = SUBSTRING_INDEX(SUBSTRING_INDEX(p_cadena, delimitador, contador), delimitador, -1);
    SET p_valorcri = TRIM(SUBSTRING_INDEX(p_subcadena, subdelimitador2, -1));
    SET p_descripcion = TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p_subcadena, subdelimitador2, 1), subdelimitador, -1));
    SET  p_criterio = TRIM(REPLACE(p_subcadena, CONCAT(subdelimitador, p_descripcion, subdelimitador2, p_valorcri), ''));
    
      INSERT INTO criterios (NombreCriterios, Descripcion, Activo) VALUES (p_criterio, p_descripcion, 1);
        SET idcriterio = LAST_INSERT_ID();

        INSERT INTO formato_criterio (ID_Tipo_Formato, ID_Criterio, Valor, Activo) VALUES (p_idcat, idcriterio, p_valorcri,1);
        SET contador = contador + 1;
    END WHILE;
END

/**************************/

CREATE PROCEDURE `Actualizar_Criterio`(in idcri bigint, in ncriterio varchar(30), in descrip varchar(500), in CriValor bigint)
BEGIN
	declare id_cri bigint default idcri;
	declare p_cri varchar(30) default (trim(ncriterio));
    declare p_descri varchar(50) default (trim(descrip));
    declare valor_Cri bigint default CriValor;
    
    UPDATE criterios set NombreCriterios = p_cri, Descripcion = p_descri where ID_Criterio = id_cri and Activo = 1;
    
    UPDATE formato_criterio set Valor = valor_Cri where ID_Criterio = id_cri and Activo = 1;
    
END

/**************************/

CREATE  PROCEDURE `Agregar_JuradoGestion`(in IdCateE bigint,in IdSubcate bigint,in Jurado1 bigint, in Jurado2 bigint, in Jurado3 bigint,in ID_FormatoC bigint)
BEGIN

	DECLARE p_idcatE int default IdCateE;
    DECLARE p_idsubcat int default IdSubcate;
    DECLARE p_idform int default ID_FormatoC;
    
	DECLARE int_jur1 int default Jurado1;
	DECLARE int_jur2 int default Jurado2;
	DECLARE int_jur3 int default Jurado3;
    
	Declare idEvento int;
	Declare idpaca1 int;
	Declare idpaca2 int;
	Declare idpaca3 int;
	Declare idpa int;
    
    Declare LastID_j1 int;
    Declare LastID_j2 int;
    Declare LastID_j3 int;
    
    DECLARE Existencia INT;

	
  
	SET idEvento = Obtener_EventoActual();
    
    IF int_jur1 IS NOT NULL THEN
    Set idpaca1 = Obtener_IdPA(int_jur1);
		SELECT COUNT(*) INTO Existencia FROM persona_usuario WHERE ID_Persona = int_jur1 and ID_Tipo_Usuario = 2;
		IF Existencia > 0 THEN
			UPDATE persona_usuario SET Activo = 1 WHERE ID_Persona = int_jur1 and ID_Tipo_Usuario = 2 LIMIT 1;
		ELSE
			INSERT INTO persona_usuario (ID_Tipo_Usuario, ID_Persona, Activo) VALUES (2, int_jur1, 1);
		END IF;
		INSERT INTO jurado (ID_Personal_Academico, ID_Categoria_Evento, ID_Formato, JuradoPos, ID_Evento, Activo) VALUES (idpaca1, p_idcatE, p_idform, 1, idEvento, 1);
		SET LastID_j1 = LAST_INSERT_ID();
		INSERT INTO jurado_subcategoria (ID_Jurado, ID_SubCategoria, Activo) VALUES (LastID_j1, p_idsubcat, 1);
	END IF;
  
  IF int_jur2 IS NOT NULL THEN
    Set idpaca2 = Obtener_IdPA(int_jur2);
		SELECT COUNT(*) INTO Existencia FROM persona_usuario WHERE ID_Persona = int_jur2 and ID_Tipo_Usuario = 2;
		IF Existencia > 0 THEN
			UPDATE persona_usuario SET Activo = 1 WHERE ID_Persona = int_jur2 and ID_Tipo_Usuario = 2 LIMIT 1;
		ELSE
			INSERT INTO persona_usuario (ID_Tipo_Usuario, ID_Persona, Activo) VALUES (2, int_jur2, 1);
		END IF;
		INSERT INTO jurado (ID_Personal_Academico, ID_Categoria_Evento, ID_Formato, JuradoPos, ID_Evento, Activo) VALUES (idpaca2, p_idcatE, p_idform, 2, idEvento, 1);
		SET LastID_j2 = LAST_INSERT_ID();
		INSERT INTO jurado_subcategoria (ID_Jurado, ID_SubCategoria, Activo) VALUES (LastID_j2, p_idsubcat, 1);
  END IF;
  
   IF int_jur3 IS NOT NULL THEN
    Set idpaca3 = Obtener_IdPA(int_jur3);
		SELECT COUNT(*) INTO Existencia FROM persona_usuario WHERE ID_Persona = int_jur3 and ID_Tipo_Usuario = 2;
		IF Existencia > 0 THEN
			UPDATE persona_usuario SET Activo = 1 WHERE ID_Persona = int_jur3 and ID_Tipo_Usuario = 2 LIMIT 1;
		ELSE
			INSERT INTO persona_usuario (ID_Tipo_Usuario, ID_Persona, Activo) VALUES (2, int_jur3, 1);
		END IF;
		INSERT INTO jurado (ID_Personal_Academico, ID_Categoria_Evento, ID_Formato, JuradoPos, ID_Evento, Activo) VALUES (idpaca3, p_idcatE, p_idform, 3, idEvento, 1);
		SET LastID_j3 = LAST_INSERT_ID();
		INSERT INTO jurado_subcategoria (ID_Jurado, ID_SubCategoria, Activo) VALUES (LastID_j3, p_idsubcat, 1);
  END IF;
  

    
END

/************************/

/*******Proceidmiento para visualziar las comisiones Actualziado****************/

CREATE DEFINER=`` PROCEDURE `Listar_ConferenciasEventoActual`()
BEGIN
Declare idEvento int;
SET idEvento = Obtener_EventoActual();
SET @REG=0;

Select  concat('<tr><td id="Anchio"><input hidden value = "',CE.ID_Conferencia_Evento,'"></td><td class="ordenConE">',@REG:= @REG+1,'</td><td class="NombreConFE">',CE.Nombre_Conferencia,'</td><td>',CE.Nombre_Conferencista,'</td><td>',CE.Detalles_Conferencista,'</td><td>',DATE_FORMAT(CE.Hora_Inicio, '%h:%i %p'),'</td><td>',DATE_FORMAT(CE.Hora_Fin, '%h:%i %p'),'</td><td>',ss.NombreSalon,'</td><td><button  type="button" id="BtnEliminarConFE" class=" btn-light CE" >Eliminar Conferencia</button></td></tr>')
     from conferencia_evento CE
     inner join salon ss on CE.ID_Salon = ss.ID_Salon
     
    where  CE.Activo = 1 and ss.Activo=1
    AND (CE.ID_Evento = idEvento)
    order by CE.Hora_Inicio;
 

END
