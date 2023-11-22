<?php

use function PHPUnit\Framework\isEmpty;

    require './includes/funciones.php';

    incluirTemplate('header');

    //variables
    $errores = [];


    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if($_POST['nombre'] === ''){
            $errores[] = 'El campo nombre no puede quedar vacío';
        }
        if($_POST['apellido'] === ''){
            $errores[] = 'El campo apellido no puede quedar vacío';
        }
        if($_POST['email'] === ''){
            $errores[] = 'El campo email no puede quedar vacío';
        }
        if($_POST['telefono'] === ''){
            $errores[] = 'El campo teléfono no puede quedar vacío';
        }
        if($_POST['body'] === ''){
            $errores[] = 'El campo mensaje no puede quedar vacío';
        }



        if(isEmpty($errores)){
            enviarMailContacto($_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['telefono'], $_POST['body']);
        }

    }




?>

    <main class="main main-contacto">
        <h2 class="titulo">Contacta con Nosotros</h2>
        <?php foreach($errores as $error): ?>

            <div class="alerta error">
            <p><?php echo $error ?></p>
            </div>

        <?php endforeach; ?>

        <form action="contacto.php" class="formulario" method="POST">
            <div class="contenedor contenedor-formulario">
                <fieldset>
                    
                    <input type="text" name="nombre" value="Nombre" placeholder="nombre" id="nombre">

                    <input type="text"  name="apellido" value="Apellidos" placeholder="apellidos" id="apellidos">

                    <input type="email" name="email" value="Dirección de Correo" placeholder="email" id="email">

                    <input type="tel" name="telefono" value="Teléfono" placeholder="telefono" id="telefono">

                    <textarea name="body" id="body" cols="30" rows="10">Mensaje</textarea>

                </fieldset>
                
                <input type="submit" value="enviar" class="boton-primario">
            </div>
        </form>
    </main>


    <?php
        incluirTemplate('footer');
    ?>
