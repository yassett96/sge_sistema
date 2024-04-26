DELIMITER //
CREATE PROCEDURE `Obtener_DatosIntegrantesSegunIdProyecto`(
	In Id_Proyecto bigint(20)
)
Begin	
    Declare vlocIdProyecto Bigint(20);	
        
    Set vlocIdProyecto = Id_Proyecto;        
        
		Select per.Primer_Nombre, per.Segundo_Nombre, per.Primer_Apellido, per.Segundo_Apellido, per.Cedula, par.ID_Numero_Carnet, g.grupo, s.Sede
			from Proyecto p
				inner join Participante_Proyecto pp On pp.Id_Proyecto = p.ID_Proyecto
				inner join Participante par on par.ID_Numero_Carnet = pp.Id_Participante
				inner join Persona_Usuario pu on pu.Id_Persona_Usuario = par.Id_Persona_Usuario
				inner join Persona per on per.Id_Persona = pu.Id_Persona
                inner join Grupo g on g.ID_Grupo = par.ID_Grupo
                inner join Sede s on s.ID_Sede = par.ID_Sede
					Where p.Id_Proyecto = vlocIdProyecto;		
End;