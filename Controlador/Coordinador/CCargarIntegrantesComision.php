<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$Id_ComisionAsigSelecc = $_POST['ComisionASel'];

    $result = $MCAsignada->Listar_IntegrantesComision($Id_ComisionAsigSelecc);

    echo $result;

?>