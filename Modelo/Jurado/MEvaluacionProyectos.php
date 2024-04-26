<?php 
    require_once("../../Modelo/General/Conexionbd.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    Class EvaluacionProyectosModelo{

        public function FunObtenerDatosProyectoSegunIdProyecto($vparIdProyecto){
            $vlocObtenerDatosProyectos = '';
            $vlocQuery = "Call Obtener_DatosProyectosSegunIdProyecto(".$vparIdProyecto.");";
            
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocObtenerDatosProyectos = $vlocMySqli->error;
            }else{
                $vlocObtenerDatosProyectos = $vlocResult;
            } 
            
            return $vlocObtenerDatosProyectos;
        }

        public function FunObtenerDatosIntegrantesProyectoSegunIdProyecto($vparIdProyecto){
            $vlocObtenerDatosIntegrantesProyecto = '';
            $vlocQuery = "Call Obtener_DatosIntegrantesSegunIdProyecto(".$vparIdProyecto.");";
            
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocObtenerDatosIntegrantesProyecto = $vlocMySqli->error;
            }else{
                $vlocObtenerDatosIntegrantesProyecto = $vlocResult;
            } 
            
            return $vlocObtenerDatosIntegrantesProyecto;
        }

        public function FunObtenerCriteriosEvaluacionJurado($vparIdPersonaJurado){
            $vlocObtenerCriteriosEvaluacionJuarado = '';
            $vlocQuery = "Call Obtener_CriteriosEvaluacionJurado(".$vparIdPersonaJurado.");";
            // echo $vlocQuery;
            // exit;
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocObtenerCriteriosEvaluacionJuarado = $vlocMySqli->error;
            }else{
                $vlocObtenerCriteriosEvaluacionJuarado = $vlocResult;
            } 
            
            return $vlocObtenerCriteriosEvaluacionJuarado;
        }

        public function FunObtenerCriteriosSegunIdFormato($vparIdFormato){
            $vlocObtenerCriterios = '';
            $vlocQuery = "Call Obtener_CriteriosSegunIdFormato(".$vparIdFormato.");";
            // echo $vlocQuery;
            // exit;
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocObtenerCriterios = $vlocMySqli->error;
            }else{
                $vlocObtenerCriterios = $vlocResult;
            } 
            
            return $vlocObtenerCriterios;
        }

        public function FunObtenerInformacionJuradoSegunIdPersona($vparIdPersona){
            $vlocObtenerInformacionJurado = '';
            $vlocQuery = "Call Obtener_InformacionJuradoSegunIdPersona(".$vparIdPersona.");";
            // echo $vlocQuery;
            // exit;
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocObtenerInformacionJurado = $vlocMySqli->error;
            }else{
                $vlocObtenerInformacionJurado = $vlocResult;
            } 
            
            return $vlocObtenerInformacionJurado;
        }

        //Para obtener el ide del evento feria actual
        public function FunObtenerIdEventoActual(){
            $vlocObtenerIdEventoActual = '';
            $vlocQuery = "CALL Obtener_EventoActual()";
            $vlocMysqli = Conexiondatabase::ConexionSecurity();
            $vlocResultado = $vlocMysqli->query($vlocQuery);

            if(!$vlocResultado)
                $vlocObtenerIdEventoActual = $vlocMysqli->error_log();
            else{
                while($row = $vlocResultado->fetch_array()){
                    $vlocObtenerIdEventoActual = $vlocObtenerIdEventoActual . $row[0];
                }
            }

            $vlocMysqli->close();
            return $vlocObtenerIdEventoActual;
        }

        public function FunModificarEvaluacionProyecto($vparIdEvento, $vparIdProyecto, $vparCalificacionFinal, $vparComentario){
            $vlocModificacion = 0;
            $vlocQuery = "Call Modificar_EvaluacionProyecto(".$vparIdEvento.", ".$vparIdProyecto.", '".$vparCalificacionFinal."', '".$vparComentario."');";
            // echo $vlocQuery;
            // exit;
            $vlocMySqli = Conexiondatabase::ConexionSecurity();

            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocModificacion = $vlocMySqli->error;
            }else{
                $vlocModificacion = $vlocResult;
            }

            return $vlocModificacion;
        }

        // public function FunObtenerProyectosInscritosSegunCodigoRegistroParticipante($vparCodigRegistroParticpante){
        //     $vlocObtenerProyectos = '';
        //     $vlocQuery = "Call Obtener_ProyectosInscritosSegunCodigoRegistroParticipante(".$vparCodigRegistroParticpante.");";
        //     // echo $vlocQuery;
        //     // exit;
        //     $vlocMySqli = Conexiondatabase::ConexionSecurity();
        //     $vlocResult = $vlocMySqli->query($vlocQuery);

        //     if(!$vlocResult){
        //         $vlocObtenerProyectos = $vlocMySqli->error;
        //     }else{
        //         $vlocObtenerProyectos = $vlocResult;
        //     } 
            
        //     return $vlocObtenerProyectos;
        // }

        // public function FunObtenerDatosProyectoSegunCodigoRegistroParticipanteEIdProyecto($vparCodigoRegistroParticipante, $vparIdProyecto){
        //     $vlocDatosProyectos = '';
        //     $vlocQuery = "Call Obtener_DatosProyectoSegunCodigoRegistroParticipanteEIdProyecto(".$vparCodigoRegistroParticipante.", ".$vparIdProyecto.");";
        //     // echo 'Prueba Samir: ' . $vlocQuery;
        //     // exit;
        //     $vlocMySqli = Conexiondatabase::ConexionSecurity();
        //     $vlocResult = $vlocMySqli->query($vlocQuery);

        //     if(!$vlocResult){
        //         $vlocDatosProyectos = $vlocMySqli->error;
        //     }else{
        //         $vlocDatosProyectos = $vlocResult;
        //     }

        //     return $vlocDatosProyectos;
        // }

        // public function FunObtenerDatosIntegrantesSegunIdProyecto($vparIdProyecto){
        //     $vlocDatosIntegrantes = '';
        //     $vlocQuery = "Call Obtener_DatosIntegrantesSegunIdProyecto(".$vparIdProyecto.");";
        //     // echo 'Prueba Samir: ' . $vlocQuery;
        //     // exit;
        //     $vlocMySqli = Conexiondatabase::ConexionSecurity();
        //     $vlocResult = $vlocMySqli->query($vlocQuery);

        //     if(!$vlocResult){
        //         $vlocDatosIntegrantes = $vlocMySqli->error;
        //     }else{
        //         $vlocDatosIntegrantes = $vlocResult;
        //     }

        //     return $vlocDatosIntegrantes;
        // }

        // public function FunConfirmarParticipacion($vparIdProyecto, $vparIdParticipante1, $vparIdParticipante2, $vparIdParticipante3){
        //     $vlocConfirmacion = '';
        //     $vlocQuery = "Call Confirmar_Participacion(".$vparIdProyecto.", '".$vparIdParticipante1."', '".$vparIdParticipante2."', '".$vparIdParticipante3."');";

        //     $vlocMysqli = Conexiondatabase::ConexionSecurity();
        //     $vlocResult = $vlocMysqli->query($vlocQuery);

        //     if(!$vlocResult){
        //         $vlocConfirmacion = $vlocMySqli->error;
        //     }else{
        //         $vlocConfirmacion = $vlocResult;
        //     }

        //     return $vlocConfirmacion;
        // }

        // public function FunAbandonarProyectoSiEsNecesario($vparIdProyecto){
        //     $vlocAbandono = '';
        //     $vlocQuery = "Call Abandonar_ProyectoSiEsNecesario(".$vparIdProyecto.");";

        //     $vlocMysqli = Conexiondatabase::ConexionSecurity();
        //     $vlocResult = $vlocMysqli->query($vlocQuery);

        //     if(!$vlocResult){
        //         $vlocAbandono = $vlocMySqli->error;
        //     }else{
        //         $vlocAbandono = $vlocResult;
        //     }

        //     return $vlocAbandono;
        // }

        // public function FunVerificarExistenciaProyectoSegunCodigoRegistro($vparCodigoRegistro){
        //     $vlocProyectos = '';
        //     $vlocQuery = "Call Verificar_ExistenciaProyectoSegunCodigoRegistro(".$vparCodigoRegistro.");";

        //     $vlocMySqli = Conexiondatabase::ConexionSecurity();

        //     $vlocResult = $vlocMySqli->query($vlocQuery);

        //     if(!$vlocResult){
        //         $vlocProyectos = $vlocMySqli->error;
        //     }else{
        //         $vlocProyectos = $vlocResult;
        //     }

        //     return $vlocProyectos;
        // }

        // public function FunEliminarIntegranteDeProyecto($vparIdParticipante, $vparIdProyecto){
        //     $vlocEliminacion = 0;
        //     $vlocQuery = "Call Eliminar_IntegranteDeProyecto(".$vparIdParticipante.", ".$vparIdProyecto.");";
        //     $vlocMySqli = Conexiondatabase::ConexionSecurity();

        //     $vlocResult = $vlocMySqli->query($vlocQuery);

        //     if(!$vlocResult){
        //         $vlocEliminacion = $vlocMySqli->error;
        //     }else{
        //         $vlocEliminacion = $vlocResult;
        //     }

        //     return $vlocEliminacion;
        // }
    }


?>