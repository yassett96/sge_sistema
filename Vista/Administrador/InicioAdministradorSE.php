<?php
  require_once ("../../Controlador/General/CUsuario.php"); 
  require_once(dirname(__FILE__, 3)."/Controlador/General/CEvento.php");    
  require_once ("../../Controlador/General/helper.php"); 

  session_start();

  if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario']  != 6)  {

    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();
  }

  //Para verificar la existencia del evento segun el año el actual
  $vlocResultadoVerificacionExistenciaEvento = FunVerificarExistenciaEventoSegunAñoActual();

  // //Para verificar que el participante ha inscrito algún proyecto
  //   // echo "Prueba Samir: ".$vlocResultadoVerificacionExistenciaEvento;
  //   // exit;
  if($vlocResultadoVerificacionExistenciaEvento == CteExisteEventoEnAñoActual){
    header('Location: ../../Vista/Administrador/InicioAdministradorCE.php');//Aqui lo redireccionas al lugar que quieras.        
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

  <link rel="stylesheet" href="../../Assets/herramientas/font-awesome-4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="../../Assets/css/Administrador/InicioAdministradorSE.css">

  <!-- Incluir SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
  
  <title>Inicio Participante SE</title>
</head>
<body>
    <header>
        <div>    
          <div class="logo">
            <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">            
          </div>
          <ul class="nav justify-content-end" id="ulNavHeader">
            <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/InicioAdministradorCE.php" >Inicio</a></li>
            <!-- <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/Eventos_ASE.php">Eventos</a></li>
            <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/QueEs_InfoSisA.php">¿Qué es SGE-FCYS?</a></li>             -->
            <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/PanelAdministrador.php">Panel admin</a></li>            
          </ul>                    
          <section id= "sectionCentralizarLogoNombre">
            <img id="imgLogUsuario" class="imgLogUsuarioClass" src="<?php echo $_SESSION['Avatar']; ?>">  
            <br>
            <a id="aNombreUsuario"><?php echo $_SESSION['NombreCompleto']; ?></a>
          </section>                            
          <div id="divMenuDespliegue">              
            <a class="nav-link " id="aCerrarSesion" href="../../Controlador/General/CCerrarSesion.php">Cerrar sesión</a>
            <a class="nav-link " href="../../Vista/Participante/MiCuenta_SE_v.php"></a>
          </div>
        </div>
        
        <!--Inicio Menu Móvil-->
        <div class="main-header">          
            <nav id="nav" class="main-nav" >            
              <div class="nav-links"> 
                <img id="imgLogUsuarioMovil" src="<?php echo $_SESSION['Avatar'] ?>">                                  
                <div class="Nombreusuario"><?php echo $_SESSION['NombreCompleto']; ?></div>
                <a class="link-item"  href="../../Vista/Administrador/InicioAdministradorCE.php" >Inicio</a>
                <!-- <a class="link-item"  href="../../Vista/Administrador/Eventos_ASE.php">Eventos</a> -->
                <a class="link-item"  href="../../Vista/Administrador/PanelAdministrador.php">Panel admin</a>    
                <a class="link-item"  href=".../../Vista/Participante/MiCuenta_SE_v.php"></a>             
                <a class="link-item" id="link-item-session2" href="../../Controlador/General/CCerrarSesion.php" >Cerrar sesión</a>
              </div>
            </nav>
            
            <button id="button-menu" class="button-menu">
              <span></span>
              <span></span>
              <span></span>
            </button>
        </div>
        <!--Fin Menu Móvil-->
    </header>    

    <h1 id="h1TextoInicial">Sistema de gestión de eventos FCYS</h1>
    
    <br><br><br><br><br><br>    
    
    <!--== INICIO BOTONES ==-->
      <div id="idDivBotones">
        <button class="boton-imagen">
          <img src="../../Assets/imagenes/Iconos/Sistema/Administrador/calificaciones.png" alt=""><br>
          <span>Jurado</span>
        </button>
        <button class="boton-imagen">
          <img src="../../Assets/imagenes/Iconos/Sistema/Administrador/curriculum.png" alt=""><br>
          <span>Personal académico</span>
        </button>
        <button class="boton-imagen">
          <img src="../../Assets/imagenes/Iconos/Sistema/Administrador/gerente.png" alt=""><br>
          <span>Coordinador</span>
        </button>
      </div>
    <!--== FIN BOTONES ==-->
    <br><br><br><br><br><br>
    <!--== INICIO SECCIÓN INSTRUCCIONES Y CONTACTO ==-->
      <div id="idDivInstruccionesContactos">      
        <ul id="ulNavegacionInstruccionesContactos">
          <li class="liNavegacionInstruccionesContactos" id="liInstruccionesGenerales"><p class="pNavegacionInstruccionesContactos" id="pIdNavegacionInstrucciones">Instrucciones generales</p></li>
          <li class="liNavegacionInstruccionesContactos" id="liContacto"><p class="pNavegacionInstruccionesContactos" id="pIdNavegacionContactos">Contacto con TI</p></li>
        </ul>
        <br>
        <div id="idDivInstruccionesGenerales">
          <p id="idPTextoInstruccionesGenerales">
            Usuarios: <br>
            &nbsp;&nbsp; Como Editar usuario: ... <br><br>
            &nbsp;&nbsp; Como Eliminar usuario: ... <br><br>
            &nbsp;&nbsp; Como agregar usuario: ... <br><br><br>
            Participante:<br>
            &nbsp;&nbsp; Como editar participante: ...<br><br>
            &nbsp;&nbsp; Como eliminar participante: ...<br><br>
            &nbsp;&nbsp; Como agregar participante: ...<br><br><br>
            Noticias:<br>
            &nbsp;&nbsp; Como Editar noticias: ...<br><br>
            &nbsp;&nbsp; Como eliminar participante: ...<br><br>
            &nbsp;&nbsp; Como agregar participante: ...<br><br>
            
          </p>
        </div>
        <div id="idDivContactoTI">
          <p id="idPTextoContacto">
            Jefe departamento de informática<br>
            &nbsp;&nbsp; Nombre: Juan Pérez<br>
            &nbsp;&nbsp; Correo: juanperez@gmail.com<br>
            &nbsp;&nbsp; N° Telefónico: +505 84951622<br><br>

            Técnico Programador 1<br>
            &nbsp;&nbsp; Nombre: Luis Reyes<br>
            &nbsp;&nbsp; Correo: lureyes@gmail.com<br>
            &nbsp;&nbsp; N° Telefónico: +505 75986324<br><br>        

            Técnico Programador 2<br>
            &nbsp;&nbsp; Nombre: Regina Gonzales<br>
            &nbsp;&nbsp; Correo: reginagon@gmail.com<br>
            &nbsp;&nbsp; N° Telefónico: +505 84967358<br>        
          </p>
        </div>
      </div>
    <!--== FIN SECCIÓN INSTRUCCIONES Y CONTACTO ==-->

   <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Incluir SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
   <script src="../../Assets/js/General/helperjs.js"></script>
   <script src="../../Assets/js/General/Constanst.js"></script>
   <!-- <script src="../../Assets/js/General/temporizador.js"></script>  -->
   <script src="../../Assets/js/Administrador/InicioAdministradorSE.js"></script>   

    <!--INICIA CONSTRUCCION FOOTER-->
    
    <br>
    <br>
    <br>
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
              <!-- <li><a href="../../Vista/Administrador/Eventos_ASE.php">Eventos</a></li> -->
              <li><a href="../../Vista/Administrador/PanelAdministrador.php">Panel admin</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <ul class="footer-links">
              <!-- <li><a href="../../Vista/Participante/MiCuenta_SE_v.php">Mi cuenta</a></li> -->
              <!-- <li style="visibility: hidden;"><a href="../../Vista/VEvento/Eventos.html">Eventos</a></li> -->
            </ul>
          </div>

          <div class="col-xs-6">
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="global" href="https://www.uni.edu.ni/#/"><i class="fa fa-globe"></i></a></li>
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
    <!--TERMINA CONSTRUCCION FOOTER-->

</body>

</html>