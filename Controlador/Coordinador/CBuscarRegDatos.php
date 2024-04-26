<?php

session_start();

require_once ("../../Modelo/Coordinador/MEditaCuentaDatos.php");


$MEditaCuenta = new EditarCuentaModeloA();

$id = $_SESSION['Idpersona'];
$Tel = $_POST['Telefono'];
$Correo = $_POST['Email'];


$result = $MEditaCuenta->BuscarRegistro($id,$Tel,$Correo);
echo $result;



?>