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
    var idNumeroCarnet = "";
    var nombres = "";
    var apellidos = "";
    var telefono = "";
    var correo_electronico = "";
    var cedula = "";
    var grado_academico = "";
    var idSede = "";
    var sede = "";  
    var grupo = "";
    
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
      idNumeroCarnet = $(this).find("#tdIdEstudianteSeleccionado").text();
      nombres = $(this).find('td:eq(1)').text();
      apellidos = $(this).find('td:eq(2)').text();
      telefono = $(this).find('td:eq(3)').text();
      correo_electronico = $(this).find('td:eq(4)').text();
      cedula = $(this).find('td:eq(5)').text();
      idSede = $(this).find('#tdIdSedeSeleccionado').text();
      sede = $(this).find('td:eq(6)').text();
      grupo = $(this).find('td:eq(7)').text();
    });
  
    //Acciones al dar clic en el botón 'Eliminar'
    $("#idBotonEliminar").click(function () {
      if (idNumeroCarnet != "") {
        $ResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionEstudiantes.php?vparIdNumeroCarnetEliminar=" + idNumeroCarnet);
        alert("Prueba Samir: " + $ResultadoAjax);
        if ($ResultadoAjax == '1') {
          funActivarAlerta("success", "Eliminación exitosa!", "Se ha eliminado el invitado con éxito!");
  
          $("#idSelectBusqueda").val("");
  
          FunActualizarTabla();
  
          // location.reload();
  
        } else {
          funActivarAlerta("error", "No ha sido posible eliminar el estudiante!", "Ha ocurrido un problema al intentar eliminar el estudiante");
        }
      } else
        funActivarAlerta("info", "No ha seleccionado estudiante!", "Por favor seleccione un estudiante para poder eliminar!");
    });
  
    //Acción al dar click en el notón 'Editar'
    $("#idBotonEditar").click(function () {
      if (idNumeroCarnet != "") {
  
        $(".camposPopUpEditar:eq(0)").val(nombres + " " + apellidos);
        $(".camposPopUpEditar:eq(1)").val(telefono);
        $(".camposPopUpEditar:eq(2)").val(correo_electronico);
        // $(".camposPopUpEditar:eq(3)").find('option:contains(' + grado_academico + ')').prop('selected', true);
        $(".camposPopUpEditar:eq(3)").find('option').filter(function () {
          return $(this).text() === sede;
        }).prop('selected', true);

        var $vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionEstudiantes.php?vparIdSedeBuscarGrupo=" + idSede);
        // alert("vlocResultadoAjax" + $vlocResultadoAjax);
        $(".camposPopUpEditar:eq(4)").html($vlocResultadoAjax);

        $(".camposPopUpEditar:eq(4)").find('option:contains(' + grupo + ')').prop('selected', true);
  
        $("#divFondoPopUpEditar").css({
          "visibility": "visible"
        });
      } else
        funActivarAlerta("info", "No ha seleccionado personal académico!", "Por favor seleccione un personal académico para poder editar!");
    });
  
    //Acción al dar click en el notón 'Crear'
    $("#idBotonCrear").click(function () {
      window.location = "../../Vista/Administrador/RegistroEstudiante.php";
    });
  
    //Clic al botón 'Cancelar' del PopUp Editar
    $("#buttonCancelarPopUpEditar").click(function () {
      $("#divFondoPopUpEditar").css({
        "visibility": "hidden"
      });

      FunActualizarTabla();
    });

    //Selección de una sede
    $(".camposPopUpEditar:eq(3)").on('change', function () {
      var idSedeNuevo = $(this).val();

      var $vlocResultadoAjax2 = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionEstudiantes.php?vparIdSedeBuscarGrupo=" + idSedeNuevo);
      // alert("Prueba Samir: " + $vlocResultadoAjax2);

      $(".camposPopUpEditar:eq(4)").html($vlocResultadoAjax2);
    });

    //Selección de una sede en 'Registrar Nuevo Estudiante'
    $("#selectSede").on('change', function () {
      var idSedeNuevo = $(this).val();

      var $vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionEstudiantes.php?vparIdSedeBuscarGrupo=" + idSedeNuevo);
      // alert("Prueba Samir: " + $vlocResultadoAjax2);

      $("#selectGrupo").html($vlocResultadoAjax);
    });
  
    //clic al botón 'Guardar cambios'.
    $("#buttonGuardarCambiosPopUpEditar").click(function () {
  
      var valor_telefono = $(".camposPopUpEditar:eq(1)").val();;
      var valor_correo_electronico = $(".camposPopUpEditar:eq(2)").val();;
      var valor_sede = $(".camposPopUpEditar:eq(3)").val();
      var valor_grupo = $(".camposPopUpEditar:eq(4)").val();
  
      if (validarCorreo(valor_correo_electronico)) {

        $vlocVerificarTelefonoCorreo = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionEstudiantes.php?vparTelefonoVerif=" + valor_telefono + "&vparCorreoVerif=" + valor_correo_electronico);
        
        if($vlocVerificarTelefonoCorreo === ""){
  
          $vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionEstudiantes.php?vparIdNumeroCarnet=" + idNumeroCarnet +
            "&vparTelefono=" + valor_telefono + "&vparCorreoElectronico=" + valor_correo_electronico + "&vparIdSede=" + valor_sede 
            + "&vparIdGrupo=" + valor_grupo);
          if ($vlocResultadoAjax == 1) {
            funActivarAlerta("success", "Estudiante Editado!", "Se ha editado el estudiante con éxito");
    
            $("#divFondoPopUpEditar").css({
              "visibility": "hidden"
            });
    
            FunActualizarTabla();
          } else
            funActivarAlerta("error", "Error!", "Ha ocurrido un error al intentar editar el estudiante!");

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

              var input_no_carnet = $("#pInputNumeroCarnet").val();
              
              if(input_no_carnet.length == 10){
              
                $vlocResultadoVerificacionCarnet = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionEstudiantes.php?vparNoCarnetVerificar=" + input_no_carnet);
                
                if($vlocResultadoVerificacionCarnet == 0){
                  
                  $.ajax({
                    url: "../../Controlador/Administrador/CAdministracionEstudiantes.php?vparBoolGuardarEstudiante=" + Cnt_Guardar_Estudiante,
                    type: 'POST',
                    data: fdatos,
                    cache: false,
                    success: function (result) {                  
                      console.log(result);
                      alert(result);
                      if (result == Cnt_Invitado_Guardado ) {

                        Swal.fire({
                          icon: "success",
                          title: "Registro almacenado correctamente!",
                          text: "Se ha registrado el estudiante correctamente"
                        }).then(() => {
                          window.location.href = "../../Vista/Administrador/InicioAdministradorCE.php";  
                        });

                      }
                      else {
                        alert('No logrado');
                      }
                    }
                  });
                }else{
                  funActivarAlerta("warning", "Carnet existente!", "El N° de carnet que ingresó, ya se encuentra registrado");
                }

              }else{
                funActivarAlerta("info", "longitud de carnet incorrecta!", "por favor, ingrese un número de carnet real");
              }
            } else {
              Swal.fire({
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
      $vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionEstudiantes.php?vparObtenerListaEstudiantes=" + Cnt_Obtener_Lista_Estudiantes)
      $("#idTable tbody").html($vlocResultadoAjax);
      idNumeroCarnet = "";
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

  function formatoCarnet(input) {
    let valor = input.value;

    if(valor.length<10)
      valor = valor.replace(/\D/g, '');
    else
      valor = valor.replace(/[^\dA-Za-z]/g, '');
  
    // Inserta el guión después del cuarto carácter
    if (valor.length > 4) {
      valor = valor.slice(0, 4) + '-' + valor.slice(4);
    }
  
    // Verifica si el último carácter es una letra
    const lastChar = valor.charAt(valor.length - 1);
    if (/[a-zA-Z]/.test(lastChar)) {
      // Convierte la última letra ingresada a mayúscula
      valor = valor.slice(0, -1) + lastChar.toUpperCase();
    }
  
    input.value = valor;
  }