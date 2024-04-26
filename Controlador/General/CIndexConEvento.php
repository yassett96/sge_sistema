<?php 
require_once ("../../Modelo/General/MIndexConEvento.php");


function FunObtenerDireccionLogoEsloganEventoActual(){
    $modeloIndexConEvento = new IndexConEventoModelo();

    $vlocResult = $modeloIndexConEvento->FunObtenerDireccionLogoEsloganEventoActual();
    
    if($vlocResult == true){
        return $vlocResult;
    }
    else{
        echo "<script>alert('Error al obtener el logo');</script>";
    }
}
?>