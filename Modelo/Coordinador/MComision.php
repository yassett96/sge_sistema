<?php

require_once ("../../Modelo/General/Conexionbd.php");
class ModalComision{

    public function get_insertar_comision($Ncomision)
    {
        $insertp = '';
        $query = "CAll Insertar_Comision('$Ncomision');";        
       
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

    public function get_Actualizar_comision($Ncomision,$UpdaComision)
    {
        $insertp = '';
        $query = "CAll Actualizar_Comision($Ncomision,'$UpdaComision');";        
       
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

    public function get_Eliminar_ComisionE($idCE)
    {
        $insertp = '';
        $query = "CAll Eliminar_ComisionE($idCE);";        
       
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

    public function get_BuscarNComision($NCom)
    {
        $return ='';

        $query = "CALL Buscar_NombreComision('$NCom');";
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
                        $return = "Lo sentimos, esta comision ya se encuentra registrada";
                        }
                    $mysqli->close();
                }
                
            
            }
            return $return;
    }

}

?>