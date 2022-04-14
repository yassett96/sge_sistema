<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="..\..\pruebaSeleccionAvatar\assets\css\index.css">
</head>
<body>

    <div id="divImagenSeleccionada">
        <img id="imgAvatarSeleccionado" src='..\..\pruebaSeleccionAvatar\iconos\fotografo.png'>

        <div id="divImagenSeleccion">    
        <?php 

        $direccionesImagenes = array(
            '..\..\pruebaSeleccionAvatar\iconos\avatar1.png',
            '..\..\pruebaSeleccionAvatar\iconos\avatar2.png',
            '..\..\pruebaSeleccionAvatar\iconos\avatar3.png',
            '..\..\pruebaSeleccionAvatar\iconos\avatar4.png',
            '..\..\pruebaSeleccionAvatar\iconos\avatar5.png'
        );
                
        foreach($direccionesImagenes as $i => $value){            
            echo "<div class='divContenedorAvatar'> <img class='imgAvatar' id='imgIdAvatar".$i."' src='".$direccionesImagenes[$i]."' onclick ='get_avatar_img(".$i.")'></div>";//nl2br($direccionesImagenes[$i] . "\n");
        }

        ?>        
        </div>  

    </div>

    <script src='..\..\pruebaSeleccionAvatar\assets\js\index.js'></script>
</body>
</html>