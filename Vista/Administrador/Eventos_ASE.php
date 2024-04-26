<?php

session_start();
// echo "<script>alert(".$_SESSION['PersonaAcademica']['ID_Tipo_Usuario'].");</script>";
// exit;
if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario']  != 6) {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

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

    
    <link rel="stylesheet" href="../../Assets/css/Participante/eventos_pse.css">
    
    <title>Eventos PSE</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
        </div>
        <div class="menu_general">
            <ul class="nav justify-content-end">
                <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Administrador/InicioAdministradorCE.php" >Inicio</a></li>
                <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Administrador/Eventos_ASE.php">Eventos</a></li>
                <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Administrador/QueEs_InfoSisA.php">¿Qué es SGE-FCYS?</a></li>
                <li class="nav-item"><a class="nav-link active" id="texto" href="#">Panel admin</a></li>
                <div class="Nombreusuario"><?php echo $_SESSION['NombreCompleto']; ?></div>
                <div class="dropdown">
                <img src="<?php echo $_SESSION['Avatar']; ?>"  class="imgRedonda"/>

                <div class="dropdown-content">
                <!-- <a href="../../Vista/Participante/MiCuenta_SE_v.php">Mi cuenta</a> -->
                <a href='../../Controlador/General/CCerrarSesion.php'>Cerrar sesión</a>
              </div>
            </ul>
        </div>

     <!--Inicia el menu movil-->
        <div class="main-header">
            
            <nav id="nav" class="main-nav">
              <div class="nav-links">

              <img src="<?php echo $_SESSION['Avatar']; ?>"  class="imgRedonda link-item"/>
              <div class="Nombreusuario"><?php echo $_SESSION['NombreCompleto']; ?></div>

                <a class="link-item"  href="../../Vista/Administrador/InicioAdministradorPCE.php" >Inicio</a>
                <a class="link-item"  href="../../Vista/Administrador/Eventos_PSE.php">Eventos</a>
                <a class="link-item"  href="../../Vista/Administrador/QueEs_InfoSisA.php">¿Qué es SGE-FCYS?</a>
                <a class="link-item"  href='#'>Panel admin</a>
                <!-- <a class="link-item"  href="../../Vista/Participante/MiCuenta_SE_v.php">Mi cuenta</a> -->
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

    <img src="../../Assets/imagenes/Recursos/mosaico1.png" id="mosaicoDER" >
    <h4 class="h4">Eventos de la Facultad</h4>
        <div class="cuadro_fondo">
            <div class="cuadro1">
                <h5>Ferias</h5>
                <p>Actividad donde se exponen proyectos de las diferentes asignaturas
                    que se imparten en la carrera de Ingeniería de Sistemas clasificadas 
                    por categorías, en la cual se aplican los conocimientos adquiridos.                    
                </p>
            </div>
            <div class="cuadro2">
                <h5>Foros</h5>
                <p>Actividad en la cual personas capacitadas en las diferentes áreas de
                    la Facultad, exponen sobre sus experiencias relacionadas al contenido
                    de la carrera.
                </p>
            </div>
            <div class="cuadro3">
                <h5>Congresos</h5>
                <p>Actividad donde se desarrollan conferencias con profesionales, donde 
                    imparten conocimientos de interés en temáticas vinculadas a la
                    carrera de Ingeniería de Sistemas.
                </p>
            </div>
        </div>
        <h4 class="h4">Historia de los eventos</h4>
        <div class="cuadro_fondo2">
            <p class="cuadro">La Facultad de Ciencias y Sistemas ha gestionado de diferentes maneras estos
                eventos, desde la apertura de las ferias, siendo la primera realizada en 1999,
                hasta la más reciente efectuada en el 2019, asi como la creación del Primer 
                Congreso Nacional de Ingeniería de Sistemas realizado en el año 2017, y el
                desarrollo de foros, siendo el Primer Foro Nacional de Matemática realizado 
                en el año 2009.
            </p>
        </div>
        
        <img src="../../Assets/imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px"> 
        
        
        <script src="../../Assets/js/General/menu_movil.js"></script>
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
                  <li><a href="../../Vista/Administrador/InicioAdministradorCE.php">Inicio</a></li>
                      <li><a href="../../Vista/Administrador/Eventos_ASE.php">Eventos</a></li>
                      <li><a href="../../Vista/Administrador/QueEs_InfoSisA.php">¿Qué es SGE-FCYS?</a></li>
                  </ul>
                </div>

                <div class="col-xs-6 col-md-3">
            
            <ul class="footer-links">
            <!-- <li><a href="../../Vista/Participante/MICuenta_SE_v.php">Mi cuenta</a></li> -->
            

            </ul>
          </div>
                
              </div>
              <hr>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                  <p class="copyright-text"> &copy; Universidad nacional de ingeniería 2022 </p>
                </div>
      
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <ul class="social-icons">
                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="global" href="#"><i class="fa fa-globe"></i></a></li>
                   
                  </ul>
                </div>
              </div>
            </div>
          </footer>
</body>
</html>
  