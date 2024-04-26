<?php
    require_once("../../Modelo/Administrador/MAdministracionCarruselInicio.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");    
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    if(isset($_GET["vparIdNoticias"]) && isset($_GET["vparDescripcion"]) && 
    isset($_GET["vparImagen"])){
        $locIdNoticias = $_GET["vparIdNoticias"];
        $vlocDescripcion = $_GET["vparDescripcion"];
        $vlocImagen = $_GET["vparImagen"];

        $vlocResultadoEdicion = FunModificarImagenCarruselInicio($locIdNoticias, $vlocDescripcion, $vlocImagen);

        echo $vlocResultadoEdicion;
    }

    if(isset($_GET["vparBoolObtenerListaImagenesCarruselNoticias"])){

        $vlocResultadoEdicion = FunObtenerListaImagenesCarruselNoticias();

        $cadena = implode(';', $vlocResultadoEdicion);
        // $cadena2 = explode(';', $cadena);
        // $cadena3 = explode(',', $cadena2);

        echo $cadena;
    }

    function FunObtenerListaImagenesCarruselNoticias(){
        $vlocListaImagenesCarruselNoticias = new AdministracionCarruselInicio();

        $vlocResultado = $vlocListaImagenesCarruselNoticias->FunObtenerListaImagenesCarruselNoticias();

        $vlocDatosImagenes = array();

        if($vlocResultado == true){
            $vlocNumDatosPersonalAcademico = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosPersonalAcademico; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocDatosImagenes, $vlocRow['Descripcion']."-_-".$vlocRow['Imagen']);
                // array_push($vlocDatosNoticias, '<tr><td id="tdIdUsuarioSeleccionado" style="display:none;">'.$vlocRow['ID_Persona_Usuario'].'</td><td>'.$vlocRow['Tipo_Usuario'].'</td><td>'.$vlocRow['Primer_Nombre'].' '.$vlocRow['Segundo_Nombre'].'</td><td>'.$vlocRow['Primer_Apellido'].' '.$vlocRow['Segundo_Apellido'].'</td><td>'.$vlocRow['Telefono'].'</td><td>'.$vlocRow['Correo_Electronico'].'</td></tr>,');
            }                

            return $vlocDatosImagenes;
        }
    }

    function FunModificarImagenCarruselInicio($vparIdImagen, $vparDescripcion, $vparImagen){
        $vlocEdicion = new AdministracionCarruselInicio();

        $vlocResultado = $vlocEdicion->FunModificarImagenCarruselInicio($vparIdImagen, $vparDescripcion, $vparImagen);
        // echo $vlocResultado;
        // exit;

        $vlocResultadoEdicion = '';

        if($vlocResultado == true){
            $vlocNumFilasResultado = $vlocResultado->num_rows;

            // for($i=0; $i<$vlocNumFilasResultado; $i++){
            //     $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                
            //     $vlocResultadoEliminacion = $vlocRow['Resultado_Eliminacion'];
            // }                

            while($vlocRow = $vlocResultado->fetch_assoc()){
                $vlocResultadoEdicion .= $vlocRow["Resultado_Modificacion"];
            }

            return $vlocResultadoEdicion;
        }
    }