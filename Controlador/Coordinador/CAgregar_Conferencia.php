<?php
require_once ("../../Modelo/Coordinador/MConferencia.php");


$PlanE4 = new MConferencia();


$NConferencia=  $_POST['NomConf'];
$NConferencista = $_POST['NombreConfer'];
$DetallesConfer= $_POST['DetConfer'];
$Hora_Inicio= $_POST['HoraI'];
$Hora_Fin= $_POST['HoraF'];
$Salon= $_POST['IdSalon'];

if(isset( $_POST['NombreConfer']) and empty( $_POST['NombreConfer'])) {
    $NConferencista = 'PENDIENTE';
} 

if(isset( $_POST['DetConfer']) and empty( $_POST['DetConfer'])) {
    $DetallesConfer = 'PENDIENTE';
} 
if(isset( $_POST['HoraI']) and empty( $_POST['HoraI'])) {
    $Hora_Inicio= '00:00:00';
} 
if(isset( $_POST['HoraF']) and empty( $_POST['HoraF'])) {
    $Hora_Fin= '00:00:00';
} 


    $result = $PlanE4-> get_insertar_conferencia($NConferencia,$NConferencista,$DetallesConfer,$Hora_Inicio,$Hora_Fin,$Salon);

    echo $result;
 
?>
