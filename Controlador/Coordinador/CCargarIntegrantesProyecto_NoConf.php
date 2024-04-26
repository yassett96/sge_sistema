<?php

require_once ("../../Modelo/Coordinador/MReportes.php");

$MReportes = new ModReportes();

$NombreProyecto = $_POST['N_Proyecto'];

    $result = $MReportes->TablaIntegrantesProyectoNoConfirmados($NombreProyecto);

    echo $result;

?>