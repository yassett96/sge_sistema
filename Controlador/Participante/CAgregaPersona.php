<?php

require_once ("../../Modelo/Participante/Mpersona.php");
require_once ("../../Modelo/General/Createavatar.php");

$modelopersona = new PersonaModelo();

$pnombre ="";
$snombre ="";
$papellido ="";
$sapellido ="";
$tel ="";
$carnet ="";
$correo ="";
$cedula="";
$idsede="";
$idgrupo="";
$user="";
$pass="";

$pnombre = $_POST['pname'];
$snombre = $_POST['sname'];
$papellido = $_POST['papellido'];
$sapellido = $_POST['sapellido'];
$tel = $_POST['tel'];
$carnet = $_POST['carnet'];
$correo = $_POST['correo'];
$cedula = $_POST['cedula'];
/*
if ($_POST['cedula'] == ""){
    $cedula = $_POST['cedula'];
}/*else{
    
}*/

$idsede = $_POST['sede'];
$idgrupo = $_POST['grupo'];

$user = $_POST['user'];
$pass = $_POST['pass'];

$nameFirstChar =$pnombre[0];
$nameSecondChar = $papellido[0];
$target_path = createAvatarImage($nameFirstChar,$nameSecondChar);


//$passmod = md5($pass);
$passmod = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 8]);



$result = $modelopersona->get_persona_insert($pnombre,$snombre,$papellido,$sapellido,$tel,$correo,$idsede,$idgrupo,$user,$passmod,$carnet,$cedula,$target_path);
echo $result;



/*
if(!$result == true)
    {
        header("location: ../../index.php");
        

    }
    else
    {
        echo "<script> alert('Por favor verifique los datos ingresados'); window.location='RegistroEstudiante.php' </script>";
    }
*/
?>