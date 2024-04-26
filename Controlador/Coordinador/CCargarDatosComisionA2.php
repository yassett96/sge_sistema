<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$Id_ComisionAsigSelecc = $_POST['ComisionASel'];
//$DatosGEA = $MCAsignada->ObtenerComisionAsignada_Persona($idpersona);


   

    $result = $MCAsignada->ObtenerR2ComisionAsignada($Id_ComisionAsigSelecc);

    if($result == ''){
        $result = 'No Asignado';
    }

    echo $result;

?>