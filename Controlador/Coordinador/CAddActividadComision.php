<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$NombreAct =$_POST['NombreAct'];
$DescripcionA = $_POST['DescripcionA'];
$FechaI = $_POST['FechaI'];
$FechaF = $_POST['FechaF'];
$Requerimientos = $_POST['Requerimientos'];
$NRequerimientos = $_POST['NRequerimientos'];
$EncargadosA = $_POST['EncargadosA'];
$NEncargados = $_POST['NEncargados'];
$ComisionAA = $_POST['ComisionAA'];
$NComisiones = $_POST['NComisiones'];
$PersonalAA = $_POST['PersonalAA'];
$NPersonalA = $_POST['NPersonalA'];
$IDComisionAsig = $_POST['IDComisionAsig'];

    $result = $MCAsignada->get_insertar_ActividadComision($NombreAct,$DescripcionA,$FechaI,$FechaF,$Requerimientos,$NRequerimientos,$EncargadosA,$NEncargados,$ComisionAA,$NComisiones,$PersonalAA,$NPersonalA,$IDComisionAsig);

    echo $result;

?>
