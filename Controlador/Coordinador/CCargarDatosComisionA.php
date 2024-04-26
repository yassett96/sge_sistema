<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$Id_ComisionAsigSelecc = $_POST['ComisionASel'];
//$DatosGEA = $MCAsignada->ObtenerComisionAsignada_Persona($idpersona);


   

    $result = $MCAsignada->ObtenerR1ComisionAsignada($Id_ComisionAsigSelecc);
    /*$result = $MCAsignada->ObtenerResponsableComision($Id_ComisionAsigSelecc);*/

    echo $result;

?>