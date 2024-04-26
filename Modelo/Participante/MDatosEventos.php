<?php

require_once ("../../Modelo/General/conexionbd.php");

class ModeloDatosEvento{
    public function ListarDatosEventos($idpersonaP){

        $datosE = '';
        
        $query = "Call Prueba_DetEvento($idpersonaP);";

///echo ($query);   
//exit;

        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        if ($result && $result -> num_rows == 1) {
            $datosE = $result->fetch_assoc();


        }
        else { $datosE = NULL; }

        $mysqli->close();
        return $datosE;

    }
}