<?php
require_once ("../../Modelo/Coordinador/PlanificacionE.php");

$PlanDG = new PlanificacionEM();

$idcom = $_POST['IdComision'];

$ComisionList = $PlanDG->select_comision_Seleccionada($idcom);
echo $ComisionList;

?>