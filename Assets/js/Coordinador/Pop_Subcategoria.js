$(document).ready(function () {

    var contador = 0; // variable para contar las filas

    $("#btnAg_subcate").click(function () {

        event.preventDefault();

        var valorInput = $("#NSubcategoriaAd").val();
        var valorAñoAca = $("#AñoAca").val();
        var textoAñoAca = $("#AñoAca").find("option:selected").text();

        var formSub = document.MSubcatA;

        if (formSub.NSubcategoriaAd.value == "") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar el Nombre de la Subcategoria',
                'warning'
            )
            formSub.NSubcategoriaAd.focus();
            return false;
        } else if (validarletras(formSub.NSubcategoriaAd.value) == false) {
            Swal.fire(
                'Advertencia',
                'No se permiten valores numericos',
                'warning'
            )
            formSub.NSubcategoriaAd.focus();
            return false;
        }
        if (formSub.AñoAca.value == "Seleccione el año académico") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar el año académico de la subcategoria',
                'warning'
            )
            formSub.NSubcategoriaAd.focus();
            return false;
        }
        else {
            /*var tabla = $("#TAddSubcate").find('tbody');
            var fila = $("<tr>").appendTo(tabla);
            var celda1 = $("<td>").appendTo(fila);
            var celda2 = $("<td>").appendTo(fila);
            var celda3 = $("<td>").appendTo(fila);
            var celda4 = $("<td>").appendTo(fila);*/

            var tabla = $("#TAddSubcate").find('tbody');
            var fila = $("<tr>").appendTo(tabla);
            var celda1 = $("<td>").appendTo(fila);
            var celda2 = $("<td>").appendTo(fila);
            /*var celda3 = $("<td>").appendTo(fila);
            var celda3Input = $("<input>").attr("type", "hidden").attr("value",textoAñoAca ).appendTo(celda3);
            var celda4 = $("<td>").appendTo(fila);*/

            var celda3 = $("<td>").appendTo(fila);
            var celda3Input = $("<input>").attr("type", "hidden").attr("value", valorAñoAca).appendTo(celda3);
            var celda3Texto = $("<span>").text(textoAñoAca).appendTo(celda3);
            //celda3Texto.css("display", "none"); // ocultar el span
            var celda4 = $("<td>").appendTo(fila);

            contador++; // incrementa el contador de filas
            celda1.text(contador); // agrega el número de fila a la primera celda
            celda2.text(valorInput);

            var botonEliminar = $("<button>").text("Eliminar").addClass("btn btn-light").appendTo(celda4);
            botonEliminar.click(function () {
                fila.remove(); // elimina la fila
                contador--; // decrementa el contador de filas
                // actualiza los números de las filas
                tabla.find('tr').each(function (i, row) {
                    $(row).find('td:first').text(i + 1);
                });
            });

            $("#NSubcategoriaAd").val("");
            $("#AñoAca").val("Seleccione el año académico");
            //document.getElementById("btnAdd_Sub").classList.remove("opacity-50");
        }

    });

    $("#btnAdd_Sub").click(function () {
        event.preventDefault();

        var valoresCelda2 = [];
        $("#TAddSubcate tbody tr").each(function () {
            var valorCelda1 = $(this).find("td:eq(1)").text();
            var valorCelda3 = $(this).find("td:eq(2) input[type='hidden']").val();

            console.log("Valor de celda 1: " + valorCelda1);
            console.log("Valor de celda 3: " + valorCelda3);

            valoresCelda2.push(valorCelda1 + "," + valorCelda3);
        });

        var resultado2 = valoresCelda2.join("}");
        console.log(resultado2);


        var contador = resultado2.split("}").length;
        console.log("Número de separadores: " + contador);

        pruebas = resultado2.toString();
        console.log(pruebas);


        if ( valoresCelda2 == "") {
            Swal.fire(
              'Advertencia',
              'Favor de ingresar una subcategoría',
              'warning'
            )
            die();
          }


        var IdCat = $("#CategoriaE3").val();

        console.log("ID DE LA CATEGORIA:" + IdCat);

        $.ajax({
            url: "../../Controlador/Coordinador/CAddSubcategoria.php",
            type: "POST",
            data: { IdCategoria: IdCat, Contador: contador, Subcategorias: pruebas },
            cache: false,
            success: function (result) {
                console.log(result);
                if (result.length == 1) {
                    Swal.fire(
                        'Exito',
                        'Dato guardado correctamente',
                        'success'
                    )

                    $("#Pop_ASubcat").modal('hide');


                    $.ajax({
                        url: "../../Controlador/Coordinador/CCategoriasSubcategorias.php",
                        type: "POST",
                        data: { Categoria: IdCat },
                        cache: false,
                        success: function (result) {
                            //alert(result);


                            $("#tabla-datos").html(result);
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
    });

    $("#btnCancel_ASub").click(function () {
        $("#Pop_ASubcat").modal('hide');
    });

    $("#btnGEd_Sub").click(function () {

        event.preventDefault();

        var valorNsubcat = $("#NSubcategoriaAd_E").val();
        var valorNAñoAca = $("#AñoAca_E").val();

        var formSub = document.MEd_SubcatA;

        if (formSub.NSubcategoriaAd_E.value == "") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar el Nombre de la Subcategoria',
                'warning'
            )
            formSub.NSubcategoriaAd_E.focus();
            return false;
        } else if (validarletras(formSub.NSubcategoriaAd_E.value) == false) {
            Swal.fire(
                'Advertencia',
                'No se permiten valores numericos',
                'warning'
            )
            formSub.NSubcategoriaAd_E.focus();
            return false;
        }

        console.log(valorNsubcat);
        console.log(valorNAñoAca);

        var filaselec = $(".selected");
        var IdSubCat = $(filaselec).closest('tr').find("input:hidden").val();
        console.log("IfSubcate seleccionada:" + IdSubCat);


        $.ajax({
            url: "../../Controlador/Coordinador/CUpdSubcategoria.php",
            type: "POST",
            data: { IdSubcate: IdSubCat, Subcategorias: valorNsubcat, IdAñoAca: valorNAñoAca },
            cache: false,
            success: function (result) {
                console.log(result);
                if (result.length == 1) {
                    Swal.fire(
                        'Exito',
                        'Dato guardado correctamente',
                        'success'
                    )

                    $("#Pop_ESub").modal('hide');
                    var IdCat_Select = $("#CategoriaE3").val();

                    $.ajax({
                        url: "../../Controlador/Coordinador/CCategoriasSubcategorias.php",
                        type: "POST",
                        data: { Categoria: IdCat_Select },
                        cache: false,
                        success: function (result) {
                            //alert(result);


                            $("#tabla-datos").html(result);
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
    });


    $("#btnCancel_ESub").click(function(){

        $('#TCatsub tbody tr').removeClass('selected');
        $("#Pop_ESub").modal('hide');
      });


    $("table tr").click(function () {
        // Remueve la clase "selected" de todas las filas
        $("table tr").removeClass("selected");
        // Agrega la clase "selected" a la fila seleccionada
        $(this).addClass("selected");
    });

    function validarletras(parametro) {
        var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\.\-_,]+$/g;
        if (parametro.search(patron)) {
            return false;
        } else {
            return true;
        }

    }

});
