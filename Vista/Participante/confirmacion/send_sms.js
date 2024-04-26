// Download the helper library from https://www.twilio.com/docs/node/install
    // Find your Account SID and Auth Token at twilio.com/console
    // and set the environment variables. See http://twil.io/secure

    // <script src="../../Assets/js/Participante/inscripcionEventoFeria.js"></script>                 
    // import {vExportTelParticipante} from '../../../Assets/js/Participante/inscripcionEventoFeria';
    // import {vExportNomApeParticipante} from '../../../Assets/js/Participante/inscripcionEventoFeria';

    // const vlocVExports = require('../../../Assets/js/Participante/inscripcionEventoFeria.js');
    // let vlocTelParticipante = vlocVExports.vExportTelParticipante;
    // let vlocNomApeParticipante = vlocVExports.vExportNomApeParticipante;

    // let vlocTelParticipante = vlocTelParticipante;
    // let vlocNomApeParticipante = vlocNomApeParticipante;
    
    // import {vExportTelParticipante} from '../../../Assets/js/Participante/inscripcionEventoFeria.js';
    // import {vExportNomApeParticipante} from '../../../Assets/js/Participante/inscripcionEventoFeria.js';
    // import {vBoolExportActivarTwilio} from '../../../Assets/js/Participante/inscripcionEventoFeria.js';

    // import {vExportTelParticipante} from 'C:/xampp/htdocs/sge_sistema/SGE_V1/Assets/js/Participante/inscripcionEventoFeria.js';
    // import {vExportNomApeParticipante} from 'C:/xampp/htdocs/sge_sistema/SGE_V1/Assets/js/Participante/inscripcionEventoFeria.js';
    // import {vBoolExportActivarTwilio} from 'C:/xampp/htdocs/sge_sistema/SGE_V1/Assets/js/Participante/inscripcionEventoFeria.js';
    if(vBoolExportActivarTwilio == true){
        alert("ExportActivarTwilio es igual a True");
    }    
    const accountSid = "AC29d0b62f57c99f365aa7a1589f32dd25";    
    const authToken = "1d64382c55cc08f0e9c0f001d6a440f2";

    if(vBoolExportActivarTwilio == true){
        const client = require('twilio')(accountSid, authToken);

        client.messages
        .create({
            body: 'Hola '+vExportNomApeParticipante+', este es un mensaje desde el Sistema. Samir Morales, Siiiii!',
            from: '+17175276391',
            // to: '+50584951622'
            to: vExportTelParticipante
        })
        .then(message => console.log(message.sid));   
        vBoolExportActivarTwilio = false;
    }

    
     