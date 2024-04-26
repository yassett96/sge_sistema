<?php
    require_once("../../Modelo/General/Conexionbd.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    Class InscripcionEventoFeriaModelo{
        /**Funciones para la inscripcion al evento Feria */        
            //Para guardar proyecto
            public function func_guardar_proyecto($vparNombre, $vparDescripcion, $vparIdSubCategoria, $vparIdPersonalAcademico, $vparRequerimiento){                            
                $insertarP = '';            
                $query = "CALL Insercion_Proyecto('".$vparNombre."', '".$vparDescripcion."', ".$vparIdSubCategoria.", ".$vparIdPersonalAcademico.", '".$vparRequerimiento."');";

                $mysqli = Conexiondatabase::ConexionSecurity();
                $result = $mysqli->query($query);

                if(!$result)
                    $insertarP = $mysqli->error;
                else
                    $insertarP = $result;

                $mysqli->close();                             

                return $insertarP;
            }

            //Función para insertar al participante en el proyecto
            public function func_Insertar_Participante_Proyecto($vparIdParticipante, $vparIdProyecto){
                $vlocInsertarPP = '';
                $vlocQuery = "CALL Insercion_ParticipanteProyecto('".$vparIdParticipante."', ".$vparIdProyecto.");";
                
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                $vlocResult = $vlocMysqli->query($vlocQuery);                        
                
                if(!$vlocResult)
                    $vlocInsertarPP = $vlocMysqli->error;
                else{
                    echo "<script>alert('Se inserto correctamente el participante');</script>";
                    $vlocInsertarPP = $vlocResult;                
                }

                $vlocMysqli->close();
                return $vlocInsertarPP;
            } 
            
            //Para insertar la relación entre el proyecto y el evento
            public function FunInsertarEventoProyecto($vparIdEvento, $vparIdProyecto){
                $vlocInsertarEP = '';
                $vlocQuery = "CALL Insercion_EventoProyecto(".$vparIdEvento.", ".$vparIdProyecto.");";
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                $vlocResultado = $vlocMysqli->query($vlocQuery);

                if(!$vlocResultado)
                    $vlocInsertarEP = $vlocMysqli->error_log();
                else{
                    while($row = $vlocResultado->fetch_array()){
                        $vlocInsertarEP = $vlocInsertarEP . $row[0];                        
                    }                     
                }

                $vlocMysqli->close();
                return $vlocInsertarEP;
            }

            //Función para verificar la exsitencia de una participante en un proyecto.
            Public Function funcVerificarExistenciaParticipanteEnProyecto($vparStrIdParticipante, $vparIntIdProyecto){
                $vlocVerificarEPP = '';

                //CREAR UNA FUNCIÓN QUE LANZE 1 Ó 0 SI SE ENCUENTRA EL PARTICIANTE EN EL PROYECTO Y ACTUALIZAR AQUÍ
                $vlocQuery="Select Verificar_ExistenciaParticipanteEnProyecto('".$vparStrIdParticipante."',".$vparIntIdProyecto.");";            
                
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                $vlocMysqli->query($vlocQuery);
                $vlocResultado = $vlocMysqli->query($vlocQuery);

                if(!$vlocResultado)
                    $vlocVerificarEPP = $vlocMysqli->error_log();
                else{                    
                    $vlocInsertarEPP = $vlocResultado;
                }
                    

                $vlocMysqli->close();
                    return $vlocVerificarEPP;
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

        /**************************************/
        
        /**Funciones Categorias */
            public function FunObtenerCategoriasSegunParticipante($vparIdNumeroCarnet){                
                $obtenerC = '';
                $query = "CAll Obtener_CategoriasSegunParticipante('".$vparIdNumeroCarnet."');";                
                $mysqli= Conexiondatabase::ConexionSecurity();
                $result = $mysqli->query($query);     
            
                if(!$result)
                    $obtenerC = $mysqli->error;
                else{
                    $obtenerC = $result;                            
                }
                
                $mysqli->close();                
                return $obtenerC;
            }
        /**************************************/

        /**Funciones Sub-Categorias */
            Public Function FunObtenerSubCategoriaSegunCategoriaYParticipante($vparNumeroCarnet, $parIdCategoria){
                $obtenerSC = '';
                $query = "CALL Obtener_SubCategoriasSegunCategoriaYParticipante('".$vparNumeroCarnet."', '".$parIdCategoria."')";                                            
                $mysqli = Conexiondatabase::ConexionSecurity();
                $result = $mysqli->query($query);                

                if(!$result)
                    $obtenerSC = $mysqli->error;
                else
                    $obtenerSC = $result;

                $mysqli->close();
                
                return $obtenerSC;    
            }
        /**************************************/

        /**Funciones Grupo */
            Public Function FuncObtenerListaGrupos(){
                $vlocObtenerGrupos = '';
                $vlocQuery = "CALL Obtener_Grupos();";
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                $vlocResultado = $vlocMysqli->query($vlocQuery);
                if(!$vlocResultado)
                    $vlocObtenerGrupos = $vlocMysqli->error;
                else
                    $vlocObtenerGrupos = $vlocResultado;

                $vlocMysqli->close();
                return $vlocObtenerGrupos;
            }

            Public Function FunObtenerGrupoSegunIdGrupo($vparIdGrupo){
                $vlocGrupo = "";
                $vlocQuery = "Call Obtener_GrupoSegunIdGrupo(".$vparIdGrupo.");";
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                $vlocResultado = $vlocMysqli->query($vlocQuery);
                if(!$vlocResultado){
                    $vlocGrupo = $vlocMysqli->error;
                    exit;
                }
                else
                    $vlocGrupo = $vlocResultado;

                
                $vlocGrupo = $vlocGrupo->fetch_array();
                $vlocGrupo = $vlocGrupo[0];

                $vlocMysqli->close();
                
                return $vlocGrupo;
            }     
                        
        /**************************************/

        /**Funciones Sede */
            Public Function FuncObtenerListaSedes(){
                $vlocObtenerSedes = '';
                $vlocQuery = "CALL Obtener_Sedes();";
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                $vlocResultado = $vlocMysqli->query($vlocQuery);

                if(!$vlocResultado)
                    $vlocObtenerSedes = $vlocMysqli->error;
                else
                    $vlocObtenerSedes = $vlocResultado;

                $vlocMysqli->close();
                return $vlocObtenerSedes;
            }

            Public Function FunObtenerSedeSegunIdSede($vparIdSede){
                $vlocSede = "";
                $vlocQuery = "Call Obtener_SedeSegunIdSede(".$vparIdSede.");";
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                $vlocResultado = $vlocMysqli->query($vlocQuery);

                if(!$vlocResultado)
                    $vlocSede = $vlocMysqli->error;
                else
                    $vlocSede = $vlocResultado;

                    $vlocSede = $vlocSede->fetch_array();
                    $vlocSede = $vlocSede[0];

                $vlocMysqli->close();
                return $vlocSede;
            }
        /**************************************/

        /**Funciones Personal Académico */
            public function FuncObtenerTutores(){
                $vlocObtenerD = '';
                $vlocQuery = "Call Obtener_Tutores();";
                
                $vlocMysqli = Conexiondatabase::ConexionSecurity();                              
                $vlocResult = $vlocMysqli->query($vlocQuery);
                
                if(!$vlocResult)
                    $vlocObtenerD = $vlocMysqli->error;
                else
                    $vlocObtenerD = $vlocResult;

                $vlocMysqli->close();

                return $vlocObtenerD;
            }
        /**************************************/

        /**Funciones Participante */
            Public Function FuncObtenerDatosParticipantePorCodigoRegistro($vparCodigoRegistro){
                $vlocObtenerPP = '';
                $vlocQuery = 'CALL Obtener_DatosParticipantePorCodigoRegistro("'.intval($vparCodigoRegistro).'");';
                
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                $vlocResult = $vlocMysqli->query($vlocQuery);
                if(!$vlocResult)
                    $vlocObtenerPP = $vlocMysqli -> error;
                else{
                    $vlocObtenerPP = $vlocResult;                
                }

                $vlocMysqli->close();                
                return $vlocObtenerPP;
            }

            Public Function FuncModificarIdGrupoParticipantePorCodigoRegistro($vparCodigoRegistro, $vparIdGrupo){
                $vlocModificarIDGPPCR = '';
                $vlocHelperPhp = new helperPhp();                
                $vlocQuery = "CALL Modificar_IdGrupoParticipantePorCodigoRegistro('".$vparCodigoRegistro."', '".$vparIdGrupo."');";
                
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                $vlocResultado=$vlocMysqli->query($vlocQuery);
                if(!$vlocResultado)
                    $vlocModificarIDGPPCR = $vlocMysqli->error_log();
                else
                    $vlocModificarIDGPPCR = $vlocResultado;

                $vlocMysqli->close();                
                return $vlocModificarIDGPPCR;
            }

            Public Function FunRegistrarEnvioMensajeConfirmacion($vparIdPersonaInscribiendo, $vparIdPersonaAInscribir, $vparCodigoConfirmacion){
                $vlocRegistrarEnvioMensajeConfirmacion = '';                      

                $vlocQuery = 'CALL Insercion_ConfirmacionParticipante("'.$vparIdPersonaInscribiendo.'", '.$vparIdPersonaAInscribir.',"'.$vparCodigoConfirmacion.'")';            
                $vlocHelper = new helperPhp();                
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                
                $vlocResultado = $vlocMysqli->query($vlocQuery);

                if(!$vlocResultado)
                    $vlocRegistrarEnvioMensajeConfirmacion = $vlocMysqli->error_log();
                else{
                    while($row = $vlocResultado->fetch_assoc()){
                        $vlocRegistrarEnvioMensajeConfirmacion = $vlocRegistrarEnvioMensajeConfirmacion . $row[1];
                    }
                }                

                $vlocMysqli->close();                
                return $vlocRegistrarEnvioMensajeConfirmacion;            
            }

            Public Function FunEliminarCodConfirmacionParticipanteTiempoExedido($vparIdPersonaInscribiendo,  $vparIdPersonaAInscribir){
                $vlocResultadoEliminacion = '';

                $vlocQuery = 'CALL Eliminar_CodConfirmacionParticipanteTiempoExedido('.$vparIdPersonaInscribiendo.', '.$vparIdPersonaAInscribir.')';

                $vlocMysqli = Conexiondatabase::ConexionSecurity();

                $vlocResultado = $vlocMysqli->query($vlocQuery);

                if(!$vlocResultado)
                    $vlocResultadoEliminacion = $vlocMysqli->error_log();                
                else{
                    while($row = $vlocResultado->fetch_assoc()){
                        $vlocResultadoEliminacion = $vlocResultadoEliminacion . $row["result"];
                    }
                }                            

                $vlocMysqli->close();
                return $vlocResultadoEliminacion;
            }

            Public Function FunEliminarRegistroConfirmacionParticipante($vparIdPersonaInscribiendo, $vparIdPersonaAInscribir){
                $vlocResultadoEliminacion = '';

                $vlocQuery = "Call Eliminar_RegistroConfirmacionParticipante(".$vparIdPersonaInscribiendo.", ".$vparIdPersonaAInscribir.");";

                $vlocMysqli = Conexiondatabase::ConexionSecurity();

                $vlocResultado = $vlocMysqli->query($vlocQuery);

                if(!$vlocResultado)
                    $vlocResultadoEliminacion = 0;
                else
                    $vlocResultadoEliminacion = 1;
                
                return $vlocResultadoEliminacion;
            }

            Public Function FunVerificarCodConfirmacionParticipante($vparCodigoConfirmacion, $vparIdPersonaInscribiendo, $vparIdPersonaAInscribir){
                $vlocResultadoVerificacion = '';
                $vlocQuery = "CALL Verificar_CodConfirmacionParticipante('".$vparCodigoConfirmacion."', ".$vparIdPersonaInscribiendo.", ". $vparIdPersonaAInscribir.")";
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                $vlocResultado = $vlocMysqli->query($vlocQuery);

                if(!$vlocResultado)
                    $vlocResultadoVerificacion = $vlocMysqli->error_log();
                else{
                    while($row = $vlocResultado->fetch_assoc()){
                        $vlocResultadoVerificacion = $vlocResultadoVerificacion . $row['result'];
                    }
                }   

                return $vlocResultadoVerificacion;
            }

            Public Function FunVerificarRegistroConfirmacionParticipante($vparIdPersonaInscribiendo, $vparIdPersonaAInscribir){                            
                $vlocResultadoVerificacion = '';
                $vlocQuery = "CALL Verificar_RegistroConfirmacionParticipante(".$vparIdPersonaInscribiendo.", ".$vparIdPersonaAInscribir.");";
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                $vlocResultado = $vlocMysqli->query($vlocQuery);

                if(!$vlocResultado)
                    $vlocResultadoVerificacion = $vlocMysqli->error_log();
                else{
                    
                    while($row = $vlocResultado->fetch_assoc()){
                        $vlocResultadoVerificacion = $vlocResultadoVerificacion . $row[1];
                    }
                }                
                                            
                return $vlocResultadoVerificacion;
            }

            Public Function FunVerificarIntegranteProyectoSegunParticipante($vparCodigoRegistro, $vparIdCategoria, $vparIdSubCategoria){
                $vlocResultadoVerificacion = '';
                $vlocQuery = 'CALL Verificar_IntegranteProyectoSegunParticipante('.$vparCodigoRegistro.', '.$vparIdCategoria.', '.$vparIdSubCategoria.');';
                // echo 'Prueba Samir: ' . $vlocQuery;
                // exit;
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                $vlocResultado = $vlocMysqli->query($vlocQuery);

                if(!$vlocResultado)
                    $vlocResultadoVerificacion = $vlocMysqli->error_log();
                else{
                    if($vlocResultado != CteValorNull){
                        while($row = $vlocResultado->fetch_array()){
                            $vlocResultadoVerificacion = $vlocResultadoVerificacion . $row[0];
                        }
                    }else
                        $vlocResultadoVerificacion = null;
                }

                return $vlocResultadoVerificacion;
            } 
            
            Public Function FunObtenerNoProyectosInscritosSegunCodRegParticipante($vparCodRegParticipante){
                $vlocNoProyectos = '';
                $vlocQuery = 'CALL Obtener_NoProyectosInscritosSegunCodRegParticipante('.$vparCodRegParticipante.');';
                // echo 'Prueba Samir: ' . $vlocQuery;
                // exit;
                $vlocMysqli = Conexiondatabase::ConexionSecurity();
                $vlocResultado = $vlocMysqli->query($vlocQuery);

                if(!$vlocResultado)
                    $vlocNoProyectos = $vlocMysqli->error_log();
                else{
                    if($vlocResultado != CteValorNull){
                        while($row = $vlocResultado->fetch_assoc()){
                            $vlocNoProyectos = $vlocNoProyectos . $row['No_Proyectos'];
                        }
                    }else
                        $vlocNoProyectos = null;
                }

                return $vlocNoProyectos;

            }
        /**************************************/
    }
?>