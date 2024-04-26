<?php
require_once ("../../Modelo/Coordinador/MFormato.php");


$ModFormat = new ModalFormato();

$Nformato = $_POST['NFormato'];

$FormatoList = $ModFormat->select_ListaFormato($Nformato);
echo $FormatoList;

?>