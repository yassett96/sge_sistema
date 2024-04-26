<?php
session_start();
require_once ("../../Modelo/Coordinador/MEditaCuentaDatos.php");

$UpdtaDatosCuneta = new EditarCuentaModeloA();

$id = $_SESSION['Idpersona'];

$idusuario = $_SESSION['ID_Tipo_Usuario']; 
$tel = $_POST['tel'];
$correo = $_POST['email'];


 $result = $UpdtaDatosCuneta->ActualizarDatosPA($id, $tel, $correo);


$IdPAcademico = $UpdtaDatosCuneta->ListarDatosAcademico($id, $idusuario);


$datosPa = $IdPAcademico;

        $_SESSION['PersonaAcademica'] = $datosPa;

        if($datosPa['ID_Tipo_Usuario'] == '6'){
        
            $_SESSION['Telefono']= $datosPa['Telefono'];
            $_SESSION['Email'] = $datosPa['Correo_Electronico'];
            $_SESSION['Cedula'] = $datosPa['Cedula'];
        }

        if($datosPa['ID_Tipo_Usuario'] == '4'){
        
            $_SESSION['Telefono']= $datosPa['Telefono'];
            $_SESSION['Email'] = $datosPa['Correo_Electronico'];
            $_SESSION['Cedula'] = $datosPa['Cedula'];
        }

        if($datosPa['ID_Tipo_Usuario'] == '3'){
        
            $_SESSION['Telefono']= $datosPa['Telefono'];
            $_SESSION['Email'] = $datosPa['Correo_Electronico'];
        }



?>