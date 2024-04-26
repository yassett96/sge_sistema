<?php

require_once ("../../Modelo/General/MActualizarContra.php");

$modelcontra = new ContrasenaModelo();

$codigo = $_POST['cod'];
$contrasena = $_POST['ncontra'];
$repetirContrasena = $_POST['ccontra'];

    $usuariocodigo = $modelcontra->ConsultarUsuarioCodigo($codigo);
    
    $registro = mysqli_num_rows($usuariocodigo);

        if ($registro) {
 
                if ($contrasena != $repetirContrasena) {
                    exit(json_encode(
                        ["status"=>"ERR",
                            "Location"=>"../../Vista/General/CorreoRecuperacion.html",
                            "mensaje"=>"Las contraseñas no coinciden."]
                    )); 
                   
                } else {
                    $pass = $_POST['ncontra'];
                    $password = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 8]);
                    
                    $resultado = $modelcontra->ActualizarContraseña($codigo, $password);
                    if ($resultado != false) {
                        exit(json_encode(
                            ["status"=>"OK",
                                "Location"=>"../../Vista/General/Iniciar_Sesion.php",
                                "mensaje"=>"Su contraseña ha sido cambiada con éxito."]
                        ));
                           
                    } else {
                        exit(json_encode(
                            ["status"=>"ERR",
                                "Location"=>"../../Vista/General/CorreoRecuperacion.html",
                                "mensaje"=>"Ocurrió un error al intentar cambiar la contraseña."]
                    )); 
                        
                    }
                }  
        }else{
            exit(json_encode(
                ["status"=>"ERR",
                    "Location"=>"../../Vista/General/CorreoRecuperacion.html",
                    "mensaje"=>"El código de recuperación de contraseña no es válido. Por favor intenta de nuevo."]
            ));    
        }   


?>