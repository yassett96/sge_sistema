<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$Id_Actividad = $_POST['Id_ComAsig'];

$ListaReq = $MCAsignada->Listar_RequerimientosAct($Id_Actividad);
$ListaRes= $MCAsignada->Listar_ResponsablesAct($Id_Actividad);
if (empty($ListaRes)){
  $ListaRes = '<tr><td></td><td colspan="5">Todos los integrantes de la comisión</td></tr>';
}
$ListaComA = $MCAsignada->Listar_ComisionApoyoAct($Id_Actividad);
if (empty($ListaComA)){
  $ListaComA = '<tr><td></td><td colspan="5">Ninguna</td></tr>';
}
$ListaPersonalA = $MCAsignada->Listar_PersonalApoyoAct($Id_Actividad);
if (empty($ListaPersonalA)){
  $ListaPersonalA = '<tr><td></td><td colspan="5">No Requiere</td></tr>';
}


?>
<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_ComisionAsignada.css">

<div class="modal" id="Pop_DetComAct" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detalles de Actividad</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!--<button type="button" class="Closedes" id="Closedes"  >X</button>-->
            </div>

            <div class="modal-body">
                <div id="Det_ComAsig" class="Det_ComAsig">
                    <form>
                        <div id="contenedor"></div>
                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="DetReqResAct-tab" data-toggle="tab" href="#ReqResAct"
                                    role="tab" aria-controls="ReqResAct" aria-selected="true">Requerimientos y
                                    Responsables</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="DetComAOPar-tab" data-toggle="tab" href="#ComAOPar" role="tab"
                                    aria-controls="ComAOPar" aria-selected="false">Comisiones de apoyo y otros
                                    participantes</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="ReqResAct" role="tabpanel"
                                aria-labelledby="ReqResAct-tab">
                                <form class="form-signin" id="idfrom">
                                    <div class="row">
                                        <div class="form-group col-md-10">
                                            <label>Requerimientos</label>
                                            <div id="MarcoReqComA" class="table-wrapper-scroll-y my-custom-scrollbar-7">
                                                <table id="TReqComA" name="TReqComA"
                                                    class="table  table-hover table-condensed table-striped table-bordered "
                                                    style="z-index:3;">
                                                    <thead>
                                                        <tr>
                                                            <th> N</th>
                                                            <th> Requerimientos</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabla-ReqComAct">
                                                        <?php echo $ListaReq ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-10">
                                            <label>Encargados de la actividad</label>
                                            <div id="MarcoResComA" class="table-wrapper-scroll-y my-custom-scrollbar-8">
                                                <table id="TResComA" name="TResComA"
                                                    class="table  table-hover table-condensed table-striped table-bordered "
                                                    style="z-index:3;">
                                                    <thead>
                                                        <tr>
                                                            <th> N</th>
                                                            <th> Responsable</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabla-ResComAct">
                                                        <?php echo $ListaRes ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="ComAOPar" role="tabpanel" aria-labelledby="ComAOPar-tab">
                                <form class="form-signin" id="fidcomentCEA" name="fidcomentCEA">
                                    <div class="row">
                                        <div class="form-group col-md-10">
                                            <label>Comisiones de Apoyo</label>
                                            <div id="MarcoCAComAct"
                                                class="table-wrapper-scroll-y my-custom-scrollbar-9">
                                                <table id="TCAComAct" name="TCAComAct"
                                                    class="table  table-hover table-condensed table-striped table-bordered "
                                                    style="z-index:3;">
                                                    <thead>
                                                        <tr>
                                                            <th> N</th>
                                                            <th> Comisiones de Apoyo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabla-CAComAct">
                                                        <?php echo $ListaComA  ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-10">
                                            <label>Otros Participantes</label>
                                            <div id="MarcoOPComAct"
                                                class="table-wrapper-scroll-y my-custom-scrollbar-10">
                                                <table id="TOPComAct" name="TOPComAct"
                                                    class="table  table-hover table-condensed table-striped table-bordered "
                                                    style="z-index:3;">
                                                    <thead>
                                                        <tr>
                                                            <th> N</th>
                                                            <th> Participantes</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabla-OPComAct">
                                                        <?php echo  $ListaPersonalA ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
                </form>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <button type="button" class="btnCerrarPOP_CEA" id="btnCerrarPOP_CEA">Cerrar</button>
                </div>
            </div>
        </div>


    </div>
</div>
</div>



<script type="text/javascript" src="../../Assets/js/Coordinador/Pop_DetComisionAsignada.js"></script>