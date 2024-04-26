<?php

require_once ("../../Modelo/Coordinador/MCategoria.php");


$PlanE3 = new MCategoria();

$IdCE =  $_POST['IdCatEvento'];


    $result = $PlanE3->get_Eliminar_CategoriaE($IdCE);

    echo $result;

?>