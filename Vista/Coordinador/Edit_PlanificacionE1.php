<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/PlanificacionE.php");

$PlanDG = new PlanificacionEM();

$DatosGEA = $PlanDG->ObtenerDatosGEvento();
$NombreEA = $DatosGEA['Nombre_Evento'];
$EsloganEA = $DatosGEA['Eslogan'];
$HoraEA = $DatosGEA['hora'];
$FechaEA = $DatosGEA['Fecha'];
//$LogoEA = $DatosGEA['Logo'];
$Sitiolist = $PlanDG->ObtenerLugarEventoActual();

//print_r($LogoEA);
//exit();

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



    <link rel="stylesheet" href="../../Assets/css/Coordinador/E_PlanificacionE1.css">


    <title>Planificacion Feria E1 Edit</title>
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
                        <a id="FondoNav" href=".../../Vista/Coordinador/ComisionesGenerales.php">Comisiones generales</a>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link active" id="texto"
                        href=".../../Vista/Coordinador/Reportes.php">Reportes</a></li>

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
    <a class="nav-link active" id="texto_atras" href="javascript:history.back()">
        << Atrás </a>
            <h4 class="texto_etapa"> Etapa 1 de 5 </h4>
            <a class="nav-link active" id="texto_planificacion"
                href="../../Vista/Coordinador/Planificacion_Feria_CE.php">Ir a etapas de planificación</a>
            <a class="nav-link active" id="texto_siguiente" href="../../Vista/Coordinador/PlanificacionE2.php">Siguiente
                >></a>
            <h4 class="h4">Planificación de evento feria</h4>
            <h4 class="h4">Editar datos generales</h4>

            <div id="EDG_E1" class="Editar_DG_E1">
                <form id="DG_FE1" name="Editar_DGF_E1">
                    <div id="Alerta"></div>
                    <div id="contenedor"></div>
                    <h4 class="h4_formulario">Datos generales</h4>
                    <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <!--<img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">-->
                            <input type="text" name="NombreE" id="NombreE" value="<?php echo $NombreEA ?>">
                            <label>Nombre de la feria (*) </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <!--<img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">-->
                            <input type="text" name="EsloganE" id="EsloganE" value="<?php echo $EsloganEA ?>">
                            <label>Eslogan de la feria (*) </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <!--<img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">-->
                            <input type="file" name="LogoE" id="LogoE">
                            <label>Logo </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <!--<img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">-->
                            <input type="time" name="HoraE" id="HoraE" value="<?php echo $HoraEA ?>"
                                class="custom-time-input">
                            <label>Hora </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <!--<img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">-->
                            <input type="date" name="FechaE" id="FechaE" value="<?php echo $FechaEA ?>">
                            <label>Fecha (*)</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <!--<img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">-->
                            <label>Lugar (*) </label>
                            <select class="form-select" name="LugarE" id="LugarE"
                                onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;'
                                onblur="this.size=0;" aria-label="Default select example">
                                <option hidden selected>Seleccione el lugar del evento</option>
                                <?php echo $Sitiolist; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <button id="btnAgregarComision" class="btnAgregarComision"> Agregar lugar </button>
                            <!--<button id="btnEditarComision" class="btnEditarComision"> Editar comisión </button>-->
                        </div>
                    </div>

                    <button id="btnActDatosG" class="btnActDatosG">Guardar cambios</button>

                    <!--<button id="btnlimpiarcampos" class="btnlimpiarcampos" type="reset" >Limpiar campos</button>-->
                    <button id="btnCancelarR" class="btnCancelarR"> Cancelar </button>
                    <!--<button id="btnCancelarR" class="btnCancelarR" type="button" onclick="if (confirm('¿Deseas realmente cancelar el registro?')) window.location.href='../../Vista/Coordinador/Planificacion_Feria.php'">Cancelar registro</button>-->
                    <!--onclick="return confirm('¿Deseas realmente eliminar?');location.href='../../Vista/Coordinador/Planificacion_Feria.php'"-->




                </form>
            </div>

            <script type="text/javascript" src="../../Assets/js/General/jquery-3.6.0.min.js"></script>
            <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
            <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script type="text/javascript" src="../../Assets/js/Coordinador/Edit_PlanificacionE1.js"></script>
            <script src="../../Assets/js/General/menu_movil.js"></script>

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
                                    arriba</li>
                            </ul>
                        </div>

                        <div class="col-xs-6 col-md-3">
                            <ul class="footer-links">
                                <li><a href="../../Vista/Coordinador/IndexCoordinadorCE.php">Inicio</a></li>
                                <li><a href="../../Vista/Coordinador/EventoCoordinadorCE.php">Eventos</a></li>
                                <li><a href="../../Vista/Coordinador/AdminEventosCE.php">Administración de eventos</a>
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



                    </div>
                </div>
            </footer>
</body>

</html>