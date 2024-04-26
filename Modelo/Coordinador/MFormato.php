<?php

require_once ("../../Modelo/General/Conexionbd.php");
class ModalFormato{

    public function get_BuscarNFormato($NFor)
    {
        $return ='';

        $query = "CALL Buscar_NombreFormato('$NFor');";
        //echo $query;
        //exit;
            $mysqli = Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if($result)
            {
                while($row = $result->fetch_array())
                {
                    if($row[0] > 0)
                        {
                        $return = "Lo sentimos, este criterio ya se encuentra registrado";
                        }
                    $mysqli->close();
                }
                
            
            }
            return $return;
    }

    public function get_insertar_formato($Nformato)
    {
        $insertp = '';
        $query = "CAll Insertar_Formato('$Nformato');";        
       
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

    public function select_ListaFormato($Nformato)
    {
        $data = '';
        $query = "CAll ListarFormatoCriterios_Seleccionado('$Nformato');";

        //echo($query);
        //exit();

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

    public function get_Actualizar_formato($Idfor,$UpdaFormato)
    {
        $insertp = '';
        $query = "CAll Actualizar_Formato($Idfor,'$UpdaFormato');";        
       
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

    public function select_ListaIDFormato($Idformat)
    {
        $data = '';
        $query = "CAll Listar_ID_FormatoCriterios_Seleccionado($Idformat);";

        //echo($query);
        //exit();

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
    
    public function get_insertar_criterios($idTFormat,$Cri,$contador)
    {
        $insertp = '';
        $query = "CAll Insertar_Criterio($idTFormat,'$Cri',$contador);";        
       
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

    public function get_Actualizar_criterio($Idcri,$NombreCri,$DesCri,$ValorCri)
    {
        $insertp = '';
        $query = "CAll Actualizar_Criterio($Idcri,'$NombreCri','$DesCri',$ValorCri);";        
       
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
    public function get_insertar_JuradosE($IdCatE,$Idsubcate,$Jurado1,$Jurado2,$Jurado3,$IdTformat)
       {
        $insertce = '';
        $query = "CAll Agregar_JuradoGestion($IdCatE,$Idsubcate,$Jurado1,$Jurado2,$Jurado3,$IdTformat);";        
       
        //echo $query;
        //exit;
       
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result){
            $insertce = $mysqli->error;
        }else{
            $insertce = "1";
        }
        $mysqli->close();
        return $insertce;  
    }

    



}