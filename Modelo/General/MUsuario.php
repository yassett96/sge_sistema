<?php
    require_once ("../../Modelo/General/Conexionbd.php");

    class UsuarioModelo{
        
        public function func_insert_usuario($id_tipo_usuario, $tipo_usuario){            
            $insertp = '';
            $query = "CAll insertion_type_user('$id_tipo_usuario','$tipo_usuario');";
            $mysqli= Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if(!$result)
                $insertp = $mysqli->error;
            $mysqli->close();
            return $insertp;
        }

        public function func_get_usuario_Por_Id($id_usuario){
            $consult = '';
            $query = "CALL obtaining_user($id_usuario)";
            $mysqli = Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);            
            
            if(!$result)
                $consult = $mysqli->error;
            else 
                $consult = $result;

            $mysqli->close();
            return $consult;
        }

    }

?>