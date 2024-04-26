<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {

    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();
}

?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="../Assets/js/General/jquery.min.js"></script>
    <link href="../../Assets/css/General/bootstrap.min.css" rel="stylesheet">

    <title>Coordinador</title>


</head>
<body>


<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"> Panel COORDINADOR [VISTA PREVIA] </h5>
   

</div>
<div class="modal-body">


        <div class="row">
            <div class="col-8">
                <div class="col-12">Bienvenid@ <?php echo $_SESSION['NombreCompleto'] ?> a su Sesion</div>
            </div>

            <div class="col-2">
                <div class="col-md-1 pb-0 col-form-label-sm pr-0">
                <div class="col-12">Usas el correo  <?php echo $_SESSION['Email'] ?> en esta Sesion</div>
                </div>
            </div>

            <div class="col-2">
                <div class="col-md-1 pb-0 col-form-label-sm pr-0">
                <div class="col-12">Tipo de Usuario  es <?php echo $_SESSION['ID'] ?> </div>
                </div>
            </div>
       

            <div class="col-2">
                <div class="col-md-1 pb-0 col-form-label-sm pr-0">
                <div class="col-12">Identificado como:  </div>
                <img src="<?php echo $_SESSION['Avatar']; ?>">
                </div>
            </div>
        </div>

        


    <div class="modal-footer">
    <a type="button" class="btn btn-primary" href='../../Vista/Coordinador/EventoCoordinadorCE.php'>Ver Coordinador CE</a>
    <a type="button" class="btn btn-primary" href='../../Vista/Coordinador/EventoCoordinadorSE.php'>Ver Coordinador SE</a>
        <a type="text" class="btn btn-secondary" data-dismiss="modal" href='../../Controlador/General/CCerrarSesion.php'>Cerrar sesión</a>
    </div>




</div>

<script src="../../Asset/js/General/jquery.min.js"></script>
<script src="../../Asset/js/General/bootstrap.min.js"></script>


</body>
</html>