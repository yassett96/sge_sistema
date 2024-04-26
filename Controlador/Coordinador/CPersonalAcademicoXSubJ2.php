<?php

require_once ("../../Modelo/Coordinador/MJurado.php");

$PlanE5 = new MJUrado();

$Id_SubCategoriE = $_POST['ID_SubCate'];
$Id_PAJ1 = $_POST['ID_paj1'];
   

    $result = $PlanE5->Listar_PAcademicoXSubJ2($Id_SubCategoriE,$Id_PAJ1);
    $result2 ='<option hidden selected value="0">Seleccione al que será jurado 2</option>'.$result;


    echo $result2;

?>