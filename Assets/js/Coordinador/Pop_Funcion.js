$(document).ready(function () {

  var contador = 0; // variable para contar las filas

  $("#btnADD_Funcion").click(function () {

    event.preventDefault();

    var valorInput = $("#NFuncionAd").val();
    var formFun = document.MFuncionA;

    if (formFun.NFuncionAd.value == "") {
      Swal.fire(
        'Advertencia',
        'Favor ingresar el Nombre de la Función',
        'warning'
      )
      formFun.NFuncionAd.focus();
      return false;
    } else if (validarletras(formFun.NFuncionAd.value) == false) {
      Swal.fire(
        'Advertencia',
        'No se permiten valores numericos',
        'warning'
      )
      formFun.NFuncionAd.focus();
      return false;
    } else {
      var tabla = $("#TAddFunciones").find('tbody');
      var fila = $("<tr>").appendTo(tabla);
      var celda1 = $("<td>").appendTo(fila);
      var celda2 = $("<td>").appendTo(fila);
      var celda3 = $("<td>").appendTo(fila);

      contador++; // incrementa el contador de filas
      celda1.text(contador); // agrega el número de fila a la primera celda
      celda2.text(valorInput);

      var botonEliminar = $("<button>").text("Eliminar").addClass("btn btn-light").appendTo(celda3);
      botonEliminar.click(function () {
        fila.remove(); // elimina la fila
        contador--; // decrementa el contador de filas
        // actualiza los números de las filas
        tabla.find('tr').each(function (i, row) {
          $(row).find('td:first').text(i + 1);
        });
      });

      $("#NFuncionAd").val("");
      
    }

  });



  $("#btnAdd_F").click(function () {
    event.preventDefault();

    var valoresCelda2 = [];
    $("#TAddFunciones tbody tr").each(function () {
      var valor = $(this).find("td:eq(1)").text();
      valoresCelda2.push(valor);
    });



    pruebas = valoresCelda2.toString();
    cont = valoresCelda2.length;

    if ( valoresCelda2 == "") {
      Swal.fire(
        'Advertencia',
        'Favor de ingresar una Funcion',
        'warning'
      )
      die();
    }
    console.log(pruebas);
    console.log(cont);

    IdComi = $("#ComisionE").val();

    console.log(IdComi);

    $.ajax({
      url: "../../Controlador/Coordinador/CAddFuncion.php",
      type: "POST",
      data: { IdComision: IdComi, Contador: cont, Funciones: pruebas },
      cache: false,
      success: function (result) {
        console.log(result);
        if (result.length == 1) {
          Swal.fire(
            'Exito',
            'Dato guardado correctamente',
            'success'
          )
          $("#Pop_AF").modal('hide');
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
  });



  $("#btnEd_F").click(function () {
    event.preventDefault();


    var DatoFuncion = $("#NFuncionEd").val();
    var filasel = $(".selected");


    var IdFunc = $(filasel).closest('tr').find("input:hidden").val();


    //console.log("IfFuncion :" + IdFunc + ", Nuevo valor: " + DatoFuncion);


    var formFuncion = document.Efuncion;

    if (formFuncion.NFuncionEd.value == "") {
      //document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"></a>Favor ingresar el Nombre de la comision</div>';

      Swal.fire(
        'Advertencia',
        'Favor ingresar La función',
        'warning'
      )

      formFuncion.NFuncionEd.focus();
      return false;
    } else if (validarletras(formFuncion.NFuncionEd.value) == false) {
      //document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"></a>No se permiten valores numericos </div>';
      Swal.fire(
        'Advertencia',
        'No se permiten valores numericos',
        'warning'
      )

      formFuncion.NFuncionEd.value = "";
      formFuncion.NFuncionEd.focus();
      return false;
    }

    $.ajax({
      url: "../../Controlador/Coordinador/CUpdFuncion.php",
      type: "POST",
      data: { IdFuncion: IdFunc, NombreFuncion: DatoFuncion },
      cache: false,
      success: function (result) {
        console.log(result);
        if (result.length == 1) {
          Swal.fire(
            'Exito',
            'Dato guardo correctamente',
            'success'
          )
          $("#Pop_EF").modal('hide');

          var NComisionE = $("#ComisionE").val();

          //console.log(ComisionE);

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


  });

  $("table tr").click(function () {
    // Remueve la clase "selected" de todas las filas
    $("table tr").removeClass("selected");
    // Agrega la clase "selected" a la fila seleccionada
    $(this).addClass("selected");
  });



  $("#btnCancel_AF").click(function () {
    $("#Pop_AF").modal('hide');
  });


  $("#btnCancel_EF").click(function () {

    $('#TFunciones tbody tr').removeClass('selected');
    //$('#tabla-datos tbody tr').css('background-color', '');
    $("#Pop_EF").modal('hide');
  });


  function validarletras(parametro) {
    var patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\.\-_,]+$/g;
    if (parametro.search(patron)) {
      return false;
    } else {
      return true;
    }

  }

});