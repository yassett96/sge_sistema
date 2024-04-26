<?php

require_once ("../../Modelo/Coordinador/MComision.php");


$MCom = new ModalComision();

$IdCE=  $_POST['IdCEvento'];


    $result = $MCom->get_Eliminar_ComisionE($IdCE);

    echo $result;

?>