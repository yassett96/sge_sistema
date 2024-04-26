<?php

    require_once("../../Modelo/Administrador/MAdministracionEstudiantes.php");
    require_once("../../Modelo/Participante/MPersona.php");
    require_once ("../../Modelo/General/Createavatar.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");    
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    // $vgDetallesProyectosInscritos = new AdministracionPersonalAcademicoModelo();
    $vgHelperPhp = new helperPhp();

    if(isset($_GET["vparIdNumeroCarnetEliminar"])){  
        
        $vlocIdNumeroCarnet = $_GET["vparIdNumeroCarnetEliminar"];

        $vlocVerificador = FunEliminarEstudiante($vlocIdNumeroCarnet);

        echo $vlocVerificador;
    }

    if(isset($_GET["vparTelefonoVerif"]) && isset($_GET["vparCorreoVerif"])){  

        $vlocTelefono = $_GET["vparTelefonoVerif"];
        $vlocCorreo = $_GET["vparCorreoVerif"];

        $vlocVerificador = FunVerificarTelefonoCorreo($vlocTelefono,$vlocCorreo);

        echo $vlocVerificador;
    }

    if(isset($_GET["vparIdSedeBuscarGrupo"])){  
        
        $vlocIdSede = $_GET["vparIdSedeBuscarGrupo"];

        $vlocVerificador = FunObtenerGruposSegunSede($vlocIdSede);
        $vlocListaGrupos = implode(',', $vlocVerificador);

        echo $vlocListaGrupos;
    }

    if(isset($_GET["vparNoCarnetVerificar"])){  
        
        $vlocNoCarnet = $_GET["vparNoCarnetVerificar"];

        $vlocVerificador = FunVerificarExistenciaNoCarnet($vlocNoCarnet);
        // $vlocverificacion = implode(',', $vlocVerificador);

        // echo $vlocverificacion;
        echo $vlocVerificador;
    }

    if(isset($_GET["vparObtenerListaEstudiantes"])){
        $vlocArrayListaEstudiantes = FunObtenerListaEstudiantes();
        $vlocListaEstudiantes = implode(',', $vlocArrayListaEstudiantes);
        echo $vlocListaEstudiantes;
    }

    if(isset($_GET["vparIdNumeroCarnet"]) && isset($_GET["vparTelefono"]) && 
    isset($_GET["vparCorreoElectronico"]) && isset($_GET["vparIdSede"]) && 
    isset($_GET["vparIdGrupo"])){

        $vlocIdNumeroCarnet = $_GET["vparIdNumeroCarnet"];
        $vlocTelefono = $_GET["vparTelefono"];
        $vlocCorreoElectronico = $_GET["vparCorreoElectronico"];
        $vlocIdSede = $_GET["vparIdSede"];
        $vlocIdGrupo = $_GET["vparIdGrupo"];

        $vlocResultadoEdicion = FunEditarEstudiantes($vlocIdNumeroCarnet, $vlocTelefono, $vlocCorreoElectronico,
        $vlocIdSede, $vlocIdGrupo);

        echo $vlocResultadoEdicion;
    }

    if(isset($_GET["vparBoolGuardarEstudiante"]) ){

        $pnombre = $_POST['pname'];
        $snombre = $_POST['sname'];
        $papellido = $_POST['papellido'];
        $sapellido = $_POST['sapellido'];
        $tel = $_POST['tel'];
        $cedula = $_POST['cedula'];
        $correo = $_POST['correo']; 
        $sede = $_POST['sede'];       
        $grupo = $_POST['grupo'];
        $numeroCarnet = $_POST['numeroCarnet'];
        // $grado_academico = $_POST['gradoA'];
        
        $idtipou = CteParticipante;
        
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $nameFirstChar =$pnombre[0];
        $nameSecondChar = $papellido[0];
        $target_path = createAvatarImage($nameFirstChar,$nameSecondChar);

        $passmod = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 8]);
        
        $vlocResult = FunInsercionNuevoEstudiante($numeroCarnet,$pnombre,$snombre,$papellido,$sapellido,$tel,$cedula,$correo,$sede,$grupo,$idtipou,$user,$passmod,$target_path);
        // echo 'Llegamos aquí';
        // exit;
        echo $vlocResult;
    }

    function FunObtenerListaEstudiantes(){
        $vlocLista = new AdministracionEstudiantesModelo();

        $vlocResultado = $vlocLista->FunObtenerListaEstudiantes();

        $vlocDatos = array();

        if($vlocResultado == true){
            $vlocNumDatos = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                // array_push($vlocDatos, '<tr><td id="tdIdInvitadoSeleccionado" style="display:none;">'.$vlocRow['ID_Personal_Academico'].'</td><td>'.$vlocRow['Primer_Nombre'].' '.$vlocRow['Segundo_Nombre'].'</td><td>'.$vlocRow['Primer_Apellido'].' '.$vlocRow['Segundo_Apellido'].'</td><td>'.$vlocRow['Telefono'].'</td><td>'.$vlocRow['Correo_Electronico'].'</td><td>'.$vlocRow['Cedula'].'</td><td>'.$vlocRow['Grado_Academico'].'</td><td>'.$vlocRow['Sede'].'</td></tr>');
                array_push($vlocDatos, '<tr><td id="tdIdEstudianteSeleccionado" style="display:none;">'.$vlocRow['ID_Numero_Carnet'].'</td><td>'.$vlocRow['Primer_Nombre'].' '.$vlocRow['Segundo_Nombre'].'</td><td>'.$vlocRow['Primer_Apellido'].' '.$vlocRow['Segundo_Apellido'].'</td><td>'.$vlocRow['Telefono'].'</td><td>'.$vlocRow['Correo_Electronico'].'</td><td>'.$vlocRow['Cedula'].'</td><td id="tdIdSedeSeleccionado" style="display:none;">'.$vlocRow['ID_Sede'].'</td><td>'.$vlocRow['Sede'].'</td><td>'.$vlocRow['grupo'].'</td></tr>');
            }                

            return $vlocDatos;
        }
    }

    function FunVerificarExistenciaNoCarnet($NoCarnet){
        $vlocVerificacion = new AdministracionEstudiantesModelo();

        $vlocResultado = $vlocVerificacion->FunVerificarExistenciaNoCarnet($NoCarnet);
        // echo $vlocResultado;
        // exit;

        $vlocResultadoVerificacion = '';

        if($vlocResultado == true){
            $vlocNumFilasResultado = $vlocResultado->num_rows;                

            while($vlocRow = $vlocResultado->fetch_assoc()){
                $vlocResultadoVerificacion .= $vlocRow["Resultado_Verificacion"];
            }

            return $vlocResultadoVerificacion;
        }
    }

    function FunEliminarEstudiante($vparIdPersonalAcademico){
        $vlocEliminacion = new AdministracionEstudiantesModelo();

        $vlocResultado = $vlocEliminacion->FunEliminarEstudiante($vparIdPersonalAcademico);
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

    function FunObtenerGruposSegunSede($vparIdSede){
        $vlocLista = new AdministracionEstudiantesModelo();

        $vlocResultado = $vlocLista->FunObtenerGruposSegunSede($vparIdSede);

        $vlocDatos = array();

        if($vlocResultado == true){
            $vlocNumDatos = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                // array_push($vlocDatos, '<tr><td id="tdIdInvitadoSeleccionado" style="display:none;">'.$vlocRow['ID_Personal_Academico'].'</td><td>'.$vlocRow['Primer_Nombre'].' '.$vlocRow['Segundo_Nombre'].'</td><td>'.$vlocRow['Primer_Apellido'].' '.$vlocRow['Segundo_Apellido'].'</td><td>'.$vlocRow['Telefono'].'</td><td>'.$vlocRow['Correo_Electronico'].'</td><td>'.$vlocRow['Cedula'].'</td><td>'.$vlocRow['Grado_Academico'].'</td><td>'.$vlocRow['Sede'].'</td></tr>');
                array_push($vlocDatos, '<option value="'.$vlocRow['ID_Grupo'].'">'.$vlocRow['Grupo'].'</option>');
            }                

            return $vlocDatos;
        }
    }

    function FunEditarEstudiantes($vparIdNumeroCarnet, $vparTelefono, $vparCorreoElectronico,
    $vparIdSede, $vparIdGrupo){
        $vlocEdicion = new AdministracionEstudiantesModelo();

        $vlocResultado = $vlocEdicion->FunEditarEstudiantes($vparIdNumeroCarnet, $vparTelefono, $vparCorreoElectronico,
        $vparIdSede, $vparIdGrupo);
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

    function FunInsercionNuevoEstudiante($numeroCarnet,$pnombre,$snombre,$papellido,$sapellido,$tel,$cedula,$correo,$sede,$grupo,$idtipou,$user,$passmod,$target_path){
        $vlocInsercion = new AdministracionEstudiantesModelo();

        $vlocResultado = $vlocInsercion->FunInsercionNuevoEstudiante($numeroCarnet,$pnombre,$snombre,$papellido,$sapellido,$tel,$cedula,$correo,$sede,$grupo,$idtipou,$user,$passmod,$target_path);
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