<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 
    <link rel="stylesheet" href="../Vista/Recursos/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Vista/Recursos/css/inicioParticipanteConEvento.css"> -->

    <link rel="stylesheet" href="http://localhost/sge_sistema/ConstruccionSistema/SGE2/Assets/css/inicioParticipanteConEvento.css">
    <link rel="stylesheet" href="http://localhost/sge_sistema/ConstruccionSistema/SGE2/Assets/css/bootstrap.min.css">    
    
    <title>Inicio SGE-FCYS</title>
</head>
<body>
    <header>

        <?php 
        require_once ("../../Controlador/CUsuario/CUsuario.php"); 
        require_once ("../../Controlador/CEvento/CEvento.php"); 
        ?>

        <div>    
            <div class="logo">
            <img src="http://localhost/sge_sistema/ConstruccionSistema/SGE2/Assets/Imagenes/FCyS balnco.png" height="50px">
            </div>
            <ul class="nav justify-content-end" id="ulNavHeader">
                <li class="nav-item"><a class="nav-link " id="texto" href="index.php" >Inicio</a></li>
                <li class="nav-item"><a class="nav-link " id="texto" href="Eventos.html">Eventos</a></li>
                <li class="nav-item"><a class="nav-link " id="texto" href="QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a></li>
                
            </ul>
            <a id="aNombreUsuario">Nombre</a>
            <img id="imgLogUsuario" class="imgLogUsuarioClass" src="http://localhost/sge_sistema/ConstruccionSistema/SGE2/Assets/Imagenes/icono5.png">  

            <div id="divMenuDespliegue">                                
                <a class="nav-link " href="#">Mi Cuenta</a>
                <a class="nav-link " id="aCerrarSesion" href="#">Cerrar Sesión</a>
            </div>
        </div>
        
        <!--Inicio Menu Móvil-->
        <div class="main-header">
        <img id="imgLogUsuario" src="http://localhost/sge_sistema/ConstruccionSistema/SGE2/Assets/Imagenes/icono5.png"> 
            <nav id="nav" class="main-nav">
            
              <div class="nav-links">
                
                <a class="link-item-session" id="link-item-session2" href="#">Cerrar Sesión</a>
                <a class="link-item"  href="../../index.php" >Inicio</a>
                <a class="link-item"  href="../../Vista/VEvento/Eventos.html">Eventos</a>
                <a class="link-item"  href="../../Vista/VQueessge/QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a>                
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

    <!--=== INICIO ENCABEZADOS ===-->
    <button id="butInscribirAEvento">Inscribir a Evento</button>
    <br><br>
        <!--=== INICIO TEMPORIZADOR ===-->
        <section id="divTemporizador">
            <div class="divDato" id="divDatoDias">
                <h2 class="h2Encabezado">Dias</h2>
                <h2 class="h2Digito" id="h2DigitoDias"><?php echo func_get_days_for_event(); ?></h2>
            </div>            
            <div class="divDato" id="divDatoHoras">
                <h2 class="h2Encabezado">Horas</h2>
                <h2 class="h2Digito" id="h2DigitoHoras"><?php echo func_get_hours_for_event(); ?></h2>
            </div>
            
            <div class="divDato">
                <h1 class="aDosPuntos">:</h1>
                <h2 class="h2Encabezado">Minutos</h2>
                <h2 class="h2Digito"id="h2DigitoMinutos"><?php echo func_get_minutes_for_event(); ?></h2>
            </div>
            
            <div class="divDato">
                <h1 class="aDosPuntos">:<h1></h1>
                <h2 class="h2Encabezado">Segundos</h2>
                <h2 class="h2Digito"id="h2DigitoSegundos"><?php echo func_get_seconds_for_event(); ?></h2>
            </div>
            
        </section>
        <!--=== FIN TEMPORIZADOR ===-->        

    <div id="divTituloInicial">
      <p class="pTituloInicial"> Feria de Ciencia y Tecnología </p>
      <p class="pTituloInicial"> 07 de Octubre, UNI-Rupap </p>
    </div>
    <!--=== FIN ENCABEZADOS ===-->    

<!--========== INICIO NOTICIAS ======= -->
<div id="div_Contenedor_Noticias">
    <div id="div_Contenedor_Noticia_Principal">
        <img src="http://localhost/sge_sistema/ConstruccionSistema/SGE2/Assets/Imagenes/Noti1.png">
        <br><br><br><br>
        <h3></h3>
        <h5></h5>
        <div class="div_Animacion" id="divTituloNoticiaPrincipal"><h3 style="color:white;" class="h3_Titulo_Noticia">Se consolida la conciencia de prevención</h3></div>
    </div>
    <div Class="div_Contenedor_Noticia_Secundario" id="div_Noticia_Secundario">
        <img src="http://localhost/sge_sistema/ConstruccionSistema/SGE2/Assets/Imagenes/Noti2.png">
        <br><br><br><br>
        <h3></h3>
        <h5></h5>
        <div class="div_Animacion"><h3 style="color:white;" class="h3_Titulo_Noticia">Las pastorelas de la UNI son de Nicaragua</h3></div>
    </div>
     <div Class="div_Contenedor_Noticia_Secundario" id="div_Noticia_Terciario">
        <img src="http://localhost/sge_sistema/ConstruccionSistema/SGE2/Assets/Imagenes/Noti3.png">
        <br><br><br><br>
        <h3></h3>
        <h5></h5>
        <div class="div_Animacion"><h3 style="color:white;" class="h3_Titulo_Noticia">Rescatando la cultura ancestral Nic.</h3></div>
    </div> 
</div>

<!--========== FIN NOTICIAS ======= -->

<!--========== INICIO LINEA DE TIEMPO DEL EVENTO ======= -->
<div id="divLineaTiempoEvento">
<ul id="ulMenuLineaTiempo">
    <li><a href="#" class="liMenuLineaTiempo">Visitas a las sedes</a></li>
    <li><a href="#" class="liMenuLineaTiempo">Periodo de inscripción</a></li>
    <li><a href="#" class="liMenuLineaTiempo">Periodo de Confirmación</a></li>
</ul>
<section class="secLineaDeTiempoEvento">
    <h3>Linea de Tiempo del Evento</h3>
    
</section>

<section class="secLineaDeTiempoEvento">
    <h3>Categorías del evento</h3>
    
</section>
</div>
<!--========== FIN LINEA DE TIEMPO DEL EVENTO ======= -->

   <script src="http://localhost/sge_sistema/ConstruccionSistema/SGE2/Assets/js/temporizador.js"></script> 
   <script src="../../Assets/js/inicioParticipanteConEvento.js"></script>
</body>
<footer>
  <h4 id="h4_contactenos"> Contáctenos </h4>
  <div class="h5_detalles_footer">
      <h5 class="h5Detalles">Teléfono: </h5>    
      <h5 class="h5Detalles"> Correo: </h5> 
      <h5 class="h5Detalles"> Dirección: </h5>
  </div>
  <div class="footer_h5">
      <h5><a class="nav_link" id="texto" href="index.php" >Inicio</a></h5> 
      <h5><a class="nav_link" id="texto" href="Eventos.html" >Eventos</a></h5>
      <h5><a class="nav_link" id="texto" href="#">¿Qué es SGE-FCYS?</a></h5>
  </div>
  <div class="img_footer">
      <img src="http://localhost/sge_sistema/ConstruccionSistema/SGE2/Assets/Imagenes/facebook.png" alt="20px" width="20px">
      <img class="espacio_img" src="http://localhost/sge_sistema/ConstruccionSistema/SGE2/Assets/Imagenes/global.png" alt="20px" width="20px">
  </div>
  <div class="p_footer">
      <p>© 2021 Universidad Nacional de Ingeniería - FCYS</p>
  </div>        
</footer>

</html>