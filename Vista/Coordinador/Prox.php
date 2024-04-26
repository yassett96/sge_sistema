<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/PlanificacionE.php");

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

    <link rel="stylesheet" href="../../Assets/css/Coordinador/Prox.css">
    


    
    
    <title>Planificacion Feria E2</title>
</head>
<body >
<header>
        <div class="logo">
          <img src="../../Assets/imagenes/Recursos/FCyS balnco.png" height="50px">
        </div>
        <div class="menu_general">
          <ul class="nav justify-content-end">
            <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Coordinador/Index_Coordinador.php" >Inicio</a></li>
 <!--           <li class="nav-item"><a class="nav-link active" id="texto" href="../../Vista/Participante/Eventos_PSE.php">Eventos</a></li>
            <li class="nav-item"><a class="nav-link active" id="texto" href="">Administración de eventos</a></li>
           
            <li><a href="">Comisiones </a>
					<ul>
                        <a id="FondoNav" href="">Comisión asignada</a>
                        <a id="FondoNav" href="">Comisiones generales</a>
					</ul>
				</li>
            <li class="nav-item"><a class="nav-link active" id="texto" href="">Reportes</a></li>
-->
                <div class="dropdown">
                    <img src="<?php echo $_SESSION['Avatar']; ?>"  class="imgRedonda"/>
  
                    <div class="dropdown-content">
                        <a href="../../Vista/Coordinador/Prox.php">Mi cuenta</a>
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
              <img src="<?php echo $_SESSION['Avatar']; ?>"  class="imgRedonda link-item"/>
              <div class="NombreusuarioM"><?php echo $_SESSION['NombreCompleto']; ?></div>
        
                <a class="link-item"  href="../../Vista/Coordinador/Index_Coordinador.php" >Inicio</a>
   
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


   
</body>
</html>