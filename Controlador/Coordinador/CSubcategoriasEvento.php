<?php

require_once ("../../Modelo/Coordinador/MJurado.php");

$PlanE5 = new MJUrado();

$Id_CategoriE = $_POST['ID_Cate'];
   

    $result = $PlanE5->select_SubcategoriaE($Id_CategoriE);

    if ($result === null || empty($result)){
        $result= '<option hidden selected value="0">No Hay Subcategorias Disponibles</option>';
    }

    echo $result;

?>
