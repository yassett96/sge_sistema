<?php

require_once ("../../Modelo/Coordinador/MFuncion.php");


$MFun = new ModalFunciones();

$Idfuncion=  $_POST['IdFuncion'];


    $result = $MFun->get_Eliminar_funcion($Idfuncion);

    echo $result;

?>