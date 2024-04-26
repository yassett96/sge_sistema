<?php

session_start();


if (!isset($_SESSION['Participantes']) or $_SESSION['Participantes']['ID_Tipo_Usuario']  != "1")  {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

require_once ("../../Modelo/Participante/MEditarCuenta.php");

$modelocuenta = new EditarCuentaModelo();

$id = $_SESSION['Idpersona'];
$tel = $_POST['tel'];
$correo = $_POST['email'];
$grupo = $_POST['sgrupo'];
$cedula = $_POST["cedula"];

$result = $modelocuenta->BuscarRegistroCORREO($id,$correo);

// if($result !== ""){
//     echo $result;
// }else {
    $resultado = $modelocuenta->ActualizarDatos($id, $tel, $correo, $grupo, $cedula);
// }

$IdParticipante = $modelocuenta->ListarDatosParticipante($id);



    $datosPer = $IdParticipante;

        $_SESSION['Participantes'] = $datosPer;

        if($datosPer['ID_Tipo_Usuario'] == '1'){
        
            $_SESSION['Telefono']= $datosPer['Telefono'];
            $_SESSION['Correo'] = $datosPer['Correo_Electronico'];
            $_SESSION['Grupo'] = $datosPer['grupo'];
            $_SESSION['IdGrupo'] = $datosPer['ID_Grupo'];
            $_SESSION['IdSede'] = $datosPer['ID_Sede'];
            $_SESSION['Cedula'] = $datosPer['Cedula'];
        }

echo $resultado; //VER QUE DEVUELVE
?>