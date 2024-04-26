<?php

require_once("../../Modelo/General/Conexionbd.php");
require_once("../../Assets/AuxiliarPhp/helperPhp.php");
require_once("../../Assets/AuxiliarPhp/Constants.php");

Class AdministracionCarruselInicio{

    public function FunObtenerListaImagenesCarruselEvento(){
        $vlocObtencionLista = '';
        $vlocQuery = "Call Obtener_InformacionImagenesCarruselEvento();";
        // echo $vlocQuery;
        // exit;
        $vlocMySqli = Conexiondatabase::ConexionSecurity();
        $vlocResult = $vlocMySqli->query($vlocQuery);

        if(!$vlocResult){
            $vlocObtencionLista = $vlocMySqli->error;
        }else{
            $vlocObtencionLista = $vlocResult;
        } 
        
        return $vlocObtencionLista;
    }

    public function FunModificarImagenCarruselEvento($vparIdImagen, $vparDescripcion, $vparImagen){
        $vlocEditar = '';
        $vlocQuery = "Call Modificar_ImagenCarrusel(".$vparIdImagen.",'".$vparDescripcion."','".$vparImagen."');";
        // echo $vlocQuery;
        // exit;
        $vlocMySqli = Conexiondatabase::ConexionSecurity();
        $vlocResult = $vlocMySqli->query($vlocQuery);

        if(!$vlocResult)
            $vlocEditar = $vlocMySqli->error;
        else
            $vlocEditar = $vlocResult;

        return $vlocEditar;
    }

}

?>