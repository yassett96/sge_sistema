<?php

require_once ("../../Controlador/Administrador/CCuenta_SE.php");

session_start();

if($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != "6"){
    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();
} 

$VerificarExistenciaEvento = FunVerificarExistenciaEventoSegunAñoActual();  
if($VerificarExistenciaEvento == CteExisteEventoEnAñoActual){
        
    header('Location: ../../Vista/Administrador/MiCuenta_CE.php');//Aqui lo redireccionas al lugar que quieras.    
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../Assets/imagenes/Recursos/ico.png" height="30px" width="30px">
    <link rel="stylesheet" href="../../Assets/css/General/bootstrap.min.css" >
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/herramientas/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../Assets/css/Administrador/micuenta_se.css" >


    <title>Mi cuenta</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
        </div>
        <div class="menu_general">
            <ul class="nav justify-content-end">
                <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Administrador/InicioAdministradorSE.php" >Inicio</a></li>
                <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Administrador/PanelAdministrador.php">Panel Admin</a></li>
                <!-- <li class="nav-item"><a class="nav-link active" id="texto" href="">¿Qué es SGE-FCYS?</a></li> -->
                               
                <div class="dropdown">
                <section class="logonombre">
                    <img src="<?php echo $_SESSION['Avatar']; ?>"  class="imgRedonda"/>
                    <div class="Nombreusuario"><?php echo $_SESSION['NombreCompleto']; ?></div>
                </section>
                <div class="dropdown-content">
                  <a href="../../Vista/Administrador/MiCuenta_SE.php">Mi cuenta</a>
                  <a href='../../Controlador/General/CCerrarSesion.php'>Cerrar sesión</a>
                </div>
                </div>
            </ul>
        </div>

        <!--Inicia menu movil-->
        <div class="main-header">            
            <nav id="nav" class="main-nav">
              <div class="nav-links">
              
                <img src="<?php echo $_SESSION['Avatar']; ?>"  class="imgRedonda link-item"/>
                <div class="link-item"><?php echo $_SESSION['NombreCompleto']; ?></div>
                 
                <a class="link-item"  href="../../Vista/Administrador/InicioAdministradorCE.php" >Inicio</a>
                <a class="link-item"  href="../../Vista/Administrador/PanelAdministrador.php">Panel Admin</a>
                <!-- <a class="link-item"  href="">¿Qué es SGE-FCYS?</a>                 -->
                <a class="link-item"  href="../../Vista/Administrador/MiCuenta_SE.php">Mi cuenta</a>
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
    <h4 class="h4_2">Mi cuenta</h4>
    <div class="cuadro_fondo">

    <div class="menuimagen">
        <img src="../../Assets/imagenes/Recursos/buscar.png" id="MenuI1" width="130" height="130" >                       
    
    <div id="contenedor"></div>
    </div>
    <div class="menuimagen1">
        <img src="../../Assets/imagenes/Recursos/editar.png" id="MenuI2" width="130" height="130" >      
    </div>        
        
    <button id="editaravatar" name="button">Editar Avatar</button>
    <button id="editardatos" name="button">Editar Datos</button> 
    </div>

    <img src="../../Assets/imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">
    <br>

    <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/menu_movil.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/Administrador/micuenta_ce.js"></script>
    

    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
          <h2>Contáctenos</h2>
            <ul class="footer-links">
            <li><i class="fa fa-phone " ></i>+505 2249 6429</li>
                <li class="emailf"><i class=" fa fa-envelope-o  "></i></i>decanatura@fcys.uni.edu.ni</li>
                <li><i class=" fa fa-map-marker  "></i></i>Semáforos 'Villa Progreso', 2 1/2 cuadras arriba</li>
            </ul>
          </div>
  
          <div class="col-xs-6 col-md-3">         
            <ul class="footer-links">
            <li><a href="../../Vista/Administrador/InicioAdministradorCE.php">Inicio</a></li>
                <li><a href="../../Vista/Administrador/PanelAdministrador.php">Panel Admin</a></li>
                <!-- <li><a href="">¿Qué es SGE-FCYS?</a></li> -->
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <ul class="footer-links">
            <li><a href="../../Vista/Administrador/MiCuenta_SE.php">Mi cuenta</a></li>
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