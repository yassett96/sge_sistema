<?php

require_once ("../../Modelo/General/Conexionbd.php");
class InicioPersonalAcademicoModelo{

    public function ObtenerDatosComisionEvento() {
        $data = array();
        $query = "Call Datos_ComisionesEventoActual();";
    
        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
    
        if ($result) {
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($row = $result->fetch_array()) {
                $data[] = $row[0];
            }
        }
    
        return $data;
    }

    public function ObtenerR1ComisionAsignada($idComisionE){

        $data = '';
        $query = "Call Responsable1_ComisionEvento($idComisionE);";

        //echo($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        
        if($result){
            while ($valores = $result->fetch_array()){
                $data .= $valores[1];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }

    public function ObtenerR2ComisionAsignada($idComisionE){

        $data = '';
        $query = "Call Responsable2_ComisionEvento($idComisionE);";

        //echo($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        
        if($result){
            while ($valores = $result->fetch_array()){
                $data .= $valores[1];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }
    public function ObtenerR3ComisionAsignada($idComisionE){

        $data = '';
        $query = "Call Responsable3_ComisionEvento($idComisionE);";

        //echo($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        
        if($result){
            while ($valores = $result->fetch_array()){
                $data .= $valores[1];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }
    public function Listar_ActividadesComision_VCS($IDComisionAsig)
    {
        $data = '';
        $query = "CAll Listar_ActividadComision_VCS($IDComisionAsig);";  // IMPRIME COMO TABLA*/       

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

    }

    public function Listar_ActividadesComision($IDComisionAsig)
    {
        $data = '';
        $query = "CAll Listar_ActividadComision($IDComisionAsig);";  // IMPRIME COMO TABLA*/       

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

    }
    public function Listar_IntegrantesComision($IDComisionAsig)
    {
        $data = '';
        $query = "CAll Listar_IntegrantesComision($IDComisionAsig);";  // IMPRIME COMO TABLA*/       

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

    }
    public function ObtenerTotalesActividad($idComisionE){

        $data = array();
        $query = "Call ObtenerDatosTotalesAct($idComisionE);";

        //echo($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);


        if ($result) {
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($row = $result->fetch_array()) {
                $data[] = $row[0];
                $data[] = $row[1];
            }
        }
    
        return $data;
    
    }

    public function Lista_ComisionAsignada_Persona($idpersona)
    {
        $data = array(); 
        $query = "CAll Lista_DatosComisionA_Persona_VCS($idpersona);";
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if($result){
            while ($valores = $result->fetch_array()){
                $data[] = $valores[0];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }

    public function ObtenerResponsableComision($idComisionE){

        $data = array();
        $query = "Call ListaResponsables_CE($idComisionE);";

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if($result){
            while ($valores = $result->fetch_array()){
                $data[] = $valores[0];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }
    public function ObtenerReporteFinalCreado($idComisionE){

        $data = '';
        $query = "Call ReporteFinalCreado_Comision($idComisionE);";

        //echo($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        
        if($result){
            while ($valores = $result->fetch_array()){
                $data .= $valores[2];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }




}

?>