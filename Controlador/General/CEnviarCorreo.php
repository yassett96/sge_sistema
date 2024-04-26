<?php

require "..\..\Assets\herramientas\PHPMailer\src\Exception.php";
require "..\..\Assets\herramientas\PHPMailer\src\PHPMailer.php";
require "..\..\Assets\herramientas\PHPMailer\src\SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CEnviar{

    public function EnviarCorreo($correo, $codigo){
        $template = file_get_contents('../../Vista/General/MensajeCorreo.html');
        $template = str_replace("{{action_url_1}}", 'http://localhost:8080//SGE_Tesis/sge_sistema/SGE_V1/Vista/General/NuevaContrasena.php?c='.$codigo, $template);
        $template = str_replace("{{year}}", date('Y'), $template);

        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';

        $envia = "consultasproyectistas@gmail.com";
        $para  = $correo;
        $asunto = 'Recuperación de contraseña';
        $mensaje = $template;

         //Server settings
         $mail->SMTPDebug = 0;                      //Enable verbose debug output
         $mail->isSMTP();                                            //Send using SMTP
         $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
         $mail->Username   = $envia;                     //SMTP username
         $mail->Password   = 'mmewhggjerxvircj';                               //SMTP password
         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
         $mail->Port       = 465;   
 
         //Recipients
         $mail->setFrom($envia,'Recuperación de contraseña');
         $mail->addAddress($para);
 
         //Content
         $mail->isHTML(true);                                  //Set email format to HTML
         $mail->Subject = $asunto;
         $mail->Body    = $mensaje;
         $mail->Send();

        /*try{

            $para  = $correo;
            $título = 'Recuperación de contraseña';
            $mensaje = $template;
            
            // Para enviar un correo HTML, debe establecerse la cabecera Content-type
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
            //cabeceras adicionales
            $cabeceras .= 'From: Soporte <soportefcys@gmail.com>' . "\r\n";    

            // Enviarlo
            mail($para, $título, $mensaje, $cabeceras);

        }catch (Exception $e){
            return false;
        }*/
    }

    public function CrearCodigoAleatorio(){
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
       
        while ($i <= 4) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        
        return $pass;
    }

}

?>