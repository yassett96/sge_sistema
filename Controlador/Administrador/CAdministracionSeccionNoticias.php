<?php
    require_once("../../Modelo/Administrador/MAdministracionSeccionNoticias.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");    
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    if(isset($_GET["vparIdNoticias"]) && isset($_GET["vparDescripcion"]) && 
    isset($_GET["vparImagen"])){
        $locIdNoticias = $_GET["vparIdNoticias"];
        $vlocDescripcion = $_GET["vparDescripcion"];
        $vlocImagen = $_GET["vparImagen"];

        $vlocResultadoEdicion = FunModificarNoticias($locIdNoticias, $vlocDescripcion, $vlocImagen);

        echo $vlocResultadoEdicion;
    }

    if(isset($_GET["vparBoolObtenerListaNoticias"])){

        $vlocResultadoEdicion = FunObtenerListaNoticias();

        $cadena = implode(';', $vlocResultadoEdicion);
        // $cadena2 = explode(';', $cadena);
        // $cadena3 = explode(',', $cadena2);

        echo $cadena;
    }

    function FunObtenerListaNoticias(){
        $vlocListaNoticias = new AdministracionSeccionNoticiasModelo();

        $vlocResultado = $vlocListaNoticias->FunObtenerListaNoticias();

        $vlocDatosNoticias = array();

        if($vlocResultado == true){
            $vlocNumDatosPersonalAcademico = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosPersonalAcademico; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocDatosNoticias, $vlocRow['Descripcion']."-_-".$vlocRow['Imagen']);
                // array_push($vlocDatosNoticias, '<tr><td id="tdIdUsuarioSeleccionado" style="display:none;">'.$vlocRow['ID_Persona_Usuario'].'</td><td>'.$vlocRow['Tipo_Usuario'].'</td><td>'.$vlocRow['Primer_Nombre'].' '.$vlocRow['Segundo_Nombre'].'</td><td>'.$vlocRow['Primer_Apellido'].' '.$vlocRow['Segundo_Apellido'].'</td><td>'.$vlocRow['Telefono'].'</td><td>'.$vlocRow['Correo_Electronico'].'</td></tr>,');
            }                

            return $vlocDatosNoticias;
        }
    }

    function FunModificarNoticias($vparIdNoticias, $vparDescripcion, $vparImagen){
        $vlocEdicion = new AdministracionSeccionNoticiasModelo();

        $vlocResultado = $vlocEdicion->FunModificarNoticias($vparIdNoticias, $vparDescripcion, $vparImagen);
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