<?php
require_once ("../../Modelo/Coordinador/MFormato.php");


$ModFormat = new ModalFormato();

$Idformat = $_POST['Id_Formato'];

$FormatoList = $ModFormat->select_ListaIDFormato($Idformat);
echo $FormatoList;

?>