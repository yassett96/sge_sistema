<?php
session_start();
if( !isset( $_SESSION[ 'SesionAbierta' ] ) || $_SESSION[ 'SesionAbierta' ] ) { 

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


    <link rel="stylesheet" href="../../Assets/css/General/iniciar_sesion.css">

    
    <title>Iniciar sesión</title>
</head>
<body>  
    <header>
    <div class="logo">
        <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
    </div>
    </header> 
    <img src="../../Assets/imagenes/Recursos/mosaico1.png" id="mosaicoDER" height="180px" width="180px">
    <div class="nav-link active">
        <a id="texto_atras" href="javascript:history.back()"> << Atrás  </a>
    </div>      
    <h4 class="h4">Bienvenido/a</h4>
    <h4 class="h4">Ingrese los datos para iniciar sesión</h4>
    <div class="alert alert-info" id="mensaje">
        Verificar sus datos antes de seleccionar el tipo de acceso.
    </div>  
    <form method="POST" id="formulario">  
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" id="paramostrar" href="#pestaña1" onclick="ValidarPestaña(1)">Personal académico</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="paraocultar" href="#pestaña2" onclick="ValidarPestaña(2)">Participante</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ocultar" href="#pestaña3" onclick="ValidarPestaña(3)">General</a>
            </li>
        </ul>  
        
            <div class="secciones">
                <article id="pestaña1">                                              
                <div class="grupo"> 
                    <img class="iconos" src="../../Assets/imagenes/Recursos/usuario.png" alt="">
                    <input type="hidden" name="accionD" id="accionD" value="login">
                    <div id="msgU-error"> </div>
                    <input type="text" name="usuarioD" id="usuarioD" oninput="Ocultarmensaje()" required>
                    <label>Usuario</label>
                </div>               
                <div class="grupo">
                    <img class="iconos" src="../../Assets/imagenes/Recursos/contraseña.png" alt="">
                    <span><img class="M1" src="../../Assets/imagenes/Recursos/Visto.png" ></span>
                    <div id="msgC-error"> </div>
                    <input type="password" name="contraD" id="contraD" oninput="Ocultarmensaje()" required>
                    <label>Contraseña</label>
                </div>
                <div>
                   <button id="botonV" type="submit" class="BotonVerificar"> Verificar datos</button>
                </div>
                <div class="grupo">
                    <img class="iconoacceso" src="../../Assets/imagenes/Recursos/acceso.png" alt="">
                    <div id="msgS-error"> </div>
                    <select class="form-select" id="menuAcceso" name="menuAcceso" aria-label="Default select example" onselect="Ocultarmensaje()" required disabled>
                    <option value="" selected>Seleccione tipo de acceso</option>   
                  </select> 
                </div>                  
                <div>
                    <button id="botonIS" type="submit" class="BotonIniciarSesionDocente" disabled>Iniciar sesión</button>
                </div>
                <a class="nav-link active" id="formulario_abajoD" href="CorreoRecuperacion.html">¿Olvidó su contraseña?</a>
                <a class="nav-link active" id="formulario_abajo2D" href="">Regresar a inicio</a>  
                </article>    
            </div>

            <div class="secciones">
                <article id="pestaña2">            
                <div class="grupo">            
                    <img class="iconos" src="../../Assets/imagenes/Recursos/usuario.png" alt="">
                    <input type="hidden" name="accionE" id="accionE" value="loginE">
                    <div id="msgUE-error"> </div>
                    <input type="text" name="usuarioE" id="usuarioE" oninput="Ocultarmensaje()" required>
                    <label>Usuario</label>                    
                </div> 
                <div class="grupo">
                    <img class="iconos" src="../../Assets//imagenes/Recursos/contraseña.png" alt="">
                    <span><img class="M1 M2" src="../../Assets//imagenes/Recursos/Visto.png" ></span>
                    <div id="msgCE-error"> </div>
                    <input type="password" name="contraE" id="contraE" oninput="Ocultarmensaje()" required>
                    <label>Contraseña</label>
                </div>              
                <div>   
                    <button type="submit" id="buttonIS2" class="BotonIniciarSesionP"> Iniciar sesión</button> 
                </div>
                <div class="h6_textopequeño">
                    <h6>O</h6>
                </div>
                <div>
                    <button class="BotonRegistrarse"> <a class="nav-link active" id="enlace_registro" href="../../Vista/General/RegistroEstudiante.php"> Registrarse</a></button>
                </div>
                <a class="nav-link active" id="formulario_abajo" href="CorreoRecuperacion.html">¿Olvidó su contraseña?</a>
                <a class="nav-link active" id="formulario_abajo2" href="">Regresar a inicio</a>
                </article>
            </div>

            <div class="secciones">
                <article id="pestaña3">               
                <div class="grupo">
                    <img class="iconos" src="../../Assets//imagenes/Recursos/usuario.png" alt="">
                    <input type="hidden" name="accionG" id="accionG" value="loginG">
                    <input type="text" name="usuarioG" id="usuarioG" required>
                    <label>Usuario</label>
                </div> 
                <div class="grupo">
                    <img class="iconos" src="../../Assets//imagenes/Recursos/contraseña.png" alt="">
                    <span><img class="M1 M3 " src="../../Assets//imagenes/Recursos/Visto.png" ></span>
                    <input type="password" name="contraG" id="contraG" required>
                    <label>Contraseña</label>
                </div>             
                <div>                
                    <button type="submit" class="BotonIniciarSesion">Iniciar sesión</button>
                </div>
                <div class="h6_textopequeño">
                    <h6>O</h6>
                </div>
                <div>
                    <button class="BotonRegistrarse"> <a class="nav-link active" id="enlace_registro" href="RegistroGeneral.html">Registrarse</a></button>
                </div>
                <a class="nav-link active" id="formulario_abajo" href="CorreoRecuperacion.html">¿Olvidó su contraseña?</a>
                <a class="nav-link active" id="formulario_abajo2" href="">Regresar a inicio</a> 
                </article>
            </div>
    </form>
    <img src="../../Assets/imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">     
  
    <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/iniciar_sesion.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/login.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    
    
    <br> <br> <br>

     <!--Footer main -->    
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
            <li><a href="">Eventos</a></li>
            <li><a href="">¿Qué es SGE-FCYS?</a></li>
            </ul>
          </div>
          
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text"> &copy; Universidad nacional de ingeniería 2022 </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="global" href="#"><i class="fa fa-globe"></i></a></li>
             
            </ul>
          </div>
        </div>
      </div>
    </footer>

          
</body>
</html>


<?php 
} 
    else {
        
        
        if ($_SESSION['Participantes']['ID_Tipo_Usuario']  == 1){
            
            header('Location: ../../Vista/Participante/InicioParticipanteSinEvento.php');

        }else if($_SESSION['PersonaAcademica']['ID_Tipo_Usuario']  == 6){

            header('Location: ../../Vista/Administrador/InicioAdministradorCE.php');//Aqui lo redireccionas al lugar que quieras.
        
        }else if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] == 3){
            header('Location: ../../Vista/Academico/InicioPersonalAcademico.php');
            
        }else if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] == 4){
            header('Location: ../../Vista/Coordinador/IndexCoordinadorSE.php');
            
        }else if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] == 2){
            header('Location: ../../Vista/Jurado/InicioJurado.php');
            
        }

        die();
    }
?>