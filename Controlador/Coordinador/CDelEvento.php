<?php
require_once ("../../Modelo/Coordinador/PlanificacionE.php");

$PlanDG = new PlanificacionEM();



    $result = $PlanDG->get_Eliminar_EventoActual();

    echo $result;

?>