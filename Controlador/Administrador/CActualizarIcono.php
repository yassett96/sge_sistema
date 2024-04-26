<?php
session_start();


if($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] !="6"){
    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();
} 


require_once ("../../Modelo/Administrador/MActualizarIcono.php");


$avatarmodelo = new AvatarModeloA();

$idpersona = $_SESSION['Idpersona'];
$idusuario = $_SESSION['ID_Tipo_Usuario'];
$avatar = $_POST['img'];

$result = $avatarmodelo->ActualizarAvatar($idpersona,$avatar);
echo $result;

$IdPAcademico = $avatarmodelo->ListarDatosPAcademico($idpersona, $idusuario);
      
        $datosPa = $IdPAcademico;
                
        $_SESSION['PersonaAcademica'] = $datosPa;

        if( $datosPa['ID_Tipo_Usuario'] == '6'){
            
            $_SESSION['Avatar'] = $datosPa['Avatar'];
            
        }
    

?>