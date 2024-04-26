<?php
require_once ("../../Modelo/Participante/MEditarCuenta.php");
session_start();


if (!isset($_SESSION['Participantes']) or $_SESSION['Participantes']['ID_Tipo_Usuario']  != "1")  {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

if (isset($_GET['vparTel']))  {

    $vlocTel = $_GET['vparTel'];

    $vlocResultado = BuscarRegistroTel($vlocTel);
    
    echo $vlocResultado;
    exit;
}

if (isset($_GET['vparTelRepetido']) && isset($_GET['vparIdPersonaRepetido']))  {

    $vlocTel = $_GET['vparTelRepetido'];
    $vlocIdPersona = $_GET['vparIdPersonaRepetido'];

    $vlocResultado = BuscarRegistroTelRepetido($vlocTel, $vlocIdPersona);
    
    echo $vlocResultado;
    exit;
}

if (isset($_GET['vparCorreo']))  {

    $vlocCorreo = $_GET['vparCorreo'];

    $vlocResultado = BuscarRegistroCorreo($vlocCorreo);
    
    echo $vlocResultado;
    exit;
}

if (isset($_GET['vparBoolObtenerIdPersona']))  {

    $vlocIdParticipante = $_SESSION['Idpersona'];        
    
    echo $vlocIdParticipante;
    exit;
}

if (isset($_GET['vparCorreoRepetido']) && isset($_GET['vparIdPersonaRepetido']))  {

    $vlocCorreo = $_GET['vparCorreoRepetido'];
    $vlocIdPersona = $_GET['vparIdPersonaRepetido'];

    $vlocResultado = BuscarRegistroCorreoRepetido($vlocCorreo, $vlocIdPersona);
    
    echo $vlocResultado;
    exit;
}

if (isset($_GET['vparCedulaRepetido']) && isset($_GET['vparIdPersonaRepetido']))  {

    $vlocCedula = $_GET['vparCedulaRepetido'];
    $vlocIdPersona = $_GET['vparIdPersonaRepetido'];

    $vlocResultado = BuscarRegistroCedulaRepetido($vlocCedula, $vlocIdPersona);
    
    echo $vlocResultado;
    exit;
}

$modelocuenta = new EditarCuentaModelo();

$id = $_SESSION['Idpersona'];
$tel = $_POST['tel'];
$correo = $_POST['email'];
$grupo = $_POST['sgrupo'];

$result = $modelocuenta->BuscarRegistro($id,$tel,$correo);

if($result !== ""){
    echo $result;
}else {
    $resultado = $modelocuenta->ActualizarDatos($id, $tel, $correo, $grupo);
}

$IdParticipante = $modelocuenta->ListarDatosParticipante($id);



$datosPer = $IdParticipante;

    $_SESSION['Participantes'] = $datosPer;

    if($datosPer['ID_Tipo_Usuario'] == '1'){
    
        $_SESSION['Telefono']= $datosPer['Telefono'];
        $_SESSION['Correo'] = $datosPer['Correo_Electronico'];
        $_SESSION['Grupo'] = $datosPer['grupo'];
        $_SESSION['IdGrupo'] = $datosPer['ID_Grupo'];
        $_SESSION['IdSede'] = $datosPer['ID_Sede'];
        $_SESSION['IdPersona'] = $datosPer['ID_Persona'];
    }

function BuscarRegistroTel($vlocTel){
    $vlocEditarCuenta = new EditarCuentaModelo();

    $vlocResult = $vlocEditarCuenta->BuscarRegistroTel($vlocTel);

    return $vlocResult;
}

function BuscarRegistroTelRepetido($vparTel, $vparIdPersona){
    $vlocEditarCuenta = new EditarCuentaModelo();

    $vlocResult = $vlocEditarCuenta->BuscarRegistroTelRepetido($vparTel, $vparIdPersona);

    return $vlocResult;
}

function BuscarRegistroCorreo($vlocCorreo){
    $vlocEditarCuenta = new EditarCuentaModelo();

    $vlocResult = $vlocEditarCuenta->BuscarRegistroCorreo($vlocCorreo);

    return $vlocResult;
}

function BuscarRegistroCorreoRepetido($vparCorreo, $vparIdPersona){
    $vlocEditarCuenta = new EditarCuentaModelo();

    $vlocResult = $vlocEditarCuenta->BuscarRegistroCorreoRepetido($vparCorreo, $vparIdPersona);

    return $vlocResult;
}

function BuscarRegistroCedulaRepetido($vparCedula, $vparIdPersona){
    $vlocEditarCuenta = new EditarCuentaModelo();

    $vlocResult = $vlocEditarCuenta->BuscarRegistroCedulaRepetido($vparCedula, $vparIdPersona);

    return $vlocResult;
}
?>