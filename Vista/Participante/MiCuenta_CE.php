<?php

session_start();

require_once ("../../Controlador/Administrador/CCuenta_CE.php");

if (!isset($_SESSION['Participantes']) or $_SESSION['Participantes']['ID_Tipo_Usuario']  != "1")  {


  header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
  die();

}
$VerificarExistenciaEvento = FunVerificarExistenciaEventoSegunAñoActual();  
if($VerificarExistenciaEvento != CteExisteEventoEnAñoActual){
        
    header('Location: ../../Vista/Participante/MICuenta_SE_v.php');//Aqui lo redireccionas al lugar que quieras.    
}else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../../Assets/imagenes/Recursos/ico.png" height="30px" width="30px">
    <link rel="stylesheet" href="../../Assets/css/General/bootstrap.min.css">

    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/herramientas/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../../Assets/css/Participante/Micuenta_ce.css">

    <title>Mi cuenta</title>
</head>
<body>
  <header>
    <div class="logo">
      <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
    </div>
    <div class="menu_general">
      <ul class="nav justify-content-end">
        <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Participante/inicioParticipanteConEvento.php" >Inicio</a></li>
        <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Participante/Eventos_PSE.php">Eventos</a></li>
        <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Participante/QueEs_InfoSisP.php">¿Qué es SGE-FCYS?</a></li>
        
        <!--<div class="modal-footer"><a type="text" class="btn btn-secondary" data-dismiss="modal" href='../Controlador/CLogin/CCerrarSesion.php'>Cerrar sesión</a></div>-->
        <!--<button><a href="../../Vista/VRegistroGeneral/RegistroGeneral.php" id="texto">Iniciar sesión</a></button>-->
          
          
        <div class="dropdown">
          
        <img src="<?php echo $_SESSION['Avatar']; ?>"  class="imgRedonda"/>
        <div class="Nombreusuario"><?php echo $_SESSION['NombreCompleto']; ?></div>
          
        <div class="dropdown-content">
        <a href="../../Vista/Participante/MiCuenta_CE.php">Mi cuenta</a>
        <a href='../../Controlador/General/CCerrarSesion.php'>Cerrar sesión</a>
        </div>
      </div>
      </ul>
        
    </div>

    <!--A partir de aqui inicia el menu movil, pero copiar todo lo contenido en HEADER-->
    <div class="main-header">
      <nav id="nav" class="main-nav">
        <div class="nav-links">
        <img src="<?php echo $_SESSION['Avatar']; ?>"  class="imgRedonda link-item"/>
        <div class="NombreusuarioM"><?php echo $_SESSION['NombreCompleto']; ?></div>
          <a class="link-item"  href="../../Vista/Participante/inicioParticipanteConEvento.php" >Inicio</a>
          <a class="link-item"  href="../../Vista/Participante/Eventos_PSE.php">Eventos</a>
          <a class="link-item"  href="../../Vista/Participante/QueEs_InfoSisP.php">¿Qué es SGE-FCYS?</a>
          <a class="link-item"  href="../../Vista/Participante/MiCuenta_CE.php">Mi cuenta</a>
          <a class="link-item"  href='../../Controlador/General/CCerrarSesion.php'>Cerrar sesión</a>            
        </div>
      </nav>
      <button id="button-menu" class="button-menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </header>
    
    <img src="../../Assets/imagenes/Recursos/mosaico1.png" id="mosaicoDER" height="180px" width="180px">
    <h4 class="h4_2">Mi cuenta</h4>

    <div id="idDivCodigoRegistro">
      <h2 id="idH2CodReg">Código registro</h2>
      
      <input id="idInputCodReg" type="text" value="<?php echo $_SESSION['Cod']; ?>" readonly>
    </div>

    <div class="cuadro_fondo">

    
      <div class="menuimagen">
      <img src="../../Assets/imagenes/Recursos/buscar.png" id="MenuI1" width="130" height="130" >
      <!--<a href="/Actual/pruebaSeleccionAvatar/index.php" target="popup" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"id="botonicono"class="link-item"  ><h5 class="textourl">Editar Icono</h5></a>-->
      
      <div id="contenedor"></div>
      
      </div>

      <div class="menuimagen1">
      <img src="../../Assets/imagenes/Recursos/editar.png" id="MenuI2" width="130" height="130" >
      
      </div>
      <div class="menuimagen2">
      <img src="../../Assets/imagenes/Recursos/reloj.png" id="MenuI3" width="130" height="130" >
      
      </div>
      <button id="editaravatar"name="button">Editar avatar</button>
      <button id="editardatos"name="button">Editar datos</button>
      <button id="historial"name="button">Historial de eventos</button>
        
       
        
        
    </div>

    <!--
    <h4 class="h4_1">Evento actual</h4>
    <div class="card" >
  <div class="card-body">
    <h5 class="card-title">Nombre del Evento:</h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php //echo $_SESSION['NombreEvento']; ?></h6>
    <br>-->
    <!--<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>--><!--
    <h5 class="card-title">Proyecto a Presentar:</h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php //echo $_SESSION['NombreProyecto']; ?></h6>
    <br>
    <h5 class="card-title">Categoria:</h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php //echo $_SESSION['Categoria']; ?></h6>
    <br>
    <h5 class="card-title">Subcategoria:</h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php //echo $_SESSION['Subcategoria']; ?></h6>-->
    <!--<p class="card-text"></p>-->
   
   
    <!--<a href="#" class="btn btn-primary">Realizar consulta</a>-->
    <?php
if(isset($_SESSION['NombreProyecto'])){ 
   if($_SESSION['NombreProyecto'] != ""){
?>
<!--
<button id="enviaconsulta" name="button" class="btn btn-primary">Realizar consulta</button>-->
<?php }}
    ?>
  </div>
</div>

        

     
  <img src="../../Assets/imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">
  <br>
  <br>
  

  <!--El menu movil, requiere que lo contenido en este JS este en el JS de sus vistas-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
  <script type="text/javascript"  src="../../Assets/js/General/jquery.min.js"></script>
  <script type="text/javascript"  src="../../Assets/js/General/menu_movil.js"></script>
  <script type="text/javascript"  src="../../Assets/js/General/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script type="text/javascript"  src="../../Assets/js/General/helperjs.js"></script>
  <script type="text/javascript"  src="../../Assets/js/Participante/Cuenta.js"></script> 
  <!-- <script type="text/javascript" src="../../Assets/js/General/ValidacionesFormulario.js"></script> -->
  <!-- <script type="text/javascript" src="../../Assets/js/Participante/editar_cuenta.js"></script> -->

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
            <li><a href="../../Vista/Participante/inicioParticipanteConEvento.php">Inicio</a></li>
                <li><a href="../../Vista/Participante/Eventos_PSE.php">Eventos</a></li>
                <li><a href="../../Vista/Participante/QueEs_InfoSisP.php">¿Qué es SGE-FCYS?</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <ul class="footer-links">
            <li><a href="../../Vista/Participante/MiCuenta_CE.php">Mi cuenta</a></li>
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
          

          <!--<div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="global" href="#"><i class="fa fa-globe"></i></a></li>
             
            </ul>
          </div>-->
        </div>
      </div>
</footer>


</body>
</html>
<?php
    }
?>
    