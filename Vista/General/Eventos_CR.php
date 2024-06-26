<?php
    require_once ("../../Controlador/General/CEvento_CR.php");

    $VerificarExistenciaEvento = FunVerificarExistenciaEventoSegunAñoActual();  
    if($VerificarExistenciaEvento != CteExisteEventoEnAñoActual){
        
        header('Location: ../../Vista/General/Evento_SR.php');//Aqui lo redireccionas al lugar que quieras.    
    }else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../../Assets/imagenes/Recursos/Logo_UNI.png" height="30px" width="30px">
    <link rel="stylesheet" href="../../Assets/css/General/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/herramientas/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../../Assets/css/General/evento_SR.css">   
   
    <title>Eventos SGE-FCYS</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
        </div>
        <div class="menu_general">
            <ul class="nav justify-content-end">
                <li class="nav-item"><a class="nav-link active" id="texto" href="../../index_SRSE.php" >Inicio</a></li>
                <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/General/Eventos_CR.php">Eventos</a></li>
                <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/General/QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a></li>
                <button><a href="../../Vista/General/Iniciar_Sesion.php" id="texto">Iniciar sesión</a></button>
            </ul>
        </div>

     <!--Inicia el menu movil-->
        <div class="main-header">
            
            <nav id="nav" class="main-nav">
              <div class="nav-links">
                <a class="link-item"  href="../../index_SRSE.php" >Inicio</a>
                <a class="link-item"  href="../../Vista/General/Eventos_CR.php">Eventos</a>
                <a class="link-item"  href="../../Vista/General/QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a>
                <button><a href="../../Vista/General/Iniciar_Sesion.php" id="texto">Iniciar sesión</a></button>
              </div>
            </nav>
            <button id="button-menu" class="button-menu">
              <span></span>
              <span></span>
              <span></span>
            </button>
        </div>

    </header>
    <img src="../../Assets/imagenes/Recursos/mosaico1.png" id="mosaicoDER" >

    <h4 class="evento">Feria Actual</h4>
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

    <!--<div class="divTreePoints">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
    </div> -->
    <br> 
    <!--========== FIN CARRUSEL ========== -->

    <!--========== Inicio datos historicos ========== -->
    <div class= "contenedor">
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#pestaña1" >Feria</a>
            </li>
            <li class="nav-item">
                <a class="nav-link cat" href="#pestaña2" >Proyectos inscritos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link cat" href="#pestaña3" >Categorias</a>
            </li>
        </ul>  
        
            <div class="secciones">
                <article id="pestaña1">                                                              
                    <div class="grupo"> 
                        <h5>Nombre evento:</h5>
                        <h6> <?php echo $datosf['Nombre_Evento'] ?> </h6>
                        <br>
                        <h5>Eslogan:</h5>
                        <h6> <?php echo $datosf['Eslogan'] ?> </h6>
                        <br>
                        <h5>Hora:</h5>
                        <h6> <?php echo $datosf['hora'] ?> </h6>
                        <br>
                        <h5>Fecha:</h5>
                        <h6> <?php echo $datosf['Fecha'] ?> </h6>
                        <br>
                        <h5>Lugar:</h5>
                        <h6> <?php echo $datosf['Nombre_Sitio'] ?> </h6>
                    </div>                        
                </article>    
            </div>

            <div class="secciones">
                <article id="pestaña2">      
                    <div id="tabla-div t">      
                    <div class="scroll-div">
                        <table id="tproyecto">
                            <thead>
                                <tr>
                                    <th>Categoria</th>
                                    <th class="th">Proyectos inscritos</th>
                                    
                                </tr>
                            </thead>

                        <?php
                        while($mostrar = mysqli_fetch_array($datosp)){
                        ?>
                        <tbody>
                            <tr>
                            <td> <?php echo $mostrar['Nombre_Categoria']?> </td>
                            <td class="td"> <?php echo $mostrar['Proyectos']?> </td>
                            </tr>
                        </tbody>
                        <?php
                            }
                        ?>

                        </table>
                    </div>
                    </div>                   
                </article>
            </div>

            <div class="secciones">
                <article id="pestaña3">               
                <div id="tabla-div">
                <div class="scroll-div">
                    <table>
                      <tr>
                       <th scope = "row">Categoria</th>
                       <th>Sub-Categoria</th>     
                      </tr>
                    
                      <?php
                        while($lista = mysqli_fetch_array($datosc)){
                      ?>

                      <tr>
                        <th> <?php echo $lista['Nombre_Categoria']?> </th>
                        <td> <?php echo $lista['subcategoria']?> </td>
                      </tr>

                      <?php
                      }
                      ?>

                    </table>
                </div>
                </div> 
            
                </article>
            </div>
    </div>
    <br> <br> <br>

        <h4 class="h4">Historia de los eventos</h4>
        <br>
        <div class="cuadro_fondo2">
            <p class="cuadro">La Facultad de Ciencias y Sistemas ha gestionado de diferentes maneras estos
                eventos, desde la apertura de las ferias, siendo la primera realizada en 1999,
                hasta la más reciente efectuada en el 2019, asi como la creación del Primer 
                Congreso Nacional de Ingeniería de Sistemas realizado en el año 2017, y el
                desarrollo de foros, siendo el Primer Foro Nacional de Matemática realizado 
                en el año 2009.
            </p>
        </div>
        
        <img src="../../Assets/imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px"> 
        
        <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>
        <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
        <script src="../../Assets/js/General/menu_movil.js"></script>
        <script src="../../Assets/js/General/evento_sr.js"></script> 
        <script src="../../Assets/js/General/Constanst.js"></script>
        <script src="../../Assets/js/General/helperjs.js"></script>

        <script>
          function ActualizarSeccionCarrusel(){
              var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionCarruselEvento.php?vparBoolObtenerListaImagenesCarruselEvento=" + Cnt_Obtener_Informacion_Imagenes_Carrusel_Evento);
          
              var elementos = vlocResultadoAjax.split(';');

              for (i=0; i<elementos.length; i++){
                  var subelementos = elementos[i].split('-_-');
                  
                  if (i == 0){
                  
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
          ActualizarSeccionCarrusel();
        </script>
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
            <li><a href="../../index_SRSE.php">Inicio</a></li>
                <li><a href="../../Vista/General/Eventos_CR.php">Eventos</a></li>
                <li><a href="../../Vista/General/QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <ul class="footer-links">
            <!--<li><a href="../../index.php">Mi cuenta</a></li>
            <li><a href="../../Vista/VEvento/Eventos.html">Eventos</a></li>-->
            <li><a href="../../Vista/General/Iniciar_Sesion.php">Iniciar sesión</a></li>
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