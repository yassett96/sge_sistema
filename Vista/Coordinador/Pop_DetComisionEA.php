<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/MComisionEA.php");

$IdCEA = $_POST['IdComEA'];

$CEA = new ModComisionEA();
$Datos_ComisionEA = $CEA->ObtenerNombreComision($IdCEA);
$NombreCEA = $Datos_ComisionEA['Nombre_Comision'];
$ID_com = $Datos_ComisionEA['ID_Comision'];
$FuncionCEA = $CEA->FuncionesComisionEventoA($ID_com);
$R1_CEA = $CEA->select_R1CEA($IdCEA);
$R2_CEA = $CEA->select_R2CEA($IdCEA);
if (empty($R2_CEA)){
  $R2_CEA = " - No se asignó Responsable 2 -";
}
$R3_CEA = $CEA->select_R3CEA($IdCEA);
if (empty($R3_CEA)){
  $R3_CEA = " - No se asignó Responsable 3 - ";
}

$IntegrantesCEA = $CEA->Integrantes_CEA($IdCEA);

 

?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_DetComisionEA.css">

<div class="modal"  id="Pop_ComisionEA" tabindex="-1" >
    <div class="modal-dialog">
    	<div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Detalles de <span id="nombre-funcion"></span></h5>
                <!--<button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>-->
                <button type="button" class="Closedes" id="Closedes"  >X</button>
            </div>

            <div class="modal-body"> 
    			<div id="GC_EActual" class="Comisiones_EActual">
          			<form>
            		    <div id="contenedor"></div>
              		        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="DetComision-tab" data-toggle="tab" href="#ComisionesA" role="tab" aria-controls="ComisionesA" aria-selected="true">Detalles de la Comisión</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="DetIntegrantesC-tab" data-toggle="tab" href="#IntegrantesCA" role="tab" aria-controls="IntegrantesCA" aria-selected="false" >Integrantes de la Comisión</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="ComisionesA" role="tabpanel" aria-labelledby="Comisiones-tab">
                                    <form class="form-signin" id="idfrom" > 
                                        <div  class="row">
                                            <div class="form-group col-md-8">
                                                <label>Nombre Comisión </label>
                                                <input type="text" value="<?php echo $NombreCEA ?>" disabled>
                                            </div>
                                        </div>
                
                                        <div  class="row">
                                            <div class="form-group col-md-10">
                                                <label >Funciones de la comisión:</label>
                                                <div id="MarcoFunCEA" class="table-wrapper-scroll-y my-custom-scrollbar-2">	
                                                    <table id="TFuncionesCEA" name="TFuncionesCEA" class="table  table-hover table-condensed table-striped table-bordered " style="z-index:3;" >
                                                        <thead>
                                                            <tr>
                                                                <th> N</th>
                                                                <th> Funciones</th>   
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tabla-datosCEA">
                                                            <?php echo $FuncionCEA ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </form> 
                                </div>

                                <div class="tab-pane fade" id="IntegrantesCA" role="tabpanel" aria-labelledby="IntegrantesC-tab">
                                    <form class="form-signin" id="fidcomentCEA" name="fidcomentCEA"> 
                                        <div  class="row">
                                            <div class="form-group col-md-8">
                                                <label>Responsable 1 : </label>
                                                <input type="text" value="<?php echo $R1_CEA ?>" disabled>
                                            </div>
                                        </div>
                
                                        <div  class="row">
                                            <div class="form-group col-md-8">
                                                <label>Responsable 2: </label>
                                                <input type="text" value="<?php echo $R2_CEA ?>" disabled>
                                            </div> 
                                        </div>
                                        
                                        <div  class="row">
                                            <div class="form-group col-md-8">
                                                <label>Responsable 3: </label>
                                                <input type="text" value="<?php echo $R3_CEA ?>" disabled>
                                            </div>
                                        </div>

                                         <div  class="row">
                                            <div class="form-group col-md-8">
                                            <label>Integrantes: </label>
                                                <div id="MarcoIntCEA" class="table-wrapper-scroll-y my-custom-scrollbar">	
                                                    <table id="TIntegrantesCEA"  class="table  table-hover table-condensed table-striped table-bordered " style="z-index:3;" >
                                                        <thead>
                                                        <tr >
                                                            <th> N </th>   
                                                            <th> Integrantes </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="Tabla_int">
                                                            <?php echo $IntegrantesCEA  ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </form>
    	        </div>
                <div  class="row">
                <div class="form-group col-md-12">
				    <button type="button" class="btnCerrarPOP_CEA" id="btnCerrarPOP_CEA"  >Cerrar</button>
			    </div>
            </div>
            </div>

            
        </div>
    </div>
</div>
    					


<script type="text/javascript"  src="../../Assets/js/Coordinador/Pop_DetComisionEA.js"></script>