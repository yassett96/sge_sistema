<?php

require_once ("../../Modelo/General/Conexionbd.php");

class MEvento_Coordinador{

    public function MostrarProyectos_Cat(){

        $query = "CALL Mostrar_Proyecto_Categoria1();";
        $mysqli = Conexiondatabase::ConexionSecurity();
        $consulta = $mysqli->query($query);
        return $consulta;
    }

    public function MostrarEventoF(){
        $query = "CALL Mostrar_EventoActual();";
        $mysqli = Conexiondatabase::ConexionSecurity();
        $consulta = $mysqli->query($query);
        return $consulta;
    }

    public function MostrarCat_Subcategoria(){
        $query = "CALL Mostrar_Cat_Subcategoria1();";
        $mysqli = Conexiondatabase::ConexionSecurity();
        $consulta = $mysqli->query($query);
        return $consulta;
    }

    public function Mostrar_UltimoE(){
        
        $query = "CALL Mostrar_UltimoEvento();";
        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        return $result;
    }
    
    public function Mostrar_UltimosProyecto($id){
        $query = "CALL Mostrar_Ultimo_Proyecto_Cat1('$id');";
        $mysqli = Conexiondatabase::ConexionSecurity();
        $consulta = $mysqli->query($query);
        return $consulta;
    }

    public function Mostrar_Cat_UltimoE($id){
        $query = "CALL Mostrar_CatS_UE1('$id');";
        $mysqli = Conexiondatabase::ConexionSecurity();
        $consulta = $mysqli->query($query);
        return $consulta;
    }

    public function FunVerificarExistenciaEventoSegunAñoActual($vparDateAñoActual){
        $vlocIntVerificacion = "";
        $query = "Call Verificar_ExistenciaEventoFeriaSegunAño(".$vparDateAñoActual.");";
        $mysqli = Conexiondatabase::ConexionSecurity();
        $vlocResult = $mysqli->query($query);
        
        if(!$vlocResult)
            $vlocIntVerificacion = $mysqli->error;
        
        $vlocResultRow = $vlocResult->fetch_array(MYSQLI_BOTH)[0];
        
        $mysqli->close();
        return $vlocResultRow;
    }
    public function FunObtenerDireccionLogoEsloganEventoActual()
        {
            $vlocDireccionLogo = '';
            $vlocQuery = "CAll Obtener_DireccionLogoEsloganEventoActual();";
            $vlocMySqli= Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if($vlocResult){
                $vlocDireccionLogo = $vlocResult->fetch_array();
            }
            
            $vlocMySqli->close();
            return $vlocDireccionLogo;
        }
        public function get_date_event($vparDateAño){
            $cons = '';
                $query = "CAll Obtener_FechaEventoFeriaSegunAño(".$vparDateAño.");";
                $mysqli= Conexiondatabase::ConexionSecurity();
                $result = $mysqli->query($query);
                if(!$result)
                    $cons = $mysqli->error;
                $mysqli->close();
                return $result;
        } 
        

} 