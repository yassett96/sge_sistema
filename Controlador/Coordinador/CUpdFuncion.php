<?php

require_once ("../../Modelo/Coordinador/MFuncion.php");


$MFun = new ModalFunciones();

$Idfuncion=  $_POST['IdFuncion'];
$UpdaFuncion = $_POST['NombreFuncion'];

    $result = $MFun->get_Actualizar_funcion($Idfuncion,$UpdaFuncion);

    echo $result;

?>