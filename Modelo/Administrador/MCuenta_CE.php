<?php

require_once ("../../Modelo/General/Conexionbd.php");

class MEvento{

    public function FunVerificarExistenciaEventoSegunAñoActual($vparDateAñoActual){
        $vlocIntVerificacion = "";
        $query = "Call Verificar_ExistenciaEventoFeriaSegunAño(".$vparDateAñoActual.");";
        $mysqli = Conexiondatabase::ConexionSecurity();
        $vlocResult = $mysqli->query($query);
        
        if(!$vlocResult)
            $vlocIntVerificacion = $mysqli->error;
        
        $vlocResultRow = $vlocResult->fetch_array(MYSQLI_BOTH)[0];
        
        $mysqli->close();
        return $vlocResultRow;
    }
}

?>
