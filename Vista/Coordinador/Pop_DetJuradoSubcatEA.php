<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

require_once ("../../Modelo/Coordinador/MJurado.php");

$PlanE5 = new MJUrado();

$ID_SubCatEA = $_POST['Id_Sub'];
$Nombrecat = $_POST['NombreCat'];
$Nombresubcat = $_POST['NombreSubC'];   

$J1_CEA = $PlanE5->select_J1CEA($ID_SubCatEA);
$J2_CEA = $PlanE5->select_J2CEA($ID_SubCatEA);
if (empty($J2_CEA)){
  $J2_CEA = " - No se asigno Jurado 2 -";
}
$J3_CEA = $PlanE5->select_J3CEA($ID_SubCatEA);
if (empty($J3_CEA)){
  $J3_CEA = " - No se asigno Jurado 3 -";
}

$DatosFormato = $PlanE5->ObtenerDatosFormato($ID_SubCatEA);

$NombreFor = $DatosFormato['NombreFormato'];
$IdFormatoCri = $DatosFormato['ID_Tipo_Formato'];

$CriteriosFor = $PlanE5->Criterios_Formato($IdFormatoCri);

 

?>
<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_DetJuradoSubEA.css">

<div class="modal" id="Pop_JuradoEA" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detalles de Jurado por Subcategoria <span id="nombre-categoria"></span></h5>
                <button type="button" class="Closedes" id="Closedes">X</button>
            </div>

            <div class="modal-body">
                <div id="DJ_EActual" class="JuradosXSub_EA">

                    <form class="form-signin" id="idfrom">

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label>Categoría </label>
                                <input type="text" value="<?php echo $Nombrecat ?>" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label>Subcategoría </label>
                                <input type="text" value="<?php echo $Nombresubcat ?>" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label>Jurado 1 </label>
                                <input type="text" value="<?php echo $J1_CEA ?>" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label>Jurado 2 </label>
                                <input type="text" value="<?php echo $J2_CEA ?>" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label>Jurado 3 </label>
                                <input type="text" value="<?php echo $J3_CEA ?>" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label>Formato de Evaluación </label>
                                <input type="text" value="<?php echo $NombreFor ?>" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>Criterios:</label>
                                <div id="MarcoJurEA" class="table-wrapper-scroll-y my-custom-scrollbar-2">
                                    <table id="TJurEA" name="TJurEA"
                                        class="table  table-hover table-condensed table-striped table-bordered "
                                        style="z-index:3;">
                                        <thead>
                                            <tr>
                                                <th> N</th>
                                                <th> Criterio</th>
                                                <th> Descripcion</th>
                                                <th> Valor </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="tabla-JurEA">
                                            <?php echo $CriteriosFor ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <button type="button" class="btnCerrarPOP_JurEA" id="btnCerrarPOP_JurEA">Cerrar</button>
                </div>
            </div>
        </div>


    </div>
</div>
</div>

<script type="text/javascript" src="../../Assets/js/Coordinador/Pop_DetJuradoSubEA.js"></script>