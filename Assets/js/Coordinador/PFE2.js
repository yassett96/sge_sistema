$(document).ready(function () {

  $("#TFunciones tbody").on('click', 'tr', function () {
    if ($(this).hasClass('selected')) {
      $(this).removeClass('selected')
    }
    else {
      $("#TFunciones tr.selected").removeClass('selected');
      $(this).addClass('selected');
    }
  });

  $("#TIntegrantes tbody").on('click', 'tr', function () {
    if ($(this).hasClass('selected')) {
      $(this).removeClass('selected')
    }
    else {
      $("#TIntegrantes tr.selected").removeClass('selected');
      $(this).addClass('selected');
    }
  });

  $("#TComisiones tbody").on('click', 'tr', function () {
    if ($(this).hasClass('selected')) {
      $(this).removeClass('selected')
    }
    else {
      $("#TComisiones tr.selected").removeClass('selected');
      $(this).addClass('selected');
    }
  });


  //////////////////////////////////////////////////////////////

  $("#btnEditaCE").click(function () { //Editar comisión Evento

    event.preventDefault();

    var filasel = $(".selected");
    var IdCEA = $(filasel).closest('tr').find("input:hidden").val();



    if (typeof IdCEA === "undefined") {
      Swal.fire(
        'Advertencia',
        'Debe seleccionar una comision',
        'warning'
      )
      die();

    }
    const nombreComisionEA = $(filasel).closest('tr').find(".NombreCEA").text();
    console.log(nombreComisionEA);
    console.log(IdCEA);


    //ComisionE = $("#ComisionE").val();

    $.ajax({
      /*url: "../../Vista/Coordinador/Pop_EditarCEActual2.php",*/
      url: "../../Vista/Coordinador/Pop_DetComisionEA.php",
      type: "POST",
      data: { IdComEA: IdCEA },
      cache: false,
      success: function (result) {
        $("#contenedor").html(result);
        $('#Pop_ComisionEA').modal('show');
        $("#nombre-funcion").text(nombreComisionEA);

        //$("#NombreComision").val(ComisionE);


      }
    });



  });


  ///////////////////////////////////////////////////////////////

  $("#ComisionE").change(function () { //Select Comision
    ComisionE = $("#ComisionE").val();

    console.log(ComisionE);

    $.ajax({
      url: "../../Controlador/Coordinador/CFuncionesComision.php",
      type: "POST",
      data: { ComisionE },
      cache: false,
      success: function (result) {
        //alert(result);


        $("#tabla-datos").html(result);
      }
    });

  });

  $("#btnAgregarComision").click(function () {
    event.preventDefault();

    //ComisionE = $("#ComisionE").val();

    $.ajax({
      url: "../../Vista/Coordinador/Pop_AgregarComision.php",
      type: "POST",
      cache: false,
      success: function (result) {
        $("#contenedor").html(result);
        $("#Pop_AC").modal('show');
        //$("#NombreComision").val(ComisionE);

      }
    });
  });

  $("#btnEditarComision").click(function () {
    event.preventDefault();

    var $selectedOption = $("#ComisionE option:selected");

    if ($selectedOption.val() === "Seleccione una Comision") {
      Swal.fire(
        'Advertencia',
        'Debe seleccionar una comision',
        'warning'
      )
      return;
    }

    var comision = {
      id: $selectedOption.data('id'),
      titulo: $selectedOption.text()
    };

    console.log("Comisión seleccionada: " + comision.titulo);


    $.ajax({
      url: "../../Vista/Coordinador/Pop_EditComision.php",
      type: "POST",
      cache: false,
      data: { comision: comision },
      success: function (result) {
        $("#contenedor").html(result);
        $("#Pop_EC").modal('show');
      }
    });

  });

  //////////////////////////////////////////////////////////////////////////////

  $("#btnAGG").click(function () { // Agregar función

    event.preventDefault();

    indice = $("#ComisionE").val();

    if (indice == "Seleccione una Comision") {

      Swal.fire(
        'Advertencia',
        'Debe seleccionar una comision',
        'warning'
      )
      die();
    }

    $.ajax({
      url: "../../Vista/Coordinador/Pop_AgregarFuncion.php",
      type: "POST",
      cache: false,
      success: function (result) {
        $("#contenedor").html(result);
        $("#Pop_AF").modal('show');
        //$("#NombreComision").val(ComisionE);

      }
    });

  });

  $("#btnEDIT").click(function () { //Editar función

    event.preventDefault();

    const elem = $(".selected");
    const data = $(elem).closest('tr').find("input:hidden").val();



    if (typeof data === "undefined") {
      Swal.fire(
        'Advertencia',
        'Debe seleccionar una funcion',
        'warning'
      )
      die();
    }

    const nombreFuncion = $(elem).closest('tr').find(".NombreFuncion").text();
    console.log(nombreFuncion);

    $.ajax({
      url: "../../Vista/Coordinador/Pop_EditFuncion.php",
      type: "POST",
      data: { NombreF: nombreFuncion },
      cache: false,
      success: function (result) {
        $("#contenedor").html(result);
        $("#Pop_EF").modal('show');
        //$("#NombreComision").val(ComisionE);

      }
    });



  });



  /////////////////////////////////////////////////////////////////////////


  $("#btnSigE2").click(function () {  //Siguieinte paso
    event.preventDefault();

    indice = $("#ComisionE").val();

    if (indice == "Seleccione una Comision") {

      Swal.fire(
        'Advertencia',
        'Debe seleccionar una comision',
        'warning'
      )
      die();
    }

    $("#IntegrantesC-tab").removeClass("disabled");

    let tabs = document.getElementById("IntegrantesC-tab");
    tabs.click();
  });

  /////////////////////////////////////////////////////////////////////////////////

  $("#ResponsableC1").click(function () { //Select Responsable 1

    event.preventDefault();

    VResponsableC = $("#ResponsableC1").val();
    VResponsableC2 = $("#ResponsableC2").val();
    VResponsableC3 = $("#ResponsableC3").val();
    IntegranteC = $("#IntegranteC").val();

    console.log(VResponsableC2);
    console.log(VResponsableC3);


    //console.log(ResponsableC);
    var Form2 = document.fidcoment;

    var ntr = $("#Tabla_int tr").length;
    var datosf = new Array();

    for (var i = 0; i <= ntr - 1; i++) {
      datosf[i] = $("#Tabla_int tr").eq(i).children("td").eq(0).find("input:hidden").val();
    }

    if (datosf.includes(VResponsableC) == true) {
      Swal.fire(
        'Advertencia',
        'La persona que desea agregar, ya esta seleccionado como Integrante',
        'warning'
      )
      Form2.ResponsableC.value = "Seleccione al Responsable 1";
      Form2.ResponsableC.focus();
      die();
    }

    if (VResponsableC == VResponsableC2) {
      Swal.fire(
        'Advertencia',
        'La persona que desea agregar, ya esta seleccionado como Responsable ',
        'warning'
      )
      Form2.ResponsableC.value = "Seleccione al Responsable 1";
      Form2.ResponsableC.focus();
      die();

    }

    if (VResponsableC == VResponsableC3) {
      Swal.fire(
        'Advertencia',
        'La persona que desea agregar, ya esta seleccionado como Responsable ',
        'warning'
      )
      Form2.ResponsableC.value = "Seleccione al Responsable 1";
      Form2.ResponsableC.focus();
      die();

    }

    $("#ResponsableC2").prop("disabled", false);
    $("#btnQuitarSeleccionR2").prop("disabled", false);
  });



  $("#ResponsableC2").click(function () { //Select Responsable 2

    event.preventDefault();

    VResponsableC2 = $("#ResponsableC2").val();
    VResponsableC = $("#ResponsableC1").val();
    VResponsableC3 = $("#ResponsableC3").val();

    IntegranteC = $("#IntegranteC").val();

    //console.log(ResponsableC);
    var Form2 = document.fidcoment;
    

    var ntr = $("#Tabla_int tr").length;
    var datosf = new Array();

    for (var i = 0; i <= ntr - 1; i++) {
      datosf[i] = $("#Tabla_int tr").eq(i).children("td").eq(0).find("input:hidden").val();
    }

    if (datosf.includes(VResponsableC2) == true) {
      Swal.fire(
        'Advertencia',
        'La persona que desea agregar, ya esta seleccionado como Integrante',
        'warning'
      )
      Form2.ResponsableC2.value = "Seleccione al Responsable 2 si lo desea";
      Form2.ResponsableC2.focus();
      die();
    }

    if (VResponsableC2 == VResponsableC) {
      Swal.fire(
        'Advertencia',
        'La persona que desea agregar, ya esta seleccionado como Responsable ',
        'warning'
      )
      Form2.ResponsableC2.value = "Seleccione al Responsable 2 si lo desea";
      Form2.ResponsableC2.focus();
      die();

    }

    if (VResponsableC2 == VResponsableC3) {
      Swal.fire(
        'Advertencia',
        'La persona que desea agregar, ya esta seleccionado como Responsable ',
        'warning'
      )
      Form2.ResponsableC2.value = "Seleccione al Responsable 2 si lo desea";
      Form2.ResponsableC2.focus();
      die();

    }

    $("#ResponsableC3").prop("disabled", false);
    $("#btnQuitarSeleccionR3").prop("disabled", false);
  });

  $("#btnQuitarSeleccionR2").click(function () {
    event.preventDefault();

    $("#ResponsableC2").val("Seleccione al Responsable 2 si lo desea");
  });

  $("#ResponsableC3").click(function () { //Select Responsable 3

    event.preventDefault();

    VResponsableC3 = $("#ResponsableC3").val();
    VResponsableC2 = $("#ResponsableC2").val();
    VResponsableC = $("#ResponsableC1").val();
    IntegranteC = $("#IntegranteC").val();

    //console.log(ResponsableC);
    var Form2 = document.fidcoment;

    var ntr = $("#Tabla_int tr").length;
    var datosf = new Array();

    for (var i = 0; i <= ntr - 1; i++) {
      datosf[i] = $("#Tabla_int tr").eq(i).children("td").eq(0).find("input:hidden").val();
    }

    if (datosf.includes(VResponsableC3) == true) {
      Swal.fire(
        'Advertencia',
        'La persona que desea agregar, ya esta seleccionado como Integrante',
        'warning'
      )
      Form2.ResponsableC3.value = "Seleccione al Responsable 3 si lo desea";
      Form2.ResponsableC3.focus();
      die();
    }

    if (VResponsableC3 == VResponsableC) {
      Swal.fire(
        'Advertencia',
        'La persona que desea agregar, ya esta seleccionado como Responsable ',
        'warning'
      )
      Form2.ResponsableC3.value = "Seleccione al Responsable 3 si lo desea";
      Form2.ResponsableC3.focus();
      die();

    }

    if (VResponsableC3 == VResponsableC2) {
      Swal.fire(
        'Advertencia',
        'La persona que desea agregar, ya esta seleccionado como Responsable ',
        'warning'
      )
      Form2.ResponsableC3.value = "Seleccione al Responsable 3 si lo desea";
      Form2.ResponsableC3.focus();
      die();

    }


  });

  $("#btnQuitarSeleccionR3").click(function () {
    event.preventDefault();

    $("#ResponsableC3").val("Seleccione al Responsable 3 si lo desea");
  });

  /*$("#btnAgregarRs").click(function(){ //Agregar Responsable(Personal Academico)
      event.preventDefault();

      //ComisionE = $("#ComisionE").val();

      $.ajax({
          url: "../../Vista/Coordinador/Pop_AgregarPAcademico.php",
          type: "POST",
          cache: false,
          success:function (result){  
              $("#contenedor").html(result);
              $("#Pop_APA").modal('show');
              //$("#NombreComision").val(ComisionE);
          }
      });
  });*/


  $("#IntegranteC").click(function () { //Select Integrante

    event.preventDefault();
    //$("#ResponsableC").prop('disabled', true);

    ResponsableC1 = $("#ResponsableC1").val();
    ResponsableC2 = $("#ResponsableC2").val();
    ResponsableC3 = $("#ResponsableC3").val();

    IntegranteC = $("#IntegranteC").val();

    var Form3 = document.fidcoment;

    //console.log(ResponsableC);
    //console.log(IntegranteC);        

    if (ResponsableC1 == IntegranteC) {

      Swal.fire(
        'Advertencia',
        'La persona que desea agregar, ya esta seleccionado como Responsable ',
        'warning'
      )
      Form3.IntegranteC.value = "Seleccione a los integrantes";
      Form3.IntegranteC.focus();
      die();
    }
    if (ResponsableC2 == IntegranteC) {

      Swal.fire(
        'Advertencia',
        'La persona que desea agregar, ya esta seleccionado como Responsable 2',
        'warning'
      )
      Form3.IntegranteC.value = "Seleccione a los integrantes";
      Form3.IntegranteC.focus();
      die();
    }
    if (ResponsableC3 == IntegranteC) {

      Swal.fire(
        'Advertencia',
        'La persona que desea agregar, ya esta seleccionado como Responsable 3',
        'warning'
      )
      Form3.IntegranteC.value = "Seleccione a los integrantes";
      Form3.IntegranteC.focus();
      die();
    }

    var ntr = $("#Tabla_int tr").length;
    var datosf = new Array();

    for (var i = 0; i <= ntr - 1; i++) {
      datosf[i] = $("#Tabla_int tr").eq(i).children("td").eq(0).find("input:hidden").val();
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
      url: "../../Controlador/Coordinador/CControlIntegrantes.php",
      type: "POST",
      data: { IntegranteC },
      cache: false,
      success: function (result) {

        //alert(result)        

        $("#TIntegrantes tbody").append(result); //LLena tabla a partir de consulta mysql formato tabla
        actualizarNumerosF();
      }
    });
  });

  $("#btnGuardarDatosG").click(function () {  //Guardar comision evento

    event.preventDefault();

    var IdComision = $("#ComisionE").val();
    console.log("IDcomision: " + IdComision);

    var NFunciones = $("#tabla-datos tr").length;
    //console.log(NFunciones);

    var IdsFuncionesC = new Array();

    for (var i = 0; i <= NFunciones - 1; i++) {
      IdsFuncionesC[i] = $("#tabla-datos tr").eq(i).children("td").eq(0).find("input:hidden").val();
      // var datosf = $("#Tabla_int tr").eq(i).children("td").eq(0).val();
      // alert(datosf);
      //console.log("Vuelta: " + i + ", datos: " + IdsIntegrantesC);
    }

    pruebas2 = IdsFuncionesC.toString();

    if (pruebas2 < 1) {
      Swal.fire(
        'Advertencia',
        'Debe ingresar minimo 1 función',
        'warning'
      )
      die();
    }
    console.log("FuncionID: " + pruebas2);

    indice = $("#ResponsableC1").val();
    if (indice == "Seleccione al Responsable 1") {

      Swal.fire(
        'Advertencia',
        'Debe seleccionar un responsable',
        'warning'
      )
      die();
    }

    var IdsResponsable2 = $("#ResponsableC2").val();
    if (IdsResponsable2 == "Seleccione al Responsable 2 si lo desea") {

      IdsResponsable2 = "NULL";
    }
    var IdsResponsable3 = $("#ResponsableC3").val();
    if (IdsResponsable3 == "Seleccione al Responsable 3 si lo desea") {

      IdsResponsable3 = "NULL";
    }

    console.log("IDResponsable1: " + indice);
    console.log("IDResponsable2: " + IdsResponsable2);
    console.log("IDResponsable3: " + IdsResponsable3);

    var NIntegrantes = $("#Tabla_int tr").length;

    //console.log(NIntegrantes);

    var IdsIntegrantesC = new Array();

    for (var j = 0; j <= NIntegrantes - 1; j++) {
      IdsIntegrantesC[j] = $("#Tabla_int tr").eq(j).children("td").eq(0).find("input:hidden").val();
      // var datosf = $("#Tabla_int tr").eq(i).children("td").eq(0).val();
      // alert(datosf);
      //console.log("Vuelta: " + i + ", datos: " + datosf);
    }

    pruebas3 = IdsIntegrantesC.toString();

    if (pruebas3 < 1) {
      Swal.fire(
        'Advertencia',
        'Debe seleccionar minimo 1 integrante',
        'warning'
      )
      die();
    }
    console.log("IDsIntegrantes: " + pruebas3);
    console.log("CONTIntegrantes: " + NIntegrantes);




    $.ajax({
      type: "POST",
      url: "../../Controlador/Coordinador/CPlanificacionE2.php",
      type: "POST",
      data: { IdComision: IdComision, Resp1: indice, Resp2: IdsResponsable2, Resp3: IdsResponsable3, Integrantes: pruebas3, conINT: NIntegrantes },
      cache: false,

      success: function (result) {
        if (result.length == 1) {

          Swal.fire({
            customClass: {
              confirmButton: 'swalBtnColor',
            },
            title: "Comisiones registradas Exitosamente",
            text: " ¿Desea Registrar otra comision?",
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
          })
            .then((result) => {
              if (result.isConfirmed) {
                window.location.href = "../../Vista/Coordinador/PlanificacionE2.php";
              } else {
                window.location.href = "../../Vista/Coordinador/Planificacion_Feria_CE.php";
              }
            });
        }
        else {
          swal("No Logrado")
        }
      }
    });

  });

  $(document).on('click', '#btnCancelarR', function (e) {

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
          window.location.href = "../../Vista/Coordinador/Planificacion_Feria_CE.php";
        }
      });
  });

  $(document).on('click', '#btnCancelarRPA', function (e) {

    event.preventDefault();

    Swal.fire({
      customClass: {
        confirmButton: 'swalBtnColor',
      },
      text: " ¿Desea realmente cancelar el resgistro?",
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





}); //IntegranteC  

$(document).on("click", "#BtnEliminarCE", function () {  //Eliminar Comision del evento


  var fila = $(this).closest("tr");
  Swal.fire({
    title: "¿Estás seguro de que deseas eliminar la comisión del evento actual?",
    showCancelButton: true,
    confirmButtonText: 'Si',
    cancelButtonText: 'No',
  }).then((result) => {
    if (result.isConfirmed) {
      fila.addClass("selected");
      eliminarCE();
    } else {
      fila.removeClass("selected");
    }
  });
});
function eliminarCE() {
  var elem = $(".selected");
  if (elem.length > 0) {
    var filaCE = $(elem).closest('tr');
    var idCE = $(elem).closest('tr').find("input:hidden").val();

    $.ajax({
      url: "../../Controlador/Coordinador/CDelComisionEvento.php",
      type: "POST",
      data: { IdCEvento: idCE },
      cache: false,
      success: function (result) {
        console.log(result);
        if (result.length == 1) {
          Swal.fire(
            'Exito',
            'Dato Eliminado correctamente',
            'success'
          );

          elem.removeClass("selected");
          filaCE.remove();
          actualizarNumerosF();


        } else {
          Swal.fire(
            'Error',
            'Ocurrio un problema, intenta nuevamente',
            'error'
          );
        }
      }
    });
  }
}


$(document).on("click", "#BtnEliminarFuncion", function () {  //Eliminar Funcion de tabla y de BD n


  var fila = $(this).closest("tr");
  Swal.fire({
    title: "¿Estás seguro de que deseas eliminar la función?",
    showCancelButton: true,
    confirmButtonText: 'Si',
    cancelButtonText: 'No',
  }).then((result) => {
    if (result.isConfirmed) {
      fila.addClass("selected");
      eliminarFuncionF();
    } else {
      fila.removeClass("selected");
    }
  });
});

function eliminarFuncionF() {
  var elem = $(".selected");
  if (elem.length > 0) {
    var iddatas = $(elem).closest('tr').find("input:hidden").val();
    console.log('Valor del input oculto: ' + iddatas);

    $.ajax({
      url: "../../Controlador/Coordinador/CDelFuncion.php",
      type: "POST",
      data: { IdFuncion: iddatas },
      cache: false,
      success: function (result) {
        console.log(result);
        if (result.length == 1) {
          Swal.fire(
            'Exito',
            'Dato guardo correctamente',
            'success'
          )




          elem.removeClass("selected");
          var fila = $('#BtnEliminarFuncion').closest('tr');

          fila.remove();
          actualizarNumerosF();
          //console.log(ComisionE);


          var NComisionE = $("#ComisionE").val();
          $.ajax({
            url: "../../Controlador/Coordinador/CFuncionesComision.php",
            type: "POST",
            data: { ComisionE: NComisionE },
            cache: false,
            success: function (result) {
              //alert(result);


              $("#tabla-datos").html(result);
            }

          });

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

/*
function actualizarNumerosF() {
  const celdasNumero = document.querySelectorAll('.orden');
  const celdasNumero2 = document.querySelectorAll('.ordenIn');
  const celdasNumero3 = document.querySelectorAll('.ordenCE');
 
  for (let i = 0; i < celdasNumero.length; i++) {
    const padre = celdasNumero[i].parentNode;
    if (padre.classList.contains('orden')) {
      celdasNumero[i].textContent = i + 1;
    }
  }
 
  for (let j = 0; j < celdasNumero2.length; j++) {
    const padre = celdasNumero2[j].parentNode;
    if (padre.classList.contains('ordenIn')) {
      celdasNumero2[j].textContent = j + 1;
    }
  }
 
  for (let k = 0; k < celdasNumero3.length; k++) {
    const padre = celdasNumero3[k].parentNode;
    if (padre.classList.contains('ordenCE')) {
      celdasNumero3[k].textContent = k + 1;
    }
  }
}*/

function actualizarNumerosF() {
  const celdasNumero = document.querySelectorAll('.orden');
  const celdasNumero2 = document.querySelectorAll('.ordenIn');
  const celdasNumero3 = document.querySelectorAll('.ordenCE');

  //console.log(celdasNumero.parentNode);

  if (celdasNumero.parentNode = 'orden') {

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

  const tablaCE = document.querySelector('#TComisiones tbody');
  const numFilasCE = tablaCE.rows.length;
  if (numFilasCE == 0) {
    tablaCE.innerHTML = '<tr><td colspan="5">No hay comisiones en el evento</td></tr>';
  }
}
