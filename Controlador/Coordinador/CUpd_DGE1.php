<?php

require_once ("../../Modelo/Coordinador/PlanificacionE.php");

$PlanDG = new PlanificacionEM();

$DatosGEA = $PlanDG->ObtenerDatosGEvento();
$ID_Evento = $DatosGEA['ID_Evento'];

require_once ("../../Modelo/Coordinador/PlanificacionE.php");

$PlanDG = new PlanificacionEM();



$dir = "../../Assets/imagenes/LogosEventos/"; //Direccion donde se almacenara la imagen o archivo

$file = $_FILES['tFile']; //Imagen o archivo subido

$TipoE = "1";
$NombreE = $_POST['tNombreE'];
$EsloganE = $_POST['tEsloganE'];
$HoraE = $_POST['tHoraE'];
$FechaE = $_POST['tFechaE'];
$LugarE = $_POST['tLugarE'];


/*if(isset($_POST['tHoraE']) and empty($_POST['tHoraE'])) {
    $HoraE = "NULL";
} */

if(isset($_POST['tFechaE']) and empty($_POST['tFechaE'])) {
    $FechaE = "0000-00-00";
} 

if(empty($_FILES['tFile'])) {

    

    $LogoEA = $DatosGEA['Logo'];

    $nombreBD1 = $LogoEA;
    $result = $PlanDG->get_Actualizar_DGeventoSF($TipoE,$NombreE,$EsloganE,$nombreBD1,$HoraE,$FechaE,$LugarE,$ID_Evento);
    echo $result;


}else{

    date_default_timezone_set('America/Managua');


    $fechaActual = date('d-m-y h_i_s');

    $nombre = "ImagenLogo";//NombreGenerico para el tipo de archivo
//$fechaActual = date("d-m-Y"); //fecha actual de la subida del archivo
//$horaActual = date("hh:i:s");
    
    $tipo_archivo = $_FILES['tFile']['type']; //obtener el tipo de archivo que se esta subiendo (image/png, application/x-zip-compressed)
    
    $nombre_archivo = ($_FILES['tFile']['name']); //nombre del archivo subido

    $ext = explode('.',$_FILES['tFile']['name']);//separar en arreglo la extencion del archivo del nombre del archivo

    $dataext =end($ext);

    $nombrefinal = $nombre.$fechaActual.".".$dataext; 
//Creacion del nombre final con el que se guardar el archivo en el servidor: combinando el nombre del archivo+ la fecha actual+ 
//la extencion del mismo que esta en la ultima posicion del arreglo en el cual se dividio el archivo para evitar 
//que exitan archivos duplicados 

    $nombreBD = $dir.$nombrefinal;//Nombre con el cual se almacenara el archivo combinado la ruta con el nombrefinal del mismo
    
if (move_uploaded_file($_FILES['tFile']['tmp_name'], $dir.$nombrefinal)){

        //move_uploaded_file
//Subida del archivo al server tomando el nombre que se genera de manera temporal y renombrandolo por la ruta donde estara
            $result = $PlanDG->get_Actualizar_DGevento($TipoE,$NombreE,$EsloganE,$nombreBD,$HoraE,$FechaE,$LugarE,$ID_Evento);
            
            echo $result;

            
        }else{
               echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
        }

}

?>