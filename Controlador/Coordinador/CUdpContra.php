<?php
session_start();

require_once ("../../Modelo/Coordinador/MEditarContra.php");

$modelEditContra = new EditarContraModelo();

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
                    "Location"=>"../../Vista/Admin/EditarContra.php",
                    "mensaje"=>"Ocurrió un error al intentar cambiar la contraseña."]
            ));
        } 
    }


?>