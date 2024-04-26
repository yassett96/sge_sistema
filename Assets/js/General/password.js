$(document).ready(function (){

    $('#btnGuardar').click(function(){
        event.preventDefault();

        var codigo = $("#cod").val();
        var pass1 = $("#ncontra").val();
        var pass2 = $("#ccontra").val();

        if(pass1 == ""){
            document.getElementById("msgN-error").innerHTML = '<img class="icono-error" id="C-error" src="../../Assets/imagenes/Recursos/error.png" alt=""> <label class="error" for="name" id="N_error">Completa este campo</label>';
            $("#ncontra").focus();
        }else if(validacontra(pass1) == false){
            document.getElementById("msg-error").innerHTML = '<div class="alert alert-danger">Formato de Contraseña no válido. Su contraseña debe contener de 8 a 16 caracteres que incluyan al menos una letra Mayúscula, una minúscula, un número y un caracter especial.</div>';
            $("#ncontra").focus();
        }else if(pass2 == ""){
            document.getElementById("msgC-error").innerHTML = '<img class="icono-error" id="C-error" src="../../Assets/imagenes/Recursos/error.png" alt=""> <label class="error" for="name" id="C_error">Completa este campo</label>';
            $("#ccontra").focus();
        }else{
            $.ajax({
                url: "../../Controlador/General/CNuevaContra.php",
                type: "POST",
                data: {cod:codigo, ncontra:pass1, ccontra:pass2},
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
                        swal(respuesta.mensaje) 
                        .then(() => {
                            window.location.assign(respuesta.Location);
                        });
                    }
                } 
            });     
        }
    });

});

function Ocultarmensaje(){
    document.getElementById("msgN-error").innerHTML = "";
    document.getElementById("msgC-error").innerHTML = "";
    document.getElementById("msg-error").innerHTML = "";

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

document.querySelector('.M1').addEventListener('click', e => {
    const passwordInput = document.querySelector('#ncontra');
    
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

document.querySelector('.M2').addEventListener('click', e => {
    const passwordInput = document.querySelector('#ccontra');
    
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
