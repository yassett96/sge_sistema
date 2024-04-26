<?php

require_once ("../../Modelo/General/Conexionbd.php");

class MCategoria{

    public function select_categoria()
    {
        $data = '';
        $query = "CAll Lista_CategoriaValidadaX();";
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if($result){
            while ($valores = $result->fetch_array()){
                $data .= $valores[0];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }

    public function lista_subcategoria_categoria($Id_Cat)
    {
        $data = '';
        $query = "CAll Lista_SubcategoriaSegunCategoria($Id_Cat);";  // IMPRIME COMO TABLA*/       



        //echo ($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        
        if ($result) {
            while ($row = $result->fetch_array()) {
                $data .= $row[0];
            }
        }
           
        $mysqli->close();
        return $data;
    }

    public function get_BuscarNCategoria($NCat)
    {
        $return ='';

        $query = "CALL Buscar_NombreCategoria('$NCat');";
        //echo $query;
        //exit;
            $mysqli = Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if($result)
            {
                while($row = $result->fetch_array())
                {
                    if($row[0] > 0)
                        {
                        $return = "Lo sentimos, esta categoria ya se encuentra registrada";
                        }
                    $mysqli->close();
                }
                
            
            }
            return $return;
    }

    public function get_insertar_categoria($Ncat)
    {
        $insertp = '';
        $query = "CAll Insertar_Categoria('$Ncat');";        
       
        //echo $query;
        //exit;
       
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result){
            $insertp = $mysqli->error;
        }else{
            $insertp = "1";
        }
        $mysqli->close();
        return $insertp;  
    }

    public function get_Actualizar_categoria($Ncategoria,$UpdaCategoria)
    {
        $insertp = '';
        $query = "CAll Actualizar_Categoria($Ncategoria,'$UpdaCategoria');";        
       
        //echo $query;
        //exit;
       
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result){
            $insertp = $mysqli->error;
        }else{
            $insertp = "1";
        }
        $mysqli->close();
        return $insertp;  
    }

    
    public function select_categoria_Seleccionada($idcat)
    {
        $data = '';
        $query = "CAll Lista_CategoriaSeleccionada_V1($idcat);";

        //echo $query;
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if($result){
            while ($valores = $result->fetch_array()){
                $data .= $valores[0];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }

    public function select_añoacademico()
    {
        $data = '';
        $query = "CAll Lista_AñoAcademico();";
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if($result){
            while ($valores = $result->fetch_array()){
                $data .= $valores[0];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }

    public function get_Insertar_Subcategoria($idCate,$Subc,$contador)
    {
        $insertp = '';
        $query = "CAll Insertar_Subcategoria($idCate,'$Subc',$contador);";        
       
        //echo $query;
        //exit;
       
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result){
            $insertp = $mysqli->error;
        }else{
            $insertp = "1";
        }
        $mysqli->close();
        return $insertp;  
    }

    public function select_añoacademicoSUB($id_subcate)
    {
        $data = '';
        $query = "CAll Lista_AñoAcademicoSUB($id_subcate);";
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if($result){
            while ($valores = $result->fetch_array()){
                $data .= $valores[0];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }

    public function get_Actualizar_Subcate($IdSubcate ,$UpdaSubc,$IDAñoA)
    {
        $insertp = '';
        $query = "CAll Actualizar_Subcategoria($IdSubcate ,'$UpdaSubc',$IDAñoA);";        
       
        //echo $query;
        //exit;
       
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result){
            $insertp = $mysqli->error;
        }else{
            $insertp = "1";
        }
        $mysqli->close();
        return $insertp;  
    }

    public function get_Eliminar_Subcategoria($Idsubcat)
    {
        $insertp = '';
        $query = "CAll Eliminar_Subcategoria($Idsubcat);";        
       
        //echo $query;
        //exit;
       
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result){
            $insertp = $mysqli->error;
        }else{
            $insertp = "1";
        }
        $mysqli->close();
        return $insertp;  
    }

    public function get_insertar_CategoriaE($IdCate)
       {
        $insertp = '';
        $query = "CAll Agregar_CategoriaEvento($IdCate);";        
       
        //echo $query;
        //exit;
       
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result){
            $insertp = $mysqli->error;
        }else{
            $insertp = "1";
        }
        $mysqli->close();
        return $insertp;  
    }

    public function CategoriaEventoA()
    {
        $data = '';
        $query = "CAll Listar_CategoriasEventoActual();";
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if($result){
            while ($valores = $result->fetch_array()){
                $data .= $valores[0];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }

    public function get_Eliminar_CategoriaE($idCE)
    {
        $insertp = '';
        $query = "CAll Eliminar_CategoriaE($idCE);";        
       
        //echo $query;
        //exit;
       
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result){
            $insertp = $mysqli->error;
        }else{
            $insertp = "1";
        }
        $mysqli->close();
        return $insertp;  
    }

    public function ObtenerNombreCategoria($idcea){

        $datosCEA = '';
        $query = "Call Cargar_IDCategoriaEvento($idcea);";

        //echo($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        
        if ($result && $result -> num_rows == 1) {
            $datosCEA = $result->fetch_assoc();


        }
        else { $datosCEA = ""; }
        $mysqli->close();
        return $datosCEA;
    }

    public function SubcategoriasXCategoriaEventoA($idcom)
    {
        $data = '';
        $query = "CAll Lista_SubcategoriaEA($idcom);";

        //echo($query);
        //exit;

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if($result){
            while ($valores = $result->fetch_array()){
                $data .= $valores[0];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }
}

?>