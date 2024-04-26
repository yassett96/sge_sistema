$(document).ready(function() {

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

    
    $(document).on('click', '#btnGuardarDatosG', function(e){

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
        datos.append('tFechaE',FechaE );
        datos.append('tLugarE',LugarE);

        //console.log(nombre);
        console.log(NombreFeria);
        console.log(EsloganFeria);
        console.log(HoraE);
        console.log(FechaE);
        console.log(LugarE);


        var formulario = document.DatosGeneralesFeriaE1;
        
    if( formulario.NombreE.value == ""){
        
        
        Swal.fire(
            'Advertencia',
            'Favor ingresar el nombre de la feria',
            'warning'
          )

        formulario.NombreE.focus();
        return false;
    }
    else if (validarletrasynum(formulario.NombreE.value) == false){
        Swal.fire(
            'Advertencia',
            'Solo se permiten caracteres alfanumericos, coma, guion, guion bajo, punto y espacio ',
            'warning'
        )
        formulario.NombreE.focus();
        return false;
    }

    if( formulario.EsloganE.value == ""){
        

        Swal.fire(
            'Advertencia',
            'Favor ingresar el eslogan de la feria',
            'warning'
          )
         
        formulario.EsloganE.focus();
        return false;
    }else if (validarletrasynum(formulario.EsloganE.value) == false){
        Swal.fire(
            'Advertencia',
            'Solo se permiten caracteres alfanumericos, coma, guion, guion bajo, punto y espacio ',
            'warning'
        )
        formulario.EsloganE.focus();
        return false;
    }

    if( formulario.FechaE.value == ""){
       

        Swal.fire(
            'Advertencia',
            'Favor ingresar un fecha temporal',
            'warning'
          )
         
        formulario.FechaE.focus();
        return false;
    }
    else if (new Date(formulario.FechaE.value) < new Date()) {
        
    
        Swal.fire(
            'Advertencia',
            'La fecha debe ser mayor o igual a la fecha actual',
            'warning'
        )
    
        formulario.FechaE.focus();
        return false;
    }

    if (formulario.LugarE.value == "Seleccione el lugar del evento"){
        
        
        Swal.fire(
            'Advertencia',
            'Favor ingresar El lugar del evento',
            'warning'
          )

        formulario.LugarE.focus();   
        return false;
    
    }else{
        document.getElementById("Alerta").innerHTML = "";
    }

        $.ajax({
            type: "POST",
            url: "../../Controlador/Coordinador/CPlanificacionE1.php",
            data: datos,
            contentType: false,
            processData: false,

            success: function(result) {
                if(result.length !==0  ){
                    
                      Swal.fire({
                        customClass: {
                          confirmButton: 'swalBtnColor',
                        },
                        title: "Evento Creado Exitosamente",
                        text: " ¿Desea continar con la planificación?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No',
                      })
                      .then((result) => {
                        if (result.isConfirmed) {
                         window.location.href = "../../Vista/Coordinador/Planificacion_Feria_CE.php";
                        } else {
                            window.location.href = "../../Vista/Coordinador/Admin_Feria_CE.php";
                        }
                      });                }
                else{
                    swal("No Logrado")
                }
            }
        });
    });

    $(document).on('click', '#btnCancelarR', function(e){

        event.preventDefault();
    
        Swal.fire({
            customClass: {
              confirmButton: 'swalBtnColor',
            },
            text: " ¿Desea realmente cancelar el registro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
          })
          .then((result) => {
            if (result.isConfirmed) {
             window.location.href = "../../Vista/Coordinador/Planificacion_Feria.php";
            }
        });
    });
});

function validarletrasynum(parametro){
    var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.\-_,]+$/;
    if(parametro.search(patron)){
        return false;
    }else{
        return true;
    }

}


//Swal.fire('Favor ingresar el nombre de la feria');
        //swal("Favor ingresar el nombre de la feria"); 