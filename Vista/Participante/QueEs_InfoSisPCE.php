<?php

session_start();

if (!isset($_SESSION['Participantes']) or $_SESSION['Participantes']['ID_Tipo_Usuario']  != "1")  {


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

    <link rel="stylesheet" href="../../Assets/css/Participante/QueEs_InfoSisP.css">
    
    <title>Qué es SGE-FCYS</title>
</head>
<body>
    <header>
        <div class="logo">
          <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
        </div>
        <div class="menu_general">
          <ul class="nav justify-content-end">
            <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Participante/inicioParticipanteConEvento.php" >Inicio</a></li>
            <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Participante/Eventos_PSE.php">Eventos</a></li>
            <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Participante/QueEs_InfoSisPCE.php">¿Qué es SGE-FCYS?</a></li>
             
                <!--<div class="modal-footer"><a type="text" class="btn btn-secondary" data-dismiss="modal" href='../Controlador/CLogin/CCerrarSesion.php'>Cerrar sesión</a></div>-->
                <!--<button><a href="../../Vista/VRegistroGeneral/RegistroGeneral.php" id="texto">Iniciar sesión</a></button>-->
                <div class="dropdown">
                <img src="<?php echo $_SESSION['Avatar']; ?>"  class="imgRedonda"/>
  
               <div class="dropdown-content">
                <a href="../../Vista/Participante/MICuenta_CE.php">Mi cuenta</a>
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
        
                <a class="link-item"  href="../../Vista/Participante/inicioParticipanteConEvento.php" >Inicio</a>
                <a class="link-item"  href="../../Vista/Participante/Eventos_PSE.php">Eventos</a>
                <a class="link-item"  href="../../Vista/Participante/QueEs_InfoSisPCE.php">¿Qué es SGE-FCYS?</a>
                <a class="link-item"  href="../../Vista/Participante/MICuenta_CE.php">Mi cuenta</a>
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
    <h4 class="h4">¿Que es SGE-FCYS?</h4>
    
    <div class="cuadro_fondo2">
        <div class="cuadro">
            <p> 
                El Sistema de Gestion de Eventos de la Facultad de Ciencias y Sistemas (SGEFCYS), 
                es una herramienta que permite gestionar los diferentes eventos de la facultad, 
                facilitando la interacción en todas sus etapas, así mismo, permite acceder a 
                registros de interés a estudiantes, docentes y población en general que se deseen 
                conocer mas de estas actividades.                   
            </p>
        </div>
    </div>

        <!--<img src="../Assets/Imagenes/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">-->

        <!--El menu movil, requiere que lo contenido en este JS este en el JS de sus vistas-->
        <script src="../../Assets/js/General/menu_movil.js"></script>
        <img src="../../Assets/imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">
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
            <li><a href="../../Vista/Participante/inicioParticipanteConEvento.php">Inicio</a></li>
                <li><a href="../../Vista/Participante/Eventos_PSE.php">Eventos</a></li>
                <li><a href="../../Vista/Participante/QueEs_InfoSisPCE.php">¿Qué es SGE-FCYS?</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <ul class="footer-links">
     
            <li><a href="../../Vista/Participante/MiCuenta_CE.php">Mi cuenta</a></li>
            
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
        <!--INICIA CONSTRUCCION FOOTER--><!--
        <div class="container"></div>
        <footer>
         Footer main 
          <section class="ft-main">
            <div class="ft-main-item">
              <h2 class="ft-title">Contáctenos</h2>
              <ul class="fa-ul">
                <li><i class="fa-li fa fa-phone fa-1x" aria-hidden="true"></i>+505 2249 6429</li>
                <li><i class="fa-li fa fa-envelope-o  fa-1x" aria-hidden="true"></i></i>decanatura@fcys.uni.edu.ni</li>
                <li><i class="fa-li fa fa-map-marker  fa-1x" aria-hidden="true"></i></i>Semáforos 'Villa Progreso', 2 1/2 cuadras arriba</li>
              </ul>
            </div>
            <div class="ft-main-item_2">
              <h2 class="ft-title"></h2>
              <ul>
                <li><a href="../../index.php">Inicio</a></li>
                <li><a href="../../Vista/VEvento/Eventos.html">Eventos</a></li>
                <li><a href="../../Vista/VQueessge/QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a></li>
              </ul>
              
            </div>
            
            <div class="ft-main-item_2">
              <h2 class="ft-title"></h2>
              <ul>
                <li><a href="../Vista/MiCuenta_SE.php">Mi cuenta</a></li>
                <li><a href="#">Eventos</a></li>
                <li><a href="#">¿Qué es SGE-FCYS?</a></li>
              </ul>
              
            </div>
            <div class="ft-main-item_3">
              <h2 class="ft-title"></h2>
              <ul class="ft-social-list">
                <a href="#"><i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-globe fa-2x" aria-hidden="true"></i></a>
              </ul>
            </div>
            
          </section>
          <section class="ft-legal">
            <ul class="ft-legal-list">
              <li>&copy; Universidad nacional de ingeniería 2022</li>
            </ul>
          </section>
          </footer>

          TERMINA CONSTRUCCION FOOTER-->
</body>
</html>
  