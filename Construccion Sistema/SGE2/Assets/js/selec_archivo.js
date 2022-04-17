//para mostrar nombre del archivo seleccionado

$(function(){
    $('.form-control').on('change', function(){
        $(this).prev().text($(this)[0].files[0].name);
    })
})