<?php
  require_once ("../../Controlador/General/CUsuario.php"); 
  require_once ("../../Controlador/Administrador/CAdministracionPersonalAcademico.php"); 
  require_once(dirname(__FILE__, 3)."/Controlador/General/CEvento.php");    
  require_once ("../../Controlador/General/helper.php"); 
  require_once ("../../Modelo/Administrador/MTipoU.php");
  require_once ("../../Assets/AuxiliarPhp/Constants.php");

  session_start();

  if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario']  != 6)  {

    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
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

$listaGradoAcademico = $TiUs->FunObtenerListaGradoAcademico();
$listaCargos = $TiUs->FunObtenerListaCargos();
$listaSedes = $TiUs->FunObtenerSedes();

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

  <link rel="stylesheet" href="../../Assets/css/Administrador/AdministracionPersonalAcademico.css">
  
  <title>Administración personal académico</title>
</head>
<body>
    <header>
        <div>    
          <div class="logo">
            <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">            
          </div>
          <ul class="nav justify-content-end" id="ulNavHeader">
            <li><a class="nav-link" id="texto" href="../../Vista/Administrador/InicioAdministradorCE.php" >Inicio</a></li>
            <!-- <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/Eventos_ASE.php">Eventos</a></li> -->
            <!-- <li ><a class="nav-link" id="texto" href="../../Vista/Administrador/QueEs_InfoSisA.php">¿Qué es SGE-FCYS?</a></li>             -->
            <li><a class="nav-link" id="texto" href="../../Vista/Administrador/PanelAdministrador.php">Panel admin</a></li>            
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
                <!-- <a class="link-item"  href="../../Vista/Administrador/QueEs_InfoSisA.php">¿Qué es SGE-FCYS?</a> -->
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
    
    <img src="../../Assets/Imagenes/Recursos/mosaico1.png" id="mosaicoDER" height="180px" width="180px">

    <h4 id="h4Atras" ><a id="aAtras"><< Atrás</a></h4>

    <br>

    <h1 id="h1TextoInicial">Administración personal académico</h1>
    
    <br><br><br>
    
    <input type="Text" id="idSelectBusquedaPA" placeholder="Buscar personal académico" ></input>

    <br><br>

      <!-- INICIO TABLA -->
      <div id="idDivTabla">
        <h2 id="idTextoTabla">Seleccione el personal académico que desea administrar</h2>

        <br>

        <div class="table-container">
          <table id="idTable">
            <thead>
              <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Grado académico</th>
                <th>Cargo</th>
                <th>Sede</th>
                <th>Teléfono</th>
                <th>Correo Electrónico</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $vlocArrayListaPersonalAcademico = FunObtenerListaPersonalAcademico();
                $vlocListaPersonalAcademico = implode(',', $vlocArrayListaPersonalAcademico);
                echo $vlocListaPersonalAcademico;
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <br>

      <!-- FIN TABLA -->

      <!-- INICIO BOTONES ACCIONES -->

      <div id="idDivBotonesAcciones">
        <button class="classBotonAccion" id="idBotonEliminar">Eliminar PA</button>
        <button class="classBotonAccion" id="idBotonEditar">Editar PA</button>
        <button class="classBotonAccion" id="idBotonCrear">Crear PA</button>
      </div>
      <br>
      <br>

      <!-- FIN BOTONES ACCIONES -->
      <!-- Inicio PopUp Editar -->
      <div id="divFondoPopUpEditar">
        <div id="divPopUpEditar">
          <h1 id="textoEncabezadoPopUpEditar">Editar Personal Académico</h1>
          <br>
          <section id="popUpEditarCampo1" class="popUpEditarCampos">
            <h5 class="h5TextosPopUpEditar">Nombre y Apellidos</h5>
            <input type="text" value="Nombre y apellidos" class="camposPopUpEditar" disabled>
          </section>
          <section id="popUpEditarCampo2" class="popUpEditarCampos">
            <h5 class="h5TextosPopUpEditar">Teléfono</h5>
            <input type="text" value="Teléfono" class="camposPopUpEditar" id="telefonoEditar">
          </section>
          <section id="popUpEditarCampo3" class="popUpEditarCampos">
            <h5 class="h5TextosPopUpEditar">Email</h5>
            <input type="text" value="Email" class="camposPopUpEditar">
          </section>
          <section id="popUpEditarCampo4" class="popUpEditarCampos">
            <h5 class="h5TextosPopUpEditar">Grado académico</h5>
            <select class="camposPopUpEditar">
              <?php echo $listaGradoAcademico; ?>
            </select>
          </section>
          <section id="popUpEditarCampo5" class="popUpEditarCampos">
            <h5 class="h5TextosPopUpEditar">Cargo</h5>
            <select class="camposPopUpEditar">
              <?php echo $listaCargos; ?>
            </select>
          </section>
          <section id="popUpEditarCampo6" class="popUpEditarCampos">
            <h5 class="h5TextosPopUpEditar">Sede</h5>
            <select class="camposPopUpEditar">
              <?php echo $listaSedes; ?>
            </select>
          </section>

          <br>

          <button class="botonesPopUpEditar" id="buttonGuardarCambiosPopUpEditar">Guardar cambios</button>
          <button class="botonesPopUpEditar" id="buttonCancelarPopUpEditar">Cancelar</button>          
        </div>
      </div>
      <!-- Fin PopUp Editar -->
    
    <img src="../../Assets/Imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">                           

    

   <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>       
   <script src="../../Assets/js/General/helperjs.js"></script>
   <script src="../../Assets/js/General/Constanst.js"></script>
   <script src="../../Assets/js/Administrador/AdministracionPersonalAcademico.js"></script>   

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