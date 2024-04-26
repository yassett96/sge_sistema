var barraProgreso;
$(document).ready(function () {

    $("#TActividades tbody").on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected')
        }
        else {
            $("#TActividades tr.selected").removeClass('selected');
            $(this).addClass('selected');
        }
    });

    console.log(ValorID);


    var btnSubirReporte = document.getElementById("btnSubirReporteF");
    var btnSubirPlan = document.getElementById("btnSubirPlan");
    var btnActividad = document.getElementById("btnAgregarActividad");
    var btnEliminarRFC = document.getElementById("btnEliminarRFC");



    console.log("IDComisionAsig : " + ComisionAsig);
    //console.log("NomrbreComision : " + NombreComisionAsig);
    $.ajax({
        url: "../../Controlador/Coordinador/CargarComisionesAsignadasID.php",
        type: "POST",
        data: { ID_VPer: ValorID },
        cache: false,
        success: function (result) {

            console.log(result);

            if (result.includes(ComisionAsig)) {

                $.ajax({
                    url: "../../Controlador/Coordinador/CCargarDatosTotalesAct.php",
                    type: "POST",
                    data: { ComisionASel: ComisionAsig },
                    cache: false,
                    success: function (result) {
                        var valoresT = JSON.parse(result);
                        var actividadesFinalizadas = valoresT[0].TotalActF;
                        var totalActividades = valoresT[0].TotalActT;

                        crearBarraProgreso(actividadesFinalizadas, totalActividades);

                        $.ajax({
                            url: "../../Controlador/Coordinador/CCargarResponsablesComisionA.php",
                            type: "POST",
                            data: { ComisionASel: ComisionAsig },
                            cache: false,
                            success: function (result) {
                                data = JSON.parse(result);
                                //alert("ID responsable:" + data);
                                if (data.includes(ValorID)) {
                                    //btnSubirReporte.style.display = "block";
                                    btnSubirPlan.style.display = "block";
                                    btnActividad.style.display = "block";
                                

                                    if (data.includes(ValorID)) {

                                        //alert("2; " + data);
                                        if (totalActividades > 0) {
                                            //alert("total actividades" + totalActividades);
                                            if (actividadesFinalizadas == totalActividades) {

                                                //alert("Actividades finalizadas ");

                                                btnSubirReporte.style.display = "block";
                                                //alert("Se activo bton reporte");

                                                $.ajax({
                                                    url: "../../Controlador/Coordinador/CBuscarReporteF.php",
                                                    type: "POST",
                                                    data: { ComisionASel: ComisionAsig },
                                                    cache: false,
                                                    success: function (result) {
                                                        //alert("Hay reporte en BD"+result)
                                                        if (result == 1) {

                                                            //alert("Hay reporte en BD");
                                                            if (data.includes(ValorID)) {

                                                                //alert("ID 3" + data);

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

                                                        //    alert(" NO Hay reporte en BD");


                                                    }
                                                });


                                            } else {

                                                //alert("Actividades NO finalizadas ");

                                                //alert("NO activo bton reporte");
                                                btnSubirReporte.style.display = "none";

                                                //alert("NO activo bton descarga");
                                                btnDescargarRFC.style.display = "none";

                                                //alert("NO activo bton eliminar");
                                                btnEliminarRFC.style.display = "none";



                                            }
                                        }
                                    }
                                } else {
                                    btnSubirReporte.style.display = "none";
                                    btnSubirPlan.style.display = "none";
                                    btnActividad.style.display = "none";






                                }
                            }







                        });
                    }
                });





            } else {
                $.ajax({
                    url: "../../Controlador/Coordinador/CCargarDatosTotalesAct.php",
                    type: "POST",
                    data: { ComisionASel: ComisionAsig },
                    cache: false,
                    success: function (result) {
                        var valoresT = JSON.parse(result);
                        var actividadesFinalizadas = valoresT[0].TotalActF;
                        var totalActividades = valoresT[0].TotalActT;

                        crearBarraProgreso(actividadesFinalizadas, totalActividades);
                    }
                });

            }

        }
    });
    function crearBarraProgreso(actividadesFinalizadas, totalActividades) {
        var porcentajeProgreso = (actividadesFinalizadas / totalActividades) * 100;
    
    
    
        if (isNaN(porcentajeProgreso)) {
            porcentajeProgreso = 0;
        }
    
    
        if (barraProgreso) {
            barraProgreso.destroy();
        }
    
        barraProgreso = new ProgressBar.Circle("#progress-bar-container", {
            color: "#66BB6A",
            strokeWidth: 6,
            trailWidth: 6,
            trailColor: "#f4f4f4",
            text: {
                value: Math.round(porcentajeProgreso) + "%",
                style: {
                    color: "#333",
                    position: "absolute",
                    top: "50%",
                    left: "50%",
                    transform: "translate(-50%, -50%)",
                    fontSize: "24px",
                    fontWeight: "bold"
                }
            }
        });
    
        barraProgreso.animate(porcentajeProgreso / 100);
    }



    $("#btnEditaCE").click(function () {

        event.preventDefault();

        var filasel = $(".selected");
        var IdComAct = $(filasel).closest('tr').find("input:hidden").val();



        if (typeof IdComAct === "undefined") {
            Swal.fire(
                'Advertencia',
                'Debe seleccionar una actividad',
                'warning'
            )
            die();

        }
        console.log(IdComAct);

        $.ajax({

            url: "../../Vista/Coordinador/Pop_DetComisionAsignada.php",
            type: "POST",
            data: { Id_ComAsig: IdComAct, /*NombreCat : nombreCategoriaEA, NombreSubC: nombreSubCateEA*/ },
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
                $('#Pop_DetComAct').modal('show');


            }
        });



    });

    $("#btnRealizarConsulta").click(function () {//Agregar Nueva categoria
        event.preventDefault();

        var Id_ComisionAsig = ComisionAsig;
        var Id_N_ComisionAsig = NombreComision;



        $.ajax({
            url: "../../Vista/Coordinador/Pop_RealizarSolictudE_VS.php",
            type: "POST",
            data: { NComisionAsig: Id_N_ComisionAsig, IDComisionAsig: Id_ComisionAsig },
            cache: false,
            success: function (result) {
                
                $("#contenedor").html(result);
                $("#Pop_RSolExtra").modal('show');

            }
        });
    });

    $("#btnVerSolicitudes").click(function () {//Agregar Nueva categoria
        event.preventDefault();

        //var ComisionAsig = ComisionAsig




        $.ajax({
            url: "../../Vista/Coordinador/Pop_DetSolicitudesR.php",
            type: "POST",
            data: { IDComisionAsig: ComisionAsig },
            cache: false,
            success: function (result) {
                //alert(result)
                $("#contenedor").html(result);
                $("#Pop_DetSolR").modal('show');
                //$("#NombreComision").val(ComisionE);

            }
        });
    });

    $("#btnEstadoActividad").click(function () {
        event.preventDefault();

        var filasel = $(".selected");
        var IdComAct = $(filasel).closest('tr').find("input:hidden").val();



        if (typeof IdComAct === "undefined") {
            Swal.fire(
                'Advertencia',
                'Debe seleccionar una actividad',
                'warning'
            )
            die();
            //alert("Debe seleccionar una actividad");

        }
        $.ajax({
            url: "../../Controlador/Coordinador/CControlEstadoAct.php",
            type: "POST",
            data: { Id_ComAsig: IdComAct },
            cache: false,
            success: function (result) {

                //console.log(result);

                if (result === "3") {
                    Swal.fire(
                        'Advertencia',
                        'No se puede actualizar el estado de la actividad, por que ya esta finalizada',
                        'warning'
                    )
                    die();
                }


                $.ajax({
                    url: "../../Vista/Coordinador/Pop_EditarEstadoAct_VS.php",
                    type: "POST",
                    data: { Id_ComAsig: IdComAct },
                    cache: false,
                    success: function (result) {
                        //alert(result)
                        $("#contenedor").html(result);
                        $("#Pop_EditarAct").modal('show');
                        //$("#NombreComision").val(ComisionE);

                    }
                });
            }
        });

    });

    $("#btnSubirPlan").click(function () {

        $.ajax({
            url: "../../Vista/Coordinador/Pop_DescargarReporte_VS.php",
            type: "POST",
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
                $("#Pop_DesRepo").modal('show');

            }
        });
    });

    $("#btnAgregarActividad").click(function () {//Agregar Nueva categoria
        event.preventDefault();


        //var IDComisionAsig = $("#ComisionesAsig").val();



        $.ajax({
            url: "../../Vista/Coordinador/Pop_AgregarActividad_VS.php",
            type: "POST",
            data: { ComisionASel: ComisionAsig },
            cache: false,
            success: function (result) {
                //alert(result)
                $("#contenedor").html(result);
                $("#Pop_AActividad").modal('show');
                //$("#NombreComision").val(ComisionE);

            }
        });
    });

    $("#btnSubirReporteF").click(function () {

        $.ajax({
            url: "../../Vista/Coordinador/Pop_SubirReporteFinal_VS.php",
            type: "POST",
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
                $("#Pop_SubirRFinal").modal('show');

            }
        });
    });

    $("#btnDescargarRFC").click(function () {
        //ComisionAsig = $("#ComisionesAsig").val();
        $.ajax({
            url: "../../Controlador/Coordinador/CObtenerURLReporteCS.php",
            type: "POST",
            data: { ComisionASel: ComisionAsig },
            cache: false,
            success: function (result) {

                console.log(result);

                var data = JSON.parse(result); // Parsear la respuesta JSON en un array




                if (data.length > 0) {
                    var nombreArchivo = data[0].Nombre;
                    var urlArchivo = data[0].URL; // Supongamos que la URL está en el primer elemento del array

                    // Descargar el archivo
                    var downloadLink = document.createElement('a');
                    downloadLink.href = urlArchivo;
                    downloadLink.download = nombreArchivo;
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    document.body.removeChild(downloadLink);
                }
            }
        });
    });

    $("#btnEliminarRFC").click(function () {

        Swal.fire({
            title: "¿Estás seguro de que deseas eliminar el reporte?",
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {

                //ComisionAsig = $("#ComisionesAsig").val();

                $.ajax({
                    url: "../../Controlador/Coordinador/CEliminarReporte.php",
                    type: "POST",
                    data: { ComisionASel: ComisionAsig },
                    cache: false,
                    success: function (result) {
                        if (result == 1) {
                            Swal.fire(
                                'Exito',
                                'Reporte eliminada correctamente',
                                'success'
                            )

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

                                                        btnSubirReporte.style.display = "block";
                                                        btnActividad.style.display = "block";
                                                        btnDescargarRFC.style.display = "none";
                                                        btnEliminarRFC.style.display = "none";
                                                    } else {

                                                        btnSubirReporte.style.display = "none";
                                                        btnActividad.style.display = "none";
                                                        btnDescargarRFC.style.display = "block";
                                                        btnEliminarRFC.style.display = "block";


                                                    }
                                                }
                                            });

                                        }
                                    });
                                }
                            });
                        } else {
                            Swal.fire(
                                'Error',
                                'Ocurrio un problema, intenta nuevamente',
                                'error'
                            )
                        }
                    }
                });


            } else {

            }
        });
    });

    
    $(document).on("click", "#BtnEliminarComA", function () {  //Eliminar Funcion de tabla y de BD n


        var fila = $(this).closest("tr");
        Swal.fire({
            title: "¿Estás seguro de que deseas eliminar la Actividad?",
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                fila.addClass("selected");
                eliminarComA();
            } else {
                fila.removeClass("selected");
            }
        });
    });

    function eliminarComA() {
        var elem = $(".selected");
        if (elem.length > 0) {
            var iddatas = $(elem).closest('tr').find("input:hidden").val();
            console.log('Valor del input oculto: ' + iddatas);

            $.ajax({
                url: "../../Controlador/Coordinador/CDelActividadCom.php",
                type: "POST",
                data: { IdActividad: iddatas },
                cache: false,
                success: function (result) {
                    console.log(result);
                    if (result.length == 1) {
                        Swal.fire(
                            'Exito',
                            'Actividad eliminada correctamente',
                            'success'
                        )

                        elem.removeClass("selected");
                        var fila = $('#BtnEliminarComA').closest('tr');

                        fila.remove();
                        actualizarNumerosF();

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

                                        $.ajax({
                                            url: "../../Controlador/Coordinador/CCargarDatosTotalesAct.php",
                                            type: "POST",
                                            data: { ComisionASel: ComisionAsig },
                                            cache: false,
                                            success: function (result) {
                                                var valoresT = JSON.parse(result);
                                                var actividadesFinalizadas = valoresT[0].TotalActF;
                                                var totalActividades = valoresT[0].TotalActT;

                                                ActualizarBarraProgreso(actividadesFinalizadas, totalActividades, barraProgreso);

                                                //ValorID = $("#Id_Per").val();
                                                var btnSubirReporte = document.getElementById("btnSubirReporteF");
                                                $.ajax({
                                                    url: "../../Controlador/Coordinador/CCargarResponsablesComisionA.php",
                                                    type: "POST",
                                                    data: { ComisionASel: ComisionAsig },
                                                    cache: false,
                                                    success: function (result) {
                                                        var data = JSON.parse(result);
                                                        if (data.includes(ValorID)) {
                                                            if (totalActividades > 0) {
                                                                if (actividadesFinalizadas == totalActividades) {

                                                                    btnSubirReporte.style.display = "block";

                                                                } else {

                                                                    btnSubirReporte.style.display = "none";

                                                                }
                                                            }
                                                        }
                                                    }
                                                });

                                            }
                                        });
                                    }
                                });
                            }
                        });


                        //console.log(ComisionE);





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

        }
    }

    function ActualizarBarraProgreso(actividadesFinalizadas, totalActividades, barraProgreso) {
        var porcentajeProgreso = (actividadesFinalizadas / totalActividades) * 100;

        barraProgreso.text.innerText = Math.round(porcentajeProgreso) + "%";

        barraProgreso.animate(porcentajeProgreso / 100);
    }

    function actualizarNumerosF() {
        const celdasNumero = document.querySelectorAll('.ordenConE');




        if (celdasNumero.parentNode = 'ordenConE') {

            for (let i = 0; i < celdasNumero.length; i++) {
                celdasNumero[i].textContent = i + 1;
            }
        }



        const tablaCE = document.querySelector('#TActividades tbody');
        const numFilasCE = tablaCE.rows.length;
        if (numFilasCE == 0) {
            tablaCE.innerHTML = '<tr><td colspan="5">No hay Actividades para esta comisión</td></tr>';
        }
    }




    


});










