<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

require_once ("../../Modelo/Coordinador/MHistorialEventoFeria.php");

$HistorialE = new MHistorialEF();

$id_Evento = $_POST['Id_EventoSel'];
/*$Nombrecat = $_POST['NombreCat'];
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
$IdFormatoCri = $DatosFormato['ID_Tipo_Formato'];*/

$ComisionesHE = $HistorialE->ListaComisionHE($id_Evento);
$CategoriasHE = $HistorialE->ListaCategoriasHE($id_Evento);
$ConferenciaHE = $HistorialE->ListaConferenciaHE($id_Evento);

 

?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_DetHistorialEvento.css">

<div class="modal" id="Pop_HistorialE" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detalles del evento seleccionado</span></h5>
                <button type="button" class="Closedes" id="Closedes">X</button>
            </div>


            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="DetComision-tab" data-toggle="tab" href="#ComisionesA" role="tab"
                        aria-controls="ComisionesA" aria-selected="true">Comisiones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="DetCategoriasYSub_E" data-toggle="tab" href="#CategoriasYSub_E" role="tab"
                        aria-controls="CategoriasYSub_E" aria-selected="false">Categorias y sub categoría</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="DetConferencias_E" data-toggle="tab" href="#Conferencias_E" role="tab"
                        aria-controls="Conferencias_E" aria-selected="false">Conferencias</a>
                </li>
             

            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ComisionesA" role="tabpanel"
                    aria-labelledby="Comisiones-tab">
                    <form class="form-signin1" id="idfrom1">

                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>Comisiones</label>

                                <input type="text" id="searchInputT1" placeholder="Buscar...">
                                <button type="button" id="btnBuscarTablaT1" onclick="filtrarTabla1()">Buscar</button>

                                <div id="MarcoComisionHE" class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table id="TComisionHE" name="TComisionHE"
                                        class="table  table-hover table-condensed table-striped table-bordered "
                                        style="z-index:3;">
                                        <thead>
                                            <tr>

                                                <th> Comision</th>
                                                <th> Responsable 1</th>
                                                <th> Responsable 2</th>
                                                <th> Responsable 3</th>
                                                 <th> Reporte final</th>
                                                 <th> Plan de trabajo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla-datosComision_HE">
                                            <?php echo $ComisionesHE ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

                <div class="tab-pane fade" id="CategoriasYSub_E" role="tabpanel" aria-labelledby="CategoriasYSub_E-tab">
                    <form class="form-signin2" id="fidcomentCEA" name="fidcomentCEA">

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label>Categorías y sub categoria </label>

                                <input type="text" id="searchInputT2" placeholder="Buscar...">
                                <button type="button" id="btnBuscarTablaT2" onclick="filtrarTabla2()">Buscar</button>

                                <div id="MarcoCatSubHE" class="table-wrapper-scroll-y my-custom-scrollbar-2">
                                    <table id="TCategoriaHE"
                                        class="table  table-hover table-condensed table-striped table-bordered "
                                        style="z-index:3;">
                                        <thead>
                                            <tr>

                                                <th> Categoria </th>
                                                <th> Sub categoria </th>
                                                <th> Año académico </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla-datosCatSub_HE">
                                            <?php echo  $CategoriasHE ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="tab-pane fade " id="Conferencias_E" role="tabpanel" aria-labelledby="Conferencias_E-tab">
                    <form class="form-signin3" id="idfrom3">

                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>Conferencias</label>

                                <input type="text" id="searchInputT3" placeholder="Buscar...">
                                <button type="button" id="btnBuscarTablaT3" onclick="filtrarTabla3()">Buscar</button>


                                <div id="MarcoConferenciaHE" class="table-wrapper-scroll-y my-custom-scrollbar-4">
                                    <table id="TConferenciaHE" name="TConferenciaHE"
                                        class="table  table-hover table-condensed table-striped table-bordered "
                                        style="z-index:3;">
                                        <thead>
                                            <tr>

                                                <th> Conferencia</th>
                                                <th> Conferencista</th>
                                                <th> Detalles </th>
                                                <th> Hora inicio</th>
                                                <th> Hora fin</th>
                                                <th> Sitio</th>
                                                <th> Salon</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla-datosConferencia_HE">
                                            <?php echo  $ConferenciaHE?>
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
                    <button type="button" class="btnCerrarPOP_HE" id="btnCerrarPOP_HE">Cerrar</button>
                </div>
            </div>



        </div>
    </div>
</div>

<script type="text/javascript" src="../../Assets/js/Coordinador/Pop_HistorialEvento.js"></script>