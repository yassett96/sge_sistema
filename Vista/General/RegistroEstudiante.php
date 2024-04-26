<?php
 // $mysqli = new mysqli('localhost', 'root', '', 'sge_bd');

  require_once ("../../Modelo/General/MSede.php");
  require_once ("../../Modelo/General/MGrupo.php");


  $SedeModel = new SedeModel();

  $Sedelist = $SedeModel->select_sede();
  

?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../../Assets/imagenes/Recursos/Logo_UNI.png" height="30px" width="30px">
    <link rel="stylesheet" href="../../Assets/css/General/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/herramientas/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../../Assets/css/General//RegistroEstudiantes.css">
    <title>Registro estudiantes</title>
</head>
<body onbeforeunload="return myFunction()">
    <header>
      <div>
        <div class="logo">
        <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
        </div>
      </div>
    </header>

    
    <img src="../../Assets/imagenes/Recursos/mosaico1.png" id="mosaicoDER" height="180px" width="180px">
    <a class="nav-link active" id="texto_atras" href="javascript:history.back()" > << Atrás  </a>

    <h4 class="h4">Bienvenido/a</h4>
    <h4 class="h4">Ingrese los datos para registrarse</h4>
  <!--action="../../Controlador/CPersona/CAgregaPersona.php" -->

    <div id="formE" class="formulario_estudiantes">
        <form  id="form_estu" name="form_estu">
          <div id="Alerta"></div>
          
            <h4 class="h4_formulario">Participantes</h4>
            <p class="NotaCampos" ><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
                <div  class="row">
                    <div class="form-group col-md-6">
                        <img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">
                        <input type="text" name="pname" id="pname" onkeyup="OrdenOracion()"  required>
                        <label>Primer nombre (*) </label>
                    </div>
                    <div class="form-group col-md-6">
                        <img class="icono2" src="../../Assets/imagenes/Recursos/icono5.png">
                        <input type="text" name="sname" id="sname" onkeyup="OrdenOracion()" required>
                        <label>Segundo nombre </label>
                    </div>
                </div>
                <div  class="row">
                    <div class="form-group col-md-6">
                        <img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">
                        <input type="text" name="papellido" id="papellido" onkeyup="OrdenOracion()" required>
                        <label>Primer apellido (*) </label>
                    </div>
                    <div class="form-group col-md-6">
                        <img class="icono2" src="../../Assets/imagenes/Recursos/icono5.png">
                        <input type="text" name="sapellido" id="sapellido" onkeyup="OrdenOracion()" required>
                        <label>Segundo apellido  </label>
                    </div>
                </div>
                <div  class="row">
                    <div class="form-group col-md-6">
                        <img class="icono3" src="../../Assets/imagenes/Recursos/iconoCel.png">

                        <input type="tel" name="tel" id="tel" placeholder="8888-8888"  required>
                        <label>Teléfono (*)</label>
                    </div>
                    
                    <div class="form-group col-md-6">
                      
                      <img class="icono6" src="../../Assets/imagenes/Recursos/Carnet.png">
                      <input type="text" name="cedula" id="pCedula" onkeyup="this.value = this.value.toUpperCase()" placeholder="001-000000-0000U"  required>
                      <label>Cédula (*)</label>
                      
                  </div>

                  
                  <div class=" col-md-2 mt-3 center">
                    <input type="checkbox" id="C2" name="C2"/> <label id="Opcion">No tengo cédula  </label>
                    </div>

                    
                </div>
                <div  class="row">
                 

                    <div class="form-group col-md-6">
                        <img class="icono4" src="../../Assets/imagenes/Recursos/sede.png" title="Seleccione Sede" >
                        <label>Sede (*)</label>
                        <select class="form-select" name="sede"  id="sede"  onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example">
                        <option hidden selected>Selecciona su sede</option>
                          <?php echo $Sedelist; ?>

                        </select> 
                    </div>
                   
                    <div class="form-group col-md-6">
                        <img class="icono1" src="../../Assets/imagenes/Recursos/Carnet.png">
                        <input type="text" name="carnet" id="carnet" onkeyup="this.value = this.value.toUpperCase()" placeholder="" required>
                        <label>N° Carnet (*)</label>
                    </div>
                    
                    
                </div>
                <div  class="row">
                   <!---->
                    
                   <div class="form-group col-md-6">
                        <img class="icono5" src="../../Assets/imagenes/Recursos/icono7Arroba.png">
                        <input type="email" name="correo" id="correo" required>
                        <label>Email (*)</label>
                    </div>
                
                     <!---->
                    <div class="form-group col-md-6">
                        <img class="icono4" src="../../Assets/imagenes/Recursos/Grupo.png" title="SeleccioneGrupo">
                        <label>Grupo (*)</label>
                        <select class="form-select" name="grupo"  id="grupo"  onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;' onblur="this.size=0;" aria-label="Default select example">
                        
                        <option value="" selected>Seleccione su grupo</option>
                        </select> 
                    </div>
                </div>  
                <div  class="row">
                    <div class="form-group col-md-6">
                        <img class="icono6" src="../../Assets/imagenes/Recursos/icono4.png" title="Su Usuario debe contener de 5 a 10 caracteres que incluyan letras y números ">
                        <input type="text" name="user" id="pInputUsuario"  minlenth="5" maxlength="10"required>
                        <label>Usuario (*)</label>
                    </div>
                    <div class="form-group col-md-6">
                        <abbr  title="Su contraseña debe contener de 8 a 16 caracteres que incluyan al menos una letra Mayuscula, una minuscula, un número y un caracter especial"><img class="icono7" src="../../Assets/imagenes/Recursos/icono8Candado.png"></abbr>
                        <input type="password" name="pass" id="pInputContraseña"  minlength="8" maxlength="16" required>
                        <label>Contraseña (*)</label>
                        <span ><img class="M1" src="../../Assets/imagenes/Recursos/Visto.png" ></span>
                    </div>
                </div>
                <div  class="row">
                    <div class="form-group col-md-6 ">
                        <img class="icono8" src="../../Assets/imagenes/Recursos/icono4Combinacion.png" >
                        <input type="password" name="" id="pInputRepContraseña"  minlength="8" maxlength="16" required>
                        <label>Repetir contraseña (*) </label>
                        <span ><img class="M2" src="../../Assets/imagenes/Recursos/Visto.png" ></span>
                    </div>
                </div>
                <button class="BotonFormulariolimpiar" type="reset" >Limpiar campos</button>
                <button id="BtnAgregarP" class="BotonFormularioRegistrarse" >Registrarse</button>
            <!--<a class="nav-link active" id="h4_formulario_Abajo" href="index.html" >¿Olvidó su contraseña?</a>-->
            <a class="nav-link active" id="h4_formulario_Abajo2" href="javascript:history.back()" >Cancelar</a>
        </form>
    </div>
    <script>
      function myFunction() {
        return "Si actualizas se podrias perder los datos";
      }
    </script>

    <script type="text/javascript" src="../../Assets/js/General/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/jquery.mask.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script type="text/javascript" src="../../Assets/js/General/ValidacionesFormulario.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/RegistroEstudiantes.js"></script> 
    
    <img src="../../Assets/imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px" >
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
               
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            
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