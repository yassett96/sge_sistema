<?php

require_once ("../../Modelo/General/MEvento_SR.php");
require_once ("../../Assets/AuxiliarPhp/helperPhp.php");
require_once ("../../Assets/AuxiliarPhp/Constants.php");


    $modelf = new MEvento_SR();
    
    $datose = $modelf->Mostrar_UltimoE();    
    $datosu = mysqli_fetch_array($datose);

    $id = $datosu['ID_Evento'];
    $datospc = $modelf->Mostrar_UltimosProyecto($id);

    $datosc = $modelf->Mostrar_Cat_UltimoE($id);
    
    function FunVerificarExistenciaEventoSegunAñoActual(){
        $modelevento = new MEvento_SR();
        $vlocHelperPhp = new helperPhp();
        $vlocDateAñoActual = $vlocHelperPhp -> funcObtenerAñoActual();
        $vlocVerificacionExistencia = $modelevento -> FunVerificarExistenciaEventoSegunAñoActual($vlocDateAñoActual);        

        return $vlocVerificacionExistencia;
    }

?>