<?php

require_once '../Controlador/MainSecurity.php';
require_once  '../Controlador/UserModule.php';

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


    <title> Loggin </title>
</head>
<body>

    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login Prueba</h5>
    </div>
    <div class="modal-body">

        <form id="fMarcas" method="post" >
            <div class="row">
                <label class="col-md-1 pb-0 col-form-label-sm pr-0">Usuario</label>
                <div class="col-sm-11 mt-2 ">
                    <input type="text" name="User" id="User" class="form-control form-control-sm text-uppercase" value="" placeholder="Ingrese su Usuario" required> <!-- READONLY STYLE="true" -->
                </div>
            </div>

            <div class="row">
                <label class="col-md-1 pb-0 col-form-label-sm pr-0">Contraseña</label>
                <div class="col-sm-11 mt-2 ">
                    <input type="password" name="Pass" id="Pass" class="form-control form-control-sm text-uppercase" value="" placeholder="Ingrese Su contraseña" required> <!-- READONLY STYLE="true" -->
                </div>
            </div>
            <div class="row">
                <div class="col-sm-11 mt-2 ">
                    <input id="Btnlog" type="button" class="btn btn-primary" value="Iniciar Sesion" required></input> <!-- READONLY STYLE="true" -->
                </div>
            </div>

        </form>

    </div>


    <script src="../asset/js/jquery.min.js"></script>
    <script src="../asset/js/bootstrap.min.js"></script>
    <script src="../asset/js/loggin.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>
