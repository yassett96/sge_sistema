<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
/*require_once ("../../Modelo/Coordinador/PlanificacionE.php");
require_once ("../../Modelo/Coordinador/MConferencia.php");

$PlanDG = new PlanificacionEM();

$DatosGEA = $PlanDG->ObtenerDatosGEvento();
$IdSitioE = $DatosGEA['ID_Sitio'];
$ListSalon = $PlanDG->select_sitiosalon($IdSitioE);
$HoraEA = $DatosGEA['hora'];

$PlanE4 = new MConferencia();
$CategoriaEventoA = $PlanE4->ConferenciaEventoA();*/

require_once ("../../Modelo/Coordinador/MJurado.php");

$PlanE5 = new MJUrado();

$listaCatE = $PlanE5->select_categoriaEvento();
$listaFromatoC = $PlanE5->select_formatocriterio();
$JuradoCEA = $PlanE5->JuradoEventoA();

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



    <link rel="stylesheet" href="../../Assets/css/Coordinador/PlanificacionE5.css">






    <title>Planificacion Feria E5</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
        </div>
        <div class="menu_general">
            <ul class="nav justify-content-end">
                <li class="nav-item"><a class="nav-link active" id="texto"
                        href="../../Vista/Coordinador/IndexCoordinadorCE.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link active" id="texto"
                        href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a></li>
                <li class="nav-item"><a class="nav-link active" id="texto"
                        href="../../Vista/Coordinador/AdminEventosCE.php">Administración de eventos</a></li>

                <li><a href="">Comisiones </a>
                    <ul>
                        <a id="FondoNav" href="../../Vista/Coordinador/ComisionAsignada.php">Comisión asignada</a>
                        <a id="FondoNav" href=".../../Prox.php">Comisiones generales</a>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link active" id="texto"
                        href=".../../Prox.php">Reportes</a></li>

                <div class="dropdown">
                    <img src="<?php echo $_SESSION['Avatar']; ?>" class="imgRedonda" />

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
                    <img src="<?php echo $_SESSION['Avatar']; ?>" class="imgRedonda link-item" />
                    <div class="NombreusuarioM"><?php echo $_SESSION['NombreCompleto']; ?></div>

                    <a class="link-item" href="../../Vista/Coordinador/IndexCoordinadorCE.php">Inicio</a>
                    <a class="link-item" href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a>
                    <a class="link-item" href="../../Vista/Coordinador/AdminEventosCE.php">Administración de eventos</a>
                    <a class="link-item" href="../../Vista/Coordinador/ComisionAsignada.php">Comisión asignada</a>
                    <a class="link-item" href="../../Prox.php">Comisiones generales</a>
                    <a class="link-item" href="../../Prox.php">Reportes</a>
                    <a class="link-item" href="../../Vista/Coordinador/MCuentaCE.php">Mi cuenta</a>
                    <a class="link-item" href='../../Controlador/General/CCerrarSesion.php'>Cerrar sesión</a>

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

    <a class="nav-link active" id="texto_atras" href="javascript:history.back()">
        << Atrás </a>
            <h4 id="texto_etapa"> Etapa 5 de 5 </h4>
            <a class="nav-link active" id="texto_planificacion"
                href="../../Vista/Coordinador/Planificacion_Feria_CE.php">Ir a etapas de planificación</a>
            <!--<a class="nav-link active" id="texto_siguiente" href="../../Vista/Coordinador/PlanificacionE5.php">Siguiente
                >></a>-->

            <h4 class="h4">Planificación de evento feria</h4>
            <h4 class="h4_2do">Gestionar jurados</h4>

            <?php
    if (!empty($JuradoCEA)) {
  // si hay datos, mostrar la tabla
?>
            <h4 class="h4_3ro">Jurados del evento</h4>
            <div class="row">
                <div class="form-group col-md-10">
                    <div id="FondoJurado" class="FondoJurado">

                        <div id="MarcoJur" class="table-wrapper-scroll-y my-custom-scrollbar-3">
                            <table id="TJuradoE" name="TJuradoE"
                                class="table  table-hover table-condensed table-striped table-bordered "
                                style="z-index:3;">
                                <thead>
                                    <tr>
                                        <th> N</th>
                                        <th> Categorías </th>
                                        <th> Subcategorías </th>
                                        <th> </th>

                                    </tr>
                                </thead>
                                <tbody id="tabla-Jurados">
                                    <?php echo $JuradoCEA ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-10">
                    <!--<button id="btnAddCE" class="btnAddCE" > Agregar Comision a evento </button>-->
                    <p class="NotaCamposJE"><b><i> Seleccione una subcategoría para ver sus jurados </i></b></p>
                    <button id="btnDetallesJE" class="btnDetallesJE">Ver detalles de jurados </button>
                </div>
            </div>

            <h4 class="h4_4to">Agregar Jurados al evento</h4>

            <div id="PF_FE5" class="Jurados_FeriaE5">
                <form id="P_F_E5" name="JuradosFeriaE5">
                    <div id="contenedor"></div>
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="Categorias-tab" data-toggle="tab" href="#Categorias"
                                role="tab" aria-controls="Categorias" aria-selected="true">Seleccionar categorías</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" id="FCriterios-tab" data-toggle="tab" href="#FCriterios"
                                role="tab" aria-controls="FCriterios" aria-selected="false">Seleccionar formato de
                                evaluación</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="Categorias" role="tabpanel"
                            aria-labelledby="Categorias-tab">
                            <form class="form-signin" id="fidcoment" name="fidcoment">
                                <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>

                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>Categorías (*): </label>
                                        <select class="form-select" name="CategoriaE" id="CategoriaE"
                                            onmousedown="if(this.options.length>3){this.size=3;}"
                                            onchange='this.size=0;' onblur="this.size=0;"
                                            aria-label="Default select example">
                                            <option hidden selected>Seleccione una categoría</option>
                                            <?php echo $listaCatE; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>SubCategorías (*): </label>
                                        <select class="form-select" name="SubcategoriasE" id="SubcategoriasE"
                                            onmousedown="if(this.options.length>3){this.size=3;}"
                                            onchange='this.size=0;' onblur="this.size=0;"
                                            aria-label="Default select example">
                                            <option hidden selected>Seleccione una subcategoría</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>1er Jurado (*): </label>
                                        <select class="form-select" name="JuradosC1s" id="JuradosC1"
                                            onmousedown="if(this.options.length>3){this.size=3;}"
                                            onchange='this.size=0;' onblur="this.size=0;"
                                            aria-label="Default select example">
                                            <option hidden selected>Seleccione al que sera jurado 1</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>2do Jurado: </label>
                                        <select class="form-select" name="JuradosC2s" id="JuradosC2"
                                            onmousedown="if(this.options.length>3){this.size=3;}"
                                            onchange='this.size=0;' onblur="this.size=0;"
                                            aria-label="Default select example" disabled>
                                            <option value="-1" selected>Seleccione al que sera jurado 2</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button id="btnQuitarSeleccionJ2" class="btnQuitarSeleccionJ2 btn " disabled>
                                            Limpiar selección </button>
                                        <!--<button id="btnEditarRs" class="btnEditarRs"> Editar  </button>-->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>3er Jurado: </label>
                                        <select class="form-select" name="JuradosC3s" id="JuradosC3"
                                            onmousedown="if(this.options.length>3){this.size=3;}"
                                            onchange='this.size=0;' onblur="this.size=0;"
                                            aria-label="Default select example" disabled>
                                            <option hidden selected>Seleccione al que sera jurado 3</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button id="btnQuitarSeleccionJ3" class="btnQuitarSeleccionJ3  btn" disabled>
                                        <!--disabled-->
                                        Limpiar selección
                                    </button>
                                    <!--<button id="btnEditarRs" class="btnEditarRs"> Editar  </button>-->
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button id="btnSigE5" class="btnSigE5"> Siguiente paso </button>
                                    <button id="btnCancelarR" class="btnCancelarR"> Cancelar registro </button>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="FCriterios" role="tabpanel" aria-labelledby="FCriterios">
                            <form class="form-signin" id="fidcoment2" name="fidcoment2">
                                <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>

                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>Formato de evaluacion (*): </label>
                                        <select class="form-select" name="FormatCriterio" id="FormatCriterio"
                                            onmousedown="if(this.options.length>3){this.size=3;}"
                                            onchange='this.size=0;' onblur="this.size=0;"
                                            aria-label="Default select example">
                                            <option hidden selected>Seleccione un tipo de Formato</option>
                                            <?php echo $listaFromatoC; ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button id="btnAgregarFormato" class="btnAgregarFormato"> Agregar nuevo
                                            formato
                                        </button>
                                        <button id="btnEditarFormato" class="btnEditarFormato"> Editar formato
                                        </button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label class="labelCriterios">Criterios (*):</label>
                                        <p class="NotaCriterios"><b><i> Seleccione un criterio para editar</i></b></p>
                                        <div id="MarcoCriterios" class="table-wrapper-scroll-y my-custom-scrollbar">
                                            <table id="TCriterios" name="TCatsub"
                                                class="table  table-hover table-condensed table-striped table-bordered "
                                                style="z-index:3;">
                                                <thead>
                                                    <tr>
                                                        <th> N</th>
                                                        <th> Criterio</th>
                                                        <th> Descripcion</th>
                                                        <th> Valor </th>
                                                        <th> </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tabla-criterios">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button id="btnAgregarCriterio" class="btnAgregarCriterio"> Agregar nuevo
                                            criterio
                                        </button>
                                        <button id="btnEditarCriterio" class="btnEditarCriterio"> Editar criterio
                                        </button>
                                    </div>
                                </div>




                                <button id="btnCancelarRegE5" class="btnCancelarRegE5"> Cancelar registro </button>
                                <button id="btnGuardarJE5" class="btnGuardarJE5">Guardar jurado </button>
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
            <h4 class="h4_4to">Agregar Jurados al evento</h4>

            <div id="PF_FE5" class="Jurados_FeriaE5">
                <form id="P_F_E5" name="JuradosFeriaE5">
                    <div id="contenedor"></div>
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="Categorias-tab" data-toggle="tab" href="#Categorias"
                                role="tab" aria-controls="Categorias" aria-selected="true">Seleccionar categorías</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" id="FCriterios-tab" data-toggle="tab" href="#FCriterios"
                                role="tab" aria-controls="FCriterios" aria-selected="false">Seleccionar formato de
                                evaluación</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="Categorias" role="tabpanel"
                            aria-labelledby="Categorias-tab">
                            <form class="form-signin" id="fidcoment" name="fidcoment">
                                <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>

                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>Categorías (*): </label>
                                        <select class="form-select" name="CategoriaE" id="CategoriaE"
                                            onmousedown="if(this.options.length>3){this.size=3;}"
                                            onchange='this.size=0;' onblur="this.size=0;"
                                            aria-label="Default select example">
                                            <option hidden selected>Seleccione una categoría</option>
                                            <?php echo $listaCatE; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>SubCategorías (*): </label>
                                        <select class="form-select" name="SubcategoriasE" id="SubcategoriasE"
                                            onmousedown="if(this.options.length>3){this.size=3;}"
                                            onchange='this.size=0;' onblur="this.size=0;"
                                            aria-label="Default select example">
                                            <option hidden selected>Seleccione una subcategoría</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>1er Jurado (*): </label>
                                        <select class="form-select" name="JuradosC1s" id="JuradosC1"
                                            onmousedown="if(this.options.length>3){this.size=3;}"
                                            onchange='this.size=0;' onblur="this.size=0;"
                                            aria-label="Default select example">
                                            <option hidden selected>Seleccione al que sera jurado 1</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>2do Jurado: </label>
                                        <select class="form-select" name="JuradosC2s" id="JuradosC2"
                                            onmousedown="if(this.options.length>3){this.size=3;}"
                                            onchange='this.size=0;' onblur="this.size=0;"
                                            aria-label="Default select example" disabled>
                                            <option value="-1" selected>Seleccione al que sera jurado 2</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button id="btnQuitarSeleccionJ2" class="btnQuitarSeleccionJ2 btn " disabled>
                                            Limpiar selección </button>
                                        <!--<button id="btnEditarRs" class="btnEditarRs"> Editar  </button>-->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>3er Jurado: </label>
                                        <select class="form-select" name="JuradosC3s" id="JuradosC3"
                                            onmousedown="if(this.options.length>3){this.size=3;}"
                                            onchange='this.size=0;' onblur="this.size=0;"
                                            aria-label="Default select example" disabled>
                                            <option hidden selected>Seleccione al que sera jurado 3</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button id="btnQuitarSeleccionJ3" class="btnQuitarSeleccionJ3  btn" disabled>
                                        <!--disabled-->
                                        Limpiar selección
                                    </button>
                                    <!--<button id="btnEditarRs" class="btnEditarRs"> Editar  </button>-->
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button id="btnSigE5" class="btnSigE5"> Siguiente paso </button>
                                    <button id="btnCancelarR" class="btnCancelarR"> Cancelar registro </button>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="FCriterios" role="tabpanel" aria-labelledby="FCriterios">
                            <form class="form-signin" id="fidcoment2" name="fidcoment2">
                                <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>

                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>Formato de evaluacion (*): </label>
                                        <select class="form-select" name="FormatCriterio" id="FormatCriterio"
                                            onmousedown="if(this.options.length>3){this.size=3;}"
                                            onchange='this.size=0;' onblur="this.size=0;"
                                            aria-label="Default select example">
                                            <option hidden selected>Seleccione un tipo de Formato</option>
                                            <?php echo $listaFromatoC; ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button id="btnAgregarFormato" class="btnAgregarFormato"> Agregar nuevo
                                            formato
                                        </button>
                                        <button id="btnEditarFormato" class="btnEditarFormato"> Editar formato
                                        </button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label class="labelCriterios">Criterios (*):</label>
                                        <p class="NotaCriterios"><b><i> Seleccione un criterio para editar</i></b></p>
                                        <div id="MarcoCriterios" class="table-wrapper-scroll-y my-custom-scrollbar">
                                            <table id="TCriterios" name="TCatsub"
                                                class="table  table-hover table-condensed table-striped table-bordered "
                                                style="z-index:3;">
                                                <thead>
                                                    <tr>
                                                        <th> N</th>
                                                        <th> Criterio</th>
                                                        <th> Descripcion</th>
                                                        <th> Valor </th>
                                                        <th> </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tabla-criterios">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button id="btnAgregarCriterio" class="btnAgregarCriterio"> Agregar nuevo
                                            criterio
                                        </button>
                                        <button id="btnEditarCriterio" class="btnEditarCriterio"> Editar criterio
                                        </button>
                                    </div>
                                </div>




                                <button id="btnCancelarRegE5" class="btnCancelarRegE5"> Cancelar registro </button>
                                <button id="btnGuardarJE5" class="btnGuardarJE5">Guardar jurado </button>
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

            <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>
            <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script src="../../Assets/js/General/menu_movil.js"></script>
            <script type="text/javascript" src="../../Assets/js/Coordinador/PlanificacionE5.js"></script>

            <script>
            $(document).ready(function() {
                var $tablaDatos = $('#TCriterios');

                $tablaDatos.on('click', 'tbody tr', function() {
                    // Elimina la clase "selected" de todas las filas
                    $tablaDatos.find('tbody tr').removeClass('selected');

                    // Agrega la clase "selected" a la fila seleccionada
                    $(this).addClass('selected');
                });
            });
            </script>

            <br>
            <br>
            <img src="../../Assets/imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">
            <br>
            <footer class="site-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <h2>Contáctenos</h2>
                            <ul class="footer-links">
                                <li><i class="fa fa-phone "></i>+505 2249 6429</li>
                                <li><i class=" fa fa-envelope-o  "></i></i>decanatura@fcys.uni.edu.ni</li>
                                <li><i class=" fa fa-map-marker  "></i></i>Semáforos 'Villa Progreso', 2 1/2 cuadras arriba
                                </li>
                            </ul>
                        </div>

                        <div class="col-xs-6 col-md-3">
                            <ul class="footer-links">
                                <li><a href="../../Vista/Coordinador/IndexCoordinadorCE.php">Inicio</a></li>
                                <li><a href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a></li>
                                <li><a href="../../Vista/Coordinador/AdminEventosCE.php">Administración de eventos</a>
                                </li>
                                <li><a href="../../Vista/Coordinador/MCuentaCE.php">Mi cuenta </a></li>
                            </ul>

                            </ul>
                        </div>

                        <div class="col-xs-6 col-md-3">
                            <ul class="footer-links">
                                <li><a href="../../Vista/Coordinador/ComisionAsignada.php">Comisión asignada</a></li>
                                <li><a href="../../Prox.php">Comisiones generales</a></li>
                                <li><a href="../../Prox.php">Reportes</a></li>

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

                    </div>
                </div>
            </footer>
</body>

</html>