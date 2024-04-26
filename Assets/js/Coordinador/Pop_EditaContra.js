$(document).ready(function () {

    $('#btnguardarc').click(function () {

        event.preventDefault();

        var ncontra = $("#npass").val();
        var ccontra = $("#cpass").val();


        console.log(ncontra);
        console.log(ccontra);
        //console.log(Idpersona);



        var formulario = document.MContraE;

        if (formulario.npass.value == "") {

            Swal.fire(
                'Advertencia',
                'Favor de completar el campo',
                'warning'
            )

            formulario.npass.focus();
            return false;
        } else if (validacontra(formulario.npass.value) == false) {
            Swal.fire(
                'Advertencia',
                'Formato de Contraseña no válido. Su contraseña debe contener de 8 a 16 caracteres que incluyan al menos una letra Mayúscula, una minúscula, un número y un caracter especial.',
                'warning'
            )

            formulario.npass.value = "";
            formulario.npass.focus();
            return false;
        }

        if (formulario.cpass.value == "") {

            Swal.fire(
                'Advertencia',
                'Favor de completar el campo de contraseña',
                'warning'
            )

            formulario.cpass.focus();
            return false;
        }

        $.ajax({
            url: "../../Controlador/Coordinador/CUdpContra.php",
            type: "POST",
            data: { npass: ncontra, cpass: ccontra },
            datatype: 'json',
            cache: false,
            success: function (data) {

                var respuesta = JSON.parse(data);

                if (respuesta.status == "OK") {
                    Swal.fire(
                        'Advertencia',
                        respuesta.mensaje,
                        "warnig"
                    )

                    $("#Pop_EContra").modal('hide');
                    $(".modal-backdrop").hide();

                } else if (respuesta.status == "ERR") {
                    //swal(respuesta.mensaje, "");
                    Swal.fire(
                        'Advertencia',
                        respuesta.mensaje,
                        "error"
                    )
                }
            }
        });


    });

    
    $(document).on('click', '#btncancelarc', function () {
        $("#Pop_EContra").modal('hide');
        location.reload();
    });




    $(document).on('click', '#ClosedesC', function () {
        $("#Pop_EContra").modal('hide');
        location.reload();
    });
});

function validacontra(parametro) {
    var patron = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?_&\-])[A-Za-z\d$@$!%*?&\-]{8,16}$/;

    /* Explicacion:  
     Minimo 8 caracteres, maximo 16
     minimo una letra mayuscula
     minimo una letra minuscula
     minimo un digito
     minimo una caracter especial*/

    if (!patron.test(parametro)) {
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