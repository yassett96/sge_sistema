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
    if($("#button-menu").length){
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
    }
  
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
  
    // Para administracion de los invitados
    var idPersonalAcademico = "";
    var nombres = "";
    var apellidos = "";
    var telefono = "";
    var correo_electronico = "";
    var cedula = "";
    var grado_academico = "";
    var sede = "";  
    
    // Para registrar un nuevo invitado
    var pNombre = "";
    var sNombre = "";
    var pApellido = "";
    var sApellido = "";
    var telefonoU = "";
    var correo = "";
    var idTipoUsuario = "";
    var usuario = "";
    var contrasena = "";
    var cedula = "";
    var idPersona = "";
    
  
    //Para funcionalidad de AdministraciónPersonalAcadémico
  
    //Para actualización de la tabla cuando se ingresa in caracter en el input de búsqueda
    $('#idSelectBusqueda').on('keyup', function () {
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
  
      idPersonalAcademico = $(this).find("#tdIdInvitadoSeleccionado").text();
      nombres = $(this).find('td:eq(1)').text();
      apellidos = $(this).find('td:eq(2)').text();
      telefono = $(this).find('td:eq(3)').text();
      correo_electronico = $(this).find('td:eq(4)').text();
      grado_academico = $(this).find('td:eq(5)').text();
      sede = $(this).find('td:eq(6)').text();
    //   sede = $(this).find('td:eq(7)').text();
    });
  
    //Acciones al dar clic en el botón 'Eliminar'
    $("#idBotonEliminar").click(function () {
      if (idPersonalAcademico != "") {
        $ResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionInvitado.php?vparIdPersonalAcademicoEliminar=" + idPersonalAcademico);
        // alert("Prueba Samir: " + $ResultadoAjax);
        if ($ResultadoAjax == '1') {
          funActivarAlerta("success", "Eliminación exitosa!", "Se ha eliminado el invitado con éxito!");
  
          $("#idSelectBusqueda").val("");
  
          FunActualizarTabla();
  
          // location.reload();
  
        } else {
          funActivarAlerta("error", "No ha sido posible eliminar el visitante!", "Ha ocurrido un problema al intentar eliminar el visitante");
        }
      } else
        funActivarAlerta("info", "No ha seleccionado visitante!", "Por favor seleccione un visitante para poder eliminar!");
    });
  
    //Acción al dar click en el notón 'Editar'
    $("#idBotonEditar").click(function () {
      if (idPersonalAcademico != "") {
  
        $(".camposPopUpEditar:eq(0)").val(nombres + " " + apellidos);
        $(".camposPopUpEditar:eq(1)").val(telefono);
        $(".camposPopUpEditar:eq(2)").val(correo_electronico);
        $(".camposPopUpEditar:eq(3)").find('option:contains(' + grado_academico + ')').prop('selected', true);
        $(".camposPopUpEditar:eq(4)").find('option').filter(function () {
          return $(this).text() === sede;
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
      window.location = "../../Vista/Administrador/RegistroInvitado.php";
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
      var valor_sede = $(".camposPopUpEditar:eq(4)").val();
  
      if (validarCorreo(valor_correo_electronico)) {

        $vlocVerificarTelefonoCorreo = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionEstudiantes.php?vparTelefonoVerif=" + valor_telefono + "&vparCorreoVerif=" + valor_correo_electronico);
        
        if($vlocVerificarTelefonoCorreo === Cnt_Verificacion_Aprobado){
  
        $vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionInvitado.php?vparIdPersonalAcademico=" + idPersonalAcademico +
          "&vparTelefono=" + valor_telefono + "&vparCorreoElectronico=" + valor_correo_electronico + "&vparIdGradoAcademico=" + valor_grado_academico 
          + "&vparIdSede=" + valor_sede);
        // alert("preuba Samir: " + $vlocResultadoAjax);
        if ($vlocResultadoAjax == 1) {
          funActivarAlerta("success", "Invitado Editado!", "Se ha editado el invitado con éxito");
  
          $("#divFondoPopUpEditar").css({
            "visibility": "hidden"
          });
  
          FunActualizarTabla();
        } else
          funActivarAlerta("error", "Error!", "Ha ocurrido un error al intentar editar el invitado!");

        }else{
          funActivarAlerta("warning", "Registro existente!", $vlocVerificarTelefonoCorreo);
        }
        
      } else
        funActivarAlerta("info", "Correo inválido!", "Agregue un correo electrónico válido: example@gmail.com!");
    });

    // Clic al botón de 'Registrarse'
    $('#BtnAgregarP').click(function () {
      event.preventDefault();
      var resultValidacion = validarcampos();
      console.log(resultValidacion);

      if (resultValidacion) {

        const fdatos = $("form#form_general").serialize();
        $.ajax({
          url: "../../Controlador/Administrador/CBuscarRegistroAca.php",
          type: 'POST',
          data: fdatos,
          success: function (result) {
            
            if (result.length == 0) {
              $.ajax({
                url: "../../Controlador/Administrador/CAdministracionInvitado.php?vparBoolGuardarInvitado=" + Cnt_Guardar_Invitado,
                type: 'POST',
                data: fdatos,
                cache: false,
                success: function (result) {                  
                  console.log(result);
                  if (result == Cnt_Invitado_Guardado ) {

                    swal("Registro almacenado correctamente")
                      .then(() => {
                        // window.location.href = "../../Vista/Administrador/Index-Admin.php";
                        window.location.href = "../../Vista/Administrador/InicioAdministradorCE.php";
                        //swal(`The returned value is: ${value}`);
                      });
                  }
                  else {
                    alert('No logrado');
                  }
                }
              });
            } else {
              swal({
                title: "Atención!",
                text: result,
                icon: "warning",
              });
            }
          }
        });
      } else {
          return false;
      }

      event.preventDefault();
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
      $vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionInvitado.php?vparObtenerListaInvitados=" + Cnt_Obtener_Lista_Invitados)
      $("#idTable tbody").html($vlocResultadoAjax);
      idPersonalAcademico = "";
    }
  
    function validarCorreo(correo) {
      // Expresión regular para validar el correo
      var regex = /\S+@\S+\.\S+/;
      return regex.test(correo);
    }
    //Fin Para funcionalidad de Administración Invitados

    function FunAjustarTablaSegunNumeroDeFilas(){
        var numTr = $("#idTable tbody").children("tr").length;

        if (numTr > 1){
            $("#idTable").css({
                "bottom": "25px"
            });
        }else{
            $("#idTable").css({
                "bottom": "0px"
            });
        }
    }

    FunAjustarTablaSegunNumeroDeFilas();

  
  });
  
  