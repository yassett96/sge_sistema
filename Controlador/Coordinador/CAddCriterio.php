<?php

require_once ("../../Modelo/Coordinador/MFormato.php");


$ModFormat = new ModalFormato();

$idTFormat=  $_POST['IdTFormato'];
$contador = $_POST['Contador'];
$Cri= $_POST['Criterios'];

    $result = $ModFormat->get_insertar_criterios($idTFormat,$Cri,$contador);

    echo $result;

?>