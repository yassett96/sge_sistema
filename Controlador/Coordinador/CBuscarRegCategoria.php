<?php
require_once ("../../Modelo/Coordinador/MCategoria.php");


$PlanE3 = new MCategoria();



$ncat = $_POST['NombreCategoria'];

$result = $PlanE3->get_BuscarNCategoria($ncat);
echo $result;



?>