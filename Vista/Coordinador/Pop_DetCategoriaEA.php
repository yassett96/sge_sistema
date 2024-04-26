<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/MCategoria.php");


$PlanE3 = new MCategoria();

$IdCEA = $_POST['IdComEA'];

$Datos_CategoriaEA = $PlanE3->ObtenerNombreCategoria($IdCEA);
$NombreCEA = $Datos_CategoriaEA['Nombre_Categoria'];
$ID_Cat = $Datos_CategoriaEA['ID_Categoria'];
$SubcategoriaCEA = $PlanE3->SubcategoriasXCategoriaEventoA($ID_Cat);


?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_DetCategoriaEA.css">

<div class="modal"  id="Pop_CategoriaEA" tabindex="-1" >
    <div class="modal-dialog">
    	<div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Detalles de Categoría <span id="nombre-categoria"></span></h5>
                <button type="button" class="Closedes" id="Closedes"  >X</button>
            </div>

            <div class="modal-body"> 
                <div id="GC_EActual" class="Comisiones_EActual">
                            
                        <form class="form-signin" id="idfrom" > 
                            <div  class="row">
                                <div class="form-group col-md-8">
                                    <label>Categoría  </label>
                                    <input type="text" value="<?php echo $NombreCEA ?>" disabled>
                                </div>
                            </div>
                
                            <div  class="row">
                                <div class="form-group col-md-10">
                                    <label >Subcategorías:</label>
                                    <div id="MarcoSubCEA" class="table-wrapper-scroll-y my-custom-scrollbar-2">	
                                        <table id="TSubcategoriasCEA" name="TSubcategoriasCEA" class="table  table-hover table-condensed table-striped table-bordered " style="z-index:3;" >
                                            <thead>
                                                <tr>
                                                <th> N</th>
                              <th> Subcategorías</th>
                              <th> Año Académico </th>
                                                </tr>
                                            </thead>
                                                <tbody id="tabla-datosCEA">
                                                    <?php echo $SubcategoriaCEA ?>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                            
                </div>

            </div>
            
            <div  class="row">
                <div class="form-group col-md-12">
				    <button type="button" class="btnCerrarPOP_CatEA" id="btnCerrarPOP_CatEA"  >Cerrar</button>
			    </div>
            </div>
        </div>

            
        </div>
    </div>
</div>

<script type="text/javascript"  src="../../Assets/js/Coordinador/Pop_DetCategoriaEA.js"></script>
