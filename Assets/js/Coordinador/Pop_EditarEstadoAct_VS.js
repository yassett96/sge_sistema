$(document).ready(function () {


    $("#btnAEA").click(function () {
        event.preventDefault();

        var ValorEstado = $("#EstadoActi").val();
        var ID = $("#IDCom_Act").val();
        var btnSubirReporte = document.getElementById("btnSubirReporteF");
        
        
        
        console.log("Valor : " + ValorEstado);
        console.log("Valor ID : " + ID);

        $.ajax({
            url: "../../Controlador/Coordinador/CUpdEstadoAct.php",
            type: "POST",
            data: { Id_EstadoA: ValorEstado, ID_ComA: ID },
            cache: false,
            success: function (result) {
                console.log(result);
                if (result.length == 1) {
                    Swal.fire(
                        'Exito',
                        'Dato Actualizado',
                        'success'
                    )

                    $('#TActividades tbody tr').removeClass('selected');
                    $('#Pop_EditarAct').modal('hide');

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

                                            /*console.log("Fin "+actividadesFinalizadas);
                                            console.log("Total "+totalActividades);*/

                                            ActualizarBarraProgreso(actividadesFinalizadas, totalActividades, barraProgreso);
                                            
                                            //ValorID = $("#Id_Per").val();
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
                                    
                                            
                                            /*if (totalActividades > 0) {
                                                if (actividadesFinalizadas == totalActividades) {
                                                    Swal.fire(
                                                        'Exito',
                                                        'Valores Iguales',
                                                        'success'
                                                    )

                                                    btnSubirReporte.style.display = "block";
                                                } else {

                                                    btnSubirReporte.style.display = "none";
                                                }
                                            }*/
                                        }
                                    });

                                }
                            })





                        }
                    })





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

    });



    function ActualizarBarraProgreso(actividadesFinalizadas, totalActividades, barraProgreso) {
        var porcentajeProgreso = (actividadesFinalizadas / totalActividades) * 100;




        /*barraProgreso = new ProgressBar.Circle("#progress-bar-container", {
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
        });*/

        barraProgreso.text.innerText = Math.round(porcentajeProgreso) + "%";

        barraProgreso.animate(porcentajeProgreso / 100);
    }

    $('#Pop_EditarAct').on('hidden.bs.modal', function () {
        $('#TActividades tbody tr').removeClass('selected');
    });

    $(document).on('click', '#btnCancel_EEA', function () {
        $('#Pop_EditarAct').modal('hide');
        $('#TActividades tbody tr').removeClass('selected');
    });

});