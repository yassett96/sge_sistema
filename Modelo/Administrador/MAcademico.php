<?php

require_once ("../../Modelo/General/Conexionbd.php");

class AcaModelo{

    public function get_persona_insert_Aca($pnombre,$snombre,$papellido,$sapellido,$tel,$correo,$idtipou,$user,$passmod,$cedula,$target_path,$gradoA,$cargo,$sede)
    {
        $insertp = '';
        $query = "CAll Insercion_PersonaAcademica('$pnombre','$snombre','$papellido','$sapellido','$tel','$correo','$idtipou','$user','$passmod','$cedula','$target_path',$gradoA,$cargo,$sede);";        
       
        // echo $query;
        // exit;
       
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

    public function put_buscar_registros_aca($tel,$correo,$user)
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
                        $return = "Lo sentimo, este Teléfono ya se encuentra registrado, intenta con otro";
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
                        $return = "Lo sentimo, este Correo ya se encuentra registrado, intenta con otro";
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
                        $return = "Lo sentimo, este usuario ya se encuentra registrado, intenta con otro";
                        }
                    $mysqli->close();
                }
                
            }
        }
        return $return;
    }

 
}
