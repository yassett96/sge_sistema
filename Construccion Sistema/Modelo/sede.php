<?php 


 
        require_once( "connect.php");
    
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $sql = "SELECT * FROM sede"; 
        $query = $conn -> prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_OBJ); 

       

   
?>