<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

$idpersona = $_SESSION['Idpersona'];

require_once ("../../Modelo/Coordinador/MComisionesGenerales.php");

$MCGeneral = new ModComisionGen();

$LDatosGEA = $MCGeneral->ObtenerDatosComisionEvento();




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

    <link rel="stylesheet" href="../../Assets/css/Coordinador/ComisionesGenerales.css">




    <script src="https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.1.0/progressbar.min.js"></script>
    <title>Comisiones Generales</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
        </div>
        <div class="menu_general">
            <ul class="nav justify-content-end">
                <li class="nav-item"><a class="nav-link active" id="texto"
                        href="../../Vista/Coordinador/IndexCoordinadorCE.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link active" id="texto"
                        href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a></li>
                <li class="nav-item"><a class="nav-link active" id="texto"
                        href="../../Vista/Coordinador/AdminEventosCE.php">Administración de eventos</a></li>

                <li><a href="">Comisiones </a>
                    <ul>
                        <a id="FondoNav" href="../../Vista/Coordinador/ComisionAsignada.php">Comisión asignada</a>
                        <a id="FondoNav" href="../../Vista/Coordinador/ComisionesGenerales.php">Comisiones generales</a>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Coordinador/Reportes.php">Reportes</a></li>

                <div class="dropdown">
                    <img src="<?php echo $_SESSION['Avatar']; ?>" class="imgRedonda" />

                    <div class="dropdown-content">
                        <a href="../../Vista/Coordinador/MCuentaCE.php">Mi cuenta</a>
                        <a href='../../Controlador/General/CCerrarSesion.php'>Cerrar sesión</a>
                    </div>
                </div>
            </ul>
            <div class="Nombreusuario"><?php echo $_SESSION['NombreCompleto']; ?></div>
        </div>

        <!--A partir de aqui inicia el menu movil, pero copiar todo lo contenido en HEADER-->
        <div class="main-header">

            <nav id="nav" class="main-nav">
                <div class="nav-links">
                    <img src="<?php echo $_SESSION['Avatar']; ?>" class="imgRedonda link-item" />
                    <div class="NombreusuarioM"><?php echo $_SESSION['NombreCompleto']; ?></div>

                    <a class="link-item" href="../../Vista/Coordinador/IndexCoordinadorCE.php">Inicio</a>
                    <a class="link-item" href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a>
                    <a class="link-item" href="../../Vista/Coordinador/AdminEventosCE.php">Administración de eventos</a>
                    <a class="link-item" href="../../Vista/Coordinador/ComisionAsignada.php">Comisión asignada</a>
                    <a class="link-item" href="../../Vista/Coordinador/ComisionesGenerales.php">Comisiones generales</a>
                    <a class="link-item" href="../../Vista/Coordinador/Reportes.php">Reportes</a>
                    <a class="link-item" href="../../Vista/Coordinador/MCuentaCE.php">Mi cuenta</a>
                    <a class="link-item" href='../../Controlador/General/CCerrarSesion.php'>Cerrar sesión</a>

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
    
    <h4 class="h4">Comisiones Generales</h4>

    <?php

    foreach ($LDatosGEA as $comision) {
    $comision = trim($comision, "()");
    $valores = explode(",", $comision);

    // Extraer los valores de los responsables y el nombre de la comisión
    $ID_ComEvento = trim($valores[0]);
    $nombreComision = trim($valores[1]);
    $resp1 = trim($valores[2]);
    $resp2 = trim($valores[3]);
    $resp3 = trim($valores[4]);
    $ActFin = trim($valores[5]);//3;//rand();
    $ActTot = trim($valores[6]); //6;//rand();

    $porcentaje = 0; // Valor predeterminado para el porcentaje

    if ($ActTot != 0) {
    $porcentaje = ($ActFin / $ActTot) * 100;
    }
    //$porcentaje = ($ActFin / $ActTot) * 100;

    $progressId = 'progress-' . $ID_ComEvento;
    $idComision = 'ComisionSeleccionada-' . $nombreComision;

    
   

    ?>
    

    <div class="ContenedorPrincipal">
        <div class="ContDatosCA" id="<?php echo $idComision; ?>">

            <div class="R1" value="<?php echo $ID_ComEvento; ?>"></div>

            <h4 class="h4"><span><?php echo $nombreComision; ?></span></h4>
            <input type="hidden" id="Id_Per" value="<?php echo $idpersona; ?>">

            <div class="row-2">
                <div class="col-12">
                    <div id="card-5" class="card-5">
                    <h5 class="card-title-PG">Progreso</h5>
                        <div class="card-body">
                        
                            <div id="<?php echo $progressId; ?>" class="progress-circle">
                                <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <div id="card-1" class="card-1">
                        <div class="card-body">
                            <h5 class="card-title">Responsable 1:</h5>
                            <span class="card-subtitle mb-2 text-muted"><?php echo $resp1; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div id="card-2" class="card-2">
                        <div class="card-body">
                            <h5 class="card-title">Responsable 2:</h5>
                            <span class="card-subtitle mb-2 text-muted"><?php echo $resp2; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div id="card-3" class="card-3">
                        <div class="card-body">
                            <h5 class="card-title">Responsable 3:</h5>
                            <span class="card-subtitle mb-2 text-muted"><?php echo $resp3; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    


    <script>
    /*var progressBar = document.getElementById('<?php echo $progressId; ?>').querySelector('.progress-bar');
    var porcentaje = <?php echo $porcentaje; ?>;

    // Actualizar el valor de la barra de progreso
    progressBar.style.width = porcentaje + '%';
    progressBar.setAttribute('aria-valuenow', porcentaje);*/

    var progressId = '<?php echo $progressId; ?>';
    var porcentaje = <?php echo $porcentaje; ?>;

    // Inicializa la barra de progreso circular utilizando progressbar.js
    var bar = new ProgressBar.Circle('#' + progressId, {
        color: '#007bff', // Color de la barra de progreso
        strokeWidth: 6, // Ancho de la barra de progreso
        trailColor: '#f2f2f2', // Color de la trayectoria de la barra de progreso
        trailWidth: 6, // Ancho de la trayectoria de la barra de progreso
        text: {
            value: porcentaje.toFixed(0) + '%', // Valor del porcentaje a mostrar en el centro
            style: {
                color: '#000000', // Color del texto del porcentaje
                fontSize: '24px', // Tamaño de fuente del texto del porcentaje
                position: 'absolute',
                left: '50%',
                top: '50%',
                transform: 'translate(-50%, -50%)'
            }
        },
        from: { color: '#66BB6A' }, // Color de inicio de la animación de progreso
        to: { color: '#66BB6A' }, // Color de fin de la animación de progreso
        step: function(state, circle) {
            circle.path.setAttribute('stroke', state.color); // Establece el color de la barra de progreso
        }
    });

    // Establece el progreso de la barra de progreso
    bar.animate(porcentaje / 100);
    </script>

    <?php

//echo $progressId; 
}
?>
    <div id="contenedor"></div>



    <script type="text/javascript" src="../../Assets/js/General/jquery.min.js">
    <script type = "text/javascript" src = "../../Assets/js/General/bootstrap.min.js" ></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.1.0/progressbar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../../Assets/js/General/menu_movil.js"></script>
    
    <script type="text/javascript" src="../../Assets/js/Coordinador/ComisionesGenerales.js"></script>
    



    <br>
    <br>
    <img src="../../Assets/imagenes/Recursos/mosaicos2.png" id="mosaicoIZQ" height="180px" width="180px">
    <br>
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h2>Contáctenos</h2>
                    <ul class="footer-links">
                        <li><i class="fa fa-phone "></i>+505 2249 6429</li>
                        <li><i class=" fa fa-envelope-o  "></i></i>decanatura@fcys.uni.edu.ni</li>
                        <li><i class=" fa fa-map-marker  "></i></i>Semáforos 'Villa Progreso', 2 1/2 cuadras
                            arriba
                        </li>
                    </ul>
                </div>

                <div class="col-xs-6 col-md-3">
                    <ul class="footer-links">
                        <li><a href="../../Vista/Coordinador/IndexCoordinadorCE.php">Inicio</a></li>
                        <li><a href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a></li>
                        <li><a href="../../Vista/Coordinador/AdminEventosCE.php">Administración de
                                eventos</a>
                        </li>
                        <li><a href="../../Vista/Coordinador/MCuentaCE.php">Mi cuenta </a></li>
                    </ul>

                    </ul>
                </div>

                <div class="col-xs-6 col-md-3">
                    <ul class="footer-links">
                        <li><a href="../../Vista/Coordinador/ComisionAsignada.php">Comisión asignada</a></li>
                        <li><a href="../../Vista/Coordinador/ComisionesGenerales.php">Comisiones generales</a></li>
                        <li><a href="../../Vista/Coordinador/Reportes.php">Reportes</a></li>

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