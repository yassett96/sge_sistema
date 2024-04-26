<?php 
    // require_once("../../Modelo/General/MEvento.php");
    // require_once("../../AuxiliarPhp/helperPhp.php");    
    require_once(dirname(__FILE__, 3)."/Modelo/General/MEvento.php");
    require_once(dirname(__FILE__, 3)."/Assets/AuxiliarPhp/helperPhp.php");    
    require_once(dirname(__FILE__, 3)."/Assets/AuxiliarPhp/Constants.php");    

    if(isset($_GET["vparBoolObtenerInfoEvento"])){  

        $vlocInfoEvento = FunObtenerInformacionEventoActual();

        echo $vlocInfoEvento;
    }

    if(isset($_GET["vparBoolObtenerInfoEventoParaIndex"])){  

        $vlocInfoEvento = FunObtenerInformacionEventoActualParaIndex();

        echo $vlocInfoEvento;
    }

    function func_get_days_for_event(){
        $modeloEvento = new EventoModelo();
        $vlocHelperPhp = new helperPhp();
        $vlocDateAñoActual = $vlocHelperPhp->funcObtenerAñoActual();

        $result = $modeloEvento -> get_date_event($vlocDateAñoActual);        

        $verif = $result->fetch_array(MYSQLI_ASSOC);
        $date1Verif = new DateTime(date('Y-m-d'));
        $date2Verif = new DateTime($verif['Fecha']);

        date_default_timezone_set('America/Tegucigalpa');
        $time1Verif = new DateTime(date("H:i:s")); 
        $time2Verif = new DateTime($verif['Hora']);

        if($date1Verif < $date2Verif){

            if($result == true){
                $row = $verif;
                $date1 = new DateTime(date('Y-m-d H:i:s'));
                $date2 = new DateTime($row['Fecha'] . $row['Hora']);
                
                $diff = $date1 -> diff($date2);
                
                return $diff -> days;
            }
            else{
                echo "<script>alert('Error al cargar la fecha del evento');</script>";
            } 
        }else{
            return '0';
        }       
    }

    function FunObtenerDireccionLogoEsloganEventoActual(){
        $modeloEvento = new EventoModelo();
    
        $vlocResult = $modeloEvento->FunObtenerDireccionLogoEsloganEventoActual();
        
        if($vlocResult == true){
            return $vlocResult;
        }
        else{
            echo "<script>alert('Error al obtener el logo');</script>";
        }
    }

    function FunVerificarLogoVacio(&$vparDireccionLogo){
        if($vparDireccionLogo === Null || $vparDireccionLogo === ''){
            $vparDireccionLogo = '../../Assets/imagenes/LogosEventos/no-image.jpg';
        }
    }

    function func_get_hours_for_event(){
        $modeloEvento = new EventoModelo();
        $vlocHelperPhp = new helperPhp();
        $vlocDateAñoActual = $vlocHelperPhp->funcObtenerAñoActual();

        $result = $modeloEvento -> get_date_event($vlocDateAñoActual);

        $verif = $result->fetch_array(MYSQLI_ASSOC);
        $date1Verif = new DateTime(date('Y-m-d'));
        $date2Verif = new DateTime($verif['Fecha']);

        date_default_timezone_set('America/Tegucigalpa');

        if($date1Verif < $date2Verif){            
        
            if($result == true){
                $rowResult = $verif;

                $datePrueba1 = new DateTime(date('Y-m-d H:i:s'));
                $datePrueba2 = new DateTime($rowResult['Fecha'] . $rowResult['Hora']);

                $diff1 = $datePrueba1 -> diff($datePrueba2);

                return $diff1->format('%h');          
            }else{
                echo "<script>alert('Error al cargar la fecha del evento');</script>";
            }

            
        }else{
            return '00';
        }
    }

    function func_get_minutes_for_event(){
        $modeloEvento = new EventoModelo();
        $vlocHelperPhp = new helperPhp();
        $vlocDateAñoActual = $vlocHelperPhp->funcObtenerAñoActual();        

        $result = $modeloEvento -> get_date_event($vlocDateAñoActual);

        $verif = $result->fetch_array(MYSQLI_ASSOC);
        $date1Verif = new DateTime(date('Y-m-d'));
        $date2Verif = new DateTime($verif['Fecha']);

        date_default_timezone_set('America/Tegucigalpa');

        if($date1Verif < $date2Verif){            
        
            if($result == true){
                $rowResult = $verif;

                date_default_timezone_set('America/Tegucigalpa');
                $time1 = new DateTime(date("Y-m-d H:i:s")); 
                $time2 = new DateTime($rowResult['Fecha'] . $rowResult['Hora']);
                
                $diffTime = $time1 -> diff($time2);
                return $diffTime->format('%i');

            }else{
                echo "<script>alert('Error al cargar la fecha del evento');</script>";
            }
        }else{
            return '00';
        }
    }

    function func_get_seconds_for_event(){
        $modeloEvento = new EventoModelo();
        $vlocHelperPhp = new helperPhp();
        $vlocDateAñoActual = $vlocHelperPhp->funcObtenerAñoActual();

        $result = $modeloEvento -> get_date_event($vlocDateAñoActual);

        $verif = $result->fetch_array(MYSQLI_ASSOC);
        $date1Verif = new DateTime(date('Y-m-d'));
        $date2Verif = new DateTime($verif['Fecha']);

        date_default_timezone_set('America/Tegucigalpa');

        if($date1Verif < $date2Verif){
        
            if($result == true){            
                $rowResult = $verif;

                date_default_timezone_set('America/Tegucigalpa');
                $time1 = new DateTime(date("H:i:s")); 
                $time2 = new DateTime($rowResult['Fecha'] . $rowResult['Hora']);
                
                $diffTime = $time1 -> diff($time2);
                return $diffTime->format('%s');
                      
            }else{
                echo "<script>alert('Error al cargar el usuario');</script>";
            }
        }else{
            return '00';
        }
    }

    function FunVerificarExistenciaEventoSegunAñoActual(){
        $modeloEvento = new EventoModelo();
        $vlocHelperPhp = new helperPhp();
        $vlocDateAñoActual = $vlocHelperPhp -> funcObtenerAñoActual();
        $vlocVerificacionExistencia = $modeloEvento -> FunVerificarExistenciaEventoSegunAñoActual($vlocDateAñoActual);        

        return $vlocVerificacionExistencia;
    }

    function FunObtenerDiaEventoActual(){
        $modeloEvento = new EventoModelo();
        $vlocHelperPhp = new helperPhp();
        $vlocDateAñoActual = $vlocHelperPhp->funcObtenerAñoActual();
        
        $vlocResult = $modeloEvento -> get_date_event($vlocDateAñoActual);

        $vlocResultColumnaFecha = $vlocResult->fetch_array(MYSQLI_BOTH)[0];
        $vlocStrDiaFecha = $vlocHelperPhp -> FunExtraerDiaDeFecha($vlocResultColumnaFecha);                

        return $vlocStrDiaFecha;
    }

    function FunObtenerMesEventoActualEnLetras(){
        $modeloEvento = new EventoModelo();
        $vlocHelperPhp = new helperPhp();
        $vlocDateAñoActual = $vlocHelperPhp->funcObtenerAñoActual();
        
        $vlocResult = $modeloEvento -> get_date_event($vlocDateAñoActual);

        $vlocResultColumnaFecha = $vlocResult->fetch_array(MYSQLI_BOTH)[0];
        $vlocStrMesFecha = $vlocHelperPhp -> FunExtraerMesDeFecha($vlocResultColumnaFecha);
        $vlocStrMesFechaLetras = FunConvertirDigitoMesEnLetras($vlocStrMesFecha);

        return $vlocStrMesFechaLetras;
    }

    function FunObtenerInformacionEventoActual(){
        $vlocInfoEvento = new EventoModelo();

        return $vlocInfoEvento->FunObtenerInformacionEventoActual();
    }

    function FunObtenerInformacionEventoActualParaIndex(){
        $vlocInfoEvento = new EventoModelo();

        return $vlocInfoEvento->FunObtenerInformacionEventoActualParaIndex();
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
        
?>