<?php

session_start();

if (!isset($_SESSION['Participantes']) or $_SESSION['Participantes']['ID_Tipo_Usuario']  != "1")  {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

?>

<link rel="stylesheet" href="../../Assets/css/Participante/EConsulta_V2.css">

<div class="modal" id="Popup2" name="Modalconsulta" tabindex="-1"  >
  <div class="modal-dialog">
    <div class="modal-content">
    <div id="Alerta"></div>

      <div class="modal-header">
      <h5 class="modal-title">Realizar consulta</h5>
        <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      

  <div class="elem-group">
    <label for="email">De: </label>
    <input type="email" id="email" name="email" class="visitor_email" placeholder=<?php echo $_SESSION['Correo']; ?> value =<?php echo $_SESSION['Correo'] ?> disabled>
    <input type="hidden" id="email2" name="email2" class="visitor_email_2" value ="<?php echo $_SESSION['Correo'] ?>">
  </div>


  <div class="elem-group">
    <label for="title">Asunto: </label>
    <input type="text" id="title" class="email_title"  required />
  </div>
  <div class="elem-group">
    <label for="message">Escribe tu consulta: </label>
    <!--<textarea id="message" name="visitor_message" placeholder="Say whatever you want." required></textarea>-->
    <p><textarea id="message" class="visitor_message" name="visitor_message" placeholder="¿Cual es tu consulta?" required></textarea></p>
  </div>
  <!--<div class="elem-group">
    <textarea id="message" name="visitor_message" placeholder="Say whatever you want." required></textarea>
  </div>-->

 

      </div>
      <div class="modal-footer">
        <button type="button" id="CerrarConsulta" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="EnviarConsulta" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
</div>

