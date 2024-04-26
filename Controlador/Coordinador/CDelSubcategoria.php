<?php

require_once ("../../Modelo/Coordinador/MCategoria.php");


$PlanE3 = new MCategoria();

$Idsub =  $_POST['IdSubcategoria'];


    $result = $PlanE3->get_Eliminar_Subcategoria($Idsub);

    echo $result;

?>