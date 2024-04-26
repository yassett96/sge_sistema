<?php
    require_once("../../Modelo/Administrador/MAdministracionUsuarios.php");
    require_once ("../../Modelo/General/Createavatar.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");    
    require_once("../../Assets/AuxiliarPhp/Constants.php");
    require_once ("../../Modelo/General/MGrupo.php");

    if(isset($_GET["vparIdPersonaUsuarioEliminar"])){  
        
        $vlocIdPersonaUsuario = $_GET["vparIdPersonaUsuarioEliminar"];

        $vlocVerificador = FunEliminarUsuario($vlocIdPersonaUsuario);

        echo $vlocVerificador;
    }

    if(isset($_GET["vparIdPersona_ListaUsuariosNoAsignados"])){  
        
        $vlocIdPersona = $_GET["vparIdPersona_ListaUsuariosNoAsignados"];

        $vlocVerificador = FunObtenerListaUsuariosNoAsignadosAPersonaParaSelect($vlocIdPersona);

        echo $vlocVerificador;
    }

    if(isset($_GET["vparNombreSede"])){  
        
        $vlocNombreSede = $_GET["vparNombreSede"];

        $vlocVerificador = FunObtenerIDSedeSegunNombre($vlocNombreSede);

        echo $vlocVerificador;
    }
    

    if(isset($_GET["vparObtenerListaUsuario"])){
        $vlocArrayListaUsuarios = FunObtenerListaUsuarios();
        $vlocListaUsuarios = implode(',', $vlocArrayListaUsuarios);
        echo $vlocListaUsuarios;
    }


    if(isset($_GET["vparIdPersonaUsuario"]) && isset($_GET["vparIdTipoUsuarioAModificar"]) &&
    isset($_GET["vparIdTipoUsuarioParticipante"]) && isset($_GET["vparTelefonoParticipante"]) &&
    isset($_GET["vparCorreoElectronicoParticipante"]) && isset($_GET["vparSedeParticipante"]) &&
    isset($_GET["vparGrupoParticipante"]) && isset($_GET["vparTipoUsuarioPersonalAcademico"]) &&
    isset($_GET["vparTelefonoPersonalAcademico"]) && isset($_GET["vparCorreoElectronicoPersonalAcademico"]) &&
    isset($_GET["vparSedePersonalAcademico"]) && isset($_GET["vparGradoAcademicoPersonalAcademico"]) &&
    isset($_GET["vparIdRolPersonalAcademico"]) && isset($_GET["vparCargoPersonalAcademico"]) && 
    isset($_GET['vparCargoAEditarPersonalAcademico']) && isset($_GET["vparTipoUsuario"]) && 
    isset($_GET["vparTelefono"]) && isset($_GET["vparCorreoElectronico"])){
        
        $vlocIdPersonaUsuario = $_GET["vparIdPersonaUsuario"];
        $vlocIdTipoUsuarioAModificar = $_GET["vparIdTipoUsuarioAModificar"];
        $vlocIdTipoUsuarioParticipante = $_GET["vparIdTipoUsuarioParticipante"];
        $vlocTelefonoParticipante = $_GET["vparTelefonoParticipante"];
        $vlocCorreoElectronicoParticipante = $_GET["vparCorreoElectronicoParticipante"];
        $vlocSedeParticipante = $_GET["vparSedeParticipante"];
        $vlocGrupoParticipante = $_GET["vparGrupoParticipante"];
        $vlocTipoUsuarioPersonalAcademico = $_GET["vparTipoUsuarioPersonalAcademico"];
        $vlocTelefonoPersonalAcademico = $_GET["vparTelefonoPersonalAcademico"];
        $vlocCorreoElectronicoPersonalAcademico = $_GET["vparCorreoElectronicoPersonalAcademico"];
        $vlocSedePersonalAcademico = $_GET["vparSedePersonalAcademico"];
        $vlocGradoAcademicoPersonalAcademico = $_GET["vparGradoAcademicoPersonalAcademico"];
        $vlocIdRolPersonalAcademico = $_GET["vparIdRolPersonalAcademico"];
        $vlocCargoPersonalAcademico = $_GET["vparCargoPersonalAcademico"];
        $vlocCargoAEditarPersonalAcademico = $_GET["vparCargoAEditarPersonalAcademico"];
        $vlocTipoUsuario = $_GET["vparTipoUsuario"];
        $vlocTelefono = $_GET["vparTelefono"];
        $vlocCorreoElectronico = $_GET["vparCorreoElectronico"];

        $vlocResultadoEdicion = FunEditarUsuario($vlocIdPersonaUsuario, $vlocIdTipoUsuarioAModificar, 
        $vlocIdTipoUsuarioParticipante, $vlocTelefonoParticipante, $vlocCorreoElectronicoParticipante,
        $vlocSedeParticipante, $vlocGrupoParticipante, $vlocTipoUsuarioPersonalAcademico, $vlocTelefonoPersonalAcademico,
        $vlocCorreoElectronicoPersonalAcademico, $vlocSedePersonalAcademico, $vlocGradoAcademicoPersonalAcademico, 
        $vlocIdRolPersonalAcademico, $vlocCargoPersonalAcademico, $vlocCargoAEditarPersonalAcademico,
        $vlocTipoUsuario, $vlocTelefono, $vlocCorreoElectronico);
        

        echo $vlocResultadoEdicion;
    }

    if(isset($_GET["vparPNombre"]) && isset($_GET["vparSNombre"]) && 
    isset($_GET["vparPApellido"]) && isset($_GET["vparSApellido"]) &&
    isset($_GET["vparTelefono"]) && isset($_GET["vparCorreo"]) && 
    isset($_GET["vparIdTipoU"]) && isset($_GET["vparUsuario"]) && 
    isset($_GET["vparContrasena"]) && isset($_GET["vparCedula"]) &&
    isset($_GET["vparNoCarnetParticipante"]) && isset($_GET["vparIdSedeParticipante"]) && 
    isset($_GET["vparIdGrupoParticipante"]) && isset($_GET["vparIdGradoAcademicoPersonalAcademico"]) && 
    isset($_GET["vparIdSedePersonalAcademico"]) && isset($_GET["vparCargoPersonalAcademico"]) && 
    isset($_GET["vparIdRolPersonalAcademico"])){        

        $pnombre = $_GET['vparPNombre'];
        $snombre = $_GET['vparSNombre'];
        $papellido = $_GET['vparPApellido'];
        $sapellido = $_GET['vparSApellido'];
        $tel = $_GET['vparTelefono'];

        $correo = $_GET['vparCorreo'];
        $cedula = $_GET['vparCedula'];

        $idtipou = $_GET['vparIdTipoU'];

        $user = $_GET['vparUsuario'];
        $pass = $_GET['vparContrasena'];

        $vlocNoCarnetParticipante = $_GET["vparNoCarnetParticipante"];
        $vlocIdSedeParticipante = $_GET["vparIdSedeParticipante"];
        $vlocIdGrupoParticipante = $_GET["vparIdGrupoParticipante"];
        $vlocIdGradoAcademicoPersonalAcademico = $_GET["vparIdGradoAcademicoPersonalAcademico"];
        $vlocIdSedePersonalAcademico = $_GET["vparIdSedePersonalAcademico"];
        $vlocCargoPersonalAcademico = $_GET["vparCargoPersonalAcademico"];
        $vlocIdRolPersonalAcademico = $_GET["vparIdRolPersonalAcademico"];
        
        $nameFirstChar =$pnombre[0];
        $nameSecondChar = $papellido[0];
        $target_path = createAvatarImage($nameFirstChar,$nameSecondChar);

        $passmod = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 8]);
        
        $vlocResult = FunInsercionNuevoUsuario($pnombre,$snombre,$papellido,$sapellido,$tel,$correo,
        $idtipou,$user,$passmod,$cedula,$target_path,$vlocNoCarnetParticipante, $vlocIdSedeParticipante,
        $vlocIdGrupoParticipante, $vlocIdGradoAcademicoPersonalAcademico, $vlocIdSedePersonalAcademico,
        $vlocCargoPersonalAcademico, $vlocIdRolPersonalAcademico);

        echo $vlocResult;
    }

    if(isset($_GET["vparIdPersonaUsuarioObtenerIdPersona"])){  
        
        $vlocIdPersonaUsuario = $_GET["vparIdPersonaUsuarioObtenerIdPersona"];

        $vlocIdPersona = FunObtenerIdPersonaSegunIdPersonaUsuario($vlocIdPersonaUsuario);
        
        echo $vlocIdPersona;
    }


    if(isset($_GET["vparIdPersona_AgregarUsuario"]) &&
    isset($_GET["vparIdTipoUsuario_AgregarUsuario"]) &&
    isset($_GET["vparSedeParticipante"]) &&
    isset($_GET["vparGrupoParticipante"]) &&
    isset($_GET["vparCarnetParticipante"]) &&
    isset($_GET["vparSedePersonalAcademico"]) &&
    isset($_GET["vparGradoAcademicoPersonalAcademico"]) &&
    isset($_GET["vparRolPersonalAcademico"]) &&
    isset($_GET["vparCargoPersonalAcademico"])){  
        
        $vlocIdPersona = $_GET["vparIdPersona_AgregarUsuario"];
        $vlocIdTipoUsuario = $_GET["vparIdTipoUsuario_AgregarUsuario"];

        $vlocSedeParticipante = $_GET["vparSedeParticipante"];
        $vlocGrupoParticipante = $_GET["vparGrupoParticipante"];
        $vlocCarnetParticipante = $_GET["vparCarnetParticipante"];
        $vlocSedePersonalAcademico = $_GET["vparSedePersonalAcademico"];
        $vlocGradoAcademicoPersonalAcademico = $_GET["vparGradoAcademicoPersonalAcademico"];
        $vlocRolPersonalAcademico = $_GET["vparRolPersonalAcademico"];
        $vlocCargoPersonalAcademico = $_GET["vparCargoPersonalAcademico"];

        $vlocIdPersona = FunAgregarUsuarioAPersona($vlocIdPersona, $vlocIdTipoUsuario, $vlocSedeParticipante,
        $vlocGrupoParticipante, $vlocCarnetParticipante, $vlocSedePersonalAcademico, $vlocGradoAcademicoPersonalAcademico,
        $vlocRolPersonalAcademico, $vlocCargoPersonalAcademico);

        echo $vlocIdPersona;
    }

    if(isset($_GET['vparIdSede'])){
        $vlocIdSede = $_GET["vparIdSede"];

        $vlocListaGrupos = FunListarGruposSegunSede($vlocIdSede);

        echo $vlocListaGrupos;
    }

    if(isset($_GET["vparNoCarnetVerificacion"])){
        $vlocNoCarnet = $_GET["vparNoCarnetVerificacion"];
        $vlocResultado = FunVerificarExistenciaNoCarnet($vlocNoCarnet);
        echo $vlocResultado;
    }

    if(isset($_GET["vparCedulaVerificacion"])){
        $vlocCedula = $_GET["vparCedulaVerificacion"];
        $vlocResultado = FunVerificarCedula($vlocCedula);
        echo $vlocResultado;
    }

    if (isset($_GET['vparTelRepetido']) && isset($_GET['vparIdPersonaRepetido']))  {

        $vlocTel = $_GET['vparTelRepetido'];
        $vlocIdPersona = $_GET['vparIdPersonaRepetido'];
    
        $vlocResultado = BuscarRegistroTelRepetido($vlocTel, $vlocIdPersona);
        
        echo $vlocResultado;
        exit;
    }

    if (isset($_GET['vparCorreoRepetido']) && isset($_GET['vparIdPersonaRepetido']))  {

        $vlocCorreo = $_GET['vparCorreoRepetido'];
        $vlocIdPersona = $_GET['vparIdPersonaRepetido'];
    
        $vlocResultado = BuscarRegistroCorreoRepetido($vlocCorreo, $vlocIdPersona);
        
        echo $vlocResultado;
        exit;
    }

    function BuscarRegistroCorreoRepetido($vparCorreo, $vparIdPersona){
        $vlocEditarCuenta = new AdministracionUsuarioModelo();
    
        $vlocResult = $vlocEditarCuenta->BuscarRegistroCorreoRepetido($vparCorreo, $vparIdPersona);
    
        return $vlocResult;
    }

    function BuscarRegistroTelRepetido($vparTel, $vparIdPersona){
        $vlocEditarCuenta = new AdministracionUsuarioModelo();
    
        $vlocResult = $vlocEditarCuenta->BuscarRegistroTelRepetido($vparTel, $vparIdPersona);
    
        return $vlocResult;
    }
    
    function FunListarGruposSegunSede($vparIdSede){
        $AdministracionUsuarioModelo = new AdministracionUsuarioModelo();        

        $result = $AdministracionUsuarioModelo->lista_sedegrupo($vparIdSede);

        return $result;        
    }


    function FunObtenerListaUsuarios(){
        $vlocListaUsuairos = new AdministracionUsuarioModelo();

        $vlocResultado = $vlocListaUsuairos->FunObtenerListaUsuarios();

        $vlocDatosUsuarios = array();

        if($vlocResultado == true){
            $vlocNumDatosPersonalAcademico = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosPersonalAcademico; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);

                // Verificar y reemplazar valores vacíos con '--'
                foreach ($vlocRow as $key => $value) {
                    if (empty($value)) {
                        $vlocRow[$key] = '---';
                    }
                }

                array_push($vlocDatosUsuarios, '<tr><td id="tdIdUsuarioSeleccionado" style="display:none;">'.$vlocRow['ID_Persona_Usuario'].'</td><td id="tdIdTipoUsuarioSeleccionado" style="display:none;">'.$vlocRow['ID_Tipo_Usuario'].'</td><td>'.$vlocRow['Tipo_Usuario'].'</td><td>'.$vlocRow['Primer_Nombre'].' '.$vlocRow['Segundo_Nombre'].'</td><td>'.$vlocRow['Primer_Apellido'].' '.$vlocRow['Segundo_Apellido'].'</td><td>'.$vlocRow['Telefono'].'</td><td>'.$vlocRow['Correo_Electronico'].'</td><td>'.$vlocRow['Cedula'].'</td><td>'.$vlocRow['Sede_Participante'].'</td><td>'.$vlocRow['Sede_Personal_Academico'].'</td><td>'.$vlocRow['Grupo'].'</td><td>'.$vlocRow['Grado_Academico'].'</td><td>'.$vlocRow['Rol'].'</td><td>'.$vlocRow['Cargo'].'</td><td>'.$vlocRow['ID_Numero_Carnet'].'</td></tr>,');
            }                

            return $vlocDatosUsuarios;
        }
    }

    function FunEliminarUsuario($vparIdPersonalAcademico){
        $vlocEliminacion = new AdministracionUsuarioModelo();

        $vlocResultado = $vlocEliminacion->FunEliminarUsuario($vparIdPersonalAcademico);
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

    function FunEditarUsuario($vparIdPersonaUsuario, $vparIdTipoUsuarioAModificar, 
    $vparIdTipoUsuarioParticipante, $vparTelefonoParticipante, $vparCorreoElectronicoParticipante,
    $vparSedeParticipante, $vparGrupoParticipante, $vparTipoUsuarioPersonalAcademico, $vparTelefonoPersonalAcademico,
    $vparCorreoElectronicoPersonalAcademico, $vparSedePersonalAcademico, $vparGradoAcademicoPersonalAcademico, 
    $vparIdRolPersonalAcademico, $vparCargoPersonalAcademico, $vparCargoAEditarPersonalAcademico,
    $vparTipoUsuario, $vparTelefono, $vparCorreoElectronico){
        $vparEdicion = new AdministracionUsuarioModelo();

        $vlocResultado = $vparEdicion->FunEditarUsuario($vparIdPersonaUsuario, $vparIdTipoUsuarioAModificar, 
        $vparIdTipoUsuarioParticipante, $vparTelefonoParticipante, $vparCorreoElectronicoParticipante,
        $vparSedeParticipante, $vparGrupoParticipante, $vparTipoUsuarioPersonalAcademico, $vparTelefonoPersonalAcademico,
        $vparCorreoElectronicoPersonalAcademico, $vparSedePersonalAcademico, $vparGradoAcademicoPersonalAcademico, 
        $vparIdRolPersonalAcademico, $vparCargoPersonalAcademico, $vparCargoAEditarPersonalAcademico,
        $vparTipoUsuario, $vparTelefono, $vparCorreoElectronico);
        // echo $vlocResultado;
        // exit;

        $vlocResultadoEdicion = '';

        if($vlocResultado == true){
            $vlocNumFilasResultado = $vlocResultado->num_rows;           

            while($vlocRow = $vlocResultado->fetch_assoc()){
                $vlocResultadoEdicion .= $vlocRow["Resultado_Edicion"];
            }


            return $vlocResultadoEdicion;
        }
    }

    function FunInsercionNuevoUsuario($pnombre,$snombre,$papellido,$sapellido,$tel,$correo,
        $idtipou,$user,$passmod,$cedula,$target_path,$vlocNoCarnetParticipante, $vlocIdSedeParticipante,
        $vlocIdGrupoParticipante, $vlocIdGradoAcademicoPersonalAcademico, $vlocIdSedePersonalAcademico,
        $vlocCargoPersonalAcademico, $vlocIdRolPersonalAcademico){
        
        $vlocInsercion = new AdministracionUsuarioModelo();

        $vlocResultado = $vlocInsercion->FunInsercionNuevoUsuario($pnombre,$snombre,$papellido,$sapellido,$tel,$correo,
        $idtipou,$user,$passmod,$cedula,$target_path,$vlocNoCarnetParticipante, $vlocIdSedeParticipante,
        $vlocIdGrupoParticipante, $vlocIdGradoAcademicoPersonalAcademico, $vlocIdSedePersonalAcademico,
        $vlocCargoPersonalAcademico, $vlocIdRolPersonalAcademico);
        // echo $vlocResultado;
        // exit;

        $vlocResultadoInsercion = '';

        if($vlocResultado == true){
            $vlocNumFilasResultado = $vlocResultado->num_rows;

            while($vlocRow = $vlocResultado->fetch_assoc()){
                $vlocResultadoInsercion .= $vlocRow["Resultado_Insercion"];
            }


            return $vlocResultadoInsercion;
        }
    }

    function FunVerificarExistenciaNoCarnet($NoCarnet){
        $vlocVerificacion = new AdministracionUsuarioModelo();

        $vlocResultado = $vlocVerificacion->FunVerificarExistenciaNoCarnet($NoCarnet);

        $vloc = $vlocResultado->fetch_assoc();

        $vlocValue = $vloc['Resultado_Verificacion'];

        return $vlocValue;
    }

    function FunVerificarCedula($cedula){
        $vlocVerificacion = new AdministracionUsuarioModelo();

        $vlocResultado = $vlocVerificacion->FunVerificarCedula($cedula);

        $vloc = $vlocResultado->fetch_assoc();

        $vlocValue = $vloc['Resultado_Verificacion'];

        return $vlocValue;
    }

    function FunAgregarUsuarioAPersona($vparIdPersona, $vparIdTipoUsuario, $vparSedeParticipante,
    $vparGrupoParticipante, $vparCarnetParticipante, $vparSedePersonalAcademico, $vparGradoAcademicoPersonalAcademico,
    $vparRolPersonalAcademico, $vparCargoPersonalAcademico){
        $vlocInsercion = new AdministracionUsuarioModelo();

        $vlocResultado = $vlocInsercion->FunAgregarUsuarioAPersona($vparIdPersona, $vparIdTipoUsuario, $vparSedeParticipante,
        $vparGrupoParticipante, $vparCarnetParticipante, $vparSedePersonalAcademico, $vparGradoAcademicoPersonalAcademico,
        $vparRolPersonalAcademico, $vparCargoPersonalAcademico);
        // echo $vlocResultado;
        // exit;

        $vlocResultadoInsercion = '';

        if($vlocResultado == true){
            $vlocNumFilasResultado = $vlocResultado->num_rows;

            while($vlocRow = $vlocResultado->fetch_assoc()){
                $vlocResultadoInsercion .= $vlocRow["Resultado_Agregado"];
            }

            return $vlocResultadoInsercion;
        }
    }

    function FunObtenerIdPersonaSegunIdPersonaUsuario($vparIdPersonaUsuario){
        $vlocIdPersona = new AdministracionUsuarioModelo();

        $vlocResultado = $vlocIdPersona->FunObtenerIdPersonaSegunIdPersonaUsuario($vparIdPersonaUsuario);
        // echo $vlocResultado;
        // exit;

        $vlocResult = '';

        if($vlocResultado == true){
            $vlocNumFilasResultado = $vlocResultado->num_rows;

            // for($i=0; $i<$vlocNumFilasResultado; $i++){
            //     $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                
            //     $vlocResultadoEliminacion = $vlocRow['Resultado_Eliminacion'];
            // }                
            
            while($vlocRow = $vlocResultado->fetch_assoc()){
                $vlocResult .= $vlocRow["Id_Persona"];
            }

            return $vlocResult;
        }
    }

    function FunObtenerListaUsuariosNoAsignadosAPersonaParaSelect($vparIdPersona){
        $vlocUsuarioModelo = new AdministracionUsuarioModelo();

        $vlocResultado = $vlocUsuarioModelo->FunObtenerListaUsuariosNoAsignadosAPersonaParaSelect($vparIdPersona);

        return $vlocResultado;
    }

    function FunObtenerIDSedeSegunNombre($vparNombrePersona){
        $vlocUsuarioModelo = new AdministracionUsuarioModelo();

        $vlocResultado = $vlocUsuarioModelo->FunObtenerIDSedeSegunNombre($vparNombrePersona);

        return $vlocResultado;
    }

    function FunVerificarTelefonoCorreo($tel,$correo){
        $vlocVerificacion = new PersonaModelo();
        $vlocResultado = $vlocVerificacion->put_buscar_registros($tel,$correo,'','');

        return $vlocResultado;
    }
?>