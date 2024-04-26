$(document).ready(function(){
    
    $(document).on("click", "#editaravatar", function(e){
        $.ajax({
            url: "../../Vista/Jurado/EditarIcono.php",
            type: "POST",
            cache: false,
            success:function (result){
                $("#contenedor").html(result);
                $("#Popup1").modal('show');
            }
        });
    
    });

    $('#editardatos').click(function(){
        $.ajax({
            url: "../../Vista/Jurado/EditarCuenta.php",
            type: "POST",
            cache: false,
            success: function (result){
                $("#contenedor").html(result);
                $("#Popup2").modal('show');
            }
        });

    });

    $(document).on('click', '#btnguardar', function(e){
        event.preventDefault();
        
        var img = imgAvatarSeleccionado.getAttribute("src"); 
                
        $.ajax({
            url: "../../Controlador/Jurado/CActualizarIcono.php",
            type: "POST",
            data: {img:img},
            cache: false,
            success:function (result){
                
                if(result.length == 0){
                    swal({
                        title: "Cambio realizado con éxito",
                        icon: "success",
                        closeOnClickOutside: false,
                    })
                    .then(() => {
                        location.reload();
                    });                      
                    $("#Popup1").modal('hide');
                    //location.reload();
                }else{
                    swal({
                        title: "Cambio no logrado",
                        icon: "error",
                        closeOnClickOutside: false,
                    });
                }
            }
        });
    });

    $(document).on('click', '#btncancelar', function(e){
        $("#Popup1").modal('hide');
        location.reload();
    
    });

});