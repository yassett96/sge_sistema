
<?php
session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 2)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$vlocTextoSelect = $_GET['vparTextoSelect'];
$vlocAñoActual = $_GET['vparAñoActual'];
$vlocIdProyecto1 = $_GET['vparIdProyecto1'];
$vlocDatosProyecto1 = $_GET['vparDatosProyecto1'];
$vlocIntegrantesProyecto1 = $_GET['vparIntegrantesProyecto1'];
$vlocIdProyecto2 = $_GET['vparIdProyecto2'];
$vlocDatosProyecto2 = $_GET['vparDatosProyecto2'];
$vlocIntegrantesProyecto2 = $_GET['vparIntegrantesProyecto2'];
$vlocStrNombreProyecto1 = $_GET['vparStrNombreProyecto1'];
$vlocStrTutorProyecto1 = $_GET['vparStrTutorProyecto1'];
$vlocStrPuntajeProyecto1 = $_GET['vparStrPuntajeProyecto1'];
$vlocStrNombreProyecto2 = $_GET['vparStrNombreProyecto2'];
$vlocStrTutorProyecto2 = $_GET['vparStrTutorProyecto2'];
$vlocStrPuntajeProyecto2 = $_GET['vparStrPuntajeProyecto2'];
$vlocStrNombreIntegrante1P1 = $_GET['vparStrNombreIntegrante1P1'];
$vlocStrNombreIntegrante2P1 = $_GET['vparStrNombreIntegrante2P1'];
$vlocStrNombreIntegrante3P1 = $_GET['vparStrNombreIntegrante3P1'];
$vlocStrNombreIntegrante1P2 = $_GET['vparStrNombreIntegrante1P2'];
$vlocStrNombreIntegrante2P2 = $_GET['vparStrNombreIntegrante2P2'];
$vlocStrNombreIntegrante3P2 = $_GET['vparStrNombreIntegrante3P2'];
$vlocStrFilaPrimerLugar = $_GET['vparStrFilaPrimerLugar'];
$vlocStrFilaSegundoLugar = $_GET['vparStrFilaSegundoLugar'];

$ActividadesCom = '';
$NombreFeria = $MCAsignada->ConsultarNombreFeria();
$vlocContenidoTabla = '';

// Para agregar los lugares
if ($vlocIdProyecto1 != ''){
    $vlocFilaPrimeros20P1 = substr($vlocStrFilaPrimerLugar, 0, 20);
    $vlocFilaDespues20P1 = substr($vlocStrFilaPrimerLugar, 20);

    $vlocFilaPrimeros20P2 = substr($vlocStrFilaSegundoLugar, 0, 20);
    $vlocFilaDespues20P2 = substr($vlocStrFilaSegundoLugar, 20);

    $vlocStrFilaPrimerLugar = $vlocFilaPrimeros20P1 . '<td>1</td>' . $vlocFilaDespues20P1;
    if($vlocIdProyecto2 != ''){
    $vlocStrFilaSegundoLugar = $vlocFilaPrimeros20P2 . '<td>2</td>' . $vlocFilaDespues20P2;
    }

    if($vlocIdProyecto2 != ''){
        $vlocStrFilaSegundoLugar = $vlocFilaPrimeros20P2 . '<td>2</td>' . $vlocFilaDespues20P2;
    }

    // Contenido total de la tabla
    $vlocContenidoTabla = $vlocStrFilaPrimerLugar . $vlocStrFilaSegundoLugar;
}

ob_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>


    <link rel="stylesheet" href="../../Assets/css/General/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/herramientas/font-awesome-4.7.0/css/font-awesome.min.css">

    <!--<link rel="stylesheet" href="../../Assets/css/Coordinador/VistaReporte.css">-->

    <!--<link rel="stylesheet" type="text/css" href="ruta/progressbar.css">-->


    <title>Lista ganadores sub categoría '<?php echo $vlocTextoSelect; ?>'</title>

    <style>
    .custom-table {
        border-collapse: collapse;
    }

    .custom-table td {
        vertical-align: top;
        border: 1px solid black;
        padding: 10px;

    }

    
    .custom-table th {
        border: 1px solid black;
        padding: 10px;
    }

    .custom-table th {
        text-align: center;
        background-color: #f2f2f2;
    }

    #Anchio {
        background-color: #000000;
        display: none;
    }

    #TActividades{        
        text-align: center;
    }

    .centered-table {
        margin: 0 auto; /* Establece márgenes automáticos para centrar horizontalmente */
    }
    </style>
</head>

<body>
    <header>
        <div class="Logo">
            <img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/SGE_Tesis/sge_sistema/SGE_V1/Assets/imagenes/Recursos/Logo_UNI.png"
                height="8%" width="10%">
            <!--<img src="../../Assets/imagenes/Recursos/Logo_UNI.png" height="80%" width="80%">-->
        </div>
        <div style="text-align: center; margin-top:-8%">
            <label class="TextUNI1"><em><strong>UNIVERSIDAD NACIONAL DE INGENIERÍA</strong></em></label>
        </div>
        <div style="text-align: center;">
            <label class="TextUNI2"><em>FACULTAD DE CIENCIAS Y SISTEMAS</em></label>
        </div>
        <div style="text-align: center;">
            <label class="TextUNI2"><em><?php echo $NombreFeria; ?></em></label>
        </div>
        <div style="text-align: center;">
            <label class="TextUNI3"><em>Reporte de ganadores de la sub categoría '<?php echo $vlocTextoSelect; ?>'</em></label>
        </div>
    </header>


    <div class="row" style="margin-top:2%;">

        <div id="MarcoAct" class="table-wrapper-scroll-y my-custom-scrollbar">
            <table id="TActividades" name="TActividades" class="custom-table centered-table">
                <thead>
                    <tr>
                        <th>Lugar</th>
                        <th>Proyecto</th>
                        <th>Integrante 1</th>
                        <th>Integrante 2</th>
                        <th>Integrante 3</th>
                        <th>Tutor</th>
                        <th>Puntaje</th>
                    </tr>
                </thead>
                <tbody id="tabla-actividades">
                    <?php 
                        echo $vlocContenidoTabla;
                    ?>
                </tbody>
            </table>

        </div>

    </div>
</body>

</html>

<?php

    $html=ob_get_clean();
    //echo $html;

    require_once '../../Assets/herramientas/dompdf/autoload.inc.php';
    USE Dompdf\Dompdf;
    $dompdf = new Dompdf();

    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' =>true));
    $dompdf->setOptions($options);

    $dompdf->loadhtml($html);

    $dompdf->setPaper('letter','landscape');
    //$dompdf->setPaper('A4','landscape');

    $dompdf->render();

    $titlePFD= "Plan de Trabajo Monodongo.pdf";

    $dompdf->stream($titlePFD, array("Attachment" => false));
?>