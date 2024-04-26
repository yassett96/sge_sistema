<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();


if(isset($_POST['IntegranteCom']) and !empty ($_POST['IntegranteCom'])){


$IDComisionApoyo = $_POST['IntegranteCom'];

$result = $MCAsignada->Agregar_ComisionTableApoyo($IDComisionApoyo);

echo $result;

//$json = json_encode($result);
//echo $json;
}


?>