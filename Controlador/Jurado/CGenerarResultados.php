<?php
    require_once("../../Modelo/Jurado/MGenerarResultados.php");
    require_once("../../Modelo/General/Createavatar.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");    
    require_once("../../Assets/AuxiliarPhp/Constants.php");
    require_once("../../Modelo/General/MGrupo.php");

    if(isset($_GET["vlocIdProyectoEvaluar"])){
        $vlocIdProyectoEvaluar = $_GET["vlocIdProyectoEvaluar"];
        session_start();
        $_SESSION['idProyectoEvaluar'] = $vlocIdProyectoEvaluar;        
        echo $_SESSION['idProyectoEvaluar'];
    }

    if(isset($_GET["vparBoolObtenerIdPersona"])){
        session_start();
        echo $_SESSION['Idpersona'];
    }

    if(isset($_GET["vparIdPersona"])){
        $vlocIdPersona = $_GET["vparIdPersona"];
        $vlocArrayListaProyectos = FunObtenerListaProyectosEvaluados($vlocIdPersona);
        $vlocListaProyectos = implode(',', $vlocArrayListaProyectos);
        echo $vlocListaProyectos;
    }

    if(isset($_GET["vparIdSubCategoria"])){
        $vlocIdSubCategoria = $_GET["vparIdSubCategoria"];
        $vlocArrayListaProyectos = FunObtenerDatosProyectosGanadores($vlocIdSubCategoria);
        // $vlocListaProyectos = implode(',', $vlocArrayListaProyectos);
        echo json_encode($vlocArrayListaProyectos);
    }

    if(isset($_GET["vparIdProyecto"])){
        $vlocIdProyecto = $_GET["vparIdProyecto"];
        $vlocArrayListaProyectos = FunObtenerDatosIntegrantesSegunProyecto($vlocIdProyecto);
        // $vlocListaProyectos = implode(',', $vlocArrayListaProyectos);
        echo json_encode($vlocArrayListaProyectos);
    }

    if(isset($_GET["vparBoolObtenerSubCategorias"]) && isset($_GET["vparIdPersonaSubCategorias"])){
        $vlocIdPersona = $_GET["vparIdPersonaSubCategorias"];
        $vlocListaSubCategorias = FunObtenerSubCategoriasSegunJurado($vlocIdPersona);
        echo $vlocListaSubCategorias;
    }

    if(isset($_GET["vparBoolGenerarReporte"])){
        require('../../Assets/AuxiliarPhp/fpdf186/fpdf.php');

        // Crear un nuevo objeto FPDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'¡Hola, mundo! Este es un PDF generado con FPDF.');

        // Salida del PDF en una variable
        $pdfContent = $pdf->Output('S');

        // Codificar el contenido en base64
        $pdfBase64 = base64_encode($pdfContent);

        echo $pdfBase64;

        // $pdf = new FPDF();
        // $pdf->AddPage();
        // $pdf->SetFont('Arial','B',16);
        // $pdf->Cell(40,10,'archivo');
        // // $pdf->Output('archivo.pdf', 'D');
        // $pdf->Output('../../Assets/', 'F');
        // // echo $pdf;
    }

    function FunObtenerListaProyectosEvaluados($vparIdPersona){
        $vlocListaProyectosSeleccionados = new GenerarResultadosModelo();

        $vlocResultado = $vlocListaProyectosSeleccionados->FunObtenerListaProyectosEvaluados($vparIdPersona);

        $vlocDatosProyectos = array();
        // $vlocDatosProyectos = '';

        if($vlocResultado == true){
            $vlocNumDatosPersonalAcademico = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosPersonalAcademico; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);

                array_push($vlocDatosProyectos, '<tr><td id="tdIdProyectoSeleccionado" style="display:none;">'.$vlocRow['ID_Proyecto'].'</td><td>'.$vlocRow['nombre'].'</td><td>'.$vlocRow['Nombre_SubCategoria'].'</td><td>'.$vlocRow['CalificacionFinal'].'</td></tr>,');
            }                

            return $vlocDatosProyectos;
        }
    }

    function FunObtenerDatosProyectosGanadores($vparIdSubCategoria){
        $vlocDatosProyectosGanadores = new GenerarResultadosModelo();

        $vlocResultado = $vlocDatosProyectosGanadores->FunObtenerDatosProyectosGanadores($vparIdSubCategoria);

        $vlocDatosProyectos = array();
        // $vlocDatosProyectos = '';

        if($vlocResultado == true){
            $vlocNumProyectosGanadores = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumProyectosGanadores; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);

                array_push($vlocDatosProyectos, $vlocRow['ID_Proyecto'].','.$vlocRow['Nombre'].','.$vlocRow['Primer_Nombre'].','.$vlocRow['Primer_Apellido'].','.$vlocRow['CalificacionFinal'].',');
            }                

            return $vlocDatosProyectos;
        }
    }

    function FunObtenerDatosIntegrantesSegunProyecto($vparIdProyecto){
        $vlocDatosIntegrantesModelo = new GenerarResultadosModelo();

        $vlocResultado = $vlocDatosIntegrantesModelo->FunObtenerDatosIntegrantesSegunProyecto($vparIdProyecto);

        $vlocDatosIntegrantes = array();
        // $vlocDatosIntegrantes = '';

        if($vlocResultado) {
            $vlocNumProyectosGanadores = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumProyectosGanadores; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);

                // Verificar y reemplazar valores vacíos con '--'
                // foreach ($vlocRow as $key => $value) {
                //     if (empty($value)) {
                //         $vlocRow[$key] = '---';
                //     }
                // }

                array_push($vlocDatosIntegrantes, $vlocRow['Primer_Nombre'].','.$vlocRow['Segundo_Nombre'].','.$vlocRow['Primer_Apellido'].','.$vlocRow['Segundo_Apellido'].';');
                // $vlocDatosIntegrantes = $vlocDatosIntegrantes . '<option class="options" value="'.$vlocRow['ID_SubCategoria'].'">'.$vlocRow['Nombre_SubCategoria'].'</option>';
            }                

            return $vlocDatosIntegrantes;
        }
    }

    function FunObtenerSubCategoriasSegunJurado($vparIdPersona){
        $vlocListaSubCategorias = new GenerarResultadosModelo();

        $vlocResultado = $vlocListaSubCategorias->FunObtenerSubCategoriasSegunJurado($vparIdPersona);

        // $vlocSubCategorias = array();
        $vlocSubCategorias = '';

        if($vlocResultado == true){
            $vlocNumDatosSubCategorias = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosSubCategorias; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);

                // Verificar y reemplazar valores vacíos con '--'
                foreach ($vlocRow as $key => $value) {
                    if (empty($value)) {
                        $vlocRow[$key] = '---';
                    }
                }

                $vlocSubCategorias = $vlocSubCategorias . '<option class="options" value="'.$vlocRow['ID_SubCategoria'].'">'.$vlocRow['Nombre_SubCategoria'].'</option>';
            }

            return $vlocSubCategorias;
        }
    }

?>