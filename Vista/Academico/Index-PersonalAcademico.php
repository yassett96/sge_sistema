<?php
session_start();



if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)  {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="../Assets/js/jquery.min.js"></script>
    <link href="../../Assets/css/General/bootstrap.min.css" rel="stylesheet">
    <title>ACADEMICO</title>
</head>
<body>



<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"> Interfaz de ACADEMICO </h5>



</div>
<div class="modal-body">


    <div class="row">
        <div class="col-10">
            <div class="col-12">Bienvenid@ <?php echo $_SESSION['NombreCompleto'] ?> a su Sesion</div>
            <div class="col-12">Tu Numero de Telefono es el <?php echo $_SESSION['Telefono']; ?> </div>
        </div>

        <div class="col-2">
            <div class="col-md-1 pb-0 col-form-label-sm pr-0">
            <div class="col-12">Tu Email es el <?php echo $_SESSION['Email']; ?> </div>
            </div>
        </div>

        <img src="<?php echo $_SESSION['Avatar']; ?> " width="50px">


    </div>


    <div class="modal-footer">
        <a type="button" class="btn btn-primary" href='../../Vista/Academico/MiCuenta_SE.php'>Mi cuenta</a>
        <a type="button" class="btn btn-primary" href='Index.php'>Ir a Pagina principal</a>
        <a type="button" class="btn btn-primary" href='../../Vista/Coordinador/AdminEventos_SE.php'>Admin Eventos</a>
        <a type="text" class="btn btn-secondary" data-dismiss="modal" href='../../Controlador/General/CCerrarSesion.php'>Cerrar sesión</a>
    </div>

   <!-- <a href="https://www.contadorvisitasgratis.com" title="contador de visitas gratis"><img src="https://counter9.stat.ovh/private/contadorvisitasgratis.php?c=j5s5bdssw4gyame4ugqww9ubugs4452x" border="0" title="contador de visitas gratis" alt="contador de visitas gratis"></a> -->


</div>


<script src="../asset/js/jquery.min.js"></script>
<script src="../asset/js/bootstrap.min.js"></script>
</body>
</html>
