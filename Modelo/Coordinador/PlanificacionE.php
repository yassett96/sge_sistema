<?php

require_once ("../../Modelo/General/Conexionbd.php");

class PlanificacionEM{


    public function get_insertar_evento($TipoE,$NombreE,$EsloganE,$nombreBD,$HoraE,$FechaE,$LugarE)
    {
        $insertp = '';
        $query = "CAll Insertar_DatosGeneralesEvento('$TipoE','$NombreE','$EsloganE','$nombreBD','$HoraE','$FechaE','$LugarE');";        
       
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

    public function select_sitio()
    {
        $data = '';
        $query = "CAll Lista_Sitio();";
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

    public function select_comision()
    {
        $data = '';
        /*$query = "CAll Lista_Comision();";*/
        $query = "CAll Lista_ComisionValidadaX();";
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

    public function select_comision_Seleccionada($idcom)
    {
        $data = '';
        $query = "CAll Lista_ComisionSeleccionada($idcom);";
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

    public function lista_funcioncomision($Id_Comision)
    {
        $data = '';
        $query = "CAll Lista_FuncionSegunComision2($Id_Comision);";  // IMPRIME COMO TABLA*/       



        //echo ($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        
        if ($result) {
            while ($row = $result->fetch_array()) {
                $data .= $row[0];
            }
        }
           
        $mysqli->close();
        return $data;
    }

    public function select_PersonalAcademico()
    {
        $data = '';
        $query = "CAll Lista_PersonalAcemico();";
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

    public function Datos_TablaPAcedemico_Responsable($Id_Persona)
    {
        $data = '';
        $query = "CAll Obtener_NombrePAcademico_Responsable($Id_Persona);";  // IMPRIME COMO Select*/       

        echo($query);
        exit;

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

    public function Datos_TablaPAcedemico($Id_Persona)
    {
        $data = '';
        $query = "CAll Obtener_NombrePAcademico($Id_Persona);";  // IMPRIME COMO TABLA*/       

        //echo($query);
        //exit();

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        
        if ($result) {
            while ($row = $result->fetch_array()) {
                $data .= $row[0];
            }
        }
           
        $mysqli->close();
        return $data;   

        /*if ($result && $result -> num_rows == 2) {
            $datosE = $result->fetch_assoc();


        }
        else { $datosE = NULL; }

        $mysqli->close();
        return $datosE;*/
    }

    public function get_insertar_ComisionE($IdCom,$Responsable1,$Responsable2,$Responsable3,$Integrantes,$ContINT)
       {
        $insertce = '';
        $query = "CAll Agregar_ComisionEvento($IdCom,$Responsable1,$Responsable2,$Responsable3,'$Integrantes',$ContINT);";        
       
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

    public function ComisionEventoA()
    {
        $data = '';
        $query = "CAll Listar_ComisionesEventoActual();";
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

    public function ObtenerDatosGEvento(){

        $datosGEA = '';
        $query = "Call Cargar_DatosGEvento();";

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

    public function ObtenerLugarEventoActual(){

        $data = '';
        $query = "Call Lista_Sitio_DGE1();";

        //echo($query);
        //exit;

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

    public function get_Insertar_NLugar($Nlugar,$salon,$contador)
    {
        $insertp = '';
        $query = "CAll Insertar_LugarSalon('$Nlugar','$salon',$contador);";        
       
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

    public function get_Actualizar_DGevento($TipoE,$NombreE,$EsloganE,$nombreBD,$HoraE,$FechaE,$LugarE,$ID_Evento)
    {
        $insertp = '';
        $query = "CAll Actualizar_DatosGeneralesEvento('$TipoE','$NombreE','$EsloganE','$nombreBD','$HoraE','$FechaE','$LugarE',$ID_Evento);";        
       
        //echo $query;
        //exit();
       
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

    public function get_Actualizar_DGeventoSF($TipoE,$NombreE,$EsloganE,$nombreBD1,$HoraE,$FechaE,$LugarE,$ID_Evento)
    {
        $insertp = '';
        $query = "CAll Actualizar_DatosGeneralesEvento('$TipoE','$NombreE','$EsloganE','$nombreBD1','$HoraE','$FechaE','$LugarE',$ID_Evento);";        
       
        //echo $query;
        //exit();
       
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

    /*******************************   Conferencias ***********************/

    public function select_sitiosalon($idsitioE)
    {
        $data = '';
        $query = "CAll Cargar_ListaSalon($idsitioE);";
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

    /************************************ Eliminar Evento ******************/

    public function get_Eliminar_EventoActual()
    {
        $insertp = '';
        $query = "Call Finalizar_EventoActualYRelaciones();";        
       
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