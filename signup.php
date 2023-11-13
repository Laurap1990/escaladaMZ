<?php
    require './includes/funciones.php';
    incluirTemplate('headerlogin');

    require './includes/config/database.php';
    $db = conectarDB();

    //para ocultar warning si el array está vacío
    error_reporting(0);

    //variables

    $nick = '';
    $nombre = '';
    $apellido = '';
    $email = '';
    $pass = '';
    $errores = [];

    //vamos a revisar el request method. puesto en el form 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nick = $_POST['nick'] ?? null;
        $nombre = $_POST['nombre'] ?? null;
        $apellido = $_POST['apellido'] ?? null;
        $email = trim($_POST['email'] ?? null);

        if($nick == ''){
            $errores[] = "El nick es obligatorio";
        }
        if($nombre == ''){
            $errores[] = "El nombre es obligatorio";
        }
        if($apellido == ''){
            $errores[] = "El apellido es obligatorio";
        }
        if($email == ''){
            $errores[] = "El email es obligatorio";
        }
        if($_POST['pass'] === $_POST['confirm']){
            $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
        }else{
            $errores[] = "Las contraseñas no coinciden";
        }

        //Código que se ejecuta si no hay errores
        if(empty($errores)){
            $query = "INSERT INTO usuarios (nick, email, nombre, apellido1, password)
                        VALUES ('$nick','$email', '$nombre', '$apellido', '$pass')";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('Location: /escaladamz/login.php?resultado=1');
            }
        }

    }


    //     echo "<pre>";
    //  var_dump($_POST);
    //  echo "</pre>";

     

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
