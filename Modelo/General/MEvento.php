<?php

    // require_once ("../../Modelo/General/Conexionbd.php");        
    require_once (dirname(__FILE__, 2)."/General/Conexionbd.php");        

    Class EventoModelo{

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
        
        Public Function FunVerificarExistenciaEventoSegunAñoActual($vparDateAñoActual){
            $vlocIntVerificacion = "";
            $vlocStrQuery = "Call Verificar_ExistenciaEventoFeriaSegunAño(".$vparDateAñoActual.");";
            $vlocMysqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMysqli->query($vlocStrQuery);
            // echo "Prueba: ".$vlocResult->fetch_array(MYSQLI_BOTH)[0];
            // exit;
            if(!$vlocResult)
                $vlocIntVerificacion = $vlocMysqli->error;
            
            $vlocResultRow = $vlocResult->fetch_array(MYSQLI_BOTH)[0];
            // echo 'Prueba Samir MEvento.php: '.$vlocResult->fetch_array(MYSQLI_BOTH)[0];
            // exit;

            $vlocMysqli->close();
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

        public function FunObtenerInformacionEventoActual(){
            $vlocInfoEvento = '';
            $vlocQuery = 'Call Obtener_InformacionEventoActual();';
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocInfoEvento = $vlocMySqli->error;
                return $vlocInfoEvento;
            }else{
                $vlocDatosEvento = array();
    
                $vlocNumDatosSedes = $vlocResult->num_rows;
    
                for($i=0; $i<$vlocNumDatosSedes; $i++){
                    $vlocRow = mysqli_fetch_array($vlocResult, MYSQLI_BOTH);
                    array_push($vlocDatosEvento, $vlocRow["Nombre_Evento"].'-_-'.$vlocRow["Nombre_Categoria"].'-_-'.$vlocRow["Nombre_SubCategoria"].'-_-'.$vlocRow["Año"].';');                
                } 
    
                $vlocDatosEvento = implode(",", $vlocDatosEvento);
            }
            return $vlocDatosEvento;    
        }

        public function FunObtenerInformacionEventoActualParaIndex(){
            $vlocInfoEvento = '';
            $vlocQuery = 'Call Obtener_InformacionEventoActualParaIndex();';
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocInfoEvento = $vlocMySqli->error;
                return $vlocInfoEvento;
            }else{
                $vlocDatosEvento = array();
    
                $vlocNumDatosSedes = $vlocResult->num_rows;
    
                for($i=0; $i<$vlocNumDatosSedes; $i++){
                    $vlocRow = mysqli_fetch_array($vlocResult, MYSQLI_BOTH);
                    array_push($vlocDatosEvento, $vlocRow["Nombre_Eventos"].'-_-'.$vlocRow["Nombre_Evento"].'-_-'.$vlocRow["Eslogan"].'-_-'.$vlocRow["Logo"].'-_-'.$vlocRow["hora"].'-_-'.$vlocRow["Fecha"].'-_-'.$vlocRow["Nombre_Sitio"].';');                
                } 
    
                $vlocDatosEvento = implode(",", $vlocDatosEvento);
            }
            return $vlocDatosEvento;    
        }

        
    }        

?>