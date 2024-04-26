<?php 
  header('Content-Type: text/html; charset=utf-8');
  session_start();


  if(!isset($_SESSION['Participantes']) or $_SESSION['Participantes']['ID_Tipo_Usuario']  != "1"){
    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="../../Assets/imagenes/Recursos/Logo_UNI.png" height="30px" width="30px">

      <link rel="stylesheet" href="../../Assets/css/General/bootstrap.min.css">

      <link rel="stylesheet" href="../../Assets/herramientas/font-awesome-4.7.0/css/font-awesome.min.css">

      <link rel="stylesheet" href="../../Assets/css/Participante/DetallesProyectosInscritos.css">

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <title>Detalles Proyectos</title>
  </head>
  <body>
    <header>
        <div>    
          <div class="logo">
            <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">            
          </div>  
          <ul class="nav justify-content-end" id="ulNavHeader">
            <li class="liNavHeader"><a class="nav-link" id="texto" href="../../Vista/Participante/inicioParticipanteSinEvento.php" >Inicio</a></li>
            <li class="liNavHeader"><a class="nav-link" id="texto" href="../../Vista/Participante/Eventos_PSE.php">Eventos</a></li>
            <li class="liNavHeader"><a class="nav-link" id="texto" href="../../Vista/Participante/QueEs_InfoSisP.php">¿Qué es SGE-FCYS?</a></li>            
          </ul>                    
          <section id= "sectionCentralizarLogoNombre">
            <img id="imgLogUsuario" class="imgLogUsuarioClass" src="<?php echo $_SESSION['Avatar']; ?>">  
            <br>
            <a id="aNombreUsuario"><?php echo $_SESSION['NombreCompleto']; ?></a>
          </section>                            
          <div id="divMenuDespliegue">              
            <a class="nav-link " href="../../Vista/Participante/MiCuenta_CE.php">Mi cuenta</a>
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
    <div id="contenedor"></div>
    <br>

    <div id="divSeccionInicial">
      <h1 id="h1TituloDatosProyectos">Datos proyectos</h1>
      <div id="divSeleccionProyecto">
        <h1 id="h1TextoProyecto">Proyecto:</h1>        
        <select id="selectProyecto" name="proyecto">          
        </select>  
      </div>
    </div>

    <div id="divSeccionFormularioLectura">
      <div id="divSeccionNavegacionFormularioLectura">
        <div class="divPestaña"><h1 id="h1PestañaDatosProyecto">Datos del proyecto</h1></div>
        <div class="divPestaña"><h1 id="h1PestañaIntegrantes">Integrantes</h1></div>
      </div>
      <br>      

      <form id="FormularioDatosProyectos">
        <h2 class="h2LabelsProyectos">Nombre: </h2>
        <br>
        <input type="text" name="nombre_proyecto" id="inputNombreProyecto" class="inputDatosProyecto" placeholder="Nombre del proyecto" disabled>
        <br><br>
        <h2 class="h2LabelsProyectos">Descripción: </h2>
        <br>
        <textarea id="inputDescripcionProyecto" name="descripcion" class="inputDatosProyecto"  disabled></textarea>
        <br><br>
        <h2 class="h2LabelsProyectos">Categoría: </h2>
        <br>
        <input type="text" name="categorias" id="inputCategoria" class="inputDatosProyecto" placeholder="Categorías del proyecto" disabled>
        <br><br>
        <h2 class="h2LabelsProyectos"> Subcategoría: </h2>        
        <br>
        <input type="text" name="sub_categorias" id="inputSubCategoria" class="inputDatosProyecto" placeholder="Subcategorías del proyecto" disabled>
        
        <h2 class="h2LabelsProyectos">Tutor</h2>
        <br>
        <input type="text" name="tutor" id="inputTutor" class="inputDatosProyecto" placeholder="Tutor del proyecto" disabled>
      </form>      

      <form id="FormularioIntegrantes">

        <div class="table-container">
          <table id="idTable">
            <thead>
              <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>N° Carnet</th>
                <th>Grupo</th>
                <th>Año académico</th>
                <th>Sede</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </form>

    </div>
    <br>
    <br>
    <br> 
       
    
    <img src="../../Assets/Imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">                             
    <br> 
    <br>

    <div id="contenedorBotones">
      <button id="enviaconsulta" name="button" class="btn btn-primary">Realizar consulta</button>
      
      <button id="confirmarParticipacion" name="buttonConfirmarParticipacion" class="btn btn-primary">Confirmar participación</button>

      <button id="bajaProyecto" name="buttonBajaProyecto" class="btn btn-primary">Abandonar proyecto</button>
    </div>

    <br>
    <br>
    <br>
        
    <!-- Scripts -->    
    
    <script src="../../Assets/js/General/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>       
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../../Assets/js/General/Constanst.js"></script>                     
    <script src="../../Assets/js/General/helperjs.js"></script> 
    <script src="../../Assets/js/Participante/DetallesProyectosInscritos.js"></script>   
    <script type="text/javascript"  src="../../Assets/js/Participante/Cuenta.js"></script>        

    <!--------------------------------  Apartir de Aqui inicia el footer  ---------------------------------->    
    <footer class="site-footer">
      <div class="container">
        <div class="row" id="divInfoFooter">
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
            <li><a href="../../Vista/Participante/MiCuenta_CE.php">Mi cuenta</a></li>
            <li><a href="../../Vista/Participante/Eventos_PSE.php">Eventos</a></li>
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
  </body>  
</html>