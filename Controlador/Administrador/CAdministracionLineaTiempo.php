<?php
    require_once("../../Modelo/Administrador/MAdministracionLineaTiempo.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");    
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    if(isset($_GET["vparIdEnlaceLineaTiempo"]) && isset($_GET["vparFase"]) && 
    isset($_GET["vparEnlace"])){
        $vlocIdEnlaceLineaTiempo = $_GET["vparIdEnlaceLineaTiempo"];
        $vlocFase = $_GET["vparFase"];
        $vlocEnlace = $_GET["vparEnlace"];

        $vlocResultadoEdicion = FunEditarEnlacesLineaTiempo($vlocIdEnlaceLineaTiempo, $vlocFase, $vlocEnlace);

        echo $vlocResultadoEdicion;
    }

    if(isset($_GET["vparIdEnlaceLineaTiempoAgregar"]) 
    && isset($_GET["vparFaseAgregar"]) 
    && isset($_GET["vparEnlaceAgregar"])){

        $vlocIdEnlaceLineaTiempo = $_GET["vparIdEnlaceLineaTiempoAgregar"];
        $vlocFaseAgregar = $_GET["vparFaseAgregar"];
        $vlocEnlaceAgregar = $_GET["vparEnlaceAgregar"];

        $vlocResultadoAgregado = FunAgregarEnlace($vlocIdEnlaceLineaTiempo, $vlocFaseAgregar, $vlocEnlaceAgregar);

        echo $vlocResultadoAgregado;
    }

    if(isset($_GET["vparBoolObtenerListaEnlacesLineaTiempo"])){

        $vlocResultadoEdicion = FunObtenerListaEnlacesLineaTiempo();

        $cadena = implode(';', $vlocResultadoEdicion);
        // $cadena2 = explode(';', $cadena);
        // $cadena3 = explode(',', $cadena2);

        echo $cadena;
    }

    if(isset($_GET["vparBoolEliminarEnlaceLineaTiempo"])){

        $vlocResultadoEliminacion = FunEliminarEnlaceLineaTiempo();

        // $result = implode(';', $vlocResultadoEliminacion);

        echo $vlocResultadoEliminacion;
    }

    function FunObtenerListaEnlacesLineaTiempo(){
        $vlocListaEnlaces = new AdministracionLineaTiempo();

        $vlocResultado = $vlocListaEnlaces->FunObtenerListaEnlacesLineaTiempo();

        $vlocDatosEnlaces = array();

        if($vlocResultado == true){
            $vlocNumDatosPersonalAcademico = $vlocResultado->num_rows;
            // echo '$vlocNumDatosPersonalAcademico: ' + $vlocNumDatosPersonalAcademico;
            // exit;
            for($i=0; $i<$vlocNumDatosPersonalAcademico; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocDatosEnlaces, $vlocRow['ID_Enlace_Linea_Tiempo']."-_-".$vlocRow['Fase']."-_-".$vlocRow['Enlace']);
                // array_push($vlocDatosNoticias, '<tr><td id="tdIdUsuarioSeleccionado" style="display:none;">'.$vlocRow['ID_Persona_Usuario'].'</td><td>'.$vlocRow['Tipo_Usuario'].'</td><td>'.$vlocRow['Primer_Nombre'].' '.$vlocRow['Segundo_Nombre'].'</td><td>'.$vlocRow['Primer_Apellido'].' '.$vlocRow['Segundo_Apellido'].'</td><td>'.$vlocRow['Telefono'].'</td><td>'.$vlocRow['Correo_Electronico'].'</td></tr>,');
            }                

            return $vlocDatosEnlaces;
        }
    }

    function FunEditarEnlacesLineaTiempo($vparIdEnlaceLineaTiempo, $vparFase, $vparEnlace){
        $vlocEdicion = new AdministracionLineaTiempo();

        $vlocResultado = $vlocEdicion->FunEditarEnlacesLineaTiempo($vparIdEnlaceLineaTiempo, $vparFase, $vparEnlace);
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

    function FunAgregarEnlace($vparIdEnlaceLineaTiempo, $vparFaseAgregar, $vparEnlaceAgregar){
        $vlocAgregado = new AdministracionLineaTiempo();

        $vlocResultado = $vlocAgregado->FunAgregarEnlace($vparIdEnlaceLineaTiempo, $vparFaseAgregar, $vparEnlaceAgregar);
        // echo $vlocResultado;
        // exit;

        $vlocResultadoAgregado = '';

        if($vlocResultado == true){
            $vlocNumFilasResultado = $vlocResultado->num_rows;

            // for($i=0; $i<$vlocNumFilasResultado; $i++){
            //     $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                
            //     $vlocResultadoEliminacion = $vlocRow['Resultado_Eliminacion'];
            // }                

            while($vlocRow = $vlocResultado->fetch_assoc()){
                $vlocResultadoAgregado .= $vlocRow["Resultado_Insercion"];
            }

            return $vlocResultadoAgregado;
        }
    }

    function FunEliminarEnlaceLineaTiempo(){
        $vlocEliminado = new AdministracionLineaTiempo();

        $vlocResultado = $vlocEliminado->FunEliminarEnlaceLineaTiempo();
        // echo $vlocResultado;
        // exit;

        $vlocResultadoEliminado = '';

        if($vlocResultado == true){
            $vlocNumFilasResultado = $vlocResultado->num_rows;

            // for($i=0; $i<$vlocNumFilasResultado; $i++){
            //     $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                
            //     $vlocResultadoEliminacion = $vlocRow['Resultado_Eliminacion'];
            // }                

            while($vlocRow = $vlocResultado->fetch_assoc()){
                $vlocResultadoEliminado .= $vlocRow["Resultado_Eliminacion"];
            }

            return $vlocResultadoEliminado;
        }
    }