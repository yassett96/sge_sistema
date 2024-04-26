<?php

require_once ("../../Modelo/Administrador/MAcademico.php");
require_once ("../../Modelo/General/Createavatar.php");

$modeloAca = new AcaModelo();


$tel = $_POST['tel'];


$correo = $_POST['correo'];

$user = $_GET['usuario'];




$result = $modeloAca ->put_buscar_registros_aca($tel,$correo,$user);
echo $result;



?>