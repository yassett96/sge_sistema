<?php

require_once ("../../Modelo/MPersona/Mpersona.php");

$modelopersona = new PersonaModelo();

$pnombre = $_POST['pname'];
$snombre = $_POST['sname'];
$papellido = $_POST['papellido'];
$sapellido = $_POST['sapellido'];
$tel = $_POST['tel'];

$idsede = $_POST['sede'];
$correo = $_POST['correo'];
$carnet = $_POST['carnet'];
$user = $_POST['user'];
$pass = $_POST['pass'];


$result = $modelopersona->get_persona_insert($pnombre,$snombre,$papellido,$sapellido,$tel,$idsede,$correo,$carnet,$user,$pass);
//echo $result;

if($result == true)
    {
        header("location: ../../index.php");

    }
    else if($result  == false) 
    {
        echo "<script> alert('Por favor verifique los datos ingresados'); window.location='RegistroEstudiante.php' </script>";
    }

?>