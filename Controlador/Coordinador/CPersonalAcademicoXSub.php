<?php

require_once ("../../Modelo/Coordinador/MJurado.php");

$PlanE5 = new MJUrado();

$Id_SubCategoriE = $_POST['ID_SubCate'];
   

    $result = $PlanE5->Listar_PAcademicoXSub($Id_SubCategoriE);
    $result1 ='<option hidden selected value="0">Seleccione al que será jurado 1</option>'.$result;


    echo $result1;

?>