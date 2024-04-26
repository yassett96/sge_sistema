<?php 
  header('Content-Type: text/html; charset=utf-8');
  session_start();


//   if(!isset($_SESSION['Participantes']) or $_SESSION['Participantes']['ID_Tipo_Usuario']  != "2"){
//     header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
//     die();
//   }

  if (!isset($_SESSION['PersonaAcademica']) or $_SESSION['PersonaAcademica']['ID_Tipo_Usuario']  != "2")   {
    header('Location: ../index.html');//Aqui lo redireccionas al lugar que quieras.
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

      <link rel="stylesheet" href="../../Assets/css/Jurado/EvaluacionProyectos.css">

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
            <li class="liNavHeader"><a class="nav-link" id="texto" href="../../Vista/Jurado/InicioJurado.php" >Inicio</a></li>
            <li class="liNavHeader"><a class="nav-link" id="texto" href="../../Vista/Jurado/ResultadosEvaluaciones.php">Evaluaciones</a></li>
            <!-- <li class="liNavHeader"><a class="nav-link" id="texto" href="../../Vista/Participante/QueEs_InfoSisP.php">¿Qué es SGE-FCYS?</a></li>             -->
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
                <!-- <a class="link-item"  href="../../Vista/Participante/QueEs_InfoSisP.php">¿Qué es SGE-FCYS?</a>     -->
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
      <h1 id="h1TituloDatosProyectos">Evaluación proyectos</h1>
      <button id="botonCancelarEvaluacion">Cancelar evaluación</button>
    </div>

    <div id="divSeccionFormularioLectura">
      <div id="divSeccionNavegacionFormularioLectura">
        <div class="divPestaña"><h1 id="h1PestañaDatosProyecto">Información del proyecto</h1></div>
        <div class="divPestaña"><h1 id="h1PestañaCriteriosEvaluacion">Criterios de evaluación</h1></div>
      </div>

      <br>      

      <form id="FormularioInformacionProyecto">
        <h2 class="h2LabelsProyectos">Proyecto: </h2>
        <br>
        <input type="text" name="nombre_proyecto" id="inputNombreProyecto" class="inputInfomracionProyecto" placeholder="Nombre del proyecto" disabled>
        <br><br>
        <h2 class="h2LabelsProyectos">Categoría: </h2>
        <br>
        <input type="text" name="nombre_proyecto" id="inputCategoria" class="inputInfomracionProyecto" placeholder="Nombre de la categoría" disabled>
        <br><br>
        <h2 class="h2LabelsProyectos">Sub categoría: </h2>
        <br>
        <input type="text" name="sub_categoria" id="inputSubCategoria" class="inputInfomracionProyecto" placeholder="Nombre de la sub categoría" disabled>
        <br><br>
        <h2 class="h2LabelsProyectos">Descripción: </h2>
        <br>
        <textarea id="inputDescripcionProyecto" name="descripcion" class="inputInfomracionProyecto" placeholder="Descripción"  disabled></textarea>
        <h2 class="h2LabelsProyectos">Integrante 1: </h2>
        <br>
        <input type="text" name="integrante_1" id="inputIntegrante1" class="inputInfomracionProyecto" placeholder="Integrante 1" disabled>
        <h2 class="h2LabelsProyectos">Integrante 2: </h2>
        <br>
        <input type="text" name="integrante_2" id="inputIntegrante2" class="inputInfomracionProyecto" placeholder="Integrante 2" disabled>

        <h2 class="h2LabelsProyectos">Integrante 3: </h2>
        <br>
        <input type="text" name="integrante_3" id="inputIntegrante3" class="inputInfomracionProyecto" placeholder="Integrante 3" disabled>
        
      </form>      

      <form id="FormularioEvaluacion">

        <h3 id="h3TituloFormulario">Instrucción para el llenado del formato de evaluación</h3>

        <div id="divInstrucciones">
          <h3 id="h3TextoInstrucciones">            
          </h3>
        </div>

        <br>

        <h3 id="h3TituloFormulario">Brinde la puntuación en cada criterio</h3>

        <br>
        
        <div class="table-container">
          <table id="idTable">
            <thead id="idTHead">              
            </thead>
            <tbody id="idTBody"></tbody>
          </table>
        </div>

        <br>

        <h3 id="h3LabelComentarios">Comentarios</h3>
        <textarea id="idTextareaComentarios"></textarea>
      </form>

      <button id="idButtonTerminarEvaluacion">Terminar evaluación</button>
    </div>
    <br>
    <br>
    <br> 
       
    
    <img src="../../Assets/Imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">                             
    <br> 
    <br>

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
    <script src="../../Assets/js/Jurado/EvaluacionProyectos.js"></script>   
    <script type="text/javascript"  src="../../Assets/js/Participante/Cuenta.js"></script>       
    <script>
      function FunVerificarValor(celda) {
        // Obtener el valor de la celda superior
        var celdaSuperior = celda.parentElement.previousElementSibling.querySelector('td:nth-child(' + (celda.cellIndex + 1) + ')');
        var valorCeldaSuperior = parseInt(celdaSuperior.textContent) || 0; // Obtener el valor como número

        // Obtener el valor ingresado en la celda actual
        var valorIngresado = parseInt(celda.textContent) || 0; // Obtener el valor como número

        // Verificar si el valor ingresado supera el valor de la celda superior
        if (valorIngresado > valorCeldaSuperior) {
          // alert("El valor no puede ser mayor que la celda superior (" + valorCeldaSuperior + ")");
          funActivarAlerta("warning", "¡Puntuación inválida!", "El valor no puede ser mayor que " + valorCeldaSuperior);
          // Restaurar el valor original de la celda
          celda.textContent = valorCeldaSuperior;
        }

        FunSumaTotal();
      }

      function FunSumaTotal() {
        let totalSum = 0;
        $('.tdPuntuaciones').each(function() {
          const cellContent = $(this).text();
          const integerValue = parseInt(cellContent, 10);
          if (!isNaN(integerValue)) {
            totalSum += integerValue;
          }
        });
    
        $('#idCeldaTotal').text(totalSum);
      }

      function validarNumeros(inputElement) {
        // Obtener el valor actual de la celda
        var valorCelda = inputElement.textContent;

        // Eliminar cualquier carácter que no sea un número o el punto (para números decimales)
        var valorNumerico = valorCelda.replace(/[^0-9.]/g, '');

        // Actualizar el contenido de la celda con el valor numérico
        inputElement.textContent = valorNumerico;
      }
    </script> 

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
            <li><a href="../../Vista/Jurado/InicioJurado.php">Inicio</a></li>
              <li><a href="../../Vista/Jurado/ResultadosEvaluaciones.php">Evaluaciones</a></li>
              <!-- <li><a href="../../Vista/Participante/QueEs_InfoSisP.php">¿Qué es SGE-FCYS?</a></li> -->
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <ul class="footer-links">
            <li><a href="../../Vista/Jurado/MiCuenta_CE.php">Mi cuenta</a></li>
            <!-- <li><a href="../../Vista/Participante/Eventos_PSE.php">Eventos</a></li> -->
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