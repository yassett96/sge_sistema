<?php
session_start();

if (!isset($_SESSION['Participantes']) or $_SESSION['Participantes']['ID_Tipo_Usuario']  != "1")  {


  header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

?>
<?php
require_once ("../../Modelo/Participante/MEditarCuenta.php");
$idg = $_SESSION['IdGrupo'];
$ids =  $_SESSION['IdSede'];
$modelcuenta = new EditarCuentaModelo();
$listagrupo = $modelcuenta->ListarGrupo($ids,$idg);
?>

    <link rel="icon" href="../../Assets/imagenes/Recursos/Logo_UNI.png" height="30px" width="30px">
    <!--<link rel="stylesheet" href="../../Assets/css/General/bootstrap.min.css">-->

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/css/Participante/editar_cuenta.css">

      <div class="modal" id="Popup2" tabindex="-1">        
        <div class="modal-dialog">
            <div id="msgt-error"> </div>            
            <div id="msgt2-error"> </div>
            <div id="msgc-error"> </div>
            <div id="msgc2-error"> </div>
            <div id="msgs-error"> </div>
          <div class="modal-content" id="idEditarCuenta" style="height: 500px;"><!-- style="height: 1000px;" --> 
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
                <div class="grupo">
                    <input type="email" name="email" id="email" oninput="Ocultarmensaje()" value="<?php echo $_SESSION['Correo']; ?>" required>
                    <label>Correo</label>
                </div>  
                <div class="grupo">
                    <?php 
                      if($_SESSION['Cedula'] == '' || $_SESSION['Cedula'] == null){
                        echo "<input type='cedula' name='cedula' id='pCedula' oninput='Ocultarmensaje()' onkeyup='formatoCedula()' placeholder='001-000000-0000U' value='".$_SESSION['Cedula']."' required>";
                      }else{
                        echo "<input type='cedula' name='cedula' id='pCedula' oninput='Ocultarmensaje()' onkeyup='formatoCedula()' placeholder='001-000000-0000U' value='".$_SESSION['Cedula']."' required disabled>";
                      }
                    ?>                    
                    <!-- <input type="text" name="cedula" id="pCedula" onkeyup="this.value = this.value.toUpperCase()" placeholder="001-000000-0000U"  required> -->
                    <label>Cédula</label>
                </div>  
                <div class="grupo">
                  <input type="text" name="grupo" id="grupo" value="<?php echo $_SESSION['Grupo']; ?>" disabled>
                  <label class="lgrupo">Grupo actual</label>
                </div>  
                <div class="grupo">              
                  <select class="form-select" id="sgrupo" name="sgrupo" aria-label="Default select example" onselect="Ocultarmensaje()" >
                  <option hidden selected>Seleccione grupo</option>
                    <?php echo $listagrupo; ?>
                  </select>
                  <label class="grupos">Actualizar grupo</label>  
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
    <script src="../../Assets/js/General/Constanst.js"></script>                     
    <script src="../../Assets/js/General/helperjs.js"></script>
    <script>
      // $('#cedula').mask("000-000000-0000S");
      function formatoCedula() {
        let cedulaInput = document.getElementById('pCedula');

        // Convertimos todo el contenido a mayúsculas
        cedulaInput.value.toUpperCase();

        
        let cedulaValue = cedulaInput.value;
      
        // Eliminamos todos los caracteres que no sean dígitos o la letra 'R'
        let formattedCedula = cedulaValue.replace(/[^0-9A-Z]/g, '');
      
        // Asegurarnos de que la longitud máxima sea 19 caracteres
        formattedCedula = formattedCedula.substring(0, 14);
      
        // Aplicamos el formato '000-000000-0000R'
        if (formattedCedula.length > 3) {
            formattedCedula = formattedCedula.substring(0, 3) + '-' + formattedCedula.substring(3);
        }
        if (formattedCedula.length > 10) {
            formattedCedula = formattedCedula.substring(0, 10) + '-' + formattedCedula.substring(10);
        }
        
        // Actualizamos el valor del campo con el formato aplicado
        cedulaInput.value = formattedCedula;
      }
    </script> 
    <!-- <script type="text/javascript" src="../../Assets/js/General/ValidacionesFormulario.js"></script> -->
    <script type="text/javascript" src="../../Assets/js/Participante/editar_cuenta.js"></script>
    