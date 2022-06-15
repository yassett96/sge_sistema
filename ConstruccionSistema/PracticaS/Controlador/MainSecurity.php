<?php

class ConfigureConnection
{

    public static function SecurityConnection()
    {
        try {
            $mysqli = new mysqli('localhost', 'root', '','baseprueba_t') or die();
            $mysqli-> set_charset('utf8');
            return $mysqli;
        } catch (exception $e) {
            echo $e->getMessage();
            //echo mysqli_errno($mysqli) . ":" .mysqli_errno($mysqli) ."\n";
        }
    }

    public static function PathSecurity()
    {
        $path='http://localhost/PracticaS';
        return $path;
    }

}?>
