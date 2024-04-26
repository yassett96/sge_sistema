DELIMITER //
Create Procedure Obtener_DireccionLogoEsloganEventoActual()
Begin

	Select e.Logo, e.Eslogan From Evento e Where Year(e.Fecha) = Year(Now()) And e.Fecha = (Select Min(ee.Fecha) From Evento ee Where ee.ID_Tipo_Evento = 1 and ee.Activo = 1 And ee.Fecha != '0000-00-00' And Year(ee.Fecha) = year(now())) And e.Activo = 1;

End;