<?php
require_once ("../../Modelo/Coordinador/MJurado.php");

$PlanE5 = new MJUrado();

$Idcri =  $_POST['Id_Criterio'];
$idformat =  $_POST['Id_TFormato'];


    $result = $PlanE5->get_Eliminar_Criterio($Idcri,$idformat);

    echo $result;

?>