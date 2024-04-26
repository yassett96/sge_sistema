$(document).ready(function () {

    $(".ContDatosCA").click(function () {
        var IDComision = $(this).find(".R1").attr("value");
        var NombreComision =  $(this).find(".h4").text();
        //var ValorID = $("#Id_Per").val();
    
        console.log(IDComision);
        console.log(NombreComision);

        /*Swal.fire(
            'Éxito',
            'Hola, has seleccionado una comisión',
            'success'
        );*/

        $.ajax({
            url: "CargarComisionSeleccionadaV1.php",
            type: "POST",
            data: { ID_Com: IDComision, NombreCom: NombreComision },
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
            }
        });


        
    });

    

    
});

