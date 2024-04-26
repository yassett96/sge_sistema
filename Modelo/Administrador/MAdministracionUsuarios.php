<?php 
    require_once("../../Modelo/General/Conexionbd.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    Class AdministracionUsuarioModelo{

        public function FunObtenerListaUsuarios(){
            $vlocListaUsuarios = '';
            $vlocQuery = "Call Obtener_ListaUsuarios();";
            
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocListaUsuarios = $vlocMySqli->error;
            }else{
                $vlocListaUsuarios = $vlocResult;
            } 
            
            return $vlocListaUsuarios;
        }

        public function BuscarRegistroTelRepetido($vparTel, $vparIdPersona){
            $dato='';
    
            if($query = "CALL Buscar_TelefonoRepetido('".$vparTel."', ".$vparIdPersona.");")
            {
                // echo $query;
                // exit;
                $mysqli= Conexiondatabase::ConexionSecurity();
                $result = $mysqli->query($query);
                if($result){
                    while($row = $result->fetch_array()){
                        if($row[0] > 0){
                            $dato = 1;
                        }else{
                            $dato = 0;
                        }
                        $mysqli->close();
                    }
                }
            } 
            return $dato;
        }

        public function BuscarRegistroCorreoRepetido($vparCorreo, $vparIdPersona){
            $dato='';
    
            if($query = "CALL Buscar_CorreoRepetido('".$vparCorreo."', ".$vparIdPersona.");")
            {
                // echo $query;
                // exit;
                $mysqli= Conexiondatabase::ConexionSecurity();
                $result = $mysqli->query($query);
                if($result){
                    while($row = $result->fetch_array()){
                        if($row[0] > 0){
                            $dato = 1;
                        }else{
                            $dato = 0;
                        }
                        $mysqli->close();
                    }
                }
            } 
            return $dato;
        }

        public function FunObtenerListaUsuariosNoAsignadosAPersonaParaSelect($vparIdPersona)
        {
            $vlocData = '';
            $vlocQuery = "CAll Obtener_ListaUsuariosNoAsignadosAPersonaParaSelect(".$vparIdPersona.");";
            // echo $vlocQuery;
            // exit;
            $vlocMySqli= Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);
            if($vlocResult){
                while ($valores = $vlocResult->fetch_array()){
                    $vlocData .= $valores[0];
                }
                $vlocResult ->close();
            };
            
            $vlocMySqli->close();
            return $vlocData;
        }

        public function FunObtenerIDSedeSegunNombre($vparNombrePersona){
            $vlocData = '';
            $vlocQuery = "CAll Obtener_IdSedeSegunNombre('".$vparNombrePersona."');";
            // echo $vlocQuery;
            // exit;
            $vlocMySqli= Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);
            if($vlocResult){
                while ($valores = $vlocResult->fetch_array()){
                    $vlocData .= $valores[0];
                }
                $vlocResult ->close();
            };
            
            $vlocMySqli->close();
            return $vlocData;
        }

        public function FunEliminarUsuario($vparIdPersonaUsuario){
            $vlocEliminacion = 0;
            $vlocQuery = 'Call Eliminar_Usuario('.$vparIdPersonaUsuario.');';
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult)
                $vlocEliminacion = $vlocMySqli->error;
            else
                $vlocEliminacion = $vlocResult;

            return $vlocEliminacion;
        }

        public function FunEditarUsuario($vparIdPersonaUsuario, $vparIdTipoUsuarioAModificar, 
            $vparIdTipoUsuarioParticipante, $vparTelefonoParticipante, $vparCorreoElectronicoParticipante,
            $vparSedeParticipante, $vparGrupoParticipante, $vparTipoUsuarioPersonalAcademico, $vparTelefonoPersonalAcademico,
            $vparCorreoElectronicoPersonalAcademico, $vparSedePersonalAcademico, $vparGradoAcademicoPersonalAcademico, 
            $vparIdRolPersonalAcademico, $vparCargoPersonalAcademico, $vparCargoAEditarPersonalAcademico,
            $vparTipoUsuario, $vparTelefono, $vparCorreoElectronico){
            
            $vlocEditar = '';
            $vlocQuery = "Call Modificar_Usuario(".$vparIdPersonaUsuario.",".$vparIdTipoUsuarioAModificar.",". 
                $vparIdTipoUsuarioParticipante.",'".$vparTelefonoParticipante."','".$vparCorreoElectronicoParticipante."',".
                $vparSedeParticipante.",".$vparGrupoParticipante.",".$vparTipoUsuarioPersonalAcademico.",'".$vparTelefonoPersonalAcademico."','".
                $vparCorreoElectronicoPersonalAcademico."',".$vparSedePersonalAcademico.",".$vparGradoAcademicoPersonalAcademico.",".
                $vparIdRolPersonalAcademico.",'".$vparCargoPersonalAcademico."','".
                $vparCargoAEditarPersonalAcademico."',".$vparTipoUsuario.",'".$vparTelefono."','".$vparCorreoElectronico."');";
            // echo $vlocQuery;
            // exit;
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult)
                $vlocEditar = $vlocMySqli->error;
            else
                $vlocEditar = $vlocResult;

            return $vlocEditar;
        }

        public function FunInsercionNuevoUsuario($pnombre,$snombre,$papellido,$sapellido,$tel,$correo,
        $idtipou,$user,$passmod,$cedula,$target_path,$vlocNoCarnetParticipante, $vlocIdSedeParticipante,
        $vlocIdGrupoParticipante, $vlocIdGradoAcademicoPersonalAcademico, $vlocIdSedePersonalAcademico,
        $vlocCargoPersonalAcademico, $vlocIdRolPersonalAcademico){
            
            $vlocInsertUsuario = '';
            $vlocQuery = "CAll Insercion_NuevoUsuario('".$pnombre."','".$snombre."','".$papellido."','".$sapellido."','".$tel."','"
            .$correo."',".$idtipou.",'".$user."','".$passmod."','".$cedula."', '".$target_path."','".$vlocNoCarnetParticipante."',"
            .$vlocIdSedeParticipante.", ".$vlocIdGrupoParticipante.",".$vlocIdGradoAcademicoPersonalAcademico.",".$vlocIdSedePersonalAcademico.",'"
            .$vlocCargoPersonalAcademico."',".$vlocIdRolPersonalAcademico.");";

            // echo $vlocQuery;
            // exit;
        
            $vlocMySqli= Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);
            if(!$vlocResult){
                $vlocInsertUsuario = $vlocMySqli->error;
            }else{
                $vlocInsertUsuario = $vlocResult;
            }
            $vlocMySqli->close();
            return $vlocInsertUsuario;
        }

        public function FunAgregarUsuarioAPersona($vparIdPersona, $vparIdTipoUsuario, $vparSedeParticipante,
        $vparGrupoParticipante, $vparCarnetParticipante, $vparSedePersonalAcademico, $vparGradoAcademicoPersonalAcademico,
        $vparRolPersonalAcademico, $vparCargoPersonalAcademico){

            $vlocInsertUsuario = '';
            $vlocQuery = "CAll Agregar_UsuarioAPersona(".$vparIdPersona.", ".$vparIdTipoUsuario.", ".$vparSedeParticipante.", ".$vparGrupoParticipante.",'".
            $vparCarnetParticipante."', ".$vparSedePersonalAcademico.",".$vparGradoAcademicoPersonalAcademico.",".$vparRolPersonalAcademico.",'".$vparCargoPersonalAcademico."');";        
        
            // echo $vlocQuery;
            // exit;
        
            $vlocMySqli= Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);
            if(!$vlocResult){
                $vlocInsertUsuario = $vlocMySqli->error;
            }else{
                $vlocInsertUsuario = $vlocResult;
            }
            $vlocMySqli->close();
            return $vlocInsertUsuario;
        }

        public function FunVerificarExistenciaNoCarnet($NoCarnet){
            $vlocLista = '';
            $vlocQuery = "Call Verificar_ExistenciaNoCarnet('$NoCarnet');";
            
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocLista = $vlocMySqli->error;
            }else{
                $vlocLista = $vlocResult;
            } 
            
            return $vlocLista;
        }

        public function FunVerificarCedula($cedula){
            $vlocVerificacion = '';
            $vlocQuery = "Call Verificar_ExistenciaCedula('$cedula');";
            
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocVerificacion = $vlocMySqli->error;
            }else{
                $vlocVerificacion = $vlocResult;
            } 
            
            return $vlocVerificacion;
        }

        public function FunObtenerIdPersonaSegunIdPersonaUsuario($vparIdPersonaUsuario){
            $vlocIdPersona = '';
            $vlocQuery = "Call Obtener_IdPersonaSegunIDPersonaUsuario(".$vparIdPersonaUsuario.");";
            // echo $vlocQuery;
            // exit;
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult)
                $vlocIdPersona = $vlocMySqli->error;
            else
                $vlocIdPersona = $vlocResult;

            return $vlocIdPersona;
        }

        public function lista_sedegrupo($Id_sede)
        {
            $data = '';
            $query = "CAll Listar_SedeGrupo($Id_sede);";

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