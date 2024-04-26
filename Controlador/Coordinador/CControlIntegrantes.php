<?php

require_once ("../../Modelo/Coordinador/PlanificacionE.php");

$PlanE2 = new PlanificacionEM();

//$ResponsableC = /*'';*/ $_POST['ResponsableC'];

if(isset($_POST['ResponsableC']) and !empty ($_POST['ResponsableC'])){



    $ResponsableC = $_POST['ResponsableC'];

    $result = $PlanE2->Datos_TablaPAcedemico_Responsable($ResponsableC);

    echo $result;
}


if(isset($_POST['IntegranteC']) and !empty ($_POST['IntegranteC'])){



    $IntegranteC = $_POST['IntegranteC'];

    $result = $PlanE2->Datos_TablaPAcedemico($IntegranteC);

    echo $result;

    //$json = json_encode($result);
    //echo $json;
}



    

?>