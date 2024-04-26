<?php

require_once ("../../Modelo/General/Conexionbd.php");
class  MHistorialEF {

    public function HistorialEFeria($idtipoE)
    {
        $data = '';
        $query = "CAll Mostrar_Historial_EventoFeria($idtipoE);";
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

    
    public function ListaComisionHE($id_Evento)
    {
        $data = '';
        $query = "CAll Listar_ComisionesEventoHistorial_V2($id_Evento);";

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

    public function ListaCategoriasHE($id_Evento)
    {
        $data = '';
        $query = "CAll Listar_CategoriasEventoHistorial($id_Evento);";

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

    public function ListaConferenciaHE($id_Evento)
    {
        $data = '';
        $query = "CAll Listar_ConferenciasEventoHistorial($id_Evento);";

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

    

}