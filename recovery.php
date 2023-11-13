<?php

    require './includes/funciones.php';
    incluirTemplate('headerlogin');
    // error_reporting(0);


    //conectar base de datos
    require './includes/config/database.php';
    $db = conectarDB();

    //variables
    $email = '';
    $name = 'EscaladaMZ';
    $errores = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = $_POST['email'];
            //Consulta
        $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $resultado = mysqli_query($db, $query);
        $queryEmail = mysqli_fetch_assoc($resultado);



        if($queryEmail['email'] === $email){
            $name = $queryEmail['nombre'];
            enviarMail($email, $name);
        }

    }
    



?>




<main class="main-log main">
        <div class="centrar-texto contenedor">
            <h2 class="no-margin no-padding">Recuperación de contraseña</h2>
                <div class="contenedor centrar-texto">
                    <form action="recovery.php" method="POST" class="formularioLog">
                        <input class="log" type="text" name="email" placeholder="Ingresa tu email">
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