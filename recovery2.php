<?php

    require './includes/funciones.php';
    incluirTemplate('headerlogin');
    error_reporting(0);


    //conectar base de datos
    require './includes/config/database.php';
    $db = conectarDB();



    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_POST['email'];
            //Consulta
        $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $resultado = mysqli_query($db, $query);
        $queryEmail = mysqli_fetch_assoc($resultado);



        if($_POST['pass'] === $_POST['confirm']){
            $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
            $id = $queryEmail['id'];
            $queryPass = "UPDATE usuarios SET password = '{$pass}' WHERE id={$id}";
            $resultadoPass = mysqli_query($db, $queryPass);
            header('Location: /escaladamz/login.php');
        }

    }



?>




<main class="main-log main">
        <div class="centrar-texto contenedor">
            <h2 class="no-margin no-padding">Recuperación de contraseña</h2>    
                <div class="contenedor centrar-texto">
                    <form action="recovery2.php" method="POST" class="formularioLog">
                        <input class="log" type="text" name="email" placeholder="Ingresa tu email">
                        <input class="log" type="password" name="pass" placeholder="Contraseña">
                        <input class="log" type="password" name="confirm" placeholder="Confirma tu contraseña">
                        <input class="boton-primario" type="submit" value="enviar">
                    </form>
                </div>
        </div>
        



    </main>
    <footer class="footer-dash">
        <div class="barra-footer">
            <p>Todos los derechos reservados <?php echo date('Y')?> ©</p>
        </div>
    </footer>
    
</body>
</html>