<?php

require_once ("../../Modelo/Coordinador/MJurado.php");

$PlanE5 = new MJUrado();

$Id_SubCategoriE = $_POST['ID_SubCate'];
$Id_PAJ1 = $_POST['ID_paj1'];
$Id_PAJ2 = $_POST['ID_paj2'];
   

    $result = $PlanE5->Listar_PAcademicoXSubJ3($Id_SubCategoriE,$Id_PAJ1,$Id_PAJ2);
    $result3 ='<option hidden selected value="0">Seleccione al que será jurado 3</option>'.$result;


    echo $result3;

?>