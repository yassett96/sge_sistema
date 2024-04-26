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

$Correo = $_GET['correo'];
$Usuario = $_GET['usuario'];
$Contra = $_GET['contra'];
$PrimerNombre = $_GET['primerNombre'];
$PrimerApellido = $_GET['primerApellido'];

$Origen = "consultasproyectistas@gmail.com"; /*Funcionaria como el receptor de consultas (servidor)*/
$Bandeja =$Correo; /* Correo de las autoridades Academicas en donde llegaran las consultas recibidad por el servidor*/

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
       <p style='font-size:20px;'> Asunto : Envío de credenciales de nuevo acceso</p>
       <br>
       <p style='font-size:18px;'>Hola ".$PrimerNombre." ".$PrimerApellido.", enviamos este correo para notificarle que se ha registrado un nuevo acceso para ti. Las credenciales son los siguientes:</p>
       <p style='font-size:18px;'>Usuario: ".$Usuario."</p>
       <br>
       <p style='font-size:18px;'>Cotraseña: ".$Contra."</p>
       <br>
       <p style='font-size:18px;'>En caso de querer modificar las credenciales, se puede hacer en la sección de 'Mi cuenta' de la aplicación web</p>
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

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = "Envío de credenciales de nuevo acceso";
$mail->Body    = $message;
// $mail->addAttachment($Protocolo['tmp_name'], $Protocolo['name']);
// $mail->addAttachment($ImagenCedula['tmp_name'], $ImagenCedula['name']);

if($mail->send()){
    echo "<p>Las credenciales han sido enviadas con éxito</p>";
} else {
    echo '<p> Sucedio un problema </p>';
}    
 
?>