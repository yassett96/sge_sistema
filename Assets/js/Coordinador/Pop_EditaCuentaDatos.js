$(document).ready(function () {

    $('#btnguardarc').click(function () {

        event.preventDefault();

        var tel = $("#NTel").val();
        var correo = $("#NEmail").val();
        

        console.log(tel);
        console.log(correo);
        //console.log(Idpersona);

        var formulario = document.MCuentaDatosC;

        if (formulario.NTel.value == "") {

            Swal.fire(
                'Advertencia',
                'Favor ingresar el Numero de telefono',
                'warning'
            )

            formulario.NTel.focus();
            return false;
        } else if (validartelefono(formulario.NTel.value) == false) {
            //document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"></a>No se permiten valores numericos </div>';
            Swal.fire(
                'Advertencia',
                'Formato de teléfono no válido',
                'warning'
            )

            formulario.NTel.value = "";
            formulario.NTel.focus();
            return false;
        }

        if (formulario.NEmail.value == "") {

            Swal.fire(
                'Advertencia',
                'Favor ingresar el Correo Electronico',
                'warning'
            )

            formulario.NEmail.focus();
            return false;
        } else if (validarCorreo(formulario.NEmail.value) == false) {
            //document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"></a>No se permiten valores numericos </div>';
            Swal.fire(
                'Advertencia',
                'Formato de correo no válido',
                'warning'
            )

            formulario.NEmail.value = "";
            formulario.NEmail.focus();
            return false;
        }

        $.ajax({
            url: "../../Controlador/Coordinador/CBuscarRegDatos.php",
            type: 'POST',
            data: { Telefono: tel, Email : correo },
            cache: false,
            success: function (result) {

                if (result.length == 0) {
                    $.ajax({
                        url: "../../Controlador/Coordinador/CUdpCuentaDatos.php",
                        type: "POST",
                        data: { tel: tel,email:correo},
                        cache: false,
                        success: function (result) {
                            console.log(result);
                            
                            if (result.length == 0) {
                                Swal.fire({
                                    title: 'Exito',
                                    text: 'Dato Actualizado correctamente',
                                    icon: 'success'
                                }).then(function () {
                                    location.reload();
                                });
                                $("#Pop_ECuenta").modal('hide');

                            }
                            else {
                                Swal.fire(
                                    'Error',
                                    'Ocurrio un problema, intenta nuevamente',
                                    'error'
                                )
                            }
                        }

                    });

                } else {
                    Swal.fire({
                        title: "Atención!",
                        text: result,
                        icon: "warning",
                    });
                }

            }
        });
    });


    $('#btncontra').click(function(){
        event.preventDefault();

        $.ajax({
            url: "../../Vista/Coordinador/Pop_EditaContra.php",
            type: "POST",
            cache: false,
            success:function (result){
                $("#contenedor").html(result);
                $("#Pop_ECuenta").modal('hide');
                $("#Pop_EContra").modal('show');
            }
        });
    
    });

    
    $(document).on('click', '#btncancelarc', function() {
        $('#Pop_ECuenta').modal('hide');
      
    
         location.reload();
        });


    $(document).on('click', '#Closedes', function() {
        $('#Pop_ECuenta').modal('hide');
      
    
         location.reload();
        });

    
});

function validartelefono(parametro) {
    //var patron1 = /^\d{8}$/;//00000000
    var patron1 = /^\d{4}-\d{4}$/;//0000-0000
    //0000 0000

    if (!patron1.test(parametro)) {
        return false;
    } else {
        return true;
    }
}

function validarCorreo(parametro) {
    var patron = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (!patron.test(parametro)) {
        return false;
    } else {
        return true;
    }
} 