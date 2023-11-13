<?php
    require './includes/funciones.php';
    incluirTemplate('headerlogin');
    //para ocultar warning si el array está vacío
    error_reporting(0);
    session_start();
   

    //conectar base de datos
    require './includes/config/database.php';
    $db = conectarDB();

    //variables globales

    $email = '';
    $pass = '';
    $datos = [];
    $mensaje= '';

    //muestra resultado mostrado en la url
    $getResultado = $_GET['resultado'] ?? null;


    

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = trim($_POST['email'] ?? null);

    
        if($_POST['email'] === ''){
            $mensaje = "El email es obligatorio";
            
        }else if($_POST['pass'] === ''){
            $mensaje = "La contraseña es obligatoria";
            
        }else if(!empty($_POST['email']) && !empty($_POST['pass'])){
            $query = "SELECT id, email, password FROM usuarios WHERE email = '{$email}'";
            $resultado = mysqli_query($db, $query);
            $datos = mysqli_fetch_assoc($resultado);
            // echo "<pre>";
            // var_dump(count($datos));
            // echo "</pre>";

            //si datos tiene algun resultado y verificamos que la contraseña de la bbdd 
            //y la ingresada por el usuario son iguales.
             if($_POST['pass'] === $datos['password']){
                 $_SESSION['user_id'] = $datos['id'];
                 header('Location: /escaladamz/index.php?resultado=1');
             }else{
                 $mensaje = "Tus credenciales no son correctas";
             }  
        
        }else if($_POST['email'] !== $datos['email']){
            $mensaje = "El usuario no existe";
        }
    }



?>

    <main class="main-log main">
        <div class="centrar-texto contenedor">
            <?php if($getResultado == 1){?>
                <p class="alerta exito">Usuario creado correctamente</p>
            <?php };?>
            <h2 class="no-margin no-padding">Inicia Sesión</h2>
            <span>ó <a href="signup.php">Regístrate</a></span>

            <?php if(!empty($mensaje)):?>
                <p class="alerta error"><?php echo $mensaje?></p>
                <?php endif;?>
            
        </div>
        

        <div class="contenedor centrar-texto">
            <form action="login.php" method="POST" class="formularioLog">
                <input class="log" type="text" name="email" placeholder="Ingresa tu email">
                <input class="log" type="password" name="pass" placeholder="Contraseña">
                <input class="boton-primario" type="submit" value="enviar">
            </form>
            <a href="recovery.php">¿Olvidaste tu contraseña?</a>
        </div>

    </main>
    <footer class="footer-dash">
        <div class="barra-footer">
            <p>Todos los derechos reservados <?php echo date('Y')?> ©</p>
        </div>
    </footer>
    
</body>
</html>
