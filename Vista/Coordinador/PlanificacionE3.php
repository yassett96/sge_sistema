<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/MCategoria.php");

$PlanE3 = new MCategoria();
$Categorialist = $PlanE3->select_categoria();
$CategoriaEventoA = $PlanE3->CategoriaEventoA();

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



    <link rel="stylesheet" href="../../Assets/css/Coordinador/PlanificacionE3.css">
    <link rel="stylesheet" href="../../Assets/css/General/jquery.dataTables.min.css">






    <title>Planificacion Feria E3</title>
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
                        <a id="FondoNav" href=".../../Vista/Coordinador/ComisionesGenerales.php">Comisiones generales</a>
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
                    <a class="link-item" href="../../Vista/Coordinador/ComisionesGenerales.php">Comisiones generales</a>
                    <a class="link-item" href="../../Vista/Coordinador/Reportes.php">Reportes</a>
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
            <h4 id="texto_etapa"> Etapa 3 de 5 </h4>
            <a class="nav-link active" id="texto_planificacion"
                href="../../Vista/Coordinador/Planificacion_Feria_CE.php">Ir a etapas de planificación</a>
            <a class="nav-link active" id="texto_siguiente" href="../../Vista/Coordinador/PlanificacionE4.php">Siguiente
                >></a>

            <h4 class="h4">Planificación de evento feria</h4>
            <h4 class="h4_2do">Gestionar categorías y subcategorías</h4>
            <!--<h4 class="h4_4to">Agregar categorías y subcategorías al evento</h4>-->


            <?php
    if (!empty($CategoriaEventoA)) {
  // si hay datos, mostrar la tabla
?>
            <h4 class="h4_3ro">Categorías del evento</h4>
            <div class="row">
                <div class="form-group col-md-10">
                    <div id="FondoCategoriaE" class="FondoCategoriaE">

                        <div id="MarcoCat" class="table-wrapper-scroll-y my-custom-scrollbar-3">
                            <table id="TCategoria" name="TCategoria"
                                class="table  table-hover table-condensed table-striped table-bordered "
                                style="z-index:3;">
                                <thead>
                                    <tr>
                                        <th> N</th>
                                        <th> Categorías del evento</th>
                                        <th> </th>

                                    </tr>
                                </thead>
                                <tbody id="tabla-categorias">
                                    <?php echo $CategoriaEventoA ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-10">
                    <p class="NotaCamposCatE"><b><i> Seleccione una categoría para ver sus detalles </i></b></p>
                    <button id="btnEditaCatE" class="btnEditaCatE">Ver detalles categorías </button>
                </div>
            </div>

            <h4 class="h4_4to">Agregar categorías al evento</h4>

            <div id="DG_FE2" class="Categorias_FeriaE2">
                <form id="DG_FE2" name="ComisionesFeriaE2">
                    <div id="contenedor"></div>
                    <h4 class="h4_formulario">Categorías y Subcategorías</h4>
                    <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label>Categorías (*): </label>
                            <select class="form-select" name="CategoriaE3" id="CategoriaE3"
                                onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;'
                                onblur="this.size=0;" aria-label="Default select example">
                                <option hidden selected>Seleccione una categoría</option>
                                <?php echo $Categorialist; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <button id="btnAgregarCategoria" class="btnAgregarCategoria"> Agregar categoría </button>
                            <button id="btnEditarCategoria" class="btnEditarCategoria"> Editar categoría </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-10">
                            <label>Subcategorías (*):</label>
                            <p class="NotaCategorias"><b><i> Seleccione la subcategoría a editar</i></b></p>
                            <div id="MarcoCatSub" class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table id="TCatsub" name="TCatsub"
                                    class="table  table-hover table-condensed table-striped table-bordered "
                                    style="z-index:3;">
                                    <thead>
                                        <tr>
                                            <th> N</th>
                                            <th> Subcategorías</th>
                                            <th> Año Académico </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-datos">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <button id="btnAGGSub" class="btnAGGSub"> Agregar subcategoría </button>
                            <button id="btnEDITSub" class="btnEDITSub">Editar subcategoría </button>
                        </div>
                    </div>


                </form>
                <div class="row">
                    <div class="form-group col-md-12">

                        <button id="btnCancelar" class="btnCancelar"> Cancelar registro </button>
                        <button id="btnGuardarE3" class="btnGuardarE3">Guardar </button>
                    </div>
                </div>
            </div>

            <?php
    } else {
  // si no hay datos, mostrar solo el div DG_FE2
?>
            <h4 class="h4_4to">Agregar comisión al evento</h4>

            <div id="DG_FE2" class="Categorias_FeriaE2">
                <form id="DG_FE2" name="ComisionesFeriaE2">
                    <div id="contenedor"></div>
                    <h4 class="h4_formulario">Categorías y Subcategorías</h4>
                    <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label>Categorías (*): </label>
                            <select class="form-select" name="CategoriaE3" id="CategoriaE3"
                                onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;'
                                onblur="this.size=0;" aria-label="Default select example">
                                <option hidden selected>Seleccione una categoría</option>
                                <?php echo $Categorialist; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <button id="btnAgregarCategoria" class="btnAgregarCategoria"> Agregar categoría </button>
                            <button id="btnEditarCategoria" class="btnEditarCategoria"> Editar categoría </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-10">
                            <label>Subcategorías (*):</label>
                            <p class="NotaCategorias"><b><i> Seleccione la subcategoría a editar</i></b></p>
                            <div id="MarcoCatSub" class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table id="TCatsub" name="TCatsub"
                                    class="table  table-hover table-condensed table-striped table-bordered "
                                    style="z-index:3;">
                                    <thead>
                                        <tr>
                                            <th> N</th>
                                            <th> Subcategorías</th>
                                            <th> Año Académico </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-datos">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <button id="btnAGGSub" class="btnAGGSub"> Agregar subcategoría </button>
                            <button id="btnEDITSub" class="btnEDITSub">Editar subcategoría </button>
                        </div>
                    </div>


                </form>
                <div class="row">
                    <div class="form-group col-md-12">

                        <button id="btnCancelar" class="btnCancelar"> Cancelar registro </button>
                        <button id="btnGuardarE3" class="btnGuardarE3">Guardar </button>
                    </div>
                </div>
            </div>

            <?php
  }
?>


            <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>
            <script type="text/javascript" src="../../Assets/js/General/jquery.mask.min.js"></script>
            <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>

            <script type="text/javascript" src="../../Assets/js/General/jquery.dataTables.min.js"></script>

            <script type="text/javascript" src="../../Assets/js/General/datatables.min.js"></script>
            <script type="text/javascript" src="../../Assets/js/General/dataTables.bootstrap4.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

            <script src="../../Assets/js/General/menu_movil.js"></script>
            <script type="text/javascript" src="../../Assets/js/Coordinador/PlanificacionE3.js"></script>

            <script>
            $(document).ready(function() {
                var $tablaDatos = $('#TCatsub');

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

                    </div>
                </div>
            </footer>
</body>

</html>