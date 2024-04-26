<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/MReportes.php");

$MRep = new ModReportes();

$ListaComisiones = $MRep->Select_ComisionesEventoActual();

?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_DescargaPlan_Reporte.css">


<div class="modal" id="Pop_DesRepo" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Seleecione la comisión del evento</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <form id="ModalDescarga" name="ModalDescarga">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="TEstadoAct">Comision del Evento: </label>
                            <select class="form-select" name="ComisionesEA" id="ComisionesEA"
                                onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;'
                                onblur="this.size=0;" aria-label="Default select example">
                                <option hidden selected>Seleccione una comisión</option>
                                <?php echo $ListaComisiones; ?>
                            </select>
                        </div>
                    </div>



                </form>


                <div class="modal-footer">

                    <button type="button" class="btnCerrar_Des" id="btnCerrar_Des"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btnDescarga" id="btnDescarga2">Descargar</button>

                    <div class="loader">

                        <div class="loader-bar" id="loaderBar">

                        </div>

                        <div id="TextoCarga">
                            <label id="CargaTextL" class="CargaTextL"> Cargando reporte ... </label>
                        </div>

                    </div>

                    <div id="loaderPercentage">0%</div>

                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript" src="../../Assets/js/Coordinador/Pop_DescargaPlan_Reporte.js"></script>