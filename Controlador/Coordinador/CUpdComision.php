<?php

require_once ("../../Modelo/Coordinador/MComision.php");

$MComision = new ModalComision();

$NcomisionE=  $_POST['IdComision'];
$UpdaComision = $_POST['UpdaComision'];

    $result = $MComision->get_Actualizar_comision($NcomisionE,$UpdaComision);
    

    echo $result;

?>