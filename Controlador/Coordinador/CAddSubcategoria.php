<?php

require_once ("../../Modelo/Coordinador/MCategoria.php");

$PlanE3 = new MCategoria();

$idCate =  $_POST['IdCategoria'];
$contador = $_POST['Contador'];
$Subc= $_POST['Subcategorias'];

    $result = $PlanE3->get_Insertar_Subcategoria($idCate,$Subc,$contador);

    echo $result;

?>
