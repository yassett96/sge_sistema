$(document).ready(function () {

    $("#btnADD_A_F").click(function () {

        event.preventDefault();

        var NuevoFormato = $("#NombreFormato").val();


        var formulario = document.ModalFormato;

        if (formulario.NombreFormato.value == "") {


            Swal.fire(
                'Advertencia',
                'Favor ingresar el Nombre del formato',
                'warning'
            )

            formulario.NombreFormato.focus();
            return false;
        } else if (validarletrasynum(formulario.NombreFormato.value) == false) {

            Swal.fire(
                'Advertencia',
                'Solo se permiten caracteres alfanumericos, coma, guion, guion bajo, punto y espacio ',
                'warning'
            )

            formulario.NombreFormato.value = "";
            formulario.NombreFormato.focus();
            return false;
        }


        $.ajax({
            url: "../../Controlador/Coordinador/CBuscarRegFormato.php",
            type: 'POST',
            data: { NFor: NuevoFormato },
            cache: false,
            success: function (result) {

                if (result.length == 0) {
                    $.ajax({
                        url: "../../Controlador/Coordinador/CAddFormato.php",
                        type: "POST",
                        data: { NFormato: NuevoFormato },
                        cache: false,
                        success: function (result) {
                            console.log(result);
                            if (result.length == 1) {
                                Swal.fire(
                                    'Exito',
                                    'Dato guardado correctamente',
                                    'success'
                                )

                                $.ajax({
                                    url: '../../Controlador/Coordinador/CActualizaSelectFormat.php',
                                    type: 'POST',
                                    data: { NFormato: NuevoFormato },
                                    cache: false,
                                    success: function (respuesta) {

                                        $("#FormatCriterio").html(respuesta);
                                    }
                                });
                                $("#Pop_A_F").modal('hide');

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

    $("#btnCancel_A_F").click(function () {
        $("#Pop_A_F").modal('hide');
    });

    
    $("#btnEd_For").click(function () {

        event.preventDefault();
        NFormatoE = $("#FormatCriterio").val();

        
        var UpdaFormat = $("#NFormatoEd").val();
        //console.log(UpdaComision);

        var formulario2 = document.MFormatoE;

        if (formulario2.NFormatoEd.value == "") {
            

            Swal.fire(
                'Advertencia',
                'Favor ingresar el Nombre de la Comisión',
                'warning'
            )

            formulario2.NFormatoEd.focus();
            return false;
        } else if (validarletrasynum(formulario2.NFormatoEd.value) == false) {
            
            Swal.fire(
                'Advertencia',
                'Solo se permiten caracteres alfanumericos, coma, guion, guion bajo, punto y espacio ',
                'warning'
            )

            formulario2.NFormatoEd.value = "";
            formulario2.NFormatoEd.focus();
            return false;
        }

        $.ajax({
            url: "../../Controlador/Coordinador/CBuscarRegFormato.php",
            type: 'POST',
            data: { NFor: UpdaFormat },
            cache: false,
            success: function (result) {

                if (result.length == 0) {
                $.ajax({
                    url: "../../Controlador/Coordinador/CUpdaFormato.php",
                    type: "POST",
                    data: { UpdaFormato: UpdaFormat, IdFormato: NFormatoE },
                    cache: false,
                    success: function (result) {
                        console.log(result);
                        if (result.length == 1) {
                            Swal.fire(
                                'Exito',
                                'Dato guardado correctamente',
                                'success'
                            )

                             $.ajax({
                                    url: '../../Controlador/Coordinador/CActualizarSelect_IdFormat.php',
                                    type: 'POST',
                                    data: { Id_Formato:  NFormatoE },
                                    cache: false,
                                    success: function (respuesta) {

                                        $("#FormatCriterio").html(respuesta);
                                    }
                                });
                            $("#Pop_E_For").modal('hide');
                            //location.reload();
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
            }else{
                Swal.fire({
                    title: "Atención!",
                    text: result,
                    icon: "warning",
                });
            }
        }



        });


    });

    $("#btnCancel_E_F").click(function () {
        $("#Pop_E_For").modal('hide');
    });
});

function validarletrasynum(parametro) {
    var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.\-_,]+$/;

    if (parametro.search(patron)) {
        return false;
    } else {
        return true;
    }

}