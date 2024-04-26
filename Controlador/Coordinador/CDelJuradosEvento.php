<?php

require_once ("../../Modelo/Coordinador/MJurado.php");

$PlanE5 = new MJUrado();

$idSubcateJE =  $_POST['Id_SubCateJ'];


    $result = $PlanE5->get_Eliminar_JuradoE($idSubcateJE);

    echo $result;

?>