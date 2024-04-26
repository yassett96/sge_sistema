$(document).ready(function() {

    $('#EnviarSol').click(function(){

        var DE_ComisionAsig = $("#ComisionesAsig").val();
        var Id_N_ComisionAsig = $("#ComisionesAsig option:selected").text();
        var PARA_IdComisionEv =  $("#ComisionPara").val();
        var AsuntoC = $("#AsuntoConsulta").val();
        var MensajeC = $("#MsjConsulta").val();
        var ValorID = $("#Id_Per").val();

        
        if (PARA_IdComisionEv  == "Seleccione una comisión") {

            Swal.fire(
                'Advertencia',
                'Debe seleccionar una comisión',
                'warning'
            )
            die();
        }

        var formulario = document.ModalRealizarSolE;

        if (formulario.AsuntoConsulta.value == "") {

            Swal.fire(
                'Advertencia',
                'Favor ingresar el asunto de la consulta',
                'warning'
            )

            formulario.AsuntoConsulta.focus();
            return false;
        } else if (validarletrasN(formulario.AsuntoConsulta.value) == false) {

            Swal.fire(
                'Advertencia',
                'Solo se permiten caracteres alfanuméricos, coma, guion, guion bajo, punto y espacio ',
                'warning'
            )

            formulario.AsuntoConsulta.value = "";
            formulario.AsuntoConsulta.focus();
            return false;
        }

        if (formulario.MsjConsulta.value == "") {

            Swal.fire(
                'Advertencia',
                'Favor ingresar el Mensaje',
                'warning'
            )

            formulario.MsjConsulta.focus();
            return false;
        } else if (validarletrasN(formulario.MsjConsulta.value) == false) {

            Swal.fire(
                'Advertencia',
                'Solo se permiten caracteres alfanuméricos, coma, guion, guion bajo, punto y espacio ',
                'warning'
            )

            formulario.MsjConsulta.value = "";
            formulario.MsjConsulta.focus();
            return false;
        }

        $.ajax({
            url: "../../Controlador/Coordinador/CRealizarSolicitudE.php",
            type: "POST",
            data: {Envia:DE_ComisionAsig,NComision:Id_N_ComisionAsig,ParaD:PARA_IdComisionEv,Asunto:AsuntoC,Contenido:MensajeC,IDP:ValorID},
            cache: false,
            success:function (result){
                console.log(result);
                if(result.length != 0){
                    Swal.fire(
                        'Exito',
                        'Tu consulta ha sido enviada, recibirás una respuesta en tu correo en un tiempo considerable',
                        'success'
                    )
                    
                    $("#Pop_RSolExtra").modal('hide');
                    
                    }
                    else{
                        Swal.fire(
                            'Advertencia',
                            'Sucedio un problema, intenda en unos momentos, de lo contratio notifica al Admin del sistema',
                            'warning'
                        )
                    }
            }
        });



    });

    function validarletrasN(parametro) {
        var patron = /[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.\- _"“”,]+$/;
        if (parametro.search(patron)) {
            return false;
        } else {
            return true;
        }
    }
});