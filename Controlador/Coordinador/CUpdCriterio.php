<?php
require_once ("../../Modelo/Coordinador/MFormato.php");


$ModFormat = new ModalFormato();

$idCrit=  $_POST['Id_Criterio'];
$Ncriterio = $_POST['N_Criterio'];
$NDescrip = $_POST['N_Descri'];
$NValor = $_POST['N_Valor'];

    $result = $ModFormat->get_Actualizar_criterio($idCrit,$Ncriterio,$NDescrip,$NValor);

    echo $result;

?>