<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();
$Id_ComisionAsigSelecc = $_POST['IDComisionAsig'];
$NombreComisionDE = $_POST["NComisionAsig"];
$ListaComisionApoyo = $MCAsignada->select_ComisionesEventoA($Id_ComisionAsigSelecc);

?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_RealizarSolicitudE.css">

<div class="modal" id="Pop_RSolExtra" name="Pop_RSolExtra" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="Alerta"></div>

            <div class="modal-header">
                <h5 class="modal-title">Realizar solicitud extra</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="ModalRealizarSolE" name="ModalRealizarSolE">


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>De : </label>
                            <input type="text" id="LabelComision" name="LabelComision" class="disabled-input"
                                placeholder=" <?php echo $NombreComisionDE; ?>" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="TEstadoAct"> Para : </label>
                            <select class="form-select" name="ComisionPara" id="ComisionPara"
                                onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;'
                                onblur="this.size=0;" aria-label="Default select example">
                                <option hidden selected>Seleccione una comisión</option>
                                <?php echo $ListaComisionApoyo; ?>
                            </select>
                        </div>
                    </div>




                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Asunto: </label>
                            <input type="text" id="AsuntoConsulta" class="AsuntoConsulta" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Escribe tu consulta: </label>
                           <p><textarea id="MsjConsulta" class="MsjConsulta" name="visitor_message"
                                    placeholder="¿Cual es tu consulta?" required></textarea></p>
                        </div>
                    </div>
                </form>



            </div>
            <div class="modal-footer">
                <button type="button" id="CerrarSol" class="CerrarSol" data-dismiss="modal">Cerrar</button>
                <button type="button" id="EnviarSol" class="EnviarSol">Enviar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="../../Assets/js/Coordinador/Pop_RealizarSolicitudE.js"></script>