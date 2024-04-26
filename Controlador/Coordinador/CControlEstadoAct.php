<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();


$IdComAsig = $_POST['Id_ComAsig'];

$result = $MCAsignada->ValidarestadoActividad($IdComAsig);

echo $result;



?>