$(document).ready(function () {

    var contador = 0; // variable para contar las filas

    $("#btnADD_C").click(function () {

        event.preventDefault();

        var valorNC = $("#NCriterioAd").val();
        var valorDC = $("#DescripcionC").val();
        var valorCValor = $("#ValorC").val();

        var formCri = document.ModCriterioA;

        if (formCri.NCriterioAd.value == "") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar el Nombre del criterio',
                'warning'
            )
            formCri.NCriterioAd.focus();
            return false;
        } else if (validarletrasynum(formCri.NCriterioAd.value) == false) {
            Swal.fire(
                'Advertencia',
                'Solo se permiten letras (mayúsculas o minúsculas) o número del 0 al 9 ',
                'warning'
            )
            formCri.NCriterioAd.focus();
            return false;
        }
        if (formCri.DescripcionC.value == "") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar la descripcion del  criterio',
                'warning'
            )
            formCri.DescripcionC.focus();
            return false;
        } else if (validarletras(formCri.DescripcionC.value) == false) {
            Swal.fire(
                'Advertencia',
                'No se permiten valores numericos',
                'warning'
            )
            formCri.DescripcionC.focus();
            return false;

        }if (formCri.ValorC.value == "") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar el Valor del criterio',
                'warning'
            )
            formCri.ValorC.focus();
            return false;
        }
         else {
            var tabla = $("#TAddCriterios").find('tbody');
            var fila = $("<tr>").appendTo(tabla);
            var celda1 = $("<td>").appendTo(fila);
            var celda2 = $("<td>").appendTo(fila);
            var celda3 = $("<td>").appendTo(fila);
            var celda4 = $("<td>").appendTo(fila);
            var celda5 = $("<td>").appendTo(fila);

            contador++; // incrementa el contador de filas
            celda1.text(contador); // agrega el número de fila a la primera celda
            celda2.text(valorNC);
            celda3.text(valorDC);
            celda4.text(valorCValor);

            var botonEliminar = $("<button>").text("Eliminar").addClass("btn btn-light").appendTo(celda5);
            botonEliminar.click(function () {
                fila.remove(); // elimina la fila
                contador--; // decrementa el contador de filas
                // actualiza los números de las filas
                tabla.find('tr').each(function (i, row) {
                    $(row).find('td:first').text(i + 1);
                });
            });

            $("#NCriterioAd").val("");
            $("#DescripcionC").val("");
            $("#ValorC").val("");
            $("#btnAdd_A_C").prop("disabled", false);
            document.getElementById("btnAdd_A_C").classList.remove("opacity-50");
        }

    });

    $("#btnAdd_A_C").click(function () {
        event.preventDefault();

        var valoresCelda = [];
        $("#TAddCriterios tbody tr").each(function () {
            var valorCelda1 = $(this).find("td:eq(1)").text();
            var valorCelda2 = $(this).find("td:eq(2)").text();
            var valorCelda3 = $(this).find("td:eq(3)").text();
            console.log("Valor de celda 1: " + valorCelda1);
            console.log("Valor de celda 2: " + valorCelda2);
            console.log("Valor de celda 3: " + valorCelda3);
            valoresCelda.push(valorCelda1 + "," + valorCelda2 + "|" + valorCelda3);

        });

        //console.log(valoresCelda);

        var DatosCriterios = valoresCelda.join("}");
        console.log(DatosCriterios);


        var contador = DatosCriterios.split("}").length;
        console.log("Número de separadores: " + contador);

        CriteriosList = DatosCriterios.toString();
        console.log(CriteriosList);

        Idformato = $("#FormatCriterio").val();
        console.log("Número ID Tipo formato: " + Idformato);



        $.ajax({
            url: "../../Controlador/Coordinador/CAddCriterio.php",
            type: "POST",
            data: { IdTFormato: Idformato, Contador: contador, Criterios: CriteriosList },
            cache: false,
            success: function (result) {
                console.log(result);
                if (result.length == 1) {
                    Swal.fire(
                        'Exito',
                        'Dato guardado correctamente',
                        'success'
                    )
                    $("#Pop_A_C").modal('hide');

                    $.ajax({
                        url: "../../Controlador/Coordinador/CCriterioFormato.php",
                        type: "POST",
                        data: { ID_TipoFormat: Idformato },
                        cache: false,
                        success: function (result) {
                            //alert(result);


                            $("#tabla-criterios").html(result);
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

    $("#btnEd_E_C").click(function () {
        event.preventDefault();
        
        var filasel = $(".selected");
        var IdCriterio = $(filasel).closest('tr').find("input:hidden").val();
        var DatoCriterio = $("#NCriterioEd").val();
        var Descri_Cri = $("#EDDescripcionC").val();
        var Valor_Cri = $("#EDValorC").val();

        console.log("ID:CRITERIO ="+IdCriterio);
        console.log("Nombre ="+DatoCriterio);
        console.log("Descripcion ="+Descri_Cri);
        console.log("Valor ="+Valor_Cri);


        //console.log("IfFuncion :" + IdFunc + ", Nuevo valor: " + DatoFuncion);


        var formCriE = document.ECriterio;

        if (formCriE.NCriterioEd.value == "") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar el Nombre del criterio',
                'warning'
            )
            formCriE.NCriterioEd.focus();
            return false;

        } else if (validarletrasynum(formCriE.NCriterioEd.value) == false) {
            Swal.fire(
                'Advertencia',
                'Solo se permiten letras (mayúsculas o minúsculas) o número del 0 al 9',
                'warning'
            )
            formCriE.NCriterioEd.focus();
            return false;

        }
        
        if (formCriE.EDDescripcionC.value == "") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar la descripción del criterio',
                'warning'
            )
            formCriE.EDDescripcionC.focus();
            return false;
        } else if (validarletras(formCriE.EDDescripcionC.value) == false) {
            Swal.fire(
                'Advertencia',
                'No se permiten valores numericos',
                'warning'
            )
            formCriE.EDDescripcionC.focus();
            return false;

        }
        
        if (formCriE.EDValorC.value == "") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar el Valor del criterio',
                'warning'
            )
            formCriE.EDValorC.focus();
            return false;
        }

        console.log("ID:CRITERIO ="+IdCriterio);
        console.log("Nombre ="+DatoCriterio);
        console.log("Descripcion ="+Descri_Cri);
        console.log("Valor ="+Valor_Cri);
        

        $.ajax({
            url: "../../Controlador/Coordinador/CUpdCriterio.php",
            type: "POST",
            data: { Id_Criterio: IdCriterio, N_Criterio: DatoCriterio,N_Descri: Descri_Cri,N_Valor:Valor_Cri },
            cache: false,
            success: function (result) {
                console.log(result);
                if (result.length == 1) {
                    Swal.fire(
                        'Exito',
                        'Dato guardo correctamente',
                        'success'
                    )
                    $("#Pop_ED_C").modal('hide');

                    Idformato = $("#FormatCriterio").val();

                    $.ajax({
                        url: "../../Controlador/Coordinador/CCriterioFormato.php",
                        type: "POST",
                        data: { ID_TipoFormat: Idformato },
                        cache: false,
                        success: function (result) {
                            //alert(result);


                            $("#tabla-criterios").html(result);
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

    $("table tr").click(function () {
        // Remueve la clase "selected" de todas las filas
        $("table tr").removeClass("selected");
        // Agrega la clase "selected" a la fila seleccionada
        $(this).addClass("selected");
      });
    
    
    
      $("#btnCancel_A_C").click(function () {
        $("#Pop_A_C").modal('hide');
      });
    
    
      $("#btnCancel_E_C").click(function () {
    
        $('#TCriterios tbody tr').removeClass('selected');
        //$('#tabla-datos tbody tr').css('background-color', '');
        $("#Pop_ED_C").modal('hide');
      });


    function validarletrasynum(parametro) {
        var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s]+$/;

        if (parametro.search(patron)) {
            return false;
        } else {
            return true;
        }

    }

    function validarletras(parametro) {
        var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\.\-_,]+$/g;
        if (parametro.search(patron)) {
            return false;
        } else {
            return true;
        }

    }
});