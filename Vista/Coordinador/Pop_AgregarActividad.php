<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/MComisionAsignada.php");
require_once ("../../Modelo/Coordinador/PlanificacionE.php");

$MCAsignada = new ModComisionA();
$Id_ComisionAsigSelecc = $_POST['ComisionASel'];
$ListaIntegrantesComision = $MCAsignada->select_IntegrantesComisionA($Id_ComisionAsigSelecc);
$ListaComisionApoyo = $MCAsignada->select_ComisionesEventoA($Id_ComisionAsigSelecc);
$ListOtrosParticipantes = $MCAsignada->select_OtrosParticipantesA();

$PlanDG = new PlanificacionEM();
$DatosGEA = $PlanDG->ObtenerDatosGEvento();
$FechaEA = $DatosGEA['Fecha'];
 
?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_AgregarActividad.css">


<div class="modal" id="Pop_AActividad" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Agregar Nueva Actividad</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="MActividad" name="MActividad">
                    <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="NActividad" id="NActividad" required>
                            <label>* Nombre Actividad : </label>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">

                            <p><textarea id="DescripcionA" class="DescripcionA" name="DescripcionA" required></textarea>
                            </p>
                            <label>* Descripción :</label>
                        </div>
                    </div>

                    <!--
                    <div class="row">
                        <div class="form-group col-md-6">

                            <p><textarea id="RequerimientosA" class="RequerimientosA" name="RequerimientosA" required></textarea>
                            </p>
                            <label>* Requerimientos :</label>
                        </div>
                    </div>
                    -->

                    <div class="row">
                        <div class="form-group col-md-6">
                            <!--<img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">-->
                            <input type="date" name="FechaI" id="FechaI">
                            <input type="hidden" id="Fecha_IEvento" value="<?php echo $FechaEA; ?>">
                            <label>Fecha Inicio(*)</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <!--<img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">-->
                            <input type="date" name="FechaF" id="FechaF">
                            <label>Fecha Fin(*)</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label> * Requerimientos : </label>
                            <input type="text" name="RequerimientoA" id="RequerimientoA" required>


                        </div>
                        <div class="form-group col-md-8">

                            <button type="button" id="btonAgregarREQ">
                                <img src="../../Assets/imagenes/Recursos/agregar_req.png" id="iconoBtnReq">
                            </button>

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <div id="MarcoReq" class="table-wrapper-scroll-y my-custom-scrollbar-3">
                                <table id="TReq"
                                    class="table  table-hover table-condensed table-striped table-bordered "
                                    style="z-index:3;">
                                    <thead>
                                        <tr>
                                            <th> N </th>
                                            <th> Requerimientos </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <!--<tbody id="Tabla_Req">-->
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label> * Encargado de Actividad : </label>
                            <div>
                                <input type="checkbox" id="noSeleccionarRes" onchange="toggleSelect()" />
                                <label id="noSeleccionar">Toda la comisión</label>
                            </div>
                            <select class="form-select" name="IntegranteRes" id="IntegranteRes"
                                onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;'
                                onblur="this.size=0;" aria-label="Default select example">
                                <option value="" disabled selected hidden>Seleccione al encargado</option>
                                <?php echo $ListaIntegrantesComision; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <div id="MarcoInt" class="table-wrapper-scroll-y my-custom-scrollbar-4">
                                <table id="TIntegrantes"
                                    class="table  table-hover table-condensed table-striped table-bordered "
                                    style="z-index:3;">
                                    <thead>
                                        <tr>
                                            <th> N </th>
                                            <th> Integrantes </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody id="Tabla_Int">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label> * Comisión de apoyo: </label>
                            <div>
                                <input type="checkbox" id="noSeleccionarComA" onchange="toggleSelect()" />
                                <label id="noSeleccionarCom_A">Ninguna</label>
                            </div>
                            <select class="form-select" name="IntegranteCom" id="IntegranteCom"
                                onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;'
                                onblur="this.size=0;" aria-label="Default select example">
                                <option value="" disabled selected hidden>Seleccione una comisión</option>
                                <?php echo $ListaComisionApoyo; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <div id="MarcoCom" class="table-wrapper-scroll-y my-custom-scrollbar-5">
                                <table id="TComision"
                                    class="table  table-hover table-condensed table-striped table-bordered "
                                    style="z-index:3;">
                                    <thead>
                                        <tr>
                                            <th> N </th>
                                            <th> Comisiones de Apoyo </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody id="Tabla_Com">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label> *Otros Participantes : </label>
                            <div>
                                <input type="checkbox" id="noSeleccionarPar" onchange="toggleSelect()" />
                                <label id="noSeleccionar_Par">No Requiere</label>
                            </div>
                            <select class="form-select" name="IntegranteApoyo" id="IntegranteApoyo"
                                onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;'
                                onblur="this.size=0;" aria-label="Default select example">
                                <option value="" disabled selected hidden> Seleccione al personal de apoyo</option>
                                <?php echo $ListOtrosParticipantes; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <div id="MarcoIntA" class="table-wrapper-scroll-y my-custom-scrollbar-6">
                                <table id="TIntegrantesA"
                                    class="table  table-hover table-condensed table-striped table-bordered "
                                    style="z-index:3;">
                                    <thead>
                                        <tr>
                                            <th> N </th>
                                            <th> Participantes </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody id="Tabla_IntA">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </form>



                <div class="modal-footer">

                    <button type="button" class="btnCancel" id="btnCancel">Cerrar</button>
                    <button type="button" class="btnAdd_A" id="btnAdd_A" data-bs-dismiss="modal">Guardar
                        Registro</button>

                </div>
            </div>
        </div>
    </div>

    <script>
    function toggleSelect() {
        var checkbox = document.getElementById("noSeleccionarRes");
        var select = document.getElementById("IntegranteRes");
        var tabla = document.getElementById("TIntegrantes");

        if (checkbox.checked) {
            select.disabled = true;
            select.selectedIndex = -1;
            tabla.style.visibility = "hidden";
        } else {
            select.disabled = false;
            select.selectedIndex = 0;
            tabla.style.visibility = "visible";
        }

        var checkbox2 = document.getElementById("noSeleccionarComA");
        var select2 = document.getElementById("IntegranteCom");
        var tabla2 = document.getElementById("TComision");

        if (checkbox2.checked) {
            select2.disabled = true;
            select2.selectedIndex = -1;
            tabla2.style.visibility = "hidden";
        } else {
            select2.disabled = false;
            select2.selectedIndex = 0;
            tabla2.style.visibility = "visible";
        }

        var checkbox3 = document.getElementById("noSeleccionarPar");
        var select3 = document.getElementById("IntegranteApoyo");
        var tabla3 = document.getElementById("TIntegrantesA");

        if (checkbox3.checked) {
            select3.disabled = true;
            select3.selectedIndex = -1;
            tabla3.style.visibility = "hidden";
        } else {
            select3.disabled = false;
            select3.selectedIndex = 0;
            tabla3.style.visibility = "visible";
        }
    }

    function eliminarFila(fila) {
        const filaw = fila.parentNode.parentNode;
        filaw.remove();
        actualizarNumeros();
    }

    function actualizarNumeros() {

        const celdasNumero = document.querySelectorAll('.ordenPAA');
        const celdasNumero2 = document.querySelectorAll('.ordenIn');
        const celdasNumero3 = document.querySelectorAll('.ordenCE');

        if (celdasNumero.parentNode = 'ordenPAA') {
            for (let i = 0; i < celdasNumero.length; i++) {
                celdasNumero[i].textContent = i + 1;
            }
        }

        if (celdasNumero2.parentNode = 'ordenIn') {
            for (let j = 0; j < celdasNumero2.length; j++) {
                celdasNumero2[j].textContent = j + 1;
            }
        }

        if (celdasNumero3.parentNode = 'ordenCE') {
            for (let k = 0; k < celdasNumero3.length; k++) {
                celdasNumero3[k].textContent = k + 1;
            }
        }
    }
    </script>

    <script type="text/javascript" src="../../Assets/js/Coordinador/Pop_AgregarActividad.js"></script>