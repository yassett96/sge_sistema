<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/MCategoria.php");

$PlanE3 = new MCategoria();
$List_AñoAca = $PlanE3->select_añoacademico();
 
?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_AgregaSubCat.css">

<div class="modal"  id="Pop_ASubcat" tabindex="-1" >
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Agregar subcategoría</h5>
            <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>

        </div>
        <div class="modal-body">
        <div id="Alerta"></div>
        <form  id="MSubcatA" name="MSubcatA">
        <p class="NotaCampos" ><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
         <div  class="row">
            <div class="form-group col-md-6">
                <input type="text" name="NSubcategoriaAd" id="NSubcategoriaAd"  required>
                <label class="TItuloPop">* Subcategoría : </label>
            </div>
            
        </div>

        <div  class="row">
                <div class="form-group col-md-6">
                        <label class="TItuloPop"> * Año Académico : </label>
                        <select class="form-select" name="AñoAca"  id="AñoAca"  onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example">
                        <option hidden selected>Seleccione el año académico</option>
                          <?php echo $List_AñoAca; ?>
                        </select> 
                    </div>
                </div>
        <div  class="row">
                  <div class="form-group col-md-12">
                    <button id="btnAg_subcate" class="btnAg_subcate" > Añadir subcategoria </button>
                    
                  </div>
                </div>
        </form>
        
        <div  class="row">
                  <div class="form-group col-md-8">
                  <div id="MarcoAddSubcate" class="table-wrapper-scroll-y my-custom-scrollbar">	
                  <table id="TAddSubcate"  class="table  table-hover table-condensed table-striped table-bordered " style="z-index:3;" >
                  <thead>
                    <tr>
                      <th> N</th>
                      <th> Subcategorías</th>
                      <th> Año Académico </th>
                      <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                        </table>
                        </div>
                    </div>
                    </div>

       

        <div class="modal-footer">
          
          <button type="button" class="btnCancel_ASub" id="btnCancel_ASub">Cerrar</button>
          <button type="button" class="btnAdd_Sub" id="btnAdd_Sub" data-bs-dismiss="modal">Guardar cambios</button>

        </div>
      </div>
    </div>
  </div>

  <script>






    </script>

  
  <script type="text/javascript"  src="../../Assets/js/Coordinador/Pop_Subcategoria.js"></script>