<?php 
    require_once("../../Modelo/General/Conexionbd.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    Class ResultadosEvaluacionesModelo{

        /**INICIO FUNCIONES PROPIAS DE LA CLASE */

        public function FunObtenerListaProyectosEvaluados($vparIdPersona){
            $vlocListaProyectosAsignados = '';
            $vlocQuery = "Call Obtener_ProyectosEvaluadosJurado(".$vparIdPersona.");";
            
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocListaProyectosAsignados = $vlocMySqli->error;
            }else{
                $vlocListaProyectosAsignados = $vlocResult;
            } 
            
            return $vlocListaProyectosAsignados;
        }

        /************************************************************/       
             
    }
?>