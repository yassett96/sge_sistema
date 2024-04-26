<?php
    require_once("../../Modelo/Participante/MInscripcionEventoFeria.php");
    require_once("../../Assets/AuxiliarPhp/helperPhp.php");    
    require_once("../../Assets/AuxiliarPhp/Constants.php");

    $vgInscripcionEventoFeria = new InscripcionEventoFeriaModelo();
    $vgHelperPhp = new helperPhp();

    /**Para registrar el proyecto*/
    if(isset($_GET['nombre_proyecto']) && isset($_GET['descripcion']) && isset($_GET['categoria']) &&
    isset($_GET['tutor']) && isset($_GET['sub_categoria']) && isset($_GET['varRegistrarProyecto'])){
        $nombre_proyecto=$_POST['nombre_proyecto'];
        $descripcion=$_POST['descripcion'];
        $categoria=$_REQUEST['categoria'];
        $tutor=$_REQUEST['tutor'];
        $subcategoria=$_REQUEST['sub_categoria'];

        $resultado = func_guardar_proyecto($nombre_proyecto, $descripcion, $categoria, $tutor, $subcategoria);

        if($resultado == true){
            echo "<script>alert('Proyecto guardado correctamente');</script>";
            // echo "<script>window.history.go(-1);</script>";        
        }    
        else
            echo "<script>alert('Error al guardar el proyecto');</script>";
    }
    /**************************************/  

    /**Para registrar el participante y el proyecto con los participantes*/

    if(isset($_GET['nombre_proyecto']) && isset($_GET['descripcion']) && isset($_GET['categoria']) && 
    isset($_GET['sub_categoria']) && isset($_GET['tutor']) && isset($_GET['requerimiento']) && isset($_GET['inputCodigoRegistroParticipante1']) && 
    isset($_GET['inputCodigoRegistroParticipante2']) && isset($_GET['inputCodigoRegistroParticipante3']) && isset($_GET['inputGrupoParticipante1']) && 
    isset($_GET['inputGrupoParticipante2']) && isset($_GET['inputGrupoParticipante3']) && isset($_GET['vacioCamposFormularioParticipante2'])
    && isset($_GET['vacioCamposFormularioParticipante3'])){

        //Datos del proyecto
        $vgStrNombreProyecto = $_GET['nombre_proyecto'];
        $vgStrDescripcionProyecto = $_GET['descripcion'];
        $vgStrIdCategoriaProyecto = $_GET['categoria'];
        $vgStrIdSubCategoria = $_GET['sub_categoria'];
        $vgStrIdTutor = $_GET['tutor'];
        $vgStrRequerimiento = $_GET['requerimiento'];

        //Codigo registro de los participantes
        $vgStrCodigoRegistroParticipante1 = $_GET['inputCodigoRegistroParticipante1'];
        $vgStrCodigoRegistroParticipante2 = $_GET['inputCodigoRegistroParticipante2'];
        $vgStrCodigoRegistroParticipante3 = $_GET['inputCodigoRegistroParticipante3'];
        
        //Obteniendo el grupo que están los participantes
        $vgStrIdGrupoParticipante1 = $_GET['inputGrupoParticipante1'];
        $vgStrIdGrupoParticipante2 = $_GET['inputGrupoParticipante2'];
        $vgStrIdGrupoParticipante3 = $_GET['inputGrupoParticipante3']; 

        //Obteniendo si los campos de los formularios están vacíos para no tomarlos en cuenta cuando se registre
        $vgIntVacioCamposFormularioParticipante2 = $_GET['vacioCamposFormularioParticipante2'];
        $vgIntVacioCamposFormularioParticipante3 = $_GET['vacioCamposFormularioParticipante3'];               
        
        //EJECUTAMOS LA FUNCIÓN PARA INSERTAR EL PARTICIPANTE PROYECTO Y EL PROYECTO.
        func_insertar_participante_proyecto_con_proyecto($vgStrNombreProyecto, $vgStrDescripcionProyecto, $vgStrIdCategoriaProyecto, $vgStrIdSubCategoria, $vgStrIdTutor, 
        $vgStrRequerimiento, $vgStrCodigoRegistroParticipante1, $vgStrCodigoRegistroParticipante2, $vgStrCodigoRegistroParticipante3, $vgStrIdGrupoParticipante1, 
        $vgStrIdGrupoParticipante2, $vgStrIdGrupoParticipante3, $vgIntVacioCamposFormularioParticipante2, $vgIntVacioCamposFormularioParticipante3);
    }

    /**************************************/  

    /** Para obtener las subcategorias */
    $id_categoria = 0;
    if(isset($_GET['varIdCategoria']) && isset($_GET['varNumeroCarnet'])){
        $id_categoria = $_GET['varIdCategoria'];
        $vparNumeroCarnet = $_GET['varNumeroCarnet'];

        $vlocSubCategorias = FunObtenerSubCategoriaSegunCategoriaYParticipante($vparNumeroCarnet, $id_categoria);        
        $vlocTex = '<option value="" selected disabled hidden>Seleccione la subcategoría</option>';

        for($y=0; $y<count(FunObtenerSubCategoriaSegunCategoriaYParticipante($vparNumeroCarnet, $id_categoria)); $y++){
            $vlocSubCategoriasExplode = explode(",", $vlocSubCategorias[$y]);
            $vlocTex = $vlocTex.'<option class="optionCategoria" value="'.($vlocSubCategoriasExplode[0]).'">'.$vlocSubCategoriasExplode[1].'</option>';
        }

        echo $vlocTex;
    }
    /**************************************/
    /**Para verificar si el participante que se quiere inscribir puede en las categorías seleccionadas */
    if(isset($_GET['varCodigoRegistroVerifPart']) && isset($_GET['varIdCategoriaVerifPart']) && isset($_GET['varIdSubCategoriaVerifPart'])){
        $vlocStrCodigoRegistro = $_GET['varCodigoRegistroVerifPart'];
        $vlocIntIdCategoria = $_GET['varIdCategoriaVerifPart'];
        $vlocIntIdSubCategoria = $_GET['varIdSubCategoriaVerifPart'];

        $vlocResultadoVerificacion = FunVerificarIntegranteProyectoSegunParticipante($vlocStrCodigoRegistro, $vlocIntIdCategoria, $vlocIntIdSubCategoria);

        echo $vlocResultadoVerificacion;
    }
    /**************************************/
    /**Para obtener el carnet del participante que está inscribiendo */
    if(isset($_GET['varObtenerCarnetParticipanteInscribiendo'])){
        session_start();
        $vlocCarnetParticipanteInscribiendo = $_SESSION['Carnet'];
        echo $vlocCarnetParticipanteInscribiendo;
    }
    /**************************************/

    /**Para obtener el número de proyectos que está inscrito el participante */
    if(isset($_GET['vparCodRegParticipante'])){
        $vlocCodRegParticipante = $_GET['vparCodRegParticipante'];
        
        $vlocNoProyectos = FunObtenerNoProyectosInscritosSegunCodRegParticipante($vlocCodRegParticipante);

        echo $vlocNoProyectos;
    }
    /**************************************/

    /**Para obtener datos participante con el código de registro */
    if(isset($_GET['varCodigoRegistro'])){
        $vlocCodigoRegistro = $_GET['varCodigoRegistro'];

        $vlocResultadosDatosParticipante = FuncObtenerDatosParticipantePorCodigoRegistro($vlocCodigoRegistro);

        $vlocTexRespuestas = '';

        if($vlocResultadosDatosParticipante != '1'){            
            $row = $vlocResultadosDatosParticipante->fetch_assoc();            
            if($row != null){
                $vlocTexRespuestas = $row["Primer_Nombre"].",".$row['Segundo_Nombre'].",".$row['Primer_Apellido'].",".$row['Segundo_Apellido'].",".$row['Cedula'].",".$row['ID_Numero_Carnet'].",".$row['ID_Grupo'].",".$row['ID_Sede'].",".$row['Telefono'].",".$row['Correo_Electronico'].",".$row['ID_Persona'];                
            }
        }

        echo $vlocTexRespuestas;
    }
    /**************************************/

    /**Para obtener el id del participante que está inscribiendo */
    if(isset($_GET['vlocInicioInfoParticipante'])){
        session_start();
        $vlocInfoParticipante = $_SESSION['Nombre'].",".$_SESSION['Apellido'];
        echo $vlocInfoParticipante;
    }

    /**Para registrar el envío de mensaje para la confirmación */
    if(isset($_GET['varIdPersonaInscribiendo']) && isset($_GET['varCodigoConfirmacion']) && isset($_GET['varIdPersonaAInscribir'])){
        $vlocIdPersonaInscribiendo = $_GET['varIdPersonaInscribiendo'];
        $vlocIdCodigoConfirmacion = $_GET['varCodigoConfirmacion'];
        $vlocIdPersonaAInscribir = $_GET['varIdPersonaAInscribir'];                

        $vlocResultadosInsercionMensajeParticipante = $vgInscripcionEventoFeria->FunRegistrarEnvioMensajeConfirmacion($vlocIdPersonaInscribiendo, $vlocIdPersonaAInscribir, $vlocIdCodigoConfirmacion);
        
        echo $vlocResultadosInsercionMensajeParticipante;
    }
    /**************************************/

    /**Para Eliminar el código de confirmacion del participante si se excede el tiempo */
    if(isset($_GET['varIdPersonaInscribiendoEli']) && isset($_GET['varIdPersonaAInscribirEli'])){        
        $vlocIdPersonaInscribiendo = $_GET['varIdPersonaInscribiendoEli'];
        $vlocIdPersonaAInscribir = $_GET['varIdPersonaAInscribirEli'];

        $vlocResultadoEliminacion = $vgInscripcionEventoFeria->FunEliminarCodConfirmacionParticipanteTiempoExedido($vlocIdPersonaInscribiendo, $vlocIdPersonaAInscribir);

        echo $vlocResultadoEliminacion;
    }
    /**************************************/

    /**Para eliminar el código de confirmación participante cuando se ha verificado */
    if(isset($_GET['varIdPersonaInscribiendoEliVerif']) && isset($_GET['varIdPersonaAInscribirEliVerif'])){
        $vlocIdPersonaInscribiendo = $_GET['varIdPersonaInscribiendoEliVerif'];
        $vlocIdPersonaAInscribir = $_GET['varIdPersonaAInscribirEliVerif'];

        $vlocResultadoEliminacion = $vgInscripcionEventoFeria->FunEliminarRegistroConfirmacionParticipante($vlocIdPersonaInscribiendo, $vlocIdPersonaAInscribir);

        echo $vlocResultadoEliminacion;
    }
    /**************************************/

    /**Para verificar que ya existe un registro de confirmación con el participante a inscribir
     * y el que está inscribiendo */
    if(isset($_GET['varIdPersonaInscribiendoExis']) && isset($_GET['varIdPersonaAInscribirExis'])){
        // FunPruebaEchoAlert("Llegamos", "", false);
        $vlocIdPersonaInscribiendo = $_GET['varIdPersonaInscribiendoExis'];
        $vlocIdPersonaAInscribir = $_GET['varIdPersonaAInscribirExis'];

        $vlocResultadoVerificacion = $vgInscripcionEventoFeria->FunVerificarRegistroConfirmacionParticipante($vlocIdPersonaInscribiendo, $vlocIdPersonaAInscribir);        
        echo $vlocResultadoVerificacion;
    }
    /**************************************/

    /**Para verificar el código de confirmación del participante */
    if(isset($_GET["varCodigoConfirmacionVerif"]) && isset($_GET["varIdPersonaInscribiendoVerif"]) && isset($_GET["varIdPersonaAInscribirVerif"])){
        $vlocCodigoConfirmacion = $_GET["varCodigoConfirmacionVerif"];
        $vlocIdPersonaInscribiendo = $_GET["varIdPersonaInscribiendoVerif"];
        $vlocIdPersonaAInscribir = $_GET["varIdPersonaAInscribirVerif"];

        $vlocResultadoVerificacion = $vgInscripcionEventoFeria->FunVerificarCodConfirmacionParticipante($vlocCodigoConfirmacion, $vlocIdPersonaInscribiendo, $vlocIdPersonaAInscribir);
        echo $vlocResultadoVerificacion;
    }
    /**************************************/

    /**Para obtener el grupo según el id del grupo*/
    if(isset($_GET["varIdGrupo"])){
        $vlocIdGrupo = $_GET["varIdGrupo"];
        
        $vlocGrupo = $vgInscripcionEventoFeria->FunObtenerGrupoSegunIdGrupo($vlocIdGrupo);
        echo $vlocGrupo;
    }
    /**************************************/

    /**Para obtener la sede según el id de la sede */
    if(isset($_GET["varIdSede"])){
        $vlocIdSede = $_GET["varIdSede"];

        $vlocSede = $vgInscripcionEventoFeria->FunObtenerSedeSegunIdSede($vlocIdSede);
        echo $vlocSede;
    }
    /**************************************/

    /**Para obtener el Id de la persona que está inscribiendo */
    if(isset($_GET["blnObtenerIdPersonaInscribiendo"])){              
        session_start();
        $vlocIdPersonaInscribiendo = $_SESSION['Idpersona'];
        echo $vlocIdPersonaInscribiendo;
    }
    /**************************************/

    /**Para obtener los datos completos del participante que está inscribiendo */
    if(isset($_GET["blnObtenerDatosParticipanteInscribiendo"])){        
        session_start();
        
        $vlocDatosPersonaInscribiendo = '';
        $vlocDatosPersonaInscribiendo = $_SESSION['Nombre'];
        $vlocDatosPersonaInscribiendo = $vlocDatosPersonaInscribiendo.",".$_SESSION['SegundoNombre'];
        $vlocDatosPersonaInscribiendo = $vlocDatosPersonaInscribiendo.",".$_SESSION['Apellido'];
        $vlocDatosPersonaInscribiendo = $vlocDatosPersonaInscribiendo.",".$_SESSION['SegundoApellido'];
        $vlocDatosPersonaInscribiendo = $vlocDatosPersonaInscribiendo.",".$_SESSION['Cedula'];
        $vlocDatosPersonaInscribiendo = $vlocDatosPersonaInscribiendo.",".$_SESSION['Carnet'];
        $vlocDatosPersonaInscribiendo = $vlocDatosPersonaInscribiendo.",".$_SESSION['IdGrupo'];
        $vlocDatosPersonaInscribiendo = $vlocDatosPersonaInscribiendo.",".$_SESSION['IdSede'];        
        $vlocDatosPersonaInscribiendo = $vlocDatosPersonaInscribiendo.",".$_SESSION['Telefono'];        
        $vlocDatosPersonaInscribiendo = $vlocDatosPersonaInscribiendo.",".$_SESSION['Correo'];  
        $vlocDatosPersonaInscribiendo = $vlocDatosPersonaInscribiendo.",".$_SESSION['Cod'];                      
        
        $vlocDatosPersonaInscribiendoExploded = explode(",", $vlocDatosPersonaInscribiendo);
        
        echo $vlocDatosPersonaInscribiendo;
    }
    /**************************************/

    /**Para obtener el id del participante inscribiendo */
    if(isset($_GET['varObtenerIdParticipanteInscribiendo'])){
        session_start(); 
        
        echo $_SESSION['IdSede'];
    }
    /**************************************/

    /*Inicio Funciones Categorías*/
    function FunObtenerCategoriasSegunParticipante($vparIdNumeroCarnet){
        $modeloCategoria = new InscripcionEventoFeriaModelo();

        $vlocResult = $modeloCategoria->FunObtenerCategoriasSegunParticipante($vparIdNumeroCarnet);
        $vlocCategorias = array();

        if($vlocResult == true){

            $vlocNumResultados = $vlocResult->num_rows;

            for($i=0; $i<$vlocNumResultados ; $i++){
                $vlocRow = mysqli_fetch_array($vlocResult, MYSQLI_BOTH);
                array_push($vlocCategorias, $vlocRow["ID_Categoria"].",".$vlocRow['Nombre_Categoria']);
            }

            return $vlocCategorias;
        }else{
            echo "<script>alert('Error al cargar las categorias');</script>";
        }
    }

    function FuncObtenerIdCategoriaSeleccionada(){
        global $gValorIdCategoria;
        return $gValorIdCategoria;
    }

    function SetObtenerIdCategoriaSeleccionada($content = ''){
        $document = new DOMDocument();
        $document->loadHTML($content);

        $tag = $document->getElementsById('aTexto');

        $tag->setAttribute('id', 'aTextocambiado');
    }
    /**************************************/

    /**Inicio Funciones Sub Categorías */
    function FunObtenerSubCategoriaSegunCategoriaYParticipante($vparNumeroCarnet, $idCategoria){
        $modelosubcategoria = new InscripcionEventoFeriaModelo();

        $vlocResult = $modelosubcategoria->FunObtenerSubCategoriaSegunCategoriaYParticipante($vparNumeroCarnet, $idCategoria);
        $vlocSubCategorias = array();

        if($vlocResult == true){

            $vlocNumResultados = $vlocResult->num_rows;

            for($i=0; $i<$vlocNumResultados ; $i++){
                $vlocRow = mysqli_fetch_array($vlocResult, MYSQLI_BOTH);
                array_push($vlocSubCategorias, $vlocRow["ID_SubCategoria"].",".$vlocRow['Nombre_SubCategoria']);
            }

            return $vlocSubCategorias;
        }
        else{
            echo "<script>alert('Error al obtener la Subcategoría');</script>";
        }

    }

    function FuncObtenerSubCategorias(){
        return FuncObtenerSubCategoriaPorIdCategoria($id_categoria);
    }
    /**************************************/

    /**Inicio Funciones Grupo */
    Function FuncObtenerListaGrupos(){

        $vlocGrupoModelo = New InscripcionEventoFeriaModelo();

        $vlocResultado = $vlocGrupoModelo->FuncObtenerListaGrupos();

        $vlocGrupo = array();

        if($vlocResultado == true){

            $vlocNumeroResultados = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumeroResultados; $i++){
                $vlocFila = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocGrupo, '<option value="'.$vlocFila["ID_Grupo"].'">'.$vlocFila["grupo"].'</option>,');
            }

            return $vlocGrupo;
        }
        else
            echo "<script>alert('Error al obtener los grupos.');</script>";
    }
    /**************************************/

    /**Inicio Funciones Sede */
    Function FuncObtenerListaSedes(){
        $vlocSedeModelo = New InscripcionEventoFeriaModelo();

        $vlocResultado = $vlocSedeModelo->FuncObtenerListaSedes();
        $vlocSede = array();

        if($vlocResultado == true){
            $vlocNumeroResultados = $vlocResultado->num_rows;

            for($i=0; $i<$vlocNumeroResultados; $i++){
                $vlocFila = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);
                array_push($vlocSede, $vlocFila['Sede']);
            }

            return $vlocSede;
        }
        else
            echo "<script>alert('Error al obtener las sedes.');</script>";
    }
    /**************************************/

    /**Inicio Funciones Personal Académico */
    function FuncObtenerTutores(){
        $modeloPersonalAcademico = new InscripcionEventoFeriaModelo();

        $vlocResultado = $modeloPersonalAcademico->FuncObtenerTutores();        
        $vlocNombres = array();

        if($vlocResultado == true){
            $vlocNumeroResultados = $vlocResultado->num_rows;


            for($i=0; $i<$vlocNumeroResultados; $i++){
                $vlocFila = mysqli_fetch_array($vlocResultado, MYSQLI_BOTH);

                array_push($vlocNombres, $vlocFila['ID_Personal_Academico'].",".$vlocFila['Primer_Nombre'].",".$vlocFila['Primer_Apellido']);
            }


            return $vlocNombres;
        }
        else
            echo "<script>alert('Error al obtener los nombre y apellidos de los docentes');</script>";
    }
    /**************************************/

    /**Inicio Funciones Participante */
    Function FuncObtenerDatosParticipantePorCodigoRegistro($vparCodigoRegistro){
        $vlocModeloInscripcionEventoFeriaModelo = New InscripcionEventoFeriaModelo();

        $vlocResultado = $vlocModeloInscripcionEventoFeriaModelo->FuncObtenerDatosParticipantePorCodigoRegistro($vparCodigoRegistro);

        if($vlocResultado == true){

            return $vlocResultado;
        }
        else
            echo "<script>alert('Error al obtener el participante por codigo de registro');</script>";
    }

    Function FuncModificarIdGrupoParticipantePorCodigoRegistro($vparCodigoRegistro, $vparIdGrupo){
        $vlocModeloParticipante = New InscripcionEventoFeriaModelo();

        $vlocResultado = $vlocModeloParticipante->FuncModificarIdGrupoParticipantePorCodigoRegistro($vparCodigoRegistro, $vparIdGrupo);

        if($vlocResultado == true)
            return $vlocResultado;
        else
            echo "<script>alert('Error al modificar el id del grupo del participante por codigo de registro');</script>";
    }

    Function FunVerificarIntegranteProyectoSegunParticipante($vparStrCodigoRegistro, $vparIntIdCategoria, $vparIntIdSubCategoria){
        $vlocModeloParticipante = New InscripcionEventoFeriaModelo();

        $vlocResultado = $vlocModeloParticipante->FunVerificarIntegranteProyectoSegunParticipante($vparStrCodigoRegistro, $vparIntIdCategoria, $vparIntIdSubCategoria);

        if($vlocResultado == CteAccesoPermitido || $vlocResultado == CteValorNull)
            return $vlocResultado;
        else
            return "<script>alert('Error al verificar el participante para integrarse al proyecto');</script>";
    }

    Function FunObtenerNoProyectosInscritosSegunCodRegParticipante($vparCodRegParticipante){
        $vlocModeloParticipante = New InscripcionEventoFeriaModelo();

        $vlocResultado = $vlocModeloParticipante->FunObtenerNoProyectosInscritosSegunCodRegParticipante($vparCodRegParticipante);

        return $vlocResultado;        
    }
    /**************************************/

    /**Funciones para la inscripción al evento Feria con los participantes */

    //Función general para insertar el proyecto y los participantes
    function func_insertar_participante_proyecto_con_proyecto($vparStrNombreProyecto, $vparStrDescripcion, $vparIntIdCategoria, 
        $vparIntIdSubCategoria, $vparIntIdTutor, $vparRequerimiento, $vparCodigoRegistroParticipante1, $vparCodigoRegistroParticipante2, $vparCodigoRegistroParticipante3,
        $vparStrIdGrupoParticipante1, $vparStrIdGrupoParticipante2, $vparStrIdGrupoParticipante3, $vparIntVacioCamposFormularioParticipante2, $vparIntVacioCamposFormularioParticipante3){
        
        $vlocHelperPhp = new helperPhp();    
        $vlocClassInscripcionEventoFeria = new InscripcionEventoFeriaModelo();
        //Obteniendo el ID_Categoria_Evento según la categoria y subcategoria
        // $vlocIdCategoriaEvento = FunObtenerIdCategoriaEventoPorCategoriaYSubCategoria($vparIntIdCategoria, $vparIntIdSubCategoria);        
        
        //Guardando Proyecto
        $vlocResultadoInsercionProyecto = func_guardar_proyecto($vparStrNombreProyecto, $vparStrDescripcion, $vparIntIdSubCategoria, $vparIntIdTutor, $vparRequerimiento);
            
        //Obteniendo Id del proyecto recien registrado
        $vlocIntIdUltimoProyectoRegistrado = $vlocHelperPhp->funcObtenerUltimoIdRegistrado('Proyecto', 'ID_Proyecto');                

        //Modificación del id del grupo de los participantes según el id del registro        
        $vlocResultadoModificacionIdGrupoParticipante1 = funcVerificarInsercionCodigoRegistroYModificarGrupo(1, $vparCodigoRegistroParticipante1, $vlocClassInscripcionEventoFeria, $vparStrIdGrupoParticipante1);                        

        if ($vparIntVacioCamposFormularioParticipante2 == CteFormularioCompletado)
            $vlocResultadoModificacionIdGrupoParticipante2 = funcVerificarInsercionCodigoRegistroYModificarGrupo(2, $vparCodigoRegistroParticipante2, $vlocClassInscripcionEventoFeria, $vparStrIdGrupoParticipante2);
        else
            $vlocResultadoModificacionIdGrupoParticipante2 = "Formulario 2 vacío";
        
        if ($vparIntVacioCamposFormularioParticipante3 == CteFormularioCompletado)
            $vlocResultadoModificacionIdGrupoParticipante3 = funcVerificarInsercionCodigoRegistroYModificarGrupo(3, $vparCodigoRegistroParticipante3, $vlocClassInscripcionEventoFeria, $vparStrIdGrupoParticipante3);        
        else
            $vlocResultadoModificacionIdGrupoParticipante3 = "Formulario 3 vacío";

        //Obteniendo datos del participante e insertándolos en el proyecto   
        
        $vlocResultadoInsercionParticipanteProyecto1 = funcInsercionParticipanteProyectoGeneral(1, $vparCodigoRegistroParticipante1,$vlocClassInscripcionEventoFeria, $vlocIntIdUltimoProyectoRegistrado);                        

        if ($vparIntVacioCamposFormularioParticipante2 == CteFormularioCompletado){            
            
            $vlocResultadoInsercionParticipanteProyecto2 = funcInsercionParticipanteProyectoGeneral(2, $vparCodigoRegistroParticipante2,$vlocClassInscripcionEventoFeria, $vlocIntIdUltimoProyectoRegistrado);            
        }            
        else
            $vlocResultadoInsercionParticipanteProyecto2 = "Formulario 2 vacío";

        if ($vparIntVacioCamposFormularioParticipante3 == CteFormularioCompletado){
            $vlocResultadoInsercionParticipanteProyecto3 = funcInsercionParticipanteProyectoGeneral(3, $vparCodigoRegistroParticipante3,$vlocClassInscripcionEventoFeria, $vlocIntIdUltimoProyectoRegistrado);                           
        }            
        else
            $vlocResultadoInsercionParticipanteProyecto3 = "Formulario 3 vacío";

        //Obtenemos el id del evento feria actual
        $vlocIdEventoActual = FunObtenerIdEventoActual();

        //Insertando la relación del proyecto con el evento
        $vlocResultadoInsercionEventoProyecto = FunInsertarEventoProyecto($vlocIdEventoActual, $vlocIntIdUltimoProyectoRegistrado);
        
        //Verificamos si se insertaron los participantes
        funcVerificarResultadoInsercionParticipanteProyecto($vlocResultadoInsercionParticipanteProyecto1, $vlocResultadoInsercionParticipanteProyecto2,
        $vlocResultadoInsercionParticipanteProyecto3, $vlocResultadoInsercionProyecto, $vlocResultadoModificacionIdGrupoParticipante1, 
        $vlocResultadoModificacionIdGrupoParticipante2, $vlocResultadoModificacionIdGrupoParticipante3, $vlocResultadoInsercionEventoProyecto);            
    }

    function funcVerificarResultadoInsercionParticipanteProyecto($vparResultadoInsercionParticipanteProyecto1, $vparResultadoInsercionParticipanteProyecto2, 
    $vparResultadoInsercionParticipanteProyecto3, $vparResultadoInsercionProyecto, $vparResultadoModificacionIdGrupoParticipante1, 
    $vparResultadoModificacionIdGrupoParticipante2, $vparResultadoModificacionIdGrupoParticipante3, $vparResultadoInsercionEventoProyecto){
        //Verificamos si los resultados de las inserciones fueron verdaderas, si es así, se lanza un aviso que se insertaron correctamente.
        if($vparResultadoInsercionProyecto == true)
            echo "<script>alert('Proyecto guardado correctamente');</script>";
        else
            echo "<script>alert('Error al guardar el proyecto');</script>";

        if($vparResultadoModificacionIdGrupoParticipante1 == true)
            echo "<script>alert('Id Grupo Modificado del Participante 1');</script>";
        else
            echo "<script>alert('Error al modificar el Id Grupo del Participante 1');</script>";

        if($vparResultadoModificacionIdGrupoParticipante2 == true)
            echo "<script>alert('Id Grupo Modificado del Participante 2');</script>";
        else
            echo "<script>alert('Error al modificar el Id Grupo del Participante 2');</script>";

        if($vparResultadoModificacionIdGrupoParticipante3 == true)
            echo "<script>alert('Id Grupo Modificado del Participante 3');</script>";
        else
            echo "<script>alert('Error al modificar el Id Grupo del Participante 3');</script>";

        if($vparResultadoInsercionParticipanteProyecto1 == true)
            echo "<script>alert('Participante 1 guardado correctamente');</script>";
        else
            echo "<script>alert('Error al guardar el participante 1');</script>";

        if($vparResultadoInsercionParticipanteProyecto2 == true)
            echo "<script>alert('Participante 2 guardado correctamente');</script>";
        else
            echo "<script>alert('Error al guardar el participante 2');</script>";

        if($vparResultadoInsercionParticipanteProyecto3 == true)
            echo "<script>alert('Participante 3 guardado correctamente');</script>";                
        else
            echo "<script>alert('Error al guardar el participante 3');</script>";

        if($vparResultadoInsercionEventoProyecto == 1)
            echo "<script>alert('Relación de evento con el proyecto registrado correctamente');</script>";
        else
            echo "<script>alert('Error registrar la relación del evento del proyecto');</script>";
    }
         
    function funcInsercionParticipanteProyectoGeneral($vparIntNumeroParticipante, $vparCodigoRegistroParticipante, $vparClassModeloParticipante, $vparIntIdUltimoProyectoRegistrado){
        //Verificamos si se ingresó el código participante y usamos una función general para obtener los datos del participante e insertar los participantes al proyecto.
        if(funcCodigoRegistroParticipanteVacio($vparCodigoRegistroParticipante))
            return funcObtenerDatosParticipanteInsertarParticipantesProyecto($vparClassModeloParticipante, $vparCodigoRegistroParticipante, $vparIntIdUltimoProyectoRegistrado);        
    }           
    
    function funcCodigoRegistroParticipanteVacio($vparCodigoRegistroParticipante){
        //Viendo si el código registro del participante NO es nulo y si NO está vacío.
        if(!is_null($vparCodigoRegistroParticipante) && $vparCodigoRegistroParticipante != '')
            return true;
        else
            return false;        
    }
    
    function funcVerificarInsercionCodigoRegistroYModificarGrupo($vparIntNumeroParticipante,$vparCodigoRegistroParticipante, $vparClassModeloParticipante, $vparStrIdGrupoParticipante){
        $vlocHelperPhp = new helperPhp();
        if(funcCodigoRegistroParticipanteVacio($vparCodigoRegistroParticipante))
            return funcModificarIdGrupoParticipantePorCodigoRegistro($vparCodigoRegistroParticipante, $vparStrIdGrupoParticipante);
        else{
            $vlocHelperPhp->funcActivarAlerta("info", "Código registro no ingresado", "El código de registro del participante ".$vparIntNumeroParticipante." no está ingresado. No se registrará");
            echo "Código registro no ingresado. El código de registro del participante ".$vparIntNumeroParticipante." no está ingresado. No se registrará";
            return '';
        }
    }
    
    function funcObtenerDatosParticipanteInsertarParticipantesProyecto($vparClassModeloParticipante, $vparCodigoRegistroParticipante, $vparIntIdUltimoProyectoRegistrado){
        if(funcCodigoRegistroParticipanteVacio($vparCodigoRegistroParticipante)){        
            //Obteniendo Id del participante    
            $vlocObjParticipante = funcObtenerDatosParticipantePorCodigoRegistro($vparCodigoRegistroParticipante)->fetch_assoc();
                
            //Obteniendo el id del participante (El número de carnet)
            $vlocStrIdParticipante = $vlocObjParticipante['ID_Numero_Carnet'];                     

            //Insertando los participantes al proyecto
            return func_insertar_participante_proyecto($vlocStrIdParticipante, $vparIntIdUltimoProyectoRegistrado);
        }
    }

    function func_insertar_participante_proyecto($vparStrIdParticipante, $vparIntIdProyecto){
        //Instanciamos la clase de del ParticipanteProyecto
        $modeloInscripcionEventoFeriaModelo = new InscripcionEventoFeriaModelo();

        //Obtenemos el id del participante para verificar si hay existencia en la base de datos.
        $vlocIntParticipanteProyecto = funcVerificarExistenciaParticipanteEnProyecto($vparStrIdParticipante, $vparIntIdProyecto);
        
        if($vlocIntParticipanteProyecto == 1){        
            //Insertamos el proyecto y obtenemos el resultado de la inserción        
            $vlocResult = $modeloInscripcionEventoFeriaModelo->func_Insertar_Participante_Proyecto($vparStrIdParticipante, $vparIntIdProyecto);
        }
        else
            $vlocResult = false;

        //Verificamos si se insertó el participante al proyecto.
        if($vlocResult == true)
            return $vlocResult;
        else{
            echo "<script>alert('Error al guardar el participante en el proyecto');</script>";
            return false;
        }        
            
    }

    function FunInsertarEventoProyecto($vparIdEvento, $vparIdProyecto){
        $modeloInscripcionEventoFeriaModelo = new InscripcionEventoFeriaModelo();

        $vlocIntResultadoInsercionEventoProyecto = $modeloInscripcionEventoFeriaModelo->FunInsertarEventoProyecto($vparIdEvento, $vparIdProyecto);

        if($vlocIntResultadoInsercionEventoProyecto == CteSeInsertoEventoProyecto){
            return $vlocIntResultadoInsercionEventoProyecto;
        }else
            return 0;

    }

    function FunObtenerIdEventoActual(){
        $modeloInscripcionEventoFeriaModelo = new InscripcionEventoFeriaModelo();

        $vlocIntResultadoObtenerIdEventoActual = $modeloInscripcionEventoFeriaModelo->FunObtenerIdEventoActual();

        if($vlocIntResultadoObtenerIdEventoActual)
            return $vlocIntResultadoObtenerIdEventoActual;
        else
            return 'Error al obtener el id del evento actual';
    }
    
    Function funcVerificarExistenciaParticipanteEnProyecto($vparStrIdParticipante, $vparIntIdProyecto){
        //Instanciamos la clase de Participante Proyecto.
        $modeloInscripcionEventoFeriaModelo = new InscripcionEventoFeriaModelo();

        //Obtenemos y guardamos el resultado de la verificación
        $vlocResult = $modeloInscripcionEventoFeriaModelo->funcVerificarExistenciaParticipanteEnProyecto($vparStrIdParticipante, $vparIntIdProyecto);

        //Verificamos si se tuvo éxito al verificar
        if($vlocResult == CteExisteParticipanteEnProyecto){
            echo "<script>alert('Este id participante ya existe en el proyecto.');</script>";        
            return false;
        }
        else{
            echo "<script>alert('Se verificó que el participante no pertenece al proyecto.');</script>";        
            return true;
        }
            
    }

    function func_guardar_proyecto($vparNombre, $vparDescripcion, $vparIdSubCategoria, $vparIdPersonalAcademico, $vparRequerimiento){
        $modeloInscripcionEventoFeriaModelo = new InscripcionEventoFeriaModelo();
    
        $vlocResult = $modeloInscripcionEventoFeriaModelo->func_guardar_proyecto($vparNombre, $vparDescripcion, $vparIdSubCategoria, $vparIdPersonalAcademico, $vparRequerimiento);
    
        if($vlocResult == true){
            return $vlocResult;
        }
        else{
            return "<script>alert('Error al guardar el proyecto');</script>";        
        }
    }

    // Function FunObtenerIdCategoriaEventoPorCategoriaYSubCategoria($vparIdCategoria, $vparIdSubCategoria){
    //     $modeloInscripcionEventoFeriaModelo = new InscripcionEventoFeriaModelo();

    //     $vlocResultado = $modeloInscripcionEventoFeriaModelo->FunObtenerIdCategoriaEventoPorCategoriaYSubCategoria($vparIdCategoria, $vparIdSubCategoria);

    //     if($vlocResultado != CteNoExisteCategoriaEvento){
    //         return $vlocResultado;
    //     }else
    //         return 'Error al obtener la categoria evento, Controlador, FunObtenerIdCategoriaEventoPorCategoriaYSubCategoria';
    // }
    /**************************************/
?>