<?php

require_once ("../../Modelo/Coordinador/MComisionesGenerales.php");

$MCGeneral = new ModComisionGen();

$Id_ComisionAsigSelecc = $_POST['ComisionASel'];

$result = $MCGeneral->Listar_ActividadesComision($Id_ComisionAsigSelecc);

if($result == ''){
    $result = '<tr><td></td><td colspan="5">Aun no se han creado las hay actividades para esta comisión</td></tr>';
   
}



    echo $result;

?>