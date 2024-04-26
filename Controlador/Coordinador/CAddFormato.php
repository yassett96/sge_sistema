<?php

require_once ("../../Modelo/Coordinador/MFormato.php");


$ModFormat = new ModalFormato();

$Nformato=  $_POST['NFormato'];

    $result = $ModFormat->get_insertar_formato($Nformato);

    echo $result;

?>