<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}





?>

<link rel="icon" href="../../Assets/imagenes/Recursos/Logo_UNI.png" height="30px" width="30px">

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_EditaContra.css">

<div class="modal" id="Pop_EContra" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Editar Contraseña </span></h5>
                <!--<button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>-->
                <button type="button" class="ClosedesC" id="ClosedesC">X</button>
            </div>
            <div class="modal-body">
                <form id="MContraE" name="MContraE">

                    <div class="grupo">
                        <span><img class="M1 M2" src="../../Assets/imagenes/Recursos/Visto.png"></span>
                        <input type="password" name="npass" id="npass" required>
                        <label>Nueva contraseña</label>
                    </div>
                    <div class="grupo">
                        <span><img class="M1 M3" src="../../Assets/imagenes/Recursos/Visto.png"></span>
                        <input type="password" name="cpass" id="cpass" required>
                        <label>Confirmar contraseña</label>
                    </div>
                </form>
            </div>



            <div class="modal-footer">

                <button type="button" class="btncancelarc" id="btncancelarc">Cancelar</button>
                <button type="button" class="btnguardarc" id="btnguardarc" data-bs-dismiss="modal">Guardar
                    cambios</button>


            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="../../Assets/js/Coordinador/Pop_EditaContra.js"></script>