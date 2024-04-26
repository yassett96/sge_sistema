<?php

require_once ("../../Modelo/Coordinador/PlanificacionE.php");

$PlanE2 = new PlanificacionEM();

$Id_Comision = /*'';*/ $_POST['ComisionE'];

/*if(isset($_POST['ComisionE']) and !empty ($_POST['ComisionE']))

    $Id_Comision = $_POST['ComisionE'];*/

   

    $result = $PlanE2->lista_funcioncomision($Id_Comision);

    echo $result;

?>
