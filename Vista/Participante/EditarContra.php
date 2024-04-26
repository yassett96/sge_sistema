<?php
session_start();

if (!isset($_SESSION['Participantes']) or $_SESSION['Participantes']['ID_Tipo_Usuario']  != "1")  {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
?>

    <link rel="icon" href="../../Assets/imagenes/Recursos/Logo_UNI.png" height="30px" width="30px">
    <link rel="stylesheet" href="../../Assets/css/General/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/css/Participante/editar_contra.css">
    
    <div class="modal" id="Popup3" tabindex="-1">
        <div class="modal-dialog">
            <div id="msgv-error"> </div>
            <div id="msgc-error"> </div>
            <div id="msgnc-error"> </div>
            <div id="msgcc-error"> </div>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Contraseña</h5>
                </div>
                
                <form method="POST">
                <div class="modal-body">                
                <div class="grupo">
                    <span><img class="M1 M2" src="../../Assets/imagenes/Recursos/Visto.png" ></span>
                    <input type="password" name="npass" id="npass" oninput="Ocultarmensaje()" required>
                    <label>Nueva contraseña</label>
                </div>  
                <div class="grupo">
                    <span><img class="M1 M3" src="../../Assets/imagenes/Recursos/Visto.png" ></span>
                    <input type="password" name="cpass" id="cpass" oninput="Ocultarmensaje()" required>
                    <label>Confirmar contraseña</label>
                </div>  
              </div>
              <div class="modal-footer">
                <button type="submit" class="btncancelarn" id="botoncancelar" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btnguardarn" id="botonguardar" data-bs-dismiss="modal">Guardar cambios</button>
              </div>
              </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/Participante/editar_contraseña.js"></script>
  
