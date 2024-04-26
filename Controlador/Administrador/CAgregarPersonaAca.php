<?php

require_once ("../../Modelo/Administrador/MAcademico.php");
require_once ("../../Modelo/General/Createavatar.php");

$modeloAca = new AcaModelo();

$pnombre = $_POST['pname'];
$snombre = $_POST['sname'];
$papellido = $_POST['papellido'];
$sapellido = $_POST['sapellido'];
$tel = $_POST['tel'];

$correo = $_POST['correo'];
$cedula = $_POST['cedula'];

// $idtipou = $_POST['tipoU'];
$idtipou = CtePersonalAcademico;


$user = $_POST['user'];
$pass = $_POST['pass'];

$gradoA = $_POST['gradoA'];
$cargo = $_POST['cargo'];
$sede = $_POST["sede"];

$nameFirstChar =$pnombre[0];
$nameSecondChar = $papellido[0];
$target_path = createAvatarImage($nameFirstChar,$nameSecondChar);

$passmod = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 8]);

$result = $modeloAca->get_persona_insert_Aca($pnombre,$snombre,$papellido,$sapellido,$tel,$correo,$idtipou,$user,$passmod,$cedula,$target_path,$gradoA,$cargo,$sede);
echo $result;
