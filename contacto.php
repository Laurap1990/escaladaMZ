<?php
    require './includes/funciones.php';

    incluirTemplate('header');
?>

    <main class="main main-contacto">
        <h2 class="titulo">Contacta con Nosotros</h2>

        <form action="" class="formulario">
            <div class="contenedor contenedor-formulario">
                <fieldset>
                    
                    <input type="text" value="Nombre" placeholder="nombre" id="nombre">

                    <input type="text" value="Apellidos" placeholder="apellidos" id="apellidos">

                    <input type="email" value="Dirección de Correo" placeholder="email" id="email">

                    <input type="tel" value="Teléfono" placeholder="telefono" id="telefono">

                    <textarea name="" id="" cols="30" rows="10">Mensaje</textarea>

                </fieldset>
                
                <input type="submit" value="enviar" class="boton-primario">
            </div>
        </form>
    </main>


    <?php
        incluirTemplate('footer');
    ?>
