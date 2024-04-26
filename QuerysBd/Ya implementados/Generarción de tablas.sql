/*Tabla Participante*/
Create Table Mensaje_Confirmacion_Participante(
ID_Mensaje_Confirmacion_Participante bigint(20) Auto_Increment primary key,
ID_Persona_Inscribiendo bigint(20) Not Null,
ID_Persona_A_Inscribir bigint(20) Not Null,
Fecha_Envio_Codigo Date,
Codigo_Confirmacion char(6),
Constraint FK_Persona_Inscribiendo Foreign Key (ID_Persona_Inscribiendo) References Persona(ID_Persona),
Constraint FK_Persona_A_Inscribir Foreign Key (ID_Persona_A_Inscribir) References Persona(ID_Persona))