<?php
session_start();

if($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 2 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] !="6"){
    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();
} 

?>

    <link rel="icon" href="../../Assets/imagenes/Recursos/Logo_UNI.png" height="30px" width="30px">
    <link rel="stylesheet" href="../../Assets/css/General/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/css/Jurado/editarcuenta.css">

        <div class="modal" id="Popup2" tabindex="-1">        
          <div class="modal-dialog">
              <div id="msgt-error"> </div>            
              <div id="msgt2-error"> </div>
              <div id="msgc-error"> </div>
              <div id="msgc2-error"> </div>              
            <div class="modal-content">              
              <div class="modal-header">
                <h5 class="modal-title">Editar Cuenta</h5>
              </div>
              
              <form method="POST">
              <div class="modal-body">
              <label class="texto">Edite los campos que desee</label>
                <div class="grupo">        
                    <input type="tel" name="tel" id="tel" oninput="Ocultarmensaje()" value="<?php echo $_SESSION['Telefono']; ?>" required>
                    <label>Teléfono</label>
                </div> 
                <div class="grupo" id="grupoc">
                    <input type="email" name="email" id="email" oninput="Ocultarmensaje()" value="<?php echo $_SESSION['Email']; ?>" required>
                    <label>Correo</label>
                </div>  
              </div>
              <div class="modal-footer">
                <button type="submit" class="btncontra" data-bs-dismiss="modal">Editar contraseña</button> 
                <button type="submit" class="btncancelarc" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btnguardarc" data-bs-dismiss="modal">Guardar cambios</button>
              </div>
              </form>   
            </div>
          </div>
        </div>

    <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/Jurado/editarcuenta.js"></script>
    