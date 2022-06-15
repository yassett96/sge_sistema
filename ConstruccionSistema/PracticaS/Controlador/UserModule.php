<?php
require_once 'MainSecurity.php';



class UserModule
{
   
    public function get_validar_login($User,$Pass){

        $datos = '';

        $query = "CALL login_verif('$User', '$Pass');";

//echo ($query);
//exit;

        $mysqli = ConfigureConnection::SecurityConnection();
        $result = $mysqli->query($query);


        if ($result -> num_rows == 1) {
            $datos = $result->fetch_assoc();


        }

        $mysqli->close();
        return $datos;

    }

    public function get_contador($Title){
        $return = '';
        $query = "Call Contador_Visita('$Title');";

   //     echo($query);
     //   exit();

        $mysqli = ConfigureConnection::SecurityConnection();
        $result = $mysqli->query($query);
        if ($result) {
            while ($row = $result->fetch_array()) {
                $return .= $row[0];
            }
        }

        $mysqli->close();
        return $return;
    }



}









    




