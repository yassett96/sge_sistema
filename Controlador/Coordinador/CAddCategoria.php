<?php

require_once ("../../Modelo/Coordinador/MCategoria.php");


$PlanE3 = new MCategoria();

$Ncat=  $_POST['NuevaCategoria'];

    $result = $PlanE3->get_insertar_categoria($Ncat);

    echo $result;

?>
