// Download the helper library from https://www.twilio.com/docs/node/install
    // Find your Account SID and Auth Token at twilio.com/console
    // and set the environment variables. See http://twil.io/secure
    const accountSid = "AC29d0b62f57c99f365aa7a1589f32dd25";    
    const authToken = "1d64382c55cc08f0e9c0f001d6a440f2";
    const client = require('twilio')(accountSid, authToken);

    client.messages
    .create({
        body: 'Mensaje desde el Sistema. Lo hice carnal 3, Siiiii!',
        from: '+17175276391',
        to: '+50584951622'
    })
    .then(message => console.log(message.sid));

    function FunEnviarMensaje(){
        const accountSid = "AC29d0b62f57c99f365aa7a1589f32dd25";    
        const authToken = "1d64382c55cc08f0e9c0f001d6a440f2";
        const client = require('twilio')(accountSid, authToken);

        client.messages
        .create({
            body: 'Mensaje desde el Sistema. Lo hice carnal 3, Siiiii!',
            from: '+17175276391',
            to: '+50584951622'
        })
        .then(message => console.log(message.sid));
    }