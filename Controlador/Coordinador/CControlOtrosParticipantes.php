<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();


if(isset($_POST['IntegranteApoyo']) and !empty ($_POST['IntegranteApoyo'])){


$IDPersonaParticipante = $_POST['IntegranteApoyo'];

$result = $MCAsignada->Agregar_Tabla_OtrosParticipantesA($IDPersonaParticipante);

echo $result;

}


?>