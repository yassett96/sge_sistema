<?php

require_once ("../../Modelo/General/Conexionbd.php");

class MJurado{
    
    public function select_categoriaEvento()
    {
        $data = '';
        $query = "CAll ListarCategoriasEvento();";
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

    public function select_SubcategoriaE($idCate)
    {
        $data = '';
        $query = "CAll ListarSubCategoriasCategoria($idCate);";
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

    public function Listar_PAcademicoXSub($idsubcate)
    {
        $data = '';
        $query = "CAll Lista_PersonalAcemicoJurado($idsubcate);";

        
        
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
    public function Listar_PAcademicoXSubJ2($idsubcate,$idpa_J1)
    {
        $data = '';
        $query = "CAll Lista_PersonalAcemicoJurado2($idsubcate,$idpa_J1);";

        
        
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
    public function Listar_PAcademicoXSubJ3($idsubcate,$idpa_J1,$idpa_J2)
    {
        $data = '';
        $query = "CAll Lista_PersonalAcemicoJurado3($idsubcate,$idpa_J1,$idpa_J2);";

        
        
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

    public function select_formatocriterio()
    {
        $data = '';
        $query = "CAll ListarFormatoCriterios();";
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

    public function lista_CriterioFormato($Id_TFormat)
    {
        $data = '';
        $query = "CAll Lista_CriterioSegunFormato($Id_TFormat);";  // IMPRIME COMO TABLA*/       



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

    public function get_Eliminar_Criterio($Idcri,$idformat)
    {
        $insertp = '';
        $query = "CAll Eliminar_Criterio($Idcri,$idformat);";        
       
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

    public function JuradoEventoA()
    {
        $data = '';
        $query = "CAll Listar_JuradoEventoActual();";
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

    public function get_Eliminar_JuradoE($idSubcateJE)
    {
        $insertp = '';
        $query = "CAll Eliminar_JuradoE($idSubcateJE);";        
       
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

    /********************************************************************* */

    public function select_J1CEA($idcea)
    {
        $data = '';
        $query = "CAll J1_Jurado_PersonalAcemico($idcea);";
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

    public function select_J2CEA($idcea)
    {
        $data = '';
        $query = "CAll J2_Jurado_PersonalAcemico($idcea);";
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

    public function select_J3CEA($idcea)
    {
        $data = '';
        $query = "CAll J3_Jurado_PersonalAcemico($idcea);";
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


    public function ObtenerDatosFormato($idcea){

        $datosCEA = '';
        $query = "Call Cargar_Datos_FormatoCriterio($idcea);";

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

    public function Criterios_Formato($idcea)
    {
        $data = '';
        $query = "CAll Lista_CriterioFormatoJE($idcea);";

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
    