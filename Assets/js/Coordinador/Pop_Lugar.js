$(document).ready(function () {

    var contador = 0;

    $("#btnAg_subcate").click(function () {

        var NSalon = $("#NombreSalon").val();
        var NCapacidad = $("#Capacidad").val();

        console.log(NSalon);
        console.log(NCapacidad);
        var formReq = document.ModalLugar;

        if (formReq.NombreSalon.value == "") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar el nombre del salón',
                'warning'
            )
            formReq.NombreSalon.focus();
            return false;
        } else if (validarTexto(formReq.NombreSalon.value) == false) {
            Swal.fire(
                'Advertencia',
                'Solo se permiten caracteres alfanuméricos, coma, guion, guion bajo, punto y espacio',
                'warning'
            )
            formReq.NombreSalon.focus();
            return false;
        }
        if (formReq.Capacidad.value == "") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar la capacidad del salón',
                'warning'
            )
            formReq.Capacidad.focus();
            return false;
        }
        else {
            var tabla = $("#TADDSalon").find('tbody');
            var fila = $("<tr>").appendTo(tabla);
            var celda1 = $("<td>").appendTo(fila);
            var celda2 = $("<td>").appendTo(fila);
            var celda3 = $("<td>").appendTo(fila);
            var celda4 = $("<td>").appendTo(fila);

            contador++; // incrementa el contador de filas
            celda1.text(contador); // agrega el número de fila a la primera celda
            celda2.text(NSalon);
            celda3.text(NCapacidad);

            var botonEliminar = $("<button>").text("Eliminar").addClass("btn btn-light CE").appendTo(celda4);
            botonEliminar.click(function () {
                fila.remove(); // elimina la fila
                contador--; // decrementa el contador de filas
                // actualiza los números de las filas
                tabla.find('tr').each(function (i, row) {
                    $(row).find('td:first').text(i + 1);
                });
            });
            $("#NombreSalon").val("");
            $("#Capacidad").val("");
        }


    });

    $("#btnADD_AC").click(function () {
        event.preventDefault();

        var NLugar = $("#NombreLugar").val();

        var formReq = document.ModalLugar;

        if (formReq.NombreLugar.value == "") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar el nombre del Lugar',
                'warning'
            )
            formReq.NombreLugar.focus();
            return false;
        } else if (validarTexto(formReq.NombreLugar.value) == false) {
            Swal.fire(
                'Advertencia',
                'Solo se permiten caracteres alfanuméricos, coma, guion, guion bajo, punto y espacio',
                'warning'
            )
            formReq.NombreLugar.focus();
            return false;
        }

        console.log(NLugar);


        var valoresCelda2 = [];
        $("#TADDSalon tbody tr").each(function () {
            var valorCelda1 = $(this).find("td:eq(1)").text();
            var valorCelda2 = $(this).find("td:eq(2)").text();

            console.log("Valor de celda 1: " + valorCelda1);
            console.log("Valor de celda 2: " + valorCelda2);

            valoresCelda2.push(valorCelda1 + "," + valorCelda2);
        });

        var lsitios = valoresCelda2.join("}");
        console.log(lsitios);


        var contador = lsitios.split("}").length;
        console.log("Número de separadores: " + contador);

        ListaSitiosG = lsitios.toString();
        console.log(ListaSitiosG);


        if (valoresCelda2 == "") {
            Swal.fire(
                'Advertencia',
                'Favor de ingresar una subcategoría',
                'warning'
            )
            die();
        }

        
        

        $.ajax({
            url: "../../Controlador/Coordinador/CAddLugarSalon.php",
            type: "POST",
            data: { NomLugar: NLugar, Contador: contador, Salones: lsitios },
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
                        url: '../../Controlador/Coordinador/CActualizaListaSitio.php',
                        type: 'POST',
                        cache: false,
                        success: function (respuesta) {

                            $("#LugarE").html(respuesta);
                        }
                    })

                    $("#Pop_AL").modal('hide');
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
    });

    $("#btnCancel_AC").click(function () {
        $("#Pop_AL").modal('hide');
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
});