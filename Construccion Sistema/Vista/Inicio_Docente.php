<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../Vista/Recursos/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Vista/Recursos/css/inicio_docente.css">
    <title>Iniciar Sesión</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../Vista/Recursos/Imagenes/FCyS balnco.png" height="50px">
        </div>
    </header> 
    <div class="nav-link active">
    <a id="texto_atras" href="index.html" > << Atrás  </a>
    </div>   
    <h4 class="h4">Bienvenido/a</h4>
    <h4 class="h4">Ingrese los datos para iniciar sesión</h4>
        <form action="">
            <div class="form">
                <ul class="nav nav-tabs">
                    <li class="nav-item" id="pestaña">
                        <a class="nav-link active" aria-current="page" href="#">Docentes</a>
                    </li>
                    <li class="nav-item" id="pestaña">
                        <a class="nav-link" href="Inicio_Esudiantes.html">Estudiantes</a>
                    </li>
                    <li class="nav-item" id="pestaña">
                        <a class="nav-link" href="Inicio_General.html">General</a>
                    </li>
                </ul> 
                <div class="grupo">
                    <img class="iconos" src="../Vista/Recursos/Imagenes/usuario.png" alt="">
                    <input type="text" name="" id="" required>
                    <label>Usuario</label>
                </div> 
                <div class="grupo">
                    <img class="iconos" src="../Vista/Recursos/Imagenes/contraseña.png" alt="">
                    <input type="password" name="" id="" required>
                    <label>Contraseña</label>
                </div>
                <div class="grupo">
                    <img class="iconos" src="../Vista/Recursos/Imagenes/sede.png" alt="">
                <select class="form-select" aria-label="Default select example">                                         
                    <?php 
                        require( "../Controlador/connect.php");
                        try {
                            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                            $sql = "SELECT * FROM sede"; 
                            $query = $conn -> prepare($sql); 
                            $query -> execute(); 
                            $results = $query -> fetchAll(PDO::FETCH_OBJ); 

                            if($query -> rowCount() > 0)   { 

                            foreach($results as $result) { 
                            echo "<option>".$result -> Sede."</option><br>";
                                }
                            }
                        } catch (PDOException $pe) {
                            die("Could not connect to the database $dbname :" . $pe->getMessage());
                        }
                    ?>                   
                  </select> 
                </div>  
                  <button class="BotonIniciarSesion">Iniciar Sesión</button>
                </div>
                <a class="nav-link active" id="formulario_abajo" href="#">¿Olvidó su contraseña?</a>
                <a class="nav-link active" id="formulario_abajo2" href="index.html">Regresar a Inicio</a>
        </form>
        <br>
        <br>
        <br>        

    <footer>
        <h4 id="h4_contactenos"> Contáctenos </h4>
        <div class="h5_detalles_footer">
            <h5>Teléfono: </h5>    
            <h5> Correo: </h5> 
            <h5> Dirección: </h5>
        </div>
        <div class="footer_h5">
            <h5><a class="nav-link active" id="texto" href="index.html" >Inicio</a></h5> 
        </div>
        <div class="img_footer">
            <img src="../Vista/Recursos/Imagenes/facebook.png" alt="20px" width="20px">
            <img class="espacio_img" src="../Vista/Recursos/Imagenes/global.png" alt="20px" width="20px">
        </div>
        <div class="p_footer">
            <p>© 2021 Universidad Nacional de Ingeniería - FCYS</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>