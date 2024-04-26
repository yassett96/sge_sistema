<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
 
$NombreC = $_POST['comision']['titulo'];
?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_EditComision.css">

<div class="modal"  id="Pop_EC" tabindex="-1" >
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Editar Comisión</h5>
            <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>

        </div>
        <div class="modal-body">
        <div id="Alerta"></div>
        <form  id="MComisionE" name="MComisionE">
        <p class="NotaCampos" ><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
         <div  class="row">
            <div class="form-group col-md-6">
                <input type="text" name="NComisionEd" id="NComisionEd" value="<?php echo $NombreC ?> " required>
                <label>* Nombre de la Comisión : </label>
            </div>
        </div>
        </form>


        <div class="modal-footer">
          
          <button type="button" class="btnCancel_EC" id="btnCancel_EC"  >Cerrar</button>
          <button type="button" class="btnEd_C" id="btnEd_C" data-bs-dismiss="modal">Guardar cambios</button>

        </div>
      </div>
    </div>
  </div>

  
  <script type="text/javascript"  src="../../Assets/js/Coordinador/Pop_Comision.js"></script>