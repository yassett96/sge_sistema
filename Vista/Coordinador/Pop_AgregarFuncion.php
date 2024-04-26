<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
 
?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_AgregaFuncion.css">

<div class="modal"  id="Pop_AF" tabindex="-1" >
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Agregar función</h5>
            <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>

        </div>
        <div class="modal-body">
        <div id="Alerta"></div>
        <form  id="MFuncionA" name="MFuncionA">
        <p class="NotaCampos" ><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
         <div  class="row">
            <div class="form-group col-md-6">
                <input type="text" name="NFuncionAd" id="NFuncionAd"  required>
                <label>* Funcion : </label>
            </div>
            
        </div>
        <div  class="row">
                  <div class="form-group col-md-12">
                    <button id="btnADD_Funcion" class="btnADD_Funcion" > Agregar función </button>
                    
                  </div>
                </div>
        </form>
        
        <div  class="row">
                  <div class="form-group col-md-8">
                  <div id="MarcoAddF" class="table-wrapper-scroll-y my-custom-scrollbar">	
                  <table id="TAddFunciones"  class="table  table-hover table-condensed table-striped table-bordered " style="z-index:3;" >
                  <thead>
                    <tr>
                        <th>N</th>
                        <th>Funciones</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                        </table>
                        </div>
                    </div>
                    </div>

       

        <div class="modal-footer">
          
          <button type="button" class="btnCancel_AF" id="btnCancel_AF">Cerrar</button>
          <button type="button" class="btnAdd_F" id="btnAdd_F" data-bs-dismiss="modal">Guardar cambios</button>

        </div>
      </div>
    </div>
  </div>

  <script>






    </script>

  
  <script type="text/javascript"  src="../../Assets/js/Coordinador/Pop_Funcion.js"></script>