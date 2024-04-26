<?php
// require_once("../../AuxiliarPhp/Constants.php");
require_once(dirname(__FILE__, 3)."/Assets/AuxiliarPhp/Constants.php");
class Conexiondatabase{

    public static function ConexionSecurity()
    {
        try{
            // $mysqli = new mysqli( 'localhost', 'root', '1234', 'sge_bd_2') or die();
            $mysqli = new mysqli( CteHost, CteUser, CtePassword, CteBDName, 3306) or die();
            $mysqli -> set_charset( 'utf8');
            return $mysqli;
        }catch (exception $e){
            echo $e->getMessage();
            // echo mysqli_errno($mysqli) . ":" .mysqli_errno($mysqli) ."/n";
        }
    }

    public static function PathSecurity()
    {
        $path = 'http://localhost/SGE_V1/index.html';
        return $path;
    }

}

?>