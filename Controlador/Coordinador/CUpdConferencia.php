<?php
require_once ("../../Modelo/Coordinador/MConferencia.php");


$PlanE4 = new MConferencia();

$Id_ConfEA = $_POST['ID_ConEA'];
$NConferencia=  $_POST['NomConf'];
$NConferencista = $_POST['NombreConfer'];
$DetallesConfer= $_POST['DetConfer'];
$Hora_Inicio= $_POST['HoraI'];
$Hora_Fin= $_POST['HoraF'];
$Salon= $_POST['IdSalon'];


if(isset( $_POST['HoraI']) and empty( $_POST['HoraI'])) {
    $Hora_Inicio= '00:00:00';
} 
if(isset( $_POST['HoraF']) and empty( $_POST['HoraF'])) {
    $Hora_Fin= '00:00:00';
} 
    $result = $PlanE4->get_Actualizar_Conferencia($Id_ConfEA, $NConferencia,$NConferencista ,$DetallesConfer, $Hora_Inicio, $Hora_Fin, $Salon);
    

    echo $result;

?>