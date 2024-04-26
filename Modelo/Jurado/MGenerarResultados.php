<?php 
    require_once("../../Modelo/General/Conexionbd.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    Class GenerarResultadosModelo{

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

        public function FunObtenerSubCategoriasSegunJurado($vparIdPersona){
            $vlocSubCategorias = '';
            $vlocQuery = "Call Obtener_SubCategoriasSegunJurado(".$vparIdPersona.")";

            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocSubCategorias = $vlocMySqli->error;
            }else{
                $vlocSubCategorias = $vlocResult;
            } 
            
            return $vlocSubCategorias;
        }

        public function FunObtenerDatosProyectosGanadores($vparIdSubCategoria){
            $vlocDatosProyectos = '';
            $vlocQuery = "Call Obtener_DatosProyectosGanadores(".$vparIdSubCategoria.")";

            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocDatosProyectos = $vlocMySqli->error;
            }else{
                $vlocDatosProyectos = $vlocResult;
            } 
            
            return $vlocDatosProyectos;
        }

        public function FunObtenerDatosIntegrantesSegunProyecto($vparIdProyecto){
            $vlocDatosIntegrantes = '';
            $vlocQuery = "Call Obtener_DatosIntegrantesSegunIdProyecto(".$vparIdProyecto.")";


            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocDatosIntegrantes = $vlocMySqli->error;
            }else{
                $vlocDatosIntegrantes = $vlocResult;
            } 
            
            return $vlocDatosIntegrantes;
        }

        /************************************************************/       
             
    }
?>