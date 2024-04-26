<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
 
$NombreF = $_POST['NombreF'];
?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_EditFuncion.css">

<div class="modal"  id="Pop_EF" tabindex="-1" >
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Editar función</h5>
            <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>

        </div>
        <div class="modal-body">
        <div id="Alerta"></div>
        <form  id="Efuncion" name="Efuncion">
        <p class="NotaCampos" ><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
         <div  class="row">
            <div class="form-group col-md-6">
                <input type="text" name="NFuncionEd" id="NFuncionEd" value="<?php echo $NombreF ?> " required>
                <label>* Funcion : </label>
            </div>
        </div>
        </form>


        <div class="modal-footer">
          
          <button type="button" class="btnCancel_EF" id="btnCancel_EF"  >Cerrar</button>
          <button type="button" class="btnEd_F" id="btnEd_F" data-bs-dismiss="modal">Guardar cambios </button>

        </div>
      </div>
    </div>
  </div>

  
  <script type="text/javascript"  src="../../Assets/js/Coordinador/Pop_Funcion.js"></script>