<?php

require_once ("../../Modelo/Conexionbd.php");

class PersonaModelo{

    public function get_persona_insert($pnombre,$snombre,$papellido,$sapellido,$tel,$idsede,$correo,$carnet,$user,$pass)
    {
        $insertp = '';
        $query = "CAll InsercionPersona('$pnombre','$snombre','$papellido','$sapellido','$tel','$correo','$idsede','$user','$pass','$carnet');";
        $mysqli= Conexionbasedatos::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result)
            $insertp = $mysqli->error;
        $mysqli->close();
        return $insertp;
    }
}





?>