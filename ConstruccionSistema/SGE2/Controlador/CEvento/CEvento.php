<?php 
    require_once ("../../Modelo/MEvento/MEvento.php");

    function func_get_days_for_event(){
        $modeloEvento = new EventoModelo();

        $result = $modeloEvento -> get_date_event();        

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
        $modeloEvento = new EventoModelo();

        $result = $modeloEvento -> get_date_event();
        
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
        $modeloEvento = new EventoModelo();

        $result = $modeloEvento -> get_date_event();
        
        if($result == true){
            $rowResult = $result->fetch_array(MYSQLI_ASSOC);

            $actualTimeMinutes = date('i');
            
            return 60-$actualTimeMinutes;                       
        }else{
            echo "<script>alert('Error al cargar el usuario');</script>";
        }
    }

    function func_get_seconds_for_event(){
        $modeloEvento = new EventoModelo();

        $result = $modeloEvento -> get_date_event();
        
        if($result == true){            

            $actualTimeSeconds = date('s');
            
            return 60 - $actualTimeSeconds;                       
        }else{
            echo "<script>alert('Error al cargar el usuario');</script>";
        }
    }

?>