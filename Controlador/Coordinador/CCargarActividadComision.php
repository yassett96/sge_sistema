<?php

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$Id_ComisionAsigSelecc = $_POST['ComisionASel'];

    $result = $MCAsignada->Listar_ActividadesComision($Id_ComisionAsigSelecc);

    if($result == ''){
        $result = '<tr><td></td><td colspan="5">Aun no se han creado las hay actividades para esta comisión</td><td></td></tr>';
       
    }




    echo $result;

?>