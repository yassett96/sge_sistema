<?php

    require_once("../../Modelo/Jurado/MEvaluacionProyectos.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");    
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    $vgDetallesProyectosInscritos = new EvaluacionProyectosModelo();
    $vgHelperPhp = new helperPhp();

    if(isset($_GET["vparBoolObtenerIdProyectoEvaluar"])){        
        session_start();
        $vlocIdProyectoEvaluar = $_SESSION['idProyectoEvaluar'];
        echo $vlocIdProyectoEvaluar;
    }

    if(isset($_GET["vparBoolObtenerIdPersonaJurado"])){        
        session_start();
        $vlocIdPersonaJurado = $_SESSION['Idpersona'];
        echo $vlocIdPersonaJurado;
    }

    if(isset($_GET["vparIdEventoModificarEvaluacion"]) && isset($_GET["vparIdProyectoModificarEvaluacion"]) &&
    isset($_GET["vparCalificacionFinalModificarEvaluacion"]) && isset($_GET["vparComentarioModificacionEvaluacion"])){

        $vlocIdEvento = $_GET["vparIdEventoModificarEvaluacion"];
        $vlocIdProyecto = $_GET["vparIdProyectoModificarEvaluacion"];
        $vlocCalificacionFinal = $_GET["vparCalificacionFinalModificarEvaluacion"];
        $vlocComentario = $_GET["vparComentarioModificacionEvaluacion"];

        $vlocResultadoModificacion = FunModificarEvaluacionProyecto($vlocIdEvento, $vlocIdProyecto, $vlocCalificacionFinal, $vlocComentario);

        echo $vlocResultadoModificacion[0];
    }

    if(isset($_GET["vparIdProyecto"])){
        $vlocIdProyecto = $_GET['vparIdProyecto'];

        $vlocDatosProyectos = FunObtenerDatosProyectoSegunIdProyecto($vlocIdProyecto);

        echo $vlocDatosProyectos;
    }

    if(isset($_GET["vparIdProyectoIntegrantes"])){
        $vlocIdProyecto = $_GET['vparIdProyectoIntegrantes'];

        $vlocDatosIntegrantesProyectos = FunObtenerDatosIntegrantesProyectoSegunIdProyecto($vlocIdProyecto);

        echo json_encode($vlocDatosIntegrantesProyectos);
    }

    if(isset($_GET["vparIdPersonaJurado"])){
        $vlocIdPersonaJurado = $_GET['vparIdPersonaJurado'];

        $vlocCriteriosEvaluacionJurado = FunObtenerCriteriosEvaluacionJurado($vlocIdPersonaJurado);

        echo json_encode($vlocCriteriosEvaluacionJurado);
    }

    if(isset($_GET["vparIdFormatoEncabezados"])){
        $vlocIdFormato = $_GET['vparIdFormatoEncabezados'];

        $vlocCriteriosEvaluacion = FunObtenerEncabezadosCriteriosSegunIdFormato($vlocIdFormato);

        echo json_encode($vlocCriteriosEvaluacion);
    }

    if(isset($_GET["vparIdFormatoContenido"])){
        $vlocIdFormato = $_GET['vparIdFormatoContenido'];

        $vlocCriteriosEvaluacion = FunObtenerContenidoTablaCriteriosSegunIdFormato($vlocIdFormato);

        echo json_encode($vlocCriteriosEvaluacion);
    }

    if(isset($_GET["vparIdPersonaInfoJurado"])){
        $vlocIdPersona = $_GET['vparIdPersonaInfoJurado'];

        $vlocInformacionJurado = FunObtenerInformacionJuradoSegunIdPersona($vlocIdPersona);

        echo json_encode($vlocInformacionJurado);
    }

    if(isset($_GET["vparBoolObtenerIdEventoActual"])){

        $vlocIdEventoActual = FunObtenerIdEventoActual();

        echo $vlocIdEventoActual;
    }

    function FunObtenerDatosProyectoSegunIdProyecto($vparIdProyecto){
        $vlocDetallesProyectosInscritos = new EvaluacionProyectosModelo();

        $vlocResultado = $vlocDetallesProyectosInscritos->FunObtenerDatosProyectoSegunIdProyecto($vparIdProyecto);

        $vlocDatosProyectos = array();

        if($vlocResultado == true){
            $vlocNumDatosProyectos = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosProyectos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocDatosProyectos, $vlocRow["Nombre"].",".$vlocRow["Nombre_Categoria"].",".$vlocRow["Nombre_SubCategoria"].",".$vlocRow["Nombre_SubCategoria"].",".$vlocRow["Descripcion"]);
            }

            $vlocDatosImploded = implode(",", $vlocDatosProyectos);
            
            return $vlocDatosImploded;
        }
    }

    function FunObtenerDatosIntegrantesProyectoSegunIdProyecto($vparIdProyecto){
        $vlocDetallesProyectosInscritos = new EvaluacionProyectosModelo();

        $vlocResultado = $vlocDetallesProyectosInscritos->FunObtenerDatosIntegrantesProyectoSegunIdProyecto($vparIdProyecto);

        $vlocDatosProyectos = array();

        if($vlocResultado == true){
            $vlocNumDatosProyectos = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosProyectos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocDatosProyectos, $vlocRow["Primer_Nombre"].",".$vlocRow["Segundo_Nombre"].",".$vlocRow["Primer_Apellido"].",".$vlocRow["Segundo_Apellido"]);
            }

            // $vlocDatosImploded = implode(";", $vlocDatosProyectos);
            
            // return $vlocDatosImploded;
            return $vlocDatosProyectos;
        }
    }

    function FunObtenerIdEventoActual(){
        $modeloEvaluacionProyectosModelo = new EvaluacionProyectosModelo();

        $vlocIntResultadoObtenerIdEventoActual = $modeloEvaluacionProyectosModelo->FunObtenerIdEventoActual();

        if($vlocIntResultadoObtenerIdEventoActual)
            return $vlocIntResultadoObtenerIdEventoActual;
        else
            return 'Error al obtener el id del evento actual';
    }

    function FunObtenerCriteriosEvaluacionJurado($vparIdPersonaJurado){
        $vlocCriteriosEvaluacionJurado = new EvaluacionProyectosModelo();

        $vlocResultado = $vlocCriteriosEvaluacionJurado->FunObtenerCriteriosEvaluacionJurado($vparIdPersonaJurado);

        $vlocCriteriosEvaluacion = array();

        if($vlocResultado == true){
            $vlocNumDatosProyectos = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosProyectos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocCriteriosEvaluacion, $vlocRow["ID_Criterio"].";".$vlocRow["NombreCriterios"].";".$vlocRow["Descripcion"].";".$vlocRow["Activo"]);
            }

            // $vlocDatosImploded = implode(";", $vlocCriteriosEvaluacion);
            
            // return $vlocDatosImploded;
            return $vlocCriteriosEvaluacion;
        }
    }

    function FunObtenerEncabezadosCriteriosSegunIdFormato($vparIdFormato){
        $vlocCriteriosEvaluacion = new EvaluacionProyectosModelo();

        $vlocResultado = $vlocCriteriosEvaluacion->FunObtenerCriteriosSegunIdFormato($vparIdFormato);

        // $vlocCriteriosEvaluacion = array();
        $vlocCriteriosEvaluacion = '';

        if($vlocResultado == true){
            $vlocNumDatosProyectos = $vlocResultado->num_rows;

            // array_push($vlocCriteriosEvaluacion, "<tr>");
            $vlocCriteriosEvaluacion = "<tr>";

            for($i=0; $i<$vlocNumDatosProyectos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                // array_push($vlocCriteriosEvaluacion, "<th>".$vlocRow["NombreCriterios"]."</th>");
                $vlocCriteriosEvaluacion = $vlocCriteriosEvaluacion . "<th>".$vlocRow["NombreCriterios"]."</th>";
            }

            // array_push($vlocCriteriosEvaluacion, "</tr>");
            $vlocCriteriosEvaluacion = $vlocCriteriosEvaluacion."<th>Total</th>";
            $vlocCriteriosEvaluacion = $vlocCriteriosEvaluacion."</tr>";

            // $vlocDatosImploded = implode(";", $vlocCriteriosEvaluacion);
            
            // return $vlocDatosImploded;
            return $vlocCriteriosEvaluacion;
        }
    }

    function FunObtenerContenidoTablaCriteriosSegunIdFormato($vparIdFormato){
        $vlocContenidoCriteriosEvaluacion = new EvaluacionProyectosModelo();

        $vlocResultado = $vlocContenidoCriteriosEvaluacion->FunObtenerCriteriosSegunIdFormato($vparIdFormato);

        // $vlocContenidoCriteriosEvaluacion = array();
        $vlocContenidoCriteriosEvaluacion = '';

        if($vlocResultado == true){
            $vlocNumDatosProyectos = $vlocResultado->num_rows;

            // array_push($vlocContenidoCriteriosEvaluacion, "<tr>");
            $vlocContenidoCriteriosEvaluacion = '<tr>';

            for($i=0; $i<$vlocNumDatosProyectos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                // array_push($vlocContenidoCriteriosEvaluacion, "<th>".$vlocRow["Valor"]."</th>");
                $vlocContenidoCriteriosEvaluacion = $vlocContenidoCriteriosEvaluacion . "<td>".$vlocRow["Valor"]."</td>";
            }

            $vlocContenidoCriteriosEvaluacion = $vlocContenidoCriteriosEvaluacion . "<td>100</td>";
            $vlocContenidoCriteriosEvaluacion = $vlocContenidoCriteriosEvaluacion . "</tr><tr>";
            // array_push($vlocContenidoCriteriosEvaluacion, '<th>100</th>');
            // array_push($vlocContenidoCriteriosEvaluacion, "</tr><tr>");

            for($i=0; $i<$vlocNumDatosProyectos; $i++){
                // $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                // array_push($vlocContenidoCriteriosEvaluacion, '<td contenteditable="true"></td>');
                $vlocContenidoCriteriosEvaluacion = $vlocContenidoCriteriosEvaluacion . '<td data-type="number" oninput="validarNumeros(this)" onkeyup="FunVerificarValor(this)" class="tdPuntuaciones" contenteditable="true"></td>';
            }

            // array_push($vlocContenidoCriteriosEvaluacion, '<td id="idCeldaTotal">0<td>');
            // array_push($vlocContenidoCriteriosEvaluacion, "</tr>");

            $vlocContenidoCriteriosEvaluacion = $vlocContenidoCriteriosEvaluacion . '<td id="idCeldaTotal">0</td>';
            $vlocContenidoCriteriosEvaluacion = $vlocContenidoCriteriosEvaluacion . '</tr>';

            // $vlocDatosImploded = implode(";", $vlocContenidoCriteriosEvaluacion);            
            // return $vlocDatosImploded;
            
            return $vlocContenidoCriteriosEvaluacion;
        }
    }

    function FunObtenerInformacionJuradoSegunIdPersona($vparIdPersona){
        $vlocInformacionJurado = new EvaluacionProyectosModelo();

        $vlocResultado = $vlocInformacionJurado->FunObtenerInformacionJuradoSegunIdPersona($vparIdPersona);

        $vlocInformacionJurado = array();

        if($vlocResultado == true){
            $vlocNumDatosProyectos = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosProyectos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocInformacionJurado, $vlocRow["ID_Jurado"].",".$vlocRow["ID_Personal_Academico"].",".$vlocRow["ID_Formato"].",".$vlocRow["JuradoPos"]);
            }

            // $vlocDatosImploded = implode(";", $vlocInformacionJurado);
            
            // return $vlocDatosImploded;
            return $vlocInformacionJurado;
        }
    }

    function FunModificarEvaluacionProyecto($vparIdEvento, $vparIdProyecto, $vparCalificacionFinal, $vparComentario){
        $vlocEvaluacionProyectoModelo = New EvaluacionProyectosModelo();

        $vlocResultado = $vlocEvaluacionProyectoModelo->FunModificarEvaluacionProyecto($vparIdEvento, $vparIdProyecto, $vparCalificacionFinal, $vparComentario);
        
        $vlocModificacion = array();

        if($vlocResultado == true){
            $vlocNumDatosProyectos = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosProyectos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocModificacion, $vlocRow["Resultado_Modificacion"]);
            }                

            return $vlocModificacion;
        }
    }

    //Funciones para vista de los proyectos inscritos
    // function FunObtenerProyectosInscritosSegunCodigoRegistroParticipante($vparCodigoRegistroParticipante){        
    //     $vlocDetallesProyectosInscritos = new EvaluacionProyectosModelo();
        
    //     $vlocResultado = $vlocDetallesProyectosInscritos->FunObtenerProyectosInscritosSegunCodigoRegistroParticipante($vparCodigoRegistroParticipante);        
        
    //     $vlocProyectos = array();

    //     if($vlocResultado == true){
    //         $vlocNumProyectos = $vlocResultado->num_rows;            

    //         for($i=0; $i<$vlocNumProyectos; $i++){
    //             $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
    //             array_push($vlocProyectos, $vlocRow["ID_Proyecto"].",".$vlocRow['Nombre']);
    //         }

    //         $vlocStrTextoSelectProyectos = "<option id='firstOptionProyectos' selected disabled hidden> Seleccione proyecto ";            

    //         for($y=0; $y<count($vlocProyectos); $y++){
    //             $vlocProyectosExplode = explode(",", $vlocProyectos[$y]);
    //             $vlocStrTextoSelectProyectos = $vlocStrTextoSelectProyectos."<option class='optionProyectos' value='".$vlocProyectosExplode[0]."'>".$vlocProyectosExplode[1]."";
    //         }                         
            
    //         return json_encode($vlocStrTextoSelectProyectos);            
    //     }else {
    //         return 'Error al obtener los proyectos inscritos';
    //     }                
    // }

    // function FunObtenerDatosProyectoSegunCodigoRegistroParticipanteEIdProyecto($vparCodigoRegistroParticipante, $vparIdProyecto){
    //     $vlocDetallesProyectosInscritos = new EvaluacionProyectosModelo();

    //     $vlocResultado = $vlocDetallesProyectosInscritos->FunObtenerDatosProyectoSegunCodigoRegistroParticipanteEIdProyecto($vparCodigoRegistroParticipante, $vparIdProyecto);

    //     $vlocDatosProyectos = array();

    //     if($vlocResultado == true){
    //         $vlocNumDatosProyectos = $vlocResultado->num_rows;

    //         for($i=0; $i<$vlocNumDatosProyectos; $i++){
    //             $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
    //             array_push($vlocDatosProyectos, $vlocRow["Nombre"].",".$vlocRow["Descripcion"].",".$vlocRow["Nombre_Categoria"].",".$vlocRow["Nombre_SubCategoria"].",".$vlocRow["Primer_Nombre"].",".$vlocRow["Primer_Apellido"]);
    //         }

    //         $vlocDatosImploded = implode(",", $vlocDatosProyectos);
            
    //         return $vlocDatosImploded;
    //     }
    // }

    // function FunObtenerDatosIntegrantesSegunIdProyecto($vparIdProyecto){
    //     $vlocDetallesProyectosInscritos = new EvaluacionProyectosModelo();

    //     $vlocResultado = $vlocDetallesProyectosInscritos->FunObtenerDatosIntegrantesSegunIdProyecto($vparIdProyecto);

    //     $vlocDatosIntegrantes = array();

    //     if($vlocResultado == true){
    //         $vlocNumDatosIntegrantes = $vlocResultado->num_rows;

    //         for($i=0; $i<$vlocNumDatosIntegrantes; $i++){
    //             $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
    //             $vlocIdGrupo = $vlocRow["grupo"];
    //             $vlocAñoAcademico = FunObtenerAñoAcademicoSegunGrupo($vlocIdGrupo);
    //             array_push($vlocDatosIntegrantes, $vlocRow["Primer_Nombre"].",".$vlocRow["Segundo_Nombre"].",".$vlocRow["Primer_Apellido"].",".$vlocRow["Segundo_Apellido"].",".$vlocRow["Cedula"].",".$vlocRow["ID_Numero_Carnet"].",".$vlocRow["grupo"].",".$vlocAñoAcademico.",".$vlocRow["Sede"]);
    //         }
            
    //         return $vlocDatosIntegrantes;
    //     }
    // }

    // function FunConfirmarParticipacion($vparIdProyecto, $vparIdParticipante1, $vparIdParticipante2, $vparIdParticipante3){
    //     $vlocDetallesProyectosInscritos = new EvaluacionProyectosModelo();

    //     $vlocResultado = $vlocDetallesProyectosInscritos->FunConfirmarParticipacion($vparIdProyecto, $vparIdParticipante1, $vparIdParticipante2, $vparIdParticipante3);

    //     $vlocConfirmacion = array();

    //     if($vlocResultado == true){
    //         $vlocNumDatosProyectos = $vlocResultado->num_rows;

    //         for($i=0; $i<$vlocNumDatosProyectos; $i++){
    //             $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
    //             array_push($vlocConfirmacion, $vlocRow["Resultado_Confirmacion"]);
    //         }                

    //         return $vlocConfirmacion;
    //     }
    // }

    // function FunAbandonarProyectoSiEsNecesario($vparIdProyecto){
    //     $vlocDetallesProyectosInscritos = new EvaluacionProyectosModelo();

    //     $vlocResultado = $vlocDetallesProyectosInscritos->FunAbandonarProyectoSiEsNecesario($vparIdProyecto);

    //     $vlocAbandono = array();

    //     if($vlocResultado == true){
    //         $vlocNumDatosProyectos = $vlocResultado->num_rows;

    //         for($i=0; $i<$vlocNumDatosProyectos; $i++){
    //             $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
    //             array_push($vlocAbandono, $vlocRow["Resultado_Abandono"]);
    //         }                

    //         return $vlocAbandono;
    //     }
    // }

    // function FunVerificarExistenciaProyecto(){
    //     $vlocDetallesProyectosInscritos = new EvaluacionProyectosModelo();

    //     session_start();
    //     $vlocCodRegistroParticipanteInscritor = $_SESSION['Cod'];

    //     $vlocResultado = $vlocDetallesProyectosInscritos->FunVerificarExistenciaProyectoSegunCodigoRegistro($vlocCodRegistroParticipanteInscritor);

    //     $vlocDatosProyectos = array();

    //     if($vlocResultado == true){
    //         $vlocNumDatosProyectos = $vlocResultado->num_rows;

    //         for($i=0; $i<$vlocNumDatosProyectos; $i++){
    //             $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
    //             array_push($vlocDatosProyectos, $vlocRow["Verificacion"]);
    //         }                

    //         return $vlocDatosProyectos;
    //     }
    // }

    // function FunEliminarIntegranteDeProyecto($vparIdParticipante, $vparIdProyecto){
    //     $vlocQuery = "Call Eliminar_IntegranteDeProyecto('".$vparIdParticipante."', ".$vparIdProyecto.");";
        
    //     $vlocMySqli = Conexiondatabase::ConexionSecurity();

    //     $vlocResultado = $vlocMySqli->query($vlocQuery);

    //     $vlocEliminacion = array();

    //     if($vlocResultado == true){
    //         $vlocNumDatosProyectos = $vlocResultado->num_rows;

    //         for($i=0; $i<$vlocNumDatosProyectos; $i++){
    //             $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
    //             array_push($vlocEliminacion, $vlocRow["Resultado_Eliminacion"]);
    //         }                

    //         return $vlocEliminacion;
    //     }

    //     // if(!$vlocResult){
    //     //     $vlocEliminacion = $vlocMySqli->error;
    //     // }else{
    //     //     $vlocEliminacion = $vlocResult;
    //     // }

    //     // return $vlocEliminacion;
    // }

    // function FunObtenerAñoAcademicoSegunGrupo($vparIdGrupo){
    //     $vlocPrimerCaracter = substr($vparIdGrupo, 0, 1);

    //     switch($vlocPrimerCaracter){
    //         case 1:
    //             return 'Primero';
    //             break;
    //         case 2:
    //             return 'Segundo';
    //             break;
    //         case 3:
    //             return 'Tercero';
    //             break;
    //         case 4:
    //             return 'Cuarto';
    //             break;
    //         case 5:
    //             return 'Quinto';
    //             break;
    //         case 'I':
    //             return 'Primero';
    //             break;
    //         case 'II':
    //             return 'Segundo';
    //             break;
    //         case 'III':
    //             return 'Tercero';
    //             break;
    //         case 'IV':
    //             return 'Cuarto';
    //             break;
    //         case 'V':
    //             return 'Quinto';
    //             break;
    //     }
    // }

?>