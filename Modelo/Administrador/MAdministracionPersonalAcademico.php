<?php 
    require_once("../../Modelo/General/Conexionbd.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    Class AdministracionPersonalAcademicoModelo{

        public function FunObtenerListaPersonalAcademico(){
            $vlocListaPersonalAcademico = '';
            $vlocQuery = "Call Obtener_ListaPersonalAcademico();";
            
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult){
                $vlocListaPersonalAcademico = $vlocMySqli->error;
            }else{
                $vlocListaPersonalAcademico = $vlocResult;
            } 
            
            return $vlocListaPersonalAcademico;
        }

        public function FunEliminarPersonalAcademico($vparIdPersonalAcademico){
            $vlocEliminacion = 0;
            $vlocQuery = 'Call Eliminar_PersonalAcademico('.$vparIdPersonalAcademico.');';
            $vlocMySqli = Conexiondatabase::ConexionSecurity();
            $vlocResult = $vlocMySqli->query($vlocQuery);

            if(!$vlocResult)
                $vlocEliminacion = $vlocMySqli->error;
            else
                $vlocEliminacion = $vlocResult;

            return $vlocEliminacion;
        }

        public function FunEditarPersonalAcademico($vparIdPersonalAcademico, $vparTelefono, $vparCorreoElectronico,
        $vparIdGradoAcademico, $vparIdCargoAModificar, $vparIdCargo, $vparIdSede){
            $vlocEditar = '';
            $vlocQuery = "Call Modificar_PersonaAcademica(".$vparIdPersonalAcademico.",'".$vparTelefono."','".$vparCorreoElectronico."',".$vparIdGradoAcademico.",".$vparIdCargoAModificar.",".$vparIdCargo.",".$vparIdSede.");";
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
        
    }


?>