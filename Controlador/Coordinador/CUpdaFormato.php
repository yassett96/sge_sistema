<?php

require_once ("../../Modelo/Coordinador/MFormato.php");


$ModFormat = new ModalFormato();

$Idfor=  $_POST['IdFormato'];
$UpdaFormato = $_POST['UpdaFormato'];

    $result = $ModFormat->get_Actualizar_formato($Idfor,$UpdaFormato);
    

    echo $result;

?>