<?php

require_once ("../../Modelo/Coordinador/MCategoria.php");


$PlanE3 = new MCategoria();
$Ncategoria=  $_POST['IDCategoria'];
$UpdaCategoria = $_POST['UpdaCat'];

    $result = $PlanE3->get_Actualizar_categoria($Ncategoria,$UpdaCategoria);
    

    echo $result;

?>