<?php

require_once ("../../Modelo/Participante/MEvento_PSE.php");
require_once ("../../Assets/AuxiliarPhp/helperPhp.php");
require_once ("../../Assets/AuxiliarPhp/Constants.php");

    $modelevento = new MEvento_PSE();
    
    $datosp = $modelevento->MostrarProyectos_Cat();
    
    $datose = $modelevento->MostrarEventoF();
    $datosf = mysqli_fetch_array($datose);
    

    $datosc = $modelevento->MostrarCat_Subcategoria();

    function FunVerificarExistenciaEventoSegunAñoActual(){
        $modelevento = new MEvento_PSE();
        $vlocHelperPhp = new helperPhp();
        $vlocDateAñoActual = $vlocHelperPhp -> funcObtenerAñoActual();
        $vlocVerificacionExistencia = $modelevento -> FunVerificarExistenciaEventoSegunAñoActual($vlocDateAñoActual);        

        return $vlocVerificacionExistencia;
    }
    

?>