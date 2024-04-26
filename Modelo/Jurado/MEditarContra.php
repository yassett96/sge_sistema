<?php

require_once ("../../Modelo/General/Conexionbd.php");

class EditarContraAModelo{

    public function ActualizarNuevaContraseña($id_pacademico,$ncontra){
        
        $query = "CALL Actualizar_Contraseña_Participante('$id_pacademico','$ncontra');";         
        $mysqli= Conexiondatabase::ConexionSecurity();
        $consulta = $mysqli->query($query);
        return $consulta;
    }
    
}


?>