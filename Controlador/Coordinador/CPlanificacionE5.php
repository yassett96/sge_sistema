<?php

require_once ("../../Modelo/Coordinador/MFormato.php");


$ModFormat = new ModalFormato();

$IdCatE = $_POST['IdcategoriaE'];
$Idsubcate = $_POST['Idsubcate'];
$Jurado1 = $_POST['J1'];
$Jurado2 = $_POST['J2'];
$Jurado3 = $_POST['J3'];
$IdTformat = $_POST['Id_TFormat'];

$result = $ModFormat->get_insertar_JuradosE($IdCatE,$Idsubcate,$Jurado1,$Jurado2,$Jurado3,$IdTformat);
echo $result;
?>