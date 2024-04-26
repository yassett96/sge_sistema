<?php

    if (isset($_FILES['imagen'])) {
        $archivo = $_FILES['imagen'];
    
        // Verificar que el archivo es una imagen válida
        $tipoImagen = exif_imagetype($archivo['tmp_name']);
        if (!($tipoImagen == IMAGETYPE_JPEG || $tipoImagen == IMAGETYPE_PNG)) {
        die('Error: El archivo seleccionado no es una imagen válida.');
        }
    
        // Mover el archivo a la carpeta de destino
        $rutaDestino = '../../Assets/Imagenes/Noticias/' . $archivo['name'];
        if (!move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
        die('Error: No se pudo mover el archivo a la carpeta de destino.');
        }
    
        echo 'Imagen subida exitosamente.';
    }
?>