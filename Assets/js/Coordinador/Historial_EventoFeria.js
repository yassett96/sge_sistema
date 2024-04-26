$(document).ready(function () {
    $("#THistorialFeria tbody").on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected')
        }
        else {
            $("#THistorialFeria tr.selected").removeClass('selected');
            $(this).addClass('selected');
        }
    });

    ///////////////////////////////////////////
    $("#btnEditaDetE").click(function () { //Ver detalles Jurados

        event.preventDefault();
    
        var filasel = $(".selected");
        var IdEvento = $(filasel).closest('tr').find("input:hidden").val();
    
    
    
        if (typeof IdEvento === "undefined") {
          Swal.fire(
            'Advertencia',
            'Debe seleccionar un evento',
            'warning'
          )
          die();
    
        }
        /*const nombreCategoriaEA = $(filasel).closest('tr').find(".NombreCatEA").text();
        const nombreSubCateEA = $(filasel).closest('tr').find(".NombreSubCatEA").text();
        console.log(nombreCategoriaEA);
        console.log(nombreSubCateEA);*/
        console.log(IdEvento);
    
    
        //ComisionE = $("#ComisionE").val();
    
        $.ajax({
          
          url: "../../Vista/Coordinador/Pop_DetHistorialEvento.php",
          type: "POST",
          data: { Id_EventoSel: IdEvento},
          cache: false,
          success: function (result) {
            $("#contenedor").html(result);
            $('#Pop_HistorialE').modal('show');
            //$("#nombre-funcion").text(nombreComisionEA);
    
            //$("#NombreComision").val(ComisionE);
    
    
          }
        });
    
    
    
      });
    
    ///////////////////////////////////////////
   
});

function filtrarTabla() {
    var input = document.getElementById('searchInput');
    var filter = input.value.toUpperCase();
    var table = document.getElementById('tabla-eventosferia');
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