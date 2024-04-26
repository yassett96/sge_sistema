<?php

require_once("../../Modelo/General/Conexionbd.php");
require_once("../../Assets/AuxiliarPhp/helperPhp.php");
require_once("../../Assets/AuxiliarPhp/Constants.php");

Class AdministracionSeccionNoticiasModelo{

    public function FunObtenerListaNoticias(){
        $vlocObtencionLista = '';
        $vlocQuery = "Call Obtener_InformacionNoticias();";
        
        $vlocMySqli = Conexiondatabase::ConexionSecurity();
        $vlocResult = $vlocMySqli->query($vlocQuery);

        if(!$vlocResult){
            $vlocObtencionLista = $vlocMySqli->error;
        }else{
            $vlocObtencionLista = $vlocResult;
        } 
        
        return $vlocObtencionLista;
    }

    public function FunModificarNoticias($vparIdNoticias, $vparDescripcion, $vparImagen){
        $vlocEditar = '';
        $vlocQuery = "Call Modificar_Noticia(".$vparIdNoticias.",'".$vparDescripcion."','".$vparImagen."');";
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