<?php


require_once ("../../Modelo/Coordinador/MCategoria.php");

$PlanE3 = new MCategoria();

$IdSubcate =  $_POST['IdSubcate'];
$UpdaSubc= $_POST['Subcategorias'];
$IDAñoA =  $_POST['IdAñoAca'];

    $result = $PlanE3->get_Actualizar_Subcate($IdSubcate ,$UpdaSubc,$IDAñoA);

    echo $result;

?>