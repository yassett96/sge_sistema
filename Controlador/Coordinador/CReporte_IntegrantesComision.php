<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once("../../Modelo/Coordinador/MComisionAsignada.php");
require_once("../../Modelo/Coordinador/MReportes.php");

$MCAsignada = new ModComisionA();
$MReportes = new ModReportes();

if (isset($_GET['variable1'])) {
    $IDcomisionA = $_GET['variable1'];
} 
if (isset($_GET['variable2'])) {
    $variable2 = $_GET['variable2'];
}

$IntegrantesCom = $MReportes->Listar_ReporteIntegrantesComision($IDcomisionA);
$NombreFeria = $MCAsignada->ConsultarNombreFeria();

//echo($_GET['variable1']);

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


    <title>Plan de trabajo <?php echo $variable2; ?></title>

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
    </style>
</head>

<body>
    <header>
        <div class="Logo">
            <img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/SGE_V2/sistema/SGE_V1/Assets/imagenes/Recursos/Logo_UNI.png"
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
            <label class="TextUNI3"><em>Integrantes de la <?php echo $variable2; ?></em></label>
        </div>
    </header>


    <div class="row" style="margin-top:2%; margin-left:25%;">

        <div id="MarcoAct" class="table-wrapper-scroll-y my-custom-scrollbar">
            <table id="TActividades" name="TActividades" class="custom-table">
                <thead>
                    <tr>
                        <th colspan="1"> N</th>
                        <th> Integrantes </th>
                        <th> Responsable </th>
                    </tr>
                </thead>
                <tbody id="tabla-actividades">
                    <?php echo $IntegrantesCom ; ?>
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

$titlePFD= "Plan de Trabajo ".$variable2.".pdf";

$dompdf->stream($titlePFD, array("Attachment" =>false));
?>