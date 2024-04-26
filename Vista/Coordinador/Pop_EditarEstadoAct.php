<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

$idComAct = $_POST['Id_ComAsig'];
$ListaEstados = $MCAsignada->select_EstadoAct($idComAct)
?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_EditarEstadoAct.css">


<div class="modal" id="Pop_EditarAct" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Actualizar estado actividad</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <form id="ModalEstadoA" name="ModalEstadoA">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="TEstadoAct"> Estado : </label>
                            <select class="form-select" name="EstadoActi" id="EstadoActi"
                                onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;'
                                onblur="this.size=0;" aria-label="Default select example">
                                <option hidden selected>Seleccione el año académico</option>
                                <?php echo $ListaEstados; ?>
                            </select>
                        </div>
                    </div>
                </form>

                <input type="hidden" id="IDCom_Act" value="<?php echo $idComAct; ?>">

                <div class="modal-footer">

                    <button type="button" class="btnCancel_EEA" id="btnCancel_EEA">Cerrar</button>
                    <button type="button" class="btnAEA" id="btnAEA" data-bs-dismiss="modal">Guardar
                        cambios</button>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="../../Assets/js/Coordinador/Pop_EditarEstadoAct.js"></script>