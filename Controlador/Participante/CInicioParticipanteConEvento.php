<?php
// Obtener el código de registro de la persona que está inscribiendo
if(isset($_GET['varObtenerCodRegInscriptor'])){
    session_start();
    $vlocStrCodigoRegistro = $_SESSION['Cod'];

    echo $vlocStrCodigoRegistro;
}

?>