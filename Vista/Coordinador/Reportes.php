<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

$idpersona = $_SESSION['Idpersona'];

require_once ("../../Modelo/Coordinador/MComisionesGenerales.php");

$MCGeneral = new ModComisionGen();

$LDatosGEA = $MCGeneral->ObtenerDatosComisionEvento();




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

    <link rel="stylesheet" href="../../Assets/css/Coordinador/Reportes.css">

    <!--<link rel="stylesheet" type="text/css" href="ruta/progressbar.css">-->


    <title>Reportes</title>
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
                <li class="nav-item"><a class="nav-link active" id="texto"
                        href="../../Vista/Coordinador/Reportes.php">Reportes</a></li>

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
    <h4 class="h4">Reportes</h4>

    <div id="contenedor"></div>

    <div class="card-deck w-50">

        <div class="card w-70">

            <div class="card-body- text-center">
                <img class="card-img-top" src="../../Assets/imagenes/Recursos/planificacion.png">

                <button onclick="location.href='../../Vista/Coordinador/ReportesComisiones.php'"
                    class="btn btn-primary">Comisiones</button>
            </div>
        </div>


        <div class="card w-70">

            <div class="card-body- text-center">
                <img class="card-img-top" src="../../Assets/imagenes/Recursos/inscripcion.png">
                <button onclick="location.href='../../Vista/Coordinador/ReportesParticipantes.php'"
                    class="btn btn-primary">Proyectos y participantes</button>


            </div>
        </div>


 <!--
        <div class="card w-70">

            <div class="card-body- text-center">
                <img class="card-img-top" src="../../Assets/imagenes/Recursos/evaluacion.png">
                <button href="#" class="btn btn-primary">Evaluación</button>
            </div>
        </div>
        
-->
    </div>
    


    <!--
    <div class="card-deck w-50 mx-auto">
        <div class="card w-75">
            <div class="card-body text-center">
                <img class="card-img-top custom-img img-fluid" src="../../Assets/imagenes/Recursos/planificacion.png">
                <button onclick="location.href='../../Vista/Coordinador/Admin_Feria_CE.php'"
                    class="btn btn-primary custom-btn">Planificación</button>
            </div>
        </div>

        <div class="card w-75">
            <div class="card-body text-center">
                <img class="card-img-top custom-img img-fluid" src="../../Assets/imagenes/Recursos/inscripcion.png">
                <button href="#" class="btn btn-primary custom-btn">Inscripción</button>
            </div>
        </div>

        <div class="card w-75">
            <div class="card-body text-center">
                <img class="card-img-top custom-img img-fluid" src="../../Assets/imagenes/Recursos/evaluacion.png">
                <button href="#" class="btn btn-primary custom-btn">Evaluación</button>
            </div>
        </div>
    </div>
-->


    <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>

    <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.1.0/progressbar.min.js"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="../../Assets/js/General/menu_movil.js"></script>
    <!--<script type="text/javascript" src="../../Assets/js/Coordinador/Reporte.js"></script>-->



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