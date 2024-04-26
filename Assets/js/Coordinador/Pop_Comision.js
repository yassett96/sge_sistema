$(document).ready(function () {


    $("#btnADD_AC").click(function () {

        event.preventDefault();

        var NuevaComision = $("#NombreComision").val();


        var formulario = document.ModalComision;

        if (formulario.NombreComision.value == "") {
            //document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"></a>Favor ingresar el Nombre de la comision</div>';

            Swal.fire(
                'Advertencia',
                'Favor ingresar el Nombre de la Comisión',
                'warning'
            )

            formulario.NombreComision.focus();
            return false;
        } else if (validarletras(formulario.NombreComision.value) == false) {
            //document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"></a>No se permiten valores numericos </div>';
            Swal.fire(
                'Advertencia',
                'No se permiten valores numericos',
                'warning'
            )

            formulario.NombreComision.value = "";
            formulario.NombreComision.focus();
            return false;
        }

        $.ajax({
            url: "../../Controlador/Coordinador/CBuscarRegComision.php",
            type: 'POST',
            data: { NCom: NuevaComision },
            cache: false,
            success: function (result) {

                if (result.length == 0) {
                    $.ajax({
                        url: "../../Controlador/Coordinador/CAddComision.php",
                        type: "POST",
                        data: { NuevaComision: NuevaComision },
                        cache: false,
                        success: function (result) {
                            console.log(result);
                            if (result.length == 1) {
                                Swal.fire({
                                    title: 'Exito',
                                    text: 'Dato guardo correctamente',
                                    icon: 'success'
                                }).then(function () {
                                    location.reload();
                                });
                                $("#Pop_AC").modal('hide');

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

    $("#btnEd_C").click(function () {

        event.preventDefault();
        NComisionE = $("#ComisionE").val();

        //$("#NombreComisionEd").val(NComisionE);
        var UpdaComision = $("#NComisionEd").val();
        console.log(UpdaComision);

        var formulario2 = document.MComisionE;

        if (formulario2.NComisionEd.value == "") {
            //document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"></a>Favor ingresar el Nombre de la comision</div>';

            Swal.fire(
                'Advertencia',
                'Favor ingresar el Nombre de la Comisión',
                'warning'
            )

            formulario2.NComisionEd.focus();
            return false;
        } else if (validarletras(formulario2.NComisionEd.value) == false) {
            //document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"></a>No se permiten valores numericos </div>';
            Swal.fire(
                'Advertencia',
                'No se permiten valores numericos',
                'warning'
            )

            formulario2.NComisionEd.value = "";
            formulario2.NComisionEd.focus();
            return false;
        }

        $.ajax({
            url: "../../Controlador/Coordinador/CBuscarRegComision.php",
            type: 'POST',
            data: { NCom: UpdaComision },
            cache: false,
            success: function (result) {

                if (result.length == 0) {
                $.ajax({
                    url: "../../Controlador/Coordinador/CUpdComision.php",
                    type: "POST",
                    data: { UpdaComision: UpdaComision, IdComision: NComisionE },
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
                                url: '../../Controlador/Coordinador/CActualizaSelect.php',
                                type: 'POST',
                                data: { IdComision: NComisionE },
                                cache: false,
                                success: function (respuesta) {

                                    $("#ComisionE").html(respuesta);
                                }
                            });
                            $("#Pop_EC").modal('hide');
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

    $("#btnCancel_AC").click(function () {
        $("#Pop_AC").modal('hide');
    });

    $("#btnCancel_EC").click(function () {
        $("#Pop_EC").modal('hide');
    });


    function validarletras(parametro) {
        //var patron = /^[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]*$/;
        var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\.\-_,]+$/;
        if (parametro.search(patron)) {
            return false;
        } else {
            return true;
        }

    }

});