<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
 
?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_AgregarLugar.css">

<div class="modal" id="Pop_AL" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Agregar Lugar</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div id="Alerta"></div>
                <form id="ModalLugar" name="ModalLugar">
                    <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="Popinput" name="NombreLugar" id="NombreLugar" required>
                            <label class="PopLabel">* Nombre del lugar : </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="Popinput" name="NombreSalon" id="NombreSalon" required>
                            <label class="PopLabel">* Nombre del salón : </label>
                        </div>

                    </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="popselect"name="Capacidad" id="Capacidad" pattern="[0-9]+"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            <label class="PopLabel">* Capacidad del salón:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <button id="btnAg_subcate" class="btnAg_subcate"> Añadir salón </button>

                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-8">
                            <div id="MarcoADDSalon" class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table id="TADDSalon"
                                    class="table  table-hover table-condensed table-striped table-bordered "
                                    style="z-index:3;">
                                    <thead>
                                        <tr>
                                            <th> N</th>
                                            <th> Salón</th>
                                            <th> Capacidad </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>




                    <div class="modal-footer">

                        <button type="button" class="btnCancel_AC" id="btnCancel_AC">Cerrar</button>
                        <button type="button" class="btnADD_AC" id="btnADD_AC" data-bs-dismiss="modal">Guardar
                            cambios</button>
                    </div>
                </div>
            </div>
        </div>


        <script type="text/javascript" src="../../Assets/js/Coordinador/Pop_Lugar.js"></script>