<?php
  require_once ("../../Controlador/General/CUsuario.php"); 
  require_once(dirname(__FILE__, 3)."/Controlador/General/CEvento.php");    
  require_once ("../../Controlador/General/helper.php"); 
  // require_once ("../../Controlador/Administrador/CInicioAdministradorCE.php"); 

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
  if($vlocResultadoVerificacionExistenciaEvento != CteExisteEventoEnAñoActual){
    header('Location: ../../Vista/Administrador/InicioAdministradorSE.php');//Aqui lo redireccionas al lugar que quieras.        
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

  <link rel="stylesheet" href="../../Assets/css/Administrador/InicioAdministradorCE.css">

  <!-- Incluir SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
  
  <title>Inicio Participante CE</title>
</head>
<body>
    <header>
        <div>    
          <div class="logo">
            <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">            
          </div>
          <ul class="nav justify-content-end" id="ulNavHeader">
            <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/InicioAdministradorCE.php" >Inicio</a></li>
            <!-- <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/Eventos_ASE.php">Eventos</a></li> -->
            <!-- <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/QueEs_InfoSisA.php">¿Qué es SGE-FCYS?</a></li>             -->
            <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/PanelAdministrador.php">Panel admin</a></li>            
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
    
    <?php
      $vlocDireccionLogoEslogan = FunObtenerDireccionLogoEsloganEventoActual();
      FunVerificarLogoVacio($vlocDireccionLogoEslogan[0]);
      // echo '<script>alert('.FunObtenerDiaEventoActual().');</script>';
      // exit;

      $vlocInformacionEventoActualParaIndex = FunObtenerInformacionEventoActualParaIndex();
      $vlocInformacionEventoActualParaIndex = explode("-_-", $vlocInformacionEventoActualParaIndex);
      $vlocSitioEvento = substr($vlocInformacionEventoActualParaIndex[6], 0, -1); // Para obtener el sitio del evento y quitar el último carácter (;)
    ?>

    <h1 id="h1TextoInicial">Sistema de gestión de eventos FCYS</h1>
    <p id="idPTituloInicial"> <?php echo $vlocDireccionLogoEslogan[2]; ?> </p>

    <br><br><br>

    <div id="idDivLogoEslogan">
      <img id="idImgLogo" src="<?php echo $vlocDireccionLogoEslogan[0]; ?>">
      <h2 id="idTextEslogan"><?php echo $vlocDireccionLogoEslogan[1]; ?></h2>
    </div>
    
    <br><br><br>

    <div id="divTituloInicial">
      <p class="pTituloInicial"> <?php echo FunObtenerDiaEventoActual(); ?> de <?php echo FunObtenerMesEventoActualEnLetras(); ?>, <?php echo $vlocSitioEvento; ?> </p>
    </div>

    <br><br><br>

    <!--=== INICIO TEMPORIZADOR ===-->
    <section id="divTemporizador">
      <div class="divDato" id="divDatoDias">
          <h2 class="h2Encabezado">Días</h2>
          <h2 class="h2Digito" id="h2DigitoDias"><?php echo func_get_days_for_event(); ?></h2>
      </div>            
      <div class="divDato" id="divDatoHoras">
          <h2 class="h2Encabezado">Horas</h2>
          <h2 class="h2Digito" id="h2DigitoHoras"><?php echo func_get_hours_for_event(); ?></h2>
      </div>
      
      <div class="divDato">
          <h1 class="aDosPuntos" id="dosPuntosMinutos">:</h1>
          <h2 class="h2Encabezado">Minutos</h2>
          <h2 class="h2Digito"id="h2DigitoMinutos"><?php echo func_get_minutes_for_event(); ?></h2>
      </div>
      
      <div class="divDato">
        <h1 class="aDosPuntos" id="dosPuntosSegundos">:</h1>
        <h2 class="h2Encabezado">Segundos</h2>
        <h2 class="h2Digito"id="h2DigitoSegundos"><?php echo func_get_seconds_for_event(); ?></h2>
      </div>          
    </section>
    <!--=== FIN TEMPORIZADOR ===--> 
    
    <!--== INICIO BOTONES ==-->
      <div id="idDivBotones">
        <button class="boton-imagen" disabled>
          <img src="../../Assets/imagenes/Iconos/Sistema/Administrador/calificaciones.png" alt=""><br>
          <span>Jurado</span>
        </button>
        <button class="boton-imagen" disabled>
          <img src="../../Assets/imagenes/Iconos/Sistema/Administrador/curriculum.png" alt=""><br>
          <span>Personal académico</span>
        </button>
        <button class="boton-imagen" disabled>
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
            &nbsp;&nbsp; Como editar usuario: Se debe dirigir al panel del administrador, para posteriormente ingresar a 'Gestionar accesos', seguido seleccionamos el acceso que se desea editar y se da clic en 'Editar acceso'. Se brinda la información pertinente en los campos y damos clic en 'Guardar cambios'. <br><br>
            &nbsp;&nbsp; Como eliminar usuario: Se debe dirigir al panel del administrador, para posteriormente ingresar a 'Gestionar accesos', seguido seleccionamos el acceso que se desea eliminar y se da clic en 'Eliminar acceso'.<br><br>
            &nbsp;&nbsp; Como agregar usuario: Se debe dirigir al panel del administrador, para posteriormente ingresar a 'Gestionar accesos', seguido seleccionamos el acceso el cual se desea agregar un acceso nuevo y se da clic en 'Agregar acceso'. Se brinda la información pertinente dependiendo del tipo de usuario que se desea agrear y posteriormente damos clic en 'Agregar usuarios'. <br><br><br>
            Secciones animadas:<br>
            &nbsp;&nbsp; Como editar noticias: Se debe dirigir al panel del administrador, para posteriormente ingresar a 'Gestionar secciones animadas', seguido seleccionamos 'Gestionar sección noticias', en el cual se selecciona el lugar de noticia que se desea editar, y se da clic en 'Editar noticia', donde seleccionamos la imagen y escribimos el texto correspodiente a la noticia<br><br>
            &nbsp;&nbsp; Como editar carrusel de inicios: Se debe dirigir al panel del administrador, para posteriormente ingresar a 'Gestionar secciones animadas', seguido seleccionamos 'Gestionar carrusel inicio', en el cual se selecciona la imagen que se desea cambiar, y se da clic en 'Cambiar imagen', donde seleccionamos la imagen a presentar en el carrusel de los inicios<br><br>
            &nbsp;&nbsp; Como editar carrusel del evento: Se debe dirigir al panel del administrador, para posteriormente ingresar a 'Gestionar secciones animadas', seguido seleccionamos 'Gestionar carrusel evento', en el cual se selecciona la imagen que se desea cambiar, y se da clic en 'Cambiar imagen', donde seleccionamos la imagen a presentar en el carrusel del evento<br><br>
            &nbsp;&nbsp; Como editar línea de tiempo: Se debe dirigir al panel del administrador, para posteriormente ingresar a 'Gestionar secciones animadas', seguido seleccionamos 'Gestionar línea de tiempo', en el cual se muestra las 5 fases que podría a legar a tener el evento, se selecciona uno si se desea editar o eliminar. Y se puede agregar enlace con el botón 'Agregar enlace', este último botón estará habilitado siempre que no se haya registrado la fase 5.<br><br>                        
          </p>
        </div>
        <div id="idDivContactoTI">
          <p id="idPTextoContacto">
            Técnico programador 1<br>
            &nbsp;&nbsp; Nombre: Desarrollador 1<br>
            &nbsp;&nbsp; Correo: desarrollador1@gmail.com<br>
            &nbsp;&nbsp; N° Telefónico: +505 0000-0001<br><br>

            Técnico Programador 2<br>
            &nbsp;&nbsp; Nombre: Desarrollador 2<br>
            &nbsp;&nbsp; Correo: desarrollador2@gmail.com<br>
            &nbsp;&nbsp; N° Telefónico: +505 0000-0002<br><br>        

            Técnico Programador 3<br>
            &nbsp;&nbsp; Nombre: Desarrollador 3<br>
            &nbsp;&nbsp; Correo: desarrollador3@gmail.com<br>
            &nbsp;&nbsp; N° Telefónico: +505 0000-0003<br>        
          </p>
        </div>
      </div>
    <!--== FIN SECCIÓN INSTRUCCIONES Y CONTACTO ==-->

   <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <!-- Incluir SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>

   <script src="../../Assets/js/General/helperjs.js"></script>
   <script src="../../Assets/js/General/Constanst.js"></script>
   <script src="../../Assets/js/General/temporizador.js"></script> 
   <script src="../../Assets/js/Administrador/InicioAdministradorCE.js"></script>   

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
              <li><a href="../../Vista/Participante/MiCuenta_SE_v.php" style="visibility:hidden;">Mi cuenta</a></li>
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