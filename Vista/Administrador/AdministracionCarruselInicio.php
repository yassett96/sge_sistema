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
//   $vlocResultadoVerificacionExistenciaEvento = FunVerificarExistenciaEventoSegunAñoActual();

  // //Para verificar que el participante ha inscrito algún proyecto
  //   // echo "Prueba Samir: ".$vlocResultadoVerificacionExistenciaEvento;
  //   // exit;
//   if($vlocResultadoVerificacionExistenciaEvento != CteExisteEventoEnAñoActual){
//     header('Location: ../../Vista/Administrador/InicioAdministradorSE.php');//Aqui lo redireccionas al lugar que quieras.        
//     die();
//   }

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

  <link rel="stylesheet" href="../../Assets/css/Administrador/AdministracionCarruselInicio.css">
  
  <title>Gestión carrusel inicio</title>
</head>
<body>
    <header>
        <div>    
          <div class="logo">
            <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">            
          </div>
          <ul class="nav justify-content-end" id="ulNavHeader">
            <li><a class="nav-link" id="texto" href="../../Vista/Administrador/InicioAdministradorCE.php" >Inicio</a></li>
            <!-- <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/Eventos_ASE.php">Eventos</a></li> -->
            <!-- <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/QueEs_InfoSisA.php">¿Qué es SGE-FCYS?</a></li>             -->
            <li><a class="nav-link" id="texto" href="../../Vista/Administrador/PanelAdministrador.php">Panel admin</a></li>            
          </ul>                    
          <section id= "sectionCentralizarLogoNombre">
            <img id="imgLogUsuario" class="imgLogUsuarioClass" src="<?php echo $_SESSION['Avatar']; ?>">  
            <br>
            <a id="aNombreUsuario"><?php echo $_SESSION['NombreCompleto']; ?></a>
          </section>                            
          <div id="divMenuDespliegue">              
            <a class="nav-link " href="../../Vista/Administrador/MiCuenta_CE.php">Mi cuenta</a>            
            <a class="nav-link " id="aCerrarSesion" href="../../Controlador/General/CCerrarSesion.php">Cerrar sesión</a>
          </div>
        </div>
        
        <!--Inicio Menu Móvil-->
        <div class="main-header">          
            <nav id="nav" class="main-nav" >            
              <div class="nav-links"> 
                <img id="imgLogUsuarioMovil" src="<?php echo $_SESSION['Avatar'] ?>">                                  
                <div class="Nombreusuario"><?php echo $_SESSION['NombreCompleto']; ?></div>
                <a class="link-item"  href="../../Vista/Administrador/InicioAdministradorCE.php" >Inicio</a>
                <a class="link-item"  href="../../Vista/Administrador/PanelAdministrador.php">Panel admin</a>
                <!-- <a class="link-item"  href="../../Vista/Administrador/QueEs_InfoSisA.php">¿Qué es SGE-FCYS?</a>     -->
                <a class="link-item"  href="../../Vista/Administrador/MiCuenta_CE.php">Mi cuenta</a>             
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
    
    <img src="../../Assets/Imagenes/Recursos/mosaico1.png" id="mosaicoDER" height="180px" width="180px">

    <h4 id="h4Atras" ><a id="aAtras"><< Atrás</a></h4>

    <br>

    <h1 id="h1TextoInicial">Gestión carrusel inicio</h1>
    <br>
    <br>
    <br>
    
    <!-- INICIO SECCIÓN SELECCIÓN NOTICIAS -->

    <div id="div_Contenedor_Noticias">
      <h3 id="idH3TextoContenedor">Seleccione la imagen que desea sustituir</h3>
      
        <div class="div_contenedor_noticia" id="div_Contenedor_Primario" >
            <img src="">            
        </div>
        
        <div class="div_contenedor_noticia" id="div_Noticia_Secundario">
            <img src="">                
        </div>
        
        <div class="div_contenedor_noticia" id="div_Noticia_Terciario">
            <img src="">                
        </div> 

    </div>

    <!-- FIN SECCIÓN SELECCIÓN NOTICIAS -->
    <br>

    <div id="idDivBotonesAcciones">
      <button class="classBotonAccion" id="idBotonEditar">Cambiar imagen</button>      
    </div>

    <!-- Inicio PopUp Editar -->
    <div id="divFondoPopUpEditar">
      <div id="divPopUpEditar">
        <h1 id="textoEncabezadoPopUpEditar">Cambiar imagen</h1>
        <br>
        <section id="popUpEditarCampo1" class="popUpEditarCampos">
          <h5 class="h5TextosPopUpEditar">Selecciona una imagen</h5><br>
          <img id="idImgPopUpEditar" src=""><br>
          <input type="file" class="camposPopUpEditar" id="imagenSeleccionar">
        </section>
        <!-- <br>
        <section id="popUpEditarCampo2" class="popUpEditarCampos">
          <h5 class="h5TextosPopUpEditar">Descripción</h5>
          <textarea type="text" value="Descripción" id="textAreaDescripcionPopUpEditar" class="camposPopUpEditar"></textarea>
        </section>     -->

        <button class="botonesPopUpEditar" id="buttonGuardarCambiosPopUpEditar">Guardar cambios</button>
        <button class="botonesPopUpEditar" id="buttonCancelarPopUpEditar">Cancelar</button>          
      </div>
    </div>
   
    <img src="../../Assets/Imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">                           

    <br><br>

   <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>       
   <script src="../../Assets/js/General/helperjs.js"></script>
   <script src="../../Assets/js/General/Constanst.js"></script>
   <script src="../../Assets/js/Administrador/AdministracionCarruselInicio.js"></script>   

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
              <li style="visibility:hidden;"><a href="../../Vista/Participante/MiCuenta_SE_v.php">Mi cuenta</a></li>
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