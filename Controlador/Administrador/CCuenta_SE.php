<?php

require_once ("../../Modelo/Administrador/MCuenta_CE.php");
require_once ("../../Assets/AuxiliarPhp/helperPhp.php");
require_once ("../../Assets/AuxiliarPhp/Constants.php");

$modelevento = new MEvento();

function FunVerificarExistenciaEventoSegunAñoActual(){
    $modelevento = new MEvento();
    $vlocHelperPhp = new helperPhp();
    $vlocDateAñoActual = $vlocHelperPhp -> funcObtenerAñoActual();
    $vlocVerificacionExistencia = $modelevento -> FunVerificarExistenciaEventoSegunAñoActual($vlocDateAñoActual);        

    return $vlocVerificacionExistencia;
}

?>