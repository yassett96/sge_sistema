<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
$idpersona = $_SESSION['Idpersona'];
echo '<script>var ValorID = ' . json_encode($_SESSION['Idpersona']) . ';</script>';

require_once ("../../Modelo/Coordinador/MComisionesGenerales.php");

$MCGeneral = new ModComisionGen();

$Id_ComAsig = $_POST['ID_Com'];
$NombreCom = $_POST['NombreCom'];

echo '<script>var ComisionAsig = ' . json_encode($_POST['ID_Com']) . ';</script>';
echo '<script>var NombreComision = ' . json_encode($_POST['NombreCom']) . ';</script>';

$ComisionesAsignadas = $MCGeneral->Lista_ComisionAsignada_Persona($idpersona);


$R1Comision = $MCGeneral->ObtenerR1ComisionAsignada($Id_ComAsig);
$R2Comision = $MCGeneral->ObtenerR2ComisionAsignada($Id_ComAsig);
if (empty($R2Comision)){
    $R2Comision = "No Asignado";
  }
$R3Comision = $MCGeneral->ObtenerR3ComisionAsignada($Id_ComAsig);
if (empty($R3Comision)){
    $R3Comision = "No Asignado";
  }

    if (in_array($Id_ComAsig, $ComisionesAsignadas)) {

    $ActividadesC = $MCGeneral->Listar_ActividadesComision($Id_ComAsig);
    
    if($ActividadesC == ''){
    $ActividadesC = '<tr><td></td><td colspan="5">Aun no se han creado las hay actividades para esta comisión</td><td></td></tr>';
    
    }
  
    }else {

    $ActividadesC = $MCGeneral->Listar_ActividadesComision_VCS($Id_ComAsig);
        if($ActividadesC == ''){
        $ActividadesC = '<tr><td></td><td colspan="5">Aun no se han creado las hay actividades para esta comisión</td></tr>';
   
        }

    }

$IntegrantesC = $MCGeneral->Listar_IntegrantesComision($Id_ComAsig);

$NumActPG = $MCGeneral->ObtenerTotalesActividad($Id_ComAsig);

$TotalActFin = $NumActPG[0];
$TotalActTot = $NumActPG[1];

$porcentaje = 0; 

if ($TotalActTot != 0) {
    $porcentaje = ($TotalActFin / $TotalActTot) * 100;
}

$AccesosResponsabled = $MCGeneral->ObtenerResponsableComision($Id_ComAsig); 
$ExistenciaReport = $MCGeneral->ObtenerReporteFinalCreado($Id_ComAsig);

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


    <title>Comision Seleccionada</title>
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
                        <a id="FondoNav" href="../../Vista/Coordinador/ComisionesGenerales.php">Comisiones generales</a>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link active" id="texto" href=".../../Prox.php">Reportes</a></li>

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

    <h4 class="h4"><span><?php echo $NombreCom; ?></span></h4>


    <div id="contenedor"></div>

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
                            <h6 class="card-subtitle mb-2 text-muted"><span><?php echo $R1Comision; ?></span></h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div id="card-2" class="card-2">
                        <div class="card-body">
                            <h5 class="card-title">Responsable 2:</h5>
                            <h6 class="card-subtitle mb-2 text-muted"> <span><?php echo $R2Comision; ?></span></h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div id="card-3" class="card-3">
                        <div class="card-body">
                            <h5 class="card-title">Responsable 3:</h5>
                            <h6 class="card-subtitle mb-2 text-muted"> <span><?php echo $R3Comision; ?></span></h6>
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
                                                <?php

if (in_array($Id_ComAsig, $ComisionesAsignadas)) { ?>
    <th></th>
    <?php
}?>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="tabla-actividades">
                                            <?php echo  $ActividadesC ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-10">
                                <?php

                            if (in_array($Id_ComAsig, $ComisionesAsignadas)) {
                                    ?>


                                <p class="NotaCamposCE"><b><i> Seleccione una Actividad para ver sus
                                            detalles o
                                            actualizar estado
                                        </i></b></p>
                                <button id="btnEditaCE" class="btnEditaCE">Ver detalles Actividad
                                </button>
                                <?php
                                }
                                    ?>


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
                                            <?php echo  $IntegrantesC ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-10">

                            </div>
                        </div>
                </div>
            </div>
        </form>
    </div>

    <?php

if (in_array($Id_ComAsig, $ComisionesAsignadas)) {

    $AccesosResponsabled = $MCGeneral->ObtenerResponsableComision($Id_ComAsig); 
    ?>


    <div class="containerbotones">
        <div class="buttons-row">
            <button class="button btn btnRealizarConsulta" id="btnRealizarConsulta">Realizar solicitud extra </button>
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
            <button class="button btnEliminarRFC btn" id="btnEliminarRFC" style="display: none;">Eliminar
                Reporte</button>
        </div>
    </div>
    <?php

}

?>
    <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>

    <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.1.0/progressbar.min.js"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="../../Assets/js/General/menu_movil.js"></script>
    <script type="text/javascript" src="../../Assets/js/Coordinador/ComisionSeleccionadaVista.js"></script>



    <script>
    /*
   // Obtener el botón por su ID
    var btnSubirReporte = document.getElementById("btnSubirReporteF");
    var btnSubirPlan = document.getElementById("btnSubirPlan");
    var btnActividad = document.getElementById("btnAgregarActividad");
    var btnEliminarRFC = document.getElementById("btnEliminarRFC");
    var btnDescargarRFC = document.getElementById("btnDescargarRFC");

    var idpersona = <?php echo $idpersona; ?>;
    var TotalActTot = <?php echo $TotalActTot; ?>;
    var TotalActFin = <?php echo $TotalActFin; ?>;

    var AccesosResponsabled = <?php echo json_encode($AccesosResponsabled); ?>;
    
    var ExistenciaReport = <?php echo json_encode($ExistenciaReport); ?>;

    if (AccesosResponsabled.includes(String(idpersona))) {

        btnSubirPlan.style.display = "block";
        btnActividad.style.display = "block";

        if (TotalActTot > 0) {
            if (TotalActFin == TotalActTot) {
                btnSubirReporte.style.display = "block";
                if (ExistenciaReport == 1) {
                    if (AccesosResponsabled.includes(String(idpersona))) {

                        btnSubirReporte.style.display = "none";
                        btnActividad.style.display = "none";
                        btnDescargarRFC.style.display = "block";
                        btnEliminarRFC.style.display = "block";
                    } else {

                        btnSubirReporte.style.display = "block";
                        btnActividad.style.display = "block";
                        btnDescargarRFC.style.display = "none";
                        btnEliminarRFC.style.display = "none";


                    }
                }
            } else {
                btnSubirReporte.style.display = "none";
                btnDescargarRFC.style.display = "none";
                btnEliminarRFC.style.display = "none";
            }

        }
    }*/
    </script>

    <script>
    /*    var porcentaje = <?php echo $porcentaje; ?>;
    var bar = new ProgressBar.Circle('#progress-bar-container', {
        color: '#007bff',
        strokeWidth: 6,
        trailColor: '#f2f2f2',
        trailWidth: 6,
        text: {
            value: porcentaje.toFixed(0) + '%',
            style: {
                color: '#000000',
                fontSize: '24px',
                position: 'absolute',
                left: '50%',
                top: '50%',
                transform: 'translate(-50%, -50%)'
            }
        },
        from: {
            color: '#66BB6A'
        },
        to: {
            color: '#66BB6A'
        },
        step: function(state, circle) {
            circle.path.setAttribute('stroke', state.color);
        }
    });


    bar.animate(porcentaje / 100);*/
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
                        <li><a href="../../Vista/Coordinador/IndexCoordinadorCE.php">Inicio</a></li>
                        <li><a href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a></li>
                        <li><a href="../../Vista/Coordinador/AdminEventosCE.php">Administración de
                                eventos</a>
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