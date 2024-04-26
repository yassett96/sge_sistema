<?php

require_once ("../../Modelo/General/Conexionbd.php");

class MHistorial{

    public function ConsultarEventosParticipados($id){
        
        $query = "Call Mostrar_Historial_Participante($id);";
        $mysqli= Conexiondatabase::ConexionSecurity();
        $consulta = $mysqli->query($query);
        return $consulta;
    }
}


?>