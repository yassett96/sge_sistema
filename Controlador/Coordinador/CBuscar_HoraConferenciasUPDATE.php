<?php
require_once ("../../Modelo/Coordinador/MConferencia.php");


$PlanE4 = new MConferencia();

$HoraI = $_POST['H_IncioC'];
$HoraF = $_POST['H_FinalC'];
$IDSitio = $_POST['IdSalonCF'];
$ID_ConfEA = $_POST['ID_ConEA'];

$result = $PlanE4->get_BuscarCoincidenciasHoraConfUPDATE($HoraI,$HoraF,$IDSitio,$ID_ConfEA);
echo $result;



?>