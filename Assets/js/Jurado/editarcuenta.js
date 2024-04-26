$(document).ready(function(){

    $('.btnguardarc').click(function(){
        event.preventDefault();

        var tel = $("#tel").val();
        var correo = $("#email").val();

        if(tel == ""){
            document.getElementById("msgt-error").innerHTML = '<div class="alert alert-danger">Completa el campo</div>';
            $('#tel').focus();
        }else if(validartelefono(tel) == false){
            document.getElementById("msgt2-error").innerHTML = '<div class="alert alert-danger">Formato no válido</div>';
            $('#tel').focus();
        }else if(correo == ""){
            document.getElementById("msgc-error").innerHTML = '<div class="alert alert-danger">Completa el campo</div>';
            $('#email').focus();
        }else if(validarCorreo(correo) == false){
            document.getElementById("msgc2-error").innerHTML = '<div class="alert alert-danger">Formato no válido</div>';
            $('#email').focus();
        }else {
            $.ajax({
                url: "../../Controlador/Jurado/CEditarCuenta.php",
                type: "POST",
                data: {tel:tel, email:correo},
                cache: false,
                success: function(result){
                                
                    if(result.length == 0){
                        swal("Datos actualizados correctamente","");
                        $("#Popup2").modal('hide');        
                                    
                    }else{
                        swal(result,"");
                        
                    }
                }
                                
            });  

        }
    });

    $('.btncancelarc').click(function(){
        event.preventDefault();

        $("#Popup2").modal('hide');
        location.reload();
    
    });

    $('.btncontra').click(function(){
        event.preventDefault();

        $.ajax({
            url: "../../Vista/Jurado/EditarContra.php",
            type: "POST",
            cache: false,
            success:function (result){
                $("#contenedor").html(result);
                $("#Popup2").modal('hide');
                $("#Popup3").modal('show');
            }
        });
    
    });
});

function Ocultarmensaje(){
    document.getElementById("msgt-error").innerHTML = "";
    document.getElementById("msgt2-error").innerHTML = "";
    document.getElementById("msgc-error").innerHTML = "";
    document.getElementById("msgc2-error").innerHTML = "";
}

function validartelefono(parametro){
    //var patron1 = /^\d{8}$/;//00000000
    var patron1 = /^\d{4}-\d{4}$/;//0000-0000
    //0000 0000
    
    if(!patron1.test(parametro)){
        return false;
    } else {
        return true;
    }
}

function validarCorreo(parametro){
    var patron = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if(!patron.test(parametro)){
        return false;
    }else{
        return true;
    }
}