<?php  
  include(dirname(__FILE__, 1)."/Controlador/General/CEvento.php");  

  $vlocResultadoVerificacionExistenciaEvento = FunVerificarExistenciaEventoSegunAñoActual();  
  if($vlocResultadoVerificacionExistenciaEvento == CteExisteEventoEnAñoActual){
    
    // header('Location: '.dirname(__FILE__, 1).'/Vista/General/IndexConEvento.php');//Aqui lo redireccionas al lugar que quieras.
    header('Location: Vista/General/IndexConEvento.php');//Aqui lo redireccionas al lugar que quieras.    
  }else{
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../SGE_V1/Assets/imagenes/Recursos/Logo_UNI.png" height="30px" width="30px">
    <link rel="stylesheet" href="../SGE_V1/Assets/css/General/bootstrap.min.css">

    <link rel="stylesheet" href="../SGE_V1/Assets/herramientas/font-awesome-4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="../SGE_V1/Assets/css/General/index_srse.css">             
    
    <title>Inicio SGE-FCYS</title>
</head>
<body>
  <header>
      <div id="divPrincipalHeader">    
          <div class="logo">
          <img src="../SGE_V1/Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
          </div>
          <ul class="nav justify-content-end">
              <li class="nav-item"><a class="nav-link" id="texto" href="" >Inicio</a></li>
              <li class="nav-item"><a class="nav-link" id="texto" href="../SGE_V1/Vista/General/Evento_SR.php">Eventos</a></li>
              <li class="nav-item"><a class="nav-link" id="texto" href="../SGE_V1/Vista/General/QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a></li>
              <button class="buttonIniciarSesion"><a href="../SGE_V1/Vista/General/Iniciar_Sesion.php" id="texto">Iniciar sesión</a></button>
          </ul>
      </div>

      <!--Inicio Menu Móvil-->
      <div class="main-header">
          <!-- <img id="imgLogUsuario" src="http://localhost/sge_sistema/ConstruccionSistema/SGE2/Assets/Imagenes/icono5.png">  -->
              <nav id="nav" class="main-nav">
              
                <div class="nav-links">                  
                  <!-- <a class="link-item-session" id="link-item-session2" href="#">Cerrar sesión</a> -->
                  <a class="link-item"  href="" >Inicio</a>
                  <a class="link-item"  href="../SGE_V1/Vista/General/Eventos_SR.php">Eventos</a>
                  <a class="link-item"  href="../SGE_V1/Vista/General/QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a>                
                  <button><a href="../SGE_V1/Vista/General/Iniciar_Sesion.php" id="texto">Iniciar sesión</a></button>
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
    <!--Para reidirigir a la página de la UNI-->
    <a><section id="sectionLinkUni">
      <img class="linkUni" rel="icon" src="../SGE_V1/Assets/imagenes/Recursos/Logo_UNI.png" height="25px" width="30px">
      <p class="linkUni">Ir a uni.edu.ni</p>
    </section></a>
    <!--=====================================-->

    <div id="fondo">
      <p id="h1_tituloinicio"> Sistema de gestión de eventos FCYS</p>
    </div>
<!--========== INICIO CARRUSEL ==========-->    
<div class="slideshow-container" >
  <div class="mySlides fade1" >
      <div class="numbertext"></div>
      <img src="../SGE_V1/Assets/imagenes/Noticias/jornada_uni.jpg" style="width:100%;">
      <div class = "text">  </div>
  </div>

  <div class="mySlides fade1">
      <div class="numbertext"></div>
      <img src="../SGE_V1/Assets/imagenes/Noticias/calendario_actividades.jpg" style="width:100%;">
      <div class = "text">  </div>
  </div>

  <div class="mySlides fade1">
      <div class="numbertext"></div>
      <img src="../SGE_V1/Assets/imagenes/Noticias/uni_farq.jpg" style="width:100%;">
      <div class = "text">  </div>
  </div>

  <a class="prev" onclick="plusSlides(-1)">❮</a>
  <a class="next" onclick="plusSlides(1)">❯</a>
</div>
<br>

<div class="divTreePoints">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div> 
<br>  
<!--========== FIN CARRUSEL ========== -->


<!--========== INICIO NOTICIAS ======= -->
<div id="div_Contenedor_Noticias">
  <div id="div_Contenedor_Noticia_Principal">
      <img src="">
      <br><br><br><br>
      <h3></h3>
      <h5></h5>
      <div class="div_Animacion" ><h3 style="color:white;" class="h3_Titulo_Noticia"></h3></div>
  </div>
  <div Class="div_Contenedor_Noticia_Secundario" id="div_Noticia_Secundario">
      <img src="">
      <br><br><br><br>
      <h3></h3>
      <h5></h5>
      <div class="div_Animacion"><h3 style="color:white;" class="h3_Titulo_Noticia"></h3></div>
  </div>
    <div Class="div_Contenedor_Noticia_Secundario" id="div_Noticia_Terciario">
      <img src="">
      <br><br><br><br>
      <h3></h3>
      <h5></h5>
      <div class="div_Animacion"><h3 style="color:white;" class="h3_Titulo_Noticia"></h3></div>
  </div> 
</div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>       
  <script src="Assets/js/General/helperjs.js"></script>
  <script src="Assets/js/General/Constanst.js"></script>
  <script>
    function ActualizarSeccionNoticias(){
      
      var vlocResultadoAjax = FunEjecutarAjax("Controlador/Administrador/CAdministracionSeccionNoticias.php?vparBoolObtenerListaNoticias=" + Cnt_Obtener_Informacion_Noticias);
  
      var elementos = vlocResultadoAjax.split(';');
      for (i=0; i<elementos.length; i++){
        var subelementos = elementos[i].split('-_-');
        
        if (i == 0){
          var urlModificado = "../SGE_V1/" + subelementos[Cnt_Posicion_Url_Imagen].substring(6);
          $(".h3_Titulo_Noticia:eq(0)").html(subelementos[Cnt_Posicion_Descripcion]);
          $("#div_Contenedor_Noticia_Principal img").attr('src', urlModificado);
        }

        if (i == 1){
          var urlModificado = "../SGE_V1/" + subelementos[Cnt_Posicion_Url_Imagen].substring(6);
          $(".h3_Titulo_Noticia:eq(1)").html(subelementos[Cnt_Posicion_Descripcion]);
          $("#div_Noticia_Secundario img").attr('src', urlModificado);
        }

        if (i == 2){
          var urlModificado = "../SGE_V1/" + subelementos[Cnt_Posicion_Url_Imagen].substring(6);
          $(".h3_Titulo_Noticia:eq(2)").html(subelementos[Cnt_Posicion_Descripcion]);
          $("#div_Noticia_Terciario img").attr('src', urlModificado);
        }
  
      }
    }

    function ActualizarSeccionCarrusel(){
      
      var vlocResultadoAjax = FunEjecutarAjax("Controlador/Administrador/CAdministracionCarruselInicio.php?vparBoolObtenerListaImagenesCarruselNoticias=" + Cnt_Obtener_Informacion_Imagenes_Carrusel_Inicio);
  
      var elementos = vlocResultadoAjax.split(';');

      for (i=0; i<elementos.length; i++){
        var subelementos = elementos[i].split('-_-');
        
        if (i == 0){
          
          var urlModificado = "../SGE_V1/" + subelementos[Cnt_Posicion_Url_Imagen].substring(6);
          
          $(".mySlides:eq(0) img").attr('src', urlModificado);
        }

        if (i == 1){
          var urlModificado = "../SGE_V1/" + subelementos[Cnt_Posicion_Url_Imagen].substring(6);
          $(".mySlides:eq(1) img").attr('src', urlModificado);
        }

        if (i == 2){
          var urlModificado = "../SGE_V1/" + subelementos[Cnt_Posicion_Url_Imagen].substring(6);
          $(".mySlides:eq(2) img").attr('src', urlModificado);
        }
  
      }
    }

    ActualizarSeccionCarrusel();
    
    ActualizarSeccionNoticias();
  </script>
  
<!--========== FIN NOTICIAS ======= -->  
   
   <!--INICIA CONSTRUCCION FOOTER-->
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
          <li><a href="">Inicio</a></li>
              <li><a href="../SGE_V1/Vista/General/Eventos_SR.php">Eventos</a></li>
              <li><a href="../SGE_V1/Vista/General/QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a></li>
          </ul>
        </div>

        <div class="col-xs-6 col-md-3" >
          <ul class="footer-links">
          <li><a href="../SGE_V1/Vista/General/Iniciar_Sesion.php">Iniciar sesión</a></li>
          <li style="visibility: hidden;"><a href="../../Vista/VEvento/Eventos.html">Eventos</a></li>
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
<script src="../SGE_V1/Assets/js/General/index_srse.js"></script> 
  <!--TERMINA CONSTRUCCION FOOTER-->
</body>


</html>
<?php
}
?>