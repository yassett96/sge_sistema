$(document).ready(function () {

    $("#TCatsub tbody").on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected')
        }
        else {
            $("#TCatsub tr.selected").removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $("#TCategoria tbody").on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected')
        }
        else {
            $("#TCategoria tr.selected").removeClass('selected');
            $(this).addClass('selected');
        }
    });

    /********************************************************************************/

    $("#btnEditaCatE").click(function () { //ver detalles Categoria Evento

        event.preventDefault();

        var filasel = $(".selected");
        var IdCatEA = $(filasel).closest('tr').find("input:hidden").val();



        if (typeof IdCatEA === "undefined") {
            Swal.fire(
                'Advertencia',
                'Debe seleccionar una categoría',
                'warning'
            )
            die();

        }
        const nombreCategoriaEA = $(filasel).closest('tr').find(".NombreCatEA").text();
        console.log(nombreCategoriaEA);
        console.log(IdCatEA);


        //ComisionE = $("#ComisionE").val();

        $.ajax({
            url: "../../Vista/Coordinador/Pop_DetCategoriaEA.php",
            type: "POST",
            data: { IdComEA: IdCatEA },
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
                $('#Pop_CategoriaEA').modal('show');
                $("#nombre-categoria").text(nombreCategoriaEA);

                //$("#NombreComision").val(ComisionE);


            }
        });



    });


    ///////////////////////////////////////////////////////////////


    $("#CategoriaE3").change(function () { //Select Categoria
        Categoria = $("#CategoriaE3").val();

        console.log("IDCategoria : " + Categoria);

        $.ajax({
            url: "../../Controlador/Coordinador/CCategoriasSubcategorias.php",
            type: "POST",
            data: { Categoria },
            cache: false,
            success: function (result) {
                //alert(result);


                $("#tabla-datos").html(result);
            }
        });
    });


    $("#btnAgregarCategoria").click(function () {//Agregar Nueva categoria
        event.preventDefault();

        //ComisionE = $("#ComisionE").val();

        $.ajax({
            url: "../../Vista/Coordinador/Pop_AgregarCategoria.php",
            type: "POST",
            cache: false,
            success: function (result) {
                //alert(result)
                $("#contenedor").html(result);
                $("#Pop_ACat").modal('show');
                //$("#NombreComision").val(ComisionE);

            }
        });
    });

    $("#btnEditarCategoria").click(function () {  //Editar subcategoría
        event.preventDefault();

        var $selectedOption = $("#CategoriaE3 option:selected");

        if ($selectedOption.val() === "Seleccione una Categoría") {
            Swal.fire(
                'Advertencia',
                'Debe seleccionar una categoría',
                'warning'
            )
            return;
        }

        var categoria = {
            id: $selectedOption.data('id'),
            titulo: $selectedOption.text()
        };

        console.log("Nombre Categoria seleccionada: " + categoria.titulo);



        $.ajax({
            url: "../../Vista/Coordinador/Pop_EditCategoria.php",
            type: "POST",
            cache: false,
            data: { categoria: categoria },
            success: function (result) {
                $("#contenedor").html(result);
                $("#Pop_ECat").modal('show');
            }
        });

    });

    //////////////////////////////////////////////////////////////////////////////

    $("#btnAGGSub").click(function () { // Agregar Subcategoria

        event.preventDefault();

        var indice = $("#CategoriaE3").val();

        if (indice == "Seleccione una Categoría") {

            Swal.fire(
                'Advertencia',
                'Debe seleccionar una categoría',
                'warning'
            )
            die();
        }

        $.ajax({
            url: "../../Vista/Coordinador/Pop_AgregarSubCat.php",
            type: "POST",
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
                $("#Pop_ASubcat").modal('show');
                //$("#NombreComision").val(ComisionE);

            }
        });

    });


    $("#btnEDITSub").click(function () { //Editar subcategoría

        event.preventDefault();

        const elem = $(".selected");
        /*const data = $(elem).closest('tr').find("input:hidden").val();*/
        const idSubcategoria = $(elem).closest('tr').find("input:hidden").eq(0).val();
        const idAñoAcademico = $(elem).closest('tr').find("input:hidden").eq(1).val();

        console.log("IDSubcategoria :" + idSubcategoria);
        console.log("IDAÑOAcademico :" + idAñoAcademico);

        if (typeof idSubcategoria === "undefined") {
            Swal.fire(
                'Advertencia',
                'Debe seleccionar una subcategoría',
                'warning'
            )
            die();
        }

        const nombreSubcate = $(elem).closest('tr').find(".NombreSub").text();
        console.log(nombreSubcate);

        $.ajax({
            url: "../../Vista/Coordinador/Pop_EditarSubcategoria.php",
            type: "POST",
            data: { NombreSub: nombreSubcate, ID_SUB: idAñoAcademico },
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
                $("#Pop_ESub").modal('show');
                $("#nombre-subcategoria").html(nombreSubcate);

            }
        });



    });

    $("#btnGuardarE3").click(function () {
        var Id_Cate = $("#CategoriaE3").val();
        var NSubcates = $("#TCatsub tr").length;

        console.log(Id_Cate);

        var IdsSubcategorias = new Array();

        for (var j = 0; j <= NSubcates - 1; j++) {
            IdsSubcategorias[j] = $("#TCatsub tr").eq(j).children("td").eq(0).find("input:hidden").val();

        }

        pruebas3 = IdsSubcategorias.toString();

        if (pruebas3 == 0) {
            Swal.fire(
                'Advertencia',
                'Debe existir minimo 1 Subcategoria',
                'warning'
            )
            die();
        }


        $.ajax({
            type: "POST",
            url: "../../Controlador/Coordinador/CPlanificacionE3.php",
            data: { idcate: Id_Cate },


            success: function (result) {
                if (result.length !== 0) {

                    Swal.fire({
                        customClass: {
                            confirmButton: 'swalBtnColor',
                        },
                        title: "Categoría registrada Exitosamente",
                        text: " ¿Desea Registrar otra categoría?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No',
                    })
                        .then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../Vista/Coordinador/PlanificacionE3.php";
                            } else {
                                window.location.href = "../../Vista/Coordinador/Planificacion_Feria_CE.php";
                            }
                        });
                }
                else {
                    swal("No Logrado")
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

$(document).on("click", "#BtnEliminarCE", function () {  //Eliminar Comision del evento


    var fila = $(this).closest("tr");
    Swal.fire({
        title: "¿Estás seguro de que deseas eliminar la categoría del evento actual?",
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
        var idCE = $(elem).closest('tr').find("input:hidden").val();

        $.ajax({
            url: "../../Controlador/Coordinador/CDelCategoriaEvento.php",
            type: "POST",
            data: { IdCatEvento: idCE },
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


$(document).on("click", "#BtnEliminarSubCat", function () {  //Eliminar Funcion de tabla y de BD n


    var fila = $(this).closest("tr");
    Swal.fire({
        title: "¿Estás seguro de que deseas eliminar la Subcategoría?",
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            fila.addClass("selected");
            eliminarSubCat();
        } else {
            fila.removeClass("selected");
        }
    });
});

function eliminarSubCat() {
    var elem = $(".selected");
    if (elem.length > 0) {
        var iddatas = $(elem).closest('tr').find("input:hidden").val();
        console.log('Valor del input oculto: ' + iddatas);

        $.ajax({
            url: "../../Controlador/Coordinador/CDelSubcategoria.php",
            type: "POST",
            data: { IdSubcategoria: iddatas },
            cache: false,
            success: function (result) {
                console.log(result);
                if (result.length == 1) {
                    Swal.fire(
                        'Exito',
                        'Dato guardo correctamente',
                        'success'
                    )




                    elem.removeClass("selected");
                    var fila = $('#BtnEliminarSubCat').closest('tr');

                    fila.remove();
                    actualizarNumerosF();
                    //console.log(ComisionE);


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

    }
}

function actualizarNumerosF() {
    const celdasNumero = document.querySelectorAll('.ordenS');
    const celdasNumero2 = document.querySelectorAll('.ordenCatE');



    if (celdasNumero.parentNode = 'ordenS') {

        for (let i = 0; i < celdasNumero.length; i++) {
            celdasNumero[i].textContent = i + 1;
        }
    }

    if (celdasNumero2.parentNode = 'ordenCatE') {
        for (let j = 0; j < celdasNumero2.length; j++) {
            celdasNumero2[j].textContent = j + 1;
        }
    }


    const tablaCE = document.querySelector('#TCategoria tbody');
    const numFilasCE = tablaCE.rows.length;
    if (numFilasCE == 0) {
        tablaCE.innerHTML = '<tr><td colspan="5">No hay categorías en el evento</td></tr>';
    }
}
