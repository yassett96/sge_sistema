$(document).ready(function () {

    $(document).on('click', '#btnCerrarPOP_HE', function () {
        $('#Pop_HistorialE').modal('hide');
        $('#THistorialFeria tbody tr').removeClass('selected');

        //  location.reload();
    });


    $(document).on('click', '#Closedes', function () {
        $('#Pop_HistorialE').modal('hide');
        $('#THistorialFeria tbody tr').removeClass('selected');
    });

    $(document).on("click", ".btn-plan-trabajo", function () {
        var filasel = $(this).closest('tr');
        var IdComEA = $(filasel).find("input:hidden").val();
        var nombreComision = $(this).closest('tr').find('.NombreCatEA').text();

        var filaselE = $(".selected");
        var IdEvento = $(filaselE).closest('tr').find("input:hidden").val();

        console.log("Nombre de la comisión: ", nombreComision);

        console.log("eVENTO SELCCE "+IdEvento);

        var variable = IdComEA;
        var NombreC = nombreComision; 
        var IdEsel = IdEvento;// Aquí defines el valor de la variable que deseas enviar
        var url = "../../Controlador/Coordinador/CReporte_ActividadesComisionHistorial.php?variable1=" + encodeURIComponent(variable) + "&variable2=" + encodeURIComponent(NombreC) + "&variable3=" + encodeURIComponent(IdEsel)
        window.location.href = url;


    });


    $(document).on("click", ".btn-reporte-final", function () {

        var filasel = $(this).closest('tr');
        var ComisionAsig = $(filasel).find("input:hidden").val();
        var nombreComision = $(this).closest('tr').find('.NombreCatEA').text();

        //console.log(ComisionAsig);

        $.ajax({
            url: "../../Controlador/Coordinador/CObtenerURLReporteCS.php",
            type: "POST",
            data: { ComisionASel: ComisionAsig },
            cache: false,
            success: function (result) {

                console.log(result);


                var data = JSON.parse(result); // Parsear la respuesta JSON en un array




                if (data.length > 0) {
                    var nombreArchivo = data[0].Nombre;
                    var urlArchivo = data[0].URL; // Supongamos que la URL está en el primer elemento del array

                    // Descargar el archivo
                    var downloadLink = document.createElement('a');
                    downloadLink.href = urlArchivo;
                    downloadLink.download = nombreArchivo;
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    document.body.removeChild(downloadLink);
                }else{
                Swal.fire(
                    'Advertencia',
                    'No hay registros para el Reporte Final de '+nombreComision+' ',
                    'warning'
                )
                }
                
            }
        });
    });

    /*var variable = $("#ComisionesEA").val();
    var NombreC = $("#ComisionesEA option:selected").text();


    if (variable == "Seleccione una comisión") {

        Swal.fire(
            'Advertencia',
            'Debe seleccionar una comisión',
            'warning'
        )
        die();
    }


    var variable = $("#ComisionesEA").val();
    var NombreC = $("#ComisionesEA option:selected").text(); // Aquí defines el valor de la variable que deseas enviar
    var url = "../../Controlador/Coordinador/CReporte_IntegrantesComision.php?variable1=" + encodeURIComponent(variable) + "&variable2=" + encodeURIComponent(NombreC)
    window.location.href = url;
    
    
    
$(document).on("click", "#BtnEliminarComA", function () {  //Eliminar Funcion de tabla y de BD n


    var fila = $(this).closest("tr");
    Swal.fire({
        title: "¿Estás seguro de que deseas eliminar la Actividad?",
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            fila.addClass("selected");
            eliminarComA();
        } else {
            fila.removeClass("selected");
        }
    });
});



});*/




});

function filtrarTabla1() {
    var input = document.getElementById('searchInputT1');
    var filter = input.value.toUpperCase();
    var table = document.getElementById('tabla-datosComision_HE');
    var rows = table.getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        var dataCells = rows[i].getElementsByTagName('td');
        var visible = false;

        for (var j = 0; j < dataCells.length; j++) {
            var cell = dataCells[j];
            if (cell) {
                var cellText = cell.textContent || cell.innerText;
                if (cellText.toUpperCase().indexOf(filter) > -1) {
                    visible = true;
                    break;
                }
            }
        }

        rows[i].style.display = visible ? '' : 'none';
    }
}

function filtrarTabla2() {
    var input = document.getElementById('searchInputT2');
    var filter = input.value.toUpperCase();
    var table = document.getElementById('tabla-datosCatSub_HE');
    var rows = table.getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        var dataCells = rows[i].getElementsByTagName('td');
        var visible = false;

        for (var j = 0; j < dataCells.length; j++) {
            var cell = dataCells[j];
            if (cell) {
                var cellText = cell.textContent || cell.innerText;
                if (cellText.toUpperCase().indexOf(filter) > -1) {
                    visible = true;
                    break;
                }
            }
        }

        rows[i].style.display = visible ? '' : 'none';
    }
}

function filtrarTabla3() {
    var input = document.getElementById('searchInputT3');
    var filter = input.value.toUpperCase();
    var table = document.getElementById('tabla-datosConferencia_HE');
    var rows = table.getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        var dataCells = rows[i].getElementsByTagName('td');
        var visible = false;

        for (var j = 0; j < dataCells.length; j++) {
            var cell = dataCells[j];
            if (cell) {
                var cellText = cell.textContent || cell.innerText;
                if (cellText.toUpperCase().indexOf(filter) > -1) {
                    visible = true;
                    break;
                }
            }
        }

        rows[i].style.display = visible ? '' : 'none';
    }
}
