<?php
if(isset($_GET['varEntrada'])){

$output=null;
$retval=null;
//  exec('node C:/xampp/htdocs/sge_sistema/ConstruccionSistema/SGE2/Vista/VInscripcionEventoFeria/confirmacion/send_sms.js', $output, $retval);

shell_exec("node C:\xampp\htdocs\sge_sistema\SGE_V1\Vista\Participante\confirmacion\send_sms.js");

echo 'C:\xampp\htdocs\sge_sistema\SGE_V1\Vista\Participante\confirmacion\send_sms.js';
exit;

// Intento de explicación en GitHub


}

?>