<?php
session_start();



if (!isset($_SESSION['Usuario']) or $_SESSION['Usuario']['Tipo'] != "2")  {


    header('Location: ../Vista/log.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once '../Controlador/MainSecurity.php';
require_once  '../Controlador/UserModule.php';

$UserModule = new UserModule();
$Title = "Interfaz Supervisor";


$Contador = $UserModule->get_contador($Title);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="../asset/js/jquery.min.js"></script>
    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">
    <title>Interfaz Supervisor</title>
</head>
<body>



<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"> Interfaz de SUPERVISOR </h5>
    <?php
    echo "¡Eres la Visita ", $Contador, ". en esta página!";
    ?>

    <div class="col-2">
        <div class="col-md-1 pb-0 col-form-label-sm pr-0">
            <img src="<?php echo $_SESSION['logo']; ?>" style="height: 100px; width: 100px; margin-left: 100px">
        </div>
    </div>



</div>
<div class="modal-body">


    <div class="row">
        <div class="col-10">
            <div class="col-12">Bienvenid@ <?php echo $_SESSION['Nombre'] ?> a su Sesion</div>
            <div class="col-12">Tu Numero de Registro es el <?php echo $_SESSION['Id']; ?> </div>
        </div>

        <div class="col-2">
            <div class="col-md-1 pb-0 col-form-label-sm pr-0">
                <img src="<?php echo $_SESSION['logo']; ?>" style="height: 150px; width: 150px;">
            </div>
        </div>
    </div>


    <div class="modal-footer">
        <a type="button" class="btn btn-primary" href='Index.php'>Ir a Pagina principal</a>
        <a type="text" class="btn btn-secondary" data-dismiss="modal" href='../Controlador/CerrarSesion.php'>Cerrar sesion</a>
    </div>

   <!-- <a href="https://www.contadorvisitasgratis.com" title="contador de visitas gratis"><img src="https://counter9.stat.ovh/private/contadorvisitasgratis.php?c=j5s5bdssw4gyame4ugqww9ubugs4452x" border="0" title="contador de visitas gratis" alt="contador de visitas gratis"></a> -->


</div>


<script src="../asset/js/jquery.min.js"></script>
<script src="../asset/js/bootstrap.min.js"></script>
</body>
</html>
