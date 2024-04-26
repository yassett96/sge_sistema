<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

$idpersona = $_SESSION['Idpersona'];

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$LDatosGEA = $MCAsignada->Lista_ComisionAsignada_Persona($idpersona);
//$DatosGEA = $MCAsignada->ObtenerComisionAsignada_Persona($idpersona);
/*$NombreComisionA = $DatosGEA['Nombre_Comision'];
$ID_Comision = $DatosGEA['ID_Comision_Evento'];
$R1Comision = $MCAsignada->ObtenerR1ComisionAsignada($ID_Comision);*/
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

    <link rel="stylesheet" href="../../Assets/css/Coordinador/ComisionAsignada.css">

    <!--<link rel="stylesheet" type="text/css" href="ruta/progressbar.css">-->


    <title>Comision Asignada</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
        </div>
        <div class="menu_general">
            <ul class="nav justify-content-end">
                <li class="nav-item"><a class="nav-link active" id="texto"
                        href="../../Vista/Academico/InicioPersonalAcademico.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link active" id="texto"
                        href="../../Vista/Academico/EventoAcademicoCE.php">Eventos</a></li>
                <li class="nav-item"><a class="nav-link active" id="texto"
                        href="../../Vista/Academico/HistorialAcademicoCE.php">Historial de eventos</a></li>

                <li><a href="">Comisiones </a>
                    <ul>
                        <a id="FondoNav" href="../../Vista/Academico/ComisionAsignadaA.php">Comisión asignada</a>
                        <!--<a id="FondoNav" href="../../Vista/Coordinador/ComisionesGenerales.php">Comisiones generales</a>-->
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Academico/ReportesA.php">Reportes</a></li>

                <div class="dropdown">
                    <img src="<?php echo $_SESSION['Avatar']; ?>" class="imgRedonda" />

                    <div class="dropdown-content">
                        <a href="../../Vista/Academico/MCuentaCE_A.php">Mi cuenta</a>
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

                    <a class="link-item" href="../../Vista/Academico/InicioPersonalAcademico.php">Inicio</a>
                    <a class="link-item" href="../../Vista/Academico/EventoAcademicoCE.php">Eventos</a>
                    <a class="link-item" href="../../Vista/Academico/HistorialAcademicoCE.php">Historial de eventos</a>
                    <a class="link-item" href="../../Vista/Academico/ComisionAsignadaA.php">Comisión asignada</a>
                  
                    <a class="link-item" href="../../Vista/Academico/ReportesA.php">Reportes</a>
                    <a class="link-item" href="../../Vista/Academico/MCuentaCE_A.php">Mi cuenta</a>
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

    <?php
    if (!empty($LDatosGEA )) {
  // si hay datos, mostrar la tabla
?>

    <h4 class="h4">Comisión asignada</h4>


    <div class="row">
        <div id="contenedor"></div>
        <div class="form-group col-md-8">
            <label class="LabelColorCAS">Seleccione una comisión:</label>
            <select class="form-select" name="ComisionesAsig" id="ComisionesAsig"
                onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;' onblur="this.size=0;"
                aria-label="Default select example">
                <option hidden selected>Comisiones Asignadas</option>
                <?php echo $LDatosGEA ; ?>
            </select>
        </div>
        <input type="hidden" id="Id_Per" value="<?php echo $idpersona; ?>">
    </div>

    <div id="content" style="display: none;">


        <h4 class="h4"><span id="NombreComisionA"></h4>

        <div class="ContenedorPrincipal">
            <div class="ContDatosCA">

                <div class="row-2">
                    <div class="col-12">
                        <div id="card-5" class="card-5">
                            <div class="card-body">
                                <div id="progress-bar-container"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <div id="card-1" class="card-1">
                            <div class="card-body">
                                <h5 class="card-title">Responsable 1:</h5>
                                <h6 class="card-subtitle mb-2 text-muted" id="Resp1Comision"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div id="card-2" class="card-2">
                            <div class="card-body">
                                <h5 class="card-title">Responsable 2:</h5>
                                <h6 class="card-subtitle mb-2 text-muted" id="Resp2Comision"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div id="card-3" class="card-3">
                            <div class="card-body">
                                <h5 class="card-title">Responsable 3:</h5>
                                <h6 class="card-subtitle mb-2 text-muted" id="Resp3Comision"></h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>



        <div id="DG_ComisionAsignada" class="DG_ComisionAsignada">
            <form id="DG_FE2" name="ComisionAsignada">

                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="Actividades-tab" data-toggle="tab" href="#Actividades" role="tab"
                            aria-controls="Actividades" aria-selected="true">Actividades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link a" id="IntegrantesC-tab" data-toggle="tab" href="#IntegrantesC" role="tab"
                            aria-controls="IntegrantesC" aria-selected="false">Integrantes</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="Actividades" role="tabpanel"
                        aria-labelledby="Actividades-tab">

                        <form class="form-signin" id="idfrom">
                            <p class="NotaCampos"><b><i></i></b></p>
                            <div class="row">
                                <div class="form-group col-md-10">

                                    <div id="MarcoAct" class="table-wrapper-scroll-y my-custom-scrollbar">
                                        <table id="TActividades" name="TActividades"
                                            class="table  table-hover table-condensed table-striped table-bordered "
                                            style="z-index:3;">
                                            <thead>
                                                <tr>
                                                    <th> N</th>
                                                    <th> Actividad</th>
                                                    <th> Descripción</th>
                                                    <th> Fecha Inicio</th>
                                                    <th> Fecha Fin</th>
                                                    <th> Estado</th>
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabla-actividades">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-10">
                                    <!--<button id="btnAddCE" class="btnAddCE" > Agregar Comision a evento </button>-->
                                    <p class="NotaCamposCE"><b><i> Seleccione una Actividad para ver sus
                                                detalles o
                                                actualizar estado
                                            </i></b></p>
                                    <button id="btnEditaCE" class="btnEditaCE">Ver detalles Actividad
                                    </button>
                                </div>
                            </div>


                        </form>

                    </div>
                    <div class="tab-pane fade" id="IntegrantesC" role="tabpanel" aria-labelledby="IntegrantesC-tab">
                        <form class="form-signin" id="fidcoment" name="fidcoment">
                            <p class="NotaCampos"><b><i> </i></b></p>


                            <div class="row">
                                <div class="form-group col-md-8">
                                    <div id="MarcoIntC" class="table-wrapper-scroll-y my-custom-scrollbar-2">
                                        <table id="TIntegrantesC"
                                            class="table  table-hover table-condensed table-striped table-bordered "
                                            style="z-index:3;">
                                            <thead>
                                                <tr>
                                                    <th> N </th>
                                                    <th> Integrantes </th>
                                                </tr>
                                            </thead>
                                            <tbody id="Tabla_int">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-10">
                                    <!--<button id="btnAddCE" class="btnAddCE" > Agregar Comision a evento </button>-->
                                    <!--<p class="NotaCamposCE"><b><i> Seleccione una comisión para ver sus detalles
                                            </i></b></p>
                                    <button id="btnEditaCE" class="btnEditaCE">Ver detalles comisión </button>-->
                                </div>
                            </div>
                    </div>
                </div>
            </form>
        </div>



        <!--
        <div class="row">
            <div class="form-group col-4">
                <button id="btnRealizarConsulta" class="btnRealizarConsulta btn "> Realizar Solicitud extra</button>
                
            </div>
            <div class="form-group col-6">
                <button id="btnVerSolicitudes" class="btnVerSolicitudes btn "> Ver solicitudes Extra </button>
            
            </div>
            <div class="form-group col">
                <button id="btnEstadoActividad" class="btnEstadoActividad btn "> Estado de Actividad </button>
                
            </div>
        </div>



        <div class="row">
            <div class="form-group col-4">
                <button id="btnSubirReporteF" class="btnSubirReporteF btn " style="display: none;"> Subir
                    reporte final
                </button>
                
            </div>
            <div class="form-group col-6">
                <button id="btnSubirPlan" class="btnSubirPlan btn " style="display: none;"> Subir plan de
                    trabajo
                </button>
               
            </div>
            <div class="form-group col">
                <button id="btnAgregarActividad" class="btnAgregarActividad btn " style="display: none;">
                    Agregar
                    Actividad
                </button>
               
            </div>
        </div>

    -->

        <div class="containerbotones">
            <div class="buttons-row">
                <button class="button btn btnRealizarConsulta" id="btnRealizarConsulta">Realizar solicitud
                    extra</button>
                <button class="button btn btnVerSolicitudes " id="btnVerSolicitudes">Ver solicitudes extra </button>
                <button class="button btn btnEstadoActividad " id="btnEstadoActividad">Estado de actividad </button>
            </div>
            <div class="buttons-row">

                <button class="button btnSubirPlan btn" id="btnSubirPlan" style="display: none;">Descargar plan de
                    trabajo</button>
                <button class="button btnAgregarActividad btn" id="btnAgregarActividad" style="display: none;">Agregar
                    actividad</button>
                <button class="button btnSubirReporteF btn" id="btnSubirReporteF" style="display: none;">Subir reporte
                    final</button>
                <button class="button btnDescargarRFC btn" id="btnDescargarRFC" style="display: none;">Descargar Reporte
                    Final</button>
                <button class="button btnEliminarRFC btn" id="btnEliminarRFC" style="display: none;">Eliminar Reporte</button>
            </div>
        </div>
    </div>

    <?php 
            } else {
           
            ?>
    <h4 class="h4">No estas asignado a ninguna comisión</h4>


    <?php
  }
?>




    <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>

    <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.1.0/progressbar.min.js"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="../../Assets/js/General/menu_movil.js"></script>
    <script type="text/javascript" src="../../Assets/js/Coordinador/ComisionAsignada.js"></script>


    <script>
    $(document).ready(function() {
        var $tablaAct = $('#TActividades');

        $tablaAct.on('click', 'tbody tr', function() {
            // Elimina la clase "selected" de todas las filas
            $tablaAct.find('tbody tr').removeClass('selected');

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
                        <li><i class=" fa fa-map-marker  "></i></i>Semáforos 'Villa Progreso', 2 1/2 cuadras
                            arriba
                        </li>
                    </ul>
                </div>

                <div class="col-xs-6 col-md-3">
                    <ul class="footer-links">
                        <li><a href="../../Vista/Academico/InicioPersonalAcademico.php">Inicio</a></li>
                        <li><a href="../../Vista/Academico/EventoAcademicoCE.php">Eventos</a></li>
                        <li><a href="../../Vista/Academico/HistorialAcademicoCE.php">Historial de
                                eventos</a>
                        </li>
                        <li><a href="../../Vista/Academico/MCuentaCE_A.php">Mi cuenta </a></li>
                    </ul>

                    </ul>
                </div>

                <div class="col-xs-6 col-md-3">
                    <ul class="footer-links">
                        <li><a href="../../Vista/Academico/ComisionAsignadaA.php">Comisión asignada</a></li>
                        <!--<li><a href="../../Vista/Coordinador/Prox.php">Comisiones generales</a></li>-->
                        <li><a href="../../Vista/Academico/ReportesA.php">Reportes</a></li>

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