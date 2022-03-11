
<?php
  $mysqli = new mysqli('localhost', 'root', '', 'sge_bd');
?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Assets/css/RegistroEstudiantes.css">
    <link rel="stylesheet" href="../../Assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Registro estudiantes</title>
</head>
<body>
    <header>
        <div>
            <div class="logo">
            <img src="../../Assets/Imagenes/FCyS balnco.png" height="50px">
            </div>
        </div>
    </header>
    
    <img src="../../Assets/Imagenes/mosaico1.png" id="mosaicoDER" height="180px" width="180px">
    <a class="nav-link active" id="texto_atras" href="index.html" > << Atrás  </a>

    <h4 class="h4">Bienvenido/a</h4>
    <h4 class="h4">Ingrese los datos para registrarse</h4>
    <div class="formulario_estudiantes">
        <form action="../../Controlador/CPersona/CAgregaPersona.php" method="post" id="form_estu">
            <h4 class="h4_formulario">Estudiantes</h4>
                <div  class="row">
                    <div class="form-group col-md-6">
                        <img class="icono1" src="../../Assets/Imagenes/icono5.png">
                        <input type="text" name="pname" id="pname" required>
                        <label>Primer Nombre </label>
                    </div>
                    <div class="form-group col-md-6">
                        <img class="icono2" src="../../Assets/Imagenes/icono5.png">
                        <input type="text" name="sname" id="sname" required>
                        <label>Segundo Nombre </label>
                    </div>
                </div>
                <div  class="row">
                    <div class="form-group col-md-6">
                        <img class="icono1" src="../../Assets/Imagenes/icono5.png">
                        <input type="text" name="papellido" id="papellido" required>
                        <label>Primer Apellido </label>
                    </div>
                    <div class="form-group col-md-6">
                        <img class="icono2" src="../../Assets/Imagenes/icono5.png">
                        <input type="text" name="sapellido" id="sapellido" required>
                        <label>Segundo Apellido </label>
                    </div>
                </div>
                <div  class="row">
                    <div class="form-group col-md-6">
                        <img class="icono3" src="../../Assets/Imagenes/iconoCel.png">
                        <input type="tel" name="tel" id="tel" required>
                        <label>Teléfono </label>
                    </div>
                    <div class="form-group col-md-6">
                        <img class="icono4" src="../../Assets/Imagenes/sede.png">
                        <select class="form-select" name="sede"  id="sede" aria-label="Default select example">
                            <option selected>Sede</option>
                            <!--<option value ="1">  Recinto Universitario Simón Bolívar </option>-->
                         
                        <?php
                         $query = $mysqli -> query ("SELECT * FROM sede");
                         while ($valores = mysqli_fetch_array($query)) {
                           echo '<option value="'.$valores[ID_Sede].'">'.$valores[Sede].'</option>';
                         }
                           ?>             
                          </select> 
                    </div>
                </div>
                <div  class="row">
                    <div class="form-group col-md-6">
                        <img class="icono5" src="../../Assets/Imagenes/icono7Arroba.png">
                        <input type="email" name="correo" id="correo" required>
                        <label>Email </label>
                    </div>
                    <div class="form-group col-md-6">
                        <img class="icono1" src="../../Assets/Imagenes/icono5.png">
                        <input type="text" name="carnet" id="carnet" required>
                        <label>N° Carnet </label>
                    </div>
                </div>
                <div  class="row">
                    <div class="form-group col-md-8">
                        <img class="icono6" src="../../Assets/Imagenes/icono4.png">
                        <input type="text" name="user" id="pInputUsuario" required>
                        <label>Usuario </label>
                    </div>
                </div>
                <div  class="row">
                    <div class="form-group col-md-8">
                        <img class="icono7" src="../../Assets/Imagenes/icono8Candado.png">
                        <input type="password" name="pass" id="pInputContraseña" required>
                        <label>Contraseña </label>
                    </div>
                </div>
                <div  class="row">
                    <div class="form-group col-md-8">
                        <img class="icono8" src="../../Assets/Imagenes/icono4Combinacion.png">
                        <input type="password" name="" id="pInputRepContraseña" required>
                        <label>Repetir contraseña </label>
                    </div>
                </div>
                <!--<button class="BotonFormulariolimpiar" type="submit" >Limpiar Campos</button>-->
                <button class="BotonFormularioRegistrarse" type="submit">Registrarse</button>
            <a class="nav-link active" id="h4_formulario_Abajo" href="index.html" >¿Olvidó su contraseña?</a>
            <a class="nav-link active" id="h4_formulario_Abajo2" href="index.html" >Cancelar</a>
        </form>
    </div>
    <br>
    <img src="../../Assets/Imagenes/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">
    <br>
    <br>
    <div class="container"></div>
        <footer>
          <!-- Footer main -->
          <section class="ft-main">
            <div class="ft-main-item">
              <h2 class="ft-title">Contactenos</h2>
              <ul class="fa-ul">
                <li><i class="fa-li fa fa-phone fa-1x" aria-hidden="true"></i>+505 2249 6429</li>
                <li><i class="fa-li fa fa-envelope-o  fa-1x" aria-hidden="true"></i></i>decanatura@fcys.uni.edu.ni</li>
                <li><i class="fa-li fa fa-map-marker  fa-1x" aria-hidden="true"></i></i>Semáforos Villa Progreso 2 1/2 cuadras arriba</li>
              </ul>
            </div>
            <div class="ft-main-item_2">
              <h2 class="ft-title"></h2>
              <ul>
                <li><a href="../../index.php">Inicio</a></li>
               
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