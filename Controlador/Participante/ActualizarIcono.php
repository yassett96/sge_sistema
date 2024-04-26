<?php
session_start();


if (!isset($_SESSION['Participantes']) or $_SESSION['Participantes']['ID_Tipo_Usuario']  != "1")  {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}


require_once ("../../Modelo/Participante/MActualizarIcono.php");


$avatarmodelo = new AvatarModelo();

$idpersona = $_SESSION['Idpersona'];

$avatar = $_POST['img'];

$result = $avatarmodelo->get_avatar_update($idpersona,$avatar);
echo $result;

$IdParticipante = $avatarmodelo->ListarDatosParticipante($idpersona);
    


   

        $datosPer = $IdParticipante;

        
        
        $_SESSION['Participantes'] = $datosPer;

        If( $datosPer['ID_Tipo_Usuario'] == '1'){

            
            $_SESSION['Avatar'] = $datosPer['Avatar'];
            
        }
    

?>