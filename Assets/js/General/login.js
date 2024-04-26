$(document).ready(function () {
    

    $('#botonV').click(function () {

        event.preventDefault();

        if ($("#usuarioD").val() != "" && $("#contraD").val() != ""){
            
            var User = $("#usuarioD").val();
            var Pass = $("#contraD").val();

            //console.log(User);
            //console.log(Pass);

            $.ajax({
                url: "../../Controlador/General/CInicio_sesion.php",
                type: "POST",
                data: {usuarioD:User,contraD:Pass},
                datatype : 'json',
                cache: false,
                success: function (data) {


                    if("OK" == data.status) {

                        $("#menuAcceso").html(data.lista);
                        $("#menuAcceso").prop('disabled', false);
                        $("#botonIS").prop('disabled', false);

                    }else {
                        swal("",JSON.parse(data).mensaje,"error")
                        .then(() => {
                            window.location.assign(JSON.parse(data).Location);
                        });
                    }
                }
                
            });


        }else if($("#usuarioD").val() == ""){
            document.getElementById("msgU-error").innerHTML = '<img class="icono-error" id="IU-error" src="../../Assets/imagenes/Recursos/error.png" alt=""> <label class="error" for="name" id="U_error">Completa este campo</label>';
            $("#usuarioD").focus();
        }else if($("#contraD").val() == ""){
            document.getElementById("msgC-error").innerHTML = '<img class="icono-error" id="IC-error" src="../../Assets/imagenes/Recursos/error.png" alt=""> <label class="error" for="name" id="C_error">Completa este campo</label>';
            $("#contraD").focus();
        }
    });     

    
    $('#botonIS').click(function () {

        event.preventDefault();

        if ($("#menuAcceso").val() != ""){
        
            let v1 = $("#menuAcceso").val();       

            $.ajax({
                url: "../../Controlador/General/CSesionLogin.php",
                type: "POST",
                data: {menuAcceso: v1},
                datatype : 'json',
                cache: false,
                success: function (data) {

                    var respuesta = JSON.parse(data);

                    if ("OK" == respuesta.status) {
                        // en realidad con el error tambien damos un Location (index.php),
                        // pero por el momento sólo redireccionamos si todo OK
                        window.location.assign(respuesta.Location);
                        //var mens = respuesta.mensaje;
                    }else{
                        swal(respuesta.mensaje)
                        .then(() => {
                            window.location.assign(respuesta.Location);
                        });
                    }
                    
                }
            });

        }else if($("#menuAcceso").val() == ""){
            document.getElementById("msgS-error").innerHTML = '<img class="icono-errorS" id="IC-error" src="../../Assets/Imagenes/error.png" alt=""> <label class="errorS" for="name" id="S_error">Seleccione un elemento de la lista</label>';
        }
    });    


    $('#buttonIS2').click(function () {

        event.preventDefault();

        if ($("#usuarioE").val() != "" && $("#contraE").val() != ""){
            
            var User = $("#usuarioE").val();
            var Pass = $("#contraE").val();
            
            console.log(User);
            console.log(Pass);
            
            $.ajax({
                url: "../../Controlador/Participante/CSesionLoginP.php",
                type: "POST",
                data: {usuarioE:User,contraE:Pass},
                datatype : 'json',
                cache: false,
                success: function (data) {                    
                    var respuesta = JSON.parse(data);

                    if("OK" == respuesta.status){ 
                        window.location.assign(respuesta.Location);
                        
                    }else {
                        swal("",respuesta.mensaje, "error")
                        .then(() => {
                            window.location.assign(respuesta.Location);
                        });
                    } 
                    
                }
            
            });

        }else if($("#usuarioE").val() == ""){
            document.getElementById("msgUE-error").innerHTML = '<img class="icono-error" id="IC-error" src="../../Assets/imagenes/Recursos/error.png" alt=""> <label class="error" for="name" id="UE_error">Completa este campo</label>';
            $("#usuarioE").focus();            

        }else if($("#contraE").val() == ""){
            document.getElementById("msgCE-error").innerHTML = '<img class="icono-error" id="IC-error" src="../../Assets/imagenes/Recursos/error.png" alt=""> <label class="error" for="name" id="CE_error">Completa este campo</label>';
            $("#contraE").focus();
            return false;
        }
    });

    //Para ocultar y mostrar mensaje
    $("#usuarioD").click(function(){
        $("#mensaje").hide();
    });

    $("#paraocultar").click(function(){
        $("#mensaje").hide();
    });

    $("#ocultar").click(function(){
        $("#mensaje").hide();
    });

    $("#paramostrar").click(function(){
        $("#mensaje").show();
    });
    
});

function Ocultarmensaje(){
    document.getElementById("msgU-error").innerHTML = "";
    document.getElementById("msgC-error").innerHTML = "";
    document.getElementById("msgS-error").innerHTML = "";
    document.getElementById("msgUE-error").innerHTML = "";
    document.getElementById("msgCE-error").innerHTML = "";
}

//mostrar y ocultar la contraseña
document.querySelector('.M1').addEventListener('click', e => {
    const passwordInput = document.querySelector('#contraD');
    
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
    const passwordInput = document.querySelector('#contraE');
    
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
    const passwordInput = document.querySelector('#contraG');
    
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

//activar el botón con un enter
document.getElementById("contraD").addEventListener("keyup", function(e){
    if (e.keyCode === 13){
        document.getElementById("botonV").click();
    }
});

document.getElementById("menuAcceso").addEventListener("keyup", function(e){
    if (e.keyCode === 13){
        document.getElementById("botonIS").click();
    }
});

document.getElementById("contraE").addEventListener("keyup", function(e){
    if (e.keyCode === 13){
        document.getElementById("buttonIS2").click();
    }
});