<?php

session_start();

if($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3){
    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();
} 

?>
<link rel="stylesheet" href="../../Assets/css/Coordinador/editaricono.css">

<div class="modal" id="Pop_EditaIcono" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Avatar</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php	
        $ava = $_SESSION['Avatar'];
        $vlocStrHtml = '<div id="divImagenSeleccionada">';
        $vlocStrHtml = $vlocStrHtml . '<img id="imgAvatarSeleccionado" src="'.$ava.'">';
        /*$buton = '<button type="button" class="Cambiarico" value="Seleccione Icono"></button>';*/
        $vlocStrHtml = $vlocStrHtml . '<div id="divImagenSeleccion">';
        ?>
                <button type="button" class="Cambiarico" id="Cambiarico">Seleccione Avatar</button>
                <?php
        $direccionesImagenes = array(
                  '../../Assets/imagenes/Iconos/Avatar/Avatar001.jpg',
                  '../../Assets/imagenes/Iconos/Avatar/Avatar003.jpg',
                  '../../Assets/imagenes/Iconos/Avatar/Avatar006.jpg',
                  '../../Assets/imagenes/Iconos/Avatar/Avatar007.jpg',
                  '../../Assets/imagenes/Iconos/Avatar/Avatar008.jpg',
                  '../../Assets/imagenes/Iconos/Avatar/Avatar009.jpg',
                  '../../Assets/imagenes/Iconos/Avatar/Avatar010.jpg',
                  '../../Assets/imagenes/Iconos/Avatar/Avatar002.jpg',
                  '../../Assets/imagenes/Iconos/Avatar/Avatar004.jpg',
                  '../../Assets/imagenes/Iconos/Avatar/Avatar005.jpg',
                  '../../Assets/imagenes/Iconos/Avatar/Avatar011.jpg',
                  '../../Assets/imagenes/Iconos/Avatar/Avatar012.jpg',
                  '../../Assets/imagenes/Iconos/Avatar/Avatar013.jpg',
                  '../../Assets/imagenes/Iconos/Avatar/Avatar014.jpg'
        );

        foreach($direccionesImagenes as $i => $value){            
            $vlocStrHtml = $vlocStrHtml . "<div class='divContenedorAvatar'> <img class='imgAvatar' id='imgIdAvatar".$i."' src='".$direccionesImagenes[$i]."' onclick ='get_avatar_img(".$i.")'></div>";//nl2br($direccionesImagenes[$i] . "\n");
        }

        $vlocStrHtml = $vlocStrHtml . '</div>';
        $vlocStrHtml = $vlocStrHtml . '</div>';

        echo $vlocStrHtml;

        ?>



                <div class="modal-footer">

                    <button type="button" class="btncancelar" id="btncancelar">Cerrar</button>
                    <button type="button" class="btnguardar" id="btnguardar" data-bs-dismiss="modal">Guardar
                        cambios</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>
    <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
    </script>
    <script type="text/javascript" src="../../Assets/js/Coordinador/editaricono.js"></script>