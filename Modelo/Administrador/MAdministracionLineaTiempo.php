<?php

require_once("../../Modelo/General/Conexionbd.php");
require_once("../../Assets/AuxiliarPhp/helperPhp.php");
require_once("../../Assets/AuxiliarPhp/Constants.php");

Class AdministracionLineaTiempo{

    public function FunObtenerListaEnlacesLineaTiempo(){
        $vlocObtencionEnlaces = '';
        $vlocQuery = "Call Obtener_EnlacesLineaTiempo();";
        // echo $vlocQuery;
        // exit;
        $vlocMySqli = Conexiondatabase::ConexionSecurity();
        $vlocResult = $vlocMySqli->query($vlocQuery);

        if(!$vlocResult){
            $vlocObtencionEnlaces = $vlocMySqli->error;
        }else{
            $vlocObtencionEnlaces = $vlocResult;
        } 
        
        return $vlocObtencionEnlaces;
    }

    public function FunEditarEnlacesLineaTiempo($vparIdEnlaceLineaTiempo, $vparFase, $vparEnlace){
        $vlocEditar = '';
        $vlocQuery = "Call Editar_EnlacesLineaTiempo(".$vparIdEnlaceLineaTiempo.",'".$vparFase."','".$vparEnlace."');";
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

    public function FunAgregarEnlace($vparIdEnlaceLineaTiempo, $vparFaseAgregar, $vparEnlaceAgregar){
        $vlocEditar = '';
        $vlocQuery = "Call Insertar_EnlaceLineaTiempo(".$vparIdEnlaceLineaTiempo.",'".$vparFaseAgregar."','".$vparEnlaceAgregar."');";
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

    public function FunEliminarEnlaceLineaTiempo(){
        $vlocEditar = '';
        $vlocQuery = "Call Eliminar_UltimaFaseLineaTiempo();";
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