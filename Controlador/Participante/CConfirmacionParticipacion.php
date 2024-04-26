<?php
/*PHPMailer/src/PHPMailer.php*/


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
require "..\..\Assets\herramientas\PHPMailer\src\Exception.php";
require "..\..\Assets\herramientas\PHPMailer\src\PHPMailer.php";
require "..\..\Assets\herramientas\PHPMailer\src\SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
/*require 'vendor/autoload.php';*/

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$Mensaje = $_POST['Mensaje'];
$Protocolo = $_FILES['Protocolo'];
$ImagenCedula = $_FILES['Cedula'] ;
$NombreProyecto = $_POST['NombreProyecto'];
$NombreParticipante1 = $_POST['NombreParticipante1'];
$NombreParticipante2 = $_POST['NombreParticipante2'];
$NombreParticipante3 = $_POST['NombreParticipante3'];
$noCarnet1 = $_POST['noCarnet1'];
$noCarnet2 = $_POST['noCarnet2'];
$noCarnet3 = $_POST['noCarnet3'];

$Origen = "consultasproyectistas@gmail.com"; /*Funcionaria como el receptor de consultas (servidor)*/
$Bandeja ="samirmorales482@gmail.com"; /* Correo de las autoridades Academicas en donde llegaran las consultas recibidad por el servidor*/

/*$Recibecorreo = $_POST['Envia'];
$Quienloenvia = "consultasproyectistas@gmail.com";  ContraseñaCorreo: EventosFCYS*
$Asunto = $_POST['Asunto'];
$Contenido = $_POST['Contenido'];     REGINA!!!!!*/

if(isset($_POST['Envia'])) {
    $Envia = filter_var($_POST['Envia'], FILTER_SANITIZE_STRING);
}
 
if(isset($_POST['Asunto'])) {
    $Asunto = filter_var($_POST['Asunto'], FILTER_SANITIZE_STRING);
}
 
if(isset($_POST['Contenido'])) {
    $Contenido = htmlspecialchars($_POST['Contenido']);
}

/*$headers = 'From: ' . $Envia . " \r\n";
$headers .= 'Mensaje: ' . $Contenido . " \r\n";*/

$message  = "<html><body>";
/*$message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";*/
$message .= "<tr><td>";
/*$message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";*/    
$message .= "<tbody>
       <tr>
       <td colspan='4' style='padding:15px;'>
       <p style='font-size:20px;'> Asunto : Confirmación de participación al evento feria</p>
       <p style='font-size:20px;'> Proyecto: ".$NombreProyecto."</p>
       <p style='font-size:20px;'> Integrante 1: ".$NombreParticipante1.", N° Carnet: ".$noCarnet1."</p>
       <p style='font-size:20px;'> Integrante 2: ".$NombreParticipante2.", N° Carnet: ".$noCarnet2."</p>
       <p style='font-size:20px;'> Integrante 3: ".$NombreParticipante3.", N° Carnet: ".$noCarnet3."</p>
       <br>
       <p style='font-size:18px;'>".$Mensaje."</p>
       <br>
       <p style='font-size:15px;'><b><i> Para dar respuesta a esta consulta, debe de enviarla al correo del participante. </i></b></p>
       </td>
       </tr>
              </tbody>";

$message .= "</body></html>";

/*try {*/
//Server settings
$mail->SMTPDebug = 0;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = $Origen;                     //SMTP username
$mail->Password   = 'mmewhggjerxvircj';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->CharSet = 'UTF-8';
$mail->setFrom($Origen,'Confirmación Participantes');
$mail->addAddress($Bandeja);     //Add a recipient
/*$mail->addAddress('ellen@example.com');               //Name is optional*/
/*$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');*/

//Attachments
/*$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name*/

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = "Confirmación de participación al evento feria";
$mail->Body    = $message;
$mail->addAttachment($Protocolo['tmp_name'], $Protocolo['name']);
$mail->addAttachment($ImagenCedula['tmp_name'], $ImagenCedula['name']);

/*$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';*/

/*$mail->send();
echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}*/

if($mail->send()){
    echo "<p>Tu confirmación ha sido enviada, pronto tendras respuesta por parte de la organizacion del evento.</p>";
} else {
    echo '<p> Sucedio un problema </p>';
}


 
/*$Envia = $_POST['Envia'];
$Asunto = $_POST['Asunto'];
$Contenido = $_POST['Contenido'];
$Origen = "98lmmp@gmail.com";


    if(isset($_POST['Envia'])) {
        $Envia = filter_var($_POST['Envia'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['Asunto'])) {
        $Asunto = filter_var($_POST['Asunto'], FILTER_SANITIZE_STRING);
        
    }
     
    if(isset($_POST['Contenido'])) {
        $Contenido = htmlspecialchars($_POST['Contenido']);
    }*/
     
   
   /* 
    $mail->isSMTP();
    $mail->SMTPDebug =SMTP::DEBUG_SERVER;
    
    $mail->Host = 'smtp.gmail.com';
    $mail->Port =  465;
    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    
    $mail->SMTPAuth = true;
    
    $email = '98lmmp@gmial.com';
    $mail->Username = $Origen;
    $mail->Password = 'rjsnzvyivxgmclpb';
    

    $mail->setFrom($Envia);
    $mail->addAddress($Origen);
    $mail->Subject =$Asunto;


    $mail->isHTML(true);         
    $mail->CharSet = 'UTF-8';
    $mail->Body    = sprintf($Contenido);
    
    if($mail->send()){
        echo "<p>Hola $Envia . Tu consulta ha sido enviada, pronto tendras respuesta por parte de la organizacion del evento.</p>";
    } else {
        echo '<p> Sucedio un problema </p>';
    }

     
    /*$headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $Origen . "\r\n";*/
     
    /*if(mail($Origen,$Asunto, $Contenido, $headers)) {
        echo "<p>Hola $Envia . Tu consulta ha sido enviada, pronto tendras respuesta por parte de la organizacion del evento.</p>";
    } else {
        echo '<p> Sucedio un problema </p>';
    }*/

   
    
 
?>