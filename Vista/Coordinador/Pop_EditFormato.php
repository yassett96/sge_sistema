<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
 
$NombreFor = $_POST['formato']['titulo'];
?>
<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_EditFormato.css">

<div class="modal" id="Pop_E_For" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Editar Formato</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <form id="MFormatoE" name="MFormatoE">
                    <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="NFormatoEd" id="NFormatoEd" value="<?php echo $NombreFor ?> "
                                required>
                            <label>* Nombre del formato : </label>
                        </div>
                    </div>
                </form>


                <div class="modal-footer">

                    <button type="button" class="btnCancel_E_F" id="btnCancel_E_F">Cerrar</button>
                    <button type="button" class="btnEd_For" id="btnEd_For" data-bs-dismiss="modal">Guardar
                        cambios</button>

                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="../../Assets/js/Coordinador/Pop_Formato.js"></script>