<?php 
  require_once("../../Controlador/Participante/CInscripcionEventoFeria.php");
  session_start();


   //Para verificar que no haya 3 proyectos inscritos
   $vlocNumeroProyectosInscritos = FunObtenerNoProyectosInscritosSegunCodRegParticipante($_SESSION['Cod']);

  if($vlocNumeroProyectosInscritos >= 3){
    header('Location: ../../Vista/Participante/InicioParticipanteConEvento.php');//Aqui lo redireccionas al lugar que quieras.        
    die();
  }

  if(!isset($_SESSION['Participantes']) or $_SESSION['Participantes']['ID_Tipo_Usuario']  != "1"){
    header('Location: ../../Vista/index.html');//Aqui lo redireccionas al lugar que quieras.
    die();
  }
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
  

    <link rel="stylesheet" href="../../Assets/css/Participante/inscripcionEventoFeria.css">

    <title>inscripción Evento</title>
  </head>
  <body>
    <?php 
      require_once('../../Controlador/Participante/CInscripcionEventoFeria.php');                
      // require_once('../../Vista/Participante/popUpConfirmacionParticipante.php');                
    ?>
    <header >
      <div class="logo">
        <img src="../../Assets/Imagenes/Recursos/FCyS balnco.png" height="50px">
      </div>
    </header>      

    <img src="../../Assets/Imagenes/Recursos/mosaico1.png" id="mosaicoDER" height="180px" width="180px">

    <h4 id="h4Atras" ><a id="aAtras"><< Atrás</a></h4>

    <h4 id="h4TextoInscripcionFeria">Inscripción al evento feria</h4>

    <button id="butCancelarInscripción">Cancelar inscripción</button>
    <br>
    <br>
    <br>
    <br>

    <!-- Inicio  formularios de inscripción -->
    <div id="divContenedorFormularioInscripcion" >
      <ul id="ulFormularioInscripcion">
        <li class="liNavegacionInscripcionEvento" id="liDatosProyecto"><p class="pNavegacionInscripcionEvento" id="pIdNavegacionInscripcionEvento">Datos del </br> proyecto </p></li>
        <li class="liNavegacionInscripcionEvento" id="liDatosParticipante1"><p class="pNavegacionInscripcionEvento">Datos del </br>participante 1</p></li>
        <li class="liNavegacionInscripcionEvento" id="liDatosParticipante2"><p class="pNavegacionInscripcionEvento">Datos del </br>participante 2</p></li>
        <li class="liNavegacionInscripcionEvento" id="liDatosParticipante3"><p class="pNavegacionInscripcionEvento">Datos del </br>participante 3</p></li>
      </ul>

      <section id="secDatosProyecto" class="secDatosInscripcionFeria">
        <form id="idFormDatosProyectos" action="../../Controlador/CParticipanteProyecto/CParticipanteProyecto.php" method="POST" name="formDatosProyectos">          
          <label for="nombre_del_proyecto" class="lblFormDatosProyecto">Nombre del proyecto </label>
          <input type="text" name="nombre_proyecto" id="inputNombreProyecto" class="inputDatosProyecto" placeholder="Digite el nombre del proyecto"><BR>

          <label for="descripcion_proyecto" class="lblFormDatosProyecto">Descripción del proyecto </label>
          <textarea id="inputDescripcionProyecto" placeholder="Escriba la descripción del proyecto" name="descripcion" class="inputDatosProyecto"></textarea><BR>              
            
          <label for="categoria" class="lblFormDatosProyecto">Categoría</label>
          <select id="selectCategoria"  name="categoria" class="selectDatosProyecto">
            <option id="optionPrimerSelecCategoria" selected disabled hidden>Seleccione la categoría</option>
                            
            <?php                                
              $vlocCarnetParticipante = $_SESSION['Carnet'];
              $vlocCategorias = FunObtenerCategoriasSegunParticipante($vlocCarnetParticipante);

              for($y=0; $y<count($vlocCategorias); $y++){
                $vlocInfoCategoria = explode(",", $vlocCategorias[$y]);
                echo '<option class="optionCategoria" value="'.$vlocInfoCategoria[0].'">'.$vlocInfoCategoria[1].'</option>';
              }                                                        
            ?>                
          </select>                                          
          <label for="subCategoria" class="lblFormDatosProyecto">Subcategoría</label>
          <select id="selectSubCategoria" name="sub_categoria" class="selectDatosProyecto">
            <option id="optionPrimerSelecSubCategoria" value="" selected disabled hidden>Seleccione la subcategoría</option>                
          </select>            

          <label for="tutor" class="lblFormDatosProyecto">Tutor</label>
          <select id="selectTutor" name="tutor" class="selectDatosProyecto" placeholder="Seleccione el tutor">
            <option id="optionPrimerSelecTutor" value="" selected disabled hidden>Seleccione el tutor</option>
            <?php     
                      
              $vlocTutores = FuncObtenerTutores();                
              
              for($y=0; $y<count(FuncObtenerTutores()); $y++){
                $vlocInfoTutor = explode(",",$vlocTutores[$y]);
                echo '<option class="optionDocente" value="'.($vlocInfoTutor[0]).'">'.$vlocInfoTutor[1].' '.$vlocInfoTutor[2].'</option>';
              }                   
            ?>                                    
          </select> 
          
          <label id="labelRequerimiento" for="requerimiento_proyecto" class="lblFormDatosProyecto">Requerimientos </label>
          <textarea id="inputRequerimientoProyecto" placeholder="Escriba los requerimientos del proyecto para poder presentar" name="requerimiento" class="inputDatosProyecto"></textarea><BR>              
        </form>
        <button id="inputBotonEnviar">Inscribir participantes</button>
      </section>

      <section id="secDatosParticipante1" class="secDatosInscripcionFeria">
        <button style="visibility: hidden;" class="buttonCargarParticipante" id="cargarparticipante1" onclick="" >Cargar participante</button><br>
        <form name="formDatosParticipante1">
          <label class="labelCodigoParticipante">Código registro inscriptor</label><br>
          <input type="number" pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="inputCodigoParticipante" name="inputCodigoRegistroParticipante1" class="" placeholder="" readonly><br>
          
          <label class="labelDatosNombreApellidoFormularios">Nombres:</label>
          <label class="labelDatosNombreApellidoFormularios" id="idLabelApellidos">Apellidos:</label><br>
          <input type="text" id="inputNombresParticipante" class="inputDatosParticipante1" placeholder="Nombres" disabled>          
          <input type="text" id="inputApellidosParticipante" class="inputDatosParticipante1" placeholder="Apellidos" disabled><BR>

          <label class="labelDatosCedulaCarnetFormularios">Cédula:</label>
          <label class="labelDatosCedulaCarnetFormularios" id="idLabelCarnet">Carnet:</label><br>
          <input type="text" id="inputCedulaParticipante" class="inputDatosParticipante1" placeholder="Cédula" disabled>          
          <input type="text" id="inputCarnetParticipante" class="inputDatosParticipante1" placeholder="Carnet" disabled><BR>

          <label class="labelDatosGrupoSedeFormularios">Grupo:</label>
          <label class="labelDatosGrupoSedeFormularios" id="idLabelSede">Sede:</label><br>
          <input name="inputGrupoParticipante1" class="inputDatosParticipante1" placeholder="Grupo" disabled>                    
          <input name="sede" class="inputDatosParticipante1" placeholder="Sede" disabled>          

          <label class="labelDatosTelefonoCorreoFormularios">Teléfono:</label>
          <label class="labelDatosTelefonoCorreoFormularios" id="idLabelCorreo">Correo:</label><br>
          <input type="text" id="inputTelefonoParticipante" class="inputDatosParticipante1" placeholder="Teléfono" disabled>          
          <input type="text" id="inputCorreoParticipante" class="inputDatosParticipante1" placeholder="Correo" disabled>
          
          <button id="inputBotonFinalizarInscripcion" class="inputBotonInscribirParticipante1" style="text-align: center;">Inscribir otro participante</button>
          <button id="inputBotonInscribirOtroParticipante" class="inputBotonInscribirParticipante1" style="text-align: center;">Finalizar inscripción</button>
        </form>
      </section>
      
      <section id="secDatosParticipante2" class="secDatosInscripcionFeria">
        <button class="buttonCargarParticipante">Cargar participante</button><br>
        <form name="formDatosParticipante2">
          <label class="labelCodigoParticipante">Ingrese el código del participante</label><br>
          <input type="number" pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="inputCodigoRegistroParticipante2" id="InputCodRegistroPar2" class="inputCodigoParticipante" placeholder=""><br>

          <br>
          <label class="labelDatosNombreApellidoFormularios">Nombres:</label>
          <label class="labelDatosNombreApellidoFormularios" id="idLabelApellidos">Apellidos:</label><br>          
          <input type="text" id="inputNombresParticipante" class="inputDatosParticipante2" placeholder="Nombres" disabled>
          <input type="text" id="inputApellidosParticipante" class="inputDatosParticipante2" placeholder="Apellidos" disabled><BR>

          <label class="labelDatosCedulaCarnetFormularios">Cédula:</label>
          <label class="labelDatosCedulaCarnetFormularios" id="idLabelCarnet">Carnet:</label><br>
          <input type="text" id="inputCedulaParticipante" class="inputDatosParticipante2" placeholder="Cédula" disabled>
          <input type="text" id="inputCarnetParticipante" class="inputDatosParticipante2" placeholder="Carnet" disabled><BR>

          <label class="labelDatosGrupoSedeFormularios">Grupo:</label>
          <label class="labelDatosGrupoSedeFormularios" id="idLabelSede">Sede:</label><br>
          <input name="inputGrupoParticipante2" class="inputDatosParticipante2" placeholder="Grupo" disabled>              
          <input name="sede" class="inputDatosParticipante2" placeholder="Sede" disabled>

          <label class="labelDatosTelefonoCorreoFormularios">Teléfono:</label>
          <label class="labelDatosTelefonoCorreoFormularios" id="idLabelCorreo">Correo:</label><br>
          <input type="text" id="inputTelefonoParticipante" class="inputDatosParticipante2" placeholder="Teléfono" disabled>
          <input type="text" id="inputCorreoParticipante" class="inputDatosParticipante2" placeholder="Correo" disabled>
          
          <button id="inputBotonLimpiarCampos1" class="inputBotonInscribirParticipante2" style="text-align: center;">Limpiar campos</button>
          <br>
          <button id="inputBotonFinalizarInscripcion2" class="inputBotonInscribirParticipante2" style="text-align: center;">Inscribir otro participante</button>
          <button id="inputBotonInscribirOtroParticipante" class="inputBotonInscribirParticipante2" style="text-align: center;">Finalizar inscripción</button>          
        </form>
      </section>

      <section id="secDatosParticipante3" class="secDatosInscripcionFeria">
        <button class="buttonCargarParticipante">Cargar participante</button><br>
        <form name="formDatosParticipante3">
          <label class="labelCodigoParticipante">Ingrese el código del participante</label><br>
          <input type="number" pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="inputCodigoParticipante" id="InputCodRegistroPar3" name="inputCodigoRegistroParticipante3" placeholder=""><br>
          
          <br>
          <label class="labelDatosNombreApellidoFormularios">Nombres:</label>
          <label class="labelDatosNombreApellidoFormularios" id="idLabelApellidos">Apellidos:</label><br>          
          <input type="text" id="inputNombresParticipante" class="inputDatosParticipante3" placeholder="Nombres" disabled>
          <input type="text" id="inputApellidosParticipante" class="inputDatosParticipante3" placeholder="Apellidos" disabled><BR>

          <label class="labelDatosCedulaCarnetFormularios">Cédula:</label>
          <label class="labelDatosCedulaCarnetFormularios" id="idLabelCarnet">Carnet:</label><br>
          <input type="text" id="inputCedulaParticipante" class="inputDatosParticipante3" placeholder="Cédula" disabled>
          <input type="text" id="inputCarnetParticipante" class="inputDatosParticipante3" placeholder="Carnet" disabled><BR>

          <label class="labelDatosGrupoSedeFormularios">Grupo:</label>
          <label class="labelDatosGrupoSedeFormularios" id="idLabelSede">Sede:</label><br>
          <input name="inputGrupoParticipante3" class="inputDatosParticipante3" placeholder="Grupo" disabled>
          <input name="sede" class="inputDatosParticipante3" placeholder="Sede" disabled>

          <label class="labelDatosTelefonoCorreoFormularios">Teléfono:</label>
          <label class="labelDatosTelefonoCorreoFormularios" id="idLabelCorreo">Correo:</label><br>
          <input type="text" id="inputTelefonoParticipante" class="inputDatosParticipante3" placeholder="Teléfono" disabled>
          <input type="text" id="inputCorreoParticipante" class="inputDatosParticipante3" placeholder="Correo" disabled>
          
          <button id="inputBotonLimpiarCampos2" class="inputBotonInscribirParticipante3" style="text-align: center;">Limpiar campos</button>          
          <button id="inputBotonInscribirOtroParticipante" class="inputBotonInscribirParticipante3" style="text-align: center;">Finalizar inscripción</button>
        </form>
      </section>      
    </div>

    <!-- Fin formularios para incripción -->          
    <img src="../../Assets/Imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">                           
    <script src="../../Assets/js/General/Constanst.js"></script>                     
    <script src="../../Assets/js/General/helperjs.js"></script>
    <script src="../../Assets/js/Participante/inscripcionEventoFeria.js"></script>                 
    <script src="../../Vista/Participante/confirmacion/send_sms.js"></script>                 
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>       
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
                  
    <!--INICIA CONSTRUCCION FOOTER-->       
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6" id="divContactos">
            <h2>Contáctenos</h2>
            <ul class="footer-links">
              <li><i class="fa fa-phone " ></i>+505 2249 6429</li>
              <li><i class=" fa fa-envelope-o  "></i></i>decanatura@fcys.uni.edu.ni</li>
              <li><i class=" fa fa-map-marker  "></i></i>Semáforos 'Villa Progreso', 2 1/2 cuadras arriba</li>
            </ul>
          </div>
  
          <div class="col-xs-6 col-md-3" id="divListaMenuFooter">         
            <ul class="footer-links">
              <li><a href="../../index.php">Inicio</a></li>
              <li><a href="../../Vista/VEvento/Eventos.html">Eventos</a></li>
              <li><a href="../../Vista/VQueessge/QueEs_InfoSis.html">¿Qué es SGE-FCYS?</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <ul class="footer-links">
              <li><a href="../../index.php">Mi cuenta</a></li>
              <!-- <li><a href="../../Vista/VEvento/Eventos.html">Eventos</a></li> -->
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
    <!--TERMINA CONSTRUCCION FOOTER-->      
  </body>
</html>
  