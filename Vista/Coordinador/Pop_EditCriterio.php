<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
 
$NombreCri = $_POST['NombreC'];
$DesCri = $_POST['DesC'];
$ValCri = $_POST['ValC'];
?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_EditCriterio.css">

<div class="modal" id="Pop_ED_C" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Editar Criterio</h5>
                    <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

            </div>
            <div class="modal-body">
                <form id="ECriterio" name="ECriterio">
                    <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="NCriterioEd" id="NCriterioEd" value="<?php echo $NombreCri ?>"
                                required>
                            <label>* Criterio : </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">

                            <p><textarea id="EDDescripcionC" class="EDDescripcionC" name="EDDescripcionC" required><?php echo $DesCri ?></textarea>
                            </p>
                            <label>* Descripción :</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="EDValorC" id="EDValorC" value="<?php echo $ValCri ?>" pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  >
                            <label class="ValorD">* Valor del criterio:</label>
                        </div>
                    </div>
                </form>


                <div class="modal-footer">

                    <button type="button" class="btnCancel_E_C" id="btnCancel_E_C">Cerrar</button>
                    <button type="button" class="btnEd_E_C" id="btnEd_E_C" data-bs-dismiss="modal">Guardar cambios </button>

                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="../../Assets/js/Coordinador/Pop_Criterio.js"></script>