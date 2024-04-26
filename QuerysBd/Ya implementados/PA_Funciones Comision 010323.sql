CREATE  PROCEDURE `Lista_FuncionSegunComision_1`(in IdComision bigint)
BEGIN
/*Selec normal*/
Declare p_idcom bigint default IdComision;



select f.ID_Funcion,f.Descripcion
     from funcion_comision fc
     inner join funcion f  on fc.ID_Funcion = f.ID_Funcion
     inner join comision c on fc.ID_Comision = c.ID_Comision
    where f.Activo = 1 and c.Activo
    AND (c.ID_Comision = p_idcom)
    order by ID_Funcion_Comision;

END
-----------
CREATE DEFINER=`` PROCEDURE `Lista_FuncionSegunComision`(in IdComision bigint)
BEGIN
/*Select imprime en tabla*/
Declare p_idcom bigint default IdComision;
/*Select concat('<tr><td><input hidden value = "',f.ID_Funcion,'"','></td><td>',f.Descripcion,'</td><tr>')*/
Select concat('<tr><td>',f.ID_Funcion,'</td><td>',f.Descripcion,'</td></tr>')
     from funcion_comision fc
     inner join funcion f  on fc.ID_Funcion = f.ID_Funcion
     inner join comision c on fc.ID_Comision = c.ID_Comision
    where f.Activo = 1 and c.Activo
    AND (c.ID_Comision = p_idcom)
    order by ID_Funcion_Comision;

END

------------------
CREATE PROCEDURE `Lista_Comision`()
BEGIN
	select concat ('<option value ="',ID_Comision,'"','>',Nombre_Comision,'</option>')
    from comision
    where Activo = 1
    order by ID_Comision;
END


