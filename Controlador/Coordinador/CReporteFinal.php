<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

/*$dirlocal = "/SGE_V2/sistema/SGE_V1/Assets/Reportes/";
$dir = $_SERVER['DOCUMENT_ROOT'] . $dirlocal;*/

$dir = "../../Assets/Reportes/";

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$dirlocal = "/SGE_Tesis/sge_sistema/SGE_V1/Assets/Reportes/";

//$dir= 'http://localhost/SGE_V2/sistema/SGE_V1/Assets/Reportes/';

$file = $_FILES['tFile'];
$NombreR = $_POST['tNombreRF'];
$IdComE = $_POST['tComision'];

date_default_timezone_set('America/Managua');

$fechaActual = date('d-m-yh_i_s');

$FechaR =  date('Y-m-d h_i_s');

$nombre = $NombreR;

$tipo_archivo = $_FILES['tFile']['type']; //obtener el tipo de archivo que se esta subiendo (image/png, application/x-zip-compressed)
    
$nombre_archivo = ($_FILES['tFile']['name']); //nombre del archivo subido

$ext = explode('.',$_FILES['tFile']['name']);//separar en arreglo la extencion del archivo del nombre del archivo

$dataext =end($ext);

$NombreReporte = $nombre.$fechaActual.".".$dataext; 

$DirDescarga = $protocol . $host . $dirlocal . $NombreReporte;

$DirReporte = $dir. $NombreReporte;

if (move_uploaded_file($_FILES['tFile']['tmp_name'], $dir.$NombreReporte)){

    $result = $MCAsignada->get_insertar_reporte($IdComE,$NombreReporte,$FechaR,$DirReporte,$DirDescarga);
    

    if ($result) {
        $URL_ultimoReporte = $MCAsignada->ObtenerUtlimoReporteIDCOM($IdComE);

        if ($URL_ultimoReporte) {
            if (file_exists($URL_ultimoReporte)) {
                if (unlink($URL_ultimoReporte)) {
                    echo $result;
                } else {
                    echo 'Ocurrió un error al eliminar el archivo.';
                }
            } else {
                 echo $result;
            }
        } else {
            echo 'No se pudo obtener la URL del último reporte.';
        }
    }

    
    

}else{
    echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
}



?>