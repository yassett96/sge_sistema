<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/MReportes.php");

$MRep = new ModReportes();

/*$ListaComisiones = $MRep->ObtenerProyectosNoConfirmadosEA();

$TotalProyectos= count($ListaComisiones);*/
$ListaParticipantes = $MRep->ObtenerParticipantesGeneralesEA();

$TotalParticipnates= count($ListaParticipantes);



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

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.0.1/css/searchPanes.dataTables.min.css">
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <link rel="stylesheet" href="../../Assets/css/Coordinador/ReportesInscritos.css">

    <!--<link rel="stylesheet" type="text/css" href="ruta/progressbar.css">-->


    <title>Reportes Participantes</title>
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
                <li class="nav-item"><a class="nav-link active" id="texto"
                        href="../../Vista/Academico/ReportesA.php">Reportes</a></li>

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
    <h4 class="h4">Lista de participantes general</h4>

    <!--<div class="col-10" style="margin-left: 10%;">   clase de tabla class="table  table-hover "-->

    <h4 class="h4">Participantes Totales <?php echo $TotalParticipnates;?></h4>
    <div id="MarcoTProyectos" class="table-wrapper-scroll-y my-custom-scrollbar-2">


        <table id="TParticipantesG" name="TParticipantesG" class="table table-bordered  display " cellspacing="0"
            width="100%">
            <thead>
                <tr>
                    <th>N° </th>
                    <th> Nombres</th>
                    <th> Apellidos </th>
                    <th> Cédula </th>
                    <th> Correo electrónico</th>
                    <th> Teléfono</th>
                    <th> Carnet </th>
                    <th> Estado de participación </th>


                </tr>
            </thead>
            <tbody>
                <?php
                
                foreach ($ListaParticipantes as $participantes) {
            ?>
                <tr>
                    <!-- <td></td>-->

                    <td><?php echo $participantes[0];?></td>
                    <td><?php echo $participantes[0];?></td>
                    <td><?php echo $participantes[1];?></td>
                    <td><?php echo $participantes[2];?></td>
                    <td><?php echo $participantes[4];?></td>
                    <td><?php echo $participantes[5];?></td>
                    <td><?php echo $participantes[3];?></td>
                    <td><?php echo $participantes[6];?></td>

                </tr>
                <?php
              }
            ?>





            </tbody>
        </table>
    </div>





    <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>

    <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="../../Assets/js/General/menu_movil.js"></script>
    <script type="text/javascript" src="../../Assets/js/Coordinador/ReportesComision.js"></script>

    <script type="text/javascript" src="../../Assets/Datatables/datatables.min.js"></script>


    <script src="../../Assets/Datatables/Buttons-2.4.0/js/buttons.html5.min.js"></script>
    <script src="../../Assets/Datatables/Buttons-2.4.0/js/dataTables.buttons.min.js"></script>
    <script src="../../Assets/Datatables/JSZip-3.10.1/jszip.min.js"></script>
    <script src="../../Assets/Datatables/pdfmake-0.2.7/pdfmake.min.js"></script>
    <script src="../../Assets/Datatables/pdfmake-0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/1.0.1/js/dataTables.searchPanes.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>




    <script>
    $(document).ready(function() {


        var table3 = $('#TParticipantesG').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
            },

            dom: 'Bftilp',
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> ',
                    title: 'Listado de Participantes del Evento',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success',
                    exportOptions: {
                        format: {
                            body: function(data, row, column, node) {
                                // Para la primer columna (índice 0), reemplazamos el contenido con la secuencia numérica
                                if (column === 0) {
                                    return $(node).text();
                                }
                                return data;
                            }
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> ',
                    title: 'Listado de Participantes del evento',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger',
                    orientation: 'landscape',
                    exportOptions: {
                        format: {
                            body: function(data, row, column, node) {
                                // Para la primer columna (índice 0), reemplazamos el contenido con la secuencia numérica
                                if (column === 0) {
                                    return $(node).text();
                                }
                                return data;
                            }
                        }
                    }
                    /*customize: function(doc) {
                        var tableM = $('#TProyectosEA').DataTable();
                        var tableWidth = tableM.table().container().offsetWidth;
                        doc.pageSize = {
                            width: tableWidth,
                            height: 'auto'
                        };
                    }*/
                },
            ],

            drawCallback: function(settings) {
                var api = this.api();
                var startIndex = api.context[0]
                    ._iDisplayStart; // Índice del primer registro visible en la página
                api.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    $(cell).html(startIndex + i +
                        1); // Actualiza la secuencia numérica de la primer columna
                });
            }

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


            </div>
        </div>
    </footer>
</body>

</html>