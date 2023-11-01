<?php

    require './includes/funciones.php';
    incluirTemplate('headerlogin');
    // error_reporting(0);

    require "vendor/autoload.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;


    //conectar base de datos
    require './includes/config/database.php';
    $db = conectarDB();

    //variables
    $email = '';
    $name = 'EscaladaMZ';
    $errores = '';

    //Consulta
    $query = "SELECT email FROM usuarios WHERE email = '{$email}'";
    $resultado = mysqli_query($db, $query);
    $queryEmail = mysqli_fetch_assoc($resultado);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = $_POST['email'] ?? NULL;

            //configuracion phpmailer
    $mail = new PHPMailer(true);

    $mail ->isSMTP();
    $mail -> SMTPAuth = true;

    $mail -> Host = "smtp.gmail.com";
    $mail -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail -> Username = "laurapasos55@gmail.com";
    $mail -> Password = "gfyjxgubwyjuhnxe";
    $mail -> setFrom($email,$name);
    $mail -> addAddress("laurap__@hotmail.com", "laura");

    $mail -> Subject = "contraseña";
    $mail -> Body = "contraseña olvidada";

    $mail -> send();

    echo "email sent";

    }



?>




<main class="main-log main">
        <div class="centrar-texto contenedor">
            <h2 class="no-margin no-padding">Recuperación de contraseña</h2>    
            <?php if(!empty($mensaje)):?>
                <p class="alerta error"><?php echo $mensaje?></p>
                <?php endif;?> 
        </div>
        

        <div class="contenedor centrar-texto">
            <form action="recovery.php" method="POST" class="formularioLog">
                <input class="log" type="text" name="email" placeholder="Ingresa tu email">
                <input class="boton-primario" type="submit" value="enviar">
            </form>
        </div>

    </main>
    <footer class="footer-dash">
        <div class="barra-footer">
            <p>Todos los derechos reservados <?php echo date('Y')?> ©</p>
        </div>
    </footer>
    
</body>
</html>