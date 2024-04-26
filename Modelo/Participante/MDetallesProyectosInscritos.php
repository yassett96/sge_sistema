<?php 
    require_once("../../Modelo/General/Conexionbd.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    Class DetallesProyectosInscritosModelo{

        public function FunObtenerProyectosInscritosSegunCodigoRegistroParticipante($vparCodigRegistroParticpante){
            $vlocObtenerProyectos = '';
            $vlocQuery = "Call Obtener_ProyectosInscritosSegunCodigoRegistroParticipante(".$vparCodigRegistroParticpante.");";
            // echo $vlocQuery;
            // exit;
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocObtenerProyectos = $vlocMySqli->error;
            }else{
                $vlocObtenerProyectos = $vlocResult;
            } 
            
            return $vlocObtenerProyectos;
        }

        public function FunObtenerDatosProyectoSegunCodigoRegistroParticipanteEIdProyecto($vparCodigoRegistroParticipante, $vparIdProyecto){
            $vlocDatosProyectos = '';
            $vlocQuery = "Call Obtener_DatosProyectoSegunCodigoRegistroParticipanteEIdProyecto(".$vparCodigoRegistroParticipante.", ".$vparIdProyecto.");";
            // echo 'Prueba Samir: ' . $vlocQuery;
            // exit;
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocDatosProyectos = $vlocMySqli->error;
            }else{
                $vlocDatosProyectos = $vlocResult;
            }

            return $vlocDatosProyectos;
        }

        public function FunObtenerDatosIntegrantesSegunIdProyecto($vparIdProyecto){
            $vlocDatosIntegrantes = '';
            $vlocQuery = "Call Obtener_DatosIntegrantesSegunIdProyectoDetallesProyecto(".$vparIdProyecto.");";
            // echo 'Prueba Samir: ' . $vlocQuery;
            // exit;
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocDatosIntegrantes = $vlocMySqli->error;
            }else{
                $vlocDatosIntegrantes = $vlocResult;
            }

            return $vlocDatosIntegrantes;
        }

        public function FunObtenerConfirmacionParticipante($vparIdParticipante, $vparIdProyecto){
            $vlocConfirmacionParticipante = '';
            $vlocQuery = "Call Obtener_ConfirmacionParticipanteProyecto('".$vparIdParticipante."', ".$vparIdProyecto.");";
            // echo $vlocQuery;
            // exit;
            $vlocMysqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMysqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocConfirmacionParticipante = $vlocMySqli->error;
            }else{
                $vlocConfirmacionParticipante = $vlocResult;
            }

            return $vlocConfirmacionParticipante;
        }

        public function FunConfirmarParticipacion($vparIdProyecto, $vparIdParticipante1, $vparIdParticipante2, $vparIdParticipante3){
            $vlocConfirmacion = '';
            $vlocQuery = "Call Confirmar_Participacion(".$vparIdProyecto.", '".$vparIdParticipante1."', '".$vparIdParticipante2."', '".$vparIdParticipante3."');";

            $vlocMysqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMysqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocConfirmacion = $vlocMySqli->error;
            }else{
                $vlocConfirmacion = $vlocResult;
            }

            return $vlocConfirmacion;
        }

        public function FunAbandonarProyectoSiEsNecesario($vparIdProyecto){
            $vlocAbandono = '';
            $vlocQuery = "Call Abandonar_ProyectoSiEsNecesario(".$vparIdProyecto.");";

            $vlocMysqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMysqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocAbandono = $vlocMySqli->error;
            }else{
                $vlocAbandono = $vlocResult;
            }

            return $vlocAbandono;
        }

        public function FunVerificarExistenciaProyectoSegunCodigoRegistro($vparCodigoRegistro){
            $vlocProyectos = '';
            $vlocQuery = "Call Verificar_ExistenciaProyectoSegunCodigoRegistro(".$vparCodigoRegistro.");";

            $vlocMySqli = Conexiondatabase::ConexionSecurity();

            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocProyectos = $vlocMySqli->error;
            }else{
                $vlocProyectos = $vlocResult;
            }

            return $vlocProyectos;
        }

        public function FunEliminarIntegranteDeProyecto($vparIdParticipante, $vparIdProyecto){
            $vlocEliminacion = 0;
            $vlocQuery = "Call Eliminar_IntegranteDeProyecto(".$vparIdParticipante.", ".$vparIdProyecto.");";
            $vlocMySqli = Conexiondatabase::ConexionSecurity();

            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocEliminacion = $vlocMySqli->error;
            }else{
                $vlocEliminacion = $vlocResult;
            }

            return $vlocEliminacion;
        }
    }


?>