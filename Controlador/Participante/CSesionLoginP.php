<?php
session_start();

/*error_reporting(0);*/

require_once ("../../Modelo/General/MInicio_sesion.php");
require_once ("../../Modelo/Participante/MDatosEventos.php");

$logins = new MInicio_Sesion();
$datoseventos = new ModeloDatosEvento();

define("MAXIMOS_INTENTOS", 3);

$user = $_POST['usuarioE'];
$pass = $_POST['contraE'];

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

if ($ValidaTUsuario == ''){
    exit(json_encode(
        ["status"=>"ERR",
            "Location"=>"../../Vista/General/Iniciar_Sesion.php",
            "mensaje"=> "Usuario no válido en este tipo de acceso E"]
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



if($res == true){

$IdPersona=$logins->ConsultarUsuarioParticipante($user,$cred['Contraseña']); 

    $IdParticipante = $logins->ListarDatosParticipante($IdPersona);
    //$DatosE = $datoseventos->ListarDatosEventos($IdPersona);

    if ($IdParticipante != ''){

        $datosPer = $IdParticipante;
        //$datosEv =$DatosE;
        
        $_SESSION['Participantes'] = $datosPer;
        


        if( $datosPer['ID_Tipo_Usuario'] == '1'){


            
            $_SESSION['Idpersona'] = $datosPer['ID_Persona'];
            $_SESSION['Nombre'] = $datosPer['Primer_Nombre'];
            $_SESSION['SegundoNombre'] = $datosPer['Segundo_Nombre'];
            $_SESSION['Apellido'] = $datosPer['Primer_Apellido'];
            $_SESSION['SegundoApellido'] = $datosPer['Segundo_Apellido'];
            $_SESSION['NombreCompleto'] = $datosPer['Primer_Nombre']. "  " . $datosPer['Primer_Apellido'];
            $_SESSION['Telefono']= $datosPer['Telefono'];
            $_SESSION['Cod'] = $datosPer['CodigoRegistro'];
            $_SESSION['Avatar'] = $datosPer['Avatar'];
            $_SESSION['Correo'] =$datosPer['Correo_Electronico'];
            $_SESSION['Carnet'] =$datosPer['ID_Numero_Carnet'];
        
            $_SESSION['Grupo'] = $datosPer['grupo'];
            $_SESSION['IdGrupo'] = $datosPer['ID_Grupo'];
            $_SESSION['Cedula'] = $datosPer['Cedula'];
            $_SESSION['IdSede'] = $datosPer['ID_Sede'];
            $_SESSION['Contra'] = $datosPer['Contraseña'];

            /*if ($datosEv !== Null){
                $_SESSION['NombreEvento'] = $datosEv['Nombre_Evento'];
                $_SESSION['NombreProyecto'] = $datosEv['Nombre_Proyecto'];
                $_SESSION['Categoria'] = $datosEv['Nombre_Categoria'];
                $_SESSION['Subcategoria'] = $datosEv['Nombre_Subcategoria'];    
            }else{
                $_SESSION['NombreEvento'] = "";
                $_SESSION['NombreProyecto'] = "";
                $_SESSION['Categoria'] = "";
                $_SESSION['Subcategoria'] = "";    
            } */

            $_SESSION[ 'SesionAbierta' ] = false; 
            exit(json_encode(
                ["status"=>"OK",
                    "Location"=>"../../Vista/Participante/inicioParticipanteSinEvento.php",
                    "mensaje"=>"cargando página Participante"]
            ));
        }
    }
}else{

        exit(json_encode(
            ["status"=>"ERR",
                "Location"=>"../../Vista/General/Iniciar_Sesion.php",
                "mensaje"=> "Usuario o Contraseña incorrecta B"]
        ));
    } 

}
?>