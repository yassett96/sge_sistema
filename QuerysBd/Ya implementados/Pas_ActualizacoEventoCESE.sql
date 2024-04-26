/******************/

CREATE  PROCEDURE `Mostrar_Proyecto_Categoria1`()
BEGIN    

Declare idEvento int;
SET idEvento = Obtener_EventoActual();

select c.Nombre_Categoria, count(p.ID_Proyecto) as Proyectos 
from proyecto as p
    inner join subcategoria as s on s.ID_Subcategoria = p.ID_Subcategoria
	inner join categoria_subcategoria as cs on cs.ID_SubCategoria = s.ID_SubCategoria
    inner join categoria as c on c.ID_Categoria = cs.ID_Categoria
	inner join evento_proyecto as ep on ep.ID_Proyecto = p.ID_Proyecto
	where ep.ID_Evento = idEvento
	and ep.Activo= 1 
	group by c.ID_Categoria;

END

/*******************/

CREATE  PROCEDURE `Mostrar_Cat_Subcategoria1`()
BEGIN
Declare idEvento int;
SET idEvento = Obtener_EventoActual();
	
select distinct c.Nombre_Categoria, group_concat(s.Nombre_SubCategoria, '<br>' separator'') as subcategoria 

from categoria_evento as ce
    
	inner join categoria_subcategoria as cs on cs.ID_Categoria = ce.ID_Categoria
	inner join categoria as c on c.ID_Categoria = cs.ID_Categoria
	inner join subcategoria as s on s.ID_SubCategoria = cs.ID_SubCategoria
	inner join evento as e on e.ID_Evento = ce.ID_Evento 
    where e.Id_Evento = idEvento
	and ce.Activo = 1 and cs.Activo = 1 and c.Activo = 1 and s.Activo = 1 
	group by c.Nombre_Categoria;

END

/***********************************/

CREATE  PROCEDURE `Mostrar_Ultimo_Proyecto_Cat1`(id bigint(20))
BEGIN


declare id_e bigint(20) default id;

    
select c.Nombre_Categoria, count(p.ID_Proyecto) as Proyectos 
from proyecto as p
    inner join subcategoria as s on s.ID_Subcategoria = p.ID_Subcategoria
	inner join categoria_subcategoria as cs on cs.ID_SubCategoria = s.ID_SubCategoria
    inner join categoria as c on c.ID_Categoria = cs.ID_Categoria
	inner join evento_proyecto as ep on ep.ID_Proyecto = p.ID_Proyecto
	where ep.ID_Evento = id_e
	and ep.Activo= 0
	group by c.ID_Categoria;
END

/*******************/
CREATE  PROCEDURE `Mostrar_CatS_UE1`(idf bigint(20))
BEGIN    

declare id_uf bigint(20) default idf;    

select distinct c.Nombre_Categoria, group_concat(s.Nombre_SubCategoria, '<br>' separator'') as subcategoria 

from categoria_evento as ce
    
	inner join categoria_subcategoria as cs on cs.ID_Categoria = ce.ID_Categoria
	inner join categoria as c on c.ID_Categoria = cs.ID_Categoria
	inner join subcategoria as s on s.ID_SubCategoria = cs.ID_SubCategoria
	inner join evento as e on e.ID_Evento = ce.ID_Evento 
    where e.Id_Evento = id_uf
	and ce.Activo = 0 and cs.Activo = 1 and c.Activo = 1 and s.Activo = 1 
	group by c.Nombre_Categoria;

END