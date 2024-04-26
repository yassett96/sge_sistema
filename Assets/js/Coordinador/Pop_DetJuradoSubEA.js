$(document).ready(function() {  

    $(document).on('click', '#btnCerrarPOP_JurEA', function() {
    $('#Pop_JuradoEA').modal('hide');
    $('#TJuradoE tbody tr').removeClass('selected');

    //  location.reload();
    });

    
    $(document).on('click', '#Closedes', function() {
        $('#Pop_JuradoEA').modal('hide');
        $('#TJuradoE tbody tr').removeClass('selected');
    });


    
});