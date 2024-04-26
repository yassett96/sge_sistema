<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../../Assets/imagenes/Recursos/Logo_UNI.png" height="30px" width="30px">
    <link rel="stylesheet" href="../../Assets/css/General/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../Assets/css/General/nueva_contraseña.css">
    <title>Restablecer contraseña</title>
</head>
<body>
    <div class="modal" tabindex="-1">  
        <div class="modal-dialog">
            <h1>Sistema de gestión de eventos FCYS</h1>
            <div id="msg-error"> </div>
            <div class="modal-content">
              <div>
                <h5 class="modal-title">Restablecer contraseña</h5>
              </div>
              <form method="POST">
              <div>
                <div class="grupo">
                    <input type="hidden" name="cod" id="cod" value="<?php echo $_GET['c']; ?>">
                    <span><img class="M1" src="../../Assets/imagenes/Recursos/Visto.png" ></span>
                    <div id="msgN-error"> </div>
                    <input type="password" name="ncontra" id="ncontra" oninput="Ocultarmensaje()" required>
                    <label>Nueva contraseña</label>
                </div>  
                <div class="grupo">
                    <span><img class="M1 M2" src="../../Assets/imagenes/Recursos/Visto.png" ></span>
                    <div id="msgC-error"> </div>
                    <input type="password" name="ccontra" id="ccontra" oninput="Ocultarmensaje()" required>
                    <label>Confirmar contraseña</label>
                </div>  
              </div>
              <div>
                <button type="submit" id="btnGuardar" name="btnGuardar" value="guardar" class="btnguardar" data-bs-dismiss="modal">Guardar cambios</button>
              </div>
              </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/password.js"></script>
</body>
</html>