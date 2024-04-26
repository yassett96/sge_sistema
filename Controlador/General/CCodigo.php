<?php

require_once ("../../Modelo/General/MActualizarContra.php");
require_once ("CEnviarCorreo.php");

    $modelocontra = new ContrasenaModelo();
    $enviarcorreo = new CEnviar();

    $correo = $_POST['txtCorreo'];
    
    
        $correousuario = $modelocontra->ConsultarUsuarioCorreo($correo);
        
        $registro = mysqli_num_rows($correousuario);
           
        if ($registro != '') {

            $codigo = $enviarcorreo->CrearCodigoAleatorio();
            date_default_timezone_set('America/Managua'); 
            $fechaRecuperacion = date("Y-m-d H:i:s");
            
            $respuesta = $modelocontra->ActualizarCodigo($correo, $codigo, $fechaRecuperacion);
            
            if ($respuesta) {
                $enviarcorreo->EnviarCorreo($correo, $codigo);   
            } 
            exit(json_encode(
                ["status"=>"OK",
                    "Location"=>"../../index_SRSE.php",
                    "mensaje"=>"Se ha enviado un correo electrónico con las instrucciones para el cambio de tu contraseña."]
            )); 
            
        }else{
            exit(json_encode(
                ["status"=>"ERR",
                    "Location"=>"../../Vista/General/CorreoRecuperacion.html",
                    "mensaje"=>"El correo electrónico no se encuentra registrado en el sistema"]
            )); 
        }

    
?>
