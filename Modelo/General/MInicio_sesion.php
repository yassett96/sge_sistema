<?php
require_once ("../../Modelo/General/Conexionbd.php");

class MInicio_Sesion{
   
    public function ConsultarUsuario($usuario,$password){

        $datos = '';
        $query = "CALL Obtener_Usuario_PersonalAcademico('$usuario','$password');";      
        
        //echo ($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        if ($result) {
            /* obtener el array de objetos */
            while ($row = $result->fetch_row()) {
                $datos=  $row[2];
            }
        
            /* liberar el conjunto de resultados */
            $result->close();
        }
        else{
            $datos = "0";
        }

        $mysqli->close();
        return $datos;        
    }


    public function ListarUsuario($idpersona){

        $list = '';
        $query = "CAll Listar_Tipo_Usuario($idpersona);";
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        
        if($result){
            while ($valores = $result->fetch_array()){
                $list .= $valores[0];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $list;
    }

    public function ListarDatosAcademico($idpersonaA,$IdTipoUsuario){

        $datos = '';
        $query = "Call Cargar_Acceso_PersonaUsuario($idpersonaA,$IdTipoUsuario);";

        //echo ($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        if ($result -> num_rows == 1) {
            $datos = $result->fetch_assoc();
        }

        $mysqli->close();
        return $datos;
    }

    public function ConsultarUsuarioParticipante($usuario,$password){

        $datos = '';
        $query = "CALL Obtener_Usuario_Participante('$usuario','$password');";

        //echo ($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        if ($result) {
            /* obtener el array de objetos */
            while ($row = $result->fetch_row()) {
                $datos=  $row[2];
            }
        
            /* liberar el conjunto de resultados */
            $result->close();
        }

        $mysqli->close();
        return $datos;        
    }

    public function ListarDatosParticipante($idpersonaP){

        $datos = '';
        $query = "Call Cargar_Acceso_Participante($idpersonaP);";
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        /*if ($result != null){
            if ($result -> num_rows == 1) {
                $datos = $result->fetch_assoc();

            }
        }*/
        
        if ($result && $result -> num_rows == 1) {
            $datos = $result->fetch_assoc();


        }
        else { $datos = ""; }
        $mysqli->close();
        return $datos;
    }

    public function ConsultarPassatiempo($usuario){
        $list ='';
        $query = "CALL Obtener_Pasatiempo_Usuario('$usuario');";      
        
        //echo ($query);
        //exit;
        
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        if ($result -> num_rows == 1) {
            $list = $result->fetch_assoc();
        }else 
        $list = "";

        $mysqli->close();
        return $list;
            
    }

    public function ConsultarIntentos($usuario){
        $list ='';
        $query = "CALL Consulta_Intento_Usuario('$usuario');";      
        
        //echo ($query);
        //exit;
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        if($result){
            while ($valores = $result->fetch_array()){
                $list .= $valores[0];
            }
            $result ->close();
        };
        
        return $list;
            
    }

    public function AgregarIntento($usuario){
        $insertp ='';
        $query = "CALL Insertar_Intentos('$usuario');";      
        
        //echo ($query);
        //exit;
    
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result){
            $insertp = $mysqli->error;
        }
        $mysqli->close();
        return $insertp;
            
    }

    public function EliminarIntento($usuario){
        $del ='';
        $query = "CALL Elimina_Intento('$usuario');";      
        
        //echo ($query);
        //exit;
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result){
            $del = $mysqli->error;
        }
        $mysqli->close();
        return $del;    
            
    }

    public function ValidarTipoUsuarioE($idpersona){

        $datos = '';
        $query = "CALL ValidarTipoUsuario($idpersona);";      
        
        //echo ($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        if ($result) {
            /* obtener el array de objetos */
            while ($row = $result->fetch_row()) {
                $datos=  $row[0];
            }
        
            /* liberar el conjunto de resultados */
            $result->close();
        }
        else{
            $datos = "0";
        }

        $mysqli->close();
        return $datos;        
    }


}


?>

