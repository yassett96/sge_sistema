-- M Comision --
/*************/
CREATE  PROCEDURE `Insertar_Comision`(in ncomision varchar(100))
BEGIN
	declare p_comision varchar(100) default (trim(ncomision));
    
    insert into  comision
	(Nombre_Comision,Activo)
    values
    (p_comision,1);
    
END
/*************/
CREATE  PROCEDURE `Actualizar_Comision`(in idcomision bigint, in ncomision varchar(100) )
BEGIN
	declare id_com bigint default idcomision;
	declare p_com varchar(100) default (trim(ncomision));
    
    UPDATE comision set Nombre_Comision = p_com where ID_Comision = id_com and Activo = 1;
    
END

-- M Funcion ---
/***************/
CREATE  PROCEDURE `Insertar_Funcion`(in Idcomin bigint, IN pacadena TEXT, IN datost INT)
BEGIN
  Declare p_idcom int default Idcomin;
  DECLARE p_cadena  TEXT default pacadena;
  DECLARE p_funcion varchar(1000);
  DECLARE delimitador CHAR(1) DEFAULT ',';
  DECLARE contador INT DEFAULT 1;
  Declare idsfuncion int;
  
    WHILE contador <= datost DO
    SET p_funcion = TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p_cadena, delimitador, contador), delimitador, -1));
    INSERT INTO funcion (Descripcion, Activo) VALUES (p_funcion, 1);
    SET idsfuncion = LAST_INSERT_ID();
    INSERT INTO funcion_comision (ID_Comision, ID_Funcion,Activo) VALUES (p_idcom, idsfuncion,1);
    SET contador = contador + 1;
  END WHILE;
  
END
/**************/
CREATE  PROCEDURE `Actualizar_Funcion`(in idfuncion bigint, in nfuncion varchar(1000) )
BEGIN
	declare id_fun bigint default idfuncion;
	declare p_fun varchar(1000) default (trim(nfuncion));
    
    UPDATE funcion set Descripcion = p_fun where ID_Funcion = id_fun and Activo = 1;
    
END
/**************/
CREATE  PROCEDURE `Eliminar_Funcion`(in idfuncion bigint )
BEGIN
	declare id_fun bigint default idfuncion;
	
    
    UPDATE funcion set Activo = 0 where ID_Funcion = id_fun;
    
    UPDATE funcion_comision set Activo = 0 where ID_Funcion = id_fun;
    
END

--  PlanificacionE --
/****************/

CREATE  PROCEDURE `Lista_Comision`()
BEGIN
	select concat ('<option value ="',ID_Comision,'"','>',Nombre_Comision,'</option>')
    from comision
    where Activo = 1
    order by ID_Comision;
END

/****************/

CREATE PROCEDURE `Lista_ComisionSeleccionada`(in idcomi bigint)
BEGIN
	select concat ('<option value ="',ID_Comision,'"',if(ID_Comision = idcomi, 'selected',''),'>',Nombre_Comision,'</option>')
    from comision
    where Activo = 1
    order by ID_Comision;
END

/****************/
-- REEMPLAZAR/ELIMINAR  el procedimiento llamado "Lista_FuncionSegunComision_1" ya que este nuevo cumple esa funcion ---
CREATE  PROCEDURE `Lista_FuncionSegunComision2`(in IdComision bigint)
BEGIN

Declare p_idcom bigint default IdComision;

SET @REG=0;
Select  concat('<tr><td id="Anchio"><input hidden value = "',f.ID_Funcion,'"></td><td class="orden">',@REG:= @REG+1,'</td><td>',f.Descripcion,'</td><td><button  type="button" id="BtnEliminarFuncion" class="btn btn-light" onclick="eliminarFuncionF()" >Eliminar Funcion</button></td></tr>')
     from funcion_comision fc
     inner join funcion f  on fc.ID_Funcion = f.ID_Funcion
     inner join comision c on fc.ID_Comision = c.ID_Comision
    where f.Activo = 1 and c.Activo
    AND (c.ID_Comision = p_idcom)
    order by ID_Funcion_Comision;
END

/***************/

CREATE PROCEDURE `Lista_PersonalAcemico`()
BEGIN
select DISTINCT concat ('<option value ="',P.ID_Persona,'"','>',P.Primer_Nombre,' ',P.Segundo_Nombre,' ',P.Primer_Apellido,' ',P.Segundo_Apellido,'</option>')
     from personal_academico PA 
     inner join persona_usuario PU  on PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
     inner join Persona P on P.ID_Persona = PU.ID_Persona
    where PA.Activo = 1 and PU.Activo = 1 and pu.ID_Tipo_Usuario in (3,4) AND P.Activo = 1
	order by P.Primer_Nombre,P.Primer_Apellido;

END

/***************/
CREATE DEFINER=`` PROCEDURE `Obtener_NombrePAcademico`(in Id_persona bigint)
BEGIN

Declare p_idper bigint default Id_persona;

SET @REG=0;
Select DISTINCT concat('<tr><td id="Anchio"><input hidden value = "',P.ID_Persona,'"></td><td class="ordenIn">',@REG:= @REG+1,'</td><td>', P.Primer_Nombre,' ',P.Segundo_Nombre,
' ',P.Primer_Apellido,' ',P.Segundo_Apellido,'</td><td><button  type="button"  class="btn btn-light" onclick="eliminarFila(this)" >Eliminar Integrante</button></td></tr>')

     from personal_academico PA 
     inner join persona_usuario PU  on PA.ID_Persona_Usuario = PU.ID_Persona_Usuario
     inner join Persona P on  P.ID_Persona = PU.ID_Persona
    where  PA.Activo = 1 and PU.Activo = 1 AND P.Activo = 1
    AND (P.ID_Persona = p_idper);

END

/******************/

-- Funciones implementadas en el Procedimiento "Agregar_ComisionEventro" --
/*******************/
CREATE FUNCTION `Obtener_EventoActual`() RETURNS int(11)
BEGIN
    DECLARE idEvento INT;
    SELECT ID_Evento INTO idEvento FROM evento WHERE Activo=1 AND YEAR(Fecha) = YEAR(CURDATE());
    RETURN idEvento;
END

/*******************/
CREATE FUNCTION `Obtener_IdPA`(id_per bigint) RETURNS int(11)
BEGIN
    DECLARE id_pa int;
    SELECT pa.Id_Personal_Academico INTO id_pa
    FROM personal_academico pa 
    INNER JOIN persona_usuario pu ON pu.ID_Persona_Usuario = pa.ID_Persona_Usuario
    INNER JOIN persona p ON p.ID_Persona = pu.Id_Persona
    WHERE pa.Activo = 1 AND pu.Activo = 1 AND pu.ID_Tipo_Usuario IN (3,4) AND p.Activo = 1 AND p.ID_Persona = id_per;
    RETURN id_pa;
END
/*******************/


CREATE PROCEDURE `Agregar_ComisionEvento`(in IdCom bigint,in Responsable1 bigint, in Responsable2 bigint, in Responsable3 bigint, in Integrantes text, in ContINT bigint)
BEGIN

  Declare p_idcom int default IdCom;
  DECLARE int_resp1 int default Responsable1;
  DECLARE int_resp2 int default Responsable2;
  DECLARE int_resp3 int default Responsable3;
  DECLARE p_cadint  TEXT default Integrantes;
  DECLARE p_integrante int;
  DECLARE delimitador CHAR(1) DEFAULT ',';
  DECLARE contador INT DEFAULT 1;
  Declare idsintegrante int;
  Declare idEvento int;
  Declare idpaca1 int;
  Declare idpaca2 int;
  Declare idpaca3 int;
  Declare idpa int;
  Declare lastIdCE int;
  
  SET idEvento = Obtener_EventoActual();
  
  Insert into comision_evento (ID_Evento,ID_Comision,Activo) values (idEvento,p_idcom,1);
  SET lastIdCE = LAST_INSERT_ID();
  
  IF int_resp1 IS NOT NULL THEN
    Set idpaca1 = Obtener_IdPA(int_resp1);
    INSERT INTO integrante_comision (ID_Personal_Academico,ID_Comision_Evento,Responsable,Activo) VALUES (idpaca1,lastIdCE,1, 1);
  END IF;
  
  IF int_resp2 IS NOT NULL THEN
    Set idpaca2 = Obtener_IdPA(int_resp2);
    INSERT INTO integrante_comision (ID_Personal_Academico,ID_Comision_Evento,Responsable,Activo) VALUES (idpaca2,lastIdCE,2, 1);
  END IF;
  
   IF int_resp3 IS NOT NULL THEN
    Set idpaca3 = Obtener_IdPA(int_resp3);
      INSERT INTO integrante_comision (ID_Personal_Academico,ID_Comision_Evento,Responsable,Activo) VALUES (idpaca3,lastIdCE,3, 1);
  END IF;
  

  WHILE contador <= ContINT DO
    SET p_integrante = TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p_cadint, delimitador, contador), delimitador, -1));
    Set idpa = Obtener_IdPA(p_integrante);
    INSERT INTO integrante_comision (ID_Personal_Academico,ID_Comision_Evento,Responsable,Activo) VALUES (idpa,lastIdCE,0, 1);
    
    
    SET contador = contador + 1;
  END WHILE;
	
  

END