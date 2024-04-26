<?php

require_once ("../../Modelo/General/Conexionbd.php");

class GrupoModel{

    public function lista_sedegrupo($Id_sede)
    {
        $data = '';
        $query = "CAll Listar_SedeGrupo($Id_sede);";



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