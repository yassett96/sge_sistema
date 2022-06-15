<?php

session_start();



if (!isset($_SESSION['Usuario']) or $_SESSION['Usuario']['Tipo'] != "1")  {


        header('Location: ../Vista/log.php');//Aqui lo redireccionas al lugar que quieras.
        die();

}

require_once '../Controlador/MainSecurity.php';
require_once  '../Controlador/UserModule.php';

$UserModule = new UserModule();
$Title = "Interfaz Administrador";


$Contador = $UserModule->get_contador($Title);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="../asset/js/jquery.min.js"></script>
    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">

    <title>Interfaz Administrador</title>


</head>
<body>


<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"> Interfaz de ADMIN </h5>
    <?php
    echo "¡Eres el visitante ", $Contador, ". en esta página!";

    ?>

</div>
<div class="modal-body">


        <div class="row">
            <div class="col-10">
                <div class="col-12">Bienvenid@ <?php echo $_SESSION['Nombre'] ?> a su Sesion</div>
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




</div>

<script src="../asset/js/jquery.min.js"></script>
<script src="../asset/js/bootstrap.min.js"></script>


</body>
</html>