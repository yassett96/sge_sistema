<?php

require_once ("../../Modelo/Coordinador/MFormato.php");


$ModFormat = new ModalFormato();


$nfor = $_POST['NFor'];

$result = $ModFormat->get_BuscarNFormato($nfor);
echo $result;



?>