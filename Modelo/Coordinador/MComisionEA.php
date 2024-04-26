<?php

require_once ("../../Modelo/General/Conexionbd.php");
class ModComisionEA{

    public function ObtenerNombreComision($idcea){

        $datosCEA = '';
        $query = "Call Cargar_IDNombre_ComisionEvento($idcea);";

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

    public function FuncionesComisionEventoA($idcom)
    {
        $data = '';
        $query = "CAll Lista_FuncionCEA($idcom);";

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

    public function select_R1CEA($idcea)
    {
        $data = '';
        $query = "CAll R1_Lista_PersonalAcemico($idcea);";
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

    public function select_R2CEA($idcea)
    {
        $data = '';
        $query = "CAll R2_Lista_PersonalAcemico($idcea);";
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

    public function select_R3CEA($idcea)
    {
        $data = '';
        $query = "CAll R3_Lista_PersonalAcemico($idcea);";
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

  


    public function Integrantes_CEA($idcea)
    {
        $data = '';
        $query = "CAll Obtener_IntegrantesComision_EA($idcea);";

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

?>