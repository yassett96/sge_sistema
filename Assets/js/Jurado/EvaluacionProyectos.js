//Para gestionar la información de los proyectos e integrantes
var IdProyectoSeleccionado = ""; //FunEjecutarAjax("../../Controlador/Jurado/CEvaluacionProyectos.php&vparBoolObtenerIdProyectoEvaluar=" + true);
var idPersonaJurado = ""; //FunEjecutarAjax("../../Controlador/Jurado/CEvaluacionProyectos.php&vparBoolObtenerIdPersonaJurado=" + true);
var idFormatoJurado = "";
var idEventoActual = 0;
var vlocNombre = "";
var vlocDescripcion = "";
var vlocNombreCategoria = "";
var vlocNombreSubCategoria = "";
var vlocPrimerNombreTutor = "";
var vlocPrimerApellidoTutor = "";
var vlocNombreIntegrante1 = "";
var vlocNombreIntegrante2 = "";
var vlocNombreIntegrante3 = "";
var vlocNoCarnet1 = "";
var vlocNoCarnet2 = "";
var vlocNoCarnet3 = "";
// Para asegurarse de que cargue toda la página antes de activar las funciones
$(document).ready(function() { 

  IdProyectoSeleccionado = FunEjecutarAjax("../../Controlador/Jurado/CEvaluacionProyectos.php?vparBoolObtenerIdProyectoEvaluar=" + true);
  idPersonaJurado = FunEjecutarAjax("../../Controlador/Jurado/CEvaluacionProyectos.php?vparBoolObtenerIdPersonaJurado=" + true);

  var vlocInfoJurado = FunEjecutarAjax("../../Controlador/Jurado/CEvaluacionProyectos.php?vparIdPersonaInfoJurado=" + idPersonaJurado);
  var vlocDatosArreglo = JSON.parse(vlocInfoJurado);
  var vlocElementoIdFormato = vlocDatosArreglo[0];
  var vlocIdFormatoSplit = vlocElementoIdFormato.split(",");

  idFormatoJurado = vlocIdFormatoSplit[2];

  FunObtenerDatosProyecto(IdProyectoSeleccionado);
  FunObtenerDatosIntegrantesProyecto(IdProyectoSeleccionado);
  FunObtenerCriteriosEvaluacionJurado(idPersonaJurado, idFormatoJurado);

  //INICIO CAMBIO DE MENU MÓVIL
    //  seleccionamos los dos elementos que serán clickables

    const toggleButton = document.getElementById("button-menu");
    const navWrapper = document.getElementById("nav");
    const menuDes = document.getElementById("imgLogUsuario");
    const DivMenuDespliegue = document.getElementById("divMenuDespliegue");

    /* 
      cada ves que se haga click en el botón 
      agrega y quita las clases necesarias 
      para que el menú se muestre.
    */
    toggleButton.addEventListener("click", () => {
      toggleButton.classList.toggle("close");
      navWrapper.classList.toggle("show");
    });

    /* 
      Cuándo se haga click fuera del contenedor de enlaces 
      el menú debe esconderse.
    */

    navWrapper.addEventListener("click", e => {
      if (e.target.id === "nav") {
        navWrapper.classList.remove("show");
        toggleButton.classList.remove("close");
      }
    });

    menuDes.addEventListener("mouseover", e => {
      FunActivarAlerta();
    });

    menuDes.addEventListener("mouseout", e => {
      FunDesactivarAlerta();
    });

    DivMenuDespliegue.addEventListener("mouseover", e => {
      FunActivarAlerta();  
    });

    DivMenuDespliegue.addEventListener("mouseout", e => {
      FunDesactivarAlerta();
    });

    function FunActivarAlerta(){
      let tag = document.getElementById("divMenuDespliegue"); 
      tag.style.top = '-20px';
      tag.style.visibility = 'visible';    
    }

    function FunDesactivarAlerta(){
      let tag = document.getElementById("divMenuDespliegue"); 
      tag.style.top = '-40px';
      tag.style.visibility = 'hidden';    
    }
  //FIN CAMBIO DE MENU MÓVIL

  //INICIO FUNCIONALIDAD
    
    //Funciones para el evento clic de las pestañas
    $(".divPestaña").eq(0).click(function() {      
      FunPestañaDatosProyectoBlanco();
      FunPestañaIntegrantesAzul();
      FunActivarFormularioDatosProyectos();
      FunDesactivarFormularioIntegrante();
    });

    $(".divPestaña").eq(1).click(function() {      
      FunPestañaDatosProyectoAzul();
      FunPestañaIntegrantesBlanco();
      FunDesactivarFormularioDatosProyecto();
      FunActivarFormularioIntegrante();
    });

    //Para hacer la carga general
    $("#selectProyecto").change(function() {
      FunLimpiarCamposFormularios();
      obtenerEImprimirDatosSegunProyecto();
    });

    function FunPestañaDatosProyectoBlanco(){
      $(".divPestaña").eq(0).css({
        "background-color":"white"    
      });

      $("#h1PestañaDatosProyecto").css({
        "color":"#181D43"
      });
    }

    async function waitThreeSeconds() {
      await new Promise(resolve => setTimeout(resolve, 3000)); // Wait for 3 seconds
      console.log("After waiting for 3 seconds, this function is executed.");
    }

    // Clic al botón para terminar la evaluación
    $("#idButtonTerminarEvaluacion").click(function(){
      let vlocBoolCeldaVacia = false;
      let vlocIntPuntacionTotal = 0;
      let vlocStrComentario = '';
      let vlocIdEventoActual = FunEjecutarAjax("../../Controlador/Jurado/CEvaluacionProyectos.php?vparBoolObtenerIdEventoActual=" + true);

      $('td[data-type="number"]').each(function() {
        const cellContent = $(this).text();
        const integerValue = parseInt(cellContent, 10);
        if (isNaN(integerValue)) {
          vlocBoolCeldaVacia = true;
        }
      });

      if(vlocBoolCeldaVacia){
        funActivarAlerta("warning", "Campos incompletos!", "Complete los campos de puntuación para terminar evaluación");
      }else{
        vlocIntPuntacionTotal = $("#idCeldaTotal").text();
        vlocStrComentario = $("#idTextareaComentarios").val();

        // Insertar la evaluación
        var vloc = FunEjecutarAjax("../../Controlador/Jurado/CEvaluacionProyectos.php?vparIdEventoModificarEvaluacion=" + vlocIdEventoActual + "&vparIdProyectoModificarEvaluacion=" + IdProyectoSeleccionado + "&vparCalificacionFinalModificarEvaluacion=" + vlocIntPuntacionTotal + "&vparComentarioModificacionEvaluacion=" + vlocStrComentario);
        
        if(vloc == 1){
          FunActivarAlertaBotonConfirmacion("¡Evaluación registrada!", "La evaluación ha sido registrado correctamente", "success", false, "Ok", "window.location.href = '../../Vista/Jurado/ProyectosAsignados.php'");
        }else{
          funActivarAlerta("error", "¡Error registro evaluación!", "Error al intentar registrar la evaluación");
        }
      }
    });

    // Clic al botón de cancelar la evaluación
    $("#botonCancelarEvaluacion").click( async function() {
      let vlocResultadoCancelacion = await FunActivarAlertaBotonConfirmacionYCancelacion("¡Cancelar evaluación!", "¿Está seguro que desea cancelar la evaluación del proyecto?", "warning", true, "Cancelar evaluación", "Cancelar")

      if(vlocResultadoCancelacion == true){
        history.back();
      }

    });

    function FunObtenerCriteriosEvaluacionJurado(vparIdPersonaJurado, vparIdFormato){
      let vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Jurado/CEvaluacionProyectos.php?vparIdPersonaJurado=" + vparIdPersonaJurado);
            
      var vlocCriteriosEvaluacion = JSON.parse(vlocResultadoAjax);
      var vlocNombreCriterios = '';
      
      vlocNombreCriterios = FunAgregarTextoInstrucciones(vlocCriteriosEvaluacion);
      
      let vlocResultadoAjaxEncabezados = FunEjecutarAjax("../../Controlador/Jurado/CEvaluacionProyectos.php?vparIdFormatoEncabezados=" + vparIdFormato);
      let vlocResultadoAjaxPuntuaciones = FunEjecutarAjax("../../Controlador/Jurado/CEvaluacionProyectos.php?vparIdFormatoContenido=" + vparIdFormato);

      var vlocEncabezadosTabla = JSON.parse(vlocResultadoAjaxEncabezados);
      var vlocContenidoTabla = JSON.parse(vlocResultadoAjaxPuntuaciones);
      
      FunAgregarContenidoTabla(vlocContenidoTabla, vlocEncabezadosTabla);
    }

    function FunAgregarTextoInstrucciones(vparCriteriosEvaluacion){
      var vlocNombreCriterios = ''
      var vlocStrCriterios = '';

      for (var i=0; i<vparCriteriosEvaluacion.length; i++){
        var vlocInfoCriterio = vparCriteriosEvaluacion[i].split(";");

        vlocStrCriterios += vlocInfoCriterio[1] + ': ' + vlocInfoCriterio[2] + '\n\n';
        vlocNombreCriterios += vlocInfoCriterio[1] + ",";
      }
      
      $("#h3TextoInstrucciones").html(vlocStrCriterios);

      return vlocNombreCriterios;
    }

    function FunAgregarContenidoTabla(vparContenidoTabla, vparEncabezadosTabla){ 

      // Inserción
      $("#idTHead").html(vparEncabezadosTabla);
      $("#idTBody").html(vparContenidoTabla);

      // Centrado de texto
      $("#idTable").css({
        'border-collapse': 'collapse'
      });

      $("td").css({
        'text-align':'center'
      });

      $(".tdPuntuaciones").css({
        "height": "40px"
      });

      const cells = document.querySelectorAll('td[data-type="number"]');

      cells.forEach(cell => {
        cell.addEventListener('input', () => {
          const content = cell.textContent.trim();
          if (!isValidNumber(content)) {
            cell.textContent = ''; // Clear invalid input
          }
        });
      });
    }

    function FunValidarPuntuacionCelda(vparNumeroCeldaPuntuacion, vparCntPuntuacionFormato, vparMensajePuntuacionNoValida){
      $(".tdPuntuaciones:eq("+vparNumeroCeldaPuntuacion+")").keyup(function(event) {
        const vlocCellContent = $(this).text();
        
        const vlocIntegerValue = parseInt(vlocCellContent, 10);

        if(vlocIntegerValue > vparCntPuntuacionFormato){
          funActivarAlerta("warning", "Puntuación no válida", vparMensajePuntuacionNoValida);
          $(this).text("");
        }

        FunSumaTotal();
      });
    }

    function isValidNumber(input) {
      return /^-?\d+(\.\d+)?$/.test(input);
    }

    function FunObtenerDatosProyecto(vparIdProyecto){
      let vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Jurado/CEvaluacionProyectos.php?vparIdProyecto=" + vparIdProyecto);
      var vlocDatosProyectos = vlocResultadoAjax.split(",");
      
      $("#inputNombreProyecto").val(vlocDatosProyectos[Cnt_Nombre_Proyecto]);
      $("#inputCategoria").val(vlocDatosProyectos[Cnt_Categoria]);
      $("#inputSubCategoria").val(vlocDatosProyectos[Cnt_Sub_Categoria]);
      $("#inputDescripcionProyecto").val(vlocDatosProyectos[Cnt_Descripcion]);
    }

    function FunObtenerDatosIntegrantesProyecto(vparIdProyecto){
      var vlocIntegrante1 = '--';
      var vlocIntegrante2 = '--';
      var vlocIntegrante3 = '--';

      let vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Jurado/CEvaluacionProyectos.php?vparIdProyectoIntegrantes=" + vparIdProyecto);

      var vlocIntegrantes = JSON.parse(vlocResultadoAjax);

      vlocIntegrante1 = vlocIntegrantes[Cnt_Integrante_1].replace(/,/g, ' ');

      if (vlocIntegrantes[1])
        vlocIntegrante2 = vlocIntegrantes[Cnt_Integrante_2].replace(/,/g, ' ');

      if (vlocIntegrantes[2])
        vlocIntegrante3 = vlocIntegrantes[Cnt_Integrante_3].replace(/,/g, ' ');

      $("#inputIntegrante1").val(vlocIntegrante1);
      $("#inputIntegrante2").val(vlocIntegrante2);
      $("#inputIntegrante3").val(vlocIntegrante3);
    }

    $("#aAtras").click( function() {
      history.back();
    });    

    //Funciones para activar y desactivar los formularios
    function FunPestañaDatosProyectoAzul(){
      $(".divPestaña").eq(0).css({
        "background-color":"#181D43"    
      });

      $("#h1PestañaDatosProyecto").css({
        "color":"white"
      });
    }

    function FunPestañaIntegrantesBlanco(){
      $(".divPestaña").eq(1).css({
        "background-color":"white"
      });

      $("#h1PestañaCriteriosEvaluacion").css({
        "color":"#181D43"
      });
    }

    function FunPestañaIntegrantesAzul(){
      $(".divPestaña").eq(1).css({
        "background-color":"#181D43"
      });

      $("#h1PestañaCriteriosEvaluacion").css({
        "color":"white"
      });
    }

    function FunActivarFormularioDatosProyectos(){
      $("#FormularioInformacionProyecto").css({
        "visibility":"visible"
      });
    }

    function FunDesactivarFormularioDatosProyecto(){
      $("#FormularioInformacionProyecto").css({
        "visibility":"hidden"
      });
    }

    function FunActivarFormularioIntegrante(){
      $("#FormularioEvaluacion").css({
        "visibility":"visible"
      });
    }

    function FunDesactivarFormularioIntegrante(){
      $("#FormularioEvaluacion").css({
        "visibility":"hidden"
      });
    }

    function FunLimpiarCamposFormularios(){
      $(".inputDatosProyecto").val("");
      $(".inputIntegrantes").val("");
    }

    CambiarTextoSegunAnchoPantalla();

    window.addEventListener("resize", CambiarTextoSegunAnchoPantalla);

    function CambiarTextoSegunAnchoPantalla(){ 
      const vlocAnchoPantalla = FunObtenerAnchoPantalla();   
      // console.log("Ancho de la pantalla: " + vlocAnchoPantalla);
      if (vlocAnchoPantalla < 931){        
        $("#firstOptionProyectos").html("Seleccione");        
      }else{
        $("#firstOptionProyectos").html("Seleccione proyecto");                
      }
      
      if(vlocAnchoPantalla < 790){
        $("#inputSubCategoria").attr('placeholder', 'Subcategoría');
        $("#inputCategoria").attr('placeholder', 'Categoría');
      }else{
        $("#inputSubCategoria").attr('placeholder', 'Subcategoría del proyecto');
        $("#inputCategoria").attr('placeholder', 'Categoría del proyecto');
      }

      if(vlocAnchoPantalla < 500){        
        $(".inputIntegrantes").eq(0).val("Nombres");
        $(".inputIntegrantes").eq(1).val("Carnet");
        $(".inputIntegrantes").eq(2).val("Nombres");
        $(".inputIntegrantes").eq(3).val("Carnet");
        $(".inputIntegrantes").eq(4).val("Nombres");
        $(".inputIntegrantes").eq(5).val("Carnet");        
        
      }else{
        $(".inputIntegrantes").eq(0).val("Nombre integrante");
        $(".inputIntegrantes").eq(1).val("Carnet integrante");
        $(".inputIntegrantes").eq(2).val("Nombre integrante");
        $(".inputIntegrantes").eq(3).val("Carnet integrante");
        $(".inputIntegrantes").eq(4).val("Nombre integrante");
        $(".inputIntegrantes").eq(5).val("Carnet integrante");
      }

      if(vlocAnchoPantalla < 295){
        $("#inputNombreProyecto").attr("placeholder", "Proyecto");
      }else{
        $("#inputNombreProyecto").attr("placeholder", "Nombre del proyecto");
      }
    }    
  //FIN FUNCIONALIDAD
});