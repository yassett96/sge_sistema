<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
 
$NombreCat = $_POST['categoria']['titulo'];
?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_EditCategoria.css">

<div class="modal"  id="Pop_ECat" tabindex="-1" >
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Editar categoría</h5>
            <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>

        </div>
        <div class="modal-body">
        <div id="Alerta"></div>
        <form  id="MCategoriaE" name="MCategoriaE">
        <p class="NotaCampos" ><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
         <div  class="row">
            <div class="form-group col-md-6">
                <input type="text" name="NCategoriaEd" id="NCategoriaEd" value="<?php echo $NombreCat ?> " required>
                <label>* Nombre de la Categoría : </label>
            </div>
        </div>
        </form>


        <div class="modal-footer">
          
          <button type="button" class="btnCancel_ECat" id="btnCancel_ECat"  >Cerrar</button>
          <button type="button" class="btnEd_Cat" id="btnEd_Cat" data-bs-dismiss="modal">Guardar cambios</button>

        </div>
      </div>
    </div>
  </div>

  
  <script type="text/javascript"  src="../../Assets/js/Coordinador/Pop_Categoria.js"></script>