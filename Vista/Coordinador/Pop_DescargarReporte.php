<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}


?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_DescargaReporte.css">


<div class="modal" id="Pop_DesRepo" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Seleecione el tipo de archivo</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <form id="ModalDescarga" name="ModalDescarga">
                    <div class="row">
                        <div class="form-group col-md-6">

                            <div>
                                <input type="checkbox" id="ReporteTPDF"
                                    onchange="toggleCheckbox('ReporteTPDF', 'ReporteTExcel')" />
                                <label id="RepPDF">PDF</label>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">

                            <div>
                                <input type="checkbox" id="ReporteTExcel"
                                    onchange="toggleCheckbox('ReporteTExcel', 'ReporteTPDF')" />
                                <label id="RepExcel">Excel </label>
                            </div>

                        </div>
                    </div>

                </form>


                <div class="modal-footer">

                    <button type="button" class="btnCerrar_Des" id="btnCerrar_Des"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btnDescarga" id="btnDescarga">Descargar</button>

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

    <script>
    function toggleCheckbox(checkboxId, otherCheckboxId) {
        var checkbox = document.getElementById(checkboxId);
        var otherCheckbox = document.getElementById(otherCheckboxId);

        if (checkbox.checked) {
            otherCheckbox.checked = false;
        }
    }
    </script>

    <script type="text/javascript" src="../../Assets/js/Coordinador/Pop_DescargaReporte.js"></script>