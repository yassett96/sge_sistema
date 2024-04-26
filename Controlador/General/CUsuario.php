<?php 
require_once ("../../Modelo/General/MUsuario.php");


function func_get_usuario_Por_Id($id_usuario){
    $modelousuario = new UsuarioModelo();

    $result = $modelousuario->func_get_usuario_Por_Id($id_usuario);
    
    if($result == true){
        return $result;
    }
    else{
        echo "<script>alert('Error al cargar el usuario');</script>";
    }
}



?>