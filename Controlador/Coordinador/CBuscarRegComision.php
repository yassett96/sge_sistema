<?php

require_once ("../../Modelo/Coordinador/MComision.php");


$ModComision = new ModalComision();


$ncom = $_POST['NCom'];

$result = $ModComision->get_BuscarNComision($ncom);
echo $result;



?>