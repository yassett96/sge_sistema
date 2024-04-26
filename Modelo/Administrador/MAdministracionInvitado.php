<?php 
    require_once("../../Modelo/General/Conexionbd.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    Class AdministracionInvitadoModelo{

        public function FunObtenerListaInvitados(){
            $vlocLista = '';
            $vlocQuery = "Call Obtener_ListaInvitados();";
            
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocLista = $vlocMySqli->error;
            }else{
                $vlocLista = $vlocResult;
            } 
            
            return $vlocLista;
        }

        public function FunInsercionNuevoInvitado($pnombre,$snombre,$papellido,$sapellido,$tel,$cedula,$correo,$grado_academico,$idtipou,$idCargo,$sede,$user,$passmod,$target_path){
            $vlocInsertUsuario = '';
            $vlocQuery = "CAll Insercion_NuevoInvitado('$pnombre','$snombre','$papellido','$sapellido','$tel','$cedula','$correo',$grado_academico,$idtipou,$idCargo, $sede, '$user', '$passmod', '$target_path');";        
        
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

        function FunEliminarInvitado($vparIdPersonalAcademico){
            $vlocEliminacion = 0;
            $vlocQuery = 'Call Eliminar_Invitado('.$vparIdPersonalAcademico.');';
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult)
                $vlocEliminacion = $vlocMySqli->error;
            else
                $vlocEliminacion = $vlocResult;

            return $vlocEliminacion;
        }

        function FunObtenerSedesInvitado(){
            $vlocListaSedes = '';
            $vlocQuery = "Call Obtener_SedesInvitados();";
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

        public function FunEditarInvitado($vparIdPersonalAcademico, $vparTelefono, $vparCorreoElectronico,
        $vparIdGradoAcademico, $vparIdSede){
            $vlocEditar = '';
            $vlocQuery = "Call Modificar_Invitado(".$vparIdPersonalAcademico.",'".$vparTelefono."','".$vparCorreoElectronico."',".$vparIdGradoAcademico.",".$vparIdSede.");";
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult)
                $vlocEditar = $vlocMySqli->error;
            else
                $vlocEditar = $vlocResult;

            return $vlocEditar;
        }
        
    }


?>