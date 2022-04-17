<?php

require_once ("../Conexionbd.php");


class MInicio_sesion{

   
    public function ConsultarUsuario($usuario,$password){
        $mysqli= Conexionbasedatos::ConexionSecurity();
        $query = "SELECT * FROM persona WHERE Usuario = '$usuario' AND Contraseña = '$password'";
        $consulta = $mysqli->query($query);
        return $consulta;
    }

}

?>