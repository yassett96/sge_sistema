<?php

require_once ("../../Modelo/General/Conexionbd.php");

class EditarContraModelo{

    public function ActualizarNuevaContraseña($id_pacademico,$ncontra){
        
        $query = "CALL Actualizar_Contraseña_Participante('$id_pacademico','$ncontra');";   
        //echo ($query);
        //exit;      
        $mysqli= Conexiondatabase::ConexionSecurity();
        $consulta = $mysqli->query($query);
        return $consulta;
    }
    
}


?>