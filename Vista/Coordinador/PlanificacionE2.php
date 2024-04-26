<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/PlanificacionE.php");



$PlanDG = new PlanificacionEM();
$ComisionList = $PlanDG->select_comision();
$PersonalAcaList = $PlanDG->select_PersonalAcademico();
$ComisionEvento = $PlanDG->ComisionEventoA();



//$Sitiolist = $PlanDG->select_sitio(); <?php echo $Sitiolist  <?php echo $List; 
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../../Assets/imagenes/Recursos/Logo_UNI.png" height="30px" width="30px">
    <link rel="stylesheet" href="../../Assets/css/General/bootstrap.min.css">


    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/herramientas/font-awesome-4.7.0/css/font-awesome.min.css">

    

    <link rel="stylesheet" href="../../Assets/css/Coordinador/PlanificacionE2.css">
    <link rel="stylesheet" href="../../Assets/css/General/jquery.dataTables.min.css">

    


    
    
    <title>Planificacion Feria E2</title>
</head>
<body >
<header>
        <div class="logo">
          <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
        </div>
        <div class="menu_general">
          <ul class="nav justify-content-end">
          <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Coordinador/IndexCoordinadorCE.php" >Inicio</a></li>
            <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a></li>
            <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Coordinador/AdminEventosCE.php">Administración de eventos</a></li>
           
            <li><a href="">Comisiones </a>
					<ul>
            <a id="FondoNav" href="../../Vista/Coordinador/ComisionAsignada.php">Comisión asignada</a>
            <a id="FondoNav" href=".../../Prox.php">Comisiones generales</a>
					</ul>
				</li>
        <li class="nav-item"><a class="nav-link active" id="texto" href=".../../Prox.php">Reportes</a></li>
		
                <div class="dropdown">
                    <img src="<?php echo $_SESSION['Avatar']; ?>"  class="imgRedonda"/>
  
                    <div class="dropdown-content">
                        <a href="../../Vista/Coordinador/MCuentaCE.php">Mi cuenta</a>
                        <a href='../../Controlador/General/CCerrarSesion.php'>Cerrar sesión</a>
                    </div>
                </div>
			</ul>
            <div class="Nombreusuario"><?php echo $_SESSION['NombreCompleto']; ?></div>
        </div>

        <!--A partir de aqui inicia el menu movil, pero copiar todo lo contenido en HEADER-->
        <div class="main-header">
        
            <nav id="nav" class="main-nav">
              <div class="nav-links">
              <img src="<?php echo $_SESSION['Avatar']; ?>"  class="imgRedonda link-item"/>
              <div class="NombreusuarioM"><?php echo $_SESSION['NombreCompleto']; ?></div>
        
              <a class="link-item"  href="../../Vista/Coordinador/IndexCoordinadorCE.php">Inicio</a>
                <a class="link-item"  href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a>
                <a class="link-item"  href="../../Vista/Coordinador/AdminEventosCE.php">Administración de eventos</a>
                <a class="link-item"  href="../../Vista/Coordinador/ComisionAsignada.php">Comisión asignada</a>
                <a class="link-item"  href="../../Vista/Coordinador/ComisionesGenerales.php">Comisiones generales</a>
                <a class="link-item"  href="../../Vista/Coordinador/Reportes.php">Reportes</a>
                <a class="link-item"  href="../../Vista/Coordinador/MCuentaCE.php">Mi cuenta</a>
                <a class="link-item"  href='../../Controlador/General/CCerrarSesion.php'>Cerrar sesión</a>
                
              </div>
            </nav>
            <button id="button-menu" class="button-menu">
              <span></span>
              <span></span>
              <span></span>
            </button>
          </div>
    </header>
    
    <img src="../../Assets/imagenes/Recursos/mosaico1.png" id="mosaicoDER" height="180px" width="180px">
   
    <a class="nav-link active" id="texto_atras" href="javascript:history.back()" > << Atrás  </a>
    <h4 id="texto_etapa"> Etapa 2 de 5 </h4>
    <a class="nav-link active" id="texto_planificacion" href="../../Vista/Coordinador/Planificacion_Feria_CE.php" >Ir a etapas de planificación</a>
    <a class="nav-link active" id="texto_siguiente" href="../../Vista/Coordinador/PlanificacionE3.php" >Siguiente >></a>

    <h4 class="h4">Planificación de evento feria</h4>
    <h4 class="h4_2do">Gestionar comisiones</h4>

    
    <?php
    if (!empty($ComisionEvento)) {
  // si hay datos, mostrar la tabla
?>
<h4 class="h4_3ro">Comisiones del evento</h4>
    <div  class="row">
      <div class="form-group col-md-10">
        <div  id="FondoComision" class="FondoComision">

          <div id="MarcoCom" class="table-wrapper-scroll-y my-custom-scrollbar-3">	
            <table id="TComisiones" name="TComisiones" class="table  table-hover table-condensed table-striped table-bordered " style="z-index:3;" >
              <thead>
                <tr>
                  <th> N</th>
                  <th> Comisiones del evento</th>
                  <th> </th>
                  
                </tr>
              </thead>
              <tbody id="tabla-comisiones">
                <?php echo $ComisionEvento ?>
              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
      <div  class="row">
        <div class="form-group col-md-10">
          <!--<button id="btnAddCE" class="btnAddCE" > Agregar Comision a evento </button>-->
          <p class="NotaCamposCE" ><b><i> Seleccione una comisión para ver sus detalles </i></b></p>
          <button id="btnEditaCE" class="btnEditaCE">Ver detalles comisión </button>
        </div>
      </div>

      <h4 class="h4_4to">Agregar comisión al evento</h4>
    
    <div id="DG_FE2" class="Comisiones_FeriaE2">
      <form  id="DG_FE2" name="ComisionesFeriaE2">
      <div id="contenedor"></div>
        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="Comisiones-tab" data-toggle="tab" href="#Comisiones" role="tab" aria-controls="Comisiones" aria-selected="true">Seleccionar Comisiones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" id="IntegrantesC-tab" data-toggle="tab" href="#IntegrantesC" role="tab" aria-controls="IntegrantesC" aria-selected="false" >Seleccionar Integrantes</a>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="Comisiones" role="tabpanel" aria-labelledby="Comisiones-tab">
            <form class="form-signin" id="idfrom" > 
            <p class="NotaCampos" ><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
            <div  class="row">
                <div class="form-group col-md-8">
                  <label>Comisiones (*): </label>
                  <select class="form-select" name="ComisionE"  id="ComisionE"  onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example">
                  <option hidden selected>Seleccione una Comision</option>
                    <?php echo $ComisionList; ?>
                  </select> 
                </div>
                </div>
                <div  class="row">
                  <div class="form-group col-md-12">
                <button id="btnAgregarComision" class="btnAgregarComision"> Agregar nueva comisión </button>
                <button id="btnEditarComision" class="btnEditarComision"> Editar comisión </button>
                </div>
                </div>
                
                <div  class="row">
                <div class="form-group col-md-10">
                        <label id="LabelFunciones">Funciones de la comisión:</label>
                        <p class="NotaFunciones" ><b><i> Seleccione la funcion a editar</i></b></p>
                        <div id="MarcoFun" class="table-wrapper-scroll-y my-custom-scrollbar-2">	
                        <table id="TFunciones" name="TFunciones" class="table  table-hover table-condensed table-striped table-bordered " style="z-index:3;" >
                          <thead>
                            <tr>
                              <th> N</th>
                              <th> Funciones</th>
                              <th> </th>
                            </tr>
                          </thead>
                          <tbody id="tabla-datos">

                          </tbody>
                        </table>
                        </div>
                    </div>
                 
                </div>
                <div  class="row">
                  <div class="form-group col-md-12">
                <button id="btnAGG" class="btnAGG" > Agregar función </button>
                <button id="btnEDIT" class="btnEDIT">Editar función </button>
                </div>
                 </div>
                
                
            </form> 
            <div  class="row">
                  <div class="form-group col-md-12">
            <button id="btnSigE2" class="btnSigE2"> Siguiente paso </button>    
            <button id="btnCancelarR" class="btnCancelarR"> Cancelar registro </button> 
            </div>
                 </div> 
          </div>
          <div class="tab-pane fade" id="IntegrantesC" role="tabpanel" aria-labelledby="IntegrantesC-tab">
            <form class="form-signin" id="fidcoment" name="fidcoment"> 
            <p class="NotaCampos" ><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
            <div  class="row">
                <div class="form-group col-md-8">
                        <label>Responsable 1(*): </label>
                        <select class="form-select " name="ResponsableC"  id="ResponsableC1"  onmousedown="if(this.options.length>3){this.size=6;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example" >
                        <option hidden selected>Seleccione al Responsable 1</option>
                          <?php echo $PersonalAcaList; ?>
                        </select> 
                    </div>
                </div>
                <div  class="row">
                <div class="form-group col-md-8">
                        <label>Responsable 2: </label>
                        <select class="form-select disabled" name="ResponsableC2"  id="ResponsableC2"  onmousedown="if(this.options.length>3){this.size=6;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example" disabled >
                        <option hidden selected>Seleccione al Responsable 2 si lo desea</option>
                          <?php echo $PersonalAcaList; ?>
                        </select> 
                    </div>
                </div>
                <div  class="row">
                  <div class="form-group col-md-12">
                     <button id="btnQuitarSeleccionR2" class="btnQuitarSeleccionR2 btn " disabled> Limpiar selección </button>
                   <!--<button id="btnEditarRs" class="btnEditarRs"> Editar  </button>-->
                  </div>
                </div>
                <div  class="row">
                <div class="form-group col-md-8">
                        <label>Responsable 3: </label>
                        <select class="form-select " name="ResponsableC3"  id="ResponsableC3"  onmousedown="if(this.options.length>3){this.size=6;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example" disabled >
                        <option hidden selected>Seleccione al Responsable 3 si lo desea</option>
                          <?php echo $PersonalAcaList; ?>
                        </select> 
                    </div>
                </div>
                <div  class="row">
                  <div class="form-group col-md-12">
                    <button id="btnQuitarSeleccionR3" class="btnQuitarSeleccionR3  btn" disabled> Limpiar selección </button>
                    <!--<button id="btnEditarRs" class="btnEditarRs"> Editar  </button>-->
                  </div>
                </div>
      
              <div  class="row">
                <div class="form-group col-md-8">
                        <label>Integrantes (*): </label>
                        <select class="form-select" name="IntegranteC"  id="IntegranteC"  onmousedown="if(this.options.length>3){this.size=6;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example" >
                        <option hidden selected>Seleccione a los integrantes</option>
                          <?php echo $PersonalAcaList; ?>
                        </select> 
                    </div>
                </div>
                <div  class="row">
                  <div class="form-group col-md-12">
                     <!--<button id="btnAgregarIn" class="btnAgregarIn"> Agregar Integrante </button>
                    <button id="btnEditarIn" class="btnEditarIn"> Editar Integrante </button>-->
                  </div>
                </div>
                <div  class="row">
                  <div class="form-group col-md-8">
                  <div id="MarcoInt" class="table-wrapper-scroll-y my-custom-scrollbar">	
                  <table id="TIntegrantes"  class="table  table-hover table-condensed table-striped table-bordered " style="z-index:3;" >
                          <thead>
                            <tr >
                              <th> N </th>   
                              <th> Integrantes </th>  
                              <th> </th>
                            </tr>
                          </thead>
                          <tbody id="Tabla_int">

                          </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
              
              <button id="btnCancelarRPA" class="btnCancelarRPA"> Cancelar registro</button>
              <button id="btnGuardarDatosG" class="btnGuardarDatosG" >Guardar </button>
              </div>
                </div>
            </form> 
          </div>
        </div>
        
      </form> 
 
    </div>
<?php
    } else {
  // si no hay datos, mostrar solo el div DG_FE2
?>

      <h4 class="h4_4to">Agregar comisión al evento</h4>
    
    <div id="DG_FE2" class="Comisiones_FeriaE2">
      <form  id="DG_FE2" name="ComisionesFeriaE2">
      <div id="contenedor"></div>
        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="Comisiones-tab" data-toggle="tab" href="#Comisiones" role="tab" aria-controls="Comisiones" aria-selected="true">Seleccionar Comisiones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" id="IntegrantesC-tab" data-toggle="tab" href="#IntegrantesC" role="tab" aria-controls="IntegrantesC" aria-selected="false" >Seleccionar Integrantes</a>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="Comisiones" role="tabpanel" aria-labelledby="Comisiones-tab">
            <form class="form-signin" id="idfrom" > 
            <p class="NotaCampos" ><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
            <div  class="row">
                <div class="form-group col-md-8">
                        <label>Comisiones (*): </label>
                        <select class="form-select" name="ComisionE"  id="ComisionE"  onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example">
                        <option hidden selected>Seleccione una Comision</option>
                          <?php echo $ComisionList; ?>
                        </select> 
                    </div>
                </div>
                <div  class="row">
                  <div class="form-group col-md-12">
                <button id="btnAgregarComision" class="btnAgregarComision"> Agregar Comision </button>
                <button id="btnEditarComision" class="btnEditarComision"> Editar comisión </button>
                </div>
                </div>
                
                <div  class="row">
                <div class="form-group col-md-10">
                        <label id="LabelFunciones">Funciones de la comisión:</label>
                        <p class="NotaFunciones" ><b><i> Seleccione la funcion a editar</i></b></p>
                        <div id="MarcoFun" class="table-wrapper-scroll-y my-custom-scrollbar-2">	
                        <table id="TFunciones" name="TFunciones" class="table  table-hover table-condensed table-striped table-bordered " style="z-index:3;" >
                          <thead>
                            <tr>
                              <th> N</th>
                              <th> Funciones</th>
                              <th> </th>
                            </tr>
                          </thead>
                          <tbody id="tabla-datos">

                          </tbody>
                        </table>
                        </div>
                    </div>
                 
                </div>
                <div  class="row">
                  <div class="form-group col-md-12">
                <button id="btnAGG" class="btnAGG" > Agregar función </button>
                <button id="btnEDIT" class="btnEDIT">Editar función </button>
                </div>
                 </div>
                
                
            </form> 
            <div  class="row">
                  <div class="form-group col-md-12">
            <button id="btnSigE2" class="btnSigE2"> Siguiente paso </button>    
            <button id="btnCancelarR" class="btnCancelarR"> Cancelar registro </button> 
            </div>
                 </div> 
          </div>
          <div class="tab-pane fade" id="IntegrantesC" role="tabpanel" aria-labelledby="IntegrantesC-tab">
            <form class="form-signin" id="fidcoment" name="fidcoment"> 
            <p class="NotaCampos" ><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
            <div  class="row">
                <div class="form-group col-md-8">
                        <label>Responsable 1(*): </label>
                        <select class="form-select " name="ResponsableC"  id="ResponsableC1"  onmousedown="if(this.options.length>3){this.size=6;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example" >
                        <option hidden selected>Seleccione al Responsable 1</option>
                          <?php echo $PersonalAcaList; ?>
                        </select> 
                    </div>
                </div>
                <div  class="row">
                <div class="form-group col-md-8">
                        <label>Responsable 2: </label>
                        <select class="form-select disabled" name="ResponsableC2"  id="ResponsableC2"  onmousedown="if(this.options.length>3){this.size=6;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example" disabled >
                        <option hidden selected>Seleccione al Responsable 2 si lo desea</option>
                          <?php echo $PersonalAcaList; ?>
                        </select> 
                    </div>
                </div>
                <div  class="row">
                  <div class="form-group col-md-12">
                     <button id="btnQuitarSeleccionR2" class="btnQuitarSeleccionR2 btn " disabled> Limpiar selección </button>
                   <!--<button id="btnEditarRs" class="btnEditarRs"> Editar  </button>-->
                  </div>
                </div>
                <div  class="row">
                <div class="form-group col-md-8">
                        <label>Responsable 3: </label>
                        <select class="form-select " name="ResponsableC3"  id="ResponsableC3"  onmousedown="if(this.options.length>3){this.size=6;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example" disabled >
                        <option hidden selected>Seleccione al Responsable 3 si lo desea</option>
                          <?php echo $PersonalAcaList; ?>
                        </select> 
                    </div>
                </div>
                <div  class="row">
                  <div class="form-group col-md-12">
                    <button id="btnQuitarSeleccionR3" class="btnQuitarSeleccionR3  btn" disabled> Limpiar selección </button>
                    <!--<button id="btnEditarRs" class="btnEditarRs"> Editar  </button>-->
                  </div>
                </div>
      
              <div  class="row">
                <div class="form-group col-md-8">
                        <label>Integrantes (*): </label>
                        <select class="form-select" name="IntegranteC"  id="IntegranteC"  onmousedown="if(this.options.length>3){this.size=6;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example"  >
                        <option hidden selected>Seleccione a los integrantes</option>
                          <?php echo $PersonalAcaList; ?>
                        </select> 
                    </div>
                </div>
                <div  class="row">
                  <div class="form-group col-md-12">
                     <!--<button id="btnAgregarIn" class="btnAgregarIn"> Agregar Integrante </button>
                    <button id="btnEditarIn" class="btnEditarIn"> Editar Integrante </button>-->
                  </div>
                </div>
                <div  class="row">
                  <div class="form-group col-md-8">
                  <div id="MarcoInt" class="table-wrapper-scroll-y my-custom-scrollbar">	
                  <table id="TIntegrantes"  class="table  table-hover table-condensed table-striped table-bordered " style="z-index:3;" >
                          <thead>
                            <tr >
                              <th> N </th>   
                              <th> Integrantes </th>  
                              <th> </th>
                            </tr>
                          </thead>
                          <tbody id="Tabla_int">

                          </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
              
              <button id="btnCancelarRPA" class="btnCancelarRPA"> Cancelar registro </button>
              <button id="btnGuardarDatosG" class="btnGuardarDatosG" >Guardar </button>
              </div>
                </div>
            </form> 
          </div>
        </div>
        
      </form> 
 
    </div>
<?php
  }
?>

   



<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
<script src="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" ></script>
<script type="text/javascript" src="datatables/datatables.min.js"></script>-->


  <!--<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
    <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>
    <script type="text/javascript" src= "../../Assets/js/General/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>

    <script type="text/javascript" src="../../Assets/js/General/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="../../Assets/js/General/datatables.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    

    
    
    

    <!--https://code.jquery.com/jquery-3.5.1.js
    https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js
    https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js-->
  


<!--<script type="text/javascript" src="datatables/datatables.min.js"></script>-->
<script>

//var myTable = document.querySelector("#TFunciones"); 

//function eliminarFila(i){
       /* var rowCount = myTable.rows.length;

        if(rowCount <= 1) {
          alert('No se puede eliminar el encabezado');
        } else {
          myTable.deleteRow();
        }
      }*/

 
  // Obtener el botón y el div a mostrar
  


    

      
      function eliminarFila(fila) {
//document.getElementById("tabla-datos").deleteRow(i);


const filaw = fila.parentNode.parentNode;

    // Eliminar la fila
    filaw.remove();
    actualizarNumeros();
  }

  function actualizarNumeros() {
    // Obtener todas las celdas que contienen los números de fila
    const celdasNumero = document.querySelectorAll('.orden');
    const celdasNumero2 = document.querySelectorAll('.ordenIn');

    //console.log(celdasNumero.parentNode);

    if (celdasNumero.parentNode = 'orden'){

    // Recorrer todas las celdas y actualizar su contenido
    for (let i = 0; i < celdasNumero.length; i++) {
      celdasNumero[i].textContent = i + 1;
    }
    }
    
    if (celdasNumero2.parentNode = 'ordenIn'){
    //const celdasNumero2 = document.querySelectorAll('.ordenIn');
    for (let j = 0; j < celdasNumero2.length; j++) {
      celdasNumero2[j].textContent = j + 1;
    }
  }
  }
/*var cantidadTR = $("#tabla-datos tr").length;

console.log(cantidadTR)
        for (var i = 1; i < cantidadTR-1; i++) {
            $($($("tr").get(i)).find("td").get(1)).text(parseInt($($($("tr").get(i)).find("td").get(1)).text()) - 1);
        } */

        $(document).ready(function() {
  var $tablaDatos = $('#TFunciones');

  $tablaDatos.on('click', 'tbody tr', function() {
    // Elimina la clase "selected" de todas las filas
    $tablaDatos.find('tbody tr').removeClass('selected');
    
    // Agrega la clase "selected" a la fila seleccionada
    $(this).addClass('selected');
  });
  
  var $tablaDatos = $('#TComisiones');

  $tablaDatos.on('click', 'tbody tr', function() {
    // Elimina la clase "selected" de todas las filas
    $tablaDatos.find('tbody tr').removeClass('selected');
    
    // Agrega la clase "selected" a la fila seleccionada
    $(this).addClass('selected');
  });

  


});
                
    
            
    </script>
        
    

    <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" src="../../Assets/js/Coordinador/PlanificacionFeria.js"></script>-->
    <script type="text/javascript" src="../../Assets/js/Coordinador/PFE2.js"></script>

    <script src="../../Assets/js/General/menu_movil.js"></script>
    
    <br>
    <br>
    <img src="../../Assets/imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px" >
    <br>
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
          <h2>Contáctenos</h2>
            <ul class="footer-links">
            <li><i class="fa fa-phone " ></i>+505 2249 6429</li>
                <li><i class=" fa fa-envelope-o  "></i></i>decanatura@fcys.uni.edu.ni</li>
                <li><i class=" fa fa-map-marker  "></i></i>Semáforos 'Villa Progreso', 2 1/2 cuadras arriba</li>
            </ul>
          </div>
  
          <div class="col-xs-6 col-md-3">         
            <ul class="footer-links">
                <li><a href="../../Vista/Coordinador/IndexCoordinadorCE.php">Inicio</a></li>
                <li><a href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a></li>
                <li><a href="../../Vista/Coordinador/AdminEventosCE.php">Administración de eventos</a></li>
                <li><a href="../../Vista/Coordinador/MCuentaCE.php">Mi cuenta  </a></li>
            </ul>
               
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
          <ul class="footer-links">
          <li><a href="../../Vista/Coordinador/ComisionAsignada.php">Comisión asignada</a></li>
          <li><a href="../../Vista/Coordinador/ComisionesGenerales.php">Comisiones generales</a></li>
       <li><a href="../../Vista/Coordinador/Reportes.php">Reportes</a></li>
       
       </ul>
            
          </div>

          <div class="col-xs-6">
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="global" href="#"><i class="fa fa-globe"></i></a></li> 
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text"> &copy; Universidad nacional de ingeniería 2023 </p>
          </div>
          

          <!--<div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="global" href="#"><i class="fa fa-globe"></i></a></li>
             
            </ul>
          </div>-->
        </div>
      </div>
</footer>
</body>
</html>