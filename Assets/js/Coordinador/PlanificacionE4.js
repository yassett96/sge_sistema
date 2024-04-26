$(document).ready(function () {

    $("#TConferencia tbody").on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected')
        }
        else {
            $("#TConferencia tr.selected").removeClass('selected');
            $(this).addClass('selected');
        }
    });

    /************************************************/
    $("#btnEditaConfE").click(function () { //Editar comisión Evento

        event.preventDefault();

        var filasel = $(".selected");
        var IdCEA = $(filasel).closest('tr').find("input:hidden").val();



        if (typeof IdCEA === "undefined") {
            Swal.fire(
                'Advertencia',
                'Debe seleccionar una conferencia para editar',
                'warning'
            )
            die();

        }
 
        console.log(IdCEA);


        //ComisionE = $("#ComisionE").val();

        $.ajax({

            url: "../../Vista/Coordinador/Pop_DetConferenciaCEAEdit.php",
            type: "POST",
            data: { idconfe: IdCEA },
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
                $('#Pop_ConferenciaEA').modal('show');
//                $("#nombre-funcion").text(nombreComisionEA);

                //$("#NombreComision").val(ComisionE);


            }
        });



    });


    /*function validarinput(input, mensaje, validacion) {
        if (validacion === 'NConferencia' && input.value.trim() === '') {
            Swal.fire(
                'Advertencia',
                'Favor ingresar el Nombre de la Conferencia',
                'warning'
            );

            input.focus();
            return null;

        }

        if (validacion === 'DatosConf') {
            if (input.value.trim() !== '') {
                if (!validarTexto(input.value)) {
                    Swal.fire(
                        'Advertencia',
                        mensaje,
                        'warning'
                    );

                    input.value = '';
                    return input;
                }
            }
        }

        if (validacion === 'SalonC' && input.value === 'Seleccione un salón') {
            Swal.fire(
                'Advertencia',
                mensaje,
                'warning'
            );
            input.value = '';
            return null;
        }

        if (validacion === 'HoraC_I' && input.value < FormConf.HoraC_IEvento.value) {
            Swal.fire(
                'Advertencia',
                'La hora de inicio no debe ser menor que la hora de inicio del evento',
                'warning'
            );

            input.focus();
            return null;
        }


        if (validacion === 'HoraC_F' && input.value < FormConf.HoraC_I.value) {
            Swal.fire(
                'Advertencia',
                'La hora de finalización no puede ser menor que la hora de inicio',
                'warning'
            );

            input.focus();
            return null;
        }





        return true;
    }

    function validarFormulario() {
        /*
        if (!validarinput(FormConf.NombreC, 'Solo se permiten caracteres alfanumericos, coma, guion, guion bajo, punto, comillas y espacio 1', 'NConferencia')) {
            return false;
        }

        if (!validarinput(FormConf.NombreCF, 'Solo se permiten caracteres alfanumericos, coma, guion, guion bajo, punto y espacio  2', 'DatosConf')) {
            return false;
        }

        if (!validarinput(FormConf.LugarCF, 'Solo se permiten caracteres alfanuméricos, coma, guion, guion bajo, punto y espacio 3', 'DatosConf')) {
            return false;
        }
        if (!validarinput(FormConf.SalonC, 'Debe seleccionar un salón', 'SalonC')) {
            return false;
        }

        if (!validarinput(FormConf.HoraC_I, 'La hora de inicio no debee ser menor que la hora inicio del evento', 'HoraC_I')) {
            return false;
        }
        if (!validarinput(FormConf.HoraC_F, 'La hora de finalización no puede ser menor que la hora de inicio', 'HoraC_F')) {
            return false;
        }

        return true;*/
    /*      var FormConf = document.ConferenciaFeriaE4;
  
          const campos = [
              { input: FormConf.NombreC, mensaje: 'Solo se permiten caracteres alfanumericos, coma, guion, guion bajo, punto, comillas y espacio 1', validacion: 'NConferencia' },
              { input: FormConf.NombreCF, mensaje: 'Solo se permiten caracteres alfanumericos, coma, guion, guion bajo, punto y espacio 2', validacion: 'DatosConf' },
              { input: FormConf.LugarCF, mensaje: 'Solo se permiten caracteres alfanuméricos, coma, guion, guion bajo, punto y espacio 3', validacion: 'DatosConf' },
              { input: FormConf.SalonC, mensaje: 'Debe seleccionar un salón', validacion: 'SalonC' },
              { input: FormConf.HoraC_I, mensaje: 'La hora de inicio no debee ser menor que la hora inicio del evento', validacion: 'HoraC_I' },
              { input: FormConf.HoraC_F, mensaje: 'La hora de finalización no puede ser menor que la hora de inicio', validacion: 'HoraC_F' }
          ];
  
          for (const campo of campos) {
              const errorField = validarinput(campo.input, campo.mensaje, campo.validacion);
              if (errorField === null) {
                  errorField.focus();
                  return false;
              }
              return true;
          }
          return true;
      }
  */

    /******************************************** */
    $("#btnGuardarE4").click(function () {
        event.preventDefault();

        var NomConferencia = $("#NombreC").val();
        var NomConferencista = $("#NombreCF").val();
        var LugarConferencista = $("#LugarCF").val();
        var IdSalon = $("#SalonC").val();
        var HoraConf_Inicio = $("#HoraC_I").val();
        var HoraConf_Fin = $("#HoraC_F").val();
        var valoroculto = $("#HoraC_IEvento").val();


        console.log(NomConferencia);
        console.log(NomConferencista);
        console.log(LugarConferencista);
        console.log("Id salon: " + IdSalon);
        console.log(HoraConf_Inicio);
        console.log(HoraConf_Fin);
        console.log("Prueba Hora evento: " + valoroculto);




        ///////



        /**/
        /*
                if (validarFormulario()) {
        
                    $.ajax({
                        url: "../../Controlador/Coordinador/CBuscar_HoraConferencias.php",
                        type: 'POST',
                        data: { H_IncioC: HoraConf_Inicio, H_FinalC: HoraConf_Fin, IdSalonCF: IdSalon },
                        cache: false,
                        success: function (result) {
        
                            if (result.length == 0) {
                                $.ajax({
                                    url: "../../Controlador/Coordinador/CAgregar_Conferencia.php",
                                    type: "POST",
                                    data: { NomConf: NomConferencia, NombreConfer: NomConferencista, DetConfer: LugarConferencista, HoraI: HoraConf_Inicio, HoraF: HoraConf_Fin, IdSalon: IdSalon },
                                    cache: false,
                                    success: function (result) {
                                        console.log(result);
                                        if (result.length == 1) {
        
                                            Swal.fire({
                                                customClass: {
                                                    confirmButton: 'swalBtnColor',
                                                },
                                                title: "Conferencia agregada correctamente",
                                                text: " ¿Desea agregar otra conferencia?",
                                                icon: 'success',
                                                showCancelButton: true,
                                                confirmButtonText: 'Si',
                                                cancelButtonText: 'No',
                                            })
                                                .then((result) => {
                                                    if (result.isConfirmed) {
                                                        window.location.href = "../../Vista/Coordinador/PlanificacionE4.php";
                                                    } else {
                                                        window.location.href = "../../Vista/Coordinador/Planificacion_Feria_CE.php";
                                                    }
                                                });
                                        }
                                        else {
                                            Swal.fire(
                                                'Error',
                                                'Ocurrio un problema, intenta nuevamente',
                                                'error'
                                            )
                                        }
                                    }
        
                                });
                            } else {
                                Swal.fire({
                                    title: "Atención!",
                                    text: result,
                                    icon: "warning",
                                });
                            }
                        }
        
                    });
        
                }*/


        //////
        //console.log(FormConf.NombreCF.value);
        //Validar nombre Conferencia***************************************/
        var FormConf = document.ConferenciaFeriaE4;


        if (FormConf.NombreC.value == "") {

            Swal.fire(
                'Advertencia',
                'Favor ingresar el Nombre de la Conferencia',
                'warning'
            )

            FormConf.NombreC.focus();
            return false;
        } else if (validarTexto(FormConf.NombreC.value) == false) {

            Swal.fire(
                'Advertencia',
                'Solo se permiten caracteres alfanumericos, coma, guion, guion bajo, punto, comillas y espacio 1',
                'warning'
            )

            FormConf.NombreC.value = "";
            FormConf.NombreC.focus();
            return false;
        }

        //Validar nombre Conferencista*******************************/

        /* if (FormConf.NombreCF.value == "") {
 
             Swal.fire(
                 'Advertencia',
                 'Favor ingresar el Nombre del conferencista',
                 'warning'
             )
 
             FormConf.NombreCF.focus();
             return false;
         } else*/
        if (!FormConf.NombreCF.value == "") {
            if (validarTexto(FormConf.NombreCF.value) == false) {
                Swal.fire(
                    'Advertencia',
                    'Solo se permiten caracteres alfanumericos, coma, guion, guion bajo, punto y espacio  2',
                    'warning'
                )

                FormConf.NombreCF.value = "";
                FormConf.NombreCF.focus();
                return false;
            }
        }


        //Validar detalles Conferencista**************************************/

        /*if (FormConf.LugarCF.value == "") {

        //     Swal.fire(
        //         'Advertencia',
        //         'Favor ingresar el detalle del conferencista',
        //         'warning'
        //     )

            FormConf.LugarCF.focus();
            return false;
        } else*/
        if (!FormConf.LugarCF.value == "") {
            if (validarTexto(FormConf.LugarCF.value) === false) {
                Swal.fire(
                    'Advertencia',
                    'Solo se permiten caracteres alfanuméricos, coma, guion, guion bajo, punto y espacio 3',
                    'warning'
                );

                FormConf.LugarCF.value = "";
                FormConf.LugarCF.focus();
                return false;
            }
        }
        //Validar Salon conferencia**************************************/

        if (FormConf.SalonC.value === "Seleccione un salón") {
            Swal.fire(
                'Advertencia',
                'Debe seleccionar un salón',
                'warning'
            )
            FormConf.SalonC.value = "Seleccione un salón";
            FormConf.SalonC.focus();
            return false;
        }

        /*if (FormConf.SalonC.value === "Seleccione un salón") {
            var IdSalon = "NULL";
        }*/

        //Validar  Hora Inicio Conferencia**********************************************/


        /*if (FormConf.HoraC_I.value == "") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar la hora de inicio de la conferencia',
                'warning'
            )

            FormConf.HoraC_I.focus();
            return false;
        }
        else*/

        if (!FormConf.HoraC_I.value == "") {
            if (FormConf.HoraC_I.value < FormConf.HoraC_IEvento.value) {  //Valida que inicial no sea menor que Hora de Inicio del evento

                Swal.fire(
                    'Advertencia',
                    'La hora de inicio no debee ser menor que la hora inicio del evento',
                    'warning'
                )

                FormConf.HoraC_I.focus();
                FormConf.HoraC_I.value = "";
                return false;
            }
        }


        //Validar la hora final de la conferencia

        /*if (FormConf.HoraC_F.value == "") {

            Swal.fire(
                'Advertencia',
                'Favor ingresar la hora de finalizacion de la conferencia',
                'warning'
            )

            FormConf.HoraC_F.focus();
            return false;
        }
        else*/
        if (FormConf.HoraC_F.value == "") {
            if (FormConf.HoraC_F.value < FormConf.HoraC_I.value) { //validar que hora final no sea menor a hora incial 
                Swal.fire(
                    'Advertencia',
                    'La hora de finalización no puede ser menor que la hora de inicio',
                    'warning'
                )
                FormConf.HoraC_F.focus();
                return false;
            }
        }


        $.ajax({
            url: "../../Controlador/Coordinador/CBuscar_HoraConferencias.php",
            type: 'POST',
            data: { H_IncioC: HoraConf_Inicio, H_FinalC: HoraConf_Fin, IdSalonCF: IdSalon },
            cache: false,
            success: function (result) {

                if (result.length == 0) {
                    $.ajax({
                        url: "../../Controlador/Coordinador/CAgregar_Conferencia.php",
                        type: "POST",
                        data: { NomConf: NomConferencia, NombreConfer: NomConferencista, DetConfer: LugarConferencista, HoraI: HoraConf_Inicio, HoraF: HoraConf_Fin, IdSalon: IdSalon },
                        cache: false,
                        success: function (result) {
                            console.log(result);
                            if (result.length == 1) {

                                Swal.fire({
                                    customClass: {
                                        confirmButton: 'swalBtnColor',
                                    },
                                    title: "Conferencia agregada correctamente",
                                    text: " ¿Desea agregar otra conferencia?",
                                    icon: 'success',
                                    showCancelButton: true,
                                    confirmButtonText: 'Si',
                                    cancelButtonText: 'No',
                                })
                                    .then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "../../Vista/Coordinador/PlanificacionE4.php";
                                        } else {
                                            window.location.href = "../../Vista/Coordinador/Planificacion_Feria_CE.php";
                                        }
                                    });
                            }
                            else {
                                Swal.fire(
                                    'Error',
                                    'Ocurrio un problema, intenta nuevamente',
                                    'error'
                                )
                            }
                        }

                    });
                } else {
                    Swal.fire({
                        title: "Atención!",
                        text: result,
                        icon: "warning",
                    });
                }
            }

        });



    });





});

$(document).on('click', '#btnCancelar', function (e) {

    event.preventDefault();

    Swal.fire({
        customClass: {
            confirmButton: 'swalBtnColor',
        },
        text: " ¿Desea realmente cancelar el resgistro?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
    })
        .then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../../Vista/Coordinador/Planificacion_Feria_CE.php";
            }
        });
});

$(document).on("click", "#BtnEliminarConFE", function () {  //Eliminar Comision del evento


    var fila = $(this).closest("tr");
    Swal.fire({
        title: "¿Estás seguro de que deseas eliminar la conferencia del evento actual?",
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            fila.addClass("selected");
            eliminarCE();
        } else {
            fila.removeClass("selected");
        }
    });
});
function eliminarCE() {
    var elem = $(".selected");
    if (elem.length > 0) {
        var filaCE = $(elem).closest('tr');
        var idConE = $(elem).closest('tr').find("input:hidden").val();

        $.ajax({
            url: "../../Controlador/Coordinador/CDelConferencias.php",
            type: "POST",
            data: { ID_Confe: idConE },
            cache: false,
            success: function (result) {
                console.log(result);
                if (result.length == 1) {
                    Swal.fire(
                        'Exito',
                        'Dato Eliminado correctamente',
                        'success'
                    );

                    elem.removeClass("selected");
                    filaCE.remove();
                    actualizarNumerosF();


                } else {
                    Swal.fire(
                        'Error',
                        'Ocurrio un problema, intenta nuevamente',
                        'error'
                    );
                }
            }
        });
    }
}

function validarTexto(parametro) {
    //var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\.\-_",]+$/;
    //var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.-_"“”,]+$/;
    //var patron = /[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.\ – _"“”,]+$/; con espacio guion espacion
    var patron = /[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.\- _"“”,]+$/;

    if (parametro.search(patron)) {
        return false;
    } else {
        return true;
    }

}
function validarletras(parametro) {
    //var patron = /^[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]*$/;
    var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\.\-_,]+$/;

    if (parametro.search(patron)) {
        return false;
    } else {
        return true;
    }



}

function actualizarNumerosF() {
    const celdasNumero = document.querySelectorAll('.ordenConE');



    if (celdasNumero.parentNode = 'ordenConE') {

        for (let i = 0; i < celdasNumero.length; i++) {
            celdasNumero[i].textContent = i + 1;
        }
    }




    const tablaCE = document.querySelector('#TConferencia tbody');
    const numFilasCE = tablaCE.rows.length;
    if (numFilasCE == 0) {
        tablaCE.innerHTML = '<tr><td colspan="5">No hay conferencias en el evento</td></tr>';
    }
}

$('#HoraC_I').on('input', function () {
    var valor = $('#HoraC_I').val().split(':');
    var horaSinSegundos = valor[0] + ':' + valor[1];
    $('#HoraC_I').val(horaSinSegundos);
});

$('#HoraC_F').on('input', function () {
    var valor = $('#HoraC_F').val().split(':');
    var horaSinSegundos = valor[0] + ':' + valor[1];
    $('#HoraC_F').val(horaSinSegundos);
});

/*function validarTexto(texto) {
    var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.\-_"“”,]+$/;
    return patron.test(texto);
  }*/


/*

$("#formulario").on("submit", function(event) {
event.preventDefault(); // Prevenir el envío del formulario por defecto

var fechaHoraInicioConf = $("#fecha_hora_inicio").val();
var fechaHoraFinConf = $("#fecha_hora_fin").val();
var horaInicio = $("#hora_inicio").val();
var horaFin = $("#hora_fin").val();

// Validar que ambos campos de fecha y hora estén completos
if (!fechaHoraInicioConf || !fechaHoraFinConf || !horaInicio || !horaFin) {
  Swal.fire(
    "Advertencia",
    "Debe completar todos los campos de fecha y hora",
    "warning"
  );
  return false;
}

// Validar que la hora de inicio sea menor que la hora de fin
if (horaInicio >= horaFin) {
  Swal.fire(
    "Advertencia",
    "La hora de inicio debe ser menor que la hora de fin",
    "warning"
  );
  return false;
}

// Hacer la petición AJAX para verificar la disponibilidad del horario
$.ajax({
  url: "ruta_al_procedimiento_en_php",
  type: "POST",
  data: {
    fechaHoraInicioConf: fechaHoraInicioConf,
    fechaHoraFinConf: fechaHoraFinConf
  },
  success: function(response) {
    // El resultado del procedimiento se encuentra en la variable 'response'
    var numConflictos = parseInt(response);
    if (numConflictos > 0) {
      Swal.fire(
        "Advertencia",
        "El horario de la conferencia ya está asignado a otra conferencia",
        "warning"
      );
    } else {
      // Continuar con la programación de la conferencia
      // ...
    }
  },
  error: function(xhr, status, error) {
    // Manejo de errores en la petición AJAX
  }
});
});

*/ 