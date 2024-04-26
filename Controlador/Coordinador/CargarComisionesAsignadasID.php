<?php

require_once ("../../Modelo/Coordinador/MComisionesGenerales.php");

$MCGeneral = new ModComisionGen();

$idpersoona = $_POST['ID_VPer'];
//$DatosGEA = $MCAsignada->ObtenerComisionAsignada_Persona($idpersona);


   

    $result = $MCGeneral->Lista_ComisionAsignada_Persona($idpersoona);

    //echo $result;

    echo implode(',', $result);

?>