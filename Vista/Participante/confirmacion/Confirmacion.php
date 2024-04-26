<?php
// Include the bundled autoload from the Twilio PHP Helper Library

require './twilio-php-main/src/Twilio/autoload.php';
require '../../../Assets/AuxiliarPhp/helperPhp.php';
require "../../../Assets/AuxiliarPhp/Constants.php";
use Twilio\Rest\Client;

$vgHelper = new helperPhp();
if(isset($_GET['vparTelParticipante']) && isset($_GET['vparNomApeParticipante']) && isset($_GET['vlocStrRegistro'])){        
        
        $vlocTelParticipante = $_GET['vparTelParticipante'];
        $vlocNomApeParticipante = $_GET['vparNomApeParticipante'];   
        
        $vlocNomApeParticipante = explode(",", $vlocNomApeParticipante);
        $vlocNomApeParticipante = $vlocNomApeParticipante[0]." ".$vlocNomApeParticipante[1];
        $vlocStrRegistro = $_GET['vlocStrRegistro'];

        // Your Account SID and Auth Token from twilio.com/console
        $account_sid = CteCuentaSID;
        $auth_token = CteTokenCuenta;

        // In production, these should be environment variables. E.g.:        
        // A Twilio number you own with SMS capabilities
        $twilio_number = CteNumeroCelularTwilio;        
        $client = new Client($account_sid, $auth_token);
        
        $vlocTelParticipanteFormatiado = $vgHelper->FunConvertirAFormatoTelefono($vlocTelParticipante);                
        
        $vlocResultado = '1234'; //De prueba, para no gastar los mensajes que quedan de la cuenta de Twilio
        //Para enviar el mensaje
        // $vlocResultado = $client->messages->create(                
        // // '+50584951622',        
        // $vlocTelParticipanteFormatiado,
        // array(
        //         'from' => $twilio_number,
        //         'body' => 'Somos UNI!. El código para Confirmar participación con '.$vlocNomApeParticipante.' es: '.$vlocStrRegistro
        // )
        // );        
        
        if($vlocResultado != ""){
                session_start();                
                $vlocIdPersonaInscribiendo = $_SESSION['Idpersona'];
                
                echo $vlocIdPersonaInscribiendo;                
        }
        else
                echo '';
}else
     echo 'Falta el teléfono del participante, el nombre o apellido ó el código de registro'

?>
