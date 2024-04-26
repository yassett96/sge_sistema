<?php
require_once ("../../Modelo/Coordinador/MCategoria.php");


$PlanE3 = new MCategoria();

$idcat = $_POST['IdCategoria'];

$Categorialist= $PlanE3->select_categoria_Seleccionada($idcat);
echo $Categorialist;

?>