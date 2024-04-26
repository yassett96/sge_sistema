$(document).ready(function(){

    $('#botonguardar').click(function(){
        event.preventDefault();

        //var id = $("#id").val();
        var ncontra = $("#npass").val();
        var ccontra = $("#cpass").val();

        if(ncontra == ""){
            document.getElementById("msgnc-error").innerHTML = '<div class="alert alert-danger" id="alerta">Completa el campo</div>';
            $('#npass').focus();
        }else if(validacontra(ncontra) == false){
            document.getElementById("msgv-error").innerHTML = '<div class="alert alert-danger">Formato de Contraseña no válido. Su contraseña debe contener de 8 a 16 caracteres que incluyan al menos una letra Mayúscula, una minúscula, un número y un caracter especial.</div>';
            $('#npass').focus();
        }else if(ccontra == ""){
            document.getElementById("msgcc-error").innerHTML = '<div class="alert alert-danger" id="alerta">Completa el campo</div>';
            $('#cpass').focus();
        }else{
            $.ajax({
                url: "../../Controlador/Participante/CEditarContra.php",
                type: "POST",
                data: {npass:ncontra, cpass:ccontra},
                datatype : 'json',
                cache: false,
                success: function(data){

                    var respuesta = JSON.parse(data);
                            
                    if(respuesta.status == "OK"){
                        swal(respuesta.mensaje, "");
                        $("#Popup3").modal('hide');
                        $(".modal-backdrop").hide();
   
                    }else if(respuesta.status == "ERR"){
                        swal(respuesta.mensaje, "");
                    }
                } 
            });     
        }
    });

    $('#botoncancelar').click(function(){
        event.preventDefault();

        $("#Popup3").modal('hide');
        location.reload();
    
    });

});

function Ocultarmensaje(){
    document.getElementById("msgnc-error").innerHTML = "";
    document.getElementById("msgv-error").innerHTML = "";
    document.getElementById("msgcc-error").innerHTML = "";

}

function validacontra(parametro){
    var patron = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?_&\-])[A-Za-z\d$@$!%*?&\-]{8,16}$/;

    /* Explicacion:  
     Minimo 8 caracteres, maximo 16
     minimo una letra mayuscula
     minimo una letra minuscula
     minimo un digito
     minimo una caracter especial*/

    if(!patron.test(parametro)){
        return false;
    } else {
        return true;
    }
}

document.querySelector('.M2').addEventListener('click', e => {
    const passwordInput = document.querySelector('#npass');
    
    if (e.target.classList.contains('show')) {
        e.target.classList.remove('show');
        e.target.textContent = 'Ocultar';
        passwordInput.type = 'text';
    } else {
        e.target.classList.add('show');
        e.target.textContent = 'Mostrar';
        passwordInput.type = 'password';
    }

});

document.querySelector('.M3').addEventListener('click', e => {
    const passwordInput = document.querySelector('#cpass');
    
    if (e.target.classList.contains('show')) {
        e.target.classList.remove('show');
        e.target.textContent = 'Ocultar';
        passwordInput.type = 'text';
    } else {
        e.target.classList.add('show');
        e.target.textContent = 'Mostrar';
        passwordInput.type = 'password';
    }

});