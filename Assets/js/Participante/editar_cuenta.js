$(document).ready(function () {

    $('.btnguardarc').click(function () {
        event.preventDefault();

        var id = $("#idpar").val();
        var tel = $("#tel").val();
        var correo = $("#email").val();
        var cedula = $("#pCedula").val();
        var selecgrupo = $("#sgrupo").val();

        var vlocIdPersona = FunEjecutarAjax("../../Controlador/Participante/CEditarCuenta.php?vparBoolObtenerIdPersona=" + true);
        var vlocResultadoAjaxVerifTelefono = FunEjecutarAjax("../../Controlador/Participante/CEditarCuenta.php?vparTelRepetido=" + tel + "&vparIdPersonaRepetido=" + vlocIdPersona);
        var vlocResultadoAjaxVerifCorreo = FunEjecutarAjax("../../Controlador/Participante/CEditarCuenta.php?vparCorreoRepetido=" + correo + "&vparIdPersonaRepetido=" + vlocIdPersona);        
        var vlocResultadoAjaxVerifCedula = FunEjecutarAjax("../../Controlador/Participante/CEditarCuenta.php?vparCedulaRepetido=" + cedula + "&vparIdPersonaRepetido=" + vlocIdPersona);
        // alert("vlocIdPersona: " + vlocIdPersona);
        // alert("vlocResultadoAjaxVerifTelefono=" + vlocResultadoAjaxVerifTelefono);
        // alert("vlocResultadoAjaxVerifCorreo: " + vlocResultadoAjaxVerifCorreo);
        // alert("vlocResultadoAjaxVerifCedula: " + vlocResultadoAjaxVerifCedula);
        // alert("cedula: " + cedula);
        if (tel == "") {
            document.getElementById("msgt-error").innerHTML = '<div class="alert alert-danger">Completa el campo</div>';
            $('#tel').focus();
        } else if (validartelefono(tel) == false) {
            document.getElementById("msgt2-error").innerHTML = '<div class="alert alert-danger">Formato no válido</div>';
            $('#tel').focus();
        } else if (correo == "") {
            document.getElementById("msgc-error").innerHTML = '<div class="alert alert-danger">Completa el campo</div>';
            $('#email').focus();
        } else if (validarCorreo(correo) == false) {
            document.getElementById("msgc2-error").innerHTML = '<div class="alert alert-danger">Formato no válido</div>';
            $('#email').focus();
        } else if (selecgrupo == "") {
            document.getElementById("msgs-error").innerHTML = '<div class="alert alert-danger">Completa el campo</div>';
            $('#sgrupo').focus();
        } else if(vlocResultadoAjaxVerifTelefono > 0){
            funActivarAlerta("warning", "Registro ya existente!", "El teléfono que intenta ingresar ya se encuentra registrado!");
        } else if(vlocResultadoAjaxVerifCorreo > 0){
            funActivarAlerta("warning", "Registro ya existente!", "El correo que intenta ingresar ya se encuentra registrado!");
        }else if(vlocResultadoAjaxVerifCedula > 0){
            funActivarAlerta("warning", "Registro ya existente!", "La cédula que intenta ingresar ya se encuentra registrado!");
        }else{
            $.ajax({
                url: "../../Controlador/Participante/CEditarCuenta_tel.php",
                type: "POST",
                data: { idpar: id, tel: tel, email: correo, sgrupo: selecgrupo },
                cache: false,
                success: function (result) {
                    // alert(result);
                    // if (result.length == 0) {
                    
                        $.ajax({
                            url: "../../Controlador/Participante/CEditarCuenta_Correo.php",
                            type: "POST",
                            data: { idpar: id, tel: tel, email: correo, sgrupo: selecgrupo, cedula: cedula },
                            cache: false,
                            success: function (result) {
                                // alert(result);
                                // if (result.length == 0) {
                                    // swal("Datos actualizados correctamente", "");
                                    FunActivarAlertaBotonConfirmacion("Edición completa!", "Se han actualizado los datos del participante", "success", false, "Ok!", "");
                                    $("#Popup2").modal('hide');

                                    setTimeout(function(){location.reload()}, 1500);

                                // } else {
                                //     swal(result, "");

                                // }
                            }
                            });

                    // } else {
                    //     swal(result, "");

                    // }

                }

            });


        }
    });

    $('.btncancelarc').click(function () {
        event.preventDefault();

        $("#Popup2").modal('hide');
        location.reload();

    });

    $('.btncontra').click(function () {
        event.preventDefault();

        $.ajax({
            url: "../../Vista/Participante/EditarContra.php",
            type: "POST",
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
                $("#Popup2").modal('hide');
                $("#Popup3").modal('show');
            }
        });

    });
});

function Ocultarmensaje() {
    document.getElementById("msgt-error").innerHTML = "";
    document.getElementById("msgt2-error").innerHTML = "";
    document.getElementById("msgc-error").innerHTML = "";
    document.getElementById("msgc2-error").innerHTML = "";
    document.getElementById("msgs-error").innerHTML = "";

}

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