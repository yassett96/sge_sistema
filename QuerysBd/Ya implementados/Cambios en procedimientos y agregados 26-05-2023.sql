-- ================================================================================================================================================
-- Eliminación de registro en Sede 'Invitado UNI (sede)' y cambio a nombre de 'Sede Externo'
Update Sede Set Activo = 0 Where ID_Sede = 6;
Update Sede Set Sede = 'Sede Externo' Where ID_Sede = 7;
-- ================================================================================================================================================
-- Procedimientos a modificar
-- ================================================================================================================================================
DELIMITER //

-- ================================================================================================================================================
-- Procedimientos a agregar
-- ================================================================================================================================================
DELIMITER //
Create Procedure Obtener_NoProyectosInscritosSegunCodRegParticipante(
	In vparCodigoRegistroParticipante int(6)
)
Begin
	Declare vlocCodigoRegistroParticipante int(6);    
    Declare vlocVerificador int(1) Default 0;
        
    Set vlocCodigoRegistroParticipante = vparCodigoRegistroParticipante;
    
    Set vlocVerificador = (
			Select count(*) 
				from Participante p
					inner join participante_proyecto pp on pp.ID_Participante = p.ID_Numero_Carnet
					inner join proyecto pr on pr.ID_Proyecto = pp.ID_Proyecto
                    inner join Evento_Proyecto ep on ep.ID_Proyecto = pr.ID_Proyecto
						Where p.CodigoRegistro = vlocCodigoRegistroParticipante And pp.Activo = 1 And pr.Activo = 1 And ep.Activo = 1
        );
        
	If (vlocVerificador > 0) Then
		Select vlocVerificador As No_Proyectos;
	Else		
		select 0 As No_Proyectos;
    End If;	
    
End;
-- ================================================================================================================================================