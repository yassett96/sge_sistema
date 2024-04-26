/**Para inscripción a evento feria y confirmación de participantes */

    /**
     * Cuando se confirma el código del participante inscribiendo
     */
    const Cnt_Codigo_Corecto = 1;

    /**
     * Cuando se elimina el registro de confirmación de participante por tiempo exedido
     */
    const Cnt_Tiempo_Exedido = 1;

    /**
     * Existencia de registro de confirmación del participante
     */
    const Cnt_Existe_Registro_Confirmacion_Participante = 1;

    /**
     * La variable no es vacía
     */
    const Cnt_Contiene_Algun_Valor = 1;    

    /**
     * Cuando se registro el envío de mensaje
     */
    const Cnt_Registro_Envio_Mensaje_Exitoso = 1;

    /**
     * Para mostrar el botón de 'Cancelar' en los popups
     */
    const Cnt_Mostrar_Boton_Cancelar = true;

    /**
     * Para verificar si se confirmo la participación
     */
    const Cnt_Participacion_Confirmada = 1;

    /**
     * Indica que el proyecto fue abandonado por los integrantes, por ende se eliminó el proyecto
     */
    const Cnt_Proyecto_Abandonado = 1;

    /**
     * Estados que tienen los proyectos
     */

    const Cnt_Estado_Proyecto_Inscrito = 1;

    const Cnt_Estado_Proyecto_Confirmado = 2;

    const Cnt_Estado_Proyecto_Abandonado = 3;
    /******************************************************************************************** */

    /**Constantes para obtener los datos del participante a inscribir según la posición en el array */
        const Cnt_Primer_Nombre_Participante = 0;
        const Cnt_Segundo_Nombre_Participante = 1;
        const Cnt_Primer_Apellido_Participante = 2;
        const Cnt_Segundo_Apellido_Participante = 3;
        const Cnt_Cedula_Participante = 4
        const Cnt_Numero_Carnet_Participante = 5;
        const Cnt_Id_Grupo_Participante = 6;
        const Cnt_Id_Sede_Participante = 7;
        const Cnt_Telefono_Participante = 8;
        const Cnt_Correo_Electronico_Participante = 9;
        const Cnt_Codigo_Registro = 10;
    /*********************************************** */

    /**Constantes para indicar la posición de los inputs de los formularios para inscribir un proyecto al evento */
        const Cnt_Valor_Input_Nombres = 0;
        const Cnt_Valor_Input_Apellidos = 1;
        const Cnt_Valor_Input_Cedula = 2;
        const Cnt_Valor_Input_Carnet = 3;
        const Cnt_Valor_Input_Grupo = 4;
        const Cnt_Valor_Input_Sede = 5;
        const Cnt_Valor_Input_Telefono = 6;
        const Cnt_Valor_Input_Correo = 7;  
    /*********************************************** */
    
/*********************************************** */

/**Para vista de Detalles del proyecto */

    const Cnt_Obtener_Proyectos = true;
    const Cnt_Obtener_Codigo_Registro_Inscriptor = true;
    const Cnt_Obtener_Datos_Proyectos = true;
    const Cnt_Obtener_Datos_Integrantes = true;
    const Cnt_Verificar_Existencia_Proyecto = true;
    const Cnt_No_Existe_Proyecto_Inscrito = 0;
    const Cnt_No_Maximo_Proyectos_Inscritos = 3;
    
    /**Para obtener cada dato del proyecto */
        const Cnt_Nombre = 0;
        const cnt_Descripcion = 1;
        const Cnt_Nombre_Categoria = 2;
        const Cnt_Nombre_SubCategoria = 3;
        const Cnt_Primer_Nombre_Tutor = 4;
        const Cnt_Primer_Apellido_Tutor = 5;

    /**Para obtener cada dato del integrante */
        const Cnt_Primer_Nombre = 0;
        const Cnt_Segundo_Nombre = 1;
        const Cnt_Primer_Apellido = 2;
        const Cnt_Segundo_Apellido = 3;
        const Cnt_Cedula = 4;
        const Cnt_ID_Numero_Carnet = 5;
        const Cnt_Grupo = 6;
        const Cnt_Año_Academico = 7;
        const Cnt_Sede = 8;

    /**Para referirse a los campos de los integrantes */
        const Cnt_Campo_Nombres_Participante_1 = 0;
        const Cnt_Campo_Carnet_Participante_1 = 1;
        const Cnt_Campo_Nombres_Participante_2 = 2;
        const Cnt_Campo_Carnet_Participante_2 = 3;
        const Cnt_Campo_Nombres_Participante_3 = 4;
        const Cnt_Campo_Carnet_Participante_3 = 5;

    /**Para referirse a los integrantes */
        const Cnt_Integrante_1 = 0;
        const Cnt_Integrante_2 = 1;
        const Cnt_Integrante_3 = 2;
        
/*********************************************** */

/**Para inscribir Proyecto */

    /**
     * Cuando se obtiene el carnet del participante
     */
    const Cnt_Obtener_Carnet = 1;

    /**
     * Cuando un participante se puede inscribir en la subcategoría seleccionada.
     */
    const Cnt_Acceso_Permitido = 1;

    /**
     * Cuando se insertó correctamente la relación del evento con el proyecto
     */
    const Cnt_Se_Inserto_Evento_Proyecto = 1;
/*********************************************** */

/**Para gestionar el personal académico */

    /**
     * Cuando se obtiene la lista del personal académico
     */    
    const Cnt_Obtener_Lista_Personal_Acdemico = true;

    /**
     * Cuando se obtiene la lista de los usuarios
     */    
    const Cnt_Obtener_Lista_Usuarios = true;
/*********************************************** */

/**Para gestionar los invitados */

    /**
     * Cuando se obtiene la lista del personal académico
     */    
    const Cnt_Obtener_Lista_Invitados = true;

    /**
     * Cuando se va a guardar un invitado
     */    
     const Cnt_Guardar_Invitado = true;

     /**
     * Cuando se va a guardar un invitado
     */    
     const Cnt_Invitado_Guardado = 1;
/*********************************************** */

/**Para gestionar los estudiantes */

    /**
     * Cuando se obtiene la lista del personal académico
     */    
    const Cnt_Obtener_Lista_Estudiantes = true;

    /**
     * Cuando se va a guardar un estudiante
     */    
    const Cnt_Guardar_Estudiante = true;

    /**
     * Cuando no se encontro teléfeno ni correo en Persona, para evitar que se ingresen los mismos
     */    
    const Cnt_Verificacion_Aprobado = '';

/*********************************************** */

/**Para gestionar sección de noticias */

    /**
     * Cuando se obtiene la información de las noticias
     */    
    const Cnt_Obtener_Informacion_Noticias = true;

    /**
     * Posición de la descripción de la noticia
     */    
    const Cnt_Posicion_Descripcion = 0;

    /**
     * Posición de la dirección de la imagen de la noticia
     */    
    const Cnt_Posicion_Url_Imagen = 1;

    /**
     * Cuando se obtiene la imagen de la sección de noticias 1
     */    
    const Cnt_Imagen_Seccion_Noticia_1 = 1;

    /**
     * Cuando se obtiene la imagen de la sección de noticias 2
     */    
    const Cnt_Imagen_Seccion_Noticia_2 = 2;

    /**
     * Cuando se obtiene la imagen de la sección de noticias 3
     */    
    const Cnt_Imagen_Seccion_Noticia_3 = 3;
    
/*********************************************** */

/**Para gestionar sección de imágenes de carrusel inicio */

    /**
     * Cuando se obtiene la información de las imágenes del carrusel de inicio
     */    
    const Cnt_Obtener_Informacion_Imagenes_Carrusel_Inicio = true;

    /**
     * Cuando se obtiene la imagen del carrusel de inicio 1
     */    
    const Cnt_Imagen_Carrusel_Inicio_1 = 4;

    /**
     * Cuando se obtiene la imagen del carrusel de inicio 2
     */    
    const Cnt_Imagen_Carrusel_Inicio_2 = 5;

    /**
     * Cuando se obtiene la imagen del carrusel de inicio 3
     */    
    const Cnt_Imagen_Carrusel_Inicio_3 = 6;


    
/*********************************************** */

/**Para gestionar sección de imágenes de carrusel evento */

    /**
     * Cuando se obtiene la información de las imágenes del carrusel de inicio
     */    
    const Cnt_Obtener_Informacion_Imagenes_Carrusel_Evento = true;

    /**
     * Cuando se obtiene la imagen del carrusel de evento 1
     */    
    const Cnt_Imagen_Carrusel_Evento_1 = 7;

    /**
     * Cuando se obtiene la imagen del carrusel de evento 2
     */    
    const Cnt_Imagen_Carrusel_Evento_2 = 8;

    /**
     * Cuando se obtiene la imagen del carrusel de evento 3
     */    
    const Cnt_Imagen_Carrusel_Evento_3 = 9;


    
/*********************************************** */

/**Para referenciar a los id's de los tipos de usuarios */
    /**Participante */
    const Cnt_Tipo_Usuario_Participante = 1;

    /**Jurado */
    const Cnt_Tipo_Usuario_Jurado = 2;

    /**Personal acamdémico */
    const Cnt_Tipo_Usuario_Personal_Academico = 3;

    /**Coordinador general */
    const Cnt_Tipo_Usuario_Coordinador_General = 4;

    /**Usuario general */
    const Cnt_Tipo_Usuario_Usuario_General = 5;

    /**Administrador */
    const Cnt_Tipo_Usuario_Administrador = 6;
/*********************************************** */

/**Para gestionar la información del proyecto en su evaluación */
    /**Posición del nombre en el resultado de la consulta */
    const Cnt_Nombre_Proyecto = 0;

    /**Posición de la categoría en el resultado de la consulta */
    const Cnt_Categoria = 1;

    /**Posición de la sub categoría en el resultado de la consulta */
    const Cnt_Sub_Categoria = 2;
    
    /**Posición de la descripción en el resultado de la consulta */
    const Cnt_Descripcion = 3;

/*********************************************** */

/**Para gestionar y validar la correcta puntuación de los criterios de los proyectos*/
    // /**Formato 1 */
    // const Cnt_Puntuacion_Contenido_Formato_1 = 20;
    // const Cnt_Puntuacion_Creatividad_Formato_1 = 20;
    // const Cnt_Puntuacion_Exposicion_Formato_1 = 30;
    // const Cnt_Puntuacion_Preguntas_Formato_1 = 30;

    // /**Formato 2 */
    // const Cnt_Puntuacion_Creatividad_Formato_2 = 20;
    // const Cnt_Puntuacion_Exposicion_Formato_2 = 40;
    // const Cnt_Puntuacion_Preguntas_Formato_2 = 40;
/*********************************************** */

/**Para gestionar sección de información de evento */

    /** Posición del nombre del evento */
    const Cnt_Nombre_Evento_Info_Evento = 0;

    /** Posición del nombre de la categoría */
    const Cnt_Nombre_Categoria_Info_Evento = 1;

    /** Posición del nombre de la subcategoría */
    const Cnt_Nombre_Subcategoria_Info_Evento = 2;

    /** Posición del nombre del año académico */
    const Cnt_Nombre_Año_Academico_Info_Evento = 3;

/*********************************************** */

/**Para gestionar sección de línea de tiempo */

    /**
     * Cuando se obtiene la información de los enlaces de las fases del evento
     */    
    const Cnt_Obtener_Informacion_Enlaces_Linea_Tiempo = true;

    /**
     * Cuando se necesita eliminar el útltimo enlace que está registrado
     */    
    const Cnt_Eliminar_Enlace_Linea_Tiempo = true;

    /**
     * Cuando se obtiene la fase de los enlaces
     */    
    const Cnt_ID = 0;

    /**
     * Cuando el enlace de la línea de tiempo es eliminado 
     */    
    const Cnt_Enlace_Linea_Tiempo_Eliminado = 1;

    /**
     * Cuando el enlace de la línea de tiempo es editado 
     */    
    const Cnt_Enlace_Linea_Tiempo_Editado = 1;

    /**
     * Cuando el enlace de la línea de tiempo es agregado
     */    
    const Cnt_Enlace_Linea_Tiempo_Agregado = 1;

    /**
     * Cuando se obtiene la fase de los enlaces
     */    
    const Cnt_Posicion_Fase = 1;
    
    /**
     * Cuando se obtiene el enlace de los enlaces
     */    
    const Cnt_Posicion_Enlace = 2;

    /**
     * Texto que se muestra cuando no existe un enlace
     */
    const Cnt_Texto_Sin_Enlace = "Sin enlace";
    
/*********************************************** */

/** Contantes Generales */
    /**
     * Para entrar a la ejecución en un ajax
     */
    const Cnt_Ejecutar_Ajax = 1;

    /**
     * La variable está vacía
     */
    const Cnt_Valor_Vacio = '';

    /**
     * La variable es Nula
     */
    const Cnt_Valor_Nulo = null;

    /**
     * Para color del botón de confirmación de una alerta SWAL (SweetAlert)
     */
    const Cnt_Color_Boton_Confirmacion = '#3085d6';

    /**
     * Para color del botón de cancelación de una alerta SWAL (SweetAlert)
     */
    const Cnt_Color_Boton_Cancelacion = '#d33';

    /**
     * Para evaluar si se ha confirmado la cancelación de la inscripcion
     */
    const Cnt_Cancelacion_Confirmada = true;
/*********************************************** */