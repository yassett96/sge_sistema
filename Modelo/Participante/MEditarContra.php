<?php

require_once ("../../Modelo/General/Conexionbd.php");

class EditarContraModelo{

    public function ActualizarNuevaContraseña($id_participante,$ncontra){
        
        $query = "CALL Actualizar_Contraseña_Participante('$id_participante','$ncontra');";         
        $mysqli= Conexiondatabase::ConexionSecurity();
        $consulta = $mysqli->query($query);
        return $consulta;
    }
    
}


?>