<?php
  require_once ("../../Controlador/General/CUsuario.php"); 
  require_once(dirname(__FILE__, 3)."/Controlador/General/CEvento.php");  
  require_once ("../../Controlador/General/helper.php"); 

  session_start();

  //Para verificar la existencia del evento segun el año el actual
  $vlocResultadoVerificacionExistenciaEvento = FunVerificarExistenciaEventoSegunAñoActual();    
  // echo "Prueba Samir: ".$vlocResultadoVerificacionExistenciaEvento[0];
  // exit;

  if($vlocResultadoVerificacionExistenciaEvento == CteExisteEventoEnAñoActual){
    header('Location: ../../Vista/Participante/InicioParticipanteConEvento.php');//Aqui lo redireccionas al lugar que quieras.            
    die();
  }
  
  //Para verificar si el participante inicio sesión
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

    <link rel="stylesheet" href="../../Assets/herramientas/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../../Assets/css/Participante/inicioParticipanteSinEvento.css">
    
   <title>Inicio Participante CE</title>
</head>
<body>
    <header>
      <div>    
        <div class="logo">
          <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">            
        </div>
        <ul class="nav justify-content-end" id="ulNavHeader">
          <li ><a class="nav-link" id="texto" href="../../Vista/Participante/inicioParticipanteSinEvento.php" >Inicio</a></li>
          <li ><a class="nav-link" id="texto" href="../../Vista/Participante/Eventos_PSE.php">Eventos</a></li>
          <li ><a class="nav-link" id="texto" href="../../Vista/Participante/QueEs_InfoSisP.php">¿Qué es SGE-FCYS?</a></li>            
        </ul>                    
        <section id= "sectionCentralizarLogoNombre">
          <img id="imgLogUsuario" class="imgLogUsuarioClass" src="<?php echo $_SESSION['Avatar']; ?>">  
          <br>
          <a id="aNombreUsuario"><?php echo $_SESSION['NombreCompleto']; ?></a>
        </section>                            
        <div id="divMenuDespliegue">              
          <a class="nav-link " href="../../Vista/Participante/MiCuenta_SE_v.php">Mi cuenta</a>
          <a class="nav-link " id="aCerrarSesion" href="../../Controlador/General/CCerrarSesion.php">Cerrar sesión</a>
        </div>
      </div>
      
      <!--Inicio Menu Móvil-->
      <div class="main-header">          
          <nav id="nav" class="main-nav" >            
            <div class="nav-links"> 
              <img id="imgLogUsuarioMovil" src="<?php echo $_SESSION['Avatar'] ?>">                                  
              <div class="Nombreusuario"><?php echo $_SESSION['NombreCompleto']; ?></div>
              <a class="link-item"  href="../../Vista/Participante/inicioParticipanteSinEvento.php" >Inicio</a>
              <a class="link-item"  href="../../Vista/Participante/Eventos_PSE.php">Eventos</a>
              <a class="link-item"  href="../../Vista/Participante/QueEs_InfoSisP.php">¿Qué es SGE-FCYS?</a>    
              <a class="link-item" id="link-item-session2" href="../../Controlador/General/CCerrarSesion.php" >Cerrar sesión</a>
              <!-- <a class="link-item"  href=".../../Vista/Participante/MiCuenta_SE_v.php">Mi cuenta</a>              -->
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

    <!--=== INICIO ENCABEZADOS ===-->    
    <br><br>              

    <div id="divTituloInicial">
      <p class="pTituloInicial"> Facultad de Ciencias y Sistemas </p>      
    </div>
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

<!--========== INICIO LINEA DE TIEMPO DEL EVENTO ======= -->
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
<!--========== FIN LINEA DE TIEMPO DEL EVENTO ======= -->
   
   <!--Se ocupa este porque básicamente tiene los mismos componentes y evitar más código innecesario-->
   <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   <script src="../../Assets/js/General/helperjs.js"></script>
   <script src="../../Assets/js/General/Constanst.js"></script>
   <script src="../../Assets/js/Participante/inicioParticipanteConEvento.js"></script>
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
              <li><a href="../../Vista/Participante/inicioParticipanteSinEvento.php">Inicio</a></li>
              <li><a href="../../Vista/Participante/Eventos_PSE.php">Eventos</a></li>
              <li><a href="../../Vista/Participante/QueEs_InfoSisP.php">¿Qué es SGE-FCYS?</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <ul class="footer-links">
              <li><a href="../../Vista/Participante/MiCuenta_SE_v.php">Mi cuenta</a></li>
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
    <!--TERMINA CONSTRUCCION FOOTER-->

</body>

</html>