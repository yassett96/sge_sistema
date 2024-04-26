<?php

require_once ("../../Modelo/Coordinador/MEvento_Coordinador.php");
require_once ("../../Assets/AuxiliarPhp/helperPhp.php");
require_once ("../../Assets/AuxiliarPhp/Constants.php");


    $modelf = new MEvento_Coordinador();
    
    $datose = $modelf->Mostrar_UltimoE();    
    $datosu = mysqli_fetch_array($datose);

    $id = $datosu['ID_Evento'];
    $datospc = $modelf->Mostrar_UltimosProyecto($id);

    $datosc = $modelf->Mostrar_Cat_UltimoE($id);
    
    function FunVerificarExistenciaEventoSegunAñoActual(){
        $modelevento = new MEvento_Coordinador();
        $vlocHelperPhp = new helperPhp();
        $vlocDateAñoActual = $vlocHelperPhp -> funcObtenerAñoActual();
        $vlocVerificacionExistencia = $modelevento -> FunVerificarExistenciaEventoSegunAñoActual($vlocDateAñoActual);        

        return $vlocVerificacionExistencia;
    }
    function FunObtenerDiaEventoActual(){
        $modeloEvento = new MEvento_Coordinador();
        $vlocHelperPhp = new helperPhp();
        $vlocDateAñoActual = $vlocHelperPhp->funcObtenerAñoActual();
        
        $vlocResult = $modeloEvento -> get_date_event($vlocDateAñoActual);

        $vlocResultColumnaFecha = $vlocResult->fetch_array(MYSQLI_BOTH)[0];
        $vlocStrDiaFecha = $vlocHelperPhp -> FunExtraerDiaDeFecha($vlocResultColumnaFecha);                

        return $vlocStrDiaFecha;
    }

?>