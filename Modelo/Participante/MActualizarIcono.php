<?php

require_once ("../../Modelo/General/conexionbd.php");

class AvatarModelo{

    public function get_avatar_update($idpersona,$avatar)
    {
        $insertp = '';
        $query = "CAll ActualizarAvatar_PersonaParticipante('$idpersona','$avatar');";        
       
        //echo $query;
        //exit;
       
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result)
            $insertp = $mysqli->error;
        $mysqli->close();
        return $insertp;

        
        

    }

    public function ListarDatosParticipante($idpersonaP){

        $datos = '';

        $query = "Call Cargar_Acceso_Participante($idpersonaP);";

//echo ($query);    
//exit;

        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        if ($result && $result -> num_rows == 1) {
            $datos = $result->fetch_assoc();


        }
        else { $datos = ""; }

        $mysqli->close();
        return $datos;

    }

}
?>