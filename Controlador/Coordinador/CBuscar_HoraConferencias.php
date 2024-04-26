<?php
require_once ("../../Modelo/Coordinador/MConferencia.php");


$PlanE4 = new MConferencia();

$HoraI = $_POST['H_IncioC'];
$HoraF = $_POST['H_FinalC'];
$IDSitio = $_POST['IdSalonCF'];

$result = $PlanE4->get_BuscarCoincidenciasHoraConf($HoraI,$HoraF,$IDSitio);
echo $result;



?>