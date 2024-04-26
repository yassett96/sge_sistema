<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$Id_ComisionAsigSelecc = $_POST['ComisionASel'];

    $ReporteActual = $MCAsignada->ObtenerReporteFinalActual($Id_ComisionAsigSelecc);

    $URL = $ReporteActual['ReporteFinal'];
    $IdRegRep = $ReporteActual['ID_ReporteFinal_CE'];

    if ($URL) {
        if (file_exists($URL)) {
            if (unlink($URL)) {
                $result = $MCAsignada->get_EliminarIDReporte($IdRegRep);
            } else {
                echo 'Ocurrió un error al eliminar el archivo.';
            }
        } else {
            echo 'El archivo no existe en el servidor.';
        }
    } else {
        echo 'No se pudo obtener la URL del último reporte.';
    }

    echo $result;

?>