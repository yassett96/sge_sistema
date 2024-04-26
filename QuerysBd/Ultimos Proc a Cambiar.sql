-- ==============================================================================================================================================================================
-- Procedimientos a cambiar
-- ==============================================================================================================================================================================
DELIMITER //
CREATE PROCEDURE `Obtener_ListaUsuariosNoAsignadosAPersonaParaSelect`(
	In ID_Persona BigInt
)
Begin    
    SELECT CONCAT('<option value ="',tu.Id_Tipo_Usuario,'"','>',tu.Tipo_Usuario,'</option>')
	FROM tipo_usuario tu
	WHERE tu.Activo = 1 
	AND NOT EXISTS (
	  SELECT 1
	  FROM persona_usuario pu
	  INNER JOIN persona p ON p.ID_Persona = pu.ID_Persona
	  WHERE pu.Id_Tipo_Usuario = tu.Id_Tipo_Usuario
	  AND p.Activo = 1
      AND pu.Activo = 1
	  AND p.ID_Persona = ID_Persona
	)
    AND tu.ID_Tipo_Usuario Not In (1, 2);
End;