<?php

require_once ("../../Modelo/Coordinador/MJurado.php");

$PlanE5 = new MJUrado();

$Id_Formato = $_POST['ID_TipoFormat'];


   

    $result = $PlanE5->lista_CriterioFormato($Id_Formato);

    echo $result;

?>