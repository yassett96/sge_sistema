function CambiarTextoSegunAnchoPantalla() {
  const vlocAnchoPantalla = FunObtenerAnchoPantalla();
}

CambiarTextoSegunAnchoPantalla();

window.addEventListener("resize", CambiarTextoSegunAnchoPantalla);

$(this.document).ready(function () {

  //INICIO CAMBIO DE MENU MÓVIL
  //  seleccionamos los dos elementos que serán clickables

  const toggleButton = document.getElementById("button-menu");
  const navWrapper = document.getElementById("nav");
  const menuDes = document.getElementById("imgLogUsuario");
  const DivMenuDespliegue = document.getElementById("divMenuDespliegue");

  /* 
    cada ves que se haga click en el botón 
    agrega y quita las clases necesarias 
    para que el menú se muestre.
  */
  toggleButton.addEventListener("click", () => {
    toggleButton.classList.toggle("close");
    navWrapper.classList.toggle("show");
  });

  /* 
    Cuándo se haga click fuera del contenedor de enlaces 
    el menú debe esconderse.
  */

  navWrapper.addEventListener("click", e => {
    if (e.target.id === "nav") {
      navWrapper.classList.remove("show");
      toggleButton.classList.remove("close");
    }
  });

  menuDes.addEventListener("mouseover", e => {
    FunActivarAlerta();
  });

  menuDes.addEventListener("mouseout", e => {
    FunDesactivarAlerta();
  });

  DivMenuDespliegue.addEventListener("mouseover", e => {
    FunActivarAlerta();
  });

  DivMenuDespliegue.addEventListener("mouseout", e => {
    FunDesactivarAlerta();
  });

  function FunActivarAlerta() {
    let tag = document.getElementById("divMenuDespliegue");
    tag.style.top = '15px';
    tag.style.visibility = 'visible';
  }

  function FunDesactivarAlerta() {
    let tag = document.getElementById("divMenuDespliegue");
    tag.style.top = '0px';
    tag.style.visibility = 'hidden';
  }

  var idPersonalAcademico = "";
  var idCargoAModificar = "";
  var nombres = "";
  var apellidos = "";
  var grado_academico = "";
  var cargo = "";
  var sede = "";
  var telefono = "";
  var correo_electronico = "";

  //Para funcionalidad de AdministraciónPersonalAcadémico

  //Para actualización de la tabla cuando se ingresa in caracter en el input de búsqueda
  $('#idSelectBusquedaPA').on('keyup', function () {
    const valorBusqueda = $(this).val().toLowerCase();
    $('#idTable tbody tr').each(function () {
      let coincide = false;
      $(this).find('td').each(function () {
        if ($(this).text().toLowerCase().includes(valorBusqueda)) {
          coincide = true;
          return false; // salimos del bucle
        }
      });
      if (coincide) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  // Acciones al seleccionar una fila de la tabla
  // $('#idTable tbody tr').click(function() {
  $('#idTable').on('click', 'tr', function () {
    // Deselecciona todas las filas
    $('tr:nth-child(even)').css({
      'background-color': '#f2f2f2'
    });

    $('tr:nth-child(odd)').css({
      'background-color': '#ddd'
    });

    // Cambia el color de fondo de la fila seleccionada
    $(this).css({
      'background-color': 'rgb(139, 139, 133)'
    });

    idPersonalAcademico = $(this).find("#tdIdPersonalAcademicoSeleccionado").text();
    nombres = $(this).find('td:eq(1)').text();
    apellidos = $(this).find('td:eq(2)').text();
    grado_academico = $(this).find('td:eq(3)').text();
    idCargoAModificar = $(this).find("#tdIdCargoAModificar").text();
    cargo = $(this).find('td:eq(5)').text();
    sede = $(this).find('td:eq(6)').text();
    telefono = $(this).find('td:eq(7)').text();
    correo_electronico = $(this).find('td:eq(8)').text();
  });

  //Acciones al dar clic en el botón 'Eliminar'
  $("#idBotonEliminar").click(function () {
    if (idPersonalAcademico != "") {
      $ResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionPersonalAcademico.php?vparIdPersonalAcademicoEliminar=" + idPersonalAcademico);
      // alert("Prueba Samir: " + $ResultadoAjax);
      if ($ResultadoAjax == '1') {
        funActivarAlerta("success", "Eliminación exitosa!", "Se ha eliminado el personal académico con éxito!");

        $("#idSelectBusquedaPA").val("");

        FunActualizarTabla();

        // location.reload();

      } else {
        funActivarAlerta("error", "No ha sido posible eliminar el personal académico!", "Ha ocurrido un problema al intentar eliminar el personal académico");
      }
    } else
      funActivarAlerta("info", "No ha seleccionado personal académico!", "Por favor seleccione un personal académico para poder eliminar!");
  });

  //Acción al dar click en el notón 'Editar'
  $("#idBotonEditar").click(function () {
    if (idPersonalAcademico != "") {

      $(".camposPopUpEditar:eq(0)").val(nombres + " " + apellidos);
      $(".camposPopUpEditar:eq(1)").val(telefono);
      $(".camposPopUpEditar:eq(2)").val(correo_electronico);
      $(".camposPopUpEditar:eq(3)").find('option:contains(' + grado_academico + ')').prop('selected', true);
      $(".camposPopUpEditar:eq(4)").find('option').filter(function () {
        return $(this).text() === cargo;
      }).prop('selected', true);
      $(".camposPopUpEditar:eq(5)").find('option:contains(' + sede + ')').prop('selected', true);

      $("#divFondoPopUpEditar").css({
        "visibility": "visible"
      });
    } else
      funActivarAlerta("info", "No ha seleccionado personal académico!", "Por favor seleccione un personal académico para poder editar!");
  });

  //Acción al dar click en el notón 'Crear'
  $("#idBotonCrear").click(function () {
    window.location = "../../Vista/Administrador/RegistroGeneral.php";
  });

  //Clic al botón 'Cancelar' del PopUp Editar
  $("#buttonCancelarPopUpEditar").click(function () {
    $("#divFondoPopUpEditar").css({
      "visibility": "hidden"
    });

    FunActualizarTabla();
  });

  //clic al botón 'Guardar cambios'.
  $("#buttonGuardarCambiosPopUpEditar").click(function () {

    var valor_telefono = $(".camposPopUpEditar:eq(1)").val();;
    var valor_correo_electronico = $(".camposPopUpEditar:eq(2)").val();;
    var valor_grado_academico = $(".camposPopUpEditar:eq(3)").val();
    var valor_cargo = $(".camposPopUpEditar:eq(4)").val();
    var valor_sede = $(".camposPopUpEditar:eq(5)").val();

    if (validarCorreo(valor_correo_electronico)) {

      $vlocVerificarTelefonoCorreo = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionEstudiantes.php?vparTelefonoVerif=" + valor_telefono + "&vparCorreoVerif=" + valor_correo_electronico);
        
      if($vlocVerificarTelefonoCorreo === Cnt_Verificacion_Aprobado){

        $vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionPersonalAcademico.php?vparIdPersonalAcademico=" + idPersonalAcademico +
          "&vparTelefono=" + valor_telefono + "&vparCorreoElectronico=" + valor_correo_electronico + "&vparIdGradoAcademico=" + valor_grado_academico + 
          "&vparIdCargoAModificar="+ idCargoAModificar + "&vparIdCargo=" + valor_cargo + "&vparIdSede=" + valor_sede);
        // alert("preuba Samir: " + $vlocResultadoAjax);
        if ($vlocResultadoAjax == 1) {
          funActivarAlerta("success", "Personal Académico Editado!", "Se ha editado el personal académico con éxito");

          $("#divFondoPopUpEditar").css({
            "visibility": "hidden"
          });

          FunActualizarTabla();
        } else
          funActivarAlerta("error", "Error!", "Ha ocurrido un error al intentar editar el personal académico!");

      }else{
        funActivarAlerta("warning", "Registro existente!", $vlocVerificarTelefonoCorreo);
      }

    } else
      funActivarAlerta("info", "Correo inválido!", "Agregue un correo electrónico válido: example@gmail.com!");
  });

  //Clic al botón 'Atrás'
  $("#h4Atras").click(function () {
    window.history.back();
  });

  $('#telefonoEditar').on('input', function () {
    var telefono = $(this).val().replace(/[^0-9]/g, '');
    if (telefono.length > 8) {
      telefono = telefono.slice(0, 8);
    }
    if (telefono.length > 4) {
      telefono = telefono.slice(0, 4) + '-' + telefono.slice(4);
    }
    $(this).val(telefono);
  });

  function FunActualizarTabla() {
    $vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionPersonalAcademico.php?vparObtenerListaPersonalAcademico=" + Cnt_Obtener_Lista_Personal_Acdemico)
    $("#idTable tbody").html($vlocResultadoAjax);

    idPersonalAcademico = "";
  }

  function validarCorreo(correo) {
    // Expresión regular para validar el correo
    var regex = /\S+@\S+\.\S+/;
    return regex.test(correo);
  }
  //Fin Para funcionalidad de AdministraciónPersonalAcadémico


});

