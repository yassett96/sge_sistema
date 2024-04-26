<?php
require_once ("../../Modelo/Coordinador/PlanificacionE.php");

$PlanDG = new PlanificacionEM();



$Sitiolist = $PlanDG->select_sitio();
echo  $Sitiolist;

?>