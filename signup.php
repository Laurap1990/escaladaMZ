<?php
    require './includes/funciones.php';
    incluirTemplate('headerlogin');
    require './clases/user.php';
    require './includes/config/database.php';
    $db = conectarDB();
    error_reporting(0);
    //variables
    $errores = [];

    //vamos a revisar el request method. puesto en el form 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $usuario = new user($_POST);

        

        if($_POST['nick'] == ''){
            $errores[] = "El nick es obligatorio";
        }
        if($_POST['nombre'] == ''){
            $errores[] = "El nombre es obligatorio";
        }
        if($_POST['apellido'] == ''){
            $errores[] = "El apellido es obligatorio";
        }
        if($_POST['email'] == ''){
            $errores[] = "El email es obligatorio";
        }
        if($_POST['pass'] !== $_POST['confirm']){

            $errores[] = "Las contraseñas no coinciden";
        }

        //Código que se ejecuta si no hay errores
        if(empty($errores)){
            $query = $usuario -> createUser();
            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('Location: /escaladamz/login.php?resultado=1');
            }
        }

    }

     

?>

<main class="main">
    <div class="centrar-texto registro">
        <h1 class="no-margin no-padding">Regístrate</h1>
        <span>ó <a href="login.php">Inicia Sesión</a></span>
    </div>

    <div class="contenedor centrar-texto block">
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

            <form action="signup.php" method="POST" class="formulario">
                <input class="log" type="text" name="nick" placeholder="Nick" value="<?php echo $nick ?>">
                <input class="log" type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombre ?>">
                <input class="log" type="text" name="apellido" placeholder="Primer Apellido" value="<?php echo $apellido ?>">
                <input class="log" type="email" name="email" placeholder="Ingresa tu email" value="<?php echo $email ?>">
                <input class="log" type="password" name="pass" placeholder="Contraseña">
                <input class="log" type="password" name="confirm" placeholder="Confirma tu contraseña">
                <input class="boton-primario" type="submit" value="enviar">
            </form>
    </div>

</main>

</body>
</html>
