<?php

require_once ("../../Modelo/Coordinador/MCategoria.php");

$PlanE3 = new MCategoria();

$Id_Categoria = $_POST['Categoria'];


   

    $result = $PlanE3->lista_subcategoria_categoria($Id_Categoria);

    echo $result;

?>