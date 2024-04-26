<?php

require_once ("../../Modelo/Coordinador/MComision.php");

$MComision = new ModalComision();

$Ncomision=  $_POST['NuevaComision'];

    $result = $MComision->get_insertar_comision($Ncomision);

    echo $result;

?>
