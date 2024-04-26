<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$Id_ComisionAsigSelecc = $_POST['ComisionASel'];

   

    $result = $MCAsignada->ObtenerReporteFinalCreado($Id_ComisionAsigSelecc);

    

    echo $result;

?>