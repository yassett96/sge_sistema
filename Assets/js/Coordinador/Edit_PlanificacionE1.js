$(document).ready(function () {
    $("#btnAgregarComision").click(function () {
        event.preventDefault();
    
        /*ComisionE = $("#NombreE").val();
        console.log(ComisionE)*/
    
        $.ajax({
          url: "../../Vista/Coordinador/Pop_AgregarLugar.php",
          type: "POST",
          cache: false,
          success: function (result) {
            $("#contenedor").html(result);
            $("#Pop_AL").modal('show');
            //$("#NombreComision").val(ComisionE);
    
          }
        });
      });
    $(document).on('click', '#btnActDatosG', function (e) {

        event.preventDefault();

        let fichero = $('#LogoE')[0].files[0];
        let NombreFeria = $("#NombreE").val();
        let EsloganFeria = $("#EsloganE").val();
        let HoraE = $("#HoraE").val();
        let FechaE = $("#FechaE").val();
        let LugarE = $("#LugarE").val();

        //let nombre = fichero.name;
        //let tipofile = fichero.type;

        let datos = new FormData();
        datos.append('tFile', fichero);
        datos.append('tNombreE', NombreFeria);
        datos.append('tEsloganE', EsloganFeria);
        datos.append('tHoraE', HoraE);
        datos.append('tFechaE', FechaE);
        datos.append('tLugarE', LugarE);

        //console.log(nombre);
        console.log(NombreFeria);
        console.log(EsloganFeria);
        console.log(HoraE);
        console.log(FechaE);
        console.log(LugarE);


        var formulario1 = document.Editar_DGF_E1;

        if (formulario1.NombreE.value == "") {


            Swal.fire(
                'Advertencia',
                'Favor ingresar el nombre de la feria',
                'warning'
            )

            formulario1.NombreE.focus();
            return false;
        } else if (validarletrasynum(formulario1.NombreE.value) == false) {
            Swal.fire(
                'Advertencia',
                'Solo se permiten caracteres alfanumericos, coma, guion, guion bajo, punto y espacio ',
                'warning'
            )
            formulario1.NombreE.focus();
            return false;
        }

        if (formulario1.EsloganE.value == "") {


            Swal.fire(
                'Advertencia',
                'Favor ingresar el eslogan de la feria',
                'warning'
            )

            formulario1.EsloganE.focus();
            return false;
        } else if (validarletrasynum(formulario1.EsloganE.value) == false) {
            Swal.fire(
                'Advertencia',
                'Solo se permiten caracteres alfanumericos, coma, guion, guion bajo, punto y espacio ',
                'warning'
            )
            formulario1.EsloganE.focus();
            return false;
        }
        if (formulario1.FechaE.value == "") {


            Swal.fire(
                'Advertencia',
                'Favor ingresar un fecha temporal',
                'warning'
            )

            formulario1.FechaE.focus();
            return false;
        }
        else if (new Date(formulario1.FechaE.value) < new Date()) {


            Swal.fire(
                'Advertencia',
                'La fecha debe ser mayor o igual a la fecha actual',
                'warning'
            )

            formulario1.FechaE.focus();
            return false;
        }

        if (formulario1.LugarE.value == "Seleccione el lugar del evento") {


            Swal.fire(
                'Advertencia',
                'Favor ingresar El lugar del evento',
                'warning'
            )

            formulario1.LugarE.focus();
            return false;

        } else {

        }

        $.ajax({
            type: "POST",
            url: "../../Controlador/Coordinador/CUpd_DGE1.php",
            data: datos,
            cache:false,
            contentType: false,
            processData: false,

            success: function (result) {
                if (result.length == 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Error innesperado",
                    text: "",
                    showConfirmButton: true,
                });
            } else {
                Swal.fire({
                    icon: "sucess",
                    title: "Datos Actualizados Exitosamente",
                    text: "",
                    timer:5000,
                    showConfirmButton: false,
                });
                window.location = "../../Vista/Coordinador/Planificacion_Feria_CE.php";
            }
            }
        });
    });
});
$(document).on('click', '#btnCancelarR', function (e) {

    event.preventDefault();

    Swal.fire({
        customClass: {
            confirmButton: 'swalBtnColor',
        },
        text: " ¿Desea realmente cancelar la actualización?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
    })
        .then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../../Vista/Coordinador/Planificacion_Feria_CE.php";
            }
        });
});

// $('#HoraE').attr('step', '60'); // Establece el paso en 60 segundos (1 minuto)

$('#HoraE').on('input', function() {
    var valor = $('#HoraE').val().split(':');
    var horaSinSegundos = valor[0] + ':' + valor[1];
    $('#HoraE').val(horaSinSegundos);
  });

// $('#HoraE').on('focus', function() {
//     var valor = $(this).val().split(':');
//     var horaSinSegundos = valor[0] + ':' + valor[1];
//     $(this).attr('type', 'text').val(horaSinSegundos).attr('type', 'time');
//   });
// $('#HoraE').inputmask('99:99', {placeholder: 'hh:mm'});
    

function validarletrasynum(parametro) {
    var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.\-_,]+$/;

    if (parametro.search(patron)) {
        return false;
    } else {
        return true;
    }

}