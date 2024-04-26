$(document).ready(function() {

    // Mostrar el panel de menú al pasar el mouse sobre la imagen
    $("#imgLogUsuario").hover(function() {
        $("#divMenuDespliegue").css({
            "visibility":"visible" 
        });
    });

    $("#aMiCuenta").hover(function() {
        $("#divMenuDespliegue").css({
            "visibility":"visible" 
        });
    });

    $("#aCerrarSesion").hover(function() {
        $("#divMenuDespliegue").css({
            "visibility":"visible" 
        });
    });

    $("#divMenuDespliegue").hover(function() {
        $("#divMenuDespliegue").css({
            "visibility":"visible" 
        });
    });

    // Ocultar el panel de menú al quitar el mouse de la imagen o el menú
    $("#imgLogUsuario").mouseout(function() {
        $("#divMenuDespliegue").css({
            "visibility":"hidden" 
        });         
    });

    $("#aMiCuenta").mouseout(function() {
        $("#divMenuDespliegue").css({
            "visibility":"hidden" 
        }); 
    });

    $("#aCerrarSesion").mouseout(function() {
        $("#divMenuDespliegue").css({
            "visibility":"hidden" 
        }); 
    });

    $("#divMenuDespliegue").mouseout(function() {
        $("#divMenuDespliegue").css({
            "visibility":"hidden" 
        }); 
    });


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
            url: "../../Vista/Coordinador/CargarComisionSeleccionadaV1.php",
            type: "POST",
            data: { ID_Com: IDComision, NombreCom: NombreComision },
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
            }
        });


        
    });
  });