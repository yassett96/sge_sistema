<?php
    require_once("../../Modelo/Jurado/MProyectosAsignados.php");
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

    if(isset($_GET["vparIdPersona"])){
        $vlocIdPersona = $_GET["vparIdPersona"];
        $vlocArrayListaProyectos = FunObtenerListaProyectosAsignados($vlocIdPersona);
        $vlocListaProyectos = implode(',', $vlocArrayListaProyectos);
        echo $vlocListaProyectos;
    }

    function FunObtenerListaProyectosAsignados($vparIdPersona){
        $vlocListaProyectosSeleccionados = new ProyectosAsignadosModelo();

        $vlocResultado = $vlocListaProyectosSeleccionados->FunObtenerListaProyectosAsignados($vparIdPersona);

        $vlocDatosProyectos = array();

        if($vlocResultado == true){
            $vlocNumDatosPersonalAcademico = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosPersonalAcademico; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);

                // Verificar y reemplazar valores vacíos con '--'
                foreach ($vlocRow as $key => $value) {
                    if (empty($value)) {
                        $vlocRow[$key] = '---';
                    }
                }

                array_push($vlocDatosProyectos, '<tr><td id="tdIdProyectoSeleccionado" style="display:none;">'.$vlocRow['ID_Proyecto'].'</td><td>'.$vlocRow['nombre'].'</td><td>'.$vlocRow['Nombre_Categoria'].'</td><td>'.$vlocRow['Nombre_SubCategoria'].'</td><td>'.$vlocRow['Tutor'].'</td></tr>,');
            }                

            return $vlocDatosProyectos;
        }
    }

?>