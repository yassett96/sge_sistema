<?php
  require_once ("../../Controlador/General/CUsuario.php"); 
  require_once ("../../Controlador/Jurado/CResultadosEvaluaciones.php"); 
  require_once(dirname(__FILE__, 3)."/Controlador/General/CEvento.php");    
  require_once ("../../Controlador/General/helper.php"); 
  require_once ("../../Modelo/Administrador/MTipoU.php");
  require_once("../../Controlador/Participante/CInscripcionEventoFeria.php");
  require_once ("../../Assets/AuxiliarPhp/Constants.php");

  session_start();

  if (!isset($_SESSION['PersonaAcademica']) or $_SESSION['PersonaAcademica']['ID_Tipo_Usuario']  != "2")   {
    header('Location: ../index.html');//Aqui lo redireccionas al lugar que quieras.
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

$TiUs = new TipoUModel();

$listaSelectTipoUsuario = $TiUs->select_tipoU_AdminUsuarios();
$listaGradoAcademico = $TiUs->FunObtenerListaGradoAcademico();
$listaRoles = $TiUs->FunObtenerListaRoles();
$listaSedes = $TiUs->FunObtenerSedes();
$listaGrupos = FuncObtenerListaGrupos();

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

  <link rel="stylesheet" href="../../Assets/css/Jurado/GenerarResultados.css">
  
  <title>Generar resultados</title>
</head>
<body>
    <header>
        <div>    
          <div class="logo">
            <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">            
          </div>
          <ul class="nav justify-content-end" id="ulNavHeader">
            <li><a class="nav-link" id="texto" href="../../Vista/Jurado/InicioJurado.php" >Inicio</a></li>
            <!-- <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/Eventos_ASE.php">Eventos</a></li> -->
            <!-- <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/QueEs_InfoSisA.php">¿Qué es SGE-FCYS?</a></li>             -->
            <li><a class="nav-link" id="texto" href="../../Vista/Jurado/ResultadosEvaluaciones.php">Evaluaciones</a></li>            
          </ul>                    
          <section id= "sectionCentralizarLogoNombre">
            <img id="imgLogUsuario" class="imgLogUsuarioClass" src="<?php echo $_SESSION['Avatar']; ?>">  
            <br>
            <a id="aNombreUsuario"><?php echo $_SESSION['NombreCompleto']; ?></a>
          </section>                            
          <div id="divMenuDespliegue">              
            <a class="nav-link " href="../../Vista/Jurado/MiCuenta_CE.php">Mi cuenta</a>            
            <a class="nav-link " id="aCerrarSesion" href="../../Controlador/General/CCerrarSesion.php">Cerrar sesión</a>
          </div>
        </div>
        
        <!--Inicio Menu Móvil-->
        <div class="main-header">          
            <nav id="nav" class="main-nav" >            
              <div class="nav-links"> 
                <img id="imgLogUsuarioMovil" src="<?php echo $_SESSION['Avatar'] ?>">                                  
                <div class="Nombreusuario"><?php echo $_SESSION['NombreCompleto']; ?></div>
                <a class="link-item"  href="../../Vista/Jurado/InicioJurado.php" >Inicio</a>
                <a class="link-item"  href="../../Vista/Jurado/ResultadosEvaluaciones.php">Evaluaciones</a>
                <!-- <a class="link-item"  href="../../Vista/Administrador/QueEs_InfoSisA.php">¿Qué es SGE-FCYS?</a> -->
                <a class="link-item"  href="../../Vista/Jurado/MiCuenta_CE.php">Mi cuenta</a>             
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

    <h1 id="h1TextoInicial">Generar resultados</h1>
    
    <br>    

    <br><br>    

      <!-- INICIO TABLA -->
      <div id="idDivTabla">
        <h2 id="idTextoTabla">Proyectos ganadores</h2>

        <br>
        
        <h4 id="h4textoSubCate">Seleccione la sub categoría para presentar los ganadores</h4>
        <br>
        <h3 class="h3CamposTabla">Sub categoría: </h3>
        <select id="idSelectSubCat">            
        </select>

        <br><br><br>

        <section id="idSectionEnunciado">
            <h4 id="h4TextoEnunciado">Nosotros, miembros del jurado evaluador de la sub categoría: ____, después de haber analizado todos los proyectos, según los criterios técnicos definidos por el comité organizador de la feria científica y tecnología <span id="año"></span>, se declara como proyecto ganador a:</h4>
        </section>

        <br>
        <h3 class="h3CamposTabla">Primer lugar</h3>
        <br>
        <div class="table-container">
          <table id="idTable">
            <thead>
              <tr>
                <th>Proyecto</th>
                <th>Integrante 1</th>
                <th>Integrante 2</th>
                <th>Integrante 3</th>
                <th>Tutor</th>
                <th>Puntaje</th>
              </tr>
            </thead>
            <tbody id="idTBodyPrimerLugar">
              
            </tbody>
          </table>
        </div>

        <br>
        <h3 class="h3CamposTabla">Segundo lugar</h3>
        <br>
        <div class="table-container">
            <table id="idTable">
                <thead>
                    <tr>
                      <th>Proyecto</th>
                      <th>Integrante 1</th>
                      <th>Integrante 2</th>
                      <th>Integrante 3</th>
                      <th>Tutor</th>
                      <th>Puntaje</th>
                    </tr>
                </thead>
                <tbody id="idTBodySegundoLugar">
                </tbody>
            </table>
        </div>
        <br>
        <button target="_blank" href="../../Assets/herramientas/dompdf/autoload.inc.php" class="classBotonAccion" id="idBotonGenerarGanadores">Generar reporte</button>        
      </div>

      <br>

      <!-- FIN TABLA -->

      <br>
      <br>      
    
    <img src="../../Assets/Imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">                               

   <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>       
   <script src="../../Assets/js/General/helperjs.js"></script>
   <script src="../../Assets/js/General/Constanst.js"></script>
   <script src="../../Assets/js/Jurado/GenerarResultados.js"></script>       

    <!--INICIA CONSTRUCCION FOOTER-->
    
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
              <li><a href="../../Vista/Jurado/InicioJurado.php">Inicio</a></li>
              <!-- <li><a href="../../Vista/Administrador/Eventos_ASE.php">Eventos</a></li> -->
              <li><a href="../../Vista/Jurado/ResultadosEvaluaciones.php">Evaluaciones</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <ul class="footer-links">
              <li><a href="../../Vista/Jurado/MiCuenta_CE.php" style="visibility:hidden;">Mi cuenta</a></li>
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