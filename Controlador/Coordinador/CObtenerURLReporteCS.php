<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$Id_ComisionAsigSelecc = $_POST['ComisionASel'];

   

    $result = $MCAsignada->ObtenerURLReporte($Id_ComisionAsigSelecc);


    echo $result;

?>