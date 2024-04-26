$(document).ready(function() {  

    $(document).on('click', '#btnCerrarPOP_CatEA', function() {
    $('#Pop_CategoriaEA').modal('hide');
    $('#TCategoria tbody tr').removeClass('selected');

    //  location.reload();
    });

    
    $(document).on('click', '#Closedes', function() {
        $('#Pop_CategoriaEA').modal('hide');
        $('#TCategoria tbody tr').removeClass('selected');
    });


    
});