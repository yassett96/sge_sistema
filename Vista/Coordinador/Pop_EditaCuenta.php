<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}





?>

<link rel="icon" href="../../Assets/imagenes/Recursos/Logo_UNI.png" height="30px" width="30px">

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_EditaCuentaDatos.css">

<div class="modal" id="Pop_ECuenta" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cuenta</span></h5>
                <!--<button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>-->
                <button type="button" class="Closedes" id="Closedes">X</button>
            </div>
            <div class="modal-body">

                <form id="MCuentaDatosC" name="MCuentaDatosC">
                    <p class="NotaCampos"><b><i> Edite los campos que desee</i></b></p>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="tel" name="NTel" id="NTel" value="<?php echo $_SESSION['Telefono']; ?>"
                                required>
                            <label>Teléfono: </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="email" name="NEmail" id="NEmail" value="<?php echo $_SESSION['Email']; ?>"
                                required>
                            <label>Correo </label>
                        </div>
                    </div>
                </form>


                <div class="modal-footer">

                    <button type="button" class="btncancelarc" id="btncancelarc">Cerrar</button>
                    <button type="button" class="btncontra" id="btncontra">Editar Contraseña</button>
                    <button type="button" class="btnguardarc" id="btnguardarc" data-bs-dismiss="modal">Guardar
                        cambios</button>


                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="../../Assets/js/Coordinador/Pop_EditaCuentaDatos.js"></script>