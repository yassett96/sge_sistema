<?php 

function conConsultaDatosSede(){   
    require_once('../Modelo/sede.php');        
        if($query -> rowCount() > 0){ 
            $var = "";
            foreach($results as $result) { 
              $var = $var . "<option>".$result -> Sede."</option><br>";        
            }
        }
        return $var;
}

?>