<?php

require_once ("../../Modelo/MInicio_Sesion/MInicio_sesion.php");

class CSesion extends MInicio_sesion{

    public function VerificarUsuario($usuario,$password,$tipoUser){
        $infousuario =  $this->ConsultarUsuario($usuario,$password);
        $registro = mysqli_num_rows($infousuario);
        if ($registro > 0)   
        {
            if($tipoUser == 1){
                require_once ("../../Vista/VParticipante/EventosParticipante.html");
            }
            elseif ($tipoUser == 2) {
                require_once ("../../Vista/VParticipante/InicioParticipante.html");                   
            } 
            else{
                require_once ("../../Vista/VParticipante/InicioParticipante.html");    
            }
        }
        else{
            echo "<script> alert('Usuario o Contraseña incorrecta'); window.location='../../Vista/Iniciar_Sesion.php' </script>";
            
        }
    }

}

if(isset($_POST['accionD']) && $_POST['accionD'] == 'login'){
    $ic = new CSesion();
    $ic->VerificarUsuario($_POST['usuarioD'],$_POST['contraD'],1);                   
}elseif(isset($_POST['accionE']) && $_POST['accionE'] == 'loginE'){
    $ic = new CSesion();
    $ic->VerificarUsuario($_POST['usuarioE'],$_POST['contraE'],2);
}elseif(isset($_POST['accionG']) && $_POST['accionG'] == 'loginG') {
    $ic = new CSesion();
    $ic->VerificarUsuario($_POST['usuarioG'],$_POST['contraG'],3);
}

?>