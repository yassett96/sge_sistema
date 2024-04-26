<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

require_once ("../../Controlador/Coordinador/CEvento_CoordinadorCE.php");
require_once ("../../Controlador/General/CEvento.php");

$VerificarExistenciaEvento = FunVerificarExistenciaEventoSegunAñoActual();  
if($VerificarExistenciaEvento != CteExisteEventoEnAñoActual){    
  header('Location: ../../Vista/Coordinador/IndexCoordinadorSE.php');//Aqui lo redireccionas al lugar que quieras.    
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

  <link rel="stylesheet" href="../../Assets/css/Coordinador/IndexCoordinadorCE.css">

  <!-- Incluir SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
  
  <title>Inicio Coordinador CE</title>
</head>
<body>
    <header>
        <div>    
          <div class="logo">
            <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">            
          </div>
          <ul class="nav justify-content-end" id="ulNavHeader">
            <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Coordinador/IndexCoordinadorCE.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link active" id="texto"  href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a></li>
            <li class="nav-item"><a class="nav-link active" id="texto"  href="../../Vista/Coordinador/AdminEventosCE.php">Administración de eventos</a></li>
            <li class="nav-item"><a id="textoC" href="">Comisiones </a>
                    <ul>
                        <a id="FondoNav" href="../../Vista/Coordinador/ComisionAsignada.php">Comisión asignada</a>
                        <a id="FondoNav" href="../../Vista/Coordinador/ComisionesGenerales.php">Comisiones generales</a>
                    </ul>
            </li>
            <li class="nav-item"><a class="nav-link active" id="texto"  href="../../Vista/Coordinador/Reportes.php">Reportes</a></li>           
          </ul>                    
          <section id= "sectionCentralizarLogoNombre">
            <img id="imgLogUsuario" class="imgLogUsuarioClass" src="<?php echo $_SESSION['Avatar']; ?>">  
            <br>
            <a id="aNombreUsuario"><?php echo $_SESSION['NombreCompleto']; ?></a>
          </section>                            
          <div id="divMenuDespliegue">              
            <a class="nav-link " href="../../Vista/Coordinador/MCuentaCE.php">Mi cuenta</a>
            <a class="nav-link " id="aCerrarSesion" href="../../Controlador/General/CCerrarSesion.php">Cerrar sesión</a>
          </div>
        </div>
        
        <!--Inicio Menu Móvil-->
        <div class="main-header">          
            <nav id="nav" class="main-nav" >            
              <div class="nav-links"> 
                <img id="imgLogUsuarioMovil" src="<?php echo $_SESSION['Avatar'] ?>">                                  
                <div class="Nombreusuario"><?php echo $_SESSION['NombreCompleto']; ?></div>
                <a class="link-item" href="../../Vista/Coordinador/IndexCoordinadorCE.php">Inicio</a>
                    <a class="link-item" href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a>
                    <a class="link-item" href="../../Vista/Coordinador/AdminEventosCE.php">Administración de Eventos</a>
                    <a class="link-item" href="../../Vista/Coordinador/ComisionAsignada.php">Comisión asignada</a>
                    <a class="link-item" href="../../Vista/Coordinador/ComisionesGenerales.php">Comisiones generales</a>
                    <a class="link-item" href="../../Vista/Coordinador/Reportes.php">Reportes</a>
                    <a class="link-item" href="../../Vista/Coordinador/MCuentaCE.php">Mi cuenta</a>
                    <a class="link-item" href='../../Controlador/General/CCerrarSesion.php'>Cerrar sesión</a>
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
      <img class="linkUni" rel="icon" src="../../../SGE_V1/Assets/imagenes/Recursos/Logo_UNI.png" height="25px" width="30px">
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

   <br><br><br><br><br><br>
    <div id="fondo">
      <p id="h1_tituloinicio"> <span>Sistema de</span> Gestión de Eventos FCYS</p>
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
      <br>
      <br>
      <br>

      <div id="divTituloInicial">
        <!-- <p class="pTituloInicial"> Feria de Ciencia y Tecnología </p> -->
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

    <!--=== FIN ENCABEZADOS ===-->    

<!--========== INICIO NOTICIAS ======= -->
<div id="div_Contenedor_Noticias">
  <div id="div_Contenedor_Noticia_Principal">
      <img src="">
      <br><br><br><br>
      <h3></h3>
      <h5></h5>
      <div class="div_Animacion" id="divTituloNoticiaPrincipal"><h3 style="color:white;" class="h3_Titulo_Noticia"></h3></div>
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

<!--========== FIN NOTICIAS ======= -->

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
   <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Incluir SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
   <script src="../../Assets/js/General/helperjs.js"></script>
   <script src="../../Assets/js/General/Constanst.js"></script>
   <script src="../../Assets/js/General/temporizador.js"></script> 
   <script src="../../Assets/js/Coordinador/IndexCoordinadorCE.js"></script>   
   <script>
    function ActualizarSeccionNoticias(){
      
      var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionSeccionNoticias.php?vparBoolObtenerListaNoticias=" + Cnt_Obtener_Informacion_Noticias);
  
      var elementos = vlocResultadoAjax.split(';');
  
      for (i=0; i<elementos.length; i++){
        var subelementos = elementos[i].split('-_-');
        
        if (i == 0){
          var urlModificado = subelementos[Cnt_Posicion_Url_Imagen];
          $(".h3_Titulo_Noticia:eq(0)").html(subelementos[Cnt_Posicion_Descripcion]);
          $("#div_Contenedor_Noticia_Principal img").attr('src', urlModificado);
        }

        if (i == 1){
          var urlModificado = subelementos[Cnt_Posicion_Url_Imagen];
          $(".h3_Titulo_Noticia:eq(1)").html(subelementos[Cnt_Posicion_Descripcion]);
          $("#div_Noticia_Secundario img").attr('src', urlModificado);
        }

        if (i == 2){
          var urlModificado = subelementos[Cnt_Posicion_Url_Imagen];
          $(".h3_Titulo_Noticia:eq(2)").html(subelementos[Cnt_Posicion_Descripcion]);
          $("#div_Noticia_Terciario img").attr('src', urlModificado);
        }  
      }
    }
    
    ActualizarSeccionNoticias();

    ActualizarSeccionEnlaces();       
  
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

      ActualizarSeccionInfoEvento();

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
  </script>

    <!--INICIA CONSTRUCCION FOOTER-->
    
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
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
            <li><a href="../../Vista/Coordinador/IndexCoordinadorCE.php">Inicio</a></li>
                <li><a href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a></li>
                <li><a href="../../Vista/Coordinador/AdminEventosCE.php">Administración de eventos</a></li>
                <li><a href="../../Vista/Coordinador/MCuentaCE.php">Mi cuenta</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <ul class="footer-links">
              <li><a href="../../Vista/Coordinador/ComisionAsignada.php">Comisión asignada</a></li>
            <li><a href="../../Vista/Coordinador/ComisionesGenerales.php">Comisiones generales</a></li>
            <li><a href="../../Vista/Coordinador/Reportes.php">Reportes</a></li>
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