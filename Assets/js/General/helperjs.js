
/**
 * Para mover la página en la posición inicial
 */
function funMoverVistaArriba(){
    document.scrollingElement.scrollTop = 0;
}

/**
 * Muestra una alerta con Swal
 * @param {String} $vparStrIcon Icono a presentar (success, info, error, warning)
 * @param {String} $vparStrTitle Texto del título en el cuadro
 * @param {String} $vparStrText Texto abajo del título
 */
function funActivarAlerta($vparStrIcon, $vparStrTitle, $vparStrText){
    Swal.fire({
        icon: $vparStrIcon,
        title: $vparStrTitle,
        text: $vparStrText
    })
}

/** NO SE USA, SE PUEDE MODIFICAR PARA QUE HAGA UNA 
 * ACCIÓN GENÉRICA DESPUÉS QUE ACEPTE, PERO DE MOMENTO 
 * NO SE HA ENCONTRADO. SE DEJA INDICADA NADA MÁS
 * 
 * Alerta con SWAL (SweetAlert) de confirmación.
 * @param {String} vparStrTitle Título del cuadro de diálogo de confirmación
 * @param {String} vparStrText Texto del cuadro abajo del título
 * @param {String} vparStrIcon Icono a presentar (succes, info, error, warning)
 * @param {Boolean} vparBlnShowCancelButton Condicion para mostrar el botón de cancelar
 * @param {String} vparStrConfirmButtonText Texto del botón de confirmación
 * @param {String} vparStrTitleConfirmed Título del cuadro después de confirmar
 * @param {String} vparStrTextConfirmed Texto del cuadro después de confirmar
 * @param {String} vparStrIconConfirmed Icono que se muestra en el cuadro después de confirmar
 * @returns {Boolean} Confirmación
 */
function FunActivarAlertaConfirmacion(vparStrTitle, vparStrText, vparStrIcon, vparBlnShowCancelButton, vparStrConfirmButtonText, 
                                        vparStrTitleConfirmed, vparStrTextConfirmed,vparStrIconConfirmed){
    Swal.fire({
        title: vparStrTitle,
        text: vparStrText,
        icon: vparStrIcon,
        showCancelButton: vparBlnShowCancelButton,
        confirmButtonColor: Cnt_Color_Boton_Confirmacion,
        cancelButtonColor: Cnt_Color_Boton_Cancelacion,
        confirmButtonText: vparStrConfirmButtonText
    }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            vparStrTitleConfirmed,
            vparStrTextConfirmed,
            vparStrIconConfirmed
          )          
            return true;
        }else
            return false;        
    })    
}

/**
 * Activa una alerta con un botón de confirmación
 * @param {String} vparStrTitle Título del cuadro de diálogo de confirmación
 * @param {String} vparStrText Texto del cuadro abajo del título
 * @param {String} vparStrIcon Icono a presentar (succes, info, error, warning)
 * @param {Boolean} vparBlnShowCancelButton Condicion para mostrar el botón de cancelar
 * @param {String} vparStrConfirmButtonText Texto del botón de confirmación
 * @returns {Boolean} Confirmación, 'True'
 */
function FunActivarAlertaBotonConfirmacion(vparStrTitle, vparStrText, vparStrIcon, vparBlnShowCancelButton, vparStrConfirmButtonText, vparStrCodigoAEjecutar){

    // El Promise es para espera de una respuesta por parte del usuario
    return new Promise((resolve, reject) => {
        Swal.fire({
            title: vparStrTitle,
            text: vparStrText,
            icon: vparStrIcon,
            showCancelButton: vparBlnShowCancelButton,
            confirmButtonColor: Cnt_Color_Boton_Confirmacion,
            cancelButtonColor: Cnt_Color_Boton_Cancelacion,
            confirmButtonText: vparStrConfirmButtonText,
            cancelButtonText: ""
        }).then((result) => {
            if (result.isConfirmed) {
                eval(vparStrCodigoAEjecutar)
            } 
            // else {
            //     resolve(false);
            // }
        }).catch((error) => {
            reject(error); // En caso de que ocurra algún error al mostrar el cuadro de diálogo
        });
    });
        
}

/**
 * Activa una alerta con un botón de confirmación
 * @param {String} vparStrTitle Título del cuadro de diálogo de confirmación
 * @param {String} vparStrText Texto del cuadro abajo del título
 * @param {String} vparStrIcon Icono a presentar (succes, info, error, warning)
 * @param {Boolean} vparBlnShowCancelButton Condicion para mostrar el botón de cancelar
 * @param {String} vparStrConfirmButtonText Texto del botón de confirmación
 * @returns {Boolean} Confirmación, 'True'
 */
async function FunActivarAlertaBotonConfirmacionYCancelacion(vparStrTitle, vparStrText, vparStrIcon, vparBlnShowCancelButton, vparStrConfirmButtonText, vparStrCancelButtonText){

    // El Promise es para espera de una respuesta por parte del usuario
    return new Promise((resolve, reject) => {
        Swal.fire({
            title: vparStrTitle,
            text: vparStrText,
            icon: vparStrIcon,
            showCancelButton: vparBlnShowCancelButton,
            confirmButtonColor: Cnt_Color_Boton_Confirmacion,
            cancelButtonColor: Cnt_Color_Boton_Cancelacion,
            confirmButtonText: vparStrConfirmButtonText,
            cancelButtonText: vparStrCancelButtonText
        }).then((result) => {
            if (result.isConfirmed) {
                resolve(true);
            }
            else {
                resolve(false);
            }
        }).catch((error) => {
            reject(error); // En caso de que ocurra algún error al mostrar el cuadro de diálogo
        });
    });
}

/**
 * Ejecuta un ajax pasando el link a ejecutar con los valores de los parámetros
 * @param {String} vparStrPathAEjecutar link a ejecutar
 * @returns {String} resultado de la ejecución a php
 */
function FunEjecutarAjax(vparStrPathAEjecutar){    
    var vlocResultadoAjax;
    var vlocAjax = $.ajax({
        url: vparStrPathAEjecutar,
        async: false,
        success: function (data){}
    });

    vlocResultadoAjax = vlocAjax.responseText;    
    return vlocResultadoAjax;
}

/**
 * Para cargar una página según la url
 * @param {String} vparStrUrl Dirección donde se encuentra la página que se quiere cargar 
 */
function funMoverAPagina(vparStrUrl){
    window.location.href = vparStrUrl;
}

/**
 * Para obtener el ancho de la pantalla en pixeles
 * @returns Ancho de la pantalla en pixeles
 */
function FunObtenerAnchoPantalla(){
    return window.innerWidth;
}