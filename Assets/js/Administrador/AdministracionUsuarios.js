
$(this.document).ready(function () {
    function CambiarTextoSegunAnchoPantalla() {
        const vlocAnchoPantalla = FunObtenerAnchoPantalla();
    }
    
    CambiarTextoSegunAnchoPantalla();
    window.addEventListener("resize", CambiarTextoSegunAnchoPantalla);

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

    // Para administración de los usuarios
    var idPersonaUsuario = "";
    var idTipoUsuarioAModificar = '';
    var tipoUsuario = "";
    var nombres = "";
    var apellidos = "";
    var telefono = "";
    var correo_electronico = "";
    var sede_participante = "";
    var sede_personal_academico = "";
    var grupo = "";
    var grado_academico = "";
    var rol = "";
    var cargo = "";
    var carnet = "";
    // var grupo_a_editar = '';

    // Para registrar un nuevo usuario
    var pNombre = "";
    var sNombre = "";
    var pApellido = "";
    var sApellido = "";
    var telefonoU = "";
    var correo = "";
    var idTipoUsuario = "";
    var usuario = "";
    var contrasena = null;
    var cedula = "";
    var idPersona = "";

    // Si el tipo de usuario es participante
    var noCarnetParticipante = null;
    var idSedeParticipante = null;
    var idGrupoParticipante = null;
    
    // Si el tipo de usuario es personal académico
    var idGradoAcademicoPersonalAcademico = null;
    var idSedePersonalAcademico = null;
    var idCargoPersonalAcademico = null;
    var idRolPersonalAcademico = null;

    // Variables para el usuario
    var inicialPrimerNombre = '';
    var segundoNombreCompleto = '';
    var tresDigitosAleatorios = '';

    // Llamada de funcionalidades iniciales
    FunLimpiarCamposFormularioEditar();
    FunDesactivarCamposParticipanteAgregarUsuario();
    FunDesactivarCamposPersonalAcademicoAgregarUsuario();
    FunActualizarPantalla();
    FunObtener3DigitosAleatorios();
    FunHacerInputsContraseñaTipoTexto();
    FunGenerarContrasena();
    // FunActualizarSelectGrupoParticipante();
    // FunDesactivarCamposEditarParticipante();
    // FunDesactivarCamposEditarPersonalAcademico();

    var vlocValorSelectTipoUsuario = $("#tipoUNuevoAcceso").val();
    
    // Acción al teclear en el input del primer nombre
    $("#pname").on('keyup', function(){
        var vlocValorInputPrimerNombre = $(this).val();

        if (vlocValorInputPrimerNombre == ''){
            inicialPrimerNombre = '';
        }else{
            inicialPrimerNombre = vlocValorInputPrimerNombre[0];
        }
        FunCargarCampoUsuario();
    });

    // Acción al teclear en el input del primer apellido
    $("#papellido").on('keyup', function(){
        var vlocValorInputPrimerApellido = $(this).val();

        if (vlocValorInputPrimerApellido == ''){
            segundoNombreCompleto = '';
        }else{
            segundoNombreCompleto = vlocValorInputPrimerApellido;
        }
        FunCargarCampoUsuario();
    });

    function FunObtener3DigitosAleatorios(){
        let vlocDigito1 = Math.floor(Math.random() * 10).toString();
        let vlocDigito2 = Math.floor(Math.random() * 10).toString();
        let vlocDigito3 = Math.floor(Math.random() * 10).toString();

        tresDigitosAleatorios = vlocDigito1 + vlocDigito2 + vlocDigito3;

        FunCargarCampoUsuario();
    }

    function FunCargarCampoUsuario(){
        var vlocUsuario = inicialPrimerNombre + segundoNombreCompleto + tresDigitosAleatorios;
        $("#pInputUsuario").val(vlocUsuario);
    }

    function FunHacerInputsContraseñaTipoTexto(){
        const passwordInput = document.querySelector('#pinputContraseña');
        const passwordInputR = document.querySelector('#pInputRepContraseña');

        passwordInput.type = 'text';
        passwordInputR.type = 'text';
    }

    function FunGenerarContrasena() {
        const caracteresMayusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const caracteresMinusculas = 'abcdefghijklmnopqrstuvwxyz';
        const caracteresNumeros = '0123456789';
        const caracteresEspeciales = '!';
        
        // Generar una letra mayúscula inicial
        const mayusculaInicial = caracteresMayusculas.charAt(
            Math.floor(Math.random() * caracteresMayusculas.length)
        );
        
        // Generar 3 caracteres aleatorios en minúscula
        let minusculas = '';
        for (let i = 0; i < 6; i++) {
            minusculas += caracteresMinusculas.charAt(
            Math.floor(Math.random() * caracteresMinusculas.length)
            );
        }
        
        // Generar un número aleatorio
        const numero = caracteresNumeros.charAt(
            Math.floor(Math.random() * caracteresNumeros.length)
        );
        
        // Generar un carácter especial aleatorio
        const especial = caracteresEspeciales.charAt(
            Math.floor(Math.random() * caracteresEspeciales.length)
        );
        
        // Combinar todos los elementos en una contraseña
        const contrasena = mayusculaInicial + minusculas + numero + especial;

        const passwordInput = document.querySelector('#pinputContraseña');
        const passwordInputR = document.querySelector('#pInputRepContraseña');

        passwordInput.value = contrasena;
        passwordInputR.value = contrasena;
        
        // $("#pInputContraseña").val(contrasena);
        // $("#pInputRepContraseña").val(contrasena);
        // return contrasena;
    }
      

    $(window).on('resize', function() {
        vlocValorSelectTipoUsuario = $("#tipoUNuevoAcceso").val();
        FunActualizarPantalla();
    });
    
    $('#idSelectBusquedaPA').on('keyup', function () {
        const valorBusqueda = $(this).val().toLowerCase();
        const palabrasClave = valorBusqueda.split(' ').filter(word => word.trim() !== '');
    
        $('#idTable tbody tr').each(function () {
            const $fila = $(this);
            let coincide = false;
    
            palabrasClave.forEach(palabra => {
                if ($fila.text().toLowerCase().includes(palabra)) {
                    coincide = true;
                }
            });
    
            if (coincide) {
                $fila.show();
            } else {
                $fila.hide();
            }
        });

        if(valorBusqueda == ""){
            FunActualizarTabla();
        }
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

        idPersonaUsuario = $(this).find("#tdIdUsuarioSeleccionado").text();
        idTipoUsuarioAModificar = $(this).find("#tdIdTipoUsuarioSeleccionado").text();
        tipoUsuario = $(this).find('td:eq(2)').text();
        nombres = $(this).find('td:eq(3)').text();
        apellidos = $(this).find('td:eq(4)').text();
        telefono = $(this).find('td:eq(5)').text();
        correo_electronico = $(this).find('td:eq(6)').text();
        sede_participante = $(this).find('td:eq(8)').text();
        sede_personal_academico = $(this).find('td:eq(9)').text();
        grupo = $(this).find('td:eq(10)').text();
        grado_academico = $(this).find('td:eq(11)').text();
        rol = $(this).find('td:eq(12)').text();
        cargo = $(this).find('td:eq(13)').text();
        carnet = $(this).find('td:eq(14)').text();        
    });

    //Acciones al dar clic en el botón 'Eliminar'
    $("#idBotonEliminar").click(function () {
        vlocConfirmacionEliminacion = FunActivarAlertaBotonConfirmacion("Eliminación acceso!", "¿Está seguro que desea eliminar el acceso?", "info", true, "Eliminar", "");

        if (idPersonaUsuario != "") {
            // Para confirmar si se desea eliminar
            Swal.fire({
                title: "Eliminación acceso!",
                text: "¿Está seguro que desea eliminar el acceso?",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor:  "Red",
                cancelButtonColor: "blue",
                confirmButtonText: "Eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    if(vlocConfirmacionEliminacion){
                        $ResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparIdPersonaUsuarioEliminar=" + idPersonaUsuario);
                        if ($ResultadoAjax == '1') {
                            funActivarAlerta("success", "Eliminación exitosa!", "Se ha eliminado el acceso con éxito!");
        
                            $("#idSelectBusquedaPA").val("");
        
                            FunActualizarTabla();
        
                            // location.reload();
        
                        } else {
                            funActivarAlerta("error", "No ha sido posible eliminar el usuario!", "Ha ocurrido un problema al intentar eliminar el usuario");
                        }
                    }
                } 
            }).catch((error) => {
                reject(error); // En caso de que ocurra algún error al mostrar el cuadro de diálogo
            });          
        } else
            funActivarAlerta("info", "No ha seleccionado usuario!", "Por favor seleccione un usuario para poder eliminar!");
    });

    //Acción al cambiar el valor del select del grupo de la sede del participante
    $(".camposPopUpEditar:eq(5)").change(function() {
        var vlocValorSeleccionado = $(this).val();
        var vlocHtmlGruposSegunSede = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparIdSede=" + vlocValorSeleccionado);
        $(".camposPopUpEditar:eq(6)").html(vlocHtmlGruposSegunSede);
    });

    //Acción al dar click en el notón 'Editar'
    $("#idBotonEditar").click(function () {
        if (idPersonaUsuario != "") {
            // Para editar participante
            if (idTipoUsuarioAModificar == Cnt_Tipo_Usuario_Participante){
                $("#divCamposEditarParticipante").css({
                    "visibility":"visible",
                    "display":"block"
                });

                $(".camposPopUpEditar:eq(0)").val(nombres + " " + apellidos);
                $(".camposPopUpEditar:eq(1)").find('option').filter(function () {
                    return $(this).text() === tipoUsuario.trim();
                }).prop('selected', true);
                $(".camposPopUpEditar:eq(2)").val(carnet);
                $(".camposPopUpEditar:eq(3)").val(telefono);
                $(".camposPopUpEditar:eq(4)").val(correo_electronico);
                $(".camposPopUpEditar:eq(5)").find('option').filter(function () {
                    return $(this).text() === sede_participante;
                }).prop('selected', true); 
                
                //Para cargar los grupo según la sede
                var vlocIdSede = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparNombreSede=" + sede_participante);
                var vlocHtmlGruposSegunSede = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparIdSede=" + vlocIdSede);
                $(".camposPopUpEditar:eq(6)").html(vlocHtmlGruposSegunSede);

                $(".camposPopUpEditar:eq(6)").find('option').filter(function () {
                    return $(this).text() === grupo;
                }).prop('selected', true);

                $(".camposPopUpEditar:eq(7)").val(cargo);

                $("#divFondoPopUpEditar").css({
                    "visibility": "visible"                    
                });

                $("#divPopUpEditar").css({
                    "height":"700px"
                });
            }

            // Para editar personal académico
            if (idTipoUsuarioAModificar == Cnt_Tipo_Usuario_Personal_Academico){
                $("#divCamposEditarPersonalAcademico").css({
                    "visibility":"visible",
                    "display":"block"
                });

                $(".camposPopUpEditar:eq(7)").val(nombres + " " + apellidos);
                $(".camposPopUpEditar:eq(8)").find('option').filter(function () {
                    return $(this).text() === tipoUsuario;
                }).prop('selected', true);
                $(".camposPopUpEditar:eq(9)").val(telefono);
                $(".camposPopUpEditar:eq(10)").val(correo_electronico);
                $(".camposPopUpEditar:eq(11)").find('option').filter(function () {
                    return $(this).text() === sede_personal_academico;
                }).prop('selected', true);
                $(".camposPopUpEditar:eq(12)").find('option').filter(function () {
                    return $(this).text() === grado_academico;
                }).prop('selected', true);
                $(".camposPopUpEditar:eq(13)").find('option').filter(function () {
                    return $(this).text() === rol;
                }).prop('selected', true);
                $(".camposPopUpEditar:eq(14)").val(cargo);

                $("#divFondoPopUpEditar").css({
                    "visibility": "visible"
                });

                $("#divPopUpEditar").css({
                    "height":"750px"
                });
            }

            // Para editar jurado, coordinador general, usuario general y administrador
            if (idTipoUsuarioAModificar != Cnt_Tipo_Usuario_Personal_Academico && idTipoUsuarioAModificar != Cnt_Tipo_Usuario_Participante){
                $("#divCamposEditarGenerico").css({
                    "visibility":"visible",
                    "display":"block"
                });

                $(".camposPopUpEditar:eq(15)").val(nombres + " " + apellidos);
                $(".camposPopUpEditar:eq(16)").find('option').filter(function () {
                    return $(this).text() === tipoUsuario;
                }).prop('selected', true);
                $(".camposPopUpEditar:eq(17)").val(telefono);
                $(".camposPopUpEditar:eq(18)").val(correo_electronico);

                $("#divFondoPopUpEditar").css({
                    "visibility": "visible"
                });

                $("#divPopUpEditar").css({
                    "height":"500px"
                });
            }
            
        } else
            funActivarAlerta("info", "No ha seleccionado Usuario!", "Por favor seleccione un usuario para poder editar!");
    });

    //Acción al cambiar el valor del select del tipo de usuario en 'Agregar Usuario'
    $(".camposPopUpAgregar:eq(1)").change(function() {
        var vlocValorSelect = $(this).val();
        
        if (vlocValorSelect == Cnt_Tipo_Usuario_Participante){     
            FunActivarCamposAgregarParticipante();
        }else if (vlocValorSelect == Cnt_Tipo_Usuario_Personal_Academico){
            FunActivarCamposAgregarPersonalAcademico();
        }else{
            FunDesactivarCamposAgregar();
        }
    });

    //Acción al cambiar el valor del select de la sede del participante
    $("#selectIdSedeParticipante").change(function (){
        FunActualizarSelectGrupoParticipante();
    });

    function FunActualizarSelectGrupoParticipante(){
        var vlocValorSelect = $("#selectIdSedeParticipante").val();

        var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparIdSede=" + vlocValorSelect);

        $("#idSedeParticipante").html(vlocResultadoAjax);
    }

    //Acciones al cambiar el valor del select de tipo de usuario en la vista de 'Registro Usuario'
    $("#tipoUNuevoAcceso").change(function() {
        vlocValorSelectTipoUsuario = $("#tipoUNuevoAcceso").val();        

        if (vlocValorSelectTipoUsuario == Cnt_Tipo_Usuario_Participante){     
            FunActivarCamposParticipanteAgregarUsuario();
            FunDesactivarCamposPersonalAcademicoAgregarUsuario();
            FunActualizarSelectGrupoParticipante();

            FunActualizarPantalla();
        }
        else if (vlocValorSelectTipoUsuario == Cnt_Tipo_Usuario_Personal_Academico){
            FunActivarCamposPersonalAcademicoAgregarUsuario();
            FunDesactivarCamposParticipanteAgregarUsuario();

            FunActualizarPantalla();
        }else{
            FunDesactivarCamposParticipanteAgregarUsuario();
            FunDesactivarCamposPersonalAcademicoAgregarUsuario();
            
            FunActualizarPantalla();           
        }
    });


    function FunActivarCamposAgregarParticipante(){
        $(".ocultaPar").hide();
        $(".ocultaPer").hide();
        $("#popUpAgregarCampo3, #popUpAgregarCampo4, #popUpAgregarCampo9").show();
        $("#divPopUpAgregar").css({
            'height':'550px'
        });
    }

    function FunDesactivarCamposAgregar(){
        $(".ocultaPar").show();
        $(".ocultaPer").show();
        $("#popUpAgregarCampo3, #popUpAgregarCampo4, #popUpAgregarCampo9").hide();
        $("#popUpAgregarCampo5, #popUpAgregarCampo6, #popUpAgregarCampo7, #popUpAgregarCampo8").hide();
        $("#divPopUpAgregar").css({
            'height':'360px'
        });
    }

    function FunActivarCamposAgregarPersonalAcademico(){
        $(".ocultaPar").hide();
        $(".ocultaPer").hide();
        $("#popUpAgregarCampo5, #popUpAgregarCampo6, #popUpAgregarCampo7, #popUpAgregarCampo8").show();
        $("#divPopUpAgregar").css({
            'height':'650px'
        });
    }

    //Acción al dar clic en el botón 'Agregar acceso'
    $("#idBotonAgregar").click(function () {
        if (idPersonaUsuario != "") {
            idPersona = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparIdPersonaUsuarioObtenerIdPersona=" + idPersonaUsuario);
            
            var listaUsuariosNoAsignados = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparIdPersona_ListaUsuariosNoAsignados=" + idPersona);

            if(listaUsuariosNoAsignados !== ""){
                $(".camposPopUpAgregar:eq(0)").val(nombres + " " + apellidos);
                $(".camposPopUpAgregar:eq(1)").html(listaUsuariosNoAsignados);

                $("#divFondoPopUpAgregar").css({
                    "visibility": "visible"
                });

                var vlocVerificador = $(".camposPopUpAgregar:eq(1)").val();

                if(vlocVerificador == Cnt_Tipo_Usuario_Participante){
                    FunActivarCamposAgregarParticipante();
                }else if(vlocVerificador == Cnt_Tipo_Usuario_Personal_Academico){
                    FunActivarCamposAgregarPersonalAcademico();
                    $("#divPopUpAgregar").css({
                        "height":"650px"
                    });
                }
            }else{
                funActivarAlerta("warning", "Tipos de usuarios completos!", "La persona " + nombres + " " + apellidos + " ya tiene todos los tipos de accesos existentes asignados!");
            }

        } else
            funActivarAlerta("info", "No ha seleccionado usuario!", "Por favor seleccione un usuario para poder agregar!");
    });

    //Acción al dar click en el notón 'Crear'
    $("#idBotonCrear").click(function () {
        window.location = "../../Vista/Administrador/RegistroUsuario.php";
    });

    //Clic al botón 'Cancelar' del PopUp Editar
    $("#buttonCancelarPopUpEditar").click(function () {
        $("#divFondoPopUpEditar").css({
            "visibility": "hidden"
        });

        FunActualizarTabla();
        FunDesactivarCamposEdicion();
        FunLimpiarCamposFormularioEditar();
    });

    //Clic al botón 'Cancelar' del PopUp Agregar
    $("#buttonCancelarPopUpAgregar").click(function () {
        $("#divFondoPopUpAgregar").css({
            "visibility": "hidden"
        });

        $(".ocultaPar").show();
        $(".ocultaPer").show();
        $("#popUpAgregarCampo3, #popUpAgregarCampo4, #popUpAgregarCampo9").hide();
        $("#popUpAgregarCampo5, #popUpAgregarCampo6, #popUpAgregarCampo7").hide();

        FunActualizarTabla();
    });

    //Clic al botón 'Guardar cambios'.
    $("#buttonGuardarCambiosPopUpEditar").click(function () {

        // Para obtener el id del usuario
        idPersona = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparIdPersonaUsuarioObtenerIdPersona=" + idPersonaUsuario);

        // Variables información participante
        var valor_tipo_usuario_participante = $(".camposPopUpEditar:eq(1)").val();
        var valor_telefono_participante = $(".camposPopUpEditar:eq(3)").val();
        var valor_correo_electronico_participante = $(".camposPopUpEditar:eq(4)").val();        
        var valor_sede_participante = $(".camposPopUpEditar:eq(5)").val();
        var valor_grupo_participante = $(".camposPopUpEditar:eq(6)").val();

        // Variables información única personal académico
        var valor_tipo_usuario_personal_academico = $(".camposPopUpEditar:eq(8)").val();
        var valor_telefono_personal_academico = $(".camposPopUpEditar:eq(9)").val();
        var valor_correo_electronico_personal_academico = $(".camposPopUpEditar:eq(10)").val();        
        var valor_sede_personal_academico = $('.camposPopUpEditar:eq(11)').val();
        var valor_grado_academico_personal_academico = $('.camposPopUpEditar:eq(12)').val();
        var valor_rol_personal_academico = $('.camposPopUpEditar:eq(13)').val();
        var valor_cargo_personal_academico = $('.camposPopUpEditar:eq(14)').val();

        // Variables información de jurados, coordinador general, usuario general y administrador
        var valor_tipo_usuario = $(".camposPopUpEditar:eq(16)").val();
        var valor_telefono = $(".camposPopUpEditar:eq(17)").val();
        var valor_correo_electronico = $(".camposPopUpEditar:eq(18)").val();        

        if(valor_tipo_usuario === idTipoUsuarioAModificar){
            idTipoUsuarioAModificar = 0;
        }

        /**Para ver los datos que se están enviando */
        console.log ("==== Para ver los datos que se están enviando ====");
        console.log("valor_tipo_usuario_participante: "+valor_tipo_usuario_participante);
        console.log("valor_telefono_participante: "+valor_telefono_participante);
        console.log("valor_correo_electronico_participante: "+valor_correo_electronico_participante);
        console.log("valor_sede_participante: "+valor_sede_participante);
        console.log("valor_grupo_participante: "+valor_grupo_participante);
        console.log("valor_tipo_usuario_personal_academico: "+valor_tipo_usuario_personal_academico);
        console.log("valor_telefono_personal_academico: "+valor_telefono_personal_academico);
        console.log("valor_correo_electronico_personal_academico: "+valor_correo_electronico_personal_academico);
        console.log("valor_sede_personal_academico: "+valor_sede_personal_academico);
        console.log("valor_grado_academico_personal_academico: "+valor_grado_academico_personal_academico);
        console.log("valor_cargo_personal_academico: "+valor_cargo_personal_academico);
        console.log("valor_tipo_usuario: "+valor_tipo_usuario);
        console.log("valor_telefono: "+valor_telefono);
        console.log("valor_correo_electronico: "+valor_correo_electronico);
        /********************************************/

        if(!validarTelefono(valor_telefono_participante, idPersona) &&
        !validarTelefono(valor_telefono_personal_academico, idPersona) &&
        !validarTelefono(valor_telefono, idPersona)){

            if (validarCorreo(valor_correo_electronico_participante) || 
                validarCorreo(valor_correo_electronico_personal_academico) || 
                validarCorreo(valor_correo_electronico)) {
                
                if (!validarCorreoRepetido(valor_correo_electronico_participante, idPersona) &&
                    !validarCorreoRepetido(valor_correo_electronico_personal_academico, idPersona) &&
                    !validarCorreoRepetido(valor_correo_electronico, idPersona)){

                    $vlocVerificarTelefonoCorreo = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionEstudiantes.php?vparTelefonoVerif=" + valor_telefono + "&vparCorreoVerif=" + valor_correo_electronico);
                
                    if($vlocVerificarTelefonoCorreo === Cnt_Verificacion_Aprobado){
                        $vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?"+
                            "vparIdPersonaUsuario=" + idPersonaUsuario +
                            "&vparIdTipoUsuarioAModificar=" + idTipoUsuarioAModificar +

                            "&vparIdTipoUsuarioParticipante=" + valor_tipo_usuario_participante +
                            "&vparTelefonoParticipante=" + valor_telefono_participante +
                            "&vparCorreoElectronicoParticipante=" + valor_correo_electronico_participante +
                            "&vparSedeParticipante=" + valor_sede_participante +
                            "&vparGrupoParticipante=" + valor_grupo_participante + 
                            
                            "&vparTipoUsuarioPersonalAcademico=" + valor_tipo_usuario_personal_academico + 
                            "&vparTelefonoPersonalAcademico=" + valor_telefono_personal_academico + 
                            "&vparCorreoElectronicoPersonalAcademico=" + valor_correo_electronico_personal_academico + 
                            "&vparSedePersonalAcademico=" + valor_sede_personal_academico + 
                            "&vparGradoAcademicoPersonalAcademico=" + valor_grado_academico_personal_academico + 
                            "&vparIdRolPersonalAcademico=" + valor_rol_personal_academico +
                            "&vparCargoPersonalAcademico=" + valor_cargo_personal_academico + 
                            "&vparCargoAEditarPersonalAcademico=" + rol +
                            
                            "&vparTipoUsuario=" + valor_tipo_usuario +
                            "&vparTelefono=" + valor_telefono + 
                            "&vparCorreoElectronico=" + valor_correo_electronico
                        );
                            
                        if ($vlocResultadoAjax == 1) {
                            funActivarAlerta("success", "Usuario Editado!", "Se ha editado el usuario con éxito");

                            $("#divFondoPopUpEditar").css({
                                "visibility": "hidden"
                            });

                            FunActualizarTabla();
                            FunLimpiarCamposFormularioEditar();
                            FunDesactivarCamposEdicion();
                        } else
                            funActivarAlerta("error", "Error!", "Ha ocurrido un error al intentar editar el Usuario!");

                    }else{
                        funActivarAlerta("warning", "Registro existente!", $vlocVerificarTelefonoCorreo);
                    }
                }else{
                    funActivarAlerta("info", "Correo ya registrado!", "El correo que intenta registrar ya se encuentra registrado");    
                }

            } else
                funActivarAlerta("info", "Correo inválido!", "Agregue un correo electrónico válido: example@gmail.com!");

        }else{
            funActivarAlerta("info", "Teléfono ya registrado!", "El teléfono que intenta registrar ya se encuentra registrado.");
        }
    });

    //Clic al botón 'Agregar acceso'
    $("#buttonAgregarUsuarioPopUpAgregar").click(function() {
        var Valor_Id_Persona_Usuario = idPersonaUsuario;
        var Valor_Tipo_Usuario = $(".camposPopUpAgregar:eq(1)").val();

        //Datos participante
        var Valor_Sede_Participante = 0;
        var Valor_Grupo_Participante = 0;
        var Valor_Carnet_Participante = 0;

        //Datos personal académico
        var Valor_Sede_Personal_Academico = 0;
        var Valor_Grado_Academico_Personal_Academico = 0;
        var Valor_Rol_Personal_Academico = 0;
        var Valor_Cargo_Personal_Academico = '';

        if (Valor_Tipo_Usuario == Cnt_Tipo_Usuario_Participante){
            Valor_Sede_Participante = $(".camposPopUpAgregar:eq(2)").val();
            Valor_Grupo_Participante = $(".camposPopUpAgregar:eq(3)").val();
            Valor_Carnet_Participante = $(".camposPopUpAgregar:eq(4)").val();

        }else if (Valor_Tipo_Usuario == Cnt_Tipo_Usuario_Personal_Academico){
            Valor_Sede_Personal_Academico = $(".camposPopUpAgregar:eq(5)").val();
            Valor_Grado_Academico_Personal_Academico = $(".camposPopUpAgregar:eq(6)").val();
            Valor_Rol_Personal_Academico = $(".camposPopUpAgregar:eq(7)").val();
            Valor_Cargo_Personal_Academico = $(".camposPopUpAgregar:eq(8)").val();
        }
                
        // var valor_Id_Persona = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparIdPersonaUsuarioObtenerIdPersona=" + idPersonaUsuario);        
        
        var vlocResultadoAgregadoUsuario = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?"+
        "vparIdPersona_AgregarUsuario=" + idPersona + "&vparIdTipoUsuario_AgregarUsuario=" + Valor_Tipo_Usuario +
        "&vparSedeParticipante=" + Valor_Sede_Participante + 
        "&vparGrupoParticipante=" + Valor_Grupo_Participante +
        "&vparCarnetParticipante=" + Valor_Carnet_Participante +
        "&vparSedePersonalAcademico=" + Valor_Sede_Personal_Academico + 
        "&vparGradoAcademicoPersonalAcademico=" + Valor_Grado_Academico_Personal_Academico +
        "&vparRolPersonalAcademico="+ Valor_Rol_Personal_Academico +
        "&vparCargoPersonalAcademico=" + Valor_Cargo_Personal_Academico);
        
        if (vlocResultadoAgregadoUsuario == 1){
            funActivarAlerta("success", "Usuario Agregado!", "Se ha agregado el usuario con éxito");

            $("#divFondoPopUpAgregar").css({
                "visibility": "hidden"
            });

            FunActualizarTabla();
        }else{
            funActivarAlerta("error", "Error!", "Ha ocurrido un error al intentar agregar el usuario");
            $("#divFondoPopUpAgregar").css({
                "visibility": "hidden"
            });
        }
            
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

    function FunActualizarPantalla(){
        const vlocAnchoPantalla2 = FunObtenerAnchoPantalla();

        if (vlocValorSelectTipoUsuario == Cnt_Tipo_Usuario_Participante){     

            if(vlocAnchoPantalla2 > 1000){
                $(".formulario_general").css({
                    "height" : "1050px"
                });
            }else if (vlocAnchoPantalla2 <= 1000 && vlocAnchoPantalla2 > 767){
                $(".formulario_general").css({
                    "height" : "900px"
                });
            }else if(vlocAnchoPantalla2 <= 767 && vlocAnchoPantalla2 > 700){
                $(".formulario_general").css({
                    "height" : "1880px"
                });
            }else if (vlocAnchoPantalla2 <= 700 && vlocAnchoPantalla2 > 480){
                $(".formulario_general").css({
                    "height" : "1930px"
                });
            }else if (vlocAnchoPantalla2 <= 480){
                $(".formulario_general").css({
                    "height" : "1620px"
                });
            }
        }
        else if (vlocValorSelectTipoUsuario == Cnt_Tipo_Usuario_Personal_Academico){

            if(vlocAnchoPantalla2 > 1000){
                $(".formulario_general").css({
                    "height" : "1050px"
                });
            }else if (vlocAnchoPantalla2 <= 1000 && vlocAnchoPantalla2 > 767){
                $(".formulario_general").css({
                    "height" : "900px"
                });
            }else if(vlocAnchoPantalla2 <= 767 && vlocAnchoPantalla2 > 700){
                $(".formulario_general").css({
                    "height" : "1980px"
                });
            }else if (vlocAnchoPantalla2 <= 700 && vlocAnchoPantalla2 > 480){
                $(".formulario_general").css({
                    "height" : "2030px"
                });
            }else if (vlocAnchoPantalla2 <= 480){
                $(".formulario_general").css({
                    "height" : "1680px"
                });
            }

        }else{

            if(vlocAnchoPantalla2 > 1000){
                $(".formulario_general").css({
                    "height" : "820px"
                });
            }else if (vlocAnchoPantalla2 <= 1000 && vlocAnchoPantalla2 > 767){
                $(".formulario_general").css({
                    "height" : "730px"
                });
            }else if(vlocAnchoPantalla2 <= 767 && vlocAnchoPantalla2 > 700){
                $(".formulario_general").css({
                    "height" : "1550px"
                });
            }else if (vlocAnchoPantalla2 <= 700 && vlocAnchoPantalla2 > 480){
                $(".formulario_general").css({
                    "height" : "1600px"
                });
            }else if (vlocAnchoPantalla2 <= 480 && vlocAnchoPantalla2 > 405){
                $(".formulario_general").css({
                    "height" : "1300px"
                });
            }else if (vlocAnchoPantalla2 <= 405){
                $(".formulario_general").css({
                    "height" : "1330px"
                });
            }
            
        }
    }

    function FunActualizarTabla() {
        $vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparObtenerListaUsuario=" + Cnt_Obtener_Lista_Usuarios)
        $("#idTable tbody").html($vlocResultadoAjax);
        idPersonaUsuario = "";
    }

    function FunDesactivarCamposEdicion(){
        $("#divCamposEditarParticipante").css({
            "Visibility":"hidden",
            "display":"none"
        });

        $("#divCamposEditarPersonalAcademico").css({
            "Visibility":"hidden",
            "display":"none"
        });

        $("#divCamposEditarGenerico").css({
            "Visibility":"hidden",
            "display":"none"
        });
    }

    function FunLimpiarCamposFormularioEditar(){        
        $(".camposPopUpEditar").val('');
    }

    function validarCorreo(correo) {
        // Expresión regular para validar el correo
        var regex = /\S+@\S+\.\S+/;
        return regex.test(correo);
    }

    function validarCorreoRepetido(vparCorreo, vparIdPersona){
        var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparCorreoRepetido=" + vparCorreo + "&vparIdPersonaRepetido=" + vparIdPersona);
        if (vlocResultadoAjax > 0 )
            return true;
        else
            return false;
    }

    function validarTelefono(vparTelefono, vparIdPersona){
        var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparTelRepetido=" + vparTelefono + "&vparIdPersonaRepetido=" + vparIdPersona);

        if (vlocResultadoAjax > 0 )
            return true;
        else
            return false;
    }
    //Fin Para funcionalidad de AdministraciónPersonalAcadémico

    function FunDesactivarCamposParticipanteAgregarUsuario(){
        $(".rowParticipante").css({
            "Visibility":"hidden",
            "display":"none"
        });

        // $(".formulario_general").css({
        //     "height" : "850px"
        // });
    }

    function FunActivarCamposParticipanteAgregarUsuario(){
        $(".rowParticipante").css({
            "Visibility":"visible",
            "display":"flex"
        });

        // $(".formulario_general").css({
        //     "height" : "1500px"
        // });
    }

    function FunDesactivarCamposPersonalAcademicoAgregarUsuario(){
        $(".rowPersonalAcademico").css({
            "Visibility":"hidden",
            "display":"none"
        });

        // $(".formulario_general").css({
        //     "height":"850px"
        // });
    }

    function FunActivarCamposPersonalAcademicoAgregarUsuario(){
        $(".rowPersonalAcademico").css({
            "Visibility":"visible",
            "display":"flex"
        });

        // $(".formulario_general").css({
        //     "height":"1500px"
        // });
    }

    //Para que la letra que se coloca en el carnet del participante sea siempre mayúscula
    $('#inputCarnetParticipante').on('input', function() {
        var inputValue = $(this).val();
        if (inputValue.length >= 10) {
            var capitalizedValue = inputValue.substring(0, 9) + inputValue.charAt(9).toUpperCase() + inputValue.substring(10);
            $(this).val(capitalizedValue);
        }
    });

    $('#BtnAgregarP').click(function () {
        event.preventDefault();
        var resultValidacion = validarcampos();
        console.log(resultValidacion);

        //Cédula de la persona para verificar
        var cedula = $("#pCedula").val();
        var resultadoValidacionCedula = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparCedulaVerificacion=" + cedula);

        //Obtenemos los valores del participante
        noCarnetParticipante = $("#inputCarnetParticipante").val();
        idSedeParticipante = $("#selectIdSedeParticipante").val();
        idGrupoParticipante = $("#idSedeParticipante").val();
        var resultValidacionCarnetParticipante = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionUsuarios.php?vparNoCarnetVerificacion=" + noCarnetParticipante);

        //Obtenemos los valores del personal académico
        idGradoAcademicoPersonalAcademico = $("#selectIdGradoAcademicoPersonalAcademico").val();
        idSedePersonalAcademico = $("#selectIdSedePersonalAcademico").val();
        CargoPersonalAcademico = $("#inputCargoPersonalAcademico").val();
        idRolPersonalAcademico = $("#selectIdRolPersonalAcademico").val();

        //Validar los campos de inscripción
        if (resultValidacion) {
            
            //Validar si existe el carnet registrado
            if(resultValidacionCarnetParticipante != Cnt_Obtener_Carnet){

                //Validar si existe la cédula registrada
                if(resultadoValidacionCedula != 1){
                    const fdatos = $("#form_general").serialize();
                    var usuario = $('#pInputUsuario').val();
                    $.ajax({
                        url: "../../Controlador/Administrador/CBuscarRegistroAca.php?usuario=" + usuario,
                        type: 'POST',
                        data: fdatos,
                        success: function (result) {
                            pNombre = $('#pname').val();
                            sNombre = $('#sname').val();
                            pApellido = $('#papellido').val();
                            sApellido = $('#sapellido').val();
                            telefonoU = $('#tel').val();
                            correo = $('#pInputEmail').val();
                            idTipoUsuario = $('#tipoUNuevoAcceso').val();
                            usuario = $('#pInputUsuario').val();
                            contrasena = $('#pinputContraseña').val();
                            cedula = $('#pCedula').val();

                            console.log("==========Datos nuevo usuario===============");
                            console.log("pNombre" + pNombre);
                            console.log("sNombre" + sNombre);
                            console.log("pApellido" + pApellido);
                            console.log("sApellido" + sApellido);
                            console.log("telefonoU" + telefonoU);
                            console.log("correo" + correo);
                            console.log("idTipoUsuario" + idTipoUsuario);
                            console.log("usuario" + usuario);
                            console.log("contrasena" + contrasena);
                            console.log("cedula" + cedula);
                            console.log("===========================================");

                            if (result.length == 0) {
                                $.ajax({
                                    url: "../../Controlador/Administrador/CAdministracionUsuarios.php?vparPNombre=" + pNombre + 
                                    "&vparSNombre=" + sNombre + "&vparPApellido=" + pApellido + "&vparSApellido=" + sApellido +
                                    "&vparTelefono=" + telefonoU + "&vparCorreo=" + correo + "&vparIdTipoU=" + idTipoUsuario +
                                    "&vparUsuario=" + usuario + "&vparContrasena=" + contrasena + "&vparCedula=" + cedula + 
                                    "&vparNoCarnetParticipante=" + noCarnetParticipante + "&vparIdSedeParticipante=" + idSedeParticipante + 
                                    "&vparIdGrupoParticipante=" + idGrupoParticipante + "&vparIdGradoAcademicoPersonalAcademico=" + idGradoAcademicoPersonalAcademico  + 
                                    "&vparIdSedePersonalAcademico=" + idSedePersonalAcademico + "&vparCargoPersonalAcademico=" + CargoPersonalAcademico + 
                                    "&vparIdRolPersonalAcademico=" + idRolPersonalAcademico,
                                    type: 'POST',
                                    data: fdatos,
                                    cache: false,
                                    success: function (result) {
                                        console.log(result);
                                        if (result.length > 0) {

                                            Swal.fire({
                                                title: "Acceso almacenado correctamente",
                                                text: "El acceso se registro de forma correcta, se ha enviado un correo para que el usuario reciba su contraseña y usuario",
                                                icon: "success"
                                            })
                                            .then(() => {
                                                // window.location.href = "../../Vista/Administrador/Index-Admin.php";
                                                var vlocFormData = new FormData();
                                                var vlocPrimerNombre = $("#pname").val();
                                                var vlocPrimerApellido = $("#papellido").val();
                                                var vlocCorreo = $("#pInputEmail").val();
                                                var vlocUsuario = $("#pInputUsuario").val();
                                                var vlocContra = $("#pinputContraseña").val();

                                                vlocFormData.append('Correo', vlocCorreo);
                                                vlocFormData.append('Usuario', vlocUsuario);
                                                vlocFormData.append('Contra', vlocContra);
                                                vlocFormData.append('PrimerNombre', vlocPrimerNombre);
                                                vlocFormData.append('PrimerApellido', vlocPrimerApellido);

                                                $.ajax({
                                                    url: "../../Controlador/Participante/CEnvioCredencialesNuevoAcceso.php?primerNombre=" + vlocPrimerNombre +
                                                    "&primerApellido=" + vlocPrimerApellido + "&correo=" + vlocCorreo + "&usuario=" + vlocUsuario + "&contra=" + vlocContra,
                                                    type: "GET",
                                                    cache: false,
                                                    contentType: false,
                                                    processData: false,
                                                    success:function (result){
                                                        window.location.href = "../../Vista/Administrador/InicioAdministradorCE.php";
                                                        //swal(`The returned value is: ${value}`);
                                                    },
                                                    error: function(xhr, status, error) {
                                                    console.log(error);
                                                    alert("Error Ajax: " + error);
                                                    }
                                                });

                                            });
                                        }
                                        else {
                                            alert('No logrado');
                                        }
                                    }
                                });
                            } else {
                                alert(result);
                                // swal({
                                //     title: "Atención!",
                                //     text: result,
                                //     icon: "warning",
                                // });
                            }
                        }
                    });
                }else{
                    funActivarAlerta("warning", "Cédula ya existente!", "La cédula que intenta ingresar ya se encuentra registrado");    
                }
            }else{
                funActivarAlerta("warning", "Carnet ya existente!", "El número de carnet que intenta ingresar ya se encuentra registrado");
            }
        } else {
            return false;
        }

        event.preventDefault();
    });


  

});
