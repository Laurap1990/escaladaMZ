<?php

    require 'app.php'; //llamamos a app.php
    require "vendor/autoload.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;


    function incluirTemplate(string $nombre){ //CREAMOS FUNCION PARA PODER INCLUIR LOS TEMPLATES Y ESTABLECEMOS PARÁMETRO
        include TEMPLATES_URL . "/$nombre.php"; // colocamos la variable
    }

    function sesionUsuario(mysqli $con):array{
        if(isset($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
            $query = "SELECT * FROM usuarios WHERE id = {$id}";
            $resultado = mysqli_query($con, $query);
            $datos = mysqli_fetch_assoc($resultado);
    
            if(count($datos) > 0){
                return $datos;
            }
        }
    }

    function enviarMail ($email, $nombre){
        $mail = new PHPMailer(true);

        $mail ->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail -> SMTPAuth = true;
        $mail->isHTML(true);
    
        $mail -> Host = "smtp.gmail.com";
        $mail -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        $mail -> Username = "laurapasos55@gmail.com";
        $mail -> Password = "gfyjxgubwyjuhnxe";
        $mail -> setFrom("laurap__@hotmail.com", "escaladaMZ");
        $mail -> addAddress($email, $nombre);
    
        $subject = "Recuperar contraseña";
        $subject = "=?UTF-8?B?".base64_encode($subject)."=?=";
        $mail->Subject = $subject;
        $mail -> Body = 'Pulsa <a href="http://localhost/escaladamz/recovery2.php">Aquí</a> Para reestablecer tu contraseña';
        
    
        $mail -> send();
    
        echo "email sent";
    
        
    }