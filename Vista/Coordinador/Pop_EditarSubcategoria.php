<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

$id_subcate = $_POST['ID_SUB'];
require_once ("../../Modelo/Coordinador/MCategoria.php");



$PlanE3 = new MCategoria();
$List_AñoAcaE = $PlanE3->select_añoacademicoSUB($id_subcate);
 
 
$NombreSub = $_POST['NombreSub'];

?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_EditSubcategoria.css">

<div class="modal"  id="Pop_ESub" tabindex="-1" >
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Editar subcategoría: <span id="nombre-subcategoria"></h5>
            <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>

        </div>
        <div class="modal-body">
        <div id="Alerta"></div>
        <form  id="MEd_SubcatA" name="MEd_SubcatA">
        <p class="NotaCampos" ><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
         <div  class="row">
            <div class="form-group col-md-6">
                <input type="text" name="NSubcategoriaAd_E" id="NSubcategoriaAd_E" value="<?php echo $NombreSub ?>" required>
                <label class="TItuloPop">* Subcategoría : </label>
            </div>
            
        </div>

        <div  class="row">
                <div class="form-group col-md-6">
                        <label class="TItuloPop"> * Año Académico : </label>
                        <select class="form-select" name="AñoAca_E"  id="AñoAca_E"  onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example">
                        <option hidden selected>Seleccione el año académico</option>
                          <?php echo $List_AñoAcaE; ?>
                        </select> 
                    </div>
                </div>


        <div class="modal-footer">
          
          <button type="button" class="btnCancel_ESub" id="btnCancel_ESub"  >Cerrar</button>
          <button type="button" class="btnGEd_Sub" id="btnGEd_Sub" data-bs-dismiss="modal">Guardar cambios </button>

        </div>
      </div>
    </div>
  </div>

  
  
  <script type="text/javascript"  src="../../Assets/js/Coordinador/Pop_Subcategoria.js"></script>