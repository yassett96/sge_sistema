$(document).ready(function(){

    $('#botonenviar').click(function(){
        event.preventDefault();
        
        var email = $("#txtCorreo").val();
       
        if(email == "" ){
            document.getElementById("msgC-error").innerHTML = '<img class="icono-error" id="C-error" src="../../Assets/Imagenes/error.png" alt="">  <label class="error" for="name" id="E_error">Completa este campo</label>';
            $("#txtCorreo").focus();
        
        }else if(validarCorreo(email) == false){
            document.getElementById("msgI-error").innerHTML = '<img class="icono-error" id="C-error" src="../../Assets/Imagenes/error.png" alt="">  <label class="error" for="name" id="E_error">Ingrese un correo válido</label>';
            email = "";
            $("#txtCorreo").focus();
        }else{
            $.ajax({
                url: "../../Controlador/General/CCodigo.php",
                type: "POST",
                data: {txtCorreo:email},
                datatype : 'json',
                cache: false,
                success: function(data){

                    var respuesta = JSON.parse(data);
                        
                        if(respuesta.status == "OK"){
                            swal(respuesta.mensaje)
                            .then(() => {
                                window.location.assign(respuesta.Location);
                            });    
                        }else if(respuesta.status == "ERR"){
                            swal(respuesta.mensaje);
                            
                            
                        }
                }      
            });
        }   
        
    });
});

function Ocultarmensaje(){
    document.getElementById("msgC-error").innerHTML = "";
    document.getElementById("msgI-error").innerHTML = "";
}    

function validarCorreo(parametro){
    var patron = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if(!patron.test(parametro)){
        return false;
    }else{
        return true;
    }
}