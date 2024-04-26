<?php

require_once ("../../Modelo/Coordinador/PlanificacionE.php");

$PlanE1 = new PlanificacionEM();

$NLugar =  $_POST['NomLugar'];
$contador = $_POST['Contador'];
$Salones= $_POST['Salones'];

    $result = $PlanE1->get_Insertar_NLugar($NLugar,$Salones,$contador);

    echo $result;

?>
