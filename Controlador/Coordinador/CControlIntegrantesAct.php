<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();


if(isset($_POST['IntegranteC']) and !empty ($_POST['IntegranteC'])){



    $IntegranteC = $_POST['IntegranteC'];

    $result = $MCAsignada->Datos_TablaPAcedemico_A($IntegranteC);

    echo $result;

    //$json = json_encode($result);
    //echo $json;
}

?>

