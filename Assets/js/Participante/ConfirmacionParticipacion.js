$(document).ready(function() { 
    
    // Para cuando cambia el input donde se selecciona la imagen de la cédula
    $("#imagenSeleccionar").change(function(e) {
        // alert("Entramos");
        var file = e.target.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#idImgPopUpConfirmar').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    });

});