
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../Vista/Recursos/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Vista/Recursos/css/index.css">
    
    <title>Inicio SGE-FCYS</title>
</head>
<body>
    <header>
        <div>
    <!--/<nav id="nav_menubar">-->
            <div class="logo">
            <img src="../Vista/Recursos/Imagenes/FCyS balnco.png" height="50px">
            </div>
            <ul class="nav justify-content-end">
                <li class="nav-item"><a class="nav-link " id="texto" href="index.php" >Inicio</a></li>
                <li class="nav-item"><a class="nav-link " id="texto" href="Eventos.html">Eventos</a></li>
                <li class="nav-item"><a class="nav-link " id="texto" href="QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a></li>
                <button><a href="Inicio_Docente.html" id="texto">Iniciar Sesión</a></button>
            </ul>
        </div>
    </header>
        
    <div id="fondo">
      <p id="h1_tituloinicio"> Sistema de Gestión de Eventos FCYS</p>
    </div>
<!--========== INICIO CARRUSEL ==========-->    
<div class="slideshow-container">
  <div class="mySlides fade1">
      <div class="numbertext"></div>
      <img src="./Recursos/Imagenes/jornada_uni.jpg" style="width:100%;height: 450px">
      <div class = "text">  </div>
  </div>

  <div class="mySlides fade1">
      <div class="numbertext"></div>
      <img src="./Recursos/Imagenes/navidad_uni.jpg" style="width:100%;height: 450px">
      <div class = "text">  </div>
  </div>

  <div class="mySlides fade1">
      <div class="numbertext"></div>
      <img src="./Recursos/Imagenes/uni_tv.jpg" style="width:100%;height: 450px">
      <div class = "text">  </div>
  </div>

  <a class="prev" onclick="plusSlides(-1)">❮</a>
  <a class="next" onclick="plusSlides(1)">❯</a>
</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div> 
<br>  
<!--========== FIN CARRUSEL ========== -->


<!--========== INICIO NOTICIAS ======= -->
<div id="div_Contenedor_Noticias">
    <div id="div_Contenedor_Noticia_Principal">
        <img src="Recursos/Imagenes/Noti1.png">
        <br><br><br><br>
        <h3></h3>
        <h5></h5>
        <div class="div_Animacion"><h3 style="color:white;" class="h3_Titulo_Noticia">Se consolida la conciencia de prevención</h3></div>
    </div>
    <div Class="div_Contenedor_Noticia_Secundario" id="div_Noticia_Secundario">
        <img src="Recursos/Imagenes/Noti2.png">
        <br><br><br><br>
        <h3></h3>
        <h5></h5>
        <div class="div_Animacion"><h3 style="color:white;" class="h3_Titulo_Noticia">Las pastorelas de la UNI son de Nicaragua</h3></div>
    </div>
     <div Class="div_Contenedor_Noticia_Secundario" id="div_Noticia_Terciario">
        <img src="Recursos/Imagenes/Noti3.png">
        <br><br><br><br>
        <h3></h3>
        <h5></h5>
        <div class="div_Animacion"><h3 style="color:white;" class="h3_Titulo_Noticia">Rescatando la cultura ancestral Nic.</h3></div>
    </div> 
</div>

<!--========== FIN NOTICIAS ======= -->
   <script src="Recursos/js/index.js"></script> 
   
</body>
<footer>
  <h4 id="h4_contactenos"> Contáctenos </h4>
  <div class="h5_detalles_footer">
      <h5>Teléfono: </h5>    
      <h5> Correo: </h5> 
      <h5> Dirección: </h5>
  </div>
  <div class="footer_h5">
      <h5><a class="nav-link " id="texto" href="index.php" >Inicio</a></h5> 
      <h5><a class="nav-link " id="texto" href="Eventos.html" >Eventos</a></h5>
      <h5><a class="nav-link " id="texto" href="#">¿Qué es SGE-FCYS?</a></h5>
  </div>
  <div class="img_footer">
      <img src="../Vista/Recursos/Imagenes/facebook.png" alt="20px" width="20px">
      <img class="espacio_img" src="../Vista/Recursos/Imagenes/global.png" alt="20px" width="20px">
  </div>
  <div class="p_footer">
      <p>© 2021 Universidad Nacional de Ingeniería - FCYS</p>
  </div>        
</footer>

</html>