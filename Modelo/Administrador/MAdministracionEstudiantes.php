<?php 
    require_once("../../Modelo/General/Conexionbd.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    Class AdministracionEstudiantesModelo{

        public function FunObtenerListaEstudiantes(){
            $vlocLista = '';
            $vlocQuery = "Call Obtener_ListaEstudiantes();";
            
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocLista = $vlocMySqli->error;
            }else{
                $vlocLista = $vlocResult;
            } 
            
            return $vlocLista;
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

        public function FunObtenerListaGruposEstudiantes(){
            $vlocLista = '';
            $vlocQuery = "Call Obtener_ListaEstudiantes();";
            
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocLista = $vlocMySqli->error;
            }else{
                $vlocLista = $vlocResult;
            } 
            
            return $vlocLista;
        }

        public function FunInsercionNuevoEstudiante($numeroCarnet, $pnombre,$snombre,$papellido,$sapellido,$tel,$cedula,$correo,$sede,$grupo,$idtipou,$user,$passmod,$target_path){
            $vlocInsertUsuario = '';
            $vlocQuery = "CAll Insercion_NuevoEstudiante('$numeroCarnet','$pnombre','$snombre','$papellido','$sapellido','$tel','$cedula','$correo',$sede,$grupo,$idtipou,'$user','$passmod','$target_path');";        
        
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

        function FunEliminarEstudiante($vparIdNumeroCarnet){
            $vlocEliminacion = 0;
            $vlocQuery = "Call Eliminar_Estudiante('".$vparIdNumeroCarnet."');";
            // echo $vlocQuery;
            // exit;
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

        public function FunEditarEstudiantes($vparIdNumeroCarnet, $vparTelefono, $vparCorreoElectronico,
        $vparIdSede, $vparIdGrupo){
            $vlocEditar = '';
            $vlocQuery = "Call Modificar_Estudiante('".$vparIdNumeroCarnet."','".$vparTelefono."','".$vparCorreoElectronico."',".$vparIdSede.",".$vparIdGrupo.");";
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

        public function FunObtenerGruposSegunSede($vparIdSede){
            $vlocLista = '';
            $vlocQuery = "Call Obtener_GruposSegunSede($vparIdSede);";
            
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocLista = $vlocMySqli->error;
            }else{
                $vlocLista = $vlocResult;
            } 
            
            return $vlocLista;          
        }
        
    }


?>