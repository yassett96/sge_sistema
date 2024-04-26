<?php

/****************/
require "..\..\Assets\herramientas\PHPMailer\src\Exception.php";
require "..\..\Assets\herramientas\PHPMailer\src\PHPMailer.php";
require "..\..\Assets\herramientas\PHPMailer\src\SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**************/

$mail = new PHPMailer(true);

$Envia = $_POST['Envia'];
$ParaD = $_POST['ParaD'];
$Asunto = $_POST['Asunto'];
$NombreComisionEnvia = $_POST['NComision'];
$Contenido = $_POST['Contenido'];
$Destino = "consultasproyectistas@gmail.com"; /*Funcionaria como el receptor de consultas (servidor)*/
//$Bandeja ="98lmmp@gmail.com"; 
//$BandejeCCR2= '';
//$BandejeCCR3= 'luismongeperes@gmail.com';

/*if(isset($_POST['Envia'])) {
    $Envia = filter_var($_POST['Envia'], FILTER_SANITIZE_STRING);
}*/
 
/*if(isset($_POST['ParaD'])) {
    $ParaD = filter_var($_POST['ParaD'], FILTER_SANITIZE_STRING);
    
}*/
if(isset($_POST['Asunto'])) {
    $Asunto = filter_var($_POST['Asunto'], FILTER_SANITIZE_STRING);
    
}
 
if(isset($_POST['Contenido'])) {
    $Contenido = htmlspecialchars($_POST['Contenido']);
}


require_once ("../../Modelo/Coordinador/MComisionAsignada.php");
$MCAsignada = new ModComisionA();

$Bandeja = $MCAsignada->ObtenerCorreoR1_CAsig($ParaD);
$BandejeCCR2 =$MCAsignada->ObtenerCorreoR2_CAsig($ParaD);
$BandejeCCR3 =$MCAsignada->ObtenerCorreoR3_CAsig($ParaD);
 
$CorreoR1ComisionEnvia =$MCAsignada->ObtenerCorreoR1_CAsig($Envia);


$message  = "<html><body>";
$message .= "<tr><td>";
$message .= "<tbody>
       <tr>
       <td colspan='4' style='padding:15px;'>
       <p style='font-size:16px;'> Has recibido la siguiente solicitud por parte de la ".$NombreComisionEnvia.", la cual solicita:</p>
       <p style='font-size:14px;'>".$Contenido."</p>
       <p style='font-size:14px;'> Correo del Responsable N°1: ".$CorreoR1ComisionEnvia." de la ".$NombreComisionEnvia."</p>
       <p style='font-size:12px;'><b><i> Para dar respuesta a esta consulta, debe de enviarla al correo del responsable de la comisión, indicado anteriormente. </i></b></p>
       </td>
       </tr>
              </tbody>";

$message .= "</body></html>";

try {
$mail->CharSet = 'UTF-8';
$mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $Destino;                     //SMTP username
    $mail->Password   = 'mmewhggjerxvircj';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($Destino,'Consulta '.$NombreComisionEnvia.' comisión de trabajo');
    $mail->addAddress($Bandeja);  
    if(!empty($BandejeCCR2)) {
        $mail->addCC($BandejeCCR2);
    } 
    if(!empty($BandejeCCR3)) {
        $mail->addCC($BandejeCCR3);
    } 
    /*$mail->addCC($CC1,"MRS MANU");
    $mail->addCC($CC2,"MONGE");  */
    //$mail->addBCC($CC2); //Add a recipient
    /*$mail->addAddress('ellen@example.com');               //Name is optional*/
    /*$mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');*/

    //Attachments
    /*$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name*/

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $Asunto;
    $mail->Body    = $message;

    //$mail->send();

    /*$imapStream = imap_open('{imap.example.com:993/ssl}', $Destino, 'mmewhggjerxvircj');
    $overview = imap_fetch_overview($imapStream, '1', FT_UID);
    $date = $overview[0]->date;
    imap_close($imapStream);*/


    /*$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';*/

    /*
    echo 'Message has been sent';*/

    
    
} catch (Exception $e) {
    echo 'Hubo un error al enviar el correo electrónico: ' . $mail->ErrorInfo;
}

if($mail->send()){
    $ID_ComisionConsulta = $Envia;
    $ID_ComisionConsultada = $ParaD;
    $ID_Persona = $_POST['IDP'];
    $AsuntoConsulta =$Asunto;
    $Solicitud =$Contenido;
    $ID_IntegranteComision = $MCAsignada->ObtenerIdintegrantecom($ID_Persona,$ID_ComisionConsulta);
    $FechaEnvioConsulta=date('Y-m-d');

    $Registro = $MCAsignada->Agregar_Solicitudrealizada($ID_ComisionConsulta,$ID_ComisionConsultada,$ID_IntegranteComision,$AsuntoConsulta,$Solicitud ,$FechaEnvioConsulta);
    echo $Registro;
} else {
    $Respuesta2 = '<p> Sucedio un problema </p>';
    echo $Respuesta2;
}



?>