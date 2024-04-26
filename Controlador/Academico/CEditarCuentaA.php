<?php

session_start();

if($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] !="3" && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] !="6"){
    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();
} 

require_once ("../../Modelo/Academico/MEditarCuentaA.php");

$pamodelocuenta = new EditarCuentaModeloA();

$id = $_SESSION['Idpersona'];
$idusuario = $_SESSION['ID_Tipo_Usuario']; 
$tel = $_POST['tel'];
$correo = $_POST['email'];

$result = $pamodelocuenta->BuscarRegistro($id,$tel,$correo);

if($result !== ""){
    echo $result;
}else {
    $resultado = $pamodelocuenta->ActualizarDatosPA($id, $tel, $correo);
}

$IdPAcademico = $pamodelocuenta->ListarDatosAcademico($id, $idusuario);


$datosPa = $IdPAcademico;

        $_SESSION['PersonaAcademica'] = $datosPa;

        if($datosPa['ID_Tipo_Usuario'] == '3'){
        
            $_SESSION['Telefono']= $datosPa['Telefono'];
            $_SESSION['Email'] = $datosPa['Correo_Electronico'];
        }


?>