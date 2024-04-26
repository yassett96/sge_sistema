<?php

require_once ("../../Modelo/Coordinador/MEvento_Coordinador.php");
require_once ("../../Assets/AuxiliarPhp/helperPhp.php");
require_once ("../../Assets/AuxiliarPhp/Constants.php");

    $modelevento = new MEvento_Coordinador();
    
    $datosp = $modelevento->MostrarProyectos_Cat();
    
    $datose = $modelevento->MostrarEventoF();
    $datosf = mysqli_fetch_array($datose);
    

    $datosc = $modelevento->MostrarCat_Subcategoria();

    /*function FunVerificarExistenciaEventoSegunAñoActual(){
        $modelevento = new MEvento_Coordinador();
        $vlocHelperPhp = new helperPhp();
        $vlocDateAñoActual = $vlocHelperPhp -> funcObtenerAñoActual();
        $vlocVerificacionExistencia = $modelevento -> FunVerificarExistenciaEventoSegunAñoActual($vlocDateAñoActual);        

        return $vlocVerificacionExistencia;
    }

     function FunObtenerDireccionLogoEsloganEventoActual()
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

        function FunObtenerDiaEventoActual(){
            $modeloEvento = new MEvento_Coordinador();
            $vlocHelperPhp = new helperPhp();
            $vlocDateAñoActual = $vlocHelperPhp->funcObtenerAñoActual();
            
            $vlocResult = $modeloEvento -> get_date_event($vlocDateAñoActual);
    
            $vlocResultColumnaFecha = $vlocResult->fetch_array(MYSQLI_BOTH)[0];
            $vlocStrDiaFecha = $vlocHelperPhp -> FunExtraerDiaDeFecha($vlocResultColumnaFecha);                
    
            return $vlocStrDiaFecha;
        }
        function FunObtenerMesEventoActualEnLetras(){
            $modeloEvento = new MEvento_Coordinador();
            $vlocHelperPhp = new helperPhp();
            $vlocDateAñoActual = $vlocHelperPhp->funcObtenerAñoActual();
            
            $vlocResult = $modeloEvento -> get_date_event($vlocDateAñoActual);
    
            $vlocResultColumnaFecha = $vlocResult->fetch_array(MYSQLI_BOTH)[0];
            $vlocStrMesFecha = $vlocHelperPhp -> FunExtraerMesDeFecha($vlocResultColumnaFecha);
            $vlocStrMesFechaLetras = FunConvertirDigitoMesEnLetras($vlocStrMesFecha);
            // echo 'Prueba Samir CEvento.php: '.$vlocStrMesFechaLetras;
            // exit;
    
            return $vlocStrMesFechaLetras;
        }
        function FunConvertirDigitoMesEnLetras($vparStrMes){
            $vlocHelperPhp = new helperPhp();
            $vlocStrMesLetras = "";
    
            switch($vparStrMes){
                case CteEnero:
                    $vlocStrMesLetras = "Enero";
                    break; 
                case CteFebrero:
                    $vlocStrMesLetras = "Febrero";
                    break;
                case CteMarzo:
                    $vlocStrMesLetras = "Marzo";
                    break;
                case CteAbril:
                    $vlocStrMesLetras = "Abril";
                    break;
                case CteMayo:
                    $vlocStrMesLetras = "Mayo";
                    break;
                case CteJunio:
                    $vlocStrMesLetras = "Junio";
                    break;
                case CteJulio:
                    $vlocStrMesLetras = "Julio";
                    break;
                case CteAgosto:
                    $vlocStrMesLetras = "Agosto";
                    break;
                case CteSeptiembre:
                    $vlocStrMesLetras = "Septiembre";
                    break;
                case CteOctubre:
                    $vlocStrMesLetras = "Octubre";
                    break;
                case CteNoviembre:
                    $vlocStrMesLetras = "Noviembre";
                    break;
                case CteDiciembre:
                    $vlocStrMesLetras = "Diciembre";
                    break;
                default:
                    $vlocStrMesFecha = "No ingreso ni un dígito entre 01 - 12";
            }
            return $vlocStrMesLetras;
        }
        function func_get_days_for_event(){
            $modeloEvento = new MEvento_Coordinador();
            $vlocHelperPhp = new helperPhp();
            $vlocDateAñoActual = $vlocHelperPhp->funcObtenerAñoActual();
    
            $result = $modeloEvento -> get_date_event($vlocDateAñoActual);        
    
            if($result == true){
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $date1 = new DateTime(date('Y-m-d'));
                $date2 = new DateTime($row['Fecha']);
                
                //echo $date1 -> format('Y-m-d');
                //echo $date2 -> format('Y-m-d');
                
                $diff = $date1 -> diff($date2);
                //echo $diff -> days;
                return $diff -> days-1;
            }
            else{
                echo "<script>alert('Error al cargar el usuario');</script>";
            }        
        }
        function func_get_hours_for_event(){
            $modeloEvento = new MEvento_Coordinador();
            $vlocHelperPhp = new helperPhp();
            $vlocDateAñoActual = $vlocHelperPhp->funcObtenerAñoActual();
    
            $result = $modeloEvento -> get_date_event($vlocDateAñoActual);
            
            if($result == true){
                $rowResult = $result->fetch_array(MYSQLI_ASSOC);
    
                $datePrueba1 = new DateTime(date('Y-m-d'));
                $datePrueba2 = new DateTime($rowResult['Fecha']);
    
                $diff1 = $datePrueba1 -> diff($datePrueba2);
                
                if($diff1->days == 0){
                   $time1 = new DateTime(date("H:I:S")); 
                   $time2 = new DateTime($rowResult['Hora']);
                   $diffTime = $time1 -> diff($time2);
                    return $diffTime;
                }else{
                    date_default_timezone_set("America/Tegucigalpa");
                    $time = date("H");                
                    $timeRest = 24 - $time;
                    return $timeRest;
                }            
            }else{
                echo "<script>alert('Error al cargar el usuario');</script>";
            }
        }
    
        function func_get_minutes_for_event(){
            $modeloEvento = new MEvento_Coordinador();
            $vlocHelperPhp = new helperPhp();
            $vlocDateAñoActual = $vlocHelperPhp->funcObtenerAñoActual();        
    
            $result = $modeloEvento -> get_date_event($vlocDateAñoActual);
            
            if($result == true){
                $rowResult = $result->fetch_array(MYSQLI_ASSOC);
    
                $actualTimeMinutes = date('i');
                
                return 60-$actualTimeMinutes;                       
            }else{
                echo "<script>alert('Error al cargar el usuario');</script>";
            }
        }
    
        function func_get_seconds_for_event(){
            $modeloEvento = new MEvento_Coordinador();
            $vlocHelperPhp = new helperPhp();
            $vlocDateAñoActual = $vlocHelperPhp->funcObtenerAñoActual();
    
            $result = $modeloEvento -> get_date_event($vlocDateAñoActual);
            
            if($result == true){            
    
                $actualTimeSeconds = date('s');
                
                return 60 - $actualTimeSeconds;                       
            }else{
                echo "<script>alert('Error al cargar el usuario');</script>";
            }
        }

        function FunVerificarLogoVacio(&$vparDireccionLogo){
            if($vparDireccionLogo === Null || $vparDireccionLogo === ''){
                $vparDireccionLogo = '../../Assets/imagenes/LogosEventos/no-image.jpg';
            }
        }
    */

?>