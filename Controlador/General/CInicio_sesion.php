<?php

session_start();

require_once ("../../Modelo/General/MInicio_sesion.php");

$logins = new MInicio_Sesion();

$user = $_POST['usuarioD'];
$pass = $_POST['contraD'];

define("MAXIMOS_INTENTOS", 3);

/*$pass = password_verify($contra,$hash);*/

$passatiempo=$logins->ConsultarPassatiempo($user);
$cred = $passatiempo;

if ($cred == NUll){
    exit(json_encode(
        ["status"=>"ERR",
            "Location"=>"../../Vista/General/Iniciar_Sesion.php",
            "mensaje"=> "Usuario o Contraseña incorrecta "]
    ));
} 

$ValidaTUsuario = $logins->ValidarTipoUsuarioE($cred['ID_Persona']);

if ($ValidaTUsuario == 1){
    exit(json_encode(
        ["status"=>"ERR",
            "Location"=>"../../Vista/General/Iniciar_Sesion.php",
            "mensaje"=> "Usuario no válido en este tipo de acceso"]
    ));
} 

$conteoIntentos = $logins->ConsultarIntentos($cred['ID_Persona']);


if ($conteoIntentos >= MAXIMOS_INTENTOS) {

    exit(json_encode(
        ["status"=>"ERR",
            "Location"=>"../../Vista/General/Iniciar_Sesion.php",
            "mensaje"=> "Has intentando muchas veces, Intentalo en 10 minutos."]
    ));
   
}else{

$intento = $conteoIntentos+1;
$opor = MAXIMOS_INTENTOS-$intento;


if (password_verify($pass, $cred['Contraseña']))
{
    $E_Intentos=$logins->EliminarIntento($cred['ID_Persona']);

    $result=$logins->ConsultarUsuario($user,$cred['Contraseña'] );

    //echo($result);
    //exit;

    $_SESSION['campo']=$result;

    if($result){
    $listaTUsuario = $logins->ListarUsuario($result);
   
    header('Content-Type: application/json');

    exit(json_encode(
        [
            "status"=>"OK",
            "lista"=>$listaTUsuario]
    ));
    
    }

    $res= true;
}else{
    $A_Intentos=$logins->AgregarIntento($cred['ID_Persona']);

    if ($intento == 1){
    exit(json_encode(
        ["status"=>"ERR",
            "Location"=>"../../Vista/General/Iniciar_Sesion.php",
            "mensaje"=> "Usuario o Contraseña incorrecta, Intento ". $intento ." Registrado, te quedan ". $opor ." Oportunidades"]
    ));}

    if($intento == 2){
        exit(json_encode(
            ["status"=>"ERR",
                "Location"=>"../../Vista/General/Iniciar_Sesion.php",
                "mensaje"=> "Usuario o Contraseña incorrecta, Intento ". $intento ." Registrado, te queda ". $opor ." Oportunidad mas"]
        ));
    }

    if($intento == 3){
        exit(json_encode(
            ["status"=>"ERR",
                "Location"=>"../../Vista/General/Iniciar_Sesion.php",
                "mensaje"=> "Usuario o Contraseña incorrecta, Intento ". $intento ." Registrado, No te quedan Oportunidades, Intentalo en 10 minutos"]
        ));
    }
    $res= false;
}
}

?>