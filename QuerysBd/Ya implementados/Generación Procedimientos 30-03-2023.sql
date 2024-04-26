-- Procedimientos nuevos 30/03/2023
CREATE DEFINER=`root`@`localhost` PROCEDURE `Obtener_GrupoSegunIdGrupo`(
In id_grupo bigint(20)
)
Begin
	Declare vlocIdGrupo bigint(20);
    Declare vlocGrupo varchar(10) Default '';
    
    Set vlocIdGrupo = id_grupo;
    Set vlocGrupo = (Select g.Grupo From Grupo g Where g.ID_Grupo = vlocIdGrupo);
    
    select vlocGrupo;
    
End