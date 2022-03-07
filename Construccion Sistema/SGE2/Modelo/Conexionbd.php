<?php

class Conexionbasedatos{

    public static function  ConexionSecurity()
    {
        try{
            $mysqli = new mysqli( 'localhost', 'root', '', 'sge_bd' ) or die();
            $mysqli -> set_charset( 'utf8');
            return $mysqli;
        }catch (exception $e){
            echo $e->getMessage();
            // echo mysqli_errno($mysqli) . ":" .mysqli_errno($mysqli) ."/n";
        }
    }

    public static function PathSecurity()
    {
        $path = 'http://localhost/SGE2';
        return $path;
    }

}

?>