-- =======================================================================================================================================
-- Tabla a agregar
-- =======================================================================================================================================
Create Table enlace_linea_tiempo(
	ID_Enlace_Linea_Tiempo Bigint Primary Key Auto_Increment,
	Fase varchar(500),
    Enlace varchar(500),
    Activo int
);
-- =======================================================================================================================================
-- Procedimientos a agregar
-- =======================================================================================================================================
DELIMITER //
Create Procedure Obtener_EnlacesLineaTiempo()
Begin
	Select * From Enlace_Linea_Tiempo elt Where elt.Activo = 1;
End;

Insert Into Enlace_Linea_Tiempo (Fase, Enlace, Activo) Values ('Fase de planeación', 'https://www.facebook.com/photo/?fbid=10158553537861627&set=pcb.10158553538176627', 1);
Insert Into Enlace_Linea_Tiempo (Fase, Enlace, Activo) Values ('Fase de inscripción', 'https://www.facebook.com/photo/?fbid=10158494066511627&set=pcb.10158494066711627', 1);
Insert Into Enlace_Linea_Tiempo (Fase, Enlace, Activo) Values ('Fase de ejecución', 'https://www.facebook.com/photo/?fbid=727284746069088&set=a.456707609793471', 1);
-- =======================================================================================================================================
DELIMITER //
Create Procedure Editar_EnlacesLineaTiempo(
	In id_enlace_linea_tiempo Bigint,
    In fase nvarchar(100),
    In enlace nvarchar(500)
)
Begin

	Update Enlace_Linea_Tiempo elt Set elt.Fase = fase, elt.Enlace = enlace Where elt.ID_Enlace_Linea_Tiempo = id_enlace_linea_tiempo;    
	
	Select 1 As Resultado_Modificacion;
    
End;
-- =======================================================================================================================================
DELIMITER //
Create Procedure Insertar_EnlaceLineaTiempo(
	In id_enlace_linea_tiempo BigInt,
	In fase varchar(100),
    in enlace varchar(500)
)
Begin
	Declare vlocVerificador BigInt Default 0;
    
    Set vlocVerificador = (Select elt.ID_Enlace_Linea_Tiempo From Enlace_Linea_Tiempo elt Where elt.ID_Enlace_Linea_Tiempo = id_enlace_linea_tiempo);

	If vlocVerificador > 0 Then
		Update Enlace_Linea_Tiempo elt Set elt.Fase = fase, elt.Enlace = enlace, elt.Activo = 1 Where elt.ID_Enlace_Linea_Tiempo = id_enlace_linea_tiempo;
        Select 1 As Resultado_Insercion;    
	Else
		Insert Into Enlace_Linea_Tiempo (Fase, Enlace, activo) Values (fase, enlace, 1);
		Select 1 As Resultado_Insercion;    
	End If;
End;
-- =======================================================================================================================================
DELIMITER //
Create Procedure Eliminar_UltimaFaseLineaTiempo()
Begin
	Declare vlocIdUltimoEnlace Bigint;
    
    Set vlocIdUltimoEnlace = (Select elt.ID_Enlace_Linea_Tiempo From enlace_linea_tiempo elt Where elt.Activo = 1 Order By elt.ID_Enlace_Linea_Tiempo Desc Limit 1);
    
    Update enlace_linea_tiempo elt Set elt.Activo = 0 Where elt.ID_Enlace_Linea_Tiempo = vlocIdUltimoEnlace;
    
    Select 1 As Resultado_Eliminacion;
End;
-- =======================================================================================================================================
-- Procedimientos a modificar
-- =======================================================================================================================================
