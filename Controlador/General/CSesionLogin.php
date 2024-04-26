<?php
session_start();

/*error_reporting(0);*/

require_once ("../../Modelo/General/MInicio_sesion.php");

$logins = new MInicio_Sesion();

$IdTipoUsuario = $_POST['menuAcceso'];
$idpersonaA = $_SESSION['campo'];


$VistaSesion=$logins->ListarDatosAcademico($idpersonaA,$IdTipoUsuario);

if ($VistaSesion){

$datosPa = $VistaSesion;

$_SESSION['PersonaAcademica'] = $datosPa;



if( $datosPa['ID_Tipo_Usuario'] == '2'){


    $_SESSION['Idpersona'] = $datosPa['ID_Persona'];
    $_SESSION['NombreCompleto'] = $datosPa['Primer_Nombre']. "  " .$datosPa['Primer_Apellido'];
    $_SESSION['Nombre'] = $datosPa['Primer_Nombre'];
    $_SESSION['Apellido'] = $datosPa['Primer_Apellido'];
    $_SESSION['Telefono'] = $datosPa['Telefono'];
    $_SESSION['Email'] = $datosPa['Correo_Electronico'];
    $_SESSION['Avatar'] = $datosPa['Avatar'];
    $_SESSION['ID_Tipo_Usuario'] = $datosPa['ID_Tipo_Usuario'];


    exit(json_encode(
        ["status"=>"OK",
            "Location"=>"../../Vista/Jurado/InicioJurado.php",
            "mensaje"=>"cargando página Jurado"]
    ));


}else if ( $datosPa['ID_Tipo_Usuario'] == '3') {
    $_SESSION['Idpersona'] = $datosPa['ID_Persona'];
    $_SESSION['NombreCompleto'] = $datosPa['Primer_Nombre']. "  " .$datosPa['Primer_Apellido'];
    $_SESSION['Nombre'] = $datosPa['Primer_Nombre'];
    $_SESSION['Apellido'] = $datosPa['Primer_Apellido'];
    $_SESSION['Telefono'] = $datosPa['Telefono'];
    $_SESSION['Email'] = $datosPa['Correo_Electronico'];
    $_SESSION['Avatar'] = $datosPa['Avatar'];
    //$_SESSION['ID'] = $datosPa['ID_Tipo_Usuario'];
    $_SESSION['ID_Tipo_Usuario'] = $datosPa['ID_Tipo_Usuario'];


    exit(json_encode(
        ["status" => "OK",
            //"Location" => "../../Vista/Academico/IndexAcademicoSE.php",
            "Location" => "../../Vista/Academico/InicioPersonalAcademico.php",
            "mensaje" => "cargando página Academica"]
    ));

}else if ( $datosPa['ID_Tipo_Usuario'] == '6') {

    $_SESSION['Idpersona'] = $datosPa['ID_Persona'];
    $_SESSION['NombreCompleto'] = $datosPa['Primer_Nombre']. "  " .$datosPa['Primer_Apellido'];
    $_SESSION['Nombre'] = $datosPa['Primer_Nombre'];
    $_SESSION['Apellido'] = $datosPa['Primer_Apellido'];
    $_SESSION['Telefono'] = $datosPa['Telefono'];
    $_SESSION['ID'] = $datosPa['ID_Tipo_Usuario'];
    $_SESSION['ID_Tipo_Usuario'] = $datosPa['ID_Tipo_Usuario'];
    $_SESSION['Email'] = $datosPa['Correo_Electronico'];
    $_SESSION['Avatar'] = $datosPa['Avatar'];
    

    $_SESSION[ 'SesionAbierta' ] = false;

    
    
    exit(json_encode(
        ["status" => "OK",
            // "Location" => "../../Vista/Administrador/Index-Admin.php",
            "Location" => "../../Vista/Administrador/InicioAdministradorCE.php",
            "mensaje" => "cargando página Administrador"]
    ));

}else if( $datosPa['ID_Tipo_Usuario'] == '4'){

    $_SESSION['Idpersona'] = $datosPa['ID_Persona'];
    $_SESSION['NombreCompleto'] = $datosPa['Primer_Nombre']. "  " .$datosPa['Primer_Apellido'];
    $_SESSION['Nombre'] = $datosPa['Primer_Nombre'];
    $_SESSION['Apellido'] = $datosPa['Primer_Apellido'];
    $_SESSION['Telefono'] = $datosPa['Telefono'];
    $_SESSION['ID'] = $datosPa['ID_Tipo_Usuario'];
    $_SESSION['ID_Tipo_Usuario'] = $datosPa['ID_Tipo_Usuario'];
    $_SESSION['Email'] = $datosPa['Correo_Electronico'];
    $_SESSION['Avatar'] = $datosPa['Avatar'];
    

    $_SESSION[ 'SesionAbierta' ] = false;

    exit(json_encode(
        ["status" => "OK",
            "Location" => "../../Vista/Coordinador/IndexCoordinadorSE.php",
            "mensaje" => "cargando página coordinador"]
    ));


   }else {
    exit(json_encode(
        ["status"=>"ERR",
            "Location"=>"../../Vista/General/Iniciar_Sesion.php",
            "mensaje"=>"Ocurrió un error. Intentalo de nuevo."]
    ));
    }


}else{

    exit(json_encode(
        ["status"=>"ERR",
            "Location"=>"../../Vista/General/Iniciar_Sesion.php",
            "mensaje"=>"Usuario o Contraseña incorrecta"]
    ));
}

?>