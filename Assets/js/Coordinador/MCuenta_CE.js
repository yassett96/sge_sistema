$(document).ready(function(){

    $(document).on("click", "#editaravatar", function(e){
        $.ajax({
            url: "../../Vista/Coordinador/EditarIcono.php",
            type: "POST",
            cache: false,
            success:function (result){
                $("#contenedor").html(result);
                $("#Pop_EditaIcono").modal('show');
            }
        });
    
    });

    $(document).on('click', '#btnguardar', function(e){
        event.preventDefault();
        
        var img = imgAvatarSeleccionado.getAttribute("src"); 
                
        $.ajax({
            url: "../../Controlador/Coordinador/CActualizarIcono.php",
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
                    $("#Pop_EditaIcono").modal('hide');
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
        $("#Pop_EditaIcono").modal('hide');
        location.reload();
    
    });



    $('#editardatos').click(function(){
        $.ajax({
            url: "../../Vista/Coordinador/Pop_EditaCuenta.php",
            type: "POST",
            cache: false,
            success: function (result){
                $("#contenedor").html(result);
                $("#Pop_ECuenta").modal('show');
            }
        });

    });
});