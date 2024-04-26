<?php
session_start();

if($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 2 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != "6"){
    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();
} 

require_once ("../../Modelo/Jurado/MEditarContra.php");

$modelEditContra = new EditarContraAModelo();

$id = $_SESSION['Idpersona'];
//$passactual = $_SESSION['Contra'];
$nuevopass = $_POST['npass'];
$confirmarpass = $_POST['cpass'];


    if($nuevopass != $confirmarpass){
        exit(json_encode(
            ["status"=>"ERR",
                "mensaje"=>"Las contraseñas no coinciden."]
        )); 
    } else {
        $ncontra = password_hash($nuevopass, PASSWORD_DEFAULT, ['cost' => 8]);

        $consulta = $modelEditContra->ActualizarNuevaContraseña($id, $ncontra);
        if ($consulta != false) {
            exit(json_encode(
                ["status"=>"OK",
                    "mensaje"=>"Su contraseña ha sido cambiada con éxito."]
            ));
        } else {
            exit(json_encode(
                ["status"=>"ERR",
                    "Location"=>"../../Vista/Jurado/EditarContra.php",
                    "mensaje"=>"Ocurrió un error al intentar cambiar la contraseña."]
            ));
        } 
    }


?>