<?php
session_start();

error_reporting(0);

require_once '../Controlador/UserModule.php';


$UserModule = new UserModule();

$user = $_POST['User'];
$pass = $_POST['Pass'];

$result=$UserModule->get_validar_login($user,$pass);

if ($result){

$datos = $result;

$_SESSION['Usuario'] = $datos;

If( $datos['Tipo'] == '1'){


    $_SESSION['Nombre'] = $datos['Nombre'];
    $_SESSION['logo'] = $datos['Logo'];
    exit(json_encode(
        ["status"=>"OK",
            "Location"=>"../Vista/Index-Admin.php",
            "mensaje"=>"cargando página admin"]
    ));


}else if ( $datos['Tipo'] == '2') {

    $_SESSION['Nombre'] = $datos['Nombre']. "  " .$datos['Apellido'];
    $_SESSION['Id'] = $datos['Id_Log'];
    $_SESSION['logo'] = $datos['Logo'];

    exit(json_encode(
        ["status" => "OK",
            "Location" => "../Vista/Index-Random.php",
            "mensaje" => "cargando página Random"]
    ));

    } else {
        exit(json_encode(
            ["status"=>"ERR",
                "Location"=>"../Vista/log.php",
                "mensaje"=>"no te reconozco "]
        ));
    }


}else{

    exit(json_encode(
        ["status"=>"OK",
            "Location"=>"../Vista/log.php",
            "mensaje"=>"no te reconozco thanos"]
    ));
}




?>