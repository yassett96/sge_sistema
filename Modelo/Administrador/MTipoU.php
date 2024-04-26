<?php

require_once ("../../Modelo/General/Conexionbd.php");

class TipoUModel{

    public function select_tipoU()
    {
        $data = '';
        $query = "CAll Listar_TipoU();";
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

    public function select_tipoU_AdminUsuarios()
    {
        $data = '';
        $query = "CAll Listar_TipoU_AdminUsuarios();";
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

    public function select_sede($idsede,$idgrupo)
    {
        $data = '';
        $query = "CAll Prueb_select($idsede,$idgrupo);";
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

    //No pasa por ningún controlador, directamente al select box de html
    public function FunObtenerListaGradoAcademico()
    {
        $vlocListaGradoAcademico = '';
        $vlocQuery = "CAll Obtener_ListagradoAcademico();";
        $vlocMySqli= Conexiondatabase::ConexionSecurity();
        $vlocResult = $vlocMySqli->query($vlocQuery);

        if(!$vlocResult){
            $vlocListaGradoAcademico = $vlocMySqli->error;
            return $vlocListaGradoAcademico;
        }else{
            $vlocDatosGradoAcademico = array();

            $vlocNumDatosGradoAcademico = $vlocResult->num_rows;

            for($i=0; $i<$vlocNumDatosGradoAcademico; $i++){
                $vlocRow = mysqli_fetch_array($vlocResult, MYSQLI_BOTH);
                array_push($vlocDatosGradoAcademico, '<option value="'.$vlocRow["ID_Grado_Academico"].'">'.$vlocRow["Grado_Academico"].'</option>,');                
            }                

            $vlocDatosGradoAcademico = implode(",", $vlocDatosGradoAcademico);            
        }        
        return $vlocDatosGradoAcademico;
    }

    public function FunObtenerListaCargos(){
        $vlocListaCargos = '';
        $vlocQuery = "Call Obtener_Cargos();";
        $vlocMySqli = Conexiondatabase::ConexionSecurity();
        $vlocResult = $vlocMySqli->query($vlocQuery);

        if(!$vlocResult){
            $vlocListaCargos = $vlocMySqli->error;
            return $vlocListaCargos;
        }else{
            $vlocDatosCargos = array();

            $vlocNumDatosCargos = $vlocResult->num_rows;

            for($i=0; $i<$vlocNumDatosCargos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResult, MYSQLI_BOTH);
                array_push($vlocDatosCargos, '<option value="'.$vlocRow["ID_Cargo"].'">'.$vlocRow["Cargo"].'</option>,');                
            } 

            $vlocDatosCargos = implode(",", $vlocDatosCargos);
        }
        return $vlocDatosCargos;
    }

    public function FunObtenerListaRoles(){
        $vlocListaCargos = '';
        $vlocQuery = "Call Obtener_Roles();";
        $vlocMySqli = Conexiondatabase::ConexionSecurity();
        $vlocResult = $vlocMySqli->query($vlocQuery);

        if(!$vlocResult){
            $vlocListaCargos = $vlocMySqli->error;
            return $vlocListaCargos;
        }else{
            $vlocDatosCargos = array();

            $vlocNumDatosCargos = $vlocResult->num_rows;

            for($i=0; $i<$vlocNumDatosCargos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResult, MYSQLI_BOTH);
                array_push($vlocDatosCargos, '<option value="'.$vlocRow["ID_Rol"].'">'.$vlocRow["Rol"].'</option>,');                
            } 

            $vlocDatosCargos = implode(",", $vlocDatosCargos);
        }
        return $vlocDatosCargos;
    }

    public function FunObtenerSedes(){
        $vlocListaSedes = '';
        $vlocQuery = "Call Obtener_Sedes();";
        $vlocMySqli = Conexiondatabase::ConexionSecurity();
        $vlocResult = $vlocMySqli->query($vlocQuery);

        if(!$vlocResult){
            $vlocListaSedes = $vlocMySqli->error;
            return $vlocListaSedes;
        }else{
            $vlocDatosSedes = array();

            $vlocNumDatosSedes = $vlocResult->num_rows;

            for($i=0; $i<$vlocNumDatosSedes; $i++){
                $vlocRow = mysqli_fetch_array($vlocResult, MYSQLI_BOTH);
                array_push($vlocDatosSedes, '<option value="'.$vlocRow["ID_Sede"].'">'.$vlocRow["Sede"].'</option>,');                
            } 

            $vlocDatosSedes = implode(",", $vlocDatosSedes);
        }
        return $vlocDatosSedes;
    }


}

?>