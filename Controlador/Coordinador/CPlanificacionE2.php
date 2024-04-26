<?php

require_once ("../../Modelo/Coordinador/PlanificacionE.php");

$PlanE2 = new PlanificacionEM();

$IdCom = $_POST['IdComision'];
$Responsable1 = $_POST['Resp1'];
$Responsable2 = $_POST['Resp2'];
$Responsable3 = $_POST['Resp3'];
$Integrantes = $_POST['Integrantes'];
$ContINT = $_POST['conINT'];

$result = $PlanE2->get_insertar_ComisionE($IdCom,$Responsable1,$Responsable2,$Responsable3,$Integrantes,$ContINT);
echo $result;
?>