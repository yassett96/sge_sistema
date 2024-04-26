<?php

    session_start();

    if (!isset($_SESSION['Participantes']) or $_SESSION['Participantes']['ID_Tipo_Usuario']  != "1")  {


        header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
        die();

    }

?>

<link rel="stylesheet" href="../../Assets/css/Participante/Confirmar_Participacion.css">

<div class="modal" id="Popup2" name="Modalconsulta" tabindex="-1"  >
  <div class="modal-dialog">
    <div class="modal-content">
        <div id="Alerta"></div>

        <div class="modal-header">
            <h5 class="modal-title">Confirmar participación</h5>
            <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">      

            <!-- <div class="elem-group">
                <label for="email">De: </label>
                <input type="email" id="email" name="email" class="visitor_email" placeholder=<?php //echo $_SESSION['Correo']; ?> value =<?php //echo $_SESSION['Correo'] ?> disabled>
                <input type="hidden" id="email2" name="email2" class="visitor_email_2" value ="<?php //echo $_SESSION['Correo'] ?>">
            </div>

            <div class="elem-group">
                <label for="title">Asunto: </label>
                <input type="text" id="title" class="email_title"  required />
            </div> -->

            <div class="elem-group">
                <label for="message">Mensaje: </label>
                <!--<textarea id="message" name="visitor_message" placeholder="Say whatever you want." required></textarea>-->
                <p><textarea id="message" class="visitor_message" name="visitor_message" placeholder="Escriba un mensaje" required></textarea></p>
            </div>

            <section id="popUpConfirmarCampo1" class="popUpConfirmarCampos">
                <h5 class="h5TextosPopUpConfirmar">Cargar imagen de la cédula:</h5>
                <img id="idImgPopUpConfirmar" src=""><br>
                <input type="file" class="camposPopUpConfirmar" accept=".png" id="imagenSeleccionar">
            </section>
            <br><br>

            <div class="elem-group">
                <label for="title">Cargar documento del proyecto: </label>
                <form id="myForm" method="POST" action="../../Controlador/Participante/CConfirmacionParticipacion.php" enctype="multipart/form-data">
                    <input type="file" name="Protocolo" id="fileUpload" accept=".pdf,.docx" required />
                </form>
            </div>

            <!--<div class="elem-group">
                <textarea id="message" name="visitor_message" placeholder="Say whatever you want." required></textarea>
            </div>-->

        </div>
        
        <div class="modal-footer">
            <button type="button" id="CerrarConsulta" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" id="ConfirmarParticipacion2" class="btn btn-primary">Enviar</button>
        </div>
    </div>
  </div>
</div>
<script src="../../Assets/js/General/helperjs.js"></script> 
<script src="../../Assets/js/Participante/ConfirmacionParticipacion.js"></script>   