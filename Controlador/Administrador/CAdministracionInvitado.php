<?php

    require_once("../../Modelo/Administrador/MAdministracionInvitado.php");
    require_once ("../../Modelo/General/Createavatar.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");    
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    // $vgDetallesProyectosInscritos = new AdministracionPersonalAcademicoModelo();
    $vgHelperPhp = new helperPhp();

    if(isset($_GET["vparIdPersonalAcademicoEliminar"])){  
        
        $vlocIdPersonalAcademico = $_GET["vparIdPersonalAcademicoEliminar"];

        $vlocVerificador = FunEliminarInvitado($vlocIdPersonalAcademico);

        echo $vlocVerificador;
    }

    if(isset($_GET["vparObtenerListaInvitados"])){
        $vlocArrayListaInvitados = FunObtenerListaInvitados();
        $vlocListaInvitados = implode(',', $vlocArrayListaInvitados);
        echo $vlocListaInvitados;
    }

    if(isset($_GET["vparIdPersonalAcademico"]) && isset($_GET["vparTelefono"]) && 
    isset($_GET["vparCorreoElectronico"]) && isset($_GET["vparIdGradoAcademico"]) && 
    isset($_GET["vparIdSede"])){

        $vlocIdPersonalAcademico = $_GET["vparIdPersonalAcademico"];
        $vlocTelefono = $_GET["vparTelefono"];
        $vlocCorreoElectronico = $_GET["vparCorreoElectronico"];
        $vlocIdGradoAcademico = $_GET["vparIdGradoAcademico"];
        $vlocIdSede = $_GET["vparIdSede"];

        $vlocResultadoEdicion = FunEditarInvitado($vlocIdPersonalAcademico, $vlocTelefono, $vlocCorreoElectronico,
        $vlocIdGradoAcademico, $vlocIdSede);

        echo $vlocResultadoEdicion;
    }

    if(isset($_GET["vparBoolGuardarInvitado"]) ){

        $pnombre = $_POST['pname'];
        $snombre = $_POST['sname'];
        $papellido = $_POST['papellido'];
        $sapellido = $_POST['sapellido'];
        $tel = $_POST['tel'];
        $cedula = $_POST['cedula'];
        $correo = $_POST['correo'];        
        $grado_academico = $_POST['gradoA'];
        
        $idtipou = CtePersonalAcademico;
        $idCargo = CteInvitado;

        $sede = $_POST['sede'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $nameFirstChar =$pnombre[0];
        $nameSecondChar = $papellido[0];
        $target_path = createAvatarImage($nameFirstChar,$nameSecondChar);

        $passmod = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 8]);
        
        $vlocResult = FunInsercionNuevoInvitado($pnombre,$snombre,$papellido,$sapellido,$tel,$cedula,$correo,$grado_academico,$idtipou,$idCargo,$sede,$user,$passmod,$target_path);
        // echo 'Llegamos aquí';
        // exit;
        echo $vlocResult;
    }

    function FunObtenerListaInvitados(){
        $vlocLista = new AdministracionInvitadoModelo();

        $vlocResultado = $vlocLista->FunObtenerListaInvitados();

        $vlocDatos = array();

        if($vlocResultado == true){
            $vlocNumDatos = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                // array_push($vlocDatos, '<tr><td id="tdIdInvitadoSeleccionado" style="display:none;">'.$vlocRow['ID_Personal_Academico'].'</td><td>'.$vlocRow['Primer_Nombre'].' '.$vlocRow['Segundo_Nombre'].'</td><td>'.$vlocRow['Primer_Apellido'].' '.$vlocRow['Segundo_Apellido'].'</td><td>'.$vlocRow['Telefono'].'</td><td>'.$vlocRow['Correo_Electronico'].'</td><td>'.$vlocRow['Cedula'].'</td><td>'.$vlocRow['Grado_Academico'].'</td><td>'.$vlocRow['Sede'].'</td></tr>');
                array_push($vlocDatos, '<tr><td id="tdIdInvitadoSeleccionado" style="display:none;">'.$vlocRow['ID_Personal_Academico'].'</td><td>'.$vlocRow['Primer_Nombre'].' '.$vlocRow['Segundo_Nombre'].'</td><td>'.$vlocRow['Primer_Apellido'].' '.$vlocRow['Segundo_Apellido'].'</td><td>'.$vlocRow['Telefono'].'</td><td>'.$vlocRow['Correo_Electronico'].'</td><td>'.$vlocRow['Grado_Academico'].'</td><td>'.$vlocRow['Sede'].'</td></tr>');
            }                

            return $vlocDatos;
        }
    }

    function FunEliminarInvitado($vparIdPersonalAcademico){
        $vlocEliminacion = new AdministracionInvitadoModelo();

        $vlocResultado = $vlocEliminacion->FunEliminarInvitado($vparIdPersonalAcademico);
        // echo $vlocResultado;
        // exit;

        $vlocResultadoEliminacion = '';

        if($vlocResultado == true){
            $vlocNumFilasResultado = $vlocResultado->num_rows;                

            while($vlocRow = $vlocResultado->fetch_assoc()){
                $vlocResultadoEliminacion .= $vlocRow["Resultado_Eliminacion"];
            }

            return $vlocResultadoEliminacion;
        }
    }

    function FunEditarInvitado($vparIdPersonalAcademico, $vparTelefono, $vparCorreoELectronico,
    $vparIdGradoAcademico, $vparIdSede){
        $vlocEdicion = new AdministracionInvitadoModelo();

        $vlocResultado = $vlocEdicion->FunEditarInvitado($vparIdPersonalAcademico, $vparTelefono, $vparCorreoELectronico,
        $vparIdGradoAcademico, $vparIdSede);
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

    function FunInsercionNuevoInvitado($pnombre,$snombre,$papellido,$sapellido,$tel,$cedula,$correo,$grado_academico,$idtipou,$idCargo,$sede,$user,$passmod,$target_path){
        $vlocInsercion = new AdministracionInvitadoModelo();

        $vlocResultado = $vlocInsercion->FunInsercionNuevoInvitado($pnombre,$snombre,$papellido,$sapellido,$tel,$cedula,$correo,$grado_academico,$idtipou,$idCargo,$sede,$user,$passmod,$target_path);
        // echo $vlocResultado;
        // exit;

        $vlocResultadoInsercion = '';

        if($vlocResultado == true){
            $vlocNumFilasResultado = $vlocResultado->num_rows;

            // for($i=0; $i<$vlocNumFilasResultado; $i++){
            //     $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                
            //     $vlocResultadoEliminacion = $vlocRow['Resultado_Eliminacion'];
            // }                

            while($vlocRow = $vlocResultado->fetch_assoc()){
                $vlocResultadoInsercion .= $vlocRow["Resultado_Insercion"];
            }
            // echo "Llegamos aquí";
            // exit;

            return $vlocResultadoInsercion;
        }
    }

    function FunVerificarTelefonoCorreo($tel,$correo){
        $vlocVerificacion = new PersonaModelo();
        $vlocResultado = $vlocVerificacion->put_buscar_registros($tel,$correo,'','');

        return $vlocResultado;
    }

?>