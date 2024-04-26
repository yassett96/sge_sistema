<?php

require_once ("../../Modelo/Coordinador/MEvento_Coordinador.php");
require_once ("../../Assets/AuxiliarPhp/helperPhp.php");
require_once ("../../Assets/AuxiliarPhp/Constants.php");

$modelevento = new MEvento_Coordinador();

function FunVerificarExistenciaEventoSegunAñoActual(){
    $modelevento = new MEvento_Coordinador();
    $vlocHelperPhp = new helperPhp();
    $vlocDateAñoActual = $vlocHelperPhp -> funcObtenerAñoActual();
    $vlocVerificacionExistencia = $modelevento -> FunVerificarExistenciaEventoSegunAñoActual($vlocDateAñoActual);        

    return $vlocVerificacionExistencia;
}

?>