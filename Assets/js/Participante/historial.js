$(document).ready(function () {
    $('#tablaH').DataTable({
        //quitar elementos de la tabla
        paging: false,
        ordering: false,
        info: false,
        filter: false,

        //cambiar el idioma a español
        "language": {
            "zeroRecords": "No se encontraron resultados",
        }   
    });

    $(document).on('click', '#btnatras', function(e){
        $("#Popup4").modal('hide');
        location.reload();
    
    });

});