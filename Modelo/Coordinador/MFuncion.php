<?php

require_once ("../../Modelo/General/Conexionbd.php");
class ModalFunciones{

    public function get_insertar_funcion($idComi,$Fun,$contador)
    {
        $insertp = '';
        $query = "CAll Insertar_Funcion($idComi,'$Fun',$contador);";        
       
        //echo $query;
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

    public function get_Actualizar_funcion($idfun,$NombreFun)
    {
        $insertp = '';
        $query = "CAll Actualizar_Funcion($idfun,'$NombreFun');";        
       
        //echo $query;
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

    public function get_Eliminar_funcion($idfun)
    {
        $insertp = '';
        $query = "CAll Eliminar_Funcion($idfun);";        
       
        //echo $query;
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

    
}