<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

/*require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();
$Id_ComisionAsigSelecc = $_POST['IDComisionAsig'];
$NombreComisionDE = $_POST["NComisionAsig"];
$ListaComisionApoyo = $MCAsignada->select_ComisionesEventoA($Id_ComisionAsigSelecc);
*/
?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_SubirReporteF.css">

<div class="modal" id="Pop_SubirRFinal" name="Pop_SubirRFinal" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="Alerta"></div>

            <div class="modal-header">
                <h5 class="modal-title">Subir Reporte final</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="ModalSubirReporteF" name="ModalSubirReporteF" >


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Nombre del reporte a subir: </label>
                            <input type="text" id="NombreReporte" class="NombreReporte" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <input type="file" name="ReporteF" id="ReporteF"  accept=".pdf,.xlsx">
                            <label id="LFile">Archivo </label>
                        </div>
                    </div>
                </form>



            </div>
            <div class="modal-footer">
                <button type="button" id="CerrarRF" class="CerrarRF" data-dismiss="modal">Cerrar</button>
                <button type="button" id="EnviarRFC" class="EnviarRFC" >Subir</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript" src="../../Assets/js/Coordinador/Pop_SubirReporteFinal_VS.js"></script>