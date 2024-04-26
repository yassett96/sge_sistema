<?php

    require_once("../../Modelo/Administrador/MAdministracionPersonalAcademico.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");    
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    // $vgDetallesProyectosInscritos = new AdministracionPersonalAcademicoModelo();
    $vgHelperPhp = new helperPhp();

    if(isset($_GET["vparIdPersonalAcademicoEliminar"])){  
        
        $vlocIdPersonalAcademico = $_GET["vparIdPersonalAcademicoEliminar"];

        $vlocVerificador = FunEliminarPersonalAcademico($vlocIdPersonalAcademico);

        echo $vlocVerificador;
    }

    if(isset($_GET["vparObtenerListaPersonalAcademico"])){
        $vlocArrayListaPersonalAcademico = FunObtenerListaPersonalAcademico();
        $vlocListaPersonalAcademico = implode(',', $vlocArrayListaPersonalAcademico);
        echo $vlocListaPersonalAcademico;
    }

    if(isset($_GET["vparIdPersonalAcademico"]) && isset($_GET["vparTelefono"]) && 
    isset($_GET["vparCorreoElectronico"]) && isset($_GET["vparIdGradoAcademico"]) && 
    isset($_GET["vparIdCargoAModificar"]) && isset($_GET["vparIdCargo"]) && 
    isset($_GET["vparIdSede"])){

        $vlocIdPersonalAcademico = $_GET["vparIdPersonalAcademico"];
        $vlocTelefono = $_GET["vparTelefono"];
        $vlocCorreoElectronico = $_GET["vparCorreoElectronico"];
        $vlocIdGradoAcademico = $_GET["vparIdGradoAcademico"];
        $vlocIdCargoAModificar = $_GET["vparIdCargoAModificar"];
        $vlocIdCargo = $_GET["vparIdCargo"];
        $vlocIdSede = $_GET["vparIdSede"];

        $vlocResultadoEdicion = FunEditarPersonalAcademico($vlocIdPersonalAcademico, $vlocTelefono, $vlocCorreoElectronico,
        $vlocIdGradoAcademico, $vlocIdCargoAModificar, $vlocIdCargo, $vlocIdSede);

        echo $vlocResultadoEdicion;
    }

    function FunObtenerListaPersonalAcademico(){
        $vlocListaPersonalAcademico = new AdministracionPersonalAcademicoModelo();

        $vlocResultado = $vlocListaPersonalAcademico->FunObtenerListaPersonalAcademico();

        $vlocDatosPersonalAcademico = array();

        if($vlocResultado == true){
            $vlocNumDatosPersonalAcademico = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosPersonalAcademico; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocDatosPersonalAcademico, '<tr><td id="tdIdPersonalAcademicoSeleccionado" style="display:none;">'.$vlocRow['ID_Personal_Academico'].'</td><td>'.$vlocRow['Primer_Nombre'].' '.$vlocRow['Segundo_Nombre'].'</td><td>'.$vlocRow['Primer_Apellido'].' '.$vlocRow['Segundo_Apellido'].'</td><td>'.$vlocRow['Grado_Academico'].'</td><td id="tdIdCargoAModificar" style="display:none;">'.$vlocRow['ID_Cargo'].'</td><td>'.$vlocRow['Cargo'].'</td><td>'.$vlocRow['Sede'].'</td><td>'.$vlocRow['Telefono'].'</td><td>'.$vlocRow['Correo_Electronico'].'</td></tr>,');
            }                

            return $vlocDatosPersonalAcademico;
        }
    }

    function FunEliminarPersonalAcademico($vparIdPersonalAcademico){
        $vlocEliminacion = new AdministracionPersonalAcademicoModelo();

        $vlocResultado = $vlocEliminacion->FunEliminarPersonalAcademico($vparIdPersonalAcademico);
        // echo $vlocResultado;
        // exit;

        $vlocResultadoEliminacion = '';

        if($vlocResultado == true){
            $vlocNumFilasResultado = $vlocResultado->num_rows;

            // for($i=0; $i<$vlocNumFilasResultado; $i++){
            //     $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                
            //     $vlocResultadoEliminacion = $vlocRow['Resultado_Eliminacion'];
            // }                

            while($vlocRow = $vlocResultado->fetch_assoc()){
                $vlocResultadoEliminacion .= $vlocRow["Resultado_Eliminacion"];
            }


            return $vlocResultadoEliminacion;
        }
    }

    function FunEditarPersonalAcademico($vparIdPersonalAcademico, $vparTelefono, $vparCorreoELectronico,
    $vparIdGradoAcademico, $vparIdCargoAModificar, $vparIdCargo, $vparIdSede){
        $vlocEdicion = new AdministracionPersonalAcademicoModelo();

        $vlocResultado = $vlocEdicion->FunEditarPersonalAcademico($vparIdPersonalAcademico, $vparTelefono, $vparCorreoELectronico,
        $vparIdGradoAcademico, $vparIdCargoAModificar, $vparIdCargo, $vparIdSede);
        // echo $vlocResultado;
        // exit;

        $vlocResultadoEdicion = '';

        if($vlocResultado == true){
            $vlocNumFilasResultado = $vlocResultado->num_rows;

            // for($i=0; $i<$vlocNumFilasResultado; $i++){
            //     $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                
            //     $vlocResultadoEliminacion = $vlocRow['Resultado_Eliminacion'];
            // }                

            while($vlocRow = $vlocResultado->fetch_assoc()){
                $vlocResultadoEdicion .= $vlocRow["Resultado"];
            }


            return $vlocResultadoEdicion;
        }
    }

    function FunVerificarTelefonoCorreo($tel,$correo){
        $vlocVerificacion = new PersonaModelo();
        $vlocResultado = $vlocVerificacion->put_buscar_registros($tel,$correo,'','');

        return $vlocResultado;
    }

?>