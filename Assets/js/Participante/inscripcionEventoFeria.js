// const { CallSummariesInstance } = require("twilio/lib/rest/insights/v1/callSummaries");

//Obtenemos los objetos a los que se le hacen clic
const buttonNavForm = document.getElementsByClassName("liNavegacionInscripcionEvento");
const sectionDatosInscripcionFeria = document.getElementsByClassName("secDatosInscripcionFeria");
const vlocButtonInscribirParticipante = document.getElementById("inputBotonEnviar");
const selectCategoriaSeleccionada = document.getElementById("selectCategoria");
const optionCategoriaSeleccionada = document.getElementsByClassName("optionCategoria");
const selecSubCategoria = document.getElementById("selectSubCategoria");
const optionTextInputSeleccionarCategoria = document.getElementById("optionPrimerSelecCategoria");
const optionTextoInputSeleccionarSubCategoria = document.getElementById("optionPrimerSelecSubCategoria");
const optionTextoInputSeleccionarTutor = document.getElementById("optionPrimerSelecTutor");
const formDatosProyectos = document.getElementById("idFormDatosProyectos");
const btnListaCargarParticipante = document.getElementsByClassName("buttonCargarParticipante");
const btnCargarParticipante1 = document.getElementById("cargarparticipante1");
const textAreaCodigoRegistro = document.getElementsByClassName("inputCodigoParticipante");
const btnAceptarCancelarEnvioMensaje = document.getElementsByClassName("buttonConfirmacionParticipante");
const inputCodigoConfirmacion = document.getElementById("inputIngresarCodigo");
const btnConfirmarCodigoEnviado = document.getElementById("buttonConfirmarParticipante");
const butCancelarInscripción = document.getElementById("butCancelarInscripción");
const btnAtras = document.getElementById("h4Atras");
const inputNombreProyecto = document.getElementById("inputNombreProyecto");
const inputBotonInscribirOtroParticipante = document.getElementById("inputBotonFinalizarInscripcion");
const inputBotonInscribirOtroParticipante2 = document.getElementById("inputBotonFinalizarInscripcion2");
const btnLimpiarCamposIntegrante2 = document.getElementById("inputBotonLimpiarCampos1");
const btnLimpiarCamposIntegrante3 = document.getElementById("inputBotonLimpiarCampos2");

var vlocPMessage = document.getElementById("pIdMessage");
var vgDatosParticipanteAInscribir = '';
let vgDatosParticipanteInscribiendo = '';
let vgDatosCamposFormulariosParticipante = '';
let vlocTelParticipante = "";
let vlocNomApeParticipante = "";

//Variables para exportar
let vExportTelParticipante = "";
let vExportNomApeParticipante = "";
let vBoolExportActivarTwilio = false;

//Variables para ir registrando los participantes que se están inscribiendo
let vgIdParticipante1 = "";
let vgIdParticipante2 = "";
let vgIdParticipante3 = "";

//Variables para guardar los id
let vgIdSedeParticipante = '';

//Varibales para utilizar
let vgStrCodigo = "";
let vgIdPersonaInscribiendo = "";
let vgIdPersonaAInscribir = "";

//Botones de "Inscribir otro participante" y "Finalizar inscripción", de los formualrios
const btnBotonesFinalesFormularioParticipante1 = document.getElementsByClassName("inputBotonInscribirParticipante1");
const btnBotonesFinalesFormularioParticipante2 = document.getElementsByClassName("inputBotonInscribirParticipante2");
const btnBotonesFinalesFormularioParticipante3 = document.getElementsByClassName("inputBotonInscribirParticipante3");

//Control de los elementos a ocultar
const divPopUpConfirmacionUsuario = document.getElementById("divPopUpConfirmacionUsuario");
const sectionPopUpConfirmacionUsuario = document.getElementById("sectionPopUpConfirmacionUsuario");
const sectionIngresoCodigo = document.getElementById("sectionIngresoCodigo");

//Valores de los campos a validar del formulario de datos del Proyecto
var vlocNombreProyecto = document.getElementById("inputNombreProyecto").value;
var vlocDescripcionProyecto = document.getElementById("inputDescripcionProyecto").value;
var vlocCategoria = document.getElementById("selectCategoria").value;
var vlocSubCategoria = document.getElementById("selectSubCategoria").value;
var vlocTutor = document.getElementById("selectTutor").value;
var vlocRequerimientoProyecto = document.getElementById("inputRequerimientoProyecto").value;

//Valores de los campos del formulario 2
var vlocValoresInputsFormulario2 = document.getElementsByClassName("inputDatosParticipante2");

//Obteniendo el control de los campos que están en los formularios de los participantes
var vlocCamposFormularioParticipante1 = document.getElementsByClassName("inputDatosParticipante1");
var vlocCamposFormularioParticipante2 = document.getElementsByClassName("inputDatosParticipante2");
var vlocCamposFormularioParticipante3 = document.getElementsByClassName("inputDatosParticipante3");
var vlocIntCodigoRegistroParticipante = document.getElementsByClassName('inputCodigoParticipante');

////////////////////////////////////////////////////////////////////////////////////////////////////
// Para responsive y quitar el autocompletado de la etiqueta <input>
 var vlocMediaQueryMax = window.matchMedia("(min-width: 1023px)");

 if(vlocMediaQueryMax.matches){
    document.getElementById("inputNombreProyecto").setAttribute("autocomplete", "off");
 }else{
    document.getElementById("inputNombreProyecto").setAttribute("autocomplete", "on");
 }
 
 function funManejadorMediaQuery(vparEventoMediaQuery){
    if(vparEventoMediaQuery.matches){        
        document.getElementById("inputNombreProyecto").setAttribute("autocomplete", "off");        
    }else{        
        document.getElementById("inputNombreProyecto").setAttribute("autocomplete", "on");        
    }        
 }

    // Asociamos el manejador al evento
    vlocMediaQueryMax.addListener(funManejadorMediaQuery);   
    
// Para responsive y cambiar el texto del título del sleect para las sub-categorias

function CambiarTextoSegunAnchoPantalla(){ 
    const vlocAnchoPantalla = FunObtenerAnchoPantalla();   
    // console.log("Ancho de la pantalla: " + vlocAnchoPantalla);
    if (vlocAnchoPantalla < 527){
        optionTextoInputSeleccionarSubCategoria.textContent = "Subcategoría";        
    }else{
        optionTextoInputSeleccionarSubCategoria.textContent = "Seleccione la subcategoría";        
    }

    if(vlocAnchoPantalla < 527){
        if(vlocAnchoPantalla < 311)
            inputNombreProyecto.placeholder = "Nombre";
        else
            inputNombreProyecto.placeholder = "Nombre del proyecto";
    }else{
        inputNombreProyecto.placeholder = "Digite el nombre del proyecto";
    }

    if(vlocAnchoPantalla < 527){
        optionTextInputSeleccionarCategoria.textContent = "Categoría";
    }else{
        optionTextInputSeleccionarCategoria.textContent = "Seleccione la categoría";
    }

    if(vlocAnchoPantalla < 502){
        inputBotonInscribirOtroParticipante.value = "Otro Participante";
        inputBotonInscribirOtroParticipante2.value = "Otro Participante";
    }else{
        inputBotonInscribirOtroParticipante.value = "Inscribir otro participante";
        inputBotonInscribirOtroParticipante2.value = "Inscribir otro participante";
    }

    if(vlocAnchoPantalla < 311){
        optionTextoInputSeleccionarTutor.textContent = "Tutor";
    }else{
        optionTextoInputSeleccionarTutor.textContent = "Seleccione el tutor";
    }
}

CambiarTextoSegunAnchoPantalla();

window.addEventListener("resize", CambiarTextoSegunAnchoPantalla);

////////////////////////////////////////////////////////////////////////////////////////////////////

// Acción al dar clic al botón de 'Limpiar campos' del integrante 2
btnLimpiarCamposIntegrante2.addEventListener("click", (e) => {
    e.preventDefault();

    FunLimpiarCamposFormulario(".inputDatosParticipante2", "InputCodRegistroPar2");
});

// Acción al dar clic al botón de 'Limpiar campos' del integrante 3
btnLimpiarCamposIntegrante3.addEventListener("click", (e) => {
    e.preventDefault();

    FunLimpiarCamposFormulario(".inputDatosParticipante3", "InputCodRegistroPar3");
});

function FunLimpiarCamposFormulario(vparClaseInputs, vlocIdInputCodRegistro){
    var vlocInputs = document.querySelectorAll(vparClaseInputs);
    var vlocInputCodRegistro = document.getElementById(vlocIdInputCodRegistro);

    vlocInputs.forEach(function(input){
        input.value = '';
    });

    vlocInputCodRegistro.value = '';    
}

btnBotonesFinalesFormularioParticipante1[1].addEventListener("click", (e) => {     
    e.preventDefault();

    let vlocNoProyectosParticipante = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?vparCodRegParticipante=" + textAreaCodigoRegistro[0].value);    

    if(vlocNoProyectosParticipante < Cnt_No_Maximo_Proyectos_Inscritos){ 
        let vlocBoolVacioCamposFormularioParticipante2 = blnDatosFormularioParticipanteCompletado(vlocCamposFormularioParticipante2);
        let vlocBoolVacioCamposFormularioParticipante3 = blnDatosFormularioParticipanteCompletado(vlocCamposFormularioParticipante3);

        metInsercionGeneralProyectoParticipante(vlocNombreProyecto, vlocDescripcionProyecto, vlocCategoria, vlocSubCategoria, vlocTutor, vlocRequerimientoProyecto, vlocIntCodigoRegistroParticipante[0].value, 
        vlocIntCodigoRegistroParticipante[1].value, vlocIntCodigoRegistroParticipante[2].value, vlocCamposFormularioParticipante1, vlocCamposFormularioParticipante2,
        vlocCamposFormularioParticipante3, vlocBoolVacioCamposFormularioParticipante2, vlocBoolVacioCamposFormularioParticipante3);  
    }else{
        funActivarAlerta("warning", "Proyectos al límite!", "Has alcanzado el máximo de proyectos permitidos, ya no puedes inscribir otro proyecto, tienes " + vlocNoProyectosParticipante + " proyectos inscritos");
    }           
});

btnBotonesFinalesFormularioParticipante2[2].addEventListener("click", (e) => {    
    e.preventDefault();

    let vlocNoProyectosParticipante = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?vparCodRegParticipante=" + textAreaCodigoRegistro[0].value);    

    if(vlocNoProyectosParticipante < Cnt_No_Maximo_Proyectos_Inscritos){
        let vlocBoolVacioCamposFormularioParticipante2 = blnDatosFormularioParticipanteCompletado(vlocCamposFormularioParticipante2);
        let vlocBoolVacioCamposFormularioParticipante3 = blnDatosFormularioParticipanteCompletado(vlocCamposFormularioParticipante3);

        metInsercionGeneralProyectoParticipante(vlocNombreProyecto, vlocDescripcionProyecto, vlocCategoria, vlocSubCategoria, vlocTutor, vlocRequerimientoProyecto, vlocIntCodigoRegistroParticipante[0].value, 
            vlocIntCodigoRegistroParticipante[1].value, vlocIntCodigoRegistroParticipante[2].value, vlocCamposFormularioParticipante1, vlocCamposFormularioParticipante2,
            vlocCamposFormularioParticipante3, vlocBoolVacioCamposFormularioParticipante2, vlocBoolVacioCamposFormularioParticipante3);
    }else{
        funActivarAlerta("warning", "Proyectos al límite!", "Has alcanzado el máximo de proyectos permitidos, ya no puedes inscribir otro proyecto, tienes " + vlocNoProyectosParticipante + " proyectos inscritos");
    }   
});

btnBotonesFinalesFormularioParticipante3[1].addEventListener("click", (e) => {
    e.preventDefault();

    let vlocNoProyectosParticipante = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?vparCodRegParticipante=" + textAreaCodigoRegistro[0].value);    

    if(vlocNoProyectosParticipante < Cnt_No_Maximo_Proyectos_Inscritos){
        let vlocBoolVacioCamposFormularioParticipante2 = blnDatosFormularioParticipanteCompletado(vlocCamposFormularioParticipante2);
        let vlocBoolVacioCamposFormularioParticipante3 = blnDatosFormularioParticipanteCompletado(vlocCamposFormularioParticipante3);    

        metInsercionGeneralProyectoParticipante(vlocNombreProyecto, vlocDescripcionProyecto, vlocCategoria, vlocSubCategoria, vlocTutor, vlocRequerimientoProyecto, vlocIntCodigoRegistroParticipante[0].value, 
            vlocIntCodigoRegistroParticipante[1].value, vlocIntCodigoRegistroParticipante[2].value, vlocCamposFormularioParticipante1, vlocCamposFormularioParticipante2,
            vlocCamposFormularioParticipante3, vlocBoolVacioCamposFormularioParticipante2, vlocBoolVacioCamposFormularioParticipante3, vlocBoolVacioCamposFormularioParticipante2, vlocBoolVacioCamposFormularioParticipante3); 
    }else{
        funActivarAlerta("warning", "Proyectos al límite!", "Has alcanzado el máximo de proyectos permitidos, ya no puedes inscribir otro proyecto, tienes " + vlocNoProyectosParticipante + " proyectos inscritos");
    } 
});

/**
 * Función general para hacer la inserción.
 * @vparNombreProyecto {string}, Cadena de texto del nombre del proyecto
 * @vparDescripcionProyecto {string}, Cadena de texto de la descripción del proyecto
 * @vparCategoria {string}, Cadena de texto de la categoría
 * @vparSubCategoria {int}, Entero de la sub categorí seleccionada
 * @vparTutor {string}, Cadena de texto del tutor seleccionado
 * @vparIntCodigoRegistroParticipante1 {string}, Cadena de texto del codigo de registro del participante 1
 * @vparIntCodigoRegistroParticipante2 {string}, Cadena de texto del codigo de registro del participante 2
 * @vparIntCodigoRegistroParticipante3 {string}, Cadena de texto del codigo de registro del participante 3
 * @vparCamposFormularioParticipante1 {array}, arreglo de los campos del formulario del participante 1
 * @vparCamposFormularioParticipante2 {array}, arreglo de los campos del formulario del participante 2
 * @vparCamposFormularioParticipante3 {array}, arreglo de los campos del formulario del participante 3
 */
function metInsercionGeneralProyectoParticipante(vparNombreProyecto="", vparDescripcionProyecto="", vparCategoria="", vparSubCategoria=0, vparTutor="", vparRequerimientoProyecto="",
    vparIntCodigoRegistroParticipante1="", vparIntCodigoRegistroParticipante2="", vparIntCodigoRegistroParticipante3="", vparCamposFormularioParticipante1=[], 
    vparCamposFormularioParticipante2=[], vparCamposFormularioParticipante3=[], vparVacioCamposFormularioParticipante2, vparVacioCamposFormularioParticipante3){
    $.ajax({
        url: "../../Controlador/Participante/CInscripcionEventoFeria.php?nombre_proyecto=" + vparNombreProyecto + "&descripcion=" + vparDescripcionProyecto +
        "&categoria=" + vparCategoria + "&sub_categoria=" + vparSubCategoria + "&tutor=" + vparTutor + "&requerimiento=" + vparRequerimientoProyecto + "&inputCodigoRegistroParticipante1=" + vparIntCodigoRegistroParticipante1 +
        "&inputCodigoRegistroParticipante2=" + vparIntCodigoRegistroParticipante2 + "&inputCodigoRegistroParticipante3=" + vparIntCodigoRegistroParticipante3 + 
        "&inputGrupoParticipante1=" + vparCamposFormularioParticipante1[4].value + "&inputGrupoParticipante2=" + vparCamposFormularioParticipante2[4].value 
        + "&inputGrupoParticipante3=" + vparCamposFormularioParticipante3[4].value + "&vacioCamposFormularioParticipante2=" + vparVacioCamposFormularioParticipante2
        +"&vacioCamposFormularioParticipante3=" + vparVacioCamposFormularioParticipante3,
        success: function(data){
            console.log(data);
            // alert(data);
            funActivarAlerta("success", "Éxito!", "Se ha registrado el proyecto con los participantes correctamente !!! ... Serás dirigido a la página inicial.");
            setTimeout(() => {
                funMoverAPagina("../../Vista/Participante/InicioParticipanteConEvento.php");
            }, 3000)
            
            console.log(data);
        }
    }); 
}

// Para evitar que se rediriga cuando se presiona 'Enter' en el input
inputNombreProyecto.addEventListener('keypress', function(event){
    if (event.key === 'Enter'){
        event.preventDefault();
    }
});

buttonNavForm[0].addEventListener("click", e => {

    botonDatosProyectoBlanco();
    botonDatosParticipante1Azul();
    botonDatosParticipante2Azul();
    botonDatosParticipante3Azul();

    seccionElegido(0);
});

buttonNavForm[1].addEventListener("click", () => {
    obtenerValoresCamposInscripcionProyecto();    
    
    if(blnDatosProyectoCompletado()){
    // let $vlocBoolTemporal = true;
    // if($vlocBoolTemporal){ // TEMPORAL, ES PARA NO ATRASAR LA PRUEBA
        botonDatosProyectoAzul();
        botonDatosParticipante1Blanco();
        botonDatosParticipante2Azul();
        botonDatosParticipante3Azul();

        seccionElegido(1);

        FunObtenerInfoParticipanteInscribiendoYRellenarFormulario();
                
    }else{
        funActivarAlerta("error","Falta de datos del proyecto", "Complete los datos del proyecto");
    }    
});

buttonNavForm[2].addEventListener("click", () => {
    obtenerValoresCamposInscripcionProyecto();

    if(blnDatosProyectoCompletado()){
    // $vlocBoolTemporal = true;
    // if($vlocBoolTemporal){ // TEMPORAL, ES PARA NO ATRASAR LA PRUEBA
        botonDatosProyectoAzul();
        botonDatosParticipante1Azul();
        botonDatosParticipante2Blanco();
        botonDatosParticipante3Azul();

        seccionElegido(2);                 
    }else{
        funActivarAlerta("error","Falta de datos del proyecto", "Complete los datos del proyecto");
    }
});

buttonNavForm[3].addEventListener("click", () => {
    obtenerValoresCamposInscripcionProyecto();

    if(blnDatosProyectoCompletado()){
        if(blnDatosParticipanteFormulario2Completado()){
        // $vlocBoolTemporal = true;
        // if($vlocBoolTemporal){ // TEMPORAL, ES PARA NO ATRASAR LA PRUEBA
        botonDatosProyectoAzul();
        botonDatosParticipante1Azul();
        botonDatosParticipante2Azul();
        botonDatosParticipante3Blanco();

        seccionElegido(3);                

        // FunObtenerEImprimirDatosParticipanteInscribiendo();
        }else{
            funActivarAlerta("error","Falta rellenar el formulario del participante 2", "Complete los datos del participante 2");    
        }
    
    }else{
        funActivarAlerta("error","Falta de datos del proyecto", "Complete los datos del proyecto");
    }
});

//Funciones si hacen clic en algunos de los botones finales de los formularios
btnBotonesFinalesFormularioParticipante1[0].addEventListener("click", (event) => {        
    event.preventDefault(); //Para que no se active el envío del formulario
    obtenerValoresCamposInscripcionProyecto();

    if(blnDatosProyectoCompletado()){
    // $vlocBoolTemporal = true;    
    // if($vlocBoolTemporal){// TEMPORAL ES PARA NO ATRASAR LA PRUEBA
        botonDatosProyectoAzul();
        botonDatosParticipante1Azul();
        botonDatosParticipante2Blanco();
        botonDatosParticipante3Azul();

        seccionElegido(2);        
    }else{
        funActivarAlerta("error","Falta de datos del proyecto", "Complete los datos del proyecto");
    }

    funMoverVistaArriba();
    //document.scrollingElement.scrollTop = 0;
});

btnBotonesFinalesFormularioParticipante2[1].addEventListener("click", (event) => {
    event.preventDefault(); //Para que no se active el envío del formulario
    obtenerValoresCamposInscripcionProyecto();

    if(blnDatosProyectoCompletado()){
        if(blnDatosParticipanteFormulario2Completado()){
            botonDatosProyectoAzul();
            botonDatosParticipante1Azul();
            botonDatosParticipante2Azul();
            botonDatosParticipante3Blanco();

            seccionElegido(3);        
        }else{
            funActivarAlerta("error","Falta rellenar el formulario del participante 2", "Complete los datos del participante 2");    
        }    
        
    }else{
        funActivarAlerta("error","Falta de datos del proyecto", "Complete los datos del proyecto");
    }

    funMoverVistaArriba();
    //document.scrollingElement.scrollTop = 0;
});

//Agregar los valores a los campos deL participante 1 // Eliminar después, innecesario porque los datos de este formulario se cargan automáticamente, son del participante que está inscribiendo
btnListaCargarParticipante[0].addEventListener("click", (e) => {    
    let vlocVerificacionParticipante = 0; 
    
    // Para verificar que no se ha obtenido el id de la sede del participante que está inscribiendo y no repetir el proceso
    if (vgIdSedeParticipante == Cnt_Valor_Vacio)
        vgIdSedeParticipante = FunObtenerIdSedeParticipanteInscribiendo();

    vlocVerificacionParticipante = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?varCodigoRegistroVerifPart=" + textAreaCodigoRegistro[0].value + "&varIdCategoriaVerifPart=" + selectCategoriaSeleccionada.value + "&varIdSubCategoriaVerifPart=" + selecSubCategoria.value);    

    if(vlocVerificacionParticipante == Cnt_Acceso_Permitido){
        vgDatosCamposFormulariosParticipante = vlocCamposFormularioParticipante1;    
        funRellenarCamposGeneral(textAreaCodigoRegistro[0], vlocCamposFormularioParticipante1);      
    }else
        funActivarAlerta("warning", "Sin acceso!", "El participante que está intentando inscribir no puede participar en esta subcategoría");        
});

//Agregar los valores a los campos deL participante 2
btnListaCargarParticipante[1].addEventListener("click", (e) => {    
    let vlocVerificacionParticipante = 0;    
    let vlocNoProyectosParticipante = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?vparCodRegParticipante=" + textAreaCodigoRegistro[1].value);    

    if(vlocNoProyectosParticipante < Cnt_No_Maximo_Proyectos_Inscritos){    
        // Para verificar que no se ha obtenido el id de la sede del participante que está inscribiendo y no repetir el proceso
        if (vgIdSedeParticipante == Cnt_Valor_Vacio)
            vgIdSedeParticipante = FunObtenerIdSedeParticipanteInscribiendo();
        
        vlocVerificacionParticipante = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?varCodigoRegistroVerifPart=" + textAreaCodigoRegistro[1].value + "&varIdCategoriaVerifPart=" + selectCategoriaSeleccionada.value + "&varIdSubCategoriaVerifPart=" + selecSubCategoria.value);    
    
        if(vlocVerificacionParticipante == Cnt_Acceso_Permitido){
            vgDatosCamposFormulariosParticipante = vlocCamposFormularioParticipante2;
            funRellenarCamposGeneral(textAreaCodigoRegistro[1], vlocCamposFormularioParticipante2, 2);    
        }else
            funActivarAlerta("warning", "Sin acceso!", "El participante que está intentando inscribir no puede participar en esta subcategoría");
    }else{
        funActivarAlerta("warning", "Proyectos al límite!", "El participante que está intentando inscribir está inscrito al máximo de proyectos permitidos, tiene "+ vlocNoProyectosParticipante +" proyectos inscritos.");
    }
       
});

//Agregar los valores a los campos del participante 3
btnListaCargarParticipante[2].addEventListener("click", ()=>{    
    let vlocVerificacionParticipante = 0;
    let vlocNoProyectosParticipante = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?vparCodRegParticipante=" + textAreaCodigoRegistro[1].value);    

    if(vlocNoProyectosParticipante < Cnt_No_Maximo_Proyectos_Inscritos){ 
        // Para verificar que no se ha obtenido el id de la sede del participante que está inscribiendo y no repetir el proceso
        if (vgIdSedeParticipante == Cnt_Valor_Vacio)
            vgIdSedeParticipante = FunObtenerIdSedeParticipanteInscribiendo();

        vlocVerificacionParticipante = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?varCodigoRegistroVerifPart=" + textAreaCodigoRegistro[2].value + "&varIdCategoriaVerifPart=" + selectCategoriaSeleccionada.value + "&varIdSubCategoriaVerifPart=" + selecSubCategoria.value);

        if(vlocVerificacionParticipante == Cnt_Acceso_Permitido){
            vgDatosCamposFormulariosParticipante = vlocCamposFormularioParticipante3;
            funRellenarCamposGeneral(textAreaCodigoRegistro[2], vlocCamposFormularioParticipante3, 3);    
        }else
            funActivarAlerta("warning", "Sin acceso!", "El participante que está intentando inscribir no puede participar en esta subcategoría");        
    }else{
        funActivarAlerta("warning", "Proyectos al límite!", "El participante que está intentando inscribir está inscrito al máximo de proyectos permitidos, tiene "+ vlocNoProyectosParticipante +" proyectos inscritos.");
    }
});

//Evitar enviar formulario al presionar 'Enter' cuando se está escribiendo en un <input>
textAreaCodigoRegistro[1].addEventListener('keydown', function(event) {
    if (event.keyCode === 13){
        event.preventDefault();
    }
});

textAreaCodigoRegistro[2].addEventListener('keydown', function(event) {
    if (event.keyCode === 13){
        event.preventDefault();
    }
});

//Para cancelar la inscripción al evento feria
butCancelarInscripción.addEventListener("click", ()=>{        
    FunActivarAlertaConfirmacionCancelacionSuscripcion("¿Estás Seguro?", "Se perderán todos los datos ingresados en los formularios",
    "warning", true, "Sí, cancelar!", "No", "Cancelado!", "Redirigiendo a la página inicial", "success");            
})

//Para redirigir a la página anterior
btnAtras.addEventListener("click", ()=>{
    // history.back(); // Se elimina porque queda la información en caché y cuando se registra el tercer proyecto y se da 'Atrás' muestra habilitado el botón 'Inscripción a evento'
    window.location.href = '../../Vista/Participante/InicioParticipanteConEvento.php';
})

function FunActivarPopUpMensajeConfirmacion(vparStrTitle, vparStrText, vparStrIcon, vparBlnShowCancelButton){
    Swal.fire({
        title: vparStrTitle,
        text: vparStrText,
        icon: vparStrIcon,
        showCancelButton: vparBlnShowCancelButton,
        confirmButtonColor: Cnt_Color_Boton_Confirmacion,
        cancelButtonColor: Cnt_Color_Boton_Cancelacion,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar"
    }).then((result) => {

        if (result.isConfirmed) {
            // Para obtener el Id de la persona que está inscribiendo
            $.ajax({
                url: "../../Controlador/Participante/CInscripcionEventoFeria.php?blnObtenerIdPersonaInscribiendo=" + "1",
                success: function(data){               
                    vgIdPersonaInscribiendo = data;              
                    vgIdPersonaAInscribir = FunObtenerIdParticipanteAInscribir(vgDatosParticipanteAInscribir);
                    // Para verificar si el registro de la persona que está inscribiendo y el que se quiere inscribir ya existen            
                    $.ajax({
                        url: "../../Controlador/Participante/CInscripcionEventoFeria.php?varIdPersonaInscribiendoExis="+vgIdPersonaInscribiendo+"&varIdPersonaAInscribirExis="+vgIdPersonaAInscribir,
                        success: function(data){
                            var $vlocIntConfirmacionParticipante = data;

                            if($vlocIntConfirmacionParticipante != Cnt_Existe_Registro_Confirmacion_Participante){                        
                                funEnviarMensajeConfirmacion(textAreaCodigoRegistro[0].value);                                                               
                            }else{
                                funActivarAlerta("info", "En espera de confirmación!", "El código ya fue enviado, se espera para la confirmación de este participante!");    
                                setTimeout(function(){                                
                                    FunActivarPopUpIngresarCodigoConfirmacion("Código Confirmación", "Ingresar el código que fue enviado al participante a inscribir", "info", Cnt_Mostrar_Boton_Cancelar);
                                }, 2000);
                                // funActivarDesactivarSeccionIngresoCodigo();
                            }          
                        }
                    });                                    
                }
            });
        }
    });
}

function FunActivarPopUpIngresarCodigoConfirmacion(vparStrTitle, vparStrText, vparStrIcon, vparBlnShowCancelButton){
    
    Swal
    .fire({
        title: vparStrTitle,
        text: vparStrText,
        icon: vparStrIcon,
        showCancelButton: vparBlnShowCancelButton,
        confirmButtonColor: Cnt_Color_Boton_Confirmacion,
        cancelButtonColor: Cnt_Color_Boton_Cancelacion,
        confirmButtonText: "Aceptar",        
        cancelButtonText: "Cancelar",
        input: 'text',        
        // inputPlaceHolder: "Ingrese el código",
        inputValidator: codigo => {
            if (!codigo){
                return "Escribe el código";
            }
            else {
                return undefined;
            }
        }
    }).then(result => {
        //  alert("Entramos aquí result.isConfirmed: " + result.value);
         if(result.value){
            let $vlocIdParticipanteAInscribir = FunObtenerIdParticipanteAInscribir(vgDatosParticipanteAInscribir);                
            let codigo = result.value;
            const vlocStrInputCodigo = codigo;
            
            if (vlocStrInputCodigo != Cnt_Valor_Vacio){
                //Para verificar que no ha pasado el tiempo para confirmar el código
                $.ajax({
                    url:"../../Controlador/Participante/CInscripcionEventoFeria.php?varIdPersonaInscribiendoEli=" + vgIdPersonaInscribiendo + "&varIdPersonaAInscribirEli=" + $vlocIdParticipanteAInscribir,
                    success: function(data){
                        let vlocResultadoEliminacionPorTiempoExedido = data;
                        
                        if(vlocResultadoEliminacionPorTiempoExedido != Cnt_Tiempo_Exedido){

                            //Para verificar que el código es el correcto                            
                            $.ajax({
                                url:"../../Controlador/Participante/CInscripcionEventoFeria.php?varCodigoConfirmacionVerif=" + vlocStrInputCodigo + "&varIdPersonaInscribiendoVerif=" + vgIdPersonaInscribiendo + "&varIdPersonaAInscribirVerif=" + $vlocIdParticipanteAInscribir,
                                success:function(data){
                                    $vlocVerificacionCodigoConfirmacion = data;
                                    
                                    if($vlocVerificacionCodigoConfirmacion == Cnt_Codigo_Corecto){
                                        funActivarAlerta("success", "Participante aceptado!", "El participante a inscribir ha sido aceptado!");

                                        vgDatosParticipanteAInscribir = FunObtenerGrupoYSedeParticipante(vgDatosParticipanteAInscribir);

                                        funRellenarCamposFormularios(vgDatosCamposFormulariosParticipante, vgDatosParticipanteAInscribir);                                                        
                                        
                                        //Para eliminar el registro una vez que se ha verificado el código de confirmación
                                        $.ajax({
                                            url:"../../Controlador/Participante/CInscripcionEventoFeria.php?varIdPersonaInscribiendoEliVerif=" + vgIdPersonaInscribiendo + "&varIdPersonaAInscribirEliVerif=" + $vlocIdParticipanteAInscribir,
                                            success:function(data){                                                                       
                                            }
                                        });
                                    }else{
                                        funActivarAlerta("error","Incorrecto!", "El código que ingreso es incorrecto");        
                                        // inputCodigoConfirmacion.value = '';                             
                                    } 
                                }
                            });                
                        }else{
                            funActivarAlerta("error", "Se ha exedido el tiempo de espera del código anterior!", "Volver a enviar el código nuevamente!");        
                            // inputCodigoConfirmacion.value = "";                
                        }
                    }
                }); 
            }else{
                funActivarAlerta("error", "Valor del campo vacío!", "Ingrese el código en el campo para confirmar al participante!");
            }
         }        
    })
}

//Alerta de confirmación para cancelar la suscripción
function FunActivarAlertaConfirmacionCancelacionSuscripcion(vparStrTitle, vparStrText, vparStrIcon, vparBlnShowCancelButton, vparStrConfirmButtonText, vparStrCancelButtonText,
    vparStrTitleConfirmed, vparStrTextConfirmed,vparStrIconConfirmed){

    Swal.fire({
        title: vparStrTitle,
        text: vparStrText,
        icon: vparStrIcon,
        showCancelButton: vparBlnShowCancelButton,
        confirmButtonColor: Cnt_Color_Boton_Confirmacion,
        cancelButtonColor: Cnt_Color_Boton_Cancelacion,        
        confirmButtonText: vparStrConfirmButtonText,
        cancelButtonText: vparStrCancelButtonText,
    }).then((result) => {

    if (result.isConfirmed) {

        Swal.fire(
            vparStrTitleConfirmed,
            vparStrTextConfirmed,
            vparStrIconConfirmed
        )          
        setTimeout(() => {window.location.replace("../../Vista/Participante/InicioParticipanteConEvento.php");}, 2000);       
    }            
    })    
}

//Función para activar o desativar el PopUp de confirmación de usuario
function funActivarDesactivarPopupConfirmacion(){    

    if (sectionPopUpConfirmacionUsuario.style.visibility == "hidden" || sectionPopUpConfirmacionUsuario.style.visibility == ""){
        sectionPopUpConfirmacionUsuario.style.visibility = "visible";
        divPopUpConfirmacionUsuario.style.visibility = "visible";
    }else{
        sectionPopUpConfirmacionUsuario.style.visibility = "hidden";
        divPopUpConfirmacionUsuario.style.visibility = "hidden";
    }  
}

function funEnviarMensajeConfirmacion(){       
                                    
            vlocTelParticipante = FunObtenerTelefonoParticipanteDelResultado(vgDatosParticipanteAInscribir);
            vlocNomApeParticipante = FunObtenerNombreApellidoParticipanteInscribiendo(true);
            vgStrCodigo = FunGenerarCodigoAutomatico();                                  
            
            //Para enviar el mensaje al participante que se quiere inscribir
            $.ajax({
                url:"../../Vista/Participante/confirmacion/Confirmacion.php?vparTelParticipante=" + vlocTelParticipante + "&vparNomApeParticipante=" + vlocNomApeParticipante + "&vlocStrRegistro=" + vgStrCodigo,
                success: function (data){           
                    let vlocResultadoEnvioMensaje = data;                                                   
                    
                    if(vlocResultadoEnvioMensaje != Cnt_Valor_Vacio){
                        vgIdPersonaInscribiendo = vlocResultadoEnvioMensaje;                        
                        funActivarAlerta("success", "Envio de mensaje exitoso!","Se ha enviado el código con éxito!");                                                
                        
                        setTimeout(function(){
                            vgIdPersonaAInscribir = FunObtenerIdParticipanteAInscribir(vgDatosParticipanteAInscribir);                            
                            //Para registrar el envío del mensaje                        
                            $.ajax({                                
                                url:"../../Controlador/Participante/CInscripcionEventoFeria.php?varIdPersonaInscribiendo="+vgIdPersonaInscribiendo+"&varCodigoConfirmacion=" + vgStrCodigo+"&varIdPersonaAInscribir=" + vgIdPersonaAInscribir,
                                success: function(data){                                                                        
                                    if(data == Cnt_Registro_Envio_Mensaje_Exitoso){
                                        funActivarAlerta("success", "Ahora consulta a tu compañero!","Se ha registrado el código con éxito!");
                                        setTimeout(function(){
                                            FunActivarPopUpIngresarCodigoConfirmacion("Código Confirmación", "Ingresar el código que fue enviado al participante a inscribir", "info", Cnt_Mostrar_Boton_Cancelar);
                                        }, 2000);
                                    }else{
                                        funActivarAlerta("error", "Oops...!","Ha ocurrido un error al registrar el mensaje!");
                                    }                                
                                }
                            }); 
                        }, 2000);
                                                                       
                    }else
                        funActivarAlerta("error", "Oops...!","Ha ocurrido un error al enviar el mensaje al participante!");
                }
            });                                    
}

function FunObtenerTelefonoParticipanteDelResultado(vparContenidosRecibidosParticipante){    
    var vlocTelParticipante = vparContenidosRecibidosParticipante[8];
    return vlocTelParticipante;
}

function FunObtenerIdParticipanteAInscribir(vparDatosParticipanteAInscribir){
    var vlocIdParticipanteAInscribir = vparDatosParticipanteAInscribir[10];
    return vlocIdParticipanteAInscribir;
}

function FunObtenerNombreApellidoParticipanteInscribiendo(vparInicioInfoParticipante){
    var vlocInfoParticipante;
    var vlocAjax = $.ajax({
        url:"../../Controlador/Participante/CInscripcionEventoFeria.php?vlocInicioInfoParticipante=" + vparInicioInfoParticipante,
        async: false,
        success: function (data){                                               
        }
    });    
    vlocInfoParticipante = vlocAjax.responseText.split(",");    
    return vlocInfoParticipante;    
}

//Para obtener los datos del participante que está inscribiendo
function FunObtenerEImprimirDatosParticipanteInscribiendo(){
    vgDatosParticipanteInscribiendo = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?blnObtenerDatosParticipanteInscribiendo=" + Cnt_Ejecutar_Ajax);    
    var vlocDatosParticipanteInscribiendo = vgDatosParticipanteInscribiendo.split(",");
    funRellenarCamposFormularios(vlocCamposFormularioParticipante1, vlocDatosParticipanteInscribiendo);    
    textAreaCodigoRegistro[0].value = vlocDatosParticipanteInscribiendo[10];//Código Registro
    vgIdParticipante1 = vlocDatosParticipanteInscribiendo[5];// Carnet del participante inscribiendo
}

function FunObtenerCarnetParticipanteInscribiendo(){    
    var vlocCarnetParticipante;    
    var vlocAjax = $.ajax({
        url:"../../Controlador/Participante/CInscripcionEventoFeria.php?varObtenerCarnetParticipanteInscribiendo=" + Cnt_Obtener_Carnet,
        async: false,
        success: function (data){                                               
        }
    });        
    vlocCarnetParticipante = vlocAjax.responseText;    
    return vlocCarnetParticipante;    
}

//Para obtener el código de 6 dígitos
function FunGenerarCodigoAutomatico(){
    var vlocStrCodigoAutomatico = '';

    while(vlocStrCodigoAutomatico.length < 6){
    var vlocDigito1 = FunStrGenerarDigitoAleatorio0A10();
    var vlocDigito2 = FunStrGenerarDigitoAleatorio0A10();
    var vlocDigito3 = FunStrGenerarDigitoAleatorio0A10();
    var vlocDigito4 = FunStrGenerarDigitoAleatorio0A10();
    var vlocDigito5 = FunStrGenerarDigitoAleatorio0A10();
    var vlocDigito6 = FunStrGenerarDigitoAleatorio0A10();

    var vlocStrCodigoAutomatico = vlocDigito1 + vlocDigito2 + vlocDigito3 + vlocDigito4 + vlocDigito5 + vlocDigito6;
    }    
    
    return vlocStrCodigoAutomatico;
}

function FunStrGenerarDigitoAleatorio0A10(){
    var vlocIntNumeroAleatorio = Math.floor(Math.random() * 10);
    var vlocStrNumeroAleatorio = String(vlocIntNumeroAleatorio)
    return String(vlocStrNumeroAleatorio);
}

function funRellenarCamposGeneral(vparTextAreaCodigoRegistro, vparCamposFormularioParticipante, vparIntNumeroParticipante){            

    let vlocTexAreaValue = vparTextAreaCodigoRegistro.value;    
    
    if(vlocTexAreaValue != ''){    
        
        $.ajax({                        
            url: "../../Controlador/Participante/CInscripcionEventoFeria.php?varCodigoRegistro=" + vlocTexAreaValue,
            success: function(data){                
                vgDatosParticipanteAInscribir = data.split(',');                

                if( vgDatosParticipanteAInscribir != Cnt_Valor_Vacio && vparIntNumeroParticipante == 2 && vgDatosParticipanteAInscribir != Cnt_Valor_Nulo)
                    vgIdParticipante2 = vgDatosParticipanteAInscribir[Cnt_Numero_Carnet_Participante];//Número carnet del participante
                else if(vgDatosParticipanteAInscribir != '' && vparIntNumeroParticipante == 3 && vgDatosParticipanteAInscribir != Cnt_Valor_Nulo)
                    vgIdParticipante3 = vgDatosParticipanteAInscribir[Cnt_Numero_Carnet_Participante];//Número carnet del participante

                if(vgIdParticipante1 != vgIdParticipante2 && vgIdParticipante1 != vgIdParticipante3 && vgIdParticipante2 != vgIdParticipante3){
                    if(vgDatosParticipanteAInscribir.length >= Cnt_Contiene_Algun_Valor && vgDatosParticipanteAInscribir != Cnt_Valor_Vacio){                     
                        //Para verificar que son de la misma sede                        
                        if(vgIdSedeParticipante == vgDatosParticipanteAInscribir[Cnt_Id_Sede_Participante]){
                            
                            // Comentado, porque se quiso deshabilitar la funcionalidad de envío de mensaje al celular para aceptar al participante a agregar como integrante
                                // var vlocStrTitle = "Envío de código de confirmación!";
                                // var vlocStrMessage = "Se enviará un mensaje al número de teléfono "+vgDatosParticipanteAInscribir[Cnt_Telefono_Participante]+ ""
                                // +", del participante "+vgDatosParticipanteAInscribir[Cnt_Primer_Nombre_Participante]+" "+vgDatosParticipanteAInscribir[Cnt_Primer_Apellido_Participante]+", para confirmar la participación";

                                // FunActivarPopUpMensajeConfirmacion(vlocStrTitle, vlocStrMessage, "info", Cnt_Mostrar_Boton_Cancelar);        
                                // funActivarDesactivarPopupConfirmacion();
                            //

                            funActivarAlerta("success", "Participante aceptado!", "El participante a inscribir ha sido aceptado!");

                            vgDatosParticipanteAInscribir = FunObtenerGrupoYSedeParticipante(vgDatosParticipanteAInscribir);

                            funRellenarCamposFormularios(vgDatosCamposFormulariosParticipante, vgDatosParticipanteAInscribir);

                        }else{
                            funActivarAlerta("warning", "Error de inscripción!", "El participante que intenta inscribir no pertenece a la misma sede!");
                        }                        
                    }
                    else
                        funActivarAlerta("error", "Participante no encontrado", "El código que ingreso, no se encuentra registrado");
                }else
                    funActivarAlerta("warning", "Participante ingresado", "El participante que está intentado ingresar ya ha intentado registrar en uno de los formularios de esta página!, inscriba otro participante o vuelva a cargar lapágina para inscribir");                             
            }
        });        
    }else{
        funActivarAlerta("warning","Falta código participante", "Ingrese el código de registro del participante!");        
    }
}

function funRellenarCamposFormularios(vparCamposFormularioParticipante, vparContenidosRecibidos){    
    vparCamposFormularioParticipante[0].value = vparContenidosRecibidos[0].concat(" ").concat(vparContenidosRecibidos[1]); //Nombres
    vparCamposFormularioParticipante[1].value = vparContenidosRecibidos[2].concat(" ").concat(vparContenidosRecibidos[3]); //Apellidos

    if (vparContenidosRecibidos[4] == '' || vparContenidosRecibidos[4] == null){
        vparCamposFormularioParticipante[2].value = 'No tiene cédula'    
    }else{
        vparCamposFormularioParticipante[2].value = vparContenidosRecibidos[4]; //Cédula
    }    

    vparCamposFormularioParticipante[3].value = vparContenidosRecibidos[5]; //Carnet
    vparCamposFormularioParticipante[4].value = vparContenidosRecibidos[6]; //Grupo
    vparCamposFormularioParticipante[5].value = vparContenidosRecibidos[7]; //Sede
    vparCamposFormularioParticipante[6].value = vparContenidosRecibidos[8]; //Telefono
    vparCamposFormularioParticipante[7].value = vparContenidosRecibidos[9]; //Correo            
}

//Utiliza "ajax" para obtener las sub categorás según la categoría seleccionada
selectCategoriaSeleccionada.addEventListener("click", (e) => {    
    e.preventDefault();        
    let vlocSelectValorCategoriaSeleccionada = selectCategoriaSeleccionada.value;     
    let vlocNumeroCarnet = FunObtenerCarnetParticipanteInscribiendo();
    
        //Para obener sub categoria según la categoria y el participante
        $.ajax(
            {
                url: "../../Controlador/Participante/CInscripcionEventoFeria.php?varIdCategoria=" + vlocSelectValorCategoriaSeleccionada + "&varNumeroCarnet=" + vlocNumeroCarnet,                
                success: function(data){
                    if(data != ''){
                        // alert('Prueba Samir, ' + data);
                        console.log('Prueba Samir, ' + data);
                        selecSubCategoria.innerHTML = data;                    
                    }                                                                
                    
                }
            }
        )                                  
});

 //Activar el formulario del participante
vlocButtonInscribirParticipante.addEventListener("click", () =>{
    obtenerValoresCamposInscripcionProyecto();  

    if(blnDatosProyectoCompletado()){ 
    // $vlocBoolTemporal = true;
    // if($vlocBoolTemporal){//TEMPORAL ES PARA NO ATRASAR
        botonDatosProyectoAzul();
        botonDatosParticipante1Blanco();
        botonDatosParticipante2Azul();
        botonDatosParticipante3Azul();

        seccionElegido(1);

        FunObtenerInfoParticipanteInscribiendoYRellenarFormulario();

    }else{
        funActivarAlerta("error","Falta de datos del proyecto", "Complete los datos del proyecto!");                
    }

    funMoverVistaArriba();

});

//Para obtener información del participante que está inscribiendo y rellenar el formulario 2
function FunObtenerInfoParticipanteInscribiendoYRellenarFormulario(){
    vgDatosParticipanteInscribiendo = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?blnObtenerDatosParticipanteInscribiendo=" + Cnt_Ejecutar_Ajax);        
    
    var vlocDatosParticipanteInscribiendo = vgDatosParticipanteInscribiendo.split(",");
    vlocDatosParticipanteInscribiendo = FunObtenerGrupoYSedeParticipante(vlocDatosParticipanteInscribiendo);

    funRellenarCamposFormularios(vlocCamposFormularioParticipante1, vlocDatosParticipanteInscribiendo);        
    textAreaCodigoRegistro[0].value = vlocDatosParticipanteInscribiendo[Cnt_Codigo_Registro];//Código Registro
    vgIdParticipante1 = vlocDatosParticipanteInscribiendo[Cnt_Numero_Carnet_Participante];
}

//Para obtener el grupo y sede del participante que se está inscrbiendo
function FunObtenerGrupoYSedeParticipante(vparDatosParticipanteInscribiendo){
    var vlocGrupo = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?varIdGrupo="+vparDatosParticipanteInscribiendo[Cnt_Id_Grupo_Participante]);
    var vlocSede = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?varIdSede="+vparDatosParticipanteInscribiendo[Cnt_Id_Sede_Participante]);      
    vparDatosParticipanteInscribiendo[Cnt_Id_Grupo_Participante] = vlocGrupo;
    vparDatosParticipanteInscribiendo[Cnt_Id_Sede_Participante] = vlocSede;    

    return vparDatosParticipanteInscribiendo;
}

//Obtener los valores de los campos de inscripción del proyecto
function obtenerValoresCamposInscripcionProyecto(){
vlocNombreProyecto = document.getElementById("inputNombreProyecto").value;
vlocDescripcionProyecto = document.getElementById("inputDescripcionProyecto").value;
vlocCategoria = document.getElementById("selectCategoria").value;
vlocSubCategoria = document.getElementById("selectSubCategoria").value;
vlocTutor = document.getElementById("selectTutor").value;
vlocRequerimientoProyecto = document.getElementById("inputRequerimientoProyecto").value;
}

//Dice si los campos del formulario del proyecto no están vacíos
function blnDatosProyectoCompletado(){
    if(vlocNombreProyecto=="" || vlocDescripcionProyecto==""||
        vlocCategoria==""||vlocSubCategoria==""||vlocTutor==""){            
            return false;
    }else{
            return true;
    }
}

//Verifica si uno de los campos necesarios del formulario 2 están vacíos
function blnDatosParticipanteFormulario2Completado(){
    if(vlocValoresInputsFormulario2[Cnt_Valor_Input_Nombres].value=="" || vlocValoresInputsFormulario2[Cnt_Valor_Input_Carnet].value=="" 
        || vlocValoresInputsFormulario2[Cnt_Valor_Input_Sede].value=="")
            return false;
    else
            return true;
}

function blnDatosFormularioParticipanteCompletado(vparFormularioParticipante){
    vlocStrResultado = 1;

    if(vparFormularioParticipante[Cnt_Valor_Input_Nombres].value=="" || vparFormularioParticipante[Cnt_Valor_Input_Carnet].value=="" 
        || vparFormularioParticipante[Cnt_Valor_Input_Sede].value=="")
            vlocStrResultado = 0;

    return vlocStrResultado;
}

//Determina el formulario que es seleccionado
function seccionElegido($vparNumeroSeccionElegido){
    for(let j=0;j<sectionDatosInscripcionFeria.length;j++){        
        if($vparNumeroSeccionElegido==j){
            sectionDatosInscripcionFeria[j].style.visibility = "visible";
        }else{
            sectionDatosInscripcionFeria[j].style.visibility = "hidden";
        }
    }
}

//Obtener IdSede del participante inscribiendo
    function FunObtenerIdSedeParticipanteInscribiendo(){        
        var $vlocIdSedeParticipanteInscribiendo = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?varObtenerIdParticipanteInscribiendo=" + Cnt_Ejecutar_Ajax);
        return $vlocIdSedeParticipanteInscribiendo;
    }

//Funciones para dar estilo a los botones que muestran los diferentes formularios
    function botonDatosProyectoBlanco(){
        buttonNavForm[0].style.backgroundColor = 'white';
        buttonNavForm[0].style.color = '#102461';
        buttonNavForm[0].style.opacity = 1;
    }

    function botonDatosProyectoAzul(){
        buttonNavForm[0].style.backgroundColor = 'Transparent';
        buttonNavForm[0].style.color = "white";
        buttonNavForm[0].style.opacity = 1;
    }

    function botonDatosParticipante1Blanco(){
        buttonNavForm[1].style.backgroundColor = 'white';
        buttonNavForm[1].style.color = '#102461';
        buttonNavForm[1].style.opacity = 1;
    }

    function botonDatosParticipante1Azul(){
        buttonNavForm[1].style.backgroundColor = 'Transparent';
        buttonNavForm[1].style.color = "white";
        buttonNavForm[1].style.opacity = 1;
    }

    function botonDatosParticipante2Blanco(){
        buttonNavForm[2].style.backgroundColor = 'white';
        buttonNavForm[2].style.color = '#102461';
        buttonNavForm[2].style.opacity = 1;
    }

    function botonDatosParticipante2Azul(){
        buttonNavForm[2].style.backgroundColor = 'Transparent';
        buttonNavForm[2].style.color = "white";
        buttonNavForm[2].style.opacity = 1;
    }

    function botonDatosParticipante3Blanco(){
        buttonNavForm[3].style.backgroundColor = 'white';
        buttonNavForm[3].style.color = '#102461';
        buttonNavForm[3].style.opacity = 1;
    }

    function botonDatosParticipante3Azul(){
        buttonNavForm[3].style.backgroundColor = 'Transparent';
        buttonNavForm[3].style.color = "white";
        buttonNavForm[3].style.opacity = 1;
    }
//************************************************************************** */