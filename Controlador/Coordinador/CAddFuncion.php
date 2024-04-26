<?php

require_once ("../../Modelo/Coordinador/MFuncion.php");

$MFun = new ModalFunciones();

$idComi=  $_POST['IdComision'];
$contador = $_POST['Contador'];
$Fun= $_POST['Funciones'];

    $result = $MFun->get_insertar_funcion($idComi,$Fun,$contador);

    echo $result;

?>
