<?php

    require_once("../../Modelo/Participante/MDetallesProyectosInscritos.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");    
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    $vgDetallesProyectosInscritos = new DetallesProyectosInscritosModelo();
    $vgHelperPhp = new helperPhp();

    if(isset($_GET["vparBoolVerificarProyectosInscritos"])){        

        $vlocVerificador = FunVerificarExistenciaProyecto();

        echo $vlocVerificador[CtePosicionValorExistenciaProyecto];
    }

    if(isset($_GET["vparIdParticipante"]) && $_GET["vparIdProyecto"]){        

        $vlocIdParticipante = $_GET["vparIdParticipante"];
        $vlocIdProyecto = $_GET["vparIdProyecto"];

        $vlocVerificador = FunEliminarIntegranteDeProyecto($vlocIdParticipante, $vlocIdProyecto);

        echo $vlocVerificador[0];
    }

    if(isset($_GET["vparBoolObtenerCarnetParticipante"])){        
        session_start();
        $vlocCarnet = $_SESSION['Carnet'];

        echo $vlocCarnet;
    }

    if(isset($_GET["vparBoolObtenerProyectos"])){
        session_start();
        $vlocCodRegistroParticipanteInscritor = $_SESSION['Cod'];
        
        $vlocStrTextoSelectProyectos = FunObtenerProyectosInscritosSegunCodigoRegistroParticipante($vlocCodRegistroParticipanteInscritor);                        
                
       echo $vlocStrTextoSelectProyectos;
    }

    if(isset($_GET["vparBoolObtenerDatosProyectos"], $_GET["vparIdProyecto"])){
        session_start();
        $vlocCodRegistroParticipanteInscritor = $_SESSION['Cod'];
        $vlocIdProyecto = $_GET['vparIdProyecto'];

        $vlocDatosProyectos = FunObtenerDatosProyectoSegunCodigoRegistroParticipanteEIdProyecto($vlocCodRegistroParticipanteInscritor, $vlocIdProyecto);

        echo $vlocDatosProyectos;
    }

    if(isset($_GET["vparBoolObtenerDatosIntegrantes"], $_GET["vparIdProyecto"])){
        $vlocIdProyecto = $_GET["vparIdProyecto"];

        $vlocDatosIntegrantes = FunObtenerDatosIntegrantesSegunIdProyecto($vlocIdProyecto);

        echo json_encode($vlocDatosIntegrantes, JSON_UNESCAPED_UNICODE);
    }

    if(isset($_GET["vparIdParticipanteConfirmacionParticipante"], $_GET["vparIdProyectoConfirmacionParticipante"])){
        $vlocIdParticipante = $_GET["vparIdParticipanteConfirmacionParticipante"];
        $vlocIdProyecto = $_GET["vparIdProyectoConfirmacionParticipante"];

        $vlocConfirmacionParticipante = FunObtenerConfirmacionParticipante($vlocIdParticipante, $vlocIdProyecto);

        echo json_encode($vlocConfirmacionParticipante, JSON_UNESCAPED_UNICODE);
    }

    if(isset($_GET["vparIdProyectoConfirmacion"]) && isset($_GET["vparIdParticipante1Confirmacion"])
    && isset($_GET["vparIdParticipante2Confirmacion"]) && isset($_GET["vparIdParticipante3Confirmacion"])){
        $vlocIdProyecto = $_GET["vparIdProyectoConfirmacion"];
        $vlocIdParticipante1 = $_GET["vparIdParticipante1Confirmacion"];
        $vlocIdParticipante2 = $_GET["vparIdParticipante2Confirmacion"];
        $vlocIdParticipante3 = $_GET["vparIdParticipante3Confirmacion"];

        $vlocConfirmacionParticipacion = FunConfirmarParticipacion($vlocIdProyecto, $vlocIdParticipante1, $vlocIdParticipante2, $vlocIdParticipante3);

        echo $vlocConfirmacionParticipacion[0];
    }

    if(isset($_GET["vparIdProyectoAbandono"])){
        $vlocIdProyecto = $_GET["vparIdProyectoAbandono"];

        $vlocAbandono = FunAbandonarProyectoSiEsNecesario($vlocIdProyecto);

        echo $vlocAbandono[0];
    }

    //Funciones para vista de los proyectos inscritos
    function FunObtenerProyectosInscritosSegunCodigoRegistroParticipante($vparCodigoRegistroParticipante){        
        $vlocDetallesProyectosInscritos = new DetallesProyectosInscritosModelo();
        
        $vlocResultado = $vlocDetallesProyectosInscritos->FunObtenerProyectosInscritosSegunCodigoRegistroParticipante($vparCodigoRegistroParticipante);        
        
        $vlocProyectos = array();

        if($vlocResultado == true){
            $vlocNumProyectos = $vlocResultado->num_rows;            

            for($i=0; $i<$vlocNumProyectos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                // echo $vlocRow[0];
                // exit;
                if($vlocRow["ID_Proyecto"] != 0){
                    array_push($vlocProyectos, $vlocRow["ID_Proyecto"].",".$vlocRow['Nombre']);
                }               
                
            }

            $vlocStrTextoSelectProyectos = "<option id='firstOptionProyectos' selected disabled hidden> Seleccione proyecto ";            

            for($y=0; $y<count($vlocProyectos); $y++){
                $vlocProyectosExplode = explode(",", $vlocProyectos[$y]);
                $vlocStrTextoSelectProyectos = $vlocStrTextoSelectProyectos."<option class='optionProyectos' value='".$vlocProyectosExplode[0]."'>".$vlocProyectosExplode[1]."";
            }                         
            
            return json_encode($vlocStrTextoSelectProyectos);
        }else {
            return 'Error al obtener los proyectos inscritos';
        }                
    }

    function FunObtenerDatosProyectoSegunCodigoRegistroParticipanteEIdProyecto($vparCodigoRegistroParticipante, $vparIdProyecto){
        $vlocDetallesProyectosInscritos = new DetallesProyectosInscritosModelo();

        $vlocResultado = $vlocDetallesProyectosInscritos->FunObtenerDatosProyectoSegunCodigoRegistroParticipanteEIdProyecto($vparCodigoRegistroParticipante, $vparIdProyecto);

        $vlocDatosProyectos = array();

        if($vlocResultado == true){
            $vlocNumDatosProyectos = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosProyectos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocDatosProyectos, $vlocRow["Nombre"].",".$vlocRow["Descripcion"].",".$vlocRow["Nombre_Categoria"].",".$vlocRow["Nombre_SubCategoria"].",".$vlocRow["Primer_Nombre"].",".$vlocRow["Primer_Apellido"]);
            }

            $vlocDatosImploded = implode(",", $vlocDatosProyectos);
            
            return $vlocDatosImploded;
        }
    }

    function FunObtenerDatosIntegrantesSegunIdProyecto($vparIdProyecto){
        $vlocDetallesProyectosInscritos = new DetallesProyectosInscritosModelo();

        $vlocResultado = $vlocDetallesProyectosInscritos->FunObtenerDatosIntegrantesSegunIdProyecto($vparIdProyecto);

        $vlocDatosIntegrantes = array();

        if($vlocResultado == true){
            $vlocNumDatosIntegrantes = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosIntegrantes; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                $vlocIdGrupo = $vlocRow["grupo"];
                $vlocAñoAcademico = FunObtenerAñoAcademicoSegunGrupo($vlocIdGrupo);
                array_push($vlocDatosIntegrantes, $vlocRow["Primer_Nombre"].",".$vlocRow["Segundo_Nombre"].",".$vlocRow["Primer_Apellido"].",".$vlocRow["Segundo_Apellido"].",".$vlocRow["Cedula"].",".$vlocRow["ID_Numero_Carnet"].",".$vlocRow["grupo"].",".$vlocAñoAcademico.",".$vlocRow["Sede"]);
            }
            
            return $vlocDatosIntegrantes;
        }
    }

    function FunObtenerConfirmacionParticipante($vparIdParticipante, $vparIdProyecto){
        $vlocDetallesProyectosInscritos = new DetallesProyectosInscritosModelo();

        $vlocResultado = $vlocDetallesProyectosInscritos->FunObtenerConfirmacionParticipante($vparIdParticipante, $vparIdProyecto);

        $vlocConfirmacionParticipante = array();

        if($vlocResultado == true){
            $vlocNumDatosIntegrantes = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosIntegrantes; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                
                array_push($vlocConfirmacionParticipante, $vlocRow["Confirmacion"]);
            }
            
            return $vlocConfirmacionParticipante;
        }
    }

    function FunConfirmarParticipacion($vparIdProyecto, $vparIdParticipante1, $vparIdParticipante2, $vparIdParticipante3){
        $vlocDetallesProyectosInscritos = new DetallesProyectosInscritosModelo();

        $vlocResultado = $vlocDetallesProyectosInscritos->FunConfirmarParticipacion($vparIdProyecto, $vparIdParticipante1, $vparIdParticipante2, $vparIdParticipante3);

        $vlocConfirmacion = array();

        if($vlocResultado == true){
            $vlocNumDatosProyectos = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosProyectos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocConfirmacion, $vlocRow["Resultado_Confirmacion"]);
            }                

            return $vlocConfirmacion;
        }
    }

    function FunAbandonarProyectoSiEsNecesario($vparIdProyecto){
        $vlocDetallesProyectosInscritos = new DetallesProyectosInscritosModelo();

        $vlocResultado = $vlocDetallesProyectosInscritos->FunAbandonarProyectoSiEsNecesario($vparIdProyecto);

        $vlocAbandono = array();

        if($vlocResultado == true){
            $vlocNumDatosProyectos = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosProyectos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocAbandono, $vlocRow["Resultado_Abandono"]);
            }                

            return $vlocAbandono;
        }
    }

    function FunVerificarExistenciaProyecto(){
        $vlocDetallesProyectosInscritos = new DetallesProyectosInscritosModelo();

        session_start();
        $vlocCodRegistroParticipanteInscritor = $_SESSION['Cod'];

        $vlocResultado = $vlocDetallesProyectosInscritos->FunVerificarExistenciaProyectoSegunCodigoRegistro($vlocCodRegistroParticipanteInscritor);

        $vlocDatosProyectos = array();

        if($vlocResultado == true){
            $vlocNumDatosProyectos = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosProyectos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocDatosProyectos, $vlocRow["Verificacion"]);
            }                

            return $vlocDatosProyectos;
        }
    }

    function FunEliminarIntegranteDeProyecto($vparIdParticipante, $vparIdProyecto){
        $vlocQuery = "Call Eliminar_IntegranteDeProyecto('".$vparIdParticipante."', ".$vparIdProyecto.");";
        
        $vlocMySqli = Conexiondatabase::ConexionSecurity();

        $vlocResultado = $vlocMySqli->query($vlocQuery);

        $vlocEliminacion = array();

        if($vlocResultado == true){
            $vlocNumDatosProyectos = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumDatosProyectos; $i++){
                $vlocRow = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocEliminacion, $vlocRow["Resultado_Eliminacion"]);
            }                

            return $vlocEliminacion;
        }

        // if(!$vlocResult){
        //     $vlocEliminacion = $vlocMySqli->error;
        // }else{
        //     $vlocEliminacion = $vlocResult;
        // }

        // return $vlocEliminacion;
    }

    function FunObtenerAñoAcademicoSegunGrupo($vparIdGrupo){
        $vlocPrimerCaracter = substr($vparIdGrupo, 0, 1);

        switch($vlocPrimerCaracter){
            case 1:
                return 'Primero';
                break;
            case 2:
                return 'Segundo';
                break;
            case 3:
                return 'Tercero';
                break;
            case 4:
                return 'Cuarto';
                break;
            case 5:
                return 'Quinto';
                break;
            case 'I':
                return 'Primero';
                break;
            case 'II':
                return 'Segundo';
                break;
            case 'III':
                return 'Tercero';
                break;
            case 'IV':
                return 'Cuarto';
                break;
            case 'V':
                return 'Quinto';
                break;
        }
    }

?>