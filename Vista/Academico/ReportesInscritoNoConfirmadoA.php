<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/MReportes.php");

$MRep = new ModReportes();

$ListaComisiones = $MRep->ObtenerProyectosNoConfirmadosEA();

$TotalProyectos= count($ListaComisiones);
$ListaParticipantes = $MRep->ObtenerParticipantesNoConfirmadosEA();





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
    <h4 class="h4">Proyectos y participantes inscritos no confirmados</h4>

    <!--<div class="col-10" style="margin-left: 10%;">   clase de tabla class="table  table-hover "-->

    <h4 class="h4">Proyectos Totales <?php echo $TotalProyectos;?></h4>
    <div id="MarcoTProyectos" class="table-wrapper-scroll-y my-custom-scrollbar">
        <table id="TProyectosEA" name="TProyectosEA" class="table table-bordered  display " cellspacing="0"
            width="100%">
            <thead>
                <tr>
                    <th> </th>
                    <th> Nombre Proyecto</th>
                    <th> Descripción </th>
                    <th> Categoría </th>
                    <th> Subcategoría</th>
                    <th> Año Académico</th>
                    <th> Sede Proyecto</th>
                    <th> Tutor </th>
                    <th> Sede Tutor</th>


                </tr>
            </thead>
            <tbody>
                <?php
                
                foreach ($ListaComisiones as $proyectos) {
            ?>
                <tr>

                    <td><?php echo $proyectos[0];?></td>
                    <td><?php echo $proyectos[1];?></td>
                    <td><?php echo $proyectos[2];?></td>
                    <td><?php echo $proyectos[3];?></td>
                    <td><?php echo $proyectos[4];?></td>
                    <td><?php echo $proyectos[5];?></td>
                    <td><?php echo $proyectos[6];?></td>
                    <td><?php echo $proyectos[7];?></td>
                    <td><?php echo $proyectos[8];?></td>

                </tr>
                <?php
              }
            ?>





            </tbody>
        </table>
        <h4 class="h4">Participantes por proyecto</h4>
        <h4 class="h8"><em>Se mostrarán los participantes una vez seleccione un proyecto</em></h4>

        <table id="TIntegratesProyectosEA" name="TIntegratesProyectosEA" class="table table-bordered  display nowrap"
            cellspacing="0" width="100%">
            <thead>
                <tr>

                    <th> Participantes</th>
                    <th> Cédula </th>
                    <th> Correo electrónico</th>
                    <th> Teléfono </th>
                    <th> Carnet </th>
                    <th> Sede </th>
                    <th> Grupo </th>
                    <th> Año </th>

                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <h4 class="h4">Participantes Generales</h4>

        <table id="TParticipantesEA" name="TParticipantesEA" class="table table-bordered  display nowrap"
            cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>N° </th>
                    <th> Proyecto</th>
                    <th> Nombres</th>
                    <th> Apellidos </th>
                    <th> Cédula </th>
                    <th> Correo electrónico</th>
                    <th> Teléfono</th>
                    <th> Carnet </th>


                </tr>
            </thead>
            <tbody>
                <?php
                
                foreach ($ListaParticipantes as $participantes) {
            ?>
                <tr>

                    <td><?php echo $participantes[0];?></td>
                    <td><?php echo $participantes[1];?></td>
                    <td><?php echo $participantes[2];?></td>
                    <td><?php echo $participantes[3];?></td>
                    <td><?php echo $participantes[4];?></td>
                    <td><?php echo $participantes[6];?></td>
                    <td><?php echo $participantes[7];?></td>
                    <td><?php echo $participantes[5];?></td>

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



        var table = $('#TProyectosEA').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
            },
            searchPanes: {
                cascadePanes: true,
                dtOpts: {
                    dom: 'tp',
                    paging: 'true',
                    pagingType: 'numbers',
                    searching: false
                }
            },
            columnDefs: [{
                    targets: [3, 4, 5, 6, 7, 8],
                    searchPanes: {
                        show: true
                    }
                },
                {
                    targets: [1, 2],
                    searchPanes: {
                        show: false
                    }
                },
                {
                    targets: 0,
                    visible: false,
                    className: 'no-export'
         
                    
                }
            ],

            dom: 'PBfrtilp',

            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> ',
                    title: 'Proyectos No Confirmados del Evento actual',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success',
                    exportOptions: {
                    columns: ':visible:not(.no-export)' // Imprimir solo las columnas visibles excepto las de clase "no-export"
                }

                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> ',
                    title: 'Proyectos No Confirmados del Evento actual',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger',
                    orientation: 'landscape',
                    /*customize: function(doc) {
                        // Obtener las dimensiones de la tabla
                        var tableM = $('#TProyectosEA')
                            .DataTable(); // Reemplaza "miTabla" con el ID de tu tabla
                        var tableWidth = tableM.table().container().offsetWidth;

                        // Ajustar el tamaño de la página del PDF
                        doc.pageSize = {
                            width: tableWidth,
                            height: 'auto'
                        };
                    }*/
                    exportOptions: {
                    columns: ':visible:not(.no-export)' // Imprimir solo las columnas visibles excepto las de clase "no-export"
                }
                    
                   

                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> ',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-info',
                    exportOptions: {
                    columns: ':visible:not(.no-export)' // Imprimir solo las columnas visibles excepto las de clase "no-export"
                }
                }
            ],

        });

        table.on('click', 'tbody tr', function() {
            let data = table.row(this).data();

            const NProyecto = data[0];


            //alert (NProyecto);  

            $.ajax({
                url: "../../Controlador/Coordinador/CCargarIntegrantesProyecto_NoConf.php",
                type: "POST",
                data: {
                    N_Proyecto: NProyecto
                },
                dataType: 'json',
                success: function(response) {

                    llenarTabla2(response);
                },


            });

            function llenarTabla2(data) {

                $('#TIntegratesProyectosEA').DataTable().destroy();


                var tablaIntegrantes = $('#TIntegratesProyectosEA').DataTable({
                    data: data,
                    columns: [{
                            data: 'Participantes'
                        },
                        {
                            data: 'Cédula'
                        },
                        {
                            data: 'Correo electrónico'
                        },
                        {
                            data: 'Teléfono'
                        },
                        {
                            data: 'Carnet'
                        },
                        {
                            data: 'Sede'
                        },
                        {
                            data: 'Grupo'
                        },
                        {
                            data: 'Año'
                        }

                    ],

                    "destroy": true,
                    dom: 'Bt',
                    buttons: [{
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i> ',
                            titleAttr: 'Exportar a Excel',
                            className: 'btn btn-success'
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i> ',
                            title: 'Integrantes del Proyecto "' + NProyecto + '" ',
                            titleAttr: 'Exportar a PDF',
                            className: 'btn btn-danger',
                            orientation: 'landscape',
                            /*customize: function(doc) {
                                var tableM = $('#TProyectosEA').DataTable();
                                var tableWidth = tableM.table().container().offsetWidth;
                                doc.pageSize = {
                                    width: tableWidth,
                                    height: 'auto'
                                };
                            }*/
                            exportOptions: {
            columns: ':visible:not(:eq(0))' // Excluir la primera columna en la exportación
        }
                        },
                    ],
                });


                tableIntegrantes = null;
            }

        });

        var table3 = $('#TParticipantesEA').DataTable({

            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
            },

            dom: 'Bftilp',
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> ',
                    title: 'Listado de Participantes Sin Confirmar',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> ',
                    title: 'Listado de Participantes Sin Confirmar',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger',
                    orientation: 'landscape',
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