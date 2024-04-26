$(document).ready(function () {

    var contador = 0;

    $("#iconoBtnReq").click(function () {

        var NRequ = $("#RequerimientoA").val();

        console.log(NRequ);
        var formReq = document.MActividad;

        if (formReq.RequerimientoA.value == "") {
            Swal.fire(
                'Advertencia',
                'Favor ingresar el requerimiento',
                'warning'
            )
            formReq.RequerimientoA.focus();
            return false;
        } else if (validarTexto(formReq.RequerimientoA.value) == false) {
            Swal.fire(
                'Advertencia',
                'Solo se permiten caracteres alfanuméricos, coma, guion, guion bajo, punto y espacio',
                'warning'
            )
            formReq.RequerimientoA.focus();
            return false;
        }
        else {
            var tabla = $("#TReq").find('tbody');
            var fila = $("<tr>").appendTo(tabla);
            var celda1 = $("<td>").appendTo(fila);
            var celda2 = $("<td>").appendTo(fila);
            var celda3 = $("<td>").appendTo(fila);

            contador++; // incrementa el contador de filas
            celda1.text(contador); // agrega el número de fila a la primera celda
            celda2.text(NRequ);

            var botonEliminar = $("<button>").text("Eliminar").addClass("btn btn-light CE").appendTo(celda3);
            botonEliminar.click(function () {
                fila.remove(); // elimina la fila
                contador--; // decrementa el contador de filas
                // actualiza los números de las filas
                tabla.find('tr').each(function (i, row) {
                    $(row).find('td:first').text(i + 1);
                });
            });
            $("#RequerimientoA").val("");
        }


    });

    $("#IntegranteRes").change(function () { //Select Integrante

        event.preventDefault();

        var IntegranteC = $("#IntegranteRes").val();

        var ntr = $("#Tabla_IntR tr").length;
        var datosf = new Array();

        for (var i = 0; i <= ntr - 1; i++) {
            datosf[i] = $("#Tabla_IntR tr").eq(i).children("td").eq(0).find("input:hidden").val();
        }

        if (datosf.includes(IntegranteC) == true) {
            Swal.fire(
                'Advertencia',
                'La persona que desea agregar, ya esta seleccionado como Integrante',
                'warning'
            )
            die();

        }

        $.ajax({
            url: "../../Controlador/Coordinador/CControlIntegrantesAct.php",
            type: "POST",
            data: { IntegranteC },
            cache: false,
            success: function (result) {

                //alert(result)        

                $("#TIntegrantes tbody").append(result); //LLena tabla a partir de consulta mysql formato tabla
                actualizarNumerosF();
            }
        });
        $("#IntegranteRes").val("");
    });

    $("#IntegranteCom").change(function () { //Select Integrante

        event.preventDefault();

        var IntegranteCom = $("#IntegranteCom").val();

        var ntr = $("#Tabla_Com tr").length;
        var datosf = new Array();

        for (var i = 0; i <= ntr - 1; i++) {
            datosf[i] = $("#Tabla_Com tr").eq(i).children("td").eq(0).find("input:hidden").val();
        }

        if (datosf.includes(IntegranteCom) == true) {
            Swal.fire(
                'Advertencia',
                'La comisión que intenta agregar, ya esta seleccionada',
                'warning'
            )
            die();

        }

        $.ajax({
            url: "../../Controlador/Coordinador/CControlComisionApoyo.php",
            type: "POST",
            data: { IntegranteCom },
            cache: false,
            success: function (result) {

                //alert(result)        

                $("#TComision tbody").append(result); //LLena tabla a partir de consulta mysql formato tabla
                actualizarNumerosF();
            }
        });
        $("#IntegranteCom").val("");
    });

    $("#IntegranteApoyo").change(function () { //Select Integrante

        event.preventDefault();

        var IntegranteApoyo = $("#IntegranteApoyo").val();

        var ntr = $("#Tabla_IntA tr").length;
        var datosf = new Array();

        for (var i = 0; i <= ntr - 1; i++) {
            datosf[i] = $("#Tabla_IntA tr").eq(i).children("td").eq(0).find("input:hidden").val();
        }

        if (datosf.includes(IntegranteApoyo) == true) {
            Swal.fire(
                'Advertencia',
                'El tipo de participante que desea agregar, ya esta seleccionado',
                'warning'
            )
            die();

        }

        $.ajax({
            url: "../../Controlador/Coordinador/CControlOtrosParticipantes.php",
            type: "POST",
            data: { IntegranteApoyo },
            cache: false,
            success: function (result) {

                //alert(result)        

                $("#TIntegrantesA tbody").append(result); //LLena tabla a partir de consulta mysql formato tabla
                actualizarNumerosF();
            }
        });
        $("#IntegranteApoyo").val("");
    });


    $("#btnAdd_A").click(function () {
        event.preventDefault();


        //var IDComisionAsig = ComisionesAsig;
        var NombreAct = $("#NActividad").val();
        var valorDC = $("#DescripcionA").val();
        var valoroculto = $("#Fecha_IEvento").val();
        var FechaI = $("#FechaI").val();
        var FechaF = $("#FechaF").val();


        var fechaActual = new Date();
        var año = fechaActual.getFullYear();
        var mes = fechaActual.getMonth() + 1;
        var día = fechaActual.getDate();
        if (día < 10) {
            día = "0" + día;
          }
        var fechaFormatoA = `${año}-0${mes}-${día}`;


        console.log("FechaHOYConFormato: " + fechaFormatoA);
        console.log("Fecha Inicio: " + FechaI);
        console.log("Fecha Fin: " + FechaF);


        //console.log(valoroculto);

        var formulario = document.MActividad;

        if (formulario.NActividad.value == "") {

            Swal.fire(
                'Advertencia',
                'Favor ingresar el Nombre de la actividad',
                'warning'
            )

            formulario.NActividad.focus();
            return false;
        } else if (validarTexto(formulario.NActividad.value) == false) {

            Swal.fire(
                'Advertencia',
                'Solo se permiten caracteres alfanuméricos, coma, guion, guion bajo, punto y espacio',
                'warning'
            )

            formulario.NActividad.value = "";
            formulario.NActividad.focus();
            return false;
        }

        if (formulario.DescripcionA.value == "") {

            Swal.fire(
                'Advertencia',
                'Favor ingresar la descripcion de la actividad',
                'warning'
            )

            formulario.DescripcionA.focus();
            return false;
        } else if (validarTexto(formulario.DescripcionA.value) == false) {

            Swal.fire(
                'Advertencia',
                'Solo se permiten caracteres alfanuméricos, coma, guion, guion bajo, punto y espacio',
                'warning'
            )

            formulario.DescripcionA.focus();
            return false;

        }

        if (formulario.FechaI.value == "") {

            Swal.fire(
                'Advertencia',
                'Favor ingresar la de fecha de inicio de la actividad',
                'warning'
            )

            formulario.FechaI.focus();
            return false;
        }
        else if (formulario.FechaI.value < fechaFormatoA) {


            Swal.fire(
                'Advertencia',
                'La fecha de inicio debe ser mayor o igual a la fecha actual',
                'warning'
            )

            formulario.FechaI.focus();
            return false;
        }
        else if (formulario.FechaI.value > formulario.Fecha_IEvento.value) {  //Valida que inicial no sea menor que Hora de Inicio del evento

            Swal.fire(
                'Advertencia',
                'La fecha de inicio no debee ser mayor que la fecha  del evento',
                'warning'
            )

            formulario.FechaI.focus();
            formulario.FechaI.value = "";
            return false;
        }

        if (formulario.FechaF.value == "") {

            Swal.fire(
                'Advertencia',
                'Favor ingresar la fecha de finalización de la actividad',
                'warning'
            )

            formulario.FechaF.focus();
            return false;
        }
        else if (formulario.FechaF.value < formulario.FechaI.value) {


            Swal.fire(
                'Advertencia',
                'La fecha de finalización debe ser mayor o igual a la fecha de inicio de la actividad',
                'warning'
            )

            formulario.FechaF.focus();
            return false;
        }
        else if (formulario.FechaF.value > formulario.Fecha_IEvento.value) {  //Valida que inicial no sea menor que Hora de Inicio del evento

            Swal.fire(
                'Advertencia',
                'La fecha de finalizacion no debee ser mayor que la fecha  del evento',
                'warning'
            )

            formulario.FechaF.focus();
            formulario.FechaF.value = "";
            return false;
        }

        var DatosReq = [];
        $("#TReq tbody tr").each(function () {
            var Req = $(this).find("td:eq(1)").text();
            DatosReq.push(Req);
        });

        ReqAct = DatosReq.toString();
        ReqActCont = DatosReq.length;

        if (DatosReq == "") {
            Swal.fire(
                'Advertencia',
                'Favor de ingresar un Requerimiento',
                'warning'
            )
            die();
        }
        console.log("Requerimientos: " + ReqAct);
        console.log("TotalReq: " + ReqActCont);
        //console.log("IDcomisionEventoS: "+IDComisionAsig);

        var checkbox = document.getElementById("noSeleccionarRes");

        if (!checkbox.checked) {
            console.log("NO Chekeado");

            var NEncAct = $("#Tabla_IntR tr").length;

            var IdsEncAct = new Array();

            for (var j = 0; j <= NEncAct - 1; j++) {
                IdsEncAct[j] = $("#Tabla_IntR tr").eq(j).children("td").eq(0).find("input:hidden").val();
            }

            EncActividad = IdsEncAct.toString();

            if (EncActividad < 1) {
                Swal.fire(
                    'Advertencia',
                    'Debe seleccionar minimo 1 un encargado de Actividad',
                    'warning'
                )
                die();
            }
            console.log("Encargados(IDPA): " + EncActividad);
            console.log("TotalEncargados: " + NEncAct);

        } else {
            console.log("si Chekeado");

            var NEncAct = "NULL";
            var EncActividad = "NULL";

            console.log("Encargados(IDPA): " + EncActividad);
            console.log("TotalEncargados: " + NEncAct);
        }

        var checkbox2 = document.getElementById("noSeleccionarComA");

        if (!checkbox2.checked) {
            console.log("NO Chekeado 2");

            var NComApoyo = $("#Tabla_Com tr").length;

            var IdsComApoyo = new Array();

            for (var j = 0; j <= NComApoyo - 1; j++) {
                IdsComApoyo[j] = $("#Tabla_Com tr").eq(j).children("td").eq(0).find("input:hidden").val();
            }

            ComApoyo = IdsComApoyo.toString();

            if (ComApoyo < 1) {
                Swal.fire(
                    'Advertencia',
                    'Debe seleccionar minimo 1 Comisión de Apoyo',
                    'warning'
                )
                die();
            }
            console.log("ComisionApoyo(IDCE): " + ComApoyo);
            console.log("TotalComisiones: " + NComApoyo);

        } else {
            console.log("si Chekeado 2");

            var NComApoyo = "NULL";
            var ComApoyo = "NULL";

            console.log("ComisionApoyo(IDCE): " + ComApoyo);
            console.log("TotalComisiones: " + NComApoyo);
        }

        var checkbox3 = document.getElementById("noSeleccionarPar");

        if (!checkbox3.checked) {
            console.log("NO Chekeado 2");

            var NOtrosP = $("#Tabla_IntA tr").length;

            var IdsPersonalApoyo = new Array();

            for (var j = 0; j <= NOtrosP - 1; j++) {
                IdsPersonalApoyo[j] = $("#Tabla_IntA tr").eq(j).children("td").eq(0).find("input:hidden").val();
            }

            PApoyo = IdsPersonalApoyo.toString();

            if (PApoyo < 1) {
                Swal.fire(
                    'Advertencia',
                    'Debe seleccionar minimo a 1 participante',
                    'warning'
                )
                die();
            }
            console.log("PersonalApoyo(IDPAA): " + PApoyo);
            console.log("TotalPersonalA: " + NOtrosP);

        } else {
            console.log("si Chekeado 2");

            var PApoyo = "NULL";
            var NOtrosP = "NULL";

            console.log("PersonalApoyo(IDPAA):" + PApoyo);
            console.log("TotalPersonalA:" + NOtrosP);
        }


        $.ajax({
            url: "../../Controlador/Coordinador/CAddActividadComision.php",
            type: "POST",
            data: { NombreAct: NombreAct, DescripcionA: valorDC, FechaI: FechaI, FechaF: FechaF, Requerimientos: ReqAct, NRequerimientos: ReqActCont, EncargadosA: EncActividad, NEncargados: NEncAct, ComisionAA: ComApoyo, NComisiones: NComApoyo, PersonalAA: PApoyo, NPersonalA: NOtrosP, IDComisionAsig: ComisionAsig },
            cache: false,
            success: function (result) {
                console.log(result);
                if (result.length == 1) {

                    Swal.fire(
                        'Exito',
                        'Actividad registrada correctamente',
                        'success'
                    )

                    $('#Pop_AActividad').modal('hide');

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

    $("#btnCancel").click(function () {
        $("#Pop_AActividad").modal('hide');
      });

      function ActualizarBarraProgreso(actividadesFinalizadas, totalActividades, barraProgreso ) {
        var porcentajeProgreso = (actividadesFinalizadas / totalActividades) * 100;

        barraProgreso.text.innerText = Math.round(porcentajeProgreso) + "%";

        barraProgreso.animate(porcentajeProgreso / 100);
    }

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

    function validarletrasN(parametro) {
        var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/g;
        if (parametro.search(patron)) {
            return false;
        } else {
            return true;
        }
    }

    function actualizarNumerosF() {
        const celdasNumero = document.querySelectorAll('.ordenPAA');
        const celdasNumero2 = document.querySelectorAll('.ordenIn');
        const celdasNumero3 = document.querySelectorAll('.ordenCE');

        //console.log(celdasNumero.parentNode);

        if (celdasNumero.parentNode = 'ordenPAA') {

            // Recorrer todas las celdas y actualizar su contenido
            for (let i = 0; i < celdasNumero.length; i++) {
                celdasNumero[i].textContent = i + 1;
            }
        }

        if (celdasNumero2.parentNode = 'ordenIn') {
            //const celdasNumero2 = document.querySelectorAll('.ordenIn');
            for (let j = 0; j < celdasNumero2.length; j++) {
                celdasNumero2[j].textContent = j + 1;
            }
        }

        if (celdasNumero3.parentNode = 'ordenCE') {
            //const celdasNumero2 = document.querySelectorAll('.ordenIn');
            for (let k = 0; k < celdasNumero3.length; k++) {
                celdasNumero3[k].textContent = k + 1;
            }
        }

       
    }
});