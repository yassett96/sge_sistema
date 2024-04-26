<?php

require_once ("../../Modelo/General/Conexionbd.php");

class SedeModel{

    public function select_sede()
    {
        $data = '';
        $query = "CAll Listar_Sede();";
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
}

?>