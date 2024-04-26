<?php

require_once ("../../Modelo/General/Conexionbd.php");

class PersonaModelo{

    public function get_persona_insert($pnombre,$snombre,$papellido,$sapellido,$tel,$correo,$idsede,$idgrupo,$user,$passmod,$carnet,$cedula,$target_path)
    {
        $insertp = '';
        $query = "CAll Insercion_PersonaParticipante('$pnombre','$snombre','$papellido','$sapellido','$tel','$correo','$idsede','$idgrupo','$user','$passmod','$carnet','$cedula','$target_path');";        
       
        //echo ($query);
        //exit;
       
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result){
            $insertp = $mysqli->error;
        }else{
            $insertp = "1";
        }
        $mysqli->close();
        return $insertp;
    }

    public function put_buscar_registros($tel,$correo,$user,$carnet)
    {
        $return ='';

        if($query = "CALL Buscar_Telefono('$tel');");
        {
            $mysqli = Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if($result)
            {
                while($row = $result->fetch_array())
                {
                    if($row[0] > 0)
                        {
                        $return = "Lo sentimos, este Teléfono ya se encuentra registrado, intenta con otro";
                        }
                    $mysqli->close();
                }
                
            }
        }

        if($query = "CALL Buscar_CorreoE('$correo');");
        {
            $mysqli = Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if($result)
            {
                while($row = $result->fetch_array())
                {
                    if($row[0] > 0)
                        {
                        $return = "Lo sentimos, este Correo ya se encuentra registrado, intenta con otro";
                        }
                    $mysqli->close();
                }
                
            }
        }

        if($query = "CALL Buscar_Usuario('$user');");
        {
            $mysqli = Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if($result)
            {
                while($row = $result->fetch_array())
                {
                    if($row[0] > 0)
                        {
                        $return = "Lo sentimos, este usuario ya se encuentra registrado, intenta con otro";
                        }
                    $mysqli->close();
                }
                
            }
        }

        if($query = "CALL Buscar_Carnet('$carnet');");
        {
            $mysqli = Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if($result)
            {
                while($row = $result->fetch_array())
                {
                    if($row[0] > 0)
                        {
                        $return = "Lo sentimos, este carnet ya se encuentra registrado, intenta con otro";
                        }
                    $mysqli->close();
                }
                
            }
        }

        return $return;
    }
}





?>