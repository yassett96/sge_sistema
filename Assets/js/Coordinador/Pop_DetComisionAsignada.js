$(document).ready(function() {  

    $(document).on('click', '#btnCerrarPOP_CEA', function() {
    $('#Pop_DetComAct').modal('hide');
    $('#TActividades tbody tr').removeClass('selected');

    //  location.reload();
    });
    $('#Pop_DetComAct').on('hidden.bs.modal', function() {
        $('#TActividades tbody tr').removeClass('selected');
    });
    
    


    
});
