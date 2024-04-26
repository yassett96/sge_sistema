<?php
require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$IdEstado=  $_POST['Id_EstadoA'];
$idComA = $_POST['ID_ComA'];


    $result = $MCAsignada->ActualizarEstado_Actividad($IdEstado,$idComA);

    echo $result;

?>