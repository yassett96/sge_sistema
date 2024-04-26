<?php
//  $mysqli = new mysqli('localhost', 'root', '', 'sge_bd');

 session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario']  != 6)  {

    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();
}

  require_once ("../../Modelo/Administrador/MTipoU.php");

  $TiUs = new TipoUModel();

  $tipoulist = $TiUs->select_tipoU_AdminUsuarios();
  $listaGradoAcademico = $TiUs->FunObtenerListaGradoAcademico();
  $listaRoles = $TiUs->FunObtenerListaRoles();
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

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/herramientas/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    
    <link rel="stylesheet" href="../../Assets/css/Administrador/RegistroUsuario.css">

    <title>Registro Usuarios</title>
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
    <h4 class="h4">Ingrese los datos para registrar al nuevo acceso</h4>
    <div class="formulario_general">
        <form  id="form_general" name="form_general">
        <div id="Alerta"></div>
            <h4 class="h4_formulario">General</h4>
            <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
            <div class="row">
                  <div class="form-group col-md-6">
                    <img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">
                    <input type="text" name="pname" id="pname" onkeyup="OrdenOracion()" required>
                    <label>Primer nombre (*)  </label>
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
                      <input type="text" name="papellido" id="papellido"  onkeyup="OrdenOracion()" required>
                      <label>Primer apellido (*)  </label>
                    </div>
                    <div class="form-group col-md-6">
                      <img class="icono2" src="../../Assets/imagenes/Recursos/icono5.png">
                      <input type="text" name="sapellido" id="sapellido" onkeyup="OrdenOracion()" required>
                      <label>Segundo apellido </label>
                    </div>
                </div>
                <div  class="row">
                <div class="form-group col-md-6">
                  <img class="icono3" src="../../Assets/imagenes/Recursos/iconoCel.png">

                  <input type="tel" name="tel" id="tel" placeholder="8888-8888" minlength="9" maxlength="9"  required>
                  <label>Teléfono (*) </label>
                </div>
                    
                <div class="form-group col-md-6">                    
                  <img class="icono6" src="../../Assets/imagenes/Recursos/Carnet.png">
                  <input type="text" name="cedula" id="pCedula"  onkeyup="this.value = this.value.toUpperCase()" placeholder="001-000000-0000U" required>
                  <label>Cédula (*) </label>                      
                </div>
                <div class=" col-md-2 mt-3 center">
                  <input type="checkbox" id="C2" name="C2"/> <label id="Opcion">No tengo cédula  </label>
                </div>
                    
                
                </div>
                <div  class="row">
                  <div class="form-group col-md-6">
                      <img class="icono5" src="../../Assets/imagenes/Recursos/icono7Arroba.png">
                      <input type="email" name="correo" id="pInputEmail" required>
                      <label>Email (*)</label>
                  </div>
                  <div class="form-group col-md-6">
                    <img class="icono5" src="../../Assets/imagenes/Iconos/Sistema/Administrador/grupo.png">
                    <label>Tipo usuario (*)</label>
                    <select class="form-select" name="tipoU"  id="tipoUNuevoAcceso"  onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example">
                      <option hidden selected>Seleccione tipo de Usuario</option>
                      <?php echo   $tipoulist; ?>
                    </select> 
                  </div>                    
                </div>

                <!-- Cuando el tipo de usuario es participante -->
                <div  class="row rowParticipante">
                  <div class="form-group col-md-6">
                    <img class="icono5" src="../../Assets/imagenes/Recursos/CarnetEstudiante.png">
                    <input type="text" name="carnetParticipante" id="inputCarnetParticipante" placeholder="Escriba su número de carnet" required>
                    <label>N° Carnet</label>
                  </div>
                  <div class="form-group col-md-6">
                    <img class="icono5" src="../../Assets/imagenes/Recursos/sede.png">
                    <label>Sede (*)</label>
                    <select class="form-select" name="sedeParticipante"  id="selectIdSedeParticipante"  onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example">
                      <!-- <option hidden selected>Seleccione la sede </option> -->
                      <?php echo   $listaSedes; ?>
                    </select> 
                  </div>                    
                </div>
                <div  class="row rowParticipante">
                  <div class="form-group col-md-6">
                    <img class="icono5" src="../../Assets/imagenes/Iconos/Sistema/Administrador/grupo.png">
                    <label>Grupo (*)</label>
                    <select class="form-select" name="grupoParticipante"  id="idSedeParticipante"  onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example">
                      <!-- <option hidden selected>Seleccione el grupo</option> -->
                    </select> 
                  </div>                    
                </div>
                <!--===========================================-->

                <!-- Cuando el tipo de usuario es personal académico -->
                <div  class="row rowPersonalAcademico">
                  <div class="form-group col-md-6">
                    <img class="icono5" src="../../Assets/imagenes/Iconos/Sistema/Administrador/diploma.png">
                    <label>Grado académico</label>
                    <select class="form-select" name="gradoAcademicoPersonalAcademico"  id="selectIdGradoAcademicoPersonalAcademico"  onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example">
                      <!-- <option hidden selected>Seleccione el grado académico</option> -->
                      <?php echo  $listaGradoAcademico; ?>
                    </select> 
                  </div>
                  <div class="form-group col-md-6">
                    <img class="icono5" src="../../Assets/imagenes/Recursos/sede.png">
                    <label>Sede</label>
                    <select class="form-select" name="sedePersonalAcademico"  id="selectIdSedePersonalAcademico"  onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example">
                      <!-- <option hidden selected>Seleccione la sede</option> -->
                      <?php echo  $listaSedes; ?>
                    </select> 
                  </div> 
                </div>
                <div  class="row rowPersonalAcademico">
                  <div class="form-group col-md-6">
                    <img class="icono5" src="../../Assets/imagenes/Iconos/Sistema/Administrador/cargo.png">
                    <input type="text" name="cargoPersonalAcademico" id="inputCargoPersonalAcademico" placeholder="Escriba el cargo" required>
                    <label>Cargo</label>
                  </div>                
                  <div class="form-group col-md-6">
                    <img class="icono5" src="../../Assets/imagenes/Iconos/Sistema/Administrador/grupo.png">
                    <label>Rol</label>
                    <select class="form-select" name="rolPersonalAcademico"  id="selectIdRolPersonalAcademico"  onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;' onblur="this.size=0;"  aria-label="Default select example">
                      <!-- <option hidden selected>Seleccione el rol del personal académico</option> -->
                      <?php echo  $listaRoles; ?>
                    </select> 
                  </div>                
                </div>
                <!--=================================================-->

                <div class="row">
                  <div class="form-group col-md-6">
                    <abbr title="Su Usuario debe contener de 5 a 10 caracteres que incluyan letras y números ">
                      <img class="icono6" src="../../Assets/imagenes/Recursos/icono4.png">
                      <input type="text" name="user" id="pInputUsuario" minlength="5" maxlength="10" required disabled>
                      <label>Usuario (*)</label>
                    </abbr>
                  </div>

                  <div class="form-group col-md-6">
                    <abbr title="Su contraseña debe contener de 8 a 16 caracteres que incluyan al menos una letra Mayuscula, una minuscula, un número y un caracter especial">
                      <img class="icono7" src="../../Assets/imagenes/Recursos/icono8Candado.png">
                      <input id="pinputContraseña" type="password" name="pInputContraseña" minlength="8" maxlength="16" required disabled>
                      <label>Contraseña (*)</label>
                      <span><img class="M1" src="../../Assets/imagenes/Recursos/Visto.png"></span>
                    </abbr>
                  </div>
                </div>
                <!-- PROBAR -->
                <div class="row">
                  <div class="form-group col-md-6">
                    <img class="icono8" src="../../Assets/imagenes/Recursos/icono4Combinacion.png">
                    <input type="password" name="pInputRepContraseña" id="pInputRepContraseña" minlength="8" maxlength="16" required disabled>
                    <label>Repetir contraseña (*)</label>
                    <span><img class="M2" src="../../Assets/imagenes/Recursos/Visto.png"></span>
                  </div>
                </div>
                <div id="divBotonesFormulario">
                  <button class="BotonesFormularios" type="reset" >Limpiar campos</button>
                  <button id="BtnAgregarP" class="BotonesFormularios">Registrarse</button>
                </div>
            <a class="nav-link active" id="h4_formulario_Abajo2" href="javascript:history.back()" >Cancelar</a>
        </form>
    </div>
    <script>
function myFunction() {
  return "Se perderan los datos si actualizas la pagina";
}
</script>

  <script type="text/javascript" src="../../Assets/js/General/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src= "../../Assets/js/General/jquery.mask.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
  <script src="../../Assets/js/General/helperjs.js"></script>
  <script src="../../Assets/js/General/Constanst.js"></script>
  <script type="text/javascript" src="../../Assets/js/General/ValidacionesFormulario.js"></script>
  <script type="text/javascript" src="../../Assets/js/Administrador/ValidacionesFormularioG.js"></script>
  <script type="text/javascript" src="../../Assets/js/Administrador/AdministracionUsuarios.js"></script> 

  
  <img src="../../Assets/imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">
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
            <!-- <li><a href="../../Vista/Administrador/Index-Admin.php">Inicio</a></li> -->
            <li><a href="../../Vista/Administrador/InicioAdministradorCE.php">Inicio</a></li>
            <li><a href="../../Vista/Administrador/PanelAdministrador.php">Panel Admin</a></li>                
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
        </div>
      </div>
</footer>

</body>
</html>