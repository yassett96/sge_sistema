$(document).ready(function () {

    function validarExtension() {
        var archivo = document.getElementById('ReporteF').value;
        var extension = archivo.substring(archivo.lastIndexOf('.') + 1).toLowerCase();

        if (extension === "pdf" || extension === "xlsx") {
            // La extensión es válida, puedes enviar el formulario
            console.log()
        } else {
            // La extensión no es válida, muestra un mensaje de error y no envíes el formulario
            alert("Por favor, selecciona un archivo .pdf o .xlsx válido.");
            return false;
        }
    }



    $('#EnviarRFC').click(function () {

        event.preventDefault();

        var NombreFeria = $("#NombreReporte").val();
        var fichero = $('#ReporteF')[0].files[0];
        //var IDComisionAsig = $("#ComisionesAsig").val();

        var formulario = document.ModalSubirReporteF;

        if (formulario.NombreReporte.value == "") {


            Swal.fire(
                'Advertencia',
                'Favor ingresar el nombre del reporte a subir',
                'warning'
            )

            formulario.NombreReporte.focus();
            return false;
        } else if (validarTexto(formulario.NombreReporte.value) == false) {

            Swal.fire(
                'Advertencia',
                'Solo se permiten caracteres alfanuméricos, coma, guion, guion bajo, punto y espacio',
                'warning'
            )

            formulario.NombreReporte.focus();
            return false;

        }
        if (formulario.ReporteF.value == "") {


            Swal.fire(
                'Advertencia',
                'Favor de seleccionar el archivo a subir',
                'warning'
            )

            formulario.ReporteF.focus();
            return false;
        }

        let extension = fichero.name.split('.').pop().toLowerCase();

        if (extension === 'pdf' || extension === 'xlsx') {

            var datos = new FormData();
            datos.append('tFile', fichero);
            datos.append('tNombreRF', NombreFeria);
            datos.append('tComision', ComisionAsig);
            //console.log(NombreFeria);

        } else {
            Swal.fire(
                'Advertencia',
                'Por favor, selecciona un archivo .pdf o .xlsx válido.',
                'warning'
            )
        }


        $.ajax({
            type: "POST",
            url: "../../Controlador/Coordinador/CReporteFinal.php",
            data: datos,
            contentType: false,
            processData: false,
            cache: false,
            success: function (result) {

                //alert(result);

                if (result == 1) {

                    Swal.fire({
                        title: 'Exito',
                        text: 'Reporte subido correctamente',
                        icon: 'success',
                        timer: 3000, // Tiempo de duración en milisegundos (3 segundos)
                        timerProgressBar: false, // Muestra una barra de progreso durante el tiempo de duración
                        showConfirmButton: false // No muestra el botón de confirmación
                    });

                    $("#Pop_SubirRFinal").modal('hide');

                    //ComisionAsig = $("#ComisionesAsig").val();
                    $.ajax({
                        url: "../../Controlador/Coordinador/CCargarActividadComision_VS.php",
                        type: "POST",
                        data: { ComisionASel: ComisionAsig },
                        cache: false,
                        success: function (result) {
                            //alert(result);


                            $("#TActividades tbody").html(result);

                            $.ajax({
                                url: "../../Controlador/Coordinador/CCargarIntegrantesComision.php",
                                type: "POST",
                                data: { ComisionASel: ComisionAsig },
                                cache: false,
                                success: function (result) {
                                    //alert(result);


                                    $("#TIntegrantesC tbody").html(result);

                                    //ComisionAsig = $("#ComisionesAsig").val();
                                    //ValorID = $("#Id_Per").val();

                                    var btnSubirReporte = document.getElementById("btnSubirReporteF");
                                    var btnDescargarRFC = document.getElementById("btnDescargarRFC");
                                    var btnActividad = document.getElementById("btnAgregarActividad");
                                    var btnEliminarRFC = document.getElementById("btnEliminarRFC");

                                    $.ajax({
                                        url: "../../Controlador/Coordinador/CCargarResponsablesComisionA.php",
                                        type: "POST",
                                        data: { ComisionASel: ComisionAsig },
                                        cache: false,
                                        success: function (result) {
                                            var data = JSON.parse(result);
                                            if (data.includes(ValorID)) {

                                                btnSubirReporte.style.display = "none";
                                                btnActividad.style.display = "none";
                                                btnDescargarRFC.style.display = "block";
                                                btnEliminarRFC.style.display = "block";
                                            } else {

                                                btnSubirReporte.style.display = "block";
                                                btnActividad.style.display = "block";
                                                btnDescargarRFC.style.display = "none";
                                                btnEliminarRFC.style.display = "none";


                                            }
                                        }
                                    });

                                }
                            });
                        }
                    });
                }
                else {
                    swal("No Logrado")
                }

            }
        });



    });

    function validarTexto(parametro) {
        //var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\.\-_",]+$/;
        //var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.-_"“”,]+$/;
        //var patron = /[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.\ – _"“”,]+$/; con espacio guion espacion
        var patron = /[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.\- _"“”,]+$/;

        if (parametro.search(patron)) {
            return false;
        } else {
            return true;
        }

    }
});