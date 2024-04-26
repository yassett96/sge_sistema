<?php

require_once ("../../Modelo/General/Conexionbd.php");

class IndexConEventoModelo{

    public function FunObtenerDireccionLogoEsloganEventoActual()
    {
        $vlocDireccionLogo = '';
        $vlocQuery = "CAll Obtener_DireccionLogoEsloganEventoActual();";
        $vlocMySqli= Conexiondatabase::ConexionSecurity();
        $vlocResult = $vlocMySqli->query($vlocQuery);

        if($vlocResult){
            $vlocDireccionLogo = $vlocResult->fetch_array();
        }
           
        $vlocMySqli->close();
        return $vlocDireccionLogo;
    }
}

?>