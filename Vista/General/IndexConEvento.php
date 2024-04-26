<?php 
    //  require_once("../../../../../../Controlador/General/CEvento.php");
    //  require_once("../../../../../../AuxiliarPhp/Constants.php");
    //  include(dirname(__FILE__, 3)."/Controlador/General/CEvento.php");
    // require_once ("../../Controlador/General/CIndexConEvento.php"); 
    require_once(dirname(__FILE__, 3)."/Controlador/General/CEvento.php");  
    require_once ("../../Controlador/General/helper.php"); 
    $vlocResultadoVerificacionExistenciaEvento = FunVerificarExistenciaEventoSegunAñoActual();
  
    if($vlocResultadoVerificacionExistenciaEvento != CteExisteEventoEnAñoActual){      
      header('Location: index_SRSE.php');//Aqui lo redireccionas al lugar que quieras.      
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="../../../SGE_V1/Assets/imagenes/Recursos/Logo_UNI.png" height="30px" width="30px">
  <link rel="stylesheet" href="../../../SGE_V1/Assets/css/General/bootstrap.min.css">

  <link rel="stylesheet" href="../../../SGE_V1/Assets/herramientas/font-awesome-4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="../../../SGE_V1/Assets/css/General/IndexConEvento.css">             

  <!-- Incluir SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
  
  <title>Inicio SGE-FCYS</title>
</head>
<body>
  <header>
      <div id="divPrincipalHeader">    
          <div class="logo">
          <img src="../../../SGE_V1/Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
          </div>
          <ul class="nav justify-content-end">
              <li class="nav-item"><a class="nav-link" id="texto" href="" >Inicio</a></li>
              <li class="nav-item"><a class="nav-link" id="texto" href="../../../SGE_V1/Vista/General/Eventos_CR.php">Eventos</a></li>
              <li class="nav-item"><a class="nav-link" id="texto" href="../../../SGE_V1/Vista/General/QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a></li>
              <button class="buttonIniciarSesion"><a href="../../../SGE_V1/Vista/General/Iniciar_Sesion.php" id="texto">Iniciar sesión</a></button>
          </ul>
      </div>

      <!--Inicio Menu Móvil-->
      <div class="main-header">
          <!-- <img id="imgLogUsuario" src="http://localhost/sge_sistema/ConstruccionSistema/SGE2/Assets/Imagenes/icono5.png">  -->
              <nav id="nav" class="main-nav">
              
                <div class="nav-links">                  
                  <!-- <a class="link-item-session" id="link-item-session2" href="#">Cerrar sesión</a> -->
                  <a class="link-item"  href="" >Inicio</a>
                  <a class="link-item"  href="../../../SGE_V1/Vista/General/Eventos_SR.php">Eventos</a>
                  <a class="link-item"  href="../../../SGE_V1/Vista/General/QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a>                
                  <button><a href="../../../SGE_V1/Vista/General/Iniciar_Sesion.php" id="texto">Iniciar sesión</a></button>
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
      <img class="linkUni" rel="icon" src="../../Assets/imagenes/Recursos/Logo_UNI.png" height="25px" width="30px">
      <p class="linkUni">Ir a uni.edu.ni</p>
    </section></a>
    <!--=====================================-->
    <?php
      $vlocDireccionLogoEslogan = FunObtenerDireccionLogoEsloganEventoActual();
      FunVerificarLogoVacio($vlocDireccionLogoEslogan[0]);
      // echo '<script>alert('.FunObtenerDiaEventoActual().');</script>';
      // exit;
      $vlocInformacionEventoActualParaIndex = FunObtenerInformacionEventoActualParaIndex();
      $vlocInformacionEventoActualParaIndex = explode("-_-", $vlocInformacionEventoActualParaIndex);
      $vlocSitioEvento = substr($vlocInformacionEventoActualParaIndex[6], 0, -1); // Para obtener el sitio del evento y quitar el último carácter (;)    
    ?>

    <div id="fondo">
      <p id="h1_tituloinicio"> Sistema de gestión de eventos FCYS</p>
      <p id="idPTituloInicial"> <?php echo $vlocDireccionLogoEslogan[2]; ?> </p>
    </div>
    <br>
    <br>
    <br>
    
    <!-- INICIO LOGO ESLOGAN -->
    <div id="idDivLogoEslogan">
      <img id="idImgLogo" src="<?php echo $vlocDireccionLogoEslogan[0]; ?>">
      <h2 id="idTextEslogan"><?php echo $vlocDireccionLogoEslogan[1]; ?></h2>
    </div>
    <!-- FIN LOGO ESLOGAN --> 

    <div id="divTituloInicial">
      <p class="pTituloInicial"> <?php echo FunObtenerDiaEventoActual(); ?> de <?php echo FunObtenerMesEventoActualEnLetras(); ?>, <?php echo $vlocSitioEvento; ?> </p>
    </div>
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
    
<!--========== INICIO CARRUSEL ==========-->    
<div class="slideshow-container" >
  <div class="mySlides fade1" >
      <div class="numbertext"></div>
      <img src="" style="width:100%;">
      <div class = "text">  </div>
  </div>

  <div class="mySlides fade1">
      <div class="numbertext"></div>
      <img src="" style="width:100%;">
      <div class = "text">  </div>
  </div>

  <div class="mySlides fade1">
      <div class="numbertext"></div>
      <img src="" style="width:100%;">
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
<!--======== FIN NOTICIAS ============= -->
<!--========== INICIO LINEA DE TIEMPO DEL EVENTO E INFORMACIÓN DE FERIA CIENTÍFICA ======= -->
<div id="divLineaTiempoEvento">
  <ul id="ulMenuLineaTiempo">
  </ul>

  <section class="secLineaDeTiempoEvento">
    <h3>Linea de Tiempo del Evento</h3>    
  </section>

  <section class="secLineaDeTiempoEvento" id="secIdLineaDeTiempoEvento">
    <h3>Categorías del evento</h3>    
  </section>
</div>
<!--========== FIN LINEA DE TIEMPO DEL EVENTO E INFORMACIÓN DE FERIA CIENTÍFICA ======= -->
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <!-- Incluir SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
  <script src="../../Assets/js/General/helperjs.js"></script>
  <script src="../../Assets/js/General/Constanst.js"></script>
  <script src="../../Assets/js/General/temporizador.js"></script> 
  <script src="../../Assets/js/General/indexConEvento.js"></script> 
  <script>
    function ActualizarSeccionNoticias(){
      
      var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionSeccionNoticias.php?vparBoolObtenerListaNoticias=" + Cnt_Obtener_Informacion_Noticias);
          //alert(vlocResultadoAjax);
  
      var elementos = vlocResultadoAjax.split(';');
  
      for (i=0; i<elementos.length; i++){
        var subelementos = elementos[i].split('-_-');
        
        if (i == 0){
          //alert(urlModificado);
          //alert(subelementos[Cnt_Posicion_Url_Imagen]);
          
          var urlModificado = "../../../SGE_V1/" + subelementos[Cnt_Posicion_Url_Imagen].substring(6);
          
          $(".h3_Titulo_Noticia:eq(0)").html(subelementos[Cnt_Posicion_Descripcion]);
          $("#div_Contenedor_Noticia_Principal img").attr('src', urlModificado);
        }

        if (i == 1){
          var urlModificado = "../../../SGE_V1/" + subelementos[Cnt_Posicion_Url_Imagen].substring(6);
          $(".h3_Titulo_Noticia:eq(1)").html(subelementos[Cnt_Posicion_Descripcion]);
          $("#div_Noticia_Secundario img").attr('src', urlModificado);
        }

        if (i == 2){
          var urlModificado = "../../../SGE_V1/" + subelementos[Cnt_Posicion_Url_Imagen].substring(6);
          $(".h3_Titulo_Noticia:eq(2)").html(subelementos[Cnt_Posicion_Descripcion]);
          $("#div_Noticia_Terciario img").attr('src', urlModificado);
        }
  
      }
    }

    function ActualizarSeccionCarrusel(){
      
      var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionCarruselInicio.php?vparBoolObtenerListaImagenesCarruselNoticias=" + Cnt_Obtener_Informacion_Imagenes_Carrusel_Inicio);
        // alert(vlocResultadoAjax);
  
      var elementos = vlocResultadoAjax.split(';');
  
      for (i=0; i<elementos.length; i++){
        var subelementos = elementos[i].split('-_-');
        
        if (i == 0){
          //alert(urlModificado);
          //alert(subelementos[Cnt_Posicion_Url_Imagen]);
          
          var urlModificado = "../../../SGE_V1/" + subelementos[Cnt_Posicion_Url_Imagen].substring(6);
          
          $(".mySlides:eq(0) img").attr('src', urlModificado);
        }

        if (i == 1){
          var urlModificado = "../../../SGE_V1/" + subelementos[Cnt_Posicion_Url_Imagen].substring(6);
          $(".mySlides:eq(1) img").attr('src', urlModificado);
        }

        if (i == 2){
          var urlModificado = "../../../SGE_V1/" + subelementos[Cnt_Posicion_Url_Imagen].substring(6);
          $(".mySlides:eq(2) img").attr('src', urlModificado);
        }
  
      }
    }

    function ActualizarSeccionEnlaces(){
        
      var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionLineaTiempo.php?vparBoolObtenerListaEnlacesLineaTiempo=" + Cnt_Obtener_Informacion_Enlaces_Linea_Tiempo);

      var elementos = vlocResultadoAjax.split(';');

      var numeroCamposEnlaces = 6;

      var elementosLength = 0;

      var textoHtml = '';

      if (elementos[0].split('-_-')[Cnt_Posicion_Fase] == undefined){
        elementosLength = 0;
      }else{
        elementosLength = elementos.length;
      }
      
      for (i=0; i<elementosLength; i++){
        var subelementos = elementos[i].split('-_-');
        
        textoHtml += '<li><a href="' + subelementos[Cnt_Posicion_Enlace] + '" class="liMenuLineaTiempo">' + subelementos[Cnt_Posicion_Fase] + '</a></li>'; 
      }

      $("#ulMenuLineaTiempo").html(textoHtml);
    }

    function ActualizarSeccionInfoEvento(){
      var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/General/CEvento.php?vparBoolObtenerInfoEvento=" + true);

      var elementos = vlocResultadoAjax.split(';');

      var textoHtml = '';
      var nombreEventoL = elementos[0].split('-_-');
      nombreEvento = nombreEventoL[Cnt_Nombre_Evento_Info_Evento];      

      textoHtml += '<h3>'+nombreEvento+'</h3><br>';

      textoHtml += '<table>'+
                      '<thead>'+
                        '<tr>'+
                          '<th>Nombre categoría</th>'+
                          '<th>Nombre subcategoría</th>'+
                          '<th>Nombre año académico</th>'+
                        '</tr>'+
                      '</thead>'+
                      '<tbody>';

      for (i=0; i<elementos.length; i++){
        var subelementos = elementos[i].split('-_-');

        if(subelementos[Cnt_Nombre_Categoria_Info_Evento] != undefined ||
        subelementos[Cnt_Nombre_Subcategoria_Info_Evento] != undefined ||
        subelementos[Cnt_Nombre_Año_Academico_Info_Evento] != undefined){
          textoHtml +=  '<tr>'+
                          '<td>'+subelementos[Cnt_Nombre_Categoria_Info_Evento]+'</td>'+
                          '<td>'+subelementos[Cnt_Nombre_Subcategoria_Info_Evento]+'</td>'+
                          '<td>'+subelementos[Cnt_Nombre_Año_Academico_Info_Evento]+'</td>'+
                        '</tr>';
        }
      }

      textoHtml += '</tbody>'+
                  '</table>';

      $("#secIdLineaDeTiempoEvento").html(textoHtml);

    }

    ActualizarSeccionCarrusel();    
    ActualizarSeccionNoticias();
    ActualizarSeccionEnlaces();
    ActualizarSeccionInfoEvento();
  </script>
  <!-- <script src="../../Assets/js/Administrador/AdministracionSeccionNoticias.js"></script>    -->
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
              <li><a href="../../../SGE_V1/Vista/General/Eventos_SR.php">Eventos</a></li>
              <li><a href="../../../SGE_V1/Vista/General/QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a></li>
          </ul>
        </div>

        <div class="col-xs-6 col-md-3" >
          <ul class="footer-links">
          <li><a href="../../../SGE_V1/Vista/General/Iniciar_Sesion.php">Iniciar sesión</a></li>
          <li style="visibility: hidden;"><a href="../../../../../../Vista/VEvento/Eventos.html">Eventos</a></li>
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
<script src="../../../SGE_V1/Assets/js/General/index_srse.js"></script> 
  <!--TERMINA CONSTRUCCION FOOTER-->
</body>


</html>
<?php
}
?>