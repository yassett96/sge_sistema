$(document).ready(function () {


    /******************************************** */
    $("#btnGuardarPOP_CEA").click(function () {
        event.preventDefault();

        var NomConferencia = $("#NombreC").val();
        var NomConferencista = $("#NombreCF").val();
        var LugarConferencista = $("#LugarCF").val();
        var IdSalon = $("#SalonC").val();
        var HoraConf_Inicio = $("#HoraC_I").val();
        var HoraConf_Fin = $("#HoraC_F").val();
        var valoroculto = $("#HoraC_IEvento").val();
        var valorIDCEA = $("#ID_ConEA").val();


        console.log(NomConferencia);
        console.log(NomConferencista);
        console.log(LugarConferencista);
        console.log("Id salon: " + IdSalon);
        console.log(HoraConf_Inicio);
        console.log(HoraConf_Fin);
        console.log("Prueba Hora evento: " + valoroculto);
        console.log("ID Conferencia evento: " + valorIDCEA);




        //Validar nombre Conferencia***************************************/
        var FormConf = document.MConFE;


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



        //Validar  Hora Inicio Conferencia**********************************************/




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
            url: "../../Controlador/Coordinador/CBuscar_HoraConferenciasUPDATE.php",
            type: 'POST',
            data: { H_IncioC: HoraConf_Inicio, H_FinalC: HoraConf_Fin, IdSalonCF: IdSalon, ID_ConEA: valorIDCEA },
            cache: false,
            success: function (result) {

                if (result.length == 0) {
                    $.ajax({
                        url: "../../Controlador/Coordinador/CUpdConferencia.php",
                        type: "POST",
                        data: { ID_ConEA: valorIDCEA, NomConf: NomConferencia, NombreConfer: NomConferencista, DetConfer: LugarConferencista, HoraI: HoraConf_Inicio, HoraF: HoraConf_Fin, IdSalon: IdSalon },
                        cache: false,
                        success: function (result) {
                            console.log(result);
                            if (result.length == 1) {

                                Swal.fire(
                                    'Exito',
                                    'Conferencia Actualizada correctamente',
                                    'success'
                                )
                                
                            }
                            else {
                                Swal.fire(
                                    'Error',
                                    'Ocurrio un problema, intenta nuevamente',
                                    'error'
                                )
                            }
                            location.reload();
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
    

    $(document).on('click', '#btnCerrarPOP_CEA', function() {
    $('#Pop_ConferenciaEA').modal('hide');
    $('#TConferencia tbody tr').removeClass('selected');

     location.reload();
    });

    
    $(document).on('click', '#Closedes', function() {
        $('#Pop_ConferenciaEA').modal('hide');
        $('#TConferencia tbody tr').removeClass('selected');
        
    });

});
    
