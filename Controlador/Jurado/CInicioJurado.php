<?php

require_once ("../../Modelo/Jurado/MInicioJurado.php");
require_once ("../../Assets/AuxiliarPhp/helperPhp.php");
require_once ("../../Assets/AuxiliarPhp/Constants.php");

    $modelevento = new MEvento_Coordinador();
    
    $datosp = $modelevento->MostrarProyectos_Cat();
    
    $datose = $modelevento->MostrarEventoF();
    $datosf = mysqli_fetch_array($datose);
    

    $datosc = $modelevento->MostrarCat_Subcategoria();

?>