<?php
  $mysqli = new mysqli('localhost', 'root', '12345', 'sge_bd', 3306);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/iniciar_sesion.css">
    <link rel="stylesheet" href="../Assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <title>Iniciar Sesión</title>
</head>
<body>  
    <header>
    <div class="logo">
        <img src="../Assets/Imagenes/FCyS balnco.png" height="50px">
    </div>
    </header> 
    <img src="../Assets/Imagenes/mosaico1.png" id="mosaicoDER" height="180px" width="180px">
    <div class="nav-link active">
        <a id="texto_atras" href="index.php" > << Atrás  </a>
    </div>      
    <h4 class="h4">Bienvenido/a</h4>
    <h4 class="h4">Ingrese los datos para iniciar sesión</h4>
    <form action="../Controlador/CInicio_Sesion/CInicio_sesion.php" method="POST">            
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#pestaña1" onclick="ValidarPestaña(1)"><span>Docentes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#pestaña2" onclick="ValidarPestaña(2)">Estudiantes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#pestaña3" onclick="ValidarPestaña(3)">General</a>
            </li>
        </ul>  
        <div class="secciones">
                <article id="pestaña1">                                                
                <div class="grupo">                
                    <img class="iconos" src="../Assets/Imagenes/usuario.png" alt="">
                    <input type="hidden" name="accionD" id="accionD" value="login">
                    <input type="text" name="usuarioD" id="usuarioD" >
                    <label>Usuario</label>
                </div>                
                <div class="grupo">
                    <img class="iconos" src="../Assets/Imagenes/contraseña.png" alt="">
                    <input type="password" name="contraD" id="contraD">
                    <label>Contraseña</label>
                </div>
                <div class="grupo">
                    <img class="iconos" src="../Assets/Imagenes/sede.png" alt="">
                    <select class="form-select" aria-label="Default select example">
                    <option selected>Sede</option>
                    <?php
                         $query = $mysqli -> query ("SELECT * FROM sede");
                         while ($valores = mysqli_fetch_array($query)) {
                           echo '<option value="'.$valores[ID_Sede].'">'.$valores[Sede].'</option>';
                        }
                    ?>           
                  </select> 
                </div>                  
                <div>
                   <button type="submit" class="BotonIniciarSesion"> Iniciar Sesión</button>
                </div>
                <a class="nav-link active" id="formulario_abajo" href="#">¿Olvidó su contraseña?</a>
                <a class="nav-link active" id="formulario_abajo2" href="index.php">Regresar a Inicio</a>    
                </article>    
            </div>     
            <div class="secciones">
                <article id="pestaña2">            
            <div class="grupo">            
                <img class="iconos" src="../Assets/Imagenes/usuario.png" alt="">
                <input type="hidden" name="accionE" id="accionE" value="loginE">
                <input type="text" name="usuarioE" id="usuarioE" >
                <label>Usuario</label>
            </div> 
            <div class="grupo">
                <img class="iconos" src="../Assets/Imagenes/contraseña.png" alt="">
                <input type="password" name="contraE" id="contraE" >
                <label>Contraseña</label>
            </div>              
            <div>   
                <button type="submit" class="BotonIniciarSesion"> Iniciar Sesión</button> 
            </div>
            <div class="h6_textopequeño">
                <h6>O</h6>
            </div>
            <div>
                <button class="BotonRegistrarse"> <a class="nav-link active" id="enlace_registro" href="RegistroEstudiantes.html"> Registrarse</a></button>
            </div>
            <a class="nav-link active" id="formulario_abajo" href="#">¿Olvidó su contraseña?</a>
            <a class="nav-link active" id="formulario_abajo2" href="index.php">Regresar a Inicio</a>
            </article>
        </div>
        <div class="secciones">
                <article id="pestaña3">               
            <div class="grupo">
                <img class="iconos" src="../Assets/Imagenes/usuario.png" alt="">
                <input type="hidden" name="accionG" id="accionG" value="loginG">
                <input type="text" name="usuarioG" id="usuarioG" >
                <label>Usuario</label>
            </div> 
            <div class="grupo">
                <img class="iconos" src="../Assets/Imagenes/contraseña.png" alt="">
                <input type="password" name="contraG" id="contraG" >
                <label>Contraseña</label>
            </div>             
            <div>                
                <button type="submit" class="BotonIniciarSesion">Iniciar Sesión</button>
            </div>
            <div class="h6_textopequeño">
                <h6>O</h6>
            </div>
            <div>
                <button class="BotonRegistrarse"> <a class="nav-link active" id="enlace_registro" href="RegistroGeneral.html">Registrarse</a></button>
            </div>
            <a class="nav-link active" id="formulario_abajo" href="#">¿Olvidó su contraseña?</a>
            <a class="nav-link active" id="formulario_abajo2" href="index.php">Regresar a Inicio</a> 
            </article>
        </div>
    </form>   
    <img src="../Assets/Imagenes/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">     
  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="../Assets/js/iniciar_sesion.js"></script>
    <br> <br> <br>

    <footer>
          <!-- Footer main -->
          <section class="ft-main">
            <div class="ft-main-item">
              <h2 class="ft-title">Contáctenos</h2>
              <ul class="fa-ul">
                <li><i class="fa-li fa fa-phone fa-1x" aria-hidden="true"></i>+505 2249 6429</li>
                <li><i class="fa-li fa fa-envelope-o  fa-1x" aria-hidden="true"></i></i>decanatura@fcys.uni.edu.ni</li>
                <li><i class="fa-li fa fa-map-marker  fa-1x" aria-hidden="true"></i></i>Semáforos Villa Progreso 2 1/2 cuadras arriba</li>
              </ul>
            </div>
            <div class="ft-main-item_2">
              <h2 class="ft-title"></h2>
              <ul>
                <li><a href="../index.php">Inicio</a></li>
               
              </ul>
              
            </div>
            <!--
            <div class="ft-main-item_2">
              <h2 class="ft-title"></h2>
              <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Eventos</a></li>
                <li><a href="#">¿Qué es SGE-FCYS?</a></li>
              </ul>
              -->
            </div>
            <div class="ft-main-item">
              <h2 class="ft-title"></h2>
              <ul class="ft-social-list">
                <a href="#"><i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-globe fa-2x" aria-hidden="true"></i></a>
              </ul>
            </div>
            
          </section>
          <section class="ft-legal">
            <ul class="ft-legal-list">
              <li>&copy; Universidad Nacional De Ingenieria 2022</li>
            </ul>
          </section>
          </footer>     
          
</body>
</html>