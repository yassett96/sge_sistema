<?php

require_once ("../../Modelo/Coordinador/MCategoria.php");


$PlanE3 = new MCategoria();

$IdCat = $_POST['idcate'];

$result = $PlanE3->get_insertar_CategoriaE($IdCat);
echo $result;
?>