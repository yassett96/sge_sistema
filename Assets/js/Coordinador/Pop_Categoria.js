$(document).ready(function () {

    $("#btnADD_ACat").click(function () {

        event.preventDefault();

        var NuevaCat = $("#NombreCategoria").val();


        var formulario = document.ModalCategoria;

        if (formulario.NombreCategoria.value == "") {
            //document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"></a>Favor ingresar el Nombre de la comision</div>';

            Swal.fire(
                'Advertencia',
                'Favor ingresar el Nombre de la categoria',
                'warning'
            )

            formulario.Nombrecategoria.focus();
            return false;
        } else if (validarletras(formulario.NombreCategoria.value) == false) {
            //document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"></a>No se permiten valores numericos </div>';
            Swal.fire(
                'Advertencia',
                'No se permiten valores numericos',
                'warning'
            )

            formulario.NombreCategoria.value = "";
            formulario.NombreCategoria.focus();
            return false;
        }



        $.ajax({
            url: "../../Controlador/Coordinador/CBuscarRegCategoria.php",
            type: 'POST',
            data: { NombreCategoria: NuevaCat },
            cache: false,
            success: function (result) {

                if (result.length == 0) {
                    $.ajax({
                        url: "../../Controlador/Coordinador/CAddCategoria.php",
                        type: "POST",
                        data: { NuevaCategoria: NuevaCat },
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
                                $("#Pop_ACat").modal('hide');

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

    $("#btnCancel_ACat").click(function () {
        $("#Pop_ACat").modal('hide');
    });

    $("#btnCancel_ECat").click(function () {
        $("#Pop_ECat").modal('hide');
    });

    $("#btnEd_Cat").click(function () {

        event.preventDefault();
        var NCategoria = $("#CategoriaE3").val();


        var UpdaCategoria = $("#NCategoriaEd").val();
        console.log(UpdaCategoria);

        var formulario2 = document.MCategoriaE;

        if (formulario2.NCategoriaEd.value == "") {

            Swal.fire(
                'Advertencia',
                'Favor ingresar el Nombre de la Categoría',
                'warning'
            )

            formulario2.NCategoriaEd.focus();
            return false;
        } else if (validarletras(formulario2.NCategoriaEd.value) == false) {

            Swal.fire(
                'Advertencia',
                'No se permiten valores numericos',
                'warning'
            )

            formulario2.NCategoriaEd.value = "";
            formulario2.NCategoriaEd.focus();
            return false;
        }
        

        $.ajax({
            url: "../../Controlador/Coordinador/CBuscarRegCategoria.php",
            type: 'POST',
            data: { NombreCategoria: UpdaCategoria },
            cache: false,
            success: function (result) {

                if (result.length == 0) {
                    $.ajax({
                        url: "../../Controlador/Coordinador/CUpdCategoria.php",
                        type: "POST",
                        data: { UpdaCat: UpdaCategoria, IDCategoria: NCategoria },
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
                                    url: '../../Controlador/Coordinador/CActualizarSelectCat.php',
                                    type: 'POST',
                                    data: { IdCategoria: NCategoria },
                                    cache: false,
                                    success: function (respuesta) {

                                        $("#CategoriaE3").html(respuesta);
                                    }
                                });
                                $("#Pop_ECat").modal('hide');
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


function validarletras(parametro) {
    //var patron = /^[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]*$/;
    var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\.\-_,]+$/;
    if (parametro.search(patron)) {
        return false;
    } else {
        return true;
    }

}
