$(document).ready(function () {

    $("#TCriterios tbody").on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected')
        }
        else {
            $("#TCriterios tr.selected").removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $("#TJuradoE tbody").on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
          $(this).removeClass('selected')
        }
        else {
          $("#TJuradoE tr.selected").removeClass('selected');
          $(this).addClass('selected');
        }
      });

    //////////////////////////////////////////////////////////

    $("#btnDetallesJE").click(function () { //Ver detalles Jurados

        event.preventDefault();
    
        var filasel = $(".selected");
        var IdSubJEA = $(filasel).closest('tr').find("input:hidden").val();
    
    
    
        if (typeof IdSubJEA === "undefined") {
          Swal.fire(
            'Advertencia',
            'Debe seleccionar Subcategoria',
            'warning'
          )
          die();
    
        }
        const nombreCategoriaEA = $(filasel).closest('tr').find(".NombreCatEA").text();
        const nombreSubCateEA = $(filasel).closest('tr').find(".NombreSubCatEA").text();
        console.log(nombreCategoriaEA);
        console.log(nombreSubCateEA);
        console.log(IdSubJEA);
    
    
        //ComisionE = $("#ComisionE").val();
    
        $.ajax({
          
          url: "../../Vista/Coordinador/Pop_DetJuradoSubcatEA.php",
          type: "POST",
          data: { Id_Sub: IdSubJEA, NombreCat : nombreCategoriaEA, NombreSubC: nombreSubCateEA },
          cache: false,
          success: function (result) {
            $("#contenedor").html(result);
            $('#Pop_JuradoEA').modal('show');
            //$("#nombre-funcion").text(nombreComisionEA);
    
            //$("#NombreComision").val(ComisionE);
    
    
          }
        });
    
    
    
      });
    
    
      ///////////////////////////////////////////////////////////////

    $("#CategoriaE").change(function () { //Select Categoria
        var CategoriaEvento = $("#CategoriaE").val();

        console.log(CategoriaEvento);

        $.ajax({
            url: "../../Controlador/Coordinador/CSubcategoriasEvento.php",
            type: "POST",
            data: { ID_Cate: CategoriaEvento },
            cache: false,
            success: function (result) {
                //alert(result);


                $("#SubcategoriasE").html(result);
                $("#SubcategoriasE").trigger("change");
                /*$("#JuradosC2").prop("disabled", false);
                $("#JuradosC3").prop("disabled", false);
                $("#btnQuitarSeleccionJ2").prop("disabled", false);
                $("#btnQuitarSeleccionJ3").prop("disabled", false);
                //$("#JuradosC2").trigger("click");*/
            }
        });

    });

    $("#SubcategoriasE").change(function () { //Select Comision
        var SubCategoriaEvento = $("#SubcategoriasE").val();

        console.log(SubCategoriaEvento);

        $.ajax({
            url: "../../Controlador/Coordinador/CPersonalAcademicoXSub.php",
            type: "POST",
            data: { ID_SubCate: SubCategoriaEvento },
            cache: false,
            success: function (result) {
                //alert(result);


                $("#JuradosC1").html(result);
                /*$("#JuradosC2").html(result);
                $("#JuradosC3").html(result);
                //$("#JuradosC1").trigger("click");*/

            }
        });

    });

    ////////////////////////////////////////////////////////////////

    

    //////////////////////////////////////////////////////////////////

    $("#JuradosC1").click(function () { //Select Jurado 1

        event.preventDefault();

        var PAJurado1 = $("#JuradosC1").val();
        var PAJurado2 = $("#JuradosC2").val();
        var PAJurado3 = $("#JuradosC3").val();

        if (PAJurado1 == PAJurado2) {
            Swal.fire(
                'Advertencia',
                'La persona que desea agregar, ya esta seleccionado como Jurado 2 ',
                'warning'
            )
            $('#JuradosC1').prop('selectedIndex', 0);
            return false;

        }

        if (PAJurado1 == PAJurado3) {
            Swal.fire(
                'Advertencia',
                'La persona que desea agregar, ya esta seleccionado como Jurado 3 ',
                'warning'
            )
            $('#JuradosC1').prop('selectedIndex', 0);
            return false;

        }
        
        
        var SubCategoriaEvento = $("#SubcategoriasE").val();

        console.log(SubCategoriaEvento);

        $.ajax({
            url: "../../Controlador/Coordinador/CPersonalAcademicoXSubJ2.php",
            type: "POST",
            data: { ID_SubCate: SubCategoriaEvento,ID_paj1 :PAJurado1 },
            cache: false,
            success: function (result) {
                //alert(result);


                $("#JuradosC2").prop("disabled", false);
                $("#JuradosC2").html(result);
                $("#btnQuitarSeleccionJ2").prop("disabled", false);
                

            }
        });

        
    });

    ////////////////////////////////////////////////////////////////

    $("#JuradosC2").click(function () { //Select Jurado 2

        event.preventDefault();

        var PAJurado1 = $("#JuradosC1").val();
        var PAJurado2 = $("#JuradosC2").val();
        var PAJurado3 = $("#JuradosC3").val();

        if (PAJurado2 == PAJurado1) {
            Swal.fire(
                'Advertencia',
                'La persona que desea agregar, ya esta seleccionado como Jurado 1 ',
                'warning'
            )
            $('#JuradosC2').prop('selectedIndex', 0);
            return false;

        }

        if (PAJurado2 == PAJurado3) {
            Swal.fire(
                'Advertencia',
                'La persona que desea agregar, ya esta seleccionado como Jurado 3 ',
                'warning'
            )
            $('#JuradosC2').prop('selectedIndex', 0);
            return false;

        }

        var SubCategoriaEvento = $("#SubcategoriasE").val();

        console.log(SubCategoriaEvento);

        $.ajax({
            url: "../../Controlador/Coordinador/CPersonalAcademicoXSubJ3.php",
            type: "POST",
            data: { ID_SubCate: SubCategoriaEvento,ID_paj1 :PAJurado1, ID_paj2:PAJurado2  },
            cache: false,
            success: function (result) {
                //alert(result);


                $("#JuradosC3").prop("disabled", false);
                $("#JuradosC3").html(result);
                $("#btnQuitarSeleccionJ3").prop("disabled", false);
                

            }
        });
        
    });



    ////////////////////////////////////////////////////////////////

    $("#btnQuitarSeleccionJ2").click(function () {
        event.preventDefault();

        $('#JuradosC2').prop('selectedIndex', 0);
    });


    ////////////////////////////////////////////////////////////////

    $("#JuradosC3").click(function () { //Select Jurado 2

        event.preventDefault();

        var PAJurado1 = $("#JuradosC1").val();
        var PAJurado2 = $("#JuradosC2").val();
        var PAJurado3 = $("#JuradosC3").val();

        if (PAJurado3 == PAJurado1) {
            Swal.fire(
                'Advertencia',
                'La persona que desea agregar, ya esta seleccionado como Jurado 1 ',
                'warning'
            )
            $('#JuradosC3').prop('selectedIndex', 0);
            return false;

        }

        if (PAJurado3 == PAJurado2) {
            Swal.fire(
                'Advertencia',
                'La persona que desea agregar, ya esta seleccionado como Jurado 2 ',
                'warning'
            )
            $('#JuradosC3').prop('selectedIndex', 0);
            return false;

        }

        
        
    });





    ////////////////////////////////////////////////////////////////

    $("#btnQuitarSeleccionJ3").click(function () {
        event.preventDefault();

        $('#JuradosC3').prop('selectedIndex', 0);
    });


    ////////////////////////////////////////////////////////////////

    $("#btnSigE5").click(function () {  //Siguieinte paso
        event.preventDefault();

        indice = $("#CategoriaE").val();
        var PAJurado1 = $("#JuradosC1").val();

        if (indice == "Seleccione una Categoría") {

            Swal.fire(
                'Advertencia',
                'Debe seleccionar una categoría',
                'warning'
            )
            die();
        }

        if (PAJurado1 == "0") {
            Swal.fire(
                'Advertencia',
                'Debe seleccionar al Jurado 1 ',
                'warning'
            )
            die();

        }

        $("#FCriterios-tab").removeClass("disabled");

        let tabs = document.getElementById("FCriterios-tab");
        tabs.click();
    });

    /////////////////////////////////////////////////////////////////////////////////

    $("#FormatCriterio").change(function () { //Select formato
        var idformato = $("#FormatCriterio").val();

        console.log(idformato);

        $.ajax({
            url: "../../Controlador/Coordinador/CCriterioFormato.php",
            type: "POST",
            data: { ID_TipoFormat: idformato },
            cache: false,
            success: function (result) {
                //alert(result);


                $("#tabla-criterios").html(result);
            }
        });

    });

    $("#btnAgregarFormato").click(function () {
        event.preventDefault();

        //ComisionE = $("#ComisionE").val();

        $.ajax({
            url: "../../Vista/Coordinador/Pop_AgregarFormato.php",
            type: "POST",
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
                $("#Pop_A_F").modal('show');
                //$("#NombreComision").val(ComisionE);

            }
        });
    });


    $("#btnEditarFormato").click(function () {
        event.preventDefault();

        var $selectedOption = $("#FormatCriterio option:selected");

        if ($selectedOption.val() === "Seleccione un tipo de Formato") {
            Swal.fire(
                'Advertencia',
                'Debe seleccionar un tipo de formato',
                'warning'
            )
            return;
        }

        var formato = {
            id: $selectedOption.data('id'),
            titulo: $selectedOption.text()
        };

        console.log("Formato Seleccionado: " + formato.titulo);


        $.ajax({
            url: "../../Vista/Coordinador/Pop_EditFormato.php",
            type: "POST",
            cache: false,
            data: { formato: formato },
            success: function (result) {
                $("#contenedor").html(result);
                $("#Pop_E_For").modal('show');
            }
        });

    });

    //////////////////////////////////////////////////////////////////////////////

    $("#btnAgregarCriterio").click(function () { // Agregar Criterio

        event.preventDefault();

        indice = $("#FormatCriterio").val();

        if (indice == "Seleccione un tipo de Formato") {

            Swal.fire(
                'Advertencia',
                'Debe seleccionar un tipo de formato',
                'warning'
            )
            die();
        }

        $.ajax({
            url: "../../Vista/Coordinador/Pop_AgregarCriterio.php",
            type: "POST",
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
                $("#Pop_A_C").modal('show');
                //$("#NombreComision").val(ComisionE);

            }
        });

    });

    $("#btnEditarCriterio").click(function () { //Editar función

        event.preventDefault();

        const elem = $(".selected");
        const data = $(elem).closest('tr').find("input:hidden").val();

        if (typeof data === "undefined") {
            Swal.fire(
                'Advertencia',
                'Debe seleccionar un criterio',
                'warning'
            )
            die();
        }

        const nombreCriterio = $(elem).closest('tr').find(".NombreCri").text();
        const DesCriterio = $(elem).closest('tr').find(".DesCri").text();
        const ValorCriterio = $(elem).closest('tr').find(".datoValor").text();
        console.log(nombreCriterio);
        console.log( DesCriterio);
        console.log(ValorCriterio);

        $.ajax({
            url: "../../Vista/Coordinador/Pop_EditCriterio.php",
            type: "POST",
            data: { NombreC: nombreCriterio, DesC:DesCriterio, ValC:ValorCriterio  },
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
                $("#Pop_ED_C").modal('show');
                //$("#NombreComision").val(ComisionE);

            }
        });
    });


    ///////////////////////////////////////////////////////////

    $("#btnGuardarJE5").click(function () {  //Guardar jurado

        event.preventDefault();
    
        var IdCat_E = $("#CategoriaE").val();
        var IdSubcate = $("#SubcategoriasE").val();
        var Jur1 = $("#JuradosC1").val();
        var Jur2 = $("#JuradosC2").val();
        var Jur3 = $("#JuradosC3").val();
        var IdTForm = $("#FormatCriterio").val();

       


        if (Jur2 == "0" || Jur2 == "Seleccione al que sera jurado 2"){
            Jur2  = "NULL";
        }
        

        if(Jur3 == "0" || Jur3 == "Seleccione al que sera jurado 3"){
            Jur3  = "NULL";
        }
    
    
        var NCriterio = $("#tabla-criterios tr").length;
        //console.log(NFunciones);
    
        var Idscriterios = new Array();
    
        for (var i = 0; i <= NCriterio - 1; i++) {
          Idscriterios[i] = $("#tabla-criterios tr").eq(i).children("td").eq(0).find("input:hidden").val();
          // var datosf = $("#Tabla_int tr").eq(i).children("td").eq(0).val();
          // alert(datosf);
          //console.log("Vuelta: " + i + ", datos: " + IdsIntegrantesC);
        }
    
        pruebas2 = Idscriterios.toString();
    
        if (pruebas2 < 1) {
          Swal.fire(
            'Advertencia',
            'Debe ingresar minimo 1 Criterio',
            'warning'
          )
          die();
        }
        console.log("IDcate: " + IdCat_E);
        console.log("IDsubcate: " + IdSubcate);
        console.log("IDJ1: " + Jur1);
        console.log("IDJ2 " + Jur2);
        console.log("IDJ3: " + Jur3);
        console.log("IDform: " + IdTForm);
        console.log("criterioID: " + pruebas2);
    
        
    
    
        $.ajax({
          type: "POST",
          url: "../../Controlador/Coordinador/CPlanificacionE5.php",
          type: "POST",
          data: { IdcategoriaE: IdCat_E, Idsubcate:IdSubcate ,J1: Jur1, J2: Jur2, J3: Jur3, Id_TFormat: IdTForm },
          cache: false,
    
          success: function (result) {
            if (result.length == 1) {
    
                Swal.fire({
                    customClass: {
                        confirmButton: 'swalBtnColor',
                    },
                    title: "Jurados agregados correctamente",
                    text: " ¿Desea agregar otros jurados?",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No',
                })
                    .then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../../Vista/Coordinador/PlanificacionE5.php";
                        } else {
                            window.location.href = "../../Vista/Coordinador/Planificacion_Feria_CE.php";
                        }
                    });
            }
            else {
                Swal.fire("No Logrado")
            }
          }
        });
    });
    


});

$(document).on("click", "#BtnEliminarJE", function () {  //Eliminar Comision del evento


    var fila = $(this).closest("tr");
    Swal.fire({
      title: "¿Estás seguro de que deseas eliminar los jurados asignados a esta subcategoria?",
      showCancelButton: true,
      confirmButtonText: 'Si',
      cancelButtonText: 'No',
    }).then((result) => {
      if (result.isConfirmed) {
        fila.addClass("selected");
        eliminarJE();
      } else {
        fila.removeClass("selected");
      }
    });
  });
  function eliminarJE() {
    var elem = $(".selected");
    if (elem.length > 0) {
      var filaCE = $(elem).closest('tr');
      var idSubCJ= $(elem).closest('tr').find("input:hidden").val();

      console.log("Id subctageoria jurado: "+idSubCJ );
      
  
      $.ajax({
        url: "../../Controlador/Coordinador/CDelJuradosEvento.php",
        type: "POST",
        data: { Id_SubCateJ: idSubCJ },
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


$(document).on("click", "#BtnEliminarCri", function () {  //Eliminar Criterio

    var fila = $(this).closest("tr");
    Swal.fire({
        title: "¿Estás seguro de que deseas eliminar este criterio?",
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            fila.addClass("selected");
            eliminarSubCat();
        } else {
            fila.removeClass("selected");
        }
    });
});

function eliminarSubCat() {
    var elem = $(".selected");
    if (elem.length > 0) {
        var iddatas = $(elem).closest('tr').find("input:hidden").val();
        console.log('Valor del input oculto: ' + iddatas);
        var idformato = $("#FormatCriterio").val();

        $.ajax({
            url: "../../Controlador/Coordinador/CDelCriterio.php",
            type: "POST",
            data: { Id_Criterio: iddatas, Id_TFormato: idformato },
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
                    var fila = $('#BtnEliminarCri').closest('tr');

                    fila.remove();
                    actualizarNumerosF();
                    //console.log(ComisionE);




                    $.ajax({
                        url: "../../Controlador/Coordinador/CCriterioFormato.php",
                        type: "POST",
                        data: { ID_TipoFormat: idformato },
                        cache: false,
                        success: function (result) {
                            //alert(result);


                            $("#tabla-criterios").html(result);
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
function actualizarNumerosF() {
    const celdasNumero = document.querySelectorAll('.ordenCri');
    const celdasNumero2 = document.querySelectorAll('.ordenJE');


    if (celdasNumero.parentNode = 'ordenCri') {

        for (let i = 0; i < celdasNumero.length; i++) {
            celdasNumero[i].textContent = i + 1;
        }
    }

    if (celdasNumero2.parentNode = 'ordenJE') {
        //const celdasNumero2 = document.querySelectorAll('.ordenIn');
        for (let k = 0; k < celdasNumero2.length; k++) {
          celdasNumero2[k].textContent = k + 1;
        }
      }
    
      const tablaCE = document.querySelector('#TJuradoE tbody');
      const numFilasCE = tablaCE.rows.length;
      if (numFilasCE == 0) {
        tablaCE.innerHTML = '<tr><td colspan="5">No hay Jurados Asignados en el evento</td></tr>';
      }


}
