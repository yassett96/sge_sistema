<?php

require_once ("../../Modelo/General/Conexionbd.php");

class EditarContraAModelo{

    public function ActualizarNuevaContraseña($id_admin,$ncontra){
        
        $query = "CALL Actualizar_Contraseña_Participante('$id_admin','$ncontra');";         
        $mysqli= Conexiondatabase::ConexionSecurity();
        $consulta = $mysqli->query($query);
        return $consulta;
    }
    
}


?>