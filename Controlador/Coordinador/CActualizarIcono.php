<?php
session_start();


if($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3){
    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();
} 


require_once ("../../Modelo/Coordinador/MActualizarIcono.php");


$avatarmodelo = new AvatarModeloC();

$idpersona = $_SESSION['Idpersona'];
$idusuario = $_SESSION['ID_Tipo_Usuario'];
$avatar = $_POST['img'];

$result = $avatarmodelo->ActualizarAvatar($idpersona,$avatar);

//print_r($result);
echo $result;

$IdPAcademico = $avatarmodelo->ListarDatosPAcademico($idpersona, $idusuario);
      
        $datosPa = $IdPAcademico;
                
        $_SESSION['PersonaAcademica'] = $datosPa;

        if( $datosPa['ID_Tipo_Usuario'] == '4'){
            
            $_SESSION['Avatar'] = $datosPa['Avatar'];
            
        }

        if( $datosPa['ID_Tipo_Usuario'] == '3'){
            
            $_SESSION['Avatar'] = $datosPa['Avatar'];
            
        }
    

?>