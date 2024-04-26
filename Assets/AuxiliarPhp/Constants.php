<?php
    /**Constantes para presentación de index*/
    define("CteExisteEventoEnAñoActual", 1);
    /****************************************/
    /**Constantes para conexión a base de datos */    
    define("CteHost", "Localhost");
    define("CteUser", "root");
    define("CtePassword", "1234");
    define("CteBDName", "sge_bd_2");
    /****************************************/

    /**Constantes para Paths de seguridad */
    define("CtePathSecurity", "http://localhost/SGE_V1/index.html");
    /****************************************/    

    /**Constantes para envío de mensaje, Twilio */
    define("CteNumeroCelularTwilio", "+15165185046");
    define("CteCuentaSID", "AC433b3d8b7bb73eef351f85c5b6b70af1");
    define("CteTokenCuenta", "05e6a0a4cfd694029c281c5fce649b28");
    /****************************************/    

    /**Constantes para inscripción del proyecto con los participantes al eventeo Feria */
    define("CteExisteParticipanteEnProyecto", 1);
    define("CteNoExisteCategoriaEvento", null);
    define("CteAccesoPermitido", 1);
    define("CteSeInsertoEventoProyecto", 1);
    define("CteFormularioCompletado", 1);
    /****************************************/    

    /**Constantes generales */
    define("CteValorNull", null);
    define("CtePosicionValorExistenciaProyecto", 0);
    /****************************************/    

    /**Constantes para definir los nombres de los meses */
    define("CteEnero", "01");
    define("CteFebrero", "02");
    define("CteMarzo", "03");
    define("CteAbril", "04");
    define("CteMayo", "05");
    define("CteJunio", "06");
    define("CteJulio", "07");
    define("CteAgosto", "08");
    define("CteSeptiembre", "09");
    define("CteOctubre", "10");
    define("CteNoviembre", "11");
    define("CteDiciembre", "12");
    /****************************************/    

    /**Constantes para definir tipos de usuarios */
    define("CteParticipante", "1");
    define("CteJurado", "2");
    define("CtePersonalAcademico", "3");
    define("CteCoordinadorGeneral", "4");
    define("CteUsuarioGeneral", "5");
    define("CteAdministrador", "6");
    /****************************************/ 

    /**Constantes para definir cargos */
    define("CteDecano", 1);
    define("CteViceDecano", 2);
    define("CteJefeDepartamento", 3);
    define("CteCoordinadorArea", 4);
    define("CteSecretario", 5);
    define("CteDocente", 6);
    define("CteTutor", 7);
    define("CteApoyo", 8);
    define("CteInvitado", 9);
    /****************************************/ 

    /**Constantes para saber los estados de un proyecto */
    define("CteEstadoInscrito", 1);
    define("CteEstadoConfirmado", 2);
    define("CteEstadoAbandonado", 3);
    /****************************************/ 
?>