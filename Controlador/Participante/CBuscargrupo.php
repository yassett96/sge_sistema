<?php



require_once ("../../Modelo/General/MGrupo.php");

$modelogrupo = new GrupoModel();

$Id_sede = '';

if(isset($_POST['sede']) and !empty ($_POST['sede']))

    $Id_sede = $_POST['sede'];

    $result = $modelogrupo->lista_sedegrupo($Id_sede);

    echo $result;

?>
