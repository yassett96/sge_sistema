<?php

require_once ("../../Modelo/General/Conexionbd.php");
class  MConferencia {

    public function get_BuscarCoincidenciasHoraConf($HoraI,$HoraF,$IDSitio)
    {
        $return ='';

        $query = "CALL VerificarRangoConferencias2('$HoraI','$HoraF',$IDSitio);";
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
                        $return = "Lo sentimos, Este rango de horas no esta disponible";
                        }
                    $mysqli->close();
                }
                
            
            }
            return $return;
    }

    public function get_insertar_conferencia($NomConf,$NombreConfer,$DetConfer,$HoraI,$HoraF,$IdSalon)
    {
        $insertp = '';
        $query = "CAll Agregar_Conferencia('$NomConf','$NombreConfer','$DetConfer','$HoraI','$HoraF',$IdSalon);";        
       
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

    public function ConferenciaEventoA()
    {
        $data = '';
        $query = "CAll Listar_ConferenciasEventoActual();";
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

    public function get_Eliminar_ConferenciaE($idConfE)
    {
        $insertp = '';
        $query = "CAll Eliminar_ConferenciaE($idConfE);";        
       
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

    /**************************************************** */

    public function ObtenerDatosConferencia($idConfSel){

        $datosGEA = '';
        $query = "Call Cargar_DatosConferenciaEvento($idConfSel);";

        //echo($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        
        if ($result && $result -> num_rows == 1) {
            $datosGEA = $result->fetch_assoc();


        }
        else { $datosGEA = ""; }
        $mysqli->close();
        return $datosGEA;
    }

    public function select_sitiosalon($idsitioE,$idsalonCE)
    {
        $data = '';
        $query = "CAll Cargar_ListaSalonConferencia($idsitioE,$idsalonCE);";
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

    
    public function get_BuscarCoincidenciasHoraConfUPDATE($HoraI,$HoraF,$IDSitio,$ID_Confea)
    {
        $return ='';

        $query = "CALL VerificarRangoConferenciasUPDATE('$HoraI','$HoraF',$IDSitio,$ID_Confea);";
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
                        $return = "Lo sentimos, Este rango de horas no esta disponible";
                        }
                    $mysqli->close();
                }
                
            
            }
            return $return;
    }

    public function get_Actualizar_Conferencia($ID_ConEA, $NomConf, $NombreConfer, $DetConfer, $HoraI, $HoraF, $IdSalon)
    {
        $insertp = '';
        $query = "CAll Actualizar_Conferencia($ID_ConEA, '$NomConf', '$NombreConfer', '$DetConfer', '$HoraI', '$HoraF', $IdSalon);";        
       
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