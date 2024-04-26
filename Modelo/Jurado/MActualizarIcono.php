<?php

require_once ("../../Modelo/General/Conexionbd.php");

class AvatarModelo{

    public function ActualizarAvatar($idpersona,$avatar)
    {
        $insertp = '';
        $query = "CAll ActualizarAvatar_PersonaParticipante('$idpersona','$avatar');";        
       
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result)
            $insertp = $mysqli->error;
        $mysqli->close();
        return $insertp;       

    }

    public function ListarDatosPAcademico($idpersona, $idtusuario){

        $datos = '';

        $query = "Call Cargar_Acceso_PersonaUsuario('$idpersona','$idtusuario');";

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