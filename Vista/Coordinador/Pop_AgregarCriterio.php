<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
 
?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_AgregarCriterio.css">

<div class="modal" id="Pop_A_C" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Agregar Criterio</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div id="Alerta"></div>
                <form id="ModCriterioA" name="ModCriterioA">

                    <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="NCriterioAd" id="NCriterioAd" required>
                            <label>* Nombre criterio : </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">

                            <p><textarea id="DescripcionC" class="DescripcionC" name="DescripcionC" required></textarea>
                            </p>
                            <label>* Descripción :</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="ValorC" id="ValorC" pattern="[0-9]+"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            <label class="ValorD">* Valor del criterio:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <button id="btnADD_C" class="btnADD_C"> Agregar criterio</button>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="form-group col-md-8">
                        <div id="MarcoAdd_C" class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table id="TAddCriterios" name="TCatsub"
                                class="table  table-hover table-condensed table-striped table-bordered "
                                style="z-index:3;">
                                <thead>
                                    <tr>
                                        <th> N</th>
                                        <th> Criterio</th>
                                        <th> Descripcion</th>
                                        <th> Valor </th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-Acriterios">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <div class="modal-footer">

                    <button type="button" class="btnCancel_A_C" id="btnCancel_A_C">Cerrar</button>
                    <button type="button" class="btnAdd_A_C opacity-50" id="btnAdd_A_C" data-bs-dismiss="modal" disabled>Guardar
                        cambios</button>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../../Assets/js/Coordinador/Pop_Criterio.js"></script>