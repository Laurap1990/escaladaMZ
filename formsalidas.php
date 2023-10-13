<?php

    require './includes/funciones.php';
    //incluir la conexion
    require './includes/config/database.php';

    incluirTemplate('header');

    //conexion a la base de datos
    conectarDB();


?>

<main class="main main-contacto">
        <h2 class="titulo">Crea tu propia Salida</h2>

        <form action="" class="formulario">
            <div class="contenedor contenedor-formulario">
                <fieldset>
                    <legend>Indica tus datos</legend>
                    <input type="text" value="Nombre" placeholder="nombre" id="nombre">

                    <input type="text" value="Apellidos" placeholder="apellidos" id="apellidos">

                    <input type="email" value="Dirección de Correo" placeholder="email" id="email">

                    <input type="tel" value="Teléfono" placeholder="telefono" id="telefono">

                </fieldset>


                <fieldset>
                    <legend>Crea tu propia salida</legend>

                    <label for="lugar">Indica en qué lugar comienza la aventura</label>
                    <input type="text" value="Lugar" placeholder="Lugar" id="lugar">

                    <label for="cuando">Dinos qué día escalamos</label>
                    <input type="date" value="Cuando" placeholder="cuando" id="cuando">

                    <label for="mensaje">Aquí puedes ser todo lo esplícitx que quieras; dinos si sabes escalar de primero,
                        si tienes coche, si tienes material... etc
                    </label>
                    <textarea name="" id="" cols="30" rows="10">Mensaje</textarea>

                </fieldset>

                <input type="submit" value="enviar" class="boton-primario">
            </div>
        </form>
    </main>

<?php

    mysqli_close($db);

    incluirTemplate('footer');
?>