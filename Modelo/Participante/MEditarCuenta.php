<?php

require_once ("../../Modelo/General/Conexionbd.php");

class EditarCuentaModelo {

    public function ListarGrupo($idsede, $idgrupo){
       
        $data = '';
        $query = "CAll Listar_Grupo_Participante($idsede,$idgrupo);";
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if($result){
            while ($valores = $result->fetch_array()){
                $data .= $valores[0];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }

    public function ActualizarDatos($id, $telefono, $correo, $grupo, $cedula){

        $query = "CALL Actualizar_Datos_Participante('".$id."','".$telefono."', '".$correo."', ".$grupo.", '".$cedula."');";         
        // echo $query;
        // exit;
        $mysqli= Conexiondatabase::ConexionSecurity();
        $consulta = $mysqli->query($query);
        return $consulta;
    }

    public function ListarDatosParticipante($idpersonaP){

        $datos = '';
        $query = "Call Cargar_Acceso_Participante($idpersonaP);";
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        if ($result != null){
            if ($result -> num_rows == 1) {
                $datos = $result->fetch_assoc();

            }
        }
        $mysqli->close();
        return $datos;
    }

    public function BuscarRegistroTel($vlocTel){
        $dato='';

        if($query = "CALL Buscar_Telefono('".$vlocTel."');")
        {
            $mysqli= Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if($result){
                while($row = $result->fetch_array()){
                    if($row[0] > 0){
                        $dato = 1;
                    }else{
                        $dato = 0;
                    }
                    $mysqli->close();
                }
            }
        } 
        return $dato;
    }

    public function BuscarRegistroTelRepetido($vparTel, $vparIdPersona){
        $dato='';

        if($query = "CALL Buscar_TelefonoRepetido('".$vparTel."', ".$vparIdPersona.");")
        {
            // echo $query;
            // exit;
            $mysqli= Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if($result){
                while($row = $result->fetch_array()){
                    if($row[0] > 0){
                        $dato = 1;
                    }else{
                        $dato = 0;
                    }
                    $mysqli->close();
                }
            }
        } 
        return $dato;
    }

    public function BuscarRegistroCorreo($vlocCorreo){
            
        if($query = "CALL Buscar_CorreoE('".$vlocCorreo."');")
        {
            $mysqli= Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if($result){
                while($row = $result->fetch_array()){
                    if($row[0] > 0){
                        $dato = 1;
                    }else{
                        $dato = 0;
                    }
                    $mysqli->close();
                }
            }
            
        }
        return $dato;
    }

    public function BuscarRegistroCorreoRepetido($vparCorreo, $vparIdPersona){
            
        if($query = "CALL Buscar_CorreoRepetido('".$vparCorreo."', ".$vparIdPersona.");")
        {
            $mysqli= Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if($result){
                while($row = $result->fetch_array()){
                    if($row[0] > 0){
                        $dato = 1;
                    }else{
                        $dato = 0;
                    }
                    $mysqli->close();
                }
            }
            
        }
        return $dato;
    }

    public function BuscarRegistroCedulaRepetido($vparCedula, $vparIdPersona){
            
        if($query = "CALL Buscar_CedulaRepetida('".$vparCedula."', ".$vparIdPersona.");")
        {
            $mysqli= Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if($result){
                while($row = $result->fetch_array()){
                    if($row[0] > 0){
                        $dato = 1;
                    }else{
                        $dato = 0;
                    }
                    $mysqli->close();
                }
            }
            
        }
        return $dato;
    }
        

        
    

}


?>