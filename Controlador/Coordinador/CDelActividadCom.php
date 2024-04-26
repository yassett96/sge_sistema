<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$idComAct =  $_POST['IdActividad'];


    $result = $MCAsignada->get_Eliminar_Actividad($idComAct);

    echo $result;

?>