<?php

require_once ("../../Modelo/Participante/Mpersona.php");


$modelopersona = new PersonaModelo();


$tel = $_POST['tel'];


$correo = $_POST['correo'];
$carnet = $_POST['carnet'];
$user = $_POST['user'];




$result = $modelopersona->put_buscar_registros($tel,$correo,$user,$carnet);
echo $result;

?>