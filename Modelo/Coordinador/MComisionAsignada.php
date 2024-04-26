<?php

require_once ("../../Modelo/General/Conexionbd.php");
class ModComisionA{

    public function ObtenerComisionAsignada_Persona($idpersona){

        $datosCEA = '';
        $query = "Call Cargar_DatosComisionA_Persona($idpersona);";

        //echo($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        
        if ($result && $result -> num_rows == 1) {
            $datosCEA = $result->fetch_assoc();


        }
        else { $datosCEA = ""; }
        $mysqli->close();
        return $datosCEA;
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

    public function ObtenerResponsableComision($idComisionE){

        $data = array();
        $query = "Call ListaResponsables_CE($idComisionE);";

        //echo($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        
        if($result){
            while ($valores = $result->fetch_array()){
                $data[] = $valores[0];
            }
            $result ->close();
        }/*

        if($result){
            while ($valores = $result->fetch_array()){
                $data[] = array(
                    'posicion1' => $valores[0],
                    'posicion2' => $valores[1]
                );
            }
            $result->close();
        }*/
           
        $mysqli->close();
        echo json_encode($data);
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
    public function ObtenerURLReporte($idComisionE){

        $data = array();
        $query = "Call ReporteFinalCreado_Comision($idComisionE);";

        //echo($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        
        if ($result) {
            while ($valores = $result->fetch_array()) {
                $reporte = array(
                    "Nombre" => $valores[0],
                    "URL" => $valores[1]
                );
                $data[] = $reporte;
            }
            $result->close();
        }
           
        $mysqli->close();
        echo json_encode($data);
    }

    public function Lista_ComisionAsignada_Persona($idpersona)
    {
        $data = '';
        $query = "CAll Lista_DatosComisionA_Persona($idpersona);";
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
    
    public function select_IntegrantesComisionA($idComisionAsig)
    {
        $data = '';
        $query = "CAll Obtener_NombreIntegrantesCA($idComisionAsig);";
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

    public function select_ComisionesEventoA($idComisionAsig)
    {
        $data = '';
        $query = "CAll Listar_ComisionEvento_Actividad($idComisionAsig);";
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

    public function Datos_TablaPAcedemico_A($Id_Persona)
    {
        $data = '';
        $query = "CAll Obtener_NombrePAcademico_Comision($Id_Persona);";  // IMPRIME COMO TABLA*/       

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

    public function Agregar_ComisionTableApoyo($IDComisionApoyo)
    {
        $data = '';
        $query = "CAll Lista_ComisionApoyo_Sel($IDComisionApoyo);";  // IMPRIME COMO TABLA*/       

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
    public function select_OtrosParticipantesA()
    {
        $data = '';
        $query = "CAll Listar_PersonaParaApoyo_Select();";
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

    public function Agregar_Tabla_OtrosParticipantesA($IDPersonaParticipante)
    {
        $data = '';
        $query = "CAll Listar_PersonaParaApoyo_Tabla($IDPersonaParticipante);";  // IMPRIME COMO TABLA*/       

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

    public function get_insertar_ActividadComision($NombreAct,$DescripcionA,$FechaI,$FechaF,$Requerimientos,$NRequerimientos,$EncargadosA,$NEncargados,$ComisionAA,$NComisiones,$PersonalAA,$NPersonalA,$IDComisionAsig)
       {
        $insertce = '';
        $query = "CAll Agregar_ActividadComision('$NombreAct','$DescripcionA','$FechaI','$FechaF','$Requerimientos',$NRequerimientos,'$EncargadosA',$NEncargados,'$ComisionAA',$NComisiones,'$PersonalAA',$NPersonalA,$IDComisionAsig);";        
       
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

    public function Listar_RequerimientosAct($Id_Actividad)
    {
        $data = '';
        $query = "Call Lista_RequerimientosActividad($Id_Actividad);";  // IMPRIME COMO TABLA*/       

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

    public function Listar_ResponsablesAct($Id_Actividad)
    {
        $data = '';
        $query = "Call Lista_ResponsablesActividad($Id_Actividad);";  // IMPRIME COMO TABLA*/       

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
    public function Listar_ComisionApoyoAct($Id_Actividad)
    {
        $data = '';
        $query = "Call Lista_ComisionApoyo_Actividad($Id_Actividad);";  // IMPRIME COMO TABLA*/       

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
    public function Listar_PersonalApoyoAct($Id_Actividad)
    {
        $data = '';
        $query = "Call Lista_PersonalApoyo_Actividad($Id_Actividad);";  // IMPRIME COMO TABLA*/       

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
    public function get_Eliminar_Actividad($idComAct)
    {
        $insertp = '';
        $query = "CAll Eliminar_ActividadCom($idComAct);";        
       
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

    public function select_EstadoAct($idComAct)
    {
        $data = '';
        $query = "CAll Lista_EstadoAct($idComAct);";
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

    public function ActualizarEstado_Actividad($IdEstado,$idComA)
    {
        $insertp = '';
        $query = "CAll Actualizar_EstadoAct($IdEstado,$idComA);";        
       
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

    public function ValidarestadoActividad($Id_ComA)
    {

        $datos = '';
        $query = "select Obtener_EstadoActividad($Id_ComA);";

        //echo ($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if($result){
            while ($valores = $result->fetch_array()){
                $datos .= $valores[0];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $datos;
    }

    public function ObtenerTotalesActividad($idComisionE){

        $data = array();
        $query = "Call ObtenerDatosTotalesAct($idComisionE);";

        //echo($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);


        if($result){
            while ($valores = $result->fetch_array()){
                $data[] = array(
                    'TotalActF' => $valores[0],
                    'TotalActT' => $valores[1]
                );
            }
            $result->close();
        }
           
        $mysqli->close();
        echo json_encode($data);
    }

    public function ObtenerCorreoR1_CAsig($idComisionE){

        $data = /*array()*/ "";
        $query = "Call ObtenerCorreoR1_ComisionEvento($idComisionE);";

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

        /*
        if($result){
            while ($valores = $result->fetch_array()){
                $data[] = array(
                    'posicion1' => $valores[0],
                    'posicion2' => $valores[1]
                );
            }
            $result->close();
        }*/
           
        $mysqli->close();
        return  $data;
    }
    public function ObtenerCorreoR2_CAsig($idComisionE){

        $data ="";
        $query = "Call ObtenerCorreoR2_ComisionEvento($idComisionE);";

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
        return  $data;
    }
    public function ObtenerCorreoR3_CAsig($idComisionE){

        $data = "";
        $query = "Call ObtenerCorreoR3_ComisionEvento($idComisionE);";

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
        return  $data;
    }

    public function ObtenerIdintegrantecom($Id_Persona,$id_ComisionAsig)
    {

        $datos = '';
        $query = "select ObtenerID_integranteComision($Id_Persona,$id_ComisionAsig);";

        //echo ($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if($result){
            while ($valores = $result->fetch_array()){
                $datos .= $valores[0];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $datos;
    }

    public function Agregar_Solicitudrealizada($ID_Comision_De,$ID_Comision_PAra,$ID_Integrante,$AsuntoC,$ConsultaC,$FechaE)
       {
        $insertce = '';
        $query = "CAll Insertar_SolitudRealizada($ID_Comision_De,$ID_Comision_PAra,$ID_Integrante,'$AsuntoC','$ConsultaC','$FechaE');";        
       
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

    public function Listar_SolicitudesRea($IDComisionAsig)
    {
        $data = '';
        $query = "CAll Listar_SolicitudesRealizadas($IDComisionAsig);";  // IMPRIME COMO TABLA*/       

        // echo $query;
        // exit();

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
    public function Listar_ReporteActividadesComision($IDComisionAsig)
    {
        $data = '';
        $query = "CAll Reporte_ActividadComision($IDComisionAsig);";  // IMPRIME COMO TABLA*/       

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

    public function Listar_ReporteActividadesComisionExcell($IDComisionAsig)
    {
        $data = '';
        $query = "CAll Reporte_ActividadComision_EXCEL($IDComisionAsig);";  // IMPRIME COMO TABLA*/       

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


    public function ConsultarNombreFeria(){

        $data = '';
        $query = "Call Mostrar_EventoActual();";

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

    public function ConsultarNombreFeriaHistorial($idEvento){

        $data = '';
        $query = "Call  Mostrar_EventoSeleccionado('$idEvento');";

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

    public function get_insertar_reporte($IdComE,$NombreReporte,$FechaR,$DirReporte,$DirDescarga)
    {
        $insertp = '';
        $query = "CAll Insertar_ReporteFinalCE($IdComE,'$NombreReporte','$FechaR','$DirReporte','$DirDescarga');";        
       
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

    public function ObtenerUtlimoReporteIDCOM($IdComE)
    {
        $data = '';
        $query = "CAll Obtener_UltimoReporte($IdComE);";
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

    public function ObtenerReporteFinalActual($IdComE)
    {
        $datos = '';
        $query = "CAll Obtener_ReporteFinalActual($IdComE);";
        //echo ($query);
        //exit;
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        /*if($result){
            while ($valores = $result->fetch_array()){
                $data .= $valores[0];
            }
            $result ->close();
        };*/
        if ($result -> num_rows == 1) {
            $datos = $result->fetch_assoc();
        }
           
        $mysqli->close();
        return $datos;
    }

    public function get_EliminarIDReporte($idRegRep)
    {
        $insertp = '';
        $query = "CAll Eliminar_RegistroReporteFinal($idRegRep);";        
       
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

?>