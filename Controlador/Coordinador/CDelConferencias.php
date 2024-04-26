<?php
require_once ("../../Modelo/Coordinador/MConferencia.php");


$PlanE4 = new MConferencia();

$IdConferenciaE = $_POST['ID_Confe'];

$result = $PlanE4->get_Eliminar_ConferenciaE($IdConferenciaE);

echo $result;

?>