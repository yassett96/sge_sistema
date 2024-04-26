<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3 )   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Controlador/General/CEvento.php");
require_once ("../../Controlador/Coordinador/CEvento_CoordinadorCE.php");

$VerificarExistenciaEvento = FunVerificarExistenciaEventoSegunAñoActual();  
if($VerificarExistenciaEvento != CteExisteEventoEnAñoActual){
    
    header('Location: ../../Vista/Academico/EventoAcademicoSE.php');//Aqui lo redireccionas al lugar que quieras.    
}else{
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

    <link rel="stylesheet" href="../../Assets/css/Coordinador/EventoCoordinadorCE.css">

    <title>Eventos Académico CE</title>
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
                        <!--<a id="FondoNav" href="../../Vista/Coordinador/Comisiones.php">Comisiones generales</a>-->
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
                    <a class="link-item" href="../../Vista/Academico/HistorialAcademicoCE.php">Historial de
                        Eventos</a>
                    <a class="link-item" href="../../Vista/Academico/ComisionAsignadaA.php">Comisión asignada</a>
                    <!--<a class="link-item" href="../../Vista/Coordinador/Prox.php">Comisiones generales</a>-->
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
    <img src="../../Assets/imagenes/Recursos/mosaico1.png" id="mosaicoDER">

    <h4 class="evento">Evento actual</h4>
    <!--========== INICIO CARRUSEL ==========-->
    <div class="slideshow-container">
        <div class="mySlides fade1">
            <div class="numbertext"></div>
            <img src="../../Assets/imagenes/Noticias/feria3.jpg" style="width:100%;">
            <div class="text"> </div>
        </div>

        <div class="mySlides fade1">
            <div class="numbertext"></div>
            <img src="../../Assets/imagenes/Noticias/feria1.jpg" style="width:100%;">
            <div class="text"> </div>
        </div>

        <div class="mySlides fade1">
            <div class="numbertext"></div>
            <img src="../../Assets/imagenes/Noticias/feria2.jpg" style="width:100%;">
            <div class="text"> </div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>
    </div>
    <br>

    <!--<div class="divTreePoints">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
    </div> -->
    <br>
    <!--========== FIN CARRUSEL ========== -->

    <!--========== Inicio datos historicos ========== -->
    <div class="contenedor">
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#pestaña1">Evento</a>
            </li>
            <li class="nav-item">
                <a class="nav-link cat" href="#pestaña2">Proyectos inscritos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link cat" href="#pestaña3">Categorías</a>
            </li>
        </ul>

        <div class="secciones">
            <article id="pestaña1">
                <div class="grupo">
                    <h5>Nombre evento:</h5>
                    <h6> <?php echo $datosf['Nombre_Evento'] ?> </h6>
                    <br>
                    <h5>Eslogan:</h5>
                    <h6> <?php echo $datosf['Eslogan'] ?> </h6>
                    <br>
                    <h5>Hora:</h5>
                    <h6> <?php echo $datosf['hora'] ?> </h6>
                    <br>
                    <h5>Fecha:</h5>
                    <h6> <?php echo $datosf['Fecha'] ?> </h6>
                    <br>
                    <h5>Lugar:</h5>
                    <h6> <?php echo $datosf['Nombre_Sitio'] ?> </h6>
                </div>
            </article>
        </div>

        <div class="secciones">
            <article id="pestaña2">
                <div id="tabla-div t">
                    <div class="scroll-div">
                        <table id="tproyecto">
                            <thead>
                                <tr>
                                    <th>Categoría</th>
                                    <th class="th">Proyectos inscritos</th>

                                </tr>
                            </thead>

                            <?php
                        while($mostrar = mysqli_fetch_array($datosp)){
                        ?>
                            <tbody>
                                <tr>
                                    <td> <?php echo $mostrar['Nombre_Categoria']?> </td>
                                    <td class="td"> <?php echo $mostrar['Proyectos']?> </td>
                                </tr>
                            </tbody>
                            <?php
                            }
                        ?>

                        </table>
                    </div>
                </div>
            </article>
        </div>

        <div class="secciones">
            <article id="pestaña3">
                <div id="tabla-div">
                    <div class="scroll-div">
                        <table>
                            <tr>
                                <th scope="row">Categoría</th>
                                <th>Sub categoría</th>
                            </tr>

                            <?php
                        while($lista = mysqli_fetch_array($datosc)){
                      ?>

                            <tr>
                                <th> <?php echo $lista['Nombre_Categoria']?> </th>
                                <td> <?php echo $lista['subcategoria']?> </td>
                            </tr>

                            <?php
                      }
                      ?>

                        </table>
                    </div>
                </div>

            </article>
        </div>
    </div>
    <br> <br> <br>

    <h4 class="h4">Historia de los eventos</h4>
    <br>
    <div class="cuadro_fondo2">
        <p class="cuadro">La Facultad de Ciencias y Sistemas ha gestionado de diferentes maneras estos
            eventos, desde la apertura de las ferias, siendo la primera realizada en 1999,
            hasta la más reciente efectuada en el 2022, así como la creación del Primer
            Congreso Nacional de Ingeniería de Sistemas realizado en el año 2017, y el
            desarrollo de foros, siendo el Primer Foro Nacional de Matemática realizado
            en el año 2009.
        </p>
    </div>

    <img src="../../Assets/imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">

    <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
    <script src="../../Assets/js/General/menu_movil.js"></script>
    <script src="../../Assets/js/General/evento_sr.js"></script>
    <br>


    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h2>Contáctenos</h2>
                    <ul class="footer-links">
                        <li><i class="fa fa-phone "></i>+505 2249 6429</li>
                        <li><i class=" fa fa-envelope-o  "></i></i>decanatura@fcys.uni.edu.ni</li>
                        <li><i class=" fa fa-map-marker  "></i></i>Semáforos 'Villa Progreso', 2 1/2 cuadras arriba</li>
                    </ul>
                </div>

                <div class="col-xs-6 col-md-3">
                    <ul class="footer-links">
                        <li><a href="../../Vista/Academico/InicioPersonalAcademico.php">Inicio</a></li>
                        <li><a href="../../Vista/Academico/EventoAcademicoCE.php">Eventos</a></li>
                        <li><a href="../../Vista/Academico/HistorialAcademicoCE.php">Historial de eventos</a></li>
                        <li><a href="../../Vista/Academico/MCuentaCE_A.php">Mi cuenta </a></li>
                    </ul>
                </div>

                <div class="col-xs-6 col-md-3">
                    <ul class="footer-links">

                        <li><a href="../../Vista/Academico/ComisionAsignadaA.php">Comisión asignada</a></li>
                        
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
<?php
    }
?>