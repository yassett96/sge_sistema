<?php

    require_once ("../../Modelo/Conexionbd.php");

    Class EventoModelo{

        public function get_date_event(){
            $cons = '';
                $query = "CAll obtaining_date_event();";
                $mysqli= Conexionbasedatos::ConexionSecurity();
                $result = $mysqli->query($query);
                if(!$result)
                    $cons = $mysqli->error;
                $mysqli->close();
                return $result;
        }        

    }        

?>